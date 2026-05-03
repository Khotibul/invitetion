<!DOCTYPE html><html class="no-js"> <!--<![endif]-->
<head>
	@php
		use Carbon\Carbon;
		use Illuminate\Support\Str;
		setlocale(LC_ALL, 'IND');
		$invitationFile = Str::startsWith($invitation->file ?? '', 'template/') ? asset($invitation->file) : url('storage/'.($invitation->file ?? ''));
		$coverImageObj  = $data->cover->description->image ?? null;
		// Fix path: sistem simpan di storage/ bukan storage/cover/
		$coverImageFile = null;
		if ($coverImageObj && !empty($coverImageObj->image)) {
			if ($coverImageObj->method === 'asset') {
				$coverImageFile = asset($coverImageObj->image);
			} elseif ($coverImageObj->method === 'storage') {
				$coverImageFile = url('storage/sm/'.$coverImageObj->image);
			} elseif ($coverImageObj->method === 'avatar') {
				$coverImageFile = url('storage/avatar/'.$coverImageObj->image);
			} else {
				$coverImageFile = url('storage/'.$coverImageObj->image);
			}
		}
		$coverImageFile = $coverImageFile ?? $invitationFile;
		$set = [
			'title'   => "Wedding of ".$invitation->title." | The Wedding",
			'file'    => $invitationFile,
			'content' => Carbon::parse($data->detail->calendar->date ?? now()->toDateString())->formatLocalized('%A, %d %B %Y'),
		];
	@endphp
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ $set['title'] }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ $set['content'] }}" />
	<meta name="keywords" content="wedding, wedding invitation, invitation, the wedding" />
	<meta name="author" content="{{ $invitation->title }}" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:type" content="website">
	<meta property="og:title" content="{{ $set['title'] }}"/>
	<meta property="og:image" content="{{ $set['file'] }}"/>
	<meta property="og:url" content="{{ request()->fullUrl() }}"/>
	<meta property="og:site_name" content="{{ $set['title'] }}"/>
	<meta property="og:description" content="{{ $set['content'] }}"/>

	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:title" content="{{ $set['title'] }}" />
	<meta name="twitter:description" content="{{ $set['content'] }}" />
	<meta name="twitter:image" content="{{ $set['file'] }}" />
	<meta name="twitter:url" content="{{ request()->fullUrl() }}" />

	<link rel="icon" href="{{ $coverImageFile }}">

	<!--
      //////////////////////////////////////////////////////

      FREE HTML5 TEMPLATE
      DESIGNED & DEVELOPED by FREEHTML5.CO

      Website: 		http://freehtml5.co/
      Email: 			info@freehtml5.co
      Twitter: 		http://twitter.com/fh5co
      Facebook: 		https://www.facebook.com/fh5co

      //////////////////////////////////////////////////////
       -->

	<link href='https://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Sacramento" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Estonia" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/animate.css') }}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/icomoon.css') }}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/bootstrap.css') }}">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/magnific-popup.css') }}">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/owl.carousel.min.css') }}">
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/owl.theme.default.min.css') }}">

	<!--<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0-beta.2/css/lightgallery-bundle.min.css" />-->
	<link type="text/css" rel="stylesheet" href="{{ asset('template/the-wedding/lib/lightgallery.js/dist/css/lightgallery-bundle.min.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('template/the-wedding/lib/lightgallery.js/dist/css/lg-thumbnail.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('template/the-wedding/lib/lightgallery.js/dist/css/lg-autoplay.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('template/the-wedding/lib/lightgallery.js/dist/css/lg-fullscreen.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('template/the-wedding/lib/lightgallery.js/dist/css/lg-transitions.css') }}" />

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{ asset('template/the-wedding/css/style.css') }}">


	<!-- Modernizr JS -->
	<script src="{{ asset('template/the-wedding/js/modernizr-2.6.2.min.js') }}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="{{ asset('template/the-wedding/js/respond.min.js') }}"></script>
	<![endif]-->


	<!-- Sage Green & Terracotta Theme Override -->
	<style>
	/* ═══════════════════════════════════════════
	   THE WEDDING — SAGE GREEN & TERRACOTTA EDITION
	   Warna utama : #6b8f71 (sage green)
	   Aksen       : #c4714a (terracotta)
	   Latar       : #f7f3ee (warm cream)
	═══════════════════════════════════════════ */

	/* Foto sampul — lingkaran */
	.couple-main {
		border-radius: 50% !important;
		object-fit: cover !important;
		display: block; margin: 0 auto;
		border: 3px solid #6b8f71 !important;
		box-shadow: 0 0 0 6px rgba(107,143,113,.15) !important;
	}
	#overlay .content .couple-main { width:200px; height:200px; }
	#fh5co-header .couple-main    { width:220px; height:220px; }
	{{ '@' }}media screen and (max-width:480px){
		#fh5co-header .couple-main { width:160px; height:160px; }
		#overlay .content .couple-main { width:160px; height:160px; }
	}

	/* Footer couple photos */
	.footer-couple-photos { display:flex; align-items:center; justify-content:center; gap:1.5rem; margin:1.2rem 0; }
	.footer-couple-photo  { width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid #6b8f71; box-shadow:0 4px 15px rgba(0,0,0,.12); }
	.footer-couple-placeholder { width:100px; height:100px; border-radius:50%; background:#f0ebe3; border:3px solid #6b8f71; display:flex; align-items:center; justify-content:center; color:#6b8f71; font-size:2.5rem; }
	.footer-couple-sep { font-size:1.8rem; color:#c4714a; font-family:'Satisfy',Arial,serif; }

	/* Overlay cover */
	#overlay {
		background: linear-gradient(160deg, #2d4a30 0%, #4a7050 55%, #6b8f71 100%) !important;
	}
	#overlay .content h1 { color:#f0ebe3 !important; letter-spacing:2px; font-family:'Satisfy',Arial,serif !important; }
	#overlay .content h3 { color:#d4b896 !important; }
	#overlay .content p  { color:rgba(240,235,227,.75) !important; }
	#overlay .btn-primary {
		background:transparent !important; border:1px solid #c4714a !important;
		color:#f0ebe3 !important; letter-spacing:3px; text-transform:uppercase;
		font-size:.8rem; padding:.7rem 2rem; border-radius:50px;
	}
	#overlay .btn-primary:hover { background:#c4714a !important; color:#fff !important; }

	/* Header */
	#fh5co-header { background:linear-gradient(180deg,#f7f3ee 0%,#f0ebe3 100%) !important; }
	#fh5co-header h2 { color:#6b8f71 !important; letter-spacing:3px; font-family:'Satisfy',Arial,serif !important; }
	#fh5co-header h1 { color:#2d4a30 !important; font-family:'Satisfy',Arial,serif !important; }
	#fh5co-header p[style*="bf9b73"] { color:#c4714a !important; }
	#fh5co-header .btn-primary { background:#6b8f71 !important; border-color:#6b8f71 !important; border-radius:50px; }
	#fh5co-header .btn-info    { background:#c4714a !important; border-color:#c4714a !important; color:#fff !important; border-radius:50px; }
	#fh5co-header a[style*="bf9b73"] { background:#6b8f71 !important; border-radius:50px !important; }

	/* Countdown */
	.simply-countdown > .simply-section { background:#6b8f71 !important; border-radius:50%; width:80px !important; height:80px !important; }
	.simply-countdown > .simply-section .simply-amount { color:#f0ebe3 !important; }
	.simply-countdown > .simply-section .simply-word   { color:rgba(240,235,227,.7) !important; }

	/* Couple section */
	#fh5co-couple { background:#f7f3ee !important; }
	#fh5co-couple h2 { color:#6b8f71 !important; font-family:'Satisfy',Arial,serif !important; }
	#fh5co-couple h3 { color:#2d4a30 !important; }
	#fh5co-couple .desc-groom h3,
	#fh5co-couple .desc-bride h3 { color:#6b8f71 !important; font-family:'Satisfy',Arial,serif !important; font-size:2.2rem !important; }
	#fh5co-couple .desc-groom p span[style*="bf9b73"],
	#fh5co-couple .desc-bride  p span[style*="bf9b73"] { color:#c4714a !important; }
	#fh5co-couple .icon-heart2 { color:#c4714a !important; }
	#fh5co-couple .fh5co-social-icons a { color:#6b8f71 !important; }

	/* Event section */
	#fh5co-event { background:#2d4a30 !important; }
	#fh5co-event h2, #fh5co-event h3 { color:#f0ebe3 !important; }
	#fh5co-event .event-wrap {
		background:rgba(255,255,255,.06) !important;
		border:1px solid rgba(196,113,74,.3) !important;
		border-radius:12px;
	}
	#fh5co-event .event-wrap h3 { color:#d4b896 !important; font-family:'Satisfy',Arial,serif !important; font-size:1.8rem !important; }
	#fh5co-event .event-col span { color:#f0ebe3 !important; }
	#fh5co-event .icon-clock, #fh5co-event .icon-calendar { color:#c4714a !important; }
	#fh5co-event .btn-primary { background:#c4714a !important; border-color:#c4714a !important; border-radius:50px; }

	/* Gallery */
	#fh5co-gallery { background:#f7f3ee !important; }
	#fh5co-gallery h2 { color:#6b8f71 !important; font-family:'Satisfy',Arial,serif !important; }
	#fh5co-gallery h3 { color:#c4714a !important; }

	/* Quote / ayat */
	#fh5co-ayat { background:linear-gradient(135deg,#4a7050 0%,#2d4a30 100%) !important; }
	#fh5co-ayat .ayat-content { color:#f0ebe3 !important; font-family:'Merriweather',serif !important; font-style:italic; line-height:1.9; }

	/* Health protocol */
	#fh5co-health-protocol { background:#f7f3ee !important; }
	#fh5co-health-protocol h2 { color:#6b8f71 !important; }
	#fh5co-health-protocol h3 { color:#2d4a30 !important; font-size:1rem !important; }
	#fh5co-health-protocol p[style*="bf9b73"] { color:#c4714a !important; }

	/* Wishes */
	#fh5co-testimonial { background:#f7f3ee !important; }
	#fh5co-testimonial h2 { color:#6b8f71 !important; font-family:'Satisfy',Arial,serif !important; }
	#fh5co-testimonial span[style*="bf9b73"] { color:#c4714a !important; }
	#fh5co-testimonial .btn-primary { background:#6b8f71 !important; border-color:#6b8f71 !important; border-radius:50px; }
	#fh5co-testimonial .form-control:focus { border-color:#6b8f71 !important; box-shadow:0 0 0 .2rem rgba(107,143,113,.2) !important; }

	/* Footer */
	#fh5co-footer { background:#2d4a30 !important; }
	#fh5co-footer h1 { color:#f0ebe3 !important; font-family:'Satisfy',Arial,serif !important; }
	#fh5co-footer h3 { color:#d4b896 !important; }
	#fh5co-footer p  { color:rgba(240,235,227,.65) !important; }
	#fh5co-footer small { color:rgba(240,235,227,.4) !important; }
	#fh5co-footer div[style*="rgba(191"] { background:rgba(107,143,113,.12) !important; border-color:rgba(107,143,113,.3) !important; }
	#fh5co-footer a[style*="bf9b73"] { background:#6b8f71 !important; border-radius:50px !important; }
	#fh5co-footer div[style*="bf9b73"] { color:#d4b896 !important; }

	/* Floating button */
	.float .control-center .option-btn { background-color:#6b8f71 !important; }

	/* Mobile couple layout */
	{{ '@' }}media screen and (max-width:767px){
		.couple-wrap { display:flex !important; flex-direction:column !important; align-items:center !important; gap:2.5rem !important; }
		.couple-half { width:100% !important; float:none !important; display:flex !important; flex-direction:column !important; align-items:center !important; text-align:center !important; }
		.couple-half .groom, .couple-half .bride { width:180px !important; height:180px !important; margin:0 auto 1rem auto !important; flex-shrink:0 !important; }
		.couple-half .groom img, .couple-half .bride img { width:180px !important; height:180px !important; }
		.desc-groom, .desc-bride { position:static !important; width:100% !important; padding:0 1rem !important; margin-top:.5rem !important; text-align:center !important; }
		.desc-groom h3, .desc-bride h3 { font-size:1.8rem !important; }
		.fh5co-social-icons { justify-content:center !important; }
		.heart { margin:0 !important; font-size:1.5rem !important; }
	}
	{{ '@' }}media screen and (min-width:768px) and (max-width:991px){
		.couple-half { width:45% !important; }
		.desc-groom h3, .desc-bride h3 { font-size:1.6rem !important; }
	}
	</style>

</head>
<body>

<div class="fh5co-loader"></div>

<!--<div class="container">-->
<div id="page">
	<!--Floating button-->
	<div id="floating-button" class="float">
		<div class="control-center open">
			<div class="audio-play">
				<a href="javascript:void(0)" id="audio-control" style="display: none;">
					<img src="{{ asset('template/the-wedding/images/audio/play.png') }}" alt="Play Music" style="width: 20px;">
				</a>
				<audio id="bg-music" loop>
					<source src="{{ $data->music->url ?? '' }}" type="audio/mp3">
				</audio>
			</div>
			<ul class="right-sidebar">
				<!--gallery-->
				<li onclick="scrollToElement('fh5co-gallery')" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAADe0lEQVRoge2YTWgVVxiG35Mr1n+qopYkik1dFKRiJGgWLmqrLsSFPy3Y1G6soFkJdulWcFHBgAFRQcGFLgRr1W6kLvz/SdpNQQqtfyXG+oMuaheamMfFzMXPw0zuzOTcG5H7bu7MOe/3fe878805M1eqo4463m8ADUAHcBroBwYJg8E43ylgA9BQDfEtwO+BBFfCb8DHeTW64cRLuiZpxkguQk48ktTunLuTNSDRQHw7eyW1BhKWB72SljjnhrKQ0/pug0ZHvCS1Sfo6KznNQEcYLYWRuX6agUWBhBRFW/kAmDscMc3AzKBy8mOWOb4YLyiJSDNQCqtH9yQtlzRJ0gpJ/1Tg2/rNko7k2ieqsMZ/6eVfUSkgQcv6JK3hd79kXPfOrxXI8V3SYK0MtFc4z4KFmZlVaKG7cdtMAlYC9wq00ECS1rSdmKTxWsI553wt5TGLIi10QNISRUttu6SDBTVWDyl39RXQmcLvBIZG0GJZWih7VyTkGwQ2VYj5Fhh4Fw0MAB3e/EagD9iYwcQzYAswG5gOrANu1crAC7wNBNhM1E7Ev997818BL+P52yR8pACTgfPVNvACWOONbzXiyxgCtnm8VcDNJPGGMwE4Wy0D/wMrvbEfSH9Qh4DtHr/BHI8HThB9Njaa8XHAL9Uw8Ll3viPtSnnYkZBrInDOcP4C5pj5sbG5cAY8ATszigfoAcab2CnAxQTeXeATwxsDHAtuIKf4G8A0E/shcHUY/gNgvuGXgENBDAAO6Moh/gIw2cRPjQ1VwkNggVd3bwgDB3KIPwtMMLGzgD9yxD8GWk28A/aM1MCDjMVPA+NMXBPwZw7xZTwFFifoKBnOYB4DZzIUPQV8YGLmEK0wRfEcWObpaDLzfXkMfFOh2FFgjOHPI8M7fkYTX5i89tPT/6ob1kAJ6E0pchgoGe6nwP0A4sv41eTuNuM/ZjYQBzcDd7zk+3h7h/0M+Deg+H6gOc79EfCfmVuay0CcpIU3L11dgDNzi4AnAcVfAZri3A44buZ6bO28JpzvHmgnek0eCQaAv4GfgNXEdzaut8vjLktW946BqG2Oe+J3j7auVBAtFo1Eq0030SpkcRKzYIQoOJvoRawW2I9ZqkOaaAEuVVF4Dzl6vtCTTfTArVX0d1+rpEZJRa7WK0kPJd2XdF7Sz5IuO+dG/X+pOuqoo0Z4DePtUHAz1eX1AAAAAElFTkSuQmCC)"></li>
				<!--chat-->
				<li onclick="scrollToElement('fh5co-testimonial')" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABKklEQVRIidWVq04DQRhGv900QUFFCVWgUYQ6PAgeAUVwSDwplocoCamsqKlE4ICQECDlAfAYoAoDHEQ7SdnO7lw6CE6yYi45384/kxnpv5NVDQJ1SXuSdiVtSGpOhl4kDSVdSOplWTYKSgVqwAnwjps3oA3UfOVN4NpDXOQKWHHJ68BDhNxwDyxVBZzPITeclclbwHeCgC9g03jzqYwDOU6VJ7mkfVvAdgK5YccWsGqZ2JC0HNA2rNkCsEwslszVNizM9ABPCTbYMLSt4LLkb2K4sQV0ZS9TDD1rL9BJUJ670ljGV8XjHPJPYKtybUADuI0MOPUqIOPr+hgYBcgHQO62/w5aBA6BPvAMvE6+In1g9uzHUpB38X1sAgM+gKOk4qmANrD+J/JQfgANB//YYXlyuAAAAABJRU5ErkJggg==)"></li>
			</ul>
			<!--calendar-->
			<div onclick="scrollToElement('fh5co-event')" class="option-btn open"></div>
			<ul class="left-sidebar">
				<!--countdown-->
				<li onclick="scrollToElement('fh5co-header')" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABG0lEQVRIidXVTS4EQRjG8SZ2IrEnETEcQmYsjLkCiUu4g1P42FpxhmGG2IvEcAcfG9Z+FtOS1qaramZ6wZPUpqve5//2k36rs+wvCLd+6yaldjaR8TmKm95iDcIhzrA4bmEHp3jCR74ecYKdwrm7PLoBllOMN9AfkX1ZPaxjBff5s4OY+RbeEsy/9YoWFrCP+VjnVeabaAYgjZRoLqvaLJypUi9m3gnlkACAdtGzPAd70VeMazcEaNYA2AoBlmoA/JiBudJmcPzRzLJsJgKo9jCc1mk1KHqWI7qOdJeifghwXgPgIriL7hTxXEXxWMXzBOZpV0UOaeUFqXox/MLShYbAvVRQF2tjmZdAbRwb/kje8/WAI2xPbPxv9AUiVMwGoTr9YAAAAABJRU5ErkJggg==)"></li>
				<!--couple-->
				<li onclick="scrollToElement('fh5co-couple')" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAB7UlEQVRIie2VPUiVURjH/+eqSSJN4tDWRRAH5xD8QDCwgqAWhwwSaarBwUGaHFwcBAchGqNNdDaKoKAkBEvUURAVRInw82Jx0Z/De64+Xu5773nv0CD3P533eZ//+T3nW6qoomstwAEPgXfAKnAA7AE/gWGgJsbXAIwCi8ARkAF+AS+AqlLQJmCB4voMDAL1xvfUFxin98WgLX5kIdoHbnvfK+AswJMBvgGPLbQGWAmEAgx7XzuQTeDLaSgHfpLA9Bu45X0/yoAC/AXSKUn9AfvuTNIXSb3OuUOgQ9LdAJ8kfZDUJenYf9dKGqiW1JyXuCbpq6RlSRuStiStO+f2TM6DQOiSpOfOuV1gStKIj3eKyx2ZJdqxrlRvwHzMNP4DlomOYx/m+AEdJm9H5mM8cBQCNvKA00AbcKOIp9GuswW3JgBnjO9toKfWVmrBdQnAVkkKvlBKUsbHY6ephNbKMaUkffftj0C6jD5uhiRhrtlcoAXY9jPwJrATq+5AT+eVNfbBZqLjdAq0JwTPBOQ7YM54Nu3PMR/8A9wrYH4UAwZ4VgSaBmYtFOi1CSlgxiTMA5PAhG9jcrfywFngJQGXT1x1VcBrosc8X/sm734BOERPX9AdXrBCoh3YI+mOogdiXdIn59xJWSOqqKL/qXMXI9MKbss7gAAAAABJRU5ErkJggg==)"></li>
			</ul>
		</div>
	</div>

	<div id="overlay">
		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box fadeInUp animated-fast">
						@if ($coverImageFile && $coverImageFile !== $invitationFile)
						<img src="{{ $coverImageFile }}" alt="" class="couple-main">
						@elseif($invitationFile)
						<img src="{{ $invitationFile }}" alt="" class="couple-main">
						@else
						<div style="width:200px;height:200px;background:#eee;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto">
							<span style="color:#aaa">Foto Sampul</span>
						</div>
						@endif
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
						<h1>{{ $data->cover->name->male }} & {{ $data->cover->name->female }}</h1>
						@if ($other['guest']!=null)
						<p style="margin-bottom: 0">Kepada Yth./saudara/i/bapak/ibu:</p>
						<h3>{{ $other['guest']['name'] }}</h3>
						@else
						<p style="margin-bottom: 0">Kepada Bapak/Ibu/Saudara/i</p>
						@endif
						<p>{{ $data->cover->content }}</p>

						<button class="btn btn-primary" id="open-invitation">{{ $data->cover->button }}</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-header">
		<div class="container">
			<img class="flower-1" style="position: absolute; right: 0; top: 0" src="{{ asset('template/the-wedding/images/background/flowers/top-right-1.svg') }}">
			<img class="flower-1" style="position: absolute; left: -25px; top:0" src="{{ asset('template/the-wedding/images/background/flowers/top-left-1.svg') }}">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h2>The Wedding Of</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					@if ($coverImageFile && $coverImageFile !== $invitationFile)
					<img src="{{ $coverImageFile }}" alt="" class="couple-main">
					@elseif($invitationFile)
					<img src="{{ $invitationFile }}" alt="" class="couple-main">
					@else
					<div style="width:220px;height:220px;background:#f5f0e8;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;border:3px solid #bf9b73">
						<span style="color:#bf9b73;font-size:3rem">📷</span>
					</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h1>{{ $data->cover->name->male }} & {{ $data->cover->name->female }}</h1>
					<p style="color: #bf9b73">{{ $data->cover->content }}</p>

					{{-- Jadwal di bawah teks "Kami berharap..." --}}
					@if(!empty($data->detail->calendar->date ?? ''))
					<div style="display:inline-block;margin:.5rem 0 1rem;padding:.9rem 2rem;background:rgba(191,155,115,.1);border:1px solid rgba(191,155,115,.35);border-radius:12px;text-align:center">
						<div style="display:flex;align-items:center;justify-content:center;gap:.5rem;margin-bottom:.4rem;color:#5d4037;font-size:.95rem;font-weight:600">
							<i class="icon-calendar" style="color:#bf9b73"></i>
							{{ Carbon::parse($data->detail->calendar->date)->formatLocalized('%A, %d %B %Y') }}
						</div>
						@if(!empty($data->detail->calendar->time ?? ''))
						<div style="display:flex;align-items:center;justify-content:center;gap:.5rem;color:#828282;font-size:.85rem;margin-bottom:.3rem">
							<i class="icon-clock" style="color:#bf9b73"></i>
							Pukul {{ $data->detail->calendar->time }} {{ strtoupper($data->detail->calendar->timezone ?? 'WIB') }}
						</div>
						@endif
						@if(!empty($data->detail->location->address ?? ''))
						<div style="display:flex;align-items:flex-start;justify-content:center;gap:.5rem;color:#828282;font-size:.85rem;line-height:1.5">
							<i class="icon-location" style="color:#bf9b73;margin-top:2px;flex-shrink:0"></i>
							<span>{{ $data->detail->location->address }}</span>
						</div>
						@if(!empty($data->detail->location->map ?? ''))
						<div style="margin-top:.6rem">
							<a href="{{ $data->detail->location->map }}" target="_blank"
							   style="display:inline-flex;align-items:center;gap:.3rem;padding:.35rem .9rem;background:#bf9b73;color:#fff;border-radius:50px;font-size:.75rem;text-decoration:none">
								<i class="icon-map2"></i> Lihat Lokasi
							</a>
						</div>
						@endif
						@endif
					</div>
					@endif

					<div class="simply-countdown simply-countdown-wedding"></div>
					<br>
					@if ($data->detail->calendar->save->show===true)
					<p>
						<a href="http://www.google.com/calendar/event?action=TEMPLATE&dates={{ date('Ymd', strtotime($data->detail->calendar->date)) }}T010000Z%2F{{ date('Ymd', strtotime($data->detail->calendar->date." +1 days")) }}T010000Z&text=Wedding%20{{ $data->cover->name->male }}-{{ $data->cover->name->female }}&location={{ $data->detail->location->address }}&details=" target="_blank" class="btn btn-primary btn-sm">{{ $data->detail->calendar->save->content }}</a><br>
						<i style="font-size: 15px">*Klik tombol ini untuk menyimpan tanggal pada google kalender</i>
					</p>
					@endif
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-couple" style="background: url('{{ asset('template/the-wedding/images/background/repeat-background/so-white.png') }}'); background-repeat:repeat ">
		<div class="container">
			<img class="flower-2-right" style="position: absolute;" src="{{ asset('template/the-wedding/images/background/flowers/right-1.svg') }}">
			<img class="flower-2-left" style="position: absolute;" src="{{ asset('template/the-wedding/images/background/flowers/left-1.svg') }}">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<img src="{{ asset('template/the-wedding/images/bismillah.svg') }}" alt="" style="margin-bottom: 20px">
					<h2>Assalamu'alaikum Wr. Wb.</h2>
					<p style="color: #bf9b73">{{ $data->cover->description->bottom }}</p>
				</div>
			</div>
			<div class="couple-wrap animate-box">
				<div class="couple-half">
					<div class="groom">
						@php
							$maleFrame = $data->profile->photo->male->frame ?? '';
							$maleImg   = $data->profile->photo->male->image ?? '';
							$maleMethod = $data->profile->photo->male->method ?? 'none';
						@endphp
						@if(!empty($maleImg) && $maleMethod !== 'none')
						<div class="position-relative d-inline-block">
							<img src="{{ $maleMethod === 'storage' ? url('storage/sm/'.$maleImg) : url('storage/avatar/'.$maleImg) }}"
								alt="groom" class="img-responsive"
								style="border-radius:50%; width:200px; height:200px; object-fit:cover;">
							@if(!empty($maleFrame))
							<img src="{{ url('storage/frame/'.$maleFrame) }}" alt="frame"
								style="position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;">
							@endif
						</div>
						@else
						<div style="width:200px;height:200px;background:#f5f0e8;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;">
							<i class="icon-user" style="font-size:4rem;color:#bf9b73"></i>
						</div>
						@endif
					</div>
					<div class="desc-groom">
						<h3>{{ $data->profile->name->male }}</h3>
						@if ($data->profile->parent->show===true)
						<p><span style="color: #bf9b73">Putra ke-{{ $data->profile->parent->male->childhood }} dari</span><br>
							<span class="parents-font">Bapak {{ $data->profile->parent->male->father }}</span>
							<br>
							<span class="parents-font">Ibu {{ $data->profile->parent->male->mother }}</span>
						</p>
						@endif
						@if ($data->profile->instagram->show===true)
						<div id="social-media-rehan">
							<ul class="fh5co-social-icons">
								<li><a target="_blank" href="https://instagram.com/{{ $data->profile->instagram->male }}"><i class="icon-instagram-with-circle"></i></a></li>
							</ul>
						</div>
						@endif
					</div>
				</div>
				<p class="heart text-center"><i class="icon-heart2"></i></p>
				<div class="couple-half">
					<div class="bride">
						@php
							$femaleFrame = $data->profile->photo->female->frame ?? '';
							$femaleImg   = $data->profile->photo->female->image ?? '';
							$femaleMethod = $data->profile->photo->female->method ?? 'none';
						@endphp
						@if(!empty($femaleImg) && $femaleMethod !== 'none')
						<div class="position-relative d-inline-block">
							<img src="{{ $femaleMethod === 'storage' ? url('storage/sm/'.$femaleImg) : url('storage/avatar/'.$femaleImg) }}"
								alt="bride" class="img-responsive"
								style="border-radius:50%; width:200px; height:200px; object-fit:cover;">
							@if(!empty($femaleFrame))
							<img src="{{ url('storage/frame/'.$femaleFrame) }}" alt="frame"
								style="position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;">
							@endif
						</div>
						@else
						<div style="width:200px;height:200px;background:#f5f0e8;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;">
							<i class="icon-user" style="font-size:4rem;color:#bf9b73"></i>
						</div>
						@endif
					</div>
					<div class="desc-bride">
						<h3>{{ $data->profile->name->female }}</h3>
						@if ($data->profile->parent->show===true)
						<p><span style="color: #bf9b73">Putri ke-{{ $data->profile->parent->female->childhood }} dari</span><br>
							<span class="parents-font">Bapak {{ $data->profile->parent->female->father }}</span>
							<br>
							<span class="parents-font">Ibu {{ $data->profile->parent->female->mother }}</span>
						</p>
						@endif
						@if ($data->profile->instagram->show===true)
						<div id="social-media-molid">
							<ul class="fh5co-social-icons">
								<li><a target="_blank" href="https://instagram.com/{{ $data->profile->instagram->female }}"><i class="icon-instagram-with-circle"></i></a></li>
							</ul>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

<!--	style="background-image:url('{{ asset('template/the-wedding/images/background/blue-brush-2.jpg') }}');"-->
	<div id="fh5co-event" class="fh5co-bg" style="border-top: 1px solid #f2f2f2">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h2>Save The Date <a href="http://www.google.com/calendar/event?action=TEMPLATE&dates={{ date('Ymd', strtotime($data->detail->calendar->date)) }}T010000Z%2F{{ date('Ymd', strtotime($data->detail->calendar->date." +1 days")) }}T010000Z&text=Wedding%20{{ $data->cover->name->male }}-{{ $data->cover->name->female }}&location={{ $data->detail->location->address }}&details=" target="_blank" class="btn btn-info"><i class="icon-download2"></i></a></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					@foreach ($other['event'] as $item)
					@php
						$item->prop = json_decode($item->content);
					@endphp
					@if($item->prop)
					<div class="col-md-6 col-sm-6 text-center">
						<div class="event-wrap animate-box">
							<h3 style="font-family: 'Oswald', Arial, serif;">{{ $item->title }}</h3>
							<div class="event-col">
								<i class="icon-clock"></i>
								<span>{{ date('H:i', strtotime($item->prop->time->start)) }}</span>
								<span>{{ ($item->prop->time->done===true) ? 'selesai' : date('H:i', strtotime($item->prop->time->end)) }}</span>
							</div>
							<div class="event-col">
								<i class="icon-calendar"></i>
								<span>{{ Carbon::parse($data->detail->calendar->date)->formatLocalized('%A') }}</span>
								<span class="tanggal">{{ Carbon::parse($data->detail->calendar->date)->formatLocalized('%d %B %Y') }}</span>
							</div>
							<p style="font-family: 'Courgette', Arial, serif">{{ $item->prop->location->address }}</p>

							<a href="{{ $item->prop->location->map }}" target="_blank"
							   class="btn btn-primary">Penunjuk Lokasi <i class="icon-map2"></i></a>
						</div>
					</div>
					@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-gallery" style="background: url('{{ asset('template/the-wedding/images/background/repeat-background/so-white.png') }}'); background-repeat:repeat ">
		<img class="flower-3-top" src="{{ asset('template/the-wedding/images/background/flowers/top-2.svg') }}">
		<img class="flower-4-bottom" src="{{ asset('template/the-wedding/images/background/flowers/bottom-2.svg') }}">

		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading animate-box">
					<h2>Galeri Foto</h2>
					@if (isset($other['photo']) && $other['photo']!=null)
					<h3 style="color: #bf9b73">{{ $other['photo']->title }}</h3>
					@endif
				</div>
			</div>
			@if (isset($other['photo']) && $other['photo']!=null)
			<div class="row row-bottom-padded-md animate-box">
				<div class="col-md-12">
					<div id="inline-gallery-container" class="inline-gallery-container" style="position: relative; height: 500px"></div>
				</div>
			</div>
			@else
			<div class="row">
				<div class="col-md-12 text-center">
					<p>Belum ada foto galeri.</p>
				</div>
			</div>
			@endif
		</div>
	</div>

	<div id="fh5co-ayat">
		<!--<img height="400" width="100%" style="top: 0" src="{{ asset('template/the-wedding/images/background/wave-up.svg') }}">-->
		<img height="400" width="100%" style="position: absolute; bottom: -175px" src="{{ asset('template/the-wedding/images/background/wave-down.svg') }}">
		<div class="container">
			<div class="ayat-content animate-box">
				{{ $data->quote->content }}
			</div>
		</div>
	</div>
	<div id="fh5co-health-protocol">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Protokol Kesehatan & Anjuran</h2>
					<p style="color: #bf9b73">Guna mencegah penyebaran Covid-19, diharapkan bagi tamu undangan untuk mematuhi Protokol Kesehatan di bawah ini :</p>
				</div>
			</div>

			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 10px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/distance.png') }}" alt="Jaga jarak"/>
							</div>
							<div class="description">
								<h3>Jaga Jarak</h3>
								<p>Jaga jarak minimal 2m dengan orang lain</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 15px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/gel.png') }}" alt="Hand Sanitizer"/>
							</div>
							<div class="description">
								<h3>Gunakan Handsanitizer</h3>
								<p>Gunakan handsanitizer secara berkala</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 10px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/washing-hands.png') }}" alt="Cuci Tangan"/>
							</div>
							<div class="description">
								<h3>Cuci Tangan</h3>
								<p>Cuci tangan yang bersih</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 10px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/quarantine.png') }}" alt="Jaga jarak"/>
							</div>
							<div class="description">
								<h3>Hindari Kerumunan</h3>
								<p>Hindari kerumunan untuk mencegah penyebaran covid</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 15px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/mask.png') }}" alt="Pakai Masker"/>
							</div>
							<div class="description">
								<h3>Gunakan Masker</h3>
								<p>Pakai masker sebelum memasuki gedung acara</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 10px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/shaking-hands.png') }}" alt="Tidak Bersalaman"/>
							</div>
							<div class="description">
								<h3>Tidak Bersalaman</h3>
								<p>Diusahakan untuk tidak bersalaman</p>
							</div>
						</div>
					</div>
				</div>
				<p style="color: #bf9b73">dan mengikuti anjuran di bawah ini :</p>
				<div class="row">
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 10px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/eating.png') }}" alt="Adab makan minum"/>
							</div>
							<div class="description">
								<h3>Makan Minum</h3>
								<p>Mohon memperhatikan adab makan dan minum (duduk, membaca bismillah, tidak mencela makanan dan tidak mubazir)</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 15px" height="100px" width="100px" src="{{ asset('template/the-wedding/images/health-protocol/no-shaking-hands.png') }}" alt="Jaga jarak"/>
							</div>
							<div class="description">
								<h3>Tidak Bercampur Baur</h3>
								<p>Mohon untuk tidak bercampur baur dan tidak bersalaman antara tamu laki-laki dan perempuan termasuk saat berfoto (kecuali dengan mahram)</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-6">
						<div class="item-protocol">
							<div class="icon">
								<img style="padding: 10px" height="90px" width="90px" src="{{ asset('template/the-wedding/images/health-protocol/rug.png') }}" alt="Sholat"/>
							</div>
							<div class="description">
								<h3>Sholat</h3>
								<p>Memperhatikan waktu shalat wajib dan tidak meninggalkannya</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	@if (($data->wishes->public ?? false)===true)
	<div id="fh5co-testimonial" style="background: url('{{ asset('template/the-wedding/images/background/repeat-background/so-white.png') }}'); background-repeat:repeat; border-top: 1px solid #f2f2f2">
		<img height="400" class="flower-bukutamu-right" style="right: 0;top: 0;position: absolute;" src="{{ asset('template/the-wedding/images/background/flowers/top-right-3.svg') }}">
		<img height="400" class="flower-bukutamu-left" style="position: absolute; left: 0; bottom: 0" src="{{ asset('template/the-wedding/images/background/flowers/bottom-left-3.svg') }}">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>{{ $data->wishes->title }}</h2>
					<span style="color: #bf9b73">{{ $data->wishes->content }}</span>
				</div>
			</div>

			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form action="{{ isset($invitation->slug) ? route('invitation.wish', $invitation->slug) : '#' }}">
						@csrf
						<div class="form-group">
							<label for="wishper-name">Nama <var dir="name"></var></label>
							<input type="text" name="name" id="wishper-name" class="form-control" placeholder="Nama Anda">
						</div>
						<div class="form-group">
							<label for="wishper-phone">No. Whatsapp <var dir="phone"></var></label>
							<input type="text" name="phone" id="wishper-phone" class="form-control" placeholder="No. Whatsapp">
						</div>
						<div class="form-group">
							<label for="wishper-message">Harapan/Pesan/Ucapan <var dir="message"></var></label>
							<textarea name="message" id="wishper-message" cols="30" rows="5" class="form-control" placeholder="Tulis ucapan..."></textarea>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary">Sampaikan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endif

	<footer id="fh5co-footer" role="contentinfo" style="background: url('{{ asset('template/the-wedding/images/background/repeat-background/witewall_3.png') }}'); background-repeat:repeat ">
		<div class="container">
			<img class="flower-1" style="position: absolute; right: 0; bottom: 0" src="{{ asset('template/the-wedding/images/background/flowers/bottom-right-1.svg') }}">
			<img class="flower-1" style="position: absolute; left: 0; bottom:0" src="{{ asset('template/the-wedding/images/background/flowers/bottom-left-1.svg') }}">
			<div class="row copyright animate-box">
				<div class="col-md-12 text-center">
					@if ($data->detail->additional->show===true)
					<p>{{ $data->detail->additional->closing }}</p>
					@endif
					<h3 style="color: #bf9b73">Wassalamu'alaikum Wr. Wb.</h3>
					<p>Jazakumullahu Khairan</p>

					{{-- Foto pasangan dalam dua lingkaran terpisah --}}
					@php
						$fMaleMethod  = $data->profile->photo->male->method   ?? 'none';
						$fMaleImg     = $data->profile->photo->male->image     ?? '';
						$fFemaleMethod= $data->profile->photo->female->method  ?? 'none';
						$fFemaleImg   = $data->profile->photo->female->image   ?? '';
						$fMaleSrc     = (!empty($fMaleImg)   && $fMaleMethod   !== 'none')
							? ($fMaleMethod   === 'storage' ? url('storage/sm/'.$fMaleImg)   : url('storage/avatar/'.$fMaleImg))   : null;
						$fFemaleSrc   = (!empty($fFemaleImg) && $fFemaleMethod !== 'none')
							? ($fFemaleMethod === 'storage' ? url('storage/sm/'.$fFemaleImg) : url('storage/avatar/'.$fFemaleImg)) : null;
					@endphp
					<div class="footer-couple-photos">
						{{-- Pria di kiri --}}
						@if($fMaleSrc)
						<img src="{{ $fMaleSrc }}" alt="{{ $data->profile->name->male ?? '' }}" class="footer-couple-photo">
						@else
						<div class="footer-couple-placeholder">🤵</div>
						@endif

						<span class="footer-couple-sep">&amp;</span>

						{{-- Wanita di kanan --}}
						@if($fFemaleSrc)
						<img src="{{ $fFemaleSrc }}" alt="{{ $data->profile->name->female ?? '' }}" class="footer-couple-photo">
						@else
						<div class="footer-couple-placeholder">👰</div>
						@endif
					</div>

					<h1 style="font-family: 'Satisfy', Arial, serif">{{ $data->cover->name->male }} & {{ $data->cover->name->female }}</h1>

					{{-- Detail acara di footer --}}
					@php
						$footerDate = $data->detail->calendar->date ?? null;
						$footerTime = $data->detail->calendar->time ?? null;
						$footerTz   = strtoupper($data->detail->calendar->timezone ?? 'WIB');
						$footerAddr = $data->detail->location->address ?? null;
						$footerMap  = $data->detail->location->map ?? null;
					@endphp
					@if($footerDate)
					<div style="margin:1.2rem auto;max-width:500px;padding:1.2rem 1.5rem;background:rgba(191,155,115,.08);border:1px solid rgba(191,155,115,.3);border-radius:12px">
						<div style="display:flex;align-items:center;justify-content:center;gap:.5rem;margin-bottom:.5rem;color:#bf9b73;font-size:.9rem">
							<i class="icon-calendar" style="font-size:1.1rem"></i>
							<span style="font-weight:600">
								{{ Carbon::parse($footerDate)->locale('id')->translatedFormat('l, d F Y') }}
							</span>
						</div>
						@if($footerTime)
						<div style="display:flex;align-items:center;justify-content:center;gap:.5rem;margin-bottom:.5rem;color:#828282;font-size:.85rem">
							<i class="icon-clock" style="font-size:1rem;color:#bf9b73"></i>
							<span>Pukul {{ $footerTime }} {{ $footerTz }}</span>
						</div>
						@endif
						@if($footerAddr)
						<div style="display:flex;align-items:flex-start;justify-content:center;gap:.5rem;color:#828282;font-size:.85rem;line-height:1.5">
							<i class="icon-location" style="font-size:1rem;color:#bf9b73;margin-top:2px;flex-shrink:0"></i>
							<span>{{ $footerAddr }}</span>
						</div>
						@if($footerMap)
						<div style="margin-top:.8rem">
							<a href="{{ $footerMap }}" target="_blank"
							   style="display:inline-flex;align-items:center;gap:.3rem;padding:.4rem 1rem;background:#bf9b73;color:#fff;border-radius:50px;font-size:.75rem;text-decoration:none;transition:opacity .2s"
							   onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
								<i class="icon-map2"></i> Lihat Lokasi
							</a>
						</div>
						@endif
						@endif
					</div>
					@endif

					{{-- Acara dari event list --}}
					@if(count($other['event'] ?? []) > 0)
					<div style="margin:.8rem auto;max-width:600px;display:flex;flex-wrap:wrap;gap:.8rem;justify-content:center">
						@foreach($other['event'] as $ev)
						@php $ep = json_decode($ev->content); @endphp
						@if($ep)
						<div style="background:rgba(191,155,115,.06);border:1px solid rgba(191,155,115,.25);border-radius:10px;padding:.8rem 1.2rem;min-width:180px;text-align:center">
							<div style="font-weight:700;color:#bf9b73;font-size:.9rem;margin-bottom:.3rem">{{ $ev->title }}</div>
							<div style="font-size:.8rem;color:#828282">
								{{ date('H:i', strtotime($ep->time->start)) }}
								@if(!($ep->time->done ?? false)) – {{ date('H:i', strtotime($ep->time->end)) }} @else – selesai @endif
								{{ $footerTz }}
							</div>
							@if(!empty($ep->location->address ?? '') && !($ep->location->sync ?? false))
							<div style="font-size:.75rem;color:#aaa;margin-top:.2rem">{{ $ep->location->address }}</div>
							@endif
						</div>
						@endif
						@endforeach
					</div>
					@endif

					<p>
						© Copyright {{ date('Y') }} Risa Digital Invitation All Rights Reserved<br>
						<small>Risa Digital Invitation</small>
					</p>
				</div>
			</div>

		</div>
	</footer>
</div>
<!--</div>-->

<!--<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>-->

<!-- jQuery -->
<script src="{{ asset('template/the-wedding/js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('template/the-wedding/js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/the-wedding/js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('template/the-wedding/js/jquery.waypoints.min.js') }}"></script>
<!-- Carousel -->
<script src="{{ asset('template/the-wedding/js/owl.carousel.min.js') }}"></script>
<!-- countTo -->
<script src="{{ asset('template/the-wedding/js/jquery.countTo.js') }}"></script>

<!-- Stellar -->
<script src="{{ asset('template/the-wedding/js/jquery.stellar.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('template/the-wedding/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('template/the-wedding/js/magnific-popup-options.js') }}"></script>

<!-- // <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script> -->
<script src="{{ asset('template/the-wedding/js/simplyCountdown.js') }}"></script>
<!-- Main -->
<script src="{{ asset('template/the-wedding/js/main.js') }}"></script>

<script src="{{ asset('template/the-wedding/lib/lightgallery.js/dist/lightgallery.min.js') }}"></script>
<script src="{{ asset('template/the-wedding/lib/lightgallery.js/dist/plugins/thumbnail/lg-thumbnail.min.js') }}"></script>
<script src="{{ asset('template/the-wedding/lib/lightgallery.js/dist/plugins/autoplay/lg-autoplay.min.js') }}"></script>
<script src="{{ asset('template/the-wedding/lib/lightgallery.js/dist/plugins/fullscreen/lg-fullscreen.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/2.0.3/showdown.min.js"></script>

<script>
	var d = new Date("{{ $data->detail->calendar->date ?? now()->toDateString() }}T{{ $data->detail->calendar->time ?? '00:00' }}");

	// default example
	simplyCountdown('.simply-countdown-wedding', {
		year: d.getFullYear(),
		month: d.getMonth() + 1,
		day: d.getDate(),
		hour: d.getHours(),
		minutes: d.getMinutes(), // Default is 0 [0-59] integer
		seconds: 0, // Default is 0 [0-59] integer
		countUp: true
		// enableUtc: true
	});

	//jQuery example
	// $('#simply-countdown-losange').simplyCountdown({
	// 	year: d.getFullYear(),
	// 	month: d.getMonth() + 1,
	// 	day: d.getDate(),
	// 	enableUtc: false
	// });

	$('#open-invitation').click(function (){
		$('#overlay').addClass('hide-overlay');
		playAudio();
		/*yang bagian floating button ada animasinya tapi karena ketutup dulu sama overlay jadinya gak nampak*/
		/*pengen pas di klik buka undangan baru jalan animasinya*/
		/*var c = document.getElementsByClassName('right-sidebar');
		for (var i = 0; i < c.length; i++) {
			c[i].classList.add('animate');
		}*/
	});

	$(".sender").on('submit', function(e) {
		e.preventDefault();
		let action = $(this).attr('action'),
			submit = $(this).find('button[type=submit]');
		$.ajax({
			type: 'post',
			url : action,
			dataType: 'json',
			data: $(this).serialize(),
			error: function(q,w,e) {
				submit.text('Coba Lagi');
				submit.prop('disabled', false);
				$.each(q.responseJSON.errors, function(index, value) {
					$(`var[dir=${index}]`).after(`<small role="alert" style="color:red">${value}</small>`);
				});
			},
			beforeSend: function() {
				$(".feedbacker").remove();
				$("small[role=alert]").remove();
				submit.prop('disabled', true);
				submit.text('Memeriksa data...');
			},
			success: function(response) {
				submit.prop('disabled', false);
				submit.text('Terkirim');
				$(".sender")[0].reset();
				submit.parent().append(`<div class="feedbacker" style="color:green; margin-top:10px">${response.message}</div>`);
			}
		});
	});

	function scrollToElement(el) {
		$("html, body").animate({ scrollTop: $(`#${el}`).offset().top }, 1000);
	}
</script>

<script>
	var audio = document.getElementById("bg-music");
	var audioControl = document.getElementById("audio-control");
	var audioIcon = audioControl.querySelector('img');

	function toggleAudio() {
		if (audio.paused) {
			audio.play();
			audioIcon.src = "{{ asset('template/the-wedding/images/audio/pause.png') }}";
		} else {
			audio.pause();
			audioIcon.src = "{{ asset('template/the-wedding/images/audio/play.png') }}";
		}
	}

	function playAudio() {
		if (audio.paused) {
			audio.play();
			audioIcon.src = "{{ asset('template/the-wedding/images/audio/pause.png') }}";
		}
	}

	audioControl.onclick = toggleAudio;

	@if(!empty($data->music->url ?? null))
		audioControl.style.display = "block";
	@endif
</script>

<script type="text/javascript">
	@if (isset($other['photo']) && $other['photo']!=null)
	const lgContainer = document.getElementById('inline-gallery-container');
	const inlineGallery = lightGallery(lgContainer, {
		container: lgContainer,
		dynamic: true,
		thumbnail : true,
		// Turn off hash plugin in case if you are using it
		// as we don't want to change the url on slide change
		hash: false,
		// Do not allow users to close the gallery
		closable: false,
		// Add maximize icon to enlarge the gallery
		showMaximizeIcon: true,
		download : false,
		// Append caption inside the slide item
		// to apply some animation for the captions (Optional)
		appendSubHtmlTo: '.lg-item',
		// Delay slide transition to complete captions animations
		// before navigating to different slides (Optional)
		// You can find caption animation demo on the captions demo page
		slideDelay: 400,
		dynamicEl: [
			@foreach ($other['photo']->prop->file as $file)
			{
				src: '{{ url('storage/'.$file) }}',
				thumb: '{{ url('storage/'.$file) }}',
			},
			@endforeach
		],
	});

	// Since we are using dynamic mode, we need to programmatically open lightGallery
	inlineGallery.openGallery();
	@endif
</script>

</body>
</html>
