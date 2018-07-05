<?php 
/*
plugin Name:ShortCode

*/




add_action( 'init', 'shortcode_theme_custom_post' );
function shortcode_theme_custom_post() {
    register_post_type( 'Testimonial',
        array(
            'labels' => array(
                'name' => __( 'Testimonial' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'supports' => array('title', 'editor', 'custom-fields', 'thumbnail', 'page-attributes'),
            'public' => false,
            'show_ui' => true
        )
    );
}





function post_list_shortcode($atts){
    extract( shortcode_atts( array(
        'count' => '-1',
        'type' => 'post',
    ), $atts) );
     
    $q = new WP_Query(
        array(
		'posts_per_page' => $count,
		'post_type' => $type
		)
        );      
         
    $list = '<ul>';
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $custom_field = get_post_meta($idd, 'custom_field', true);
        $post_content = get_the_content();
        $list .= '
       
	   <li><a href="'.get_permalink().'">'.get_the_title().'</a></li>
	   <p>'.get_the_content().'</p>
        ';        
    endwhile;
    $list.= '</ul>';
    wp_reset_query();
    return $list;
}
add_shortcode('post_list', 'post_list_shortcode');  















