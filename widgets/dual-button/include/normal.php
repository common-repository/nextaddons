<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-dual-button-wrapper <?php echo esc_attr($nextaddons_custom_class);?>">
    <div class="nxadd-dual-button <?php echo esc_attr($mclass);?>">
        <!-- Button 1-->
        <?php if( $nextaddons_dualbutton_type == 'icon'){?>
            <a href="<?php echo esc_url( $nextaddons_dualbutton_link['url']);?>" <?php echo ($nextaddons_dualbutton_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_dualbutton_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-dual-btn nxadd-dual-btn-one  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation);?>">
                <?php 
                    if($nextaddons_dualbutton_icon['library'] == 'svg' || isset($nextaddons_dualbutton_icon['value']['url'])){
                    \Elementor\Icons_Manager::render_icon( $nextaddons_dualbutton_icon, [ 'aria-hidden' => 'true'] );
                }else{
                ?>
                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_dualbutton_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_dualbutton_icon['library']);?>"></i>	
                <?php }?> 
            </a>
        <?php }else if( $nextaddons_dualbutton_type == 'icon-text' ){ ?>
            
            <a href="<?php echo esc_url( $nextaddons_dualbutton_link['url']);?>" <?php echo ($nextaddons_dualbutton_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_dualbutton_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-dual-btn nxadd-dual-btn-one  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation);?>">
                <?php if( $nextaddons_dualbutton_icon_position == 'left'){?>
                    <?php 
                    if($nextaddons_dualbutton_icon['library'] == 'svg' || isset($nextaddons_dualbutton_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_dualbutton_icon, [ 'aria-hidden' => 'true'] );
                    }else{
                    ?>
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_dualbutton_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_dualbutton_icon['library']);?>"></i>
                <?php 
                    }
                    }?>
                <?php echo esc_html__($nextaddons_dualbutton_text, 'next-addons');?>
                <?php if( $nextaddons_dualbutton_icon_position == 'right'){?>
                    <?php 
                    if($nextaddons_dualbutton_icon['library'] == 'svg' || isset($nextaddons_dualbutton_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_dualbutton_icon, [ 'aria-hidden' => 'true'] );
                    }else{
                    ?> 
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_dualbutton_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_dualbutton_icon['library']);?>"></i>
                <?php }
                }?>
            </a>

        <?php }else{ ?>
            <a href="<?php echo esc_url( $nextaddons_dualbutton_link['url']);?>" <?php echo ($nextaddons_dualbutton_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_dualbutton_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-dual-btn nxadd-dual-btn-one  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation);?>">
            <?php echo esc_html__($nextaddons_dualbutton_text, 'next-addons');?>
            </a>
        <?php } ?>

        <!-- Button 2-->

        <?php if( $nextaddons_dualbutton1_type == 'icon'){?>
            <a href="<?php echo esc_url( $nextaddons_dualbutton1_link['url']);?>" <?php echo ($nextaddons_dualbutton1_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_dualbutton1_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-dual-btn nxadd-dual-btn-two  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation1);?>">
                <?php 
                    if($nextaddons_dualbutton1_icon['library'] == 'svg' || isset($nextaddons_dualbutton1_icon['value']['url'])){
                    \Elementor\Icons_Manager::render_icon( $nextaddons_dualbutton1_icon, [ 'aria-hidden' => 'true'] );
                }else{
                ?>
                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_dualbutton1_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_dualbutton1_icon['library']);?>"></i>	
                <?php }?> 
            </a>
        <?php }else if( $nextaddons_dualbutton1_type == 'icon-text' ){ ?>
            
            <a href="<?php echo esc_url( $nextaddons_dualbutton1_link['url']);?>" <?php echo ($nextaddons_dualbutton1_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_dualbutton1_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-dual-btn nxadd-dual-btn-two  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation1);?>">
                <?php if( $nextaddons_dualbutton1_icon_position == 'left'){?>
                    <?php 
                    if($nextaddons_dualbutton1_icon['library'] == 'svg' || isset($nextaddons_dualbutton1_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_dualbutton1_icon, [ 'aria-hidden' => 'true'] );
                    }else{
                    ?>
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_dualbutton1_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_dualbutton1_icon['library']);?>"></i>
                <?php 
                    }
                    }?>
                <?php echo esc_html__($nextaddons_dualbutton1_text, 'next-addons');?>
                <?php if( $nextaddons_dualbutton1_icon_position == 'right'){?>
                    <?php 
                    if($nextaddons_dualbutton1_icon['library'] == 'svg' || isset($nextaddons_dualbutton1_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_dualbutton1_icon, [ 'aria-hidden' => 'true'] );
                    }else{
                    ?> 
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_dualbutton1_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_dualbutton1_icon['library']);?>"></i>
                <?php }
                }?>
            </a>

        <?php }else{ ?>
            <a href="<?php echo esc_url( $nextaddons_dualbutton1_link['url']);?>" <?php echo ($nextaddons_dualbutton1_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_dualbutton1_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-dual-btn nxadd-dual-btn-two  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation1);?>">
            <?php echo esc_html__($nextaddons_dualbutton1_text, 'next-addons');?>
            </a>
        <?php } ?>
        
    </div>
</div> 