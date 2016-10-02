$(document).ready(function() {
	$(document).foundation('dropdown');

	$('a.open-login').on('click', function() {
	  	$('#login-modal').foundation('reveal','open');
	});

	$('a.open-register').on('click', function() {
	  	$('#register-modal').foundation('reveal', 'open');
	});

	$('a.close').on('click', function() {
	  	$('#register-modal').foundation('reveal', 'close');
	});

	$('a.close').on('click', function() {
	  	$('#login-modal').foundation('reveal', 'close');
	});

	/* This is basic - uses default settings */		
	$("a#single_image").fancybox();
			
	/* Using custom settings */		
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});

	/* Apply fancybox to multiple items */		
	$("a.group").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
		'titleShow'     :   true
	});	
});