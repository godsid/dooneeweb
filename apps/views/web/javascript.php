<script src="<?=static_url('/js/superfish.js')?>"></script>
<script src="<?=static_url('/js/jquery.flexslider.js')?>"></script>
<script src="<?=static_url('/js/jquery.nicescroll.min.js')?>"></script>

<script src="<?=static_url('/js/jquery.mousewheel-3.0.6.pack.js')?>"></script>
<!--<script src="<?=static_url('/js/jquery.fancybox.js?v=2.1.5')?>"></script>-->
<script src="<?=static_url('/js/perfect-scrollbar.js')?>"></script>


<script>
$(document).ready(function(){
    var headerSmallHeight = 140;
    $(window).scroll(function(){
        st = $(this).scrollTop();
        if(st>headerSmallHeight){
            $('#header').addClass('small');
        }else{
            $('#header').removeClass('small');
        }        
    });
});
function nextpage(){

  $.get($('.load-more').attr('href'),function(resp){
      //history.pushState(null, null, $('.load-more').attr('href'));
      toPosition = $('.ctrl-page').offset().top;
      $('.ctrl-page').replaceWith(resp);
      $("a.lb-popup").overlay({mask: '#FFF', opacity: 0.5, effect: 'apple'});
      $('html, body').animate({scrollTop: toPosition}, 200);
  });
  return false;
}

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
  /*silde thumb fix*/
  $('#slider-fix').flexslider({
    animation: "slide",
    controlNav: "thumbnails",	
    animationLoop: true,
	slideshowSpeed: 7000
  });

  /*movie slide*/
  $('.bx-mv-slide').flexslider({
    animation: "slide",
	slideshow: false,
    animationLoop: true,
    itemWidth: 195,
    itemMargin: 0,
    minItems: 2,
    maxItems: 6
  });
  
});

$(document).ready(function() {
	/*accordion*/
	/*$("#accordion").tabs(
	  "#accordion div.pane",
	  {tabs: '.btn-package', effect: 'slide', initialIndex: 10}
	);*/
	/*Accordion*/
	$('.accordion a.btn-package').click(function() {
		$(this).parents('.bar').toggleClass('active').next().toggleClass('active').slideToggle(200);
    });
	//Lightbox login
	$("a.lb-popup").overlay({mask: '#FFF', opacity: 0.5, effect: 'apple'});
	/*scrollbar*/
	$(".js-v-scroll").niceScroll({
		styler:"fb",
		cursorwidth:"9px",
		cursorcolor:"#000",
		cursorborder: "0",
		background:"rgba(0,0,0,0.5)",
		autohidemode:false,
	});
	$('#scroll-cat, .js-scroll').perfectScrollbar({
	  suppressScrollX: true,
	  wheelSpeed: 100,
	  wheelPropagation: false
	});
	
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
}); 
</script>
