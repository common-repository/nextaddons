<?php
use \NextAddons\Utilities\Help as Help;

?>
<div class="themedev-fun-fact-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-fun-fact-item <?php echo esc_attr($classs);?>">
        <?php if( $nextaddons_funfact_icon_enable == 'yes'):?>
        <div class="nxadd-funfact-icon">
            <?php 
                if($nextaddons_funfact_icon['library'] == 'svg' || isset($nextaddons_funfact_icon['value']['url'])){
                \Elementor\Icons_Manager::render_icon( $nextaddons_funfact_icon, [ 'aria-hidden' => 'true'] );
            }else{
            ?>
            <i class="nextaddons-icon <?php echo esc_attr($nextaddons_funfact_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_funfact_icon['library']);?>"></i>	
            <?php }?>
        </div>
        <?php endif;?>
        <div class="nxadd-funfact-timer" nx-fun-value="<?php echo esc_attr($nextaddons_funfact_counter);?>" nx-fun-start="<?php echo esc_attr($nextaddons_funfact_start);?>" nx-fun-step="<?php echo esc_attr($nextaddons_funfact_step);?>" nx-fun-speed="<?php echo esc_attr($nextaddons_funfact_speed);?>" nx-fun-tag="<?php echo esc_attr($nextaddons_funfact_counter_tag);?>" <?php if($nextaddons_funfact_control_format == 'yes'){?> nx-fun-number-format="yes" nx-fun-number-format-name="<?php echo esc_attr($nextaddons_funfact_currency_format);?>" <?php } if( $nextaddons_funfact_extra_text_enable == 'yes'){?> nx-fun-extra-data="<?php echo esc_attr($nextaddons_funfact_extra_text);?>" nx-fun-extra-data-direction="<?php echo esc_attr($nextaddons_funfact_extra_text_direction);?>" <?php }?> id="<?php echo esc_attr($elementorID);?>">
        </div>
        <?php if( $nextaddons_funfact_title_enable == 'yes'):?>
        <h2 class="nxadd-funfact-title"><?php echo Help::_nspan($nextaddons_funfact_title, 'span', '');?> </h2>
        <?php endif;?>
    </div>
</div> 

