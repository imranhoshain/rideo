<?php
namespace Rideo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Rideo_Feature_Product extends Widget_Base {

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
		return 'products';
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
		return __( 'Rideo Feature Product', 'rideo-toolkit' );
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
  			'rideo_product_slider',
  			[
  				'label' => esc_html_x( 'Rideo Feature Product','Admin Panel','rideo-toolkit' )
  			]
  		); 
 
         		
        $this->add_control(
			'limit',
			[
				'label' => esc_html_x("Heading Text", 'Admin Panel','rideo-toolkit'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html_x("6", 'Admin Panel','rideo-toolkit'),			
			]
		); 
        
        $this->add_control(
			'rideo_product_category',
			[
				'label'     => esc_html_x( 'Categories', 'Admin Panel','rideo-toolkit' ),
				'description' => esc_html_x('Filter the posts by selected categories.', 'Admin Panel','rideo-toolkit' ),	
				'type'      =>  Controls_Manager::SELECT2,
				'default'    =>  "",
				'multiple' => true,
				"options"    => rideo_theme_product_category(),					
			]
		 
		); 
        
        $this->add_control(
			'filter',
			[
				'label'     => esc_html_x( 'List Type', 'Admin Panel','businesslounge' ),
				'type'      =>  Controls_Manager::SELECT,
				'default'    =>  "recent_products",
				"options"    => array(
									"recent_products" =>  esc_html_x( 'Recent Products', 'Admin Panel','businesslounge' ),
									"featured_products" =>  esc_html_x( 'Featured Products', 'Admin Panel','businesslounge' ),
									"sale_products" =>  esc_html_x( 'Sale Products', 'Admin Panel','businesslounge' ),
									"best_selling_products" =>  esc_html_x( 'Best-Selling Products', 'Admin Panel','businesslounge' ),
									"top_rated_products" =>  esc_html_x( 'Top Rated Products', 'Admin Panel','businesslounge' ),
								),				
			]
		 
		);
        
        $this->add_control(
			'columns',
			[
				'label'     => esc_html_x( 'Layout', 'Admin Panel','businesslounge' ),
				'description' => esc_html_x('Column layout for the list', 'Admin Panel','businesslounge' ),	
				'type'      =>  Controls_Manager::SELECT,
				'default'    =>  "4",
				"options"    => array(
									"1" => "1",
									"2" => "2",													
									"3" => "3",													
									"4" => "4",													
									"5" => "5",													
									"6" => "6",
								),				
			]
		 
		);
 
  		$this->add_control(
			'orderby',
			[
				'label'     => esc_html_x( 'List Order By', 'Admin Panel','businesslounge' ),
				'description' => esc_html_x('Sorts the posts by this parameter', 'Admin Panel','businesslounge' ),	
				'type'      =>  Controls_Manager::SELECT,
				'default'    =>  "date",
				"options"    => array(
									'date' => esc_html_x('Date',"Admin Panel","businesslounge"),
									'author' => esc_html_x('Author',"Admin Panel","businesslounge"),
									'title' => esc_html_x('Title',"Admin Panel","businesslounge"),
									'modified' => esc_html_x('Modified',"Admin Panel","businesslounge"),
									'ID' => esc_html_x('ID',"Admin Panel","businesslounge"),
									'rand' => esc_html_x('Randomized',"Admin Panel","businesslounge"),
								)							
			]
		 
		); 


 		$this->add_control(
			'order',
			[
				'label'     => esc_html_x( 'List Order', 'Admin Panel','businesslounge' ),
				'description' => esc_html_x('Designates the ascending or descending order of the list_orderby parameter', 'Admin Panel','businesslounge' ),	
				'type'      =>  Controls_Manager::SELECT,
				'default'    =>  "DESC",
				"options"    => array(
									"DESC" => esc_html_x('Descending',"Admin Panel","businesslounge"),
									"ASC" => esc_html_x('Ascending',"Admin Panel","businesslounge"),
								)							
			]
		 
		); 

 		$this->add_control(
			'per_page',
			[
				'label'   => esc_html_x("Products Count", 'Admin Panel','businesslounge'),
				'type'    =>  Controls_Manager::NUMBER, 
				'default' => 8,
				'min'     => 1,
				'max'     => 200, 		 
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

    echo rideo_product_slider_shortcode ($settings);            


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
