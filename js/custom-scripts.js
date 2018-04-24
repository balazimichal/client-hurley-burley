jQuery( document ).ready(function() {

  // MENU TOGGLER
  var TOGGLER = function () {
    var _state = false;
    console.log(_state);

    var openMenu = function () {
      jQuery(".hb-navigation-button").addClass('active');
      jQuery(".hb-navigation").animate({ "margin-right": '+=400' });
    }

    var closeMenu = function () {
      jQuery(".hb-navigation-button").removeClass('active');
      jQuery(".hb-navigation").animate({ "margin-right": '-=400'});
    }

    return {
      toggle: (function () {
        _state = !_state;

        if (_state) {
          openMenu();
        } else {
          closeMenu();
        }


      })
    }
  }();

  jQuery(".hb-navigation-button, .hb-navigation a").click(function () {
      TOGGLER.toggle();
    });

  // CHANGE CURRENT CLASS BASED ON SCROLL POSITION
  /*
  jQuery(window).scroll(function () {
    var windscroll = jQuery(window).scrollTop();
    if (windscroll >= 100) {
      jQuery('.fusion-fullwidth').each(function (i) {
        if (jQuery(this).position().top <= windscroll - 100) {
          jQuery('.hb-navigation a.current, .hb-navigation-switches a.current').removeClass('current');
          jQuery('.hb-navigation a, .hb-navigation-switches a').eq(i).addClass('current');
        }
      });

    } else {
      jQuery('.hb-navigation a, .hb-navigation-switches a').removeClass('current');
      jQuery('.hb-navigation a:first, .hb-navigation-switches a:first').addClass('current');
    }

  }).scroll();​
  */
  jQuery(window).scroll(function () {
    var windscroll = jQuery(window).scrollTop();
    if (windscroll >= 100) {
      jQuery('.fusion-fullwidth').each(function (i) {
        if (jQuery(this).position().top <= windscroll - 100) {
          jQuery('.hb-navigation a.current, .hb-navigation-switches a.current').removeClass('current');
          jQuery('.hb-navigation-switches a').eq(i).addClass('current');
        }
        console.log(i);
      });
    } else {
      jQuery('.hb-navigation a, .hb-navigation-switches a').removeClass('current');
      jQuery('.hb-navigation a:first, .hb-navigation-switches a:first').addClass('current');
    }
  }).scroll();

  // SMOOTH SCROLLING
  var lastScrollTop = 0;
  jQuery(document).on('click', '.hb-navigation-switches li a[href^="#"], .hb-navigation li a[href^="#"]', function (event) {
    event.preventDefault();
    var name = jQuery(this).attr('href');
    jQuery(".hb-navigation a, .hb-navigation-switches a").removeClass('current');
    jQuery(".hb-navigation [href=" + name + "], .hb-navigation-switches [href=" + name + "]").addClass('current');

    var newScrollTop = jQuery(jQuery.attr(this, 'href')).offset().top;


    if (jQuery(jQuery.attr(this, 'href')).offset().top > lastScrollTop) {
      jQuery('html, body').animate({ scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top }, 500);
    } else {
      jQuery('html, body').animate({ scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top - 10 }, 500);
    }
    lastScrollTop = jQuery(jQuery.attr(this, 'href')).offset().top;

  });



 });