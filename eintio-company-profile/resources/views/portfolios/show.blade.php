<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">

    <title>{{ $portfolio->title }} — Portofolio | PT Eintio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8faf9;
            color: #172033;
            line-height: 1.7;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            width: min(1180px, calc(100% - 40px));
            margin: auto;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid #edf0f2;
        }

        .nav-inner {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            font-size: 21px;
            font-weight: 700;
            letter-spacing: -.5px;
            color: #142033;
        }

        .brand span {
            color: #28a889;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 34px;
            font-size: 14px;
            color: #697586;
        }

        .nav-links a {
            transition: .2s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #17977a;
        }

        .nav-contact {
            padding: 11px 19px;
            border-radius: 9px;
            background: #1fa586;
            color: white !important;
            font-weight: 600;
        }

        /* =========================
           HERO
        ========================= */

        .hero {
            padding: 76px 0 70px;
            background:
                radial-gradient(circle at 90% 20%, rgba(37,169,139,.08), transparent 28%),
                #fff;
            border-bottom: 1px solid #edf0f2;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #7b8797;
            font-size: 13px;
            margin-bottom: 38px;
            transition: .2s;
        }

        .back-link:hover {
            color: #159879;
            transform: translateX(-3px);
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.3fr .7fr;
            gap: 70px;
            align-items: end;
        }

        .category {
            display: inline-flex;
            align-items: center;
            padding: 7px 13px;
            border-radius: 999px;
            background: #e9f8f3;
            color: #148b70;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .7px;
            text-transform: uppercase;
            margin-bottom: 19px;
        }

        .project-title {
            font-size: clamp(38px, 5vw, 66px);
            line-height: 1.06;
            letter-spacing: -2.7px;
            font-weight: 700;
            color: #152033;
            max-width: 800px;
        }

        .project-description {
            max-width: 730px;
            margin-top: 25px;
            color: #697586;
            font-size: 16px;
            line-height: 1.85;
        }

        .project-meta {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 11px;
            color: #657184;
            font-size: 13px;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .meta-item i {
            color: #20a586;
        }

        .meta-dot {
            color: #c7ced6;
        }

        /* =========================
           MAIN IMAGE
        ========================= */

        .main-image-section {
            padding: 70px 0 30px;
        }

        .main-image {
            width: 100%;
            height: min(600px, 52vw);
            min-height: 320px;
            object-fit: cover;
            border-radius: 25px;
            background: #eef3f1;
            box-shadow: 0 25px 70px rgba(22, 35, 50, .09);
        }

        .image-placeholder {
            width: 100%;
            height: min(600px, 52vw);
            min-height: 320px;
            border-radius: 25px;
            background: #edf3f1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a1adb8;
        }

        .image-placeholder i {
            font-size: 45px;
        }

        /* =========================
           PROJECT INFO
        ========================= */

        .info-section {
            padding: 70px 0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: .7fr 1.3fr;
            gap: 90px;
        }

        .section-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #20a586;
            margin-bottom: 14px;
        }

        .section-title {
            font-size: 31px;
            line-height: 1.2;
            letter-spacing: -1px;
            color: #162034;
        }

        .info-list {
            border-top: 1px solid #e8ecef;
        }

        .info-row {
            display: grid;
            grid-template-columns: 150px 1fr;
            gap: 20px;
            padding: 17px 0;
            border-bottom: 1px solid #e8ecef;
            font-size: 14px;
        }

        .info-label {
            color: #8a95a3;
        }

        .info-value {
            color: #293548;
            font-weight: 600;
        }

        /* =========================
           BACKGROUND
        ========================= */

        .content-section {
            padding: 85px 0;
            background: white;
        }

        .content-grid {
            display: grid;
            grid-template-columns: .65fr 1.35fr;
            gap: 100px;
        }

        .content-text {
            color: #687586;
            font-size: 15px;
            line-height: 1.9;
            white-space: pre-line;
        }

        /* =========================
           REQUIREMENTS
        ========================= */

        .requirements-section {
            padding: 85px 0;
        }

        .requirements-grid {
            margin-top: 42px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .requirement-card {
            background: white;
            border: 1px solid #e9edef;
            border-radius: 17px;
            padding: 24px;
            display: flex;
            gap: 15px;
            align-items: flex-start;
            transition: .25s ease;
        }

        .requirement-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(20,35,50,.06);
        }

        .check-icon {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            background: #e8f8f2;
            color: #1ca382;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .requirement-text {
            font-size: 14px;
            color: #4d596a;
        }

        /* =========================
           SOLUTIONS
        ========================= */

        .solutions-section {
            padding: 85px 0;
            background: white;
        }

        .solutions-grid {
            margin-top: 42px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .solution-card {
            padding: 30px;
            border: 1px solid #e8edef;
            border-radius: 19px;
            transition: .25s ease;
        }

        .solution-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(20,35,50,.07);
        }

        .solution-icon {
            width: 48px;
            height: 48px;
            border-radius: 13px;
            background: #e8f8f2;
            color: #1b9e80;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
        }

        .solution-title {
            font-size: 17px;
            color: #1a2638;
            margin-bottom: 9px;
        }

        .solution-description {
            color: #7a8695;
            font-size: 13px;
            line-height: 1.8;
        }

        /* =========================
           GALLERY
        ========================= */

        .gallery-section {
            padding: 85px 0;
        }

        .gallery-grid {
            margin-top: 42px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 17px;
            background: #edf2f0;
            aspect-ratio: 16 / 10;
            cursor: pointer;
        }

        .gallery-item:first-child {
            grid-column: span 2;
            grid-row: span 2;
            aspect-ratio: auto;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .45s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.045);
        }

        /* =========================
           FOOTER CTA
        ========================= */

        .cta {
            padding: 95px 0;
            background: #142033;
            color: white;
        }

        .cta-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
        }

        .cta h2 {
            font-size: clamp(30px, 4vw, 46px);
            line-height: 1.15;
            letter-spacing: -1.5px;
        }

        .cta p {
            color: #9ca7b5;
            margin-top: 12px;
            max-width: 600px;
            font-size: 14px;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #25a889;
            color: white;
            padding: 14px 22px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            transition: .2s;
        }

        .cta-button:hover {
            background: #1b9578;
            transform: translateY(-2px);
        }

        /* =========================
           FOOTER
        ========================= */

        footer {
            background: #101a2a;
            color: #8f9baa;
            padding: 30px 0;
            font-size: 12px;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* =========================
           LIGHTBOX
        ========================= */

        .lightbox {
            position: fixed;
            inset: 0;
            z-index: 999;
            background: rgba(10,16,25,.94);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .lightbox.is-open {
            display: flex;
        }

        .lightbox img {
            max-width: 92vw;
            max-height: 88vh;
            object-fit: contain;
            border-radius: 10px;
        }

        .lightbox-close {
            position: absolute;
            top: 25px;
            right: 30px;
            width: 42px;
            height: 42px;
            border: 0;
            border-radius: 50%;
            background: rgba(255,255,255,.1);
            color: white;
            cursor: pointer;
            font-size: 17px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 850px) {

            .nav-links {
                display: none;
            }

            .hero-grid,
            .info-grid,
            .content-grid {
                grid-template-columns: 1fr;
                gap: 35px;
            }

            .project-meta {
                justify-content: flex-start;
            }

            .project-title {
                letter-spacing: -1.8px;
            }

            .requirements-grid,
            .solutions-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-item:first-child {
                grid-column: span 2;
                grid-row: span 1;
                aspect-ratio: 16 / 10;
            }

            .cta-inner {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 560px) {

            .container {
                width: min(100% - 28px, 1180px);
            }

            .hero {
                padding: 50px 0;
            }

            .project-title {
                font-size: 39px;
            }

            .main-image {
                height: 280px;
                border-radius: 18px;
            }

            .image-placeholder {
                height: 280px;
                border-radius: 18px;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 3px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .gallery-item:first-child {
                grid-column: span 1;
            }

            .footer-inner {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
        }
    </style>
</head>

<body>

{{-- =========================
     NAVBAR
========================= --}}

<nav class="navbar">
    <div class="container nav-inner">

        <a href="{{ route('home') }}" class="brand">
            PT <span>Eintio</span>
        </a>

        <div class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('profile') }}">Profil</a>
            <a href="{{ route('services') }}">Layanan</a>
            <a href="{{ route('portfolios') }}" class="active">Portofolio</a>
            <a href="{{ route('teams') }}">Tim</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('contact') }}" class="nav-contact">Hubungi Kami</a>
        </div>

    </div>
</nav>


{{-- =========================
     HERO
========================= --}}

<section class="hero">
    <div class="container">

        <a href="{{ route('portfolios') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Portofolio
        </a>

        <div class="hero-grid">

            <div>

                <div class="category">
                    {{ $portfolio->category?->name ?? 'Portofolio' }}
                </div>

                <h1 class="project-title">
                    {{ $portfolio->title }}
                </h1>

                @if($portfolio->description)
                    <p class="project-description">
                        {{ $portfolio->description }}
                    </p>
                @endif

            </div>

            <div class="project-meta">

                @if($portfolio->client)
                    <span class="meta-item">
                        <i class="fa-regular fa-building"></i>
                        {{ $portfolio->client }}
                    </span>

                    @if($portfolio->project_date)
                        <span class="meta-dot">•</span>
                    @endif
                @endif

                @if($portfolio->project_date)
                    <span class="meta-item">
                        <i class="fa-regular fa-calendar"></i>
                        {{ \Carbon\Carbon::parse($portfolio->project_date)->format('Y') }}
                    </span>
                @endif

            </div>

        </div>

    </div>
</section>


{{-- =========================
     MAIN IMAGE
========================= --}}

<section class="main-image-section">
    <div class="container">

        @if($portfolio->image)

            <img
                src="{{ asset('storage/' . $portfolio->image) }}"
                alt="{{ $portfolio->title }}"
                class="main-image"
            >

        @else

            <div class="image-placeholder">
                <i class="fa-regular fa-image"></i>
            </div>

        @endif

    </div>
</section>


{{-- =========================
     PROJECT INFO
========================= --}}

<section class="info-section">
    <div class="container">

        <div class="info-grid">

            <div>
                <div class="section-label">Project Information</div>

                <h2 class="section-title">
                    Detail Proyek
                </h2>
            </div>

            <div class="info-list">

                <div class="info-row">
                    <div class="info-label">Kategori</div>
                    <div class="info-value">
                        {{ $portfolio->category?->name ?? '-' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Client</div>
                    <div class="info-value">
                        {{ $portfolio->client ?: '-' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Tahun</div>
                    <div class="info-value">
                        {{ $portfolio->project_date
                            ? \Carbon\Carbon::parse($portfolio->project_date)->format('Y')
                            : '-' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        {{ $portfolio->status === 'published' ? 'Published' : 'Draft' }}
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


{{-- =========================
     BACKGROUND
========================= --}}

@if($portfolio->background)

<section class="content-section">
    <div class="container">

        <div class="content-grid">

            <div>
                <div class="section-label">
                    Background
                </div>

                <h2 class="section-title">
                    Latar Belakang Proyek
                </h2>
            </div>

            <div class="content-text">
                {{ $portfolio->background }}
            </div>

        </div>

    </div>
</section>

@endif


{{-- =========================
     REQUIREMENTS
========================= --}}

@php
    $requirements = collect($portfolio->requirements ?? [])
        ->filter(fn($item) => filled($item))
        ->values();
@endphp

@if($requirements->count())

<section class="requirements-section">
    <div class="container">

        <div class="section-label">
            Project Requirements
        </div>

        <h2 class="section-title">
            Kebutuhan Proyek
        </h2>

        <div class="requirements-grid">

            @foreach($requirements as $requirement)

                <div class="requirement-card">

                    <div class="check-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>

                    <div class="requirement-text">
                        {{ $requirement }}
                    </div>

                </div>

            @endforeach

        </div>

    </div>
</section>

@endif


{{-- =========================
     SOLUTIONS
========================= --}}

@php
    $solutions = collect($portfolio->solutions ?? [])
        ->filter(fn($item) => filled($item['title'] ?? null))
        ->values();
@endphp

@if($solutions->count())

<section class="solutions-section">
    <div class="container">

        <div class="section-label">
            Development
        </div>

        <h2 class="section-title">
            Solusi yang Dikembangkan
        </h2>

        <div class="solutions-grid">

            @foreach($solutions as $solution)

                <div class="solution-card">

                    <div class="solution-icon">
                        <i class="fa-solid {{ $solution['icon'] ?? 'fa-gear' }}"></i>
                    </div>

                    <h3 class="solution-title">
                        {{ $solution['title'] }}
                    </h3>

                    @if(!empty($solution['description']))

                        <p class="solution-description">
                            {{ $solution['description'] }}
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    </div>
</section>

@endif


{{-- =========================
     GALLERY
========================= --}}

@php
    $gallery = collect($portfolio->gallery ?? [])
        ->filter(fn($item) => filled($item))
        ->values();
@endphp

@if($gallery->count())

<section class="gallery-section">
    <div class="container">

        <div class="section-label">
            Project Gallery
        </div>

        <h2 class="section-title">
            Tampilan Proyek
        </h2>

        <div class="gallery-grid">

            @foreach($gallery as $image)

                <div
                    class="gallery-item"
                    onclick="openLightbox('{{ asset('storage/' . $image) }}')"
                >
                    <img
                        src="{{ asset('storage/' . $image) }}"
                        alt="{{ $portfolio->title }}"
                        loading="lazy"
                    >
                </div>

            @endforeach

        </div>

    </div>
</section>

@endif


{{-- =========================
     CTA
========================= --}}

<section class="cta">
    <div class="container">

        <div class="cta-inner">

            <div>

                <h2>
                    Punya proyek<br>
                    yang ingin dikembangkan?
                </h2>

                <p>
                    Kami siap membantu mewujudkan kebutuhan digital
                    dan teknologi untuk bisnis maupun organisasi Anda.
                </p>

            </div>

            <a href="{{ route('contact') }}" class="cta-button">
                Diskusikan Proyek
                <i class="fa-solid fa-arrow-right"></i>
            </a>

        </div>

    </div>
</section>


{{-- =========================
     FOOTER
========================= --}}

<footer>
    <div class="container">

        <div class="footer-inner">

            <span>
                © {{ date('Y') }} PT Eintio Academic & Technology
            </span>

            <span>
                Academic · Technology · Innovation
            </span>

        </div>

    </div>
</footer>


{{-- =========================
     LIGHTBOX
========================= --}}

<div class="lightbox" id="lightbox">

    <button
        type="button"
        class="lightbox-close"
        onclick="closeLightbox()"
    >
        <i class="fa-solid fa-xmark"></i>
    </button>

    <img id="lightboxImage" src="" alt="Preview">

</div>


<script>

    function openLightbox(image) {

        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');

        lightboxImage.src = image;
        lightbox.classList.add('is-open');

        document.body.style.overflow = 'hidden';
    }


    function closeLightbox() {

        const lightbox = document.getElementById('lightbox');

        lightbox.classList.remove('is-open');

        document.body.style.overflow = '';
    }


    document.getElementById('lightbox').addEventListener('click', function(e) {

        if (e.target === this) {
            closeLightbox();
        }

    });


    document.addEventListener('keydown', function(e) {

        if (e.key === 'Escape') {
            closeLightbox();
        }

    });

</script>

</body>
</html>