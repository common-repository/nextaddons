<?php
use \NextAddons\Utilities\Help as Help;
?>

<div class="themedev-business-hours-wrapper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <ul class="nxadd-business-hours-inner">
    <?php 
    if( !empty($nextaddons_items_heading) ){
        ?>
        <li class="nxadd-business-hour-title">
            <h3><?php echo esc_html__($nextaddons_items_heading, 'next-addons');?></h3>
        </li>
        <?php
    }
    if( is_array($nextaddons_business_items) && !empty($nextaddons_business_items) ){   
    
        foreach($nextaddons_business_items as $k=>$v):
        $days = isset($v['nextaddons_items_days']) ? $v['nextaddons_items_days'] : '';
        $time = isset($v['nextaddons_items_time']) ? $v['nextaddons_items_time'] : '';
        $close = isset($v['nextaddons_items_close']) ? $v['nextaddons_items_close'] : 'no';
        
        $_id = isset($v['_id']) ? $v['_id'] : '';
    ?>
    <li class="nxadd-business-hour-single-item <?php if( $close == 'yes'){ echo 'nx-business-close';}?>">
        <span class="nxadd-business-day"><?php echo esc_html__($days, 'next-addons');?></span>
        <span class="nxadd-business-time"><?php echo esc_html__($time, 'next-addons');?></span>
    </li>
        
    <?php  endforeach;?>
    
    <?php 
    }
    ?>  
    </ul> 
</div> 