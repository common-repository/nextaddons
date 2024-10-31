<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themdev-card-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <?php if( !empty($nextaddons_content_badge) ):?><span class="nxadd-card-badge"><?php echo esc_html__($nextaddons_content_badge, 'next-addons');?></span> <?php endif;?>
        
    <div class="nxadd-card-box <?php echo esc_attr($nextaddons_tabs_type);?>">
        <figure class="nxadd-card-header">
            <?php
                $url = isset($nextaddons_card_image['url']) ? $nextaddons_card_image['url'] : '';
                if(isset($nextaddons_card_image['id'])  && $nextaddons_card_image['id'] != ''){
                    echo wp_get_attachment_image( $nextaddons_card_image['id'], $thumbnail_size , '', ['class' => 'nxcardbox ']);
                }else if( !empty($url) ){
                ?>
                <img class="nxcardbox" src="<?php echo esc_url($url)?>" alt="">
                <?php } ?>

        </figure>
        <div class="nxadd-card-body">
            <?php if( !empty($nextaddons_content_title) ){?>
            <h3 class="nxadd-card-title"> <?php echo esc_html__($nextaddons_content_title, 'next-addons');?> </h3>
            <?php }?>
            <?php if( !empty($nextaddons_content_price) ){?>
            <span class="nxadd-product-price"><?php echo esc_html($nextaddons_content_price);?></span>
            <?php }?>
            <?php if( !empty($nextaddons_content_details) ){?>
            <div class="nxadd-card-text">
                <p class="card-des"><?php echo esc_html__($nextaddons_content_details, 'next-addons');?></p>
            </div>
            <?php }?>
            <div class="nxadd-btn-wrapper ">
                <a href="<?php echo esc_url( $nextaddons_content_button_link['url']);?>" <?php echo ($nextaddons_content_button_link['is_external'] == 'on') ? 'target="_blank"' : '';?> <?php echo ($nextaddons_content_button_link['nofollow'] == 'on') ? 'rel="nofollow"' : '';?>  class="nxadd-btn nxadd-<?php echo $nextaddons_icon_icons_position;?>-icon">
                    <?php if( !empty($nextaddons_button_text)){?><span><?php echo esc_html__($nextaddons_button_text, 'next-addons')?></span> <?php }?>
                    
                    <?php
                    if($nextaddons_icon_icons['library'] == 'svg' || isset($nextaddons_icon_icons['value']['url'])){
                        \Elementor\Icons_Manager::render_icon( $nextaddons_icon_icons, [ 'aria-hidden' => 'true'] );
                    }else if( !empty($nextaddons_icon_icons['value']) ) {
                    ?>
                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_icon_icons['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_icon_icons['library']);?>"></i>			
                    <?php }?>
                </a>
            </div>
        </div>
    </div>
</div> 

