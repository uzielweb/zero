
jQuery(function ($) {

     //caches a jQuery object containing the header element
     var header = $("#tppa-header");
     $(window).scroll(function() {
         var scroll = $(window).scrollTop();
 
         if (scroll >= 90) {
             header.removeClass('stickyheader').addClass("stickedheader");
         } else {
             header.removeClass("stickedheader").addClass('stickyheader');
         }
     });
     var scrolltoTopButton = $('#scrolltoTopButton');

     $(window).scroll(function() {
       if ($(window).scrollTop() > 300) {
        scrolltoTopButton.addClass('show');
       } else {
        scrolltoTopButton.removeClass('show');
       }
     });
   
     scrolltoTopButton.on('click', function(e) {
       e.preventDefault();
       $('html, body').animate({scrollTop:0}, '300');
     });
   

  
   $('#offcanvas_button').click(function(){
    $('.onCanvas').toggleClass('showmenu');
    $('.offCanvas').toggleClass('showoffcanvas');
   }        
   );
   $('#close-canvas').click(function(){
    $('.onCanvas').toggleClass('showmenu');
    $('.offCanvas').toggleClass('showoffcanvas');
   }        
   );

});



