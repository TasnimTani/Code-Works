<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */
global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
$seese_id   = ( is_home() ) ? get_option( 'page_for_posts' ) : $seese_id;
if ( class_exists( 'WooCommerce' ) ) { $seese_id = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $seese_id; }
$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

if ($seese_meta) {
  $content_padding = $seese_meta['content_spacings'];
} else {
  $content_padding = '';
}

if ($content_padding && $content_padding !== 'seese-padding-none') {
  $content_top_spacings = $seese_meta['content_top_spacings'];
  $content_bottom_spacings = $seese_meta['content_bottom_spacings'];
  if ($content_padding === 'seese-padding-custom') {
		$content_top_spacings = $content_top_spacings ? 'padding-top:'. seese_check_px($content_top_spacings) .' !important;' : '';
		$content_bottom_spacings = $content_bottom_spacings ? 'padding-bottom:'. seese_check_px($content_bottom_spacings) .' !important;' : '';
		$custom_padding = $content_top_spacings . $content_bottom_spacings;
  } else {
		$custom_padding = '';
  }
} else {
  $custom_padding = '';
}

// Layout Options
$woo_page_layout = cs_get_option('woo_page_layout');
$woo_sidebar     = cs_get_option('woo_sidebar_position');
$woo_load_style  = cs_get_option('woo_load_style');
$woo_columns     = cs_get_option('woo_product_columns');
$woo_columns     = $woo_columns ? $woo_columns : '4';

$a = $woo_cat_filter  = cs_get_option('woo_cat_filter');
$b = $woo_sort_filter = cs_get_option('woo_sort_filter');
$c = $woo_result_cnt  = cs_get_option('woo_result_count');

if ($woo_page_layout === 'less-width') {
  $parent_class = 'seese-less-width';
  $layout_class = 'container seese-reduced';
} else {
  $parent_class = 'seese-extra-width';
  $layout_class = 'container';
}

if (is_woocommerce_shop() || is_product_category() || is_product_tag()) {
  if ($woo_sidebar === 'sidebar-hide') {
		$column_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
  } else {
    if ($woo_sidebar === 'sidebar-left') {
      $column_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-shop-has-sidebar seese-has-leftCol seese-sidebar-space-one';
    } else {
      $column_class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12 seese-has-sidebar seese-shop-has-sidebar seese-has-rightCol seese-sidebar-space-one';
    }
  }

  $shop_col_class = 'seese-shop-wrapper woo-col-'.esc_attr($woo_columns);

  if ($woo_load_style === 'page_number' || $woo_load_style === 'prev_next') {
    $pagination_class = 'seese-no-ajax';
  } else {
    $pagination_class = 'seese-ajax';
  }
} else {
  $column_class   = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';
  $shop_col_class = 'woo-content';
  $pagination_class = '';
}

if ($a && $b && $c) {
  $woo_cat_filter_class  = 'col-lg-7 col-md-7 col-sm-12 col-xs-12';
  $woo_result_cnt_class  = 'col-lg-3 col-md-3 col-sm-12 col-xs-12';
  $woo_sort_filter_class = 'col-lg-2 col-md-2 col-sm-12 col-xs-12';
} else if ($a && ($b || $c)) {
  $woo_cat_filter_class  = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
  $woo_result_cnt_class  = 'col-lg-4 col-md-4 col-sm-12 col-xs-12';
  $woo_sort_filter_class = 'col-lg-4 col-md-4 col-sm-12 col-xs-12';
} else if (!$a && $b && $c) {
  $woo_cat_filter_class  = '';
  $woo_result_cnt_class  = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
  $woo_sort_filter_class = 'col-lg-6 col-md-6 col-sm-12 col-xs-12';
} else if (($a && !($b || $c)) || ($b && !($a || $c)) || ($c && !($a || $b))) {
  $woo_cat_filter_class  = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $woo_result_cnt_class  = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
  $woo_sort_filter_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
} else {
  $woo_cat_filter_class  = '';
  $woo_result_cnt_class  = '';
  $woo_sort_filter_class = '';
}

get_header(); ?>

<!-- ContainerWrap Start-->
<div class="seese-containerWrap <?php echo esc_attr($parent_class); ?>" >
  <div class="seese-background seese-background-outer">
    <div class="<?php echo esc_attr($layout_class); ?>">
      <div class="seese-background-inner <?php echo esc_attr($content_padding); ?> seese-container-inner" style="<?php echo esc_attr($custom_padding); ?>">

        <?php
        if (is_woocommerce_shop() || is_product_category() || is_product_tag()) :
          if ($woo_cat_filter || $woo_result_cnt || $woo_sort_filter) : ?>
            <div class="row seese-filterWrap seese-shop-default-filter">
              <div class="seese-filterTabs">
              <?php
              if ($woo_cat_filter) { ?>
                <div class="<?php echo esc_attr($woo_cat_filter_class); ?> seese-cat-filter">
                  <?php
                  echo '<label>'. esc_html__('FILTER: ', 'seese') . '</label>';
                  if (function_exists('seese_category_list')) {
                    echo seese_category_list();
                  } ?>
                </div><?php
              }
              if ($woo_result_cnt) { ?>
                <div class="<?php echo esc_attr($woo_result_cnt_class); ?> seese-result-count">
                  <?php woocommerce_result_count(); ?>
                </div><?php
              }
              if ($woo_sort_filter) { ?>
                <div class="<?php echo esc_attr($woo_sort_filter_class); ?> seese-form-order-filter">
                  <?php woocommerce_catalog_ordering(); ?>
                </div><?php
              }?>
              </div>
            </div><?php
          endif;
        endif;
        ?>

        <div class="row seese-shop-default-content">
          <?php
          if (is_woocommerce_shop() || is_product_category() || is_product_tag()) {
            if ($woo_sidebar === 'sidebar-left') {
              get_sidebar('shop');
            }
          }
          ?>

          <!-- Content Area Start-->
          <div class="<?php echo esc_attr($column_class); ?> seese-contentCol">
            <div class="row seese-content-area">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php
                if (is_woocommerce_shop() || is_product_category() || is_product_tag()) {
                  echo '<div class="woocommerce">';
                } ?>

                <div class="<?php echo esc_attr($shop_col_class.' '.$pagination_class); ?>">
                  <?php
                  if (have_posts()) {
                    woocommerce_content();
                  } else {
                    get_template_part( 'layouts/post/content', 'none' );
                  } ?>
                </div>

                <?php
                if (is_woocommerce_shop() || is_product_category() || is_product_tag()) {
                  echo '</div>';
                }
                ?>

              </div>
            </div>
          </div>
          <!-- Content Area End-->

          <?php
          if (is_woocommerce_shop() || is_product_category() || is_product_tag()) {
            if (($woo_sidebar !== 'sidebar-left') && ($woo_sidebar !== 'sidebar-hide')) {
              get_sidebar('shop');
            }
          }?>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- ContainerWrap End-->

<?php get_footer();
