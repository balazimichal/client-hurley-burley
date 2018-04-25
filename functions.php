<?php


/********** THEME VARIABLES *************/

$THEME_GLOBALS['theme_name'] = 'Hurley Burley';  // set up theme name

/****************************************/





// ENQUEUE AVADA STYLES
function theme_enqueue_styles() {
    wp_enqueue_style( 'avada-parent-stylesheet', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );




// ENQUEUE CUSTOM SCRIPT
function toggle_scripts() {
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom-scripts.js', array( 'jquery' )  );
}
add_action( 'wp_enqueue_scripts', 'toggle_scripts' );



// ENQUEUE TITLEBAR STYLES
function custom_css() {
	wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/custom-styles.css');
		$r = 0;
		$g = 0;
		$b = 0;
		$a = 0;
        $custom_css = "
                .sdfair-titlebar-overlay{
                        background: rgba($r,$g,$b,$a);
                }";
        wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'custom_css' );






// REMOVE POST AND PORTFOLIO FROM AVADA INSTALL
function belton_remove_menus(){
  remove_menu_page( 'edit.php' );                               //Posts
  remove_menu_page( 'edit-comments.php' );						//Comments
  remove_menu_page( 'edit.php?post_type=avada_portfolio' );     //Portfolio
  remove_menu_page( 'edit.php?post_type=avada_faq' );           //FAQs
  remove_menu_page( 'edit.php?post_type=essential_grid' );      //Essential Grid Posts
}
add_action( 'admin_menu', 'belton_remove_menus' );






// AUTO YEAR
function auto_year() { return date("Y"); }
add_shortcode('auto-year', 'auto_year');




// ADD SUPPORT FOR THEME THUMBNAIL
add_theme_support( 'post-thumbnails' );
//add_image_size( 'similar-pages', 400, 300, true );



// PRODUCTS
function hb_products() { 
	$hb_products = null;
	$hb_products .= '<div class="hb-products">';

	$hb_products .= '<div class="hb-single-product blue">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>The Original</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-blue-fermented-raw-slaw.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>*Cool, Clean and Tangy</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>Cool, Clean and Tangy</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-blue-fermented-raw-slaw.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>More on Nutritional Values and Ingredients</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';

	$hb_products .= '<div class="hb-single-product green">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>Jalapeño and Oregano</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-green-jalapeno-oregano.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>*Zingy, Crunchy and a Tad Hot</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>Zingy, Crunchy and a Tad Hot</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-green-jalapeno-oregano.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>More on Nutritional Values and Ingredients</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';

	$hb_products .= '<div class="hb-single-product orange">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>Turmeric and Cumin</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-orange-turmeric-cumin.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>*Bold, Rich and Fragrant</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>Bold, Rich and Fragrant</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-orange-turmeric-cumin.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>More on Nutritional Values and Ingredients</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';

	$hb_products .= '<div class="hb-single-product red">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>Lemon and Ginger</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-red-lemon-ginger.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>*Fresh, Crisp and Cleansing </p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>Fresh, Crisp and Cleansing</h2></div>';
	$hb_products .= '<div class="two"><img src="/hurley/wp-content/uploads/2018/04/hb-red-lemon-ginger.png" alt="" /></div>';
	$hb_products .= '<div class="three"><p>More on Nutritional Values and Ingredients</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';

	$hb_products .= '</div>';
	$hb_products .= '<style>
	.hb-single-product{
		width:25%;
		float:left;
		text-align:center;
		z-index:100;
		padding:50px 2%;
		cursor:pointer;
	}

	.hb-single-product .initial{
		display:block;
	}
	.hb-single-product .hover{
		display:none;
		visibility:none;
	}
	
	.hb-single-product:hover .initial{
		display:none;
	}
	.hb-single-product:hover .hover{
		display:block;
	}
	

	.hb-single-product.blue{
		background:#89C7E4;
		color:#fff;
	}
	.hb-single-product.blue h2{
		color:#009BAF;
	}
	.hb-single-product.blue .hover{
		color:#009BAF;
	}
	.hb-single-product.blue .hover h2{
		color:#fff;
	}
	.hb-single-product.green{
		background:#00794E;
		color:#fff;
	}	
	.hb-single-product.green h2{
		color:#AAD360;
	}
	.hb-single-product.green .hover{
		color:#AAD360;
	}
	.hb-single-product.green .hover h2{
		color:#fff;
	}
	.hb-single-product.orange{
		background:#ED7701;
		color:#fff;
	}
	.hb-single-product.orange h2{
		color:#FBBD00;
	}
	.hb-single-product.orange .hover{
		color:#FBBD00;
	}
	.hb-single-product.orange .hover h2{
		color:#fff;
	}
	.hb-single-product.red{
		background:#C90932;
		color:#fff;
	}
	.hb-single-product.red h2{
		color:#FFB6B1;
	}
	.hb-single-product.red .hover{
		color:#FFB6B1;
	}
	.hb-single-product.red .hover h2 {
		color:#fff;
	}
	@media only screen and (max-width: 1024px) {
		.hb-single-product{
			width:100%;
			padding:50px 30px;
		}
	}
	</style>';
	$hb_products .= '<script>
	let ourProducts = () => {
		const wh = jQuery(window).height();
		const sph = jQuery( ".hb-single-product" ).height();
		if(sph < wh) {
			jQuery( ".hb-single-product" ).height(wh);
			jQuery( ".hb-single-product .one" ).height(wh*0.3);
			jQuery( ".hb-single-product .two" ).height(wh*0.5);
			jQuery( ".hb-single-product .three" ).height(wh*0.2);

		}
	}
	ourProducts();
	let doit;
    window.onresize = function(){
      clearTimeout(doit);
      doit = setTimeout(ourProducts, 100);
	};

	const handlerIn = function () {
		jQuery(this).find(".initial").fadeOut(100);
		jQuery(this).find(".hover").fadeIn(250);
	}
	const handlerOut = function () {
		jQuery(this).find(".hover").fadeOut(100);
		jQuery(this).find(".initial").fadeIn(250);
		
	}
	jQuery( ".hb-single-product" ).mouseenter( handlerIn ).mouseleave( handlerOut );

	</script>';
	return $hb_products; 
}
add_shortcode('hb-products', 'hb_products');



// REGISTER HURLEY BURLEY MENU
add_action( 'after_setup_theme', 'register_hb_menu' );
function register_hb_menu() {
  register_nav_menu( 'hb_custom_menu', __( 'Hurley Burley Menu', 'hb' ) );
}



// NAVIGATION
function hb_navigation() { 
	$hb_menu = wp_nav_menu(
						array(
							'echo' => false
							)
						);


						// custom menu example @ https://digwp.com/2011/11/html-formatting-custom-menus/

	
	$hb_navigation = null;
	$hb_navigation .= '<div class="hb-navigation">';
	$hb_navigation .= $hb_menu;
	$hb_navigation .= '[fusion_social_links icons_boxed="" icons_boxed_radius="" color_type="" icon_colors="" box_colors="" tooltip_placement="" blogger="" deviantart="" digg="" dribbble="" dropbox="" facebook="#" flickr="" forrst="" googleplus="" instagram="#" linkedin="" myspace="" paypal="" pinterest="" reddit="" rss="" skype="" soundcloud="" spotify="" tumblr="" twitter="#" vimeo="" vk="" xing="" yahoo="" yelp="" youtube="" email="" show_custom="no" alignment="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" /]';
	$hb_navigation .= '</div>';
	$hb_navigation .= '<div class="hb-navigation-button">';
	$hb_navigation .= '<a href="#" class="active"></a>';
	$hb_navigation .= '</div>';



	$menu_name = 'hb_custom_menu'; // specify custom menu slug
	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
		$menu = wp_get_nav_menu_object($locations[$menu_name]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$menu_list = '<nav>' ."\n";
		$menu_list .= "\t\t\t\t". '<ul>' ."\n";
		foreach ((array) $menu_items as $key => $menu_item) {
			$title = '•';
			$url = $menu_item->url;
			$menu_list .= "\t\t\t\t\t". '<li><a href="'. $url .'">'. $title .'</a></li>' ."\n";
		}
		$menu_list .= "\t\t\t\t". '</ul>' ."\n";
		$menu_list .= "\t\t\t". '</nav>' ."\n";
	} else {
		// $menu_list = '<!-- no list defined -->';
	}



	$hb_navigation .= '<div class="hb-navigation-switches">';
	$hb_navigation .= $menu_list;
	$hb_navigation .= '</div>';
	$hb_navigation .= '<style>
		.hb-navigation{
			display:block;
			width:400px;
			height:auto;
			background:#b20026;
			position:absolute;
			top:0;
			right:-400px;
			z-index:100;
			padding:90px 30px 50px;
		}
		.hb-navigation .fusion-social-links{
			padding-top:120px;
		}
		.hb-navigation ul{
			list-style:none;
			padding:0;
			margin:0;
		}
		.hb-navigation ul li a{
			color:#fff !important;
			font-size:32px;
			border-bottom:1px solid #C42549;
			display:block;
			padding:15px 0;
		}
		.hb-navigation ul li a:hover, .hb-navigation ul li a.current{
			color:#FFB6B1 !important;
		}
		.admin-bar .hb-navigation{top:28px;}
		.hb-navigation-button{
			position:absolute;
			top:30px;
			right:30px;
			display:block;
			z-index:100;
			text-align:right;
		}
		.admin-bar .hb-navigation-button{top:58px;}
		.hb-navigation-button a:after{    
			content: "\f0c9";
    		font-family: \'FontAwesome\';
    		font-style: normal;
    		font-weight: normal;
			text-decoration: inherit;
			color:#fff !important;
		}
		.hb-navigation-button a:after:hover{color:#fff !important;}
		.hb-navigation-button.active a:after{content:\'\f00d\'}
		.hb-navigation-switches{
			position:fixed;
			right:20px;
			top:120px;
			width:50px;
			height:300px;
			z-index:99;
			text-align:right;
			padding:10px 0;
		}
		.hb-navigation-switches ul{
			padding:0;
			margin:0;
		}
		.hb-navigation-switches ul li{
			list-style:none;
			text-align:center;
			height:30px;
		}
		.hb-navigation-switches a{
			display:inline-block;
			font-size:32px;
			color:#fff;
		}
		.hb-navigation-switches a:hover,.hb-navigation-switches a.current{
			color:#b20026 !important;
		}
		@media only screen and (max-width: 1024px) {
			.hb-navigation-switches{display:none}
		}
	</style>';
	echo do_shortcode($hb_navigation); 

}


add_action( 'avada_before_header_wrapper', 'hb_navigation' );



// FOOTER
function hb_footer() {
	
	$hb_footer = null;

	$hb_footer .= '<div class="hb-footer desktop">';
	$hb_footer .= '<div class="f-col-1">';
	$hb_footer .= '<img src="/hurley/wp-content/uploads/2018/04/hb-logo-footer-retina.png" alt="" />';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-2">';
	$hb_footer .= '[fusion_social_links icons_boxed="" icons_boxed_radius="" color_type="" icon_colors="#a7a7a7" box_colors="" tooltip_placement="" blogger="" deviantart="" digg="" dribbble="" dropbox="" facebook="#" flickr="" forrst="" googleplus="" instagram="#" linkedin="" myspace="" paypal="" pinterest="" reddit="" rss="" skype="" soundcloud="" spotify="" tumblr="" twitter="#" vimeo="" vk="" xing="" yahoo="" yelp="" youtube="" email="" show_custom="no" alignment="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" /]';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-3">';
	$hb_footer .= '<a href="/privacy-policy/">Privacy Policy</a> | <a href="/terms-conditions/">Terms & Conditions</a>';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-4">';
	$hb_footer .= 'Registered Office - 24 Museum Street, Ipswich, Suffolk. IP1 1HZ. <br />Company Number - 10117603. VAT No. GB 252777383';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-5">';
	$hb_footer .= 'Hurly Burly Foods Limited<br/>PO Box 73924, London. W8 9HN';
	$hb_footer .= '</div>';
	$hb_footer .= '</div>';

	$hb_footer .= '<div class="hb-footer mobile">';
	$hb_footer .= '<div class="f-col-1">';
	$hb_footer .= '<img src="/hurley/wp-content/uploads/2018/04/hb-logo-footer-retina.png" alt="" />';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-5">';
	$hb_footer .= 'Hurly Burly Foods Limited<br/>PO Box 73924, London. W8 9HN';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-4">';
	$hb_footer .= 'Registered Office - 24 Museum Street, Ipswich, Suffolk. IP1 1HZ.';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-2">';
	$hb_footer .= 'Company Number - 10117603. VAT No. GB 252777383';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-3">';
	$hb_footer .= '<a href="/privacy-policy/">Privacy Policy</a> | <a href="/terms-conditions/">Terms & Conditions</a>';
	$hb_footer .= '</div>';
	$hb_footer .= '</div>';

	$hb_footer = do_shortcode($hb_footer);
	return $hb_footer; 
}
add_shortcode('hb-footer', 'hb_footer');



// ADD OPTIONS PAGES (ACF PLUGIN MUST BE INSTALLED)
/*
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> $THEME_GLOBALS['theme_name'].' Settings',
		'menu_title'	=> $THEME_GLOBALS['theme_name'].' Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> $THEME_GLOBALS['theme_name'].' Footer',
		'menu_title'	=> $THEME_GLOBALS['theme_name'].' Footer',
		'parent_slug'	=> 'theme-general-settings',
	));


}
*/
