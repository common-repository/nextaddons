<?php
use \NextAddons\Utilities\Help as Help;
$nextaddons_slide_dot = empty($nextaddons_slide_dot) ? 'no' : 'yes';
$nextaddons_slide_arrow = empty($nextaddons_slide_arrow) ? 'no' : 'yes';

$leftIcon = isset($nextaddons_slide_arrow_left['value']) ? $nextaddons_slide_arrow_left['value'] : 'nx-icon nx-icon-chevron-left';
$rightIcon = isset($nextaddons_slide_arrow_right['value']) ? $nextaddons_slide_arrow_right['value'] : 'nx-icon nx-icon-chevron-right';

?>
<div class="themedev-image-slider-wrapper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-slider-item">    
        <div class="nx-slider-content" id="<?php echo esc_attr($elementorID);?>" nx-slide-active="0" nx-slide-speed="<?php echo esc_attr($nextaddons_slide_speed);?>" nx-item-width="<?php echo esc_attr($nextaddons_slide_width);?>" nx-item-margin="<?php echo esc_attr($nextaddons_slide_spacing);?>" nx-control-button="<?php echo esc_attr($nextaddons_slide_arrow);?>" nx-pre-button-text="<?php echo esc_attr($leftIcon);?>" nx-next-button-text="<?php echo esc_attr($rightIcon);?>" nx-slide-item="<?php echo esc_attr($nextaddons_slide_item);?>" nx-control-dot="<?php echo esc_attr($nextaddons_slide_dot);?>" nx-slide-type="<?php echo esc_attr($nextaddons_slide_vertical);?>">				    
        <?php if( is_array($nextaddons_imageslider_photos_items) && !empty($nextaddons_imageslider_photos_items) ){
            foreach($nextaddons_imageslider_photos_items as $k=>$v):
                $title = isset($v['nextaddons_photos_title']) ? $v['nextaddons_photos_title'] : '';
                $details = isset($v['nextaddons_photos_des']) ? $v['nextaddons_photos_des'] : '';
                $photos = isset($v['nextaddons_photos_url']) ? $v['nextaddons_photos_url'] : '';

                $_id = isset($v['_id']) ? $v['_id'] : '';
                
                $id = isset($photos['id']) ? $photos['id'] : '';
                $url = isset($photos['url']) ? $photos['url'] : '';

                ?>
                <div class="nx-item-slider " style="float: left; min-height:1px;">
                    <div class="nxadd-image-slider-item">
                       <?php
                        if($id != '' || $id != 0){
                            echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'nx-full-width']);
                        }else{
                        ?>
                            <img class="nx-full-width" src="<?php echo esc_url($url);?>" alt="">
                        <?php }?>
                        
                        <div class="nxadd-entry-caption <?php echo esc_attr($nextaddons_content_position);?>"> 
                            <?php if(!empty($title) ):?>
                            <h5 class="nxadd-title"> <?php echo __($title, 'next-addons');?></h5>
                            <?php endif;?>

                            <?php if(!empty($details) ):?>
                            <span class="nxadd-subtitle"><?php echo __($details, 'next-addons');?></span>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
                
            <?php endforeach;
            } ?>
        </div>
    </div>
</div> 

