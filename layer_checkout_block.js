const layer_settings = window.wc.wcSettings.getSetting('openpayment_data', {});
const layer_label = window.wp.htmlEntities.decodeEntities(layer_settings.title) || window.wp.i18n.__('Layer Payment for WooCommerce', 'openpayment');
const layericon = layer_settings.layer_icon;

const Layer_Content = () => {
    return window.wp.htmlEntities.decodeEntities(layer_settings.description || '');
};

const Layer_Block_Gateway = {
    name: 'openpayment',    
	label: window.wp.element.createElement(() =>
      window.wp.element.createElement(
        "span",
        {style: {position: "relative", left: "0", bottom: "0"}}, 
        window.wp.element.createElement("img", {
          src: layericon,
          alt: layer_label,
		  alignSelf: "bottom",
        }),
			"           " + layer_label+""

      )
    ),	
    content: Object(window.wp.element.createElement)(Layer_Content, null ),
    edit: Object(window.wp.element.createElement)(Layer_Content, null ),
    canMakePayment: () => true,
    ariaLabel: layer_label,
	placeOrderButtonLabel: 'Pay Now with Open Payment',
    supports: {
        features: layer_settings.supports,
    },
};


window.wc.wcBlocksRegistry.registerPaymentMethod( Layer_Block_Gateway );
