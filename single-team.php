<?php
/*
 * The template for displaying all single team.
 * Author & Copyright: VictorThemes
 * URL: http://themeforest.net/user/VictorThemes
 */

global $post;
$seese_id   = ( isset( $post ) ) ? $post->ID : false;
$seese_meta = get_post_meta( $seese_id, 'page_type_metabox', true );

if ($seese_meta) {
  $team_spacings       = $seese_meta['content_spacings'];
  $team_top_spacing    = $seese_meta['content_top_spacings'];
  $team_bottom_spacing = $seese_meta['content_bottom_spacings'];
} else {
  $team_spacings       = '';
}

if (empty($team_spacings) || ($team_spacings === 'seese-padding-none')) {
  $team_spacings       = cs_get_option('team_spacings');
  $team_top_spacing    = cs_get_option('team_top_spacing');
  $team_bottom_spacing = cs_get_option('team_bottom_spacing');
}

if ($team_spacings && $team_spacings !== 'seese-padding-none') {
  if ($team_spacings === 'seese-padding-custom') {
	$team_top_spacing = $team_top_spacing ? 'padding-top:'. seese_check_px($team_top_spacing) .' !important;' : '';
	$team_bottom_spacing = $team_bottom_spacing ? 'padding-bottom:'. seese_check_px($team_bottom_spacing) .' !important;' : '';
	$custom_padding = $team_top_spacing . $team_bottom_spacing;
  } else {
	$custom_padding = '';
  }
} else {
  $custom_padding = '';
}

$team_page_layout = cs_get_option('team_page_layout');
$column_class     = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-no-sidebar';

if ($team_page_layout === 'less-width') {
  $parent_class = 'seese-less-width';
  $layout_class = 'container seese-reduced';
} else {
  $parent_class = 'seese-extra-width';
  $layout_class = 'container';
}

get_header();
?>

<!-- Content Wrapper Start -->
<div class="seese-containerWrap <?php echo esc_attr($parent_class); ?>">
  <div class="seese-background seese-background-outer">
    <div class="<?php echo esc_attr($layout_class); ?>">
      <div class="seese-background-inner <?php echo esc_attr($content_padding); ?> seese-container-inner" style="<?php echo esc_attr($custom_padding); ?>">
        <div class="row">

          <!-- Content Column Start -->
          <div class="<?php echo esc_attr($column_class); ?> seese-contentCol">
            <div class="row seese-content-area">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="seese-single-team">

                <?php
                if (have_posts()) : while (have_posts()) : the_post();
                  $large_image  = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
                  $large_image  = $large_image[0];
                  $team_options = get_post_meta( get_the_ID(), 'team_options', true );
                  $member_link  = ($team_options['team_custom_link']) ? $team_options['team_custom_link'] : get_the_permalink();
                  $member_job   = ($team_options['team_job_position']) ? $team_options['team_job_position'] : '';

                  if ($large_image) {
                    $team_img = $large_image;
                  } else {
                    $team_img = SEESE_PLUGIN_ASTS . '/images/1170x705.jpg';
                  } ?>

                  <div class="seese-team-single-img">
                    <img src="<?php echo esc_url($team_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
                  </div>

                  <div class="seese-team-member-name">
                    <?php the_title(); ?>
                  </div>

                  <div class="seese-team-member-job">
                    <?php echo esc_attr($member_job); ?>
                  </div>

                  <div class="seese-team-content">
                    <?php the_content(); ?>
                  </div>

                <?php
                endwhile; endif;
                wp_reset_postdata();  // avoid errors further down the page
    		    ?>

                </div>
		      		</div>
            </div>
          </div>
          <!-- Content Column End -->

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Wrapper End -->

<?php get_footer();
