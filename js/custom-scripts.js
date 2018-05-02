jQuery( document ).ready(function() {

  // SET THE HEIGHT OF THE MENU
  const menuHeight = () => {
    const wh = jQuery(window).outerHeight();
    jQuery(".hb-navigation").outerHeight(wh);
  }

  // INITIALIZE MENU HEIGHT AND RUN UPON RESIZE
  menuHeight();
  let resizeMenu;
  jQuery(window).resize(function () {
    clearTimeout(resizeMenu);
    resizeMenu = setTimeout(menuHeight, 100);
  });


  // HIDE THE MENU ON LOAD
  jQuery(".hb-navigation").hide();    

  // MENU TOGGLER
  var TOGGLER = function () {
    var _state = false;

    var openMenu = function () {
      jQuery(".hb-navigation-button").addClass('active');
      jQuery(".hb-navigation").show();
      jQuery(".hb-navigation").animate({ "margin-right": '+=400' });
    }

    var closeMenu = function () {
      jQuery(".hb-navigation-button").removeClass('active');
      jQuery(".hb-navigation").animate({
        "margin-right": '-=400'}, 400, "linear", 
        function () {
          jQuery(".hb-navigation").hide();
        }
      )
      
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

  jQuery(".hb-navigation-button, .hb-navigation a").click(function (e) {
      e.preventDefault();
      TOGGLER.toggle();
    });




  // MAKE SURE WE HAVE CURRENT MENU UPDATED ON ALL MENUS  
  jQuery(window).scroll(function () {
    var windscroll = jQuery(window).scrollTop();
    if (windscroll > 0) {
      jQuery('.section').each(function (i) {
        if (jQuery(this).position().top <= windscroll) {
          jQuery('.hb-navigation a.current, .hb-navigation-switches a.current').removeClass('current');
          jQuery('.hb-navigation-switches a').eq(i).addClass('current');
        }
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
      jQuery('html, body').animate({ scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top +1 }, 500);
    } else {
      jQuery('html, body').animate({ scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top + 1 }, 500);
    }
    lastScrollTop = jQuery(jQuery.attr(this, 'href')).offset().top;

  });




  // PRODUCTS
  const ourProducts = () => {
    const wh = jQuery(window).outerHeight();
    const sph = jQuery(".hb-single-product .one h2").outerHeight() + jQuery(".hb-single-product .two img").outerHeight() + jQuery(".hb-single-product .three p").outerHeight() + 100;
    console.log("wh: " + wh);
    console.log("sph: " + sph);
    if (sph < wh) {
      console.log("product height calculated");
      jQuery(".hb-single-product").height(wh);
      jQuery(".hb-single-product .information").outerHeight(wh);
      jQuery(".hb-single-product .one").height(wh * 0.3);
      jQuery(".hb-single-product .two").height(wh * 0.45);
      jQuery(".hb-single-product .three").height(wh * 0.25);
    } else {
      jQuery(".hb-single-product").height(600);
      jQuery(".hb-single-product .one").height(100);
      jQuery(".hb-single-product .two").height(600);
      jQuery(".hb-single-product .three").height(100);
      console.log("product height fixed");
    } 
    
  }

  // INITIALIZE AND REPAINT HEIGHT OF THE WINDOW
  ourProducts();
  let resizeProducts;
  jQuery(window).resize(function () {
    clearTimeout(resizeProducts);
    resizeProducts = setTimeout(ourProducts, 100);

  });

  // HOVER STATES ON PRODUCTS
  const handlerIn = function () {
    jQuery(this).find(".hover").fadeIn(250);
    jQuery(this).find(".initial").fadeOut(250);
  }
  const handlerOut = function () {
    jQuery(this).find(".hover").fadeOut(250);
    jQuery(this).find(".initial").fadeIn(250);

  }
  jQuery(".hb-single-product").mouseenter(handlerIn).mouseleave(handlerOut);


  // OPEN PRODUCTS INFO WINDOW
  jQuery(".product-button").click(function (e) {
    e.preventDefault();
    const infoContent = jQuery(this).parent().parent().next(".information").html();
    jQuery(".hb-products-info-wrapper .more-info-content").html(infoContent);
    jQuery(".hb-products-info-wrapper").show();
    jQuery(".hb-products").hide();
    jQuery("html, body").animate({
      scrollTop: jQuery("#our-products").offset().top
    }, 550);
  });


  // CLOSE PRODUCTS INFO WINDOW
  jQuery(".close").on("click", function (e) {
    e.preventDefault();
    jQuery(".hb-products-info-wrapper").hide();
    jQuery(".hb-products").show();
  });



 });