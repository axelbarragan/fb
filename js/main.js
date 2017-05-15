var preloader = $('.preloader');
$(window).on('load', function() {
	preloader.fadeOut(1000, function(){ $(this).remove();});
	//console.log("SE QUITO");
	$(function(){
		$(".element").typed({
			strings: ["tu sitio web.", "la identidad corporativa.","la publicidad que necesitas."],
			loop: true,
			typeSpeed: 60,
			backSpeed: 0,
		});

    /*Tooltip*/
		$('.tool').tooltip();



		$('.nav a').click(function(){
			$('.navbar-ex1-collapse').collapse('hide');
		});

    /*Waypoint*/
    $('#quienes-somos').css('opacity', 0);
		$('.ser-general').css('opacity', 0);
		$('.mmv').css('opacity', 0);
		$('.tecnologias').css('opacity', 0);

		$('#quienes-somos').waypoint(function() {
			$('#quienes-somos').addClass('fadeInUp');
		}, { offset: '70%' });

		$('.ser-general').waypoint(function() {
			$('.ser-general').addClass('bounceIn');
		}, { offset: '70%' });

		$('.mmv').waypoint(function() {
			$('.mmv').addClass('bounceIn');
		}, { offset: '70%' });

		$('.tecnologias').waypoint(function() {
			$('.tecnologias').addClass('bounceIn');
		}, { offset: '70%' });

	});
});