jQuery(document).ready(function ($) {
	// Photo/Icon panel
	$('body').on('click', '.su-panel-clickable', function (e) {
		var $tab = $(this),
		    data = $tab.data();

		document.location.href = data.url;
		// Open specified url
        if (data.url !== '') {
            if (data.target === 'self') window.location = data.url;
            else if (data.target === 'blank') window.open(data.url);
        }
        e.preventDefault();
	});
});