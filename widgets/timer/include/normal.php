<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-countdown-wraper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-countdown-timer <?php echo esc_attr($classs);?>" nx-countdown-end-date="<?php echo esc_attr($date);?>" nx-show-type="<?php echo esc_attr($format);?>" nx-show-name="<?php echo esc_attr($label);?>" nx-count-tag="<?php echo $nextaddons_timer_date_tag;?>" nx-label-tag="<?php echo $nextaddons_timer_dateformat_tag;?>" <?php if($nextaddons_timer_exprie_enable == 'yes'){?> nx-expired-message="<?php echo esc_html__($nextaddons_timer_exprie_text, 'next-addons');?>" <?php }?> id="<?php echo esc_attr($elementorID);?>">
     </div>
</div> 

