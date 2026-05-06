@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:title" content="Wedding of {{ $femaleNickname }} & {{ $maleNickname }}">
<meta name="theme-color" content="#2d7a4f">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{
    --green:#2d7a4f;--green-light:#e8f5ee;--green-dark:#1d5a3f;
    --sage:#8fad91;--cream:#f7f9f7;--white:#fff;--dark:#1c2b1e;--gray:#6b7c6d;
    --color-primary:#2d7a4f;--color-muted:rgba(28,43,30,.6);
    --section-bg:#fff;--card-bg:#f7f9f7;--rsvp-bg:#edf5ef;
    --font-heading:'DM Serif Display',serif;
}
*{margin:0;padding:0;box-sizing:border-box}html{scroll-behavior:smooth}
body{font-family:'DM Sans',sans-serif;background:var(--cream);color:var(--dark);overflow-x:hidden}
h1,h2,h3,h4{font-family:'DM Serif Display',serif}

/* COVER */
#cover{position:fixed;inset:0;z-index:9999;background:var(--green-dark);display:flex;align-items:center;justify-content:center;text-align:center;padding:2rem;transition:opacity .9s,visibility .9s}
#cover.gone{opacity:0;visibility:hidden;pointer-events:none}
.cover-circle{position:absolute;width:500px;height:500px;border-radius:50%;border:1px solid rgba(255,255,255,.08);top:50%;left:50%;transform:translate(-50%,-50%)}
.cover-circle2{position:absolute;width:350px;height:350px;border-radius:50%;border:1px solid rgba(255,255,255,.12);top:50%;left:50%;transform:translate(-50%,-50%)}
.cover-inner{position:relative;z-index:1}
.cover-tag{display:inline-block;padding:.3rem 1.2rem;border:1px solid rgba(255,255,255,.3);font-size:.65rem;letter-spacing:4px;text-transform:uppercase;color:rgba(255,255,255,.6);margin-bottom:1.5rem}
.cover-names{font-size:clamp(2.5rem,8vw,5rem);color:var(--white);line-height:1.05}
.cover-amp{color:var(--sage);font-style:italic}
.cover-date{font-size:.78rem;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-top:1.2rem}
.cover-guest{font-size:.8rem;color:rgba(255,255,255,.4);margin-top:.6rem}
.cover-guest strong{color:rgba(255,255,255,.7);display:block}
.btn-open{display:inline-flex;align-items:center;gap:.5rem;margin-top:2rem;padding:.85rem 2.5rem;background:var(--sage);color:var(--dark);border:none;font-size:.8rem;letter-spacing:2px;text-transform:uppercase;cursor:pointer;transition:all .3s;font-family:'DM Sans',sans-serif;border-radius:2px}
.btn-open:hover{background:var(--white)}

/* MAIN */
#main{display:none}#main.on{display:block}

/* HERO */
.hero{min-height:100vh;background:linear-gradient(160deg,var(--green-dark) 0%,var(--green) 100%);display:flex;align-items:center;justify-content:center;text-align:center;padding:3rem 2rem;position:relative;overflow:hidden}
.hero-leaf{position:absolute;font-size:20rem;opacity:.04;top:-50px;right:-80px;transform:rotate(20deg)}
.hero-leaf2{position:absolute;font-size:15rem;opacity:.04;bottom:-30px;left:-60px;transform:rotate(-15deg)}
.hero-inner{position:relative;z-index:1}
.hero-tag{font-size:.65rem;letter-spacing:5px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-bottom:1.5rem}
.hero-names{font-size:clamp(3rem,10vw,6.5rem);color:var(--white);line-height:1}
.hero-amp{color:var(--sage);font-style:italic;display:block;font-size:clamp(2rem,6vw,4rem);margin:.2rem 0}
.hero-bar{width:60px;height:2px;background:var(--sage);margin:2rem auto}
.hero-date{font-size:.78rem;letter-spacing:4px;text-transform:uppercase;color:rgba(255,255,255,.5)}
.hero-quote{font-size:1rem;font-style:italic;color:rgba(255,255,255,.4);margin-top:1.5rem;max-width:420px;margin-left:auto;margin-right:auto}

/* SECTION */
.sec-hd{text-align:center;margin-bottom:3rem}
.sec-tag{font-size:.65rem;letter-spacing:5px;text-transform:uppercase;color:var(--sage);margin-bottom:.5rem}
.sec-title{font-size:clamp(2rem,5vw,3rem);color:var(--dark)}
.sec-bar{width:40px;height:2px;background:var(--green);margin:1rem auto 0}

/* COUPLE */
.couple-section{padding:6rem 2rem;background:var(--white)}
.couple-wrap{max-width:900px;margin:0 auto;display:grid;grid-template-columns:1fr 50px 1fr;align-items:center;gap:2rem}
.couple-card{text-align:center}
.couple-photo-wrap{position:relative;display:inline-block;margin-bottom:1.5rem}
.couple-photo{width:190px;height:190px;border-radius:50%;object-fit:cover;border:3px solid var(--green-light)}
.couple-placeholder{width:190px;height:190px;border-radius:50%;background:var(--green-light);display:flex;align-items:center;justify-content:center;color:var(--green);font-size:3.5rem;border:3px solid var(--green-light)}
.couple-frame-img{position:absolute;inset:-6px;border-radius:50%;pointer-events:none}
.couple-name{font-size:1.9rem;color:var(--dark);margin-bottom:.3rem}
.couple-role{font-size:.65rem;letter-spacing:3px;text-transform:uppercase;color:var(--sage);margin-bottom:.8rem}
.couple-parent{font-size:.82rem;color:var(--gray);line-height:1.8}
.couple-ig{font-size:.78rem;color:var(--green);margin-top:.5rem}
.couple-sep{display:flex;flex-direction:column;align-items:center;gap:.5rem;color:var(--sage)}
.sep-line{width:1px;height:60px;background:var(--green-light)}
.sep-heart{font-size:1.5rem}

/* EVENTS */
.events-section{padding:6rem 2rem;background:var(--cream)}
.events-grid{max-width:900px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem}
.event-card{background:var(--white);padding:2.5rem;border-radius:4px;border-left:3px solid var(--green);box-shadow:0 2px 20px rgba(45,122,79,.06)}
.event-name{font-size:1.6rem;color:var(--dark);margin-bottom:.8rem}
.event-row{display:flex;align-items:center;gap:.5rem;font-size:.82rem;color:var(--gray);margin-bottom:.4rem}
.event-row i{color:var(--green);width:14px}
.event-map{display:inline-flex;align-items:center;gap:.4rem;margin-top:.8rem;padding:.45rem 1.2rem;background:var(--green);color:var(--white);border-radius:2px;font-size:.75rem;text-decoration:none;transition:background .3s}
.event-map:hover{background:var(--green-dark)}

/* COUNTDOWN */
.countdown-section{padding:5rem 2rem;background:var(--green);text-align:center}
.countdown-grid{display:flex;justify-content:center;gap:1.5rem;flex-wrap:wrap;margin-top:2.5rem}
.cd-item{background:rgba(255,255,255,.1);padding:1.5rem 2rem;border-radius:4px;min-width:90px;text-align:center}
.cd-num{font-family:'DM Serif Display',serif;font-size:3rem;color:var(--white);display:block;line-height:1}
.cd-lbl{font-size:.6rem;letter-spacing:3px;text-transform:uppercase;color:rgba(255,255,255,.5);margin-top:.3rem}

/* STORY */
.story-section{padding:6rem 2rem;background:var(--white)}
.story-line{max-width:700px;margin:2rem auto 0;position:relative;padding-left:2rem}
.story-line::before{content:'';position:absolute;left:0;top:0;bottom:0;width:2px;background:linear-gradient(180deg,var(--green),var(--sage),transparent)}
.story-item{position:relative;margin-bottom:2.5rem;padding-left:1.5rem}
.story-dot{position:absolute;left:-2.3rem;top:.3rem;width:16px;height:16px;border-radius:50%;background:var(--white);border:2px solid var(--green)}
.story-yr{font-size:.65rem;letter-spacing:3px;text-transform:uppercase;color:var(--sage);margin-bottom:.2rem}
.story-ttl{font-size:1.2rem;color:var(--dark);margin-bottom:.3rem}
.story-desc{font-size:.85rem;color:var(--gray);line-height:1.7}

/* GALLERY */
.gallery-section{padding:6rem 2rem;background:var(--cream)}
.gallery-grid{max-width:1100px;margin:2rem auto 0;display:grid;grid-template-columns:repeat(3,1fr);gap:.8rem}
.g-item{overflow:hidden;aspect-ratio:1}
.g-item.wide{grid-column:span 2;aspect-ratio:2/1}
.g-item img{width:100%;height:100%;object-fit:cover;transition:transform .6s;display:block}
.g-item:hover img{transform:scale(1.05)}

/* GIFT */
.gift-section{padding:5rem 2rem;background:var(--white);text-align:center}
.gift-card{display:inline-block;max-width:360px;width:100%;padding:2rem;background:var(--cream);border-radius:4px;margin-top:2rem;border-top:3px solid var(--green)}
.gift-bank{font-size:.65rem;letter-spacing:4px;text-transform:uppercase;color:var(--sage);margin-bottom:.5rem}
.gift-num{font-family:'DM Serif Display',serif;font-size:2rem;color:var(--dark);margin:.3rem 0}
.gift-name{font-size:.82rem;color:var(--gray)}
.btn-copy{display:inline-flex;align-items:center;gap:.4rem;margin-top:1rem;padding:.5rem 1.5rem;background:var(--green);color:var(--white);border:none;border-radius:2px;font-size:.75rem;cursor:pointer;transition:background .3s;font-family:'DM Sans',sans-serif}
.btn-copy:hover{background:var(--green-dark)}

/* MUSIC */
.music-fab{position:fixed;bottom:2rem;right:2rem;z-index:200;width:46px;height:46px;border-radius:50%;background:var(--green);color:var(--white);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;box-shadow:0 4px 15px rgba(45,122,79,.3);transition:all .3s}
.music-fab:hover{background:var(--green-dark)}

/* FOOTER */
.site-footer{background:var(--dark);color:rgba(255,255,255,.5);text-align:center;padding:4rem 2rem}
.footer-names{font-size:3rem;color:var(--white);margin-bottom:.5rem}
.footer-brand{font-size:.6rem;letter-spacing:4px;text-transform:uppercase;color:var(--sage);margin-top:1.5rem}

/* REVEAL */
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

<div id="cover">
    <div class="cover-circle"></div>
    <div class="cover-circle2"></div>
    <div class="cover-inner">
        @if($coverSrc)
        <img src="{{ $coverSrc }}" alt="cover" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.2);margin-bottom:1.5rem">
        @endif
        <div class="cover-tag">Undangan Pernikahan</div>
        <h1 class="cover-names">{{ $femaleNickname }}<span class="cover-amp"> &amp; </span>{{ $maleNickname }}</h1>
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
    <div class="hero-leaf">🌿</div>
    <div class="hero-leaf2">🌿</div>
    <div class="hero-inner reveal">
        <p class="hero-tag">The Wedding of</p>
        <h1 class="hero-names">{{ $femaleNickname }}<span class="hero-amp">&amp;</span>{{ $maleNickname }}</h1>
        <div class="hero-bar"></div>
        <p class="hero-date">{{ $weddingDateFormatted }}</p>
        @if($quoteContent)<p class="hero-quote">"{{ $quoteContent }}"</p>@endif
    </div>
</section>

<section class="couple-section">
    <div class="sec-hd reveal"><p class="sec-tag">Mempelai</p><h2 class="sec-title">Dua Hati Menjadi Satu</h2><div class="sec-bar"></div></div>
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
    <div class="sec-hd reveal"><p class="sec-tag">Acara</p><h2 class="sec-title">Rangkaian Acara</h2><div class="sec-bar"></div></div>
    <div class="events-grid">
        @foreach($other['event'] as $ev)
        @php $ep = json_decode($ev->content); @endphp
        @if($ep)
        <div class="event-card reveal">
            <h3 class="event-name">{{ $ev->title }}</h3>
            <div class="event-row"><i class="fa-regular fa-calendar"></i>{{ $weddingDateFormatted }}</div>
            <div class="event-row"><i class="fa-regular fa-clock"></i>{{ date('H:i',strtotime($ep->time->start)) }}@if(!($ep->time->done??false)) &ndash; {{ date('H:i',strtotime($ep->time->end)) }}@endif {{ $weddingTz }}</div>
            @if(!empty($ep->location->address??''))<div class="event-row"><i class="fa-solid fa-location-dot"></i>{{ $ep->location->address }}</div>@endif
            @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" target="_blank" class="event-map"><i class="fa-solid fa-map"></i> Lihat Peta</a>@endif
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

@if($showCountdown)
<section class="countdown-section">
    <div class="sec-hd reveal"><p class="sec-tag" style="color:rgba(255,255,255,.5)">Menghitung Hari</p><h2 class="sec-title" style="color:var(--white)">Hari Bahagia Kami</h2><div class="sec-bar" style="background:rgba(255,255,255,.3)"></div></div>
    <div class="countdown-grid">
        <div class="cd-item"><span class="cd-num" id="cd-d">00</span><span class="cd-lbl">Hari</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-h">00</span><span class="cd-lbl">Jam</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-m">00</span><span class="cd-lbl">Menit</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-s">00</span><span class="cd-lbl">Detik</span></div>
    </div>
</section>
@endif

@if(count($other['story'] ?? []) > 0)
<section class="story-section">
    <div class="sec-hd reveal"><p class="sec-tag">Kisah Kami</p><h2 class="sec-title">Perjalanan Cinta</h2><div class="sec-bar"></div></div>
    <div class="story-line">
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

@if(count($galleryFiles) > 0)
<section class="gallery-section">
    <div class="sec-hd reveal"><p class="sec-tag">Galeri</p><h2 class="sec-title">{{ $galleryTitle }}</h2><div class="sec-bar"></div></div>
    <div class="gallery-grid">
        @foreach($galleryFiles as $i => $gf)
        <div class="g-item reveal @if($i===0) wide @endif"><img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy"></div>
        @endforeach
    </div>
</section>
@endif

@if($showGift && $giftCode)
<section class="gift-section">
    <div class="sec-hd reveal"><p class="sec-tag">Hadiah</p><h2 class="sec-title">{{ $giftTitle }}</h2><div class="sec-bar"></div></div>
    @if($giftContent)<p style="color:var(--gray);font-size:.88rem;margin-top:.5rem" class="reveal">{{ $giftContent }}</p>@endif
    <div class="gift-card reveal">
        <p class="gift-bank">{{ strtoupper($giftBank) }}</p>
        <p class="gift-num">{{ $giftCode }}</p>
        <p class="gift-name">a.n. {{ $giftName }}</p>
        <button class="btn-copy" onclick="navigator.clipboard.writeText('{{ $giftCode }}').then(()=>{this.textContent='Tersalin!';setTimeout(()=>this.textContent='Salin',2000)})">Salin</button>
    </div>
</section>
@endif

@php $__detailsShownGift = true; $__detailsShownStory = true; @endphp
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
