@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:title" content="Wedding of {{ $femaleNickname }} & {{ $maleNickname }}">
<meta name="theme-color" content="#b5838d">
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Nunito:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{
    --rose:#b5838d;--rose-light:#f2d7db;--rose-dark:#8a5a63;
    --blush:#fdf0f2;--cream:#faf8f6;--white:#fff;--dark:#2d1f22;--gray:#8a7a7d;
    --color-primary:#b5838d;--color-muted:rgba(45,31,34,.6);
    --section-bg:#fff;--card-bg:#fdf0f2;--rsvp-bg:#fdf0f2;
    --font-heading:'Libre Baskerville',serif;
}
*{margin:0;padding:0;box-sizing:border-box}html{scroll-behavior:smooth}
body{font-family:'Nunito',sans-serif;background:var(--cream);color:var(--dark);overflow-x:hidden}
h1,h2,h3,h4{font-family:'Libre Baskerville',serif}

/* COVER */
#cover{position:fixed;inset:0;z-index:9999;background:var(--blush);display:flex;align-items:center;justify-content:center;text-align:center;padding:2rem;transition:opacity .9s,visibility .9s}
#cover.gone{opacity:0;visibility:hidden;pointer-events:none}
.cover-petal{position:absolute;font-size:8rem;opacity:.08;pointer-events:none}
.cover-petal.p1{top:5%;left:5%;transform:rotate(-20deg)}
.cover-petal.p2{top:5%;right:5%;transform:rotate(20deg)}
.cover-petal.p3{bottom:5%;left:5%;transform:rotate(15deg)}
.cover-petal.p4{bottom:5%;right:5%;transform:rotate(-15deg)}
.cover-inner{position:relative;z-index:1}
.cover-ornament{font-size:2rem;color:var(--rose);margin-bottom:1rem;opacity:.6}
.cover-label{font-size:.65rem;letter-spacing:5px;text-transform:uppercase;color:var(--rose);margin-bottom:1rem}
.cover-names{font-size:clamp(2.5rem,8vw,5rem);color:var(--dark);line-height:1.05}
.cover-amp{color:var(--rose);font-style:italic}
.cover-divider{width:80px;height:1px;background:var(--rose-light);margin:1.5rem auto}
.cover-date{font-size:.75rem;letter-spacing:3px;text-transform:uppercase;color:var(--gray)}
.cover-guest{font-size:.8rem;color:var(--gray);margin-top:.8rem}
.cover-guest strong{color:var(--dark);display:block}
.btn-open{display:inline-flex;align-items:center;gap:.5rem;margin-top:2rem;padding:.85rem 2.5rem;background:var(--rose);color:var(--white);border:none;font-size:.78rem;letter-spacing:2px;text-transform:uppercase;cursor:pointer;transition:all .3s;font-family:'Nunito',sans-serif;border-radius:50px}
.btn-open:hover{background:var(--rose-dark);transform:translateY(-2px)}

/* MAIN */
#main{display:none}#main.on{display:block}

/* HERO */
.hero{min-height:100vh;background:linear-gradient(135deg,var(--blush) 0%,#f9e8eb 100%);display:flex;align-items:center;justify-content:center;text-align:center;padding:3rem 2rem;position:relative;overflow:hidden}
.hero-circle{position:absolute;width:600px;height:600px;border-radius:50%;border:1px solid rgba(181,131,141,.1);top:50%;left:50%;transform:translate(-50%,-50%)}
.hero-circle2{position:absolute;width:400px;height:400px;border-radius:50%;border:1px solid rgba(181,131,141,.15);top:50%;left:50%;transform:translate(-50%,-50%)}
.hero-inner{position:relative;z-index:1}
.hero-ornament{font-size:2.5rem;color:var(--rose);opacity:.5;margin-bottom:1rem}
.hero-label{font-size:.65rem;letter-spacing:5px;text-transform:uppercase;color:var(--rose);margin-bottom:1rem}
.hero-names{font-size:clamp(3rem,10vw,6.5rem);color:var(--dark);line-height:1}
.hero-amp{color:var(--rose);font-style:italic;display:block;font-size:clamp(2rem,6vw,4rem);margin:.2rem 0}
.hero-divider{width:60px;height:1px;background:var(--rose-light);margin:2rem auto}
.hero-date{font-size:.75rem;letter-spacing:4px;text-transform:uppercase;color:var(--gray)}
.hero-quote{font-size:1rem;font-style:italic;color:var(--gray);margin-top:1.5rem;max-width:420px;margin-left:auto;margin-right:auto}

/* SECTION */
.sec-hd{text-align:center;margin-bottom:3rem}
.sec-tag{font-size:.65rem;letter-spacing:5px;text-transform:uppercase;color:var(--rose);margin-bottom:.5rem}
.sec-title{font-size:clamp(2rem,5vw,3rem);color:var(--dark)}
.sec-ornament{font-size:1.5rem;color:var(--rose);opacity:.4;margin-top:.5rem}

/* COUPLE */
.couple-section{padding:6rem 2rem;background:var(--white)}
.couple-wrap{max-width:900px;margin:0 auto;display:grid;grid-template-columns:1fr 60px 1fr;align-items:center;gap:2rem}
.couple-card{text-align:center}
.couple-photo-wrap{position:relative;display:inline-block;margin-bottom:1.5rem}
.couple-photo{width:200px;height:200px;border-radius:50%;object-fit:cover;border:4px solid var(--rose-light)}
.couple-placeholder{width:200px;height:200px;border-radius:50%;background:var(--blush);display:flex;align-items:center;justify-content:center;color:var(--rose);font-size:3.5rem;border:4px solid var(--rose-light)}
.couple-frame-img{position:absolute;inset:-6px;border-radius:50%;pointer-events:none}
.couple-name{font-size:1.9rem;color:var(--dark);margin-bottom:.3rem}
.couple-role{font-size:.65rem;letter-spacing:3px;text-transform:uppercase;color:var(--rose);margin-bottom:.8rem}
.couple-parent{font-size:.82rem;color:var(--gray);line-height:1.8}
.couple-ig{font-size:.78rem;color:var(--rose);margin-top:.5rem}
.couple-sep{display:flex;flex-direction:column;align-items:center;gap:.5rem;color:var(--rose)}
.sep-line{width:1px;height:60px;background:var(--rose-light)}
.sep-heart{font-size:1.5rem}

/* EVENTS */
.events-section{padding:6rem 2rem;background:var(--blush)}
.events-grid{max-width:900px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem}
.event-card{background:var(--white);padding:2.5rem;border-radius:12px;text-align:center;box-shadow:0 4px 20px rgba(181,131,141,.1)}
.event-icon{font-size:2rem;color:var(--rose);margin-bottom:1rem}
.event-name{font-size:1.6rem;color:var(--dark);margin-bottom:.8rem}
.event-time{font-size:.8rem;color:var(--rose);letter-spacing:1px;margin-bottom:.5rem}
.event-loc{font-size:.85rem;color:var(--gray);line-height:1.6}
.event-map{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;padding:.5rem 1.5rem;background:var(--rose);color:var(--white);border-radius:50px;font-size:.75rem;text-decoration:none;transition:background .3s}
.event-map:hover{background:var(--rose-dark)}

/* COUNTDOWN */
.countdown-section{padding:5rem 2rem;background:var(--rose-dark);text-align:center}
.countdown-grid{display:flex;justify-content:center;gap:1.5rem;flex-wrap:wrap;margin-top:2.5rem}
.cd-item{background:rgba(255,255,255,.1);padding:1.5rem 2rem;border-radius:12px;min-width:90px;text-align:center}
.cd-num{font-family:'Libre Baskerville',serif;font-size:3rem;color:var(--white);display:block;line-height:1}
.cd-lbl{font-size:.6rem;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-top:.3rem}

/* GALLERY */
.gallery-section{padding:6rem 2rem;background:var(--cream)}
.gallery-grid{max-width:1100px;margin:2rem auto 0;display:grid;grid-template-columns:repeat(3,1fr);gap:.8rem}
.g-item{overflow:hidden;aspect-ratio:1;border-radius:8px}
.g-item.wide{grid-column:span 2;aspect-ratio:2/1}
.g-item img{width:100%;height:100%;object-fit:cover;transition:transform .6s;display:block}
.g-item:hover img{transform:scale(1.05)}

/* GIFT */
.gift-section{padding:5rem 2rem;background:var(--white);text-align:center}
.gift-card{display:inline-block;max-width:360px;width:100%;padding:2rem;background:var(--blush);border-radius:12px;margin-top:2rem}
.gift-bank{font-size:.65rem;letter-spacing:4px;text-transform:uppercase;color:var(--rose);margin-bottom:.5rem}
.gift-num{font-family:'Libre Baskerville',serif;font-size:2rem;color:var(--dark);margin:.3rem 0}
.gift-name{font-size:.82rem;color:var(--gray)}
.btn-copy{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;padding:.5rem 1.5rem;background:var(--rose);color:var(--white);border:none;border-radius:50px;font-size:.75rem;cursor:pointer;transition:background .3s;font-family:'Nunito',sans-serif}
.btn-copy:hover{background:var(--rose-dark)}

/* MUSIC */
.music-fab{position:fixed;bottom:2rem;right:2rem;z-index:200;width:46px;height:46px;border-radius:50%;background:var(--rose);color:var(--white);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;box-shadow:0 4px 15px rgba(181,131,141,.4);transition:all .3s}
.music-fab:hover{background:var(--rose-dark)}

/* FOOTER */
.site-footer{background:var(--dark);color:rgba(255,255,255,.5);text-align:center;padding:4rem 2rem}
.footer-names{font-size:3rem;color:var(--white);margin-bottom:.5rem}
.footer-brand{font-size:.6rem;letter-spacing:4px;text-transform:uppercase;color:var(--rose);margin-top:1.5rem}

.reveal{opacity:0;transform:translateY(20px);transition:opacity .7s,transform .7s}
.reveal.in{opacity:1;transform:none}

{{ '@' }}media(max-width:768px){
    .couple-wrap{grid-template-columns:1fr;gap:2rem}
    .couple-sep{flex-direction:row;justify-content:center}
    .sep-line{width:50px;height:1px}
    .gallery-grid{grid-template-columns:repeat(2,1fr)}
    .g-item.wide{grid-column:span 2;aspect-ratio:1}
}
{{ '@' }}media(max-width:480px){
    .gallery-grid{grid-template-columns:1fr}
    .g-item.wide{grid-column:span 1;aspect-ratio:1}
}
</style>
</head>
<body>
@include('template.partials.preview-banner')

<div id="cover">
    <div class="cover-petal p1">🌸</div>
    <div class="cover-petal p2">🌸</div>
    <div class="cover-petal p3">🌸</div>
    <div class="cover-petal p4">🌸</div>
    <div class="cover-inner">
        @if($coverSrc)
        <img src="{{ $coverSrc }}" alt="cover" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid var(--rose-light);margin-bottom:1.5rem">
        @endif
        <div class="cover-ornament">❀</div>
        <p class="cover-label">Undangan Pernikahan</p>
        <h1 class="cover-names">{{ $femaleNickname }}<span class="cover-amp"> &amp; </span>{{ $maleNickname }}</h1>
        <div class="cover-divider"></div>
        <p class="cover-date">{{ $weddingDateShort }}</p>
        @if($other['guest'])<div class="cover-guest">Kepada Yth.<strong>{{ $other['guest']['name'] ?? '' }}</strong></div>@endif
        <button class="btn-open" id="btnOpen"><i class="fa-solid fa-envelope-open-text"></i> {{ $coverButton }}</button>
    </div>
</div>

<div id="main">
@if($showMusic && $musicUrl)
<audio id="bgAudio" loop><source src="{{ $musicUrl }}" type="audio/mpeg"></audio>
<button class="music-fab" id="musicFab"><i class="fa-solid fa-music"></i></button>
@endif

<section class="hero">
    <div class="hero-circle"></div>
    <div class="hero-circle2"></div>
    <div class="hero-inner reveal">
        <div class="hero-ornament">❀</div>
        <p class="hero-label">The Wedding of</p>
        <h1 class="hero-names">{{ $femaleNickname }}<span class="hero-amp">&amp;</span>{{ $maleNickname }}</h1>
        <div class="hero-divider"></div>
        <p class="hero-date">{{ $weddingDateFormatted }}</p>
        @if($quoteContent)<p class="hero-quote">"{{ $quoteContent }}"</p>@endif
    </div>
</section>

<section class="couple-section">
    <div class="sec-hd reveal"><p class="sec-tag">Mempelai</p><h2 class="sec-title">Dua Hati Menjadi Satu</h2><div class="sec-ornament">❀</div></div>
    <div class="couple-wrap reveal">
        <div class="couple-card">
            <div class="couple-photo-wrap">
                @if($femaleSrc)<img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo">
                @if($femaleFrame)<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame-img">@endif
                @else<div class="couple-placeholder">{{ $femaleInitial }}</div>@endif
            </div>
            <h3 class="couple-name">{{ $femaleName }}</h3>
            <p class="couple-role">Mempelai Wanita</p>
            @if($showParent)<p class="couple-parent">Putri ke-{{ $femaleChildhood }} dari<br>Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}</p>@endif
            @if($showIg && $femaleIg)<p class="couple-ig"><i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}</p>@endif
        </div>
        <div class="couple-sep"><div class="sep-line"></div><span class="sep-heart">&#x2665;</span><div class="sep-line"></div></div>
        <div class="couple-card">
            <div class="couple-photo-wrap">
                @if($maleSrc)<img src="{{ $maleSrc }}" alt="{{ $maleName }}" class="couple-photo">
                @if($maleFrame)<img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" class="couple-frame-img">@endif
                @else<div class="couple-placeholder">{{ $maleInitial }}</div>@endif
            </div>
            <h3 class="couple-name">{{ $maleName }}</h3>
            <p class="couple-role">Mempelai Pria</p>
            @if($showParent)<p class="couple-parent">Putra ke-{{ $maleChildhood }} dari<br>Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}</p>@endif
            @if($showIg && $maleIg)<p class="couple-ig"><i class="fa-brands fa-instagram"></i> @{{ $maleIg }}</p>@endif
        </div>
    </div>
</section>

@if(count($other['event'] ?? []) > 0)
<section class="events-section">
    <div class="sec-hd reveal"><p class="sec-tag">Acara</p><h2 class="sec-title">Rangkaian Acara</h2><div class="sec-ornament">❀</div></div>
    <div class="events-grid">
        @foreach($other['event'] as $ev)
        @php $ep = json_decode($ev->content); @endphp
        @if($ep)
        <div class="event-card reveal">
            <div class="event-icon"><i class="fa-solid fa-rings-wedding"></i></div>
            <h3 class="event-name">{{ $ev->title }}</h3>
            <p class="event-time">{{ $weddingDateFormatted }}</p>
            <p class="event-time">{{ date('H:i',strtotime($ep->time->start)) }}@if(!($ep->time->done??false)) &ndash; {{ date('H:i',strtotime($ep->time->end)) }}@endif {{ $weddingTz }}</p>
            @if(!empty($ep->location->address??''))<p class="event-loc">{{ $ep->location->address }}</p>@endif
            @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" target="_blank" class="event-map"><i class="fa-solid fa-map-pin"></i> Lihat Peta</a>@endif
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

@if($showCountdown)
<section class="countdown-section">
    <div class="sec-hd reveal"><p class="sec-tag" style="color:rgba(255,255,255,.5)">Menghitung Hari</p><h2 class="sec-title" style="color:var(--white)">Hari Bahagia Kami</h2></div>
    <div class="countdown-grid">
        <div class="cd-item"><span class="cd-num" id="cd-d">00</span><span class="cd-lbl">Hari</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-h">00</span><span class="cd-lbl">Jam</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-m">00</span><span class="cd-lbl">Menit</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-s">00</span><span class="cd-lbl">Detik</span></div>
    </div>
</section>
@endif

@if(count($galleryFiles) > 0)
<section class="gallery-section">
    <div class="sec-hd reveal"><p class="sec-tag">Galeri</p><h2 class="sec-title">{{ $galleryTitle }}</h2><div class="sec-ornament">❀</div></div>
    <div class="gallery-grid">
        @foreach($galleryFiles as $i => $gf)
        <div class="g-item reveal @if($i===0) wide @endif"><img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy"></div>
        @endforeach
    </div>
</section>
@endif

@if($showGift && $giftCode)
<section class="gift-section">
    <div class="sec-hd reveal"><p class="sec-tag">Hadiah</p><h2 class="sec-title">{{ $giftTitle }}</h2></div>
    <div class="gift-card reveal">
        <p class="gift-bank">{{ strtoupper($giftBank) }}</p>
        <p class="gift-num">{{ $giftCode }}</p>
        <p class="gift-name">a.n. {{ $giftName }}</p>
        <button class="btn-copy" onclick="navigator.clipboard.writeText('{{ $giftCode }}').then(()=>{this.textContent='Tersalin!';setTimeout(()=>this.textContent='Salin',2000)})">Salin</button>
    </div>
</section>
@endif

@php $__detailsShownGift = true; @endphp
@include('template.partials.details')

@include('template.partials.rsvp-wishes')

<footer class="site-footer">
    <h2 class="footer-names">{{ $femaleNickname }} &amp; {{ $maleNickname }}</h2>
    @if($showClosing && $closingText)<p style="font-size:.85rem;margin-top:.5rem">{{ $closingText }}</p>@endif
    <p class="footer-brand">Risa Digital Invitation</p>
</footer>
</div>

<script>
document.getElementById('btnOpen').addEventListener('click',function(){
    document.getElementById('cover').classList.add('gone');
    document.getElementById('main').classList.add('on');
    @if($showMusic && $musicUrl)setTimeout(()=>document.getElementById('bgAudio')?.play().catch(()=>{}),600);@endif
});
@if($showMusic && $musicUrl)
var aud=document.getElementById('bgAudio'),fab=document.getElementById('musicFab');
fab.addEventListener('click',function(){if(aud.paused){aud.play();fab.innerHTML='<i class="fa-solid fa-pause"></i>';}else{aud.pause();fab.innerHTML='<i class="fa-solid fa-music"></i>';}});
@endif
(function(){var t=new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');function run(){var diff=t-new Date();if(diff<=0)return;var pad=function(n){return String(Math.floor(n)).padStart(2,'0');};document.getElementById('cd-d').textContent=pad(diff/86400000);document.getElementById('cd-h').textContent=pad((diff%86400000)/3600000);document.getElementById('cd-m').textContent=pad((diff%3600000)/60000);document.getElementById('cd-s').textContent=pad((diff%60000)/1000);}run();setInterval(run,1000);})();
var obs=new IntersectionObserver(function(e){e.forEach(function(x){if(x.isIntersecting){x.target.classList.add('in');obs.unobserve(x.target);}});},{threshold:.1});
document.querySelectorAll('.reveal').forEach(function(el){obs.observe(el);});
</script>
</body>
</html>
