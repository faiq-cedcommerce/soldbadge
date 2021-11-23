<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woo_Soldbadge
 * @subpackage Woo_Soldbadge/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Soldbadge
 * @subpackage Woo_Soldbadge/public
 * @author     Faiq Masood <faiqmasood@cedcommerce.com>
 */
class Woo_Soldbadge_Public {

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
		 * defined in Woo_Soldbadge_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Soldbadge_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-soldbadge-public.css', array(), $this->version, 'all' );

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
		 * defined in Woo_Soldbadge_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Soldbadge_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-soldbadge-public.js', array( 'jquery' ), $this->version, false );

	}

	//Showing Sold Out Label over the product Image
	public function show_soldout_badge () {
		global $product;
		if($product->managing_stock() && (int) $product-> get_stock_quantity () < 1){
			echo '<span class = "ced_soldout">Sold</span>';
		}		
	}

	//Change the Checkout Form Field Label
	public function rename_checkout_form_fields( $address_fields ) {
		
		$address_fields['billing']['billing_phone']['label'] ="Mobile";
		$address_fields['billing']['billing_email']['label'] ="Email";
     	return $address_fields;
	
	}

	//Change the title of the single page using overriding the template file title.php
	public function woo_adon_plugin_template( $template, $template_name, $template_path ) {
		if ( 'title.php' === basename( $template ) ) {
			$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'woocommerce/single-product/title.php';
			}

		//for multiple templates overriding	
			// elseif ( 'form-billing.php' === basename( $template ) ) {
			// 	$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'woocommerce/checkout/form-billing.php';
			// 	}	

			return $template;
   }
}