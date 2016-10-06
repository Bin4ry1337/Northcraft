$(document).ready(function()
{
	var open         = true;
	var timeline2    = $('#timeline-two');
	var normalHeight = 220;
	var maxHeight    = 675;

	timeline2.on('click', function()
	{
		if(open)
		{
			timeline2.animate({height: maxHeight}, 400);
			$('.timeline-two-content').fadeIn(500).css('display', 'normal');
			open = false;
		}
		else
		{
			timeline2.animate({height: normalHeight}, 400);
			$('.timeline-two-content').fadeOut(300, function()
			{
				$('.timeline-two-content').css('display', 'none');
			});
			open = true;
		}
	});
});