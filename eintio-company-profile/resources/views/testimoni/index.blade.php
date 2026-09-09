<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">

<title>Testimoni - PT Eintio Academic &amp; Technology</title>

<style>
:root{
    --teal:#14b8c4;
    --teal-dark:#0e9aa8;
    --navy:#12233f;
    --ink:#33415c;
    --muted:#687386;
    --bg:#f7f9fc;
    --yellow:#ffd400;
    --line:#e8edf4;
    --radius:18px;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

html{
    scroll-behavior:smooth;
}

body{
    font-family:'Segoe UI',Arial,sans-serif;
    background:var(--bg);
    color:var(--ink);
    line-height:1.6;
}

img{
    display:block;
    max-width:100%;
}

a{
    text-decoration:none;
    color:inherit;
}

button,
input,
select,
textarea{
    font-family:inherit;
}

.container{
    max-width:1200px;
    margin:0 auto;
    padding:0 24px;
}


/* =========================================================
   NAVBAR — SAMA SEPERTI INDEX
========================================================= */

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

.nav-links a:hover{
    color:var(--teal);
}

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
    border:0;
    border-radius:50px;
    padding:10px 20px;
    font-size:13px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:9px;
    cursor:pointer;
    transition:.2s;
    white-space:nowrap;
}

.btn-teal:hover{
    background:var(--teal-dark);
    transform:translateY(-1px);
}

.nav-consult{
    margin-left:0;
}

.menu-toggle{
    display:none;
    border:0;
    background:none;
    color:var(--navy);
    font-size:25px;
    cursor:pointer;
}


/* =========================================================
   PAGE / HERO
========================================================= */

.page{
    padding-top:64px;
}

.hero{
    padding:0 0 56px;
}

.hero-grid{
    display:grid;
    grid-template-columns:1.05fr 1fr;
    gap:50px;
    align-items:center;
}

.badge{
    display:inline-flex;
    align-items:center;
    gap:7px;
    background:#e6f7f9;
    border:1px solid #bdeef2;
    color:var(--teal-dark);
    padding:6px 15px;
    border-radius:50px;
    font-size:11px;
    font-weight:700;
    letter-spacing:1px;
    text-transform:uppercase;
    margin-bottom:20px;
}

.hero h1{
    color:var(--navy);
    font-size:46px;
    line-height:1.16;
    letter-spacing:-1px;
    font-weight:800;
    margin-bottom:20px;
}

.hero h1 span{
    color:var(--teal);
}

.hero-desc{
    color:var(--muted);
    font-size:15px;
    line-height:1.75;
    max-width:510px;
    margin-bottom:30px;
}

.hero-stats{
    display:flex;
    align-items:center;
    gap:40px;
}

.stat{
    display:flex;
    align-items:center;
    gap:12px;
}

.stat-icon{
    width:46px;
    height:46px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#e6f7f9;
    color:var(--teal-dark);
    font-size:17px;
}

.stat:nth-child(2) .stat-icon{
    background:#fff8d9;
    color:#d7b900;
}

.stat strong{
    display:block;
    color:var(--navy);
    font-size:18px;
    line-height:1.1;
}

.stat small{
    display:block;
    color:var(--muted);
    font-size:11px;
    margin-top:4px;
}

.hero-img{
    height:330px;
    background:#fff;
    border-radius:20px;
    padding:7px;
    overflow:hidden;
    box-shadow:0 18px 45px rgba(18,35,63,.13);
}

.hero-img img{
    width:100%;
    height:100%;
    object-fit:cover;
    border-radius:15px;
}


/* =========================================================
   FILTER
========================================================= */

.filter-wrap{
    padding-bottom:20px;
}

.filter-bar{
    display:flex;
    align-items:center;
    gap:10px;
    overflow-x:auto;
    scrollbar-width:none;
}

.filter-bar::-webkit-scrollbar{
    display:none;
}

.filter{
    border:1px solid #d5dce7;
    background:#f0f3f8;
    color:var(--ink);
    border-radius:50px;
    padding:8px 18px;
    font-size:11px;
    font-weight:700;
    cursor:pointer;
    white-space:nowrap;
    transition:.2s;
}

.filter:hover{
    border-color:var(--teal);
    color:var(--teal);
}

.filter.active{
    background:var(--teal);
    border-color:var(--teal);
    color:#fff;
    box-shadow:0 5px 14px rgba(20,184,196,.18);
}


/* =========================================================
   CONTENT
========================================================= */

.content{
    display:grid;
    grid-template-columns:minmax(0,1fr) 365px;
    gap:28px;
    align-items:start;
    padding-top:20px;
}

.left-column{
    min-width:0;
}


/* =========================================================
   RATING
========================================================= */

.rating-card{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 28px rgba(18,35,63,.05);
    padding:28px 30px;
    display:grid;
    grid-template-columns:185px minmax(0,1fr);
    gap:28px;
    align-items:center;
}

.rating-number{
    color:var(--teal);
    font-size:48px;
    line-height:1;
    font-weight:800;
}

.rating-stars{
    color:var(--yellow);
    font-size:17px;
    letter-spacing:2px;
    margin-top:7px;
}

.rating-caption{
    color:var(--muted);
    font-size:11px;
    margin-top:5px;
}

.rating-bars{
    display:grid;
    gap:12px;
}

.rating-row{
    display:grid;
    grid-template-columns:110px minmax(80px,1fr) 28px;
    gap:10px;
    align-items:center;
    font-size:10px;
    font-weight:700;
    color:var(--ink);
}

.rating-row b{
    text-align:right;
    color:var(--muted);
    font-size:10px;
}

.bar{
    height:6px;
    border-radius:50px;
    overflow:hidden;
    background:#e9edf3;
}

.bar span{
    display:block;
    height:100%;
    background:var(--teal);
    border-radius:50px;
}


/* =========================================================
   REVIEWS
========================================================= */

.reviews{
    display:grid;
    grid-template-columns:repeat(2,minmax(0,1fr));
    gap:22px;
    margin-top:24px;
}

.review-card{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 28px rgba(18,35,63,.05);
    padding:26px;
    min-height:265px;
    display:flex;
    flex-direction:column;
}

.review-stars{
    color:var(--yellow);
    font-size:14px;
    letter-spacing:2px;
}

.quote{
    color:#edf0f4;
    font-size:48px;
    line-height:.5;
    align-self:flex-end;
    margin-top:0;
}

.review-text{
    color:var(--ink);
    font-size:12.5px;
    line-height:1.75;
    margin:10px 0 20px;
    flex:1;
}

.review-person{
    border-top:1px solid #e8edf4;
    padding-top:14px;
    display:flex;
    align-items:center;
    gap:10px;
}

.avatar{
    width:43px;
    height:43px;
    flex:0 0 43px;
    border-radius:50%;
    object-fit:cover;
    background:#edf1f5;
}

.person-name{
    color:var(--navy);
    font-size:11.5px;
    font-weight:800;
}

.person-role{
    color:var(--muted);
    font-size:9.5px;
    margin-top:2px;
}


/* =========================================================
   LOAD MORE
========================================================= */

.load-more{
    display:flex;
    justify-content:center;
    margin-top:32px;
}

.load-more button{
    border:1.5px solid var(--teal);
    background:#fff;
    color:var(--teal-dark);
    border-radius:50px;
    padding:10px 20px;
    font-size:11px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:7px;
    cursor:pointer;
    transition:.2s;
}

.load-more button:hover{
    background:var(--teal);
    color:#fff;
}


/* =========================================================
   FORM
========================================================= */

.form-card{
    background:#fff;
    border-radius:var(--radius);
    box-shadow:0 8px 28px rgba(18,35,63,.05);
    padding:27px;
}

.form-card h2{
    color:var(--navy);
    font-size:20px;
    line-height:1.25;
    margin-bottom:8px;
}

.form-card > p{
    color:var(--muted);
    font-size:11px;
    line-height:1.65;
    margin-bottom:20px;
}

.field{
    margin-bottom:13px;
}

.field label{
    display:block;
    color:var(--navy);
    font-size:10.5px;
    font-weight:700;
    margin-bottom:5px;
}

.field input,
.field select,
.field textarea{
    width:100%;
    border:1px solid #cfd7e4;
    border-radius:7px;
    background:#f8faff;
    color:var(--ink);
    padding:9px 10px;
    font-size:11px;
    outline:none;
    transition:.2s;
}

.field input:focus,
.field select:focus,
.field textarea:focus{
    border-color:var(--teal);
    background:#fff;
    box-shadow:0 0 0 3px rgba(20,184,196,.08);
}

.field input::placeholder,
.field textarea::placeholder{
    color:#929cad;
}

.field textarea{
    min-height:90px;
    resize:vertical;
}

.form-stars{
    display:flex;
    gap:3px;
}

.form-stars button{
    border:0;
    background:none;
    color:#cbd2dc;
    font-size:23px;
    line-height:1;
    padding:0;
    cursor:pointer;
    transition:.15s;
}

.form-stars button:hover,
.form-stars button.selected{
    color:var(--yellow);
}

.send{
    width:100%;
    border:0;
    border-radius:50px;
    background:var(--yellow);
    color:var(--navy);
    padding:11px 16px;
    font-size:11px;
    font-weight:800;
    cursor:pointer;
    transition:.2s;
}

.send:hover{
    transform:translateY(-1px);
    box-shadow:0 7px 18px rgba(255,212,0,.25);
}


/* =========================================================
   CTA
========================================================= */

.cta-wrap{
    padding:65px 0 72px;
}

.cta{
    background:linear-gradient(120deg,#0e9aa8,#14b8c4);
    border-radius:25px;
    padding:48px 55px;
    display:grid;
    grid-template-columns:1.2fr .8fr;
    gap:40px;
    align-items:center;
    overflow:hidden;
    box-shadow:0 15px 35px rgba(18,35,63,.12);
}

.cta h2{
    color:#fff;
    font-size:31px;
    line-height:1.25;
    font-weight:800;
    margin-bottom:15px;
}

.cta p{
    color:rgba(255,255,255,.9);
    font-size:13px;
    line-height:1.7;
    max-width:510px;
    margin-bottom:24px;
}

.btn-yellow{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    border:0;
    border-radius:50px;
    background:var(--yellow);
    color:var(--navy);
    padding:12px 24px;
    font-size:12px;
    font-weight:800;
    box-shadow:0 7px 20px rgba(0,0,0,.15);
    transition:.2s;
}

.btn-yellow:hover{
    transform:translateY(-2px);
}

.cta-img{
    height:220px;
    border-radius:17px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 15px 35px rgba(0,0,0,.20);
}

.cta-img img{
    width:100%;
    height:100%;
    object-fit:cover;
}


/* =========================================================
   FOOTER — SAMA SEPERTI INDEX
========================================================= */

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

.footer-grid p{
    font-size:13.5px;
    color:var(--muted);
    line-height:1.7;
}

.footer-grid h5{
    font-size:15px;
    color:var(--navy);
    margin-bottom:16px;
}

.footer-grid ul{
    list-style:none;
}

.footer-grid ul li{
    padding:5px 0;
    font-size:13.5px;
    color:var(--muted);
}

.footer-grid ul li a:hover{
    color:var(--teal);
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

.contact-list li a{
    color:var(--muted);
}

.contact-list li a:hover{
    color:var(--teal);
}

.copyright{
    text-align:center;
    font-size:12.5px;
    color:var(--muted);
    border-top:1px solid #e8edf4;
    padding:18px 24px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .nav-links{
        gap:18px;
        font-size:13px;
    }

    .nav-inner{
        gap:20px;
    }

    .content{
        grid-template-columns:minmax(0,1fr) 340px;
    }

    .rating-card{
        grid-template-columns:165px minmax(0,1fr);
    }
}


@media(max-width:1024px){

    .nav-links{
        display:none;
        position:absolute;
        top:100%;
        left:0;
        right:0;
        background:#fff;
        box-shadow:0 10px 25px rgba(18,35,63,.10);
        padding:18px 24px;
        flex-direction:column;
        align-items:flex-start;
        gap:0;
        margin-left:0;
    }

    .nav-links.mobile-open{
        display:flex;
    }

    .nav-links a{
        width:100%;
        padding:11px 0;
    }

    .nav-links a.active::after{
        display:none;
    }

    .nav-inner > .nav-consult{
        display:none;
    }

    .menu-toggle{
        display:block;
        margin-left:auto;
    }
}


@media(max-width:900px){

    .hero-grid{
        grid-template-columns:1fr;
    }

    .hero-img{
        height:330px;
    }

    .content{
        grid-template-columns:1fr;
    }

    .form-card{
        order:2;
    }

    .cta{
        grid-template-columns:1fr;
    }

    .cta-img{
        height:240px;
    }

    .footer-grid{
        grid-template-columns:1fr 1fr;
    }
}


@media(max-width:700px){

    .page{
        padding-top:42px;
    }

    .hero{
        padding-bottom:45px;
    }

    .hero h1{
        font-size:36px;
    }

    .hero-desc{
        font-size:14px;
    }

    .hero-img{
        height:280px;
    }

    .hero-stats{
        gap:22px;
        flex-wrap:wrap;
    }

    .rating-card{
        grid-template-columns:1fr;
        padding:25px;
    }

    .reviews{
        grid-template-columns:1fr;
    }

    .cta-wrap{
        padding:52px 0;
    }

    .cta{
        padding:38px 28px;
        border-radius:22px;
    }

    .cta h2{
        font-size:28px;
    }

    .cta-img{
        height:200px;
    }

    .footer-grid{
        grid-template-columns:1fr;
    }
}


@media(max-width:560px){

    .container{
        padding:0 18px;
    }

    .nav-inner{
        padding:12px 18px;
    }

    .brand{
        font-size:14px;
    }

    .logo-img{
        width:28px;
        height:28px;
    }

    .hero h1{
        font-size:32px;
    }

    .rating-row{
        grid-template-columns:105px minmax(60px,1fr) 30px;
        gap:7px;
        font-size:9px;
    }

    .filter{
        padding:8px 15px;
        font-size:10px;
    }
}
</style>
</head>


<body>


{{-- =========================================================
     NAVBAR — SAMA SEPERTI INDEX
========================================================= --}}

<nav class="navbar">

    <div class="nav-inner">

        <a href="{{ url('/') }}" class="brand">

            <img
                src="{{ asset('images/ikon.png') }}"
                alt="Eintio Logo"
                class="logo-img"
            >

            <span>
                PT Eintio Academic &amp; Technology
            </span>

        </a>


        <div class="nav-links">

            <a href="{{ url('/') }}">
                Beranda
            </a>

            <a href="{{ url('/profil') }}">
                Profil
            </a>

            <a href="{{ url('/layanan') }}">
                Layanan
            </a>

            <a href="{{ url('/portofolio') }}">
                Portofolio
            </a>

            <a href="{{ url('/tim') }}">
                Tim
            </a>

            <a href="{{ url('/blog') }}">
                Blog
            </a>

            <a href="{{ url('/testimoni') }}" class="active">
                Testimoni
            </a>

            <a href="{{ url('/contact') }}">
                Contact
            </a>

        </div>


        <a
            class="btn-teal nav-consult"
            href="https://wa.me/628112225804"
            target="_blank"
            rel="noopener noreferrer"
        >
            <span>Konsultasi WhatsApp</span>
            <i class="fa-solid fa-paper-plane"></i>
        </a>


        <button
            class="menu-toggle"
            type="button"
            aria-label="Buka menu"
            onclick="toggleMenu()"
        >
            ☰
        </button>

    </div>

</nav>



<main class="page">


{{-- =========================================================
     HERO TESTIMONI
========================================================= --}}

<section class="hero">

    <div class="container hero-grid">

        <div>

            <span class="badge">
                Testimoni
            </span>


            <h1>
                Cerita Sukses<br>
                <span>Klien Kami</span>
            </h1>


            <p class="hero-desc">
                Lihat bagaimana PT Eintio Academic &amp; Technology telah
                membantu berbagai instansi, institusi akademik, dan
                perusahaan mewujudkan transformasi digital mereka.
            </p>


            <div class="hero-stats">

                <div class="stat">

                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <div>
                        <strong>120+</strong>
                        <small>Klien Puas</small>
                    </div>

                </div>


                <div class="stat">

                    <div class="stat-icon">
                        <i class="fa-solid fa-rocket"></i>
                    </div>

                    <div>
                        <strong>200+</strong>
                        <small>Proyek Selesai</small>
                    </div>

                </div>

            </div>

        </div>


        <div class="hero-img">

            <img
                src="{{ asset('assets/image.png') }}"
                alt="Testimoni PT Eintio Academic &amp; Technology"
            >

        </div>

    </div>

</section>



{{-- =========================================================
     FILTER
========================================================= --}}

<div class="container filter-wrap">

    <div class="filter-bar">

        <button
            class="filter active"
            type="button"
            data-filter="all"
        >
            Semua Testimoni
        </button>

        <button
            class="filter"
            type="button"
            data-filter="teknologi"
        >
            Teknologi
        </button>

        <button
            class="filter"
            type="button"
            data-filter="akademik"
        >
            Akademik
        </button>

        <button
            class="filter"
            type="button"
            data-filter="pendidikan"
        >
            Pendidikan
        </button>

        <button
            class="filter"
            type="button"
            data-filter="bisnis"
        >
            Bisnis
        </button>

        <button
            class="filter"
            type="button"
            data-filter="instansi"
        >
            Instansi
        </button>

    </div>

</div>



{{-- =========================================================
     CONTENT
========================================================= --}}

<section>

    <div class="container content">


        {{-- LEFT COLUMN --}}

        <div class="left-column">


            {{-- RATING --}}

            <div class="rating-card">

                <div>

                <div class="rating-number">
    {{ $averageRating }}
</div>

                    <div class="rating-stars">
                        ★★★★★
                    </div>

                    <div class="rating-caption">
    Dari {{ $total }} Ulasan
</div>

                </div>


                <div class="rating-bars">

                    <div class="rating-row">

                        <span>
                            Kualitas Layanan
                        </span>

                        <div class="bar">
                            <span style="width:98%"></span>
                        </div>

                        <b>4.9</b>

                    </div>


                    <div class="rating-row">

                        <span>
                            Profesionalisme
                        </span>

                        <div class="bar">
                            <span style="width:100%"></span>
                        </div>

                        <b>5.0</b>

                    </div>


                    <div class="rating-row">

                        <span>
                            Ketepatan Waktu
                        </span>

                        <div class="bar">
                            <span style="width:96%"></span>
                        </div>

                        <b>4.8</b>

                    </div>


                    <div class="rating-row">

                        <span>
                            Komunikasi
                        </span>

                        <div class="bar">
                            <span style="width:98%"></span>
                        </div>

                        <b>4.9</b>

                    </div>

                </div>

            </div>



            {{-- REVIEWS --}}

            <div class="reviews">

@forelse($testimonials as $item)

<article 
class="review-card"
data-category="{{ strtolower($item->category) }}"
>


<div class="review-stars">

@for($i = 1; $i <= 5; $i++)

@if($i <= $item->rating)

★


@else

<span style="color:#cbd2dc">
★
</span>

@endif


@endfor


</div>


<div class="quote">
”
</div>



<p class="review-text">

"{{ $item->testimoni }}"

</p>



<div class="review-person">


<img
class="avatar"
src="{{ asset('images/testimoni/avatar-default.jpg') }}"
alt=""
>



<div>

<div class="person-name">

{{ $item->client_name }}

</div>



<div class="person-role">

{{ $item->client_institution }}

<br>

{{ $item->client_position }}

</div>


</div>


</div>


</article>


@empty


<p>
Belum ada testimoni.
</p>


@endforelse

            </div>



            {{-- LOAD MORE --}}

            <div class="load-more">

                <button type="button" id="loadMore">

                    <i class="fa-solid fa-rotate-right"></i>

                    Muat Lebih Banyak

                </button>

            </div>


        </div>



        {{-- =====================================================
             FORM TESTIMONI
        ====================================================== --}}

        <aside class="form-card">

            <h2>
                Berikan Testimoni Anda
            </h2>

            <p>
                Pengalaman Anda sangat berarti bagi kami untuk terus
                meningkatkan kualitas layanan.
            </p>


            <form
method="POST"
action="{{ route('testimoni.store') }}"
>

                @csrf


                <div class="field">

                    <label for="name">
                        Nama Lengkap
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Masukkan nama"
                        value="{{ old('name') }}"
                    >

                </div>



                <div class="field">

                    <label for="email">
                        Email Profesional
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="email@instansi.com"
                        value="{{ old('email') }}"
                    >

                </div>



                <div class="field">

                    <label for="organization">
                        Instansi / Organisasi
                    </label>

                    <input
                        id="organization"
                        type="text"
                        name="client_institution"
                        placeholder="Nama organisasi"
                        value="{{ old('organization') }}"
                    >

                </div>



                <div class="field">

                    <label for="service">
                        Layanan yang Digunakan
                    </label>

                    <select
                        id="service"
                        name="service"
                    >

                        <option value="">
                            Layanan Cloud
                        </option>

                        <option value="Technology">
                            Technology
                        </option>

                        <option value="Business">
                            Business
                        </option>

                        <option value="Education">
                            Education
                        </option>

                        <option value="Academic">
                            Academic
                        </option>

                    </select>

                </div>



                <div class="field">

                    <label>
                        Rating Anda
                    </label>

                    <div class="form-stars">

                        <button
                            type="button"
                            aria-label="1 bintang"
                        >
                            ★
                        </button>

                        <button
                            type="button"
                            aria-label="2 bintang"
                        >
                            ★
                        </button>

                        <button
                            type="button"
                            aria-label="3 bintang"
                        >
                            ★
                        </button>

                        <button
                            type="button"
                            aria-label="4 bintang"
                        >
                            ★
                        </button>

                        <button
                            type="button"
                            aria-label="5 bintang"
                        >
                            ★
                        </button>

                    </div>


                    <input
                        type="hidden"
                        name="rating"
                        id="rating"
                        value=""
                    >

                </div>



                <div class="field">

                    <label for="message">
                        Pesan Testimoni
                    </label>

                    <textarea
    id="testimoni"
    name="testimoni"
    placeholder="Ceritakan pengalaman kolaborasi Anda bersama kami..."
>{{ old('testimoni') }}</textarea>

                </div>



                <button
                    class="send"
                    type="submit"
                >
                    Kirim Testimoni
                </button>

            </form>

        </aside>

    </div>

</section>



{{-- =========================================================
     CTA
========================================================= --}}

<div class="container cta-wrap">

    <div class="cta">

        <div>

            <h2>
                Bersama Eintio, Wujudkan
                Solusi Digital Terbaik
                untuk Anda
            </h2>

            <p>
                Bergabunglah dengan ratusan klien yang telah
                mempercayakan transformasi digital dan ekosistem
                akademik mereka kepada kami.
            </p>

            <a
                class="btn-yellow"
                href="{{ url('/contact') }}"
            >
                Mulai Konsultasi Gratis
            </a>

        </div>


        <div class="cta-img">

            <img
                src="{{ asset('assets/bg.png') }}"
                alt="Testimoni Eintio"
            >

        </div>

    </div>

</div>


</main>



{{-- =========================================================
     FOOTER — SAMA SEPERTI INDEX
========================================================= --}}

<footer>

    <div class="container footer-grid">


        {{-- BRAND --}}

        <div>

            <div class="footer-brand">

                <img
                    src="{{ asset('images/ikon.png') }}"
                    alt="Eintio Logo"
                    class="logo-img"
                >

                <span>
                    PT Eintio Academic &amp; Technology
                </span>

            </div>


            <p>
                Menyediakan solusi digital terintegrasi dan pendampingan akademik
                profesional untuk masa depan bisnis dan pendidikan Indonesia
                yang lebih cerah.
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



        {{-- NAVIGASI --}}

        <div>

            <h5>
                Navigasi
            </h5>

            <ul>

                <li>
                    <a href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ url('/layanan') }}">
                        Layanan
                    </a>
                </li>

                <li>
                    <a href="{{ url('/tim') }}">
                        Tim
                    </a>
                </li>

                <li>
                    <a href="{{ url('/blog') }}">
                        Blog
                    </a>
                </li>

            </ul>

        </div>



        {{-- LAYANAN --}}

        <div>

            <h5>
                Layanan
            </h5>

            <ul>

                <li>
                    <a href="{{ url('/layanan') }}">
                        Web Development
                    </a>
                </li>

                <li>
                    <a href="{{ url('/layanan') }}">
                        Mobile Apps
                    </a>
                </li>

                <li>
                    <a href="{{ url('/layanan') }}">
                        Analisis Data Riset
                    </a>
                </li>

                <li>
                    <a href="{{ url('/layanan') }}">
                        Bimbingan Akademik
                    </a>
                </li>

            </ul>

        </div>



        {{-- KONTAK --}}

        <div>

            <h5>
                Kontak
            </h5>

            <ul class="contact-list">

                <li>

                    <i class="fa-solid fa-location-dot ci"></i>

                    <span>
                        Jln. Menjangan No. 25A,
                        Salatiga, Jawa Tengah
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
        © 2024 PT Eintio Academic &amp; Technology.
        All rights reserved.
    </div>

</footer>



<script>

/* =========================================================
   MOBILE MENU — SAMA SEPERTI HALAMAN SEBELUMNYA
========================================================= */

function toggleMenu(){

    const nav = document.querySelector('.nav-links');

    if(nav){
        nav.classList.toggle('mobile-open');
    }

}


/* =========================================================
   RATING STAR
========================================================= */

const ratingInput =
    document.getElementById('rating');

const ratingButtons =
    document.querySelectorAll('.form-stars button');


ratingButtons.forEach(function(button,index){

    button.addEventListener('click',function(){

        const rating = index + 1;

        ratingInput.value = rating;


        ratingButtons.forEach(function(item,itemIndex){

            item.classList.toggle(
                'selected',
                itemIndex < rating
            );

        });

    });

});


/* =========================================================
   FILTER TESTIMONI
========================================================= */

const filters =
    document.querySelectorAll('.filter');

const reviewCards =
    document.querySelectorAll('.review-card');


filters.forEach(function(filter){

    filter.addEventListener('click',function(){

        filters.forEach(function(item){

            item.classList.remove('active');

        });

        this.classList.add('active');


        const selected =
            this.dataset.filter;


        reviewCards.forEach(function(card){

            if(selected === 'all'){

                card.style.display = 'flex';

                return;

            }


            const categories =
                (card.dataset.category || '')
                .toLowerCase()
                .split(' ');


            if(categories.includes(selected)){

                card.style.display = 'flex';

            }else{

                card.style.display = 'none';

            }

        });

    });

});


/* =========================================================
   LOAD MORE
========================================================= */

const loadMore =
    document.getElementById('loadMore');


if(loadMore){

    loadMore.addEventListener('click',function(){

        this.innerHTML =
            '<i class="fa-solid fa-check"></i> Semua Testimoni Ditampilkan';

    });

}

</script>

</body>
</html>