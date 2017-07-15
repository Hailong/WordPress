jQuery(function($) {

  "use strict";

  // // Logo animation
  var element = document.querySelectorAll('.site-title a')[0];
  $('.site-title a').hide();

  jQuery(document).ready(function($){

    //Animate Site title
    charming(element);
    $('.site-title a').show();

    // Menu
    $('#site-navigation .nav-menu').slicknav({
      prependTo:'.menu-mobile',
      label:'',
      allowParentLinks: true
    });

    $('#banner-animate').css('opacity', 0);

    $('#banner-animate').waypoint(function() {
        $('#banner-animate').addClass('fadeIn');
    }, { offset: '50%' });



    // Equal height of divs use in scenarios section
    $('.links-container').each(function(){
            var highestBox = 0;

            $(this).find('.border-solid-gray').each(function(){
                if($(this).height() > highestBox){
                    highestBox = $(this).height();
                }
            });

            $(this).find('.border-solid-gray').height(highestBox);
    });


    var count = jQuery('.grid-container .border-solid-gray').length
      if (count <= 3) {
        jQuery('.links-container').addClass('centered-boxes');
    }

    var count = jQuery('.clients .client-image').length
       if (count <= 4) {
         jQuery('.clients-container').addClass('centered-boxes');
     }


    // Returns a function, that, when invoked, will only be triggered at most once
       // during a given window of time. Normally, the throttled function will run
       // as much as it can, without ever going more than once per `wait` duration;
       // but if you'd like to disable the execution on the leading edge, pass
       // `{leading: false}`. To disable execution on the trailing edge, ditto.
       function throttle(func, wait, options) {
         var context, args, result;
         var timeout = null;
         var previous = 0;
         if (!options) options = {};
         var later = function() {
           previous = options.leading === false ? 0 : Date.now();
           timeout = null;
           result = func.apply(context, args);
           if (!timeout) context = args = null;
         };
         return function() {
           var now = Date.now();
           if (!previous && options.leading === false) previous = now;
           var remaining = wait - (now - previous);
           context = this;
           args = arguments;
           if (remaining <= 0 || remaining > wait) {
             if (timeout) {
               clearTimeout(timeout);
               timeout = null;
             }
             previous = now;
             result = func.apply(context, args);
             if (!timeout) context = args = null;
           } else if (!timeout && options.trailing !== false) {
             timeout = setTimeout(later, remaining);
           }
           return result;
         };
       }

       /* StickyMenu
     	================================================== */
        function stickyMenu() {

           if ($(window).scrollTop() > 50) {
               $('#headercontainer').addClass("sticky");
             }
           else {
               $('#headercontainer').removeClass("sticky");
             }
       }

   $(window).on('scroll', throttle(stickyMenu,200, {leading:true,trailing:true}));

      $(".sticky-btn").on("click", function(event){
         event.stopPropagation();
          if($(".sticky-form .active").is(":visible")){
              $(".sticky-form, .sticky-btn").removeClass("active");
              $('.overlay-modal').hide();
          }else{
              $(".sticky-form, .sticky-btn").toggleClass("active");
              $('.overlay-modal').show();
          }
      });

      $(".overlay-modal").click(function (e) {
        //e.stopPropagation();
        var clicked = $(e.target);

        if ( clicked.is('.sticky-form') ) {

          return;

         } else {

           $('.overlay-modal').hide();
           $(".sticky-form, .sticky-btn").removeClass("active");

         }
      });

      $(".open-modal").on("click", function(event){
        event.preventDefault();
        event.stopPropagation();

        if($(".sticky-form .active").is(":visible")){
            $(".sticky-form, .sticky-btn").removeClass("active")
        }else{
            $(".sticky-form, .sticky-btn").toggleClass("active").focus();
             $('.overlay-modal').show();
        }
      });

  });

  $(".banner-caption a").on("click", function(){
    $('html, body').animate({
      scrollTop: $("#contact-section").offset().top
    }, 2000);
    $('#contact-section form:first *:input[type!=hidden]:first').focus();
  });




  $( document ).ready(function(){
    $("#owl-demo").owlCarousel({

        navigation : true, // Show next and prev buttons
        navigationText: ['&lsaquo;','&rsaquo;'],
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        pagination: false

    });
  });

  $( document ).ready(function(){
  	$("#owl-hero").owlCarousel({

  			navigation : true, // Show next and prev buttons
        navigationText: ['&lsaquo;','&rsaquo;'],
  			slideSpeed : 300,
  			paginationSpeed : 400,
  			singleItem:true,
        pagination: false,
        items : 2,
        autoPlay : true,

  	});
  });



});
