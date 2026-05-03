@extends('panel.layouts.app')
@section('title', 'Harga Template')
@section('content')
<div class="container">

    {{-- Header --}}
    <div class="row mt-3 mb-3 align-items-center">
        <div class="col">
            <h5 class="mb-0 fw-semibold">
                <i class="bx bx-purchase-tag-alt me-1 text-primary"></i>
                Pengaturan Harga Template
            </h5>
            <small class="text-muted">Atur harga dan grade untuk setiap template undangan</small>
        </div>
        <div class="col-auto d-flex gap-2">
            <button class="btn btn-primary btn-sm" id="btnSaveAll">
                <i class="bx bx-save me-1"></i> Simpan Semua
            </button>
            <a href="{{ route('template.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bx bx-list-ul me-1"></i> Daftar Template
            </a>
        </div>
    </div>

    {{-- Grade Summary Cards --}}
    <div class="row g-3 mb-4">
        @foreach($gradeMeta as $gradeKey => $meta)
        @php $count = isset($templates[$gradeKey]) ? $templates[$gradeKey]->count() : 0; @endphp
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-label-{{ $meta['color'] }}"
                             style="width:42px;height:42px;flex-shrink:0">
                            <i class="bx {{ $meta['icon'] }} text-{{ $meta['color'] }} fs-5"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $meta['label'] }}</h6>
                            <small class="text-muted">{{ $count }} template</small>
                        </div>
                    </div>
                    <p class="text-muted small mb-3">{{ $meta['desc'] }}</p>
                    {{-- Bulk price setter --}}
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control bulk-price-input"
                               id="bulk_{{ $gradeKey }}" min="0" step="1000"
                               placeholder="Harga seragam..."
                               data-grade="{{ $gradeKey }}">
                        <button class="btn btn-outline-{{ $meta['color'] }} btn-bulk-apply"
                                data-grade="{{ $gradeKey }}"
                                title="Terapkan ke semua {{ $meta['label'] }}">
                            <i class="bx bx-check-double"></i>
                        </button>
                    </div>
                    <small class="text-muted d-block mt-1">
                        <i class="bx bx-info-circle me-1"></i>
                        Isi & klik ✓ untuk terapkan ke semua template {{ $meta['label'] }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Template Tables per Grade --}}
    @foreach($gradeMeta as $gradeKey => $meta)
    <div class="card border-0 shadow-sm mb-4" id="section-{{ $gradeKey }}">
        <div class="card-header border-0 py-2 px-3 d-flex align-items-center gap-2">
            <span class="badge bg-{{ $meta['color'] }} rounded-pill">{{ $meta['label'] }}</span>
            <span class="fw-semibold">Template {{ $meta['label'] }}</span>
            <span class="badge bg-light text-dark ms-auto">
                {{ isset($templates[$gradeKey]) ? $templates[$gradeKey]->count() : 0 }} template
            </span>
        </div>
        <div class="card-body p-0">
            @if(isset($templates[$gradeKey]) && $templates[$gradeKey]->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3" style="width:50px">#</th>
                            <th>Template</th>
                            <th style="width:130px">Grade</th>
                            <th style="width:200px">Harga (Rp)</th>
                            <th style="width:100px">Status</th>
                            <th style="width:80px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($templates[$gradeKey] as $i => $tpl)
                        <tr data-id="{{ $tpl->id }}" class="template-row">
                            <td class="ps-3 text-muted small">{{ $i + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($tpl->file)
                                    <img src="{{ Str::startsWith($tpl->file, 'template/') ? asset($tpl->file) : url('storage/'.$tpl->file) }}"
                                         alt="{{ $tpl->title }}"
                                         class="rounded" style="width:40px;height:40px;object-fit:cover;flex-shrink:0">
                                    @else
                                    <div class="rounded bg-light d-flex align-items-center justify-content-center"
                                         style="width:40px;height:40px;flex-shrink:0">
                                        <i class="bx bx-image text-muted"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <div class="fw-semibold small">{{ $tpl->title }}</div>
                                        <small class="text-muted">{{ $tpl->slug }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <select class="form-select form-select-sm grade-select"
                                        data-id="{{ $tpl->id }}" style="min-width:110px">
                                    @foreach($gradeMeta as $gk => $gm)
                                    <option value="{{ $gk }}" {{ $tpl->grade === $gk ? 'selected' : '' }}>
                                        {{ $gm['label'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number"
                                           class="form-control price-input"
                                           data-id="{{ $tpl->id }}"
                                           value="{{ $tpl->price ?? 0 }}"
                                           min="0" step="1000"
                                           placeholder="0">
                                </div>
                                <small class="text-muted price-display">
                                    {{ number_format($tpl->price ?? 0, 0, ',', '.') }}
                                </small>
                            </td>
                            <td>
                                @if($tpl->publish === 'publish')
                                <span class="badge bg-success">Publish</span>
                                @else
                                <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary btn-save-single"
                                        data-id="{{ $tpl->id }}"
                                        title="Simpan template ini">
                                    <i class="bx bx-save"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-4 text-muted">
                <i class="bx bx-layer fs-2 d-block mb-2 opacity-50"></i>
                <small>Belum ada template grade {{ $meta['label'] }}</small>
            </div>
            @endif
        </div>
    </div>
    @endforeach

    {{-- Floating save bar --}}
    <div id="saveBar" class="d-none position-fixed bottom-0 start-0 end-0 bg-white border-top shadow-lg py-2 px-4 d-flex align-items-center justify-content-between"
         style="z-index:1050">
        <span class="text-muted small">
            <i class="bx bx-edit-alt me-1 text-warning"></i>
            Ada perubahan yang belum disimpan
        </span>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary" id="btnDiscardChanges">Batalkan</button>
            <button class="btn btn-sm btn-primary" id="btnSaveBar">
                <i class="bx bx-save me-1"></i> Simpan Semua Perubahan
            </button>
        </div>
    </div>

</div>
@endsection

@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.template-row.changed { background-color: rgba(255, 193, 7, 0.06); }
.template-row.saved   { background-color: rgba(25, 135, 84, 0.06); }
.price-display { display:block; margin-top:2px; font-size:.7rem; }
</style>
@endpush

@push('script')
<script>
(function () {
    var CSRF   = document.querySelector('meta[name="csrf-token"]').content;
    var UPDATE = '{{ route("template.pricing.update") }}';
    var BULK   = '{{ route("template.pricing.bulk") }}';
    var changed = {};   // { id: { id, price, grade } }

    // ── Format angka saat input berubah ──────────────────────────────
    document.querySelectorAll('.price-input').forEach(function (inp) {
        inp.addEventListener('input', function () {
            var id  = this.dataset.id;
            var row = this.closest('tr');
            var disp = row.querySelector('.price-display');
            var val  = parseInt(this.value) || 0;
            disp.textContent = val.toLocaleString('id-ID');
            markChanged(id, row);
        });
    });

    document.querySelectorAll('.grade-select').forEach(function (sel) {
        sel.addEventListener('change', function () {
            var id  = this.dataset.id;
            var row = this.closest('tr');
            markChanged(id, row);
        });
    });

    function markChanged(id, row) {
        var priceInp = row.querySelector('.price-input');
        var gradeInp = row.querySelector('.grade-select');
        changed[id] = {
            id:    parseInt(id),
            price: parseInt(priceInp.value) || 0,
            grade: gradeInp.value,
        };
        row.classList.add('changed');
        row.classList.remove('saved');
        showSaveBar();
    }

    function showSaveBar() {
        var bar = document.getElementById('saveBar');
        if (Object.keys(changed).length > 0) {
            bar.classList.remove('d-none');
            bar.classList.add('d-flex');
        } else {
            bar.classList.add('d-none');
            bar.classList.remove('d-flex');
        }
    }

    // ── Simpan satu template ─────────────────────────────────────────
    document.querySelectorAll('.btn-save-single').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var id  = this.dataset.id;
            var row = this.closest('tr');
            var priceInp = row.querySelector('.price-input');
            var gradeInp = row.querySelector('.grade-select');
            saveBatch([{
                id:    parseInt(id),
                price: parseInt(priceInp.value) || 0,
                grade: gradeInp.value,
            }], function () {
                delete changed[id];
                row.classList.remove('changed');
                row.classList.add('saved');
                showSaveBar();
            });
        });
    });

    // ── Simpan semua ─────────────────────────────────────────────────
    function saveAll() {
        var updates = Object.values(changed);
        if (updates.length === 0) {
            showToast('info', 'Tidak ada perubahan', 'Semua data sudah tersimpan.');
            return;
        }
        saveBatch(updates, function () {
            document.querySelectorAll('.template-row.changed').forEach(function (r) {
                r.classList.remove('changed');
                r.classList.add('saved');
            });
            changed = {};
            showSaveBar();
        });
    }

    document.getElementById('btnSaveAll').addEventListener('click', saveAll);
    document.getElementById('btnSaveBar').addEventListener('click', saveAll);

    document.getElementById('btnDiscardChanges').addEventListener('click', function () {
        location.reload();
    });

    function saveBatch(updates, onSuccess) {
        fetch(UPDATE, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ updates: updates }),
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {
            if (data.toast) showToast(data.toast.icon, data.toast.title, data.toast.html);
            if (onSuccess) onSuccess();
        })
        .catch(function () {
            showToast('error', 'Gagal', 'Terjadi kesalahan. Coba lagi.');
        });
    }

    // ── Bulk apply per grade ─────────────────────────────────────────
    document.querySelectorAll('.btn-bulk-apply').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var grade = this.dataset.grade;
            var inp   = document.getElementById('bulk_' + grade);
            var price = parseInt(inp.value);
            if (isNaN(price) || price < 0) {
                showToast('warning', 'Perhatian', 'Masukkan harga yang valid.');
                return;
            }
            if (!confirm('Terapkan harga Rp ' + price.toLocaleString('id-ID') + ' ke semua template ' + grade.toUpperCase() + '?')) return;

            fetch(BULK, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ grade: grade, price: price }),
            })
            .then(function (r) { return r.json(); })
            .then(function (data) {
                if (data.toast) showToast(data.toast.icon, data.toast.title, data.toast.html);
                if (data.redirect && data.redirect.type === 'reload') {
                    setTimeout(function () { location.reload(); }, 1200);
                }
            })
            .catch(function () {
                showToast('error', 'Gagal', 'Terjadi kesalahan.');
            });
        });
    });

    // ── Toast helper (pakai SweetAlert2 jika ada, fallback alert) ────
    function showToast(icon, title, html) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true, position: 'top-end', showConfirmButton: false,
                timer: 3000, timerProgressBar: true,
                icon: icon, title: title, html: html,
            });
        } else {
            alert(title + ': ' + html.replace(/<[^>]+>/g, ''));
        }
    }

    // ── Format harga saat halaman load ───────────────────────────────
    document.querySelectorAll('.price-display').forEach(function (el) {
        var row = el.closest('tr');
        if (!row) return;
        var inp = row.querySelector('.price-input');
        if (inp) {
            var val = parseInt(inp.value) || 0;
            el.textContent = val.toLocaleString('id-ID');
        }
    });

})();
</script>
@endpush
