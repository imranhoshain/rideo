<?php

//Social Link ShortCode
function rideo_footer_top_social_link_shortcode($atts, $content = null)
{
    
    $footer_top_social_array = cs_get_option('footer_top_social');
        
    if (!empty($footer_top_social_array)) {
        $footer_top_social_link_markup = '<div class="social-link actions-btn clearfix"><ul>';
        
        foreach ($footer_top_social_array as $footer_top_social_link) {            
            $footer_top_social_link_markup .= '            
            <li>
                <a href="'. esc_url($footer_top_social_link['footer_social_top_link']) .'"><i class="'.esc_attr($footer_top_social_link['footer_top_social_icon']).'"></i></a>
            </li>            
            ';
        }
        
        $footer_top_social_link_markup .= '</ul></div>';
    } else {
        $footer_top_social_link_markup = '';
    }
        
    return $footer_top_social_link_markup;
}
add_shortcode('footer_top_social_link', 'rideo_footer_top_social_link_shortcode');