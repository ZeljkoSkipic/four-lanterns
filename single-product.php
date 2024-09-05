<?php

get_header();

$price = get_field('price');
$description = get_field('description');

?>

<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix fl_single-product">
            <div class="fl_product_main">
				<div class="fl_product_left">
					<h1 class="title-1"><?php the_title(); ?></h1>
					<div class="fl_pl_top">
						<span class="fl_price">$<?php echo $price; ?></span>
						<?php
							// Check rows existexists.
							if( have_rows('states_links') ): ?>
								<?php // Loop through rows.
								while( have_rows('states_links') ) : the_row();

									// Load sub field value.
									$product_link = get_sub_field('product_link');
									$state = get_sub_field('state'); ?>


								<?php endwhile; ?>
								<a class="fl_order_btn" disabled target="_blank">Order Wine</a>

								<select name="" class="fl_order_ss" id="wine_dd">
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
					<div class="fl_pl_description">
						<?php echo $description; ?>
					</div>
					<?php
					// Check rows existexists.
					if( have_rows('additional_information') ): ?>
						<div class="fl_pl_additional_info">
						<?php // Loop through rows.
						while( have_rows('additional_information') ) : the_row();

							// Load sub field value.
							$section_title = get_sub_field('section_title');
							$section_text = get_sub_field('section_text'); ?>

						<div class="fl_pl_ai_box">
								<h3 class="fl_pl_title"><?php echo $section_title; ?></h3>
								<div class="fl_pl_text"><?php echo $section_text; ?></div>
						</div>

						<?php // End loop.
						endwhile; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="fl_product_right">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>
			<div class="fl_recommended">
				<h2 class="title-1"><?php the_field('recommended_title'); ?></h2>
				<div class="fl_recommended_inner">
					<?php
						$wines = get_field('wines');
						if( $wines ): ?>
							<?php foreach( $wines as $post ):

								// Setup this post for WP functions (variable must be named $post).
								setup_postdata($post); ?>
								<div class="fl_wine">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
									<div class="bw_recommended_text">
										<h2 class="bw_recommended_title"><a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a></h2>
										<?php the_excerpt(); ?>
										<span class="bw_recommended_price">$<?php the_field('price'); ?></span>
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
			<h2 class="title-1"><?php the_field('reviews_title', 'option'); ?></h2>
			<?php
			$review_stars = get_field('review_stars', 'option');
			$size = 'full';
			if( $review_stars ) {
				echo wp_get_attachment_image( $review_stars, $size, "", array( "class" => "review_stars" ) );
			} ?>
			<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script> <div class="elfsight-app-57b7f74e-bf9b-4d1b-81e2-e9069c794248" data-elfsight-app-lazy></div>
		</div>
	</div>
	<?php get_template_part('template-parts/cta'); ?>
</div>

<script>
jQuery(document).ready(function ($) {
	$( "select" )
	.change(function () {
		var str = "";
		$( "select#wine_dd option:not(#blank):selected" ).each(function() {
		str += $( this ).val() + " ";
		});
		$( ".fl_order_btn" ).attr( "href", str );
	})
	.change();

});
</script>

<?php

get_footer();
