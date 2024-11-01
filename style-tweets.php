<?php
/*
 * Plugin Name: Style My Tweets
 * Plugin URI: http://wordpress.org/extend/plugins/style-my-tweets/
 * Description: Easily style the Twitter widget that comes with Jetpack by WordPress.com.  This plugin requires the <a href='http://wordpress.org/extend/plugins/themekit/' target='_blank'>ThemeKit For WordPress</a> plugin.
 * Author: jaredharbour
 * Version: 1.0.1
 * Author URI: http://jaredharbour.com
 * License: GPL2+
 */
 
	class Twitter_Styles_For_Jetpack{
		
		private $_tkversion = "0.5.1";
		
		public function __construct() { 
			if( class_exists('ThemeKitForWP') ){
				$this->load_themekit_options();		
			}
		}
		
		function load_themekit_options(){
			$tw = new ThemeKitForWP();
			if( $tw->get_version() >= $this->_tkversion ){
			
				$tw->set_option_name('twitter-settings');
				$tw->set_menu_title('Style My Tweets');
				$tw->set_menu_type('settings');
				
				$radius = array();
				for ($i = 0; $i < 26; $i++){ 
					$radius[] = array('id'=>'radius_'.$i,'name'=>$i.'px'); 
				}
				
				$opts = array ();
				
				$opts[] = array( 	"desc" => "The settings below allow you to change the style of the Twitter widget that comes with Jetpack by WordPress.com<br><br>Some styles are provided as defaults so it is likely that the twitter widget on your site has already changed a bit.  Also, some of the header styles may not work because every theme is different and can use whatever html they want for widget headers.  Good Luck and Have Fun!",
									"type" => "description");
									
				$opts[] = array( 	"name" => "Tweet Widget Container",
									"type" => "section");
				
				$opts[] = array( 	
					"name" => "Container Background Color",
					"desc" => "Set a background color on the twitter container",
					"id" => "twitter_bg",
					"type" => "colorpicker",
					"std" => "#f7f7f7",
					"selector" => ".widget_twitter",
					"style"=> "background-color"
				);
				
				$opts[] = array(
					"name" => "Container Border",
					"desc" => "Adds a border to the widget container.",
					"id" => "twitter_border",
					"std" => array('width' => '2','style' => 'solid','color' => '#999999'),
					"type" => "border",
					"selector" => ".widget_twitter",
					"style" => "twitter-container-border"
				);
				
				$opts[] = array( 
					"name" => "Container Border Radius",
					"subtext"=>"",
					"desc" => "Sets the border radius of the widget container.",
					"id" => "twitter_border_radius",
					"type" => "select",
					"options" => $radius,
					"std" => 'radius_10',
					"selector" => ".widget_twitter",
					"style" => "twitter-container-border-radius"
				);
				$opts[] = array( 
					"name" => "Container Spacing",
					"desc" => "Enter an integer value i.e. 5 for the padding around the tweets.",
					"id" => "twitter_cont_padding",
					"type" => array( 
						array(  
							'id' => 'top',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Top: '
							),
						array(
							'id' => 'bottom',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Bottom: '
							),
						array(  
							'id' => 'left',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Left: '
							),
						array(
							'id' => 'right',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Right: '
							)
					),
					"selector" => ".widget_twitter",
					"style" => "twitter-container-padding"
				);
				
				$opts[] = array("type" => "close");
				
				$opts[] = array( 	"name" => "Twitter Widget Header Settings",
									"type" => "section");
				
				$opts[] = array(	
					"name" => "Header Text",		
				    "id" => "twitter_header_text",
					"std" => array('size' => '25','face' => 'Molengo','style' => 'normal','color' => '#454545','underline'=>'none'),
					"type" => "typography",
					"selector" => ".widget_twitter h1,.widget_twitter h1 a,.widget_twitter h2,.widget_twitter h2 a,.widget_twitter h3,.widget_twitter h3 a,.widget_twitter h4,.widget_twitter h4 a,.widget_twitter h5,.widget_twitter h5 a,.widget_twitter h6,.widget_twitter h6 a",
					"style"=>'font'
				);
				
				$opts[] = array( 
					"name" => "Header Text Align",
					"subtext"=>"",
					"desc" => "Sets the alignment of the header.",
					"id" => "twitter_header_text_alignment",
					"type" => "select",
					"options" => array(
						array('id'=>'left','name'=>'Left'),
						array('id'=>'right','name'=>'Right'),
						array('id'=>'center','name'=>'Center')
					),
					"std" => 'left',
					"selector" => ".widget_twitter h1,.widget_twitter h1 a,.widget_twitter h2,.widget_twitter h2 a,.widget_twitter h3,.widget_twitter h3 a,.widget_twitter h4,.widget_twitter h4 a,.widget_twitter h5,.widget_twitter h5 a,.widget_twitter h6,.widget_twitter h6 a",
					"style" => "twitter-header-text-align"
				);
				
				$opts[] = array( 
					"name" => "Header Text Margin",
					"desc" => "Enter an integer value i.e. 5 for the margin around the widget header.",
					"id" => "twitter_header_margin",
					"type" => array( 
						array(  
							'id' => 'top',
							'type' => 'text',
							'std' => 5,
							'meta' => 'px',
							'label'=>'Top: '
							),
						array(
							'id' => 'bottom',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Bottom: '
							),
						array(  
							'id' => 'left',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Left: '
							),
						array(
							'id' => 'right',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Right: '
							)
					),
					"selector" => ".widget_twitter h1,.widget_twitter h2,.widget_twitter h3,.widget_twitter h4,.widget_twitter h5,.widget_twitter h6",
					"style" => "twitter-header-margin"
				);
				
				$opts[] = array("type" => "close");
				
				$opts[] = array( 	"name" => "Tweet Settings",
									"type" => "section");
				
				$opts[] = array(	
					"name" => "Tweet Text",		
				    "id" => "twitter_text",
					"std" => array('size' => '12','face' => 'Arial','style' => 'normal','color' => '#333333'),
					"type" => "typography",
					"selector" => ".widget_twitter ul.tweets li",
					"style"=>'font'
				);
				$opts[] = array( 
					"name" => "Tweet Margin",
					"desc" => "Enter an integer value i.e. 5 for the margin around each tweet.",
					"id" => "twitter_margin",
					"type" => array( 
						array(  
							'id' => 'top',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Top: '
							),
						array(
							'id' => 'bottom',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Bottom: '
							),
						array(  
							'id' => 'left',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Left: '
							),
						array(
							'id' => 'right',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Right: '
							)
					),
					"selector" => ".widget_twitter ul.tweets li",
					"style" => "twitter-margin"
				);
				
				$opts[] = array( 
					"name" => "Tweet Spacing",
					"desc" => "Enter an integer value i.e. 5 for the padding around each tweet.",
					"id" => "twitter_padding",
					"type" => array( 
						array(  
							'id' => 'top',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Top: '
							),
						array(
							'id' => 'bottom',
							'type' => 'text',
							'std' => 10,
							'meta' => 'px',
							'label'=>'Bottom: '
							),
						array(  
							'id' => 'left',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Left: '
							),
						array(
							'id' => 'right',
							'type' => 'text',
							'std' => 0,
							'meta' => 'px',
							'label'=>'Right: '
							)
					),
					"selector" => ".widget_twitter ul.tweets li",
					"style" => "twitter-padding"
				);
				$opts[] = array("name" => "Link Style",
								"desc" => "General link styles",
								"id" => "tweet_link",
								"std" => array('style' => 'normal','color' => '#333333','underline'=>'underline'),
								"type" => "typography",
								"selector" => ".widget_twitter ul.tweets li a,.widget_twitter ul.tweets li a:link",
								"style" => "font"
				);
				$opts[] = array("name" => "Link Visited",
								"desc" => "Link visited styles",
								"id" => "tweet_link_visited",
								"std" => array('style' => 'normal','color' => '#333333','underline'=>'underline'),
								"type" => "typography",
								"selector" => ".widget_twitter ul.tweets li	a:visited",
								"style" => "font"
				);	
				$opts[] = array("name" => "Link Active",
								"desc" => "Link active styles",
								"id" => "tweet_link_active",
								"std" => array('style' => 'normal','color' => '#333333','underline'=>'underline'),
								"type" => "typography",
								"selector" => ".widget_twitter ul.tweets li	a:visited",
								"style" => "font"
				);					
				$opts[] = array("name" => "Link Hover",
								"desc" => "Link hover styles",
								"id" => "tweet_link_hover",
								"std" => array('style' => 'normal','color' => '#333333','underline'=>'none'),
								"type" => "typography",
								"selector" => ".widget_twitter ul.tweets li a:hover",
								"style" => "font"
				);
				
				$opts[] = array(
					"name" => "Tweet Seperator",
					"desc" => "Adds a border to the bottom of each tweet.",
					"id" => "tweet_border",
					"std" => array('width' => '1','style' => 'dashed','color' => '#999999'),
					"type" => "border",
					"selector" => ".widget_twitter ul.tweets li",
					"style" => "border-bottom"
				);
				
				$opts[] = array("type" => "close");
			
				$tw->register_options($opts);
				
				add_filter('themekitforwp_css_engine_twitter-settings',array(&$this,'twitter_css_engine'), 10, 2);
			}
		}
		
		function twitter_css_engine($reg_option, $saved){
			$styles = '';
		    switch( $reg_option['style'] ){
		    	case 'twitter-container-border-radius':
		    		$b = explode("_",$saved[ $reg_option[ "id" ] ]);
		        	$styles .= '-moz-border-radius: '.$b[1].'px;';
		        	$styles .= 'border-radius: '.$b[1].'px;';
		        break;
		        case 'twitter-container-border':
		        	$styles .= 'border: '.$saved[ $reg_option[ "id" ] ]['color'].' '.$saved[ $reg_option[ "id" ] ]['style'].' '.$saved[ $reg_option[ "id" ] ]['width'].'px;';
		        break;
		        case 'twitter-container-padding':
		        	$styles .= 'padding:'.$saved[ $reg_option[ "id" ] ]['top'].'px '.$saved[ $reg_option[ "id" ] ]['right'].'px '.$saved[ $reg_option[ "id" ] ]['bottom'].'px '.$saved[ $reg_option[ "id" ] ]['left'].'px;';
		        break;
		        case 'twitter-padding':
		        	$styles .= 'padding:'.$saved[ $reg_option[ "id" ] ]['top'].'px '.$saved[ $reg_option[ "id" ] ]['right'].'px '.$saved[ $reg_option[ "id" ] ]['bottom'].'px '.$saved[ $reg_option[ "id" ] ]['left'].'px;';
		       	break;
		        case 'twitter-header-margin':
		        	$styles .= 'margin:'.$saved[ $reg_option[ "id" ] ]['top'].'px '.$saved[ $reg_option[ "id" ] ]['right'].'px '.$saved[ $reg_option[ "id" ] ]['bottom'].'px '.$saved[ $reg_option[ "id" ] ]['left'].'px;';
		        break;
		        case 'twitter-margin':
		        	$styles .= 'margin:'.$saved[ $reg_option[ "id" ] ]['top'].'px '.$saved[ $reg_option[ "id" ] ]['right'].'px '.$saved[ $reg_option[ "id" ] ]['bottom'].'px '.$saved[ $reg_option[ "id" ] ]['left'].'px;';
		        break;
		        case 'twitter-header-text-align':
		        	$styles .= 'text-align:'.$saved[ $reg_option[ "id" ] ].';';
		        break;
		    }
		    return $styles;
		}
		
		function &init() {
			static $instance = false;
	
			if ( !$instance ) {
				$instance = new Twitter_Styles_For_Jetpack;
			}
	
			return $instance;
		}
	}
	
	add_action( 'init', array( 'Twitter_Styles_For_Jetpack', 'init' ) );

?>