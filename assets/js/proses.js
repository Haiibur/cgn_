function pratinjau1(event) {
	if (event.target.files.length > 0) {
		var src = URL.createObjectURL(event.target.files[0]);
		var prev = document.getElementById("imgPratinjau1");
		prev.src = src;
		prev.style.display = "block";
		prev.style.width = "100%";
		prev.style.height = "160";
	}
}

function pratinjau2(event) {
	if (event.target.files.length > 0) {
		var src = URL.createObjectURL(event.target.files[0]);
		var prev = document.getElementById("imgPratinjau2");
		prev.src = src;
		prev.style.display = "block";
		prev.style.width = "100%";
		prev.style.height = "160";
	}
}

function pratinjau3(event) {
	if (event.target.files.length > 0) {
		var src = URL.createObjectURL(event.target.files[0]);
		var prev = document.getElementById("imgPratinjau3");
		prev.src = src;
		prev.style.display = "block";
		prev.style.width = "100%";
		prev.style.height = "160";
	}
}

function pratinjau4(event) {
	if (event.target.files.length > 0) {
		var src = URL.createObjectURL(event.target.files[0]);
		var prev = document.getElementById("imgPratinjau4");
		prev.src = src;
		prev.style.display = "block";
		prev.style.width = "100%";
		prev.style.height = "160";
	}
}

function pratinjau5(event) {
	if (event.target.files.length > 0) {
		var src = URL.createObjectURL(event.target.files[0]);
		var prev = document.getElementById("imgPratinjau5");
		prev.src = src;
		prev.style.display = "block";
		prev.style.width = "100%";
		prev.style.height = "160";
	}
}

function isURL(string) {
	let url;
	try {
		url = new URL(string);
	} catch (_) {
		return false;
	}
	return url.protocol === "http:" || url.protocol === "https:";
}

$(function () {
	const $table = $("#table");
	const allID = [...$("#form").find("[id]")].map((item) => item.id);
	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 2000,
	});
	$(".select2").select2();
	$(".DataLink").click(function () {
		window.open($(this).data("id"), "_blank");
	});

	$("#form").submit(function (event) {
		for (var instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		var loading = $(this).find("#loading");
		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			beforeSend: function () {
				loading.html(
					"<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>"
				);
			},
			success: function () {
				$("#loading div").remove();
				$("#BSmodal").modal("hide");
				Toast.fire({
					type: "success",
					title: "Berhasil",
				});
			},
			error: function () {
				Toast.fire({
					type: "error",
					title: "Terjadi kesalahan, coba lagi",
				});
			},
			complete: function () {
				$("#form")[0].reset();
				$("#form").find("img").removeAttr("src style");
				for (var instance in CKEDITOR.instances) {
					CKEDITOR.instances[instance].updateElement();
					CKEDITOR.instances[instance].setData("");
				}
				$table.bootstrapTable("refresh");
			},
		});
		event.preventDefault();
	});

	$("#formData").submit(function (event) {
		event.preventDefault();
		const back = $(this).attr("role");
		for (var instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}
		$("#loading2").html(
			"<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>"
		);
		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function () {
				Toast.fire({
					type: "success",
					title: "Berhasil",
				});
			},
			error: function () {
				$("#loading2").hide();
				Toast.fire({
					type: "error",
					title: "Terjadi kesalahan, coba lagi",
				});
			},
			complete: function () {
				$("#loading2").hide();
				setTimeout(() => {
					window.location.href = back;
				}, 2100);
			},
		});
	});

	$("#formNav").submit(function (event) {
		event.preventDefault();
		$("#loading3").html(
			"<div class='spinner-border spinner-border-sm text-warning' role='status'><span class='sr-only'>Loading...</span></div>"
		);
		$.ajax({
			url: $(this).attr("action"),
			method: $(this).attr("method"),
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			async: false,
			success: function () {
				$("#header_modal").modal("hide");
				Toast.fire({
					type: "success",
					title: "Berhasil",
				});
			},
			error: function () {
				$("#loading3").hide();
				Toast.fire({
					type: "error",
					title: "Terjadi kesalahan, coba lagi",
				});
			},
			complete: function () {
				$("#loading3").hide();
				setTimeout(() => {
					location.reload();
				}, 2100);
			},
		});
	});

	$("#btnCreate").click(function (event) {
		$.ajax({
			url: $(this).attr("href"),
			method: "GET",
			success: (data) => {
				allID.forEach((element) => {
					for (const [key, val] of Object.entries(data)) {
						if (key === "action") {
							$("#form").attr("action", data.action);
						} else if (element === key) {
							if ($("#" + key).prop("tagName") === "SELECT") {
								$("#" + key).empty();
								for (let i = 0; i < val.length; ++i) {
									$("#" + key).append(
										"<option value='" +
											Object.keys(val[i]) +
											"'>" +
											Object.values(val[i]) +
											"</option>"
									);
									$("#" + key)
										.find("option")
										.each(function () {
											let ini = $(this);
											if (ini.val() == data.selected) {
												ini.attr("selected", "selected");
												return false;
											}
										});
								}
							} else if ($("#" + key).prop("tagName") === "IMG") {
								if (isURL(val)) {
									$("#" + key)
										.attr("src", val)
										.css("width", "100%")
										.css("height", "160");
								}
							} else if ($("#" + key).prop("tagName") === "TEXTAREA") {
								for (var instance in CKEDITOR.instances) {
									CKEDITOR.instances[instance].setData(val);
								}
							} else if ($("#" + key).prop("tagName") === "INPUT") {
								$("#" + key).val(val);
							}
						}
					}
				});
			},
			complete: () => {
				$(".modal-header h4").text("Form Tambah Data");
				$("#BSmodal").modal({
					keyboard: false,
					backdrop: "static",
					show: true,
				});
			},
		});
		event.preventDefault();
	});

	$("#btnRetrieve").click(function (event) {
		// Edit Data
		const $id = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.id;
		});
		let count = Object.keys($id).length;
		if ($id != "") {
			if (count > 1) {
				Toast.fire({
					icon: "info",
					title: "Data yang dipilih lebih dari satu",
				});
			} else {
				$.ajax({
					url: $(this).attr("href") + $id,
					method: "GET",
					success: (data) => {
						allID.forEach((element) => {
							for (const [key, val] of Object.entries(data)) {
								if (key === "action") {
									$("#form").attr("action", data.action);
								} else if (element === key) {
									if ($("#" + key).prop("tagName") === "SELECT") {
										$("#" + key).empty();
										for (let i = 0; i < val.length; ++i) {
											$("#" + key).append(
												"<option value='" +
													Object.keys(val[i]) +
													"'>" +
													Object.values(val[i]) +
													"</option>"
											);
											$("#" + key)
												.find("option")
												.each(function () {
													let ini = $(this);
													if (ini.val() == data.selected) {
														ini.attr("selected", "selected");
														return false;
													}
												});
										}
									} else if ($("#" + key).prop("tagName") === "IMG") {
										if (isURL(val)) {
											$("#" + key)
												.attr("src", val)
												.css("width", "100%")
												.css("height", "160");
										}
									} else if ($("#" + key).prop("tagName") === "TEXTAREA") {
										for (var instance in CKEDITOR.instances) {
											CKEDITOR.instances[instance].setData(val);
										}
									} else if ($("#" + key).prop("tagName") === "INPUT") {
										$("#" + key).val(val);
									}
								}
							}
						});
					},
					complete: () => {
						$(".modal-header h4").text("Form Edit Data");
						$("#BSmodal").modal({
							keyboard: false,
							backdrop: "static",
							show: true,
						});
					},
				});
			}
		} else {
			Toast.fire({
				icon: "info",
				title: "Anda belum memilih data",
			});
		}
		event.preventDefault();
	});

	$("#btnActivate").click(function (event) {
		// Mengaktifkan Data
		const $id = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.id;
		});
		let count = Object.keys($id).length;
		if ($id != "") {
			if (count > 1) {
				Toast.fire({
					icon: "info",
					title: "Data yang dipilih lebih dari satu",
				});
			} else {
				$.ajax({
					url: $(this).attr("href"),
					method: "POST",
					data: {
						id: $id,
						status: 1,
					},
					success: function () {
						Toast.fire({
							icon: "success",
							title: "Berhasil",
						});
					},
					complete: function () {
						$table.bootstrapTable("refresh");
					},
				});
			}
		} else {
			Toast.fire({
				icon: "info",
				title: "Anda belum memilih data",
			});
		}
		event.preventDefault();
	});

	$("#btnDeactivate").click(function (event) {
		// Nonaktikan Data
		const $id = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.id;
		});
		let count = Object.keys($id).length;
		if ($id != "") {
			if (count > 1) {
				Toast.fire({
					icon: "info",
					title: "Data yang dipilih lebih dari satu",
				});
			} else {
				$.ajax({
					url: $(this).attr("href"),
					method: "POST",
					data: {
						id: $id,
						status: 2,
					},
					success: function () {
						Toast.fire({
							icon: "success",
							title: "Berhasil",
						});
					},
					complete: function () {
						$table.bootstrapTable("refresh");
					},
				});
			}
		} else {
			Toast.fire({
				icon: "info",
				title: "Anda belum memilih data",
			});
		}
		event.preventDefault();
	});

	$("#btnDestroy").click(function (event) {
		// Hapus Data
		const $ids = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.ids;
		});

		const $ids2 = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.ids2;
		});

		if ($ids != "") {
			Swal.fire({
				title: "Anda Yakin?",
				text: "Akan menghapus data ini!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, Hapus!",
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: $(this).attr("href"),
						method: "POST",
						data: { id: $ids },
						success: function () {
							Toast.fire({
								icon: "success",
								title: "Berhasil",
							});
						},
						error: function () {
							Toast.fire({
								icon: "error",
								title: "Terjadi kesalahan, coba lagi",
							});
						},
						complete: function () {
							$table.bootstrapTable("refresh");
						},
					});
				}
			});
		} else {
			Toast.fire({
				icon: "info",
				title: "Anda belum memilih data",
			});
		}
		event.preventDefault();
	});

	$("#btnRedir").click(function (event) {
		// Edit Data Redirect Page
		const $id = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.id;
		});
		let count = Object.keys($id).length;
		if ($id != "") {
			if (count > 1) {
				Toast.fire({
					icon: "info",
					title: "Anda memilih lebih dari satu data!",
				});
			} else {
				window.location.href = $(this).attr("href") + $id;
			}
		} else {
			Toast.fire({
				icon: "warning",
				title: "Anda belum memilih data",
			});
		}
		event.preventDefault();
	});

	$("#btnRedir2").click(function (event) {
		// Edit Data Redirect Page
		const $id = $.map($table.bootstrapTable("getSelections"), (row) => {
			return row.id;
		});
		let count = Object.keys($id).length;
		if ($id != "") {
			if (count > 1) {
				Toast.fire({
					icon: "info",
					title: "Anda memilih lebih dari satu data!",
				});
			} else {
				window.location.href = $(this).attr("href") + $id;
			}
		} else {
			Toast.fire({
				icon: "warning",
				title: "Anda belum memilih data",
			});
		}
		event.preventDefault();
	});

	$("[data-dismiss='modal']").click(function (event) {
		const form = $(this).parents(".modal").find("form");
		form[0].reset();
		form.find("img").removeAttr("src style");
		form.find("select").removeAttr("selected");
		for (var instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
			CKEDITOR.instances[instance].setData("");
		}
	});

	$("#btnNavEdit").click(function (event) {
		// Edit Navbar
		const navID = [...$("#navForm").find("[id]")].map((item) => item.id);
		$.ajax({
			url: $(this).attr("href"),
			method: "GET",
			success: (data) => {
				navID.forEach((element) => {
					for (const [key, val] of Object.entries(data)) {
						if (key === "action") {
							$("#form").attr("action", data.action);
						} else if (element === key) {
							if ($("#" + key).prop("tagName") === "SELECT") {
								$("#" + key).empty();
								for (let i = 0; i < val.length; ++i) {
									$("#" + key).append(
										"<option value='" +
											Object.keys(val[i]) +
											"'>" +
											Object.values(val[i]) +
											"</option>"
									);
									$("#" + key)
										.find("option")
										.each(function () {
											let ini = $(this);
											if (ini.val() == data.selected) {
												ini.attr("selected", "selected");
												return false;
											}
										});
								}
							} else if ($("#" + key).prop("tagName") === "IMG") {
								if (isURL(val)) {
									$("#" + key)
										.attr("src", val)
										.css("width", "100%")
										.css("height", "200");
								}
							} else if ($("#" + key).prop("tagName") === "TEXTAREA") {
								for (var instance in CKEDITOR.instances) {
									CKEDITOR.instances[instance].setData(val);
								}
							} else if ($("#" + key).prop("tagName") === "INPUT") {
								$("#" + key).val(val);
							}
						}
					}
				});
			},
			complete: () => {
				$("#navModal").modal({
					keyboard: false,
					backdrop: "static",
					show: true,
				});
			},
		});
		event.preventDefault();
	});
});
