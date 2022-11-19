
"use strict";

/*------------------------------------
  Data-X-Data Predefined Variables
--------------------------------------*/
var $window = $(window),
    $document = $(document),
    $body = $('body'),
    $fullScreen = $('.fullscreen-banner') || $('.section-fullscreen'),
    $halfScreen = $('.halfscreen-banner');

//Check if function exists
$.fn.exists = function () {
  return this.length > 0;
};


/*------------------------------------
  Data-X-Data PreLoader
--------------------------------------*/
function preloader() {
   $('#ht-preloader').fadeOut();
};


/*------------------------------------
  Data-X-Data Menu
--------------------------------------*/
function dropdown() {
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
  }
  var $subMenu = $(this).next(".dropdown-menu");
  $subMenu.toggleClass('show');

  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass("show");
  });

  return false;
});
};



/*------------------------------------
  Data-X-Data FullScreen
--------------------------------------*/
function fullScreen() {
    if ($fullScreen.exists()) {
        $fullScreen.each(function () {
        var $elem = $(this),
        elemHeight = $window.height();
        if($window.width() < 768 ) $elem.css('height', elemHeight/ 1);
        else $elem.css('height', elemHeight);
        });
        }
        if ($halfScreen.exists()) {
        $halfScreen.each(function () {
        var $elem = $(this),
        elemHeight = $window.height();
        $elem.css('height', elemHeight / 2);
        });
    }
};


/*------------------------------------
  Data-X-Data Counter
--------------------------------------*/
  function counter() {  
    $('.count-number').countTo({
      refreshInterval: 2
    });   
  };

/*------------------------------------
  Data-X-Data Owl Carousel
--------------------------------------*/
function owlcarousel() {
$('.owl-carousel').each( function() {
  var $carousel = $(this);
  $carousel.owlCarousel({
      items : $carousel.data("items"),
      slideBy : $carousel.data("slideby"),
      center : $carousel.data("center"),
      loop : true,
      margin : $carousel.data("margin"),
      dots : $carousel.data("dots"),
      nav : $carousel.data("nav"),     
      autoplay : $carousel.data("autoplay"),
      autoplayTimeout : $carousel.data("autoplay-timeout"),
      navText : [ '<span class="las la-long-arrow-alt-left"><span>', '<span class="las la-long-arrow-alt-right"></span>' ],
      responsive: {
        0:{items: $carousel.data('xs-items') ? $carousel.data('xs-items') : 1},
        576:{items: $carousel.data('sm-items')},
        768:{items: $carousel.data('md-items')},
        1024:{items: $carousel.data('lg-items')},
        1200:{items: $carousel.data("xl-items")},
        1400:{items: $carousel.data("xxl-items")},
        1600:{items: $carousel.data("items")}
      },
  });
});
};


/*------------------------------------
  Data-X-Data Scroll to top
--------------------------------------*/
function scrolltop() {
  var pxShow = 300,
    goTopButton = $(".scroll-top")
    // Show or hide the button
  if ($(window).scrollTop() >= pxShow) goTopButton.addClass('scroll-visible');
  $(window).on('scroll', function () {
    if ($(window).scrollTop() >= pxShow) {
      if (!goTopButton.hasClass('scroll-visible')) goTopButton.addClass('scroll-visible')
    } else {
      goTopButton.removeClass('scroll-visible')
    }
  });
  $('.smoothscroll').on('click', function (e) {
    $("html, body").scrollTop(0);
    return false;
  });
};


/*------------------------------------
  Data-X-Data Fixed Header
--------------------------------------*/
function fxheader() {
  $(window).on('scroll', function () {
    if ($(window).scrollTop() >= 300) {
      $('#header-wrap').addClass('fixed-header');
    } else {
      $('#header-wrap').removeClass('fixed-header');
    }
  });
};


/*------------------------------------------
  HT Text Color, Background Color And Image
---------------------------------------------*/
function databgcolor() {
    $('[data-bg-color]').each(function(index, el) {
     $(el).css('background-color', $(el).data('bg-color'));  
    });
    $('[data-text-color]').each(function(index, el) {
     $(el).css('color', $(el).data('text-color'));  
    });
    $('[data-bg-img]').each(function() {
     $(this).css('background-image', 'url(' + $(this).data("bg-img") + ')');
    });
};




/*------------------------------------
  Data-X-Data ProgressBar
--------------------------------------*/
  function progressbar () {
    if ($(".skillbar").length) {
    $('.skillbar').skillBars({
    from: 0,
    speed: 4000, 
    interval: 100,
    decimals: 0,
  });
}
};


/*------------------------------------
  Data-X-Data Countdown
--------------------------------------*/
function countdown() {
  $('.countdown').each(function () {
    var $this = $(this),
      finalDate = $(this).data('countdown');
    $this.countdown(finalDate, function (event) {
      $(this).html(event.strftime('<li><span>%-D</span><p>Days</p></li>' + '<li><span>%-H</span><p>Hours</p></li>' + '<li><span>%-M</span><p>Minutes</p></li>' + '<li><span>%S</span><p>Seconds</p></li>'));
    });
  });
};


/*------------------------------------
  Data-X-Data Btn Product
--------------------------------------*/
function btnproduct() {
  $('.btn-product-up').on('click', function (e) {
    e.preventDefault();
    var numProduct = Number($(this).next().val());
    if (numProduct > 1) $(this).next().val(numProduct - 1);
  });
  $('.btn-product-down').on('click', function (e) {
    e.preventDefault();
    var numProduct = Number($(this).prev().val());
    $(this).prev().val(numProduct + 1);
  });
};


/*------------------------------------
  Data-X-Data Side Menu
--------------------------------------*/
function sidenav() {
$('.ht-nav-toggle').on('click', function(event) {
      event.preventDefault();
      var $this = $(this);
      if( $('body').hasClass('menu-show') ) {
        $('body').removeClass('menu-show');
        $('#ht-main-nav > .ht-nav-toggle').removeClass('show');
      } else {
        $('body').addClass('menu-show');
        setTimeout(function(){
          $('#ht-main-nav > .ht-nav-toggle').addClass('show');
        }, 900);
      }
    })
};


/*------------------------------------
  Data-X-Data Active Class
--------------------------------------*/
function activeclass() {
  $('.featured-item, .portfolio-item, .team-member.style-2').mouseenter(function () {
    $('.featured-item.active, .portfolio-item, .team-member.style-2.active').removeClass('active');
    $(this).removeClass('.featured-item, .portfolio-item, .team-member.style-2').addClass('active');
  });
};


/*------------------------------------
  Data-X-Data Search Class
--------------------------------------*/

function Searchbarmain() {
  $('a[href="#search"]').on("click", function (event) {
    event.preventDefault();
    $("#search").addClass("open");
    $('#search > form > input[type="search"]').focus();
  });

  $("#search, #search button.close").on("click keyup", function (event) {
    if (
      event.target == this ||
      event.target.className == "close" ||
      event.keyCode == 27
    ) {
      $(this).removeClass("open");
    }
  });

  $("form").submit(function (event) {
    event.preventDefault();
    return false;
  });
};
/*------------------------------------
  Data-X-Data Window load and functions
--------------------------------------*/
$(document).ready(function() {    
    fullScreen(),
    dropdown(),
    owlcarousel(),
    counter(),
    scrolltop(),
    fxheader(),
    databgcolor(),
    progressbar(),
    countdown(),
    btnproduct(),
    sidenav(),
    activeclass();
    Searchbarmain();
});


$window.resize(function() {
});


$(window).on('load', function() {
    preloader();
});

// Navbar active Class
jQuery(function($) {
  var path = window.location.href; 
  // because the 'href' property of the DOM element is the absolute path
  $('#site-header ul li a').each(function() {
      if (this.href === path) {
      $(this).addClass('active');
      return false;
      }
  });
});