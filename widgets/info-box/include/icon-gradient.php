<?php
use \NextAddons\Utilities\Help as Help;

?>
<div class="themedev-info-box <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-info_box <?php echo esc_attr($classs);?> ">	
        <?php if( $nextaddons_infobox_icon_enable == 'yes'):?>
        <div class="nxadd-icon">
        <?php
             if($nextaddons_infobox_icon['library'] == 'svg' || isset($nextaddons_infobox_icon['value']['url'])){
                \Elementor\Icons_Manager::render_icon( $nextaddons_infobox_icon, [ 'aria-hidden' => 'true'] );
            }else{
            ?>
            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_infobox_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_infobox_icon['library']);?>"></i>			
            <?php }?> 			
        </div>
        <?php endif;?>
        <div class="nxadd-body">
            <?php if($nextaddons_infobox_title_enable == 'yes'):?>
                <?php if($nextaddons_infobox_title_link_enable == 'yes'){?>
                <a href="<?php echo esc_url( $nextaddons_infobox_title_link['url']);?>" <?php echo ($nextaddons_infobox_title_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_infobox_title_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> >
                <?php }?>

                <<?php echo esc_html($nextaddons_infobox_title_tag);?> class="nxadd-title <?php echo esc_attr($animationClass);?>" > <?php echo Help::_nspan($nextaddons_infobox_title, $nextaddons_infobox_title_focus_tag, '');?> </<?php echo esc_html($nextaddons_infobox_title_tag);?>>
                <?php if($nextaddons_infobox_title_link_enable == 'yes'){?>
                </a>
                <?php }?> 

            <?php endif;?>
            <?php if($themedev_next_infobox_description_enable == 'yes'):?>
                <p class="nxadd-des"><?php echo Help::_nspan($themedev_next_infobox_description, 'span', 'focus-title');?></p>
            <?php endif;?>
        </div>
        <?php if( $nextaddons_infobox_button_enable == 'yes'):?>
            <div class="nxadd-btn-wrapper">
                <?php if( $nextaddons_infobox_button_type == 'icon'){?>
                    <a href="<?php echo esc_url( $nextaddons_infobox_button_link['url']);?>" <?php echo ($nextaddons_infobox_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_infobox_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-primary <?php echo esc_attr($buttonAnimation);?>">
                        <?php 
                         if($nextaddons_infobox_button_icon['library'] == 'svg' || isset($nextaddons_infobox_button_icon['value']['url'])){
                            \Elementor\Icons_Manager::render_icon( $nextaddons_infobox_button_icon, [ 'aria-hidden' => 'true'] );
                        }else{
                        ?>
                        <i class="nextaddons-icon <?php echo esc_attr($nextaddons_infobox_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_infobox_button_icon['library']);?>"></i>	
                        <?php }?> 
                    </a>
                <?php }else if( $nextaddons_infobox_button_type == 'icon-text' ){ ?>
                    
                    <a href="<?php echo esc_url( $nextaddons_infobox_button_link['url']);?>" <?php echo ($nextaddons_infobox_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_infobox_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-primary <?php echo esc_attr($buttonAnimation);?>">
                        <?php if( $nextaddons_infobox_button_icon_position == 'left'){?>
                            <?php 
                            if($nextaddons_infobox_button_icon['library'] == 'svg' || isset($nextaddons_infobox_button_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_infobox_button_icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?>
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_infobox_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_infobox_button_icon['library']);?>"></i>
                        <?php 
                            }
                         }?>
                        <?php echo esc_html__($nextaddons_infobox_button_text, 'next-addons');?>
                        <?php if( $nextaddons_infobox_button_icon_position == 'right'){?>
                            <?php 
                            if($nextaddons_infobox_button_icon['library'] == 'svg' || isset($nextaddons_infobox_button_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_infobox_button_icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?> 
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_infobox_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_infobox_button_icon['library']);?>"></i>
                        <?php }
                        }?>
                    </a>

                <?php }else{ ?>
                    <a href="<?php echo esc_url( $nextaddons_infobox_button_link['url']);?>" <?php echo ($nextaddons_infobox_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_infobox_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-dark <?php echo esc_attr($buttonAnimation);?>">
                    <?php echo esc_html__($nextaddons_infobox_button_text, 'next-addons');?>
                    </a>
                <?php } ?>
            </div>
        <?php endif;?>
        <?php if( $nextaddons_infobox_hover_icon_enable == 'yes' ):?>
        <div class="nxadd-icon nxadd-icon-hover">
            <?php
             if($nextaddons_infobox_hover_icon['library'] == 'svg' || isset($nextaddons_infobox_hover_icon['value']['url'])){
                \Elementor\Icons_Manager::render_icon( $nextaddons_infobox_hover_icon, [ 'aria-hidden' => 'true'] );
            }else{
            ?>
            <i class="nextaddons-icon2 <?php echo esc_attr($nextaddons_infobox_hover_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_infobox_hover_icon['library']);?>"></i>			
            <?php }?> 
         </div>
        <?php endif;?>
    </div>
</div> 