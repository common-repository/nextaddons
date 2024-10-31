<?php
use \NextAddons\Utilities\Help as Help;

$nextaddons_content_type = isset($nextaddons_content_type) ? $nextaddons_content_type : '';
?>
<div class="themedev-step-flow-wrapper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-step-inner nx-advance-step-flow <?php echo $nextaddons_content_type;?> <?php echo esc_attr($classs);?>">
        <div class="nxadd-step-icon-content">
            <div class="nxadd-step-icon">
                
                <?php
                if($nextaddons_icon_icons['library'] == 'svg' || isset($nextaddons_icon_icons['value']['url'])){
                    \Elementor\Icons_Manager::render_icon( $nextaddons_icon_icons, [ 'aria-hidden' => 'true', 'class' => ''] );
                }else{
                    ?>
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_icon_icons['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_icon_icons['library']);?>"></i>	
                    <?php
                }
                ?>

                <?php if( !empty($nextaddons_content_counter_data) ){?>
                <span class="nxadd-steps-label"><?php echo esc_html__($nextaddons_content_counter_data, 'next-addons');?></span>
                <?php }?>

                <?php 
                if( !empty($nextaddons_indication_data) ){
                    $options = [];
                    foreach($nextaddons_indication_data as $v):
                        $k = str_replace( 'nx-', '', $v);
                        $content = 'nextaddons_indication_'.$k.'_label';

                        $data = isset($$content) ? $$content : '';
                       
                ?>
                    <div class="nxadd-step-arrow <?php echo $v;?>">  <?php if(!empty($data)):?><span class="nx-arrow-lebel"><?php echo esc_html__($data, 'next-adons');?></span> <?php endif;?></div>
                <?php endforeach;
                }?>
               
            </div>
            
        </div>
        <?php if($nextaddons_content_show == 'yes'):?>
        <div class="nxadd-step-content">
            <?php if( !empty($nextaddons_content_title) ):?><h3 class="nxadd-step-title"> <?php echo esc_html__($nextaddons_content_title, 'next-addons');?> </h3> <?php endif;?>
            <?php if( !empty($nextaddons_content_details) ):?><p class="nxadd-step-des"><?php echo esc_html__($nextaddons_content_details, 'next-addons');?></p><?php endif;?>
        </div>
        <?php endif;?>
    </div>
  
</div> 

