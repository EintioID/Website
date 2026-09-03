<x-guest-layout>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="ein-bg-fixed">
    <div class="shape blob" style="width:38vw;height:38vw;max-width:420px;max-height:420px;background:#14B8A6;top:-10vw;left:-10vw;opacity:.16;animation-duration:16s;"></div>
    <div class="shape blob" style="width:34vw;height:34vw;max-width:380px;max-height:380px;background:#c6a15b;top:60%;right:-12vw;opacity:.14;animation-duration:19s;animation-delay:-4s;"></div>
    <div class="shape blob" style="width:28vw;height:28vw;max-width:320px;max-height:320px;background:#41526D;bottom:-10vw;left:35%;opacity:.10;animation-duration:14s;animation-delay:-8s;"></div>

    <div class="shape spin" style="width:100px;height:100px;border:2px solid #14B8A6;border-radius:24px;top:12%;left:8%;opacity:.22;animation-duration:22s;"></div>
    <div class="shape spin" style="width:74px;height:74px;border:2px dashed #41526D;border-radius:50%;bottom:10%;right:8%;opacity:.18;animation-duration:30s;"></div>

    <div class="shape drift" style="width:58px;height:58px;border:2px solid #c6a15b;border-radius:50%;top:20%;right:12%;opacity:.28;animation-duration:9s;"></div>
    <div class="shape drift" style="width:14px;height:14px;background:#14B8A6;border-radius:50%;top:35%;left:22%;opacity:.5;animation-duration:7s;"></div>
    <div class="shape drift" style="width:10px;height:10px;background:#c6a15b;border-radius:50%;top:55%;right:22%;opacity:.5;animation-duration:8s;animation-delay:-2s;"></div>
    <div class="shape drift" style="width:16px;height:16px;background:#41526D;border-radius:6px;bottom:18%;right:30%;opacity:.3;animation-duration:11s;animation-delay:-3s;"></div>

    <div class="icon-float drift" style="top:15%;right:20%;color:#14B8A6;opacity:.3;animation-duration:10s;">
        <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 10 12 5 2 10l10 5 10-5Z"/><path d="M6 12v5c0 1 3 2 6 2s6-1 6-2v-5"/></svg>
    </div>
    <div class="icon-float drift" style="bottom:22%;left:10%;color:#c6a15b;opacity:.3;animation-duration:12s;animation-delay:-3s;">
        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
    </div>
    <div class="icon-float drift" style="top:65%;right:10%;color:#41526D;opacity:.25;animation-duration:11s;animation-delay:-5s;">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="4" width="18" height="12" rx="1"/><path d="M2 20h20"/></svg>
    </div>

    <div class="line" style="top:25%;"></div>
    <div class="line" style="top:75%;"></div>
</div>

<div class="ein-page">
    <div class="ein-container">
        <div class="ein-card ein-success-card">
            <div class="ein-card-top"></div>
            <div class="ein-card-body" style="text-align:center;">
                <div class="ein-success-icon">
                    <svg viewBox="0 0 52 52" width="72" height="72">
                        <circle class="ein-check-circle" cx="26" cy="26" r="24" fill="none"/>
                        <path class="ein-check-mark" fill="none" d="M14 27l7 7 16-16"/>
                    </svg>
                </div>

                <h2 class="ein-success-title">Registrasi Berhasil!</h2>
                <p class="ein-success-text">Akun kamu sudah dibuat. Silakan masuk menggunakan email dan password yang baru saja kamu daftarkan.</p>

                <a href="{{ route('login') }}" class="ein-btn-primary ein-btn-link">
                    <span class="shimmer"></span>
                    <span>Lanjut ke Login</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </a>
            </div>
        </div>

        <p class="ein-copyright">© {{ date('Y') }} PT. Eintio Academic & Technology</p>
    </div>
</div>

<style>
*{box-sizing:border-box;}
:root{
  --ein-cream:#EEE9E2; --ein-navy:#41526D; --ein-teal:#14B8A6;
  --ein-gold:#c6a15b; --ein-dark:#282F3A; --ein-muted:#5E6478;
}
html,body{background:linear-gradient(135deg,#EEE9E2 0%,#e5f4f2 45%,#d8ede9 100%);}
.ein-bg-fixed{position:fixed;inset:0;overflow:hidden;pointer-events:none;z-index:0;}
.shape{position:absolute;border-radius:9999px;}
.icon-float{position:absolute;}
.blob{filter:blur(60px);animation:blobmove ease-in-out infinite;}
@keyframes blobmove{0%,100%{transform:translate(0,0) scale(1);}33%{transform:translate(40px,-60px) scale(1.15);}66%{transform:translate(-30px,30px) scale(.9);}}
.drift{animation:driftmove ease-in-out infinite;}
@keyframes driftmove{0%,100%{transform:translateY(0) translateX(0);}50%{transform:translateY(-24px) translateX(14px);}}
.spin{animation:spinmove linear infinite;}
@keyframes spinmove{from{transform:rotate(0);}to{transform:rotate(360deg);}}
.line{position:absolute;left:0;width:100%;height:1px;background:linear-gradient(90deg,transparent,#14B8A6,transparent);opacity:.18;}
.ein-page{font-family:'Poppins',sans-serif;min-height:100vh;width:100%;position:relative;z-index:1;display:flex;align-items:center;justify-content:center;padding:clamp(24px,5vw,48px) 16px;}
.ein-container{position:relative;z-index:10;width:100%;max-width:400px;}
.ein-card{position:relative;background:#fff;border-radius:20px;box-shadow:0 24px 50px -20px rgba(40,47,58,.22);overflow:hidden;}
.ein-card-top{height:4px;background:linear-gradient(90deg,#14B8A6,#c6a15b,#41526D);}
.ein-card-body{padding:clamp(28px,6vw,40px) clamp(24px,6vw,32px);}
.ein-success-icon{width:90px;height:90px;margin:0 auto 20px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:linear-gradient(135deg,rgba(20,184,166,.12),rgba(20,184,166,.04));}
.ein-check-circle{stroke:#14B8A6;stroke-width:3;stroke-dasharray:151;stroke-dashoffset:151;animation:circleDraw .6s ease forwards;}
.ein-check-mark{stroke:#14B8A6;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:36;stroke-dashoffset:36;animation:checkDraw .4s .6s ease forwards;}
@keyframes circleDraw{to{stroke-dashoffset:0;}}
@keyframes checkDraw{to{stroke-dashoffset:0;}}
.ein-success-title{font-size:22px;font-weight:800;color:var(--ein-dark);margin:0 0 8px;}
.ein-success-text{font-size:13px;color:var(--ein-muted);line-height:1.6;margin:0 0 24px;}
.ein-btn-primary{position:relative;isolation:isolate;overflow:visible;width:100%;padding:14px;border:none;border-radius:12px;background:linear-gradient(135deg,#14B8A6,#0d9488);color:#fff;font-family:'Poppins',sans-serif;font-weight:600;font-size:13.5px;display:flex;align-items:center;justify-content:center;gap:8px;cursor:pointer;box-shadow:0 12px 22px -10px rgba(20,184,166,.45);transition:box-shadow .3s,transform .2s;text-decoration:none;}
.ein-btn-link:hover{box-shadow:0 16px 30px -12px rgba(20,184,166,.55);transform:translateY(-2px);}
.ein-btn-link:active{transform:translateY(0);}
.ein-btn-primary .arrow{transition:transform .3s;}
.ein-btn-primary:hover .arrow{transform:translateX(3px);}
.shimmer{position:absolute;inset:0;background:linear-gradient(120deg,transparent,rgba(255,255,255,.35),transparent);transform:translateX(-120%);transition:transform .8s;}
.ein-btn-primary:hover .shimmer{transform:translateX(120%);}
.ein-copyright{text-align:center;font-size:10.5px;color:#9a978f;margin-top:18px;}
</style>
</x-guest-layout>