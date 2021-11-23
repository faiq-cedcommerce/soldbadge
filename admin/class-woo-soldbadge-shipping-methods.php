<?php
class Woo_Soldbadge_Shipping_Methods extends WC_Shipping_Method {
    public function __construct( $instance_id = 0) {
        $this->id                   = 'cedcoss-shipping'; 
        $this->method_title         = 'CEDCOSS Shipping';  
        $this->method_description   = 'Custom Shipping Method for CEDCOSS'; 
        $this->availability         = 'including';
        $this->countries = array(
            'US', // Unites States of America

            'CA', // Canada

            'DE', // Germany

            'GB', // United Kingdom

            'IT', // Italy

            'ES', // Spain

            'HR' // Kenya

            );
            
        $this->init();

        $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
        $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : 'CEDCOSS Shipping';
    }

    function init(){
        $this->init_form_fields();
        $this->init_settings();
        add_action('woocommerce_update_options_shipping_' . $this->id, array($this, 'process_admin_options'));
    }
    function init_form_fields(){
        $this->form_fields = array(
            'enabled' => array(
            'title' => 'Enable',
            'type' => 'checkbox',
            'default' => 'yes'
            ),
            'weight' => array(
            'title' => 'Weight (kg)',
            'type' => 'number',
            'default' => 50
            ),
            'title' => array(
            'title' => 'Title',
            'type' => 'text',
            'default' => 'CEDCOSS Shipping',
            ),
        );
    }

   function calculate_shipping($package){
             $weight = 0;

            $cost = 0;

            $country = $package["destination"]["country"];

            foreach ( $package['contents'] as $item_id => $values )

            {

                $_product = $values['data'];

                $weight = $weight + $_product->get_weight() * $values['quantity'];

            }
            $weight = wc_get_weight( $weight, 'kg' );

            if( $weight <= 10 ) {

            $cost = 0;

            } elseif( $weight <= 30 ) {

            $cost = 5;

            } elseif( $weight <= 50 ) {

            $cost = 10;

            } else {

            $cost = 20;

            }

            $countryZones = array(

            'HR' => 0,

            'US' => 3,

            'GB' => 2,

            'CA' => 3,

            'ES' => 2,

            'DE' => 1,

            'IT' => 1

            );




            $zonePrices = array(

            0 => 10,

            1 => 30,

            2 => 50,

            3 => 70

            );


            $zoneFromCountry = $countryZones[ $country ];

            $priceFromZone = $zonePrices[ $zoneFromCountry ];

            $cost += $priceFromZone;

            $rate = array(

            'id' => $this->id,

            'label' => $this->title,

            'cost' => $cost

            );

            $this->add_rate( $rate );

    }
 
}
