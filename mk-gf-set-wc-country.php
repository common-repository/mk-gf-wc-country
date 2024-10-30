<?php
defined( 'ABSPATH' ) or die( 'You can\'t access this file directly!');
/**
 * Plugin Name: MK GF WC Country
 * Plugin URI: https://mklasen.com
 * Description: MK GF WC Country
 * Version: 1.0
 * Author: Marinus Klasen
 * Author URI: http://mklasen.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html


 Copyright 2015  Marinus Klasen  (email : marinus@mklasen.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

 */

class MK_GF_WC_Country {
  function __construct() {
    $this->init();
  }

  public function init() {
    add_action('plugins_loaded', function() {
      // Check if both Woocommere and Gravity Forms are activated.
      if ( class_exists( 'woocommerce' ) && class_exists('GFForms') ) {
        $this->hooks();
      }
    });
  }

  public function hooks() {
    // Use Woocommerces country list for Gravity Forms
    add_filter('gform_countries', array($this, 'set_gf_wc_countries'));
  }

  public function set_gf_wc_countries() {
    return WC()->countries->countries;
  }

  public function get_address_field($fields) {
    foreach ($fields as $key => $field) {
      if ($field->type == 'address')
        return $field;
    }
  }
}

$mk_gf_wc_country = new MK_GF_WC_Country();
