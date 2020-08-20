handleItemChanged = (mealId, slab, key, price, name) => {
	$('#target_' + mealId + '_' + slab + '_price').html(' ' + price + ' ');
	$('#target_' + mealId + '_' + slab + '_name').html(' ' + name + ' ');
};