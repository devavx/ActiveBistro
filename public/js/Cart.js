handleItemChanged = (mealId, slab, itemId, price, name, day) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/replace/' + day + '/' + slab + '/' + mealId + '/' + itemId,
			success: (message, data) => {
				notyf.success('Your changes have been successfully saved!');
				reload();
			},
			failed: (message) => {

			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};

increaseQuantity = (day, mealId) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/quantity/' + day + '/' + mealId + '/increase',
			success: (message, data) => {
				notyf.success(message);
				$('#main_container').fadeTo('fast', 0.0, function () {
					$('#main_container').html(data);
					$(".owl-carousel1").owlCarousel({
						// loop: true,
						center: true,
						margin: 0,

						responsiveClass: true,
						nav: false,
						responsive: {
							0: {
								items: 1,
								nav: false
							},
							680: {
								items: 2,
								nav: false,
								loop: false
							},
							1000: {
								items: 3,
								nav: true
							}
						}
					});
					$('#main_container').fadeTo('slow', 1.0);
				});
			},
			failed: (message) => {

			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};

decreaseQuantity = (day, mealId) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/quantity/' + day + '/' + mealId + '/decrease',
			success: (message, data) => {
				notyf.success(message);
				$('#main_container').fadeTo('fast', 0.0, function () {
					$('#main_container').html(data);
					$(".owl-carousel1").owlCarousel({
						// loop: true,
						center: true,
						margin: 0,

						responsiveClass: true,
						nav: false,
						responsive: {
							0: {
								items: 1,
								nav: false
							},
							680: {
								items: 2,
								nav: false,
								loop: false
							},
							1000: {
								items: 3,
								nav: true
							}
						}
					});
					$('#main_container').fadeTo('slow', 1.0);
				});
			},
			failed: (message) => {

			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};

addItem = (day, itemId) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/items/add/' + day + '/' + itemId,
			success: (message, data) => {
				reload();
				notyf.success(message);
			},
			failed: (message) => {
				notyf.error(message);
			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};

removeItem = (day, itemId) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/items/remove/' + day + '/' + itemId,
			success: (message, data) => {
				reload();
				notyf.success(message);
			},
			failed: (message) => {
				notyf.error(message);
			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};

deleteItem = (day, itemId) => {
	bootbox.confirm({
		message: "Remove item from cart entirely?",
		centerVertical: true,
		buttons: {
			confirm: {
				label: 'Yes',
				className: 'btn btn-outline-muted'
			},
			cancel: {
				label: 'No',
				className: 'btn btn-outline-muted'
			}
		},
		callback: function (result) {
			if (result) {
				setLoading(true, () => {
					performGet({
						url: '/cart/items/delete/' + day + '/' + itemId,
						success: (message, data) => {
							reload();
							notyf.success(message);
						},
						failed: (message) => {
							notyf.error(message);
						},
						complete: () => {
							setLoading(false);
						}
					});
				});
			}
		}
	});
};

rebuildCarousel = () => {

};

initialized = () => {

};