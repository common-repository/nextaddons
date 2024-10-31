<?php
use \NextAddons\Utilities\Help as Help;

?>
<div class="themedev-piechart-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="themedev-single-pie_chart <?php echo esc_attr($classs);?>">
        <div class="nx-chart chart-<?php echo esc_attr($elementorID);?>" data-percent="<?php echo esc_attr($nextaddons_piechart_counter);?>" data-update="0">
            <?php 
            if($nextaddons_piechart_display == 'icon'){
                if($nextaddons_piechart_display_icon['library'] == 'svg' || isset($nextaddons_piechart_display_icon['value']['url'])){
                    \Elementor\Icons_Manager::render_icon( $nextaddons_piechart_display_icon, [ 'aria-hidden' => 'true'] );
                }else{
                ?>
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_piechart_display_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_piechart_display_icon['library']);?>"></i>	
                <?php }
            }else{
            ?>
                <span class="nx-piedisply"><?php echo esc_html($nextaddons_piechart_display_text);?>
            <?php }?>
        </div>
    </div>
</div> 

