@extends('member.layouts.app')
@section('title', Str::title($menu['title']))
@section('content')
<section class="position-relative py-3">
    @include('member.layouts.component', ['content'=>'breadcrumb', 'menu'=>$menu])
    <div class="row g-3">
        <div class="col-12">
            <div class="bg-white shadow rounded p-3 mb-2">
                <h5 class="mb-1"><i class="bx bx-link me-1 text-primary"></i> Link Undangan</h5>
                <p class="text-muted small mb-2">Bagikan link ini kepada tamu undangan Anda.</p>
                @php
                    $invSlug = Auth::user()->inv->slug ?? '';
                    $baseLink = $invSlug ? route('invitation.index', $invSlug) : '#';
                    $publishStatus = Auth::user()->inv->publish ?? 'draft';
                    $coupleName = implode(' & ', json_decode(Auth::user()->inv->title ?? '[]', true) ?? ['-', '-']);
                @endphp
                @if($publishStatus !== 'publish')
                <div class="alert alert-warning py-2 small mb-2">
                    <i class="bx bx-error me-1"></i>
                    Undangan belum dipublikasikan. Link sudah bisa dibagikan untuk preview, tapi tamu hanya bisa melihat setelah Anda
                    <a href="{{ route('menu.einvitation') }}" class="fw-bold">publish undangan</a>.
                </div>
                @endif
                <div class="input-group">
                    <input type="text" id="share_link" class="form-control border-end-0"
                           value="{{ $baseLink }}" readonly>
                    <span class="input-group-text bg-white border-start-0 copy-text"
                          data-text="{{ $baseLink }}" style="cursor:pointer">
                        <i class="bx bx-copy"></i>
                        <span style="display:none">Disalin</span>
                    </span>
                </div>
                <div class="mt-2 d-flex gap-2 flex-wrap">
                    <a href="{{ $baseLink }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bx bx-link-external me-1"></i> Buka Link
                    </a>
                    <a href="https://wa.me/?text={{ urlencode('Anda diundang ke pernikahan kami 💍 Buka undangan di: '.$baseLink) }}"
                       target="_blank" class="btn btn-sm btn-success">
                        <i class="bx bxl-whatsapp me-1"></i> Bagikan via WhatsApp
                    </a>
                </div>

                <hr class="my-3">
                <h6 class="mb-2"><i class="bx bxl-whatsapp me-1 text-success"></i> Smart WhatsApp</h6>
                <p class="text-muted small mb-2">Ketik nama penerima, sistem akan membuat pesan WhatsApp lengkap + link personal.</p>
                <div class="row g-2">
                    <div class="col-md-7">
                        <label for="wa_guest_name" class="form-label small">Nama Penerima</label>
                        <input type="text" id="wa_guest_name" class="form-control form-control-sm"
                               placeholder="Contoh: Ust. Mu'atok Bil Kahfi, S.Pd.">
                    </div>
                    <div class="col-md-5">
                        <label for="wa_salutation" class="form-label small">Sapaan</label>
                        <input type="text" id="wa_salutation" class="form-control form-control-sm" value="Yth."
                               placeholder="Yth.">
                    </div>
                </div>
                <div class="mt-2">
                    <label for="wa_message_preview" class="form-label small">Preview Pesan</label>
                    <textarea id="wa_message_preview" class="form-control form-control-sm" rows="10" readonly></textarea>
                </div>
                <div class="mt-2 d-flex gap-2 flex-wrap">
                    <a id="wa_share_btn" href="#" target="_blank" class="btn btn-sm btn-success disabled" aria-disabled="true">
                        <i class="bx bxl-whatsapp me-1"></i> Bagikan via WhatsApp
                    </a>
                    <button type="button" id="wa_copy_message" class="btn btn-sm btn-outline-primary" disabled>
                        <i class="bx bx-copy me-1"></i> Salin Pesan
                    </button>
                    <button type="button" id="wa_copy_link" class="btn btn-sm btn-outline-secondary" disabled>
                        <i class="bx bx-link me-1"></i> Salin Link Detail
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="bg-white shadow rounded p-3 mb-2">
                <h6 class="mb-2"><i class="bx bx-user-plus me-1"></i> Tambah Link Personal Tamu</h6>
                <p class="text-muted small mb-2">Buat link khusus per tamu agar nama tamu tampil di undangan.</p>
                <form action="{{ route('menu.share-add') }}" method="post" class="add-guest">
                    @csrf
                    <div class="mb-2">
                        <var dir="share_guest_type"></var>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="share_guest_type" id="share_guest_type_1" value="personal" @checked(true)>
                                <label class="form-check-label small" for="share_guest_type_1">Individu</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="share_guest_type" id="share_guest_type_2" value="group">
                                <label class="form-check-label small" for="share_guest_type_2">Grup</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="share_guest_type" id="share_guest_type_3" value="private">
                                <label class="form-check-label small" for="share_guest_type_3">Privasi</label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label for="share_guest_name" class="form-label small">
                                <var dir="share_guest_name">Nama Tamu</var>
                            </label>
                            <input type="text" name="share_guest_name" id="share_guest_name"
                                   class="form-control form-control-sm" placeholder="Nama lengkap tamu">
                        </div>
                        <div class="col-md-6">
                            <label for="share_guest_location" class="form-label small">
                                <var dir="share_guest_location">Lokasi / Kota</var>
                            </label>
                            <input type="text" name="share_guest_location" id="share_guest_location"
                                   class="form-control form-control-sm" placeholder="Kota / lokasi tamu">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-creasik-primary btn-sm w-100">
                        <i class="bx bxs-plus-circle me-1"></i> Tambah Tamu
                    </button>
                </form>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="bg-white shadow rounded p-3">
                <h6 class="mb-2"><i class="bx bx-list-ul me-1"></i> Daftar Tamu ({{ count($data->guest) }})</h6>
                @forelse ($data->guest as $item)
                @php
                    $guestData = json_decode($item->name);
                    $guestLink = $baseLink . '?to=' . $item->slug;
                @endphp
                <div class="guest-item bg-light rounded p-2 mb-1">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div class="flex-grow-1 min-w-0">
                            <div class="fw-semibold small text-truncate">{{ $guestData->name ?? '-' }}</div>
                            <div class="text-muted" style="font-size:.72rem">
                                <i class="bx bx-map-pin me-1"></i>{{ $guestData->location ?? '-' }}
                                <span class="badge bg-warning ms-1" style="font-size:.65rem">{{ Str::title($item->type) }}</span>
                            </div>
                            <div class="text-primary mt-1" style="font-size:.7rem;word-break:break-all">
                                {{ $guestLink }}
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-1 flex-shrink-0">
                            <button type="button" class="btn btn-sm btn-outline-primary copy-text p-1"
                                    data-text="{{ $guestLink }}" title="Salin link">
                                <i class="bx bx-copy" style="font-size:.9rem"></i>
                                <span style="display:none"></span>
                            </button>
                            <a href="https://wa.me/?text={{ urlencode('Kepada Yth. '.($guestData->name ?? 'Tamu').' 🎊 Anda diundang! Buka undangan: '.$guestLink) }}"
                               target="_blank" class="btn btn-sm btn-outline-success p-1" title="Kirim via WhatsApp">
                                <i class="bx bxl-whatsapp" style="font-size:.9rem"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-3 small">
                    <i class="bx bx-user-x d-block fs-3 mb-1"></i>
                    Belum ada tamu. Tambahkan tamu di sebelah kiri.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@push('style')
@endpush

@push('script')
<script>
$(function() {
    const baseLink = @json($baseLink);
    const coupleName = @json($coupleName);

    function buildDetailLink(guestName) {
        if (!baseLink || baseLink === '#') return '#';
        const separator = baseLink.includes('?') ? '&' : '?';
        return baseLink + separator + 'nama=' + encodeURIComponent(guestName);
    }

    function buildWaMessage(salutation, guestName, detailLink) {
        const sal = (salutation || '').toString().trim();
        const greet = (sal ? (sal + ' ') : '') + guestName.trim();
        return (
            greet + "\n\n" +
            "Assalamualikum Wr. Wb\n\n" +
            "Dengan memohon Rahmat Dan Ridho Allah SWT, Dan tanpa mengurangi rasa hormat kami. melalui media sosial ini, kami *" + coupleName + "*\n" +
            "mengundang Bapak/Ibu/Sdr/i untuk berkenan hadir di acara pernikahan kami.\n\n" +
            "*Detail Acara:*\n" +
            detailLink + "\n\n" +
            "Merupakan suatu kehormatan dan kebahagiaan jika Anda bersedia hadir dan turut memberikan doa restu untuk kami\n\n" +
            "Terimakasih kami sampaikan Bapak/Ibu/Sdr/i.\n\n" +
            "Wassalamualaikum Wr.Wb\n" +
            " *" + coupleName + "*"
        );
    }

    function setDisabled(el, disabled) {
        if (!el) return;
        el.prop('disabled', !!disabled);
    }

    function setLinkDisabled($el, disabled) {
        if (!$el || !$el.length) return;
        if (disabled) {
            $el.addClass('disabled').attr('aria-disabled', 'true');
        } else {
            $el.removeClass('disabled').attr('aria-disabled', 'false');
        }
    }

    async function copyToClipboard(text) {
        if (!text) return false;
        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(text);
                return true;
            }
        } catch (e) {}

        // Fallback (HTTP / older browser)
        const $tmp = $('<textarea readonly style="position:absolute;left:-9999px;top:-9999px"></textarea>').val(text);
        $('body').append($tmp);
        $tmp[0].select();
        try {
            document.execCommand('copy');
            $tmp.remove();
            return true;
        } catch (e) {
            $tmp.remove();
            return false;
        }
    }

    function refreshSmartWa() {
        const guestName = ($('#wa_guest_name').val() || '').toString().trim();
        const salutation = ($('#wa_salutation').val() || '').toString();
        const $shareBtn = $('#wa_share_btn');
        const $copyMsg = $('#wa_copy_message');
        const $copyLink = $('#wa_copy_link');
        const $preview = $('#wa_message_preview');

        if (!guestName || baseLink === '#') {
            $preview.val('');
            $shareBtn.attr('href', '#');
            setLinkDisabled($shareBtn, true);
            setDisabled($copyMsg, true);
            setDisabled($copyLink, true);
            return;
        }

        const detailLink = buildDetailLink(guestName);
        const message = buildWaMessage(salutation, guestName, detailLink);
        $preview.val(message);

        const waUrl = 'https://wa.me/?text=' + encodeURIComponent(message);
        $shareBtn.attr('href', waUrl);
        setLinkDisabled($shareBtn, false);
        setDisabled($copyMsg, false);
        setDisabled($copyLink, false);

        $copyMsg.off('click.smartwa').on('click.smartwa', function() {
            copyToClipboard(message);
        });
        $copyLink.off('click.smartwa').on('click.smartwa', function() {
            copyToClipboard(detailLink);
        });
    }

    $('#wa_guest_name, #wa_salutation').on('input', refreshSmartWa);
    refreshSmartWa();

    $(".add-guest").on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var submit = form.find('button[type=submit]');
        $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: form.serialize(),
            error: function(q) {
                submit.children('span').text('Coba Lagi');
                submit.prop('disabled', false);
                if (q.responseJSON && q.responseJSON.errors) {
                    $.each(q.responseJSON.errors, function(index, value) {
                        $('var[dir=' + index + ']').after('<sup role="alert" title="' + value + '">!</sup>');
                    });
                }
            },
            beforeSend: function() {
                $("sup[role=alert]").remove();
                submit.children('span').text('Menyimpan...');
                submit.prop('disabled', true);
            },
            success: function() {
                window.location.reload();
            }
        });
    });
});
</script>
@endpush
