@extends('member.layouts.app')
@section('title', Str::title('dashboard'))
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
    <ul class="nav nav-pills creasik-nav-pill mb-3">
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

    <div class="row g-3 mb-3">

        {{-- ── Kolom Kiri: Undangan ── --}}
        <div class="col-12 col-lg-7">
            <div class="dashboard-summary bg-white shadow-sm rounded h-100">

                {{-- Nama pasangan --}}
                <h4 class="fw-bold">{{ $namaLengkap }}</h4>

                {{-- Link undangan --}}
                @if($data->subdomain)
                <h6 class="mb-2">
                    <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank" class="text-break">
                        <i class="bx bx-link-external me-1"></i>{{ route('invitation.index', $data->subdomain) }}
                    </a>
                </h6>
                @else
                <h6 class="text-muted mb-2">
                    <i class="bx bx-info-circle me-1"></i>Belum ada link undangan
                </h6>
                @endif

                {{-- Preview undangan — iframe template aktif --}}
                @if(Auth::user()->inv && Auth::user()->inv->temp)
                <div class="position-relative mb-2" style="border-radius:8px;overflow:hidden;border:1px solid #e0e0e0">
                    {{-- Label template aktif --}}
                    <div class="position-absolute top-0 start-0 m-2" style="z-index:2">
                        <span class="badge" style="background:#2d7a4f;font-size:.7rem">
                            <i class="bx bx-palette me-1"></i>{{ Auth::user()->inv->temp->title }}
                        </span>
                    </div>
                    {{-- Tombol buka fullscreen --}}
                    @if($data->subdomain)
                    <div class="position-absolute top-0 end-0 m-2" style="z-index:2">
                        <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank"
                           class="btn btn-sm btn-light shadow-sm" style="font-size:.75rem" title="Buka di tab baru">
                            <i class="bx bx-fullscreen"></i>
                        </a>
                    </div>
                    @endif
                    {{-- Wrapper iframe --}}
                    <div id="previewWrap" style="position:relative;height:320px;overflow:hidden;background:#f8faf9">
                        <iframe
                            id="previewFrame"
                            src="{{ route('member.preview') }}"
                            style="border:none;position:absolute;top:0;left:0;transform-origin:top left"
                            scrolling="no"
                            loading="lazy"
                            title="Preview Undangan">
                        </iframe>
                        {{-- Overlay klik — arahkan ke halaman undangan --}}
                        @if($data->subdomain)
                        <a href="{{ route('invitation.index', $data->subdomain) }}" target="_blank"
                           style="position:absolute;inset:0;z-index:1;cursor:pointer"
                           title="Klik untuk membuka undangan"></a>
                        @else
                        <div style="position:absolute;inset:0;z-index:1"></div>
                        @endif
                    </div>
                </div>
                @elseif(Auth::user()->inv && Auth::user()->inv->file)
                <div class="mb-2" style="max-height:220px;overflow:hidden;border-radius:8px">
                    <img src="{{ url('storage/'.Auth::user()->inv->file) }}" alt="preview undangan"
                         style="width:100%;height:220px;object-fit:cover">
                </div>
                @else
                <div class="d-flex align-items-center justify-content-center mb-2 rounded"
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

                {{-- Countdown --}}
                @if($data->date && !empty($data->date->date))
                <div id="countdown" class="countdown" data-time="{{ date('Y-m-d', strtotime($data->date->date)) }}">
                    <ul class="list-unstyled mb-0">
                        <li><b id="days">0</b><span>Hari</span></li>
                        <li><b id="hours">0</b><span>Jam</span></li>
                        <li><b id="minutes">0</b><span>Menit</span></li>
                        <li><b id="seconds">0</b><span>Detik</span></li>
                    </ul>
                </div>
                @else
                <div class="text-center py-2 text-muted small">
                    <i class="bx bx-calendar me-1"></i>
                    Tanggal pernikahan belum diatur —
                    <a href="{{ route('menu.detail') }}">atur sekarang</a>
                </div>
                @endif

                {{-- Tombol aksi --}}
                <div class="text-center py-2 d-flex justify-content-center gap-2 flex-wrap">
                    @if($data->subdomain)
                    <a href="{{ route('invitation.index', $data->subdomain) }}"
                       class="btn btn-sm btn-creasik-primary" target="_blank">
                        <i class="bx bx-link-external"></i> Tinjau
                    </a>
                    @endif
                    <a href="{{ route('menu.detail') }}" class="btn btn-sm btn-creasik-primary">
                        <i class="bx bx-edit"></i> Ubah Tanggal
                    </a>
                    @if($data->subdomain)
                    <button class="btn btn-sm btn-outline-secondary" id="copyLinkBtn"
                            data-link="{{ route('invitation.index', $data->subdomain) }}">
                        <i class="bx bx-copy"></i> Salin Link
                    </button>
                    @endif
                </div>
            </div>

            {{-- Peringatan template tidak sesuai paket --}}
            @if (!in_array($data->template, (array)$template))
            <div class="alert alert-warning rounded shadow-sm mt-2 mb-0 py-2">
                <i class="bx bx-error me-1"></i>
                Template <b>{{ Str::title($data->template) }}</b> tidak termasuk dalam paket kamu.
                <a href="{{ route('packages') }}" class="alert-link ms-1">Upgrade paket</a>
            </div>
            @endif
        </div>

        {{-- ── Kolom Kanan ── --}}
        <div class="col-12 col-lg-5">
            <div class="d-flex flex-column gap-3 h-100">

                {{-- Paket aktif --}}
                <div class="package-book bg-white shadow-sm rounded text-center p-3">
                    <div class="small text-muted mb-1">Paket</div>
                    <b class="text-creasik-primary d-block fs-5">{{ $packTitle }}</b>
                    @if(!$isExpired)
                    <span class="text-muted small">
                        Aktif sampai
                        {{ Carbon::parse($activation)->locale('id')->addDays($active)
                            ->settings(['formatFunction' => 'translatedFormat'])->format('j F Y') }}
                    </span>
                    @else
                    <span class="text-danger small"><i class="bx bx-error-circle me-1"></i>Undangan kadaluwarsa</span>
                    @endif
                    <a href="{{ route('packages') }}" class="btn btn-success btn-sm w-100 mt-2 text-uppercase">
                        <i class="bx bx-chevrons-up"></i> Upgrade
                    </a>
                </div>

                {{-- Statistik kehadiran --}}
                <div class="bg-white shadow-sm rounded p-3 {{ (Auth::user()->acc && Auth::user()->acc->guestbook==0) ? 'lock' : '' }}">
                    <h6 class="fw-bold mb-3">Statistik Kehadiran</h6>
                    <div class="d-flex align-items-center gap-3">
                        @if($statTotal > 0)
                        <div class="progress flex-shrink-0"
                             data-max="{{ $statTotal }}"
                             data-value="{{ $statHadir }}"></div>
                        @else
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                             style="width:70px;height:70px;border:3px solid #e0e0e0;color:#aaa;font-size:.75rem">
                            Belum ada
                        </div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small">Hadir</span>
                                <b class="text-success">{{ $statHadir }}</b>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small">Tidak hadir</span>
                                <b class="text-danger">{{ $statTidak }}</b>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="small text-muted">Total konfirmasi</span>
                                <b class="text-muted">{{ $statTotal }}</b>
                            </div>
                        </div>
                    </div>
                    @if($statTotal > 0)
                    <a href="{{ route('menu.presenting') }}" class="btn btn-sm btn-outline-secondary w-100 mt-2">
                        <i class="bx bx-list-check me-1"></i>Lihat Detail
                    </a>
                    @endif
                </div>

                {{-- Buku tamu --}}
                <div class="guest-book rounded p-2 {{ (Auth::user()->acc && Auth::user()->acc->guestbook==0) ? 'lock' : '' }}">
                    <a href="{{ route('guestbook') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                        <img src="{{ url('images/icons/open-book_2702134.png') }}" alt="guestbook" style="width:48px">
                        <div>
                            <span class="d-block fw-semibold">Buku Tamu</span>
                            <small class="text-muted">{{ $totalTamu }} / {{ $limitTamuLabel }} tamu</small>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="preset-menu grid-5">
        @foreach ($menu as $item)
        @php
        $lock = [];
        // lock by guestbook
        if (in_array($item['id'], ['reservation', 'table-management', 'souvenir'])) :
            if (Auth::user()->acc && Auth::user()->acc->guestbook==1) :
                $lock[$item['id']] = false;
                $item['url'] = $item['url'];
            elseif (Auth::user()->acc && Auth::user()->acc->guestbook==0) :
                $lock[$item['id']] = true;
                $item['url'] = 'packages';
            else:
                 // Default if acc is missing or guestbook status unknown
                $lock[$item['id']] = true;
                $item['url'] = 'packages';
            endif;
        else :
            $lock[$item['id']] = false;
        endif;
        // **

        // lock by package
        if (in_array($item['id'], array_keys($conditional))) :
            $lock[$item['id']] = ($conditional[$item['id']]===false) ? true : false;
            $item['url'] = ($conditional[$item['id']]===false) ? 'packages' : $item['url'];
        endif;
        // **
        @endphp
        <a href="{{ route($item['url']) }}" @class(['shadow-sm', 'rounded', 'p-3', 'lock' => $lock[$item['id']]])>
            <img src="{{ url('images/icons/'.$item['icon']) }}" alt="{{ $item['title'] }}">
            <span>{{ Str::upper($item['title']) }}</span>
        </a>
        @endforeach
    </div>

    {{-- ── Template Undangan ── --}}
    <div class="mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Template Undangan</h4>
            <a href="{{ route('menu.design') }}" class="btn btn-sm btn-creasik-primary">
                <i class="bx bx-palette me-1"></i>Ubah Desain
            </a>
        </div>

        @php
            $templateLimit = (array)($data->templateLimit ?? ['basic']);
            $gradeColors   = ['basic' => '#2d7a4f', 'premium' => '#d4af37', 'exclusive' => '#9b59b6'];
            $gradeLabels   = ['basic' => 'Basic', 'premium' => 'Premium', 'exclusive' => 'Exclusive'];
            $activeInvTemp = Auth::user()->inv?->temp;
        @endphp

        @foreach (['basic', 'premium', 'exclusive'] as $grade)
        @php
            $gradeTemplates = $data->templates->$grade ?? collect();
            $isGradeAllowed = in_array($grade, $templateLimit);
        @endphp
        @if(count($gradeTemplates) > 0)
        <div class="mb-4">
            {{-- Grade header --}}
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge px-3 py-1" style="background:{{ $gradeColors[$grade] }};font-size:.75rem">
                    {{ $gradeLabels[$grade] }}
                </span>
                @if(!$isGradeAllowed)
                <span class="badge bg-secondary" style="font-size:.7rem">
                    <i class="bx bx-lock-alt me-1"></i>Perlu Upgrade
                </span>
                @endif
                <small class="text-muted">{{ count($gradeTemplates) }} template</small>
            </div>

            {{-- Template cards --}}
            <div class="d-flex flex-nowrap overflow-auto pb-2" style="gap:12px">
                @foreach($gradeTemplates as $item)
                @php
                    $isActive  = $activeInvTemp && $item->id == $activeInvTemp->id;
                    $isLocked  = !$isGradeAllowed;
                    $imgSrc    = Str::startsWith($item->file ?? '', 'template/')
                        ? asset($item->file)
                        : url('storage/'.($item->file ?? ''));
                @endphp
                <div class="card border-0 flex-shrink-0 position-relative"
                     style="width:180px;box-shadow:{{ $isActive ? '0 0 0 3px #2d7a4f' : '0 2px 8px rgba(0,0,0,.1)' }}">

                    {{-- Thumbnail --}}
                    <div class="position-relative" style="height:130px;overflow:hidden;border-radius:8px 8px 0 0">
                        <img src="{{ $imgSrc }}" alt="{{ $item->title }}"
                             style="width:100%;height:100%;object-fit:cover">

                        {{-- Overlay badges --}}
                        @if($isActive)
                        <span class="position-absolute top-0 start-0 m-1 badge"
                              style="background:#2d7a4f;font-size:.65rem">
                            <i class="bx bx-check me-1"></i>Aktif
                        </span>
                        @endif
                        @if($isLocked)
                        <div class="position-absolute inset-0 d-flex align-items-center justify-content-center"
                             style="inset:0;background:rgba(0,0,0,.45);border-radius:8px 8px 0 0">
                            <div class="text-center text-white">
                                <i class="bx bx-lock-alt" style="font-size:1.8rem"></i>
                                <div style="font-size:.65rem">Upgrade</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Card body --}}
                    <div class="card-body p-2 text-center" style="background:#fff;border-radius:0 0 8px 8px">
                        <p class="mb-2 text-truncate small fw-semibold" title="{{ $item->title }}"
                           style="font-size:.8rem">{{ $item->title }}</p>

                        <div class="d-grid gap-1">
                            {{-- Tinjau --}}
                            <a href="{{ route('preview-template.index', $item->slug) }}"
                               class="btn btn-sm btn-outline-secondary" target="_blank"
                               style="font-size:.72rem;padding:.25rem .5rem">
                                <i class="bx bx-show"></i> Tinjau
                            </a>

                            @if($isLocked)
                            {{-- Upgrade --}}
                            <a href="{{ route('packages') }}"
                               class="btn btn-sm btn-warning" style="font-size:.72rem;padding:.25rem .5rem">
                                <i class="bx bx-crown"></i> Upgrade
                            </a>
                            @elseif($isActive)
                            {{-- Sudah aktif --}}
                            <button class="btn btn-sm btn-success" disabled
                                    style="font-size:.72rem;padding:.25rem .5rem">
                                <i class="bx bx-check-circle"></i> Digunakan
                            </button>
                            @else
                            {{-- Gunakan --}}
                            @php
                                $invPreset = Auth::user()->inv?->preset ? json_decode(Auth::user()->inv->preset) : null;
                                $invDesign = $invPreset?->design ?? null;
                            @endphp
                            <form action="{{ route('save.setting', 'design') }}" class="save-menu d-grid" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="design_template" value="{{ $item->id }}">
                                <input type="hidden" name="design_title_color"       value="{{ $invDesign->title->color      ?? '#000000' }}">
                                <input type="hidden" name="design_content_color"     value="{{ $invDesign->content->color    ?? '#333333' }}">
                                <input type="hidden" name="design_background"        value="{{ $invDesign->background        ?? '#ffffff' }}">
                                <input type="hidden" name="design_button_background" value="{{ $invDesign->button->background ?? '#2d7a4f' }}">
                                <input type="hidden" name="design_button_color"      value="{{ $invDesign->button->color     ?? '#ffffff' }}">
                                <input type="hidden" name="design_title_font"        value="{{ $invDesign->title->font       ?? 'Arial' }}">
                                <input type="hidden" name="design_content_font"      value="{{ $invDesign->content->font     ?? 'Arial' }}">
                                <button type="submit" class="btn btn-sm btn-creasik-primary"
                                        style="font-size:.72rem;padding:.25rem .5rem">
                                    <i class="bx bx-check"></i> Gunakan
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
