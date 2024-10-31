<?php
use \NextAddons\Utilities\Help as Help;
?>
<div class="themedev-pricing-list-area <?php echo esc_attr($nextaddons_custom_class);?>" >
   <div class="nx-pricemenu">
    <?php if( is_array($nextaddons_pricemenu_menu_items) && !empty($nextaddons_pricemenu_menu_items) ){
        foreach($nextaddons_pricemenu_menu_items as $k=>$v):
            $title = isset($v['nextaddons_menu_title']) ? $v['nextaddons_menu_title'] : '';
            $price = isset($v['nextaddons_menu_price']) ? $v['nextaddons_menu_price'] : '';
            $details = isset($v['nextaddons_menu_des']) ? $v['nextaddons_menu_des'] : '';
            $photos = isset($v['nextaddons_menu_photos']) ? $v['nextaddons_menu_photos'] : '';


            $type = isset($v['nextaddons_menu_badge_type']) ? $v['nextaddons_menu_badge_type'] : '';
            $text = isset($v['nextaddons_menu_badge']) ? $v['nextaddons_menu_badge'] : '';
            $icon = isset($v['nextaddons_menu_icon']) ? $v['nextaddons_menu_icon'] : '';
            $ratting = isset($v['nextaddons_menu_ratting']) ? $v['nextaddons_menu_ratting'] : '';
            $link = isset($v['nextaddons_menu_link']) ? $v['nextaddons_menu_link'] : '';

            $_id = isset($v['_id']) ? $v['_id'] : '';
            
            $id = isset($photos['id']) ? $photos['id'] : '';
            $url = isset($photos['url']) ? $photos['url'] : '';

            ?>    
            <div class="nxadd-single-price-list-block nx-media nx-animation-default <?php echo esc_attr($nextaddons_tabs_type);?>">
                <?php if(!empty($photos) && !empty($url) ){?>
                    <div class="nx-media-price">
                    <?php
                        if($id != '' || $id != 0){
                            echo wp_get_attachment_image( $id, $thumbnail_menu_size , '', ['class' => 'nx-full-width']);
                        }else{
                        ?>
                            <img class="nx-full-width" src="<?php echo esc_url($url);?>" alt="">
                    <?php }?>
                    </div>
                <?php }?>

                <div class="nx-media-body">
                    
                    <?php if( !empty($type) ){?>
                    <div class="nx-price-badge">
                       <?php if($type == 'text' && !empty($text) ){?>
                        <span class="badges-text"> <?php echo __($text, 'next-addons');?> </span>
                       <?php }else if( $type == 'icon' && !empty($icon) ) {?>
                        <span class="badges-icon">
                            <?php 
                            if($icon['library'] == 'svg' || isset($icon['value']['url'])){
                                \Elementor\Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true'] );
                            }else{
                            ?>
                            <i class="nextaddons-icon <?php echo esc_attr($icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($icon['library']);?>"></i>	
                            <?php }?>
                        </span>
                       <?php }?>
                    </div>
                    <?php }?>

                    <div class="nx-price-content">
                        
                        <?php if(!empty($title) ):?>
                        <h4 class="pricing-list-title"> <?php echo __($title, 'next-addons');?></h4>
                        <?php endif;?>
                        <div class="dot-border"></div>
                        <?php if( !empty($price) ){?>
                        <span class="pricing-list-price"><?php echo __($price, 'next-addons');?></span>
                        <?php }?>
                    </div>
                    <?php if(!empty($ratting) ){?>
                        <div class="nx-price-ratting">
                            <span class="ratting-body">
                             <?php echo $ratting;?> <i class="nextaddons-icon nx-icon nx-icon-star1"> </i>
                            </span>
                        </div>
                    <?php }?>

                    <?php if(!empty($details) ):?>
                        <p class="product-des"><?php echo __($details, 'next-addons');?></p>
                    <?php endif;?>
                    
                </div>
            </div>
        <?php endforeach;
        } ?>
    </div>
</div> 

