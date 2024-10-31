<?php
use \NextAddons\Utilities\Help as Help;
use \NextAddons\Widgets\NextConfig_Slider as NX_Config;

$nextaddons_slide_dot = empty($nextaddons_slide_dot) ? 'no' : 'yes';
$nextaddons_slide_arrow = empty($nextaddons_slide_arrow) ? 'no' : 'yes';

$leftIcon = isset($nextaddons_slide_arrow_left['value']) ? $nextaddons_slide_arrow_left['value'] : 'nx-icon nx-icon-chevron-left';
$rightIcon = isset($nextaddons_slide_arrow_right['value']) ? $nextaddons_slide_arrow_right['value'] : 'nx-icon nx-icon-chevron-right';

?>
<div class="themedev-gallery-slider-wrapper <?php echo esc_attr($nextaddons_custom_class);?>" >
   <div class="slidercontent <?php echo esc_attr($nextaddons_layout_type);?>">  
        
        <div class="slider-wrapper <?php echo esc_attr($classs);?>">
            <div class="nx-slider-content" id="<?php echo esc_attr($elementorID);?>" nx-slide-active="0" nx-slide-speed="<?php echo esc_attr($nextaddons_slide_speed);?>" nx-item-width="<?php echo esc_attr($nextaddons_slide_width);?>" nx-item-margin="<?php echo esc_attr($nextaddons_slide_spacing);?>" nx-control-button="<?php echo esc_attr($nextaddons_slide_arrow);?>" nx-pre-button-text="<?php echo esc_attr($leftIcon);?>" nx-next-button-text="<?php echo esc_attr($rightIcon);?>" nx-slide-item="1" nx-control-dot="<?php echo esc_attr($nextaddons_slide_dot);?>">				    
            <?php 
            $data = [];
                        
            if( is_array($nextaddons_slider_videos_items) && !empty($nextaddons_slider_videos_items) ){
                foreach($nextaddons_slider_videos_items as $k=>$v):
                    $images = isset($v['nextaddons_videos_images']) ? $v['nextaddons_videos_images'] : '';
                    $title = isset($v['nextaddons_videos_title']) ? $v['nextaddons_videos_title'] : '';
                    $details = isset($v['nextaddons_videos_des']) ? $v['nextaddons_videos_des'] : '';
                    $url_video = isset($v['nextaddons_videos_url']) ? $v['nextaddons_videos_url'] : '';
                    $overlay = isset($v['nextaddons_videos_overlay_set']) ? $v['nextaddons_videos_overlay_set'] : 'no';
                    $type = isset($v['nextaddons_videos_type']) ? $v['nextaddons_videos_type'] : 'youtube';

                    $button_enable = isset($v['nextaddons_videos_button_enable']) ? $v['nextaddons_videos_button_enable'] : 'no';
                    $button_link = isset($v['nextaddons_videos_button_link']) ? $v['nextaddons_videos_button_link'] : '#';
                    $button_name = isset($v['nextaddons_videos_button_name']) ? $v['nextaddons_videos_button_name'] : 'Read More';
                    
                    $_id = isset($v['_id']) ? $v['_id'] : '';
                    
                    $settings = [
                        'autoplay' => $nextaddons_videos_settings_autoplay,
                    ];
                    $video_url = NX_Config::instance()->_embaed_url($type, $url_video, $settings);

                    if($overlay != 'yes'){
                        $default_images = NX_Config::instance()->_get_video_data_new($type, $url_video);
                        $images = isset($default_images['thumbnail']) ? $default_images['thumbnail'] : '';
                    }

                    $data1 = [];
                    $data1['title'] = $title;
                    $data1['details'] = $details;
                    $data1['url'] = isset($images['url']) ? $images['url'] : $images;
                    
                    $data[] = $data1;
                    
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
                    <div class="nx-item-slider " style="float: left; min-height:1px;">
                        <div class="nxadd-gallery-slider-single-item nx-video-slider" <?php if($nextaddons_videos_overlay_images == 'yes'){?> style="min-height: <?php echo $nextaddons_videos_iframe_height;?>px;" nx-targetid="#<?php echo esc_attr($elementorID);?>" nx-targetdisplayclose=".nxdisplay-play-<?php echo esc_attr($k)?>" nx-targetdisplayopen=".nx-openiframe-<?php echo esc_attr($k)?>" href="javascript:void()" onclick="nx_play(this);" <?php }?>>
                            <?php
                            if($nextaddons_videos_overlay_images == 'yes'){                      
                                if(isset($images['id'])  && $images['id'] != ''){
                                    echo wp_get_attachment_image( $images['id'], $thumbnail_videos_size , '', ['class' => 'nxadd-img nx-popup-hide nxdisplay-play-'.$k.'']);
                                }else{
                                    $url_image = isset($images['url']) ? $images['url'] : $images;
                            ?>
                                <img class="nxadd-img nx-popup-hide nxdisplay-play-<?php echo esc_attr($k)?>" src="<?php echo esc_url($url_image)?>" alt="">
                            <?php 
                                } 
                            }?>  

                        <?php if($nextaddons_videos_overlay_images == 'yes'){?>
                            <div class="nxadd-item-content nxdisplay-play-<?php echo esc_attr($k)?>">
                                <?php if($nextaddons_videos_title_enable == 'yes' && !empty($title) ):?>
                                <h5 class="nxadd-title"> <?php echo __($title, 'next-addons');?></h5>
                                <?php endif;?>

                                <?php if($nextaddons_videos_details_enable == 'yes' && !empty($details) ):?>
                                <span class="nxadd-subtitle"><?php echo __($details, 'next-addons');?></span>
                                <?php endif;?>
                            </div>
                            
                            <a class="nxadd-play-video-icon nxdisplay-play-<?php echo esc_attr($k)?>" >
                                <i class="nx-icon nx-icon-play3"></i>
                            </a>
                            <div class="nx-playbox" data-render='<?php echo $render;?>'></div> 
                        <?php }else{?>
                       
                            <?php if(!empty($video_url)){?>                 
                                <iframe width="<?php echo $nextaddons_videos_iframe_width;?>" height="<?php echo $nextaddons_videos_iframe_height;?>" class="nx-popup-show nx-iframe-<?php echo esc_attr($type);?> nx-openiframe-<?php echo esc_attr($k)?>" src="<?php echo esc_url($video_url);?>" style="<?php echo ($nextaddons_videos_overlay_images != 'yes') ? 'display: block;' : '';?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>			 
                            <?php }
                        }?>
                        
                          
                        </div>
                    </div>
                    
                <?php endforeach;
                } ?>
            </div>
        </div>
            
        <div class="nxadd-gallery-slider-sync-thumb video-bottom-content"  id="<?php echo esc_attr($elementorID);?>-click">
            <?php if( is_array( $data ) && !empty( $data ) ):
                foreach( $data as $k=>$v):
                    $url = isset($v['url']) ? $v['url'] : '';
                    $title = isset($v['title']) ? $v['title'] : '';
                    $details = isset($v['details']) ? $v['details'] : '';
                    
                ?>
                <div class="nx-item nx-item-click nx-item-click-active-3 <?php if($k == 0){?> active <?php }?>" nx-click-item-index="<?php echo $k;?>">  
                    <div class="nxadd-single-thumb">
                    
                        <a class="nxadd-nav-item" >
                            <span class="nxadd-nav-thumb" style="background-image: url('<?php echo esc_attr($url);?>')"></span>
                            <?php if($nextaddons_tab_title_enable == 'yes' && !empty($title) ):?>
                            <h4 class="nxadd-nav-title"><?php echo $title;?></h4>
                            <?php endif;?>

                            <?php if($nextaddons_tab_details_enable == 'yes' && !empty($details) ):?>
                            <div class="nxadd-nav-credits"><?php echo $details;?></div>
                            <?php endif;?>
                        </a>
                        
                    </div>
                </div>
                
                    <?php endforeach;
                endif;?>
        </div>

    </div>

</div> 


