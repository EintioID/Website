<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">
<title>Profil — {{ $profile->company_name ?? 'PT Eintio Academic & Technology' }}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
:root{
  --teal:#14b8c4;
  --teal-dark:#0e9aa8;
  --navy:#12233f;
  --ink:#33415c;
  --muted:#5b6b85;
  --bg:#f7f9fc;
  --yellow:#ffd400;
  --radius:18px;
}

*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI',Arial,sans-serif;
}

html{scroll-behavior:smooth;}

body{
  background:var(--bg);
  color:var(--ink);
  line-height:1.6;
}

img{display:block;max-width:100%;}
a{text-decoration:none;color:inherit;}

.container{
  max-width:1200px;
  margin:0 auto;
  padding:0 24px;
}


.navbar{
  background:#fff;
  box-shadow:0 2px 12px rgba(18,35,63,.06);
  position:sticky;
  top:0;
  z-index:100;
}

.nav-inner{
  display:flex;
  align-items:center;
  gap:32px;
  padding:14px 24px;
  max-width:1300px;
  margin:0 auto;
}

.brand{
  display:flex;
  align-items:center;
  gap:10px;
  font-weight:800;
  font-size:17px;
  color:var(--navy);
  white-space:nowrap;
}

.logo-img{
  width:30px;
  height:30px;
  object-fit:contain;
  flex-shrink:0;
}

.nav-links{
  display:flex;
  align-items:center;
  gap:26px;
  margin-left:auto;
  font-size:14.5px;
  color:var(--ink);
}

.nav-links a{
  position:relative;
  white-space:nowrap;
  padding:8px 0 12px;
  transition:.2s;
}

.nav-links a:hover{color:var(--teal);}

.nav-links a.active{
  color:var(--teal);
  font-weight:700;
}

.nav-links a.active::after{
  content:"";
  position:absolute;
  left:0;
  right:0;
  bottom:0;
  height:2px;
  background:var(--teal);
  border-radius:10px;
}

.btn-teal{
  background:var(--teal);
  color:#fff;
  padding:10px 16px 10px 20px;
  border-radius:50px;
  font-weight:700;
  font-size:14px;
  border:none;
  cursor:pointer;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:9px;
  white-space:nowrap;
  transition:.2s;
}

.btn-teal:hover{background:var(--teal-dark);}
.btn-teal i{line-height:1;}

.menu-toggle{
  display:none;
  margin-left:auto;
  background:none;
  border:none;
  font-size:24px;
  cursor:pointer;
  color:var(--navy);
}

@media(max-width:1024px){
  .nav-links{display:none;}

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

  .nav-consult{display:none;}
  .menu-toggle{display:block;}
}


.hero{
  padding:54px 0 70px;
  background:#eef9fc;
}

.hero-grid{
  display:grid;
  grid-template-columns:1.02fr 1fr;
  gap:48px;
  align-items:center;
}

.hero h1{
  font-size:44px;
  line-height:1.18;
  color:var(--navy);
  font-weight:800;
  margin-bottom:20px;
}

.hero h1 .accent{color:var(--teal);}

.hero p{
  font-size:16px;
  color:var(--muted);
  max-width:480px;
  margin-bottom:30px;
}

.hero-visual{position:relative;}

.hero-img{
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 20px 50px rgba(18,35,63,.15);
}

.hero-img img{
  width:100%;
  height:390px;
  object-fit:cover;
}

.float-card{
  position:absolute;
  left:-22px;
  bottom:-28px;
  background:#fff;
  border-radius:17px;
  box-shadow:0 14px 40px rgba(18,35,63,.14);
  padding:15px 21px;
  display:flex;
  align-items:center;
  gap:11px;
}

.float-card .fc-icon{
  width:40px;
  height:40px;
  border-radius:50%;
  background:#e6f7f9;
  color:var(--teal-dark);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:17px;
}

.float-card strong{
  font-size:13.5px;
  color:var(--navy);
  display:block;
  line-height:1.35;
}

@media(max-width:900px){
  .hero-grid{grid-template-columns:1fr;}
  .hero h1{font-size:34px;}
  .hero-img img{height:320px;}
  .float-card{left:12px;bottom:-20px;}
}


.about{
  padding:64px 0;
  background:#fff;
}

.about-grid{
  display:grid;
  grid-template-columns:1fr 1.15fr;
  gap:56px;
  align-items:start;
}

.about-quote .q-icon{
  font-size:38px;
  line-height:1;
  color:#c8edf1;
  margin-bottom:14px;
}

.about-quote h2{
  font-size:29px;
  line-height:1.32;
  color:var(--navy);
  font-weight:800;
}

.about-text p{
  font-size:15px;
  color:var(--muted);
  margin-bottom:18px;
}

.about-text p:last-child{margin-bottom:0;}

@media(max-width:900px){
  .about-grid{grid-template-columns:1fr;}
}


.stats{
  padding:48px 0;
  background:#eef9fc;
}

.stats-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
}

.stat{
  text-align:center;
  padding:8px 16px;
  border-left:1px solid #e1edf1;
}

.stat:first-child{border-left:none;}

.stat .s-icon{
  width:34px;
  height:34px;
  margin:0 auto 10px;
  border-radius:50%;
  background:#fff;
  color:var(--teal);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:14px;
}

.stat h3{
  font-size:34px;
  line-height:1.1;
  color:var(--navy);
  font-weight:800;
}

.stat span{
  font-size:12.5px;
  color:var(--muted);
}

@media(max-width:800px){
  .stats-grid{
    grid-template-columns:1fr 1fr;
    gap:28px 0;
  }

  .stat:nth-child(3){border-left:none;}
}


.visimisi{
  background:linear-gradient(120deg,#0e9aa8,#14a5b2);
  padding:58px 0;
  color:#fff;
}

.vm-grid{
  display:grid;
  grid-template-columns:1fr 1.15fr;
  gap:56px;
  align-items:start;
}

.vm-head{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:18px;
}

.vm-head .vm-icon{
  width:42px;
  height:42px;
  border-radius:50%;
  background:rgba(255,212,0,.22);
  color:var(--yellow);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:17px;
}

.vm-head h2{
  font-size:28px;
  font-weight:800;
}

.vm-underline{
  width:58px;
  height:4px;
  background:var(--yellow);
  border-radius:4px;
  margin-bottom:20px;
}

.visimisi p.lead{
  font-size:14px;
  line-height:1.7;
  color:rgba(255,255,255,.92);
}

.visi-img{
  border-radius:18px;
  overflow:hidden;
  margin-top:25px;
  box-shadow:0 16px 40px rgba(0,0,0,.2);
}

.visi-img img{
  width:100%;
  height:260px;
  object-fit:cover;
}

.misi-list{
  display:flex;
  flex-direction:column;
  gap:10px;
  margin-top:4px;
}

.misi-item{
  display:grid;
  grid-template-columns:54px 38px 1fr;
  align-items:center;
  gap:10px;
  background:rgba(255,255,255,.10);
  border:1px solid rgba(255,255,255,.15);
  border-radius:17px;
  padding:15px 17px;
  transition:.2s;
}

.misi-item:hover{background:rgba(255,255,255,.17);}

.misi-num{
  font-size:24px;
  font-weight:800;
  color:#fff;
}

.misi-ico{
  width:30px;
  height:30px;
  border-radius:50%;
  background:rgba(255,255,255,.07);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:12px;
  color:#fff;
}

.misi-item p{
  font-size:12.5px;
  color:rgba(255,255,255,.95);
  line-height:1.5;
}

@media(max-width:900px){
  .vm-grid{grid-template-columns:1fr;}
}


.nilai{
  padding:58px 0 66px;
  background:#fff;
}

.nilai h2{
  text-align:center;
  font-size:29px;
  color:var(--teal);
  font-weight:800;
  margin-bottom:42px;
}

.nilai-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  gap:22px;
}

.nilai-card{
  background:#f1fafb;
  border:1px solid #dcecef;
  border-radius:18px;
  box-shadow:0 5px 20px rgba(18,35,63,.035);
  padding:28px 25px 20px;
  display:flex;
  flex-direction:column;
  min-height:235px;
  transition:transform .25s;
}

.nilai-card:hover{transform:translateY(-5px);}

.nilai-card .n-icon{
  width:38px;
  height:38px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:15px;
  margin-bottom:18px;
}

.ni-purple{background:#e9e1fa;color:#9b5bd6;}
.ni-blue{background:#dcecff;color:#4a83e8;}
.ni-yellow{background:#fff4c9;color:#e4ad00;}
.ni-pink{background:#f8e4f2;color:#ae58c8;}

.nilai-card h3{
  font-size:16px;
  color:var(--navy);
  margin-bottom:10px;
}

.nilai-card p{
  font-size:12.5px;
  line-height:1.5;
  color:var(--muted);
  flex:1;
}

.nilai-arrow{
  align-self:flex-end;
  margin-top:18px;
  width:30px;
  height:30px;
  border-radius:50%;
  border:1px solid #cbdde3;
  color:var(--teal);
  background:#fff;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:12px;
  transition:.2s;
}

.nilai-card:hover .nilai-arrow{
  background:var(--teal);
  color:#fff;
  border-color:var(--teal);
}

@media(max-width:1000px){
  .nilai-grid{grid-template-columns:1fr 1fr;}
}

@media(max-width:560px){
  .nilai-grid{grid-template-columns:1fr;}
}


footer{
  background:#fff;
  border-top:1px solid #e8edf4;
  padding:56px 0 0;
}

.footer-grid{
  display:grid;
  grid-template-columns:1.6fr 1fr 1fr 1.2fr;
  gap:40px;
  padding-bottom:44px;
}

.footer-brand{
  display:flex;
  align-items:center;
  gap:10px;
  font-weight:800;
  color:var(--navy);
  font-size:16px;
  margin-bottom:16px;
}

.footer-brand .logo-img{
  width:30px;
  height:30px;
}

.footer-grid p{
  font-size:13.5px;
  color:var(--muted);
}

.socials{
  display:flex;
  gap:12px;
  margin-top:20px;
}

.socials a{
  width:38px;
  height:38px;
  border-radius:10px;
  background:#eef2f8;
  color:var(--teal-dark);
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:16px;
  transition:.2s;
}

.socials a:hover{
  background:var(--teal);
  color:#fff;
}

.footer-grid h5{
  font-size:15px;
  color:var(--navy);
  margin-bottom:16px;
}

.footer-grid ul{list-style:none;}

.footer-grid ul li{
  padding:5px 0;
  font-size:13.5px;
  color:var(--muted);
}

.footer-grid ul li a:hover{color:var(--teal);}

.contact-list li{
  display:flex;
  gap:12px;
  align-items:flex-start;
}

.contact-list .ci{
  color:var(--teal);
  font-size:14px;
  width:16px;
  min-width:16px;
  margin-top:5px;
  text-align:center;
}

.contact-list li a{color:var(--muted);}
.contact-list li a:hover{color:var(--teal);}

.copyright{
  text-align:center;
  font-size:12.5px;
  color:var(--muted);
  border-top:1px solid #e8edf4;
  padding:18px 24px;
}

@media(max-width:900px){
  .footer-grid{grid-template-columns:1fr 1fr;}
}

@media(max-width:560px){
  .footer-grid{grid-template-columns:1fr;}
}
</style>
</head>

<body>


<nav class="navbar">
  <div class="nav-inner">

    <a href="{{ url('/') }}" class="brand">
      @if($profile && $profile->logo)
        <img src="{{ asset('storage/' . $profile->logo) }}" alt="Eintio Logo" class="logo-img">
      @else
        <img src="{{ asset('images/ikon.png') }}" alt="Eintio Logo" class="logo-img">
      @endif
      <span>{{ $profile->company_name ?? 'PT Eintio Academic & Technology' }}</span>
    </a>

    <div class="nav-links">
      <a href="{{ url('/') }}">Beranda</a>
      <a href="{{ url('/profil') }}" class="active">Profil</a>
      <a href="{{ url('/layanan') }}">Layanan</a>
      <a href="{{ url('/portofolio') }}">Portofolio</a>
      <a href="{{ url('/tim') }}">Tim</a>
      <a href="{{ url('/blog') }}">Blog</a>
      <a href="{{ url('/testimoni') }}">Testimoni</a>
      <a href="{{ url('/contact') }}">Contact</a>
    </div>

    <a class="btn-teal nav-consult"
       href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profile->phone ?? '628112225804') }}"
       target="_blank"
       rel="noopener noreferrer">
      <span>Konsultasi WhatsApp</span>
      <i class="fa-solid fa-paper-plane"></i>
    </a>

    <button class="menu-toggle"
            type="button"
            aria-label="Buka menu"
            onclick="toggleMenu()">
      <i class="fa-solid fa-bars"></i>
    </button>

  </div>
</nav>


<header class="hero">
  <div class="container hero-grid">

    <div>
      <h1>
        Mengenal<br>
        <span class="accent">{{ $profile->company_name ?? 'PT Eintio Academic & Technology' }}</span>
      </h1>

      <p>
        {{ $profile->hero_subtitle ?? 'Kami adalah mitra strategis Anda dalam mewujudkan inovasi digital dan keunggulan akademik. Menjembatani kompleksitas teknologi dengan solusi praktis untuk masa depan yang lebih cerdas.' }}
      </p>

      <a class="btn-teal"
         href="{{ $profile?->cta_1_url ?? url('/contact') }}">
        {{ $profile?->cta_1_label ?? 'Mari Berkenalan' }}
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>

    <div class="hero-visual">
      <div class="hero-img">
        @if($profile && $profile->hero_image)
          <img src="{{ asset('storage/' . $profile->hero_image) }}" alt="Profil {{ $profile->company_name ?? 'Eintio' }}">
        @else
          <img src="{{ asset('assets/Dashboard.png') }}" alt="Dashboard performa bisnis">
        @endif
      </div>

      <div class="float-card">
        <div class="fc-icon">
          <i class="fa-solid fa-rocket"></i>
        </div>
        <strong>Solusi Cerdas<br>untuk Masa Depan</strong>
      </div>
    </div>

  </div>
</header>


<section class="about">
  <div class="container about-grid">

    <div class="about-quote">
      <div class="q-icon">
        <i class="fa-solid fa-quote-left"></i>
      </div>

      <h2>
        {{ $profile->tagline ?: 'Kami percaya teknologi bukan hanya tentang sistem, tetapi tentang memberdayakan manusia untuk mencapai keunggulan.' }}
      </h2>
    </div>

    <div class="about-text">
      @if($profile && $profile->description)
        <p>{!! nl2br(e($profile->description)) !!}</p>
      @else
        <p>
          PT Eintio Academic &amp; Technology hadir sebagai jembatan antara kebutuhan industri modern dan ketelitian akademis. Kami mengintegrasikan solusi perangkat lunak mutakhir dengan riset mendalam untuk menciptakan produk yang tidak hanya berfungsi, tetapi berdampak.
        </p>

        <p>
          Fokus kami terletak pada sinergi inovasi digital—baik dalam pengembangan platform skala besar, analisis data tingkat lanjut, maupun solusi kreatif yang mendorong transformasi bisnis dan institusi pendidikan.
        </p>
      @endif
    </div>

  </div>
</section>


<section class="stats">
  <div class="container stats-grid">

    <div class="stat">
      <div class="s-icon">
        <i class="fa-solid fa-circle-check"></i>
      </div>
      <h3>50+</h3>
      <span>Projects Delivered</span>
    </div>

    <div class="stat">
      <div class="s-icon">
        <i class="fa-solid fa-handshake"></i>
      </div>
      <h3>30+</h3>
      <span>Active Partners</span>
    </div>

    <div class="stat">
      <div class="s-icon">
        <i class="fa-solid fa-clock-rotate-left"></i>
      </div>
      <h3>8+</h3>
      <span>Years Experience</span>
    </div>

    <div class="stat">
      <div class="s-icon">
        <i class="fa-solid fa-users"></i>
      </div>
      <h3>20+</h3>
      <span>Expert Team</span>
    </div>

  </div>
</section>


@php
  $defaultVision = 'Menjadi pionir dalam menyediakan solusi teknologi inovatif dan layanan akademik terdepan yang memberdayakan institusi, bisnis, dan individu untuk mencapai potensi maksimal di era digital.';

  $defaultMission = [
    'Menyediakan solusi perangkat lunak yang inovatif, efisien, dan dapat disesuaikan untuk berbagai sektor industri.',
    'Mendukung institusi pendidikan dan peneliti dengan layanan analisis data dan pendampingan akademik berkualitas tinggi.',
    'Membangun ekosistem kolaboratif yang menjembatani kesenjangan antara teori akademik dan praktik teknologi praktis.'
  ];

  $missions = ($profile && !empty($profile->mission))
      ? $profile->mission
      : $defaultMission;
@endphp

<section class="visimisi">
  <div class="container vm-grid">

    <div>
      <div class="vm-head">
        <div class="vm-icon">
          <i class="fa-solid fa-eye"></i>
        </div>
        <h2>Visi Kami</h2>
      </div>

      <div class="vm-underline"></div>

      <p class="lead">
        {{ $profile->vision ?: $defaultVision }}
      </p>

      <div class="visi-img">
        <img src="{{ asset('assets/Vision Graphic.png') }}"
             alt="Workspace analisis data">
      </div>
    </div>

    <div>
      <div class="vm-head">
        <div class="vm-icon">
          <i class="fa-solid fa-flag"></i>
        </div>
        <h2>Misi Kami</h2>
      </div>

      <div class="misi-list">
        @foreach($missions as $i => $misi)
          <div class="misi-item">
            <span class="misi-num">
              {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
            </span>

            <span class="misi-ico">
              @if($i === 0)
                <i class="fa-solid fa-code"></i>
              @elseif($i === 1)
                <i class="fa-solid fa-graduation-cap"></i>
              @else
                <i class="fa-solid fa-share-nodes"></i>
              @endif
            </span>

            <p>{{ $misi }}</p>
          </div>
        @endforeach
      </div>
    </div>

  </div>
</section>

<!-- =======================================================
     NILAI INTI
======================================================= -->
@php
  $defaultValues = [
    [
      'icon' => 'fa-solid fa-puzzle-piece',
      'bg' => 'ni-purple',
      'title' => 'Customized',
      'desc' => 'Solusi yang dirancang khusus menyesuaikan kebutuhan unik setiap klien untuk hasil yang optimal.'
    ],
    [
      'icon' => 'fa-solid fa-handshake',
      'bg' => 'ni-blue',
      'title' => 'Collaborative',
      'desc' => 'Bekerja bersama sebagai mitra strategis dengan komunikasi yang transparan dan proaktif.'
    ],
    [
      'icon' => 'fa-solid fa-microchip',
      'bg' => 'ni-yellow',
      'title' => 'Technology',
      'desc' => 'Mengadopsi teknologi mutakhir untuk memastikan solusi yang tangguh dan skalabel.'
    ],
    [
      'icon' => 'fa-solid fa-leaf',
      'bg' => 'ni-pink',
      'title' => 'Sustainable',
      'desc' => 'Menciptakan dampak positif jangka panjang bagi bisnis dan lingkungan akademik.'
    ]
  ];

  $palette = ['ni-purple', 'ni-blue', 'ni-yellow', 'ni-pink'];
@endphp

<section class="nilai">
  <div class="container">

    <h2>Nilai Inti Kami</h2>

    <div class="nilai-grid">

      @if($coreValues && count($coreValues))

        @foreach($coreValues as $value)
          <div class="nilai-card">

            <div class="n-icon {{ $palette[$loop->index % count($palette)] }}">
              <i class="{{ $value->icon }}"></i>
            </div>

            <h3>{{ $value->title }}</h3>

            <p>{{ $value->description }}</p>

            <div class="nilai-arrow">
              <i class="fa-solid fa-arrow-right"></i>
            </div>

          </div>
        @endforeach

      @else

        @foreach($defaultValues as $value)
          <div class="nilai-card">

            <div class="n-icon {{ $value['bg'] }}">
              <i class="{{ $value['icon'] }}"></i>
            </div>

            <h3>{{ $value['title'] }}</h3>

            <p>{{ $value['desc'] }}</p>

            <div class="nilai-arrow">
              <i class="fa-solid fa-arrow-right"></i>
            </div>

          </div>
        @endforeach

      @endif

    </div>
  </div>
</section>

<!-- =======================================================
     FOOTER — DIPERTAHANKAN SEPERTI INDEX
======================================================= -->
<footer>
  <div class="container footer-grid">

    <div>
      <div class="footer-brand">
        @if($profile && $profile->logo)
          <img src="{{ asset('storage/' . $profile->logo) }}"
               alt="Eintio Logo"
               class="logo-img">
        @else
          <img src="{{ asset('images/ikon.png') }}"
               alt="Eintio Logo"
               class="logo-img">
        @endif

        <span>{{ $profile->company_name ?? 'PT Eintio Academic & Technology' }}</span>
      </div>

      <p>
        {{ $profile->tagline ?: 'Menyediakan solusi digital terintegrasi dan pendampingan akademik profesional untuk masa depan bisnis dan pendidikan Indonesia yang lebih cerah.' }}
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
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li><a href="{{ url('/layanan') }}">Layanan</a></li>
        <li><a href="{{ url('/tim') }}">Tim</a></li>
        <li><a href="{{ url('/blog') }}">Blog</a></li>
      </ul>
    </div>

    <div>
      <h5>Layanan</h5>
      <ul>
        <li><a href="{{ url('/layanan') }}">Web Development</a></li>
        <li><a href="{{ url('/layanan') }}">Mobile Apps</a></li>
        <li><a href="{{ url('/layanan') }}">Analisis Data Riset</a></li>
        <li><a href="{{ url('/layanan') }}">Bimbingan Akademik</a></li>
      </ul>
    </div>

    <div>
      <h5>Kontak</h5>

      <ul class="contact-list">

        <li>
          <i class="fa-solid fa-location-dot ci"></i>
          <span>{{ $profile->address ?? 'Jln. Menjangan No. 25A, Salatiga, Jawa Tengah' }}</span>
        </li>

        <li>
          <i class="fa-solid fa-phone ci"></i>
          <a href="tel:{{ preg_replace('/[^0-9+]/', '', $profile->phone ?? '+628112225804') }}">
            {{ $profile->phone ?? '(+62) 8112225804' }}
          </a>
        </li>

        <li>
          <i class="fa-solid fa-envelope ci"></i>
          <a href="mailto:{{ $profile->email ?? 'info@eintio.co.id' }}">
            {{ $profile->email ?? 'info@eintio.co.id' }}
          </a>
        </li>

      </ul>
    </div>

  </div>

  <div class="copyright">
    © {{ date('Y') }} {{ $profile->company_name ?? 'PT Eintio Academic & Technology' }}. All rights reserved.
  </div>
</footer>

<script>
function toggleMenu(){
  document.querySelector('.nav-links').classList.toggle('mobile-open');
}
</script>

</body>
</html>
