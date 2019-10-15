'use strict';

var Site = window.Site || {};

/* Create a closure to maintain scope of the '$'
and remain compatible with other frameworks.  */
(function($) {  
  $(window).bind("load", function() {
    $("#loader").fadeOut(300);
  });
  $(document).ready(function(){
    general();

    //anchor animate
    $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        
        var target = $(this.hash);

        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });

    //return image 
    $(".return_parent").each(function (index){
      var imgSrc = $(this).attr('src');
      $(this).parent('.src_return').css('background-image', 'url(' + imgSrc + ')');
    });

    
    //menu responsive
    $(".ico_menu").click(function(event) {
      if($('nav').css("display") == "none"){
        $('nav').addClass('active');
        $(this).addClass('active');
        $('nav').slideDown(500);
      }else{
        $('nav').removeClass('active');
        $(this).removeClass('active');
        $('nav').slideUp(500);
      }
    });
    // slider
    $("#owl-detalle").owlCarousel({
      autoPlay:7000,
      navigation : true,
      pagination : false,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true
    });

    var sync1 = $("#owl-planos");
    var sync2 = $("#owl-medidas");
   
    sync1.owlCarousel({
      singleItem : true,
      slideSpeed : 1000,
      navigation: true,
      pagination:false,
      afterAction : syncPosition,
      responsiveRefreshRate : 200,
    });
   
    sync2.owlCarousel({
      items : 7,
      itemsDesktop      : [1199,7],
      itemsDesktopSmall     : [979,5],
      itemsTablet       : [768,4],
      itemsMobile       : [320,3],
      pagination:false,
      responsiveRefreshRate : 100,
      afterInit : function(el){
        el.find(".owl-item").eq(0).addClass("synced");
      }
    });
   
    function syncPosition(el){
      var current = this.currentItem;
      $("#owl-medidas")
        .find(".owl-item")
        .removeClass("synced")
        .eq(current)
        .addClass("synced")
      if($("#owl-medidas").data("owlCarousel") !== undefined){
        center(current)
      }
    }
   
    $("#owl-medidas").on("click", ".owl-item", function(e){
      e.preventDefault();
      var number = $(this).data("owlItem");
      sync1.trigger("owl.goTo",number);
    });
   
    function center(number){
      var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
      var num = number;
      var found = false;
      for(var i in sync2visible){
        if(num === sync2visible[i]){
          var found = true;
        }
      }
   
      if(found===false){
        if(num>sync2visible[sync2visible.length-1]){
          sync2.trigger("owl.goTo", num - sync2visible.length+2)
        }else{
          if(num - 1 === -1){
            num = 0;
          }
          sync2.trigger("owl.goTo", num);
        }
      } else if(num === sync2visible[sync2visible.length-1]){
        sync2.trigger("owl.goTo", sync2visible[1])
      } else if(num === sync2visible[0]){
        sync2.trigger("owl.goTo", num-1)
      }
      
    }


    // royal slider
    jQuery.rsCSS3Easing.easeOutBack = 'cubic-bezier(0.175, 0.885, 0.320, 1.275)';
    var slider = $('#slider').royalSlider({
      arrowsNav: true,
      autoHeight: true,
      sliderDrag: true,
      arrowsNavAutoHide: false,
      controlNavigationSpacing: 0,
      loop: true,
      keyboardNavEnabled: true,
      fadeinLoadedSlide: false,
      controlNavigation: 'bullets',
      thumbsFitInViewport: true,
      startSlideId: 0,
      autoPlay: {
        // autoplay options go gere
        enabled: true,
        pauseOnHover: false,
        delay:5000,
        stopAtAction:false
      },
      transitionType:'slide',
      slidesSpacing:0,
      imageScalePadding:0,
      usePreloader:true,
      navigateByClick:false
    });


    var slider = $(".royalSlider").data('royalSlider'); 


    $(".acordeon a").on("click", function(e){
      $('.acordeon li').removeClass('active');
      // $('.acordeon li div').slideUp(400);
      if($(this).parent('h5').next('div').css("max-height") == "0px"){
        $(this).parent('h5').parent('li').addClass('active');
        // $(this).parent('h5').next('div').slideDown(400);
      }

      
    });

  });

  //redimension
  var width, height;
  function doneResizing(){
    general();
  }
  //RESIZE
  $(window).resize(function() {
    //recalculo fotos para el seo
    var newWidth = $(window).width();
    var newHeight = $(window).height();
    if( newWidth != width || newHeight != height ) {
      width = newWidth;
      height = newHeight;
      doneResizing();
    }
  });
})(jQuery);



function general (){  
  var thisHeight = $(window).height();
  var thisWidth = $(window).width();
   if (thisWidth <=700){
    $('.isotope-item').addClass('mobile');
   }else{
    $('.isotope-item').removeClass('mobile');
   }
}


function Filter(div){
  $('.filter').hide();
  $(div).show();
}


//PROTOTYPE

function Contacto(){
  if($( '.form' ).css("display") == "none"){
    $('.compartir').fadeOut(300);
	$('.form').fadeIn(300);
  }else{
    $('.form').fadeOut(300);
  }
  
}

function compartir(){
  if($( '.compartir' ).css("display") == "none"){
	$('.form').fadeOut(300);
    $('.compartir').fadeIn(300);
  }else{
    $('.compartir').fadeOut(300);
  }
  
}