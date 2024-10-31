<?php
use \NextAddons\Utilities\Help as Help;
use \NextAddons\Widgets\NextConfig_Advance_Gallery as NX_Config;
?>
<div class="themedev-mixin-gallery-wraper <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-gallery-style nxadd-video-gallery <?php echo esc_attr($nextaddons_layout_type);?>" id="<?php echo esc_attr($elementorID);?>">
        
        <ul class="nxadd-main-filter <?php echo esc_attr($nextaddons_tab_style);?>" >
            <li class="nxadd-nav-item">
                <a class="nx-controls nx-active" href="#" nx-target=".all">All</a>
            </li>
            <?php 
            $data = [];
            if( is_array($nextaddons_tab_items) && !empty($nextaddons_tab_items) ){
                foreach($nextaddons_tab_items as $v):
                    $_id = isset($v['_id']) ? $v['_id'] : '';
                    $name = isset($v['nextaddons_tab_title']) ? $v['nextaddons_tab_title'] : '';
                    $id = isset($v['nextaddons_tab_id']) ? $v['nextaddons_tab_id'] : 'tab1';
                    
                ?>
                <li class="nxadd-nav-item">
                    <a class="nx-controls" href="#" nx-target=".<?php echo $id;?>"><?php echo esc_html__($name, 'next-addons');?></a>
                </li>

                <?php 
            endforeach;
            }
        ?> 
        </ul>

        <div class="nxadd-mix-content <?php echo esc_attr($classs);?>" >
            <?php if( is_array($nextaddons_adgallery_items) && !empty($nextaddons_adgallery_items) ){
                foreach($nextaddons_adgallery_items as $k=>$v):
                    $images = isset($v['nextaddons_videos_images']) ? $v['nextaddons_videos_images'] : '';
                    $url_video = isset($v['nextaddons_videos_url']) ? $v['nextaddons_videos_url'] : '';
                    $overlay = isset($v['nextaddons_videos_overlay_set']) ? $v['nextaddons_videos_overlay_set'] : 'no';
                    $type = isset($v['nextaddons_videos_type']) ? $v['nextaddons_videos_type'] : 'youtube';

                    $settings = [
                        'autoplay' => $nextaddons_videos_settings_autoplay,
                    ];
                    $video_url = NX_Config::instance()->_embaed_url($type, $url_video, $settings);

                    if($overlay != 'yes'){
                        $default_images = NX_Config::instance()->_get_video_data_new($type, $url_video);
                        $images = isset($default_images['thumbnail']) ? $default_images['thumbnail'] : '';
                    }

                    $title = isset($v['nextaddons_videos_title']) ? $v['nextaddons_videos_title'] : '';
                    $details = isset($v['nextaddons_videos_des']) ? $v['nextaddons_videos_des'] : '';
                   
                    $_id = isset($v['_id']) ? $v['_id'] : '';
                    $_tab = isset($v['nextaddons_videos_tab']) ? $v['nextaddons_videos_tab'] : 'tab1';
                    
                    $ren['iframe'] = [
                        'width' => $nextaddons_videos_iframe_width,
                        'height' => $nextaddons_videos_iframe_height,
                        'src' => $video_url,
                        'frameborder' => 0,
                        'allow' => 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
                        'allowfullscreen' => 1,
                        'autoplay' => $nextaddons_videos_settings_autoplay,
                        'class' => 'nx-openiframe-'.$k,
                        'style' => 'display: block;'
                    ];
                    $render = json_encode($ren);
                    
                ?>
                <div class="nx-mix nx-animation-default <?php echo esc_attr($_tab);?> nxadd-gallery-item  <?php echo esc_attr($class2);?>" <?php if( $nextaddons_adgallery_popup_enable != 'yes'){?>  nx-targetid="#<?php echo esc_attr($elementorID);?>" nx-targetdisplayclose=".nxdisplay-play-<?php echo esc_attr($k)?>" nx-targetdisplayopen=".nx-openiframe-<?php echo esc_attr($k)?>"  onclick="nx_play(this);" <?php }?>>
                    <div class="nxadd-gallery-inner hover-horizontal">
                    <?php
                        if($nextaddons_videos_overlay_images == 'yes'){                      
                            if(isset($images['id'])  && $images['id'] != ''){
                                echo wp_get_attachment_image( $images['id'], $thumbnail_videos_size , '', ['class' => 'nxadd-img nx-popup-hide ']);
                            }else{
                                $url_image = isset($images['url']) ? $images['url'] : $images;
                        ?>
                            <img class="nxadd-img nx-popup-hide" src="<?php echo esc_url($url_image)?>" alt="">
                        <?php 
                            } 
                        }   
                        if($nextaddons_adgallery_popup_enable == 'yes'){?>
                            <div class="nx-popup" data-render='<?php echo $render;?>'> </div>
                         <?php }else{?>
                             <div class="nx-playbox" data-render='<?php echo $render;?>'></div> 
                         <?php  }?>

                        <?php if($nextaddons_adgallery_overlay_enable == 'yes'){?>
                        <div class="nxadd-hover-area nx-text-center">
                            <div class="nxadd-hover-content">
                                <?php if($nextaddons_adgallery_title_enable == 'yes'  && !empty($title) ):?>
                                <h3 class="nxadd-gallery-title"> <?php echo __($title, 'next-addons');?></h3>
                                <?php endif;?>

                                <?php if($nextaddons_adgallery_details_enable == 'yes' && !empty($details) ):?>
                                    <p class="nxadd-des"><?php echo __($details, 'next-addons');?></p>
                                <?php endif;?>

                                <?php if($nextaddons_adgallery_overlay_enable_icon == 'yes'):?>
                                <a class="image-popup nxadd-gallery-icon <?php echo esc_attr($iconAnimation);?>" >
                                <?php 
                                    if($nextaddons_adgallery_overlay_icon['library'] == 'svg' || isset($nextaddons_adgallery_overlay_icon['value']['url'])){
                                        \Elementor\Icons_Manager::render_icon( $nextaddons_adgallery_overlay_icon, [ 'aria-hidden' => 'true'] );
                                    }else{
                                    ?>
                                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_adgallery_overlay_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_adgallery_overlay_icon['library']);?>"></i>	
                                    <?php }?>
                                </a>
                                <?php endif;?>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <?php 
            endforeach;
            }
        ?> 
        </div>
    </div>
</div> 

