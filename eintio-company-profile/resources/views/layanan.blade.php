<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">
    <title>Layanan — {{ $profile->company_name ?? 'PT Eintio Academic & Technology' }}</title>

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
            font-family:'Inter','Segoe UI',Arial,sans-serif;
        }

        html{scroll-behavior:smooth}

        body{
            color:var(--ink);
            background:var(--bg);
            line-height:1.6;
        }

        a{
            text-decoration:none;
            color:inherit;
        }

        img{
            display:block;
            max-width:100%;
        }

        .container{
            max-width:1200px;
            margin:0 auto;
            padding:0 24px;
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

.btn-teal .fa-chevron-right{
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
        ========================================================= */
        .hero{
            padding:64px 0 72px;
            background:#eefafd;
        }

        .hero-inner{
            max-width:1200px;
            margin:0 auto;
            padding:0 24px;
            display:grid;
            grid-template-columns:1.05fr 1fr;
            gap:48px;
            align-items:center;
        }

        .hero-content{
            padding:0;
        }

        .hero-title{
            font-size:46px;
            line-height:1.18;
            color:var(--navy);
            font-weight:800;
            letter-spacing:-1px;
            margin-bottom:20px;
        }

        .hero-desc{
            font-size:16px;
            color:var(--muted);
            max-width:480px;
            margin-bottom:32px;
            line-height:1.7;
        }

        .hero-buttons{
            display:flex;
            gap:14px;
            flex-wrap:wrap;
        }

        .btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            border-radius:50px;
            font-weight:700;
            font-size:14px;
            transition:.2s;
        }

        .btn-primary{
            background:var(--teal);
            color:#fff;
            padding:10px 22px;
            box-shadow:0 5px 14px rgba(20,184,196,.16);
        }

        .btn-primary:hover{
            background:var(--teal-dark);
        }

        .btn-secondary{
            background:#fff;
            color:var(--navy);
            border:2px solid #d7dee9;
            padding:10px 24px;
        }

        .btn-secondary:hover{
            border-color:var(--teal);
            color:var(--teal-dark);
        }

        .hero-image-wrap{
            border-radius:24px;
            overflow:hidden;
            box-shadow:0 20px 50px rgba(18,35,63,.15);
            height:360px;
            background:#edf5fa;
        }

        .hero-image{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        /* =========================================================
           SECTION
        ========================================================= */
        .service-section{
            padding:72px 0;
            background:#fff;
        }

        .section-heading{
            margin-bottom:36px;
        }

        .section-heading.right{
            text-align:right;
        }

        .section-number{
            display:flex;
            align-items:center;
            gap:12px;
            color:#c8d9ff;
            font-size:30px;
            font-weight:400;
            margin-bottom:6px;
        }

        .section-number::after{
            content:"";
            width:70px;
            height:1px;
            background:#dbe6ff;
        }

        .section-heading.right .section-number{
            justify-content:flex-end;
            color:#f7d35e;
        }

        .section-heading.right .section-number::before{
            content:"";
            width:70px;
            height:1px;
            background:#f7d35e;
        }

        .section-heading.right .section-number::after{
            display:none;
        }

        .section-title{
            font-size:30px;
            line-height:1.25;
            font-weight:800;
            color:var(--navy);
            margin-bottom:10px;
        }

        .section-heading.right .section-title{
            text-align:right;
        }

        .section-desc{
            color:var(--muted);
            font-size:15px;
            max-width:650px;
            line-height:1.7;
        }

        .section-heading.right .section-desc{
            margin-left:auto;
        }

        .blue-line{
            width:62px;
            height:3px;
            background:#246eff;
            margin-top:22px;
        }

        .yellow-line{
            width:62px;
            height:3px;
            background:#f4c900;
            margin:22px 0 0 auto;
        }

        /* =========================================================
           TECHNOLOGY CARDS
        ========================================================= */
        .service-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
        }

        .service-card{
            border:1px solid #e2edf8;
            border-radius:18px;
            padding:30px;
            background:#fff;
            box-shadow:0 8px 30px rgba(18,35,63,.06);
            min-height:520px;
            display:flex;
            flex-direction:column;
            transition:.25s;
        }

        .service-card:hover{
            transform:translateY(-5px);
            box-shadow:0 14px 35px rgba(18,35,63,.09);
        }

        .service-icon{
            width:46px;
            height:46px;
            border-radius:12px;
            background:#e6f0ff;
            color:#246eff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:21px;
            margin-bottom:20px;
        }

        .service-card h3{
            font-size:19px;
            line-height:1.35;
            font-weight:600;
            color:var(--navy);
            margin-bottom:12px;
        }

        .service-card p{
            font-size:13px;
            line-height:1.6;
            color:#7b8799;
            min-height:63px;
        }

        .card-image{
            width:100%;
            height:145px;
            object-fit:cover;
            border-radius:10px;
            margin:14px 0 16px;
            background:#edf5fa;
        }

        .feature-list{
            list-style:none;
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .feature-list li{
            display:flex;
            align-items:center;
            gap:8px;
            color:#687181;
            font-size:12px;
            line-height:1.5;
        }

        .feature-list li::before{
            content:"✓";
            width:16px;
            height:16px;
            border:1.5px solid #18c5c8;
            border-radius:50%;
            color:#00b8bc;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            font-size:9px;
            flex-shrink:0;
        }

        .card-link{
            margin-top:auto;
            padding-top:22px;
            color:#2470ee;
            font-size:13px;
            font-weight:600;
        }

        .card-link:hover{
            color:var(--teal-dark);
        }

        /* =========================================================
           ACADEMIC
        ========================================================= */
        .academic-section{
            padding:20px 0 72px;
            background:#fff;
        }

        .academic-grid{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:20px;
        }

        .academic-card{
            border:1px solid #e2edf8;
            border-radius:18px;
            overflow:hidden;
            min-height:270px;
            display:grid;
            grid-template-columns:1fr 190px;
            box-shadow:0 8px 30px rgba(18,35,63,.06);
            background:#fff;
            transition:.25s;
        }

        .academic-card:hover{
            transform:translateY(-5px);
            box-shadow:0 14px 35px rgba(18,35,63,.09);
        }

        .academic-content{
            padding:28px 30px;
            display:flex;
            flex-direction:column;
        }

        .academic-icon{
            width:46px;
            height:46px;
            border-radius:12px;
            background:#fff6d4;
            color:#d2a900;
            display:flex;
            align-items:center;
            justify-content:center;
            margin-bottom:18px;
            font-size:19px;
        }

        .academic-card h3{
            color:var(--navy);
            font-size:20px;
            font-weight:600;
            margin-bottom:10px;
        }

        .academic-card p{
            color:#7b8799;
            font-size:12px;
            line-height:1.6;
            margin-bottom:18px;
        }

        .academic-card .feature-list{
            gap:7px;
        }

        .academic-card .feature-list li{
            font-size:11.5px;
        }

        .academic-link{
            margin-top:auto;
            padding-top:18px;
            color:#ad8c00;
            font-size:13px;
            font-weight:600;
        }

        .academic-link:hover{
            color:#8e7200;
        }

        .academic-image{
            width:100%;
            height:100%;
            min-height:270px;
            object-fit:cover;
            background:#edf5fa;
        }

        /* FOOTER */
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



/* RESPONSIVE */
        ========================================================= */
        @media(max-width:1100px){
            .nav-links{
                gap:15px;
                font-size:12px;
            }

            .btn-teal{
                font-size:12px;
                padding:9px 15px;
            }
        }

        @media(max-width:900px){
            .nav-links{
                display:none;
            }

            .btn-teal{
                display:none;
            }

            .menu-toggle{
                display:block;
            }

            .hero-inner{
                grid-template-columns:1fr;
            }

            .hero-title{
                font-size:38px;
            }

            .hero-image-wrap{
                height:320px;
            }

            .service-grid{
                grid-template-columns:1fr;
            }

            .academic-grid{
                grid-template-columns:1fr;
            }

            .footer-main{
                grid-template-columns:1fr 1fr;
            }
        }

        @media(max-width:600px){
            .container,
            .hero-inner,
            .footer-main{
                padding-left:18px;
                padding-right:18px;
            }

            .hero{
                padding:42px 0 50px;
            }

            .hero-title{
                font-size:32px;
            }

            .hero-desc{
                font-size:14px;
            }

            .hero-image-wrap{
                height:240px;
            }

            .section-title{
                font-size:26px;
            }

            .service-card{
                padding:24px;
            }

            .academic-card{
                grid-template-columns:1fr;
            }

            .academic-image{
                height:220px;
                min-height:220px;
                order:-1;
            }

            .footer-main{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>

<body>

{{-- =========================================================
     NAVBAR
========================================================= --}}
<nav class="navbar">
  <div class="nav-inner">
    <a href="{{ url('/') }}" class="brand">
      <img src="{{ asset('images/ikon.png') }}" alt="Eintio Logo" class="logo-img">
      <span>PT Eintio Academic &amp; Technology</span>
    </a>
    <div class="nav-links">
      <a href="{{ url('/') }}">Beranda</a>
      <a href="{{ url('/profil') }}">Profil</a>
      <a href="{{ url('/layanan') }}" class="active">Layanan</a>
      <a href="{{ url('/portofolio') }}">Portofolio</a>
      <a href="{{ url('/tim') }}">Tim</a>
      <a href="{{ url('/blog') }}">Blog</a>
      <a href="{{ url('/testimoni') }}">Testimoni</a>
      <a href="{{ url('/contact') }}">Contact</a>
    </div>
    <a class="btn-teal nav-consult" href="https://wa.me/628112225804" target="_blank" rel="noopener noreferrer">
      <span>Konsultasi WhatsApp</span><i class="fa-solid fa-chevron-right"></i>
    </a>
    <button class="menu-toggle" type="button" aria-label="Buka menu" onclick="toggleMenu()">☰</button>
  </div>
</nav>


{{-- =========================================================
     HERO
========================================================= --}}
<section class="hero">

    <div class="hero-inner">

        <div class="hero-content">

            <h1 class="hero-title">
                Solusi Terintegrasi<br>
                untuk Bisnis dan<br>
                Pendidikan
            </h1>

            <p class="hero-desc">
                Eintio menyediakan layanan berbasis teknologi dan
                pengembangan akademik yang dirancang khusus sesuai
                kebutuhan Anda.
            </p>

            <div class="hero-buttons">

                <a href="#teknologi"
                   class="btn btn-primary">
                    <i class="fa-solid fa-code"></i> Teknologi
                </a>

                <a href="#akademik"
                   class="btn btn-secondary">
                    <i class="fa-solid fa-graduation-cap"></i> Layanan Akademik
                </a>

            </div>

        </div>

        <div class="hero-image-wrap">

            <img src="{{ asset('assets/nd.png') }}"
                 class="hero-image"
                 alt="Layanan Eintio">

        </div>

    </div>

</section>


{{-- =========================================================
     LAYANAN TEKNOLOGI
========================================================= --}}
<section class="service-section" id="teknologi">

    <div class="container">

        <div class="section-heading">

            <div class="section-number">
                01
            </div>

            <h2 class="section-title">
                Layanan Teknologi
            </h2>

            <p class="section-desc">
                Transformasi digital bisnis Anda melalui solusi teknologi
                yang handal, aman, dan scalable.
            </p>

            <div class="blue-line"></div>

        </div>


        <div class="service-grid">

            <article class="service-card">

                <div class="service-icon">
                    <i class="fa-solid fa-desktop"></i>
                </div>

                <h3>
                    Pengembangan Website &amp;<br>
                    Aplikasi
                </h3>

                <p>
                    Pembuatan website profil, e-commerce,
                    hingga aplikasi mobile kustom untuk
                    kebutuhan bisnis Anda.
                </p>

                <img src="{{ asset('assets/w.png') }}"
                     class="card-image"
                     alt="Pengembangan Website">

                <ul class="feature-list">
                    <li>UI/UX Design Premium</li>
                    <li>Web App (React/Vue)</li>
                    <li>Mobile App (Flutter/React Native)</li>
                    <li>Maintenance &amp; Support</li>
                </ul>

                <a href="#"
                   class="card-link">
                    Selengkapnya →
                </a>

            </article>


            <article class="service-card">

                <div class="service-icon">
                    <i class="fa-solid fa-server"></i>
                </div>

                <h3>
                    Sistem Informasi &amp; Digitalisasi<br>
                    Bisnis
                </h3>

                <p>
                    Digitalisasi proses operasional perusahaan
                    melalui sistem informasi yang terstruktur.
                </p>

                <img src="{{ asset('assets/s.png') }}"
                     class="card-image"
                     alt="Sistem Informasi">

                <ul class="feature-list">
                    <li>ERP Custom</li>
                    <li>Sistem Manajemen HR</li>
                    <li>Inventory Management</li>
                    <li>CRM Solutions</li>
                </ul>

                <a href="#"
                   class="card-link">
                    Selengkapnya →
                </a>

            </article>


            <article class="service-card">

                <div class="service-icon">
                    <i class="fa-solid fa-gears"></i>
                </div>

                <h3>
                    Integrasi Sistem &amp; Otomasi
                </h3>

                <p>
                    Hubungkan berbagai platform yang Anda
                    gunakan menjadi satu ekosistem yang efisien.
                </p>

                <img src="{{ asset('assets/t.png') }}"
                     class="card-image"
                     alt="Integrasi Sistem">

                <ul class="feature-list">
                    <li>API Development</li>
                    <li>Third-party Integration</li>
                    <li>Workflow Automation</li>
                    <li>Data Migration</li>
                </ul>

                <a href="#"
                   class="card-link">
                    Selengkapnya →
                </a>

            </article>

        </div>

    </div>

</section>


{{-- =========================================================
     LAYANAN AKADEMIK
========================================================= --}}
<section class="academic-section" id="akademik">

    <div class="container">

        <div class="section-heading right">

            <div class="section-number">
                02
            </div>

            <h2 class="section-title">
                Layanan Akademik
            </h2>

            <p class="section-desc">
                Meningkatkan kompetensi SDM melalui program pelatihan
                berstandar industri.
            </p>

            <div class="yellow-line"></div>

        </div>


        <div class="academic-grid">

            <article class="academic-card">

                <div class="academic-content">

                    <div class="academic-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3>
                        Pelatihan &amp; Workshop
                    </h3>

                    <p>
                        Program pelatihan intensif untuk perusahaan,
                        instansi, maupun institusi pendidikan dengan
                        materi up-to-date.
                    </p>

                    <ul class="feature-list">
                        <li>In-House Corporate Training</li>
                        <li>Digital Marketing Masterclass</li>
                        <li>Leadership di Era Digital</li>
                    </ul>

                    <a href="#"
                       class="academic-link">
                        Jadwal &amp; Silabus →
                    </a>

                </div>

                <img src="{{ asset('assets/p.png') }}"
                     class="academic-image"
                     alt="Pelatihan dan Workshop">

            </article>


            <article class="academic-card">

                <div class="academic-content">

                    <div class="academic-icon">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>

                    <h3>
                        Belajar Coding / IT
                    </h3>

                    <p>
                        Bootcamp dan kursus pemrograman dari
                        level dasar hingga mahir, dibimbing
                        langsung oleh praktisi industri.
                    </p>

                    <ul class="feature-list">
                        <li>Fullstack Web Development</li>
                        <li>Data Science &amp; Analytics</li>
                        <li>Cybersecurity Basics</li>
                    </ul>

                    <a href="#"
                       class="academic-link">
                        Lihat Program →
                    </a>

                </div>

                <img src="{{ asset('assets/l.png') }}"
                     class="academic-image"
                     alt="Belajar Coding">

            </article>

        </div>

    </div>

</section>


{{-- =========================================================
     FOOTER — TETAP SEPERTI SEBELUMNYA
========================================================= --}}
<footer><div class="container footer-grid">
  <div><div class="footer-brand"><img src="{{ asset('images/ikon.png') }}" alt="Eintio Logo" class="logo-img"><span>PT Eintio Academic &amp; Technology</span></div><p>Menyediakan solusi digital terintegrasi dan pendampingan akademik profesional untuk masa depan bisnis dan pendidikan Indonesia yang lebih cerah.</p><div class="socials"><a href="#" aria-label="Share">
        <i class="fa-solid fa-share-nodes"></i>
    </a>

    <a href="#" aria-label="Contact">
        <i class="fa-solid fa-at"></i>
    </a>

    <a href="#" aria-label="Website">
        <i class="fa-solid fa-globe"></i>
    </a></div></div>
  <div><h5>Navigasi</h5><ul><li><a href="{{ url('/') }}">Beranda</a></li><li><a href="{{ url('/layanan') }}" class="active">Layanan</a></li><li><a href="{{ url('/tim') }}">Tim</a></li><li><a href="{{ url('/blog') }}">Blog</a></li></ul></div>
  <div><h5>Layanan</h5><ul><li><a href="{{ url('/layanan') }}">Web Development</a></li><li><a href="{{ url('/layanan') }}">Mobile Apps</a></li><li><a href="{{ url('/layanan') }}">Analisis Data Riset</a></li><li><a href="{{ url('/layanan') }}">Bimbingan Akademik</a></li></ul></div>
  <div><h5>Kontak</h5><ul class="contact-list"><li><i class="fa-solid fa-location-dot ci"></i><span>Jln. Menjangan No. 25A, Salatiga, Jawa Tengah</span></li><li><i class="fa-solid fa-phone ci"></i><a href="tel:+628112225804">(+62) 8112225804</a></li><li><i class="fa-solid fa-envelope ci"></i><a href="mailto:info@eintio.co.id">info@eintio.co.id</a></li></ul></div>
</div><div class="copyright">© 2024 PT Eintio Academic &amp; Technology. All rights reserved.</div></footer>


<script>
    function toggleMenu(){document.querySelector('.nav-links').classList.toggle('mobile-open')}
    </script>

</body>
</html>
