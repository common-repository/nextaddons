<?php
use \NextAddons\Utilities\Help as Help;
use \NextAddons\Widgets\NextConfig_Gallery as NX_Config;
?>
<div class="themedev-gallery-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nxadd-gallery-style nxadd-video-gallery <?php echo esc_attr($classs);?>" id="<?php echo esc_attr($elementorID);?>">
        <?php if( is_array($nextaddons_gallery_items) && !empty($nextaddons_gallery_items) ){
            foreach($nextaddons_gallery_items as $k=>$v):
                $images = isset($v['nextaddons_videos_images']) ? $v['nextaddons_videos_images'] : '';
                $url_video = isset($v['nextaddons_videos_url']) ? $v['nextaddons_videos_url'] : '';
                $_id = isset($v['_id']) ? $v['_id'] : '';
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
            <div class="nxadd-single-gallery-item <?php echo esc_attr($class2);?>" <?php if( $nextaddons_gallery_popup_enable != 'yes'){?>  nx-targetid="#<?php echo esc_attr($elementorID);?>" nx-targetdisplayclose=".nxdisplay-play-<?php echo esc_attr($k)?>" nx-targetdisplayopen=".nx-openiframe-<?php echo esc_attr($k)?>"  onclick="nx_play(this);" <?php }?> >
                <div class="nxadd-portfolio-thumb ">
                 <?php
                     if($nextaddons_videos_overlay_images == 'yes'){                      
                        if(isset($images['id'])  && $images['id'] != ''){
                            echo wp_get_attachment_image( $images['id'], $thumbnail_videos_size , '', ['class' => 'nxadd-img nx-popup-hide  nxdisplay-play-'.$k.'']);
                        }else{
                            $url_image = isset($images['url']) ? $images['url'] : $images;
                    ?>
                            <img class="nxadd-img nx-popup-hide nxdisplay-play-<?php echo esc_attr($k)?>" src="<?php echo esc_url($url_image)?>" alt="">
                    <?php 
                        } 
                    }
                    if($nextaddons_gallery_popup_enable == 'yes'){?>
                       <div class="nx-popup" data-render='<?php echo $render;?>'> </div>
                    <?php }else{?>
                        <div class="nx-playbox" data-render='<?php echo $render;?>'></div> 
                    <?php  }?>
            
                    <?php if($nextaddons_gallery_overlay_enable == 'yes'){?>
                    <div class="nxadd-hover-area nx-text-center nxdisplay-play-<?php echo esc_attr($k)?>">
                        <div class="nxadd-hover-content">
                            <?php if($nextaddons_gallery_title_enable == 'yes'  && !empty($title) ):?>
                             <h3 class="nxadd-gallery-title"> <?php echo __($title, 'next-addons');?></h3>
                            <?php endif;?>

                            <?php if($nextaddons_gallery_details_enable == 'yes' && !empty($details) ):?>
                                <p class="nxadd-des"><?php echo __($details, 'next-addons');?></p>
                            <?php endif;?>

                            <?php if($nextaddons_gallery_overlay_enable_icon == 'yes'):?>
                            <a class="image-popup nx-gallery-icon <?php echo esc_attr($iconAnimation);?>" >
                            <?php 
                                if($nextaddons_gallery_overlay_icon['library'] == 'svg' || isset($nextaddons_gallery_overlay_icon['value']['url'])){
                                    \Elementor\Icons_Manager::render_icon( $nextaddons_gallery_overlay_icon, [ 'aria-hidden' => 'true'] );
                                }else{
                                ?>
                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_gallery_overlay_icon['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_gallery_overlay_icon['library']);?>"></i>	
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

