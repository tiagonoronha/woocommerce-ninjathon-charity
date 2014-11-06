<?php

/**
 * Plugin Name: WooCommerce Ninjathon Charity
 * Plugin URI: http://woothemes.com
 * Description: Ninjathon
 * Author: WooThemes
 * Author URI: http://www.woothemes.com/
 * Version: 1.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WC Ninjathon Charity class
 */
class WC_Ninjathon_Charity {

    /**
     * Constructor
     */
    public function __construct() {
    	add_action( 'woocommerce_cart_calculate_fees', array( $this, 'woocommerce_custom_surcharge' ) );
    }

	/**
	 * Add a 1% surcharge to your cart / checkout
	 * change the $percentage to set the surcharge to a value to suit
	 * Uses the WooCommerce fees API
	 */
	public function woocommerce_custom_surcharge() {
	  global $woocommerce;

		if ( is_admin() && ! defined( 'DOING_AJAX' ) )
			return;

		$percentage = 0.01;
		$surcharge = ( $woocommerce->cart->cart_contents_total + $woocommerce->cart->shipping_total ) * $percentage;
		$woocommerce->cart->add_fee( 'Surcharge', $surcharge, true, 'standard' );

	}

}

$GLOBALS['wc_ninjathon_charity'] = new WC_Ninjathon_Charity();