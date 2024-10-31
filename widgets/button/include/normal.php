<?php
use \NextAddons\Utilities\Help as Help;

use \NextAddons\Widgets\NextConfig_Button as NX_Config;

$nextaddons_button_link['url'] = esc_url( $nextaddons_button_link['url']);

if($nextaddons_button_linktype == 'video'){
    $nextaddons_button_link['url'] = 'jasvscript: void();';
}
?>
<div class="themedev-button-area <?php echo esc_attr($nextaddons_custom_class);?>">
    <div class="nxadd-single-btn <?php if($nextaddons_button_linktype == 'video'){?>nx-popup-data<?php }?>" >
        <?php if( $nextaddons_button_type == 'icon'){?>
            <a href="<?php echo $nextaddons_button_link['url'];?>" <?php echo ($nextaddons_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation);?>">
                <?php 
                    if($nextaddons_button_icon['library'] == 'svg' || isset($nextaddons_button_icon['value']['url'])){
                    \Elementor\Icons_Manager::render_icon( $nextaddons_button_icon, [ 'aria-hidden' => 'true'] );
                }else{
                ?>
                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_button_icon['library']);?>"></i>	
                <?php }?> 
            </a>
        <?php }else if( $nextaddons_button_type == 'icon-text' ){ ?>
            
            <a href="<?php echo $nextaddons_button_link['url'];?>" <?php echo ($nextaddons_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation);?>">
                <?php if( $nextaddons_button_icon_position == 'left'){?>
                    <?php 
                    if($nextaddons_button_icon['library'] == 'svg' || isset($nextaddons_button_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_button_icon, [ 'aria-hidden' => 'true'] );
                    }else{
                    ?>
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_button_icon['library']);?>"></i>
                <?php 
                    }
                    }?>
                <?php echo esc_html__($nextaddons_button_text, 'next-addons');?>
                <?php if( $nextaddons_button_icon_position == 'right'){?>
                    <?php 
                    if($nextaddons_button_icon['library'] == 'svg' || isset($nextaddons_button_icon['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_button_icon, [ 'aria-hidden' => 'true'] );
                    }else{
                    ?> 
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_button_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_button_icon['library']);?>"></i>
                <?php }
                }?>
            </a>

        <?php }else{ ?>
            <a href="<?php echo $nextaddons_button_link['url'];?>" <?php echo ($nextaddons_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> class="nxadd-btn  <?php echo esc_attr($classs);?> <?php echo esc_attr($buttonAnimation);?>">
            <?php echo esc_html__($nextaddons_button_text, 'next-addons');?>
            </a>
        <?php } ?>

        <?php if($nextaddons_button_linktype == 'video'){
            
            $settings = [
                'autoplay' => 0,
            ];
            $video_url = NX_Config::instance()->_embaed_url('youtube', $nextaddons_button_video, $settings);

            $ren['iframe'] = [
                'width' => 800,
                'height' => 400,
                'src' => $video_url,
                'frameborder' => 0,
                'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                'allowfullscreen' => 1,
                'autoplay' => 1,
               
            ];
            $render = json_encode($ren);
            ?>
            <div class="nx-popup" data-render='<?php echo $render;?>'>
            </div>
        <?php }?>
    </div>
  
</div> 

