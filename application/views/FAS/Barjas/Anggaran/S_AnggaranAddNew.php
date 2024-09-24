<script>
	// array data per akun
	let arrDataD = [];
	let arrDataBudget = [];
	let arrBulan = [{
			no: 1,
			nama: "Januari"
		},
		{
			no: 2,
			nama: "Februari"
		},
		{
			no: 3,
			nama: "Maret"
		},
		{
			no: 4,
			nama: "April"
		},
		{
			no: 5,
			nama: "Mei"
		},
		{
			no: 6,
			nama: "Juni"
		},
		{
			no: 7,
			nama: "Juli"
		},
		{
			no: 8,
			nama: "Agustus"
		},
		{
			no: 9,
			nama: "September"
		},
		{
			no: 10,
			nama: "Oktober"
		},
		{
			no: 11,
			nama: "November"
		},
		{
			no: 12,
			nama: "Desember"
		},
	]

	$(document).ready(function() {
		// alert('aaa')
		$(".select2").select2({
			width: "100%"
		});
		getListDetail2AnggaranById()
	});

	//get data list detail 2
	function getListDetail2AnggaranById() {
		let anggaran_detail_id = $("#anggaran_detail_id").val()
		$.ajax({
			type: 'POST',
			url: "<?= base_url('FAS/Barjas/Anggaran/getListDetail2AnggaranById') ?>",
			data: {
				anggaran_detail_id: anggaran_detail_id,
			},
			success: function(response) {

				let no = 1;
				let data = response;

				if (data.length > 0) {
					$.each(data, function(index, value) {
						var petik = "'";
						var style = "";
						var action = ''
						if (value.anggaran_detail_2_level == 0) {
							let listBudget = []
							$.ajax({
								type: 'POST',
								url: "<?= base_url('FAS/Barjas/Anggaran/getListDetail3AnggaranById') ?>",
								data: {
									anggaran_detail_2_id: value.anggaran_detail_2_id,
								},
								success: function(response) {

									let data = response;

									if (data.length > 0) {
										$.each(data, function(index, item) {
											listBudget.push({
												bulan: item
													.anggaran_detail_3_urut_bulan,
												nama_bulan: item
													.anggaran_detail_3_nama_bulan,

												qty: parseInt(item
													.anggaran_detail_3_jumlah
												) || 0
											})
										});
									}
								}
							});

							if (listBudget != []) {
								arrDataBudget.push({
									kode_anggaran: value.anggaran_detail_2_kode,
									budget: listBudget
								})

							}

						}

						arrDataD.push({
							kode_anggaran: value.anggaran_detail_2_kode,
							nama_anggaran: value.anggaran_detail_2_nama_anggaran,
							level: value.anggaran_detail_2_level,
							status: 'Aktif',
							reff_sub: [],
							reff_kode: value.anggaran_detail_2_reff_kode || null,
							budget: parseInt(value.anggaran_detail_2_budget) || 0,
							alokasi: parseInt(value.anggaran_detail_2_alokasi) || 0,
							terpakai: parseInt(value.anggaran_detail_2_terpakai) || 0
						})

					});
				} else {

				}
				viewTable();
			}
		});
		// viewTable();

	}

	$('#saveData').click(function(e) {
		// data header
		var anggaran_id = $("#id_header").val()
		var anggaran_detail_status = $("#anggaran_detail_status").val()
		let anggaran_detail_id = $("#anggaran_detail_id").val()
		let anggaran_detail_kode = $("#anggaran_detail_kode").val()

		if (arrDataD.length <= 0) {
			Swal.fire(
				'Error!',
				"Harap lengkapi data Anggaran!",
				'warning'
			)
			return false;
		}
		//filter cari anggaran induk yg budget nya masih 0
		let resultInduk = arrDataD.filter((value => value.level == jumlah_level - 1) && (value => value.budget <=
			0));
		//cek apakah ada yg budget nya masih 0
		if (resultInduk.length > 0) {
			Swal.fire(
				'Error!',
				"Harap isi budget dahulu!",
				'warning'
			)
			return false;
		}
		//filter cari anggaran level 0
		let result = arrDataD.filter(value => value.level == 0);
		//cek apakah jumlah akun level 0 = dengan isi budgetnya // semua level 0 harus ada budget
		if (result.length != arrDataBudget.length) {
			Swal.fire(
				'Error!',
				"Harap isi budget dahulu!",
				'warning'
			)
			return false;
		}

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
					url: "<?= base_url('FAS/Barjas/Anggaran/SaveAnggaranDetail') ?>",
					data: {
						anggaran_id: anggaran_id,
						anggaran_detail_status: anggaran_detail_status,

						detail2: arrDataD,
						detail3: arrDataBudget
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
								'Data berhasil diupdate.',
								'success'
							)
							setTimeout(function() {
								window.location.href =
									"<?= base_url('FAS/Barjas/Anggaran/AnggaranMenu') ?>";
							}, 3000);
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
		})
	});
	// === ADD INDUK ANGGARAN ===
	function viewModalAddInduk() {
		let jumlah_level = $("#jumlah_level").val()
		$("#level_induk").val(jumlah_level - 1)
		$("#status_induk").val("Aktif");
		$('#modalAddInduk').modal("show");
	}
	// reset form modal
	$('#modalAddInduk').on('hidden.bs.modal', function(e) {
		$(this)
			.find("input,textarea,select")
			.val('')
			.end()
			.find("input[type=checkbox], input[type=radio]")
			.prop("checked", "")
			.end();
	})
	// save induk anggaran
	function saveInduk() {
		var kode_anggaran = $("#kode_anggaran_induk").val();
		var nama_anggaran = $("#nama_anggaran_induk").val();
		var level = $("#level_induk").val();
		var status = $("#status_induk").val();
		// validasi input
		if (kode_anggaran == "" || nama_anggaran == "") {
			alert("Harap lengkapi data dahulu !")
			return false;
		}
		console.log(arrDataD);
		//cek apakah kode sudah terpakai
		let index_data = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran); //cek index yg tersedia
		// jika kode anggaran sudah ada maka alert
		if (index_data >= 0) {
			alert("Kode Anggaran Sudah Ada !")
			return false;
		}
		arrDataD.push({
			kode_anggaran: kode_anggaran,
			nama_anggaran: nama_anggaran,
			level: level,
			status: status,
			reff_sub: [],
			reff_kode: null,
			budget: 0,
			alokasi: 0,
			terpakai: 0
		})
		viewTable();
		$('#modalAddInduk').modal("hide");
	}

	// === ADD SUB ANGGARAN ===
	function addSubAnggaran(kode_anggaran_induk) {
		//cek index dari kode induk yg dipilih
		let index_data = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran_induk);
		// level sub anggaran = level indux - 1;
		var nama_induk_anggaran = arrDataD[index_data]["nama_anggaran"];
		var kode_induk_anggaran = arrDataD[index_data]["kode_anggaran"];
		console.log();
		$("#level_sub").val(arrDataD[index_data]["level"] - 1)
		$("#status_sub").val("Aktif");
		$("#nama_induk_anggaran").val(kode_induk_anggaran + " - " + nama_induk_anggaran);
		$("#kode_induk_anggaran").val(kode_induk_anggaran);
		$("#kode_induk_anggaran1").val(kode_induk_anggaran + ".");
		$('#modalAddSub').modal("show");
	}
	// reset form modal
	$('#modalAddSub').on('hidden.bs.modal', function(e) {
		$(this)
			.find("input,textarea,select")
			.val('')
			.end()
			.find("input[type=checkbox], input[type=radio]")
			.prop("checked", "")
			.end();
	})
	// save sub anggaran
	function saveSub() {
		var kode_anggaran = $("#kode_induk_anggaran1").val() + $("#kode_anggaran_sub").val();
		var nama_anggaran = $("#nama_anggaran_sub").val();
		var level = $("#level_sub").val();
		var status = $("#status_sub").val();
		var reff_kode = $("#kode_induk_anggaran").val();

		// validasi input
		if (kode_anggaran == "" || nama_anggaran == "" || $("#kode_anggaran_sub").val() == "") {
			alert("Harap lengkapi data dahulu !")
			return false;
		}
		//cek apakah kode sudah terpakai
		let index_data = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran); //cek index yg tersedia
		// jika kode anggaran sudah ada maka alert
		if (index_data >= 0) {
			alert("Kode Anggaran Sudah Ada !")
			return false;
		}
		// cek index atasnya
		let index_data1 = arrDataD.findIndex(item => item.kode_anggaran == reff_kode); //cek index yg tersedia
		//cek level sebelumnya
		let last_level = arrDataD[index_data1]["level"]

		arrDataD.push({
			kode_anggaran: kode_anggaran,
			nama_anggaran: nama_anggaran,
			level: last_level - 1,
			status: status,
			reff_kode: reff_kode,
			budget: 0,
			alokasi: 0,
			terpakai: 0
		})
		viewTable();
		$('#modalAddSub').modal("hide");
	}

	// === EDIT ANGGARAN ===
	function editAnggaran(kode_anggaran) {
		//cek index dari kode induk yg dipilih
		let index_data = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran);
		// level sub anggaran = level indux - 1;
		var nama_induk_anggaran = arrDataD[index_data]["nama_anggaran"];
		var kode_induk_anggaran = arrDataD[index_data]["kode_anggaran"];

		$("#level_edit").val(arrDataD[index_data]["level"])
		$("#status_edit").val("Aktif");
		$("#nama_anggaran_edit").val(nama_induk_anggaran);
		$("#kode_anggaran_edit").val(kode_induk_anggaran);
		$('#modalEdit').modal("show");
	}
	// reset form modal
	$('#modalEdit').on('hidden.bs.modal', function(e) {
		$(this)
			.find("input,textarea,select")
			.val('')
			.end()
			.find("input[type=checkbox], input[type=radio]")
			.prop("checked", "")
			.end();
	})
	// save edit anggaran
	function saveEdit() {
		var kode_anggaran = $("#kode_anggaran_edit").val();
		var nama_anggaran = $("#nama_anggaran_edit").val();
		var level = $("#level_edit").val();
		var status = $("#status_edit").val();

		// validasi input
		if (kode_anggaran == "" || nama_anggaran == "") {
			alert("Harap lengkapi data dahulu !")
			return false;
		}
		//cek index
		let index_data = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran); //cek index yg tersedia
		// ubah data sesuai index
		arrDataD[index_data]["kode_anggaran"] = kode_anggaran;
		arrDataD[index_data]["nama_anggaran"] = nama_anggaran;
		arrDataD[index_data]["status"] = status;
		viewTable();
		$('#modalEdit').modal("hide");
	}

	// === ADD BUDGETING ===
	function addBudgeting(kode_anggaran) {
		// alert("adasd");
		//cek index dari kode induk yg dipilih
		let index_data = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran);
		// level sub anggaran = level indux - 1;
		var nama_induk_anggaran = arrDataD[index_data]["nama_anggaran"];
		var kode_induk_anggaran = arrDataD[index_data]["kode_anggaran"];
		// console.log("aa");
		$("#nama_anggaran_budget").val(kode_induk_anggaran + " - " + nama_induk_anggaran);
		$("#kode_anggaran_budget").val(kode_anggaran);
		viewTableBudget(kode_anggaran);
		$('#modalAddBudgeting').modal("show");

	}
	// reset form modal
	$('#modalAddBudgeting').on('hidden.bs.modal', function(e) {
		$(this)
			.find("input,textarea,select")
			.val('')
			.end()
			.find("input[type=checkbox], input[type=radio]")
			.prop("checked", "")
			.end();
	})

	// save sub anggaran
	function saveBudget() {
		var kode_anggaran = $("#kode_anggaran_budget").val();
		let no = 1;
		let totalBudget = 0;
		// let listBudget = []
		let listBudget = $("input[name='budget[]']").map(function(index) {
			totalBudget += parseInt($(this).val());
			// listBudget.push({
			//     bulan: index + 1,
			//     nama_bulan: arrBulan[index]["nama"],

			//     qty: parseInt($(this).val())
			// })
			return {
				bulan: index + 1,
				nama_bulan: arrBulan[index]["nama"],

				qty: parseInt($(this).val())
			};
		}).get();
		// console.log(listBudget);

		//cek apakah kode sudah terpakai
		let index_data = arrDataBudget.findIndex(item => item.kode_anggaran == kode_anggaran); //cek index yg tersedia
		// jika kode anggaran sudah ada maka alert
		if (index_data >= 0) {
			// jika data ada maka update data budgetb sesuai index
			arrDataBudget[index_data]["budget"] = listBudget
		} else {
			arrDataBudget.push({
				kode_anggaran: kode_anggaran,
				budget: listBudget
			})
		}
		// cari indek data anggaran yg sesuai dengan kode_anggaran
		let index_akun = arrDataD.findIndex(item => item.kode_anggaran == kode_anggaran);
		// update budget di data anggaran 
		arrDataD[index_akun]["budget"] = totalBudget;
		// cek reff akun atasnya
		if (arrDataD[index_akun]["reff_kode"] != null) {
			//cari dari semua array index mana yg reffnya sama
			$.each(arrDataD, function(index, value) {
				if (index != index_akun) {
					if (value.reff_kode == arrDataD[index_akun]["reff_kode"]) {
						totalBudget += value.budget
					}
				}
			})
			// cek index dari akun reff atasnya
			let index_akun1 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun]["reff_kode"]);
			// update tambahkan budget di data anggaran 
			arrDataD[index_akun1]["budget"] = totalBudget;
			// cek reff akun atasnya
			if (arrDataD[index_akun1]["reff_kode"] != null) {
				//cari dari semua array index mana yg reffnya sama
				$.each(arrDataD, function(index, value) {
					if (index != index_akun1) {
						if (value.reff_kode == arrDataD[index_akun1]["reff_kode"]) {
							totalBudget += value.budget
						}
					}
				})
				// cek index dari akun reff atasnya
				let index_akun2 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun1]["reff_kode"]);
				// update tambahkan budget di data anggaran 
				arrDataD[index_akun2]["budget"] = totalBudget;
				// cek reff akun atasnya
				if (arrDataD[index_akun2]["reff_kode"] != null) {
					//cari dari semua array index mana yg reffnya sama
					$.each(arrDataD, function(index, value) {
						if (index != index_akun2) {
							if (value.reff_kode == arrDataD[index_akun2]["reff_kode"]) {
								totalBudget += value.budget
							}
						}
					})
					// cek index dari akun reff atasnya
					let index_akun3 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun2]["reff_kode"]);
					// update tambahkan budget di data anggaran 
					arrDataD[index_akun3]["budget"] = totalBudget;
					// cek reff akun atasnya
					if (arrDataD[index_akun3]["reff_kode"] != null) {
						//cari dari semua array index mana yg reffnya sama
						$.each(arrDataD, function(index, value) {
							if (index != index_akun3) {
								if (value.reff_kode == arrDataD[index_akun3]["reff_kode"]) {
									totalBudget += value.budget
								}
							}
						})
						// cek index dari akun reff atasnya
						let index_akun4 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun3][
							"reff_kode"
						]);
						// update tambahkan budget di data anggaran 
						arrDataD[index_akun4]["budget"] = totalBudget;
						// cek reff akun atasnya
						if (arrDataD[index_akun4]["reff_kode"] != null) {
							//cari dari semua array index mana yg reffnya sama
							$.each(arrDataD, function(index, value) {
								if (index != index_akun4) {
									if (value.reff_kode == arrDataD[index_akun4]["reff_kode"]) {
										totalBudget += value.budget
									}
								}
							})
							// cek index dari akun reff atasnya
							let index_akun5 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun4][
								"reff_kode"
							]);
							// update tambahkan budget di data anggaran 
							arrDataD[index_akun5]["budget"] = totalBudget;
							// cek reff akun atasnya
							if (arrDataD[index_akun5]["reff_kode"] != null) {
								//cari dari semua array index mana yg reffnya sama
								$.each(arrDataD, function(index, value) {
									if (index != index_akun5) {
										if (value.reff_kode == arrDataD[index_akun5]["reff_kode"]) {
											totalBudget += value.budget
										}
									}
								})
								// cek index dari akun reff atasnya
								let index_akun6 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun5][
									"reff_kode"
								]);
								// update tambahkan budget di data anggaran 
								arrDataD[index_akun6]["budget"] = totalBudget;
								// cek reff akun atasnya
								if (arrDataD[index_akun6]["reff_kode"] != null) {
									//cari dari semua array index mana yg reffnya sama
									$.each(arrDataD, function(index, value) {
										if (index != index_akun6) {
											if (value.reff_kode == arrDataD[index_akun6]["reff_kode"]) {
												totalBudget += value.budget
											}
										}
									})
									// cek index dari akun reff atasnya
									let index_akun7 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun6]
										[
											"reff_kode"
										]);
									// update tambahkan budget di data anggaran 
									arrDataD[index_akun7]["budget"] = totalBudget;
									// cek reff akun atasnya
									if (arrDataD[index_akun7]["reff_kode"] != null) {
										//cari dari semua array index mana yg reffnya sama
										$.each(arrDataD, function(index, value) {
											if (index != index_akun7) {
												if (value.reff_kode == arrDataD[index_akun7]["reff_kode"]) {
													totalBudget += value.budget
												}
											}
										})
										// cek index dari akun reff atasnya
										let index_akun8 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[
												index_akun7]
											[
												"reff_kode"
											]);
										// update tambahkan budget di data anggaran 
										arrDataD[index_akun8]["budget"] = totalBudget;
										// cek reff akun atasnya
										if (arrDataD[index_akun8]["reff_kode"] != null) {
											//cari dari semua array index mana yg reffnya sama
											$.each(arrDataD, function(index, value) {
												if (index != index_akun8) {
													if (value.reff_kode == arrDataD[index_akun8]["reff_kode"]) {
														totalBudget += value.budget
													}
												}
											})
											// cek index dari akun reff atasnya
											let index_akun9 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[
													index_akun8]
												[
													"reff_kode"
												]);
											// update tambahkan budget di data anggaran 
											arrDataD[index_akun9]["budget"] = totalBudget;
											// cek reff akun atasnya
											if (arrDataD[index_akun9]["reff_kode"] != null) {
												//cari dari semua array index mana yg reffnya sama
												$.each(arrDataD, function(index, value) {
													if (index != index_akun9) {
														if (value.reff_kode == arrDataD[index_akun9]["reff_kode"]) {
															totalBudget += value.budget
														}
													}
												})
												// cek index dari akun reff atasnya
												let index_akun10 = arrDataD.findIndex(item => item.kode_anggaran ==
													arrDataD[
														index_akun9]
													[
														"reff_kode"
													]);
												// update tambahkan budget di data anggaran 
												arrDataD[index_akun10]["budget"] = totalBudget;

											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		console.log(arrDataBudget);
		viewTable();
		$('#modalAddBudgeting').modal("hide");
	}

	function deleteAnggaran(index_akun) {
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data yang dihapus akan hilang!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value == true) {
				// Swal.fire(
				//     'Deleted!',
				//     'Your file has been deleted.',
				//     'success'
				// )

				//-- UPDATE BUDGATE atasnya  jika akun dihapus

				let totalBudget = 0
				// cek reff akun atasnya
				if (arrDataD[index_akun]["reff_kode"] != null) {
					//cari dari semua array index mana yg reffnya sama
					$.each(arrDataD, function(index, value) {
						if (index != index_akun) {
							if (value.reff_kode == arrDataD[index_akun]["reff_kode"]) {
								totalBudget += value.budget
							}
						}
					})
					// cek index dari akun reff atasnya
					let index_akun1 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun][
						"reff_kode"
					]);
					// update tambahkan budget di data anggaran 
					arrDataD[index_akun1]["budget"] = totalBudget;
					// cek reff akun atasnya
					if (arrDataD[index_akun1]["reff_kode"] != null) {
						//cari dari semua array index mana yg reffnya sama
						$.each(arrDataD, function(index, value) {
							if (index != index_akun1) {
								if (value.reff_kode == arrDataD[index_akun1]["reff_kode"]) {
									totalBudget += value.budget
								}
							}
						})
						// cek index dari akun reff atasnya
						let index_akun2 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun1][
							"reff_kode"
						]);
						// update tambahkan budget di data anggaran 
						arrDataD[index_akun2]["budget"] = totalBudget;
						// cek reff akun atasnya
						if (arrDataD[index_akun2]["reff_kode"] != null) {
							//cari dari semua array index mana yg reffnya sama
							$.each(arrDataD, function(index, value) {
								if (index != index_akun2) {
									if (value.reff_kode == arrDataD[index_akun2]["reff_kode"]) {
										totalBudget += value.budget
									}
								}
							})
							// cek index dari akun reff atasnya
							let index_akun3 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[index_akun2]
								["reff_kode"]);
							// update tambahkan budget di data anggaran 
							arrDataD[index_akun3]["budget"] = totalBudget;
							// cek reff akun atasnya
							if (arrDataD[index_akun3]["reff_kode"] != null) {
								//cari dari semua array index mana yg reffnya sama
								$.each(arrDataD, function(index, value) {
									if (index != index_akun3) {
										if (value.reff_kode == arrDataD[index_akun3]["reff_kode"]) {
											totalBudget += value.budget
										}
									}
								})
								// cek index dari akun reff atasnya
								let index_akun4 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[
									index_akun3][
									"reff_kode"
								]);
								// update tambahkan budget di data anggaran 
								arrDataD[index_akun4]["budget"] = totalBudget;
								// cek reff akun atasnya
								if (arrDataD[index_akun4]["reff_kode"] != null) {
									//cari dari semua array index mana yg reffnya sama
									$.each(arrDataD, function(index, value) {
										if (index != index_akun4) {
											if (value.reff_kode == arrDataD[index_akun4]["reff_kode"]) {
												totalBudget += value.budget
											}
										}
									})
									// cek index dari akun reff atasnya
									let index_akun5 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[
										index_akun4][
										"reff_kode"
									]);
									// update tambahkan budget di data anggaran 
									arrDataD[index_akun5]["budget"] = totalBudget;
									// cek reff akun atasnya
									if (arrDataD[index_akun5]["reff_kode"] != null) {
										//cari dari semua array index mana yg reffnya sama
										$.each(arrDataD, function(index, value) {
											if (index != index_akun5) {
												if (value.reff_kode == arrDataD[index_akun5]["reff_kode"]) {
													totalBudget += value.budget
												}
											}
										})
										// cek index dari akun reff atasnya
										let index_akun6 = arrDataD.findIndex(item => item.kode_anggaran == arrDataD[
											index_akun5][
											"reff_kode"
										]);
										// update tambahkan budget di data anggaran 
										arrDataD[index_akun6]["budget"] = totalBudget;
										// cek reff akun atasnya
										if (arrDataD[index_akun6]["reff_kode"] != null) {
											//cari dari semua array index mana yg reffnya sama
											$.each(arrDataD, function(index, value) {
												if (index != index_akun6) {
													if (value.reff_kode == arrDataD[index_akun6][
															"reff_kode"
														]) {
														totalBudget += value.budget
													}
												}
											})
											// cek index dari akun reff atasnya
											let index_akun7 = arrDataD.findIndex(item => item.kode_anggaran ==
												arrDataD[index_akun6]
												[
													"reff_kode"
												]);
											// update tambahkan budget di data anggaran 
											arrDataD[index_akun7]["budget"] = totalBudget;
											// cek reff akun atasnya
											if (arrDataD[index_akun7]["reff_kode"] != null) {
												//cari dari semua array index mana yg reffnya sama
												$.each(arrDataD, function(index, value) {
													if (index != index_akun7) {
														if (value.reff_kode == arrDataD[index_akun7][
																"reff_kode"
															]) {
															totalBudget += value.budget
														}
													}
												})
												// cek index dari akun reff atasnya
												let index_akun8 = arrDataD.findIndex(item => item.kode_anggaran ==
													arrDataD[
														index_akun7]
													[
														"reff_kode"
													]);
												// update tambahkan budget di data anggaran 
												arrDataD[index_akun8]["budget"] = totalBudget;
												// cek reff akun atasnya
												if (arrDataD[index_akun8]["reff_kode"] != null) {
													//cari dari semua array index mana yg reffnya sama
													$.each(arrDataD, function(index, value) {
														if (index != index_akun8) {
															if (value.reff_kode == arrDataD[index_akun8][
																	"reff_kode"
																]) {
																totalBudget += value.budget
															}
														}
													})
													// cek index dari akun reff atasnya
													let index_akun9 = arrDataD.findIndex(item => item
														.kode_anggaran == arrDataD[
															index_akun8]
														[
															"reff_kode"
														]);
													// update tambahkan budget di data anggaran 
													arrDataD[index_akun9]["budget"] = totalBudget;
													// cek reff akun atasnya
													if (arrDataD[index_akun9]["reff_kode"] != null) {
														//cari dari semua array index mana yg reffnya sama
														$.each(arrDataD, function(index, value) {
															if (index != index_akun9) {
																if (value.reff_kode == arrDataD[index_akun9]
																	["reff_kode"]) {
																	totalBudget += value.budget
																}
															}
														})
														// cek index dari akun reff atasnya
														let index_akun10 = arrDataD.findIndex(item => item
															.kode_anggaran ==
															arrDataD[
																index_akun9]
															[
																"reff_kode"
															]);
														// update tambahkan budget di data anggaran 
														arrDataD[index_akun10]["budget"] = totalBudget;

													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
				// cari index budget yg sesuai anggarannya
				let index_budget = arrDataBudget.findIndex(item => item.kode_anggaran == arrDataD[index_akun][
					"kode_anggaran"
				])
				// delete budget jika ada
				if (index_budget >= 0) {
					arrDataBudget.splice(index_budget, 1);
				}
				//delete data anggaran
				arrDataD.splice(index_akun, 1);
				viewTable();
			}
		})
	}
	// untuk remder body / isi table Anggaran setiap ada perubahan
	function viewTable() {
		// alert('asdas')
		$("#tableAnggaran tbody").empty();
		let jumlah_level = $("#jumlah_level").val()
		let no = 1;
		//filer sort orderby float kode_anggaran ASC
		let dataSort = arrDataD.sort((a, b) => parseFloat(a.kode_anggaran) - parseFloat(b.kode_anggaran));
		// console.log(dataSort);
		$.each(dataSort, function(index, value) {
			// console.log(index);
			var kode_anggaran = String(value.kode_anggaran);
			var petik = "'";
			var hapus = "";
			//cek apakah ada akun reff atas kode tsb
			let index_akunReff = arrDataD.findIndex(item => item.reff_kode == kode_anggaran)
			//cek apakah ada level dibahawnya, jika tidak maka tampilkan btn delet
			if (index_akunReff < 0) {
				hapus = '<a class="btn btn-danger" title="Delete" onclick="deleteAnggaran(' + index +
					')"><i class="fa fa-trash" aria-hidden="true"></i></a>'
			}
			if (value.level != 0) {
				var action = '<a class="btn btn-warning" title="Edit" onclick="editAnggaran(' + petik +
					kode_anggaran + petik +
					')"><i class="fas fa-edit"></i></a><a class="btn btn-primary" onclick="addSubAnggaran(' +
					petik + kode_anggaran +
					petik +
					')">Sub Anggaran</a>'
				if (value.level == jumlah_level - 1) {
					var style = 'style="font-weight:bold;background-color:lightgrey" ';
				} else {
					var style = 'style="font-weight:bold"';
				}
			} else {
				var style = "";
				var action = '<a class="btn btn-warning" title="Edit" onclick="editAnggaran(' + petik +
					kode_anggaran + petik +
					')"><i class="fas fa-edit"></i></a><a class="btn btn-success" onclick="addBudgeting(' + petik +
					kode_anggaran + petik +
					')">Budgeting</a>'
			}
			$('#tableAnggaran tbody').append(`
            <tr ${style}>
                <td style='vertical-align:middle; text-align: center;' >${no}</td>
                <td style='vertical-align:middle; ' >${value.kode_anggaran}<input type="hidden" class="form-control" name="sku_id[]" value="${value.sku_id}"></td>
                <td style='vertical-align:middle; ' >${value.nama_anggaran}</td>
                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(value.budget)}</td>
                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(value.alokasi)}</td>
                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(value.terpakai)}</td>
                <td style='vertical-align:middle; text-align: center;' >${formatRupiah(value.alokasi - value.terpakai)}</td>
                <td style='vertical-align:middle; text-align: center;' >${value.status}</td>
                <td style='vertical-align:middle; ' >${action}${hapus}</td>
           </tr>
        `);

			// tableDO.row.add(tr[0]).draw()
			no++;
		})
	}

	// untuk render body / isi table Budget setiap ada perubahan
	function viewTableBudget(kode_anggaran) {
		console.log(kode_anggaran);
		$("#tableBudget tbody").empty();
		let no = 1;
		if (arrDataBudget.length > 0) {
			//cek apakah ada budget yg telah disimpan
			let index_data = arrDataBudget.findIndex(item => item.kode_anggaran == kode_anggaran);
			console.log(index_data);
			if (index_data >= 0) {
				// data Budget dari index yg ada
				let data = arrDataBudget[index_data]["budget"];
				$.each(data, function(index, value) {
					$('#tableBudget tbody').append(`
                    <tr>
                        <td style='vertical-align:middle; text-align: center;' >${value.bulan}</td>
                        <td style='vertical-align:middle; ' >${arrBulan[index]["nama"]}</td>
                        <td style='vertical-align:middle; ' ><input type="number" class="form-control" name="budget[]" id="budget-${value.bulan}" value="${value.qty}"></td>
                   </tr>
                `);
				})
			} else {
				// mengacu pada total bulan
				$.each(arrBulan, function(index, value) {
					$('#tableBudget tbody').append(`
                    <tr>
                        <td style='vertical-align:middle; text-align: center;' >${value.no}</td>
                        <td style='vertical-align:middle; ' >${value.nama}</td>
                        <td style='vertical-align:middle; ' ><input type="number" class="form-control" name="budget[]" id="budget-${value.no}" value="0"></td>
                   </tr>
                `);
				})
			}
		} else {
			// mengacu pada total bulan
			$.each(arrBulan, function(index, value) {
				$('#tableBudget tbody').append(`
                <tr>
                    <td style='vertical-align:middle; text-align: center;' >${value.no}</td>
                    <td style='vertical-align:middle; ' >${value.nama}</td>
                    <td style='vertical-align:middle; ' ><input type="number" class="form-control" name="budget[]" id="budget-${value.no}" value="0"></td>
               </tr>
            `);
			})
		}

	}

	function formatRupiah(angka, prefix) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}

	function addApproval() {
		if ($('#approval').is(':checked')) {
			$('#anggaran_detail_status').val('In progress approval')
		} else {
			$('#anggaran_detail_status').val('Draft')
		}
	}
</script>
