<?php
use \NextAddons\Utilities\Help as Help;
?>

<div class="themeDev-tooltip-wraper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-tooltip-item <?php if(!empty($$nextaddons_tooltip_effect)){?>style-2<?php }?> <?php echo esc_attr($classs);?> <?php echo esc_attr($elementorID);?>" id="<?php echo esc_attr($elementorID);?>">
        <div class="nxadd-tooltip <?php echo esc_attr($nextaddons_tooltip_enable);?>">
            
            <?php
                if($nextaddons_tooltip_content_type == 'icon'){
                    ?>
                    <span href="#" class="tooltip-icon-link">
                    <?php
                    if($nextaddons_content_icon['library'] == 'svg' || isset($nextaddons_content_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_content_icon, [ 'aria-hidden' => 'true', 'class' => 'nextaddons-icon'] );
                    }else{
                        ?>
                        <i class="nextaddons-icon <?php echo esc_attr($nextaddons_content_icon['value']);?> " aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_content_icon['library']);?>"></i>	
                        <?php
                    }
                   ?>
                   </span>
                   <?php
                }else{
                    $id = isset($nextaddons_content_photos['id']) ? $nextaddons_content_photos['id'] : '';
                    $url = isset($nextaddons_content_photos['url']) ? $nextaddons_content_photos['url'] : '';

                    if($id != '' || $id != 0){
                       echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'tooltip-img']);
                    }else{
                    ?>
                        <img class="tooltip-img" src="<?php echo esc_url($url);?>" alt="">
                    <?php }
                }
                ?>
            <span class="nxadd-tooltip-text <?php echo esc_attr($nextaddons_tooltip_effect);?> <?php echo esc_attr($nextaddons_tooltip_type);?>">
                <?php echo $nextaddons_content_text;?>
            </span>
        </div>
     </div>   
</div> 