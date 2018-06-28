<?php

//Heading Section ShortCode
function rideo_heading_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array(
        
         'heading_title' => '',               
         'heading_sub_title' => '',               
         'heading_title_two' => '',               
                   
    ), $atts));
    

    $rideo_heading_section_markup = '<div class="section-title text-center">' ;
    
    $rideo_heading_section_markup .= '<h3>'.$heading_title.'</h3>';
    $rideo_heading_section_markup .= '
                            <div class="shape">
								<i class="fa fa-cog"></i>
							</div>';
    
    $rideo_heading_section_markup .= '<p>'.$heading_sub_title.'</p>';

    $rideo_heading_section_markup .= '</div>';

    return $rideo_heading_section_markup;

}
add_shortcode('rideo_heading', 'rideo_heading_shortcode');

?>
