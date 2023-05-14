<div class="bw_product_cta">
	<?php
	$background_image = get_field('background_image', 'option');
	$size = 'full';
	if( $background_image ) {
		echo wp_get_attachment_image( $background_image, $size, "", array( "class" => "background_image" ) );
	} ?>
	<div class="bw_product_cta_left">
	<?php
	$cta_image = get_field('cta_image', 'option');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	if( $cta_image ) {
		echo wp_get_attachment_image( $cta_image, $size );
	}
	?>
	</div>
	<div class="bw_product_cta_right">
	<?php
	$cta_logo = get_field('cta_logo', 'option');
	$size = 'full'; // (thumbnail, medium, large, full or custom size)
	if( $cta_logo ) {
		echo wp_get_attachment_image( $cta_logo, $size, "", array("class" => "cta_logo") );
	}
	?>
	<h2 class="title-1"><?php the_field('cta_title', 'option'); ?></h2>
	<div class="bw_product_cta_content"><?php the_field('cta_content', 'option'); ?></div>
	<?php
	$cta_link = get_field('cta_button', 'option');
	if( $cta_link ):
		$cta_link_url = $cta_link['url'];
		$cta_link_title = $cta_link['title'];
		$cta_link_target = $cta_link['target'] ? $cta_link['target'] : '_self';
		?>
		<a class="bw_cta_btn" href="<?php echo esc_url( $cta_link_url ); ?>" target="<?php echo esc_attr( $cta_cta_link_target ); ?>"><?php echo esc_html( $cta_link_title ); ?></a>
	<?php endif; ?>

	</div>
</div>
