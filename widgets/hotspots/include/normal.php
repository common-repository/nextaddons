<?php
use \NextAddons\Utilities\Help as Help;

?>
<div class="themedev-hotspots-area <?php echo esc_attr($nextaddons_custom_class);?>">
    <div class="nxadd-hotspots-wrapper nx-focus-content " id="<?php echo esc_attr($elementorID);?>" nx-move-control="<?php echo $nextaddons_hotspots_move;?>">
        <div class="nxadd-hot-spots-image <?php echo esc_attr($classs);?> nx-text-center">
            <?php if( is_array($nextaddons_hotspots_items) && !empty($nextaddons_hotspots_items)):
                $i = 0;
                foreach($nextaddons_hotspots_items as $v):
                    
                    $bar_type = !isset($v['nextaddons_hotspots_bar_type']) ? 'top-bar' : $v['nextaddons_hotspots_bar_type'];
                    $focus_type = !isset($v['nextaddons_hotspots_focus_type']) ? 'hotspots-ring' : $v['nextaddons_hotspots_focus_type'];
                    
                    $show = !isset($v['nextaddons_hotspots_data_show']) ? '' : $v['nextaddons_hotspots_data_show'];
                    $title = !isset($v['nextaddons_hotspots_data_title']) ? '' : $v['nextaddons_hotspots_data_title'];
                    $pointer = !isset($v['nextaddons_hotspots_pointer']) ? 'text' : $v['nextaddons_hotspots_pointer'];
                    $icons = !isset($v['nextaddons_hotspots_pointer_icon']) ? '' : $v['nextaddons_hotspots_pointer_icon'];
                    $text_pinter = !isset($v['nextaddons_hotspots_pointer_text']) ? '' : $v['nextaddons_hotspots_pointer_text'];
                   
                ?>
                <div class="elementor-repeater-item-<?php echo esc_attr( $v[ '_id' ] ); ?> nx-focus-pane nxadd-hotspots-content <?php echo esc_attr($bar_type);?> <?php echo ($show == 'yes') ? 'nx-show' : '';?>" id="popover-<?php echo esc_attr($elementorID);?>-<?php echo $i;?>">
                    <h4 class="nxadd-hotspot-title"><?php echo esc_html__($title, 'next-addons');?> </h4>
                </div>
                <span class="elementor-repeater-item-<?php echo esc_attr( $v[ '_id' ] ); ?> nx-focus nxadd-hots-pots-inner <?php echo esc_attr($focus_type);?> <?php echo ($show == 'yes') ? 'nx-active' : '';?>" nx-target="#popover-<?php echo esc_attr($elementorID);?>-<?php echo $i;?>">
                    <span class="hotspots-icon-wrap">
                       <?php 
                       if($pointer == 'text'){
                             echo '<i class="hotspot-icon"> '.esc_html($text_pinter).' </i>';
                       }else{
                        if($icons['library'] == 'svg' || isset($icons['value']['url'])){
                            \Elementor\Icons_Manager::render_icon( $icons, [ 'aria-hidden' => 'true'] );
                        }else{
                        ?>
                        <i class="nextaddons-icon hotspot-icon <?php echo esc_attr($icons['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($icons['library']);?>"></i>	
                        <?php }
                        }?>
                    </span>
                </span>
                <?php $i++;
                endforeach;
            endif;
            ?> 
            <img src="<?php echo $nextaddons_hotspots_images['url'];?>" alt="">
        </div>
    </div>
</div> 