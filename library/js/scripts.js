// Fire when DOM is loaded
jQuery(document).ready(function($) {

  //Troligen ingen sök så ta bort sen
  $( "nav.search" ).click(function() {
    $('body').toggleClass('open-nav');
    if( $( "body.home" ).hasClass("open-nav") ) {
      }
      else {
    }
    $('.search-field').focus();
  });

  $.fn.shuffleChildren = function() {
  $.each(this.get(), function(index, el) {
    var $el = $(el);
    var $find = $el.children();

    $find.sort(function() {
      return 0.5 - Math.random();
    });

    $el.empty();
    $find.appendTo($el);
  });
};

  $(".selected").shuffleChildren();

});

// Fire when pages is loaded
jQuery(window).load(function($) {
  if (jQuery('.swiper-container').length) {
      mySwiper.update();
      var activeSlide = jQuery('.swiper-slide')[mySwiper.realIndex + 1];
      var activeCaption = jQuery(activeSlide).find('.caption').text();
      jQuery('.swiper-footer .caption').text(activeCaption);
  }
});
