@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Undangan Pernikahan {{ $maleNickname }} &amp; {{ $femaleNickname }}</title>
<meta property="og:title"       content="Undangan Pernikahan {{ $maleNickname }} & {{ $femaleNickname }}">
<meta property="og:image"       content="{{ $ogImage }}">
<meta property="og:description" content="Kami mengundang kehadiran Anda di hari bahagia kami">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Lato:wght@300;400;700&family=Great+Vibes&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
/* ── RESET & BASE ── */
*{margin:0;padding:0;box-sizing:border-box}
:root{
    --green-dark:#1a4731;
    --green-mid:#2d6a4f;
    --green-light:#52b788;
    --gold:#c9a84c;
    --gold-light:#e8d5a3;
    --cream:#fdf8f0;
    --cream2:#f5ede0;
    --white:#ffffff;
    --text:#2c2c2c;
    --gray:#6b6b6b;
    --border:#e0d5c5;
}
html{scroll-behavior:smooth}
body{font-family:'Lato',sans-serif;background:var(--cream);color:var(--text);overflow-x:hidden}
h1,h2,h3,h4{font-family:'Amiri',serif}
.script{font-family:'Great Vibes',cursive}
img{max-width:100%;display:block}
a{text-decoration:none;color:inherit}

/* ── ORNAMENT SVG INLINE ── */
.ornament-divider{
    display:flex;align-items:center;justify-content:center;gap:.8rem;
    margin:1.2rem 0;color:var(--gold);font-size:1.2rem;
}
.ornament-divider::before,.ornament-divider::after{
    content:'';flex:1;max-width:80px;height:1px;background:linear-gradient(90deg,transparent,var(--gold));
}
.ornament-divider::after{background:linear-gradient(90deg,var(--gold),transparent)}

/* ── COVER OVERLAY ── */
#cover{
    position:fixed;inset:0;z-index:9999;
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    text-align:center;padding:2rem;
    background:linear-gradient(160deg,var(--green-dark) 0%,#0d2b1e 100%);
    transition:opacity .9s ease,visibility .9s ease;
}
#cover.gone{opacity:0;visibility:hidden;pointer-events:none}
.cover-border{
    position:absolute;inset:12px;
    border:1px solid rgba(201,168,76,.35);
    pointer-events:none;
}
.cover-corner{
    position:absolute;width:30px;height:30px;
    border-color:var(--gold);border-style:solid;
}
.cover-corner.tl{top:12px;left:12px;border-width:2px 0 0 2px}
.cover-corner.tr{top:12px;right:12px;border-width:2px 2px 0 0}
.cover-corner.bl{bottom:12px;left:12px;border-width:0 0 2px 2px}
.cover-corner.br{bottom:12px;right:12px;border-width:0 2px 2px 0}
.cover-bismillah{
    font-family:'Amiri',serif;font-size:1.8rem;
    color:var(--gold-light);margin-bottom:1rem;letter-spacing:2px;
}
.cover-label{
    font-size:.65rem;letter-spacing:5px;text-transform:uppercase;
    color:rgba(255,255,255,.5);margin-bottom:.8rem;
}
.cover-names{
    font-size:clamp(2.2rem,8vw,4rem);
    color:var(--white);line-height:1.1;margin-bottom:.3rem;
}
.cover-amp{color:var(--gold);display:block;font-size:clamp(1.5rem,5vw,2.8rem);margin:.2rem 0}
.cover-date{
    font-size:.8rem;letter-spacing:3px;text-transform:uppercase;
    color:var(--gold-light);margin:1rem 0;
}
.cover-photo{
    width:130px;height:130px;border-radius:50%;object-fit:cover;
    border:3px solid var(--gold);margin-bottom:1.2rem;
    box-shadow:0 0 0 6px rgba(201,168,76,.15);
}
.cover-guest{
    font-size:.8rem;color:rgba(255,255,255,.6);margin-bottom:.3rem;
}
.cover-guest strong{color:var(--white);font-size:1rem;display:block;margin-top:.2rem}
.btn-open{
    display:inline-flex;align-items:center;gap:.6rem;
    margin-top:1.5rem;padding:.8rem 2.2rem;
    background:transparent;color:var(--gold);
    border:1px solid var(--gold);
    font-size:.75rem;letter-spacing:3px;text-transform:uppercase;
    cursor:pointer;transition:all .3s;
}
.btn-open:hover{background:var(--gold);color:var(--green-dark)}

/* ── MAIN ── */
#main{display:none}
#main.on{display:block}

/* ── SECTION BASE ── */
section{padding:4.5rem 1.5rem}
.sec-inner{max-width:900px;margin:0 auto}
.sec-label{font-size:.65rem;letter-spacing:4px;text-transform:uppercase;color:var(--gold);margin-bottom:.4rem}
.sec-title{font-size:clamp(1.6rem,4vw,2.4rem);color:var(--green-dark);margin-bottom:.3rem}

/* ── HERO ── */
.hero{
    min-height:100vh;
    background:linear-gradient(180deg,var(--green-dark) 0%,#1e3d2f 60%,#2d5a3d 100%);
    display:flex;align-items:center;justify-content:center;
    text-align:center;position:relative;overflow:hidden;
}
.hero-pattern{
    position:absolute;inset:0;opacity:.06;
    background-image:repeating-linear-gradient(45deg,var(--gold) 0,var(--gold) 1px,transparent 0,transparent 50%);
    background-size:20px 20px;
}
.hero-inner{position:relative;z-index:1;padding:2rem}
.hero-bismillah{
    font-family:'Amiri',serif;font-size:2rem;
    color:var(--gold-light);margin-bottom:1.5rem;
}
.hero-label{font-size:.65rem;letter-spacing:5px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-bottom:.8rem}
.hero-names{font-size:clamp(2.5rem,9vw,5.5rem);color:var(--white);line-height:1}
.hero-amp{color:var(--gold);display:block;font-size:clamp(1.8rem,6vw,3.5rem);margin:.3rem 0}
.hero-date-box{
    display:inline-block;
    border:1px solid rgba(201,168,76,.4);
    padding:.6rem 2rem;margin:1.5rem 0;
    font-size:.8rem;letter-spacing:3px;text-transform:uppercase;
    color:var(--gold-light);
}
.hero-quote{font-size:.95rem;color:rgba(255,255,255,.65);font-style:italic;max-width:480px;margin:0 auto}
.scroll-down{
    position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);
    color:rgba(255,255,255,.4);font-size:.65rem;letter-spacing:2px;text-transform:uppercase;
    display:flex;flex-direction:column;align-items:center;gap:.3rem;
    animation:bob 2s infinite;
}
.scroll-down i{color:var(--gold);font-size:1rem}
{{ '@' }}keyframes bob{0%,100%{transform:translateX(-50%) translateY(0)}50%{transform:translateX(-50%) translateY(5px)}}

/* ── OPENING ── */
.opening-sec{background:var(--cream);text-align:center}
.opening-sec p{font-size:1rem;color:var(--gray);line-height:1.9;max-width:600px;margin:0 auto}
.opening-sec .ayat{
    font-family:'Amiri',serif;font-size:1.3rem;
    color:var(--green-dark);line-height:2;
    margin:1.5rem auto;max-width:600px;
    padding:1.2rem;
    border-left:3px solid var(--gold);
    background:rgba(201,168,76,.06);
    text-align:right;
    direction:rtl;
}
.opening-sec .ayat-source{
    font-size:.75rem;letter-spacing:2px;color:var(--gold);
    text-align:center;direction:ltr;margin-top:.5rem;
}

/* ── COUPLE ── */
.couple-sec{background:var(--cream2)}
.couple-wrap{
    display:grid;grid-template-columns:1fr auto 1fr;
    align-items:center;gap:2rem;margin-top:2.5rem;
}
.couple-card{text-align:center}
.couple-photo-ring{
    position:relative;display:inline-block;margin-bottom:1.2rem;
}
.couple-photo{
    width:180px;height:180px;border-radius:50%;object-fit:cover;
    border:4px solid var(--gold-light);
    box-shadow:0 6px 25px rgba(0,0,0,.12);
}
.couple-photo-placeholder{
    width:180px;height:180px;border-radius:50%;
    background:linear-gradient(135deg,var(--green-mid),var(--green-dark));
    display:flex;align-items:center;justify-content:center;
    color:var(--gold-light);font-size:3.5rem;
    border:4px solid var(--gold-light);
}
.couple-frame-img{
    position:absolute;inset:-8px;border-radius:50%;pointer-events:none;
}
.couple-name{font-size:1.7rem;color:var(--green-dark);margin-bottom:.2rem}
.couple-role{
    font-size:.65rem;letter-spacing:3px;text-transform:uppercase;
    color:var(--gold);margin-bottom:.7rem;
}
.couple-parent{font-size:.85rem;color:var(--gray);line-height:1.8}
.couple-ig a{
    display:inline-flex;align-items:center;gap:.3rem;
    font-size:.8rem;color:var(--gray);margin-top:.5rem;
    transition:color .3s;
}
.couple-ig a:hover{color:var(--green-mid)}
.couple-sep{
    display:flex;flex-direction:column;align-items:center;gap:.5rem;
    color:var(--gold);
}
.couple-sep .heart-icon{font-size:2rem}
.couple-sep .vline{width:1px;height:50px;background:var(--gold-light)}

/* ── EVENTS ── */
.events-sec{background:var(--green-dark);color:var(--white)}
.events-sec .sec-title{color:var(--white)}
.events-sec .sec-label{color:var(--gold-light)}
.events-grid{
    display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
    gap:1.5rem;margin-top:2rem;
}
.event-card{
    background:rgba(255,255,255,.06);
    border:1px solid rgba(201,168,76,.25);
    padding:2rem 1.5rem;
    transition:background .3s,transform .3s;
}
.event-card:hover{background:rgba(255,255,255,.1);transform:translateY(-4px)}
.event-icon{font-size:1.8rem;color:var(--gold);margin-bottom:.8rem}
.event-name{font-size:1.4rem;color:var(--white);margin-bottom:.8rem}
.event-row{
    display:flex;align-items:flex-start;gap:.6rem;
    font-size:.85rem;color:rgba(255,255,255,.7);margin-bottom:.4rem;
}
.event-row i{color:var(--gold);width:14px;margin-top:2px;flex-shrink:0}
.event-map-btn{
    display:inline-flex;align-items:center;gap:.4rem;
    margin-top:1rem;padding:.5rem 1.2rem;
    border:1px solid var(--gold);color:var(--gold);
    font-size:.75rem;letter-spacing:2px;text-transform:uppercase;
    transition:all .3s;
}
.event-map-btn:hover{background:var(--gold);color:var(--green-dark)}

/* ── COUNTDOWN ── */
.countdown-sec{background:var(--cream2);text-align:center}
.countdown-row{
    display:flex;justify-content:center;gap:1rem;flex-wrap:wrap;
    margin-top:2rem;
}
.cd-box{
    min-width:90px;padding:1.2rem 1rem;
    background:var(--white);
    border-bottom:3px solid var(--gold);
    box-shadow:0 3px 15px rgba(0,0,0,.06);
    text-align:center;
}
.cd-num{
    font-family:'Amiri',serif;font-size:2.8rem;
    color:var(--green-dark);line-height:1;display:block;
}
.cd-lbl{font-size:.6rem;letter-spacing:3px;text-transform:uppercase;color:var(--gray);margin-top:.2rem}

/* ── STORY ── */
.story-sec{background:var(--cream)}
.story-line{
    position:relative;max-width:700px;margin:2rem auto 0;
    padding-left:2rem;
}
.story-line::before{
    content:'';position:absolute;left:0;top:0;bottom:0;
    width:2px;background:linear-gradient(180deg,var(--gold),var(--gold-light),transparent);
}
.story-item{
    position:relative;margin-bottom:2.5rem;padding-left:1.5rem;
}
.story-dot{
    position:absolute;left:-2.4rem;top:.3rem;
    width:20px;height:20px;border-radius:50%;
    background:var(--white);border:2px solid var(--gold);
    display:flex;align-items:center;justify-content:center;
}
.story-dot i{font-size:.5rem;color:var(--gold)}
.story-date{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:.2rem}
.story-title{font-size:1.15rem;color:var(--green-dark);margin-bottom:.3rem}
.story-desc{font-size:.85rem;color:var(--gray);line-height:1.7}

/* ── GALLERY ── */
.gallery-sec{background:var(--cream2)}
.gallery-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:.8rem;margin-top:2rem;
}
.g-item{overflow:hidden;aspect-ratio:1;position:relative}
.g-item.tall{grid-row:span 2;aspect-ratio:auto}
.g-item img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.g-item:hover img{transform:scale(1.07)}
.gallery-empty{grid-column:1/-1;text-align:center;padding:3rem;color:var(--gray);font-style:italic}

/* ── WISHES ── */
.wishes-sec{background:var(--cream)}
.wishes-form{
    max-width:560px;margin:2rem auto 0;
    background:var(--white);padding:2rem;
    border-top:3px solid var(--gold);
    box-shadow:0 4px 20px rgba(0,0,0,.06);
}
.f-label{
    display:block;font-size:.7rem;letter-spacing:2px;
    text-transform:uppercase;color:var(--gray);margin-bottom:.4rem;
}
.f-input{
    width:100%;padding:.75rem 1rem;
    border:1px solid var(--border);
    font-family:'Lato',sans-serif;font-size:.9rem;
    color:var(--text);outline:none;margin-bottom:1rem;
    transition:border-color .3s;background:var(--cream);
}
.f-input:focus{border-color:var(--gold);background:var(--white)}
textarea.f-input{resize:vertical;min-height:90px}
.btn-submit{
    width:100%;padding:.9rem;
    background:var(--green-dark);color:var(--white);
    border:none;cursor:pointer;
    font-size:.75rem;letter-spacing:3px;text-transform:uppercase;
    transition:background .3s;
}
.btn-submit:hover{background:var(--green-mid)}
.form-msg{
    padding:.8rem 1rem;margin-top:.8rem;font-size:.85rem;display:none;
}
.form-msg.ok{background:#f0faf4;color:#1a6b3c;border-left:3px solid #2d7a4f}
.form-msg.err{background:#fff5f5;color:#c0392b;border-left:3px solid #c0392b}

/* ── RSVP ── */
.rsvp-sec{
    background:linear-gradient(160deg,var(--green-dark) 0%,#1e3d2f 100%);
    color:var(--white);text-align:center;
}
.rsvp-sec .sec-title{color:var(--white)}
.rsvp-sec .sec-label{color:var(--gold-light)}
.rsvp-form{
    max-width:480px;margin:2rem auto 0;
    background:rgba(255,255,255,.06);
    border:1px solid rgba(201,168,76,.2);
    padding:2rem;
}
.rsvp-opts{display:flex;gap:1rem;margin-bottom:1rem}
.rsvp-opt{
    flex:1;padding:.7rem;
    background:transparent;color:rgba(255,255,255,.7);
    border:1px solid rgba(255,255,255,.2);
    cursor:pointer;font-size:.75rem;letter-spacing:1px;text-transform:uppercase;
    transition:all .3s;
}
.rsvp-opt.on,.rsvp-opt:hover{background:var(--gold);color:var(--green-dark);border-color:var(--gold)}
.rsvp-input{
    width:100%;padding:.75rem 1rem;
    background:rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.15);
    color:var(--white);font-family:'Lato',sans-serif;font-size:.9rem;
    outline:none;margin-bottom:.8rem;transition:border-color .3s;
}
.rsvp-input:focus{border-color:var(--gold)}
.rsvp-input::placeholder{color:rgba(255,255,255,.4)}

/* ── GIFT ── */
.gift-sec{background:var(--cream2);text-align:center}
.gift-card{
    display:inline-block;max-width:400px;width:100%;
    background:var(--white);padding:2rem;
    border-top:3px solid var(--gold);
    box-shadow:0 4px 20px rgba(0,0,0,.06);
    margin-top:1.5rem;
}
.gift-bank-logo{
    font-size:.7rem;letter-spacing:3px;text-transform:uppercase;
    color:var(--gold);margin-bottom:.5rem;
}
.gift-account{font-size:1.8rem;font-family:'Amiri',serif;color:var(--green-dark);margin:.3rem 0}
.gift-name{font-size:.9rem;color:var(--gray)}
.btn-copy{
    display:inline-flex;align-items:center;gap:.4rem;
    margin-top:1rem;padding:.5rem 1.5rem;
    background:var(--green-dark);color:var(--white);
    border:none;cursor:pointer;font-size:.75rem;letter-spacing:2px;text-transform:uppercase;
    transition:background .3s;
}
.btn-copy:hover{background:var(--green-mid)}

/* ── FOOTER ── */
.site-footer{
    background:var(--green-dark);color:rgba(255,255,255,.5);
    text-align:center;padding:3rem 1.5rem;
}
.footer-names{font-size:2.5rem;color:var(--white);margin-bottom:.3rem}
.footer-closing{font-size:.85rem;margin-bottom:1.5rem;color:rgba(255,255,255,.6)}
.footer-brand{font-size:.6rem;letter-spacing:3px;text-transform:uppercase;color:var(--gold)}

/* ── MUSIC FAB ── */
.music-fab{
    position:fixed;bottom:1.5rem;right:1.5rem;z-index:200;
    width:46px;height:46px;border-radius:50%;
    background:var(--green-dark);color:var(--gold);
    border:2px solid var(--gold);
    display:flex;align-items:center;justify-content:center;
    cursor:pointer;font-size:1rem;
    box-shadow:0 4px 15px rgba(0,0,0,.25);
    transition:all .3s;
}
.music-fab:hover{background:var(--gold);color:var(--green-dark)}
.music-fab.playing{animation:pulse 2s infinite}
{{ '@' }}keyframes pulse{0%{box-shadow:0 0 0 0 rgba(201,168,76,.5)}70%{box-shadow:0 0 0 12px rgba(201,168,76,0)}100%{box-shadow:0 0 0 0 rgba(201,168,76,0)}}

/* ── REVEAL ── */
.reveal{opacity:0;transform:translateY(24px);transition:opacity .7s ease,transform .7s ease}
.reveal.in{opacity:1;transform:none}

/* ── RESPONSIVE ── */
{{ '@' }}media(max-width:700px){
    .couple-wrap{grid-template-columns:1fr;gap:1.5rem}
    .couple-sep{flex-direction:row;justify-content:center}
    .couple-sep .vline{width:50px;height:1px}
    .gallery-grid{grid-template-columns:repeat(2,1fr)}
    .g-item.tall{grid-row:span 1;aspect-ratio:1}
    .rsvp-opts{flex-direction:column}
}
{{ '@' }}media(max-width:420px){
    section{padding:3rem 1rem}
    .gallery-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>
@include('template.partials.preview-banner')

{{-- ══ COVER OVERLAY ══ --}}
<div id="cover">
    <div class="cover-border"></div>
    <div class="cover-corner tl"></div><div class="cover-corner tr"></div>
    <div class="cover-corner bl"></div><div class="cover-corner br"></div>

    @if($coverSrc)
    <img src="{{ $coverSrc }}" alt="cover" class="cover-photo">
    @endif

    <p class="cover-bismillah">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</p>
    <p class="cover-label">Undangan Pernikahan</p>
    <h1 class="cover-names script">
        {{ $maleNickname }}
        <span class="cover-amp script">&amp;</span>
        {{ $femaleNickname }}
    </h1>
    <p class="cover-date">
        <i class="fa-regular fa-calendar" style="margin-right:.4rem"></i>
        {{ $weddingDateFormatted }}
    </p>

    @if($other['guest'])
    <p class="cover-guest">
        Kepada Yth.
        <strong>{{ $other['guest']['name'] ?? '' }}</strong>
        @if(!empty($other['guest']['location'] ?? ''))
        <span style="font-size:.75rem;color:rgba(255,255,255,.4)">di {{ $other['guest']['location'] }}</span>
        @endif
    </p>
    @endif

    <button class="btn-open" id="btnOpen">
        <i class="fa-solid fa-envelope-open-text"></i>
        {{ $coverButton }}
    </button>
</div>

{{-- ══ MAIN ══ --}}
<div id="main">

@if($showMusic && $musicUrl)
<audio id="bgAudio" loop><source src="{{ $musicUrl }}" type="audio/mpeg"></audio>
<button class="music-fab" id="musicFab"><i class="fa-solid fa-music"></i></button>
@endif

{{-- ── HERO ── --}}
<section class="hero" id="top">
    <div class="hero-pattern"></div>
    <div class="hero-inner reveal">
        <p class="hero-bismillah">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</p>
        <p class="hero-label">Undangan Pernikahan</p>
        <h1 class="hero-names script">
            {{ $maleNickname }}
            <span class="hero-amp script">&amp;</span>
            {{ $femaleNickname }}
        </h1>
        <div class="hero-date-box">
            <i class="fa-regular fa-calendar" style="margin-right:.5rem"></i>
            {{ $weddingDateFormatted }}
            &nbsp;|&nbsp; {{ $weddingTime }} {{ $weddingTz }}
        </div>
        @if(!empty($quoteContent ?? ''))
        <p class="hero-quote">"{{ $quoteContent }}"</p>
        @endif
    </div>
    <div class="scroll-down"><span>Scroll</span><i class="fa-solid fa-chevron-down"></i></div>
</section>

{{-- ── OPENING ── --}}
<section class="opening-sec">
    <div class="sec-inner reveal" style="text-align:center">
        <p class="sec-label">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
        <h2 class="sec-title">Bismillah, Kami Menikah</h2>
        <div class="ornament-divider"><i class="fa-solid fa-star-and-crescent"></i></div>
        <p>Dengan memohon rahmat dan ridha Allah Subhanahu Wa Ta'ala, kami bermaksud menyelenggarakan pernikahan kami. Kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu.</p>
        <div class="ayat">
            وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ أَنفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا إِلَيْهَا
            <div class="ayat-source">QS. Ar-Rum: 21</div>
        </div>
    </div>
</section>

{{-- ── COUPLE ── --}}
<section class="couple-sec" id="couple">
    <div class="sec-inner">
        <div style="text-align:center" class="reveal">
            <p class="sec-label">Mempelai</p>
            <h2 class="sec-title">Dua Insan Bersatu</h2>
            <div class="ornament-divider"><i class="fa-solid fa-heart"></i></div>
        </div>
        <div class="couple-wrap reveal">
            {{-- Wanita --}}
            <div class="couple-card">
                <div class="couple-photo-ring">
                    @if($femaleSrc)
                    <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo">
                    @if($femaleFrame)<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame-img">@endif
                    @else
                    <div class="couple-photo-placeholder">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
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
                    <a href="https://instagram.com/{{ $femaleIg }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}
                    </a>
                </div>
                @endif
            </div>

            <div class="couple-sep">
                <div class="vline"></div>
                <span class="heart-icon script" style="color:var(--gold);font-size:2rem">&#x2665;</span>
                <div class="vline"></div>
            </div>

            {{-- Pria --}}
            <div class="couple-card">
                <div class="couple-photo-ring">
                    @if($maleSrc)
                    <img src="{{ $maleSrc }}" alt="{{ $maleName }}" class="couple-photo">
                    @if($maleFrame)<img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" class="couple-frame-img">@endif
                    @else
                    <div class="couple-photo-placeholder">
                        <i class="fa-solid fa-user"></i>
                    </div>
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
                    <a href="https://instagram.com/{{ $maleIg }}" target="_blank">
                        <i class="fa-brands fa-instagram"></i> @{{ $maleIg }}
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ── EVENTS ── --}}
@if(count($other['event'] ?? []) > 0)
<section class="events-sec" id="events">
    <div class="sec-inner">
        <div class="reveal">
            <p class="sec-label">Rangkaian Acara</p>
            <h2 class="sec-title">Undangan &amp; Acara</h2>
            <div class="ornament-divider" style="color:var(--gold-light)"><i class="fa-solid fa-rings-wedding"></i></div>
            <p style="color:rgba(255,255,255,.6);font-size:.9rem;max-width:560px">
                Bahagia rasanya apabila Anda berkenan hadir dan memberikan doa restu kepada kami.
            </p>
        </div>
        <div class="events-grid">
            @foreach($other['event'] as $ev)
            @php $ep = json_decode($ev->content); @endphp
            @if($ep)
            <div class="event-card reveal">
                <div class="event-icon"><i class="fa-solid fa-mosque"></i></div>
                <h3 class="event-name">{{ $ev->title }}</h3>
                <div class="event-row">
                    <i class="fa-regular fa-clock"></i>
                    <span>
                        {{ date('H:i', strtotime($ep->time->start)) }}
                        @if(!($ep->time->done ?? false)) – {{ date('H:i', strtotime($ep->time->end)) }} @else – selesai @endif
                        {{ $weddingTz }}
                    </span>
                </div>
                <div class="event-row">
                    <i class="fa-regular fa-calendar"></i>
                    <span>{{ $weddingDateFormatted }}</span>
                </div>
                @if(!empty($ep->location->address ?? ''))
                <div class="event-row">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>{{ $ep->location->address }}</span>
                </div>
                @endif
                @if(!empty($ep->location->map ?? ''))
                <a href="{{ $ep->location->map }}" target="_blank" class="event-map-btn">
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

{{-- ── COUNTDOWN ── --}}
@if($showCountdown)
<section class="countdown-sec" id="countdown">
    <div class="sec-inner reveal" style="text-align:center">
        <p class="sec-label">Menghitung Hari</p>
        <h2 class="sec-title">Insya Allah</h2>
        <div class="ornament-divider"><i class="fa-solid fa-hourglass-half"></i></div>
        <div class="countdown-row">
            <div class="cd-box"><span class="cd-num" id="cd-d">00</span><span class="cd-lbl">Hari</span></div>
            <div class="cd-box"><span class="cd-num" id="cd-h">00</span><span class="cd-lbl">Jam</span></div>
            <div class="cd-box"><span class="cd-num" id="cd-m">00</span><span class="cd-lbl">Menit</span></div>
            <div class="cd-box"><span class="cd-num" id="cd-s">00</span><span class="cd-lbl">Detik</span></div>
        </div>
        @if(($data->detail->calendar->save->show ?? false) === true)
        <a href="https://www.google.com/calendar/event?action=TEMPLATE&dates={{ date('Ymd',strtotime($weddingDate)) }}T090000Z%2F{{ date('Ymd',strtotime($weddingDate.' +1 days')) }}T090000Z&text={{ urlencode('Pernikahan '.$maleName.' & '.$femaleName) }}&location={{ urlencode($locationAddress) }}"
           target="_blank"
           style="display:inline-flex;align-items:center;gap:.5rem;margin-top:1.5rem;padding:.6rem 1.8rem;border:1px solid var(--gold);color:var(--gold);font-size:.75rem;letter-spacing:2px;text-transform:uppercase;transition:all .3s"
           onmouseover="this.style.background='var(--gold)';this.style.color='var(--green-dark)'"
           onmouseout="this.style.background='transparent';this.style.color='var(--gold)'">
            <i class="fa-regular fa-calendar-plus"></i>
            {{ $data->detail->calendar->save->content ?? 'Simpan Tanggal' }}
        </a>
        @endif
    </div>
</section>
@endif

{{-- ── STORY ── --}}
@if(count($other['story'] ?? []) > 0)
<section class="story-sec" id="story">
    <div class="sec-inner">
        <div style="text-align:center" class="reveal">
            <p class="sec-label">Kisah Kami</p>
            <h2 class="sec-title">Cerita Cinta</h2>
            <div class="ornament-divider"><i class="fa-solid fa-book-open-reader"></i></div>
            <p style="color:var(--gray);font-size:.9rem;max-width:500px;margin:0 auto">
                Banyak cerita yang kami lalui hingga akhirnya kami bisa bersatu.
            </p>
        </div>
        <div class="story-line">
            @foreach($other['story'] as $st)
            <div class="story-item reveal">
                <div class="story-dot"><i class="fa-solid fa-heart"></i></div>
                <p class="story-date">{{ \Carbon\Carbon::parse($st->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
                <h4 class="story-title">{{ $st->title }}</h4>
                <p class="story-desc">{{ $st->content }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── GALLERY ── --}}
<section class="gallery-sec" id="gallery">
    <div class="sec-inner">
        <div style="text-align:center" class="reveal">
            <p class="sec-label">Galeri</p>
            <h2 class="sec-title">Momen Berharga</h2>
            <div class="ornament-divider"><i class="fa-regular fa-images"></i></div>
        </div>
        @if($other['photo'] && !empty($other['photo']->prop->file ?? []))
        <div class="gallery-grid">
            @foreach($other['photo']->prop->file as $i => $gf)
            <div class="g-item reveal @if($i === 0) tall @endif">
                <img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy">
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
<section class="wishes-sec" id="wishes">
    <div class="sec-inner">
        <div style="text-align:center" class="reveal">
            <p class="sec-label">Ucapan &amp; Doa</p>
            <h2 class="sec-title">{{ $wishesTitle ?? 'Kirim Ucapan' }}</h2>
            <div class="ornament-divider"><i class="fa-solid fa-hands-praying"></i></div>
            @if(!empty($wishesContent ?? ''))
            <p style="color:var(--gray);font-size:.9rem;margin-bottom:1.5rem">{{ $wishesContent }}</p>
            @endif
        </div>
        <form class="wishes-form reveal" id="wishForm"
              action="{{ $invSlug ? route('invitation.wish', $invSlug) : '#' }}" method="post">
            @csrf
            <label class="f-label">Nama <var dir="name"></var></label>
            <input type="text" name="name" class="f-input" placeholder="Nama Anda" required>
            <label class="f-label">No. WhatsApp <var dir="phone"></var></label>
            <input type="text" name="phone" class="f-input" placeholder="08xxxxxxxxxx" required>
            <label class="f-label">Ucapan &amp; Doa <var dir="message"></var></label>
            <textarea name="message" class="f-input" placeholder="Tulis ucapan dan doa terbaik Anda..." required></textarea>
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane" style="margin-right:.4rem"></i> Kirim Ucapan
            </button>
            <div class="form-msg" id="wishMsg"></div>
        </form>
    </div>
</section>
@endif

{{-- ── RSVP ── --}}
<section class="rsvp-sec" id="rsvp">
    <div class="sec-inner">
        <div style="text-align:center" class="reveal">
            <p class="sec-label">Konfirmasi Kehadiran</p>
            <h2 class="sec-title">{{ $rsvpTitle ?? 'Apakah Anda Hadir?' }}</h2>
            <div class="ornament-divider" style="color:var(--gold-light)"><i class="fa-solid fa-check-double"></i></div>
            @if(!empty($rsvpContent ?? ''))
            <p style="color:rgba(255,255,255,.6);font-size:.9rem">{{ $rsvpContent }}</p>
            @endif
        </div>
        <form class="rsvp-form reveal" id="rsvpForm"
              action="{{ $invSlug ? route('invitation.present', $invSlug) : '#' }}" method="post">
            @csrf
            <input type="hidden" name="option" id="rsvpOpt" value="">
            <div class="rsvp-opts">
                <button type="button" class="rsvp-opt" onclick="pickRsvp(this,'yes')">
                    <i class="fa-solid fa-check" style="margin-right:.3rem"></i>
                    {{ $rsvpYes ?? 'Hadir' }}
                </button>
                <button type="button" class="rsvp-opt" onclick="pickRsvp(this,'no')">
                    <i class="fa-solid fa-xmark" style="margin-right:.3rem"></i>
                    {{ $rsvpNo ?? 'Tidak Hadir' }}
                </button>
            </div>
            <input type="text"   name="name"   class="rsvp-input" placeholder="Nama Anda" required>
            <input type="number" name="amount" class="rsvp-input" placeholder="Jumlah tamu" min="1" value="1">
            <button type="submit" class="btn-submit" style="background:var(--gold);color:var(--green-dark)">
                <i class="fa-solid fa-envelope-circle-check" style="margin-right:.4rem"></i> Kirim Konfirmasi
            </button>
            <div class="form-msg" id="rsvpMsg"></div>
        </form>
    </div>
</section>

{{-- ── GIFT ── --}}
@if($showGift && !empty($giftCode ?? ''))
<section class="gift-sec" id="gift">
    <div class="sec-inner reveal" style="text-align:center">
        <p class="sec-label">Amplop Digital</p>
        <h2 class="sec-title">{{ $giftTitle ?? 'Hadiah Pernikahan' }}</h2>
        <div class="ornament-divider"><i class="fa-solid fa-gift"></i></div>
        @if(!empty($giftContent ?? ''))
        <p style="color:var(--gray);font-size:.9rem;margin-bottom:.5rem">{{ $giftContent }}</p>
        @endif
        <div class="gift-card">
            <p class="gift-bank-logo">{{ strtoupper($giftBank ?? 'Bank') }}</p>
            <p class="gift-account" id="giftAccNum">{{ $giftCode }}</p>
            <p class="gift-name">a.n. {{ $giftName }}</p>
            <button class="btn-copy" onclick="copyAcc()">
                <i class="fa-regular fa-copy"></i> Salin Nomor
            </button>
        </div>
    </div>
</section>
@endif

{{-- ── FOOTER ── --}}
@php $__detailsShownGift = true; $__detailsShownStory = true; @endphp
@include('template.partials.details')

<footer class="site-footer">
    <h2 class="footer-names script">{{ $maleNickname }} &amp; {{ $femaleNickname }}</h2>
    @if($showClosing && !empty($closingText ?? ''))
    <p class="footer-closing">{{ $closingText }}</p>
    @endif
    <p style="font-size:.85rem;color:rgba(255,255,255,.5);margin-bottom:.5rem">
        Wassalamu'alaikum Warahmatullahi Wabarakatuh
    </p>
    <p class="footer-brand">Risa Digital Invitation</p>
</footer>

</div>{{-- /#main --}}

<script>
// ── Open cover
document.getElementById('btnOpen').addEventListener('click', function() {
    document.getElementById('cover').classList.add('gone');
    document.getElementById('main').classList.add('on');
    @if($showMusic && $musicUrl)
    setTimeout(() => document.getElementById('bgAudio')?.play().catch(()=>{}), 600);
    @endif
});

// ── Music
@if($showMusic && $musicUrl)
const aud = document.getElementById('bgAudio');
const fab = document.getElementById('musicFab');
fab.addEventListener('click', function() {
    if (aud.paused) {
        aud.play();
        fab.classList.add('playing');
        fab.innerHTML = '<i class="fa-solid fa-pause"></i>';
    } else {
        aud.pause();
        fab.classList.remove('playing');
        fab.innerHTML = '<i class="fa-solid fa-music"></i>';
    }
});
@endif

// ── Countdown
(function tick() {
    const t = new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');
    function run() {
        const diff = t - new Date();
        if (diff <= 0) {
            document.getElementById('countdown')?.querySelector('.countdown-row')?.remove();
            return;
        }
        const pad = n => String(Math.floor(n)).padStart(2,'0');
        document.getElementById('cd-d').textContent = pad(diff/86400000);
        document.getElementById('cd-h').textContent = pad((diff%86400000)/3600000);
        document.getElementById('cd-m').textContent = pad((diff%3600000)/60000);
        document.getElementById('cd-s').textContent = pad((diff%60000)/1000);
    }
    run(); setInterval(run, 1000);
})();

// ── RSVP pick
function pickRsvp(el, val) {
    document.querySelectorAll('.rsvp-opt').forEach(b => b.classList.remove('on'));
    el.classList.add('on');
    document.getElementById('rsvpOpt').value = val;
}

// ── AJAX form helper
function ajaxForm(id, msgId) {
    const f = document.getElementById(id);
    if (!f) return;
    f.addEventListener('submit', function(e) {
        e.preventDefault();
        const msg = document.getElementById(msgId);
        const btn = f.querySelector('button[type=submit]');
        btn.disabled = true;
        fetch(f.action, { method:'POST', body: new FormData(f), headers:{'X-Requested-With':'XMLHttpRequest'} })
            .then(r => r.json())
            .then(d => {
                msg.style.display = 'block';
                msg.className = 'form-msg ok';
                msg.textContent = d.message || 'Terkirim!';
                f.reset();
                document.querySelectorAll('.rsvp-opt').forEach(b => b.classList.remove('on'));
            })
            .catch(() => {
                msg.style.display = 'block';
                msg.className = 'form-msg err';
                msg.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
            })
            .finally(() => btn.disabled = false);
    });
}
ajaxForm('wishForm', 'wishMsg');
ajaxForm('rsvpForm', 'rsvpMsg');

// ── Copy account number
function copyAcc() {
    const num = document.getElementById('giftAccNum')?.textContent?.trim();
    if (!num) return;
    navigator.clipboard.writeText(num).then(() => {
        const btn = document.querySelector('.btn-copy');
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-check"></i> Tersalin!';
        setTimeout(() => btn.innerHTML = orig, 2000);
    });
}

// ── Scroll reveal
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); obs.unobserve(e.target); } });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
</script>
</body>
</html>
