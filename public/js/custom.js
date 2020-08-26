/// some script
$(function () {
	'use strict'

	$("[data-trigger]").on("click", function () {
		var trigger_id = $(this).attr('data-trigger');
		$(trigger_id).toggleClass("show");
		$('body').toggleClass("offcanvas-active");
	});

	// close if press ESC button
	$(document).on('keydown', function (event) {
		if (event.keyCode === 27) {
			$(".navbar-collapse").removeClass("show");
			$("body").removeClass("overlay-active");
		}
	});

	// close button
	$(".btn-close").click(function (e) {
		$(".navbar-collapse").removeClass("show");
		$("body").removeClass("offcanvas-active");
	});


})

function destoryConfirmMessage(type, id, url) {
	swal({
		title: "Are you sure?",
		text: "This action can not be reserved!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				document.getElementById(type + id).submit();
			} else {
				// swal("Your imaginary file is safe!");
			}
		});
}

function deleteConfirmMessage(id, url, buttonId) {
	swal({
		title: "Are you sure?",
		text: "This action can not be reversed!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: url,
					cache: false,
					dataType: 'json',
					contentType: false,
					processData: false,
					beforeSend: function () {
						$(buttonId).prop('disabled', true);
						$(buttonId).html('Deleting...!!');
					},
					success: function (result) {
						$(buttonId).prop('disabled', false);
						switch (result.status) {
							case 'success':
								(function ($) {
									"use strict";
									Lobibox.notify('success', {
										position: 'top right',
										msg: result.message
									});
								})(jQuery);

								setTimeout(function () {
										location.reload();
									},
									2000);
								break;
							case 'error':
								(function ($) {
									"use strict";
									Lobibox.notify('error', {
										position: 'top right',
										msg: result.message
									});
								})(jQuery);
								break;
							default:
								alert('Invalid Responce!!!');
								break;
						}
						;

					},
					error: function () {
						alert('Something Went Worng!!');
					}
				});
			} else {
				// swal("Your imaginary file is safe!");
			}
		});
}

function deleteConfirmMessageBulk(url, items) {
	swal({
		title: "Are you sure?",
		text: "This action can not be reversed!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((result) => {
		if (result) {
			performDeleteBulk({
				url: url,
				data: {items: items},
				success: function (message) {
					Lobibox.notify('success', {
						position: 'top right',
						msg: message
					});
					setTimeout(function () {
						window.location.reload();
					}, 1000);
				},
				failed: function (message) {
					Lobibox.notify('error', {
						position: 'top right',
						msg: message
					});
				}
			});
		}
	});
}

function changeStatusConfirmMessage(id, url, buttonId) {
	swal({
		title: "Are you sure?",
		text: "Changing active status will control visibility of some items.",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: url,
					cache: false,
					dataType: 'json',
					contentType: false,
					processData: false,
					beforeSend: function () {
						$(buttonId).prop('disabled', true);
						$(buttonId).html('Deleting...!!');
					},
					success: function (result) {
						$(buttonId).prop('disabled', false);
						switch (result.status) {
							case 'success':
								(function ($) {
									"use strict";
									Lobibox.notify('success', {
										position: 'top right',
										msg: result.message
									});
								})(jQuery);

								setTimeout(function () {
										location.reload();
									},
									2000);
								break;
							case 'error':
								(function ($) {
									"use strict";
									Lobibox.notify('error', {
										position: 'top right',
										msg: result.message
									});
								})(jQuery);
								break;
							default:
								alert('Invalid Responce!!!');
								break;
						}
						;

					},
					error: function () {
						alert('Something went wrong!!');
					}
				});
			} else {
				// swal("Your imaginary file is safe!");
			}
		});
}

function showConfirmMessage(type, id, url) {
	swal({
		title: "Are you sure?",
		text: "This action can not be reserved!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
		.then((willDelete) => {
			if (willDelete) {
				$.get(url, {}, function (data) {
					var obj = JSON.parse(data);
					switch (obj.status) {
						case 'success':
							swal(obj.message, {
								icon: "success",
							});
							setTimeout(function () {
									location.reload();
								},
								2000);
							break;
						case 'error':
							swal(obj.message, {
								icon: "warning",
							});
							setTimeout(function () {
									location.reload();
								},
								2000);
							break;
						default:
							alert('Invalid Responce!!!');
							break;
					}
					;
				});
			} else {
				// swal("Your imaginary file is safe!");
			}
		});
}

function saveAjaxData(formId, url, buttonId) {
	var data = $(formId).serialize();
	$.ajax({
		type: 'post',
		data: new FormData($(formId)[0]),
		url: url,
		cache: false,
		dataType: 'json',
		contentType: false,
		processData: false,
		beforeSend: function () {
			$(buttonId).prop('disabled', true);
			$(buttonId).html('Please Wait!!');
		},
		success: function (result) {

			$(buttonId).prop('disabled', false);
			$(buttonId).html('SAVE');
			switch (result.status) {
				case 'success':
					(function ($) {
						"use strict";
						Lobibox.notify('success', {
							position: 'top right',
							msg: result.message
						});
					})(jQuery);

					setTimeout(function () {
							location.reload();
						},
						2000);
					break;
				case 'error':
					(function ($) {
						"use strict";
						Lobibox.notify('error', {
							position: 'top right',
							msg: result.message
						});
					})(jQuery);
					break;
				default:
					alert('Invalid Responce!!!');
					break;
			}
			;

		},
		error: function (data) {
			$(buttonId).prop('disabled', false);
			$(buttonId).html('SAVE');

			(function ($) {
				"use strict";
				Lobibox.notify('error', {
					position: 'top right',
					msg: data.responseJSON.message
				});
			})(jQuery);
			// console.log(data.responseJSON.message);
		}
	});
}

//On Country Change
$('#country_id').on('change', function () {
	var id = $(this).val();
	$('#state_id').val(null);
	$('#state_id option').remove();
	// Fetch the preselected item, and add to the control
	var stateSelect = $('#state_id');
	$.ajax({
		type: 'GET',
		url: "/admin/state/stateByCountry/" + id
	}).then(function (data) {
		// create the option and append to Select2
		for (i = 0; i < data.length; i++) {
			var item = data[i]
			var option = new Option(item.name, item.id, true, true);
			stateSelect.append(option);
		}
		stateSelect.trigger('change');
	});
});

function fetch_data(page, sort_type, sort_by, query, data, model_name) {
	$.ajax({
		url: "/admin/" + model_name + "?page=" + page + "&sortby=" + sort_by + "&sorttype=" + sort_type + "&query=" + query + "&data=" + data,
		beforeSend: function () {
			$('#cover-spin').show();
		},
		success: function (data) {
			$('#cover-spin').hide();
			$('tbody').html('');
			$('tbody').html(data);
		},
		error: function () {
			alert('Somthing Went Wrong!');
			$('#cover-spin').hide();
		}
	});
}
