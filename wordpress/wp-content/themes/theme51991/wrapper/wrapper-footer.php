<?php /* Wrapper Name: Footer */ ?>

<div class="row">
	<div class="span12">
		<a href="<?php echo home_url(); ?>/" class="logo_h logo_h__img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer_logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>"></a>
	</div>
</div>

<div class="row">
	<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-footer-nav.php">
		<?php get_template_part("static/static-footer-nav"); ?>
	</div>
</div>

<div class="footer-widgets">
	<div class="row">
		<div class="span12" data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="footer-sidebar">
			<?php dynamic_sidebar("footer-sidebar"); ?>
		</div>
	</div>
</div>

<!-- Social Links -->
<div class="row">
	<div class="span12 social-nets-wrapper" data-motopress-type="static" data-motopress-static-file="static/static-social-networks.php">
		<?php get_template_part("static/static-social-networks"); ?>
	</div>
</div>
<!-- /Social Links -->

<div class="copyright">
	<div class="row">
		<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-footer-text.php">
			<?php get_template_part("static/static-footer-text"); ?>
		</div>
	</div>
</div>