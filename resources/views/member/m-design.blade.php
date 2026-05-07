@extends('member.layouts.app')
@section('title', Str::title($menu['title']))
@section('content')
<section class="position-relative py-3">
    @include('member.layouts.component', ['content'=>'breadcrumb', 'menu'=>$menu])
    <form action="{{ route('save.setting', 'design') }}" class="save-menu" method="post">
        @csrf
        @method('put')
        <div class="row g-3">

            {{-- ── Pilih Template ── --}}
            <div class="col-12">
                <div class="bg-white shadow rounded p-3">
                    <h4>Desain</h4>
                    @php
                        // $data->limit setelah json_encode/decode bisa jadi array atau object
                        $limitArr = is_array($data->limit) ? $data->limit : (array)$data->limit;
                    @endphp
                    @if (in_array('basic', $limitArr))
                    <div class="d-flex template-category mb-2 basic">
                        <div class="template-list">
                            @forelse ($data->template->basic ?? [] as $item)
                            @php
                                $activeTemp = Auth::user()->inv?->temp;
                                $check = $activeTemp && ($item->id == $activeTemp->id);
                            @endphp
                            <figure>
                                @if ($check)
                                <span class="badge bg-warning">Saat ini</span>
                                @endif
                                <input type="radio" name="design_template" id="temp{{ $item->id }}" value="{{ $item->id }}" @checked($check)>
                                <label for="temp{{ $item->id }}" class="shadow-sm">
                                    <img src="{{ Str::startsWith($item->file ?? '', 'template/') ? asset($item->file) : url('storage/'.($item->file ?? '')) }}" alt="">
                                    <span>{{ $item->title }}</span>
                                </label>
                                <a href="{{ route('preview-template.index', $item->slug) }}" class="btn text-dark text-capitalize bg-white w-100 btn-sm my-1" target="_blank">pratinjau</a>
                            </figure>
                            @empty
                            <div class="empty m-2 py-5">Kosong</div>
                            @endforelse
                        </div>
                        <div class="template-label"><span>Basic</span></div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                    @if (in_array('premium', $limitArr))
                    <div class="d-flex template-category mb-2 premium">
                        <div class="template-list">
                            @forelse ($data->template->premium ?? [] as $item)
                            @php
                                $activeTemp = Auth::user()->inv?->temp;
                                $check = $activeTemp && ($item->id == $activeTemp->id);
                            @endphp
                            <figure>
                                @if ($check)
                                <span class="badge bg-warning">Saat ini</span>
                                @endif
                                <input type="radio" name="design_template" id="temp{{ $item->id }}" value="{{ $item->id }}" @checked($check)>
                                <label for="temp{{ $item->id }}" class="shadow-sm">
                                    <img src="{{ Str::startsWith($item->file ?? '', 'template/') ? asset($item->file) : url('storage/'.($item->file ?? '')) }}" alt="">
                                    <span>{{ $item->title }}</span>
                                </label>
                                <a href="{{ route('preview-template.index', $item->slug) }}" class="btn text-dark text-capitalize bg-white w-100 btn-sm my-1" target="_blank">pratinjau</a>
                            </figure>
                            @empty
                            <div class="empty m-2 py-5">Kosong</div>
                            @endforelse
                        </div>
                        <div class="template-label"><span>Premium</span></div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                    @if (in_array('exclusive', $limitArr))
                    <div class="d-flex template-category mb-2 exclusive">
                        <div class="template-list">
                            @forelse ($data->template->exclusive ?? [] as $item)
                            @php
                                $activeTemp = Auth::user()->inv?->temp;
                                $check = $activeTemp && ($item->id == $activeTemp->id);
                            @endphp
                            <figure>
                                @if ($check)
                                <span class="badge bg-warning">Saat ini</span>
                                @endif
                                <input type="radio" name="design_template" id="temp{{ $item->id }}" value="{{ $item->id }}" @checked($check)>
                                <label for="temp{{ $item->id }}" class="shadow-sm">
                                    <img src="{{ Str::startsWith($item->file ?? '', 'template/') ? asset($item->file) : url('storage/'.($item->file ?? '')) }}" alt="">
                                    <span>{{ $item->title }}</span>
                                </label>
                                <a href="{{ route('preview-template.index', $item->slug) }}" class="btn text-dark text-capitalize bg-white w-100 btn-sm my-1" target="_blank">pratinjau</a>
                            </figure>
                            @empty
                            <div class="empty m-2 py-5">Kosong</div>
                            @endforelse
                        </div>
                        <div class="template-label"><span>Exclusive</span></div>
                        <div class="clearfix"></div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- ── Warna Tema ── --}}
            <div class="col-lg-6">
                <div class="bg-white shadow rounded p-3">
                    <h4>Warna tema</h4>
                    <div class="select-tab border-bottom">
                        <div><var dir="design_title_color">Warna tema</var></div>
                        <div>
                            <label for="design_title_color">
                                <input type="color" name="design_title_color" id="design_title_color"
                                       value="{{ $data->preset->title->color ?? '#000000' }}">
                            </label>
                            <label for="design_content_color">
                                <input type="color" name="design_content_color" id="design_content_color"
                                       value="{{ $data->preset->content->color ?? '#333333' }}">
                            </label>
                        </div>
                    </div>
                    <div class="select-tab border-bottom">
                        <div><var dir="design_background">Warna latar</var></div>
                        <div>
                            <label for="design_background">
                                <input type="color" name="design_background" id="design_background"
                                       value="{{ $data->preset->background ?? '#ffffff' }}">
                            </label>
                        </div>
                    </div>
                    <div class="select-tab border-bottom">
                        <div><var dir="design_button_color">Warna tombol</var></div>
                        <div>
                            <label for="design_button_color">
                                <input type="color" name="design_button_color" id="design_button_color"
                                       value="{{ $data->preset->button->color ?? '#ffffff' }}">
                            </label>
                            <label for="design_btn_bg_color">
                                <input type="color" name="design_button_background" id="design_btn_bg_color"
                                       value="{{ $data->preset->button->background ?? '#2d7a4f' }}">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Font & Ukuran ── --}}
            <div class="col-lg-6">
                <div class="bg-white shadow rounded p-3">
                    <h4>Font</h4>
                    @php
                        // $data->font adalah array of objects setelah json_encode/decode
                        $fontItems   = (array)$data->font;
                        $titleFont   = $data->preset->title->font   ?? 'Arial';
                        $titleSize   = (int)($data->preset->title->size   ?? 24);
                        $titleColor  = $data->preset->title->color  ?? '#000000';
                        $contentFont = $data->preset->content->font ?? 'Arial';
                        $contentSize = (int)($data->preset->content->size ?? 14);
                        $contentColor= $data->preset->content->color?? '#333333';
                    @endphp

                    {{-- Font Judul --}}
                    <div class="select-tab border-bottom">
                        <div><var dir="design_title_font">Font judul</var></div>
                        <div>
                            <select name="design_title_font" id="design_title_font" class="form-select">
                                @foreach ($fontItems as $item)
                                @php
                                    $fContent = is_object($item) ? $item->content : $item['content'];
                                    $fTitle   = is_object($item) ? $item->title   : $item['title'];
                                @endphp
                                <option value="{{ $fContent }}" @selected($titleFont === $fContent)>{{ $fTitle }}</option>
                                @endforeach
                            </select>
                            <div id="preview_title_font" class="font-preview mt-2"
                                 style="font-family:'{{ $titleFont }}',serif;font-size:{{ $titleSize }}px;color:{{ $titleColor }}">
                                Judul Undangan
                            </div>
                        </div>
                    </div>

                    {{-- Ukuran Font Judul --}}
                    <div class="select-tab border-bottom">
                        <div>
                            <var dir="design_title_size">Ukuran judul: <b id="lbl_title_size">{{ $titleSize }}</b>px</var>
                        </div>
                        <div>
                            <input type="range" name="design_title_size" id="design_title_size"
                                   class="form-range" value="{{ $titleSize }}" min="12" max="72" step="2">
                        </div>
                    </div>

                    {{-- Font Konten --}}
                    <div class="select-tab border-bottom">
                        <div><var dir="design_content_font">Font deskripsi</var></div>
                        <div>
                            <select name="design_content_font" id="design_content_font" class="form-select">
                                @foreach ($fontItems as $item)
                                @php
                                    $fContent = is_object($item) ? $item->content : $item['content'];
                                    $fTitle   = is_object($item) ? $item->title   : $item['title'];
                                @endphp
                                <option value="{{ $fContent }}" @selected($contentFont === $fContent)>{{ $fTitle }}</option>
                                @endforeach
                            </select>
                            <div id="preview_content_font" class="font-preview mt-2"
                                 style="font-family:'{{ $contentFont }}',sans-serif;font-size:{{ $contentSize }}px;color:{{ $contentColor }}">
                                Teks deskripsi undangan
                            </div>
                        </div>
                    </div>

                    {{-- Ukuran Font Konten --}}
                    <div class="select-tab">
                        <div>
                            <var dir="design_content_size">Ukuran deskripsi: <b id="lbl_content_size">{{ $contentSize }}</b>px</var>
                        </div>
                        <div>
                            <input type="range" name="design_content_size" id="design_content_size"
                                   class="form-range" value="{{ $contentSize }}" min="10" max="32" step="1">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="save-button">
            <button type="submit">
                <i class="bx bx-save"></i>
                <span>simpan</span>
            </button>
        </div>
    </form>
</section>
@endsection

@push('style')
@php
    // Bangun URL Google Fonts — satu family per request agar tidak error
    $fontFamilies = [];
    foreach ((array)$data->font as $f) {
        $name = is_object($f) ? $f->content : $f['content'];
        $fontFamilies[] = 'family=' . str_replace(' ', '+', $name);
    }
    $googleFontsUrl = 'https://fonts.googleapis.com/css2?' . implode('&', $fontFamilies) . '&display=swap';
@endphp
<link href="{{ $googleFontsUrl }}" rel="stylesheet">
<style>
.font-preview {
    padding: .5rem .75rem;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: .375rem;
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .25s;
    word-break: break-word;
    line-height: 1.4;
}
</style>
@endpush

@push('script')
<script>
$(function() {
    // ── Load Google Font on demand (jika belum di-load)
    var loadedFonts = {};
    function loadFont(name) {
        if (!name || loadedFonts[name]) return;
        loadedFonts[name] = true;
        var link = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = 'https://fonts.googleapis.com/css2?family='
                  + encodeURIComponent(name.replace(/ /g, '+'))
                  + '&display=swap';
        document.head.appendChild(link);
    }

    // ── Preview font judul
    $('#design_title_font').on('change', function() {
        var font = $(this).val();
        loadFont(font);
        $('#preview_title_font').css('font-family', "'" + font + "', serif");
    });

    // ── Preview font konten
    $('#design_content_font').on('change', function() {
        var font = $(this).val();
        loadFont(font);
        $('#preview_content_font').css('font-family', "'" + font + "', sans-serif");
    });

    // ── Slider ukuran judul
    $('#design_title_size').on('input', function() {
        var sz = $(this).val();
        $('#lbl_title_size').text(sz);
        $('#preview_title_font').css('font-size', sz + 'px');
    });

    // ── Slider ukuran konten
    $('#design_content_size').on('input', function() {
        var sz = $(this).val();
        $('#lbl_content_size').text(sz);
        $('#preview_content_font').css('font-size', sz + 'px');
    });

    // ── Sinkronkan warna preview dengan color picker
    $('#design_title_color').on('input', function() {
        $('#preview_title_font').css('color', $(this).val());
    });
    $('#design_content_color').on('input', function() {
        $('#preview_content_font').css('color', $(this).val());
    });
});
</script>
@endpush
