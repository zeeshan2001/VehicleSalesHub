<div id="overlay">
<div id="loader-container">
<span id="loader-text">UPDATING...</span>
</div>
</div>
<script src="includes/loader/spin.js" type="text/javascript"></script>
<script>
		 var opts = {
			lines: 13, // The number of lines to draw
			length: 10, // The length of each line
			width: 5, // The line thickness
			radius: 16, // The radius of the inner circle
			corners: 0, // Corner roundness (0..1)
			rotate: 0, // The rotation offset
			color: '#000', // #rgb or #rrggbb
			speed: 1, // Rounds per second
			trail: 60, // Afterglow percentage
			shadow: false, // Whether to render a shadow
			hwaccel: false, // Whether to use hardware acceleration
			className: 'spinner', // The CSS class to assign to the spinner
			zIndex: 2e9, // The z-index (defaults to 2000000000)
			top: '42px', // Top position relative to parent in px
			left: '44px' // Left position relative to parent in px
		};
		var target = document.getElementById('loader-container');
		var spinner = new Spinner(opts).stop(target);
	</script>
