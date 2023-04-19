<?php

get_header();

$price = get_field('price');
$description = get_field('description');

?>

<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix bv_single-product">
            <div class="bv_product_main">
				<div class="bv_product_left">
					<h1 class="title-1"><?php the_title(); ?></h1>
					<div class="bv_pl_top">
						<span class="bv_price">$<?php echo $price; ?></span>
						<?php
							// Check rows existexists.
							if( have_rows('states_links') ): ?>
								<?php // Loop through rows.
								while( have_rows('states_links') ) : the_row();

									// Load sub field value.
									$product_link = get_sub_field('product_link');
									$state = get_sub_field('state'); ?>


								<?php endwhile; ?>
								<a class="bv_order_btn" disabled target="_blank">Order Wine</a>

								<select name="" class="bv_order_ss" id="wine_dd">
									<option id="blank">Select State</option>
									<?php while( have_rows('states_links') ) : the_row();
									$state = get_sub_field('state');
									$product_link = get_sub_field('product_link');
									?>
									<option value="<?php echo $product_link; ?>"><?php echo $state; ?></option>
								<?php endwhile; ?>
								</select>
							<?php endif; ?>
					</div>
					<div class="bv_pl_description">
						<?php echo $description; ?>
					</div>
					<?php
					// Check rows existexists.
					if( have_rows('additional_information') ): ?>
						<div class="bv_pl_additional_info">
						<?php // Loop through rows.
						while( have_rows('additional_information') ) : the_row();

							// Load sub field value.
							$section_title = get_sub_field('section_title');
							$section_text = get_sub_field('section_text'); ?>

						<div class="bv_pl_ai_box">
								<h3 class="bv_pl_title"><?php echo $section_title; ?></h3>
								<div class="bv_pl_text"><?php echo $section_text; ?></div>
						</div>

						<?php // End loop.
						endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="bv_product_right">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>
			<div class="bv_recommended">
				<h2 class="title-1"><?php the_field('recommended_title'); ?></h2>
				<div class="bv_recommended_inner">
					<?php
						$wines = get_field('wines');
						if( $wines ): ?>
							<?php foreach( $wines as $post ):

								// Setup this post for WP functions (variable must be named $post).
								setup_postdata($post); ?>
								<div class="bv_wine">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
									<div class="bw_recommended_text">
										<h2 class="bw_recommended_title"><a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a></h2>
										<p>What this text should represent?</p>
										<span class="bw_recommended_price"><?php the_field('price'); ?></span>
									</div>
								</div>
							<?php endforeach; ?>
							<?php
							// Reset the global post object so that the rest of the page works correctly.
							wp_reset_postdata(); ?>
						<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="bw_reviews">
		<div class="container">
			<script src="https://login.reviewgenerationservices.com/js/v1/embed.js?token=703d1dfa-2be9-4afa-b376-8647d9fae952" type="text/javascript"></script>
		</div>
	</div>
	<div class="bw_product_cta">
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
</div>

<script>
jQuery(document).ready(function ($) {
	$( "select" )
	.change(function () {
		var str = "";
		$( "select#wine_dd option:not(#blank):selected" ).each(function() {
		str += $( this ).val() + " ";
		});
		$( ".bv_order_btn" ).attr( "href", str );
	})
	.change();

});
</script>

<?php

get_footer();
