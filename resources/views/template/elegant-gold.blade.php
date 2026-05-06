@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Wedding of {{ $femaleNickname }} &amp; {{ $maleNickname }} | Risa Digital Invitation</title>
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:title" content="Wedding of {{ $femaleNickname }} & {{ $maleNickname }}">
<meta name="theme-color" content="#d4af37">
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --gold:#d4af37;--gold-light:#f0d98a;--gold-pale:#fdf8e8;
  --dark:#1a1a1a;--dark2:#2c2c2c;--cream:#faf8f3;--white:#fff;--gray:#888;
  --color-primary:#d4af37;--color-muted:rgba(26,26,26,.6);
  --section-bg:#fff;--card-bg:#faf8f3;--rsvp-bg:#fdf8e8;
  --font-heading:'Playfair Display',serif;
}
html{scroll-behavior:smooth}
body{font-family:'Montserrat',sans-serif;background:var(--cream);color:var(--dark);overflow-x:hidden}
h1,h2,h3,h4{font-family:'Playfair Display',serif}
.script{font-family:'Great Vibes',cursive}
img{display:block;max-width:100%}
a{text-decoration:none;color:inherit}

/* COVER */
#cover{position:fixed;inset:0;z-index:9999;background:var(--dark);display:flex;align-items:center;justify-content:center;text-align:center;padding:2rem;transition:opacity .9s,visibility .9s}
#cover.gone{opacity:0;visibility:hidden;pointer-events:none}
.cover-border{position:absolute;inset:20px;border:1px solid rgba(212,175,55,.3);pointer-events:none}
.cover-border::before{content:'';position:absolute;inset:8px;border:1px solid rgba(212,175,55,.12)}
.cover-inner{position:relative;z-index:1;max-width:500px}
.cover-label{font-size:.6rem;letter-spacing:6px;text-transform:uppercase;color:rgba(212,175,55,.7);margin-bottom:1rem}
.cover-names{font-size:clamp(2.2rem,7vw,4rem);color:var(--white);line-height:1.05}
.cover-amp{color:var(--gold);display:block;font-style:italic;font-size:clamp(1.4rem,4.5vw,2.8rem);margin:.2rem 0}
.cover-rule{width:80px;height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent);margin:1.2rem auto}
.cover-date{font-size:.7rem;letter-spacing:4px;text-transform:uppercase;color:rgba(255,255,255,.5)}
.cover-guest{font-size:.8rem;color:rgba(255,255,255,.45);margin-top:.8rem}
.cover-guest strong{color:var(--gold-light);display:block;font-size:.9rem;margin-top:.2rem}
.btn-open{display:inline-flex;align-items:center;gap:.5rem;margin-top:1.8rem;padding:.75rem 2.2rem;border:1px solid rgba(212,175,55,.6);color:var(--gold);background:transparent;font-size:.7rem;letter-spacing:3px;text-transform:uppercase;cursor:pointer;transition:all .3s;font-family:'Montserrat',sans-serif}
.btn-open:hover{background:var(--gold);color:var(--dark)}

/* MAIN */
#main{display:none}#main.on{display:block}

/* HERO */
.hero{min-height:100vh;background:var(--dark);display:flex;align-items:center;justify-content:center;text-align:center;padding:4rem 2rem;position:relative;overflow:hidden}
.hero-glow{position:absolute;inset:0;background:radial-gradient(ellipse 60% 50% at 50% 40%,rgba(212,175,55,.07) 0%,transparent 70%);pointer-events:none}
.hero-inner{position:relative;z-index:1;max-width:680px}
.hero-eyebrow{font-size:.6rem;letter-spacing:6px;text-transform:uppercase;color:rgba(212,175,55,.6);margin-bottom:1.5rem}
.hero-names{font-size:clamp(2.8rem,9vw,6rem);color:var(--white);line-height:.95}
.hero-amp{color:var(--gold);display:block;font-style:italic;font-size:clamp(1.8rem,6vw,4rem);margin:.2rem 0}
.hero-rule{width:60px;height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent);margin:1.8rem auto}
.hero-date{font-size:.7rem;letter-spacing:4px;text-transform:uppercase;color:rgba(255,255,255,.4)}
.hero-quote{font-size:.95rem;font-style:italic;color:rgba(255,255,255,.35);margin-top:1.5rem;max-width:420px;margin-left:auto;margin-right:auto;line-height:1.7}

/* SECTION */
.section{padding:5.5rem 2rem}
.container{max-width:1100px;margin:0 auto}
.sec-head{text-align:center;margin-bottom:3rem}
.sec-eyebrow{font-size:.6rem;letter-spacing:5px;text-transform:uppercase;color:var(--gold);margin-bottom:.5rem}
.sec-title{font-size:clamp(1.8rem,4vw,2.8rem);color:var(--dark)}
.sec-rule{width:50px;height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent);margin:1rem auto 0}

/* COUPLE */
.couple-section{background:var(--cream)}
.couple-wrap{max-width:860px;margin:0 auto;display:grid;grid-template-columns:1fr 50px 1fr;align-items:center;gap:2rem}
.couple-card{text-align:center}
.couple-photo-outer{position:relative;display:inline-block;margin-bottom:1.5rem}
.couple-photo-outer::before{content:'';position:absolute;inset:-6px;border-radius:50%;border:1px solid rgba(212,175,55,.35);pointer-events:none}
.couple-photo{width:190px;height:190px;border-radius:50%;object-fit:cover;border:2px solid var(--gold-light)}
.couple-placeholder{width:190px;height:190px;border-radius:50%;background:var(--dark2);display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:3.5rem;border:2px solid var(--gold-light)}
.couple-frame-img{position:absolute;inset:-6px;border-radius:50%;pointer-events:none;width:calc(100% + 12px);height:calc(100% + 12px);top:-6px;left:-6px}
.couple-name{font-size:1.9rem;color:var(--dark);margin-bottom:.25rem}
.couple-role{font-size:.6rem;letter-spacing:4px;text-transform:uppercase;color:var(--gold);margin-bottom:.8rem}
.couple-parent{font-size:.82rem;color:var(--gray);line-height:1.9}
.couple-ig{font-size:.78rem;color:var(--gold);margin-top:.5rem}
.couple-sep{display:flex;flex-direction:column;align-items:center;gap:.5rem}
.sep-line{width:1px;height:55px;background:linear-gradient(180deg,transparent,var(--gold-light),transparent)}
.sep-diamond{width:8px;height:8px;background:var(--gold);transform:rotate(45deg);flex-shrink:0}

/* EVENTS */
.events-section{background:var(--white)}
.events-grid{max-width:900px;margin:0 auto;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem}
.event-card{padding:2.5rem 2rem;border:1px solid rgba(212,175,55,.25);text-align:center;position:relative;background:var(--cream);transition:box-shadow .3s}
.event-card:hover{box-shadow:0 8px 35px rgba(212,175,55,.12)}
.event-card::before{content:'';position:absolute;inset:7px;border:1px solid rgba(212,175,55,.12);pointer-events:none}
.event-icon{font-size:1.4rem;color:var(--gold);margin-bottom:1rem;opacity:.8}
.event-name{font-size:1.5rem;color:var(--dark);margin-bottom:.8rem}
.event-time{font-size:.72rem;color:var(--gold);letter-spacing:.15em;margin-bottom:.4rem}
.event-loc{font-size:.82rem;color:var(--gray);line-height:1.7;margin-top:.5rem}
.event-map{display:inline-flex;align-items:center;gap:.4rem;margin-top:1.2rem;font-size:.68rem;letter-spacing:.2em;text-transform:uppercase;color:var(--gold);border-bottom:1px solid rgba(212,175,55,.3);padding-bottom:2px;transition:color .3s}
.event-map:hover{color:var(--dark)}

/* COUNTDOWN */
.countdown-section{background:var(--dark2);text-align:center;padding:5rem 2rem;position:relative}
.countdown-section::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent)}
.countdown-section::after{content:'';position:absolute;bottom:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent)}
.countdown-grid{display:flex;justify-content:center;gap:0;flex-wrap:wrap;margin-top:2.5rem}
.cd-item{min-width:100px;text-align:center;padding:1.5rem 1rem;border-right:1px solid rgba(212,175,55,.12)}
.cd-item:last-child{border-right:none}
.cd-num{font-family:'Playfair Display',serif;font-size:3.8rem;color:var(--gold);line-height:1;display:block;font-weight:300}
.cd-lbl{font-size:.55rem;letter-spacing:.4em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-top:.4rem}

/* GALLERY */
.gallery-section{background:var(--cream)}
.gallery-grid{max-width:1100px;margin:2rem auto 0;display:grid;grid-template-columns:repeat(3,1fr);gap:4px}
.g-item{overflow:hidden;aspect-ratio:1;position:relative}
.g-item.wide{grid-column:span 2;aspect-ratio:2/1}
.g-item img{width:100%;height:100%;object-fit:cover;transition:transform .7s;display:block}
.g-item:hover img{transform:scale(1.06)}

/* GIFT */
.gift-section{background:var(--white);text-align:center}
.gift-card{display:inline-block;max-width:380px;width:100%;padding:2.8rem 2.5rem;border:1px solid rgba(212,175,55,.25);margin-top:2rem;position:relative;background:var(--cream)}
.gift-card::before{content:'';position:absolute;inset:7px;border:1px solid rgba(212,175,55,.12);pointer-events:none}
.gift-bank{font-size:.6rem;letter-spacing:.45em;text-transform:uppercase;color:var(--gold);margin-bottom:.6rem}
.gift-num{font-family:'Playfair Display',serif;font-size:2.1rem;color:var(--dark);margin:.3rem 0;letter-spacing:.05em}
.gift-name{font-size:.8rem;color:var(--gray)}
.btn-copy{display:inline-flex;align-items:center;gap:.5rem;margin-top:1.2rem;padding:.65rem 1.8rem;border:1px solid rgba(212,175,55,.5);color:var(--gold);background:transparent;font-family:'Montserrat',sans-serif;font-size:.65rem;font-weight:500;letter-spacing:.3em;text-transform:uppercase;cursor:pointer;transition:all .3s}
.btn-copy:hover{background:var(--gold);color:var(--dark);border-color:var(--gold)}

/* MUSIC */
.music-fab{position:fixed;bottom:2rem;right:2rem;z-index:200;width:46px;height:46px;border-radius:50%;background:var(--dark2);color:var(--gold);border:1px solid rgba(212,175,55,.5);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;box-shadow:0 4px 20px rgba(0,0,0,.4);transition:all .3s}
.music-fab:hover{background:var(--gold);color:var(--dark)}

/* FOOTER */
.site-footer{background:var(--dark);color:rgba(255,255,255,.35);text-align:center;padding:5rem 2rem;position:relative}
.site-footer::before{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,var(--gold),transparent)}
.footer-names{font-size:clamp(2.5rem,7vw,4rem);color:var(--white);margin-bottom:.5rem;font-weight:300}
.footer-closing{font-size:.85rem;color:rgba(255,255,255,.4);margin-top:.5rem;font-style:italic}
.footer-brand{font-size:.55rem;letter-spacing:.5em;text-transform:uppercase;color:rgba(212,175,55,.5);margin-top:2rem}

/* REVEAL */
.reveal{opacity:0;transform:translateY(22px);transition:opacity .75s ease,transform .75s ease}
.reveal.in{opacity:1;transform:none}

{{ '@' }}media(max-width:768px){
  .couple-wrap{grid-template-columns:1fr;gap:2.5rem}
  .couple-sep{flex-direction:row;justify-content:center}
  .sep-line{width:50px;height:1px;background:linear-gradient(90deg,transparent,var(--gold-light),transparent)}
  .gallery-grid{grid-template-columns:repeat(2,1fr)}
  .g-item.wide{grid-column:span 2;aspect-ratio:1}
  .countdown-grid{gap:0}
  .cd-item{min-width:80px;padding:1.2rem .6rem}
  .cd-num{font-size:3rem}
}
{{ '@' }}media(max-width:480px){
  .gallery-grid{grid-template-columns:1fr}
  .g-item.wide{grid-column:span 1;aspect-ratio:1}
}
</style>
</head>
<body>

{{-- COVER --}}
<div id="cover">
  <div class="cover-border"></div>
  <div class="cover-inner">
    @if($coverSrc)
    <img src="{{ $coverSrc }}" alt="cover" style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:2px solid var(--gold);margin:0 auto 1.5rem">
    @endif
    <p class="cover-label">The Wedding of</p>
    <h1 class="cover-names script">
      {{ $femaleNickname }}<span class="cover-amp">&amp;</span>{{ $maleNickname }}
    </h1>
    <div class="cover-rule"></div>
    <p class="cover-date">{{ $weddingDateShort }}</p>
    @if($other['guest'])
    <div class="cover-guest">Kepada Yth.<strong>{{ $other['guest']['name'] ?? '' }}</strong></div>
    @endif
    <button class="btn-open" id="btnOpen">
      <i class="fa-regular fa-envelope"></i> {{ $coverButton }}
    </button>
  </div>
</div>

{{-- MAIN --}}
<div id="main">
@if($showMusic && $musicUrl)
<audio id="bgAudio" loop><source src="{{ $musicUrl }}" type="audio/mpeg"></audio>
<button class="music-fab" id="musicFab"><i class="fa-solid fa-music"></i></button>
@endif

{{-- HERO --}}
<section class="hero">
  <div class="hero-glow"></div>
  <div class="hero-inner reveal">
    <p class="hero-eyebrow">The Wedding of</p>
    <h1 class="hero-names script">
      {{ $femaleNickname }}<span class="hero-amp">&amp;</span>{{ $maleNickname }}
    </h1>
    <div class="hero-rule"></div>
    <p class="hero-date">{{ $weddingDateFormatted }}</p>
    @if($quoteContent)<p class="hero-quote">&ldquo;{{ $quoteContent }}&rdquo;</p>@endif
  </div>
</section>

{{-- COUPLE --}}
<section class="section couple-section">
  <div class="container">
    <div class="sec-head reveal">
      <p class="sec-eyebrow">Mempelai</p>
      <h2 class="sec-title">Dua Hati Menjadi Satu</h2>
      <div class="sec-rule"></div>
    </div>
    <div class="couple-wrap reveal">
      <div class="couple-card">
        <div class="couple-photo-outer">
          @if($femaleSrc)<img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo">
          @if($femaleFrame)<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame-img">@endif
          @else<div class="couple-placeholder">{{ $femaleInitial }}</div>@endif
        </div>
        <h3 class="couple-name">{{ $femaleName }}</h3>
        <p class="couple-role">Mempelai Wanita</p>
        @if($showParent)<p class="couple-parent">Putri ke-{{ $femaleChildhood }} dari<br>Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}</p>@endif
        @if($showIg && $femaleIg)<p class="couple-ig"><i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}</p>@endif
      </div>
      <div class="couple-sep"><div class="sep-line"></div><div class="sep-diamond"></div><div class="sep-line"></div></div>
      <div class="couple-card">
        <div class="couple-photo-outer">
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
  </div>
</section>

{{-- EVENTS --}}
@if(count($other['event'] ?? []) > 0)
<section class="section events-section">
  <div class="container">
    <div class="sec-head reveal">
      <p class="sec-eyebrow">Acara</p>
      <h2 class="sec-title">Rangkaian Acara</h2>
      <div class="sec-rule"></div>
    </div>
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
        @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" target="_blank" class="event-map"><i class="fa-solid fa-location-dot"></i> Lihat Peta</a>@endif
      </div>
      @endif
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- COUNTDOWN --}}
@if($showCountdown)
<section class="countdown-section">
  <div class="container">
    <div class="sec-head reveal">
      <p class="sec-eyebrow" style="color:rgba(212,175,55,.55)">Menghitung Hari</p>
      <h2 class="sec-title" style="color:var(--white)">Hari Bahagia Kami</h2>
      <div class="sec-rule"></div>
    </div>
    <div class="countdown-grid">
      <div class="cd-item"><span class="cd-num" id="cd-d">00</span><span class="cd-lbl">Hari</span></div>
      <div class="cd-item"><span class="cd-num" id="cd-h">00</span><span class="cd-lbl">Jam</span></div>
      <div class="cd-item"><span class="cd-num" id="cd-m">00</span><span class="cd-lbl">Menit</span></div>
      <div class="cd-item"><span class="cd-num" id="cd-s">00</span><span class="cd-lbl">Detik</span></div>
    </div>
  </div>
</section>
@endif

{{-- GALLERY --}}
@if(count($galleryFiles) > 0)
<section class="section gallery-section">
  <div class="container">
    <div class="sec-head reveal">
      <p class="sec-eyebrow">Galeri</p>
      <h2 class="sec-title">{{ $galleryTitle }}</h2>
      <div class="sec-rule"></div>
    </div>
  </div>
  <div class="gallery-grid">
    @foreach($galleryFiles as $i => $gf)
    <div class="g-item reveal @if($i===0) wide @endif">
      <img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy">
    </div>
    @endforeach
  </div>
</section>
@endif

{{-- GIFT --}}
@if($showGift && $giftCode)
<section class="section gift-section">
  <div class="container">
    <div class="sec-head reveal">
      <p class="sec-eyebrow">Amplop Digital</p>
      <h2 class="sec-title">{{ $giftTitle }}</h2>
      <div class="sec-rule"></div>
    </div>
    @if($giftContent)<p style="color:var(--gray);font-size:.85rem;max-width:400px;margin:0 auto" class="reveal">{{ $giftContent }}</p>@endif
    <div class="gift-card reveal">
      <p class="gift-bank">{{ strtoupper($giftBank) }}</p>
      <p class="gift-num">{{ $giftCode }}</p>
      <p class="gift-name">a.n. {{ $giftName }}</p>
      <button class="btn-copy" onclick="navigator.clipboard.writeText('{{ $giftCode }}').then(()=>{this.innerHTML='<i class=\'fa-solid fa-check\'></i> Tersalin';setTimeout(()=>this.innerHTML='<i class=\'fa-regular fa-copy\'></i> Salin',2200)})">
        <i class="fa-regular fa-copy"></i> Salin
      </button>
    </div>
  </div>
</section>
@endif

@php $__detailsShownGift = true; @endphp
@include('template.partials.details')

@include('template.partials.rsvp-wishes')

<footer class="site-footer">
  <div style="margin-bottom:2rem;color:rgba(212,175,55,.3);font-size:.8rem;letter-spacing:3px">&#x2666;</div>
  <h2 class="footer-names script">{{ $femaleNickname }} &amp; {{ $maleNickname }}</h2>
  @if($showClosing && $closingText)<p class="footer-closing">{{ $closingText }}</p>@endif
  <p class="footer-brand">Risa Digital Invitation</p>
</footer>
</div>

<script>
document.getElementById('btnOpen').addEventListener('click',function(){
  document.getElementById('cover').classList.add('gone');
  document.getElementById('main').classList.add('on');
  @if($showMusic && $musicUrl)setTimeout(()=>document.getElementById('bgAudio')?.play().catch(()=>{}),700);@endif
});
@if($showMusic && $musicUrl)
(function(){var a=document.getElementById('bgAudio'),f=document.getElementById('musicFab');f.addEventListener('click',function(){if(a.paused){a.play();f.innerHTML='<i class="fa-solid fa-pause"></i>';}else{a.pause();f.innerHTML='<i class="fa-solid fa-music"></i>';}});})();
@endif
(function(){var t=new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');function pad(n){return String(Math.floor(n)).padStart(2,'0');}function tick(){var d=t-new Date();if(d<=0)return;document.getElementById('cd-d').textContent=pad(d/86400000);document.getElementById('cd-h').textContent=pad((d%86400000)/3600000);document.getElementById('cd-m').textContent=pad((d%3600000)/60000);document.getElementById('cd-s').textContent=pad((d%60000)/1000);}tick();setInterval(tick,1000);})();
(function(){var o=new IntersectionObserver(function(e){e.forEach(function(x){if(x.isIntersecting){x.target.classList.add('in');o.unobserve(x.target);}});},{threshold:.1});document.querySelectorAll('.reveal').forEach(function(el){o.observe(el);});})();
</script>
</body>
</html>
