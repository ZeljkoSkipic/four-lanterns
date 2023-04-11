<?php

get_header();

$price = get_field('price');
$description = get_field('description');

?>

<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix bv_single-product">
            <div class="bv_product_left">
                <h1><?php the_title(); ?></h1>
                <div class="bv_pl_top">
                    <span class="bv_price">$<?php echo $price; ?></span>
                    <a class="bv_order_btn" href="#">Order Wine</a>
                    <?php
                        // Check rows existexists.
                        if( have_rows('states_links') ): ?>
                            <select name="" id="">
                            <?php // Loop through rows.
                            while( have_rows('states_links') ) : the_row();

                                // Load sub field value.
                                $state = get_sub_field('state');
                                $product_link = get_sub_field('product_link'); ?>

                                <option value="<?php echo $state; ?>"><?php echo $state; ?></option>

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
	</div>
</div>

<?php

get_footer();
