import $ from 'jquery';
import * as bootstrap from 'bootstrap';
import Swal from 'sweetalert2';
import html2canvas from 'html2canvas';
import CircleProgress from 'js-circle-progress';

// Expose jQuery & Swal globally agar script inline di blade bisa pakai $ dan Swal
window.$ = window.jQuery = $;
window.Swal = Swal;

// Toast mixin — expose ke window agar blade inline scripts bisa pakai Toast.fire()
const Toast = Swal.mixin({
	toast: true,
	position: 'top-end',
	showConfirmButton: false,
	timer: 4000,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer);
		toast.addEventListener('mouseleave', Swal.resumeTimer);
	}
});
window.Toast = Toast;

// ── Semua DOM-dependent code dibungkus dalam document.ready ──────────────────
$(function () {

	// ── Copy text ──────────────────────────────────────────────────────────────
	$(document).on('click', '.copy-text', function (e) {
		e.preventDefault();
		var text = $(this).data('text');
		$('body').append('<textarea name="selected-text"></textarea>');
		$('textarea[name=selected-text]')
			.css('position', 'absolute')
			.css('transform', 'scale(0,0)')
			.val(text)
			.select();
		if (document.execCommand('copy')) {
			Toast.fire({ icon: 'info', title: 'Disalin', text: 'Disalin ke papan klip.' });
			$('textarea[name=selected-text]').remove();
		}
	});

	// ── Circle Progress ────────────────────────────────────────────────────────
	if ($('.progress').length > 0) {
		var set_max = $('.progress').data('max'),
			set_val = $('.progress').data('value');
		new CircleProgress('.progress', { value: set_val, max: set_max });
	}

	// ── Bootstrap Tooltips ─────────────────────────────────────────────────────
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	tooltipTriggerList.map(function (el) { return new bootstrap.Tooltip(el); });

	// ── DataTables ─────────────────────────────────────────────────────────────
	var dataTables;
	function initMemberDataTables() {
		// Guard: jangan sampai script berhenti kalau plugin DataTables belum ter-load
		if (!$('.dataTables').length) return;
		if (!$.fn || typeof $.fn.DataTable !== 'function') return;

		// Hindari double init
		if ($.fn.DataTable.isDataTable && $.fn.DataTable.isDataTable('.dataTables')) {
			dataTables = $('.dataTables').DataTable();
			return;
		}

		var $table      = $('.dataTables').first(),
			columnsMode = $table.data('columns'),
			action      = $table.data('list'),
			csrf        = $('meta[name=csrf-token]').attr('content');

		let columns = [
			{ data: 'image', name: 'image' },
			{ data: 'title', name: 'title' },
			{ data: 'info',  name: 'info'  },
		];
		if (columnsMode === 'transaction') {
			columns = [
				{ data: 'invoice', name: 'invoice' },
				{ data: 'package', name: 'package' },
				{ data: 'amount',  name: 'amount'  },
				{ data: 'method',  name: 'method'  },
				{ data: 'status',  name: 'status'  },
				{ data: 'date',    name: 'date'    },
				{ data: 'action',  name: 'action'  },
			];
		}

		dataTables = $table.DataTable({
			responsive:   true,
			ordering:     false,
			lengthChange: false,
			lengthMenu:   false,
			autoWidth:    false,
			language: {
				search:            '_INPUT_',
				searchPlaceholder: 'Cari',
				searchClass:       'form-control',
				zeroRecords:       'Kosong',
				info:              'Data total: _TOTAL_',
				infoEmpty:         '',
				paginate: {
					previous: '<i class="bx bx-chevron-left"></i>',
					next:     '<i class="bx bx-chevron-right"></i>',
				},
				infoFiltered: '/ _MAX_',
			},
			serverSide: true,
			ajax: {
				url:      action,
				type:     'post',
				dataType: 'json',
				data:     { _token: csrf },
				error:    function (q, w, e) { console.log(q, w, e); },
			},
			columns,
		});

		$('.dataTables_filter').css('float', 'unset');
		$('.dataTables_filter').children('label').addClass('d-block pb-1');
		$('.dataTables_filter').children('label').children('input').addClass('form-control form-control-sm m-0');
		$('.dataTables_info').addClass('small');
		$('.dataTables_paginate').addClass('small');
	}
	// Coba init sekarang, dan ulangi saat window load (untuk kasus script DataTables dipush setelah file ini)
	initMemberDataTables();
	$(window).on('load', function () { initMemberDataTables(); });

	// ── File upload button ─────────────────────────────────────────────────────
	if ($('.btn_upload').length > 0) {
		var btnUpload = $('.btn_upload').children('input[type=file]'),
			btnOuter  = $('.button_outer');

		btnUpload.on('change', function (e) {
			var ext = btnUpload.val().split('.').pop().toLowerCase();
			if ($.inArray(ext, ['png', 'jpg', 'jpeg']) === -1) {
				$('.error_msg').text(null);
			} else {
				$('.error_msg').text(null);
				btnOuter.addClass('file_uploading');
				setTimeout(function () { btnOuter.addClass('file_uploaded'); }, 2900);
				var uploadedFile = URL.createObjectURL(e.target.files[0]);
				setTimeout(function () {
					$('#uploaded_view').append('<img src="' + uploadedFile + '" />').addClass('show');
				}, 3000);
			}
		});

		$('.file_remove').on('click', function () {
			$('#uploaded_view').removeClass('show').find('img').remove();
			btnOuter.removeClass('file_uploading file_uploaded');
		});
	}

	// ── Strbox store ───────────────────────────────────────────────────────────
	if ($('.strbox-store').length > 0) {
		$('.strbox-store').on('submit', function (e) {
			e.preventDefault();
			let action = $(this).attr('action'),
				submit = $(this).find('button[type=submit]');
			$.ajax({
				type:        'post',
				url:         action,
				dataType:    'json',
				data:        new FormData(this),
				contentType: false,
				cache:       false,
				processData: false,
				error: function (q, w, e) {
					submit.children('span').text('Coba lagi');
					submit.prop('disabled', false);
					console.log(q, w, e);
				},
				beforeSend: function () {
					submit.prop('disabled', true);
					submit.children('span').text('Mengunggah...');
				},
				success: function (response) {
					if (dataTables) dataTables.ajax.reload();
					$('.strbox-store')[0].reset();
					submit.children('span').text('Unggah');
					submit.prop('disabled', false);
				},
			});
		});

		$(document).on('click', '.unuse-image', function (e) {
			e.preventDefault();
			$('#' + $(this).data('target')).remove();
		});
	}

	// ── Delete event ───────────────────────────────────────────────────────────
	$(document).on('click', '.delete-event', function (e) {
		e.preventDefault();
		let action = $(this).data('url'),
			token  = $('meta[name=csrf-token]').attr('content');
		Swal.fire({
			icon: 'question', title: 'Hapus acara?',
			showCancelButton: true, confirmButtonColor: '#d33',
			confirmButtonText: 'Hapus', cancelButtonText: 'Batal',
		}).then(function (result) {
			if (result.isConfirmed) {
				$.ajax({
					type: 'post', url: action, dataType: 'json',
					data: { _method: 'DELETE', _token: token },
					success: function () { location.reload(); },
					error:   function (q, w, e) { console.log(q, w, e); },
				});
			}
		});
	});

	// ── Delete story ───────────────────────────────────────────────────────────
	$(document).on('click', '.delete-story', function (e) {
		e.preventDefault();
		let action = $(this).data('url'),
			token  = $('meta[name=csrf-token]').attr('content');
		Swal.fire({
			icon: 'question', title: 'Hapus cerita?',
			showCancelButton: true, confirmButtonColor: '#d33',
			confirmButtonText: 'Hapus', cancelButtonText: 'Batal',
		}).then(function (result) {
			if (result.isConfirmed) {
				$.ajax({
					type: 'post', url: action, dataType: 'json',
					data: { _method: 'DELETE', _token: token },
					success: function () { location.reload(); },
					error:   function (q, w, e) { console.log(q, w, e); },
				});
			}
		});
	});

	// ── Delete souvenir ────────────────────────────────────────────────────────
	$(document).on('click', '.delete-souvenir', function (e) {
		e.preventDefault();
		let action = $(this).data('url'),
			token  = $('meta[name=csrf-token]').attr('content');
		Swal.fire({
			icon: 'question', title: 'Hapus souvenir?',
			showCancelButton: true, confirmButtonColor: '#d33',
			confirmButtonText: 'Hapus', cancelButtonText: 'Batal',
		}).then(function (result) {
			if (result.isConfirmed) {
				$.ajax({
					type: 'post', url: action, dataType: 'json',
					data: { _method: 'DELETE', _token: token },
					success: function () { location.reload(); },
					error:   function (q, w, e) { console.log(q, w, e); },
				});
			}
		});
	});

	// ── Figure catcher (e-invitation screenshot) ───────────────────────────────
	$(document).on('click', '.figure-catcher', function (e) {
		e.preventDefault();
		var action = $(this).data('url'),
			button = $('.figure-catcher'),
			csrf   = $('meta[name=csrf-token]').attr('content');
		html2canvas(document.querySelector('.figure-image')).then(function (canvas) {
			var imgData = canvas.toDataURL('image/webp');
			$.ajax({
				type: 'post', url: action, dataType: 'json',
				data: { _token: csrf, _method: 'PUT', base64data: imgData },
				beforeSend: function () { button.prop('disabled', true); },
				success: function (response) {
					button.prop('disabled', false);
					if (response.toast) Toast.fire(response.toast);
				},
				error: function (q, w, e) {
					button.prop('disabled', false);
					console.log(q, w, e);
				},
			});
		});
	});

	// ── Save menu (profile, cover, detail, rsvp, dll) ─────────────────────────
	// Ctrl+S shortcut
	document.addEventListener('keydown', function (event) {
		if (event.ctrlKey && event.key === 's') {
			event.preventDefault();
			var $form = $('.save-menu').first();
			if ($form.length) $form.submit();
		}
	});

	// AJAX submit untuk semua form .save-menu
	$(document).on('submit', '.save-menu', function (e) {
		e.preventDefault();

		var $form    = $(this),
			action   = $form.attr('action'),
			$submit  = $form.find('button[type=submit]'),
			origIcon = 'bx-save',
			origText = $submit.find('span').text().trim() || 'simpan';

		$.ajax({
			type:        'post',
			url:         action,
			dataType:    'json',
			data:        new FormData(this),
			contentType: false,
			cache:       false,
			processData: false,

			beforeSend: function () {
				$('sup[role=alert]').remove();
				// Tampilkan info toast saat mulai
				Toast.fire({ icon: 'info', title: 'Proses simpan...' });
				// Ubah tombol ke loading state
				$submit.find('i').removeClass(origIcon).addClass('bx-loader bx-spin');
				$submit.find('span').text('Proses simpan...');
				$submit.prop('disabled', true);
			},

			success: function (response) {
				// Reset tombol
				$submit.find('i').removeClass('bx-loader bx-spin').addClass('bx-check');
				$submit.find('span').text('Berhasil disimpan');
				$submit.prop('disabled', false);

				// Tampilkan toast sukses
				var toastData = response.toast || { icon: 'success', title: 'Berhasil disimpan' };
				Toast.fire({
					icon:  toastData.icon  || 'success',
					title: toastData.title || 'Berhasil disimpan',
					text:  toastData.text  || '',
				});

				// Kembalikan tombol ke semula setelah 2 detik
				setTimeout(function () {
					$submit.find('i').removeClass('bx-check').addClass(origIcon);
					$submit.find('span').text(origText);
				}, 2000);

				// Reload jika diminta
				if (response.page === 'reload') {
					setTimeout(function () { location.reload(); }, 900);
				}
			},

			error: function (xhr) {
				// Reset tombol
				$submit.find('i').removeClass('bx-loader bx-spin').addClass(origIcon);
				$submit.find('span').text(origText);
				$submit.prop('disabled', false);

				// Tampilkan error di field
				$('sup[role=alert]').remove();
				if (xhr.responseJSON && xhr.responseJSON.errors) {
					$.each(xhr.responseJSON.errors, function (field, messages) {
						var msg = Array.isArray(messages) ? messages[0] : messages;
						$('var[dir=' + field + ']').after(
							'<sup role="alert" data-bs-toggle="tooltip" data-bs-placement="right" title="' + msg + '">!</sup>'
						);
					});
				}

				// Tampilkan Swal error
				Swal.fire({
					icon:               'warning',
					title:              'Periksa kembali',
					text:               'Lengkapi semua field yang diperlukan.',
					confirmButtonColor: '#2d7a4f',
					confirmButtonText:  'OK',
				});
			},
		});
	});

	// ── Logout form ────────────────────────────────────────────────────────────
	$(document).on('click', '.logout-form', function (e) {
		e.preventDefault();
		$('#logout-form').submit();
	});

}); // end $(function)
