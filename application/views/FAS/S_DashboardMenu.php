<script type="text/javascript">
	$(document).ready(
		function() {
			var Outlet = '<?= $_SESSION['depo_nama'] ?>';
			$(".select2").select2({
				width: "100%"
			});

			titleCase(Outlet);

			if ($('#filter_perusahaan option:selected').val() != '') {
				getOutstandingApproval()
			}

			if ($('#filter_tgl').length > 0) {
				$('#filter_tgl').daterangepicker({
					'applyClass': 'btn-sm btn-success',
					'cancelClass': 'btn-sm btn-default',
					locale: {
						"format": "DD/MM/YYYY",
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					},
					'startDate': '<?= date("01-m-Y") ?>',
					'endDate': '<?= date("t-m-Y") ?>'
				});
			}

		}
	);

	$(document).on('change', '#filter_perusahaan', function() {
		getOutstandingApproval();
		getInfoStatusSO()
	})

	$("#filter_tgl").on('change', function() {
		getInfoStatusSO();
	})

	function getOutstandingApproval() {
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Approval/getOutstandingApproval') ?>",
			data: {
				perusahaan: $('#filter_perusahaan option:selected').val() == '' ? '' : $(
					'#filter_perusahaan option:selected').val()

			},
			success: function(response) {

				let no = 1;
				let data = response;
				console.log(data);

				if ($.fn.DataTable.isDataTable('#tableApproval')) {
					$('#tableApproval').DataTable().destroy();
				}

				$("#tableApproval tbody").empty();
				$("#tableApproval tbody").html('');
				if (data != null) {
					$.each(data, function() {

						$('#tableApproval tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.approval_setting_jenis}</td>
									<td>	
                                    <a class="btn btn-primary" onclick="detailApproval('${this.approval_setting_id}','${this.approval_setting_jenis}')">${this.jumlah}</a>
                                    </td>
                                </tr>
                            `);
						no++;
					});
				} else {
					$("#tableApproval tbody").html('');
				}

				// $('#tableApproval').DataTable();

			}
		});
	}

	function getInfoStatusSO() {
		var date = $("#filter_tgl").val();
		var pt = $("#filter_perusahaan").val();

		$.ajax({
			type: "POST",
			url: "<?= base_url('FAS/MainDashboard/getInfoStatusSO') ?>",
			data: {
				date: date,
				pt: pt
			},
			dataType: "JSON",
			success: function(response) {
				$("#so").html(response.so.jmlSO);
				$("#apprv").html(response.apprv.jmlApprv);
				$("#pndg").html(response.pndg.jmlPndg);
			}
		})
	}

	function detailApproval(approval_setting_id, approval_setting_jenis) {
		$('#modalApproval').modal("show");
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Approval/getApprovalByApprovalSettingId') ?>",
			data: {
				approval_setting_id: approval_setting_id
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tableDetailApproval')) {
					$('#tableDetailApproval').DataTable().destroy();
				}

				$("#tableDetailApproval tbody").empty();
				$("#tableDetailApproval tbody").html('');
				if (data.length > 0) {
					$.each(data, function() {
						$('#tableDetailApproval tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; text-align: center; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.approval_reff_dokumen_jenis}<input type="hidden" name="approval_id[]" value="${this.approval_id}" /></td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.tgl}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.diajukan_oleh}</td>
                                    <td style='vertical-align:middle; text-align: center;'' ><a href='<?= base_url() ?>/${this.url_doc}?kode=${this.approval_reff_dokumen_kode}' target='_blank'>${this.approval_reff_dokumen_kode}</a></td>
                                    <td style='vertical-align:middle; text-align: center;'' ><button class="btn btn-md btn-primary" onclick="showHistory('${this.approval_reff_dokumen_kode}')">History</button></td>
                                    <td style='vertical-align:middle; text-align: center;'>	
										<div class="custom-checkbox-input">
											<input style="width:20px;height:20px" type='checkbox' value="0" name='approval[]' class="cly cl-${no} form-check-input-acc custom-color-white" id='approval-${no}' onclick="approvalCheck(this.id,${no})"/>
										</div>
									</td>
									<td style='vertical-align:middle; text-align: center;'>
										<div class="custom-checkbox-input">
											<input style="width:20px;height:20px" type='checkbox' value="0" name='reject[]' class="cln cl-${no} form-check-input custom-color-white" id='reject-${no}' onclick="approvalCheck(this.id,${no})"/>
										</div>
									</td>
                                    <td style='vertical-align:middle; text-align: center;'>
									<textarea name="note[]" id="note[]" style="width:100%" cols="50" rows="1"></textarea>
										
                                    </td>
                                </tr>
                            `);
						no++;
					});
				} else {
					$("#tableDetailApproval tbody").html('');
				}

				$('#tableDetailApproval').DataTable({
					paging: false
				});

			}
		});

	}

	$("#saveApproval").prop('disabled', true);
	// mengatasi checkbox double
	function approvalCheck(id, no) {
		$("#saveApproval").prop('disabled', true);

		var cly = $(".cly").length;
		var cln = $(".cln").length;

		var isdisabled = 0;

		for (i = 0; i < cln; i++) {
			if ($(".cln").eq(i).prop('checked') == true) {
				isdisabled++;
			}
		}

		for (i = 0; i < cly; i++) {
			if ($(".cly").eq(i).prop('checked') == true) {
				isdisabled++;
			}
		}

		if (isdisabled > 0) {
			$("#saveApproval").prop('disabled', false);
		}
		//jika cheked maka val = 1
		if (document.getElementById(id).checked) {
			$("#" + id + "").val(1)
		} else {
			$("#" + id + "").val(0)
		}
		$('.cl-' + no + '').not("#" + id + "").prop('checked', false);
	}

	function showHistory(approval_pengajuan_id) {
		$('#modalHistoryApproval').modal("show");
		$.ajax({
			type: 'GET',
			url: "<?= base_url('FAS/Approval/getHistoryApproval') ?>",
			data: {
				approval_pengajuan_id: approval_pengajuan_id
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if ($.fn.DataTable.isDataTable('#tableHistoryApproval')) {
					$('#tableHistoryApproval').DataTable().destroy();
				}

				$("#tableHistoryApproval tbody").empty();
				$("#tableHistoryApproval tbody").html('');
				if (data.length > 0) {
					$.each(data, function() {
						if (this.approval_status == "Approved") {
							var color = "style='background-color:green;color:white'"
						} else {
							var color = "style='background-color:red;color:white'"
						}
						$('#tableHistoryApproval tbody').append(`
                                <tr>
                                    <td style='vertical-align:middle; text-align: center; ' >${no}</td>
                                    <td style='vertical-align:middle; ' >${this.approval_reff_dokumen_jenis}<input type="hidden" name="approval_id[]" value="${this.approval_id}" /></td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.tgl}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.approval_reff_dokumen_kode}</td>
                                    <td style='vertical-align:middle; text-align: center;' ><a ${color} class="btn btn-md">${this.approval_status}<a/></td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.karyawan_nama}</td>
                                    <td style='vertical-align:middle; text-align: center;' >${this.approval_keterangan}</td>
																		<td style='vertical-align:middle; text-align: center;' >${this.approval_group_nama}</td>
                                </tr>
                            `);
						no++;
					});
				} else {
					$("#tableHistoryApproval tbody").html('');
				}

				// $('#tableDetailApproval').DataTable({
				//     paging: false
				// });

			}
		});
	}
	$('input[type="checkbox"]').on('click', function() {
		// alert('asdasd')
		$('input[name="' + this.name + '"]').not(this).prop('checked', false);
	});

	$('#saveApproval').click(function(e) {
		// data header
		var approval_id = $("input[name='approval_id[]']").map(function() {
			return $(this).val();
		}).get();
		let approv_check = $("input[name='approval[]']").map(function() {
			return parseInt($(this).val());
		}).get();
		let reject_check = $("input[name='reject[]']").map(function() {
			return parseInt($(this).val());
		}).get()
		let note = $("[name='note[]']").map(function() {
			return $(this).val();
		}).get();
		console.log(note);
		let dataAcc = [];
		let dataReject = [];
		//cari data approval yg di acc
		approval_id.forEach((value, index) => {
			// var keterangan = null
			// console.log(note[index]);
			if (note[index] == "undefined") {
				var keterangan = null
			} else {
				var keterangan = note[index]
			}
			if (approv_check[index] > 0) {
				dataAcc.push({
					approval_id: value,
					approval_keterangan: keterangan
				})
			}
			if (reject_check[index] > 0) {
				dataReject.push({
					approval_id: value,
					approval_keterangan: keterangan
				})
			}
		});
		// console.log(dataAcc);
		// return false;
		Swal.fire({
			title: 'Apakah anda yakin menyimpan perubahan ?',
			text: "Pastikan data sudah benar !",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value == true) {
				$.ajax({
					type: 'POST',
					url: "<?= base_url('FAS/Approval/ApprovalProses') ?>",
					data: {
						dataAcc: dataAcc,
						dataReject: dataReject,
					},
					async: "true",
					beforeSend: function() {
						$("#saveApproval").prop('disabled', true);
					},
					dataType: "json",
					success: function(response) {
						console.log(response);
						if (response.status == 1) {
							Swal.fire(
								'Success!',
								'Data berhasil diupdate.',
								'success'
							)
							setTimeout(function() {
								location.reload()
							}, 3000);
						} else {
							Swal.fire(
								'Error!',
								response.message,
								'warning'
							)
							$('#saveApproval').prop('disabled', false);
						}
					}
				});
			}
		})
		console.log(dataAcc);
		console.log(dataReject);

	});


	function titleCase(string) {
		var sentence = string.toLowerCase().split(" ");
		for (var i = 0; i < sentence.length; i++) {
			sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
		}

		$("#lbtitleoutlet").html(sentence.join(" ") + " Dashboard");

	}
</script>