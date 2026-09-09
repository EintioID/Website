<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
      <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">

<title>Contact - PT Eintio Academic &amp; Technology</title>

<style>

:root{
    --teal:#14b8c4;
    --teal-dark:#0e9aa8;
    --navy:#12233f;
    --ink:#33415c;
    --muted:#5b6b85;
    --bg:#f7f9fc;
    --yellow:#ffd400;
    --blue:#1760d9;
    --line:#e5eaf1;
    --radius:18px;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Arial,sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
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

.btn-teal:hover{
    background:var(--teal-dark);
}

.btn-teal i{
    line-height:1;
}

.btn-teal .fa-paper-plane{
    font-size:13px;
}

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

    .nav-links{
        display:none;
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
        box-shadow:0 10px 25px rgba(18,35,63,.08);
    }

    .nav-consult{
        display:none;
    }

    .menu-toggle{
        display:block;
    }
}


/* =========================================================
   CONTACT HERO
========================================================= */

.contact-hero{
    background:linear-gradient(
        120deg,
        #f4fbfc,
        #eef9fb
    );

    padding:0;
}

.contact-hero-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    min-height:520px;
    align-items:center;
}

.contact-hero-content{
    padding:58px 45px 58px 0;
}

.contact-hero h1{
    font-size:46px;
    line-height:1.13;
    color:#172033;
    font-weight:800;
    margin-bottom:20px;
}

.contact-hero h1 .accent{
    color:var(--teal);
}

.contact-hero p{
    font-size:15px;
    color:var(--muted);
    max-width:560px;
    margin-bottom:28px;
}

.contact-benefits{
    display:grid;
    gap:12px;
    max-width:440px;
}

.contact-benefit{
    display:flex;
    align-items:center;
    gap:14px;
    background:#fff;
    border:1px solid #e6eaf0;
    border-radius:9px;
    padding:12px 14px;
    min-height:58px;
    box-shadow:0 4px 15px rgba(18,35,63,.035);
}

.contact-benefit-icon{
    width:36px;
    height:36px;
    border-radius:10px;
    background:#edf4ff;
    color:#1559c9;
    display:flex;
    align-items:center;
    justify-content:center;
    flex-shrink:0;
}

.contact-benefit span{
    font-size:12px;
    font-weight:700;
    color:#28344a;
}

.contact-hero-image{
    height:420px;
    border-radius:24px 0 0 24px;
    overflow:hidden;
    box-shadow:0 20px 45px rgba(18,35,63,.12);
}

.contact-hero-image img{
    width:100%;
    height:100%;
    object-fit:cover;
}


/* =========================================================
   CONTACT INFO
========================================================= */

.contact-info{
    background:#fff;
    padding:12px 0 70px;
}

.section-heading{
    text-align:center;
    margin:0 auto 30px;
}

.section-heading h2{
    font-size:30px;
    color:var(--teal);
    font-weight:800;
}

.section-heading p{
    max-width:620px;
    margin:7px auto 0;
    color:var(--muted);
    font-size:14px;
}

.contact-cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:22px;
}

.contact-card{
    background:#f3fbfc;
    border-radius:12px;
    padding:25px 20px 22px;
    min-height:250px;
    text-align:center;

    display:flex;
    flex-direction:column;
    align-items:center;

    transition:.2s;
}

.contact-card:hover{
    transform:translateY(-4px);
    box-shadow:0 10px 25px rgba(18,35,63,.07);
}

.contact-card-icon{
    width:50px;
    height:50px;
    background:#fff;
    border-radius:13px;

    display:flex;
    align-items:center;
    justify-content:center;

    color:#0757d5;
    font-size:20px;

    box-shadow:0 5px 16px rgba(18,35,63,.06);

    margin-bottom:15px;
}

.contact-card h3{
    font-size:16px;
    color:#172033;
    margin-bottom:7px;
}

.contact-card p{
    font-size:12px;
    color:#5e6879;
    line-height:1.55;
    min-height:58px;
}

.contact-card-link{
    margin-top:auto;
    padding-top:15px;

    color:#1459c9;
    font-size:11px;
    font-weight:700;
}


/* =========================================================
   FORM SECTION
========================================================= */

.contact-form-section{
    background:#f0fafc;
    padding:62px 0 70px;
}

.contact-form-layout{
    display:grid;
    grid-template-columns:1.55fr .75fr;
    gap:28px;
    align-items:start;
}

.contact-form-card{
    background:#fff;
    border:1px solid var(--line);
    border-radius:20px;
    padding:30px;
    box-shadow:0 7px 28px rgba(18,35,63,.045);
}

.contact-form-card h2{
    font-size:23px;
    color:#202735;
    margin-bottom:23px;
}

.contact-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:17px 20px;
}

.contact-field{
    min-width:0;
}

.contact-field.full{
    grid-column:1/-1;
}

.contact-field label{
    display:block;
    margin-bottom:6px;
    color:#414b5d;
    font-size:10.5px;
    font-weight:700;
}

.contact-field input,
.contact-field select,
.contact-field textarea{
    width:100%;
    border:1px solid #d2d9e4;
    border-radius:8px;
    background:#fff;
    color:#586477;
    outline:0;
    padding:11px 13px;
    font-size:11.5px;
}

.contact-field input,
.contact-field select{
    height:43px;
}

.contact-field textarea{
    min-height:105px;
    resize:vertical;
}

.contact-field input:focus,
.contact-field select:focus,
.contact-field textarea:focus{
    border-color:var(--teal);
    box-shadow:0 0 0 3px rgba(20,184,196,.09);
}


/* UPLOAD */

.attachment{
    margin-top:17px;
}

.upload-box{
    min-height:118px;

    border:2px dashed #cbd5e4;
    border-radius:10px;

    background:#f8faff;

    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;

    text-align:center;
    padding:18px;

    cursor:pointer;
}

.upload-box i{
    font-size:21px;
    color:#6b7689;
    margin-bottom:7px;
}

.upload-box div{
    font-size:10.5px;
    color:#657084;
}

.upload-box span{
    color:#1459c9;
    font-weight:700;
}

.upload-box small{
    color:#9aa3b1;
    font-size:9px;
}

.upload-box input{
    display:none;
}


/* SUBMIT */

.submit-button{
    width:100%;
    border:0;
    border-radius:8px;

    background:var(--yellow);
    color:#fff;

    padding:13px;
    margin-top:17px;

    font-size:11px;
    font-weight:800;

    cursor:pointer;
    transition:.2s;
}

.submit-button:hover{
    background:#f1c700;
}


/* ALERT */

.alert{
    padding:11px 14px;
    border-radius:9px;
    margin-bottom:18px;
    font-size:11px;
}

.alert-success{
    background:#e8f8ef;
    color:#287b51;
}

.alert-error{
    background:#fff0f0;
    color:#b13a3a;
}

.alert-error ul{
    padding-left:17px;
    margin-top:5px;
}


/* =========================================================
   SIDEBAR
========================================================= */

.contact-sidebar{
    display:grid;
    gap:20px;
}

.response-box{
    background:var(--blue);
    color:#fff;

    border-radius:22px;

    padding:26px 25px;

    box-shadow:0 12px 28px rgba(20,89,217,.22);
}

.response-box h3{
    font-size:20px;
    margin-bottom:9px;
}

.response-box p{
    font-size:11.5px;
    line-height:1.6;
    color:#fff;
    opacity:.88;
    margin-bottom:20px;
}

.response-button{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;

    background:var(--yellow);
    border-radius:8px;

    padding:11px;

    font-size:10.5px;
    font-weight:800;

    color:#fff;
}

.operational-box{
    background:#fff;
    border:1px solid var(--line);
    border-radius:20px;

    padding:23px 25px;

    box-shadow:0 6px 20px rgba(18,35,63,.035);
}

.online-status{
    font-size:10.5px;
    font-weight:700;
    margin-bottom:16px;
}

.online-dot{
    display:inline-block;
    width:8px;
    height:8px;

    background:#18bd6b;
    border-radius:50%;

    margin-right:7px;
}

.operational-box h3{
    font-size:16px;
    color:#252c39;

    border-bottom:1px solid #e9edf2;

    padding-bottom:9px;
    margin-bottom:10px;
}

.operational-hour{
    display:flex;
    justify-content:space-between;
    gap:12px;

    padding:5px 0;

    font-size:10.5px;
    color:#596477;
}

.operational-hour strong{
    color:#394357;
}

.closed{
    color:#e34e55!important;
}


/* =========================================================
   MAP
========================================================= */

.location-section{
    background:#fff;
    padding:58px 0 70px;
}

.map-wrapper{
    height:470px;

    border-radius:20px;
    overflow:hidden;

    position:relative;

    border:1px solid var(--line);

    box-shadow:0 10px 30px rgba(18,35,63,.08);
}

.map-wrapper iframe{
    width:100%;
    height:100%;
    border:0;
}

.map-info{
    position:absolute;

    top:24px;
    left:24px;

    width:255px;

    background:#fff;
    border-radius:12px;

    padding:18px;

    box-shadow:0 8px 25px rgba(18,35,63,.14);
}

.map-info h3{
    font-size:15px;
    color:#172033;
    margin-bottom:5px;
}

.map-info p{
    font-size:10px;
    color:#687386;
    line-height:1.55;
    margin-bottom:12px;
}

.map-info a{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:7px;

    background:#1459d9;
    color:#fff;

    padding:9px;

    border-radius:6px;

    font-size:9.5px;
    font-weight:700;
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
    max-width:310px;
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

    .contact-cards{
        grid-template-columns:1fr 1fr;
    }
}

@media(max-width:900px){

    .contact-hero-grid{
        grid-template-columns:1fr;
    }

    .contact-hero-content{
        padding:50px 24px 35px;
    }

    .contact-hero h1{
        font-size:38px;
    }

    .contact-hero-image{
        height:360px;
        border-radius:20px;
        margin:0 24px 45px;
    }

    .contact-form-layout{
        grid-template-columns:1fr;
    }

    .footer-grid{
        grid-template-columns:1fr 1fr;
    }
}

@media(max-width:700px){

    .container{
        padding:0 16px;
    }

    .nav-inner{
        padding:12px 16px;
    }

    .brand{
        font-size:14px;
    }

    .contact-hero-content{
        padding:42px 16px 30px;
    }

    .contact-hero h1{
        font-size:34px;
    }

    .contact-hero p{
        font-size:14px;
    }

    .contact-hero-image{
        height:300px;
        margin:0 16px 35px;
    }

    .contact-info{
        padding-top:8px;
    }

    .contact-cards{
        grid-template-columns:1fr;
    }

    .contact-grid{
        grid-template-columns:1fr;
        gap:14px;
    }

    .contact-field.full{
        grid-column:auto;
    }

    .contact-form-card{
        padding:23px 18px;
    }

    .map-wrapper{
        height:360px;
    }

    .map-info{
        top:15px;
        left:15px;
        width:220px;
    }

    .footer-grid{
        grid-template-columns:1fr;
        gap:28px;
    }
}

</style>


</head>


<body>




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

            <a href="{{ url('/testimoni') }}">
                Testimoni
            </a>

            <a href="{{ url('/contact') }}" class="active">
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



<!-- =========================================================
     HERO CONTACT
========================================================= -->

<header class="contact-hero">

    <div class="container contact-hero-grid">


        <div class="contact-hero-content">

            <h1>
                Mari Wujudkan
                <br>
                <span class="accent">
                    Solusi Bersama
                </span>
            </h1>


            <p>
                Tim PT Eintio Academic &amp; Technology siap mendengarkan
                kebutuhan Anda dan merancang solusi digital yang memadukan
                inovasi teknologi dengan kedalaman riset akademik.
            </p>


            <div class="contact-benefits">

                <div class="contact-benefit">

                    <div class="contact-benefit-icon">
                        <i class="fa-solid fa-bolt"></i>
                    </div>

                    <span>
                        Respon Cepat
                    </span>

                </div>


                <div class="contact-benefit">

                    <div class="contact-benefit-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <span>
                        Tim Profesional
                    </span>

                </div>


                <div class="contact-benefit">

                    <div class="contact-benefit-icon">
                        <i class="fa-solid fa-gears"></i>
                    </div>

                    <span>
                        Solusi Sesuai Kebutuhan
                    </span>

                </div>

            </div>

        </div>


        <div class="contact-hero-image">

            <img
                src="{{ asset('assets/kj.png') }}"
                alt="Tim PT Eintio Academic & Technology"
            >

        </div>

    </div>

</header>



<!-- =========================================================
     CONTACT CARDS
========================================================= -->

<section class="contact-info">

    <div class="container">


        <div class="section-heading">

            <h2>
                Hubungi Eintio
            </h2>

            <p>
                Pilih jalur komunikasi yang paling nyaman bagi Anda.
                Kami berkomitmen untuk memberikan respon tercepat.
            </p>

        </div>


        <div class="contact-cards">


            <!-- ALAMAT -->

            <div class="contact-card">

                <div class="contact-card-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <h3>
                    Alamat
                </h3>

                <p>
                    Jl. Diponegoro No. 123,
                    <br>
                    Sidorejo, Salatiga,
                    <br>
                    Jawa Tengah 50700
                </p>

                <a
                    class="contact-card-link"
                    href="#lokasi"
                >
                    Lihat Lokasi →
                </a>

            </div>


            <!-- WHATSAPP -->

            <div class="contact-card">

                <div class="contact-card-icon">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>

                <h3>
                    WhatsApp
                </h3>

                <p>
                    +62 812-3456-7890
                    <br>
                    Senin - Jumat
                    <br>
                    (09:00 - 17:00)
                </p>

                <a
                    class="contact-card-link"
                    href="https://wa.me/6281234567890"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Chat Sekarang →
                </a>

            </div>


            <!-- EMAIL -->

            <div class="contact-card">

                <div class="contact-card-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <h3>
                    Email
                </h3>

                <p>
                    contact@eintio.co.id
                    <br>
                    support@eintio.co.id
                </p>

                <a
                    class="contact-card-link"
                    href="mailto:contact@eintio.co.id"
                >
                    Kirim Email →
                </a>

            </div>


            <!-- INSTAGRAM -->

            <div class="contact-card">

                <div class="contact-card-icon">
                    <i class="fa-brands fa-instagram"></i>
                </div>

                <h3>
                    Instagram
                </h3>

                <p>
                    @eintio.technology
                    <br>
                    Ikuti update terbaru kami.
                </p>

                <a
                    class="contact-card-link"
                    href="https://www.instagram.com/eintio.id"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Kunjungi Profil →
                </a>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     FORM
========================================================= -->

<section class="contact-form-section">

    <div class="container">

        <div class="contact-form-layout">


            <!-- FORM CARD -->

            <div class="contact-form-card">

                <h2>
                    Ceritakan Kebutuhan Anda
                </h2>


                @if(session('success'))

                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>

                @endif


                @if($errors->any())

                    <div class="alert alert-error">

                        <strong>
                            Mohon periksa kembali:
                        </strong>

                        <ul>

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ $contactAction ?? url('/contact') }}"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="contact-grid">


                        <!-- NAMA -->

                        <div class="contact-field">

                            <label>
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama Anda"
                                required
                            >

                        </div>


                        <!-- EMAIL -->

                        <div class="contact-field">

                            <label>
                                Email Perusahaan
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="email@perusahaan.com"
                                required
                            >

                        </div>


                        <!-- WHATSAPP -->

                        <div class="contact-field">

                            <label>
                                Nomor WhatsApp
                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="+62 8xx xxxx xxxx"
                            >

                        </div>


                        <!-- ORGANISASI -->

                        <div class="contact-field">

                            <label>
                                Nama Perusahaan / Instansi
                            </label>

                            <input
                                type="text"
                                name="organization"
                                value="{{ old('organization') }}"
                                placeholder="PT Contoh Indo"
                            >

                        </div>


                        <!-- SERVICE -->

                        <div class="contact-field">

                            <label>
                                Jenis Layanan yang Dibutuhkan
                            </label>

                            <select name="service">

                                <option value="">
                                    Pilih layanan
                                </option>

                                <option value="Web Development">
                                    Web Development
                                </option>

                                <option value="Mobile Apps">
                                    Mobile Apps
                                </option>

                                <option value="Analisis Data Riset">
                                    Analisis Data Riset
                                </option>

                                <option value="Bimbingan Akademik">
                                    Bimbingan Akademik
                                </option>

                                <option value="Digital Transformation">
                                    Digital Transformation
                                </option>

                                <option value="Lainnya">
                                    Lainnya
                                </option>

                            </select>

                        </div>


                        <!-- TIMELINE -->

                        <div class="contact-field">

                            <label>
                                Estimasi Timeline
                            </label>

                            <select name="timeline">

                                <option value="">
                                    Pilih estimasi
                                </option>

                                <option value="< 1 Bulan">
                                    &lt; 1 Bulan
                                </option>

                                <option value="1 - 3 Bulan">
                                    1 - 3 Bulan
                                </option>

                                <option value="3 - 6 Bulan">
                                    3 - 6 Bulan
                                </option>

                                <option value="> 6 Bulan">
                                    &gt; 6 Bulan
                                </option>

                            </select>

                        </div>


                        <!-- MESSAGE -->

                        <div class="contact-field full">

                            <label>
                                Pesan / Detail Kebutuhan
                            </label>

                            <textarea
                                name="message"
                                placeholder="Jelaskan secara singkat mengenai masalah atau kebutuhan sistem Anda..."
                                required
                            >{{ old('message') }}</textarea>

                        </div>


                    </div>


                    <!-- ATTACHMENT -->

                    <div class="attachment">

                        <div class="contact-field">

                            <label>
                                Lampiran (Opsional)
                            </label>


                            <label
                                class="upload-box"
                                for="attachment"
                            >

                                <i class="fa-regular fa-file-lines"></i>

                                <div id="uploadText">

                                    Drag and drop file di sini,
                                    atau
                                    <span>
                                        Pilih File
                                    </span>

                                </div>

                                <small>
                                    Maksimal 10MB (PDF, DOCX, ZIP)
                                </small>


                                <input
                                    id="attachment"
                                    type="file"
                                    name="attachment"
                                    accept=".pdf,.doc,.docx,.zip"
                                >

                            </label>

                        </div>

                    </div>


                    <button
                        class="submit-button"
                        type="submit"
                    >
                        Kirim Pesan
                    </button>


                </form>

            </div>



            <!-- SIDEBAR -->

            <aside class="contact-sidebar">


                <!-- RESPONSE -->

                <div class="response-box">

                    <h3>
                        Need a Faster Response?
                    </h3>

                    <p>
                        Tim representatif kami siap membalas pesan
                        instan Anda selama jam kerja untuk konsultasi kilat.
                    </p>

                    <a
                        class="response-button"
                        href="https://wa.me/628112225804"
                        target="_blank"
                        rel="noopener noreferrer"
                    >

                        <i class="fa-brands fa-whatsapp"></i>

                        Hubungi via WhatsApp

                    </a>

                </div>


                <!-- OPERATIONAL -->

                <div class="operational-box">

                    <div class="online-status">

                        <span class="online-dot"></span>

                        Online pada jam operasional

                    </div>


                    <h3>
                        Jam Operasional
                    </h3>


                    <div class="operational-hour">

                        <span>
                            Senin - Jumat
                        </span>

                        <strong>
                            09:00 - 17:00 WIB
                        </strong>

                    </div>


                    <div class="operational-hour">

                        <span>
                            Sabtu
                        </span>

                        <strong>
                            09:00 - 14:00 WIB
                        </strong>

                    </div>


                    <div class="operational-hour">

                        <span>
                            Minggu &amp; Hari Libur
                        </span>

                        <strong class="closed">
                            Tutup
                        </strong>

                    </div>

                </div>


            </aside>

        </div>

    </div>

</section>



<!-- =========================================================
     LOCATION
========================================================= -->

<section
    class="location-section"
    id="lokasi"
>

    <div class="container">


        <div class="section-heading">

            <h2>
                Temukan Lokasi Kami
            </h2>

        </div>


        <div class="map-wrapper">


            <iframe
                src="https://www.google.com/maps?q=Salatiga%2C%20Jawa%20Tengah&output=embed"
                loading="lazy"
                title="Lokasi PT Eintio Academic & Technology"
            >
            </iframe>


            <div class="map-info">

                <h3>
                    Eintio Office
                </h3>

                <p>
                    Pusat Inovasi Akademik &amp; Teknologi,
                    <br>
                    Salatiga, Jawa Tengah.
                </p>


                <a
                    href="https://www.google.com/maps/search/?api=1&query=PT+Eintio+Academic+Technology+Salatiga"
                    target="_blank"
                    rel="noopener noreferrer"
                >

                    <i class="fa-solid fa-map"></i>

                    Buka Google Maps

                </a>

            </div>


        </div>

    </div>

</section>





<footer>

    <div class="container footer-grid">


        <!-- BRAND -->

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
                Menyediakan solusi digital terintegrasi dan
                pendampingan akademik profesional untuk masa depan
                bisnis dan pendidikan Indonesia yang lebih cerah.
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



        <!-- NAVIGASI -->

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



        <!-- LAYANAN -->

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



        <!-- KONTAK -->

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



<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

function toggleMenu(){

    const nav =
        document.querySelector('.nav-links');

    nav.classList.toggle('mobile-open');

}


/* FILE UPLOAD */

const attachment =
    document.getElementById('attachment');

const uploadText =
    document.getElementById('uploadText');


if(attachment){

    attachment.addEventListener(
        'change',
        function(){

            if(this.files.length){

                uploadText.innerHTML =
                    '<span>' +
                    this.files[0].name +
                    '</span>';

            }else{

                uploadText.innerHTML =
                    'Drag and drop file di sini, atau ' +
                    '<span>Pilih File</span>';

            }

        }
    );

}

</script>


</body>
</html>