<?php
use \NextAddons\Utilities\Help as Help;

$nextaddons_slide_dot = empty($nextaddons_slide_dot) ? 'no' : 'yes';
$nextaddons_slide_arrow = empty($nextaddons_slide_arrow) ? 'no' : 'yes';

$leftIcon = isset($nextaddons_slide_arrow_left['value']) ? $nextaddons_slide_arrow_left['value'] : 'nx-icon nx-icon-chevron-left';
$rightIcon = isset($nextaddons_slide_arrow_right['value']) ? $nextaddons_slide_arrow_right['value'] : 'nx-icon nx-icon-chevron-right';

$vertical = isset($nextaddons_slide_vertical) ? $nextaddons_slide_vertical : 'no';

$nextaddons_slide_enable = isset($nextaddons_slide_enable) ? $nextaddons_slide_enable : 'no';
$nextaddons_slide_speed = isset($nextaddons_slide_speed) ? $nextaddons_slide_speed : '0';
$nextaddons_slide_width = isset($nextaddons_slide_width) ? $nextaddons_slide_width : '300';
$nextaddons_slide_spacing = isset($nextaddons_slide_spacing) ? $nextaddons_slide_spacing : '';
$nextaddons_slide_arrow = isset($nextaddons_slide_arrow) ? $nextaddons_slide_arrow : 'no';
$nextaddons_slide_item = isset($nextaddons_slide_item) ? $nextaddons_slide_item : '1';
$nextaddons_slide_dot = isset($nextaddons_slide_dot) ? $nextaddons_slide_dot : 'no';

?>
<div class="themedev-woocommerce-wrapper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <?php if($nextaddons_slide_enable == 'yes'){?>
    <div class="nxadd-slider-item ">    
        <div class="nx-slider-content " id="<?php echo esc_attr($elementorID);?>" nx-slide-active="0" nx-slide-speed="<?php echo esc_attr($nextaddons_slide_speed);?>" nx-item-width="<?php echo esc_attr($nextaddons_slide_width);?>" nx-item-margin="<?php echo esc_attr($nextaddons_slide_spacing);?>" nx-control-button="<?php echo esc_attr($nextaddons_slide_arrow);?>" nx-pre-button-text="<?php echo esc_attr($leftIcon);?>" nx-next-button-text="<?php echo esc_attr($rightIcon);?>" nx-slide-item="<?php echo esc_attr($nextaddons_slide_item);?>" nx-control-dot="<?php echo esc_attr($nextaddons_slide_dot);?>" nx-slide-type="<?php echo esc_attr($vertical);?>">				    
    <?php }else{?>
    <div class="nx-container ">
		<div class="nx-row nxadd-slider-item">  
    <?php }?>  
            <?php
            $column = $nextaddons_wooshop_display_column;
            while ( $post_query->have_posts() ) : 
                $post_query->the_post();
                $defult_featured = \Elementor\Utils::get_placeholder_image_src();

                global $product;
        
                 ?>
                 <?php if($nextaddons_slide_enable == 'yes'){?>
                <div class="nx-item-slider" style="float: left; min-height:1px;" >
                <?php }else{?>
                <div class="<?php echo esc_attr($column);?> ">
                <?php }?>  
                    

                    <div class="woocommerce">
						<ul class="products">
							<li class="products-item <?php echo esc_attr($classs);?> shadow">
								<div class="nxadd-wc-products-image">
                                    <?php if( $nextaddons_wooshop_badge_enable == 'yes'):?>  
									<div class="nxadd-wc-badge badge-left badge-position-top">
										<?php woocommerce_show_product_loop_sale_flash(); ?>
									</div>
                                    <?php endif;?>
									<?php if($nextaddons_wooshop_featured_enable == 'yes'){?>    
                                        
                                        <a href="<?php the_permalink(); ?>" class="post-image">
                                        <?php  if( has_post_thumbnail() ){
                                                $id = get_post_thumbnail_id(get_the_ID());
                                                echo wp_get_attachment_image( $id, $thumbnail_size, '', ['class' => 'thumb-img']);
                                            }else{?>
                                                <img src="<?php echo esc_url( $defult_featured);?>" class="thumb-img" alt="">
                                        <?php }?>    
                                        </a>
                                        <?php }?>
                                        <?php if( $nextaddons_wooshop_addtocart_enable == 'yes'):
                                            $icon_class = isset($nextaddons_content_icon['value']) ? $nextaddons_content_icon['value'] : '';
                                            $icon_position = !empty($nextaddons_content_icon_position) ? $nextaddons_content_icon_position : '';
                                            ?>  
                                        <div class="nxadd-wc-add-to-card ">
                                                <?php woocommerce_template_loop_add_to_cart([
                                                'class' => $icon_class.' '.$icon_position.' button product_type_simple add_to_cart_button ajax_add_to_cart'
                                            ]);?>
                                        </div>
                                        <?php endif;?>
                                </div>
                                
								<div class="nxadd-wc-products-des">
                                   <?php if($nextaddons_wooshop_title_enable == 'yes'){?>  
                                    <<?php echo $nextaddons_wooshop_title_tag;?> class="products-title ">
                                        <a href="<?php the_permalink(); ?>" >
                                            <?php 
                                            $ext = '';
                                            if(strlen(get_the_title()) >= $nextaddons_wooshop_title_limit){
                                                $ext = $nextaddons_wooshop_title_limit_symbol;
                                            }
                                            if($nextaddons_wooshop_title_limit_by == 'word'){
                                                echo wp_trim_words( get_the_title(), $nextaddons_wooshop_title_limit, $nextaddons_wooshop_title_limit_symbol );
                                            }else{
                                                echo substr( get_the_title(), 0, $nextaddons_wooshop_title_limit) . $ext; 
                                            }
                                        
                                            ?>
                                        </a>
                                    </<?php echo $nextaddons_wooshop_title_tag;?>>
                                    <?php }?>

                                    <?php if( $nextaddons_wooshop_ratting_enable == 'yes'):?>        
									<div class="nxadd-wc-rating">
										<div class="star-rating">
											<?php 
											$rating_count = $product->get_rating_count();
											$review_count = $product->get_review_count();
											$average      = $product->get_average_rating();

											echo wc_get_star_rating_html($rating_count, $review_count);?>
										</div>
                                       
									</div>
                                    <?php endif;?>

                                    <?php if( $nextaddons_wooshop_price_enable == 'yes'):?>   
									<div class="nxadd-price">
                                         <?php woocommerce_template_single_price(); ?>
                                    </div>
                                    <?php endif;?>
								</div>
							</li>
						</ul>
                    </div>
                    
				</div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div> 