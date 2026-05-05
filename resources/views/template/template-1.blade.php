
@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:title" content="Wedding of {{ $femaleNickname }} & {{ $maleNickname }}">
<meta name="theme-color" content="#c9a84c">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,600&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ===== GOLD LUXE — Elegant Exotic Wedding Template ===== */
:root {
    --gold:        #c9a84c;
    --gold-light:  #e8d5a3;
    --gold-pale:   #f5edd8;
    --gold-dark:   #a07830;
    --dark:        #0f0f0f;
    --dark-2:      #1a1a1a;
    --dark-3:      #242424;
    --cream:       #faf7f0;
    --cream-2:     #f5f0e6;
    --white:       #ffffff;
    --gray:        #7a7a7a;
    --gray-light:  #b0a898;
    /* shared vars for rsvp-wishes partial */
    --color-primary:  #c9a84c;
    --color-muted:    rgba(15,15,15,.55);
    --section-bg:     #faf7f0;
    --card-bg:        #ffffff;
    --rsvp-bg:        #f5f0e6;
    --font-heading:   'Cormorant Garamond', serif;
}
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior:smooth; font-size:16px; }
body {
    font-family: 'Jost', sans-serif;
    font-weight: 300;
    background: var(--cream);
    color: var(--dark);
    overflow-x: hidden;
    line-height: 1.7;
}
img { display:block; max-width:100%; }
a { color:inherit; text-decoration:none; }
h1,h2,h3,h4 { font-family:'Cormorant Garamond',serif; font-weight:400; line-height:1.1; }

/* ── ORNAMENT SVG inline ── */
.orn { display:block; margin:0 auto; }

/* ── GOLD DIVIDER ── */
.g-divider {
    display:flex; align-items:center; justify-content:center;
    gap:.8rem; margin:1.5rem auto;
}
.g-divider::before, .g-divider::after {
    content:''; flex:1; max-width:60px; height:1px;
    background:linear-gradient(90deg, transparent, var(--gold));
}
.g-divider::after { background:linear-gradient(90deg, var(--gold), transparent); }
.g-divider-icon { color:var(--gold); font-size:.7rem; opacity:.8; }

/* ── SECTION LABEL ── */
.sec-eyebrow {
    font-family:'Jost',sans-serif;
    font-size:.6rem; font-weight:500;
    letter-spacing:.5em; text-transform:uppercase;
    color:var(--gold); margin-bottom:.6rem;
}
.sec-title {
    font-size:clamp(1.9rem,4vw,2.8rem);
    color:var(--dark); font-weight:300;
}
.sec-title em { font-style:italic; color:var(--gold-dark); }
.sec-head { text-align:center; margin-bottom:3.5rem; }

/* ══════════════════════════════════════════
   COVER OVERLAY
══════════════════════════════════════════ */
#cover {
    position:fixed; inset:0; z-index:9999;
    background:var(--dark);
    display:flex; align-items:center; justify-content:center;
    text-align:center; padding:2rem;
    transition:opacity .9s ease, visibility .9s ease;
}
#cover.gone { opacity:0; visibility:hidden; pointer-events:none; }

/* decorative corner frames */
.cover-corner {
    position:absolute; width:60px; height:60px;
    border-color:rgba(201,168,76,.4); border-style:solid;
    pointer-events:none;
}
.cover-corner.tl { top:24px; left:24px; border-width:1px 0 0 1px; }
.cover-corner.tr { top:24px; right:24px; border-width:1px 1px 0 0; }
.cover-corner.bl { bottom:24px; left:24px; border-width:0 0 1px 1px; }
.cover-corner.br { bottom:24px; right:24px; border-width:0 1px 1px 0; }

/* inner border */
.cover-frame {
    position:absolute; inset:40px;
    border:1px solid rgba(201,168,76,.12);
    pointer-events:none;
}

.cover-inner { position:relative; z-index:1; max-width:520px; width:100%; }

.cover-photo-wrap {
    width:120px; height:120px; border-radius:50%;
    margin:0 auto 1.8rem;
    border:1px solid rgba(201,168,76,.5);
    padding:4px;
    background:rgba(201,168,76,.06);
}
.cover-photo-wrap img {
    width:100%; height:100%; border-radius:50%; object-fit:cover;
}

.cover-eyebrow {
    font-size:.58rem; letter-spacing:.55em; text-transform:uppercase;
    color:rgba(201,168,76,.7); margin-bottom:1.2rem;
}
.cover-names {
    font-size:clamp(2.2rem,7vw,4.2rem);
    color:var(--white); line-height:1.05;
    font-weight:300;
}
.cover-amp {
    display:block; font-style:italic;
    font-size:clamp(1.4rem,4.5vw,2.8rem);
    color:var(--gold); margin:.2rem 0;
}
.cover-rule {
    width:80px; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
    margin:1.4rem auto;
}
.cover-date {
    font-size:.68rem; letter-spacing:.4em; text-transform:uppercase;
    color:rgba(255,255,255,.45);
}
.cover-guest {
    margin-top:1rem;
    font-size:.78rem; color:rgba(255,255,255,.4);
}
.cover-guest strong {
    display:block; color:var(--gold-light);
    font-size:.88rem; font-weight:400; margin-top:.2rem;
}
.btn-open {
    display:inline-flex; align-items:center; gap:.6rem;
    margin-top:2rem; padding:.75rem 2.2rem;
    border:1px solid rgba(201,168,76,.6);
    color:var(--gold); background:transparent;
    font-family:'Jost',sans-serif;
    font-size:.68rem; font-weight:500;
    letter-spacing:.35em; text-transform:uppercase;
    cursor:pointer; transition:all .35s ease;
}
.btn-open:hover {
    background:var(--gold); color:var(--dark);
    border-color:var(--gold);
}

/* ══════════════════════════════════════════
   MAIN CONTENT
══════════════════════════════════════════ */
#main { display:none; }
#main.on { display:block; }

/* ── HERO ── */
.hero {
    min-height:100vh;
    background:var(--dark);
    display:flex; align-items:center; justify-content:center;
    text-align:center; padding:5rem 2rem 4rem;
    position:relative; overflow:hidden;
}
.hero-glow {
    position:absolute; inset:0; pointer-events:none;
    background:
        radial-gradient(ellipse 60% 50% at 50% 40%, rgba(201,168,76,.07) 0%, transparent 70%),
        radial-gradient(ellipse 40% 30% at 20% 80%, rgba(201,168,76,.04) 0%, transparent 60%);
}
.hero-lines {
    position:absolute; inset:30px;
    border:1px solid rgba(201,168,76,.06);
    pointer-events:none;
}
.hero-inner { position:relative; z-index:1; max-width:700px; }
.hero-eyebrow {
    font-size:.58rem; letter-spacing:.55em; text-transform:uppercase;
    color:rgba(201,168,76,.6); margin-bottom:2rem;
}
.hero-names {
    font-size:clamp(3rem,9vw,6.5rem);
    color:var(--white); line-height:.95; font-weight:300;
}
.hero-amp {
    display:block; font-style:italic;
    font-size:clamp(2rem,6vw,4.5rem);
    color:var(--gold); margin:.25rem 0;
}
.hero-rule {
    width:60px; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
    margin:2rem auto;
}
.hero-date {
    font-size:.68rem; letter-spacing:.4em; text-transform:uppercase;
    color:rgba(255,255,255,.4);
}
.hero-quote {
    font-family:'Cormorant Garamond',serif;
    font-size:1.05rem; font-style:italic;
    color:rgba(255,255,255,.3);
    margin-top:1.8rem; max-width:420px; margin-left:auto; margin-right:auto;
    line-height:1.6;
}

/* ── COUPLE ── */
.couple-section {
    padding:6rem 2rem;
    background:var(--cream);
    position:relative;
}
.couple-section::before {
    content:'';
    position:absolute; top:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold-light),transparent);
}
.couple-section::after {
    content:'';
    position:absolute; bottom:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold-light),transparent);
}
.couple-wrap {
    max-width:860px; margin:0 auto;
    display:grid; grid-template-columns:1fr 48px 1fr;
    align-items:center; gap:2rem;
}
.couple-card { text-align:center; }
.couple-photo-outer {
    position:relative; display:inline-block;
    margin-bottom:1.6rem;
}
/* gold ring around photo */
.couple-photo-outer::before {
    content:'';
    position:absolute; inset:-6px; border-radius:50%;
    border:1px solid rgba(201,168,76,.35);
    pointer-events:none;
}
.couple-photo-outer::after {
    content:'';
    position:absolute; inset:-12px; border-radius:50%;
    border:1px solid rgba(201,168,76,.12);
    pointer-events:none;
}
.couple-photo {
    width:190px; height:190px; border-radius:50%;
    object-fit:cover;
    border:2px solid var(--gold-light);
}
.couple-placeholder {
    width:190px; height:190px; border-radius:50%;
    background:var(--dark-2);
    display:flex; align-items:center; justify-content:center;
    color:var(--gold);
    font-family:'Cormorant Garamond',serif;
    font-size:3.5rem; font-style:italic;
    border:2px solid var(--gold-light);
}
.couple-frame-img {
    position:absolute; inset:-6px; border-radius:50%;
    pointer-events:none; width:calc(100% + 12px); height:calc(100% + 12px);
    top:-6px; left:-6px;
}
.couple-name {
    font-size:1.9rem; color:var(--dark);
    margin-bottom:.25rem; font-weight:400;
}
.couple-role {
    font-size:.58rem; letter-spacing:.4em; text-transform:uppercase;
    color:var(--gold); margin-bottom:.8rem;
}
.couple-parent {
    font-size:.8rem; color:var(--gray); line-height:1.9;
}
.couple-ig {
    font-size:.75rem; color:var(--gold-dark); margin-top:.5rem;
}
.couple-sep {
    display:flex; flex-direction:column;
    align-items:center; gap:.5rem;
}
.sep-line {
    width:1px; height:55px;
    background:linear-gradient(180deg,transparent,var(--gold-light),transparent);
}
.sep-diamond {
    width:8px; height:8px;
    background:var(--gold); transform:rotate(45deg);
    flex-shrink:0;
}

/* ── EVENTS ── */
.events-section {
    padding:6rem 2rem;
    background:var(--white);
    position:relative;
}
.events-grid {
    max-width:900px; margin:0 auto;
    display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:1.5rem;
}
.event-card {
    padding:2.5rem 2rem;
    border:1px solid var(--gold-pale);
    text-align:center; position:relative;
    background:var(--cream);
    transition:box-shadow .3s ease;
}
.event-card:hover {
    box-shadow:0 8px 40px rgba(201,168,76,.12);
}
/* inner decorative border */
.event-card::before {
    content:''; position:absolute;
    inset:7px; border:1px solid rgba(201,168,76,.18);
    pointer-events:none;
}
.event-icon {
    font-size:1.4rem; color:var(--gold);
    margin-bottom:1rem; opacity:.8;
}
.event-name {
    font-size:1.55rem; color:var(--dark);
    margin-bottom:.8rem; font-weight:400;
}
.event-time {
    font-size:.72rem; color:var(--gold-dark);
    letter-spacing:.15em; margin-bottom:.4rem;
}
.event-loc {
    font-size:.82rem; color:var(--gray); line-height:1.7;
    margin-top:.5rem;
}
.event-map {
    display:inline-flex; align-items:center; gap:.4rem;
    margin-top:1.2rem; font-size:.68rem;
    letter-spacing:.2em; text-transform:uppercase;
    color:var(--gold); border-bottom:1px solid var(--gold-pale);
    padding-bottom:2px; transition:color .3s;
}
.event-map:hover { color:var(--gold-dark); }

/* ── COUNTDOWN ── */
.countdown-section {
    padding:5rem 2rem;
    background:var(--dark-2);
    text-align:center; position:relative; overflow:hidden;
}
.countdown-section::before {
    content:'';
    position:absolute; top:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
}
.countdown-section::after {
    content:'';
    position:absolute; bottom:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
}
.countdown-grid {
    display:flex; justify-content:center;
    gap:0; flex-wrap:wrap; margin-top:2.5rem;
}
.cd-item {
    min-width:100px; text-align:center;
    padding:1.5rem 1rem;
    border-right:1px solid rgba(201,168,76,.12);
}
.cd-item:last-child { border-right:none; }
.cd-num {
    font-family:'Cormorant Garamond',serif;
    font-size:3.8rem; color:var(--gold);
    line-height:1; display:block; font-weight:300;
}
.cd-lbl {
    font-size:.55rem; letter-spacing:.4em; text-transform:uppercase;
    color:rgba(255,255,255,.3); margin-top:.4rem;
}

/* ── STORY ── */
.story-section {
    padding:6rem 2rem;
    background:var(--cream-2);
}
.story-timeline {
    max-width:680px; margin:0 auto;
    position:relative; padding-left:2rem;
}
.story-timeline::before {
    content:''; position:absolute;
    left:0; top:0; bottom:0; width:1px;
    background:linear-gradient(180deg,transparent,var(--gold-light) 20%,var(--gold-light) 80%,transparent);
}
.story-item {
    position:relative; margin-bottom:2.5rem;
    padding-left:1.8rem;
}
.story-dot {
    position:absolute; left:-2.4rem; top:.35rem;
    width:14px; height:14px;
    background:var(--cream-2); border:1px solid var(--gold);
    transform:rotate(45deg);
}
.story-yr {
    font-size:.6rem; letter-spacing:.4em; text-transform:uppercase;
    color:var(--gold); margin-bottom:.3rem;
}
.story-ttl {
    font-size:1.25rem; color:var(--dark); margin-bottom:.4rem;
}
.story-desc {
    font-size:.83rem; color:var(--gray); line-height:1.8;
}

/* ── GALLERY ── */
.gallery-section {
    padding:6rem 2rem;
    background:var(--dark);
}
.gallery-section .sec-eyebrow { color:rgba(201,168,76,.6); }
.gallery-section .sec-title { color:var(--white); }
.gallery-grid {
    max-width:1100px; margin:2rem auto 0;
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:4px;
}
.g-item { overflow:hidden; aspect-ratio:1; position:relative; }
.g-item.wide { grid-column:span 2; aspect-ratio:2/1; }
.g-item img {
    width:100%; height:100%; object-fit:cover;
    transition:transform .7s ease; display:block;
}
.g-item:hover img { transform:scale(1.06); }
/* gold overlay on hover */
.g-item::after {
    content:''; position:absolute; inset:0;
    background:rgba(201,168,76,.0);
    transition:background .4s ease;
    pointer-events:none;
}
.g-item:hover::after { background:rgba(201,168,76,.08); }

/* ── GIFT ── */
.gift-section {
    padding:6rem 2rem;
    background:var(--cream); text-align:center;
}
.gift-card {
    display:inline-block; max-width:380px; width:100%;
    padding:2.8rem 2.5rem;
    border:1px solid var(--gold-pale);
    margin-top:2rem; position:relative;
    background:var(--white);
}
.gift-card::before {
    content:''; position:absolute;
    inset:7px; border:1px solid rgba(201,168,76,.15);
    pointer-events:none;
}
.gift-bank {
    font-size:.6rem; letter-spacing:.45em; text-transform:uppercase;
    color:var(--gold); margin-bottom:.6rem;
}
.gift-num {
    font-family:'Cormorant Garamond',serif;
    font-size:2.1rem; color:var(--dark);
    margin:.3rem 0; font-weight:400; letter-spacing:.05em;
}
.gift-name { font-size:.8rem; color:var(--gray); }
.btn-copy {
    display:inline-flex; align-items:center; gap:.5rem;
    margin-top:1.2rem; padding:.65rem 1.8rem;
    border:1px solid rgba(201,168,76,.5);
    color:var(--gold); background:transparent;
    font-family:'Jost',sans-serif;
    font-size:.65rem; font-weight:500;
    letter-spacing:.3em; text-transform:uppercase;
    cursor:pointer; transition:all .3s ease;
}
.btn-copy:hover { background:var(--gold); color:var(--dark); border-color:var(--gold); }

/* ── MUSIC FAB ── */
.music-fab {
    position:fixed; bottom:2rem; right:2rem; z-index:200;
    width:46px; height:46px; border-radius:50%;
    background:var(--dark-2); color:var(--gold);
    border:1px solid rgba(201,168,76,.5);
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; font-size:1rem;
    box-shadow:0 4px 20px rgba(0,0,0,.4);
    transition:all .3s ease;
}
.music-fab:hover { background:var(--gold); color:var(--dark); }

/* ── FOOTER ── */
.site-footer {
    background:var(--dark);
    color:rgba(255,255,255,.35);
    text-align:center; padding:5rem 2rem;
    position:relative;
}
.site-footer::before {
    content:'';
    position:absolute; top:0; left:0; right:0; height:1px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
}
.footer-names {
    font-size:clamp(2.5rem,7vw,4rem);
    color:var(--white); margin-bottom:.5rem; font-weight:300;
}
.footer-closing {
    font-size:.85rem; color:rgba(255,255,255,.4);
    margin-top:.5rem; font-style:italic;
}
.footer-brand {
    font-size:.55rem; letter-spacing:.5em; text-transform:uppercase;
    color:rgba(201,168,76,.5); margin-top:2rem;
}

/* ── REVEAL ANIMATION ── */
.reveal { opacity:0; transform:translateY(22px); transition:opacity .75s ease, transform .75s ease; }
.reveal.in { opacity:1; transform:none; }

/* ══════════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════════ */
{{ '@' }}media (max-width:768px) {
    .couple-wrap { grid-template-columns:1fr; gap:2.5rem; }
    .couple-sep { flex-direction:row; justify-content:center; }
    .sep-line { width:50px; height:1px;
        background:linear-gradient(90deg,transparent,var(--gold-light),transparent); }
    .gallery-grid { grid-template-columns:repeat(2,1fr); }
    .g-item.wide { grid-column:span 2; aspect-ratio:1; }
    .countdown-grid { gap:0; }
    .cd-item { min-width:80px; padding:1.2rem .6rem; }
    .cd-num { font-size:3rem; }
    .cover-corner { width:40px; height:40px; }
}
{{ '@' }}media (max-width:480px) {
    .gallery-grid { grid-template-columns:1fr; }
    .g-item.wide { grid-column:span 1; aspect-ratio:1; }
    .cd-item { min-width:70px; }
    .cd-num { font-size:2.5rem; }
    .hero-names { font-size:clamp(2.5rem,9vw,4rem); }
}
</style>
</head>
<body>


{{-- ══ COVER OVERLAY ══ --}}
<div id="cover">
    <div class="cover-corner tl"></div>
    <div class="cover-corner tr"></div>
    <div class="cover-corner bl"></div>
    <div class="cover-corner br"></div>
    <div class="cover-frame"></div>

    <div class="cover-inner">
        @if($coverSrc)
        <div class="cover-photo-wrap">
            <img src="{{ $coverSrc }}" alt="foto sampul">
        </div>
        @endif

        <p class="cover-eyebrow">The Wedding of</p>
        <h1 class="cover-names">
            {{ $femaleNickname }}
            <span class="cover-amp">&amp;</span>
            {{ $maleNickname }}
        </h1>
        <div class="cover-rule"></div>
        <p class="cover-date">{{ $weddingDateShort }}</p>

        @if($other['guest'])
        <div class="cover-guest">
            Kepada Yth.
            <strong>{{ $other['guest']['name'] ?? '' }}</strong>
        </div>
        @endif

        <button class="btn-open" id="btnOpen">
            <i class="fa-regular fa-envelope"></i>
            {{ $coverButton }}
        </button>
    </div>
</div>

{{-- ══ MAIN CONTENT ══ --}}
<div id="main">

@if($showMusic && $musicUrl)
<audio id="bgAudio" loop><source src="{{ $musicUrl }}" type="audio/mpeg"></audio>
<button class="music-fab" id="musicFab" title="Musik">
    <i class="fa-solid fa-music"></i>
</button>
@endif

{{-- HERO --}}
<section class="hero">
    <div class="hero-glow"></div>
    <div class="hero-lines"></div>
    <div class="hero-inner reveal">
        <p class="hero-eyebrow">The Wedding of</p>
        <h1 class="hero-names">
            {{ $femaleNickname }}
            <span class="hero-amp">&amp;</span>
            {{ $maleNickname }}
        </h1>
        <div class="hero-rule"></div>
        <p class="hero-date">{{ $weddingDateFormatted }}</p>
        @if($quoteContent)
        <p class="hero-quote">&ldquo;{{ $quoteContent }}&rdquo;</p>
        @endif
    </div>
</section>

{{-- COUPLE --}}
<section class="couple-section">
    <div class="sec-head reveal">
        <p class="sec-eyebrow">Mempelai</p>
        <h2 class="sec-title">Dua Hati <em>Menjadi Satu</em></h2>
        <div class="g-divider"><span class="g-divider-icon">&#x2666;</span></div>
    </div>
    <div class="couple-wrap reveal">
        {{-- Wanita --}}
        <div class="couple-card">
            <div class="couple-photo-outer">
                @if($femaleSrc)
                    <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo">
                    @if($femaleFrame)
                    <img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame-img">
                    @endif
                @else
                    <div class="couple-placeholder">{{ $femaleInitial }}</div>
                @endif
            </div>
            <h3 class="couple-name">{{ $femaleName }}</h3>
            <p class="couple-role">Mempelai Wanita</p>
            @if($showParent)
            <p class="couple-parent">
                Putri ke-{{ $femaleChildhood }} dari<br>
                Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}
            </p>
            @endif
            @if($showIg && $femaleIg)
            <p class="couple-ig"><i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}</p>
            @endif
        </div>

        {{-- Separator --}}
        <div class="couple-sep">
            <div class="sep-line"></div>
            <div class="sep-diamond"></div>
            <div class="sep-line"></div>
        </div>

        {{-- Pria --}}
        <div class="couple-card">
            <div class="couple-photo-outer">
                @if($maleSrc)
                    <img src="{{ $maleSrc }}" alt="{{ $maleName }}" class="couple-photo">
                    @if($maleFrame)
                    <img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" class="couple-frame-img">
                    @endif
                @else
                    <div class="couple-placeholder">{{ $maleInitial }}</div>
                @endif
            </div>
            <h3 class="couple-name">{{ $maleName }}</h3>
            <p class="couple-role">Mempelai Pria</p>
            @if($showParent)
            <p class="couple-parent">
                Putra ke-{{ $maleChildhood }} dari<br>
                Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}
            </p>
            @endif
            @if($showIg && $maleIg)
            <p class="couple-ig"><i class="fa-brands fa-instagram"></i> @{{ $maleIg }}</p>
            @endif
        </div>
    </div>
</section>

{{-- EVENTS --}}
@if(count($other['event'] ?? []) > 0)
<section class="events-section">
    <div class="sec-head reveal">
        <p class="sec-eyebrow">Acara</p>
        <h2 class="sec-title">Rangkaian <em>Acara</em></h2>
        <div class="g-divider"><span class="g-divider-icon">&#x2666;</span></div>
    </div>
    <div class="events-grid">
        @foreach($other['event'] as $ev)
        @php $ep = json_decode($ev->content); @endphp
        @if($ep)
        <div class="event-card reveal">
            <div class="event-icon"><i class="fa-solid fa-rings-wedding"></i></div>
            <h3 class="event-name">{{ $ev->title }}</h3>
            <p class="event-time">{{ $weddingDateFormatted }}</p>
            <p class="event-time">
                {{ date('H:i', strtotime($ep->time->start)) }}
                @if(!($ep->time->done ?? false))
                &ndash; {{ date('H:i', strtotime($ep->time->end)) }}
                @endif
                {{ $weddingTz }}
            </p>
            @if(!empty($ep->location->address ?? ''))
            <p class="event-loc">{{ $ep->location->address }}</p>
            @endif
            @if(!empty($ep->location->map ?? ''))
            <a href="{{ $ep->location->map }}" target="_blank" class="event-map">
                <i class="fa-solid fa-location-dot"></i> Lihat Peta
            </a>
            @endif
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

{{-- COUNTDOWN --}}
@if($showCountdown)
<section class="countdown-section">
    <div class="sec-head reveal">
        <p class="sec-eyebrow" style="color:rgba(201,168,76,.55)">Menghitung Hari</p>
        <h2 class="sec-title" style="color:var(--white)">Hari <em style="color:var(--gold)">Bahagia</em> Kami</h2>
        <div class="g-divider">
            <span class="g-divider-icon" style="color:rgba(201,168,76,.5)">&#x2666;</span>
        </div>
    </div>
    <div class="countdown-grid">
        <div class="cd-item">
            <span class="cd-num" id="cd-d">00</span>
            <span class="cd-lbl">Hari</span>
        </div>
        <div class="cd-item">
            <span class="cd-num" id="cd-h">00</span>
            <span class="cd-lbl">Jam</span>
        </div>
        <div class="cd-item">
            <span class="cd-num" id="cd-m">00</span>
            <span class="cd-lbl">Menit</span>
        </div>
        <div class="cd-item">
            <span class="cd-num" id="cd-s">00</span>
            <span class="cd-lbl">Detik</span>
        </div>
    </div>
</section>
@endif

{{-- STORY --}}
@if(count($other['story'] ?? []) > 0)
<section class="story-section">
    <div class="sec-head reveal">
        <p class="sec-eyebrow">Kisah Kami</p>
        <h2 class="sec-title">Perjalanan <em>Cinta</em></h2>
        <div class="g-divider"><span class="g-divider-icon">&#x2666;</span></div>
    </div>
    <div class="story-timeline">
        @foreach($other['story'] as $st)
        <div class="story-item reveal">
            <div class="story-dot"></div>
            <p class="story-yr">{{ \Carbon\Carbon::parse($st->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
            <h4 class="story-ttl">{{ $st->title }}</h4>
            <p class="story-desc">{{ $st->content }}</p>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- GALLERY --}}
@if(count($galleryFiles) > 0)
<section class="gallery-section">
    <div class="sec-head reveal">
        <p class="sec-eyebrow">Galeri</p>
        <h2 class="sec-title">{{ $galleryTitle }}</h2>
        <div class="g-divider">
            <span class="g-divider-icon" style="color:rgba(201,168,76,.5)">&#x2666;</span>
        </div>
    </div>
    <div class="gallery-grid">
        @foreach($galleryFiles as $i => $gf)
        <div class="g-item reveal @if($i === 0) wide @endif">
            <img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy">
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- GIFT --}}
@if($showGift && $giftCode)
<section class="gift-section">
    <div class="sec-head reveal">
        <p class="sec-eyebrow">Amplop Digital</p>
        <h2 class="sec-title">{{ $giftTitle }}</h2>
        <div class="g-divider"><span class="g-divider-icon">&#x2666;</span></div>
    </div>
    @if($giftContent)
    <p style="color:var(--gray);font-size:.85rem;max-width:400px;margin:0 auto" class="reveal">
        {{ $giftContent }}
    </p>
    @endif
    <div class="gift-card reveal">
        <p class="gift-bank">{{ strtoupper($giftBank) }}</p>
        <p class="gift-num">{{ $giftCode }}</p>
        <p class="gift-name">a.n. {{ $giftName }}</p>
        <button class="btn-copy"
            onclick="navigator.clipboard.writeText('{{ $giftCode }}').then(()=>{
                this.innerHTML='<i class=\'fa-solid fa-check\'></i> Tersalin';
                setTimeout(()=>this.innerHTML='<i class=\'fa-regular fa-copy\'></i> Salin Nomor',2200)
            })">
            <i class="fa-regular fa-copy"></i> Salin Nomor
        </button>
    </div>
</section>
@endif

{{-- RSVP + WISHES --}}
@include('template.partials.rsvp-wishes')

{{-- FOOTER --}}
<footer class="site-footer">
    <div class="g-divider" style="margin-bottom:2rem">
        <span class="g-divider-icon" style="color:rgba(201,168,76,.4)">&#x2666;</span>
    </div>
    <h2 class="footer-names">{{ $femaleNickname }} &amp; {{ $maleNickname }}</h2>
    @if($showClosing && $closingText)
    <p class="footer-closing">{{ $closingText }}</p>
    @endif
    <p class="footer-brand">Risa Digital Invitation</p>
</footer>

</div>{{-- end #main --}}

<script>
// Open invitation
document.getElementById('btnOpen').addEventListener('click', function () {
    document.getElementById('cover').classList.add('gone');
    document.getElementById('main').classList.add('on');
    @if($showMusic && $musicUrl)
    setTimeout(function () {
        document.getElementById('bgAudio')?.play().catch(function(){});
    }, 700);
    @endif
});

// Music toggle
@if($showMusic && $musicUrl)
(function () {
    var aud = document.getElementById('bgAudio');
    var fab = document.getElementById('musicFab');
    fab.addEventListener('click', function () {
        if (aud.paused) {
            aud.play();
            fab.innerHTML = '<i class="fa-solid fa-pause"></i>';
        } else {
            aud.pause();
            fab.innerHTML = '<i class="fa-solid fa-music"></i>';
        }
    });
})();
@endif

// Countdown
(function () {
    var target = new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');
    function pad(n) { return String(Math.floor(n)).padStart(2, '0'); }
    function tick() {
        var diff = target - new Date();
        if (diff <= 0) return;
        document.getElementById('cd-d').textContent = pad(diff / 86400000);
        document.getElementById('cd-h').textContent = pad((diff % 86400000) / 3600000);
        document.getElementById('cd-m').textContent = pad((diff % 3600000) / 60000);
        document.getElementById('cd-s').textContent = pad((diff % 60000) / 1000);
    }
    tick();
    setInterval(tick, 1000);
})();

// Scroll reveal
(function () {
    var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
            if (e.isIntersecting) {
                e.target.classList.add('in');
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(function (el) { obs.observe(el); });
})();
</script>
</body>
</html>
