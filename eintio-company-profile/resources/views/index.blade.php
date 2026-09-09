<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">
<title>PT Eintio Academic &amp; Technology — Solusi Cerdas untuk Bisnis dan Pendidikan</title>
<style>

:root{
    --teal:#14b8c4;
    --teal-dark:#0e9aa8;
    --navy:#12233f;
    --ink:#33415c;
    --muted:#5b6b85;
    --bg:#f7f9fc;
    --yellow:#ffd400;
    --radius:18px
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Arial,sans-serif
}

html{
    scroll-behavior:smooth
}

body{
    background:var(--bg);
    color:var(--ink);
    line-height:1.6
}

img{
    display:block;
    max-width:100%
}

a{
    text-decoration:none;
    color:inherit
}

.container{
    max-width:1200px;
    margin:0 auto;
    padding:0 24px
}

/* NAVBAR */
.navbar{
    background:#fff;
    box-shadow:0 2px 12px rgba(18,35,63,.06);
    position:sticky;
    top:0;
    z-index:100
}

.nav-inner{
    display:flex;
    align-items:center;
    gap:32px;
    padding:14px 24px;
    max-width:1300px;
    margin:0 auto
}

.brand{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:800;
    font-size:17px;
    color:var(--navy);
    white-space:nowrap
}

.logo-img{
    width:30px;
    height:30px;
    object-fit:contain;
    flex-shrink:0
}

.nav-links{
    display:flex;
    align-items:center;
    gap:26px;
    margin-left:auto;
    font-size:14.5px;
    color:var(--ink)
}

.nav-links a{
    position:relative;
    white-space:nowrap;
    padding:8px 0 12px;
    transition:.2s
}

.nav-links a:hover{
    color:var(--teal)
}

.nav-links a.active{
    color:var(--teal);
    font-weight:700
}

.nav-links a.active::after{
    content:"";
    position:absolute;
    left:0;
    right:0;
    bottom:0;
    height:2px;
    background:var(--teal);
    border-radius:10px
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
    transition:.2s
}

.btn-teal:hover{
    background:var(--teal-dark)
}

.btn-teal .fa-paper-plane{
    font-size:13px
}

.btn-teal i{
    line-height:1
}

.btn-outline{
    background:#fff;
    color:var(--navy);
    border:2px solid #d7dee9;
    padding:10px 24px;
    border-radius:50px;
    font-weight:600;
    font-size:14px;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:.2s
}

.btn-outline:hover{
    border-color:var(--teal);
    color:var(--teal)
}

.menu-toggle{
    display:none;
    margin-left:auto;
    background:none;
    border:none;
    font-size:24px;
    cursor:pointer;
    color:var(--navy)
}

@media(max-width:1024px){
    .nav-links{
        display:none
    }

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
        box-shadow:0 10px 25px rgba(18,35,63,.08)
    }

    .nav-consult{
        display:none
    }

    .menu-toggle{
        display:block
    }

}

/* HERO */
.hero{
    padding:64px 0 72px
}

.hero-grid{
    display:grid;
    grid-template-columns:1.05fr 1fr;
    gap:48px;
    align-items:center
}

.badge{
    display:inline-block;
    background:#e6f7f9;
    color:var(--teal-dark);
    border:1px solid #bdeef2;
    padding:6px 18px;
    border-radius:50px;
    font-size:12px;
    font-weight:700;
    letter-spacing:1.2px;
    text-transform:uppercase;
    margin-bottom:22px
}

.hero h1{
    font-size:46px;
    line-height:1.18;
    color:var(--navy);
    font-weight:800;
    margin-bottom:20px
}

.hero h1 .accent{
    color:var(--teal)
}

.hero p{
    font-size:16.5px;
    color:var(--muted);
    max-width:480px;
    margin-bottom:32px
}

.hero-btns{
    display:flex;
    gap:14px;
    flex-wrap:wrap
}

.hero-img{
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(18,35,63,.15)
}

.hero-img img{
    width:100%;
    height:100%;
    object-fit:cover
}

@media(max-width:900px){
    .hero-grid{
        grid-template-columns:1fr
    }

    .hero h1{
        font-size:34px
    }

}

/* TRUST */
.trust{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 30px rgba(18,35,63,.06);
    padding:34px 40px;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:24px
}

.trust-item{
    display:flex;
    gap:16px;
    align-items:flex-start
}

.trust-icon{
    flex:0 0 46px;
    width:46px;
    height:46px;
    border-radius:50%;
    background:#e6f7f9;
    color:var(--teal-dark);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px
}

.trust-item h4{
    font-size:15.5px;
    color:var(--navy)
}

.trust-item p{
    font-size:13px;
    color:var(--muted)
}

@media(max-width:800px){
    .trust{
        grid-template-columns:1fr
    }

}

section{
    padding:72px 0
}

.badge-green{
    background:#e8f8ef;
    color:#2f9e6b;
    border-color:#c4ecd4
}

.badge-blue{
    background:#e9f1fd;
    color:#3b6fd4;
    border-color:#cbdcf7
}


.sektor-grid{
    display:grid;
    grid-template-columns:300px 1fr;
    gap:48px;
    align-items:center
}

.sektor-grid h2,.layanan-grid h2{
    font-size:34px;
    color:var(--navy);
    font-weight:800;
    line-height:1.25;
    margin-bottom:16px
}

.sektor-grid h2 .accent,.layanan-grid h2 .accent{
    color:var(--teal)
}

.sektor-grid p,.layanan-grid>div>p{
    color:var(--muted);
    font-size:15px
}

.sektor-cards{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px
}

.sektor-card{
    position:relative;
    border-radius:var(--radius);
    overflow:hidden;
    height:380px;
    cursor:pointer
}

.sektor-card img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:transform .4s
}

.sektor-card:hover img{
    transform:scale(1.06)
}

.sektor-overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(to top,rgba(10,25,50,.85) 0%,rgba(10,25,50,.15) 55%,rgba(10,25,50,.25) 100%);
    display:flex;
    flex-direction:column;
    justify-content:flex-end;
    padding:24px
}

.sektor-num{
    position:absolute;
    top:16px;
    left:20px;
    color:rgba(255,255,255,.55);
    font-size:26px;
    font-weight:800
}

.sektor-overlay h3{
    color:#fff;
    font-size:18px;
    margin-bottom:6px
}

.sektor-overlay p{
    color:rgba(255,255,255,.85);
    font-size:12.5px;
    line-height:1.5;
    margin-bottom:14px
}

.arrow-btn{
    width:40px;
    height:40px;
    border-radius:50%;
    background:var(--teal);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    transition:.2s
}

.sektor-card:hover .arrow-btn{
    background:var(--yellow);
    color:var(--navy)
}

@media(max-width:1000px){
    .sektor-grid{
        grid-template-columns:1fr
    }

    .sektor-cards{
        grid-template-columns:1fr 1fr
    }

}

@media(max-width:640px){
    .sektor-cards{
        grid-template-columns:1fr
    }

    .sektor-card{
        height:300px
    }

}


.layanan-grid{
    display:grid;
    grid-template-columns:340px 1fr 1fr;
    gap:40px;
    align-items:start
}

.check-list{
    list-style:none;
    margin-top:22px
}

.check-list li{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:14.5px;
    color:var(--ink);
    padding:7px 0
}

.check{
    flex:0 0 20px;
    width:20px;
    height:20px;
    border-radius:50%;
    border:2px solid var(--teal);
    color:var(--teal);
    font-size:11px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700
}

.layanan-card{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 30px rgba(18,35,63,.06);
    padding:34px 30px
}

.layanan-card .lc-icon{
    width:52px;
    height:52px;
    border-radius:14px;
    background:#e6f7f9;
    color:var(--teal-dark);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    margin-bottom:20px
}

.layanan-card h3{
    font-size:20px;
    color:var(--navy);
    margin-bottom:12px
}

.layanan-card p{
    font-size:14px;
    color:var(--muted);
    margin-bottom:20px
}

.link-arrow{
    color:var(--teal);
    font-weight:700;
    font-size:14px;
    display:inline-flex;
    align-items:center;
    gap:7px
}

.link-arrow i{
    font-size:12px
}

.link-arrow:hover{
    gap:10px
}

@media(max-width:1000px){
    .layanan-grid{
        grid-template-columns:1fr
    }

}


.porto-head{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    margin-bottom:36px;
    flex-wrap:wrap;
    gap:12px
}

.porto-head h2{
    font-size:32px;
    color:var(--teal);
    font-weight:800
}

.porto-head p{
    color:var(--muted);
    font-size:15px;
    margin-top:6px
}

.porto-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:22px
}

.porto-card{
    background:#fff;
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:0 8px 30px rgba(18,35,63,.06);
    cursor:pointer;
    transition:transform .25s
}

.porto-card:hover{
    transform:translateY(-6px)
}

.porto-card img{
    width:100%;
    height:210px;
    object-fit:cover
}

.porto-body{
    padding:20px 22px
}

.porto-body h4{
    font-size:16px;
    color:var(--navy)
}

.porto-body p{
    font-size:13px;
    color:var(--muted);
    margin-top:4px
}

@media(max-width:900px){
    .porto-grid{
        grid-template-columns:1fr
    }

}


.kenapa h2{
    text-align:center;
    font-size:32px;
    color:var(--teal);
    font-weight:800;
    margin-bottom:44px
}

.kenapa-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px
}

.kenapa-card{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 30px rgba(18,35,63,.06);
    padding:30px 26px
}

.kenapa-card .k-icon{
    width:48px;
    height:48px;
    border-radius:12px;
    background:#e6f7f9;
    color:var(--teal-dark);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
    margin-bottom:18px
}

.kenapa-card h4{
    font-size:16.5px;
    color:var(--navy);
    margin-bottom:10px
}

.kenapa-card p{
    font-size:13.5px;
    color:var(--muted)
}

@media(max-width:1000px){
    .kenapa-grid{
        grid-template-columns:1fr 1fr
    }

}

@media(max-width:560px){
    .kenapa-grid{
        grid-template-columns:1fr
    }

}


.testimoni h2{
    text-align:center;
    font-size:32px;
    color:var(--teal);
    font-weight:800;
    margin-bottom:48px
}

.testi-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:22px
}

.testi-card{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 30px rgba(18,35,63,.06);
    padding:30px 28px;
    display:flex;
    flex-direction:column
}

.stars{
    color:var(--yellow);
    font-size:16px;
    letter-spacing:3px;
    margin-bottom:16px
}

.testi-card blockquote{
    font-size:14px;
    color:var(--ink);
    font-style:italic;
    flex:1
}

.testi-person{
    display:flex;
    align-items:center;
    gap:12px;
    margin-top:24px
}

.avatar{
    flex:0 0 44px;
    width:44px;
    height:44px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:800;
    font-size:15px;
    color:#fff
}

.av-teal{
    background:var(--teal)
}

.av-blue{
    background:#3b6fd4
}

.av-navy{
    background:var(--navy)
}

.testi-person h5{
    font-size:14.5px;
    color:var(--navy)
}

.testi-person span{
    font-size:12.5px;
    color:var(--muted)
}

@media(max-width:900px){
    .testi-grid{
        grid-template-columns:1fr
    }

}


.cta-wrap{
    padding:20px 0 72px
}

.cta{
    background:linear-gradient(120deg,#0e9aa8,#14b8c4);
    border-radius:28px;
    padding:56px 60px;
    display:grid;
    grid-template-columns:1.2fr 1fr;
    gap:48px;
    align-items:center;
    overflow:hidden
}

.cta h2{
    color:#fff;
    font-size:36px;
    font-weight:800;
    line-height:1.25;
    margin-bottom:18px
}

.cta p{
    color:rgba(255,255,255,.9);
    font-size:15.5px;
    margin-bottom:30px;
    max-width:480px
}

.btn-yellow{
    background:var(--yellow);
    color:var(--navy);
    padding:14px 30px;
    border-radius:50px;
    font-weight:800;
    font-size:15px;
    border:none;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:10px;
    box-shadow:0 8px 24px rgba(0,0,0,.18);
    transition:.2s
}

.btn-yellow:hover{
    transform:translateY(-2px)
}

.btn-yellow i{
    font-size:14px
}

.cta-img{
    border-radius:18px;
    overflow:hidden;
    height:260px;
    box-shadow:0 16px 40px rgba(0,0,0,.25)
}

.cta-img img{
    width:100%;
    height:100%;
    object-fit:cover
}

@media(max-width:900px){
    .cta{
        grid-template-columns:1fr;
        padding:40px 32px
    }

    .cta h2{
        font-size:28px
    }

    .cta-img{
        height:200px
    }

}


footer{
    background:#fff;
    border-top:1px solid #e8edf4;
    padding:56px 0 0
}

.footer-grid{
    display:grid;
    grid-template-columns:1.6fr 1fr 1fr 1.2fr;
    gap:40px;
    padding-bottom:44px
}

.footer-brand{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:800;
    color:var(--navy);
    font-size:16px;
    margin-bottom:16px
}

.footer-brand .logo-img{
    width:30px;
    height:30px
}

.footer-grid p{
    font-size:13.5px;
    color:var(--muted)
}

.socials{
    display:flex;
    gap:12px;
    margin-top:20px
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
    transition:.2s
}

.socials a:hover{
    background:var(--teal);
    color:#fff
}

.footer-grid h5{
    font-size:15px;
    color:var(--navy);
    margin-bottom:16px
}

.footer-grid ul{
    list-style:none
}

.footer-grid ul li{
    padding:5px 0;
    font-size:13.5px;
    color:var(--muted)
}

.footer-grid ul li a:hover{
    color:var(--teal)
}

.contact-list li{
    display:flex;
    gap:12px;
    align-items:flex-start
}

.contact-list .ci{
    color:var(--teal);
    font-size:14px;
    width:16px;
    min-width:16px;
    margin-top:5px;
    text-align:center
}

.contact-list li a{
    color:var(--muted)
}

.contact-list li a:hover{
    color:var(--teal)
}

.copyright{
    text-align:center;
    font-size:12.5px;
    color:var(--muted);
    border-top:1px solid #e8edf4;
    padding:18px 24px
}

@media(max-width:900px){
    .footer-grid{
        grid-template-columns:1fr 1fr
    }

}

@media(max-width:560px){
    .footer-grid{
        grid-template-columns:1fr
    }

}

</style>

</head>
<body>

<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ url('/') }}" class="brand">
      <img src="{{ asset('images/ikon.png') }}" alt="Eintio Logo" class="logo-img">
      <span>PT Eintio Academic &amp; Technology</span>
    </a>
    <div class="nav-links">
      <a href="{{ url('/') }}" class="active">Beranda</a>
      <a href="{{ url('/profil') }}">Profil</a>
      <a href="{{ url('/layanan') }}">Layanan</a>
      <a href="{{ url('/portofolio') }}">Portofolio</a>
      <a href="{{ url('/tim') }}">Tim</a>
      <a href="{{ url('/blog') }}">Blog</a>
      <a href="{{ url('/testimoni') }}">Testimoni</a>
      <a href="{{ url('/contact') }}">Contact</a>
    </div>
    <a class="btn-teal nav-consult" href="https://wa.me/628112225804" target="_blank" rel="noopener noreferrer">
      <span>Konsultasi WhatsApp</span><i class="fa-solid fa-paper-plane"></i>
    </a>
    <button class="menu-toggle" type="button" aria-label="Buka menu" onclick="toggleMenu()">☰</button>
  </div>
</nav>

<header class="hero">
  <div class="container hero-grid">
    <div>
      <span class="badge">Solusi Digital Terintegrasi</span>
      <h1>Solusi Cerdas untuk <span class="accent">Bisnis dan Pendidikan</span> di Era Digital</h1>
      <p>Kami menghadirkan inovasi teknologi mutakhir dan pendampingan akademik profesional untuk membantu institusi Anda bertransformasi dan berkembang pesat.</p>
      <div class="hero-btns">
        <a class="btn-teal" href="https://wa.me/628112225804" target="_blank" rel="noopener noreferrer">Konsultasi Sekarang <i class="fa-solid fa-arrow-right"></i></a>
        <a class="btn-outline" href="{{ url('/layanan') }}">Jelajahi Layanan</a>
      </div>
    </div>
    <div class="hero-img"><img src="{{ asset('assets/Dashboard.png') }}" alt="Dashboard analitik bisnis"></div>
  </div>
</header>

<div class="container">
  <div class="trust">
    <div class="trust-item"><div class="trust-icon"><i class="fa-solid fa-shield-halved"></i></div><div><h4>Solusi Terpercaya</h4><p>Keamanan &amp; keandalan prioritas utama.</p></div></div>
    <div class="trust-item"><div class="trust-icon"><i class="fa-solid fa-handshake"></i></div><div><h4>Kolaboratif</h4><p>Bekerja bersama mencapai hasil maksimal.</p></div></div>
    <div class="trust-item"><div class="trust-icon"><i class="fa-solid fa-arrow-trend-up"></i></div><div><h4>Dampak Nyata</h4><p>Fokus pada pertumbuhan berkelanjutan.</p></div></div>
  </div>
</div>

<section>
  <div class="container sektor-grid">
    <div><span class="badge badge-green">Target Kami</span><h2>Mendukung <span class="accent">Berbagai Sektor</span></h2><p>Kami merancang solusi spesifik untuk tantangan unik yang dihadapi bisnis dan akademik.</p></div>
    <div class="sektor-cards">
      <div class="sektor-card"><img src="{{ asset('assets/3_Business_people_teamwork_and_meeting.png') }}" alt="Pelaku bisnis"><div class="sektor-overlay"><span class="sektor-num">– 01</span><h3>Pelaku Bisnis</h3><p>Transformasi digital untuk efisiensi operasional.</p><div class="arrow-btn"><i class="fa-solid fa-arrow-right"></i></div></div></div>
      <div class="sektor-card"><img src="{{ asset('assets/3_What_will_the_future_campus_look.png') }}" alt="Institusi pendidikan"><div class="sektor-overlay"><span class="sektor-num">– 02</span><h3>Institusi Pendidikan</h3><p>Sistem manajemen akademik terintegrasi.</p><div class="arrow-btn"><i class="fa-solid fa-arrow-right"></i></div></div></div>
      <div class="sektor-card"><img src="{{ asset('assets/4_1_509_200_Woman_Working_Laptop_Stock.png') }}" alt="Individu profesional"><div class="sektor-overlay"><span class="sektor-num">– 03</span><h3>Individu Profesional</h3><p>Pendampingan akademik dan peningkatan skill.</p><div class="arrow-btn"><i class="fa-solid fa-arrow-right"></i></div></div></div>
    </div>
  </div>
</section>

<section style="background:#fff;">
  <div class="container layanan-grid">
    <div><span class="badge badge-blue">Layanan Utama</span><h2>Mendorong Batas <span class="accent">Inovasi &amp; Akademik</span></h2><p>Eintio menggabungkan keunggulan teknis dengan wawasan akademik mendalam untuk memberikan solusi yang benar-benar transformatif.</p><ul class="check-list"><li><span class="check">✓</span> Custom Software Development</li><li><span class="check">✓</span> Academic Data Analysis</li><li><span class="check">✓</span> Digital Transformation Consulting</li></ul></div>
    <div class="layanan-card"><div class="lc-icon"><i class="fa-solid fa-laptop-code"></i></div><h3>Solusi Teknologi</h3><p>Pengembangan aplikasi web, mobile, dan sistem kustom yang dirancang khusus untuk memenuhi kebutuhan spesifik dan diskalakan untuk pertumbuhan bisnis Anda di era digital.</p><a class="link-arrow" href="{{ url('/layanan') }}">Pelajari lebih lanjut <i class="fa-solid fa-arrow-right"></i></a></div>
    <div class="layanan-card"><div class="lc-icon"><i class="fa-solid fa-graduation-cap"></i></div><h3>Layanan Akademik</h3><p>Pendampingan komprehensif mulai dari bimbingan publikasi, analisis data statistik mendalam, hingga penulisan karya ilmiah dengan standar kualitas akademik tertinggi.</p><a class="link-arrow" href="{{ url('/layanan') }}">Pelajari lebih lanjut <i class="fa-solid fa-arrow-right"></i></a></div>
  </div>
</section>

<section>
  <div class="container">
    <div class="porto-head"><div><h2>Portofolio Terpilih</h2><p>Intip bagaimana kami membantu mitra kami mencapai target melalui solusi digital.</p></div><a class="link-arrow" href="{{ url('/portofolio') }}">Lihat Semua Projek <i class="fa-solid fa-arrow-right"></i></a></div>
    <div class="porto-grid">
      <div class="porto-card"><img src="{{ asset('assets/5_Modern_office_workspace_with_business.png') }}" alt="Projek dashboard"><div class="porto-body"><h4>Dashboard Analitik Terpadu</h4><p>Custom Software Development</p></div></div>
      <div class="porto-card"><img src="{{ asset('assets/1_Data_Analysis_Workspace_Laptop_Tablet.png') }}" alt="Projek analisis data"><div class="porto-body"><h4>Sistem Informasi Akademik</h4><p>Digital Transformation</p></div></div>
      <div class="porto-card"><img src="{{ asset('assets/10_Data_analysis_workspace_with_laptop.png') }}" alt="Projek riset"><div class="porto-body"><h4>Analisis Data Riset</h4><p>Academic Data Analysis</p></div></div>
    </div>
  </div>
</section>

<section class="kenapa" style="background:#fff;">
  <div class="container"><h2>Kenapa Memilih Eintio?</h2><div class="kenapa-grid">
    <div class="kenapa-card"><div class="k-icon"><i class="fa-solid fa-lightbulb"></i></div><h4>Inovasi Berkelanjutan</h4><p>Kami selalu update dengan teknologi terbaru untuk memberikan solusi terbaik dan relevan.</p></div>
    <div class="kenapa-card"><div class="k-icon"><i class="fa-solid fa-clock"></i></div><h4>Tepat Waktu</h4><p>Manajemen proyek yang efisien menjamin pengiriman sistem atau laporan sesuai deadline.</p></div>
    <div class="kenapa-card"><div class="k-icon"><i class="fa-solid fa-headset"></i></div><h4>Dukungan Penuh</h4><p>Tim kami siap membantu Anda kapan pun diperlukan bahkan setelah fase implementasi selesai.</p></div>
    <div class="kenapa-card"><div class="k-icon"><i class="fa-solid fa-award"></i></div><h4>Kualitas Premium</h4><p>Standar kualitas tinggi yang kami terapkan dalam setiap baris kode dan analisis akademik.</p></div>
  </div></div>
</section>

<section class="testimoni"><div class="container"><h2>Apa Kata Klien Kami</h2><div class="testi-grid">
  <div class="testi-card"><div class="stars">★★★★★</div><blockquote>"Kerja sama dengan Eintio sangat membantu digitalisasi operasional kantor kami. Hasilnya rapi, modern, dan sangat intuitif bagi tim kami."</blockquote><div class="testi-person"><div class="avatar av-teal">AS</div><div><h5>Andi Setiawan</h5><span>CEO, Startup Solutions</span></div></div></div>
  <div class="testi-card"><div class="stars">★★★★★</div><blockquote>"Sangat profesional dalam pendampingan analisis data akademik. Metodologi yang digunakan sangat tepat dan membantu penyelesaian riset saya tepat waktu."</blockquote><div class="testi-person"><div class="avatar av-blue">MU</div><div><h5>Dr. Maria Ulfa</h5><span>Peneliti Senior</span></div></div></div>
  <div class="testi-card"><div class="stars">★★★★★</div><blockquote>"Tim yang sangat responsif. Sistem informasi akademik yang mereka bangun telah mengubah total cara kami berinteraksi dan melayani mahasiswa."</blockquote><div class="testi-person"><div class="avatar av-navy">BW</div><div><h5>Bambang Wijaya</h5><span>Direktur IT, Univ. Harapan</span></div></div></div>
</div></div></section>

<div class="container cta-wrap"><div class="cta"><div><h2>Siap Untuk Mulai<br>Bertransformasi?</h2><p>Jangan biarkan institusi Anda tertinggal. Mulai langkah pertama Anda menuju era digital bersama PT Eintio Academic &amp; Technology hari ini untuk solusi yang efisien dan berdampak.</p><a class="btn-yellow" href="https://wa.me/628112225804" target="_blank" rel="noopener noreferrer">Konsultasi Sekarang Gratis <i class="fa-solid fa-comment"></i></a></div><div class="cta-img"><img src="{{ asset('assets/6_Circuit_board_electronic_dark_computer.png') }}" alt="Teknologi digital"></div></div></div>

<footer><div class="container footer-grid">
  <div><div class="footer-brand"><img src="{{ asset('images/ikon.png') }}" alt="Eintio Logo" class="logo-img"><span>PT Eintio Academic &amp; Technology</span></div><p>Menyediakan solusi digital terintegrasi dan pendampingan akademik profesional untuk masa depan bisnis dan pendidikan Indonesia yang lebih cerah.</p>
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
</div></div>
  <div><h5>Navigasi</h5><ul><li><a href="{{ url('/') }}">Beranda</a></li><li><a href="{{ url('/layanan') }}">Layanan</a></li><li><a href="{{ url('/tim') }}">Tim</a></li><li><a href="{{ url('/blog') }}">Blog</a></li></ul></div>
  <div><h5>Layanan</h5><ul><li><a href="{{ url('/layanan') }}">Web Development</a></li><li><a href="{{ url('/layanan') }}">Mobile Apps</a></li><li><a href="{{ url('/layanan') }}">Analisis Data Riset</a></li><li><a href="{{ url('/layanan') }}">Bimbingan Akademik</a></li></ul></div>
  <div><h5>Kontak</h5><ul class="contact-list"><li><i class="fa-solid fa-location-dot ci"></i><span>Jln. Menjangan No. 25A, Salatiga, Jawa Tengah</span></li><li><i class="fa-solid fa-phone ci"></i><a href="tel:+628112225804">(+62) 8112225804</a></li><li><i class="fa-solid fa-envelope ci"></i><a href="mailto:info@eintio.co.id">info@eintio.co.id</a></li></ul></div>
</div><div class="copyright">© 2024 PT Eintio Academic &amp; Technology. All rights reserved.</div></footer>

<script>
function toggleMenu(){document.querySelector('.nav-links').classList.toggle('mobile-open')}
</script>
</body>
</html>