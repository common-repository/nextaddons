<?php
use \NextAddons\Utilities\Help as Help;
$nextaddons_slide_dot = empty($nextaddons_slide_dot) ? 'no' : 'yes';
$nextaddons_slide_arrow = empty($nextaddons_slide_arrow) ? 'no' : 'yes';

$leftIcon = isset($nextaddons_slide_arrow_left['value']) ? $nextaddons_slide_arrow_left['value'] : 'nx-icon nx-icon-chevron-left';
$rightIcon = isset($nextaddons_slide_arrow_right['value']) ? $nextaddons_slide_arrow_right['value'] : 'nx-icon nx-icon-chevron-right';

$vertical = isset($nextaddons_slide_vertical) ? $nextaddons_slide_vertical : 'no';

?>
<div class="themedev-testimonial-wrapper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <?php if($nextaddons_slide_enable == 'yes'){?>
    <div class="nxadd-slider-item <?php echo esc_attr($classs);?>">    
        <div class="nx-slider-content" id="<?php echo esc_attr($elementorID);?>" nx-slide-active="0" nx-slide-speed="<?php echo esc_attr($nextaddons_slide_speed);?>" nx-item-width="<?php echo esc_attr($nextaddons_slide_width);?>" nx-item-margin="<?php echo esc_attr($nextaddons_slide_spacing);?>" nx-control-button="<?php echo esc_attr($nextaddons_slide_arrow);?>" nx-pre-button-text="<?php echo esc_attr($leftIcon);?>" nx-next-button-text="<?php echo esc_attr($rightIcon);?>" nx-slide-item="<?php echo esc_attr($nextaddons_slide_item);?>" nx-control-dot="<?php echo esc_attr($nextaddons_slide_dot);?>" nx-slide-type="<?php echo esc_attr($vertical);?>">					    
    <?php }else{?>
    <div class="nx-container">
        <div class="nx-row nxadd-slider-item  <?php echo esc_attr($classs);?>"> 
    <?php }?> 

        <?php 
        $column = $nextaddons_testimonial_display_column;

        if( is_array($nextaddons_testimonial_items) && !empty($nextaddons_testimonial_items) ){
            foreach($nextaddons_testimonial_items as $k=>$v):
                $name = isset($v['nextaddons_items_name']) ? $v['nextaddons_items_name'] : '';
                $designation = isset($v['nextaddons_items_designation']) ? $v['nextaddons_items_designation'] : '';
                $overview = isset($v['nextaddons_items_overview']) ? $v['nextaddons_items_overview'] : '';
                $photos = isset($v['nextaddons_items_photos']) ? $v['nextaddons_items_photos'] : '';

                $_id = isset($v['_id']) ? $v['_id'] : '';
                
                $id = isset($photos['id']) ? $photos['id'] : '';
                $url = isset($photos['url']) ? $photos['url'] : '';

                ?>
                <?php if($nextaddons_slide_enable == 'yes'){?>
                <div class="nx-item-slider" style="float: left; min-height:1px;" >
                <?php }else{?>
                <div class="<?php echo esc_attr($column);?> ">
                <?php }?> 
                <div class="nxadd-single-testimonial style-5 white-color nx-text-center gradient-1 nxtestimonial-content <?php if($nextaddons_testimonial_popup_enable == 'yes'){?>nx-popup-data<?php }?>">
                    <div class="nxadd-client-bio nx-text-center">
                       
                        <?php
                        if($nextaddons_testimonial_photos_enable == 'yes'){
                        ?>
                            <div class="client-image">
                            <?php
                            if($id != '' || $id != 0){
                                echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'testimonial-img']);
                            }else{
                            ?>
                                <img class="testimonial-img" src="<?php echo esc_url($url);?>" alt="">
                            <?php }?>
                        
                            </div>
                        <?php
                        }?> 
                        <span class="profile-info">
                            <?php if($nextaddons_testimonial_name_enable == 'yes' && !empty($name) ):?>
                            <strong class="author-name"><?php echo esc_html($name);?> </strong>
                            <?php endif;?>

                            <?php if($nextaddons_testimonial_designation_enable == 'yes' && !empty($designation) ):?>
                            <span class="author-des"><?php echo esc_html__($designation, 'next-addons');?></span>
                            <?php endif;?>
                        </span>
                    </div>
                    <div class="nxadd-author-card">
                       
                        <div class="nxadd-watermark-icon">
                            <?php
                            if($nextaddons_testimonial_wartermark['library'] == 'svg' || isset($nextaddons_testimonial_wartermark['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_testimonial_wartermark, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?>
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_testimonial_wartermark['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_testimonial_wartermark['library']);?>"></i>			
                            <?php }?>
                        </div>
                        <?php if($nextaddons_testimonial_overview_enable == 'yes' && !empty($overview) ):?>
                        <p class="profile-des">
                            <?php echo esc_html__($overview, 'next-addons');?>    
                        </p>
                        <?php endif;?>
                    </div>
                </div> 
                
                    
            </div> <!-- end -->
                
            <?php endforeach;
            } ?>
        </div>
    </div>
</div> 
