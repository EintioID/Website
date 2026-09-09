
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">
<title>Portofolio — PT Eintio Academic & Technology</title>

<style>
:root{
  --teal:#14b8c4;
  --teal-dark:#0e9aa8;
  --navy:#12233f;
  --ink:#33415c;
  --muted:#687386;
  --bg:#f5f8fe;
  --line:#e5ebf4;
  --yellow:#ffd400;
  --purple:#a55cff;
}
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',Arial,sans-serif}
html{scroll-behavior:smooth}
body{background:var(--bg);color:var(--ink);line-height:1.6}
img{display:block;max-width:100%}
a{text-decoration:none;color:inherit}
.container{max-width:1200px;margin:0 auto;padding:0 24px}

/* ===== NAVBAR ===== */
.navbar{
  background:#fff;
  box-shadow:0 2px 12px rgba(18,35,63,.06);
  position:sticky;top:0;z-index:100;
}
.nav-inner{
  display:flex;align-items:center;gap:32px;
  padding:14px 24px;max-width:1300px;margin:0 auto;
}
.brand{
  display:flex;align-items:center;gap:10px;
  font-weight:800;font-size:17px;color:var(--navy);white-space:nowrap;
}
.logo-img{width:30px;height:30px;object-fit:contain;flex-shrink:0}
.nav-links{
  display:flex;gap:26px;margin-left:auto;
  font-size:14px;color:var(--ink);align-items:center;
}
.nav-links a{padding:5px 0}
.nav-links a:hover,.nav-links a.active{color:var(--teal)}
.nav-links a.active{font-weight:700;border-bottom:2px solid var(--teal)}
.btn-teal{
  background:var(--teal);color:#fff!important;
  padding:10px 22px;border-radius:50px;font-weight:700;
  font-size:14px;border:none;cursor:pointer;
  display:inline-flex;align-items:center;gap:8px;white-space:nowrap;
}
.menu-toggle{
  display:none;margin-left:auto;background:none;border:none;
  font-size:24px;cursor:pointer;color:var(--navy)
}

/* ===== HERO ===== */
.hero{padding:58px 0 70px;background:#f5f8fe}
.hero-grid{
  display:grid;grid-template-columns:1.05fr 1fr;
  gap:48px;align-items:center;
}
.hero-left{padding-top:4px}
.hero-badge{
  display:inline-flex;align-items:center;gap:7px;
  background:#fff;color:var(--teal-dark);
  border:1px solid #9de4e9;border-radius:50px;
  padding:7px 17px;font-size:12px;font-weight:700;
  letter-spacing:.7px;margin-bottom:30px;
}
.hero h1{
  font-size:46px;line-height:1.12;color:#18202d;
  font-weight:800;letter-spacing:-1.2px;margin-bottom:25px;
}
.hero h1 .accent{
  color:var(--teal);position:relative;display:inline-block;
}
.hero h1 .accent:after{
  content:"";position:absolute;left:0;right:0;bottom:-4px;
  height:5px;background:var(--yellow);border-radius:4px;
  transform:rotate(-1deg);
}
.hero p{
  font-size:16px;color:#5e687b;max-width:500px;
  line-height:1.72;
}
.hero-image-box{
  height:390px;border-radius:27px;overflow:hidden;
  background:#fff;box-shadow:0 18px 45px rgba(18,35,63,.08);
  display:flex;align-items:center;justify-content:center;padding:25px;
}
.hero-image{
  width:100%;height:100%;object-fit:cover;border-radius:14px;
}

/* ===== FILTER ===== */
.portfolio-area{padding:0 0 80px}
.filter-bar{
  background:#fff;border:1px solid #e6ebf2;
  border-radius:22px;padding:6px;
  display:flex;align-items:center;gap:5px;
  box-shadow:0 3px 14px rgba(18,35,63,.04);
  margin-bottom:28px;
}
.filters{display:flex;align-items:center;gap:6px;flex:1}
.filter-btn{
  border:0;background:transparent;color:#5f6878;
  padding:10px 24px;border-radius:20px;
  font-size:13px;font-weight:600;cursor:pointer;
}
.filter-btn:hover{color:var(--teal)}
.filter-btn.active{background:var(--teal);color:#fff}
.sort-btn{
  border:1px solid #ccd5e2;background:#fff;
  border-radius:20px;padding:9px 18px;
  font-size:13px;font-weight:600;color:#4b5567;
}

/* ===== PROJECT GRID ===== */
.project-grid{
  display:grid;grid-template-columns:repeat(3,1fr);
  gap:22px;
}
.project-card{
  background:#fff;border-radius:19px;overflow:hidden;
  box-shadow:0 7px 24px rgba(18,35,63,.055);
  min-height:470px;display:flex;flex-direction:column;
  transition:.25s;position:relative;
}
.project-card:hover{transform:translateY(-4px);box-shadow:0 13px 30px rgba(18,35,63,.09)}
.project-image{
  width:calc(100% - 34px);height:205px;
  object-fit:cover;border-radius:10px;margin:17px 17px 0;
  background:#edf3fa;
}
.project-body{padding:17px 17px 19px;display:flex;flex-direction:column;flex:1}
.project-meta{
  display:flex;align-items:center;justify-content:space-between;
  margin-bottom:12px;
}
.category{
  display:inline-flex;align-items:center;
  padding:5px 11px;border-radius:20px;
  font-size:10px;font-weight:600;
}
.cat-blue{background:#edf4ff;color:#3976dd}
.cat-teal{background:#e8faf8;color:#149f98}
.cat-purple{background:#f7efff;color:#a04be0}
.cat-yellow{background:#fff8d9;color:#bc9200}
.project-year{font-size:10px;color:#87909e}
.project-card h3{
  font-size:18px;line-height:1.3;color:#1e2531;
  font-weight:700;margin-bottom:5px;
}
.client{font-size:11px;color:#70798a;margin-bottom:13px}
.project-desc{
  font-size:12.5px;color:#687284;line-height:1.58;
  display:-webkit-box;-webkit-line-clamp:3;
  -webkit-box-orient:vertical;overflow:hidden;
}
.project-arrow{
  width:38px;height:38px;border-radius:50%;
  position:absolute;right:17px;bottom:17px;
  display:flex;align-items:center;justify-content:center;
  font-size:17px;font-weight:500;
}
.arrow-blue{background:#edf4ff;color:#3478ee}
.arrow-teal{background:#e8faf8;color:#14a99f}
.arrow-purple{background:#f7efff;color:#a84ee7}
.arrow-yellow{background:#fff8d9;color:#c69a00}

/* ===== FOOTER ===== */
footer{background:#fff;border-top:1px solid #e8edf4;padding:56px 0 0}
.footer-grid{
  display:grid;grid-template-columns:1.6fr 1fr 1fr 1.2fr;
  gap:40px;padding-bottom:44px;
}
.footer-brand{
  display:flex;align-items:center;gap:10px;
  font-weight:800;color:var(--navy);font-size:16px;margin-bottom:16px;
}
.footer-grid p{font-size:13.5px;color:var(--muted)}
.footer-grid h5{font-size:15px;color:var(--navy);margin-bottom:16px}
.footer-grid ul{list-style:none}
.footer-grid ul li{padding:5px 0;font-size:13.5px;color:var(--muted)}
.footer-grid ul li a:hover{color:var(--teal)}
.socials{display:flex;gap:12px;margin-top:20px}
.socials a{
  width:38px;height:38px;border-radius:10px;
  background:#eef2f8;color:var(--teal-dark);
  display:flex;align-items:center;justify-content:center;
  font-size:16px;
}
.contact-list li{display:flex;gap:10px;align-items:flex-start}
.contact-list .ci{color:var(--teal);margin-top:2px}
.copyright{
  text-align:center;font-size:12.5px;color:var(--muted);
  border-top:1px solid #e8edf4;padding:18px 24px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:1100px){
  .nav-links{gap:15px;font-size:12px}
  .btn-teal{font-size:12px;padding:9px 15px}
}
@media(max-width:1024px){
  .nav-links{display:none}
  .nav-links.mobile-open{
    display:flex;
    position:absolute;
    top:100%;
    left:0;
    right:0;
    background:#fff;
    padding:20px 24px;
    flex-direction:column;
    align-items:flex-start;
    gap:16px;
    box-shadow:0 10px 25px rgba(18,35,63,.08);
  }
  .nav-consult{display:none}
  .menu-toggle{display:block}
}
@media(max-width:900px){
  .nav-links{display:none}
  .menu-toggle{display:block}
  .hero-grid{grid-template-columns:1fr}
  .hero h1{font-size:40px}
  .hero-image-box{height:330px}
  .project-grid{grid-template-columns:1fr 1fr}
  .footer-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:620px){
  .hero{padding:42px 0 55px}
  .hero h1{font-size:34px}
  .hero p{font-size:14px}
  .hero-image-box{height:250px;padding:15px}
  .filter-bar{overflow-x:auto}
  .filters{min-width:max-content}
  .sort-btn{display:none}
  .project-grid{grid-template-columns:1fr}
  .project-card{min-height:440px}
  .footer-grid{grid-template-columns:1fr}
}
</style>
</head>

<body>

<!-- ===== NAVBAR — SAMA SEPERTI INDEX ===== -->
<nav class="navbar">
  <div class="nav-inner">

    <a href="{{ url('/') }}" class="brand">
      <img src="{{ asset('images/ikon.png') }}"
           alt="Eintio Logo"
           class="logo-img">
      <span>PT Eintio Academic &amp; Technology</span>
    </a>

    <div class="nav-links">
      <a href="{{ url('/') }}">Beranda</a>
      <a href="{{ url('/profil') }}">Profil</a>
      <a href="{{ url('/layanan') }}">Layanan</a>
      <a href="{{ url('/portofolio') }}" class="active">Portofolio</a>
      <a href="{{ url('/tim') }}">Tim</a>
      <a href="{{ url('/blog') }}">Blog</a>
      <a href="{{ url('/testimoni') }}">Testimoni</a>
      <a href="{{ url('/contact') }}">Contact</a>
    </div>

    <a class="btn-teal nav-consult"
       href="https://wa.me/628112225804"
       target="_blank"
       rel="noopener noreferrer">
      <span>Konsultasi WhatsApp</span>
      <i class="fa-solid fa-paper-plane"></i>
    </a>

    <button class="menu-toggle"
            type="button"
            aria-label="Buka menu"
            onclick="toggleMenu()">☰</button>

  </div>
</nav>


<!-- ===== HERO ===== -->
<header class="hero">
  <div class="container hero-grid">

    <div class="hero-left">

      <span class="hero-badge">
        ✦ Portofolio Kami
      </span>

      <h1>
        Karya dan <span class="accent">Solusi</span> yang<br>
        Telah Kami<br>
        Kembangkan
      </h1>

      <p>
        Jelajahi berbagai proyek inovatif yang telah kami selesaikan,
        menggabungkan keahlian akademik dengan teknologi terkini untuk
        memberikan hasil nyata bagi klien kami.
      </p>

    </div>

    <div class="hero-image-box">
      <img src="{{ asset('assets/x.png') }}"
           class="hero-image"
           alt="Portofolio PT Eintio">
    </div>

  </div>
</header>


<!-- ===== PORTFOLIO ===== -->
<main class="portfolio-area">
  <div class="container">

    <!-- FILTER -->
    <div class="filter-bar">

      <div class="filters">

        {{-- Semua --}}
        <button
            type="button"
            class="filter-btn active"
            data-filter="all">
          Semua
        </button>

        {{-- Kategori mengikuti kategori yang tersedia di Admin --}}
        @foreach($categories as $category)

          <button
              type="button"
              class="filter-btn"
              data-filter="{{ strtolower($category->name) }}">
            {{ $category->name }}
          </button>

        @endforeach

      </div>

      <button class="sort-btn" type="button">
        Terbaru⌄
      </button>

    </div>


    <!-- PROJECTS -->
    <div class="project-grid">

      @forelse($portfolios as $portfolio)

        @php

          /*
           * Kategori berasal dari category_id di Admin
           * kemudian mengambil nama kategori melalui relasi category.
           */
          $categoryName = $portfolio->category?->name ?? 'Tanpa Kategori';

          $categorySlug = strtolower($categoryName);


          /*
           * Warna tampilan tetap sama.
           * Hanya penentuan class yang mengikuti nama kategori dari Admin.
           */
          $categoryClass =
              str_contains($categorySlug, 'akademik')
                  ? 'cat-yellow'
                  : (
                      str_contains($categorySlug, 'sistem')
                          ? 'cat-teal'
                          : (
                              str_contains($categorySlug, 'desain')
                                  ? 'cat-purple'
                                  : 'cat-blue'
                            )
                    );


          $arrowClass =
              str_contains($categorySlug, 'akademik')
                  ? 'arrow-yellow'
                  : (
                      str_contains($categorySlug, 'sistem')
                          ? 'arrow-teal'
                          : (
                              str_contains($categorySlug, 'desain')
                                  ? 'arrow-purple'
                                  : 'arrow-blue'
                            )
                    );

        @endphp


        <a href="{{ route('portfolios.show', ['portfolio' => $portfolio->slug]) }}"
           class="project-card"
           data-category="{{ $categorySlug }}">

          {{-- Gambar dari Admin Portfolio --}}
          <img
              class="project-image"
              src="{{ $portfolio->image
                  ? asset('storage/' . $portfolio->image)
                  : asset('images/portofolio/hero.jpg') }}"
              alt="{{ $portfolio->title }}"
          >


          <div class="project-body">

            <div class="project-meta">

              {{-- Kategori dari Admin --}}
              <span class="category {{ $categoryClass }}">
                {{ $categoryName }}
              </span>


              {{-- Tahun dari project_date Admin --}}
              <span class="project-year">
                @if($portfolio->project_date)
                  {{ \Carbon\Carbon::parse($portfolio->project_date)->format('Y') }}
                @else
                  -
                @endif
              </span>

            </div>


            {{-- Judul dari Admin --}}
            <h3>
              {{ $portfolio->title }}
            </h3>


            {{-- Client dari field "client" Admin --}}
            <div class="client">
              {{ $portfolio->client ?? '-' }}
            </div>


            {{-- Description dari Admin --}}
            <p class="project-desc">
              {{ $portfolio->description }}
            </p>

          </div>


          {{-- Tombol detail --}}
          <span class="project-arrow {{ $arrowClass }}">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
          </span>

        </a>

      @empty

        <div style="
            grid-column:1/-1;
            background:#fff;
            padding:40px;
            border-radius:19px;
            text-align:center;
            color:#687386;
        ">
          Belum ada portofolio yang dipublikasikan.
        </div>

      @endforelse

    </div>

  </div>
</main>


<!-- ===== FOOTER — SAMA SEPERTI INDEX ===== -->
<footer>

  <div class="container footer-grid">

    <div>

      <div class="footer-brand">
        <img src="{{ asset('images/ikon.png') }}"
             alt="Eintio Logo"
             class="logo-img">

        <span>PT Eintio Academic &amp; Technology</span>
      </div>

      <p>
        Menyediakan solusi digital terintegrasi dan pendampingan akademik
        profesional untuk masa depan bisnis dan pendidikan Indonesia yang lebih cerah.
      </p>

      <div class="socials">

        <a href="#" aria-label="Share">
          <i class="fa-solid fa-share-nodes"></i>
        </a>

        <a href="#" aria-label="Contact">
          <i class="fa-solid fa-at"></i>
        </a>

        <a href="#" aria-label="Website">
          <i class="fa-solid fa-globe"></i>
        </a>

      </div>

    </div>


    <div>

      <h5>Navigasi</h5>

      <ul>
        <li>
          <a href="{{ url('/') }}">Beranda</a>
        </li>

        <li>
          <a href="{{ url('/layanan') }}">Layanan</a>
        </li>

        <li>
          <a href="{{ url('/tim') }}">Tim</a>
        </li>

        <li>
          <a href="{{ url('/blog') }}">Blog</a>
        </li>
      </ul>

    </div>


    <div>

      <h5>Layanan</h5>

      <ul>
        <li>
          <a href="{{ url('/layanan') }}">Web Development</a>
        </li>

        <li>
          <a href="{{ url('/layanan') }}">Mobile Apps</a>
        </li>

        <li>
          <a href="{{ url('/layanan') }}">Analisis Data Riset</a>
        </li>

        <li>
          <a href="{{ url('/layanan') }}">Bimbingan Akademik</a>
        </li>
      </ul>

    </div>


    <div>

      <h5>Kontak</h5>

      <ul class="contact-list">

        <li>
          <i class="fa-solid fa-location-dot ci"></i>
          <span>
            Jln. Menjangan No. 25A, Salatiga, Jawa Tengah
          </span>
        </li>

        <li>
          <i class="fa-solid fa-phone ci"></i>
          <a href="tel:+628112225804">
            (+62) 8112225804
          </a>
        </li>

        <li>
          <i class="fa-solid fa-envelope ci"></i>
          <a href="mailto:info@eintio.co.id">
            info@eintio.co.id
          </a>
        </li>

      </ul>

    </div>

  </div>


  <div class="copyright">
    © 2024 PT Eintio Academic &amp; Technology. All rights reserved.
  </div>

</footer>


<script>
document.addEventListener('DOMContentLoaded', function () {

  const buttons = document.querySelectorAll('.filter-btn');
  const cards = document.querySelectorAll('.project-card');


  buttons.forEach(function (button) {

    button.addEventListener('click', function () {

      buttons.forEach(function (item) {
        item.classList.remove('active');
      });

      button.classList.add('active');


      const filter = button.dataset.filter || 'all';


      cards.forEach(function (card) {

        const category =
          (card.dataset.category || '').toLowerCase();


        if (
          filter === 'all' ||
          category.includes(filter)
        ) {

          card.style.display = '';

        } else {

          card.style.display = 'none';

        }

      });

    });

  });

});


function toggleMenu(){

  document
    .querySelector('.nav-links')
    .classList
    .toggle('mobile-open');

}
</script>

</body>
</html>

