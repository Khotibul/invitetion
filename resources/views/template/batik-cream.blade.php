@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
﻿<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangan Pernikahan {{ $maleNickname }} &amp; {{ $femaleNickname }}</title>
<meta property="og:title" content="Undangan Pernikahan {{ $maleName }} &amp; {{ $femaleName }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:description" content="Kami mengundang kehadiran Anda di hari bahagia kami">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
    --cream:#fbf6ee;
    --cream-2:#f4eadc;
    --paper:#ffffff;
    --cocoa:#2f2622;
    --cocoa-2:#3b2f2a;
    --latte:#7c665c;
    --gold:#b88746;
    --gold-2:#d8b88f;
    --shadow:0 18px 50px rgba(47,38,34,.12);
    --radius:18px;

    --batik: url("data:image/svg+xml,%3Csvg%20xmlns%3D%27http%3A//www.w3.org/2000/svg%27%20width%3D%27240%27%20height%3D%27240%27%20viewBox%3D%270%200%20240%20240%27%3E%3Cg%20fill%3D%27none%27%20stroke%3D%27%23b88746%27%20stroke-width%3D%271.2%27%20opacity%3D%270.28%27%3E%3Cpath%20d%3D%27M120%2020c-22%200-40%2018-40%2040%200%2011%205%2021%2012%2029-7%208-12%2018-12%2029%200%2022%2018%2040%2040%2040s40-18%2040-40c0-11-5-21-12-29%207-8%2012-18%2012-29%200-22-18-40-40-40z%27/%3E%3Cpath%20d%3D%27M20%20120c0-22%2018-40%2040-40%2011%200%2021%205%2029%2012%208-7%2018-12%2029-12%2022%200%2040%2018%2040%2040s-18%2040-40%2040c-11%200-21-5-29-12-8%207-18%2012-29%2012-22%200-40-18-40-40z%27/%3E%3Cpath%20d%3D%27M48%2048l144%20144M192%2048L48%20192%27/%3E%3C/g%3E%3C/svg%3E");
}
html{scroll-behavior:smooth}
body{
    font-family:'Plus Jakarta Sans',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
    background:var(--cream);
    color:var(--cocoa);
    overflow-x:hidden;
}
img{max-width:100%;display:block}
a{text-decoration:none;color:inherit}
.script{font-family:'Great Vibes',cursive}
h1,h2,h3{font-family:'Fraunces',serif}

/* -- COVER OVERLAY -- */
#cover-overlay{
    position:fixed;inset:0;z-index:9999;
    display:flex;align-items:center;justify-content:center;
    padding:2rem;text-align:center;
    background:
        radial-gradient(1200px 900px at 50% 0%, rgba(184,135,70,.18) 0%, transparent 55%),
        linear-gradient(160deg, var(--cream) 0%, var(--cream-2) 100%);
    transition:opacity .9s ease,visibility .9s ease;
}
#cover-overlay::before{
    content:'';position:absolute;inset:0;
    background-image:var(--batik);
    background-size:280px;
    opacity:.35;
    pointer-events:none;
}
#cover-overlay.hidden{opacity:0;visibility:hidden;pointer-events:none}
.cover-card{
    position:relative;
    width:min(520px, 100%);
    padding:2.4rem 2rem;
    background:rgba(255,255,255,.72);
    border:1px solid rgba(184,135,70,.28);
    border-radius:28px;
    box-shadow:var(--shadow);
    backdrop-filter: blur(10px);
}
.cover-card::before,.cover-card::after{
    content:'';position:absolute;inset:12px;border-radius:22px;
    border:1px dashed rgba(184,135,70,.25);
    pointer-events:none;
}
.cover-badge{
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.55rem 1.2rem;
    border:1px solid rgba(184,135,70,.45);
    border-radius:999px;
    font-size:.75rem;
    letter-spacing:3px;
    text-transform:uppercase;
    color:var(--cocoa-2);
    background:rgba(251,246,238,.7);
}
.cover-names{
    margin-top:1.2rem;
    font-size:clamp(2.4rem, 8vw, 4.4rem);
    line-height:1.05;
}
.cover-names .amp{
    display:inline-block;
    margin:.2rem .25rem 0;
    font-family:'Fraunces',serif;
    font-size:clamp(1.4rem, 5vw, 2.2rem);
    color:var(--gold);
}
.cover-sub{
    margin-top:.75rem;
    color:var(--latte);
    font-size:.95rem;
    line-height:1.6;
}
.cover-photo{
    width:140px;height:140px;border-radius:50%;
    object-fit:cover;
    margin:1.4rem auto 0;
    border:3px solid rgba(184,135,70,.55);
    box-shadow:0 14px 40px rgba(47,38,34,.14);
}
.cover-guest{
    margin-top:1.4rem;
    font-size:.9rem;
    color:var(--latte);
}
.cover-guest strong{display:block;color:var(--cocoa);font-size:1.08rem;margin-top:.2rem}
.btn-open{
    margin-top:1.35rem;
    width:100%;
    display:inline-flex;align-items:center;justify-content:center;gap:.6rem;
    padding:1rem 1.25rem;
    border-radius:16px;
    border:1px solid rgba(184,135,70,.5);
    background:linear-gradient(180deg, rgba(184,135,70,.95) 0%, rgba(155,105,51,.95) 100%);
    color:#fff;
    letter-spacing:2px;
    text-transform:uppercase;
    font-size:.8rem;
    cursor:pointer;
    transition:transform .25s ease, filter .25s ease;
}
.btn-open:hover{transform:translateY(-2px);filter:saturate(1.05) brightness(1.03)}
.btn-open:active{transform:translateY(0)}

/* -- MAIN CONTENT -- */
#main-content{display:none}
#main-content.visible{display:block}
section{padding:5.25rem 1.25rem}
.section-inner{max-width:1100px;margin:0 auto}
.sec-head{text-align:center;margin-bottom:2.2rem}
.sec-label{
    font-size:.7rem;
    letter-spacing:4px;
    text-transform:uppercase;
    color:var(--gold);
}
.sec-title{
    margin-top:.45rem;
    font-size:clamp(1.8rem, 4vw, 2.8rem);
}
.sec-divider{
    width:86px;height:2px;
    margin:1.2rem auto 0;
    background:linear-gradient(90deg, transparent, var(--gold), transparent);
}

/* -- HERO -- */
.hero{
    --hero-img:none;
    position:relative;
    min-height:100vh;
    display:flex;align-items:center;justify-content:center;
    text-align:center;
    background:
        radial-gradient(1200px 900px at 50% 0%, rgba(184,135,70,.16) 0%, transparent 58%),
        linear-gradient(180deg, rgba(251,246,238,.92) 0%, rgba(244,234,220,.92) 100%),
        var(--hero-img);
    background-size:auto, auto, cover;
    background-position:center, center, center;
    background-repeat:no-repeat,no-repeat,no-repeat;
    overflow:hidden;
}
.hero::before{
    content:'';position:absolute;inset:0;
    background-image:var(--batik);
    background-size:340px;
    opacity:.25;
    pointer-events:none;
}
.hero-inner{
    position:relative;z-index:1;
    width:min(760px, 100%);
    padding:2.8rem 1.6rem;
    background:rgba(255,255,255,.62);
    border:1px solid rgba(184,135,70,.28);
    border-radius:28px;
    box-shadow:var(--shadow);
    backdrop-filter: blur(10px);
}
.hero-eyebrow{
    font-size:.75rem;
    letter-spacing:5px;
    text-transform:uppercase;
    color:var(--latte);
}
.hero-names{
    margin-top:.8rem;
    font-size:clamp(2.6rem, 8.5vw, 5.2rem);
    line-height:1.02;
}
.hero-amp{color:var(--gold);margin:0 .45rem}
.hero-date{
    margin-top:1rem;
    display:inline-flex;align-items:center;gap:.55rem;
    padding:.55rem 1.05rem;
    border-radius:999px;
    border:1px solid rgba(184,135,70,.3);
    background:rgba(251,246,238,.7);
    font-size:.9rem;
    color:var(--cocoa-2);
}
.hero-quote{
    margin-top:1.3rem;
    color:var(--latte);
    font-style:italic;
    line-height:1.8;
}
.scroll-hint{
    position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);
    font-size:.72rem;letter-spacing:3px;text-transform:uppercase;
    color:rgba(47,38,34,.55);
    display:flex;flex-direction:column;align-items:center;gap:.5rem;
}
.scroll-hint i{color:var(--gold)}

/* -- FLOATING NAV -- */
.dock{
    position:fixed;left:50%;bottom:1.1rem;transform:translateX(-50%);
    z-index:250;
    display:flex;gap:.55rem;
    padding:.55rem;
    border-radius:999px;
    background:rgba(255,255,255,.72);
    border:1px solid rgba(184,135,70,.25);
    box-shadow:0 10px 30px rgba(47,38,34,.12);
    backdrop-filter: blur(10px);
}
.dock a{
    width:44px;height:44px;border-radius:999px;
    display:inline-flex;align-items:center;justify-content:center;
    color:var(--cocoa-2);
    transition:background .2s ease, transform .2s ease, color .2s ease;
}
.dock a:hover{background:rgba(184,135,70,.14);transform:translateY(-1px)}
.dock a:active{transform:translateY(0)}

/* -- MUSIC -- */
.music-fab{
    position:fixed;right:1.1rem;top:1.1rem;z-index:260;
    width:46px;height:46px;border-radius:999px;
    display:flex;align-items:center;justify-content:center;
    background:rgba(255,255,255,.82);
    border:1px solid rgba(184,135,70,.3);
    box-shadow:0 10px 25px rgba(47,38,34,.12);
    cursor:pointer;
    transition:transform .2s ease, background .2s ease, color .2s ease;
}
.music-fab:hover{transform:translateY(-1px);background:var(--gold);color:#fff}
.music-fab.playing{animation:pulse 2s infinite}
{{ '@' }}keyframes pulse{
    0%{box-shadow:0 0 0 0 rgba(184,135,70,.45),0 10px 25px rgba(47,38,34,.12)}
    70%{box-shadow:0 0 0 14px rgba(184,135,70,0),0 10px 25px rgba(47,38,34,.12)}
    100%{box-shadow:0 0 0 0 rgba(184,135,70,0),0 10px 25px rgba(47,38,34,.12)}
}

/* -- COUPLE -- */
.couple-section{background:var(--paper)}
.couple-grid{
    margin-top:2.2rem;
    display:grid;
    grid-template-columns:repeat(2, minmax(0,1fr));
    gap:1.4rem;
}
.couple-card{
    background:linear-gradient(180deg, rgba(251,246,238,.9) 0%, rgba(244,234,220,.9) 100%);
    border:1px solid rgba(184,135,70,.22);
    border-radius:var(--radius);
    padding:2.2rem 1.4rem;
    box-shadow:0 10px 30px rgba(47,38,34,.08);
    position:relative;
    overflow:hidden;
}
.couple-card::before{
    content:'';position:absolute;inset:-40px;
    background-image:var(--batik);
    background-size:300px;
    opacity:.2;
    transform:rotate(8deg);
    pointer-events:none;
}
.couple-photo-wrap{position:relative;width:176px;height:176px;margin:0 auto 1rem}
.couple-photo{
    width:176px;height:176px;border-radius:50%;object-fit:cover;
    border:4px solid rgba(184,135,70,.45);
    box-shadow:0 16px 45px rgba(47,38,34,.14);
    position:relative;z-index:1;
}
.couple-frame{
    position:absolute;inset:-10px;border-radius:50%;
    pointer-events:none;z-index:2;
}
.couple-photo-placeholder{
    width:176px;height:176px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    background:linear-gradient(135deg, var(--cocoa-2), var(--cocoa));
    color:rgba(255,255,255,.9);
    font-size:3.3rem;
    border:4px solid rgba(184,135,70,.45);
}
.couple-name{font-size:1.55rem;position:relative;z-index:1}
.couple-role{
    margin-top:.25rem;
    font-size:.7rem;letter-spacing:4px;text-transform:uppercase;
    color:var(--gold);
    position:relative;z-index:1;
}
.couple-parent{
    margin-top:.95rem;
    color:var(--latte);
    line-height:1.85;
    font-size:.92rem;
    position:relative;z-index:1;
}
.couple-ig{margin-top:.8rem;position:relative;z-index:1}
.couple-ig a{
    display:inline-flex;align-items:center;gap:.45rem;
    color:var(--cocoa-2);
    font-size:.88rem;
    padding:.45rem .75rem;
    border-radius:999px;
    border:1px solid rgba(184,135,70,.22);
    background:rgba(255,255,255,.55);
    transition:background .2s ease, transform .2s ease;
}
.couple-ig a:hover{background:rgba(184,135,70,.12);transform:translateY(-1px)}

/* -- EVENTS -- */
.events-section{
    background:
        radial-gradient(900px 640px at 50% 0%, rgba(184,135,70,.14) 0%, transparent 55%),
        linear-gradient(180deg, var(--cream) 0%, var(--cream-2) 100%);
    position:relative;
    overflow:hidden;
}
.events-section::before{
    content:'';position:absolute;inset:0;
    background-image:var(--batik);
    background-size:360px;
    opacity:.16;
    pointer-events:none;
}
.events-grid{
    position:relative;
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(260px, 1fr));
    gap:1.1rem;
}
.event-card{
    background:rgba(255,255,255,.7);
    border:1px solid rgba(184,135,70,.22);
    border-radius:var(--radius);
    box-shadow:0 10px 28px rgba(47,38,34,.1);
    padding:1.6rem 1.25rem;
    backdrop-filter: blur(8px);
}
.event-icon{color:var(--gold);font-size:1.6rem;margin-bottom:.75rem}
.event-name{font-size:1.35rem;margin-bottom:.75rem}
.event-row{display:flex;gap:.6rem;align-items:flex-start;color:var(--latte);font-size:.92rem;line-height:1.6;margin-bottom:.35rem}
.event-row i{color:var(--gold);width:18px;flex-shrink:0;margin-top:2px}
.btn-map{
    margin-top:.9rem;
    display:inline-flex;align-items:center;gap:.5rem;
    padding:.6rem 1rem;
    border-radius:999px;
    border:1px solid rgba(184,135,70,.45);
    color:var(--cocoa-2);
    background:rgba(251,246,238,.75);
    font-size:.78rem;
    letter-spacing:3px;
    text-transform:uppercase;
    transition:transform .2s ease, background .2s ease;
}
.btn-map:hover{transform:translateY(-1px);background:rgba(184,135,70,.14)}

/* -- COUNTDOWN -- */
.countdown-section{background:var(--paper)}
.countdown-grid{
    display:grid;
    grid-template-columns:repeat(4, minmax(0, 1fr));
    gap:.85rem;
    max-width:720px;
    margin:0 auto;
}
.cd-item{
    padding:1.2rem 1rem;
    border-radius:16px;
    background:linear-gradient(180deg, rgba(251,246,238,.9) 0%, rgba(244,234,220,.9) 100%);
    border:1px solid rgba(184,135,70,.22);
    box-shadow:0 10px 24px rgba(47,38,34,.08);
}
.cd-num{font-size:2.15rem;font-weight:700;color:var(--cocoa-2);font-family:'Fraunces',serif}
.cd-lbl{margin-top:.2rem;font-size:.72rem;letter-spacing:4px;text-transform:uppercase;color:var(--gold)}
.cd-note{
    margin-top:1.2rem;
    color:var(--latte);
    text-align:center;
    font-size:.92rem;
}

/* -- STORY -- */
.story-section{
    background:
        linear-gradient(180deg, var(--cream) 0%, var(--cream-2) 100%);
}
.timeline{
    max-width:900px;margin:0 auto;
    position:relative;
    padding-left:1.25rem;
}
.timeline::before{
    content:'';position:absolute;left:8px;top:0;bottom:0;
    width:2px;background:linear-gradient(var(--gold), transparent);
    opacity:.6;
}
.story-item{
    position:relative;
    padding:1.2rem 1.2rem 1.2rem 1.6rem;
    margin-bottom:1rem;
    border-radius:var(--radius);
    background:rgba(255,255,255,.68);
    border:1px solid rgba(184,135,70,.2);
    box-shadow:0 10px 24px rgba(47,38,34,.08);
}
.story-item::before{
    content:'';position:absolute;left:-2px;top:1.6rem;
    width:14px;height:14px;border-radius:50%;
    background:var(--gold);
    box-shadow:0 0 0 6px rgba(184,135,70,.18);
}
.story-date{
    font-size:.7rem;letter-spacing:3px;text-transform:uppercase;
    color:var(--gold);
}
.story-title{margin-top:.35rem;font-size:1.2rem}
.story-text{margin-top:.45rem;color:var(--latte);line-height:1.85;font-size:.95rem}

/* -- GALLERY -- */
.gallery-section{background:var(--paper)}
.gallery-grid{
    display:grid;
    grid-template-columns:repeat(3, minmax(0, 1fr));
    gap:.85rem;
}
.g-item{
    border-radius:16px;
    overflow:hidden;
    border:1px solid rgba(184,135,70,.18);
    box-shadow:0 10px 24px rgba(47,38,34,.08);
    background:rgba(251,246,238,.7);
}
.g-item img{
    width:100%;
    height:100%;
    object-fit:cover;
    aspect-ratio: 1 / 1;
    transform:scale(1.02);
    transition:transform .5s ease;
}
.g-item:hover img{transform:scale(1.06)}
.gallery-empty{
    grid-column:1 / -1;
    padding:2.5rem 1.5rem;
    border-radius:var(--radius);
    text-align:center;
    color:var(--latte);
    border:1px dashed rgba(184,135,70,.3);
    background:rgba(251,246,238,.65);
}

/* -- GIFT -- */
.gift-section{
    background:
        radial-gradient(900px 640px at 50% 0%, rgba(184,135,70,.12) 0%, transparent 58%),
        linear-gradient(180deg, var(--cream) 0%, var(--cream-2) 100%);
}
.gift-box{
    max-width:820px;margin:0 auto;
    background:rgba(255,255,255,.74);
    border:1px solid rgba(184,135,70,.22);
    border-radius:24px;
    box-shadow:var(--shadow);
    padding:2rem 1.5rem;
    backdrop-filter: blur(10px);
}
.gift-text{color:var(--latte);line-height:1.85}
.bank-card{
    margin-top:1.2rem;
    padding:1.2rem 1.1rem;
    border-radius:18px;
    border:1px solid rgba(184,135,70,.22);
    background:rgba(251,246,238,.75);
    display:flex;justify-content:space-between;gap:1rem;flex-wrap:wrap;align-items:center;
}
.bank-left{display:flex;flex-direction:column;gap:.25rem}
.bank-name{font-weight:700}
.bank-code{font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, 'Liberation Mono', monospace;letter-spacing:.5px}
.btn-copy{
    display:inline-flex;align-items:center;gap:.55rem;
    padding:.7rem 1rem;
    border-radius:999px;
    border:1px solid rgba(184,135,70,.45);
    background:var(--gold);
    color:#fff;
    cursor:pointer;
    transition:transform .2s ease, filter .2s ease;
    font-size:.82rem;
}
.btn-copy:hover{transform:translateY(-1px);filter:brightness(1.03)}
.copy-hint{margin-top:.75rem;font-size:.85rem;color:var(--latte)}

/* -- WISHES / RSVP -- */
.form-wrap{
    max-width:840px;margin:0 auto;
    background:rgba(255,255,255,.74);
    border:1px solid rgba(184,135,70,.22);
    border-radius:24px;
    box-shadow:var(--shadow);
    padding:2rem 1.5rem;
    backdrop-filter: blur(10px);
}
.f-row{display:flex;flex-direction:column;gap:.4rem;margin-bottom:1rem}
.f-row label{font-size:.78rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold)}
.f-input{
    width:100%;
    padding:.9rem 1rem;
    border-radius:14px;
    border:1px solid rgba(184,135,70,.25);
    background:rgba(251,246,238,.75);
    outline:none;
    color:var(--cocoa-2);
    font-family:inherit;
}
textarea.f-input{min-height:120px;resize:vertical}
.f-input:focus{border-color:rgba(184,135,70,.55)}
.btn-send{
    width:100%;
    display:inline-flex;align-items:center;justify-content:center;gap:.6rem;
    padding:1rem 1.1rem;
    border-radius:16px;
    border:1px solid rgba(184,135,70,.5);
    background:linear-gradient(180deg, rgba(47,38,34,.95) 0%, rgba(59,47,42,.95) 100%);
    color:#fff;
    letter-spacing:2px;
    text-transform:uppercase;
    font-size:.8rem;
    cursor:pointer;
    transition:transform .2s ease, filter .2s ease;
}
.btn-send:hover{transform:translateY(-1px);filter:brightness(1.03)}
.btn-send:disabled{opacity:.7;cursor:not-allowed;transform:none}
.rsvp-msg{
    display:none;
    margin-top:1rem;
    padding:.9rem 1rem;
    border-radius:14px;
    font-size:.9rem;
    line-height:1.5;
}
.rsvp-msg.success{display:block;background:#f1fbf6;color:#1e6d3c;border-left:3px solid #1e6d3c}
.rsvp-msg.error{display:block;background:#fff4f4;color:#b12a2a;border-left:3px solid #b12a2a}
.rsvp-options{display:flex;gap:.75rem;margin:1.1rem 0 .9rem;flex-wrap:wrap}
.rsvp-option{
    flex:1;
    min-width:160px;
    padding:.85rem 1rem;
    border-radius:16px;
    border:1px solid rgba(184,135,70,.3);
    background:rgba(251,246,238,.7);
    cursor:pointer;
    letter-spacing:2px;
    text-transform:uppercase;
    font-size:.78rem;
    transition:background .2s ease, transform .2s ease;
}
.rsvp-option:hover{transform:translateY(-1px);background:rgba(184,135,70,.12)}
.rsvp-option.active{background:rgba(184,135,70,.18);border-color:rgba(184,135,70,.55)}

/* -- FOOTER -- */
.site-footer{
    padding:3.25rem 1.25rem;
    background:linear-gradient(180deg, var(--cocoa) 0%, #201a17 100%);
    color:rgba(255,255,255,.82);
    text-align:center;
    position:relative;
    overflow:hidden;
}
.site-footer::before{
    content:'';position:absolute;inset:0;
    background-image:var(--batik);
    background-size:360px;
    opacity:.18;
    pointer-events:none;
}
.footer-names{position:relative;z-index:1;font-size:2.7rem;color:#fff}
.footer-brand{position:relative;z-index:1;margin-top:1.1rem;font-size:.85rem;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.6)}

/* -- REVEAL -- */
.reveal{opacity:0;transform:translateY(26px);transition:opacity .75s ease, transform .75s ease}
.reveal.visible{opacity:1;transform:translateY(0)}

{{ '@' }}media (prefers-reduced-motion: reduce){
    html{scroll-behavior:auto}
    .reveal{transition:none}
    .btn-open,.btn-send,.dock a,.music-fab,.rsvp-option,.btn-map,.btn-copy{transition:none}
}

{{ '@' }}media(max-width:900px){
    .couple-grid{grid-template-columns:1fr}
    .gallery-grid{grid-template-columns:repeat(2, minmax(0, 1fr))}
    .countdown-grid{grid-template-columns:repeat(2, minmax(0, 1fr))}
}
{{ '@' }}media(max-width:520px){
    section{padding:4.4rem 1rem}
    .hero-inner{padding:2.3rem 1.25rem}
    .dock{gap:.35rem;padding:.45rem}
    .dock a{width:42px;height:42px}
    .gallery-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

{{-- -- COVER OVERLAY -- --}}
<div id="cover-overlay">
    <div class="cover-card reveal visible">
        <div class="cover-badge">
            <i class="fa-regular fa-calendar"></i>
            {{ Carbon::parse($weddingDate)->locale('id')->translatedFormat('d F Y') }}
        </div>

        <h1 class="cover-names script">
            {{ $maleName ?? $maleName }}
            <span class="amp">&</span>
            {{ $femaleName ?? $femaleName }}
        </h1>

        @if(!empty($coverContent ?? ''))
        <p class="cover-sub">{{ $coverContent }}</p>
        @elseif(!empty($quoteContent ?? ''))
        <p class="cover-sub">"{{ $quoteContent }}"</p>
        @endif

        @if($coverSrc)
        <img src="{{ $coverSrc }}" alt="cover" class="cover-photo" loading="lazy">
        @endif

        @if(($other['guest'] ?? null))
        <div class="cover-guest">
            Kepada Yth.
            <strong>{{ $other['guest']['name'] ?? '' }}</strong>
            @if(!empty($other['guest']['location'] ?? ''))
            <span style="display:block;margin-top:.2rem;font-size:.82rem;opacity:.9">di {{ $other['guest']['location'] }}</span>
            @endif
        </div>
        @endif

        <button class="btn-open" id="btnOpen">
            <i class="fa-solid fa-envelope-open-text"></i>
            {{ $coverButton }}
        </button>
    </div>
</div>

{{-- -- MAIN CONTENT -- --}}
<div id="main-content">

{{-- Music --}}
@if(!empty($musicUrl ?? null) && $showMusic)
<audio id="bgMusic" loop>
    <source src="{{ $musicUrl }}" type="audio/mpeg">
</audio>
<button class="music-fab" id="musicBtn" title="Musik">
    <i class="fa-solid fa-music"></i>
</button>
@endif

{{-- Dock Nav --}}
<nav class="dock" aria-label="Navigasi">
    <a href="#home" title="Beranda" aria-label="Beranda"><i class="fa-solid fa-house"></i></a>
    <a href="#couple" title="Mempelai" aria-label="Mempelai"><i class="fa-solid fa-user-group"></i></a>
    <a href="#events" title="Acara" aria-label="Acara"><i class="fa-regular fa-calendar-days"></i></a>
    <a href="#gallery" title="Galeri" aria-label="Galeri"><i class="fa-regular fa-images"></i></a>
    <a href="#rsvp" title="RSVP" aria-label="RSVP"><i class="fa-solid fa-circle-check"></i></a>
</nav>

{{-- -- HERO -- --}}
<section class="hero" id="home" @if($coverSrc) style="--hero-img:url('{{ $coverSrc }}');" @endif>
    <div class="hero-inner reveal">
        <p class="hero-eyebrow">Undangan Pernikahan</p>
        <h1 class="hero-names script">
            {{ $maleName ?? $maleName }}
            <span class="hero-amp">&</span>
            {{ $femaleName ?? $femaleName }}
        </h1>
        <div class="hero-date">
            <i class="fa-regular fa-clock" style="color:var(--gold)"></i>
            {{ Carbon::parse($weddingDate)->locale('id')->translatedFormat('l, d F Y') }} • {{ date('H:i', strtotime($weddingTime)) }} {{ $weddingTz }}
        </div>
        @if(!empty($quoteContent ?? ''))
        <p class="hero-quote">"{{ $quoteContent }}"</p>
        @endif
        @if($showClosing && !empty($data->detail->additional->opening ?? ''))
        <p class="hero-quote" style="font-style:normal;margin-top:1rem">{{ $data->detail->additional->opening }}</p>
        @endif
    </div>
    <div class="scroll-hint" aria-hidden="true">
        <span>Scroll</span>
        <i class="fa-solid fa-chevron-down"></i>
    </div>
</section>

{{-- -- COUPLE -- --}}
<section class="couple-section" id="couple">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Mempelai</p>
            <h2 class="sec-title">Dua Hati, Satu Tujuan</h2>
            <div class="sec-divider"></div>
        </div>

        <div class="couple-grid reveal">
            <div class="couple-card">
                <div class="couple-photo-wrap">
                    @if($maleSrc)
                    <img src="{{ $maleSrc }}" alt="{{ $maleName }}" class="couple-photo" loading="lazy">
                    @if(!empty($maleFrame))
                    <img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" class="couple-frame" loading="lazy">
                    @endif
                    @else
                    <div class="couple-photo-placeholder"><i class="fa-solid fa-user"></i></div>
                    @endif
                </div>
                <h3 class="couple-name">{{ $maleName }}</h3>
                <p class="couple-role">Mempelai Pria</p>
                @if($showParent)
                <p class="couple-parent">
                    Putra ke-{{ $maleChildhood }} dari<br>
                    Bapak {{ $maleFather }}<br>
                    &amp; Ibu {{ $maleMother }}
                </p>
                @endif
                @if($showIg && !empty($maleIg ?? ''))
                <div class="couple-ig">
                    <a href="https://instagram.com/{{ $maleIg }}" target="_blank" rel="noopener">
                        <i class="fa-brands fa-instagram"></i> @{{ $maleIg }}
                    </a>
                </div>
                @endif
            </div>

            <div class="couple-card">
                <div class="couple-photo-wrap">
                    @if($femaleSrc)
                    <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo" loading="lazy">
                    @if(!empty($femaleFrame))
                    <img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame" loading="lazy">
                    @endif
                    @else
                    <div class="couple-photo-placeholder"><i class="fa-solid fa-user"></i></div>
                    @endif
                </div>
                <h3 class="couple-name">{{ $femaleName }}</h3>
                <p class="couple-role">Mempelai Wanita</p>
                @if($showParent)
                <p class="couple-parent">
                    Putri ke-{{ $femaleChildhood }} dari<br>
                    Bapak {{ $femaleFather }}<br>
                    &amp; Ibu {{ $femaleMother }}
                </p>
                @endif
                @if($showIg && !empty($femaleIg ?? ''))
                <div class="couple-ig">
                    <a href="https://instagram.com/{{ $femaleIg }}" target="_blank" rel="noopener">
                        <i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- -- EVENTS -- --}}
@if(count($other['event'] ?? []) > 0)
<section class="events-section" id="events">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Acara</p>
            <h2 class="sec-title">{{ $data->detail->event->title ?? 'Save the Date' }}</h2>
            <div class="sec-divider"></div>
        </div>

        <div class="events-grid">
            @foreach($other['event'] as $ev)
            @php $ev->prop = json_decode($ev->content); @endphp
            @if($ev->prop)
            <div class="event-card reveal">
                <div class="event-icon"><i class="fa-solid fa-champagne-glasses"></i></div>
                <h3 class="event-name">{{ $ev->title ?? 'Acara' }}</h3>
                <div class="event-row">
                    <i class="fa-regular fa-clock"></i>
                    <div>
                        {{ date('H:i', strtotime($ev->prop->time->start ?? '00:00')) }}
                        @if(($ev->prop->time->done ?? false) === true)
                        - Selesai
                        @else
                        - {{ date('H:i', strtotime($ev->prop->time->end ?? '00:00')) }}
                        @endif
                        <span style="opacity:.9">({{ $weddingTz }})</span>
                    </div>
                </div>
                @if(!empty($ev->prop->location->address ?? ''))
                <div class="event-row">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>{{ $ev->prop->location->address }}</div>
                </div>
                @endif
                @if(!empty($ev->prop->location->map ?? ''))
                <a class="btn-map" href="{{ $ev->prop->location->map }}" target="_blank" rel="noopener">
                    <i class="fa-solid fa-map-location-dot"></i> Lihat Peta
                </a>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- -- COUNTDOWN -- --}}
<section class="countdown-section" id="countdown">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Hitung Mundur</p>
            <h2 class="sec-title">Menuju Hari Bahagia</h2>
            <div class="sec-divider"></div>
        </div>

        <div class="countdown-grid reveal" id="countdownGrid">
            <div class="cd-item"><div class="cd-num" id="cd-days">00</div><div class="cd-lbl">Hari</div></div>
            <div class="cd-item"><div class="cd-num" id="cd-hours">00</div><div class="cd-lbl">Jam</div></div>
            <div class="cd-item"><div class="cd-num" id="cd-minutes">00</div><div class="cd-lbl">Menit</div></div>
            <div class="cd-item"><div class="cd-num" id="cd-seconds">00</div><div class="cd-lbl">Detik</div></div>
        </div>
        <p class="cd-note reveal">Semoga langkah kita selalu diberkahi.</p>
    </div>
</section>

{{-- -- STORY -- --}}
@if(count($other['story'] ?? []) > 0)
<section class="story-section" id="story">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Cerita</p>
            <h2 class="sec-title">{{ $data->story->title ?? 'Kisah Kami' }}</h2>
            <div class="sec-divider"></div>
        </div>

        <div class="timeline">
            @foreach($other['story'] as $st)
            @php $st->prop = json_decode($st->content); @endphp
            <div class="story-item reveal">
                @if(!empty($st->prop->date ?? ''))
                <div class="story-date">{{ Carbon::parse($st->prop->date)->locale('id')->translatedFormat('d F Y') }}</div>
                @endif
                <div class="story-title">{{ $st->title ?? '' }}</div>
                @if(!empty($st->prop->content ?? ''))
                <div class="story-text">{{ $st->prop->content }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- -- GALLERY -- --}}
<section class="gallery-section" id="gallery">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Galeri</p>
            <h2 class="sec-title">{{ ($other['photo'] ?? null) ? ($other['photo']->title ?? 'Momen Berharga') : 'Momen Berharga' }}</h2>
            <div class="sec-divider"></div>
        </div>

        @if(($other['photo'] ?? null) && !empty($other['photo']->prop->file ?? []))
        <div class="gallery-grid">
            @foreach($other['photo']->prop->file as $i => $gf)
            <div class="g-item reveal">
                <img src="{{ url('storage/'.$gf) }}" alt="gallery {{ $i+1 }}" loading="lazy">
            </div>
            @endforeach
        </div>
        @else
        <div class="gallery-grid">
            <div class="gallery-empty">Belum ada foto galeri.</div>
        </div>
        @endif
    </div>
</section>

{{-- -- GIFT -- --}}
@if($showGift)
<section class="gift-section" id="gift">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Hadiah</p>
            <h2 class="sec-title">{{ $giftTitle ?? 'Wedding Gift' }}</h2>
            <div class="sec-divider"></div>
        </div>

        <div class="gift-box reveal">
            @if(!empty($giftContent ?? ''))
            <p class="gift-text">{{ $giftContent }}</p>
            @endif

            <div class="bank-card">
                <div class="bank-left">
                    <div class="bank-name">{{ $giftBank ?? 'Bank' }}</div>
                    <div class="bank-code" id="bankCode">{{ $giftCode ?? '' }}</div>
                    <div style="color:var(--latte);font-size:.9rem">a.n {{ $giftName ?? '' }}</div>
                </div>
                <button type="button" class="btn-copy" onclick="copyAcc()">
                    <i class="fa-regular fa-copy"></i> Salin Nomor
                </button>
            </div>
            <div class="copy-hint" id="copyHint" style="display:none">Nomor rekening tersalin.</div>
        </div>
    </div>
</section>
@endif

{{-- -- WISHES -- --}}
@if($showWishes)
<section class="wishes-section" id="wishes">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Ucapan</p>
            <h2 class="sec-title">{{ $wishesTitle ?? 'Ucapan & Doa' }}</h2>
            <div class="sec-divider"></div>
            @if(!empty($wishesContent ?? ''))
            <p style="margin-top:1rem;color:var(--latte);line-height:1.8">{{ $wishesContent }}</p>
            @endif
        </div>

        <div class="form-wrap reveal">
            <form id="wishesForm" action="{{ route('invitation.wish', request()->route('slug') ?? '') }}" method="post">
                @csrf
                <div class="f-row">
                    <label>Nama</label>
                    <input class="f-input" type="text" name="name" placeholder="Nama Anda" required>
                </div>
                <div class="f-row">
                    <label>No. WhatsApp</label>
                    <input class="f-input" type="text" name="phone" placeholder="08xxxxxxxxxx" required>
                </div>
                <div class="f-row">
                    <label>Ucapan &amp; Doa</label>
                    <textarea class="f-input" name="message" placeholder="Tulis ucapan..." required></textarea>
                </div>
                <button type="submit" class="btn-send">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Ucapan
                </button>
                <div class="rsvp-msg" id="wishMsg"></div>
            </form>
        </div>
    </div>
</section>
@endif

{{-- -- RSVP -- --}}
<section class="rsvp-section" id="rsvp">
    <div class="section-inner">
        <div class="sec-head reveal">
            <p class="sec-label">Konfirmasi</p>
            <h2 class="sec-title">{{ $rsvpTitle ?? 'Konfirmasi Kehadiran' }}</h2>
            <div class="sec-divider"></div>
            @if(!empty($rsvpContent ?? ''))
            <p style="margin-top:1rem;color:var(--latte);line-height:1.8">{{ $rsvpContent }}</p>
            @endif
        </div>

        <div class="form-wrap reveal">
            <form id="rsvpForm" action="{{ route('invitation.present', request()->route('slug') ?? '') }}" method="post">
                @csrf
                <input type="hidden" name="option" id="rsvpOption" value="">
                <div class="rsvp-options">
                    <button type="button" class="rsvp-option" onclick="setRsvp(this,'yes')">
                        <i class="fa-solid fa-check" style="margin-right:.35rem"></i> {{ $rsvpYes ?? 'Hadir' }}
                    </button>
                    <button type="button" class="rsvp-option" onclick="setRsvp(this,'no')">
                        <i class="fa-solid fa-xmark" style="margin-right:.35rem"></i> {{ $rsvpNo ?? 'Tidak Hadir' }}
                    </button>
                </div>
                <div class="f-row">
                    <label>Nama</label>
                    <input class="f-input" type="text" name="name" placeholder="Nama Anda" required>
                </div>
                <div class="f-row">
                    <label>Jumlah Tamu</label>
                    <input class="f-input" type="number" name="amount" placeholder="Jumlah tamu" min="1" value="1">
                </div>
                <button type="submit" class="btn-send">
                    <i class="fa-solid fa-envelope-circle-check"></i> Kirim Konfirmasi
                </button>
                <div class="rsvp-msg" id="rsvpMsg"></div>
            </form>
        </div>
    </div>
</section>

{{-- -- FOOTER -- --}}
<footer class="site-footer">
    <p class="script footer-names">{{ $maleName ?? $maleName }} &amp; {{ $femaleName ?? $femaleName }}</p>
    @if($showClosing && !empty($closingText ?? ''))
    <p style="position:relative;z-index:1;margin-top:.65rem;font-size:.92rem;line-height:1.8;color:rgba(255,255,255,.75)">
        {{ $closingText }}
    </p>
    @endif
    <p class="footer-brand">Risa Digital Invitation</p>
</footer>

</div>{{-- end #main-content --}}

<script>
// -- Open invitation
document.getElementById('btnOpen')?.addEventListener('click', function() {
    document.getElementById('cover-overlay')?.classList.add('hidden');
    document.getElementById('main-content')?.classList.add('visible');
    @if(!empty($musicUrl ?? null) && $showMusic)
    setTimeout(() => { document.getElementById('bgMusic')?.play().catch(()=>{}); }, 450);
    @endif
});

// -- Music toggle
@if(!empty($musicUrl ?? null) && $showMusic)
const bgMusic = document.getElementById('bgMusic');
const musicBtn = document.getElementById('musicBtn');
musicBtn?.addEventListener('click', function() {
    if (!bgMusic) return;
    if (bgMusic.paused) {
        bgMusic.play();
        musicBtn.classList.add('playing');
        musicBtn.innerHTML = '<i class="fa-solid fa-pause"></i>';
    } else {
        bgMusic.pause();
        musicBtn.classList.remove('playing');
        musicBtn.innerHTML = '<i class="fa-solid fa-music"></i>';
    }
});
@endif

// -- Countdown
(function() {
    const target = new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');
    const grid = document.getElementById('countdownGrid');
    function tick() {
        const now = new Date();
        const diff = target - now;
        if (diff <= 0) {
            if (grid) grid.innerHTML = '<p style="color:var(--gold);font-size:1.05rem;letter-spacing:2px;text-align:center;grid-column:1/-1">Hari Bahagia Telah Tiba</p>';
            return;
        }
        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = String(val).padStart(2,'0'); };
        set('cd-days', d);
        set('cd-hours', h);
        set('cd-minutes', m);
        set('cd-seconds', s);
    }
    tick();
    setInterval(tick, 1000);
})();

// -- RSVP option
function setRsvp(el, val) {
    document.querySelectorAll('.rsvp-option').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('rsvpOption').value = val;
}

// -- Copy account number
function copyAcc() {
    const el = document.getElementById('bankCode');
    const hint = document.getElementById('copyHint');
    if (!el) return;
    const text = (el.textContent || '').trim();
    if (!text) return;
    navigator.clipboard?.writeText(text)
        .then(() => {
            if (hint) {
                hint.style.display = 'block';
                clearTimeout(window.__copyHintT);
                window.__copyHintT = setTimeout(() => { hint.style.display = 'none'; }, 1800);
            }
        })
        .catch(()=>{});
}

// -- AJAX forms
function ajaxForm(formId, msgId) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const msg = document.getElementById(msgId);
        const btn = form.querySelector('button[type=submit]');
        if (btn) btn.disabled = true;
        const fd = new FormData(form);
        fetch(form.action, { method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => {
                if (!msg) return;
                msg.className = 'rsvp-msg success';
                msg.textContent = data.message || 'Terkirim!';
                form.reset();
                document.querySelectorAll('.rsvp-option').forEach(b => b.classList.remove('active'));
            })
            .catch(() => {
                if (!msg) return;
                msg.className = 'rsvp-msg error';
                msg.textContent = 'Terjadi kesalahan. Coba lagi.';
            })
            .finally(() => { if (btn) btn.disabled = false; });
    });
}
ajaxForm('wishesForm', 'wishMsg');
ajaxForm('rsvpForm', 'rsvpMsg');

// -- Scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('visible');
            observer.unobserve(e.target);
        }
    });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => {
    if (el.classList.contains('visible')) return;
    observer.observe(el);
});
</script>

</body>
</html>
