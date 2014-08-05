<script src="<?=static_url('/js/superfish.js')?>"></script>
<script src="<?=static_url('/js/jquery.flexslider.js')?>"></script>
<script src="<?=static_url('/js/jquery.nicescroll.min.js')?>"></script>

<script src="<?=static_url('/js/jquery.mousewheel-3.0.6.pack.js')?>"></script>
<!--<script src="<?=static_url('/js/jquery.fancybox.js?v=2.1.5')?>"></script>-->

<script>
$(document).ready(function(){
    
    var lastScrollTop = 0;
    $(window).scroll(function(){
        
        var st = $(this).scrollTop();
        
        
        if (st > lastScrollTop){
            console.log('down');
            // scrolling down
            if($('#header').data('size') === 'big')
            {
                $('#header').data('size','small');
                $('#header').stop().animate({
                    top:'-193px'
                },100);
            }
        }
        else
        {
            // scrolling up
            if($('#header').data('size') === 'small')
            {
                            console.log('up');
                $('#header').data('size','big');
                $('#header').stop().animate({
                    top:'0'
                },50);
            }  
        }
        lastScrollTop = st;
    });
	
	//Scroll add class nav
	if($('#header+*').length > 0) {
		var top1 = $('#header+*').offset().top - parseFloat($('#header+*').css('marginTop').replace(/auto/, 0));
		$(window).scroll(function (event) {
		var y1 = $(this).scrollTop();
		if (y1 >= top1) {$('#header').addClass('small');} else {$('#header').removeClass('small');}
		});
	}
	
});

/*hover cat*/
$('#sl-cat').superfish().find('ul');
	$('#sl-cat').superfish({
			animation:{
				opacity:'show',height:'show'
				}, speed:1, dropShadows: false
});
/*FlexSlider*/
$(window).load(function() {
   /*Big*/
  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    sync: "#carousel"
  });
  /*Thumb*/
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: true,
    slideshow: false,
    itemWidth: 180,
    itemMargin: 20,
    minItems: 2,
    maxItems: 5,
    asNavFor: '#slider'
  });
  /*movie slide*/
  $('.bx-mv-slide').flexslider({
    animation: "slide",
    animationLoop: true,
	//slideshow: false,
	slideshowSpeed: 15000,
    itemWidth: 195,
    itemMargin: 0,
    minItems: 2,
    maxItems: 6
  });
  
});

$(document).ready(function() {
	/*$(".nav-main ul li a").click(function() {
		$(".nav-main ul li a").removeClass("selected");
		$(this).addClass("selected");
	});*/
	/*scrollbar*/
	$(".js-v-scroll").niceScroll({
		styler:"fb",
		cursorwidth:"7px",
		cursorcolor:"#000",
		cursorborder: "0",
		background:"rgba(0,0,0,0.5)",
		autohidemode:false,
	});
	/*$(".js-h-scroll").niceScroll({
		styler:"fb",
		cursorwidth:"7px",
		cursorcolor:"#000",
		cursorborder: "0",
		background:"rgba(0,0,0,0.5)",
		autohidemode:false,
		horizrailenabled:true	
	});*/
	
});
</script>

<script>
$(document).ready(function(){
	/*back to top*/
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('#back2top').css({bottom:"0"});
		} else {
			$('#back2top').css({bottom:"-50px"});
		}
	});
	$('#back2top').click(function(){
		$('html, body').animate({scrollTop: '0px'}, 200);
		return false;
	});
	/*Lightbox*/
	/*$(".fancybox").fancybox({
		width     : 800,
		height    : 600,
		autoSize   : true,
		scrolling: 'no',
		helpers:  {
			title:  null
		}
	});*/
	/*lightbox player*/
	/*$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		helpers:  {
			title:  null
		}
	});*/
}); 
</script>
