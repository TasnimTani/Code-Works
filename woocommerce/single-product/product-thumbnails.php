<?php
/**
 * VictorTheme Custom Changes - Changed the full structure thumbnail slider and connect with large image
 */

/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
    return;
}

global $post, $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && has_post_thumbnail() ) {  ?>

    <div class="thumbnails">
        <div id="seese-product-thumbnails-slider">
            <?php
                // Featured image
                if ( has_post_thumbnail() ) {
                    $loop = 1;
                    $image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="woocommerce-product-gallery__image current">%s</div>', $image ), $post->ID );
                } else {
                    $loop = 0;
                }

                 // Gallery images
                foreach ( $attachment_ids as $attachment_id ) {
                    $loop++;
                    $image_link = wp_get_attachment_url( $attachment_id );
                    if ( ! $image_link ) {
                        continue;
                    }
                    $active_class = ( $loop == 1 ) ? 'current' : '';
                    $image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
                    echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div class="woocommerce-product-gallery__image %s">%s</div>', $active_class, $image ), $attachment_id, $post->ID );
                }
            ?>
        </div>
    </div>

<?php
}
