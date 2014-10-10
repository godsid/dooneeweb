<script src="<?=static_url('/js/superfish.js')?>"></script>
<script src="<?=static_url('/js/jquery.flexslider.js')?>"></script>
<script src="<?=static_url('/js/jquery.nicescroll.min.js')?>"></script>

<script src="<?=static_url('/js/jquery.mousewheel-3.0.6.pack.js')?>"></script>
<!--<script src="<?=static_url('/js/jquery.fancybox.js?v=2.1.5')?>"></script>-->
<script src="<?=static_url('/js/perfect-scrollbar.js')?>"></script>
<script src="<?=static_url('/js/jquery.lazy.1.9.min.js')?>"></script>

<script>
/* Header scroll */
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
/* pageing movie */
function nextpage(){
  $.get($('.load-more').attr('href'),function(resp){
      //history.pushState(null, null, $('.load-more').attr('href'));
      toPosition = $('.ctrl-page').offset().top-50;
      resp = $(resp);
      $('.is-pageing').append($(resp).filter('ul').find('li'));

      $('.ctrl-page').replaceWith($(resp).filter('.ctrl-page'));
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
	$("a.lb-popup").overlay({mask: '#FFF', opacity: 0.5, effect: 'apple',onLoad:function(obj){
    target = $(obj.target||obj.srcElement);
    if($(target).is('img')){
      target = $(target).parent();
    }
    if($(target).attr('rel')=='#popup-age'){
      if($(target).hasClass('withlogin')){
        $(target).attr('rel','#popup-login');
        id = (new Date().getTime());
        $('body').append('<a href="" id="'+id+'" rel="#popup-login"></a>');
        $('#'+id).overlay({mask: '#FFF', opacity: 0.5, effect: 'apple'});
        $('#confirm_rate').attr('href','javascript:$(\'a.close\').click();$(\'#'+id+'\').click();');
      }else{
        $('#confirm_rate').attr('href',$(target).attr('href'));
      }
    }

    loginUrl = $('.formLogin:first').attr('action');
    loginUrl = loginUrl.replace(/login.*/,'login?reurl='+encodeURI($(target).attr('href')));
    $('#popup-login .formLogin').attr('action',loginUrl);
  }});

  //Popup Payment
  $("a.payment-popup").overlay({mask: '#FFF', opacity: 0.5, effect: 'apple',onLoad:function(obj){
    target = $(obj.target||obj.srcElement);
    package_id = target.attr('data-package');
    channel = target.attr('data-channel');

    if(channel=='creditcard'){
      $("#2c2p-payment-form").attr('action',$("#2c2p-payment-form").attr('action').replace(/[0-9]+/,package_id));
    }else if(channel =='prepaidcard'){
        $("#prepaidcard-payment-form").submit(function(){
          code = "";
          $("#prepaidcard-payment-form input").each(function(key,item){
              if($(item).attr('type')=='text'){
                if($(item).val().trim().match(/^[0-9]{4}/)==null){
                  $(item).focus();
                  return false;
                }else{
                  code+=$(item).val().trim();
                }
              }
          });
          if(code.match(/^[0-9]{16}/)==null){
            alert('คุณกรอกข้อมูลไม่ถูกต้องค่ะ');
            return false;
          }else{
            $("#bt-prepaid").hide();
            $.post("<?=base_url('/payment/prepaidcard/')?>/"+package_id,{"code":code},function(resp){
                $("#bt-prepaid").show();
               if(resp.status=="success"){
                  alert(resp.message);
                  window.location = '<?=home_url('')?>';
               }else{
                  alert(resp.message);
               }
            });
          }
          return false;
        });
        return false;
    }else{
      $(target.attr('rel')+' li a').each(function(index,item){
       $(item).attr('href',$(item).attr('href').replace(/\/payment\/[a-z]+\/[0-9]+/,'/payment/'+channel+'/'+package_id));
      });
    }
  }});
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

/* Image lazy load*/
var loaded = 0;
jQuery(document).ready(function() {
  jQuery(".thm-mv img").lazy({
    effect: "fadeIn",
    effectTime: 1500,
    threshold: 0
  });
  jQuery(".lazy").lazy({
    effect: "fadeIn",
    effectTime: 1500,
    threshold: 0
  });
});

/* Payment agent choose */

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
/* Facebook Login*/
$(document).ready(function() {
  $.ajaxSetup({ cache: true });
  $.getScript('//connect.facebook.co.th/th_TH/all.js', function(){
    FB.init({
      appId: '<?=$this->config->item('facebook_appid')?>',
    });     
    $('#fb-signin').removeAttr('disabled');
    FB.getLoginStatus(updateStatusCallback);
  });
});

/* Facebook State Change */
function updateStatusCallback(response){
  console.log('FB: '+response.status);
  if (response.status === 'connected') {
    // Logged into your app and Facebook.
  } else if (response.status === 'not_authorized') {
    // The person is logged into Facebook, but not your app.
    console.log('Please log ' + 'into this app.');
  } else {

  }
}
/* Facebook Button click */
$('.fb-signin').click(function(){
  FB.login(function(response) {
   // handle the response
   if(response.status==='connected'){
      login();
   }
   updateStatusCallback(response);
  }, {scope: '<?=$this->config->item('facebook_scope')?>'});
});
/* Login site with facebook */
function login(){
  FB.api('/me', function(response) {
    $.post('<?=base_url('/facebookLogin')?>',response,function(resp){
      console.log(resp);  
      if(resp.user_id){
        if(window.location.href.match(/login|register/)==null){
          window.location.reload();
        }else{
          window.location = '<?=home_url()?>';
        }
      }else{
        alert(resp.message);
      }
    });
  });
}
</script>
