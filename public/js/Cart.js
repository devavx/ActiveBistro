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

decreaseQuantity = (day, mealId) => {
	setLoading(true, () => {
		performGet({
			url: '/cart/quantity/' + day + '/' + mealId + '/decrease',
			success: (message, data) => {
				reload();
				notyf.success('Your changes have been successfully saved!');
			},
			failed: (message) => {

			},
			complete: () => {
				setLoading(false);
			}
		});
	});
};