{{-- modern-elegant --}}

@include('template.partials.helpers')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Wedding of {{ $maleName }} & {{ $femaleName }} | Risa Digital Invitation</title>
<meta property="og:image" content="{{ $ogImage }}">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root{--color-primary:#2d7a4f;--color-light:#e8f5ee;--color-gold:#d4af37;--color-dark:#1d5a3f;--color-muted:#6b7280;--font-heading:'Playfair Display',serif;--section-bg:#fff;--card-bg:#f9f9f9;--rsvp-bg:#f0f9f4}
*{margin:0;padding:0;box-sizing:border-box}html{scroll-behavior:smooth}
body{font-family:'Poppins',sans-serif;color:var(--color-dark);overflow-x:hidden}
h1,h2,h3{font-family:var(--font-heading)}
/* Cover */
#cover{position:fixed;inset:0;z-index:9999;background:linear-gradient(135deg,var(--color-light),#f0f9f4);display:flex;align-items:center;justify-content:center;text-align:center;padding:2rem;transition:opacity .8s,visibility .8s}
#cover.gone{opacity:0;visibility:hidden;pointer-events:none}
.cover-inner{max-width:600px}
.cover-ornament{font-size:2.5rem;color:var(--color-gold);margin-bottom:1rem}
.cover-title{font-size:1rem;letter-spacing:4px;text-transform:uppercase;color:var(--color-muted);margin-bottom:.5rem}
.cover-names{font-size:clamp(2rem,7vw,3.5rem);color:var(--color-primary);line-height:1.1;margin-bottom:.5rem}
.cover-amp{color:var(--color-gold);font-style:italic;margin:0 .5rem}
.cover-date{font-size:.85rem;letter-spacing:3px;color:var(--color-muted);margin:1rem 0}
.cover-sub{font-size:.9rem;color:var(--color-muted);margin-bottom:1.5rem}
.cover-guest{font-size:.85rem;color:var(--color-muted);margin-bottom:.3rem}
.cover-guest strong{color:var(--color-dark);display:block;font-size:1rem}
.btn-open{display:inline-flex;align-items:center;gap:.5rem;padding:.85rem 2.5rem;background:var(--color-primary);color:#fff;border:none;border-radius:50px;font-size:.9rem;cursor:pointer;transition:all .3s;margin-top:.5rem}
.btn-open:hover{background:var(--color-gold);transform:translateY(-2px)}
/* Main */
#main{display:none}#main.on{display:block}
/* Hero */
.hero{min-height:100vh;background:linear-gradient(135deg,var(--color-light),#f0f9f4);display:flex;align-items:center;justify-content:center;text-align:center;padding:2rem;position:relative;overflow:hidden}
.hero::before{content:'';position:absolute;top:-50%;right:-50%;width:100%;height:100%;background:radial-gradient(circle,rgba(45,122,79,.1),transparent 70%);animation:float 20s infinite ease-in-out}
@keyframes float{0%,100%{transform:translate(0,0)}50%{transform:translate(-20px,20px)}}
.hero-content{position:relative;z-index:1;max-width:700px}
.hero h1{font-size:clamp(2rem,6vw,3.5rem);color:var(--color-primary);margin-bottom:.5rem}
.hero .couple-names{font-size:clamp(1.5rem,5vw,2.5rem);color:var(--color-dark);margin:1.5rem 0}
.hero .couple-names .amp{color:var(--color-gold);font-style:italic;margin:0 .5rem}
.hero .subtitle{font-size:1rem;color:var(--color-muted);margin-bottom:1.5rem}
.divider{width:80px;height:3px;background:var(--color-gold);margin:1.5rem auto}
/* Date */
.date-section{background:#fff;padding:4rem 2rem;text-align:center}
.date-box{display:inline-block;padding:2rem 3rem;background:linear-gradient(135deg,var(--color-primary),#3d9a6f);color:#fff;border-radius:20px;box-shadow:0 10px 30px rgba(45,122,79,.3)}
.date-box h2{font-size:2rem;margin-bottom:.5rem}
/* Couple */
.couple-section{padding:5rem 2rem;background:var(--color-light)}
.couple-grid{max-width:900px;margin:0 auto;display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:2rem}
.couple-card{text-align:center}
.couple-photo{width:180px;height:180px;border-radius:50%;object-fit:cover;border:4px solid var(--color-primary);box-shadow:0 8px 25px rgba(0,0,0,.1);margin:0 auto 1rem}
.couple-placeholder{width:180px;height:180px;border-radius:50%;background:var(--color-light);display:flex;align-items:center;justify-content:center;border:4px solid var(--color-primary);margin:0 auto 1rem;color:var(--color-primary);font-size:3rem}
.couple-frame{position:absolute;inset:-6px;border-radius:50%;pointer-events:none}
.couple-photo-wrap{position:relative;display:inline-block}
.couple-card h3{font-size:1.6rem;color:var(--color-primary);margin-bottom:.3rem}
.couple-card .role{font-size:.75rem;letter-spacing:2px;text-transform:uppercase;color:var(--color-gold);margin-bottom:.5rem}
.couple-card .parents{font-size:.85rem;color:var(--color-muted);line-height:1.7}
.couple-sep{display:flex;flex-direction:column;align-items:center;gap:.5rem;color:var(--color-gold)}
.couple-sep .heart{font-size:2rem}
.couple-sep .line{width:1px;height:50px;background:var(--color-gold)}
/* Events */
.events-section{padding:5rem 2rem;background:#fff}
.events-grid{max-width:1000px;margin:2rem auto 0;display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:2rem}
.event-card{background:var(--color-light);padding:2rem;border-radius:15px;border-top:4px solid var(--color-primary);transition:transform .3s}
.event-card:hover{transform:translateY(-8px)}
.event-card h3{color:var(--color-primary);font-size:1.5rem;margin-bottom:.8rem}
.event-row{display:flex;align-items:center;gap:.5rem;font-size:.85rem;color:var(--color-muted);margin-bottom:.4rem}
.event-row i{color:var(--color-primary);width:16px}
.event-map{display:inline-flex;align-items:center;gap:.4rem;margin-top:.8rem;padding:.5rem 1.2rem;background:var(--color-primary);color:#fff;border-radius:50px;font-size:.8rem;text-decoration:none;transition:background .3s}
.event-map:hover{background:var(--color-gold)}
/* Countdown */
.countdown-section{padding:4rem 2rem;background:var(--color-primary);color:#fff;text-align:center}
.countdown-grid{display:flex;justify-content:center;gap:1rem;flex-wrap:wrap;margin-top:2rem}
.cd-item{background:rgba(255,255,255,.15);padding:1.5rem 2rem;border-radius:12px;min-width:90px;text-align:center}
.cd-num{font-family:var(--font-heading);font-size:2.8rem;color:#fff;display:block;line-height:1}
.cd-lbl{font-size:.65rem;letter-spacing:2px;text-transform:uppercase;opacity:.7;margin-top:.2rem}
/* Story */
.story-section{padding:5rem 2rem;background:var(--color-light)}
.story-line{max-width:700px;margin:2rem auto 0;position:relative;padding-left:2rem}
.story-line::before{content:'';position:absolute;left:0;top:0;bottom:0;width:2px;background:linear-gradient(180deg,var(--color-primary),var(--color-gold),transparent)}
.story-item{position:relative;margin-bottom:2rem;padding-left:1.5rem}
.story-dot{position:absolute;left:-2.3rem;top:.3rem;width:18px;height:18px;border-radius:50%;background:#fff;border:2px solid var(--color-primary)}
.story-date{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--color-gold);margin-bottom:.2rem}
.story-title{font-size:1.1rem;color:var(--color-primary);margin-bottom:.3rem}
.story-desc{font-size:.85rem;color:var(--color-muted);line-height:1.7}
/* Gallery */
.gallery-section{padding:5rem 2rem;background:#fff}
.gallery-grid{max-width:1100px;margin:2rem auto 0;display:grid;grid-template-columns:repeat(3,1fr);gap:1rem}
.gallery-grid .g-item{overflow:hidden;aspect-ratio:1;border-radius:10px}
.gallery-grid .g-item.wide{grid-column:span 2;aspect-ratio:2/1}
.gallery-grid .g-item img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.gallery-grid .g-item:hover img{transform:scale(1.07)}
/* Gift */
.gift-section{padding:4rem 2rem;background:var(--color-light);text-align:center}
.gift-card{display:inline-block;max-width:380px;width:100%;background:#fff;padding:2rem;border-radius:12px;border-top:4px solid var(--color-gold);box-shadow:0 4px 20px rgba(0,0,0,.06);margin-top:1.5rem}
.gift-bank{font-size:.7rem;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-bottom:.4rem}
.gift-account{font-family:var(--font-heading);font-size:1.8rem;color:var(--color-primary);margin:.3rem 0}
.btn-copy{display:inline-flex;align-items:center;gap:.4rem;margin-top:.8rem;padding:.5rem 1.5rem;background:var(--color-primary);color:#fff;border:none;border-radius:50px;font-size:.8rem;cursor:pointer;transition:background .3s}
.btn-copy:hover{background:var(--color-gold)}
/* Footer */
.site-footer{background:var(--color-primary);color:rgba(255,255,255,.7);text-align:center;padding:3rem 2rem}
.footer-names{font-size:2.5rem;color:#fff;margin-bottom:.3rem}
.footer-brand{font-size:.65rem;letter-spacing:3px;text-transform:uppercase;color:var(--color-gold);margin-top:1rem}
/* Music */
.music-fab{position:fixed;bottom:1.5rem;right:1.5rem;z-index:200;width:46px;height:46px;border-radius:50%;background:var(--color-primary);color:#fff;border:2px solid var(--color-gold);display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;box-shadow:0 4px 15px rgba(0,0,0,.2);transition:all .3s}
.music-fab:hover{background:var(--color-gold)}
/* Reveal */
.reveal{opacity:0;transform:translateY(24px);transition:opacity .7s,transform .7s}
.reveal.in{opacity:1;transform:none}
/* Responsive */
@media(max-width:768px){.couple-grid{grid-template-columns:1fr;gap:1.5rem}.couple-sep{flex-direction:row;justify-content:center}.couple-sep .line{width:50px;height:1px}.gallery-grid{grid-template-columns:repeat(2,1fr)}.gallery-grid .g-item.wide{grid-column:span 2;aspect-ratio:1}}
@media(max-width:480px){.gallery-grid{grid-template-columns:1fr}.gallery-grid .g-item.wide{grid-column:span 1;aspect-ratio:1}}
</style>
</head>
<body>

{{-- Cover --}}
<div id="cover">
    @if($coverSrc)
    <img src="{{ $coverSrc }}" alt="cover" style="width:140px;height:140px;border-radius:50%;object-fit:cover;border:4px solid var(--color-gold);margin-bottom:1.2rem;box-shadow:0 0 0 6px rgba(212,175,55,.15)">
    @endif
    <div class="cover-inner">
        <div class="cover-ornament">❦</div>
        <p class="cover-title">The Wedding of</p>
        <h1 class="cover-names">{{ $femaleName }}<span class="cover-amp">&</span>{{ $maleName }}</h1>
        <p class="cover-date"><i class="fa-regular fa-calendar" style="margin-right:.4rem"></i>{{ $weddingDateFormatted }}</p>
        <p class="cover-sub">{{ $coverContent }}</p>
        @if($other['guest'])<p class="cover-guest">Kepada Yth.<strong>{{ $other['guest']['name'] ?? '' }}</strong></p>@endif
        <button class="btn-open" id="btnOpen"><i class="fa-solid fa-envelope-open-text"></i>{{ $coverButton }}</button>
    </div>
</div>

{{-- Main --}}
<div id="main">
@if($showMusic && $musicUrl)
<audio id="bgAudio" loop><source src="{{ $musicUrl }}" type="audio/mpeg"></audio>
<button class="music-fab" id="musicFab"><i class="fa-solid fa-music"></i></button>
@endif

{{-- Hero --}}
<section class="hero" id="hero">
    <div class="hero-content reveal">
        <div class="ornament" style="color:var(--color-gold);font-size:2rem;margin-bottom:.5rem">❦</div>
        <h1>The Wedding of</h1>
        <div class="couple-names"><span>{{ $femaleName }}</span><span class="amp">&</span><span>{{ $maleName }}</span></div>
        <div class="divider"></div>
        <p class="subtitle">{{ $coverContent }}</p>
        @if($quoteContent)<p style="font-style:italic;color:var(--color-muted);font-size:.9rem;max-width:500px;margin:0 auto">"{{ $quoteContent }}"</p>@endif
    </div>
</section>

{{-- Tanggal --}}
<section class="date-section">
    <div class="date-box reveal">
        <h2>Save The Date</h2>
        <p>{{ $weddingDateFormatted }}</p>
        <p style="font-size:.9rem;opacity:.8;margin-top:.3rem">{{ $weddingTime }} {{ $weddingTz }}</p>
    </div>
</section>

{{-- Pasangan --}}
<section class="couple-section" id="couple">
    <div style="text-align:center;margin-bottom:2rem" class="reveal">
        <h2 style="font-family:var(--font-heading);color:var(--color-primary)">Mempelai</h2>
        <div class="divider"></div>
    </div>
    <div class="couple-grid reveal">
        <div class="couple-card">
            <div class="couple-photo-wrap">
                @if($femaleSrc)
                <img src="{{ $femaleSrc }}" alt="{{ $femaleName }}" class="couple-photo">
                @if($femaleFrame)<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="" class="couple-frame" style="position:absolute;inset:-6px;border-radius:50%;pointer-events:none">@endif
                @else<div class="couple-placeholder"><i class="fa-solid fa-user"></i></div>@endif
            </div>
            <h3>{{ $femaleName }}</h3>
            <p class="role">Mempelai Wanita</p>
            @if($showParent)<p class="parents">Putri ke-{{ $femaleChildhood }} dari<br>Bapak {{ $femaleFather }} &amp; Ibu {{ $femaleMother }}</p>@endif
            @if($showIg && $femaleIg)<p style="margin-top:.5rem;font-size:.8rem;color:var(--color-muted)"><i class="fa-brands fa-instagram"></i> @{{ $femaleIg }}</p>@endif
        </div>
        <div class="couple-sep"><div class="line"></div><span class="heart">❤</span><div class="line"></div></div>
        <div class="couple-card">
            <div class="couple-photo-wrap">
                @if($maleSrc)
                <img src="{{ $maleSrc }}" alt="{{ $maleName }}" class="couple-photo">
                @if($maleFrame)<img src="{{ url('storage/frame/'.$maleFrame) }}" alt="" class="couple-frame" style="position:absolute;inset:-6px;border-radius:50%;pointer-events:none">@endif
                @else<div class="couple-placeholder"><i class="fa-solid fa-user"></i></div>@endif
            </div>
            <h3>{{ $maleName }}</h3>
            <p class="role">Mempelai Pria</p>
            @if($showParent)<p class="parents">Putra ke-{{ $maleChildhood }} dari<br>Bapak {{ $maleFather }} &amp; Ibu {{ $maleMother }}</p>@endif
            @if($showIg && $maleIg)<p style="margin-top:.5rem;font-size:.8rem;color:var(--color-muted)"><i class="fa-brands fa-instagram"></i> @{{ $maleIg }}</p>@endif
        </div>
    </div>
</section>

{{-- Acara --}}
@if(count($other['event'] ?? []) > 0)
<section class="events-section" id="events">
    <div style="text-align:center" class="reveal">
        <h2 style="font-family:var(--font-heading);color:var(--color-primary)">Rangkaian Acara</h2>
        <div class="divider"></div>
    </div>
    <div class="events-grid">
        @foreach($other['event'] as $ev)
        @php $ep = json_decode($ev->content); @endphp
        @if($ep)
        <div class="event-card reveal">
            <h3>{{ $ev->title }}</h3>
            <div class="event-row"><i class="fa-regular fa-clock"></i>{{ date('H:i',strtotime($ep->time->start)) }}@if(!($ep->time->done??false)) – {{ date('H:i',strtotime($ep->time->end)) }}@else – selesai@endif {{ $weddingTz }}</div>
            <div class="event-row"><i class="fa-regular fa-calendar"></i>{{ $weddingDateFormatted }}</div>
            @if(!empty($ep->location->address??''))<div class="event-row"><i class="fa-solid fa-location-dot"></i>{{ $ep->location->address }}</div>@endif
            @if(!empty($ep->location->map??''))<a href="{{ $ep->location->map }}" target="_blank" class="event-map"><i class="fa-solid fa-map"></i> Lihat Peta</a>@endif
        </div>
        @endif
        @endforeach
    </div>
</section>
@endif

{{-- Countdown --}}
@if($showCountdown)
<section class="countdown-section" id="countdown">
    <p style="font-size:.7rem;letter-spacing:4px;text-transform:uppercase;opacity:.7">Menghitung Hari</p>
    <h2 style="font-family:var(--font-heading);margin:.3rem 0">Hari Bahagia Kami</h2>
    <div class="countdown-grid">
        <div class="cd-item"><span class="cd-num" id="cd-d">00</span><span class="cd-lbl">Hari</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-h">00</span><span class="cd-lbl">Jam</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-m">00</span><span class="cd-lbl">Menit</span></div>
        <div class="cd-item"><span class="cd-num" id="cd-s">00</span><span class="cd-lbl">Detik</span></div>
    </div>
</section>
@endif

{{-- Kisah cinta --}}
@if(count($other['story'] ?? []) > 0)
<section class="story-section" id="story">
    <div style="text-align:center" class="reveal">
        <h2 style="font-family:var(--font-heading);color:var(--color-primary)">Kisah Cinta</h2>
        <div class="divider"></div>
    </div>
    <div class="story-line">
        @foreach($other['story'] as $st)
        <div class="story-item reveal">
            <div class="story-dot"></div>
            <p class="story-date">{{ \Carbon\Carbon::parse($st->created_at)->locale('id')->translatedFormat('d F Y') }}</p>
            <h4 class="story-title">{{ $st->title }}</h4>
            <p class="story-desc">{{ $st->content }}</p>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- Galeri --}}
<section class="gallery-section" id="gallery">
    <div style="text-align:center" class="reveal">
        <h2 style="font-family:var(--font-heading);color:var(--color-primary)">Galeri</h2>
        <div class="divider"></div>
    </div>
    @if(count($galleryFiles) > 0)
    <div class="gallery-grid">
        @foreach($galleryFiles as $i => $gf)
        <div class="g-item reveal @if($i===0) wide @endif">
            <img src="{{ url('storage/'.$gf) }}" alt="galeri {{ $i+1 }}" loading="lazy">
        </div>
        @endforeach
    </div>
    @else
    <p style="text-align:center;color:var(--color-muted);padding:2rem">Belum ada foto galeri.</p>
    @endif
</section>

{{-- Gift --}}
@if($showGift && $giftCode)
<section class="gift-section" id="gift">
    <h2 style="font-family:var(--font-heading);color:var(--color-primary)" class="reveal">{{ $giftTitle }}</h2>
    @if($giftContent)<p style="color:var(--color-muted);font-size:.9rem;margin-top:.5rem" class="reveal">{{ $giftContent }}</p>@endif
    <div class="gift-card reveal">
        <p class="gift-bank">{{ strtoupper($giftBank) }}</p>
        <p class="gift-account" id="giftNum">{{ $giftCode }}</p>
        <p style="font-size:.85rem;color:var(--color-muted)">a.n. {{ $giftName }}</p>
        <button class="btn-copy" onclick="navigator.clipboard.writeText('{{ $giftCode }}').then(()=>{this.textContent='✓ Tersalin!';setTimeout(()=>this.textContent='Salin Nomor',2000)})">Salin Nomor</button>
    </div>
</section>
@endif

@include('template.partials.rsvp-wishes')

{{-- Footer --}}
<footer class="site-footer">
    <h2 class="footer-names" style="font-family:var(--font-heading)">{{ $femaleName }} &amp; {{ $maleName }}</h2>
    @if($showClosing && $closingText)<p style="font-size:.85rem;margin-bottom:.5rem">{{ $closingText }}</p>@endif
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
// Countdown
(function(){
    var t=new Date('{{ $weddingDate }}T{{ $weddingTime }}:00');
    function run(){var diff=t-new Date();if(diff<=0)return;var pad=function(n){return String(Math.floor(n)).padStart(2,'0');};document.getElementById('cd-d').textContent=pad(diff/86400000);document.getElementById('cd-h').textContent=pad((diff%86400000)/3600000);document.getElementById('cd-m').textContent=pad((diff%3600000)/60000);document.getElementById('cd-s').textContent=pad((diff%60000)/1000);}
    run();setInterval(run,1000);
})();
// Reveal
var obs=new IntersectionObserver(function(e){e.forEach(function(x){if(x.isIntersecting){x.target.classList.add('in');obs.unobserve(x.target);}});},{threshold:.1});
document.querySelectorAll('.reveal').forEach(function(el){obs.observe(el);});
</script>
</body>
</html>
