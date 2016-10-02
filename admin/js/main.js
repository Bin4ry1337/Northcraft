$(document).ready(function() {
	$(document).foundation();
	$('.alert-box').closest('[data-alert]').fadeOut(2500);
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
});