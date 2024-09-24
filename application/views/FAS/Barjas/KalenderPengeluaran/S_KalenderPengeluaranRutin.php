<script type="text/javascript">
	var arrEvent = [];
	var isErrorW = 0;
	//aa
	$(document).ready(function() {
		// GetKalenderEvent();
		console.log(arrEvent);
		$('.custom-select').select2({
			width: '100%'
		});
		if ($("#filter_perusahaan option:selected").val() != "") {
			let ini = $("#filter_perusahaan option:selected").val();
			GetKalenderByPerusahaan(ini);
		}

	});

	function GetKalenderByPerusahaan(perusahaan) {

		$("#calendar").show();

		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			initialView: 'dayGridMonth',
			headerToolbar: {
				left: 'prev,next today',
				center: 'title',
				right: 'dayGridMonth,listMonth'
				// center: 'dayGridMonth,listWeek'
			},
			editable: true,
			// titleFormat: { year: 'numeric', month: '2-digit', day: '2-digit' }
			// events: [{
			//         title: 'My Event',
			//         start: '2022-05-01',
			//         // url: 'http://google.com/'
			//     }, {
			//         title: 'All Day Event',
			//         start: '2022-06-01',
			//         id: 112,
			//         color: 'green'
			//     },
			//     {
			//         title: 'Long Event',
			//         start: '2022-06-07',
			//         end: '2022-06-10',
			//         color: 'yellow'

			//     },
			//     {
			//         groupId: 999,
			//         title: 'Repeating Event',
			//         start: '2022-06-09T16:00:00'
			//     },
			//     {
			//         groupId: 999,
			//         title: 'Repeating Event',
			//         start: '2020-06-16T16:00:00'
			//     },
			//     {
			//         title: 'Conference',
			//         start: '2022-06-11',
			//         end: '2022-06-13'
			//     },
			//     {
			//         title: 'Meeting',
			//         start: '2022-06-04T10:30:00',
			//         end: '2022-06-12T12:30:00',
			//         color: 'orange'
			//     },
			//     {
			//         title: 'Lunch',
			//         start: '2022-06-12T12:00:00'
			//     },
			//     {
			//         title: 'Meeting',
			//         start: '2022-06-12T14:30:00'
			//     },
			//     {
			//         title: 'Happy Hour',
			//         start: '2022-06-12T17:30:00'
			//     },
			//     {
			//         title: 'Dinner',
			//         start: '2022-06-12T20:00:00'
			//     },
			//     {
			//         title: 'Birthday Party',
			//         start: '2022-06-13T07:00:00'
			//     },
			//     {
			//         title: 'Click for Google',
			//         url: 'http://google.com/',
			//         start: '2022-06-28'
			//     }
			// ],
			events: {
				type: 'GET',
				url: "<?= base_url() ?>FAS/Barjas/KalenderPengeluaranRutin/GetKalenderEvent/?perusahaan=" + perusahaan,
				success: function(response) {
					// Instead of returning the raw response, return only the data 
					// element Fullcalendar wants
					return response;
				}
			},
			// add html in tittle
			eventContent: function(info) {
				return {
					html: info.event.title
				};
			},
			// eventRender: function(info) {
			//     info.el.querySelectorAll('.fc-title')[0].innerHTML = info.el.querySelectorAll(
			//         '.fc-title')[0].innerText;
			// },
			eventClick: function(calEvent) {
				getDetailEvent(calEvent.event._def.publicId)
				// alert(calEvent.event._def.publicId);
				// console.log(calEvent);
				console.log(calEvent);

			}
		});

		calendar.render();

		calendar.on('dateClick', function(info) {
			// $("#previewaddeventcalendar").modal('show');
		});
	}

	function viewEventBerulang() {
		if ($("#filter_perusahaan").val() != "") {
			$("#modalListEventBerulang").modal('show');
			getListEventBerulang();
		} else {
			alert("Harap Pilih Perusahaan");
			$("#modalListEventBerulang").modal('hide');
		}

	}
	$('.chW').on('click', function() {

		var chW = $(".chW").length;
		isErrorW = 0;
		for (i = 0; i < chW; i++) {
			if ($(".chW").eq(i).prop('checked') == true) {
				isErrorW += 1;
				// alert('asdasd')
			}
		}
		// console.log(isErrorW);
		// isErrorW = 0;

	});
	$("#approval_jenis_pengadaan").change(function() {
		if ($(this).val() == "PO" || $(this).val() == "Po" || $(this).val() == "po") {
			$("#formnodocpo").show();
			$("#add_nodocpo").val("");
		} else {
			$("#add_nodocpo").val("");
			$("#formnodocpo").hide();
		}
	})

	function getListEventBerulang() {
		$("#tableListEventBerulang tbody").html('');
		if ($.fn.DataTable.isDataTable('#tableAnggaran')) {
			$('#tableListEventBerulang').DataTable().destroy();
		}
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetKalenderBerulang') ?>",
			data: {
				// kalender_detail_id: kalender_detail_id,
				perusahaan: $("#filter_perusahaan").val()
			},
			success: function(response) {
				let no = 1;
				let data = response;
				if (data.length > 0) {
					$.each(data, function() {
						// let recurrence;
						// switch (this.kalender_recurrence) {
						//     case '1':
						//         recurrence = "Hari";
						//         break;
						//     case '2':
						//         recurrence = "Minggu";
						//         break;
						//     case '3':
						//         recurrence = "Bulan";
						//         break;
						//     case '4':
						//         recurrence = "Tahun";
						//         break;
						//     default:
						//         recurrence = null;
						// }
						var dateSplit = this.kalender_tgl_create.split(" ");
						var dateSplit2 = dateSplit[0].split("-");
						var formattedDate = dateSplit2.reverse().join('-'); // 26-06-2013
						$('#tableListEventBerulang tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.kalender_judul}</td>
                                    <td style='vertical-align:middle; ' >${formatRupiah(parseInt(this.kalender_nilai))}</td>
                                    <td style='vertical-align:middle; ' >${this.kalender_recurrence}</td>
                                    <td style='vertical-align:middle; ' >${this.kalender_who_create}</td>
                                    <td style='vertical-align:middle; ' >${formattedDate}</td>
                                    <td style='vertical-align:middle; text-align: center;' >
                                    <a class="btn btn-primary" onclick="viewDetailEventBerulang('${this.kalender_id}','${this.kalender_judul}','${formatRupiah(parseInt(this.kalender_nilai))}','${this.kalender_recurrence}')">Detail</a>
                                    <a class="btn btn-danger" onclick="deleteEventBerulang('${this.kalender_id}')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                    `);
						no++;
					});
				} else {
					$("#tableListEventBerulang tbody").html('');
				}
				$('#tableListEventBerulang').DataTable();
			}

		})
	}

	function viewDetailEventBerulang(kalender_id, kalender_judul, kalender_nilai, recurrence) {
		$("#modalDetailEventBerulang").modal('show');
		$("#detail_judul").val(kalender_judul);
		$("#detail_nilai").val(kalender_nilai);
		$("#detail_recurrence").val(recurrence);

		getDetailEventBerulang(kalender_id, kalender_judul, kalender_nilai)
	}

	function getDetailEventBerulang(kalender_id, kalender_judul, kalender_nilai) {
		// alert('kalender_id')
		$("#tableDetailEventBerulang tbody").html('');
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetDetailKalenderByKalenderId') ?>",
			data: {
				kalender_id: kalender_id,
			},
			success: function(response) {
				let no = 1;
				let data = response;

				if (data.length > 0) {
					$.each(data, function() {
						let namahari;
						switch (this.kalender_detail_nama_hari) {
							case 'Sunday':
								namahari = "Minggu";
								break;
							case 'Monday':
								namahari = "Senin";
								break;
							case 'Tuesday':
								namahari = "Selasa";
								break;
							case 'Wednesday':
								namahari = "Rabu";
								break;
							case 'Thursday':
								namahari = "Kamis";
								break;
							case 'Friday':
								namahari = "Jumat";
								break;
							case 'Saturday':
								namahari = "Sabtu";
						}

						var disabled = "";
						var status = "";
						if (this.kalender_detail_flag_pengajuan == 1) {
							var disabled = "disabled"
							var status =
								'<span class="fc-title"> <i class="fa fa-solid fa fa-bold fa fa-check" aria-hidden="true"></i></span>';
						}
						$('#tableDetailEventBerulang tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.kalender_detail_tanggal}</td>
                                    <td style='vertical-align:middle; ' >${namahari}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${status}</td>
									<td style='vertical-align:middle; text-align: center;' >
                                    <button class="btn btn-danger" ${disabled} onclick="deleteDetailEventBerulang('${this.kalender_id}','${this.kalender_detail_id}')"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                    `);
						no++;
					});
				} else {
					$("#tableDetailEventBerulang tbody").html('');
				}
				// $('#tableDetailEventBerulang').DataTable();
			}

		})
	}

	function addEvent() {
		$("#modalAddEvent").modal('show');
	}

	function cancelEvent() {
		Swal.fire({
			title: 'Apakah Anda yakin?',
			text: "Data yang diinput akan hilang!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya!'
		}).then((result) => {
			if (result.value == true) {
				window.location.href =
					"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";

			}
		})
	}
	// reset form modal
	// $('#modalAddEvent').on('hidden.bs.modal', function(e) {
	//     $(this)
	//         .find("input,textarea,select")
	//         .val('')
	//         .end()
	//         .find("input[type=checkbox], input[type=radio]")
	//         .prop("checked", "")
	//         .end();
	// })

	function getDetailEvent(kalender_detail_id) {
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetKalenderByDetailId') ?>",
			data: {
				kalender_detail_id: kalender_detail_id,
			},
			success: function(response) {
				let no = 1;
				let data = response;
				$("#view_kalender_id").val(data.kalender_id);
				$("#view_kalender_detail_id").val(data.kalender_detail_id);
				$("#view_kalender_kode").val(data.kalender_kode);
				$("#view_kalender_judul").val(data.kalender_judul);
				$("#view_kalender_keterangan").val(data.kalender_keterangan);
				// $("#view_kalender_warna").val('' + addslashes(data.tipe_biaya_warna) + '');
				$("#view_kategori_biaya").val(data.kategori_biaya_nama);
				$("#view_tipe_biaya").val(data.tipe_biaya_nama);
				// $("#view_kalender_warna").val(addslashes(data.tipe_biaya_warna));
				// document.getElementById("view_kalender_warna").style.color = addslashes(data.tipe_biaya_warna);
				// $("#view_kalender_warna").val('#841fbf');
				// $("#view_kalender_warna").val(color);
				// alert(addslashes(data.tipe_biaya_warna))
				$("#view_kalender_tanggal").val(data.kalender_detail_tanggal);
				// $("#view_kalender_anggaran").val(data.kalender_nilai);
				$("#view_kalender_nilai").val(formatRupiah(parseInt(data.kalender_nilai)));
				$("#view_kalender_default_pembayaran").val(data.kalender_default_pembayaran);
				$("#view_kalender_no_rekening").val(data.kalender_no_rekening);
				$("#view_kalender_nama_penerima").val(data.kalender_nama_penerima);
				$("#view_bank").val(data.bank_account_nama);
				$("#view_perusahaan").val(data.client_wms_nama);
				$("#view_tipepengadaan").val(data.tipe_pengadaan_nama);
				$("#view_tipepengadaanid").val(data.tipe_pengadaan_id);
				$("#view_tipetransaksi").val("-");
				if (data.is_kasbon == 0) {
					$('#viewdiviskasbon').show();
					$('#viewcb_iskasbon').prop("checked", false)
					$('#viewcb_iskasbonvalue').val('')
				} else {
					$('#viewdiviskasbon').show();
					$('#viewcb_iskasbon').prop("checked", true)
					$('#viewcb_iskasbonvalue').val('FA5CB8A0-5ED2-4E63-9EDF-8FC8BE6594B7')
				}
				//jika sudah diajukan
				if (data.kalender_detail_flag_pengajuan == 1) {
					// alert('aa')
					$("#btnDeleteView").prop('disabled', true);
					$("#btnUpdateView").prop('disabled', true);
					$("#btnPengajuanView").attr('disabled', true);
				} else {
					$("#btnDeleteView").prop('disabled', false);
					$("#btnUpdateView").prop('disabled', false);
					$("#btnPengajuanView").attr('disabled', false);

				}
				$("#viewtipepengaadannama").val(data.tipe_pengadaan_nama)
				if (data.is_kasbon == 0) {
					$("#lblbtnPengajuanDanaModalDetailEvent").html('Purchase Request');
					$("#lblpurchaserequest").show()
					$("#lblpengajuandana").hide()
				} else {
					$("#lblpurchaserequest").hide()
					$("#lblpengajuandana").show()
					$("#lblbtnPengajuanDanaModalDetailEvent").html('Pengajuan Dana');
				}
			}
		});

		$("#modalView").modal('show');
	}

	function GetKalenderEvent() {
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetKalenderEvent') ?>",
			success: function(response) {

				let no = 1;
				let data = response;

				if (data.length > 0) {
					$.each(data, function() {
						arrEvent.push({
							title: this.kalender_judul,
							color: this.kalender_warna,
							start: this.kalender_detail_tanggal,
						})
						return false;
					});
				}
			}
		});
	}

	$("#cbberulang").change(
		function() {
			$("#YesUlang").removeAttr('style');
			$("#YesUlang").attr('style', 'display: none;');

			var Ulang = $("#cbberulang option:selected").val();

			if (Ulang == "1") {
				$("#YesUlang").removeAttr('style');
			}
		}
	)

	$("#akhirY").change(function() {
		var akhir = $("#akhirY").val()
		if (akhir == 2) {
			$("#tglakhirY").show();
		} else {
			$("#tglakhirY").hide();
		}
	})
	$("#akhirM").change(function() {
		var akhir = $("#akhirM").val()
		if (akhir == 2) {
			$("#tglakhirM").show();
		} else {
			$("#tglakhirM").hide();
		}
	})
	$("#akhirW").change(function() {
		var akhir = $("#akhirW").val()
		if (akhir == 2) {
			$("#tglakhirW").show();
		} else {
			$("#tglakhirW").hide();
		}
	})
	$("#akhirD").change(function() {
		var akhir = $("#akhirD").val()
		if (akhir == 2) {
			$("#tglakhirD").show();
		} else {
			$("#tglakhirD").hide();
		}
	})
	$("#cbmode").change(
		function() {
			var Mode = $("#cbmode option:selected").val();

			$("#Mode_D").removeAttr('style');
			$("#Mode_W").removeAttr('style');
			$("#Mode_M").removeAttr('style');
			$("#Mode_Y").removeAttr('style');

			if (Mode == '1') {
				$("#Mode_W").attr('style', 'display: none;');
				$("#Mode_M").attr('style', 'display: none;');
				$("#Mode_Y").attr('style', 'display: none;');
			} else if (Mode == '2') {
				$("#Mode_D").attr('style', 'display: none;');
				$("#Mode_M").attr('style', 'display: none;');
				$("#Mode_Y").attr('style', 'display: none;');
			} else if (Mode == '3') {
				$("#Mode_D").attr('style', 'display: none;');
				$("#Mode_W").attr('style', 'display: none;');
				$("#Mode_Y").attr('style', 'display: none;');
			} else if (Mode == '4') {
				$("#Mode_D").attr('style', 'display: none;');
				$("#Mode_W").attr('style', 'display: none;');
				$("#Mode_M").attr('style', 'display: none;');
			}
		}
	);

	//update
	$("#updatecbberulang").change(
		function() {
			$("#updateYesUlang").removeAttr('style');
			$("#updateYesUlang").attr('style', 'display: none;');

			var Ulang = $("#updatecbberulang option:selected").val();

			if (Ulang == "1") {
				$("#updateYesUlang").removeAttr('style');
			}
		}
	)
	$("#updateakhirY").change(function() {
		var akhir = $("#updateakhirY").val()
		if (akhir == 2) {
			$("#updatetglakhirY").show();
		} else {
			$("#updatetglakhirY").hide();
		}
	})
	$("#updateakhirM").change(function() {
		var akhir = $("#updateakhirM").val()
		if (akhir == 2) {
			$("#updatetglakhirM").show();
		} else {
			$("#updatetglakhirM").hide();
		}
	})
	$("#updateakhirW").change(function() {
		var akhir = $("#updateakhirW").val()
		if (akhir == 2) {
			$("#tupdateglakhirW").show();
		} else {
			$("#updatetglakhirW").hide();
		}
	})
	$("#updateakhirD").change(function() {
		var akhir = $("#updateakhirD").val()
		if (akhir == 2) {
			$("#updatetglakhirD").show();
		} else {
			$("#updatetglakhirD").hide();
		}
	})
	$("#updatecbmode").change(
		function() {
			var Mode = $("#updatecbmode option:selected").val();

			$("#updateMode_D").removeAttr('style');
			$("#updateMode_W").removeAttr('style');
			$("#updateMode_M").removeAttr('style');
			$("#updateMode_Y").removeAttr('style');

			if (Mode == '1') {
				$("#updateMode_W").attr('style', 'display: none;');
				$("#updateMode_M").attr('style', 'display: none;');
				$("#updateMode_Y").attr('style', 'display: none;');
			} else if (Mode == '2') {
				$("#updateMode_D").attr('style', 'display: none;');
				$("#updateMode_M").attr('style', 'display: none;');
				$("#updateMode_Y").attr('style', 'display: none;');
			} else if (Mode == '3') {
				$("#updateMode_D").attr('style', 'display: none;');
				$("#updateMode_W").attr('style', 'display: none;');
				$("#updateMode_Y").attr('style', 'display: none;');
			} else if (Mode == '4') {
				$("#updateMode_D").attr('style', 'display: none;');
				$("#updateMode_W").attr('style', 'display: none;');
				$("#updateMode_M").attr('style', 'display: none;');
			}
		}
	);

	$("#kalender_default_pembayaran").change(function() {
		if ($("#kalender_default_pembayaran").val() == "Tunai") {
			$("#bank").attr('disabled', true);
			$("#txtkalender_no_rekening").attr('disabled', true);
		} else {
			$("#bank").attr('disabled', false);
			$("#txtkalender_no_rekening").attr('disabled', false);

		}
	})
	$('.txtjumlah').change(function(e) {
		if (this.value == "0") {
			alert("Tidak boleh diisi 0");
			$('.txtjumlah').val(1)
		}
	});
	$('#kalender_nilai').change(function(e) {
		if (this.value <= "0") {
			alert("Nilai harus lebih dari 0!")
			$('.kalender_nilai').val()
		}
	});
	$(document).on('change', '#jenis_pengadaanevent', function() {

		let ini = $(this).children("option").filter(":selected").text();
		let isi = ini.replace(/\s/g, '')
		if (isi.toLowerCase() != "nonpo") {
			$('#divnilaievent').hide('FadeIn');
			$('#diviskasbon').hide('FadeIn');
		} else {
			$('#divnilaievent').show('FadeIn');
			$('#diviskasbon').show('FadeIn');
		}
	})
	$('#cb_iskasbon').click(function(event) {
		if (this.checked) {
			$("#cb_iskasbonvalue").val(1);
		} else {
			$("#cb_iskasbonvalue").val(0);
		}
	});
	$(document).on('change', '#updatejenis_pengadaanevent', function() {

		let ini = $(this).children("option").filter(":selected").text();
		let isi = ini.replace(/\s/g, '')
		if (isi.toLowerCase() != "nonpo") {
			$('#updatedivnilaievent').hide('FadeIn');
			$('#updatediviskasbon').hide('FadeIn');
			$('#updatecb_iskasbon').prop('checked', false);
			$('#updatekalender_nilai').val('');
		} else {
			$('#updatecb_iskasbon').prop('checked', false);
			$('#updatedivnilaievent').show('FadeIn');
			$('#updatediviskasbon').show('FadeIn');
			$('#updatekalender_nilai').val('');
		}
	})
	$('#updatecb_iskasbon').click(function(event) {
		if (this.checked) {
			$("#updatecb_iskasbonvalue").val(1);
		} else {
			$("#updatecb_iskasbonvalue").val(0);
		}
	});

	function saveEvent() {
		let dataBerulang = [];
		let kategori_biaya_id = $("#kategori_biaya").val();
		let tipe_biaya_id = $("#tipe_biaya").val();
		let kalender_judul = $("#kalender_judul").val();
		let kalender_keterangan = $("#kalender_keterangan").val();
		let kalender_selected_date = $("#kalender_selected_date").val();
		let kalender_nilai = $("#kalender_nilai").val();
		let kalender_default_pembayaran = $("#kalender_default_pembayaran").val();
		let bank_account_id = $("#bank").val();
		let kalender_no_rekening = $("#txtkalender_no_rekening").val();
		let kalender_nama_penerima = $("#kalender_nama_penerima").val();
		let berulang = $("#cbberulang").val();
		let tipe_berulang = $("#cbmode").val();
		let perusahaan = $("#perusahaan").val();
		let jenis_pengadaan = $("#jenis_pengadaanevent option:selected").val();
		let jenis_pengadaantext = $("#jenis_pengadaanevent").children("option").filter(":selected").text();
		let iskasbon = $("#cb_iskasbonvalue").val();
		console.log("jenis_pengadaantext", jenis_pengadaantext);

		// let kalender_warna = $("#kalender_warna").val();
		if (jenis_pengadaantext.replace(/\s/g, '') == "Non PO") {
			if (kalender_nilai <= "0") {
				alert("Nilai harus lebih dari 0!");
				return false;
			}
			if (kalender_judul == "" || kalender_selected_date == "" ||
				jenis_pengadaan == "" || perusahaan == "") {
				alert('Harap Lengkapi data dahulu !')
				return false;
			}
			// if (kalender_default_pembayaran == "Tunai") {
			// 	if (kalender_judul == "" || kalender_selected_date ==
			// 		"" ||
			// 		kalender_nilai == "" ||
			// 		kalender_default_pembayaran == "" ||
			// 		kalender_nama_penerima == "") {
			// 		alert('Harap Lengkapi data dahulu !')
			// 		return false;
			// 	}
			// 	bank_account_id = null;
			// 	kalender_no_rekening = null;
			// } else {
			// 	if (kalender_judul == "" || kalender_selected_date ==
			// 		"" ||
			// 		kalender_nilai == "" ||
			// 		kalender_default_pembayaran == "" || bank_account_id == "" || kalender_no_rekening == "" ||
			// 		kalender_nama_penerima == "") {
			// 		alert('Harap Lengkapi data dahulu !')
			// 		return false;
			// 	}
			// }
		}
		if (kalender_judul == "" || kalender_selected_date == "" ||
			jenis_pengadaan == "" || perusahaan == "") {
			alert('Harap Lengkapi data dahulu !')
			return false;
		}
		if (jenis_pengadaan == "") {
			alert('Mohon Pilih Tipe Pengadaan!')
			return false;
		}
		// if (kalender_default_pembayaran == "Tunai") {
		// 	if (kategori_biaya_id == "" || tipe_biaya_id == "" || kalender_judul == "" || kalender_selected_date ==
		// 		"" ||
		// 		kalender_nilai == "" ||
		// 		kalender_default_pembayaran == "" ||
		// 		kalender_nama_penerima == "") {
		// 		alert('Harap Lengkapi data dahulu !')
		// 		return false;
		// 	}
		// 	bank_account_id = null;
		// 	kalender_no_rekening = null;
		// } else {
		// 	if (kategori_biaya_id == "" || tipe_biaya_id == "" || kalender_judul == "" || kalender_selected_date ==
		// 		"" ||
		// 		kalender_nilai == "" ||
		// 		kalender_default_pembayaran == "" || bank_account_id == "" || kalender_no_rekening == "" ||
		// 		kalender_nama_penerima == "") {
		// 		alert('Harap Lengkapi data dahulu !')
		// 		return false;
		// 	}
		// }
		if (berulang == 1) {
			//jika berulang hari
			if (tipe_berulang == 1) {
				dataBerulang = {
					kalender_value1: $("#txtjumlahD").val(),
					kalender_value2: tipe_berulang,
					kalender_modeberakhir: $("#akhirD").val(),
					kalender_modeberakhirtanggal: $("#akhirD").val() == 2 ? $("#tglakhirD").val() : null,
				}
			}
			if (tipe_berulang == 2) {
				if (isErrorW <= 0) {
					alert('Harap Lengkapi data dahulu !');
					return false;
				}
				// console.log(isErrorW);
				// return false;
				dataBerulang = {
					kalender_value1: $("#txtjumlahW").val(),
					kalender_value2: tipe_berulang,
					kalender_modeberakhir: $("#akhirW").val(),
					kalender_modeberakhirtanggal: $("#akhirW").val() == 2 ? $("#tglakhirW").val() : null,
					kalender_senin: $('#chW_1').is(':checked') ? 1 : null,
					kalender_selasa: $('#chW_2').is(':checked') ? 1 : null,
					kalender_rabu: $('#chW_3').is(':checked') ? 1 : null,
					kalender_kamis: $('#chW_4').is(':checked') ? 1 : null,
					kalender_jumat: $('#chW_5').is(':checked') ? 1 : null,
					kalender_sabtu: $('#chW_6').is(':checked') ? 1 : null,
					kalender_minggu: $('#chW_7').is(':checked') ? 1 : null,
				}
			}
			if (tipe_berulang == 3) {
				dataBerulang = {
					kalender_value1: $("#txtjumlahM").val(),
					kalender_value2: tipe_berulang,
					kalender_recurrencebulanan: $("#tanggalM").val(),
					kalender_modeberakhir: $("#akhirM").val(),
					kalender_modeberakhirtanggal: $("#akhirM").val() == 2 ? $("#tglakhirM").val() : null,

				}
			}
			if (tipe_berulang == 4) {
				dataBerulang = {
					kalender_value1: $("#txtjumlahY").val(),
					kalender_value2: tipe_berulang,
					kalender_modeberakhir: $("#akhirY").val(),
					kalender_modeberakhirtanggal: $("#akhirY").val() == 2 ? $("#tglakhirY").val() : null,
				}
			}
		}
		// console.log(dataBerulang);
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/SaveKalenderPengeluaranRutin') ?>",
			data: {
				kategori_biaya_id: kategori_biaya_id,
				tipe_biaya_id: tipe_biaya_id,
				kalender_judul: kalender_judul,
				kalender_keterangan: kalender_keterangan,
				kalender_selected_date: kalender_selected_date,
				kalender_nilai: kalender_nilai,
				kalender_default_pembayaran: kalender_default_pembayaran,
				bank_account_id: bank_account_id,
				kalender_no_rekening: kalender_no_rekening,
				kalender_nama_penerima: kalender_nama_penerima,
				kalender_is_recurrence: berulang,
				tipe_berulang: tipe_berulang,
				// kalender_warna: kalender_warna,
				dataBerulang: dataBerulang,
				perusahaan: perusahaan,
				jenis_pengadaan: jenis_pengadaan,
				iskasbon: iskasbon
			},
			beforeSend: function() {
				$("#saveEvent").prop('disabled', true);
			},
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.status == 1) {
					Swal.fire(
						'Success!',
						'Event has been created.',
						'success'
					)
					setTimeout(function() {
						window.location.href =
							"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
					}, 3000);
				} else {
					Swal.fire(
						'Error!',
						response.message,
						'warning'
					)
					$('#saveEvent').prop('disabled', false);
				}
				// let data = response;
				// console.log(data);
			}
		});

	}

	function updatesaveEvent() {
		let dataBerulang = [];
		let kategori_biaya_id = $("#updatekategori_biaya").val();
		let tipe_biaya_id = $("#updatetipe_biaya").val();
		let kalender_judul = $("#updatekalender_judul").val();
		let kalender_keterangan = $("#updatekalender_keterangan").val();
		let kalender_selected_date = $("#updatekalender_selected_date").val();
		let kalender_nilai = $("#updatekalender_nilai").val();
		let kalender_default_pembayaran = $("#updatekalender_default_pembayaran").val();
		let bank_account_id = $("#updatebank").val();
		let kalender_no_rekening = $("#updatetxtkalender_no_rekening").val();
		let kalender_nama_penerima = $("#updatekalender_nama_penerima").val();
		let berulang = $("#updatecbberulang").val();
		let tipe_berulang = $("#updatecbmode").val();
		let perusahaan = $("#updateperusahaan").val();
		let jenis_pengadaan = $("#updatejenis_pengadaanevent option:selected").val();
		let jenis_pengadaantext = $("#updatejenis_pengadaanevent").children("option").filter(":selected").text();
		let iskasbon = $("#updatecb_iskasbonvalue").val();
		let kalender_nilai_rpl = kalender_nilai.replaceAll('.', '');

		if (jenis_pengadaantext.replace(/\s/g, '') == "Non PO") {
			if (kalender_nilai <= "0") {
				alert("Nilai harus lebih dari 0!");
				return false;
			}
			if (kalender_judul == "" || kalender_selected_date == "" ||
				jenis_pengadaan == "" || perusahaan == "") {
				alert('Harap Lengkapi data dahulu !')
				return false;
			}
		}
		if (kalender_judul == "" || kalender_selected_date == "" ||
			jenis_pengadaan == "" || perusahaan == "") {
			alert('Harap Lengkapi data dahulu !')
			return false;
		}
		if (jenis_pengadaan == "") {
			alert('Mohon Pilih Tipe Pengadaan!')
			return false;
		}
		if (berulang == 1) {
			//jika berulang hari
			if (tipe_berulang == 1) {
				dataBerulang = {
					kalender_value1: $("#updatetxtjumlahD").val(),
					kalender_value2: tipe_berulang,
					kalender_modeberakhir: $("#updateakhirD").val(),
					kalender_modeberakhirtanggal: $("#updateakhirD").val() == 2 ? $("#updatetglakhirD").val() : null,
				}
			}
			if (tipe_berulang == 2) {
				if (isErrorW <= 0) {
					alert('Harap Lengkapi data dahulu !');
					return false;
				}
				dataBerulang = {
					kalender_value1: $("#updatetxtjumlahW").val(),
					kalender_value2: tipe_berulang,
					kalender_modeberakhir: $("#updateakhirW").val(),
					kalender_modeberakhirtanggal: $("#updateakhirW").val() == 2 ? $("#updatetglakhirW").val() : null,
					kalender_senin: $('#chW_1').is(':checked') ? 1 : null,
					kalender_selasa: $('#chW_2').is(':checked') ? 1 : null,
					kalender_rabu: $('#chW_3').is(':checked') ? 1 : null,
					kalender_kamis: $('#chW_4').is(':checked') ? 1 : null,
					kalender_jumat: $('#chW_5').is(':checked') ? 1 : null,
					kalender_sabtu: $('#chW_6').is(':checked') ? 1 : null,
					kalender_minggu: $('#chW_7').is(':checked') ? 1 : null,
				}
			}
			if (tipe_berulang == 3) {
				dataBerulang = {
					kalender_value1: $("#updatetxtjumlahM").val(),
					kalender_value2: tipe_berulang,
					kalender_recurrencebulanan: $("#updatetanggalM").val(),
					kalender_modeberakhir: $("#updateakhirM").val(),
					kalender_modeberakhirtanggal: $("#updateakhirM").val() == 2 ? $("#updatetglakhirM").val() : null,

				}
			}
			if (tipe_berulang == 4) {
				dataBerulang = {
					kalender_value1: $("#updatetxtjumlahY").val(),
					kalender_value2: tipe_berulang,
					kalender_modeberakhir: $("#updateakhirY").val(),
					kalender_modeberakhirtanggal: $("#updateakhirY").val() == 2 ? $("#updatetglakhirY").val() : null,
				}
			}
		}
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/UpdateSaveKalenderPengeluaranRutin') ?>",
			data: {
				kategori_biaya_id: kategori_biaya_id,
				tipe_biaya_id: tipe_biaya_id,
				kalender_judul: kalender_judul,
				kalender_keterangan: kalender_keterangan,
				kalender_selected_date: kalender_selected_date,
				kalender_nilai: kalender_nilai_rpl,
				kalender_default_pembayaran: kalender_default_pembayaran,
				bank_account_id: bank_account_id,
				kalender_no_rekening: kalender_no_rekening,
				kalender_nama_penerima: kalender_nama_penerima,
				kalender_is_recurrence: berulang,
				tipe_berulang: tipe_berulang,
				dataBerulang: dataBerulang,
				perusahaan: perusahaan,
				jenis_pengadaan: jenis_pengadaan,
				iskasbon: iskasbon,
				kalender_id: $('#hkalender_id').val(),
				kalender_detail_id: $('#hkalender_detail_id').val(),
				type_edit: $('#typeedit').val()
			},
			beforeSend: function() {
				$("#saveEvent").prop('disabled', true);
			},
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.status == 1) {
					Swal.fire(
						'Success!',
						'Event has been created.',
						'success'
					)
					setTimeout(function() {
						window.location.href =
							"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
					}, 3000);
				} else {
					Swal.fire(
						'Error!',
						response.message,
						'warning'
					)
					$('#saveEvent').prop('disabled', false);
				}
				// let data = response;
				// console.log(data);
			}
		});

	}

	function pengajuanApproval() {
		let lblnamatipepengadaan = $("#viewtipepengaadannama").val();
		let kalender_id = $('#view_kalender_id').val();

		let kalender_detail_id = $('#view_kalender_detail_id').val();
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetKalenderByDetailId') ?>",
			data: {
				kalender_detail_id: kalender_detail_id,
			},
			success: function(response) {
				let no = 1;
				let data = response;
				console.log(data);

				$("#approval_kalender_id").val(data.kalender_id);
				$("#approval_kalender_detail_id").val(data.kalender_detail_id);
				// $("#approval_kalender_kode").val(data.kalender_kode);
				$("#approval_kalender_judul").val(data.kalender_judul);
				$("#approval_kalender_keterangan").val(data.kalender_keterangan);
				// $("#approval_kalender_warna").val('' + addslashes(data.tipe_biaya_warna) + '');
				$("#approval_kategori_biaya").val(data.kategori_biaya_nama);
				$("#approval_kategori_biaya_id").val(data.kategori_biaya_id);
				$("#approval_tipe_biaya").val(data.tipe_biaya_nama);
				$("#approval_tipe_biaya_id").val(data.tipe_biaya_id);
				// $("#approval_kalender_warna").val(addslashes(data.tipe_biaya_warna));
				// document.getElementById("approval_kalender_warna").style.color = addslashes(data.tipe_biaya_warna);
				// $("#approval_kalender_warna").val('#841fbf');
				// $("#approval_kalender_warna").val(color);
				// alert(addslashes(data.tipe_biaya_warna))
				$("#approval_kalender_tanggal").val(data.kalender_detail_tanggal);
				let splittgl = data.kalender_detail_tanggal.split("-");
				$("#approval_anggaran_detail_tahun").val(splittgl[0]).change();
				// $("#approval_kalender_anggaran").val(data.kalender_nilai);
				$("#approval_kalender_nilai").val(parseInt(data.kalender_nilai));
				$("#approval_kalender_default_pembayaran").val(data.kalender_default_pembayaran);
				$("#approval_kalender_no_rekening").val(data.kalender_no_rekening);
				$("#approval_kalender_nama_penerima").val(data.kalender_nama_penerima);
				$("#approval_bank").val(data.bank_account_nama);
				$("#approval_bank_id").val(data.bank_account_id);
				$("#approval_perusahaan_id").val(data.client_wms_id);
				$("#approval_perusahaan").val(data.client_wms_nama);
				$("#approval_jenis_pengadaan").val(data.tipe_pengadaan_id).change();
				if ($('#lblbtnPengajuanDanaModalDetailEvent').html() == 'Purchase Request' || $('#lblbtnPengajuanDanaModalDetailEvent').html() == 'Pengajuan Dana') {
					$('#approval_status').val('Draft')
					$('#chk_approval').prop('checked', false)
				}
				// $("#approval_perusahaan").empty();
				// $("#approval_perusahaan").append('<option value="' + data.client_wms_id + '">' + data.client_wms_nama + '</option>');
				//get count pengajuan dana rekap



				// $.ajax({
				// 	type: 'GET',
				// 	url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetCountPengajuanDanaRekap') ?>",
				// 	data: {
				// 		tipe_biaya_id: $("#approval_tipe_biaya_id").val() ,
				// 		tanggal: $("#approval_kalender_tanggal").val()
				// 	},
				// 	success: function(response) {
				// 		if (response != null) {
				// 			$("#count_pengajuan").val(response.count)
				// 		} else {
				// 			$("#count_pengajuan").val(0)
				// 		}
				// 	}
				// });
				$('#approval_anggaran_detail_2 option').remove()
				let idAnggaranDetail = $('#approval_anggaran_detail_2');
				let id_pt = data.client_wms_id;
				// console.log("id", data.client_wms_id);
				let tahun = $('#approval_anggaran_detail_tahun').val() == "" ? <?= date("Y"); ?> : $('#approval_anggaran_detail_tahun').val();
				// let tahun = $('#approval_anggaran_detail_tahun option:selected').val() == "" ? <?= date("Y"); ?> : $('#approval_anggaran_detail_tahun option:selected').val();
				idAnggaranDetail.append($("<option />").val(null).text(
					"-- PILIH ANGGARAN DAHULU--"));

				$.ajax({
					type: 'POST',
					url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetAnggaranDetail2ByYearDepoClient') ?>",
					data: {
						client_wms_id: data.client_wms_id,
						tahun: tahun
					},
					// async: false,
					success: function(response) {
						let data = response;

						if (data.length > 0) {
							$.each(data, function() {
								idAnggaranDetail.append($("<option />").val(
									this.anggaran_detail_2_id).text(this.anggaran_detail_2_kode +
									' - ' +
									this.anggaran_detail_2_nama_anggaran));
							})
						}
					}
				});
				let tipe_transaksi_id = $('#approval_tipe_transaksi')
				// $.ajax({
				// 	type: 'POST',
				// 	url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetTipeTransaksiByTipePengadaanID') ?>",
				// 	data: {
				// 		id_jenis_pengadaan: data.tipe_pengadaan_id
				// 	},
				// 	dataType: "json",
				// 	success: function(response) {
				// 		tipe_transaksi_id.empty();
				// 		let data = response;
				// 		tipe_transaksi_id.append($("<option />").val(null).text("-- PILIH --"));
				// 		if (data.length > 0) {
				// 			$.each(data, function(i, v) {
				// 				tipe_transaksi_id.append($("<option />").val(
				// 					v.tipe_transaksi_id).text(v.tipe_transaksi_nama));
				// 			})
				// 		}
				// 	}
				// });

			}
		});


		// if (lblnamatipepengadaan != "PO") {
		$("#modalPengajuanApproval").modal('show');
		// }
	}
	// $(document).on("change", "#approval_anggaran_detail_tahun", function() {
	//     let idAnggaranDetail = $('#approval_anggaran_detail_2');
	//     let id_pt = $('#approval_perusahaan_id').val();
	//     let tahun = $('#approval_anggaran_detail_tahun option:selected').val() == "" ? <?= date("Y"); ?> : $('#approval_anggaran_detail_tahun option:selected').val();
	//     $('#approval_anggaran_detail_2 option').remove()
	//     idAnggaranDetail.append($("<option />").val(null).text(
	//         "-- PILIH ANGGARAN DAHULU--"));
	//     $.ajax({
	//         type: 'POST',
	//         url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetAnggaranDetail2ByYearDepoClient') ?>",
	//         data: {
	//             client_wms_id: id_pt,
	//             tahun: tahun
	//         },
	//         async: false,
	//         success: function(response) {
	//             let data = response;

	//             if (data.length > 0) {
	//                 $.each(data, function() {
	//                     idAnggaranDetail.append($("<option />").val(
	//                         this.anggaran_detail_2_id).text(this.anggaran_detail_2_kode +
	//                         ' - ' +
	//                         this.anggaran_detail_2_nama_anggaran));
	//                 })
	//             }
	//         }
	//     });

	// });
	function updateEvent() {
		let kalender_id = $('#view_kalender_id').val();
		let kalender_detail_id = $('#view_kalender_detail_id').val();
		Swal.fire({
			title: 'Update Event Biaya',
			input: 'radio',
			inputOptions: {
				0: 'Update semua Jadwal',
				1: 'Hanya tanggal saat ini',
			},
			showCancelButton: true,
			inputValidator: (value) => {
				if (!value) {
					return 'Pilih salah satu opsi!'
				}
				$('#hkalender_id').val(kalender_id)
				$('#hkalender_detail_id').val(kalender_detail_id)
				$('#typeedit').val(value)

				$.ajax({
					type: 'GET',
					url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/GetKalenderByDetailId') ?>",
					data: {
						kalender_detail_id: kalender_detail_id,
					},
					success: function(response) {
						let data = response
						$('#updateperusahaan').val(data.client_wms_id).change()
						$("#updatejenis_pengadaanevent").val(data.tipe_pengadaan_id).change();
						$("#updatekalender_judul").val(data.kalender_judul);

						$("#updatekalender_keterangan").val(data.kalender_keterangan);

						$("#updatekalender_selected_date").val(data.kalender_detail_tanggal);
						if (data.kalender_nilai == "0.0000" || data.kalender_nilai == ".0000") {
							$("#updatekalender_nilai").val('');
						} else {
							$("#updatekalender_nilai").val(formatRupiah(parseInt(data.kalender_nilai)));
						}
						$("#updatekalender_default_pembayaran").val(data.kalender_default_pembayaran).change();
						$("#updatetxtkalender_no_rekening").val(data.kalender_no_rekening);
						$("#updatekalender_nama_penerima").val(data.kalender_nama_penerima);
						$("#updatebank").val(data.bank_account_id).change();

						$("#view_tipepengadaanid").val(data.tipe_pengadaan_id);
						$("#view_tipetransaksi").val("-");
						if (data.tipe_pengadaan_nama == "Non PO") {
							$('#updatediviskasbon').show();

						} else {
							$('#updatediviskasbon').hide();
						}
						if (data.is_kasbon == 0) {
							// $('#updatediviskasbon').hide();
							$('#updatecb_iskasbon').prop("checked", false)
							$('#updatecb_iskasbon').val(0)
						} else {
							$('#updatediviskasbon').show();
							$('#updatecb_iskasbon').prop("checked", true)
							$('#updatecb_iskasbon').val(1)
						}
						//jika sudah diajukan
						if (data.kalender_detail_flag_pengajuan == 1) {
							$("#btnDeleteView").prop('disabled', true);
							$("#btnUpdateView").prop('disabled', true);
							$("#btnPengajuanView").attr('disabled', true);
						} else {
							$("#btnUpdateView").prop('disabled', false);
							$("#btnDeleteView").prop('disabled', false);
							$("#btnPengajuanView").attr('disabled', false);

						}

						$('#modalUpdateEvent').modal('show');

					}
				})

				return false;
			}
		})
	}

	function deleteEvent() {
		let kalender_id = $('#view_kalender_id').val();
		let kalender_detail_id = $('#view_kalender_detail_id').val();
		Swal.fire({
			title: 'Hapus Event Biaya',
			input: 'radio',
			inputOptions: {
				0: 'Hapus semua Jadwal',
				1: 'Hanya tanggal saat ini',
			},
			showCancelButton: true,
			inputValidator: (value) => {
				if (!value) {
					return 'Pilih salah satu opsi!'
				}
				$.ajax({
					type: 'POST',
					url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/DeleteKalenderEvent') ?>",
					data: {
						mode: value,
						kalender_id: kalender_id,
						kalender_detail_id: kalender_detail_id
					},
					dataType: "json",
					success: function(response) {
						// console.log(response.status);
						if (response.status == 1) {
							Swal.fire(
								'Success!',
								'Event has been deleted.',
								'success'
							)
							setTimeout(function() {
								window.location.href =
									"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
							}, 3000);
						} else {
							Swal.fire(
								'Error!',
								response.message,
								'warning'
							)
						}

					}
				});
			}
		})
	}

	function deleteEventBerulang(kalender_id) {
		Swal.fire({
			title: 'Apakah Anda yakin?',
			text: "Data akan dihapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: 'POST',
					url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/DeleteKalenderEvent') ?>",
					data: {
						mode: 0,
						kalender_id: kalender_id,
						kalender_detail_id: null
					},
					dataType: "json",
					success: function(response) {
						// console.log(response.status);
						if (response.status == 1) {
							Swal.fire(
								'Success!',
								'Event has been deleted.',
								'success'
							)
							setTimeout(function() {
								window.location.href =
									"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
							}, 3000);
						} else {
							Swal.fire(
								'Error!',
								response.message,
								'warning'
							)
						}

					}
				});
			}
		})
	}

	function deleteDetailEventBerulang(kalender_id, kalender_detail_id) {
		Swal.fire({
			title: 'Apakah Anda yakin?',
			text: "Data akan dihapus!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, hapus!'
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: 'POST',
					url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/DeleteKalenderEvent') ?>",
					data: {
						mode: 1,
						kalender_id: kalender_id,
						kalender_detail_id: kalender_detail_id
					},
					dataType: "json",
					success: function(response) {
						// console.log(response.status);
						if (response.status == 1) {
							Swal.fire(
								'Success!',
								'Event has been deleted.',
								'success'
							)
							setTimeout(function() {
								window.location.href =
									"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
							}, 3000);
						} else {
							Swal.fire(
								'Error!',
								response.message,
								'warning'
							)
						}

					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						alert("Status: " + textStatus);
						alert("Error: " + errorThrown);
					}
				});
			}
		})
	}

	//submit form permintaan apprval
	$('#PengajuanApproval').submit(function(e) {
		e.preventDefault();
		// let kategori_biaya_id = $('#approval_kategori_biaya_id').val();
		// let tipe_biaya_id = $('#approval_tipe_biaya_id').val();
		// let pengajuan_dana_status = $('#approval_status').val();
		// let pengajuan_dana_judul = $('#approval_kalender_judul').val();
		// let pengajuan_dana_keterangan = $('#approval_kalender_keterangan').val();
		// let pengajuan_dana_tgl_pengajuan = $('#approval_kalender_tanggal_pengajuan').val();
		// let pengajuan_dana_tgl_dibutuhkan = $('#approval_kalender_tanggal').val();
		// let pengajuan_dana_value = $('#approval_kalender_nilai').val();
		// let pengajuan_dana_default_pembayaran = $('#approval_kalender_default_pembayaran').val();
		// let bank_account_id = $('#approval_bank_id').val();
		// let pengajuan_dana_nama_penerima = $('#approval_kalender_nama_penerima').val();
		// let pengajuan_dana_rekening_penerima = $('#approval_kalender_no_rekening').val();
		let anggaran_detail_2_id = $('#approval_anggaran_detail_2').val();
		let approval_anggaran = $('#approval_anggaran').val();
		let approval_tipe_transaksi = $('#approval_tipe_transaksi').val();
		let approval_jenis_pengadaan = $('#approval_jenis_pengadaan option:selected').val();
		let approval_nodocpo = $('#approval_nodocpo').val();
		let approval_jenis_asset = $('#approval_jenis_asset').val();
		let iskasbon = $('#viewcb_iskasbonvalue').val();
		// let pengajuan_dana_attacment_1 = $('#approval_file').val();
		let attachment = $('#approval_file');
		let nama_pemohon = $('#approval_kalender_nama_pemohon').val();
		if (nama_pemohon == '') {
			alert('Mohon Isi Nama Pemohon');
			return false;
		}
		// // console.log(pengajuan_dana_attacment_1);
		// if (anggaran_detail_2_id == '') {
		// 	alert('Harap pilih anggaran terlebih dahulu!')
		// 	return false;
		// }
		// if (approval_tipe_transaksi == '') {
		// 	alert('Harap pilih tipe transaksi terlebih dahulu!')
		// 	return false;
		// }
		// if (approval_jenis_pengadaan == '') {
		// 	alert('Harap pilih jenis pengadaan terlebih dahulu!')
		// 	return false;
		// }
		// if (approval_jenis_asset == '') {
		// 	alert('Harap pilih jenis asset terlebih dahulu!')
		// 	return false;
		// }
		// if (pengajuan_dana_attacment_1 == '') {
		//     alert('data213232 baladeqadnmasjkncdb')
		// }
		let files = attachment[0].files[0];
		var formData = new FormData(this);
		formData.append('kalender_detail_id', $('#view_kalender_detail_id').val());
		formData.append('file', files);
		formData.append('tipe_transaksikasbon', iskasbon);
		formData.append('tipe_pengadaanid', $('#view_tipepengadaanid').val());
		Swal.fire({
			title: 'Apakah Anda yakin?',
			text: "Pastikan data yang diinput sudah benar!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya!'
		}).then((result) => {
			if (result.value == true) {
				if ($("#lblbtnPengajuanDanaModalDetailEvent").html() == "Purchase Request") {
					$.ajax({
						type: 'POST',
						url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/insert_purchase_request') ?>",
						data: {
							kalender_detail_id: $('#view_kalender_detail_id').val(),
							kalender_id: $('#view_kalender_detail_id').val(),
							depo_id: '<?= $this->session->userdata('depo_id'); ?>',
							client_wms_id: $('#approval_perusahaan_id').val(),
							tipe_pengadaan_id: $('#approval_jenis_pengadaan option:selected').val(),
							tipe_transaksi_id: $('#approval_tipe_transaksi option:selected').val(),
							tipe_kepemilikan_id: "",
							kategori_biaya_id: "",
							tipe_biaya_id: "",
							purchase_request_status: "Draft",
							purchase_request_tgl: "",
							purchase_request_tgl_dibutuhkan: $('#approval_kalender_tanggal').val(),
							purchase_request_tgl_create: "",
							purchase_request_who_create: "",
							purchase_request_keterangan: "",
							purchase_request_pemohon: '<?= $this->session->userdata('pengguna_username'); ?>',
							karyawan_divisi_id: '',
							anggaran_detail_2_id: $('#approval_anggaran_detail_2 option:selected').val(),
							judul: $('#approval_kalender_judul').val(),
							nama_penerima: $('#approval_kalender_nama_penerima').val(),
							bank_penerima: $('#approval_kalender_nama_penerima').val(),
							no_rekening: $('#approval_kalender_no_rekening').val(),
							default_pembayaran: $('#approval_kalender_default_pembayaran').val(),
							bank_penerima: $('#approval_bank').val(),
							nama_pemohon: $('#approval_kalender_nama_pemohon').val(),
							keterangan: $('#approval_kalender_keterangan').val()
						},
						// async: false,
						success: function(response) {
							if (response == 1 || response == "1") {
								alert('Data telah ditambah ke Purchase Request');
							} else {
								alert('Data Gagal Ditambah');
							}
							$("#modalView").modal('hide');
							setTimeout(function() {
								window.location.href =
									"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
							}, 2000);
						}
					})
					return false
				} else {


					// console.log(formData);
					$.ajax({
						url: "<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/SavePengajuanDana') ?>",
						type: 'POST',
						data: formData,
						processData: false,
						contentType: false,
						cache: false,
						dataType: "JSON",
						async: false,
						success: function(response) {
							if (response.status == 1) {
								Swal.fire(
									'Success!',
									'Data has been saved.',
									'success'
								)
								setTimeout(function() {
									window.location.href =
										"<?= base_url('FAS/Barjas/KalenderPengeluaranRutin/KalenderPengeluaranRutinMenu') ?>";
								}, 3000);
							} else {
								Swal.fire(
									'Error!',
									response.message,
									'warning'
								)
							}
						},
					});
				}
			}
		})
	});

	function addslashes(str) {
		return (str + '').replace(/[\\"']/g, '\\$&').replace(/\u0000/g, '\\0').toString();
	}

	function parseColor(color) {
		var m;
		m = color.match(/^#([0-9a-f]{6})$/i)[1];
		if (m) {
			return [
				parseInt(m.substr(0, 2), 16),
				parseInt(m.substr(2, 2), 16),
				parseInt(m.substr(4, 2), 16)
			];
		}
	}

	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}
</script>