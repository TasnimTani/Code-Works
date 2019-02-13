<?php
/**
 * VictorTheme Custom Changes - Added the title of the form.
 */

/**
 * Order tracking form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/form-tracking.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $post;
?>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

    <!-- Custom Changes start --><h2><?php esc_html_e( 'Track Your Order', 'seese' ); ?></h2> <!-- Custom Changes end -->

    <p><?php esc_html_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'seese' ); ?></p>

<div class="seese-form-less-width"> <!-- Custom Changes div with class 'seese-form-less-width' -->
    <p class="form-row form-row-first"><label for="orderid"><?php esc_html_e( 'Order ID', 'seese' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" value="<?php echo isset( $_REQUEST['orderid'] ) ? esc_attr( wp_unslash( $_REQUEST['orderid'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'seese' ); ?>" /></p><?php // @codingStandardsIgnoreLine ?>
    <p class="form-row form-row-last"><label for="order_email"><?php esc_html_e( 'Billing email', 'seese' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" value="<?php echo isset( $_REQUEST['order_email'] ) ? esc_attr( wp_unslash( $_REQUEST['order_email'] ) ) : ''; ?>" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'seese' ); ?>" /></p><?php // @codingStandardsIgnoreLine ?>
    <div class="clear"></div>

    <p class="form-row"><input type="submit" class="button" name="track" value="<?php esc_html_e( 'Track', 'seese' ); ?>" /></p>
    <?php wp_nonce_field( 'woocommerce-order_tracking', 'woocommerce-order-tracking-nonce' ); ?>

    </div> <!-- Custom Changes div close -->
</form>
