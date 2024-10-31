<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-gallery-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-gallery-style <?php echo esc_attr($classs);?>">
        <?php if( is_array($nextaddons_gallery_photos_items) && !empty($nextaddons_gallery_photos_items) ){
            foreach($nextaddons_gallery_photos_items as $k=>$v):
                $title = isset($v['nextaddons_photos_title']) ? $v['nextaddons_photos_title'] : '';
                $details = isset($v['nextaddons_photos_des']) ? $v['nextaddons_photos_des'] : '';
                $photos = isset($v['nextaddons_photos_url']) ? $v['nextaddons_photos_url'] : '';

                $_id = isset($v['_id']) ? $v['_id'] : '';
                
                $id = isset($photos['id']) ? $photos['id'] : '';
                $url = isset($photos['url']) ? $photos['url'] : '';

            ?>
            <div class="nxadd-single-gallery-item <?php echo esc_attr($class2);?>" <?php  if($nextaddons_gallery_popup_enable == 'yes'){?> nx-body-click="yes"<?php }?> >
                <div class="nxadd-portfolio-thumb">
                   <?php 
                    if($id != '' || $id != 0){
                       echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'nxadd-img']);
                    }else{
                    ?>
                        <img class="nxadd-img" src="<?php echo esc_url($url);?>" alt="">
                    <?php }?>

                    <?php if($nextaddons_gallery_overlay_enable == 'yes'){?>
                    <div class="nxadd-hover-area">
                        <div class="nxadd-hover-content">
                            <?php if($nextaddons_gallery_title_enable == 'yes'  && !empty($title) ):?>
                             <h3 class="nxadd-gallery-title"> <?php echo __($title, 'next-addons');?></h3>
                            <?php endif;?>

                            <?php if($nextaddons_gallery_details_enable == 'yes' && !empty($details) ):?>
                                <p class="nxadd-des"><?php echo __($details, 'next-addons');?></p>
                            <?php endif;?>
                           
                            <?php if($nextaddons_gallery_overlay_enable_icon == 'yes'):?>
                            <a class="image-popup nx-gallery-icon <?php echo esc_attr($iconAnimation);?>" >
                                <?php 
                                if($nextaddons_gallery_overlay_icon['library'] == 'svg' || isset($nextaddons_gallery_overlay_icon['value']['url'])){
                                    \Elementor\Icons_Manager::render_icon( $nextaddons_gallery_overlay_icon, [ 'aria-hidden' => 'true'] );
                                }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_gallery_overlay_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_gallery_overlay_icon['library']);?>"></i>	
                                <?php }?>
                            </a>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php 
        endforeach;
        }
    ?> 
    </div>
</div> 

