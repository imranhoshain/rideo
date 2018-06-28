<?php


//Find me ShortCode
function rideo_find_location_shortcode($atts, $content = null)
{
    
    $location_find_array = cs_get_option('footer_find_me_options');
    
    
    if (!empty($location_find_array)) {
        $rideo_location_find_markup = '<div class="contact-link"><ul>';
        
        foreach ($location_find_array as $location_find) {
            $rideo_location_find_markup .=  '            
            <li>
                <span>'.$location_find['footer_contact_title'].'</span><p>'.$location_find['footer_contact_detail'].'</p>
            </li>            
            '; 
        }
        
        $rideo_location_find_markup .= '</ul></div>';
    } else {
        $rideo_location_find_markup = '';
    }
    
    return $rideo_location_find_markup;
}
add_shortcode('footer_find_location', 'rideo_find_location_shortcode');

?>
