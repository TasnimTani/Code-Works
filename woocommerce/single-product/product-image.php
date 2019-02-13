<?php
/**
 * VictorTheme Custom Changes - Changed the full structure to make the product large image slider and thumbnail slider and connect them
 */

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
    return;
}

global $post, $product;
$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
    'woocommerce-product-gallery',
    'woocommerce-product-gallery--' . $placeholder,
    'woocommerce-product-gallery--columns-' . absint( $columns ),
    'images',
) );

// Custom Changes Start
$woo_single_modal = cs_get_option('woo_single_modal');

if ( $woo_single_modal ) {
    $modal_enabled = true;
    $zoom_class = 'seese-zoom';
    $image_gallery_class = 'modal-enabled seese-gallery';
} else {
    $modal_enabled = false;
    $zoom_class = 'seese-no-zoom';
    $image_gallery_class = '';
}

?>

<div class="row"> 

    <div class="seese-product-images-col col-lg-10 col-md-9 col-sm-9 col-xs-10" id="seese-product-images-col">
        
        <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">

            <figure class="woocommerce-product-gallery__wrapper">       

                <?php
                    $woo_single_custom_badge = get_post_meta( $post->ID, 'badge_input', true );
                    if(!empty($woo_single_custom_badge)) { echo '<span class="seese-custom-badge">'.esc_attr( $woo_single_custom_badge, 'seese' ).'</span>'; }
                ?>

                <div id="seese-product-images-slider" class="<?php echo esc_attr($image_gallery_class); ?> slick-slider slick-arrows-small" >
            
                    <?php
                        // Featured image
                        if ( has_post_thumbnail() ) {
                            $image_title    = esc_attr( get_the_title( $post->ID ) );
                            $image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('alt' => $image_title) );
                            if ( $modal_enabled ) {
                                $full_image       = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                                $image_icon       = 'seese-font-plus';
                                $image_wrap_open  = sprintf( '<a href="%s" class="seese-product-image-link" data-size="%sx%s" itemprop="image">', esc_url( $full_image[0] ), intval( $full_image[1] ), intval( $full_image[2] ) );
                                $image_wrap_close = '<i class="seese-product-image-icon seese-font ' . $image_icon . '"></i></a>';
                            } else {
                                $image_wrap_open  = '';
                                $image_wrap_close = '';
                            }
                            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="woocommerce-product-gallery__image %s">%s%s%s</div>', $zoom_class, $image_wrap_open, $image, $image_wrap_close ), $post->ID );
                        } else {
                            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="woocommerce-product-gallery__image--placeholder"><img src="%s" alt="%s" /></div>', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'seese' ) ), $post->ID );
                        }

                        // Gallery images
                        $attachment_ids = $product->get_gallery_image_ids ();

                        if ( $attachment_ids ) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                $image_link = wp_get_attachment_url( $attachment_id );
                                if ( ! $image_link ) {
                                    continue;
                                }
                                $image_title    = esc_attr( get_the_title( $attachment_id ) );
                                $image          = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array('alt' => $image_title) );
                                if ( $modal_enabled ) {
                                    $full_image = wp_get_attachment_image_src( $attachment_id, 'full' );
                                    $image_wrap_open  = sprintf( '<a href="%s" class="seese-product-image-link" data-size="%sx%s" itemprop="image">', esc_url( $full_image[0] ), intval( $full_image[1] ), intval( $full_image[2] ) );
                                    $image_wrap_close = '<i class="seese-product-image-icon seese-font seese-font-plus"></i></a>';
                                } else {
                                    $image_wrap_open  = '';
                                    $image_wrap_close = '';
                                }
                                echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div class="woocommerce-product-gallery__image %s">%s%s%s</div>', $zoom_class, $image_wrap_open, $image, $image_wrap_close ), $post->ID );
                            }
                        }
                    ?>

                </div>

            </figure>
        
        </div>
    
    </div>

    <div class="seese-product-thumbnails-col col-lg-2 col-md-3 col-sm-3 col-xs-2">
        <?php do_action( 'woocommerce_product_thumbnails' ); ?>
    </div>

</div>
