<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://gameweeds.com
 * @since      1.0.0
 *
 * @package    Real_Estate
 * @subpackage Real_Estate/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Real_Estate
 * @subpackage Real_Estate/public
 * @author     Yuri Kralia <yura.kralya@gmail.com>
 */
class Real_Estate_Public {

	CONST TAXONOMY = 'district';
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Real_Estate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Real_Estate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/real-estate-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Real_Estate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Real_Estate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/real-estate-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'real_estate_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	}

	/**
	 * Register custom taxonomies.
	 *
	 * @since    1.0.0
	 */
	public function register_taxonomies() {
		register_taxonomy( self::TAXONOMY, 'real_estate_object', array(
			'label'        => __( 'District', 'textdomain' ),
			'rewrite'      => array( 'slug' => 'posts/district' )
		) );
	}

	/**
	 * Register custom post types.
	 *
	 * @since    1.0.0
	 */
	public function register_post_types() {
		register_post_type( 'real_estate_object', array(
			'public' => true,
			'labels' => array(
				'name'          => esc_html__( 'Real Estate Objects', 'textdomain' ),
				'all_items'     => esc_html__( 'All Real Estate Objects', 'textdomain' ),
				'singular_name' => esc_html__( 'Real Estate Object', 'textdomain' )
			),
		) );
	}

	/**
	 * Add shortcode which display ACF Form Fields as Filter for RealEstateObjects.
	 *
	 * @since    1.0.0
	 */
	public function display_real_estate_acf_fields_run( $atts, $content = "" ) {

        extract( shortcode_atts( array(
            'field_group'      => '',
            'post_id'    => false,
        ), $atts ) );

		ob_start();

		acf_form_head();

		acf_form(array(
			'post_id'       => $post_id,
			'post_title'    => false,
			'post_content'  => false,
			'field_groups' => [ $field_group ],
			'submit_value'  => __('Filter')
		));

		return ob_get_clean();
	} 

	/**
	 * Add shortcode which display ACF Form Fields as Filter for RealEstateObjects.
	 *
	 * @since    1.0.0
	 */
	public function acf_fields_as_characteristicks_run( $atts, $content = "" ) {

		extract( shortcode_atts( array(
            'field_group'      => '',
            'post_id'    => false,
        ), $atts ) );
		
		$fields = acf_get_fields($field_group);
		if ($fields){

			$inner = "<h4 class='acf-label'>Characteristics</h4><ul>";

			foreach ($fields as $field){
				$key = $field['key'];
				/** TODO:: What the field with _validate_email email? I don't create it... */
				if ($key == '_validate_email')
					continue;

				$fieldObject = acf_get_field($key, false, false);
				$fieldLabel = $fieldObject['label'];

				$fieldValue = get_field($key, false, false);

				
				$inner .= "<li>$fieldLabel: $fieldValue</li>";
				
			}

			$inner .= "</ul>";
		}

		return $inner;
	} 

	/**
	 * ACF Filter Ajax Handler
	 * 
	 * Display list of Real Estate Objects with pagination using "display-posts" shortcode.
	 */
	public function acf_filter_ajax_handler()
	{
		/** Retrieve terms here, because display-posts shortcode try get terms with "wp_get_post_terms" and return empty set */
		$terms    = get_terms( 
			array(
				'taxonomy'   => self::TAXONOMY, 
				'hide_empty' => false
			) );
		$terms = implode(',', array_map(function($item){ return $item->slug; },$terms));

		ob_start();
		echo do_shortcode("[display-posts include_content='true' category_display='".self::TAXONOMY."' category_label='District: ' taxonomy='district' tax_term='".$terms."' post_type='real_estate_object' posts_per_page='3' pagination='true' /]");

		$content = ob_get_clean();
		echo json_encode(['content' => $content]);
    	wp_die();
	}

	/**
	 * Extend "display-posts" shortcode by ACF Filter params.
	 * 
	 * Retrive ACF fields keys and values and put them into $args as meta_key and meta_value.
	 */
	public function display_posts_shortcode_args( $args, $atts ){
		
		$acf_filter_form_data = array();
		parse_str($_POST['data'], $acf_filter_form_data);

		if ($acf_filter_form_data['_acf_form']){

			$args['meta_key'] = [];
			$args['meta_value'] = [];
			foreach ($acf_filter_form_data['acf'] as $key => $value){

				$field = acf_get_field($key, false, false);
			
				array_push($args['meta_key'], $field['name']);
				array_push($args['meta_value'], $value);
			}
		}else{
			$args['meta_key'] = [''];
			$args['meta_value'] = [''];
		}

		return $args;
	}

}
