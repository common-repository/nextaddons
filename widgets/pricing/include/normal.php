<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-pricing-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-pricing-table <?php echo esc_attr($classs);?>">
        <?php if($nextaddons_pricing_title_enable == 'yes'):?>
        <div class="nxadd-pricing-header ">
            <<?php echo esc_html($nextaddons_pricing_title_tag);?> class="pricing-title <?php echo esc_attr($animation_title);?>" > <?php echo Help::_nspan($nextaddons_pricing_title, 'span', '');?> </<?php echo esc_html($nextaddons_pricing_title_tag);?>> 
        </div>
        <?php endif;?>

        <?php if($nextaddons_pricing_price_enable == 'yes'):?>
        <div class="nxadd-pricing-price">
            <div class="nxadd-pricing-tag"></div>
            <span class="nxadd-price ">
                <?php if( !empty($nextaddons_pricing_currency) ){?><sup><?php echo esc_html($nextaddons_pricing_currency);?></sup> <?php }?>
                <?php 
                echo (double) $nextaddons_pricing_amount; 
                ?>
                <?php if( !empty($nextaddons_pricing_beforeamount) ){?><span class="nx-before-price"><?php echo esc_html($nextaddons_pricing_beforeamount);?></span> <?php }?>
                
                <?php if( !empty($nextaddons_pricing_package) ){?><sub><?php echo esc_html__($nextaddons_pricing_package, 'next-addons');?></sub><?php }?>
            </span>
        </div>
        <?php endif;?>

        <?php if($nextaddons_pricing_description_enable == 'yes'):?>
        <div class="nxadd-pricing-content">    
            <p><?php echo Help::_nspan($nextaddons_pricing_description, 'span', 'focus-title');?></p>
        </div>
        <?php endif;?>

       
        <?php if( $nextaddons_pricing_button_enable == 'yes'):?>
            <div class="nxadd-pricing-action">
            <?php if( $nextaddons_pricing_button_type == 'icon'){?>
                    <a href="<?php echo esc_url( $nextaddons_pricing_button_link['url']);?>" <?php echo ($nextaddons_pricing_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_pricing_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-primary <?php echo esc_attr($buttonAnimation);?>">
                        <?php 
                         if($nextaddons_pricing_button_icon['library'] == 'svg' || isset($nextaddons_pricing_button_icon['value']['url'])){
                            \Elementor\Icons_Manager::render_icon( $nextaddons_pricing_button_icon, [ 'aria-hidden' => 'true'] );
                        }else{
                        ?>
                        <i class="nextaddons-icon <?php echo esc_attr($nextaddons_pricing_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_pricing_button_icon['library']);?>"></i>	
                        <?php }?> 
                    </a>
                <?php }else if( $nextaddons_pricing_button_type == 'icon-text' ){ ?>
                    
                    <a href="<?php echo esc_url( $nextaddons_pricing_button_link['url']);?>" <?php echo ($nextaddons_pricing_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_pricing_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-primary <?php echo esc_attr($buttonAnimation);?>">
                        <?php if( $nextaddons_pricing_button_icon_position == 'left'){?>
                            <?php 
                            if($nextaddons_pricing_button_icon['library'] == 'svg' || isset($nextaddons_pricing_button_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_pricing_button_icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?>
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_pricing_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_pricing_button_icon['library']);?>"></i>
                        <?php 
                            }
                         }?>
                        <?php echo esc_html__($nextaddons_pricing_button_text, 'next-addons');?>
                        <?php if( $nextaddons_pricing_button_icon_position == 'right'){?>
                            <?php 
                            if($nextaddons_pricing_button_icon['library'] == 'svg' || isset($nextaddons_pricing_button_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_pricing_button_icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?> 
                            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_pricing_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_pricing_button_icon['library']);?>"></i>
                        <?php }
                        }?>
                    </a>

                <?php }else{ ?>
                    <a href="<?php echo esc_url( $nextaddons_pricing_button_link['url']);?>" <?php echo ($nextaddons_pricing_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_pricing_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn nxadd-btn-outline-primary <?php echo esc_attr($buttonAnimation);?>">
                    <?php echo esc_html__($nextaddons_pricing_button_text, 'next-addons');?>
                    </a>
                <?php } ?>
            </div>
        <?php endif;?>

    </div>
</div> 