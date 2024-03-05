<?php
/**
 *
 * Admoin Checkout Template.
 *
 * @package ckr-recurly
 */
wp_enqueue_script( 'ckr-recurly-custom' );
global $wpdb, $form_error;
$config = get_option( 'ckr_recurly_config' );


if ( is_wp_error( $form_error ) ) {
	foreach ( $form_error->get_error_messages() as $r_error ) {
		echo esc_html__( '<div class="error_recurly">' );
		echo esc_html__( '<strong>ERROR</strong>:' );
		echo esc_attr_e( $r_error, 'ckr-recurly' );
		echo esc_html__( '<br/></div>' );
	}
}
$first_name = ( isset( $_REQUEST['first_name'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['first_name'] ) ) : '';
$last_name  = ( isset( $_REQUEST['last_name'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['last_name'] ) ) : '';
?>
<form id="recurly-form" name="recurly-form" method="post" autocomplete="off">
  <input type="hidden"   name="thankyou_page" value="<?php echo wp_kses_post( get_permalink() ); ?>" />
  <div id="error_recurly" style="display: none;" class="error_recurly"></div>
  <div class="ckr-recurly-form-field "  >
	<input type="text" data-recurly="first_name" placeholder="First Name" name="first_name" id="first_name" value="<?php echo wp_kses_post( $first_name ); ?>" class="recurly-form-field-medium" autocomplete="first_name">
  </div>
  <div class="ckr-recurly-form-field "  >
	<input type="text" data-recurly="last_name" placeholder="Last Name" name="last_name" id="last_name" value="<?php echo wp_kses_post( $last_name ); ?>" class="recurly-form-field-medium" autocomplete="off">
  </div>
  <div class="ckr-recurly-form-field "  >
	<input type="text" name="email" data-recurly="email"  placeholder="Email" id="email" class="recurly-form-field-medium" autocomplete="off">
  </div>
  <div class="ckr-recurly-form-field "  >
	<div id="recurly-elements"> </div>
  </div>
  <!-- Recurly Elements will be attached here -->
  
  <div class="ckr-recurly-form-field "  >
	<input type="text" data-recurly="address1" placeholder="Address" name="address1" id="address1" class="recurly-form-field-medium" autocomplete="off">
  </div>
  <div class="ckr-recurly-form-field "  >
	<input type="text" data-recurly="city" placeholder="City" name="city" id="city" class="recurly-form-field-medium" autocomplete="off">
  </div>
  <input type="hidden" data-recurly="country" placeholder="Country" value="<?php echo wp_kses_post( $config['country_code'] ); ?>" name="country" id="country" class="recurly-form-field-medium" autocomplete="off">
  <div class="ckr-recurly-form-field "  >
	<input type="text" data-recurly="state" placeholder="State" name="state" id="state" class="recurly-form-field-medium" autocomplete="off">
  </div>
  <div class="ckr-recurly-form-field "  >
	<input type="text" data-recurly="postal_code" placeholder="Postal Code" name="postal_code" id="postal_code" class="recurly-form-field-medium" autocomplete="off">
  </div>
  
  <!-- Recurly.js will update this field automatically -->
  <input type="hidden" name="recurly-token" data-recurly="token">
  <div class="ckr-recurly-submit-container"><button type="submit" id="btn_sub" class="submit">submit</button></div>
  
  <img src="<?php echo wp_kses_post( home_url( '/wp-includes/js/thickbox/loadingAnimation.gif' ) ); ?>" id="loader_img" style="display: none;" />
</form>
 
<script>
recurly.configure('<?php echo wp_kses_post( $config['public_key'] ); ?>');
 const elements = recurly.Elements();
const cardElement = elements.CardElement();
cardElement.attach('#recurly-elements');
 

document.querySelector('#recurly-form').addEventListener('submit', function (event) {
recurlyErrors('');	
	hideRecurlyError();
  const form = this;
  event.preventDefault();
	
	if(validateForm()){
  recurly.token(elements, form, function (err, token) {
	if (err) {
		
		 
		recurlyErrors(err.message);
		 
	} else {
		  document.getElementById("error_recurly").style.display = "block";   
	 
	   form.submit();
	}
  });
		
	}
});
</script>
