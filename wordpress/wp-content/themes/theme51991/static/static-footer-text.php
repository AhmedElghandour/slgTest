<?php /* Static Name: Footer text */ ?>
<div id="footer-text" class="footer-text">
	<?php $myfooter_text = apply_filters( 'cherry_text_translate', of_get_option('footer_text'), 'footer_text' ); ?>

	<?php if($myfooter_text){?>
		<?php echo $myfooter_text; ?>
	<?php } else { ?>

		<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('description'); ?>" class="site-name"><?php bloginfo('name'); ?></a> <i>&copy; <?php echo date ('Y'); ?>.</i> <a href="<?php echo home_url(); ?>/privacy-policy/" title="<?php echo theme_locals('privacy_policy'); ?>"><?php echo theme_locals("privacy_policy"); ?></a>

	<?php } ?>
	<?php if( is_front_page() ) { ?>
		<!-- {%FOOTER_LINK} -->
	<?php } ?>
</div>