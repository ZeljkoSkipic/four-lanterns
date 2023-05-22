<?php

if( have_rows('blurb', 'option') ): ?>
<div class="fl_bottles_wrap">
	<?php while( have_rows('blurb', 'option') ) : the_row(); ?>
	<div class="fl_bottles">
	<?php
		$image = get_sub_field('image');
		$size = 'full';
		if( $image ) {
			echo wp_get_attachment_image( $image, $size, "", array( "class" => "image" ) );
		} ?>
	<?php
		// Check rows existexists.
		if( have_rows('states_links') ): ?>
			<?php // Loop through rows.
			while( have_rows('states_links') ) : the_row();

				// Load sub field value.
				$signup_link = get_sub_field('signup_link');
				$state = get_sub_field('state'); ?>


			<?php endwhile; ?>
			<div class="fl_signup_wrap">
				<select name="" class="fl_signup_ss" id="wine_dd">
					<option id="blank">Select State</option>
					<?php while( have_rows('states_links') ) : the_row();
					$state = get_sub_field('state');
					$signup_link = get_sub_field('signup_link');
					?>
					<option value="<?php echo $signup_link; ?>"><?php echo $state; ?></option>
				<?php endwhile; ?>
				</select>
				<a class="fl_signup_btn" disabled target="_blank">Sign Up</a>
			</div>
		</div>
		<?php endif; ?>

	<?php endwhile; ?>
	</div>
<?php endif; ?>

<script>
jQuery(document).ready(function ($) {
	$( "select" )
	.change(function () {
		var str = "";
		$( "select#wine_dd option:not(#blank):selected" ).each(function() {
		str += $( this ).val() + " ";
		});
		$( ".fl_signup_btn" ).attr( "href", str );
	})
	.change();

});
</script>
