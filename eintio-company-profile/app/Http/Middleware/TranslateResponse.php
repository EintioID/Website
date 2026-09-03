<?php

namespace App\Http\Middleware;

use Closure;
use DOMDocument;
use DOMElement;
use DOMText;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateResponse
{
    /**
     * Tag yang isinya JANGAN pernah ditranslate (kode, script, dll).
     */
    protected array $skipAncestorTags = ['script', 'style', 'textarea', 'code', 'pre'];

    /**
     * Attribute HTML yang isinya perlu ikut ditranslate.
     */
    protected array $translatableAttributes = ['placeholder', 'title', 'alt', 'aria-label'];

    /**
     * Locale sumber (bahasa asli teks di blade).
     */
    protected string $sourceLocale = 'id';

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $locale = app()->getLocale();

        // Kalau locale = sumber asli, atau bukan response HTML, skip translate.
        if ($locale === $this->sourceLocale || !$this->isHtmlResponse($response)) {
            return $response;
        }

        $content = $response->getContent();

        if (empty($content)) {
            return $response;
        }

        try {
            $response->setContent($this->translateHtml($content, $locale));
        } catch (\Throwable $e) {
            // Kalau API gagal/timeout, tampilkan HTML asli daripada error total.
            report($e);
        }

        return $response;
    }

    protected function isHtmlResponse($response): bool
    {
        if (!method_exists($response, 'headers')) {
            return false;
        }

        $contentType = $response->headers->get('Content-Type', '');

        return str_contains($contentType, 'text/html');
    }

    protected function translateHtml(string $html, string $locale): string
    {
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML(
            '<?xml encoding="utf-8" ?>' . $html,
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // --- Translate text node (isi teks di antara tag) ---
        $skipConditions = implode('', array_map(
            fn ($tag) => "[not(ancestor::{$tag})]",
            $this->skipAncestorTags
        ));

        $textNodes = $xpath->query("//text(){$skipConditions}");

        foreach ($textNodes as $node) {
            $this->translateTextNode($node, $locale);
        }

        // --- Translate attribute tertentu (placeholder, title, alt, aria-label) ---
        foreach ($this->translatableAttributes as $attr) {
            $attrNodes = $xpath->query("//*[@{$attr}]");

            foreach ($attrNodes as $el) {
                $this->translateAttribute($el, $attr, $locale);
            }
        }

        return $dom->saveHTML();
    }

    protected function translateTextNode(DOMText $node, string $locale): void
    {
        $text = $node->nodeValue;
        $trimmed = trim($text);

        // Skip teks kosong atau cuma angka/simbol
        if ($trimmed === '' || is_numeric($trimmed) || !preg_match('/\p{L}/u', $trimmed)) {
            return;
        }

        if ($this->isExcluded($node->parentNode)) {
            return;
        }

        $translated = $this->cachedTranslate($trimmed, $locale);

        // Pertahankan whitespace asli di sekitar teks
        $node->nodeValue = str_replace($trimmed, $translated, $text);
    }

    protected function translateAttribute(DOMElement $el, string $attr, string $locale): void
    {
        $value = $el->getAttribute($attr);
        $trimmed = trim($value);

        if ($trimmed === '' || !preg_match('/\p{L}/u', $trimmed)) {
            return;
        }

        if ($this->isExcluded($el)) {
            return;
        }

        $el->setAttribute($attr, $this->cachedTranslate($trimmed, $locale));
    }

    /**
     * Elemen dengan class="notranslate" atau translate="no" akan dilewati.
     * Pakai ini di blade buat exclude nama brand, kode, dll.
     */
    protected function isExcluded(?\DOMNode $node): bool
    {
        while ($node instanceof DOMElement) {
            $class = $node->getAttribute('class');
            $translateAttr = $node->getAttribute('translate');

            if (str_contains($class, 'notranslate') || $translateAttr === 'no') {
                return true;
            }

            $node = $node->parentNode;
        }

        return false;
    }

    protected function cachedTranslate(string $text, string $locale): string
    {
        $cacheKey = 'translate:' . $locale . ':' . md5($text);

        return Cache::remember($cacheKey, now()->addDays(30), function () use ($text, $locale) {
            try {
                $translator = new GoogleTranslate($locale);
                $translator->setSource($this->sourceLocale);

                return $translator->translate($text);
            } catch (\Throwable $e) {
                // Kalau gagal, fallback ke teks asli
                return $text;
            }
        });
    }
}