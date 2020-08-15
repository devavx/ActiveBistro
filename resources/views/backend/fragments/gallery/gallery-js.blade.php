@if(!isset($prefix))
	const gallery = $('.file-gallery').dropify({
	messages: {
	default: "Click to choose..."
	}
	});
@else
	const gallery = $('.file-gallery').dropify({
	messages: {
	default: "Click to choose..."
	}
	});
	gallery.on('dropify.afterClear', function (event, element) {
	performGet({
	url: '{{$prefix}}' + '/' + element.element.getAttribute('data-key'),
	success: (message, data) => {
	},
	failed: (message) => {
	},
	complete: () => {
	}
	});
	});
	$('.file-gallery').change(function () {
	performGet({
	url: '{{$prefix}}' + '/' + event.currentTarget.getAttribute('data-key'),
	success: (message, data) => {
	},
	failed: (message) => {
	},
	complete: () => {
	}
	});
	})
@endif