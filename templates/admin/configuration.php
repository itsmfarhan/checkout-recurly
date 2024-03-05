<?php
/**
 *
 * Admoin setting Template.
 *
 * @package ckr-recurly
 */

$public_key      = ( isset( $_REQUEST['ckr']['public_key'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['ckr']['public_key'] ) ) : $config['public_key'];
$private_api_key = ( isset( $_REQUEST['ckr']['private_api_key'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['ckr']['private_api_key'] ) ) : $config['private_api_key'];
$country_code    = ( isset( $_REQUEST['ckr']['country_code'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['ckr']['country_code'] ) ) : $config['country_code'];
$currency        = ( isset( $_REQUEST['ckr']['currency'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['ckr']['currency'] ) ) : $config['currency'];
$plan_code       = ( isset( $_REQUEST['ckr']['plan_code'] ) ) ? sanitize_text_field( wp_unslash( $_REQUEST['ckr']['plan_code'] ) ) : $config['plan_code'];


?>
<div class="wrap">
  <h2><?php echo esc_html__( 'Recurly Settings' ); ?></h2>
  <div class="">
	<form method="post" class="dis-file-uploader" enctype="multipart/form-data" >
	  <?php wp_nonce_field( 'ckr_recurly_action', 'ckr_recurly_nonce' ); ?>
	  <table class="form-table" role="presentation">
		<tbody>
		  <tr>
			<th scope="row"> <label><?php echo esc_html__( 'Public Key' ); ?></label>
			</th>
			<td><input type="text" class="regular-text" id="public_key" name="ckr[public_key]" value="<?php echo wp_kses_post( $public_key ); ?>" required /></td>
		  </tr>
		  <tr>
			<th scope="row"> <label><?php echo esc_html__( 'Private API Key' ); ?></label>
			</th>
			<td><input type="password" class="regular-text" id="private_api_key" name="ckr[private_api_key]" value="<?php echo wp_kses_post( $private_api_key ); ?>" required /></td>
		  </tr>
		  <tr>
			<th scope="row"> <label><?php echo esc_html__( 'Country Code' ); ?></label>
			</th>
			<td><input type="text" class="regular-text" id="country_code" name="ckr[country_code]" value="<?php echo wp_kses_post( $country_code ); ?>" required /></td>
		  </tr>
		  <tr>
			<th scope="row"> <label><?php echo esc_html__( 'Currency' ); ?></label>
			</th>
			<td><input type="text" class="regular-text" id="currency" name="ckr[currency]" value="<?php echo wp_kses_post( $currency ); ?>" required /></td>
		  </tr>
		  <tr>
			<th scope="row"> <label><?php echo esc_html__( 'Plan Code' ); ?></label>
			</th>
			<td><input type="text" class="regular-text" id="plan_code" name="ckr[plan_code]" value="<?php echo wp_kses_post( $plan_code ); ?>" required /></td>
		  </tr>
		  <tr>
			<th scope="row"> <input name="settings-updated" type="hidden" value="1" />
			  <input type="submit"  class="button button-primary"  value="<?php echo esc_html__( 'Save Changes' ); ?>">
			</th>
		  </tr>
		</tbody>
	  </table>
	</form>
  </div>
</div>
