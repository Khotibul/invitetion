@extends('member.layouts.app')
@section('title', Str::title('dashboard'))
@push('style')
<style>
/* ══════════════════════════════════════════
   DASHBOARD MODERN — Creasik 2025
══════════════════════════════════════════ */
:root {
    --cr-green:   #00b0b3ff;
    --cr-green2:  #1f5c3a;
    --cr-gold:    #d4af37;
    --cr-gold2:   #b8960c;
    --cr-light:   #f0f9f4;
    --cr-card-bg: #ffffff;
    --cr-radius:  14px;
    --cr-shadow:  0 2px 16px rgba(0,0,0,.07);
    --cr-shadow-hover: 0 6px 24px rgba(0,0,0,.13);
}

/* ── Sub-nav pills ── */
.creasik-nav-pill { gap:.5rem; flex-wrap:nowrap; overflow-x:auto; padding-bottom:.25rem; }
.creasik-nav-pill::-webkit-scrollbar { height:3px; }
.creasik-nav-pill::-webkit-scrollbar-thumb { background:var(--cr-green); border-radius:3px; }
.creasik-nav-pill .nav-link {
    border-radius:50px; padding:.45rem 1rem; font-size:.82rem; font-weight:600;
    color:#555; background:#fff; border:1.5px solid #e0e0e0;
    display:flex; align-items:center; gap:.35rem; white-space:nowrap;
    transition:all .2s;
}
.creasik-nav-pill .nav-link.active,
.creasik-nav-pill .nav-link:hover {
    background:var(--cr-green); color:#fff; border-color:var(--cr-green);
}
.creasik-nav-pill .nav-link i { font-size:1rem; }

/* ── Hero card (undangan) ── */
.dash-hero {
    background: linear-gradient(135deg, var(--cr-green2) 0%, var(--cr-green) 60%, #3a9e65 100%);
    border-radius: var(--cr-radius);
    color: #fff;
    padding: 1.5rem;
    position: relative;
    overflow: hidden;
    box-shadow: var(--cr-shadow);
}
.dash-hero::before {
    content:'';
    position:absolute; top:-40px; right:-40px;
    width:180px; height:180px;
    background:rgba(255,255,255,.06);
    border-radius:50%;
}
.dash-hero::after {
    content:'';
    position:absolute; bottom:-60px; left:-30px;
    width:220px; height:220px;
    background:rgba(255,255,255,.04);
    border-radius:50%;
}
.dash-hero .couple-name {
    font-size:1.35rem; font-weight:700; letter-spacing:.5px;
    text-shadow:0 1px 4px rgba(0,0,0,.2);
}
.dash-hero .inv-link {
    font-size:.78rem; color:rgba(255,255,255,.8);
    text-decoration:none; word-break:break-all;
}
.dash-hero .inv-link:hover { color:#fff; }
.dash-hero .badge-template {
    background:rgba(255,255,255,.18); color:#fff;
    font-size:.7rem; border-radius:50px; padding:.3rem .75rem;
    backdrop-filter:blur(4px);
}

/* ── Preview iframe wrapper ── */
.preview-card {
    background:#fff; border-radius:var(--cr-radius);
    overflow:hidden; box-shadow:var(--cr-shadow);
    border:1px solid rgba(45,122,79,.15);
}
.preview-card-header {
    background:linear-gradient(90deg,var(--cr-green),#3a9e65);
    padding:.6rem 1rem;
    display:flex; align-items:center; justify-content:space-between;
}
.preview-card-header span { color:#fff; font-size:.8rem; font-weight:600; }
.preview-card-header a { color:rgba(255,255,255,.85); font-size:.85rem; }
.preview-card-header a:hover { color:#fff; }

/* ── Stat cards ── */
.stat-card {
    background:var(--cr-card-bg); border-radius:var(--cr-radius);
    padding:1.1rem 1.2rem; box-shadow:var(--cr-shadow);
    border:1px solid rgba(0,0,0,.05);
    transition:box-shadow .2s, transform .2s;
}
.stat-card:hover { box-shadow:var(--cr-shadow-hover); transform:translateY(-2px); }
.stat-card .stat-icon {
    width:44px; height:44px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.4rem; flex-shrink:0;
}
.stat-card .stat-label { font-size:.75rem; color:#888; font-weight:500; }
.stat-card .stat-value { font-size:1.5rem; font-weight:700; line-height:1.1; }

/* ── Package card ── */
.pack-card {
    background:linear-gradient(135deg,#fff9e6 0%,#fffdf5 100%);
    border:1.5px solid rgba(212,175,55,.3);
    border-radius:var(--cr-radius);
    padding:1.2rem; box-shadow:var(--cr-shadow);
}
.pack-card .pack-title { font-size:1.1rem; font-weight:700; color:var(--cr-green2); }
.pack-card .pack-badge {
    background:linear-gradient(90deg,var(--cr-gold),var(--cr-gold2));
    color:#fff; font-size:.7rem; border-radius:50px; padding:.25rem .75rem;
    font-weight:600; letter-spacing:.5px;
}

/* ── Countdown ── */
.countdown-modern { display:flex; gap:.5rem; justify-content:center; flex-wrap:wrap; }
.countdown-modern .cd-box {
    background:rgba(45,122,79,.08); border:1px solid rgba(45,122,79,.15);
    border-radius:10px; padding:.5rem .75rem; text-align:center; min-width:56px;
}
.countdown-modern .cd-box b { display:block; font-size:1.4rem; font-weight:700; color:var(--cr-green2); line-height:1; }
.countdown-modern .cd-box span { font-size:.65rem; color:#888; text-transform:uppercase; letter-spacing:.5px; }

/* ── Preset menu (quick links) ── */
.preset-menu-modern {
    display:grid;
    grid-template-columns: repeat(5, 1fr);
    gap:.75rem;
}
.preset-menu-modern > a {
    background:#fff; border-radius:var(--cr-radius);
    padding:.9rem .5rem; text-align:center; text-decoration:none;
    border:1.5px solid #eee; transition:all .2s;
    display:flex; flex-direction:column; align-items:center; gap:.4rem;
    box-shadow:0 1px 6px rgba(0,0,0,.05);
}
.preset-menu-modern > a:hover {
    border-color:var(--cr-green); box-shadow:0 4px 16px rgba(45,122,79,.15);
    transform:translateY(-2px);
}
.preset-menu-modern > a.lock { position:relative; overflow:hidden; }
.preset-menu-modern > a i { font-size:1.8rem; color:var(--cr-green); }
.preset-menu-modern > a span { font-size:.65rem; font-weight:700; color:#444; text-transform:uppercase; letter-spacing:.3px; line-height:1.2; }

/* ── Section header ── */
.section-header {
    display:flex; align-items:center; justify-content:space-between;
    margin-bottom:1rem;
}
.section-header h5 {
    font-size:1rem; font-weight:700; color:var(--cr-green2);
    margin:0; display:flex; align-items:center; gap:.4rem;
}
.section-header h5::before {
    content:''; display:inline-block;
    width:4px; height:18px; background:var(--cr-green);
    border-radius:4px;
}

/* ── Template thumbnail CSS card ── */
.tpl-scroll { display:flex; gap:.85rem; overflow-x:auto; padding-bottom:.5rem; }
.tpl-scroll::-webkit-scrollbar { height:4px; }
.tpl-scroll::-webkit-scrollbar-thumb { background:var(--cr-green); border-radius:4px; }

.tpl-card {
    flex-shrink:0; width:160px;
    border-radius:12px; overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
    border:2px solid transparent;
    transition:all .25s; cursor:pointer;
    background:#fff;
}
.tpl-card.active-tpl { border-color:var(--cr-green); box-shadow:0 0 0 3px rgba(45,122,79,.2); }
.tpl-card:hover { transform:translateY(-3px); box-shadow:0 6px 20px rgba(0,0,0,.15); }

/* CSS Thumbnail — cover preview */
.tpl-thumb {
    height:120px; position:relative; overflow:hidden;
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    padding:.75rem .5rem;
}
.tpl-thumb .tpl-photo {
    width:44px; height:44px; border-radius:50%;
    border:2px solid rgba(255,255,255,.6);
    background:rgba(255,255,255,.2);
    display:flex; align-items:center; justify-content:center;
    font-size:1.2rem; margin-bottom:.35rem; flex-shrink:0;
    overflow:hidden;
}
.tpl-thumb .tpl-names {
    font-size:.62rem; font-weight:700; text-align:center;
    line-height:1.3; letter-spacing:.3px;
}
.tpl-thumb .tpl-divider {
    width:30px; height:1px; margin:.3rem auto;
    background:rgba(255,255,255,.5);
}
.tpl-thumb .tpl-date {
    font-size:.55rem; text-align:center; opacity:.85;
}
.tpl-thumb .tpl-btn {
    margin-top:.35rem; padding:.2rem .6rem;
    border-radius:50px; font-size:.5rem; font-weight:600;
    letter-spacing:.5px; text-transform:uppercase;
    background:rgba(255,255,255,.25); color:#fff;
    border:1px solid rgba(255,255,255,.5);
}
/* Lock overlay */
.tpl-thumb .tpl-lock {
    position:absolute; inset:0;
    background:rgba(0,0,0,.45);
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    color:#fff;
}
.tpl-thumb .tpl-lock i { font-size:1.6rem; }
.tpl-thumb .tpl-lock span { font-size:.6rem; margin-top:.2rem; }
/* Active badge */
.tpl-thumb .tpl-active-badge {
    position:absolute; top:.4rem; left:.4rem;
    background:var(--cr-green); color:#fff;
    font-size:.55rem; border-radius:50px; padding:.15rem .5rem;
    font-weight:700;
}

.tpl-info {
    padding:.5rem .6rem .6rem;
    background:#fff;
}
.tpl-info .tpl-title {
    font-size:.72rem; font-weight:700; color:#333;
    white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
    margin-bottom:.4rem;
}
.tpl-info .tpl-actions { display:flex; gap:.3rem; }
.tpl-info .tpl-actions .btn { font-size:.62rem; padding:.2rem .45rem; flex:1; }

/* ── Grade badge ── */
.grade-badge {
    display:inline-flex; align-items:center; gap:.3rem;
    padding:.3rem .8rem; border-radius:50px;
    font-size:.72rem; font-weight:700; margin-bottom:.75rem;
}

/* ── Guestbook card ── */
.guestbook-card {
    background:linear-gradient(135deg,#f0f9f4,#e8f5ee);
    border:1.5px solid rgba(45,122,79,.2);
    border-radius:var(--cr-radius); padding:1rem 1.2rem;
    display:flex; align-items:center; gap:1rem;
    text-decoration:none; transition:all .2s;
    box-shadow:var(--cr-shadow);
}
.guestbook-card:hover { box-shadow:var(--cr-shadow-hover); transform:translateY(-2px); }
.guestbook-card img { width:52px; flex-shrink:0; }
.guestbook-card .gb-title { font-weight:700; color:var(--cr-green2); font-size:.95rem; }
.guestbook-card .gb-sub { font-size:.78rem; color:#666; }

/* ── Attendance chart ── */
.attend-card {
    background:#fff; border-radius:var(--cr-radius);
    padding:1.2rem; box-shadow:var(--cr-shadow);
    border:1px solid rgba(0,0,0,.05);
}

/* ── Action buttons ── */
.btn-creasik-primary {
    background:var(--cr-green); color:#fff; border:none;
    border-radius:8px; font-weight:600; font-size:.82rem;
    transition:all .2s;
}
.btn-creasik-primary:hover { background:var(--cr-green2); color:#fff; transform:translateY(-1px); }
.text-creasik-primary { color:var(--cr-green) !important; }

/* ── Responsive ── */
@media (max-width:767px) {
    .preset-menu-modern { grid-template-columns:repeat(3,1fr); gap:.5rem; }
    .preset-menu-modern > a { padding:.7rem .4rem; }
    .preset-menu-modern > a i { font-size:1.5rem; }
    .dash-hero .couple-name { font-size:1.1rem; }
    .stat-card .stat-value { font-size:1.2rem; }
    .tpl-card { width:145px; }
    .tpl-thumb { height:110px; }
}
@media (max-width:480px) {
    .preset-menu-modern { grid-template-columns:repeat(3,1fr); }
    .creasik-nav-pill .nav-link span { display:none; }
    .creasik-nav-pill .nav-link { padding:.45rem .7rem; }
}
</style>
@endpush
@php
    use Carbon\Carbon;
    use App\Models\Feedback;
    use App\Models\InvitationGuest;

    $invoice = Auth::user()->invoice->first();
    if ($invoice) {
        $activation  = $invoice->date;
        $packContent = ($invoice->pack && $invoice->pack->content) ? json_decode($invoice->pack->content) : null;
        $active      = $packContent->active ?? 0;
        $template    = $packContent->template ?? [];
        $packTitle   = $invoice->pack ? $invoice->pack->title : 'Paket Tidak Diketahui';
    } else {
        $activation  = now();
        $active      = 0;
        $template    = [];
        $packTitle   = 'Belum Langganan';
    }

    // Nama pasangan — pisahkan pria & wanita
    $invTitle = Auth::user()->inv ? json_decode(Auth::user()->inv->title, true) : null;
    $namePria   = $invTitle[0] ?? '-';
    $nameWanita = $invTitle[1] ?? '-';
    // Jika keduanya sama (bug lama), tampilkan hanya satu
    $namaLengkap = ($namePria === $nameWanita)
        ? $namePria
        : $namePria . ' & ' . $nameWanita;

    // Statistik kehadiran
    $invId     = Auth::user()->inv?->id;
    $statHadir = $invId ? Feedback::where('invitation_id', $invId)->where('type', 'present')
        ->whereRaw("content::text ILIKE '%\"option\":\"yes\"%' OR content::text ILIKE '%\"option\":\"hadir\"%'")
        ->count() : 0;
    $statTidak = $invId ? Feedback::where('invitation_id', $invId)->where('type', 'present')
        ->whereRaw("content::text NOT ILIKE '%\"option\":\"yes\"%' AND content::text NOT ILIKE '%\"option\":\"hadir\"%'")
        ->count() : 0;
    $statTotal = $statHadir + $statTidak;

    // Tamu terdaftar
    $totalTamu = $invId ? InvitationGuest::where('invitation_id', $invId)->count() : 0;
    $limitTamu = $packContent->guest ?? 0;
    $limitTamuLabel = ($limitTamu === 'unlimited' || $limitTamu == 0) ? '∞' : $limitTamu;

    $isExpired = isexpired($activation, $active);
@endphp
@section('content')
<section class="py-3">

    {{-- Sub-nav --}}
    <ul class="nav creasik-nav-pill mb-4">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page">
                <i class="bx bxs-widget"></i><span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="bx bx-user-circle"></i><span>Profil</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('packages') }}">
                <i class="bx bx-cart-alt"></i><span>Pesan Undangan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('storage') }}">
                <i class="bx bx-images"></i><span>Penyimpanan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('transaction') }}">
                <i class="bx bx-receipt"></i><span>Transaksi</span>
            </a>
        </li>
    </ul>

    {{-- Row 1: Hero + Stats --}}
    <div class="row g-3 mb-3">

        {{-- Hero card --}}
        <div class="col-12 col-lg-7">
            <div class="dash-hero mb-3">
                <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                    <div>
                        <div class="couple-name mb-1">
                            <i class="bx bx-heart me-1" style="color:rgba(255,255,255,.7)"></i>
                            {{ $namaLengkap }}
                        </div>
                        @if($data->subdomain)
                        <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank" class="inv-link">
                            <i class="bx bx-link-external me-1"></i>{{ route('invitation.index', $data->subdomain) }}
                        </a>
                        @else
                        <span class="inv-link"><i class="bx bx-info-circle me-1"></i>Belum ada link undangan</span>
                        @endif
                    </div>
                    @if(Auth::user()->inv && Auth::user()->inv->temp)
                    <span class="badge-template flex-shrink-0">
                        <i class="bx bx-palette me-1"></i>{{ Auth::user()->inv->temp->title }}
                    </span>
                    @endif
                </div>

                {{-- Countdown --}}
                @if($data->date && !empty($data->date->date))
                <div id="countdown" class="countdown-modern my-2" data-time="{{ date('Y-m-d', strtotime($data->date->date)) }}">
                    <div class="cd-box"><b id="days">0</b><span>Hari</span></div>
                    <div class="cd-box"><b id="hours">0</b><span>Jam</span></div>
                    <div class="cd-box"><b id="minutes">0</b><span>Menit</span></div>
                    <div class="cd-box"><b id="seconds">0</b><span>Detik</span></div>
                </div>
                @else
                <div class="text-center py-2" style="color:rgba(255,255,255,.7);font-size:.82rem">
                    <i class="bx bx-calendar me-1"></i>
                    Tanggal pernikahan belum diatur �
                    <a href="{{ route('menu.detail') }}" style="color:#fff;font-weight:600">atur sekarang</a>
                </div>
                @endif

                {{-- Action buttons --}}
                <div class="d-flex gap-2 flex-wrap mt-2">
                    @if($data->subdomain)
                    <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank"
                       class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.4);border-radius:8px;font-size:.78rem">
                        <i class="bx bx-show me-1"></i>Tinjau
                    </a>
                    <button class="btn btn-sm" id="copyLinkBtn"
                            data-link="{{ route('invitation.index', $data->subdomain) }}"
                            style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.4);border-radius:8px;font-size:.78rem">
                        <i class="bx bx-copy me-1"></i>Salin Link
                    </button>
                    @endif
                    <a href="{{ route('menu.detail') }}"
                       class="btn btn-sm" style="background:rgba(255,255,255,.2);color:#fff;border:1px solid rgba(255,255,255,.4);border-radius:8px;font-size:.78rem">
                        <i class="bx bx-edit me-1"></i>Ubah Tanggal
                    </a>
                </div>
            </div>

            {{-- Preview iframe --}}
            @if(Auth::user()->inv && Auth::user()->inv->temp)
            <div class="preview-card">
                <div class="preview-card-header">
                    <span><i class="bx bx-desktop me-1"></i>Preview Undangan</span>
                    @if($data->subdomain)
                    <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank" title="Buka di tab baru">
                        <i class="bx bx-fullscreen"></i>
                    </a>
                    @endif
                </div>
                <div id="previewWrap" style="position:relative;height:300px;overflow:hidden;background:#f8faf9">
                    <iframe id="previewFrame"
                        src="{{ route('member.preview') }}"
                        style="border:none;position:absolute;top:0;left:0;transform-origin:top left"
                        scrolling="no" loading="lazy" title="Preview Undangan">
                    </iframe>
                    @if($data->subdomain)
                    <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank"
                       style="position:absolute;inset:0;z-index:1;cursor:pointer" title="Klik untuk membuka undangan"></a>
                    @else
                    <div style="position:absolute;inset:0;z-index:1"></div>
                    @endif
                </div>
            </div>
            @elseif(Auth::user()->inv && Auth::user()->inv->file)
            <div class="preview-card">
                <div class="preview-card-header">
                    <span><i class="bx bx-image me-1"></i>Foto Undangan</span>
                </div>
                <img src="{{ url('storage/'.Auth::user()->inv->file) }}" alt="preview"
                     style="width:100%;height:220px;object-fit:cover">
            </div>
            @else
            <div class="d-flex align-items-center justify-content-center rounded-3"
                 style="height:180px;background:#f0f9f4;border:2px dashed #2d7a4f">
                <div class="text-center text-muted">
                    <i class="bx bx-image" style="font-size:2.5rem;color:#2d7a4f"></i>
                    <p class="mb-1 small">Belum ada foto undangan</p>
                    <a href="{{ route('menu.design') }}" class="btn btn-sm btn-creasik-primary">
                        <i class="bx bx-palette me-1"></i>Pilih Template
                    </a>
                </div>
            </div>
            @endif

            {{-- Template mismatch warning --}}
            @if (!in_array($data->template, (array)$template))
            <div class="alert alert-warning rounded-3 shadow-sm mt-2 mb-0 py-2 small">
                <i class="bx bx-error me-1"></i>
                Template <b>{{ Str::title($data->template) }}</b> tidak termasuk dalam paket kamu.
                <a href="{{ route('packages') }}" class="alert-link ms-1">Upgrade paket</a>
            </div>
            @endif
        </div>

        {{-- Right column --}}
        <div class="col-12 col-lg-5">
            <div class="d-flex flex-column gap-3 h-100">

                {{-- Package card --}}
                <div class="pack-card">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="pack-badge"><i class="bx bx-crown me-1"></i>Paket Aktif</span>
                        @if(!$isExpired)
                        <span class="badge bg-success-subtle text-success" style="font-size:.7rem">Aktif</span>
                        @else
                        <span class="badge bg-danger-subtle text-danger" style="font-size:.7rem">Kadaluwarsa</span>
                        @endif
                    </div>
                    <div class="pack-title mb-1">{{ $packTitle }}</div>
                    @if(!$isExpired)
                    <div class="text-muted small mb-2">
                        <i class="bx bx-calendar me-1"></i>
                        Aktif sampai
                        {{ Carbon::parse($activation)->locale('id')->addDays($active)
                            ->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}
                    </div>
                    @else
                    <div class="text-danger small mb-2">
                        <i class="bx bx-error-circle me-1"></i>Undangan kadaluwarsa
                    </div>
                    @endif
                    <a href="{{ route('packages') }}" class="btn btn-sm btn-creasik-primary w-100">
                        <i class="bx bx-chevrons-up me-1"></i>Upgrade Paket
                    </a>
                </div>

                {{-- Stats row --}}
                <div class="row g-2">
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="stat-icon" style="background:#e8f5ee">
                                    <i class="bx bx-check-circle" style="color:#2d7a4f"></i>
                                </div>
                                <span class="stat-label">Hadir</span>
                            </div>
                            <div class="stat-value text-success">{{ $statHadir }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="stat-icon" style="background:#fef2f2">
                                    <i class="bx bx-x-circle" style="color:#dc3545"></i>
                                </div>
                                <span class="stat-label">Tidak Hadir</span>
                            </div>
                            <div class="stat-value text-danger">{{ $statTidak }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="stat-icon" style="background:#fff8e1">
                                    <i class="bx bx-group" style="color:#d4af37"></i>
                                </div>
                                <span class="stat-label">Total Tamu</span>
                            </div>
                            <div class="stat-value" style="color:#d4af37">{{ $totalTamu }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div class="stat-icon" style="background:#f0f4ff">
                                    <i class="bx bx-message-dots" style="color:#4361ee"></i>
                                </div>
                                <span class="stat-label">Konfirmasi</span>
                            </div>
                            <div class="stat-value" style="color:#4361ee">{{ $statTotal }}</div>
                        </div>
                    </div>
                </div>

                {{-- Guestbook --}}
                <a href="{{ route('guestbook') }}"
                   class="guestbook-card {{ (Auth::user()->acc && Auth::user()->acc->guestbook==0) ? 'lock' : '' }}">
                    <img src="{{ url('images/icons/open-book_2702134.png') }}" alt="guestbook">
                    <div>
                        <div class="gb-title"><i class="bx bx-book-open me-1"></i>Buku Tamu</div>
                        <div class="gb-sub">{{ $totalTamu }} / {{ $limitTamuLabel }} tamu terdaftar</div>
                        @if($statTotal > 0)
                        <div class="mt-1" style="font-size:.72rem;color:#2d7a4f;font-weight:600">
                            <i class="bx bx-trending-up me-1"></i>{{ $statHadir }} konfirmasi hadir
                        </div>
                        @endif
                    </div>
                    <i class="bx bx-chevron-right ms-auto" style="color:#2d7a4f;font-size:1.3rem"></i>
                </a>

            </div>
        </div>
    </div>

    {{-- Quick Menu --}}
    <div class="mb-4">
        <div class="section-header">
            <h5>Menu Undangan</h5>
        </div>
        <div class="preset-menu-modern">
            @foreach ($menu as $item)
            @php
                $lock = [];
                if (in_array($item['id'], ['reservation', 'table-management', 'souvenir'])) {
                    if (Auth::user()->acc && Auth::user()->acc->guestbook==1) {
                        $lock[$item['id']] = false;
                    } else {
                        $lock[$item['id']] = true;
                        $item['url'] = 'packages';
                    }
                } else {
                    $lock[$item['id']] = false;
                }
                if (in_array($item['id'], array_keys($conditional))) {
                    $lock[$item['id']] = ($conditional[$item['id']]===false) ? true : false;
                    $item['url'] = ($conditional[$item['id']]===false) ? 'packages' : $item['url'];
                }
            @endphp
            <a href="{{ route($item['url']) }}"
               @class(['lock' => $lock[$item['id']]])
               style="border-radius:var(--cr-radius);background:#fff;padding:.9rem .5rem;text-align:center;text-decoration:none;border:1.5px solid #eee;transition:all .2s;display:flex;flex-direction:column;align-items:center;gap:.4rem;box-shadow:0 1px 6px rgba(0,0,0,.05)">
                <i class="{{ $item['icon'] }}" style="font-size:1.8rem;color:#2d7a4f"></i>
                <span style="font-size:.62rem;font-weight:700;color:#444;text-transform:uppercase;letter-spacing:.3px;line-height:1.2">{{ $item['title'] }}</span>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Template Undangan --}}
    <div class="mb-2">
        <div class="section-header">
            <h5>Template Undangan</h5>
            <a href="{{ route('menu.design') }}" class="btn btn-sm btn-creasik-primary">
                <i class="bx bx-palette me-1"></i>Ubah Desain
            </a>
        </div>

        @php
            $templateLimit = (array)($data->templateLimit ?? ['basic']);
            $gradeColors   = ['basic' => '#2d7a4f', 'premium' => '#d4af37', 'exclusive' => '#9b59b6'];
            $gradeLabels   = ['basic' => 'Basic', 'premium' => 'Premium', 'exclusive' => 'Exclusive'];
            $gradeIcons    = ['basic' => 'bx-star', 'premium' => 'bx-crown', 'exclusive' => 'bx-diamond'];
            $activeInvTemp = Auth::user()->inv?->temp;

            // CSS thumbnail styles per template slug
            $thumbStyles = [
                'the-wedding'        => ['bg'=>'linear-gradient(160deg,#8b6b4a 0%,#bf9b73 55%,#d4b896 100%)','color'=>'#fff','accent'=>'rgba(255,255,255,.5)','font'=>'Satisfy,serif'],
                'the-wedding-navy'   => ['bg'=>'linear-gradient(160deg,#0d1f35 0%,#1e3a5f 55%,#2d5a8e 100%)','color'=>'#c8d8e8','accent'=>'rgba(143,168,200,.6)','font'=>'Merriweather,serif'],
                'the-wedding-sage'   => ['bg'=>'linear-gradient(160deg,#2d4a3e 0%,#4a7c59 55%,#6b9e7a 100%)','color'=>'#e8f5ee','accent'=>'rgba(200,230,210,.6)','font'=>'Satisfy,serif'],
                'the-wedding-pink'   => ['bg'=>'linear-gradient(160deg,#8b6b6b 0%,#d4a5a5 55%,#f7d7d7 100%)','color'=>'#fff','accent'=>'rgba(255,255,255,.5)','font'=>'Satisfy,serif'],
                'the-wedding-purple' => ['bg'=>'linear-gradient(160deg,#3d1f6b 0%,#6b3fa0 55%,#9b6fc8 100%)','color'=>'#f5f0fa','accent'=>'rgba(201,168,224,.6)','font'=>'Satisfy,serif'],
                'modern-elegant'     => ['bg'=>'linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%)','color'=>'#e8d5b7','accent'=>'rgba(232,213,183,.5)','font'=>'Playfair Display,serif'],
                'minimalist-green'   => ['bg'=>'linear-gradient(135deg,#1b4332 0%,#2d6a4f 50%,#40916c 100%)','color'=>'#d8f3dc','accent'=>'rgba(216,243,220,.5)','font'=>'Lato,sans-serif'],
                'luxury-botanical'   => ['bg'=>'linear-gradient(135deg,#1c2b1a 0%,#2d4a2b 50%,#4a7c59 100%)','color'=>'#f0e6d3','accent'=>'rgba(212,175,55,.5)','font'=>'Cormorant Garamond,serif'],
                'romantic-garden'    => ['bg'=>'linear-gradient(135deg,#6b2d3e 0%,#a0405a 50%,#c8607a 100%)','color'=>'#fce4ec','accent'=>'rgba(252,228,236,.5)','font'=>'Dancing Script,cursive'],
                'tropical-paradise'  => ['bg'=>'linear-gradient(135deg,#0d4f3c 0%,#1a7a5e 50%,#2eb87a 100%)','color'=>'#e0f7fa','accent'=>'rgba(224,247,250,.5)','font'=>'Pacifico,cursive'],
                'vintage-rustic'     => ['bg'=>'linear-gradient(135deg,#5c3d2e 0%,#8b5e3c 50%,#b8845a 100%)','color'=>'#fdf6ec','accent'=>'rgba(253,246,236,.5)','font'=>'Playfair Display,serif'],
                'elegant-gold'       => ['bg'=>'linear-gradient(135deg,#1a1200 0%,#3d2b00 50%,#6b4c00 100%)','color'=>'#ffd700','accent'=>'rgba(255,215,0,.5)','font'=>'Cormorant Garamond,serif'],
                'islami-gold'        => ['bg'=>'linear-gradient(135deg,#1a2a1a 0%,#2d4a2b 50%,#4a7c59 100%)','color'=>'#d4af37','accent'=>'rgba(212,175,55,.5)','font'=>'Amiri,serif'],
                'blush-rose'         => ['bg'=>'linear-gradient(135deg,#7b2d3e 0%,#c4607a 50%,#e8a0b0 100%)','color'=>'#fff','accent'=>'rgba(255,255,255,.5)','font'=>'Dancing Script,cursive'],
                'white-elegance'     => ['bg'=>'linear-gradient(135deg,#2c2c2c 0%,#4a4a4a 50%,#6b6b6b 100%)','color'=>'#f5f5f5','accent'=>'rgba(245,245,245,.5)','font'=>'Cormorant Garamond,serif'],
            ];
            $defaultThumb = ['bg'=>'linear-gradient(135deg,#2d7a4f 0%,#3a9e65 100%)','color'=>'#fff','accent'=>'rgba(255,255,255,.5)','font'=>'serif'];
        @endphp

        @foreach (['basic', 'premium', 'exclusive'] as $grade)
        @php
            $gradeTemplates = $data->templates->$grade ?? collect();
            $isGradeAllowed = in_array($grade, $templateLimit);
        @endphp
        @if(count($gradeTemplates) > 0)
        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="grade-badge" style="background:{{ $gradeColors[$grade] }}1a;color:{{ $gradeColors[$grade] }};border:1.5px solid {{ $gradeColors[$grade] }}40">
                    <i class="bx {{ $gradeIcons[$grade] }}"></i>{{ $gradeLabels[$grade] }}
                </span>
                @if(!$isGradeAllowed)
                <span class="badge bg-secondary" style="font-size:.68rem">
                    <i class="bx bx-lock-alt me-1"></i>Perlu Upgrade
                </span>
                @endif
                <small class="text-muted">{{ count($gradeTemplates) }} template</small>
            </div>

            <div class="tpl-scroll">
                @foreach($gradeTemplates as $item)
                @php
                    $isActive = $activeInvTemp && $item->id == $activeInvTemp->id;
                    $isLocked = !$isGradeAllowed;
                    $ts       = $thumbStyles[$item->slug] ?? $defaultThumb;
                @endphp
                <div class="tpl-card {{ $isActive ? 'active-tpl' : '' }}">

                    {{-- CSS Thumbnail --}}
                    <div class="tpl-thumb" style="background:{{ $ts['bg'] }}">
                        @if($isActive)
                        <div class="tpl-active-badge"><i class="bx bx-check me-1"></i>Aktif</div>
                        @endif
                        @if($isLocked)
                        <div class="tpl-lock">
                            <i class="bx bx-lock-alt"></i>
                            <span>Upgrade</span>
                        </div>
                        @endif
                        <div class="tpl-photo" style="border-color:{{ $ts['accent'] }}">
                            <span style="color:{{ $ts['color'] }};font-size:1.3rem">&#128145;</span>
                        </div>
                        <div class="tpl-names" style="color:{{ $ts['color'] }};font-family:{{ $ts['font'] }}">
                            Nama &amp; Pasangan
                        </div>
                        <div class="tpl-divider" style="background:{{ $ts['accent'] }}"></div>
                        <div class="tpl-date" style="color:{{ $ts['color'] }}">
                            &#128197; 2025
                        </div>
                        <div class="tpl-btn">Buka Undangan</div>
                    </div>

                    {{-- Card info --}}
                    <div class="tpl-info">
                        <div class="tpl-title" title="{{ $item->title }}">{{ $item->title }}</div>
                        <div class="tpl-actions">
                            <a href="{{ route('preview-template.index', $item->slug) }}"
                               class="btn btn-outline-secondary" target="_blank">
                                <i class="bx bx-show"></i>
                            </a>
                            @if($isLocked)
                            <a href="{{ route('packages') }}" class="btn btn-warning flex-grow-1">
                                <i class="bx bx-crown me-1"></i>Upgrade
                            </a>
                            @elseif($isActive)
                            <button class="btn btn-success flex-grow-1" disabled>
                                <i class="bx bx-check-circle me-1"></i>Aktif
                            </button>
                            @else
                            @php
                                $invPreset = Auth::user()->inv?->preset ? json_decode(Auth::user()->inv->preset) : null;
                                $invDesign = $invPreset?->design ?? null;
                            @endphp
                            <form action="{{ route('save.setting', 'design') }}" class="save-menu flex-grow-1" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="design_template"          value="{{ $item->id }}">
                                <input type="hidden" name="design_title_color"       value="{{ $invDesign->title->color      ?? '#000000' }}">
                                <input type="hidden" name="design_content_color"     value="{{ $invDesign->content->color    ?? '#333333' }}">
                                <input type="hidden" name="design_background"        value="{{ $invDesign->background        ?? '#ffffff' }}">
                                <input type="hidden" name="design_button_background" value="{{ $invDesign->button->background ?? '#2d7a4f' }}">
                                <input type="hidden" name="design_button_color"      value="{{ $invDesign->button->color     ?? '#ffffff' }}">
                                <input type="hidden" name="design_title_font"        value="{{ $invDesign->title->font       ?? 'Arial' }}">
                                <input type="hidden" name="design_content_font"      value="{{ $invDesign->content->font     ?? 'Arial' }}">
                                <button type="submit" class="btn btn-creasik-primary w-100">
                                    <i class="bx bx-check me-1"></i>Gunakan
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>

</section>
@endsection

@push('script')
<script>
// ── Scale & setup iframe preview
(function () {
    const frame = document.getElementById('previewFrame');
    const wrap  = document.getElementById('previewWrap');
    if (!frame || !wrap) return;

    const TEMPLATE_W = 390;

    function doScale() {
        const wrapW = wrap.offsetWidth || 400;
        const scale = wrapW / TEMPLATE_W;
        const frameH = Math.ceil(320 / scale);
        frame.style.width     = TEMPLATE_W + 'px';
        frame.style.height    = frameH + 'px';
        frame.style.transform = 'scale(' + scale + ')';
        wrap.style.height     = '320px';
    }

    frame.addEventListener('load', function () {
        doScale();
        try {
            const doc = frame.contentDocument || frame.contentWindow.document;
            if (!doc) return;
            const s = doc.createElement('style');
            s.textContent = [
                '#cover,#cover-overlay,#opening-cover{display:none!important}',
                '#main,#main-content{display:block!important}',
                '*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important}',
                'html,body{overflow:hidden!important}',
                '.music-fab,#music-toggle{display:none!important}',
                '#bottom-nav{display:none!important}'
            ].join('');
            doc.head.appendChild(s);
            // Paksa tampilkan main
            ['main','main-content'].forEach(function(id) {
                const el = doc.getElementById(id);
                if (el) { el.style.display='block'; el.classList.add('on','visible'); }
            });
            // Klik tombol buka jika ada
            const btn = doc.getElementById('btnOpen') || doc.getElementById('open-invitation');
            if (btn) btn.click();
        } catch(e) {}
    });

    doScale();
    window.addEventListener('resize', doScale);
})();

// ── Countdown
if ($("#countdown").length > 0) {
    (function () {
        const second = 1000, minute = second * 60, hour = minute * 60, day = hour * 24;
        const thetime = document.getElementById('countdown').getAttribute('data-time');
        const countDown = new Date(thetime + "T09:00:00+07:00").getTime();
        const x = setInterval(function () {
            const distance = countDown - new Date().getTime();
            if (distance < 0) {
                document.getElementById("countdown").innerHTML = '<p class="text-muted small py-2">Acara telah selesai 🎉</p>';
                clearInterval(x);
                return;
            }
            document.getElementById("days").innerText    = Math.floor(distance / day);
            document.getElementById("hours").innerText   = Math.floor((distance % day) / hour);
            document.getElementById("minutes").innerText = Math.floor((distance % hour) / minute);
            document.getElementById("seconds").innerText = Math.floor((distance % minute) / second);
        }, 1000);
    }());
}

// ── Salin link undangan
const copyBtn = document.getElementById('copyLinkBtn');
if (copyBtn) {
    copyBtn.addEventListener('click', function () {
        navigator.clipboard.writeText(this.dataset.link).then(() => {
            const orig = this.innerHTML;
            this.innerHTML = '<i class="bx bx-check"></i> Tersalin!';
            this.classList.replace('btn-outline-secondary', 'btn-success');
            setTimeout(() => {
                this.innerHTML = orig;
                this.classList.replace('btn-success', 'btn-outline-secondary');
            }, 2000);
        });
    });
}
</script>
@endpush
