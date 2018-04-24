jQuery( document ).ready(function() {


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


  /*
  let menuPosition = 0;

  const openNav = () => {
    menuMove = (menuPosition === 0) ? 400 : 0;
    menuPosition = 400;
    jQuery(".hb-navigation-button").addClass('active');
    jQuery(".hb-navigation").animate({ "margin-right": '+=' + menuMove });
  }

  const closeNav = () => {
    menuMove = (menuPosition === 0) ? 0 : 400;
    menuPosition = 0;
    jQuery(".hb-navigation-button").removeClass('active');
    jQuery(".hb-navigation").animate({ "margin-right": '-=' + menuMove });

    // CLOSE NAVIGATION AFTER SELECTION
    jQuery('body').on("click", ".hb-navigation a", function () {
      closeNav();
    });
  }

  // NAVIGATION
  jQuery(".hb-navigation-button").toggle(function () {
    openNav();
  }, function () {
    closeNav();
  });
  */


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