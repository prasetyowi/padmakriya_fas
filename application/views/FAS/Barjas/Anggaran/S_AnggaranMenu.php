<script>
	$(document).ready(function() {
		// alert('aaa')
		$(".select2").select2({
			width: "100%"
		});
	});

	function viewModalAdd() {
		$('#modalAdd').modal("show");
	}

	function getDataAnggaranSearch() {
		var anggaran_tahun = $("#tahun").val();
		var perusahaan = $("#filter_perusahaan").val();
		Swal.showLoading()
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/Anggaran/getDataAnggaranSearch') ?>",
			data: {
				anggaran_tahun: anggaran_tahun,
				perusahaan: perusahaan
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tableAnggaran')) {
					$('#tableAnggaran').DataTable().destroy();
				}

				$("#tableAnggaran tbody").empty();
				$("#tableAnggaran tbody").html('');
				if (data != null) {
					$.each(data, function() {
						var btn_add =
							'<a class="btn btn-info"  target="_blank" href="<?php echo site_url('FAS/Barjas/Anggaran/AnggaranForm?anggaran_kode=') ?>' +
							this.anggaran_kode + '">Add Anggaran</a>'


						if (this.count_detail > 0) {
							var btn_add = ""
						}
						$('#tableAnggaran tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.client_wms_nama===null?'-':this.client_wms_nama}</td>
                                    <td style='vertical-align:middle; ' >${this.anggaran_kode}</td>
                                    <td style='vertical-align:middle; ' >${this.anggaran_tahun}</td>
                                    <td style='vertical-align:middle; ' >${this.anggaran_tgl_create}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.anggaran_who_create}</td>
                                    <td style='vertical-align:middle; text-align: center;' >
                                    ${btn_add}
                                    <a class="btn btn-primary" onclick="detailAnggaran('${this.anggaran_id}')">Detail</a>
                                    </td>
                                </tr>
                    `);
						no++;
					});
				} else {
					$("#tableAnggaran tbody").html('');
				}

				$('#tableAnggaran').DataTable();
				swal.close();
			}
		});
	}

	function SaveAnggaran() {
		var anggaran_kode = $("#anggaran_kode").val()
		var anggaran_jumlah_level = $("#anggaran_jumlah_level").val()
		var anggaran_tahun = $("#anggaran_tahun").val()
		var anggaran_status = $("#anggaran_status").val()
		var perusahaan = $("#perusahaan").val()
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/Anggaran/SaveAnggaran') ?>",
			data: {
				anggaran_kode: anggaran_kode,
				anggaran_tahun: anggaran_tahun,
				anggaran_jumlah_level: anggaran_jumlah_level,
				perusahaan: perusahaan
			},
			async: "true",
			beforeSend: function() {
				$("#saveData").prop('disabled', true);
			},
			dataType: "json",
			success: function(response) {
				console.log(response);
				if (response.status == 1) {
					Swal.fire(
						'Success!',
						'Your file has been created.',
						'success'
					)
					setTimeout(function() {
						window.location.href =
							"<?= base_url('FAS/Barjas/Anggaran/AnggaranMenu') ?>";
					}, 3000);
					// $('#modalAdd').modal("hide");
				} else {
					Swal.fire(
						'Error!',
						response.message,
						'warning'
					)
					$('#saveData').prop('disabled', false);
				}
				// let data = response;
				// console.log(data);
			}
		});

	}

	// === DETAIL ANGGARAN ===
	function detailAnggaran(anggaran_id) {
		// viewTableBudget(kode_anggaran);
		$('#modalDetail').modal("show");
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/Anggaran/getListDetail') ?>",
			data: {
				anggaran_id: anggaran_id,
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tableDetail')) {
					$('#tableDetail').DataTable().destroy();
				}

				$("#tableDetail tbody").empty();
				$("#tableDetail tbody").html('');
				if (data.length > 0) {
					$.each(data, function(index) {
						var edit = '';
						if ((this.anggaran_detail_status == "Draft" || this.anggaran_detail_status ==
								"Rejected") && index == 0) {
							if (this.anggaran_detail_status ==
								"Rejected") {
								var edit =
									'<a class="btn btn-warning" target="_blank" href="<?php echo site_url('FAS/Barjas/Anggaran/AnggaranAddNew?kode=') ?>' +
									this.anggaran_detail_kode + '">Edit</a>'
							} else {
								var edit =
									'<a class="btn btn-warning" target="_blank" href="<?php echo site_url('FAS/Barjas/Anggaran/AnggaranEdit?kode=') ?>' +
									this.anggaran_detail_kode + '">Edit</a>'
							}
						}
						$('#tableDetail tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.anggaran_tahun}</td>
                                    <td style='vertical-align:middle; ' >${this.anggaran_kode}</td>
                                    <td style='vertical-align:middle; ' >${this.anggaran_detail_kode}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.anggaran_detail_status}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.anggaran_detail_who_create}</td>
                                    <td style='vertical-align:middle; text-align: center;' >
                                    <a class="btn btn-info" target="_blank" href="<?php echo site_url('FAS/Barjas/Anggaran/AnggaranView?kode=') ?>${this.anggaran_detail_kode}">Lihat</a>
                                    ${edit}
                                    </td>
                                </tr>
                            `);
						no++;
					});
				} else {
					$("#tableDetail tbody").html('');
				}

				$('#tableDetail').DataTable();
				swal.close();
			}
		});

	}
</script>
