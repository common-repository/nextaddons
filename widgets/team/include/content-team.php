<?php
use \NextAddons\Utilities\Help as Help;
$nextaddons_slide_dot = empty($nextaddons_slide_dot) ? 'no' : 'yes';
$nextaddons_slide_arrow = empty($nextaddons_slide_arrow) ? 'no' : 'yes';

$leftIcon = isset($nextaddons_slide_arrow_left['value']) ? $nextaddons_slide_arrow_left['value'] : 'nx-icon nx-icon-chevron-left';
$rightIcon = isset($nextaddons_slide_arrow_right['value']) ? $nextaddons_slide_arrow_right['value'] : 'nx-icon nx-icon-chevron-right';

$vertical = isset($nextaddons_slide_vertical) ? $nextaddons_slide_vertical : 'no';
?>
<div class="themedev-team-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <?php if($nextaddons_slide_enable == 'yes'){?>
    <div class="nxadd-slider-item <?php echo esc_attr($classs);?>">    
        <div class="nx-slider-content testimonial-style-2" id="<?php echo esc_attr($elementorID);?>" nx-slide-active="0" nx-slide-speed="<?php echo esc_attr($nextaddons_slide_speed);?>" nx-item-width="<?php echo esc_attr($nextaddons_slide_width);?>" nx-item-margin="<?php echo esc_attr($nextaddons_slide_spacing);?>" nx-control-button="<?php echo esc_attr($nextaddons_slide_arrow);?>" nx-pre-button-text="<?php echo esc_attr($leftIcon);?>" nx-next-button-text="<?php echo esc_attr($rightIcon);?>" nx-slide-item="<?php echo esc_attr($nextaddons_slide_item);?>" nx-control-dot="<?php echo esc_attr($nextaddons_slide_dot);?>" nx-slide-type="<?php echo esc_attr($vertical);?>">				    
    <?php }else{?>
    <div class="nx-container">
        <div class="nx-row nxadd-slider-item  <?php echo esc_attr($classs);?>"> 
    <?php }?> 

        <?php 
        $column = $nextaddons_team_display_column;

        if( is_array($nextaddons_team_items) && !empty($nextaddons_team_items) ){
            foreach($nextaddons_team_items as $k=>$v):
                $name = isset($v['nextaddons_items_name']) ? $v['nextaddons_items_name'] : '';
                $designation = isset($v['nextaddons_items_designation']) ? $v['nextaddons_items_designation'] : '';
                $overview = isset($v['nextaddons_items_overview']) ? $v['nextaddons_items_overview'] : '';
				$photos = isset($v['nextaddons_items_photos']) ? $v['nextaddons_items_photos'] : '';
				
                $fb = isset($v['nextaddons_items_social_fb_id']) ? $v['nextaddons_items_social_fb_id'] : '';
                $tw = isset($v['nextaddons_items_social_tw_id']) ? $v['nextaddons_items_social_tw_id'] : '';
                $link = isset($v['nextaddons_items_social_link_id']) ? $v['nextaddons_items_social_link_id'] : '';
				$in = isset($v['nextaddons_items_social_in_id']) ? $v['nextaddons_items_social_in_id'] : '';
				
                $phone = isset($v['nextaddons_items_phone']) ? $v['nextaddons_items_phone'] : '';
                $email = isset($v['nextaddons_items_email']) ? $v['nextaddons_items_email'] : '';

                $_id = isset($v['_id']) ? $v['_id'] : '';
                
                $id = isset($photos['id']) ? $photos['id'] : '';
                $url = isset($photos['url']) ? $photos['url'] : '';

                ?>
                <?php if($nextaddons_slide_enable == 'yes'){?>
                <div class="nx-item-slider" style="float: left; min-height:1px;" >
                <?php }else{?>
                <div class="<?php echo esc_attr($column);?> nx-item-slider">
                <?php }?>  
                
                    <div class="nxadd-team-member-profile style-4 <?php if($nextaddons_team_popup_enable == 'yes'){?>nx-popup-data<?php }?>">
                       
                        <?php
                        if($nextaddons_team_photos_enable == 'yes'){
                        ?>
                        <a class="" >
                            <?php
                            if($id != '' || $id != 0){
                                echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'nxaddons-team-image']);
                            }else{
                            ?>
                                <img class="nxaddons-team-image" src="<?php echo esc_url($url);?>" alt="">
                            <?php }?>
                            </a>
                        <?php
                        }?> 

                        <?php include 'popup.php';?>    
                           

                        <div class="nxadd-team-member-content">
                            <?php if($nextaddons_team_name_enable == 'yes' && !empty($name) ):?>
                            <h2 class="member-title"> <?php echo esc_html($name);?></h2>
                            <?php endif;?>
                            <?php if($nextaddons_team_designation_enable == 'yes' && !empty($designation) ):?>
                            <span class="member-designation"><?php echo esc_html($designation);?></span>
                            <?php endif;?>
                        
                            <?php if( $nextaddons_team_social_enable == 'yes'){?>
                            <ul class="nxadd-social nxaddon-social-colored">
                                <?php if( !empty($fb) ){?>
                                <li class="social-item ">
                                    <a class="facebook" href="https://www.facebook.com/<?php echo $fb;?>/" target="_blank">
                                        <i class="nx-icon nx-icon-facebook"></i>
                                    </a>
                                </li>
                                <?php }?>

                                <?php if( !empty($tw) ){?>
                                <li class="social-item">
                                    <a class="twitter" href="https://twitter.com/<?php echo $tw;?>/" target="_blank">
                                        <i class="nx-icon nx-icon-twitter"></i>
                                    </a>
                                </li>
                                <?php }?>
                                <?php if( !empty($link) ){?>
                                <li class="social-item">
                                    <a class="linkedin" href="https://linkedin.com/in/<?php echo $link;?>/" target="_blank">
                                        <i class="nx-icon nx-icon-linkedin"></i>
                                    </a>
                                </li>
                                <?php }?>
                                <?php if( !empty($in) ){?>
                                <li class="social-item">
                                    <a class="instagram" href="https://instagram.com/<?php echo $in;?>/" target="_blank">
                                        <i class="nx-icon nx-icon-instagram"></i>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                            <?php }?>

                        </div>
                    </div>

                </div> <!-- end -->
                
			<?php 
			endforeach;
            } ?>
        </div>
    </div>
</div> 
