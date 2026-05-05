<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Risa Digital Invitation - Undangan Digital Elegant</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --green:#2d7a4f;--green-dark:#1d5a3f;--green-light:#e8f5ee;
  --gold:#d4af37;--white:#fff;--text:#1d5a3f;
}
html{scroll-behavior:smooth}
body{font-family:'Inter',sans-serif;color:var(--text);overflow-x:hidden}
h1,h2,h3{font-family:'Playfair Display',serif}
img{display:block;max-width:100%}
a{text-decoration:none}

/* ── NAVBAR ── */
.navbar{
  position:fixed;top:0;left:0;width:100%;z-index:9999;
  padding:1rem 1.5rem;
  display:flex;align-items:center;justify-content:space-between;
  transition:background .3s,box-shadow .3s,padding .3s;
}
.navbar.scrolled{
  background:var(--white);
  box-shadow:0 2px 20px rgba(0,0,0,.1);
  padding:.75rem 1.5rem;
}
.nav-brand{
  font-family:'Playfair Display',serif;
  font-size:1.25rem;font-weight:700;
  color:var(--white);transition:color .3s;
  white-space:nowrap;
}
.navbar.scrolled .nav-brand{color:var(--green)}
.nav-links{display:flex;align-items:center;gap:1.5rem}
.nav-links a{color:var(--white);font-weight:500;font-size:.9rem;transition:color .3s}
.navbar.scrolled .nav-links a{color:var(--text)}
.nav-links a:hover{color:var(--gold)}
.nav-btn{
  padding:.5rem 1.4rem;border-radius:50px;
  background:var(--white);color:var(--green)!important;
  font-weight:600;font-size:.85rem;transition:all .3s;
}
.navbar.scrolled .nav-btn{background:var(--green);color:var(--white)!important}
.nav-btn:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(0,0,0,.15)}

/* Hamburger */
.nav-toggle{
  display:none;flex-direction:column;justify-content:center;
  gap:5px;cursor:pointer;padding:4px;background:none;border:none;
}
.nav-toggle span{
  display:block;width:24px;height:2px;
  background:var(--white);border-radius:2px;transition:all .3s;
}
.navbar.scrolled .nav-toggle span{background:var(--green)}
.nav-toggle.open span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.nav-toggle.open span:nth-child(2){opacity:0;transform:scaleX(0)}
.nav-toggle.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}

/* Mobile overlay menu */
.nav-mobile{
  display:none;position:fixed;inset:0;
  background:var(--green-dark);z-index:9998;
  flex-direction:column;align-items:center;justify-content:center;
  gap:2rem;padding:2rem;
}
.nav-mobile.open{display:flex}
.nav-mobile a{
  color:var(--white);font-size:1.4rem;font-weight:600;
  font-family:'Playfair Display',serif;transition:color .3s;
}
.nav-mobile a:hover{color:var(--gold)}
.nav-mobile .nav-btn-mobile{
  padding:.8rem 2.5rem;border-radius:50px;
  background:var(--white);color:var(--green)!important;
  font-size:1rem;font-weight:700;
}

/* ── HERO ── */
.hero{
  min-height:100vh;
  background:linear-gradient(135deg,var(--green) 0%,var(--green-dark) 100%);
  display:flex;align-items:center;justify-content:center;
  text-align:center;padding:6rem 1.5rem 3rem;
  position:relative;overflow:hidden;
}
.hero::before,.hero::after{
  content:'';position:absolute;border-radius:50%;
  background:radial-gradient(circle,rgba(255,255,255,.1) 0%,transparent 70%);
  animation:float 20s infinite ease-in-out;
}
.hero::before{width:500px;height:500px;top:-100px;right:-100px}
.hero::after{width:400px;height:400px;bottom:-50px;left:-50px;animation-duration:25s;animation-direction:reverse}
@keyframes float{0%,100%{transform:translate(0,0)}50%{transform:translate(30px,-30px)}}
.hero-content{position:relative;z-index:1;max-width:700px;animation:fadeInUp 1.2s ease}
@keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}
.hero-logo{font-size:clamp(1.9rem,5vw,3.2rem);font-weight:700;color:var(--white);margin-bottom:.8rem;line-height:1.2}
.hero-tagline{font-size:clamp(.95rem,2.5vw,1.3rem);color:rgba(255,255,255,.9);margin-bottom:2.5rem;line-height:1.6}
.cta-buttons{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.btn{padding:.85rem 2rem;border-radius:50px;font-weight:600;font-size:.9rem;transition:all .3s;display:inline-block}
.btn-white{background:var(--white);color:var(--green)}
.btn-white:hover{transform:translateY(-3px);box-shadow:0 10px 25px rgba(255,255,255,.3)}
.btn-outline-white{border:2px solid var(--white);color:var(--white)}
.btn-outline-white:hover{background:var(--white);color:var(--green)}
.btn-green{background:var(--green);color:var(--white)}
.btn-green:hover{background:var(--green-dark);transform:translateY(-2px)}

/* ── SECTIONS ── */
.section{padding:5rem 1.5rem}
.container{max-width:1200px;margin:0 auto}
.section-head{text-align:center;margin-bottom:3rem}
.section-head h2{font-size:clamp(1.7rem,4vw,2.6rem);color:var(--green);margin-bottom:.5rem}
.section-head p{font-size:.95rem;color:#666;max-width:580px;margin:0 auto}

/* ── FEATURES ── */
.features{background:var(--green-light)}
.features-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.5rem}
.feature-card{background:var(--white);padding:2rem;border-radius:16px;text-align:center;box-shadow:0 4px 20px rgba(45,122,79,.08);transition:transform .3s}
.feature-card:hover{transform:translateY(-6px)}
.feature-icon{font-size:2.5rem;margin-bottom:1rem}
.feature-card h3{font-size:1.2rem;color:var(--green);margin-bottom:.5rem}
.feature-card p{color:#666;font-size:.88rem;line-height:1.6}

/* ── TEMPLATES ── */
.templates{background:var(--white)}
.templates-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem}
.template-card{border-radius:14px;overflow:hidden;box-shadow:0 6px 25px rgba(0,0,0,.09);transition:transform .3s,box-shadow .3s;background:var(--white)}
.template-card:hover{transform:translateY(-6px);box-shadow:0 16px 40px rgba(45,122,79,.18)}
.template-image{width:100%;height:220px;overflow:hidden;position:relative}
.template-image img{width:100%;height:100%;object-fit:cover;transition:transform .5s}
.template-card:hover .template-image img{transform:scale(1.07)}
.template-placeholder{width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;color:var(--white);font-size:.85rem;letter-spacing:1px;text-transform:uppercase;gap:.5rem}
.template-badge{position:absolute;top:10px;right:10px;background:var(--gold);color:var(--white);font-size:.65rem;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:.25rem .7rem;border-radius:50px}
.template-info{padding:1.2rem 1.5rem;border-top:3px solid var(--green-light)}
.template-info h4{font-size:1.1rem;color:var(--green);margin-bottom:.2rem}
.template-grade{font-size:.7rem;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:.8rem}
.btn-preview{display:inline-flex;align-items:center;gap:.3rem;padding:.45rem 1.2rem;border:2px solid var(--green);color:var(--green);border-radius:50px;font-size:.78rem;font-weight:600;transition:all .3s}
.btn-preview:hover{background:var(--green);color:var(--white)}

/* ── PRICING ── */
.pricing{background:var(--green-light)}
.pricing-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;align-items:start}
.pricing-card{background:var(--white);padding:2.5rem 2rem;border-radius:16px;text-align:center;box-shadow:0 4px 20px rgba(45,122,79,.1);transition:transform .3s}
.pricing-card:hover{transform:translateY(-6px)}
.pricing-card.featured{border:3px solid var(--gold);position:relative}
.pricing-card.featured::before{content:'Terpopuler';position:absolute;top:-14px;left:50%;transform:translateX(-50%);background:var(--gold);color:var(--white);font-size:.7rem;font-weight:700;letter-spacing:1px;padding:.3rem 1rem;border-radius:50px;text-transform:uppercase}
.pricing-card h3{font-size:1.6rem;color:var(--green);margin-bottom:.5rem}
.price{font-size:2.5rem;font-weight:700;color:var(--green);margin:1rem 0}
.price-features{list-style:none;margin:1.5rem 0;text-align:left}
.price-features li{padding:.6rem 0;border-bottom:1px solid #eee;font-size:.88rem;color:#555}
.price-features li::before{content:'✓ ';color:var(--green);font-weight:700}

/* ── TESTIMONIALS ── */
.testimonials{background:var(--white)}
.testimonials-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem}
.testimonial-card{background:var(--green-light);padding:2rem;border-radius:14px;box-shadow:0 4px 15px rgba(45,122,79,.08)}
.testimonial-text{font-style:italic;color:#444;line-height:1.7;margin-bottom:1rem;font-size:.93rem}
.testimonial-author{font-weight:600;color:var(--green);font-size:.88rem}

/* ── CTA ── */
.cta-section{padding:5rem 1.5rem;background:linear-gradient(135deg,var(--green) 0%,var(--green-dark) 100%);text-align:center;color:var(--white)}
.cta-section h2{font-size:clamp(1.7rem,4vw,2.6rem);margin-bottom:1rem}
.cta-section p{font-size:.95rem;opacity:.9;margin-bottom:2rem;max-width:500px;margin-left:auto;margin-right:auto}

/* ── FOOTER ── */
footer{background:var(--green-dark);color:rgba(255,255,255,.8);padding:3rem 1.5rem;text-align:center}
.footer-links{display:flex;justify-content:center;gap:1.5rem;margin-bottom:1.5rem;flex-wrap:wrap}
.footer-links a{color:rgba(255,255,255,.7);font-size:.88rem;transition:color .3s}
.footer-links a:hover{color:var(--gold)}
footer p{font-size:.82rem;opacity:.6}

/* ── RESPONSIVE ── */
@media(max-width:768px){
  .nav-links{display:none}
  .nav-toggle{display:flex}

  .hero{padding:5rem 1.2rem 3rem}
  .cta-buttons{flex-direction:column;align-items:center}
  .cta-buttons .btn{width:100%;max-width:280px;text-align:center}

  .section{padding:3.5rem 1.2rem}
  .section-head{margin-bottom:2rem}

  .features-grid{grid-template-columns:1fr 1fr}
  .feature-card{padding:1.5rem 1rem}
  .feature-icon{font-size:2rem}

  .templates-grid{grid-template-columns:1fr}
  .template-image{height:200px}

  .pricing-grid{grid-template-columns:1fr}
  .pricing-card.featured{transform:none}

  .testimonials-grid{grid-template-columns:1fr}

  .footer-links{gap:1rem}
}
@media(max-width:480px){
  .features-grid{grid-template-columns:1fr}
  .hero-logo{font-size:1.7rem}
  .nav-brand{font-size:1.1rem}
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="mainNav">
  <a href="{{ url('/') }}" class="nav-brand">&#128154; Risa Digital Invitation</a>

  <div class="nav-links">
    <a href="#templates">Template</a>
    <a href="#pricing">Harga</a>
    @if(Route::has('login'))
      @auth
        <a href="{{ url('/dashboard') }}" class="nav-btn">Dashboard</a>
      @else
        <a href="{{ route('login') }}">Masuk</a>
        @if(Route::has('register'))
          <a href="{{ route('register') }}" class="nav-btn">Daftar</a>
        @endif
      @endauth
    @endif
  </div>

  <button class="nav-toggle" id="navToggle" aria-label="Buka menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- MOBILE MENU -->
<div class="nav-mobile" id="navMobile">
  <a href="#templates" class="nav-mobile-link">Template</a>
  <a href="#pricing" class="nav-mobile-link">Harga</a>
  @if(Route::has('login'))
    @auth
      <a href="{{ url('/dashboard') }}" class="nav-btn-mobile">Dashboard</a>
    @else
      <a href="{{ route('login') }}" class="nav-mobile-link">Masuk</a>
      @if(Route::has('register'))
        <a href="{{ route('register') }}" class="nav-btn-mobile">Daftar Gratis</a>
      @endif
    @endauth
  @endif
</div>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <h1 class="hero-logo">&#128154; Risa Digital Invitation</h1>
    <p class="hero-tagline">Undangan Digital Elegant untuk Momen Spesial Anda</p>
    <div class="cta-buttons">
      <a href="{{ route('register') }}" class="btn btn-white">Mulai Sekarang</a>
      <a href="#templates" class="btn btn-outline-white">Lihat Template</a>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="section features">
  <div class="container">
    <div class="section-head">
      <h2>Kenapa Memilih Kami?</h2>
      <p>Fitur lengkap untuk undangan digital yang sempurna</p>
    </div>
    <div class="features-grid">
      <div class="feature-card"><div class="feature-icon">&#127912;</div><h3>Template Kekinian</h3><p>Pilihan template modern dan elegant yang dapat disesuaikan dengan tema acara Anda</p></div>
      <div class="feature-card"><div class="feature-icon">&#128241;</div><h3>Responsive Design</h3><p>Tampil sempurna di semua perangkat, dari smartphone hingga desktop</p></div>
      <div class="feature-card"><div class="feature-icon">&#9889;</div><h3>Loading Cepat</h3><p>Optimasi performa untuk pengalaman pengguna yang maksimal</p></div>
      <div class="feature-card"><div class="feature-icon">&#128248;</div><h3>Gallery Unlimited</h3><p>Upload foto sebanyak yang Anda inginkan tanpa batasan</p></div>
      <div class="feature-card"><div class="feature-icon">&#9993;</div><h3>RSVP System</h3><p>Kelola konfirmasi kehadiran tamu dengan mudah dan praktis</p></div>
      <div class="feature-card"><div class="feature-icon">&#127873;</div><h3>Gift Registry</h3><p>Informasi hadiah dan rekening untuk kemudahan tamu</p></div>
    </div>
  </div>
</section>

<!-- TEMPLATES -->
<section id="templates" class="section templates">
  <div class="container">
    <div class="section-head">
      <h2>Template Pilihan</h2>
      <p>Desain modern dan elegant untuk berbagai jenis acara</p>
    </div>
    <div class="templates-grid">
      @foreach($data['templates'] as $item)
      <div class="template-card">
        <div class="template-image">
          @if($item->file && \Illuminate\Support\Str::startsWith($item->file, 'template/'))
            <img src="{{ asset($item->file) }}" alt="{{ $item->title }}" loading="lazy">
          @elseif($item->file)
            <img src="{{ url('storage/'.$item->file) }}" alt="{{ $item->title }}" loading="lazy">
          @else
            @php
              static $gi=0;
              $grads=['linear-gradient(135deg,#2d7a4f,#3d9a6f)','linear-gradient(135deg,#8b7355,#5d4e37)','linear-gradient(135deg,#8ba888,#4a6741)','linear-gradient(135deg,#00a86b,#0077be)','linear-gradient(135deg,#2c2c2c,#555)','linear-gradient(135deg,#9caf88,#2d5016)'];
              $grad=$grads[$gi%count($grads)];$gi++;
            @endphp
            <div class="template-placeholder" style="background:{{ $grad }}">
              <span style="font-size:2rem">&#128141;</span>
              <span>{{ $item->title }}</span>
            </div>
          @endif
          <span class="template-badge">{{ ucfirst($item->grade ?? 'free') }}</span>
        </div>
        <div class="template-info">
          <h4>{{ $item->title }}</h4>
          <p class="template-grade">{{ ucfirst($item->grade ?? 'free') }}</p>
          <a href="{{ route('preview-template.index', $item->slug) }}" class="btn-preview">&#128065; Preview</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- PRICING -->
<section id="pricing" class="section pricing">
  <div class="container">
    <div class="section-head">
      <h2>Paket Harga</h2>
      <p>Pilih paket yang sesuai dengan kebutuhan Anda</p>
    </div>
    <div class="pricing-grid">
      <div class="pricing-card">
        <h3>Basic</h3><div class="price">Rp 150K</div>
        <ul class="price-features">
          <li>1 Template Pilihan</li><li>Gallery 20 Foto</li>
          <li>RSVP System</li><li>Aktif 30 Hari</li><li>Support Email</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-green">Pilih Paket</a>
      </div>
      <div class="pricing-card featured">
        <h3>Premium</h3><div class="price">Rp 250K</div>
        <ul class="price-features">
          <li>Semua Template</li><li>Gallery Unlimited</li>
          <li>RSVP + Guest Management</li><li>Aktif 60 Hari</li>
          <li>Custom Domain</li><li>Priority Support</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-green">Pilih Paket</a>
      </div>
      <div class="pricing-card">
        <h3>Enterprise</h3><div class="price">Rp 500K</div>
        <ul class="price-features">
          <li>Semua Fitur Premium</li><li>Custom Design</li>
          <li>Video Background</li><li>Aktif 90 Hari</li>
          <li>Dedicated Support</li><li>Free Revisi</li>
        </ul>
        <a href="{{ route('register') }}" class="btn btn-green">Pilih Paket</a>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="section testimonials">
  <div class="container">
    <div class="section-head">
      <h2>Testimoni</h2>
      <p>Apa kata mereka yang sudah menggunakan layanan kami</p>
    </div>
    <div class="testimonials-grid">
      <div class="testimonial-card"><p class="testimonial-text">"Undangan digitalnya sangat elegant dan mudah digunakan. Tamu-tamu kami sangat terkesan!"</p><p class="testimonial-author">- Sarah &amp; Ahmad</p></div>
      <div class="testimonial-card"><p class="testimonial-text">"Template yang disediakan sangat modern dan sesuai dengan tema pernikahan kami. Highly recommended!"</p><p class="testimonial-author">- Dina &amp; Rizky</p></div>
      <div class="testimonial-card"><p class="testimonial-text">"Pelayanan yang cepat dan responsif. Undangan jadi dalam waktu singkat dengan hasil yang memuaskan."</p><p class="testimonial-author">- Maya &amp; Budi</p></div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="container">
    <h2>Siap Membuat Undangan Digital Anda?</h2>
    <p>Mulai sekarang dan buat undangan yang berkesan untuk momen spesial Anda</p>
    <a href="{{ route('register') }}" class="btn btn-white">Daftar Gratis</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="footer-content">
    <div class="footer-links">
      <a href="#">Tentang Kami</a>
      <a href="#templates">Template</a>
      <a href="#pricing">Harga</a>
      <a href="#">Kontak</a>
      <a href="#">FAQ</a>
    </div>
    <p>&copy; {{ date('Y') }} Risa Digital Invitation. All Rights Reserved.</p>
    <p style="margin-top:.5rem">Made with &#128154; in Indonesia</p>
  </div>
</footer>

<script>
// Navbar scroll effect
var nav = document.getElementById('mainNav');
window.addEventListener('scroll', function(){
  nav.classList.toggle('scrolled', window.scrollY > 50);
});

// Hamburger toggle
var toggle = document.getElementById('navToggle');
var mobile = document.getElementById('navMobile');
function closeMenu(){
  toggle.classList.remove('open');
  mobile.classList.remove('open');
  document.body.style.overflow = '';
}
toggle.addEventListener('click', function(){
  var isOpen = mobile.classList.toggle('open');
  toggle.classList.toggle('open', isOpen);
  document.body.style.overflow = isOpen ? 'hidden' : '';
});
// Close on link click
document.querySelectorAll('.nav-mobile-link, .nav-btn-mobile').forEach(function(el){
  el.addEventListener('click', closeMenu);
});
// Close on outside click
mobile.addEventListener('click', function(e){
  if(e.target === mobile) closeMenu();
});
// Close on Escape
document.addEventListener('keydown', function(e){
  if(e.key === 'Escape') closeMenu();
});
</script>
</body>
</html>
