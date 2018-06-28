<?php
namespace Rideo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Rideo_Heading extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'rideo-heading';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Rideo Heading', 'rideo-toolkit' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-heading';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'rideo' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		// Content Controls
  		$this->start_controls_section(
  			'rideo_heading',
  			[
  				'label' => esc_html_x( 'Heading WIth Sub Title','Admin Panel','rideo-toolkit' )
  			]
  		); 
 

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html_x("Heading Text", 'Admin Panel','rideo-toolkit'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html_x("Heading Text", 'Admin Panel','rideo-toolkit'),			
			]
		); 
        
        $this->add_control(
          'heading_sub_title',
          [
             'label'   => __( 'Heading Sub Title', 'rideo-toolkit' ),
             'type'    => Controls_Manager::TEXTAREA,
             'default' => __( 'It is a long established fact that a reader will be distracted by the readable content page when looking at its layout.', 'rideo-toolkit' ),
          ]
        );
      
		$this->end_controls_section();
        
        
        $this->start_controls_section(
  			'rideo_heading_two',
  			[
  				'label' => esc_html_x( 'Heading WIthout Sub Title','Admin Panel','rideo-toolkit' )
  			]
  		); 
 

		$this->add_control(
			'heading_title_two',
			[
				'label' => esc_html_x("Heading Text", 'Admin Panel','rideo-toolkit'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html_x("Heading Text", 'Admin Panel','rideo-toolkit'),			
			]
		); 
            
      
		$this->end_controls_section(); 

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */

	protected function render( ) {
        
		$settings = $this->get_settings();             

    echo rideo_heading_shortcode($settings);            


	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
    protected function content_template() {
        
    }
}
