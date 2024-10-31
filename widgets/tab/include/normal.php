<?php
use \NextAddons\Utilities\Help as Help;
?>

<div class="themedev-tab-wraper nx-tabs-wraper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nx-tab-style <?php echo esc_attr($nextaddons_tabs_type);?>  <?php echo esc_attr($classs);?> <?php echo esc_attr($elementorID);?>" id="<?php echo esc_attr($elementorID);?>">
    <?php 
    if( is_array($nextaddons_tabs_items) && !empty($nextaddons_tabs_items) ){   
     ?>
        <ul class="nx-nav nx-nav-tabs <?php echo ($nextaddons_tabs_type == 'top-tab') ? $nextaddons_tabs_type_full : '';?> ">
            <?php
             foreach($nextaddons_tabs_items as $k=>$v):
                $title = isset($v['nextaddons_items_title']) ? $v['nextaddons_items_title'] : '';
                $active = isset($v['nextaddons_items_active']) ? $v['nextaddons_items_active'] : 'no';
                
                $_id = isset($v['_id']) ? $v['_id'] : '';
            ?>
            <li class="nav-item">
                <a class="nx-tab nx-nav-link <?php echo esc_attr($nextaddons_tabs_icon_position);?> <?php if($active == 'yes'){?>nx-active<?php }?>" href="#" nx-target="#nx_<?php echo esc_attr($_id);?>">
                <?php
                if($nextaddons_indicator_enable == 'yes'){
                    if($nextaddons_indicator_icon['library'] == 'svg' || isset($nextaddons_indicator_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_indicator_icon, [ 'aria-hidden' => 'true', 'class' => 'tabs-icon1'] );
                    }else{
                        ?>
                        <i class="nextaddons-icon <?php echo esc_attr($nextaddons_indicator_icon['value']);?> tabs-icon1" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_indicator_icon['library']);?>"></i>	
                        <?php
                    }
                    
                }?>

                <?php echo esc_html__($title);?>
            </a>
            </li>
           
            <?php  endforeach;?>
        </ul>
        <?php 
        }
       
        if( is_array($nextaddons_tabs_items) && !empty($nextaddons_tabs_items) ){
            ?>
        <div class="nx-tab-content">
            <?php
             foreach($nextaddons_tabs_items as $k=>$v):
                $details = isset($v['nextaddons_items_content']) ? $v['nextaddons_items_content'] : '';
                $active = isset($v['nextaddons_items_active']) ? $v['nextaddons_items_active'] : 'no';
                
                $_id = isset($v['_id']) ? $v['_id'] : '';
            ?>
            <div class="nx-tab-pane  <?php if($active == 'yes'){?>nx-show<?php }?>" id="nx_<?php echo esc_attr($_id);?>">
                <div class="animated nx-fadeInUp"><?php echo $details;?> </div>
            </div>
           
            <?php  endforeach;?>
        </div>
    
        <?php 
        }
        ?>
     </div>   
</div> 