<?php


/********** THEME VARIABLES *************/

$THEME_GLOBALS['theme_name'] = 'Hurly Burly';  // set up theme name

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




// ADD OPTIONS PAGES (ACF PLUGIN MUST BE INSTALLED)
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> $THEME_GLOBALS['theme_name'].' Products',
		'menu_title'	=> $THEME_GLOBALS['theme_name'].' Products',
		'menu_slug' 	=> 'theme-general-products',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> $THEME_GLOBALS['theme_name'].' Footer',
		'menu_title'	=> $THEME_GLOBALS['theme_name'].' Footer',
		'parent_slug'	=> 'theme-general-settings',
	));


}




// PULL POSTS TO SLIDER
function hb_post_slider( $atts ) { 

$arr = explode(',', $atts['id']);

$hb_post_slider = null;
$hb_post_slider .= '<div class="flexslider">';
$hb_post_slider .= '<ul class="slides">';

foreach ($arr as $postid) {
	$content_post = get_post($postid);
	$content = $content_post->post_content;
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

	$hb_post_slider .= '<li>';
	$hb_post_slider .= $content;
	$hb_post_slider .= '</li>';
}


$hb_post_slider .= '</ul>';
$hb_post_slider .= '</div>';

$hb_post_slider .= '<script>

jQuery(window).load(function() {
  jQuery(".flexslider").flexslider({
	animation: "fade",
	animationLoop: true,
	smoothHeight: false,
	slideshow: true,
	directionNav: false
  });
});

</script>';

$hb_post_slider .= '<style>
.flexslider{margin-bottom:0;}
</style>';

return $hb_post_slider;

}
add_shortcode('hb-post-slider', 'hb_post_slider');





// PRODUCTS
function hb_products() { 
	$hb_products = null;
	$hb_products .= '<div class="hb-products">';


	// BLUE
	$hb_products .= '<div class="hb-single-product blue">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>'.get_field('blue_title', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('blue_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><p>'.get_field('blue_tag', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>'.get_field('blue_tag', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('blue_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><a class="product-button" href="#">FIND OUT MORE</a><p>'.get_field('blue_link', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="information">';
	$hb_products .= '<div class="info-content blue">';
	$hb_products .= '<h2>'.get_field('blue_title', 'options').'</h2>';
	$hb_products .= '<div class="left">';
	$hb_products .= '<h3>'.get_field('blue_tag', 'options').'</h3>';
	$hb_products .= '<p>'.get_field('blue_description', 'options').'</p>';
	$hb_products .= '<span class="mobile-image"><img src="'.get_field('blue_hero_image', 'options').'" alt=""></span>';	

	if( have_rows('blue_table', 'options') ):

		$hb_products .= '<table>';
		$hb_products .= '<thead>';
		$hb_products .= '<tr><th>&nbsp;</th><th><small>per 100G</small></th></tr>';
		$hb_products .= '</thead>';
		$hb_products .= '<tbody>';

		while ( have_rows('blue_table', 'options') ) : the_row();
			
			$hb_products .= '<tr><td>'.get_sub_field('title').'</td><td>'.get_sub_field('value').'</td></tr>';

		endwhile;

		$hb_products .= '</tbody>';
		$hb_products .= '</table>';

	endif;

	$hb_products .= '<h3 class="reminder">'.get_field('blue_reminder','options').'</h3>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="right">';
	$hb_products .= '<img src="'.get_field('blue_hero_image', 'options').'" alt="">';	
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';


	// GREEN
	$hb_products .= '<div class="hb-single-product green">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>'.get_field('green_title', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('green_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><p>'.get_field('green_tag', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>'.get_field('green_tag', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('green_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><a class="product-button" href="#">FIND OUT MORE</a><p>'.get_field('green_link', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="information">';
	$hb_products .= '<div class="info-content green">';
	$hb_products .= '<h2>'.get_field('green_title', 'options').'</h2>';
	$hb_products .= '<div class="left">';
	$hb_products .= '<h3>'.get_field('green_tag', 'options').'</h3>';
	$hb_products .= '<p>'.get_field('green_description', 'options').'</p>';
	$hb_products .= '<span class="mobile-image"><img src="'.get_field('green_hero_image', 'options').'" alt=""></span>';	

	if( have_rows('green_table', 'options') ):

		$hb_products .= '<table>';
		$hb_products .= '<thead>';
		$hb_products .= '<tr><th>&nbsp;</th><th><small>per 100G</small></th></tr>';
		$hb_products .= '</thead>';
		$hb_products .= '<tbody>';

		while ( have_rows('green_table', 'options') ) : the_row();
			
			$hb_products .= '<tr><td>'.get_sub_field('title').'</td><td>'.get_sub_field('value').'</td></tr>';

		endwhile;

		$hb_products .= '</tbody>';
		$hb_products .= '</table>';

	endif;

	$hb_products .= '<h3 class="reminder">'.get_field('green_reminder','options').'</h3>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="right">';
	$hb_products .= '<img src="'.get_field('green_hero_image', 'options').'" alt="">';	
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';


	// ORANGE
	$hb_products .= '<div class="hb-single-product orange">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>'.get_field('orange_title', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('orange_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><p>'.get_field('orange_tag', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>'.get_field('orange_tag', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('orange_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><a class="product-button" href="#">FIND OUT MORE</a><p>'.get_field('orange_link', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="information">';
	$hb_products .= '<div class="info-content orange">';
	$hb_products .= '<h2>'.get_field('orange_title', 'options').'</h2>';
	$hb_products .= '<div class="left">';
	$hb_products .= '<h3>'.get_field('orange_tag', 'options').'</h3>';
	$hb_products .= '<p>'.get_field('orange_description', 'options').'</p>';
	$hb_products .= '<span class="mobile-image"><img src="'.get_field('orange_hero_image', 'options').'" alt=""></span>';	

	if( have_rows('orange_table', 'options') ):

		$hb_products .= '<table>';
		$hb_products .= '<thead>';
		$hb_products .= '<tr><th>&nbsp;</th><th><small>per 100G</small></th></tr>';
		$hb_products .= '</thead>';
		$hb_products .= '<tbody>';

		while ( have_rows('orange_table', 'options') ) : the_row();
			
			$hb_products .= '<tr><td>'.get_sub_field('title').'</td><td>'.get_sub_field('value').'</td></tr>';

		endwhile;

		$hb_products .= '</tbody>';
		$hb_products .= '</table>';

	endif;

	$hb_products .= '<h3 class="reminder">'.get_field('orange_reminder','options').'</h3>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="right">';
	$hb_products .= '<img src="'.get_field('orange_hero_image', 'options').'" alt="">';	
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';


	// RED
	$hb_products .= '<div class="hb-single-product red">';
	$hb_products .= '<div class="initial">';
	$hb_products .= '<div class="one"><h2>'.get_field('red_title', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" class="hb-maxheight" src="'.get_field('red_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><p>'.get_field('red_tag', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="hover">';
	$hb_products .= '<div class="one"><h2>'.get_field('red_tag', 'options').'</h2></div>';
	$hb_products .= '<div class="two"><img class="hb-maxheight" src="'.get_field('red_image', 'options').'" alt="" /></div>';
	$hb_products .= '<div class="three"><a class="product-button" href="#">FIND OUT MORE</a><p>'.get_field('red_link', 'options').'</p></div>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="information">';
	$hb_products .= '<div class="info-content red">';
	$hb_products .= '<h2>'.get_field('red_title', 'options').'</h2>';
	$hb_products .= '<div class="left">';
	$hb_products .= '<h3>'.get_field('red_tag', 'options').'</h3>';
	$hb_products .= '<p>'.get_field('red_description', 'options').'</p>';
	$hb_products .= '<span class="mobile-image"><img src="'.get_field('red_hero_image', 'options').'" alt=""></span>';	

	if( have_rows('red_table', 'options') ):

		$hb_products .= '<table>';
		$hb_products .= '<thead>';
		$hb_products .= '<tr><th>&nbsp;</th><th><small>per 100G</small></th></tr>';
		$hb_products .= '</thead>';
		$hb_products .= '<tbody>';

		while ( have_rows('red_table', 'options') ) : the_row();
			
			$hb_products .= '<tr><td>'.get_sub_field('title').'</td><td>'.get_sub_field('value').'</td></tr>';

		endwhile;

		$hb_products .= '</tbody>';
		$hb_products .= '</table>';

	endif;

	$hb_products .= '<h3 class="reminder">'.get_field('red_reminder','options').'</h3>';
	$hb_products .= '</div>';
	$hb_products .= '<div class="right">';
	$hb_products .= '<img src="'.get_field('red_hero_image', 'options').'" alt="">';	
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';
	$hb_products .= '</div>';


	$hb_products .= '</div>';
	$hb_products .= '<div class="hb-products-info-wrapper"><div class="more-info-content"></div><a href="#" class="close">Close</a></div>';
	$hb_products .= '<style>
	.hb-products{
		position:relative;
	}
	.hb-single-product{
		width:25%;
		float:left;
		text-align:center;
		z-index:100;
		padding:50px 2%;
		position:relative;
	}
	.hb-single-product a{
		color:#fff;
	}
	.hb-single-product .hover p{
		border-bottom:5px dotted rgba(255,255,255,0);
		padding-bottom:20px;
	}

	.hb-single-product .information{
		display:none;
	}
	.hb-products-info-wrapper{
		display:none;
	}	

	.hb-products-info-wrapper .info-content{
		padding:50px 5%;
	}
	.hb-products-info-wrapper .info-content:after{
		content: "";
    	display: block;
    	clear: both;
	}

	.hb-products-info-wrapper .close{
		opacity:1;
		position:absolute;
		top:60px;
		right:10%;
		text-align:right;
		color:rgba(255,255,255,0.5);
	}

	.hb-products-info-wrapper h2{
		font-size:4vw !important;
		color:#fff !important;
		margin-bottom:40px;
	}
	.hb-products-info-wrapper h3{
		font-size:3vw;
		color:#fff;
		margin-bottom:60px;
	}
	.hb-products-info-wrapper p{
		font-size:2vw;
		color:#fff;
		margin-bottom:80px;
	}
	.hb-products-info-wrapper small{
		font-size:20px;
	}
	.hb-products-info-wrapper table{
		width:100%;
		margin-bottom:100px;
	}
	.hb-products-info-wrapper tbody tr{
		border-bottom:1px solid rgba(255,255,255,0.5);
		line-height:48px !important;
	}
	.hb-products-info-wrapper td:last-child, .hb-products-info-wrapper th:last-child{
		text-align:right;
	}
	.hb-products-info-wrapper h3.reminder{
		font-size:60px;
	}

	.hb-products-info-wrapper .left{
		float:left;
		width:50%;
	}
	.hb-products-info-wrapper .right{
		float:left;
		width:50%;
	}
	.hb-products-info-wrapper .right img{
		    text-align: right;
			margin-left: 100px;
			display: block;
			width: 50%;
			position: absolute;
	}


	.hb-single-product .initial{
		display:block;
		position:absolute;
		top:0;
		left:0;
		padding:10% 5%;
		z-index:102;
		width:25%;
		width:100%;
	}
	.hb-single-product .hover{
		display:block;
		position:absolute;
		top:0;
		left:0;
		padding:10% 5%;
		z-index:101;
		width:100%;
	}

	.hb-single-product p{
		margin-bottom:0;
		font-size:18px;
	}

	.product-button{
		padding:5px 20px;
		background:#fff;
		color:black;
		display:inline-block;
		font-size:20px !important;
		margin-bottom:20px;
	}

	.hb-single-product .three{
		font-size:24px;
	}

	.mobile-image{display:none}

	
	

	.hb-single-product.blue{
		background:#89C7E4;
		color:#fff;
	}
	.hb-single-product.blue .hover{
		background:#89C7E4;
	}
	.hb-single-product.blue .initial{
		background:#89C7E4;
	}
	.hb-single-product.blue h2{
		color:#009BAF;
	}
	.hb-single-product.blue .hover a{
		color:#009BAF;
	}
	.hb-single-product.blue .hover h2{
		color:#fff;
	}
	.hb-products-info-wrapper .blue{
		background:#009BAF;
	}
	.hb-products-info-wrapper .blue h3.reminder{
		color:#89C7E4;
	}
	.hb-products-info-wrapper .blue small{
		color:#89C7E4;
	}


	.hb-single-product.green{
		background:#00794E;
		color:#fff;
	}	
	.hb-single-product.green .hover{
		background:#00794E;
	}	
	.hb-single-product.green .initial{
		background:#00794E;
	}	
	.hb-single-product.green h2{
		color:#AAD360;
	}
	.hb-single-product.green .hover a{
		color:#AAD360;
	}
	.hb-single-product.green .hover h2{
		color:#fff;
	}
	.hb-products-info-wrapper .green{
		background:#00794E;
	}
	.hb-products-info-wrapper .green h3.reminder{
		color:#F0B139;
	}
	.hb-products-info-wrapper .green small{
		color:#F0B139;
	}


	.hb-single-product.orange{
		background:#ED7701;
		color:#fff;
	}
	.hb-single-product.orange .hover{
		background:#ED7701;
	}	
	.hb-single-product.orange .initial{
		background:#ED7701;
	}	
	.hb-single-product.orange h2{
		color:#FBBD00;
	}
	.hb-single-product.orange .hover a{
		color:#FBBD00;
	}
	.hb-single-product.orange .hover h2{
		color:#fff;
	}
	.hb-products-info-wrapper .orange{
		background:#ED7701;
	}
	.hb-products-info-wrapper .orange h3.reminder{
		color:#F0B139;
	}
	.hb-products-info-wrapper .orange small{
		color:#F0B139;
	}



	.hb-single-product.red{
		background:#C90932;
		color:#fff;
	}
	.hb-single-product.red .hover{
		background:#C90932;
	}	
	.hb-single-product.red .initial{
		background:#C90932;
	}
	.hb-single-product.red h2{
		color:#FFB6B1;
	}
	.hb-single-product.red .hover a{
		color:#FFB6B1;
	}
	.hb-single-product.red .hover h2 {
		color:#fff;
	}
	.hb-products-info-wrapper .red{
		background:#BA002B;
	}
	.hb-products-info-wrapper .red h3.reminder{
		color:#F0B139;
	}
	.hb-products-info-wrapper .red small{
		color:#F0B139;
	}


	@media only screen and (max-width: 1024px) {
		.hb-single-product{
			width:100%;
			padding:10% 30px;
		}
		.hb-products-info-wrapper .info-content{
			padding:10% 30px;
		}
		.hb-products-info-wrapper h2{
			text-align:center;
			font-size:44px !important;
		}
		.hb-products-info-wrapper h3{
			text-align:center;
			font-size:24px !important;
		}
		.hb-products-info-wrapper p{
			text-align:center;
			font-size:20px;
		}
		.product-button{
			padding:10px 20px !important;
		}
		.hb-single-product .intro p, .hb-single-product .hover p{
			border-bottom:5px dotted rgba(255,255,255,0.5);
			padding-bottom:20px;
		}
		.mobile-image{display:block}
		.hb-products-info-wrapper table td,.hb-products-info-wrapper table th{
			font-size:20px;
		}
		.hb-products-info-wrapper h3.reminder{
			float:left;
			text-align:left;
			line-height:20px;
			margin-bottom:0;
		}
		.hb-products-info-wrapper .close{
			position:absolute;
			top:auto;
			bottom:90px;
			right:10%;
			color:#fff;
		}
		.hb-products-info-wrapper .left{
			float:none;
			width:100%;
		}
		.hb-products-info-wrapper .right{
			display:none;
		}

	}


	@media only screen and (max-width: 600px) {
		.hb-products-info-wrapper .close{
			bottom:45px;
		}
	}
	</style>';
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


	
	$hb_navigation = null;
	$hb_navigation .= '<div class="hb-navigation">';
	$hb_navigation .= $hb_menu;
	$hb_navigation .= '[fusion_social_links icons_boxed="" icons_boxed_radius="" color_type="" icon_colors="" box_colors="" tooltip_placement="" blogger="" deviantart="" digg="" dribbble="" dropbox="" facebook="#" flickr="" forrst="" googleplus="" instagram="#" linkedin="" myspace="" paypal="" pinterest="" reddit="" rss="" skype="" soundcloud="" spotify="" tumblr="" twitter="" vimeo="" vk="" xing="" yahoo="" yelp="" youtube="" email="" show_custom="no" alignment="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" /]';
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
			padding:70px 30px 50px;
		}
		.hb-navigation .fusion-social-links{
			position:absolute;
			bottom:30px;
		}
		.hb-navigation ul{
			list-style:none;
			padding:0;
			margin:0;
		}
		.hb-navigation ul li a{
			color:#fff !important;
			font-size: 2vw;
			line-height: 2vw;
			border-bottom:1px solid #C42549;
			display:block;
			padding:15px 0;
		}
		.hb-navigation ul li a:hover, .hb-navigation ul li a.current{
			color:#FFB6B1 !important;
		}

		.hb-navigation-button{
			position:absolute;
			top:40px;
			right:30px;
			display:block;
			z-index:100;
			text-align:right;
			font-size:36px !important;
		}

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
			.hb-navigation ul li a{
				font-size:24px;
			}

		}
		@media only screen and (max-width: 600px) {
			.hb-navigation{width:100%}		
			.hb-navigation ul li a{
				padding:5px 0;
			}
			.hb-navigation ul li a{
				line-height: 32px;
			}
		}
	</style>';
	if(is_front_page()) {
		echo do_shortcode($hb_navigation); 
	}

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
	$hb_footer .= '[fusion_social_links icons_boxed="" icons_boxed_radius="" color_type="" icon_colors="#a7a7a7" box_colors="" tooltip_placement="" blogger="" deviantart="" digg="" dribbble="" dropbox="" facebook="https://www.facebook.com/hurlyburlyfoods" flickr="" forrst="" googleplus="" instagram="https://www.instagram.com/hurlyburlyfoods/" linkedin="" myspace="" paypal="" pinterest="" reddit="" rss="" skype="" soundcloud="" spotify="" tumblr="" vimeo="" vk="" xing="" yahoo="" yelp="" youtube="" email="" show_custom="no" alignment="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" class="" id="" /]';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-3">';
	$hb_footer .= '<a href="/privacy-policy/">Privacy Policy</a> | <a href="/terms-conditions/">Terms & Conditions</a>';
	$hb_footer .= '</div>';
	$hb_footer .= '<div class="f-col-4">';
	$hb_footer .= 'Registered Office - 24 Museum Street, Ipswich, Suffolk. IP1 1HZ. Company Number - 10117603. VAT No. GB 252777383';
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




