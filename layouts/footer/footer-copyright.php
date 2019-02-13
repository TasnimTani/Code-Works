<?php
// Theme Options
$need_copyright = cs_get_option('need_copyright');
$footer_copyright_layout = cs_get_option('footer_copyright_layout');

if ($footer_copyright_layout === 'copyright-2') {
  $copyright_layout_class    = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 seese-left';
  $copyright_seclayout_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 seese-right';
} elseif ($footer_copyright_layout === 'copyright-3') {
  $copyright_layout_class    = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 seese-right';
  $copyright_seclayout_class = 'col-lg-6 col-md-6 col-sm-6 col-xs-12 seese-left';
} else {
  $copyright_layout_class    = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 seese-center';
  $copyright_seclayout_class = '';
}

$copyright_text = cs_get_option('copyright_text');
$secondary_text = cs_get_option('secondary_text');

if (isset($need_copyright)) {
?>

<!-- Copyright Bar Start -->
<div class="seese-copyright">
  <div class="container">
    <div class="row">

      <?php if ($footer_copyright_layout === 'copyright-3') { ?>
        <div class="<?php echo esc_attr($copyright_seclayout_class); ?>">
		  <?php echo do_shortcode($secondary_text); ?>
        </div>
      <?php } ?>

      <div class="<?php echo esc_attr($copyright_layout_class); ?>">
				<?php
        if (isset($copyright_text)) {
          echo do_shortcode($copyright_text);
        } else {
          echo esc_html__('&copy; Copyright', 'seese') .' '. date('Y') .'. '. esc_html__('All Rights Reserved.', 'seese');
        } ?>
      </div>

      <?php if ($footer_copyright_layout === 'copyright-2') { ?>
        <div class="<?php echo esc_attr($copyright_seclayout_class); ?>">
		  <?php echo do_shortcode($secondary_text); ?>
        </div>
      <?php } ?>

    </div>
  </div>
</div>
<!-- Copyright Bar End -->

<?php } ?>