<?php
/*
 * The template for displaying 404 pages (not found).
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

// Theme Options
$error_heading      = cs_get_option('error_heading');
$error_page_content = cs_get_option('error_page_content');
$error_btn_text     = cs_get_option('error_btn_text');

$error_page_bg      = esc_url(SEESE_IMAGES) . '/404.png';
$error_page_content = ($error_page_content) ? $error_page_content : esc_html__('It looks like nothing was found at this location. Click the link below to return home.', 'seese');
$error_btn_text     = ($error_btn_text) ? $error_btn_text : esc_html__('Go Back To Home', 'seese');

$parent_class = 'seese-extra-width';
$layout_class = 'container';

get_header(); ?>

<!-- Content 404 Start -->
<div class="seese-containerWrap <?php echo esc_attr($parent_class); ?>">
  <div class="seese-background">
    <div class="<?php echo esc_attr($layout_class); ?>">
      <div class="seese-background-inner">
        <div class="row">

          <div class="error-content">
            <img src="<?php echo esc_url($error_page_bg); ?>" alt="<?php esc_html_e('404 Error', 'seese'); ?>"/>
            <h2>
              <?php
              if($error_heading){
       	        echo esc_attr($error_heading);
       	      } else {
       	        printf(esc_html__('Oops! %sPage%s Not Found!', 'seese'), '<span>', '</span>');
       	      } ?>
            </h2>
       	    <p><?php echo esc_attr($error_page_content); ?></p>
       	    <a href="<?php echo esc_url(home_url('/')); ?>" class="seese-btn btn-fourth"><?php echo esc_attr($error_btn_text); ?></a>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content 404 End -->

<?php get_footer();
