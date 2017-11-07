var depuracao=false;
var retornoJS;
function callbackajx(murl,fmData,beforesend_case,done_case,error_case){
	$.ajax({
		method:"POST",
		url: murl,
		data:fmData,
		processData: false,
		cache: false,
		contentType: false,
		beforeSend: beforesend_case
	}).done(done_case).error(error_case);
}
jQuery(function($) {
	//Preloader
	var preloader = $('.preloader');
	$(window).load(function(){
		preloader.remove();
	});

	//#main-slider
	var slideHeight = $(window).height();
	$('#home-slider .item').css('height',slideHeight);

	$(window).resize(function(){'use strict',
		$('#home-slider .item').css('height',slideHeight);
	});

	//Scroll Menu
	$(window).on('scroll', function(){
		if( $(window).scrollTop()>slideHeight ){
			$('.main-nav').addClass('navbar-fixed-top');
		} else {
			$('.main-nav').removeClass('navbar-fixed-top');
		}
	});

	// Navigation Scroll
	$(window).scroll(function(event) {
		Scroll();
	});

	$('.navbar-collapse ul li a,.objScrollLento').on('click', function() {
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 50}, 1000);
		return false;
	});

	// User define function
	function Scroll() {
		var contentTop      =   [];
		var contentBottom   =   [];
		var winTop      =   $(window).scrollTop();
		var rangeTop    =   200;
		var rangeBottom =   500;
		$('.navbar-collapse').find('.scroll a').each(function(){
			contentTop.push( $( $(this).attr('href') ).offset().top);
			contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
		})
		$.each( contentTop, function(i){
			if ( winTop > contentTop[i] - rangeTop ){
				$('.navbar-collapse li.scroll')
				.removeClass('active')
				.eq(i).addClass('active');
			}
		})
	};

	$('#tohash').on('click', function(){
		$('html, body').animate({scrollTop: $(this.hash).offset().top-45}, 800);

		return false;
	});

	//Initiat WOW JS
	new WOW().init();
	//smoothScroll
	smoothScroll.init();

	// Progress Bar
	$('#sobre-nos').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
		if (visible) {
			$.each($('div.progress-bar'),function(){
				$(this).css('width', $(this).attr('aria-valuetransitiongoal')+'%');
			});
			$(this).unbind('inview');
		}
	});

	//Countdown
	$('#features').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
		if (visible) {
			$(this).find('.timer').each(function () {
				var $this = $(this);
				$({ Counter: 0 }).animate({ Counter: $this.text() }, {
					duration: 2000,
					easing: 'swing',
					step: function () {
						$this.text(Math.ceil(this.Counter));
					}
				});
			});
			$(this).unbind('inview');
		}
	});

	// Portfolio Single View
	$('#portfolio').on('click','.folio-read-more',function(event){
		event.preventDefault();
		var link = $(this).data('single_url');
		var full_url = '#portfolio-single-wrap',
		parts = full_url.split("#"),
		trgt = parts[1],
		target_top = $("#"+trgt).offset().top;

		$('html, body').animate({scrollTop:target_top}, 600);
		$('#portfolio-single').slideUp(500, function(){
			$(this).load(link,function(){
				$(this).slideDown(500);
			});
		});
	});

	// Close Portfolio Single View
	$('#portfolio-single-wrap').on('click', '.close-folio-item',function(event) {
		event.preventDefault();
		var full_url = '#portfolio',
		parts = full_url.split("#"),
		trgt = parts[1],
		target_offset = $("#"+trgt).offset(),
		target_top = target_offset.top;
		$('html, body').animate({scrollTop:target_top}, 600);
		$("#portfolio-single").slideUp(500);
	});

	function tratarErros(textStatus){
		if(depuracao){
			retornoJS=textStatus;
			console.log("[FORM_SAC] Retorno obtido em: 'retornoJS'. MSG="+textStatus.responseText);
		}
	}
	// Contact form
	var form_sac = $('#main-contact-form');
	form_sac.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		var functiona=($("#name").val().length>3)&&//+3 caracteres
		(($("#message").val().length>5)&&($("#message").val().indexOf(' ')>-1))&& //Ter mais que 5 letras e espaço deve existir.
		($("#subject").val()!=-1)&& //Não estar no valor padrão
		(  ($("#email").val().indexOf('@')>0) //@ estar a frente da primeira caractere
		|| ($("#teleph").val().length==15)  ); //Telefone ter 15 caracteres. Um dos dois deve estar preenchido.
		console.log('parte 1');
		if(!functiona){
form_sac.prepend( form_status.html('<p class="text-warning">Por favor, preencha todos os campos corretamente.<br/>E-mail é opcional se tiver um telefone, e vice-versa.</p>').fadeIn().delay(10000).fadeOut() );
		}else{
		var fmd = new FormData();
		fmd.append("nome",$("#name").val());
		if ($("#email").val().indexOf('@')>0)	fmd.append("mail",$("#email").val());
		if ($("#teleph").val().length==15) fmd.append("telef",$("#teleph").val());
		fmd.append("assu",$("#subject").val());
		fmd.append("mes",$("#message").val());
		$.ajax({
			method:"POST",
			url: $(this).attr('action'),
			data:fmd,
			processData: false,
			cache: false,
			contentType: false,
			beforeSend: function(){
				form_sac.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Enviando mensagem.</p>').fadeIn() );
			}
		}).done(function(data){
			if(depuracao){
				retornoJS=data;
				console.log("[FORM_SAC] Retorno obtido em: 'retornoJS'");
			}
			if(data.code==0)
			form_status.html('<p class="text-success">Enviado com sucesso! Agradecemos pelo contato.</p>').delay(5000).fadeOut();
			else if(data.code>0)
			form_status.html('<p class="text-warning">Ops... Parece que aconteceu algum problema. Erro: '+data.value+'</p>').delay(7000).fadeOut();
			else
			form_status.html('<p class="text-warning">Ops... Parece que aconteceu algum problema. Erro: '+data+'</p>').delay(20000).fadeOut();
		}).error(function(textStatus ){
			tratarErros(textStatus);
			form_status.html('<p class="text-danger">Ops... Parece que estamos com alguns problemas. Desculpe :/</p>').delay(4000).fadeOut();
		});

		;
	}
	});


		// Contact form
		var form_wwu = $('#formulario-trabalhe-conosco');
		form_wwu.submit(function(event){
			event.preventDefault();
			var form_status = $('<div class="form_status"></div>');
		if($("#anexo")[0].files[0]===undefined){
form_wwu.prepend( form_status.html('<p class="text-warning">Por favor, escolha um arquivo para ser enviado.</p>').fadeIn().delay(10000).fadeOut() );
		}else{
			var fmd = new FormData();
			fmd.append("classe","trabalhe-conosco");
			fmd.append("anexo",$("#anexo")[0].files[0]);
			$.ajax({
				method:"POST",
				url: $(this).attr('action'),
				data:fmd,
				processData: false,
				cache: false,
				contentType: false,
				beforeSend: function(){
					form_wwu.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Enviando dados.</p>').fadeIn() );
				}
			}).done(function(data){
				if(depuracao){
					retornoJS=data;
					console.log("[FORM_WWU] Retorno obtido em: 'retornoJS'");
				}

				if(data.code==0)
				form_status.html('<p class="text-success">Enviado com sucesso! Agradecemos pela contribuição.</p>').delay(3000).fadeOut();
				else
				form_status.html('<p class="text-warning">Ops... Parece que aconteceu algum problema. Erro: '+data+'</p>').delay(3000).fadeOut();

			}).error(function(textStatus){
				tratarErros(textStatus);
				form_status.html('<p class="text-danger">Ops... Parece que estamos com alguns problemas. Desculpe :/</p>').delay(4000).fadeOut();
			});
		}
		});



	//Google Map
	var latitude = $('#google-map').data('latitude')
	var longitude = $('#google-map').data('longitude')
	function initialize_map() {
		var myLatlng = new google.maps.LatLng(latitude,longitude);
		var mapOptions = {
			zoom: 15,
			scrollwheel: false,
			mapTypeId: 'satellite',
			center: myLatlng
		};
		var map = new google.maps.Map(document.getElementById('google-map'), mapOptions);

		var contentString = '';

		var msg = '<div id="iw-container">' +
									'<div class="iw-title">Porcelain Factory of Vista Alegre</div>' +
									'<div class="iw-content">' +
										'<div class="iw-subTitle">History</div>' +
										'<img src="http://maps.marnoto.com/en/5wayscustomizeinfowindow/images/vistalegre.jpg" alt="Porcelain Factory of Vista Alegre" height="115" width="83">' +
										'<p>Founded in 1824, the Porcelain Factory of Vista Alegre was the first industrial unit dedicated to porcelain production in Portugal. For the foundation and success of this risky industrial development was crucial the spirit of persistence of its founder, José Ferreira Pinto Basto. Leading figure in Portuguese society of the nineteenth century farm owner, daring dealer, wisely incorporated the liberal ideas of the century, having become "the first example of free enterprise" in Portugal.</p>' +
										'<div class="iw-subTitle">Contacts</div>' +
										'<p>VISTA ALEGRE ATLANTIS, SA<br>3830-292 Ílhavo - Portugal<br>'+
										'<br>Phone. +351 234 320 600<br>e-mail: geral@vaa.pt<br>www: www.myvistaalegre.com</p>'+
									'</div>' +
									'<div class="iw-bottom-gradient"></div>' +
								'</div>';'<img style="width:90px;" class="img-responsive" src="../images/logo_mini.png" alt="Inova Utilidades">'
								var infowindow = new google.maps.InfoWindow({
									content: msg,
									maxWidth: 350
								});


google.maps.event.addListener(infowindow, 'domready', function() {
var iwOuter = $('.gm-style-iw');
iwBackground.children(':nth-child(4)').css({'display' : 'none'});
iwOuter.parent().parent().css({left: '115px'});
iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
var iwCloseBtn = iwOuter.next();
iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});
	if($('.iw-content').height() < 140){
      $('.iw-bottom-gradient').css({display: 'none'});
  }
	iwCloseBtn.mouseout(function(){
	      $(this).css({opacity: '1'});
	});
});
		var marker = new google.maps.Marker({
			position: myLatlng,
			label:"N",
			map: map,
			title:"Inova Utilidades"
		});
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open(map,marker);
		});

	}
	google.maps.event.addDomListener(window, 'load', initialize_map);

});




//Máscara de formulários:
