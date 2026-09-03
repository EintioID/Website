<x-guest-layout>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<div class="ein-bg-fixed">
    <div class="shape blob" style="width:38vw;height:38vw;max-width:420px;max-height:420px;background:#14B8A6;top:-10vw;left:-10vw;opacity:.16;animation-duration:16s;"></div>
    <div class="shape blob" style="width:34vw;height:34vw;max-width:380px;max-height:380px;background:#c6a15b;top:60%;right:-12vw;opacity:.14;animation-duration:19s;animation-delay:-4s;"></div>
    <div class="shape blob" style="width:28vw;height:28vw;max-width:320px;max-height:320px;background:#41526D;bottom:-10vw;left:35%;opacity:.10;animation-duration:14s;animation-delay:-8s;"></div>
    <div class="shape spin" style="width:100px;height:100px;border:2px solid #14B8A6;border-radius:24px;top:12%;left:8%;opacity:.22;animation-duration:22s;"></div>
    <div class="shape drift" style="width:58px;height:58px;border:2px solid #c6a15b;border-radius:50%;top:20%;right:12%;opacity:.28;animation-duration:9s;"></div>
    <div class="shape drift" style="width:14px;height:14px;background:#14B8A6;border-radius:50%;top:35%;left:22%;opacity:.5;animation-duration:7s;"></div>
    <div class="shape drift" style="width:10px;height:10px;background:#c6a15b;border-radius:50%;top:55%;right:22%;opacity:.5;animation-duration:8s;animation-delay:-2s;"></div>
    <div class="line" style="top:25%;"></div>
    <div class="line" style="top:75%;"></div>
</div>

<div class="ein-page">
    <div class="ein-container">
        <div class="ein-header">
            <div class="ein-logo">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
            </div>
            <h1 class="ein-brand">PT. Eintio</h1>
            <p class="ein-brand-sub">ACADEMIC & TECHNOLOGY</p>
        </div>

        <div class="ein-welcome">
            <h2>Konfirmasi Password</h2>
            <p>Ini adalah area aman. Mohon konfirmasi password Anda untuk melanjutkan.</p>
        </div>

        <div class="ein-card">
            <div class="ein-card-top"></div>
            <div class="ein-card-body">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="ein-field">
                        <label for="password">Password</label>
                        <div class="ein-input-wrap">
                            <span class="ein-input-icon">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                            </span>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"/>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="ein-error" />
                    </div>

                    <button type="submit" class="ein-btn-primary">
                        <span class="shimmer"></span>
                        <span>Konfirmasi</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="arrow">
                            <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                        </svg>
                    </button>
                </form>
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
.blob{filter:blur(60px);animation:blobmove ease-in-out infinite;}
@keyframes blobmove{0%,100%{transform:translate(0,0) scale(1);}33%{transform:translate(40px,-60px) scale(1.15);}66%{transform:translate(-30px,30px) scale(.9);}}
.drift{animation:driftmove ease-in-out infinite;}
@keyframes driftmove{0%,100%{transform:translateY(0) translateX(0);}50%{transform:translateY(-24px) translateX(14px);}}
.spin{animation:spinmove linear infinite;}
@keyframes spinmove{from{transform:rotate(0);}to{transform:rotate(360deg);}}
.line{position:absolute;left:0;width:100%;height:1px;background:linear-gradient(90deg,transparent,#14B8A6,transparent);opacity:.18;}
.ein-page{font-family:'Poppins',sans-serif;min-height:100vh;width:100%;position:relative;z-index:1;display:flex;align-items:center;justify-content:center;padding:clamp(24px,5vw,48px) 16px;}
.ein-container{position:relative;z-index:10;width:100%;max-width:380px;}
.ein-header{text-align:center;margin-bottom:18px;}
.ein-logo{width:52px;height:52px;border-radius:16px;margin:0 auto 10px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#14B8A6,#41526D);box-shadow:0 12px 24px -10px rgba(20,184,166,.4);animation:floaty 4s ease-in-out infinite;}
@keyframes floaty{0%,100%{transform:translateY(0);}50%{transform:translateY(-5px);}}
.ein-brand{font-size:19px;font-weight:700;color:var(--ein-dark);margin:0;}
.ein-brand-sub{font-size:10px;letter-spacing:.2em;color:var(--ein-muted);font-weight:600;margin:2px 0 0;}
.ein-welcome{text-align:center;margin-bottom:16px;}
.ein-welcome h2{font-size:clamp(20px,5vw,24px);font-weight:800;color:var(--ein-dark);margin:0 0 4px;}
.ein-welcome p{font-size:12.5px;color:#646464;line-height:1.5;margin:0;}
.ein-card{position:relative;background:#fff;border-radius:20px;box-shadow:0 24px 50px -20px rgba(40,47,58,.22);overflow:hidden;}
.ein-card-top{height:4px;background:linear-gradient(90deg,#14B8A6,#c6a15b,#41526D);}
.ein-card-body{padding:clamp(20px,5vw,28px)}
.ein-field{margin-bottom:14px;}
.ein-field label{display:block;font-size:12px;font-weight:600;color:var(--ein-dark);margin-bottom:5px;}
.ein-input-wrap{position:relative;display:flex;align-items:center;}
.ein-input-icon{position:absolute;left:12px;display:flex;color:#9a9a9a;transition:color .3s;pointer-events:none;}
.ein-input-wrap input{width:100%;padding:11px 14px 11px 38px;border-radius:10px;border:1.5px solid #e5e2db;font-size:13.5px;font-weight:500;font-family:'Poppins',sans-serif;background:#faf9f7;color:var(--ein-dark);transition:all .25s;outline:none;}
.ein-input-wrap input::placeholder{color:#b3b0a8;font-weight:400;}
.ein-input-wrap input:hover{border-color:var(--ein-gold);}
.ein-input-wrap input:focus{background:#fff;border-color:var(--ein-teal);box-shadow:0 0 0 3px rgba(20,184,166,.15);}
.ein-input-wrap:has(input:focus) .ein-input-icon{color:var(--ein-teal);}
.ein-error{margin-top:4px;font-size:11px;color:#e0553b;font-weight:500;}
.ein-btn-primary{position:relative;isolation:isolate;overflow:visible;width:100%;padding:14px;border:none;border-radius:12px;background:linear-gradient(135deg,#14B8A6,#0d9488);color:#fff;font-family:'Poppins',sans-serif;font-weight:600;font-size:13.5px;display:flex;align-items:center;justify-content:center;gap:8px;cursor:pointer;box-shadow:0 12px 22px -10px rgba(20,184,166,.45);transition:box-shadow .3s;}
.ein-btn-primary:hover{box-shadow:0 16px 30px -12px rgba(20,184,166,.55);}
.ein-btn-primary .arrow{transition:transform .3s;}
.ein-btn-primary:hover .arrow{transform:translateX(3px);}
.shimmer{position:absolute;inset:0;background:linear-gradient(120deg,transparent,rgba(255,255,255,.35),transparent);transform:translateX(-120%);transition:transform .8s;}
.ein-btn-primary:hover .shimmer{transform:translateX(120%);}
.ein-copyright{text-align:center;font-size:10.5px;color:#9a978f;margin-top:18px;}
@media (max-width:380px){.ein-card-body{padding:16px;}.ein-welcome h2{font-size:19px;}.ein-logo{width:46px;height:46px;}}
</style>
</x-guest-layout>