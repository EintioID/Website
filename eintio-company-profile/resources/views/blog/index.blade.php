
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
          <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">

    <title>Blog — PT Eintio Academic & Technology</title>

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
            background:#fff;
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

        /* =====================================================
           NAVBAR
        ===================================================== */

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

        .menu-toggle{
            display:none;
            margin-left:auto;
            background:none;
            border:none;
            font-size:24px;
            cursor:pointer;
            color:var(--navy);
        }

        /* =====================================================
           BLOG GLOBAL
        ===================================================== */

        .blog-page{
            background:#fff;
            color:#18222d;
        }

        .blog-container{
            width:min(1200px,calc(100% - 48px));
            margin:auto;
        }

        /* =====================================================
           HERO
        ===================================================== */

        .blog-hero{
            background:#effafd;
            padding:30px 0 28px;
        }

        .blog-hero-inner{
            min-height:225px;
            display:grid;
            grid-template-columns:1fr 1fr;
            align-items:center;
            gap:42px;
        }

        .blog-eyebrow{
            display:inline-flex;
            padding:7px 13px;
            border-radius:30px;
            background:#dff7fa;
            color:#0897a7;
            font-size:10px;
            font-weight:800;
            letter-spacing:.7px;
            text-transform:uppercase;
            margin-bottom:17px;
        }

        .blog-hero h1{
            margin:0 0 12px;
            font-size:38px;
            line-height:1.05;
            letter-spacing:-1.6px;
            font-weight:800;
            color:#18222d;
        }

        .blog-hero p{
            max-width:520px;
            margin:0;
            color:#56616f;
            font-size:14px;
            line-height:1.7;
        }

        .blog-hero-image{
            width:100%;
            height:225px;
            object-fit:cover;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(24,74,90,.10);
        }

        /* =====================================================
           FILTER
        ===================================================== */

        .blog-filter-wrap{
            background:#effafd;
            padding-bottom:28px;
        }

        .blog-filter{
            background:#fff;
            border-radius:35px;
            padding:9px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
            box-shadow:0 5px 20px rgba(19,79,92,.08);
        }

        .blog-categories{
            display:flex;
            gap:7px;
            flex-wrap:wrap;
        }

        .blog-category{
            background:#f0f3fa;
            color:#5c6572;
            border-radius:25px;
            padding:9px 17px;
            font-size:11px;
            white-space:nowrap;
            transition:.2s;
        }

        .blog-category:hover,
        .blog-category.active{
            background:#0b9eae;
            color:#fff;
        }

        .blog-search{
            width:205px;
            display:flex;
            align-items:center;
            gap:8px;
            background:#f0f3fa;
            border-radius:25px;
            padding:9px 14px;
        }

        .blog-search i{
            color:#758090;
            font-size:12px;
        }

        .blog-search input{
            width:100%;
            border:0;
            outline:0;
            background:transparent;
            font-size:11px;
            color:#374151;
        }

        /* =====================================================
           SECTION
        ===================================================== */

        .blog-section{
            padding:0 0 38px;
        }

        .blog-section.soft{
            background:#f1fbfd;
            padding-top:8px;
        }

        .blog-section-title{
            width:100%;
            text-align:center;
            color:#0b9eae;
            font-size:23px;
            line-height:1.2;
            margin:0 0 19px;
            font-weight:800;
            letter-spacing:-.5px;
        }

        /* =====================================================
           FEATURED
        ===================================================== */

        .featured-card{
            display:grid;
            grid-template-columns:227px 1fr;
            min-height:245px;
            background:#fff;
            border-radius:17px;
            overflow:hidden;
            box-shadow:0 5px 20px rgba(20,50,70,.07);
        }

        .featured-side{
            background:linear-gradient(145deg,#078c9d,#129aa8);
            padding:24px;
            color:#fff;
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .featured-badge{
            width:max-content;
            background:#ffd000;
            color:#fff;
            padding:4px 8px;
            border-radius:3px;
            font-size:8px;
            font-weight:800;
            margin-bottom:15px;
        }

        .featured-side h3{
            font-size:17px;
            line-height:1.25;
            margin:0 0 14px;
            font-weight:800;
        }

        .featured-info{
            display:grid;
            gap:8px;
            font-size:9px;
            margin-bottom:17px;
        }

        .featured-info span{
            display:flex;
            align-items:center;
            gap:7px;
        }

        .featured-info i{
            font-size:11px;
        }

        .featured-btn{
            display:block;
            text-align:center;
            background:#ffd000;
            color:#fff;
            border-radius:22px;
            padding:9px;
            font-size:10px;
            font-weight:800;
            transition:.2s;
        }

        .featured-btn:hover{
            background:#ffe044;
            color:#4a4300;
        }

        .featured-content{
            display:grid;
            grid-template-columns:1fr 1fr;
            align-items:center;
            gap:20px;
            padding:20px 25px;
        }

        .featured-image{
            width:100%;
            height:125px;
            object-fit:cover;
            border-radius:8px;
        }

        .post-category{
            color:#0ca4b3;
            font-size:10px;
            margin-bottom:10px;
        }

        .featured-content h3{
            font-size:17px;
            line-height:1.35;
            margin:0 0 9px;
        }

        .featured-content p{
            color:#667180;
            font-size:10px;
            line-height:1.65;
            margin:0 0 14px;
        }

        .read-more{
            color:#08a1b1;
            font-size:10px;
            font-weight:600;
        }

        .read-more:hover{
            color:#067f8c;
        }

        /* =====================================================
           LATEST ARTICLES
        ===================================================== */

        .latest-head{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:19px;
        }

        .latest-head .blog-section-title{
            margin:0;
        }

        .latest-all{
            color:#0b9eae;
            font-size:10px;
        }

        .post-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:18px;
        }

        .post-card{
            background:#fff;
            border:1px solid #edf0f3;
            border-radius:14px;
            overflow:hidden;
            color:inherit;
            box-shadow:0 4px 14px rgba(20,50,70,.04);
            transition:.2s;
        }

        .post-card:hover{
            transform:translateY(-4px);
            box-shadow:0 12px 28px rgba(20,50,70,.10);
        }

        .post-image-wrap{
            position:relative;
        }

        .post-image{
            width:100%;
            height:122px;
            object-fit:cover;
        }

        .post-tag{
            position:absolute;
            top:9px;
            left:10px;
            background:#fff;
            color:#0b9cac;
            padding:4px 7px;
            border-radius:8px;
            font-size:8px;
            font-weight:700;
            box-shadow:0 2px 8px rgba(0,0,0,.08);
        }

        .post-body{
            padding:14px;
        }

        .post-body h3{
            margin:0 0 8px;
            font-size:13px;
            line-height:1.4;
            font-weight:800;
            color:#18222d;
        }

        .post-body p{
            margin:0 0 12px;
            color:#68717e;
            font-size:9px;
            line-height:1.65;
        }

        /* =====================================================
           PAGINATION
        ===================================================== */

        .pagination{
            display:flex;
            justify-content:center;
            gap:7px;
            margin-top:25px;
        }

        .page-link{
            min-width:34px;
            height:34px;
            padding:0 10px;
            border:1px solid #e5eaee;
            border-radius:9px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#667180;
            font-size:10px;
            background:#fff;
        }

        .page-link.active,
        .page-link:hover{
            background:#0b9eae;
            border-color:#0b9eae;
            color:#fff;
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .blog-empty{
            grid-column:1/-1;
            padding:40px;
            text-align:center;
            color:#77818d;
            background:#fff;
            border:1px solid #edf0f3;
            border-radius:14px;
        }

        /* =====================================================
           KNOWLEDGE
        ===================================================== */

        .knowledge-section{
            background:#effbfd;
            padding:29px 0 75px;
        }

        .knowledge-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:18px;
        }

        .knowledge-card{
            background:#fff;
            border:1px solid #e9eef1;
            border-radius:13px;
            padding:17px;
            text-align:center;
            min-height:108px;
        }

        .knowledge-icon{
            width:39px;
            height:39px;
            margin:0 auto 10px;
            border-radius:50%;
            background:#edfafc;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#08a6b6;
            font-size:16px;
        }

        .knowledge-card h3{
            font-size:12px;
            margin:0 0 5px;
            color:#18222d;
        }

        .knowledge-card p{
            font-size:8px;
            color:#68717e;
            margin:0;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

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

        /* =====================================================
           RESPONSIVE
        ===================================================== */

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

            .footer-grid{
                grid-template-columns:1fr 1fr;
            }
        }

        @media(max-width:900px){

            .blog-hero-inner{
                grid-template-columns:1fr;
                gap:25px;
            }

            .blog-hero-image{
                height:210px;
            }

            .featured-content{
                grid-template-columns:1fr;
            }

            .post-grid{
                grid-template-columns:repeat(2,1fr);
            }

            .knowledge-grid{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:640px){

            .container{
                padding:0 18px;
            }

            .blog-container{
                width:min(100% - 28px,1200px);
            }

            .blog-hero{
                padding-top:20px;
            }

            .blog-hero h1{
                font-size:31px;
            }

            .blog-filter{
                border-radius:18px;
                align-items:stretch;
                flex-direction:column;
            }

            .blog-search{
                width:100%;
            }

            .blog-categories{
                overflow:auto;
                flex-wrap:nowrap;
                padding-bottom:2px;
            }

            .featured-card{
                grid-template-columns:1fr;
            }

            .featured-content{
                padding:17px;
            }

            .post-grid,
            .knowledge-grid{
                grid-template-columns:1fr;
            }

            .latest-head{
                align-items:end;
            }

            .footer-grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>

<body>

{{-- =====================================================
     NAVBAR
===================================================== --}}

<nav class="navbar">
    <div class="nav-inner">

        <a href="{{ url('/') }}" class="brand">
            <img
                src="{{ asset('images/ikon.png') }}"
                alt="Eintio Logo"
                class="logo-img"
            >

            <span>PT Eintio Academic &amp; Technology</span>
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

            <a href="{{ url('/blog') }}" class="active">
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


<div class="blog-page">

{{-- =====================================================
     HERO
===================================================== --}}

<section class="blog-hero">

    <div class="blog-container blog-hero-inner">

        <div>

            <span class="blog-eyebrow">
                Insight &amp; Knowledge
            </span>

            <h1>
                Insight &amp; Knowledge
            </h1>

            <p>
                Jelajahi pemikiran terbaru, panduan teknis, dan tren industri
                seputar teknologi, bisnis, dan akademik untuk membantu Anda
                terus relevan di era digital.
            </p>

        </div>

        <img
            class="blog-hero-image"
            src="{{ asset('assets/bl.png') }}"
            alt="Insight & Knowledge"
        >

    </div>

</section>


{{-- =====================================================
     FILTER KATEGORI
===================================================== --}}

<section class="blog-filter-wrap">

    <div class="blog-container">

        <div class="blog-filter">

            <div class="blog-categories">

                {{-- SEMUA --}}

                <a
                    href="{{ url('/blog') }}"
                    class="blog-category {{ !request('category') ? 'active' : '' }}"
                >
                    Semua
                </a>


                {{-- KATEGORI DARI DATABASE --}}

                @foreach($categories ?? [] as $category)

                    <a
                        href="{{ url('/blog?category=' . $category->slug) }}"
                        class="blog-category {{ request('category') == $category->slug ? 'active' : '' }}"
                    >
                        {{ $category->name }}
                    </a>

                @endforeach

            </div>


            {{-- SEARCH --}}

            <form
                class="blog-search"
                action="{{ url('/blog') }}"
                method="GET"
            >

                @if(request('category'))

                    <input
                        type="hidden"
                        name="category"
                        value="{{ request('category') }}"
                    >

                @endif

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari artikel..."
                >

            </form>

        </div>

    </div>

</section>


{{-- =====================================================
     FEATURED ARTICLE
===================================================== --}}

<section class="blog-section">

    <div class="blog-container">

        <h2 class="blog-section-title">
            Artikel Unggulan
        </h2>


        @if($featuredPost)

            <article class="featured-card">

                <div class="featured-side">

                    <span class="featured-badge">
                        ARTIKEL UNGGULAN
                    </span>


                    <h3>
                        {{ $featuredPost->title }}
                    </h3>


                    <div class="featured-info">

                        @if($featuredPost->published_at)

                            <span>

                                <i class="fa-regular fa-calendar"></i>

                                {{ \Carbon\Carbon::parse($featuredPost->published_at)->translatedFormat('d F Y') }}

                            </span>

                        @endif


                        @if($featuredPost->author)

                            <span>

                                <i class="fa-regular fa-user"></i>

                                {{ $featuredPost->author->name }}

                            </span>

                        @endif

                    </div>


                    <a
                        class="featured-btn"
                        href="{{ url('/blog/' . $featuredPost->slug) }}"
                    >
                        Baca Artikel
                    </a>

                </div>


                <div class="featured-content">

                    <img
                        class="featured-image"
                        src="{{ $featuredPost->thumbnail
                            ? \Illuminate\Support\Facades\Storage::url($featuredPost->thumbnail)
                            : asset('images/blog/default.jpg') }}"
                        alt="{{ $featuredPost->title }}"
                    >


                    <div>

                        <div class="post-category">

                            {{ $featuredPost->category?->name ?? 'Insight' }}

                        </div>


                        <h3>
                            {{ $featuredPost->title }}
                        </h3>


                        <p>
                            {{ $featuredPost->excerpt }}
                        </p>


                        <a
                            class="read-more"
                            href="{{ url('/blog/' . $featuredPost->slug) }}"
                        >
                            Baca Artikel Lengkap →
                        </a>

                    </div>

                </div>

            </article>

        @else

            <div class="blog-empty">

                Belum ada artikel unggulan.

            </div>

        @endif

    </div>

</section>


{{-- =====================================================
     ARTIKEL TERBARU
===================================================== --}}

<section class="blog-section soft">

    <div class="blog-container">

        <div class="latest-head">

            <h2 class="blog-section-title">
                Artikel Terbaru
            </h2>

            <a
                href="{{ url('/blog') }}"
                class="latest-all"
            >
                Lihat Semua
            </a>

        </div>


        <div class="post-grid">

            @forelse($blogPosts as $post)

                <a
                    class="post-card"
                    href="{{ url('/blog/' . $post->slug) }}"
                >

                    <div class="post-image-wrap">

                        <img
                            class="post-image"
                            src="{{ $post->thumbnail
                                ? \Illuminate\Support\Facades\Storage::url($post->thumbnail)
                                : asset('images/blog/default.jpg') }}"
                            alt="{{ $post->title }}"
                        >


                        <span class="post-tag">

                            {{ $post->category?->name ?? 'Insight' }}

                        </span>

                    </div>


                    <div class="post-body">

                        <h3>
                            {{ $post->title }}
                        </h3>


                        <p>
                            {{ \Illuminate\Support\Str::limit($post->excerpt, 115) }}
                        </p>


                        <span class="read-more">
                            Baca Artikel →
                        </span>

                    </div>

                </a>

            @empty

                <div class="blog-empty">

                    Belum ada artikel yang dipublikasikan.

                </div>

            @endforelse

        </div>


        {{-- PAGINATION --}}

        @if($blogPosts->hasPages())

            <div class="pagination">

                @if($blogPosts->onFirstPage())

                    <span class="page-link">
                        ‹
                    </span>

                @else

                    <a
                        class="page-link"
                        href="{{ $blogPosts->previousPageUrl() }}"
                    >
                        ‹
                    </a>

                @endif


                @foreach(
                    $blogPosts->getUrlRange(
                        1,
                        $blogPosts->lastPage()
                    ) as $page => $url
                )

                    <a
                        class="page-link {{ $page == $blogPosts->currentPage() ? 'active' : '' }}"
                        href="{{ $url }}"
                    >
                        {{ $page }}
                    </a>

                @endforeach


                @if($blogPosts->hasMorePages())

                    <a
                        class="page-link"
                        href="{{ $blogPosts->nextPageUrl() }}"
                    >
                        ›
                    </a>

                @else

                    <span class="page-link">
                        ›
                    </span>

                @endif

            </div>

        @endif

    </div>

</section>


{{-- =====================================================
     EXPLORE KNOWLEDGE
===================================================== --}}

<section class="knowledge-section">

    <div class="blog-container">

        <h2 class="blog-section-title">
            Explore Our Knowledge
        </h2>


        <div class="knowledge-grid">

            @forelse($categories ?? [] as $category)

                <a
                    href="{{ url('/blog?category=' . $category->slug) }}"
                    class="knowledge-card"
                >

                    <div class="knowledge-icon">

                        @php
                            $icon = match(strtolower($category->name)) {
                                'technology' => 'fa-microchip',
                                'business' => 'fa-arrow-trend-up',
                                'education' => 'fa-graduation-cap',
                                'academic' => 'fa-book-open',
                                default => 'fa-folder-open'
                            };
                        @endphp

                        <i class="fa-solid {{ $icon }}"></i>

                    </div>


                    <h3>
                        {{ $category->name }}
                    </h3>


                    <p>
                        {{ $category->description ?? 'Artikel dan wawasan terbaru.' }}
                    </p>

                </a>

            @empty

                <div class="blog-empty">

                    Belum ada kategori.

                </div>

            @endforelse

        </div>

    </div>

</section>

</div>


{{-- =====================================================
     FOOTER
===================================================== --}}

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
                Menyediakan solusi digital terintegrasi dan pendampingan
                akademik profesional untuk masa depan bisnis dan pendidikan
                Indonesia yang lebih cerah.
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
                    <a href="{{ url('/') }}">
                        Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ url('/profil') }}">
                        Profil
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

            <h5>Layanan</h5>

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

            <h5>Kontak</h5>

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

        © {{ date('Y') }}
        PT Eintio Academic &amp; Technology.
        All rights reserved.

    </div>

</footer>


<script>

function toggleMenu(){

    const nav = document.querySelector('.nav-links');

    nav.classList.toggle('mobile-open');

}

</script>

</body>
</html>

