@extends('member.layouts.app')
@section('title', Str::title($menu['title']))
@php
    $presetUrl   = $data->preset->url   ?? '';
    $presetTitle = $data->preset->title ?? '';
    $presetShow  = ($data->preset->show === true);
    $isExternal  = !empty($presetUrl) && filter_var($presetUrl, FILTER_VALIDATE_URL);
    $presetSrc   = $isExternal ? $presetUrl : (!empty($presetUrl) ? storage_url('audio/'.$presetUrl) : '');
    // Cek apakah file audio preset ada di storage (untuk format filename), untuk URL lama cukup cek tidak kosong
    $hasPreset   = $isExternal
        ? !empty($presetUrl)
        : (!empty($presetUrl) && \Illuminate\Support\Facades\Storage::disk('public')->exists('audio/'.$presetUrl));
@endphp
@section('content')
<section class="position-relative py-3">
    @include('member.layouts.component', ['content'=>'breadcrumb', 'menu'=>$menu])

    <div class="row g-3">

        {{-- ═══ KOLOM KIRI: Pengaturan & Simpan ═══ --}}
        <div class="col-lg-7">

            {{-- Form simpan pengaturan musik --}}
            <form action="{{ route('save.setting', 'music') }}" class="save-menu" method="post">
                @csrf
                @method('put')

                {{-- Toggle aktif/nonaktif --}}
                <div class="bg-white shadow rounded p-3 mb-2">
                    <div class="form-check form-switch d-flex flex-row-reverse justify-content-between ps-0 py-1">
                        <input class="form-check-input" type="checkbox"
                               name="music_show" id="music_show"
                               @checked($presetShow)>
                        <label class="form-check-label" for="music_show">
                            Aktifkan <b>musik latar</b> di undangan
                        </label>
                    </div>
                </div>

                {{-- Preview musik yang sedang dipilih --}}
                <div class="bg-white shadow rounded p-3 mb-2">
                    <h6 class="fw-semibold mb-3">
                        <i class="bx bx-music me-1 text-success"></i>
                        Musik yang dipilih
                    </h6>

                    <div class="current-music p-2 rounded bg-light mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-semibold text-truncate" id="current-title" style="max-width:220px">
                                {{ $presetTitle ?: '— Belum ada musik dipilih —' }}
                            </span>
                            @if($hasPreset)
                            <span class="badge bg-success-subtle text-success small">
                                <i class="bx bx-check-circle me-1"></i>Aktif
                            </span>
                            @endif
                        </div>

                        @if($hasPreset)
                        <audio id="current-audio"
                               src="{{ $presetSrc }}"
                               controls controlsList="nodownload noplaybackrate"
                               class="w-100" style="height:36px"></audio>
                        @else
                        <div class="text-muted small py-1" id="no-music-msg">
                            <i class="bx bx-info-circle me-1"></i>
                            Pilih musik dari daftar di sebelah kanan, lalu klik <b>Simpan</b>.
                        </div>
                        @endif

                        {{-- Hidden inputs yang dikirim ke server --}}
                        <input type="hidden" name="music_title" id="inp-music-title"
                               value="{{ $presetTitle }}">
                        <input type="hidden" name="music_url"   id="inp-music-url"
                               value="{{ $isExternal ? '' : $presetUrl }}">
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="bx bx-save me-1"></i>
                        <span>Simpan Pengaturan Musik</span>
                    </button>
                </div>
            </form>

        </div>{{-- /col-lg-7 --}}

        {{-- ═══ KOLOM KANAN: Daftar Musik & Upload ═══ --}}
        <div class="col-lg-5">

            {{-- Upload musik pribadi (hanya paket custom) --}}
            @if ($data->custom == 'custom')
            <div class="bg-white shadow rounded mb-2">
                <div class="accordion" id="accordionUpload">
                    <div class="accordion-item border-0">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseUpload">
                                <i class="bx bx-upload me-2 text-primary"></i>
                                Upload Musik Sendiri
                            </button>
                        </h2>
                        <div id="collapseUpload" class="accordion-collapse collapse">
                            <div class="accordion-body pt-0">
                                <form id="form-upload-music"
                                      action="{{ route('menu.music-add') }}"
                                      method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-2">
                                        <label class="form-label small fw-semibold">Judul Musik</label>
                                        <input type="text" name="music_title"
                                               class="form-control form-control-sm"
                                               placeholder="Contoh: Lagu Favorit Kami" required>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label small fw-semibold">File Musik (MP3)</label>
                                        <input type="file" name="music_file" id="file-input"
                                               class="form-control form-control-sm"
                                               accept="audio/mpeg,audio/mp3,.mp3" required>
                                        <div class="form-text">Format MP3, maks. 10 MB</div>
                                    </div>
                                    <div id="upload-preview" class="mb-2 d-none">
                                        <audio id="preview-audio" controls class="w-100"
                                               controlsList="nodownload" style="height:36px"></audio>
                                    </div>
                                    <button type="submit" id="btn-upload" class="btn btn-primary btn-sm w-100">
                                        <i class="bx bx-upload me-1"></i>
                                        <span>Unggah</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Musik pribadi yang sudah diupload --}}
                <div class="p-3 border-top">
                    @if ($data->my_music != null)
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="small fw-semibold text-muted">Musik Saya</span>
                        <form action="{{ route('menu.music-delete') }}" method="post" class="d-inline"
                              onsubmit="return confirm('Hapus musik ini?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm py-0 px-2">
                                <i class="bx bx-trash"></i>
                            </button>
                        </form>
                    </div>
                    <div class="music-item">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="small text-truncate fw-semibold" style="max-width:150px">
                                {{ $data->my_music->title }}
                            </span>
                            <button type="button" class="btn btn-sm btn-success btn-use-music"
                                    data-filename="{{ $data->my_music->content }}"
                                    data-title="{{ $data->my_music->title }}"
                                    @if($presetUrl === $data->my_music->content) disabled @endif>
                                {{ $presetUrl === $data->my_music->content ? '✓ Digunakan' : 'Gunakan' }}
                            </button>
                        </div>
                        @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('audio/'.$data->my_music->content))
                        <audio src="{{ storage_url('audio/'.$data->my_music->content) }}"
                               controls controlsList="nodownload noplaybackrate"
                               class="w-100" style="height:36px"></audio>
                        @else
                        <small class="text-danger">
                            <i class="bx bx-error-circle me-1"></i>File tidak ditemukan.
                        </small>
                        @endif
                    </div>
                    @else
                    <div class="text-center text-muted small py-2">
                        <i class="bx bx-music d-block fs-4 mb-1"></i>
                        Belum ada musik pribadi
                    </div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Daftar musik dari admin --}}
            <div class="bg-white shadow rounded p-3">
                <h6 class="fw-semibold mb-3">
                    <i class="bx bx-library me-1 text-primary"></i>
                    Pilih Musik
                </h6>

                @forelse ($data->music as $item)
                <div class="music-item border-bottom pb-2 mb-2">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <span class="small fw-semibold text-truncate" style="max-width:150px">
                            {{ $item->title }}
                        </span>
                        <button type="button" class="btn btn-sm btn-success btn-use-music"
                                data-filename="{{ $item->content }}"
                                data-title="{{ $item->title }}"
                                @if($presetUrl === $item->content) disabled @endif>
                            {{ $presetUrl === $item->content ? '✓ Digunakan' : 'Gunakan' }}
                        </button>
                    </div>
                    @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('audio/'.$item->content))
                    <audio src="{{ storage_url('audio/'.$item->content) }}"
                           controls controlsList="nodownload noplaybackrate"
                           class="w-100" style="height:36px"></audio>
                    @else
                    <small class="text-muted">
                        <i class="bx bx-error-circle me-1"></i>File tidak tersedia.
                    </small>
                    @endif
                </div>
                @empty
                <div class="text-center text-muted py-3">
                    <i class="bx bx-music d-block fs-3 mb-1"></i>
                    <small>Belum ada musik tersedia dari admin</small>
                </div>
                @endforelse
            </div>

        </div>{{-- /col-lg-5 --}}
    </div>
</section>
@endsection

@push('style')
<style>
.music-item audio { border-radius: 6px; }
</style>
@endpush

@push('script')
<script>
(function ($) {
    // ── Tombol "Gunakan": pilih musik dari daftar
    $(document).on('click', '.btn-use-music', function () {
        var $btn      = $(this);
        var filename  = $btn.data('filename');   // nama file saja, e.g. "abc123.mp3"
        var title     = $btn.data('title');
        var audioSrc  = $btn.closest('.music-item').find('audio').attr('src') || '';

        // Update hidden inputs (dikirim saat form disimpan)
        $('#inp-music-title').val(title);
        $('#inp-music-url').val(filename);

        // Update tampilan preview di kolom kiri
        $('#current-title').text(title);
        $('#no-music-msg').remove();

        var $curAudio = $('#current-audio');
        if ($curAudio.length) {
            $curAudio.attr('src', audioSrc);
        } else {
            $('.current-music').append(
                '<audio id="current-audio" src="' + audioSrc + '" controls ' +
                'controlsList="nodownload noplaybackrate" class="w-100" style="height:36px"></audio>'
            );
        }

        // Reset semua tombol, tandai yang dipilih
        $('.btn-use-music').prop('disabled', false).text('Gunakan');
        $btn.prop('disabled', true).text('✓ Digunakan');

        // Hentikan semua audio yang sedang diputar
        document.querySelectorAll('audio').forEach(function (a) {
            if (!a.paused) a.pause();
        });
    });

    // ── Preview file sebelum upload
    $('#file-input').on('change', function () {
        var file = this.files[0];
        if (!file) return;
        var url = URL.createObjectURL(file);
        $('#preview-audio').attr('src', url);
        $('#upload-preview').removeClass('d-none');
    });

    // ── Upload musik via AJAX (agar tidak reload halaman)
    $('#form-upload-music').on('submit', function (e) {
        e.preventDefault();
        var $btn  = $('#btn-upload');
        var $form = $(this);

        $btn.prop('disabled', true)
            .html('<i class="bx bx-loader-alt bx-spin me-1"></i><span>Mengunggah...</span>');

        $.ajax({
            url        : $form.attr('action'),
            type       : 'POST',
            data       : new FormData($form[0]),
            processData: false,
            contentType: false,
            success: function (res) {
                $btn.prop('disabled', false)
                    .html('<i class="bx bx-upload me-1"></i><span>Unggah</span>');
                // Reload agar musik baru muncul di daftar
                location.reload();
            },
            error: function (xhr) {
                $btn.prop('disabled', false)
                    .html('<i class="bx bx-upload me-1"></i><span>Unggah</span>');
                var msg = 'Gagal mengunggah.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg = Object.values(xhr.responseJSON.errors).flat().join('\n');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                alert(msg);
            }
        });
    });

})(jQuery);
</script>
@endpush
