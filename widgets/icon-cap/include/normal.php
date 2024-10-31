<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-icon-caps-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-icon-caps-wrapper">
    <?php if( !empty($nextaddons_content_badge) ):?><span class="nxadd-icon-caps-badge "><?php echo esc_html__($nextaddons_content_badge, 'next-addons');?></span> <?php endif;?>
        <div class="nxadd-icon-inner <?php echo esc_attr($nextaddons_tabs_type);?>">
            <span class="nxadd-icon">
               
                <?php
                if($nextaddons_icon_icons['library'] == 'svg' || isset($nextaddons_icon_icons['value']['url'])){
                    \Elementor\Icons_Manager::render_icon( $nextaddons_icon_icons, [ 'aria-hidden' => 'true'] );
                }else{
                ?>
                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_icon_icons['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_icon_icons['library']);?>"></i>			
                <?php }?>

            </span>
            <?php if( !empty($nextaddons_content_title) ){?>
            <div class="nxadd-icon-caps-title-wrap">
                <a class="nxadd-icon-caps-title" href="<?php echo esc_url( $nextaddons_content_title_link['url']);?>" <?php echo ($nextaddons_content_title_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_content_title_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?> >
                    <?php echo esc_html__($nextaddons_content_title, 'next-addons');?>
                </a>
            </div>
            <?php }?>
        </div>
    </div>
</div> 

