<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_Layer_Blocks extends AbstractPaymentMethodType
{
  protected $name = 'openpayment';
  
  public function initialize()
  {
    $this->settings = get_option('woocommerce_openpayment_settings', []);
  }

  public function get_payment_method_script_handles()
  {
    wp_register_script(
      'layer-blocks-integration',
	  
      plugin_dir_url(__FILE__) . 'layer_checkout_block.js',
      [
        'wc-blocks-registry',
        'wc-settings',
        'wp-element',
        'wp-html-entities',
        'wp-i18n',
      ],
      null,
      true
    );

//    if (function_exists('wp_set_script_translations')) {
//      wp_set_script_translations('noon-blocks-integration');
//    }

    return ['layer-blocks-integration'];
  }

  public function is_active() {
		return true;
    //return ! empty( $this->settings[ 'enabled' ] ) && 'yes' === $this->settings[ 'enabled' ];
	}

  public function get_payment_method_data()
  {
    $title = "Layer Payment Gateway";
    if (isset($this->settings['title'])) {
      $title = $this->settings['title'];
    }
    $description = "Pay with Open Payment";
    if (isset($this->settings['description'])) {
      $description = $this->settings['description'];
    }

    return [
      'title' => $title,
      'layer_icon' => plugins_url('images/logo.png',__FILE__),	  
      'description' => $description,
    ];
  }
}
