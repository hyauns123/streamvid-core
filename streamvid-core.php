<?php
/**
 * Plugin Name: Streamvid Core
 * Plugin URI: https://jwsuperthemes.com/
 * Description: Add Themeoption And Function Config for themes.
 * Author: JWSThemes
 * Author URI: https://jwsuperthemes.com/
 * Version: 1.4
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add Post Type.
 */
      
  
define("streamvidcore", "Active");

// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );


include_once( 'simple-user-avatar/simple-user-avatar.php' );
include_once( 'redux-core/framework.php' );
include_once( 'check_update.php' );

if(!function_exists('jws_add_less')){
	function jws_add_less(){
	  require_once plugin_dir_path( __FILE__ ) . 'less/less.php'; 
	}
}

if(!function_exists('insert_widgets')){
	function insert_widgets($tag){
	  register_widget($tag);
	}
}

if(!function_exists('insert_remove_widget')){
	function insert_remove_widget($tag){
	  unregister_widget($tag);
	}
}

if(!function_exists('insert_shortcode')){
	function insert_shortcode($tag, $func){
	 add_shortcode($tag, $func);
	}
}
if(!function_exists('custom_reg_post_type')){
	function custom_reg_post_type( $post_type, $args = array() ) {
		register_post_type( $post_type, $args );
	}
}
if(!function_exists('custom_reg_taxonomy')){
	function custom_reg_taxonomy( $taxonomy, $object_type, $args = array() ) {
		register_taxonomy( $taxonomy, $object_type, $args );
	}
}
if (!function_exists('output_ech')) { 
    function output_ech($ech) {
        echo $ech;
    }
}
if (!function_exists('decode_ct')) { 
    function decode_ct($loc) {
        echo rawurldecode(base64_decode(strip_tags($loc)));
    }
}
if (!function_exists('ct_64')) { 
    function ct_64($ech) {
       return base64_encode($ech);
    }
}
if (!function_exists('ct_65')) { 
    function ct_65($ech) {
       return base64_decode($ech);
    }
}
if(!function_exists('jws_removes_filter')){
	function jws_removes_filter($tag){
        remove_filter($tag);
	}
}
if(!function_exists('check_url')){
	function check_url(){
	    $path = $_SERVER['REQUEST_URI'];  
	    $result = array();   
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $result[] = $actual_link;
        if($path) {
            $result[] = $path;
        }
        return $result;
	}
}
if(!function_exists('jws_sv_ct3')){
	function jws_sv_ct3($user_email,$name, $subject, $content){
       wp_mail( $user_email,$name, $subject, $content );
	}
}
if(!function_exists('ct_sv')) {
    function ct_sv() {
       return $_SERVER; 
    }   
}

if(!function_exists('jws_chars_spec_html')) {
    function jws_chars_spec_html($content) {
       return htmlspecialchars_decode($content); 
    }   
}

if(!function_exists('jws_sv_ct2')){
	function jws_sv_ct2(){
       return $_SERVER['DOCUMENT_ROOT'];
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Single product share buttons
 * ------------------------------------------------------------------------------------------------
 */

if (!function_exists('jws_share_buttons')) {
    function jws_share_buttons()
    {
        ?>

        <div class="post-share addthis_inline_share_toolbox">
                <div class="post-share-inner">
                    <label class="fw-700 cl-heading"><?php echo esc_html__('Share on','streamvid'); ?></label>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook"></i></a>
            
            		<a target="_blank" href="//plus.google.com/share?url=<?php the_permalink(); ?>"><i class="fab fa-google"></i></a>
            
            		<a  target="_blank" href="//twitter.com/share?url=<?php the_permalink(); ?>"><i class="fab fa-twitter"></i></a>

                    <a  target="_blank" href="//www.linkedin.com/shareArticle?mini=true&title=<?php echo get_the_title(); ?>&url=<?php  the_permalink(); ?>"><i class="fab fa-linkedin"></i></a>
                    
                    <a target="_blank"  href="//www.pinterest.com/pin/create/button/?url=<?php echo the_permalink(); ?>"><i class="fab fa-pinterest"></i></a>
               
                </div>
        </div>

        <?php
    }
}



//Register Meta box
add_action( 'add_meta_boxes', function() {
    add_meta_box( 'product_questions', 'Questions Of Product', 'jws_questions_product_added', 'questions', 'side' );
});
 
//Meta callback function
function jws_questions_product_added( $post ) {
    $product_question = get_post_meta( $post->ID, 'product_questions', true );
    if($product_question) {
        echo '<a href="'.get_the_permalink($product_question).'" target="_blank">'.get_the_title($product_question).'</a>';
    }
}