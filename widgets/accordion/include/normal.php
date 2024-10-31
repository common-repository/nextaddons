<?php
use \NextAddons\Utilities\Help as Help;
?>

<div class="themedev-tab-wrapper nx-accrodion-wraper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-accordion <?php echo esc_attr($classs);?>">
    <?php 
        if( is_array($nextaddons_accordion_items) && !empty($nextaddons_accordion_items) ){
            foreach($nextaddons_accordion_items as $k=>$v):
                $title = isset($v['nextaddons_items_title']) ? $v['nextaddons_items_title'] : '';
                $details = isset($v['nextaddons_items_content']) ? $v['nextaddons_items_content'] : '';
                $active = isset($v['nextaddons_items_active']) ? $v['nextaddons_items_active'] : 'no';
                
                $_id = isset($v['_id']) ? $v['_id'] : '';
            ?>
           
            <div class="nx-card">
				<div class="nx-card-header <?php if($active == 'yes'){?>nx-visible active<?php }?>">
					<div class="<?php echo esc_attr($elementorID);?> nx-click-collapse open">
                        <?php
                        if($nextaddons_accordion_serial_type == 'icon'){
                            if($nextaddons_serial_icon['library'] == 'svg' || isset($nextaddons_serial_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_serial_icon, [ 'aria-hidden' => 'true', 'class' => 'left-icon  left-icon1'] );
                            }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_serial_icon['value']);?> left-icon left-icon1" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_serial_icon['library']);?>"></i>	
                                <?php
                            }

                            if($nextaddons_serial_icon2['library'] == 'svg' || isset($nextaddons_serial_icon2['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_serial_icon2, [ 'aria-hidden' => 'true', 'class' => 'left-icon left-icon2'] );
                            }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_serial_icon2['value']);?> left-icon left-icon2" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_serial_icon2['library']);?>"></i>	
                                <?php
                            }
                        }else if( $nextaddons_accordion_serial_type == 'number' ){?>
                            <span class="number left-icon"></span>
                        <?php }?>
                         <span class="accon-title"><?php echo esc_html__($title, 'next-addons');?>   </span>

                        <?php
                        if($nextaddons_indicator_enable == 'yes'){
                            if($nextaddons_indicator_icon['library'] == 'svg' || isset($nextaddons_indicator_icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_indicator_icon, [ 'aria-hidden' => 'true', 'class' => 'right-icon right-icon1'] );
                            }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_indicator_icon['value']);?> right-icon arrow-icon right-icon1" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_indicator_icon['library']);?>"></i>	
                                <?php
                            } if($nextaddons_indicator_icon2['library'] == 'svg' || isset($nextaddons_indicator_icon2['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $nextaddons_indicator_icon2, [ 'aria-hidden' => 'true', 'class' => 'right-icon right-icon2'] );
                            }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_indicator_icon2['value']);?> right-icon arrow-icon right-icon2" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_indicator_icon2['library']);?>"></i>	
                                <?php
                            }
                        }?>
					</div>
					<div class="nx-hide-collapse <?php if($active == 'yes'){?>active<?php }?>" style="height:<?php if($active == 'yes'){?>auto<?php }else{?>0<?php }?>;">
						<div class="nx-card-body">
                        <?php echo $details;?>   
						</div>
					</div>
				</div>
			</div>
        <?php 
        endforeach;
        }
        ?>
        
    </div>

</div> 