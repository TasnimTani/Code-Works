<?php
/**
 * VictorTheme Custom Changes - Single Product Navigation, Container Class, Image Col and Summary Col Class Added
 */

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

    <!-- Custom Changes Starts -->
  <div class="seese-single-product-showcase">

      <?php
          $woo_single_nav = (cs_get_option('woo_single_nav')) ? true : false;
          if($woo_single_nav){
      ?>
              <div class="seese-single-product-menu">
                  <div class="seese-single-next-link">
                      <?php
                          next_post_link('%link', apply_filters('seese_single_product_next', '<i class="fa fa-angle-left" aria-hidden="true"></i>'), false, array(), 'product_cat');
                      ?>
                  </div>
                  <div class="seese-single-prev-link">
                      <?php
                          previous_post_link('%link', apply_filters('seese_single_product_prev', '<i class="fa fa-angle-right" aria-hidden="true"></i>'), false, array(), 'product_cat');
                      ?>
                  </div>
              </div>
      <?php
          }
      ?>

        <div class="container">
            <div class="row">

                <div class="seese-product-image-col col-lg-6 col-md-6 col-xs-12">
                <!-- Custom Changes Ends -->
                    <?php
                        /**
                         * woocommerce_before_single_product_summary hook.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action('woocommerce_before_single_product_summary');
                    ?>
                <!-- Custom Changes Starts -->
                </div>

                <div class="seese-product-summary-col col-lg-6 col-md-6 col-xs-12">
                    <div class="summary entry-summary">
                <!-- Custom Changes Ends -->
                    <?php
                        /**
                         * woocommerce_single_product_summary hook.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                        do_action( 'woocommerce_single_product_summary' );
                    ?>
               <!-- Custom Changes Starts -->
                    </div>
               </div><!-- .summary -->

            </div>
        </div>

    </div>
    <!-- Custom Changes Ends -->

    <?php
        /**
         * woocommerce_after_single_product_summary hook.
         *
         * @hooked woocommerce_output_product_data_tabs - 10
         * @hooked woocommerce_upsell_display - 15
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product_summary' );
    ?>

    <meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
