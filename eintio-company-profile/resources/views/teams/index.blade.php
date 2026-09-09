<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
          <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">

    <title>Tim — PT Eintio Academic &amp; Technology</title>

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

    button{
        font-family:inherit;
    }

    /* =========================================================
       CONTAINER
    ========================================================= */

    .container{
        max-width:1200px;
        margin:0 auto;
        padding:0 24px;
    }


    /* =========================================================
       NAVBAR
    ========================================================= */

    .navbar{
        background:#fff;
        box-shadow:0 2px 12px rgba(18,35,63,.06);
        position:sticky;
        top:0;
        z-index:1000;
    }

    .nav-inner{
        display:flex;
        align-items:center;
        gap:32px;
        padding:14px 24px;
        max-width:1300px;
        margin:0 auto;
        position:relative;
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

    .menu-toggle{
        display:none;
        margin-left:auto;
        background:none;
        border:none;
        font-size:24px;
        cursor:pointer;
        color:var(--navy);
    }


    /* =========================================================
       HERO
    ========================================================= */

    .hero{
        padding:64px 0 72px;
    }

    .hero-grid{
        display:grid;
        grid-template-columns:1.05fr 1fr;
        gap:48px;
        align-items:center;
    }

    .badge{
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:#e6f7f9;
        color:var(--teal-dark);
        border:1px solid #bdeef2;
        padding:6px 18px;
        border-radius:50px;
        font-size:12px;
        font-weight:700;
        letter-spacing:1px;
        text-transform:uppercase;
        margin-bottom:22px;
    }

    .hero h1{
        font-size:46px;
        line-height:1.18;
        color:var(--navy);
        font-weight:800;
        margin-bottom:20px;
    }

    .hero h1 .accent{
        color:var(--teal);
    }

    .hero p{
        font-size:16.5px;
        color:var(--muted);
        max-width:500px;
        margin-bottom:32px;
    }

    .hero-btns{
        display:flex;
        gap:14px;
        flex-wrap:wrap;
    }

    .btn-primary{
        background:var(--teal);
        color:#fff;
        padding:12px 22px;
        border-radius:50px;
        font-weight:700;
        font-size:14px;
        display:inline-flex;
        align-items:center;
        gap:9px;
        transition:.2s;
    }

    .btn-primary:hover{
        background:var(--teal-dark);
        transform:translateY(-2px);
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
        transition:.2s;
    }

    .btn-outline:hover{
        border-color:var(--teal);
        color:var(--teal);
    }

    .hero-visual{
        position:relative;
    }

    .hero-img{
        height:390px;
        border-radius:24px;
        overflow:hidden;
        box-shadow:0 20px 50px rgba(18,35,63,.15);
    }

    .hero-img img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .hero-quote{
        position:absolute;
        left:-25px;
        bottom:-25px;
        width:250px;
        padding:20px 22px;
        border-radius:16px;
        background:#fff;
        box-shadow:0 15px 40px rgba(18,35,63,.13);
        font-size:12px;
        line-height:1.55;
        color:var(--ink);
    }

    .hero-quote strong{
        display:block;
        color:var(--yellow);
        font-size:30px;
        line-height:.8;
        margin-bottom:7px;
    }

    .hero-quote b{
        font-weight:700;
    }


    /* =========================================================
       VALUES
    ========================================================= */

    .values{
        padding:0 0 20px;
    }

    .values-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
    }

    .value-card{
        background:#fff;
        border-radius:var(--radius);
        box-shadow:0 8px 30px rgba(18,35,63,.06);
        padding:25px 24px;
        border:1px solid #edf1f6;
    }

    .value-icon{
        width:46px;
        height:46px;
        border-radius:12px;
        background:#e6f7f9;
        color:var(--teal-dark);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:18px;
        margin-bottom:16px;
    }

    .value-card h4{
        color:var(--navy);
        font-size:15px;
        margin-bottom:7px;
    }

    .value-card p{
        color:var(--muted);
        font-size:12.5px;
        line-height:1.55;
    }


    /* =========================================================
       TEAM
    ========================================================= */

    .team-section{
        padding:72px 0;
        background:var(--bg);
    }

    .section-heading{
        text-align:center;
        margin-bottom:25px;
    }

    .section-heading h2{
        font-size:32px;
        color:var(--teal);
        font-weight:800;
        margin-bottom:6px;
    }

    .section-heading p{
        font-size:14px;
        color:var(--muted);
    }

    .team-filter{
        display:flex;
        justify-content:center;
        gap:8px;
        flex-wrap:wrap;
        margin-bottom:36px;
    }

    .filter-btn{
        border:none;
        background:#e4eaf2;
        color:#68758a;
        border-radius:50px;
        padding:8px 18px;
        font-size:12px;
        font-weight:700;
        cursor:pointer;
        transition:.2s;
    }

    .filter-btn:hover,
    .filter-btn.active{
        background:var(--teal);
        color:#fff;
    }

    .team-grid{
        display:grid;
        grid-template-columns:repeat(3,1fr);
        gap:24px;
    }

    .team-card{
        background:#fff;
        border:1px solid #e7ebf0;
        border-radius:var(--radius);
        overflow:hidden;
        box-shadow:0 8px 30px rgba(18,35,63,.06);
        transition:.25s;
    }

    .team-card:hover{
        transform:translateY(-6px);
        box-shadow:0 15px 35px rgba(18,35,63,.11);
    }

    .team-card.hidden{
        display:none;
    }

    .team-image{
        height:300px;
        position:relative;
        overflow:hidden;
        background:#edf2f7;
    }

    .team-image img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition:.4s;
    }

    .team-card:hover .team-image img{
        transform:scale(1.04);
    }

    .team-category{
        position:absolute;
        top:15px;
        right:15px;
        padding:6px 12px;
        border-radius:50px;
        background:var(--yellow);
        color:#554d00;
        font-size:10px;
        font-weight:800;
        box-shadow:0 4px 10px rgba(0,0,0,.08);
    }

    .team-body{
        padding:20px 20px 21px;
    }

    .team-body h3{
        font-size:17px;
        color:var(--navy);
        margin-bottom:3px;
        font-weight:800;
    }

    .team-position{
        font-size:12px;
        color:var(--muted);
        margin-bottom:14px;
    }

    .team-links{
        display:flex;
        gap:8px;
    }

    .team-links a{
        width:32px;
        height:32px;
        border-radius:9px;
        background:#eefafb;
        color:var(--teal);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:13px;
        transition:.2s;
    }

    .team-links a:hover{
        background:var(--teal);
        color:#fff;
    }


    /* =========================================================
       CULTURE
    ========================================================= */

    .culture{
        background:#1098a6;
        color:#fff;
        padding:72px 0;
    }

    .culture-heading{
        text-align:center;
        margin-bottom:42px;
    }

    .culture-heading h2{
        font-size:32px;
        font-weight:800;
        margin-bottom:7px;
    }

    .culture-heading p{
        font-size:14px;
        color:rgba(255,255,255,.88);
        max-width:600px;
        margin:auto;
    }

    .culture-grid{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
    }

    .culture-card{
        background:rgba(255,255,255,.09);
        border:1px solid rgba(255,255,255,.14);
        border-radius:16px;
        padding:26px 23px;
        min-height:190px;
        transition:.25s;
    }

    .culture-card:hover{
        background:rgba(255,255,255,.14);
        transform:translateY(-4px);
    }

    .culture-icon{
        width:48px;
        height:48px;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(255,212,0,.14);
        color:var(--yellow);
        margin-bottom:18px;
        font-size:17px;
    }

    .culture-card h4{
        font-size:16px;
        margin-bottom:8px;
    }

    .culture-card p{
        font-size:12px;
        color:rgba(255,255,255,.80);
        line-height:1.6;
    }


    /* =========================================================
       WORKFLOW
    ========================================================= */

    .workflow{
        background:#fff;
        padding:72px 0;
    }

    .workflow-heading{
        text-align:center;
        margin-bottom:55px;
    }

    .workflow-heading h2{
        font-size:32px;
        color:var(--teal);
        font-weight:800;
        margin-bottom:7px;
    }

    .workflow-heading p{
        font-size:14px;
        color:var(--muted);
        max-width:650px;
        margin:auto;
    }

    .workflow-line{
        display:grid;
        grid-template-columns:repeat(4,1fr);
        position:relative;
    }

    .workflow-line::before{
        content:"";
        position:absolute;
        left:10%;
        right:10%;
        top:27px;
        height:2px;
        background:#dbe4ec;
    }

    .workflow-item{
        position:relative;
        text-align:center;
        z-index:1;
        padding:0 15px;
    }

    .workflow-icon{
        width:55px;
        height:55px;
        margin:0 auto 18px;
        border-radius:50%;
        background:#fff;
        border:1px solid #e1e8ef;
        box-shadow:0 6px 18px rgba(18,35,63,.08);
        display:flex;
        align-items:center;
        justify-content:center;
        color:var(--teal);
        font-size:17px;
    }

    .workflow-item:nth-child(3) .workflow-icon{
        background:var(--teal);
        color:#fff;
        border-color:var(--teal);
    }

    .workflow-item h4{
        font-size:14px;
        color:var(--navy);
        margin-bottom:7px;
    }

    .workflow-item p{
        max-width:200px;
        margin:auto;
        font-size:11.5px;
        line-height:1.55;
        color:var(--muted);
    }


    /* =========================================================
       FOOTER
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

    .footer-brand .logo-img{
        width:30px;
        height:30px;
    }

    .footer-grid p{
        font-size:13.5px;
        color:var(--muted);
        max-width:350px;
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
       TABLET
    ========================================================= */

    @media(max-width:1100px){

        .nav-links{
            gap:18px;
            font-size:13px;
        }

        .nav-inner{
            gap:20px;
        }

        .hero-grid{
            gap:35px;
        }

        .hero h1{
            font-size:40px;
        }

        .team-image{
            height:280px;
        }

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

        .values-grid{
            grid-template-columns:1fr 1fr;
        }

        .culture-grid{
            grid-template-columns:1fr 1fr;
        }

        .team-grid{
            grid-template-columns:repeat(2,1fr);
        }

        .footer-grid{
            grid-template-columns:1fr 1fr;
        }

    }


    /* =========================================================
       MOBILE / TABLET
    ========================================================= */

    @media(max-width:900px){

        .hero{
            padding:48px 0 70px;
        }

        .hero-grid{
            grid-template-columns:1fr;
        }

        .hero h1{
            font-size:38px;
        }

        .hero p{
            font-size:15px;
        }

        .hero-img{
            height:350px;
        }

        .hero-quote{
            left:20px;
        }

        .workflow-line{
            grid-template-columns:1fr 1fr;
            gap:45px 20px;
        }

        .workflow-line::before{
            display:none;
        }

    }


    @media(max-width:650px){

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
            width:27px;
            height:27px;
        }

        .hero{
            padding:40px 0 60px;
        }

        .hero h1{
            font-size:34px;
        }

        .hero p{
            font-size:14.5px;
        }

        .hero-img{
            height:300px;
            border-radius:18px;
        }

        .hero-quote{
            position:relative;
            left:auto;
            bottom:auto;
            width:calc(100% - 30px);
            margin:-35px auto 0;
            z-index:2;
        }

        .values{
            padding-bottom:10px;
        }

        .values-grid{
            grid-template-columns:1fr;
            gap:15px;
        }

        .team-section,
        .culture,
        .workflow{
            padding:55px 0;
        }

        .section-heading h2,
        .culture-heading h2,
        .workflow-heading h2{
            font-size:27px;
        }

        .team-grid{
            grid-template-columns:1fr;
            gap:18px;
        }

        .team-image{
            height:350px;
        }

        .culture-grid{
            grid-template-columns:1fr;
        }

        .culture-card{
            min-height:auto;
        }

        .workflow-line{
            grid-template-columns:1fr;
            gap:35px;
        }

        .footer-grid{
            grid-template-columns:1fr;
            gap:30px;
        }

        footer{
            padding-top:45px;
        }

    }


    @media(max-width:420px){

        .brand span{
            font-size:13px;
        }

        .hero h1{
            font-size:30px;
        }

        .hero-img{
            height:250px;
        }

        .team-image{
            height:310px;
        }

        .hero-btns{
            flex-direction:column;
            align-items:stretch;
        }

        .btn-primary,
        .btn-outline{
            justify-content:center;
        }

    }

    </style>
</head>

<body>


<!-- =========================================================
     NAVBAR
========================================================= -->

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

            <a href="{{ url('/tim') }}" class="active">
                Tim
            </a>

            <a href="{{ url('/blog') }}">
                Blog
            </a>

            <a href="{{ url('/testimoni') }}">
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
            <i class="fa-solid fa-bars"></i>
        </button>

    </div>

</nav>



<!-- =========================================================
     HERO
========================================================= -->

<header class="hero">

    <div class="container hero-grid">

        <div>

            <span class="badge">
                <i class="fa-solid fa-users"></i>
                Tim PT Eintio
            </span>


            <h1>
                Orang-Orang di Balik
                <span class="accent">
                    Solusi Eintio
                </span>
            </h1>


            <p>
                Kami adalah kumpulan pemikir inovatif, teknologi handal,
                dan pakar akademik yang berdedikasi untuk menciptakan
                solusi digital yang tidak hanya canggih, tapi juga
                berdampak nyata.
            </p>


            <div class="hero-btns">

                <a
                    href="#team"
                    class="btn-primary"
                >
                    Lihat Tim Kami
                    <i class="fa-solid fa-arrow-right"></i>
                </a>


                <a
                    href="{{ url('/profil') }}"
                    class="btn-outline"
                >
                    Kenali Eintio
                </a>

            </div>

        </div>


        <div class="hero-visual">

            <div class="hero-img">

                <img
                    src="{{ asset('assets/ra.png') }}"
                    alt="Tim PT Eintio"
                >

            </div>


            <div class="hero-quote">

                <strong>“</strong>

                <b>
                    "Kolaborasi adalah kunci untuk menciptakan
                    solusi yang berdampak."
                </b>

            </div>

        </div>

    </div>

</header>



<!-- =========================================================
     VALUES
========================================================= -->

<section class="values">

    <div class="container values-grid">


        <div class="value-card">

            <div class="value-icon">
                <i class="fa-solid fa-users"></i>
            </div>

            <h4>
                Beragam Keahlian
            </h4>

            <p>
                Menyatukan talenta terbaik dari berbagai
                disiplin ilmu.
            </p>

        </div>



        <div class="value-card">

            <div class="value-icon">
                <i class="fa-solid fa-handshake"></i>
            </div>

            <h4>
                Kolaborasi
            </h4>

            <p>
                Sinergi erat untuk mencapai tujuan bersama
                dengan efisien.
            </p>

        </div>



        <div class="value-card">

            <div class="value-icon">
                <i class="fa-regular fa-lightbulb"></i>
            </div>

            <h4>
                Kreativitas
            </h4>

            <p>
                Pendekatan inovatif untuk memecahkan
                tantangan kompleks.
            </p>

        </div>



        <div class="value-card">

            <div class="value-icon">
                <i class="fa-regular fa-circle-check"></i>
            </div>

            <h4>
                Berorientasi Solusi
            </h4>

            <p>
                Fokus pada hasil nyata yang memberikan
                nilai tambah maksimal.
            </p>

        </div>


    </div>

</section>



<!-- =========================================================
     TEAM
========================================================= -->

<section
    class="team-section"
    id="team"
>

    <div class="container">


        <div class="section-heading">

            <h2>
                Tim Inti Eintio
            </h2>

            <p>
                Kenali orang-orang yang berada di balik
                solusi dan inovasi Eintio.
            </p>

        </div>



        <!-- FILTER DIVISI DARI DATABASE -->

        <div class="team-filter">

            <button
                class="filter-btn active"
                data-filter="all"
            >
                Semua
            </button>


            @foreach(
                $members
                    ->pluck('division')
                    ->filter()
                    ->unique('id')
                    ->sortBy('name')
                as $division
            )

                <button
                    class="filter-btn"
                    data-filter="{{ $division->id }}"
                >
                    {{ $division->name }}
                </button>

            @endforeach

        </div>



        <!-- TEAM DATA DARI DATABASE -->

        <div class="team-grid">

            @forelse($members as $member)

                <article
                    class="team-card"
                    data-category="{{ $member->division_id }}"
                >

                    <div class="team-image">

                        @if($member->photo)

                            <img
                                src="{{ asset('storage/' . $member->photo) }}"
                                alt="{{ $member->name }}"
                                loading="lazy"
                            >

                        @else

                            <img
                                src="{{ asset('images/team/default.jpg') }}"
                                alt="{{ $member->name }}"
                                loading="lazy"
                            >

                        @endif


                        <span class="team-category">
                            {{ $member->division?->name ?? 'Tim Eintio' }}
                        </span>

                    </div>


                    <div class="team-body">

                        <h3>
                            {{ $member->name }}
                        </h3>


                        <div class="team-position">
                            {{ $member->position }}
                        </div>


                        <div class="team-links">

                            @if($member->linkedin)

                                <a
                                    href="{{ $member->linkedin }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="LinkedIn {{ $member->name }}"
                                >
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </a>

                            @endif


                            @if($member->instagram)

                                <a
                                    href="{{ $member->instagram }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Instagram {{ $member->name }}"
                                >
                                    <i class="fa-brands fa-instagram"></i>
                                </a>

                            @endif


                            <a
                                href="{{ url('/contact') }}"
                                aria-label="Kontak {{ $member->name }}"
                            >
                                <i class="fa-solid fa-link"></i>
                            </a>

                        </div>

                    </div>

                </article>

            @empty

                <div style="grid-column:1/-1;text-align:center;padding:40px 20px;color:var(--muted);">

                    <i
                        class="fa-solid fa-users"
                        style="font-size:32px;margin-bottom:12px;"
                    ></i>

                    <p>
                        Belum ada anggota tim yang ditampilkan.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</section>



<!-- =========================================================
     CULTURE
========================================================= -->

<section class="culture">

    <div class="container">


        <div class="culture-heading">

            <h2>
                Budaya Kerja Kami
            </h2>

            <p>
                Kami membangun lingkungan kerja yang merangsang
                kreativitas dan mendukung keunggulan profesional.
            </p>

        </div>



        <div class="culture-grid">


            <div class="culture-card">

                <div class="culture-icon">
                    <i class="fa-solid fa-face-smile"></i>
                </div>

                <h4>
                    Kolaboratif
                </h4>

                <p>
                    Kami memecahkan masalah bersama, berbagi
                    pengetahuan, dan saling mendukung untuk
                    mencapai hasil optimal.
                </p>

            </div>



            <div class="culture-card">

                <div class="culture-icon">
                    <i class="fa-solid fa-pen"></i>
                </div>

                <h4>
                    Kreatif
                </h4>

                <p>
                    Eksplorasi ide-ide baru sangat didorong.
                    Kami tidak takut menantang status quo untuk
                    menemukan solusi inovatif.
                </p>

            </div>



            <div class="culture-card">

                <div class="culture-icon">
                    <i class="fa-regular fa-lightbulb"></i>
                </div>

                <h4>
                    Profesional
                </h4>

                <p>
                    Menjaga standar kualitas tinggi dalam setiap
                    aspek pekerjaan, dari kode hingga komunikasi
                    klien.
                </p>

            </div>



            <div class="culture-card">

                <div class="culture-icon">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>

                <h4>
                    Berdampak
                </h4>

                <p>
                    Setiap baris kode dan setiap desain bertujuan
                    untuk menciptakan nilai tambah nyata bagi
                    pengguna akhir.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     WORKFLOW
========================================================= -->

<section class="workflow">

    <div class="container">


        <div class="workflow-heading">

            <h2>
                Cara Kami Bekerja
            </h2>

            <p>
                Proses yang terstruktur untuk memastikan setiap
                proyek berjalan efisien dan memenuhi standar
                kualitas tertinggi.
            </p>

        </div>



        <div class="workflow-line">


            <div class="workflow-item">

                <div class="workflow-icon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <h4>
                    1. Understand
                </h4>

                <p>
                    Analisis mendalam terhadap kebutuhan,
                    tantangan, dan tujuan bisnis Anda.
                </p>

            </div>



            <div class="workflow-item">

                <div class="workflow-icon">
                    <i class="fa-regular fa-comments"></i>
                </div>

                <h4>
                    2. Collaborate
                </h4>

                <p>
                    Merancang strategi dan prototype bersama
                    secara iteratif untuk memastikan
                    keselarasan visi.
                </p>

            </div>



            <div class="workflow-item">

                <div class="workflow-icon">
                    <i class="fa-solid fa-code"></i>
                </div>

                <h4>
                    3. Develop
                </h4>

                <p>
                    Implementasi teknis menggunakan praktik
                    terbaik industri dan teknologi terkini.
                </p>

            </div>



            <div class="workflow-item">

                <div class="workflow-icon">
                    <i class="fa-solid fa-rocket"></i>
                </div>

                <h4>
                    4. Deliver
                </h4>

                <p>
                    Peluncuran produk yang mulus, didukung
                    onboarding dan dukungan purna jual.
                </p>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     FOOTER
========================================================= -->

<footer>

    <div class="container footer-grid">


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
                pendampingan akademik profesional untuk masa
                depan bisnis dan pendidikan Indonesia yang
                lebih cerah.
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


/* FILTER TEAM */

document
    .querySelectorAll('.filter-btn')
    .forEach(function(button){

        button.addEventListener('click', function(){

            document
                .querySelectorAll('.filter-btn')
                .forEach(function(btn){

                    btn.classList.remove('active');

                });


            this.classList.add('active');


            const filter =
                this.dataset.filter;


            document
                .querySelectorAll('.team-card')
                .forEach(function(card){

                    if(
                        filter === 'all' ||
                        card.dataset.category === filter
                    ){

                        card.classList.remove('hidden');

                    }else{

                        card.classList.add('hidden');

                    }

                });

        });

    });


/* CLOSE MOBILE MENU WHEN CLICK LINK */

document
    .querySelectorAll('.nav-links a')
    .forEach(function(link){

        link.addEventListener('click', function(){

            const nav =
                document.querySelector('.nav-links');

            nav.classList.remove('mobile-open');

        });

    });

</script>

</body>
</html>