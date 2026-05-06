@include('template.partials.helpers')
<!-- white-elegance template -->
<!DOCTYPE html>
<html lang="id">
<head>
@php
    $__slug = $invSlug;
@endphp
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
<meta property="og:title" content="Wedding of {{ $femaleName }} &amp; {{ $maleName }}">
<meta property="og:image" content="{{ $ogImage }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Lato:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
    --white:#ffffff;
    --off-white:#faf9f7;
    --cream:#f5f0e8;
    --gold:#c9a84c;
    --gold-light:#e8d5a3;
    --dark:#2c2c2c;
    --gray:#6b6b6b;
    --light-gray:#e8e8e8;
}
html{scroll-behavior:smooth}
body{font-family:'Lato',sans-serif;color:var(--dark);background:var(--white);overflow-x:hidden}
h1,h2,h3,h4{font-family:'Playfair Display',serif}
.script{font-family:'Great Vibes',cursive}

/* ── OVERLAY COVER ── */
#cover-overlay{
    position:fixed;inset:0;z-index:9999;
    background:var(--off-white);
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    text-align:center;padding:2rem;
    transition:opacity .8s ease,visibility .8s ease;
}
#cover-overlay.hidden{opacity:0;visibility:hidden;pointer-events:none}
#cover-overlay .cover-bg{
    position:absolute;inset:0;
    background:linear-gradient(160deg,#f9f5ef 0%,#ede8df 100%);
    z-index:-1;
}
#cover-overlay .ornament-top{
    position:absolute;top:0;left:0;right:0;height:6px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
}
#cover-overlay .ornament-bottom{
    position:absolute;bottom:0;left:0;right:0;height:6px;
    background:linear-gradient(90deg,transparent,var(--gold),transparent);
}
.cover-date-badge{
    display:inline-block;
    border:1px solid var(--gold);
    color:var(--gold);
    font-size:.75rem;
    letter-spacing:3px;
    text-transform:uppercase;
    padding:.4rem 1.5rem;
    margin-bottom:1.5rem;
}
.cover-title{font-size:1rem;letter-spacing:4px;text-transform:uppercase;color:var(--gray);margin-bottom:.5rem}
.cover-names{font-size:clamp(2.5rem,8vw,5rem);color:var(--dark);line-height:1.1;margin-bottom:.3rem}
.cover-amp{color:var(--gold);font-style:italic;margin:0 .5rem}
.cover-sub{font-size:.9rem;color:var(--gray);letter-spacing:2px;margin-bottom:2rem}
@if($coverSrc)
.cover-photo{
    width:160px;height:160px;border-radius:50%;
    object-fit:cover;
    border:4px solid var(--gold-light);
    box-shadow:0 8px 30px rgba(0,0,0,.12);
    margin-bottom:1.5rem;
}
@endif
.cover-guest{font-size:.85rem;color:var(--gray);margin-bottom:.3rem}
.cover-guest strong{color:var(--dark);font-size:1.1rem;display:block}
.btn-open{
    display:inline-flex;align-items:center;gap:.5rem;
    background:var(--dark);color:var(--white);
    padding:.85rem 2.5rem;
    font-size:.85rem;letter-spacing:2px;text-transform:uppercase;
    border:none;cursor:pointer;
    transition:background .3s,transform .3s;
    margin-top:1rem;
}
.btn-open:hover{background:var(--gold);transform:translateY(-2px)}
.btn-open i{font-size:.9rem}

/* ── MAIN CONTENT ── */
#main-content{display:none}
#main-content.visible{display:block}

/* ── SECTION BASE ── */
section{padding:5rem 1.5rem}
.section-inner{max-width:1100px;margin:0 auto}
.section-label{
    font-size:.7rem;letter-spacing:4px;text-transform:uppercase;
    color:var(--gold);margin-bottom:.5rem;
}
.section-title{font-size:clamp(1.8rem,4vw,2.8rem);color:var(--dark);margin-bottom:.5rem}
.section-divider{
    width:60px;height:2px;
    background:linear-gradient(90deg,var(--gold),var(--gold-light));
    margin:1rem 0 2rem;
}
.section-divider.center{margin:1rem auto 2rem}

/* ── HERO ── */
.hero{
    min-height:100vh;
    background:linear-gradient(160deg,#f9f5ef 0%,#ede8df 60%,#e0d5c5 100%);
    display:flex;align-items:center;justify-content:center;
    text-align:center;position:relative;overflow:hidden;
}
.hero-deco{
    position:absolute;
    width:400px;height:400px;border-radius:50%;
    background:radial-gradient(circle,rgba(201,168,76,.12) 0%,transparent 70%);
    pointer-events:none;
}
.hero-deco.tl{top:-100px;left:-100px}
.hero-deco.br{bottom:-100px;right:-100px}
.hero-inner{position:relative;z-index:1;padding:2rem}
.hero-eyebrow{font-size:.75rem;letter-spacing:5px;text-transform:uppercase;color:var(--gold);margin-bottom:1rem}
.hero-names{font-size:clamp(3rem,10vw,6.5rem);line-height:1;color:var(--dark);margin-bottom:.5rem}
.hero-amp{color:var(--gold);display:block;font-size:clamp(2rem,6vw,4rem);margin:.2rem 0}
.hero-date{
    display:inline-block;
    border-top:1px solid var(--gold-light);
    border-bottom:1px solid var(--gold-light);
    padding:.6rem 2rem;
    font-size:.85rem;letter-spacing:3px;text-transform:uppercase;
    color:var(--gray);margin:1.5rem 0;
}
.hero-quote{font-size:1rem;color:var(--gray);font-style:italic;max-width:500px;margin:0 auto}
.scroll-hint{
    position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);
    display:flex;flex-direction:column;align-items:center;gap:.3rem;
    color:var(--gray);font-size:.7rem;letter-spacing:2px;text-transform:uppercase;
    animation:bounce 2s infinite;
}
.scroll-hint i{font-size:1.2rem;color:var(--gold)}
{{ '@' }}keyframes bounce{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(6px)}}

/* ── COUPLE ── */
.couple-section{background:var(--white)}
.couple-grid{
    display:grid;grid-template-columns:1fr auto 1fr;
    align-items:center;gap:3rem;
    max-width:900px;margin:0 auto;
}
.couple-card{text-align:center}
.couple-photo-wrap{
    position:relative;display:inline-block;
    margin-bottom:1.5rem;
}
.couple-photo{
    width:200px;height:200px;border-radius:50%;
    object-fit:cover;
    border:3px solid var(--gold-light);
    box-shadow:0 8px 30px rgba(0,0,0,.1);
}
.couple-photo-placeholder{
    width:200px;height:200px;border-radius:50%;
    background:var(--cream);
    display:flex;align-items:center;justify-content:center;
    border:3px solid var(--gold-light);
    color:var(--gold);font-size:3rem;
}
.couple-frame{
    position:absolute;inset:-6px;border-radius:50%;
    pointer-events:none;
}
.couple-name{font-size:1.8rem;color:var(--dark);margin-bottom:.3rem}
.couple-role{font-size:.75rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-bottom:.8rem}
.couple-parent{font-size:.85rem;color:var(--gray);line-height:1.8}
.couple-ig a{
    display:inline-flex;align-items:center;gap:.3rem;
    font-size:.8rem;color:var(--gray);text-decoration:none;margin-top:.5rem;
    transition:color .3s;
}
.couple-ig a:hover{color:var(--gold)}
.couple-sep{
    display:flex;flex-direction:column;align-items:center;gap:.5rem;
    color:var(--gold);
}
.couple-sep .heart{font-size:2.5rem}
.couple-sep .line{width:1px;height:60px;background:var(--gold-light)}

/* ── EVENTS ── */
.events-section{background:var(--off-white)}
.events-grid{
    display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:2rem;margin-top:2rem;
}
.event-card{
    background:var(--white);
    padding:2.5rem 2rem;
    border-top:3px solid var(--gold);
    box-shadow:0 4px 20px rgba(0,0,0,.06);
    transition:transform .3s,box-shadow .3s;
}
.event-card:hover{transform:translateY(-6px);box-shadow:0 12px 35px rgba(0,0,0,.1)}
.event-icon{font-size:2rem;color:var(--gold);margin-bottom:1rem}
.event-name{font-size:1.5rem;color:var(--dark);margin-bottom:.8rem}
.event-time{
    display:flex;align-items:center;gap:.5rem;
    font-size:.85rem;color:var(--gray);margin-bottom:.5rem;
}
.event-time i{color:var(--gold);width:16px}
.event-location{font-size:.85rem;color:var(--gray);line-height:1.6}
.event-map{
    display:inline-flex;align-items:center;gap:.4rem;
    margin-top:1rem;font-size:.8rem;
    color:var(--gold);text-decoration:none;
    border-bottom:1px solid var(--gold-light);
    padding-bottom:2px;transition:color .3s;
}
.event-map:hover{color:var(--dark)}

/* ── COUNTDOWN ── */
.countdown-section{
    background:var(--dark);color:var(--white);
    text-align:center;padding:4rem 1.5rem;
}
.countdown-section .section-label{color:var(--gold-light)}
.countdown-section .section-title{color:var(--white)}
.countdown-grid{
    display:flex;justify-content:center;gap:1rem;flex-wrap:wrap;
    margin-top:2.5rem;
}
.countdown-item{
    background:rgba(255,255,255,.08);
    border:1px solid rgba(201,168,76,.3);
    padding:1.5rem 2rem;min-width:100px;
    text-align:center;
}
.countdown-num{
    font-family:'Playfair Display',serif;
    font-size:3rem;color:var(--gold);line-height:1;
    display:block;
}
.countdown-label{font-size:.65rem;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-top:.3rem}

/* ── STORY ── */
.story-section{background:var(--white)}
.story-timeline{position:relative;max-width:700px;margin:0 auto;padding-top:1rem}
.story-timeline::before{
    content:'';position:absolute;left:50%;top:0;bottom:0;
    width:1px;background:var(--gold-light);transform:translateX(-50%);
}
.story-item{
    display:grid;grid-template-columns:1fr 40px 1fr;
    align-items:start;gap:0;margin-bottom:3rem;
}
.story-item:nth-child(odd) .story-content{grid-column:1;text-align:right;padding-right:2rem}
.story-item:nth-child(odd) .story-dot{grid-column:2}
.story-item:nth-child(odd) .story-empty{grid-column:3}
.story-item:nth-child(even) .story-empty{grid-column:1}
.story-item:nth-child(even) .story-dot{grid-column:2}
.story-item:nth-child(even) .story-content{grid-column:3;text-align:left;padding-left:2rem}
.story-dot{
    width:40px;height:40px;border-radius:50%;
    background:var(--white);border:2px solid var(--gold);
    display:flex;align-items:center;justify-content:center;
    color:var(--gold);font-size:.9rem;
    position:relative;z-index:1;
    justify-self:center;
}
.story-date{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:.3rem}
.story-title{font-size:1.2rem;color:var(--dark);margin-bottom:.4rem}
.story-desc{font-size:.85rem;color:var(--gray);line-height:1.7}

/* ── GALLERY ── */
.gallery-section{background:var(--off-white)}
.gallery-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    grid-template-rows:auto;
    gap:1rem;margin-top:2rem;
}
.gallery-grid .g-item{overflow:hidden;position:relative;aspect-ratio:1}
.gallery-grid .g-item.wide{grid-column:span 2;aspect-ratio:2/1}
.gallery-grid .g-item img{
    width:100%;height:100%;object-fit:cover;
    transition:transform .5s ease;display:block;
}
.gallery-grid .g-item:hover img{transform:scale(1.06)}
.gallery-empty{
    grid-column:1/-1;text-align:center;
    padding:4rem;color:var(--gray);font-style:italic;
}

/* ── WISHES ── */
.wishes-section{background:var(--white)}
.wishes-form{
    max-width:600px;margin:0 auto;
    background:var(--off-white);
    padding:2.5rem;
}
.form-row{margin-bottom:1.2rem}
.form-row label{
    display:block;font-size:.75rem;letter-spacing:2px;
    text-transform:uppercase;color:var(--gray);margin-bottom:.4rem;
}
.form-row input,.form-row textarea{
    width:100%;padding:.8rem 1rem;
    border:1px solid var(--light-gray);
    background:var(--white);
    font-family:'Lato',sans-serif;font-size:.9rem;
    color:var(--dark);
    transition:border-color .3s;outline:none;
}
.form-row input:focus,.form-row textarea:focus{border-color:var(--gold)}
.form-row input:focus-visible,.form-row textarea:focus-visible,.btn-open:focus-visible,.btn-send:focus-visible,.music-btn:focus-visible{outline:3px solid rgba(201,168,76,.35);outline-offset:2px}
.form-row textarea{resize:vertical;min-height:100px}
.btn-send{
    width:100%;padding:1rem;
    background:var(--dark);color:var(--white);
    border:none;cursor:pointer;
    font-size:.8rem;letter-spacing:3px;text-transform:uppercase;
    transition:background .3s;
}
.btn-send:hover{background:var(--gold)}
.wishes-list{margin-top:3rem}
.wish-item{
    border-bottom:1px solid var(--light-gray);
    padding:1.2rem 0;
}
.wish-name{font-weight:700;font-size:.9rem;color:var(--dark);margin-bottom:.2rem}
.wish-msg{font-size:.85rem;color:var(--gray);line-height:1.6;font-style:italic}
.wish-date{font-size:.7rem;color:var(--gold);margin-top:.3rem}

/* ── RSVP ── */
.rsvp-section{
    background:linear-gradient(160deg,#f9f5ef 0%,#ede8df 100%);
    text-align:center;
}
.rsvp-form{
    max-width:500px;margin:2rem auto 0;
    background:var(--white);padding:2.5rem;
    box-shadow:0 4px 30px rgba(0,0,0,.08);
}
.rsvp-options{display:flex;gap:1rem;margin-bottom:1.2rem}
.rsvp-option{
    flex:1;padding:.8rem;
    border:1px solid var(--light-gray);
    background:var(--white);cursor:pointer;
    font-size:.8rem;letter-spacing:1px;text-transform:uppercase;
    transition:all .3s;
}
.rsvp-option.active,.rsvp-option:hover{
    background:var(--dark);color:var(--white);border-color:var(--dark);
}
.rsvp-input{
    width:100%;padding:.8rem 1rem;
    border:1px solid var(--light-gray);
    font-family:'Lato',sans-serif;font-size:.9rem;
    margin-bottom:1rem;outline:none;
    transition:border-color .3s;
}
.rsvp-input:focus{border-color:var(--gold)}
.rsvp-msg{
    padding:1rem;font-size:.9rem;
    display:none;margin-top:1rem;
}
.rsvp-msg.success{background:#f0faf4;color:#2d7a4f;border-left:3px solid #2d7a4f}
.rsvp-msg.error{background:#fff5f5;color:#c0392b;border-left:3px solid #c0392b}

/* ── FOOTER ── */
.site-footer{
    background:var(--dark);color:rgba(255,255,255,.6);
    text-align:center;padding:3rem 1.5rem;
}
.footer-names{font-size:2.5rem;color:var(--white);margin-bottom:.5rem}
.footer-brand{font-size:.7rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold);margin-top:1.5rem}

/* ── MUSIC PLAYER ── */
.music-fab{
    position:fixed;bottom:2rem;right:2rem;z-index:100;
    width:48px;height:48px;border-radius:50%;
    background:var(--dark);color:var(--white);
    border:2px solid var(--gold);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:1.1rem;
    box-shadow:0 4px 15px rgba(0,0,0,.2);
    transition:background .3s,transform .3s;
}
.music-fab:hover{background:var(--gold);transform:scale(1.1)}
.music-fab.playing{animation:pulse-ring 2s infinite}
{{ '@' }}keyframes pulse-ring{
    0%{box-shadow:0 0 0 0 rgba(201,168,76,.4)}
    70%{box-shadow:0 0 0 12px rgba(201,168,76,0)}
    100%{box-shadow:0 0 0 0 rgba(201,168,76,0)}
}

/* ── RESPONSIVE ── */
{{ '@' }}media(max-width:768px){
    .couple-grid{grid-template-columns:1fr;gap:2rem}
    .couple-sep{flex-direction:row;justify-content:center}
    .couple-sep .line{width:60px;height:1px}
    .story-timeline::before{left:20px}
    .story-item{grid-template-columns:40px 1fr;grid-template-rows:auto auto}
    .story-item:nth-child(odd) .story-content,
    .story-item:nth-child(even) .story-content{
        grid-column:2;grid-row:1;text-align:left;padding:0 0 0 1rem;
    }
    .story-item:nth-child(odd) .story-dot,
    .story-item:nth-child(even) .story-dot{grid-column:1;grid-row:1}
    .story-item:nth-child(odd) .story-empty,
    .story-item:nth-child(even) .story-empty{display:none}
    .gallery-grid{grid-template-columns:repeat(2,1fr)}
    .gallery-grid .g-item.wide{grid-column:span 2}
    .rsvp-options{flex-direction:column}
}
{{ '@' }}media(max-width:480px){
    section{padding:3.5rem 1rem}
    .gallery-grid{grid-template-columns:1fr}
    .gallery-grid .g-item.wide{grid-column:span 1;aspect-ratio:1}
}

/* ── ANIMATIONS ── */
.reveal{opacity:0;transform:translateY(30px);transition:opacity .7s ease,transform .7s ease}
.reveal.visible{opacity:1;transform:translateY(0)}
</style>
</head>
<body>

{{-- ── COVER OVERLAY ── --}}
<div id="cover-overlay">
    <div class="cover-bg"></div>
    <div class="ornament-top"></div>
    <div class="ornament-bottom"></div>

    @if($coverSrc)
    <img src="{{ $coverSrc }}" alt="cover" class="cover-photo">
    @endif

    <div class="cover-date-badge">
        {{ $weddingDateShort }}
    </div>

    <p class="cover-title">The Wedding of</p>
    <h1 class="cover-names script">
        {{ $femaleNickname }}
        <span class="cover-amp">&</span>
        {{ $maleNickname }}
    </h1>
    <p class="cover-sub">{{ $coverContent }}</p>

    @if($other['guest'])
    <div class="cover-guest">
        Kepada Yth.
        <strong>{{ $other['guest']['name'] ?? '' }}</strong>
    </div>
    @endif

    <button class="btn-open" id="btnOpen">
        <i class="fa-solid fa-envelope-open-text"></i>
        {{ $coverButton }}
    </button>
</div>

{{-- ── MAIN CONTENT ── --}}
<div id="main-content">

{{-- Music --}}
@if($showMusic && $musicUrl)
<audio id="bgMusic" loop>
    <source src="{{ $musicUrl }}" type="audio/mpeg">
</audio>
<button class="music-fab" id="musicBtn" title="Musik">
    <i class="fa-solid fa-music"></i>
</button>
@endif

{{-- ── HERO ── --}}
<section class="hero" id="hero">
    <div class="hero-deco tl"></div>
    <div class="hero-deco br"></div>
    <div class="hero-inner reveal">
        <p class="hero-eyebrow">The Wedding of</p>
        <h1 class="hero-names script">
            {{ $femaleNickname }}
            <span class="hero-amp script">&</span>
            {{ $maleNickname }}
        </h1>
        <div class="hero-date">
            <i class="fa-regular fa-calendar" style="color:var(--gold);margin-right:.5rem"></i>
            {{ $weddingDateFormatted }}
        </div>
        @if($quoteContent)
        <p class="hero-quote">"{{ $quoteContent }}"</p>
        @endif
    </div>
    <div class="scroll-hint">
        <span>Scroll</span>
        <i class="fa-solid fa-chevron-down"></i>
    </div>
</section>

{{-- ── COUPLE ── --}}
<section class="couple-section" id="couple">
    <div class="section-inner">
        <div style="text-align:center" class="reveal">
            <p class="section-label">Mempelai</p>
            <h2 class="section-title">Dua Hati Menjadi Satu</h2>
            <div class="section-divider center"></div>
        </div>
        <div class="couple-grid reveal">
            {{-- Pria --}}
            <div class="couple-card">
                <div class="couple-photo-wrap">
                    @if($maleSrc)
                    <img src="{{ $maleSrc }}" alt="{{ $maleName }}" class="couple-photo">
                    @if($maleFrame)
                    <img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" class="couple-frame">
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
                @if($showIg && $maleIg)
                <div class="couple-ig">
                    <a href="https://instagram.com/{{ $maleIg }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i> @{{ $maleIg }}
                    </a>
                </div>
                @endif
            </div>

            {{-- Separator --}}
            <div class="couple-sep">
                <div class="line"></div>
                <span class="heart script" style="font-size:2.5rem;color:var(--gold)">&#x2665;</span>
                <div class="line"></div>
            </div>

            {{-- Wanita --}}
            <div class="couple-card">
                <div class="couple-photo-wrap">
                    @if($femaleSrc)
                    <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo">
                    @if($femaleFrame)
                    <img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame">
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
                @if($showIg && $femaleIg)
                <div class="couple-ig">
                    <a href="https://instagram.com/{{ $femaleIg }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── EVENTS ── --}}
@if(count($other['event'] ?? []) > 0)
<section class="events-section" id="events">
    <div class="section-inner">
        <div class="reveal">
            <p class="section-label">Acara</p>
            <h2 class="section-title">Rangkaian Acara</h2>
            <div class="section-divider"></div>
        </div>
        <div class="events-grid">
            @foreach($other['event'] as $ev)
            @php $evProp = json_decode($ev->content); @endphp
            @if($evProp)
            <div class="event-card reveal">
                <div class="event-icon"><i class="fa-solid fa-rings-wedding"></i></div>
                <h3 class="event-name">{{ $ev->title }}</h3>
                <div class="event-time">
                    <i class="fa-regular fa-clock"></i>
                    {{ date('H:i', strtotime($evProp->time->start)) }}
                    @if(!($evProp->time->done ?? false))
                    – {{ date('H:i', strtotime($evProp->time->end)) }}
                    @endif
                    {{ $weddingTz }}
                </div>
                <div class="event-time">
                    <i class="fa-regular fa-calendar"></i>
                    {{ $weddingDateFormatted }}
                </div>
                @if(!empty($evProp->location->address ?? ''))
                <p class="event-location">
                    <i class="fa-solid fa-location-dot" style="color:var(--gold);margin-right:.3rem"></i>
                    {{ $evProp->location->address }}
                </p>
                @endif
                @if(!empty($evProp->location->map ?? ''))
                <a href="{{ $evProp->location->map }}" target="_blank" class="event-map">
                    <i class="fa-solid fa-map"></i> Lihat Peta
                </a>
                @endif
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── COUNTDOWN ── --}}
@if($showCountdown)
<section class="countdown-section" id="countdown">
    <p class="section-label">Menghitung Hari</p>
    <h2 class="section-title" style="color:var(--white)">Hari Bahagia Kami</h2>
    <div class="countdown-grid" id="countdownGrid">
        <div class="countdown-item"><span class="countdown-num" id="cd-days">0</span><span class="countdown-label">Hari</span></div>
        <div class="countdown-item"><span class="countdown-num" id="cd-hours">0</span><span class="countdown-label">Jam</span></div>
        <div class="countdown-item"><span class="countdown-num" id="cd-minutes">0</span><span class="countdown-label">Menit</span></div>
        <div class="countdown-item"><span class="countdown-num" id="cd-seconds">0</span><span class="countdown-label">Detik</span></div>
    </div>
    @if(($data->detail->calendar->save->show ?? false) === true)
    <a href="https://www.google.com/calendar/event?action=TEMPLATE&dates={{ date('Ymd', strtotime($weddingDate)) }}T090000Z%2F{{ date('Ymd', strtotime($weddingDate.' +1 days')) }}T090000Z&text=Wedding+{{ urlencode($femaleName).'+'.$maleName }}&location={{ urlencode($locationAddress) }}"
       target="_blank"
       style="display:inline-flex;align-items:center;gap:.5rem;margin-top:2rem;padding:.7rem 2rem;background:transparent;color:var(--gold);border:1px solid var(--gold);font-size:.8rem;letter-spacing:2px;text-transform:uppercase;text-decoration:none;transition:all .3s">
        <i class="fa-regular fa-calendar-plus"></i>
        {{ $data->detail->calendar->save->content ?? 'Simpan Tanggal' }}
    </a>
    @endif
</section>
@endif

{{-- ── STORY ── --}}
@if(count($other['story'] ?? []) > 0)
<section class="story-section" id="story">
    <div class="section-inner">
        <div style="text-align:center" class="reveal">
            <p class="section-label">Kisah Kami</p>
            <h2 class="section-title">Perjalanan Cinta</h2>
            <div class="section-divider center"></div>
        </div>
        <div class="story-timeline">
            @foreach($other['story'] as $st)
            <div class="story-item reveal">
                <div class="story-content">
                    <p class="story-date">{{ \Carbon\Carbon::parse($st->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                    <h4 class="story-title">{{ $st->title }}</h4>
                    <p class="story-desc">{{ $st->content }}</p>
                </div>
                <div class="story-dot"><i class="fa-solid fa-heart" style="font-size:.7rem"></i></div>
                <div class="story-empty"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── GALLERY ── --}}
<section class="gallery-section" id="gallery">
    <div class="section-inner">
        <div style="text-align:center" class="reveal">
            <p class="section-label">Galeri</p>
            <h2 class="section-title">Momen Berharga</h2>
            <div class="section-divider center"></div>
        </div>
        @if($other['photo'] && !empty($other['photo']->prop->file ?? []))
        <div class="gallery-grid">
            @foreach($other['photo']->prop->file as $i => $gf)
            <div class="g-item reveal @if($i === 0) wide @endif">
                <img src="{{ url('storage/'.$gf) }}" alt="gallery {{ $i+1 }}" loading="lazy">
            </div>
            @endforeach
        </div>
        @else
        <div class="gallery-grid"><div class="gallery-empty">Belum ada foto galeri.</div></div>
        @endif
    </div>
</section>

{{-- ── WISHES ── --}}
@if($showWishes)
<section class="wishes-section" id="wishes">
    <div class="section-inner">
        <div style="text-align:center" class="reveal">
            <p class="section-label">Ucapan</p>
            <h2 class="section-title">{{ $wishesTitle }}</h2>
            <div class="section-divider center"></div>
            @if($wishesContent)
            <p style="color:var(--gray);font-size:.9rem;margin-bottom:2rem">{{ $wishesContent }}</p>
            @endif
        </div>
        <form class="wishes-form reveal" id="wishesForm" action="{{ $__slug ? route('invitation.wish', $__slug) : '#' }}" method="post">
            @csrf
            <div class="form-row">
                <label>Nama <var dir="name"></var></label>
                <input type="text" name="name" placeholder="Nama Anda" required>
            </div>
            <div class="form-row">
                <label>No. WhatsApp <var dir="phone"></var></label>
                <input type="text" name="phone" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="form-row">
                <label>Ucapan & Doa <var dir="message"></var></label>
                <textarea name="message" placeholder="Tulis ucapan..." required></textarea>
            </div>
            <button type="submit" class="btn-send">
                <i class="fa-solid fa-paper-plane" style="margin-right:.5rem"></i> Kirim Ucapan
            </button>
            <div class="rsvp-msg" id="wishMsg"></div>
        </form>
    </div>
</section>
@endif

{{-- ── RSVP ── --}}
<section class="rsvp-section" id="rsvp">
    <div class="section-inner">
        <div style="text-align:center" class="reveal">
            <p class="section-label">Konfirmasi</p>
            <h2 class="section-title">{{ $rsvpTitle }}</h2>
            <div class="section-divider center"></div>
            @if($rsvpContent)
            <p style="color:var(--gray);font-size:.9rem">{{ $rsvpContent }}</p>
            @endif
        </div>
        <form class="rsvp-form reveal" id="rsvpForm" action="{{ $__slug ? route('invitation.present', $__slug) : '#' }}" method="post">
            @csrf
            <input type="hidden" name="option" id="rsvpOption" value="">
            <div class="rsvp-options">
                <button type="button" class="rsvp-option" data-val="yes" onclick="setRsvp(this,'yes')">
                    <i class="fa-solid fa-check" style="margin-right:.3rem"></i>
                    {{ $rsvpYes }}
                </button>
                <button type="button" class="rsvp-option" data-val="no" onclick="setRsvp(this,'no')">
                    <i class="fa-solid fa-xmark" style="margin-right:.3rem"></i>
                    {{ $rsvpNo }}
                </button>
            </div>
            <input type="text" name="name" class="rsvp-input" placeholder="Nama Anda" required>
            <input type="number" name="amount" class="rsvp-input" placeholder="Jumlah tamu" min="1" value="1">
            <button type="submit" class="btn-send">
                <i class="fa-solid fa-envelope-circle-check" style="margin-right:.5rem"></i> Kirim Konfirmasi
            </button>
            <div class="rsvp-msg" id="rsvpMsg"></div>
        </form>
    </div>
</section>

{{-- ── FOOTER ── --}}
@php $__detailsShownStory = true; @endphp
@include('template.partials.details')

<footer class="site-footer">
    <p class="script footer-names">
        {{ $femaleNickname }} &amp; {{ $maleNickname }}
    </p>
    @if($showClosing && $closingText)
    <p style="font-size:.85rem;margin-top:.5rem">{{ $closingText }}</p>
    @endif
    <p class="footer-brand">Risa Digital Invitation</p>
</footer>

</div>{{-- end #main-content --}}

<script>
// ── Open invitation
document.getElementById('btnOpen').addEventListener('click', function() {
    document.getElementById('cover-overlay').classList.add('hidden');
    document.getElementById('main-content').classList.add('visible');
    @if($showMusic && $musicUrl)
    setTimeout(() => { document.getElementById('bgMusic')?.play().catch(()=>{}); }, 500);
    @endif
});

// ── Music toggle
@if($showMusic && $musicUrl)
const bgMusic = document.getElementById('bgMusic');
const musicBtn = document.getElementById('musicBtn');
musicBtn.addEventListener('click', function() {
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

// ── Countdown
(function() {
    const target = new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');
    function tick() {
        const now = new Date();
        const diff = target - now;
        if (diff <= 0) {
            document.getElementById('countdownGrid').innerHTML = '<p style="color:var(--gold);font-size:1.2rem;letter-spacing:2px">Hari Bahagia Telah Tiba ✨</p>';
            return;
        }
        const d = Math.floor(diff / 86400000);
        const h = Math.floor((diff % 86400000) / 3600000);
        const m = Math.floor((diff % 3600000) / 60000);
        const s = Math.floor((diff % 60000) / 1000);
        document.getElementById('cd-days').textContent   = String(d).padStart(2,'0');
        document.getElementById('cd-hours').textContent  = String(h).padStart(2,'0');
        document.getElementById('cd-minutes').textContent = String(m).padStart(2,'0');
        document.getElementById('cd-seconds').textContent = String(s).padStart(2,'0');
    }
    tick();
    setInterval(tick, 1000);
})();

// ── RSVP option
function setRsvp(el, val) {
    document.querySelectorAll('.rsvp-option').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('rsvpOption').value = val;
}

// ── AJAX forms
function ajaxForm(formId, msgId) {
    const form = document.getElementById(formId);
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const msg = document.getElementById(msgId);
        const btn = form.querySelector('button[type=submit]');
        btn.disabled = true;
        const fd = new FormData(form);
        fetch(form.action, { method: 'POST', body: fd, headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => {
                msg.style.display = 'block';
                msg.className = 'rsvp-msg success';
                msg.textContent = data.message || 'Terkirim!';
                form.reset();
                document.querySelectorAll('.rsvp-option').forEach(b => b.classList.remove('active'));
            })
            .catch(() => {
                msg.style.display = 'block';
                msg.className = 'rsvp-msg error';
                msg.textContent = 'Terjadi kesalahan. Coba lagi.';
            })
            .finally(() => { btn.disabled = false; });
    });
}
ajaxForm('wishesForm', 'wishMsg');
ajaxForm('rsvpForm', 'rsvpMsg');

// ── Scroll reveal
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); } });
}, { threshold: 0.12 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
</body>
</html>
