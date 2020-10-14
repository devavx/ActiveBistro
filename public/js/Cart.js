ask = (message = 'Are you sure?', callback = null) => {
	bootbox.confirm({
		message: message,
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
			if (result && callback != null) {
				callback();
			}
		}
	});
};

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

cloneMeal = (day, mealId) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/quantity/' + day + '/' + mealId + '/clone',
			success: (message, data) => {
				notyf.success(message);
				fadeAndRerender(data);
			},
			failed: (message) => {

			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};

deleteMeal = (day, mealId) => {
	ask('Remove item from cart entirely?', () => {
		setLoading(true, () => {
			performGet({
				url: '/cart/quantity/' + day + '/' + mealId + '/delete',
				success: (message, data) => {
					notyf.success(message);
					fadeAndRerender(data);
				},
				failed: message => {

				},
				complete: () => {
					setLoading(false);
				}
			});
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
	ask('Remove item from cart entirely?', () => {
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
	});
};

rebuildCarousel = () => {
	$(".owl-carousel1").owlCarousel({
		center: true,
		loop: false,
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
				loop: true
			},
			1000: {
				items: 3,
				nav: true
			}
		}
	});
};

fadeAndRerender = (data) => {
	const element = $('#main_container');
	element.fadeTo('fast', 0.0, function () {
		element.html(data);
		rebuildCarousel();
		element.fadeTo('slow', 1.0);
	});
}

initialized = () => {

};