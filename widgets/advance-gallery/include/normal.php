<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-mixin-gallery-wraper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-gallery-style <?php echo esc_attr($nextaddons_layout_type);?>" id="<?php echo esc_attr($elementorID);?>">
        
        <ul class="nxadd-main-filter <?php echo esc_attr($nextaddons_tab_style);?>" >
                <li class="nxadd-nav-item">
                    <a class="nx-controls nx-active" href="#" nx-target=".all">All</a>
                </li>
            <?php 
            $data = [];
            if( is_array($nextaddons_tab_items) && !empty($nextaddons_tab_items) ){
                foreach($nextaddons_tab_items as $v):
                    $_id = isset($v['_id']) ? $v['_id'] : '';
                    $name = isset($v['nextaddons_tab_title']) ? $v['nextaddons_tab_title'] : '';
                    $id = isset($v['nextaddons_tab_id']) ? $v['nextaddons_tab_id'] : 'tab1';
                   
                ?>
                <li class="nxadd-nav-item">
                    <a class="nx-controls" href="#" nx-target=".<?php echo $id;?>"><?php echo esc_html__($name, 'next-addons');?></a>
                </li>

                <?php 
            endforeach;
            }
        ?> 
        </ul>

        <div class="nxadd-mix-content <?php echo esc_attr($classs);?>" >
            <?php  
            if( is_array($nextaddons_adgallery_photos_items) && !empty($nextaddons_adgallery_photos_items) ):
                foreach($nextaddons_adgallery_photos_items as $v):
                    $title = isset($v['nextaddons_photos_title']) ? $v['nextaddons_photos_title'] : '';
                    $details = isset($v['nextaddons_photos_des']) ? $v['nextaddons_photos_des'] : '';
                    $photos = isset($v['nextaddons_photos_url']) ? $v['nextaddons_photos_url'] : '';

                    $_id = isset($v['_id']) ? $v['_id'] : '';
                    $_tab = isset($v['nextaddons_photos_tab']) ? $v['nextaddons_photos_tab'] : 'tab1';
                    
                    $id = isset($photos['id']) ? $photos['id'] : '';
                    $url = isset($photos['url']) ? $photos['url'] : '';
                ?>
            <div class="nx-mix nx-animation-default <?php echo esc_attr($_tab);?> nxadd-gallery-item  <?php echo esc_attr($class2);?>" <?php  if($nextaddons_adgallery_popup_enable == 'yes'){?> nx-body-click="yes"<?php }?> >
                <div class="nxadd-gallery-inner hover-horizontal">
                    <?php 
                    if($id != '' || $id != 0){
                       echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'nxadd-img']);
                    }else{
                    ?>
                        <img class="nxadd-img" src="<?php echo esc_url($url);?>" alt="">
                    <?php }?>

                    <?php if($nextaddons_adgallery_overlay_enable == 'yes'){?>
                    <div class="nxadd-hover-area">
                        <div class="nxadd-hover-content">
                            <?php if($nextaddons_adgallery_title_enable == 'yes'  && !empty($title) ):?>
                             <h3 class="nxadd-gallery-title"> <?php echo __($title, 'next-addons');?></h3>
                            <?php endif;?>

                            <?php if($nextaddons_adgallery_details_enable == 'yes' && !empty($details) ):?>
                                <p class="nxadd-des"><?php echo __($details, 'next-addons');?></p>
                            <?php endif;?>
                           
                            <?php if($nextaddons_adgallery_overlay_enable_icon == 'yes'):?>
                            <a class="image-popup nxadd-gallery-icon <?php echo esc_attr($iconAnimation);?>" >
                                <?php 
                                if($nextaddons_adgallery_overlay_icon['library'] == 'svg' || isset($nextaddons_adgallery_overlay_icon['value']['url'])){
                                    \Elementor\Icons_Manager::render_icon( $nextaddons_adgallery_overlay_icon, [ 'aria-hidden' => 'true'] );
                                }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_adgallery_overlay_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_adgallery_overlay_icon['library']);?>"></i>	
                                <?php }?>
                            </a>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
                <?php endforeach;
                endif;
                ?>
        </div>

    </div>
</div> 

