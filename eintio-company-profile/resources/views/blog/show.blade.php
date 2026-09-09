<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
          <link rel="icon" type="image/png" href="{{ asset('images/ikon.png') }}">

    <title>{{ $blogPost->title }} — PT Eintio Academic & Technology</title>

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

/* ================= NAVBAR ================= */

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

.logo-svg{
    width:30px;
    height:30px;
}

.nav-links{
    display:flex;
    gap:26px;
    margin-left:auto;
    font-size:14.5px;
    color:var(--ink);
}

.nav-links a{
    transition:.2s;
}

.nav-links a:hover{
    color:var(--teal);
}

.nav-links a.active{
    color:var(--teal);
    font-weight:700;
}

.btn-teal{
    background:var(--teal);
    color:#fff;
    padding:10px 22px;
    border-radius:50px;
    font-weight:700;
    font-size:14px;
    border:none;
    cursor:pointer;
    display:inline-flex;
    align-items:center;
    gap:8px;
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

/* ================= HERO ================= */

.hero{
    padding:64px 0 72px;
    background:#fff;
}

.hero-grid{
    display:grid;
    grid-template-columns:1.05fr 1fr;
    gap:48px;
    align-items:center;
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
    max-width:480px;
    margin-bottom:32px;
}

.hero-img{
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(18,35,63,.15);
}

.hero-img img{
    width:100%;
    height:360px;
    object-fit:cover;
}

/* ================= VALUES ================= */

.values{
    padding:0 0 72px;
    background:#fff;
}

.values-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

.value-card{
    background:#f7fbfc;
    border-radius:var(--radius);
    padding:26px 24px;
    border:1px solid #edf2f5;
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
    font-size:15.5px;
    color:var(--navy);
    margin-bottom:6px;
}

.value-card p{
    font-size:12.5px;
    color:var(--muted);
}

/* ================= TEAM ================= */

.team-section{
    padding:72px 0;
    background:var(--bg);
}

.section-heading{
    text-align:center;
    margin-bottom:44px;
}

.section-heading h2{
    font-size:32px;
    color:var(--teal);
    font-weight:800;
    margin-bottom:8px;
}

.section-heading p{
    color:var(--muted);
    font-size:15px;
    max-width:650px;
    margin:auto;
}

/* FILTER */

.team-filter{
    display:flex;
    justify-content:center;
    gap:8px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

.filter-btn{
    border:none;
    padding:8px 18px;
    border-radius:50px;
    background:#e9edf3;
    color:#64748b;
    font-size:12px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.filter-btn:hover,
.filter-btn.active{
    background:var(--teal);
    color:#fff;
}

/* GRID */

.team-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:22px;
}

.team-card{
    background:#fff;
    border-radius:var(--radius);
    overflow:hidden;
    box-shadow:0 8px 30px rgba(18,35,63,.06);
    border:1px solid #edf0f4;
    transition:.25s;
}

.team-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(18,35,63,.1);
}

.team-image{
    position:relative;
    height:320px;
    overflow:hidden;
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
    top:14px;
    right:14px;
    padding:5px 11px;
    border-radius:50px;
    background:var(--yellow);
    color:#4b4500;
    font-size:10px;
    font-weight:800;
}

.team-body{
    padding:18px 20px 20px;
}

.team-body h3{
    color:var(--navy);
    font-size:16px;
    margin-bottom:2px;
}

.team-position{
    color:var(--muted);
    font-size:12px;
    margin-bottom:13px;
}

.team-links{
    display:flex;
    gap:10px;
}

.team-links a{
    width:27px;
    height:27px;
    border-radius:7px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#e8f8fa;
    color:var(--teal-dark);
    font-size:11px;
    transition:.2s;
}

.team-links a:hover{
    background:var(--teal);
    color:#fff;
}

/* ================= CULTURE ================= */

.culture{
    background:#1097a5;
    padding:72px 0;
    color:#fff;
}

.culture-heading{
    text-align:center;
    margin-bottom:40px;
}

.culture-heading h2{
    font-size:32px;
    font-weight:800;
    margin-bottom:8px;
}

.culture-heading p{
    color:rgba(255,255,255,.85);
    font-size:14px;
    max-width:600px;
    margin:auto;
}

.culture-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

.culture-card{
    background:rgba(255,255,255,.10);
    border:1px solid rgba(255,255,255,.15);
    border-radius:var(--radius);
    padding:26px 24px;
}

.culture-icon{
    width:44px;
    height:44px;
    border-radius:50%;
    background:rgba(255,212,0,.15);
    color:var(--yellow);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:18px;
}

.culture-card h4{
    font-size:15px;
    margin-bottom:8px;
}

.culture-card p{
    color:rgba(255,255,255,.78);
    font-size:12px;
    line-height:1.6;
}

/* ================= WORKFLOW ================= */

.workflow{
    padding:72px 0;
    background:#fff;
}

.workflow-heading{
    text-align:center;
    margin-bottom:55px;
}

.workflow-heading h2{
    font-size:32px;
    color:var(--teal);
    font-weight:800;
}

.workflow-heading p{
    font-size:14px;
    color:var(--muted);
    margin-top:7px;
}

.workflow-line{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:0;
    position:relative;
}

.workflow-line:before{
    content:"";
    position:absolute;
    top:23px;
    left:12%;
    right:12%;
    height:2px;
    background:#dce5ec;
}

.workflow-item{
    position:relative;
    text-align:center;
    z-index:1;
}

.workflow-icon{
    width:48px;
    height:48px;
    border-radius:50%;
    background:#fff;
    border:1px solid #e4eaf0;
    box-shadow:0 5px 15px rgba(18,35,63,.08);
    color:var(--teal);
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 15px;
}

.workflow-item:nth-child(3) .workflow-icon{
    background:var(--teal);
    color:#fff;
}

.workflow-item h4{
    color:var(--navy);
    font-size:14px;
    margin-bottom:7px;
}

.workflow-item p{
    color:var(--muted);
    font-size:11.5px;
    max-width:190px;
    margin:auto;
}

/* ================= CTA ================= */

.cta-wrap{
    padding:20px 0 72px;
}

.cta{
    background:linear-gradient(120deg,#0e9aa8,#14b8c4);
    border-radius:28px;
    padding:56px 60px;
    display:grid;
    grid-template-columns:1.2fr 1fr;
    gap:48px;
    align-items:center;
    overflow:hidden;
}

.cta h2{
    color:#fff;
    font-size:36px;
    font-weight:800;
    line-height:1.25;
    margin-bottom:18px;
}

.cta p{
    color:rgba(255,255,255,.9);
    font-size:15.5px;
    margin-bottom:30px;
    max-width:480px;
}

.btn-yellow{
    background:var(--yellow);
    color:var(--navy);
    padding:14px 30px;
    border-radius:50px;
    font-weight:800;
    font-size:15px;
    display:inline-flex;
    align-items:center;
    gap:10px;
    box-shadow:0 8px 24px rgba(0,0,0,.18);
}

.cta-img{
    border-radius:18px;
    overflow:hidden;
    height:260px;
    box-shadow:0 16px 40px rgba(0,0,0,.25);
}

.cta-img img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* ================= FOOTER ================= */

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
}

.contact-list li{
    display:flex;
    gap:10px;
    align-items:flex-start;
}

.contact-list .ci{
    color:var(--teal);
}

.copyright{
    text-align:center;
    font-size:12.5px;
    color:var(--muted);
    border-top:1px solid #e8edf4;
    padding:18px 24px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:1024px){

    .nav-links{
        display:none;
    }

    .menu-toggle{
        display:block;
    }

    .hero-grid{
        grid-template-columns:1fr;
    }

    .values-grid{
        grid-template-columns:1fr 1fr;
    }

    .culture-grid{
        grid-template-columns:1fr 1fr;
    }

    .footer-grid{
        grid-template-columns:1fr 1fr;
    }
}

@media(max-width:900px){

    .hero h1{
        font-size:36px;
    }

    .team-grid{
        grid-template-columns:1fr 1fr;
    }

    .workflow-line{
        grid-template-columns:1fr 1fr;
        gap:35px;
    }

    .workflow-line:before{
        display:none;
    }

    .cta{
        grid-template-columns:1fr;
        padding:40px 32px;
    }
}

@media(max-width:640px){

    .container{
        padding:0 18px;
    }

    .hero{
        padding:45px 0 55px;
    }

    .hero h1{
        font-size:32px;
    }

    .hero-img img{
        height:280px;
    }

    .values-grid,
    .team-grid,
    .culture-grid,
    .footer-grid{
        grid-template-columns:1fr;
    }

    .team-image{
        height:340px;
    }

    .workflow-line{
        grid-template-columns:1fr;
    }

    .cta h2{
        font-size:28px;
    }

    .cta-img{
        height:210px;
    }
}


/* ================= BLOG COMPONENTS ================= */


.blog-page{
    --teal:#0b9eae;
    --ink:#18222d;
    --muted:#667180;
    --soft:#effbfd;
    --yellow:#ffd000;
    background:#fff;
    color:var(--ink);
    font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
}

.blog-page *{
    box-sizing:border-box;
}

.blog-container{
    width:min(1200px,calc(100% - 48px));
    margin:auto;
}

/* =========================
   HERO
========================= */

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
    display:block;
    box-shadow:0 10px 25px rgba(24,74,90,.10);
}

/* =========================
   FILTER
========================= */

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
    text-decoration:none;
    white-space:nowrap;
    transition:.2s;
}

.blog-category:hover,
.blog-category.active{
    background:var(--teal);
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

.blog-search svg{
    width:14px;
    height:14px;
    stroke:#758090;
}

.blog-search input{
    width:100%;
    border:0;
    outline:0;
    background:transparent;
    font-size:11px;
    color:#374151;
}

/* =========================
   SECTION
========================= */

.blog-section{
    padding:0 0 38px;
}

.blog-section.soft{
    background:#f1fbfd;
    padding-top:8px;
}

.blog-section-title{
    text-align:center;
    color:var(--teal);
    font-size:23px;
    line-height:1.2;
    margin:0 0 19px;
    font-weight:800;
    letter-spacing:-.5px;
}

/* =========================
   FEATURED
========================= */

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

.featured-info svg{
    width:13px;
    height:13px;
    stroke:#fff;
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
    text-decoration:none;
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
    text-decoration:none;
    font-weight:600;
}

/* =========================
   LATEST ARTICLES
========================= */

.latest-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:19px;
}

.latest-head .blog-section-title{
    margin:0;
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
    text-decoration:none;
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
    display:block;
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
}

.post-body p{
    margin:0 0 12px;
    color:#68717e;
    font-size:9px;
    line-height:1.65;
}

/* =========================
   PAGINATION
========================= */

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
    text-decoration:none;
    color:#667180;
    font-size:10px;
    background:#fff;
}

.page-link.active,
.page-link:hover{
    background:var(--teal);
    border-color:var(--teal);
    color:#fff;
}

/* =========================
   EMPTY
========================= */

.blog-empty{
    grid-column:1/-1;
    padding:40px;
    text-align:center;
    color:#77818d;
    background:#fff;
    border:1px solid #edf0f3;
    border-radius:14px;
}

/* =========================
   WEBINAR
========================= */

.webinar-section{
    padding:27px 0 35px;
    background:#fff;
}

.webinar-subtitle{
    text-align:center;
    color:#667180;
    font-size:12px;
    margin:-5px 0 25px;
}

.webinar-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.webinar-card{
    background:#f5fcfd;
    border-radius:14px;
    padding:19px;
    box-shadow:0 6px 20px rgba(30,90,100,.05);
    position:relative;
}

.webinar-hot{
    position:absolute;
    right:0;
    top:0;
    background:#0aa5b5;
    color:#fff;
    font-size:8px;
    padding:5px 9px;
    border-radius:0 10px 0 9px;
}

.webinar-type{
    color:#0aa4b3;
    font-size:9px;
    margin-bottom:11px;
}

.webinar-card h3{
    font-size:14px;
    line-height:1.4;
    margin:0 0 12px;
}

.webinar-meta{
    display:grid;
    gap:6px;
    color:#606b78;
    font-size:9px;
    margin-bottom:16px;
}

.webinar-btn{
    display:block;
    background:#ffd000;
    color:#fff;
    text-align:center;
    padding:9px;
    border-radius:22px;
    font-size:9px;
    font-weight:800;
    text-decoration:none;
}

/* =========================
   KNOWLEDGE
========================= */

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
    font-size:18px;
}

.knowledge-card h3{
    font-size:12px;
    margin:0 0 5px;
}

.knowledge-card p{
    font-size:8px;
    color:#68717e;
    margin:0;
}

/* =========================
   RESPONSIVE
========================= */

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

    .post-grid,
    .webinar-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .knowledge-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:640px){

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
    .webinar-grid,
    .knowledge-grid{
        grid-template-columns:1fr;
    }

    .latest-head{
        align-items:end;
    }
}

    


.blog-page{
    --teal:#0b9eae;
    --ink:#18222d;
    --muted:#667180;
    --soft:#effbfd;
    --yellow:#ffd000;
    background:#fff;
    color:var(--ink);
    font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
}

.blog-page *{
    box-sizing:border-box;
}

.blog-container{
    width:min(1200px,calc(100% - 48px));
    margin:auto;
}

/* =========================
   HERO
========================= */

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
    display:block;
    box-shadow:0 10px 25px rgba(24,74,90,.10);
}

/* =========================
   FILTER
========================= */

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
    text-decoration:none;
    white-space:nowrap;
    transition:.2s;
}

.blog-category:hover,
.blog-category.active{
    background:var(--teal);
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

.blog-search svg{
    width:14px;
    height:14px;
    stroke:#758090;
}

.blog-search input{
    width:100%;
    border:0;
    outline:0;
    background:transparent;
    font-size:11px;
    color:#374151;
}

/* =========================
   SECTION
========================= */

.blog-section{
    padding:0 0 38px;
}

.blog-section.soft{
    background:#f1fbfd;
    padding-top:8px;
}

.blog-section-title{
    text-align:center;
    color:var(--teal);
    font-size:23px;
    line-height:1.2;
    margin:0 0 19px;
    font-weight:800;
    letter-spacing:-.5px;
}

/* =========================
   FEATURED
========================= */

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

.featured-info svg{
    width:13px;
    height:13px;
    stroke:#fff;
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
    text-decoration:none;
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
    text-decoration:none;
    font-weight:600;
}

/* =========================
   LATEST ARTICLES
========================= */

.latest-head{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:19px;
}

.latest-head .blog-section-title{
    margin:0;
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
    text-decoration:none;
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
    display:block;
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
}

.post-body p{
    margin:0 0 12px;
    color:#68717e;
    font-size:9px;
    line-height:1.65;
}

/* =========================
   PAGINATION
========================= */

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
    text-decoration:none;
    color:#667180;
    font-size:10px;
    background:#fff;
}

.page-link.active,
.page-link:hover{
    background:var(--teal);
    border-color:var(--teal);
    color:#fff;
}

/* =========================
   EMPTY
========================= */

.blog-empty{
    grid-column:1/-1;
    padding:40px;
    text-align:center;
    color:#77818d;
    background:#fff;
    border:1px solid #edf0f3;
    border-radius:14px;
}

/* =========================
   WEBINAR
========================= */

.webinar-section{
    padding:27px 0 35px;
    background:#fff;
}

.webinar-subtitle{
    text-align:center;
    color:#667180;
    font-size:12px;
    margin:-5px 0 25px;
}

.webinar-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
}

.webinar-card{
    background:#f5fcfd;
    border-radius:14px;
    padding:19px;
    box-shadow:0 6px 20px rgba(30,90,100,.05);
    position:relative;
}

.webinar-hot{
    position:absolute;
    right:0;
    top:0;
    background:#0aa5b5;
    color:#fff;
    font-size:8px;
    padding:5px 9px;
    border-radius:0 10px 0 9px;
}

.webinar-type{
    color:#0aa4b3;
    font-size:9px;
    margin-bottom:11px;
}

.webinar-card h3{
    font-size:14px;
    line-height:1.4;
    margin:0 0 12px;
}

.webinar-meta{
    display:grid;
    gap:6px;
    color:#606b78;
    font-size:9px;
    margin-bottom:16px;
}

.webinar-btn{
    display:block;
    background:#ffd000;
    color:#fff;
    text-align:center;
    padding:9px;
    border-radius:22px;
    font-size:9px;
    font-weight:800;
    text-decoration:none;
}

/* =========================
   KNOWLEDGE
========================= */

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
    font-size:18px;
}

.knowledge-card h3{
    font-size:12px;
    margin:0 0 5px;
}

.knowledge-card p{
    font-size:8px;
    color:#68717e;
    margin:0;
}

/* =========================
   RESPONSIVE
========================= */

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

    .post-grid,
    .webinar-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .knowledge-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:640px){

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
    .webinar-grid,
    .knowledge-grid{
        grid-template-columns:1fr;
    }

    .latest-head{
        align-items:end;
    }
}



/* =========================
   ARTICLE DETAIL
========================= */

.article-page{background:#fff;padding:58px 0 80px}
.article-container{max-width:900px;margin:0 auto;padding:0 24px}
.article-header{text-align:center;margin-bottom:30px}
.article-category{display:inline-flex;align-items:center;justify-content:center;color:var(--teal-dark);font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;margin-bottom:12px}
.article-title{max-width:820px;margin:0 auto 16px;color:var(--navy);font-size:42px;line-height:1.14;font-weight:800;letter-spacing:-1px}
.article-meta{display:flex;flex-wrap:wrap;justify-content:center;align-items:center;gap:10px 18px;color:#6b7280;font-size:11px}
.article-meta span{display:inline-flex;align-items:center;gap:6px}
.article-meta i{color:#8b98aa;font-size:10px}
.article-actions{display:flex;justify-content:center;gap:8px;margin-top:15px}
.article-action{width:32px;height:32px;border:1px solid #e7edf2;border-radius:50%;background:#fff;color:#68778b;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:.2s}
.article-action:hover{color:var(--teal-dark);border-color:#bfecef;background:#f4fdfe}
.article-cover{width:100%;max-height:500px;object-fit:cover;border-radius:16px;box-shadow:0 14px 38px rgba(18,35,63,.12);margin:0 auto 28px}
.article-excerpt{max-width:780px;margin:0 auto 26px;color:#5d6a7d;font-size:15px;line-height:1.8;text-align:left}
.article-toc{max-width:780px;margin:0 auto 32px;padding:20px 24px;border:1px solid #e4f1f3;background:linear-gradient(135deg,#f4fbfc,#f8fbfc);border-radius:14px}
.article-toc-title{display:flex;align-items:center;gap:8px;color:var(--navy);font-size:14px;font-weight:800;margin-bottom:12px}
.article-toc-title i{color:var(--teal)}
.article-toc ol{margin:0;padding-left:22px}
.article-toc li{margin:7px 0;color:#526176;font-size:11px}
.article-toc a:hover{color:var(--teal-dark)}
.article-body{max-width:780px;margin:0 auto;color:#526176}
.article-section{scroll-margin-top:100px;margin-bottom:32px}
.article-section h2{color:var(--navy);font-size:22px;line-height:1.3;font-weight:800;margin:0 0 12px}
.article-paragraph{font-size:12px;line-height:1.85;margin:0 0 12px}
.article-list{list-style:none;padding:0;margin:14px 0 0;display:grid;gap:10px}
.article-list li{display:flex;gap:10px;align-items:flex-start;font-size:11px;line-height:1.7}
.article-list-num{flex:0 0 auto;min-width:22px;color:var(--teal);font-weight:800}
.article-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px}
.article-card{background:#fff;border:1px solid #e9eef2;border-radius:12px;padding:15px;box-shadow:0 4px 12px rgba(18,35,63,.035)}
.article-card-icon{width:30px;height:30px;border-radius:8px;background:#e9f9fa;color:var(--teal-dark);display:flex;align-items:center;justify-content:center;margin-bottom:10px;font-size:12px}
.article-card h3{color:var(--navy);font-size:11px;line-height:1.4;margin:0 0 6px}
.article-card p{color:#68768a;font-size:9.5px;line-height:1.65;margin:0}
.article-benefits{display:grid;gap:13px;margin-top:14px}
.article-benefit{display:grid;grid-template-columns:22px 1fr;gap:9px}
.article-benefit-check{width:22px;height:22px;border-radius:50%;background:var(--teal);color:#fff;display:flex;align-items:center;justify-content:center;font-size:9px;margin-top:1px}
.article-benefit h3{color:var(--navy);font-size:10.5px;margin:0 0 3px}
.article-benefit p{color:#68768a;font-size:10px;line-height:1.65;margin:0}
.article-info-box{background:#f2fbfc;border-radius:14px;padding:20px 22px;display:grid;grid-template-columns:repeat(2,1fr);gap:18px 28px}
.article-info-item h3{color:var(--teal-dark);font-size:10.5px;margin:0 0 4px}
.article-info-item p{color:#68768a;font-size:10px;line-height:1.65;margin:0}
.article-timeline{position:relative;margin-top:18px;padding:4px 0}
.article-timeline::before{content:"";position:absolute;left:50%;top:0;bottom:0;width:1px;background:#dcecef;transform:translateX(-50%)}
.article-timeline-item{position:relative;width:50%;padding:0 28px 25px 0}
.article-timeline-item:nth-child(even){margin-left:50%;padding:0 0 25px 28px}
.article-timeline-item:last-child{padding-bottom:0}
.article-timeline-dot{position:absolute;top:0;right:-13px;width:26px;height:26px;border-radius:50%;background:#e8fafb;border:4px solid #fff;box-shadow:0 0 0 1px #cfecef;display:flex;align-items:center;justify-content:center;color:var(--teal-dark);font-size:8px;font-weight:800;z-index:2}
.article-timeline-item:nth-child(even) .article-timeline-dot{left:-13px;right:auto}
.article-timeline-card{border:1px solid #edf0f3;border-radius:11px;padding:13px 14px;background:#fff;box-shadow:0 3px 10px rgba(18,35,63,.03)}
.article-timeline-card h3{color:var(--navy);font-size:10.5px;margin:0 0 4px}
.article-timeline-card p{color:#68768a;font-size:9.5px;line-height:1.65;margin:0}
.article-quote{margin:18px 0 0;padding:22px 24px;background:#f3fbfc;border-left:4px solid var(--teal);border-radius:0 12px 12px 0}
.article-quote i{color:var(--teal);margin-bottom:8px}
.article-quote p{color:var(--navy);font-size:14px;line-height:1.75;font-weight:600;margin:0 0 8px}
.article-quote cite{color:#728095;font-size:10px;font-style:normal}
.article-nav{max-width:780px;margin:40px auto 0;padding-top:24px;border-top:1px solid #edf0f3;display:grid;grid-template-columns:1fr 1fr;gap:18px}
.article-nav-link{min-height:68px;border:1px solid #edf0f3;border-radius:12px;padding:13px 15px;background:#fff;transition:.2s}
.article-nav-link:hover{border-color:#bfecef;transform:translateY(-2px)}
.article-nav-link.next{text-align:right}
.article-nav-label{color:#8a96a8;font-size:8.5px;margin-bottom:5px}
.article-nav-title{color:var(--navy);font-size:10.5px;line-height:1.45;font-weight:700}
.related-section{background:#f7fbfc;padding:48px 0 70px;border-top:1px solid #edf3f4}
.related-container{max-width:900px;margin:0 auto;padding:0 24px}
.related-head{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:18px}
.related-head h2{color:var(--navy);font-size:22px;font-weight:800;margin:0}
.related-all{color:var(--teal-dark);font-size:10px;font-weight:700}
.related-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}
.related-card{background:#fff;border:1px solid #edf0f3;border-radius:12px;overflow:hidden;box-shadow:0 3px 12px rgba(18,35,63,.035);transition:.2s}
.related-card:hover{transform:translateY(-3px);box-shadow:0 9px 20px rgba(18,35,63,.08)}
.related-image{width:100%;height:112px;object-fit:cover}
.related-body{padding:11px}
.related-date{color:#7d8999;font-size:8px;margin-bottom:6px}
.related-body h3{color:var(--navy);font-size:10.5px;line-height:1.4;margin:0 0 7px}
.related-body p{color:#718094;font-size:8.5px;line-height:1.55;margin:0 0 8px}
.related-more{color:var(--teal-dark);font-size:8.5px;font-weight:700}

@media(max-width:900px){
    .article-title{font-size:34px}
    .related-grid{grid-template-columns:repeat(2,1fr)}
    .article-cards{grid-template-columns:1fr}
}
@media(max-width:640px){
    .article-page{padding:38px 0 55px}
    .article-container,.related-container{padding:0 16px}
    .article-title{font-size:28px;letter-spacing:-.6px}
    .article-meta{font-size:9px;gap:7px 11px}
    .article-cover{border-radius:12px;max-height:300px}
    .article-excerpt{font-size:12px}
    .article-section h2{font-size:18px}
    .article-paragraph{font-size:10.5px}
    .article-info-box{grid-template-columns:1fr;gap:13px}
    .article-timeline::before{left:13px}
    .article-timeline-item,.article-timeline-item:nth-child(even){width:100%;margin-left:0;padding:0 0 18px 43px}
    .article-timeline-item .article-timeline-dot,.article-timeline-item:nth-child(even) .article-timeline-dot{left:0;right:auto}
    .article-nav{grid-template-columns:1fr}
    .article-nav-link.next{text-align:left}
    .related-grid{grid-template-columns:1fr 1fr}
    .related-head h2{font-size:18px}
}
@media(max-width:430px){
    .related-grid{grid-template-columns:1fr}
}

    </style>
</head>

<body>

<nav class="navbar">
    <div class="nav-inner">

        <a href="{{ route('home') }}" class="brand">

            <svg class="logo-svg" viewBox="0 0 100 100">
                <rect x="28" y="14" width="40" height="14" rx="3"
                      fill="#ffd400" stroke="#111" stroke-width="4"/>
                <rect x="20" y="18" width="11" height="7" rx="2"
                      fill="#ffd400" stroke="#111" stroke-width="3"/>
                <line x1="50" y1="28" x2="50" y2="38"
                      stroke="#111" stroke-width="4"/>
                <rect x="24" y="38" width="52" height="46" rx="7"
                      fill="#ffd400" stroke="#111" stroke-width="5"/>
                <text x="50" y="61" text-anchor="middle"
                      font-size="16" font-weight="800"
                      fill="#111" font-family="Arial">EIN</text>
                <text x="50" y="77" text-anchor="middle"
                      font-size="16" font-weight="800"
                      fill="#111" font-family="Arial">TIO</text>
            </svg>

            PT Eintio Academic & Technology
        </a>

        <div class="nav-links">

            <a href="{{ route('home') }}">Beranda</a>

            <a href="{{ route('profile') }}">Profil</a>

            <a href="{{ route('services') }}">Layanan</a>

            <a href="{{ route('portfolios') }}">Portofolio</a>

            <a href="{{ route('teams') }}">Tim</a>

            <a href="{{ route('blog') }}" class="active">Blog</a>

            <a href="#">Testimoni</a>

            <a href="{{ route('contact') }}">Contact</a>

        </div>

        <a class="btn-teal"
           href="https://wa.me/628112225804"
           target="_blank">

            <i class="fa-brands fa-whatsapp"></i>
            Konsultasi WhatsApp

        </a>

        <button class="menu-toggle"
                onclick="toggleMenu()">

            <i class="fa-solid fa-bars"></i>

        </button>

    </div>
</nav>

<main>

    <section class="article-page">
        <div class="article-container">

            <header class="article-header">

                <div class="article-category">
                    {{ $blogPost->category?->name ?? 'Insight' }}
                </div>

                <h1 class="article-title">
                    {{ $blogPost->title }}
                </h1>

                <div class="article-meta">
                    @if($blogPost->published_at)
                        <span>
                            <i class="fa-regular fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($blogPost->published_at)->translatedFormat('d F Y') }}
                        </span>
                    @endif

                    <span>
                        <i class="fa-regular fa-clock"></i>
                        5 min read
                    </span>

                    <span>
                        <i class="fa-regular fa-user"></i>
                        {{ $blogPost->author?->name ?? 'PT Eintio Academic & Technology' }}
                    </span>
                </div>

                <div class="article-actions">
                    <button class="article-action" type="button" title="Bagikan" onclick="shareArticle()">
                        <i class="fa-solid fa-share-nodes"></i>
                    </button>
                    <button class="article-action" type="button" title="Salin link" onclick="copyArticleLink()">
                        <i class="fa-regular fa-copy"></i>
                    </button>
                </div>

            </header>

            <img
                class="article-cover"
                src="{{ $blogPost->thumbnail
                    ? \Illuminate\Support\Facades\Storage::url($blogPost->thumbnail)
                    : asset('images/blog/default.jpg') }}"
                alt="{{ $blogPost->title }}"
            >

            @if($blogPost->excerpt)
                <p class="article-excerpt">{{ $blogPost->excerpt }}</p>
            @endif

            @php
                $articleSections = $blogPost->sections->sortBy('order')->values();
                $tocSections = $articleSections->filter(fn ($section) => filled($section->title))->values();
            @endphp

            @if($tocSections->isNotEmpty())
                <aside class="article-toc">
                    <div class="article-toc-title">
                        <i class="fa-solid fa-list"></i>
                        Daftar Isi
                    </div>
                    <ol>
                        @foreach($tocSections as $index => $section)
                            <li>
                                <a href="#section-{{ $section->id ?? $index }}">
                                    {{ $section->title }}
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </aside>
            @endif

            <div class="article-body">

                @forelse($articleSections as $index => $section)

                    @php
                        $data = is_array($section->data)
                            ? $section->data
                            : (json_decode($section->data ?? '{}', true) ?: []);

                        $items = is_array($data['items'] ?? null) ? $data['items'] : [];
                        $sectionId = 'section-' . ($section->id ?? $index);
                    @endphp

                    <section class="article-section" id="{{ $sectionId }}">

                        @if(filled($section->title))
                            <h2>{{ $index + 1 }}. {{ $section->title }}</h2>
                        @endif

                        @if($section->type === 'description')

                            @php
                                $description = trim((string) ($data['description'] ?? ''));
                                $paragraphs = preg_split("/\r\n\r\n|\n\n|\r\n|\n/", $description);
                            @endphp

                            @foreach($paragraphs as $paragraph)
                                @if(trim($paragraph) !== '')
                                    <p class="article-paragraph">{{ trim($paragraph) }}</p>
                                @endif
                            @endforeach

                        @elseif($section->type === 'list')

                            <ul class="article-list">
                                @foreach($items as $itemIndex => $item)
                                    <li>
                                        <span class="article-list-num">
                                            {{ str_pad($itemIndex + 1, 2, '0', STR_PAD_LEFT) }}.
                                        </span>
                                        <span>
                                            <strong>{{ $item['title'] ?? '' }}</strong>
                                            @if(!empty($item['description']))
                                                <br>{{ $item['description'] }}
                                            @endif
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                        @elseif($section->type === 'columns')

                            <div class="article-cards">
                                @foreach($items as $item)
                                    <article class="article-card">
                                        <div class="article-card-icon">
                                            <i class="{{ $item['icon'] ?? 'fa-solid fa-layer-group' }}"></i>
                                        </div>
                                        <h3>{{ $item['title'] ?? '' }}</h3>
                                        @if(!empty($item['description']))
                                            <p>{{ $item['description'] }}</p>
                                        @endif
                                    </article>
                                @endforeach
                            </div>

                        @elseif($section->type === 'benefits')

                            <div class="article-benefits">
                                @foreach($items as $item)
                                    <article class="article-benefit">
                                        <div class="article-benefit-check">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <div>
                                            <h3>{{ $item['title'] ?? '' }}</h3>
                                            @if(!empty($item['description']))
                                                <p>{{ $item['description'] }}</p>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                        @elseif($section->type === 'timeline')

                            <div class="article-timeline">
                                @foreach($items as $itemIndex => $item)
                                    <article class="article-timeline-item">
                                        <div class="article-timeline-dot">
                                            {{ str_pad($itemIndex + 1, 2, '0', STR_PAD_LEFT) }}
                                        </div>
                                        <div class="article-timeline-card">
                                            <h3>{{ $item['title'] ?? '' }}</h3>
                                            @if(!empty($item['description']))
                                                <p>{{ $item['description'] }}</p>
                                            @endif
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                        @elseif($section->type === 'quote')

                            <blockquote class="article-quote">
                                <i class="fa-solid fa-quote-left"></i>
                                <p>{{ $data['quote'] ?? '' }}</p>
                                @if(!empty($data['author']))
                                    <cite>— {{ $data['author'] }}</cite>
                                @endif
                            </blockquote>

                        @endif

                    </section>

                @empty

                    <div class="blog-empty">
                        Konten artikel belum tersedia.
                    </div>

                @endforelse

            </div>

            @if(isset($previousPost) || isset($nextPost))
                <nav class="article-nav" aria-label="Navigasi artikel">

                    @if($previousPost)
                        <a class="article-nav-link"
                           href="{{ route('blog.show', ['blogPost' => $previousPost->slug]) }}">
                            <div class="article-nav-label">
                                <i class="fa-solid fa-arrow-left"></i>
                                Artikel Sebelumnya
                            </div>
                            <div class="article-nav-title">{{ $previousPost->title }}</div>
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if($nextPost)
                        <a class="article-nav-link next"
                           href="{{ route('blog.show', ['blogPost' => $nextPost->slug]) }}">
                            <div class="article-nav-label">
                                Artikel Selanjutnya
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                            <div class="article-nav-title">{{ $nextPost->title }}</div>
                        </a>
                    @endif

                </nav>
            @endif

        </div>
    </section>

    <section class="related-section">
        <div class="related-container">

            <div class="related-head">
                <h2>Artikel Terkait</h2>
                <a class="related-all" href="{{ route('blog') }}">
                    Lihat Semua Blog →
                </a>
            </div>

            <div class="related-grid">

                @forelse(($relatedPosts ?? collect()) as $post)

                    <a class="related-card"
                       href="{{ route('blog.show', ['blogPost' => $post->slug]) }}">

                        <img
                            class="related-image"
                            src="{{ $post->thumbnail
                                ? \Illuminate\Support\Facades\Storage::url($post->thumbnail)
                                : asset('images/blog/default.jpg') }}"
                            alt="{{ $post->title }}"
                        >

                        <div class="related-body">

                            @if($post->published_at)
                                <div class="related-date">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d M Y') }}
                                </div>
                            @endif

                            <h3>{{ $post->title }}</h3>

                            <p>
                                {{ \Illuminate\Support\Str::limit($post->excerpt, 85) }}
                            </p>

                            <span class="related-more">
                                Baca Selengkapnya →
                            </span>

                        </div>
                    </a>

                @empty

                    <div class="blog-empty">
                        Belum ada artikel terkait.
                    </div>

                @endforelse

            </div>
        </div>
    </section>

</main>

<footer>

    <div class="container footer-grid">

        <div>

            <div class="footer-brand">

                <svg class="logo-svg" viewBox="0 0 100 100">
                    <rect x="28" y="14" width="40" height="14" rx="3"
                          fill="#ffd400" stroke="#111" stroke-width="4"/>
                    <rect x="20" y="18" width="11" height="7" rx="2"
                          fill="#ffd400" stroke="#111" stroke-width="3"/>
                    <line x1="50" y1="28" x2="50" y2="38"
                          stroke="#111" stroke-width="4"/>
                    <rect x="24" y="38" width="52" height="46" rx="7"
                          fill="#ffd400" stroke="#111" stroke-width="5"/>
                    <text x="50" y="61" text-anchor="middle"
                          font-size="16" font-weight="800"
                          fill="#111" font-family="Arial">EIN</text>
                    <text x="50" y="77" text-anchor="middle"
                          font-size="16" font-weight="800"
                          fill="#111" font-family="Arial">TIO</text>
                </svg>

                PT Eintio Academic & Technology

            </div>

            <p>
                Menyediakan solusi digital terintegrasi dan pendampingan
                akademik profesional untuk masa depan bisnis dan pendidikan
                Indonesia yang lebih cerah.
            </p>

            <div class="socials">

                <a href="https://www.instagram.com/eintio.id"
                   target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="https://wa.me/628112225804"
                   target="_blank">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

                <a href="https://linktr.ee/eintio"
                   target="_blank">
                    <i class="fa-solid fa-link"></i>
                </a>

            </div>

        </div>


        <div>

            <h5>Navigasi</h5>

            <ul>

                <li>
                    <a href="{{ route('home') }}">Beranda</a>
                </li>

                <li>
                    <a href="{{ route('profile') }}">Profil</a>
                </li>

                <li>
                    <a href="{{ route('services') }}">Layanan</a>
                </li>

                <li>
                    <a href="{{ route('teams') }}">Tim</a>
                </li>

                <li>
                    <a href="{{ route('blog') }}">Blog</a>
                </li>

            </ul>

        </div>


        <div>

            <h5>Layanan</h5>

            <ul>

                <li>
                    <a href="{{ route('services') }}">
                        Web Development
                    </a>
                </li>

                <li>
                    <a href="{{ route('services') }}">
                        Mobile Apps
                    </a>
                </li>

                <li>
                    <a href="{{ route('services') }}">
                        Analisis Data Riset
                    </a>
                </li>

                <li>
                    <a href="{{ route('services') }}">
                        Bimbingan Akademik
                    </a>
                </li>

            </ul>

        </div>


        <div>

            <h5>Kontak</h5>

            <ul class="contact-list">

                <li>
                    <span class="ci">
                        <i class="fa-solid fa-location-dot"></i>
                    </span>

                    Jln. Menjangan No. 25A,
                    Salatiga, Jawa Tengah
                </li>

                <li>
                    <span class="ci">
                        <i class="fa-solid fa-phone"></i>
                    </span>

                    (+62) 8112225804
                </li>

                <li>
                    <span class="ci">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    info@eintio.co.id
                </li>

            </ul>

        </div>

    </div>

    <div class="copyright">
        © 2024 PT Eintio Academic & Technology.
        All rights reserved.
    </div>

</footer>

<script>

function toggleMenu(){

    const nav = document.querySelector('.nav-links');

    if(nav.style.display === 'flex'){
        nav.style.display = 'none';
    }else{
        nav.style.display = 'flex';
        nav.style.flexDirection = 'column';
        nav.style.position = 'absolute';
        nav.style.top = '64px';
        nav.style.left = '0';
        nav.style.right = '0';
        nav.style.background = '#fff';
        nav.style.padding = '20px 24px';
        nav.style.boxShadow = '0 10px 25px rgba(0,0,0,.08)';
    }

}

</script>

<script>
function shareArticle() {
    const data = {
        title: @json($blogPost->title),
        text: @json($blogPost->excerpt ?? $blogPost->title),
        url: window.location.href
    };

    if (navigator.share) {
        navigator.share(data).catch(() => {});
    } else {
        copyArticleLink();
    }
}

function copyArticleLink() {
    const url = window.location.href;

    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            alert('Link artikel berhasil disalin.');
        }).catch(() => {
            window.prompt('Salin link artikel:', url);
        });
    } else {
        window.prompt('Salin link artikel:', url);
    }
}
</script>

</body>
</html>
