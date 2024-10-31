<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-image-box <?php echo esc_attr($nextaddons_custom_class);?>">
    <div class="nxadd-image-box <?php echo esc_attr($classs);?>">
        
        <?php if( $nextaddons_imagebox_image_enable == 'yes'):?>
            <?php if($nextaddons_imagebox_image_link_enable == 'yes'){?>
            <a class="box-thumble" href="<?php echo esc_url( $nextaddons_imagebox_image_link['url']);?>" <?php echo ($nextaddons_imagebox_image_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_imagebox_image_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> >
            <?php }?> 
            <?php
                $url = isset($nextaddons_imagebox_image['url']) ? $nextaddons_imagebox_image['url'] : '';
                if(isset($nextaddons_imagebox_image['id']) && $nextaddons_imagebox_image['id'] != ''){
                    echo wp_get_attachment_image( $nextaddons_imagebox_image['id'], $thumbnail_size , '', ['class' => 'nximagebox ']);
                }else{
                ?>
                <img class="nximagebox" src="<?php echo esc_url($url)?>" alt="">
                <?php } ?>
            <?php if($nextaddons_imagebox_image_link_enable == 'yes'){?>
            </a>
            <?php }?> 
        <?php endif;?>

        <div class="nxadd-box-body">

            <?php if($nextaddons_imagebox_title_enable == 'yes'):?> 
            <a class="nxadd-image-box-title  <?php echo esc_attr($animationClass);?>" href="<?php echo esc_url( $nextaddons_imagebox_title_link['url']);?>" <?php echo ($nextaddons_imagebox_title_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_imagebox_title_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> >
                <?php echo Help::_nspan($nextaddons_imagebox_title, $nextaddons_imagebox_title_focus_tag, '');?>
            </a>
            <?php endif;?> 

            <?php if($themedev_next_imagebox_description_enable == 'yes'):?>
                <p class="nxadd-des"><?php echo Help::_nspan($themedev_next_imagebox_description, 'span', 'focus-title');?></p>
            <?php endif;?> 


            <?php if( $nextaddons_imagebox_button_enable == 'yes'):?>
                <div class="nxadd-btn-wrapper">
                <?php if( $nextaddons_imagebox_button_type == 'icon'){?>
                    <a href="<?php echo esc_url( $nextaddons_imagebox_button_link['url']);?>" <?php echo ($nextaddons_imagebox_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_imagebox_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                        <?php 
                         if($nextaddons_imagebox_button_icon['library'] == 'svg' || isset($nextaddons_imagebox_button_icon['value']['url'])){
                            \Elementor\Icons_Manager::render_icon( $nextaddons_imagebox_button_icon, [ 'aria-hidden' => 'true'] );
                        }else{
                        ?>
                        <i class="nextaddons-icon <?php echo esc_attr($nextaddons_imagebox_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_imagebox_button_icon['library']);?>"></i>	
                        <?php }?> 
                    </a>
                <?php }else if( $nextaddons_imagebox_button_type == 'icon-text' ){ ?>
                    
                    <a href="<?php echo esc_url( $nextaddons_imagebox_button_link['url']);?>" <?php echo ($nextaddons_imagebox_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_imagebox_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                        <?php if( $nextaddons_imagebox_button_icon_position == 'left'){?>
                            <?php 
                            if($nextaddons_imagebox_button_icon['library'] == 'svg' || isset($nextaddons_imagebox_button_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_imagebox_button_icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?>
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_imagebox_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_imagebox_button_icon['library']);?>"></i>
                        <?php 
                            }
                         }?>
                        <?php echo esc_html__($nextaddons_imagebox_button_text, 'next-addons');?>
                        <?php if( $nextaddons_imagebox_button_icon_position == 'right'){?>
                            <?php 
                            if($nextaddons_imagebox_button_icon['library'] == 'svg' || isset($nextaddons_imagebox_button_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_imagebox_button_icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?> 
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_imagebox_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_imagebox_button_icon['library']);?>"></i>
                        <?php }
                        }?>
                    </a>

                <?php }else{ ?>
                    <a href="<?php echo esc_url( $nextaddons_imagebox_button_link['url']);?>" <?php echo ($nextaddons_imagebox_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_imagebox_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                    <?php echo esc_html__($nextaddons_imagebox_button_text, 'next-addons');?>
                    </a>
                <?php } ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div> 