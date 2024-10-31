<?php
use \NextAddons\Utilities\Help as Help;
$nextaddons_slide_dot = empty($nextaddons_slide_dot) ? 'no' : 'yes';
$nextaddons_slide_arrow = empty($nextaddons_slide_arrow) ? 'no' : 'yes';

$leftIcon = isset($nextaddons_slide_arrow_left['value']) ? $nextaddons_slide_arrow_left['value'] : 'nx-icon nx-icon-chevron-left';
$rightIcon = isset($nextaddons_slide_arrow_right['value']) ? $nextaddons_slide_arrow_right['value'] : 'nx-icon nx-icon-chevron-right';

$vertical = isset($nextaddons_slide_vertical) ? $nextaddons_slide_vertical : 'no';
?>
<div class="themedev-blog-post-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <?php if($nextaddons_slide_enable == 'yes'){?>
        <div class="nxadd-slider-item">    
          <div class="nx-slider-content" id="<?php echo esc_attr($elementorID);?>" nx-slide-active="0" nx-slide-speed="<?php echo esc_attr($nextaddons_slide_speed);?>" nx-item-width="<?php echo esc_attr($nextaddons_slide_width);?>" nx-item-margin="<?php echo esc_attr($nextaddons_slide_spacing);?>" nx-control-button="<?php echo esc_attr($nextaddons_slide_arrow);?>" nx-pre-button-text="<?php echo esc_attr($leftIcon);?>" nx-next-button-text="<?php echo esc_attr($rightIcon);?>" nx-slide-item="<?php echo esc_attr($nextaddons_slide_item);?>" nx-control-dot="<?php echo esc_attr($nextaddons_slide_dot);?>" nx-slide-type="<?php echo esc_attr($vertical);?>">				    
        <?php }else{?>
        <div class="nx-container">
            <div class="nx-row"> 
        <?php }?>   
         <?php
            $column = $nextaddons_blog_display_column;
            while ( $post_query->have_posts() ) : 
                $post_query->the_post();
                $defult_featured = \Elementor\Utils::get_placeholder_image_src();
                 ?>
                <?php if($nextaddons_slide_enable == 'yes'){?>
                    <div class="nx-item-slider" style="float: left; min-height:1px;" >
                <?php }else{?>
                <div class="<?php echo esc_attr($column);?> nx-item-slider">
                <?php }?> 
					<div class="nxadd-blog-post-wrap <?php echo esc_attr($classs);?>">
                        <?php if($nextaddons_blog_featured_enable == 'yes'){?>    
                        <div class="nxadd-blog-post-thumbnail">
							<a href="<?php the_permalink(); ?>" class="post-image">
                               <?php  if( has_post_thumbnail() ){
                                    $id = get_post_thumbnail_id(get_the_ID());
                                    echo wp_get_attachment_image( $id, $thumbnail_size, '', ['class' => 'thumb-img']);
                                }else{?>
                                    <img src="<?php echo esc_url( $defult_featured);?>" class="thumb-img" alt="">
                               <?php }?>    
                             </a>
                        </div>
                        <?php }?>
						<div class="nxadd-blog-post-content">
							
                            <?php if($nextaddons_blog_title_enable == 'yes'){?>  
							<<?php echo $nextaddons_blog_title_tag;?> class="nxadd-post-title <?php echo esc_attr($animation_title);?>">
								<a href="<?php the_permalink(); ?>" >
                                    <?php 
                                    $ext = '';
                                    if(strlen(get_the_title()) >= $nextaddons_blog_title_limit){
                                        $ext = $nextaddons_blog_title_limit_symbol;
                                    }
                                    if($nextaddons_blog_title_limit_by == 'word'){
                                        echo wp_trim_words( get_the_title(), $nextaddons_blog_title_limit, $nextaddons_blog_title_limit_symbol );
                                    }else{
                                        echo substr( get_the_title(), 0, $nextaddons_blog_title_limit) . $ext; 
                                    }
                                 
                                    ?>
								</a>
                            </<?php echo $nextaddons_blog_title_tag;?>>
                            <?php } ?>

                            <div class="nxadd-meta-list">
                                <?php if($nextaddons_blog_date_enable == 'yes'){?>
                                    <span class="meta-data"> 
                                    <?php if($nextaddons_blog_date_icon == 'yes'){
                                        if( isset($nextaddons_blog_date_icon_select) ){
                                            if($nextaddons_blog_date_icon_select['library'] == 'svg' || isset($nextaddons_blog_date_icon_select['value']['url'])){
                                                \Elementor\Icons_Manager::render_icon( $nextaddons_blog_date_icon_select, [ 'aria-hidden' => 'true'] );
                                            }else{
                                                ?>
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_blog_date_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_blog_date_icon_select['library']);?>"></i>	
                                                <?php
                                            }
                                        }else{
                                        ?>
                                             <i class="nx-icon nx-icon-calendar"></i> 
                                    <?php }
                                    }?> 
                                    <?php echo esc_html( get_the_date( $nextaddons_blog_date_format ) ); ?></span>
                                    <?php }?>
                                <?php if($nextaddons_blog_categories_enable == 'yes'){?>
                                <span class="post-cat">
                                    <?php if($nextaddons_blog_categories_icon == 'yes'){
                                         if( isset($nextaddons_blog_categories_icon_select) ){
                                            if($nextaddons_blog_categories_icon_select['library'] == 'svg' || isset($nextaddons_blog_categories_icon_select['value']['url'])){
                                                \Elementor\Icons_Manager::render_icon( $nextaddons_blog_categories_icon_select, [ 'aria-hidden' => 'true'] );
                                            }else{
                                                ?>
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_blog_categories_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_blog_categories_icon_select['library']);?>"></i>	
                                                <?php
                                            }
                                        }else{
                                        ?><i class="nx-icon nx-icon-folder"></i> 
                                        <?php }
                                         }?>
                                <?php 
                                    $seperator = !empty( trim($nextaddons_blog_categories_seperator) ) ? $nextaddons_blog_categories_seperator : ' | ';
                                    echo get_the_category_list( $seperator ); ?>
                                </span>
                                <?php }?>
                            </div>
                            <?php if($nextaddons_blog_excerpt_enable == 'yes'){?>  
                            <div class="nxadd-blog-des">
								<<?php echo $nextaddons_blog_excerpt_tag;?> class="post-des">
                                <?php 
                                    $ext = '';
                                    if(strlen(get_the_excerpt()) >= $nextaddons_blog_excerpt_limit){
                                        $ext = $nextaddons_blog_excerpt_limit_symbol;
                                    }
                                    if($nextaddons_blog_excerpt_limit_by == 'word'){
                                        echo wp_trim_words( get_the_excerpt(), $nextaddons_blog_excerpt_limit, $nextaddons_blog_excerpt_limit_symbol );
                                    }else{
                                        echo substr( get_the_excerpt(), 0, $nextaddons_blog_excerpt_limit) . $ext; 
                                    }
                                 
                                    ?>
                                </<?php echo $nextaddons_blog_excerpt_tag;?>>
							</div>
                            <?php }?>

                          
                            <?php if( $nextaddons_blog_button_enable == 'yes'):?>
                                <div class="nxadd-btn-wrapper">
                                    <?php if( $nextaddons_blog_button_type == 'icon'){?>
                                        <a href="<?php the_permalink(); ?>" class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                                            <?php 
                                            if($nextaddons_blog_button_icon['library'] == 'svg' || isset($nextaddons_blog_button_icon['value']['url'])){
                                                \Elementor\Icons_Manager::render_icon( $nextaddons_blog_button_icon, [ 'aria-hidden' => 'true'] );
                                            }else{
                                            ?>
                                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_blog_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_blog_button_icon['library']);?>"></i>	
                                            <?php }?> 
                                        </a>
                                    <?php }else if( $nextaddons_blog_button_type == 'icon-text' ){ ?>
                                        
                                        <a href="<?php the_permalink(); ?>" class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                                            <?php if( $nextaddons_blog_button_icon_position == 'left'){?>
                                                <?php 
                                                if($nextaddons_blog_button_icon['library'] == 'svg' || isset($nextaddons_blog_button_icon['value']['url'])){
                                                    \Elementor\Icons_Manager::render_icon( $nextaddons_blog_button_icon, [ 'aria-hidden' => 'true'] );
                                                }else{
                                                ?>
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_blog_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_blog_button_icon['library']);?>"></i>
                                            <?php 
                                                }
                                            }?>
                                            <?php echo esc_html__($nextaddons_blog_button_text, 'next-addons');?>
                                            <?php if( $nextaddons_blog_button_icon_position == 'right'){?>
                                                <?php 
                                                if($nextaddons_blog_button_icon['library'] == 'svg' || isset($nextaddons_blog_button_icon['value']['url'])){
                                                    \Elementor\Icons_Manager::render_icon( $nextaddons_blog_button_icon, [ 'aria-hidden' => 'true'] );
                                                }else{
                                                ?> 
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_blog_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_blog_button_icon['library']);?>"></i>
                                            <?php }
                                            }?>
                                        </a>

                                    <?php }else{ ?>
                                        <a href="<?php the_permalink(); ?>" class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                                        <?php echo esc_html__($nextaddons_blog_button_text, 'next-addons');?>
                                        </a>
                                    <?php } ?>
                                </div>
                           
                            <?php endif;?>
						</div>
					</div>
				</div>
                <?php
            endwhile;
            ?>
        </div>
    </div>
</div> 