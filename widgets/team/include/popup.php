<?php if($nextaddons_team_popup_enable == 'yes'): ?>
    <div class="nx-popup">	
        <div class="nx-popup-container">
            <div class="nxadd-team-popup">
                <div class="team-popup-container">
                    <div class="nx-modal-popup">
                        <div class="team-popup-wrap">
                            <?php
                            if($nextaddons_team_photos_enable == 'yes'){
                            ?>
                            <div class="nxadd-popup-team-image">
                                <div class="nx-modal-img">
                                <?php
                                    if($id != '' || $id != 0){
                                        echo wp_get_attachment_image( $id, $thumbnail_photos_size , '', ['class' => 'authorteam-img']);
                                    }else{
                                    ?>
                                        <img class="authorteam-img" src="<?php echo esc_url($url);?>" alt="">
                                    <?php }?>
                                </div>
                            </div>
                            <?php }?>

                            <div class="nxadd-modal-content">
                                <div class="nx-popup-content">
                                    <div class="nx-popup-header">
                                        <?php if($nextaddons_team_name_enable == 'yes' && !empty($name) ):?>
                                        <h2 class="person-title"> <?php echo esc_html($name);?></h2>
                                        <?php endif;?>
                                        <?php if($nextaddons_team_designation_enable == 'yes' && !empty($designation) ):?>
                                        <span class="perosn-designation"><?php echo esc_html($designation);?></span>
                                        <?php endif;?>
                                    </div>
                                    <div class="nx-popup-body">
                                    <?php if($nextaddons_team_overview_enable == 'yes' && !empty($overview) ):?>
                                        <p class="profile-des">
                                            <?php echo $overview;?>    
                                        </p>
                                        <?php endif;?>
                                    </div>

                                    <div class="nx-popup-footer">
                                        <ul class="nx-person-info">
                                            <?php if( !empty($phone) ){?>
                                            <li><strong>Phone:</strong><a href="tel:<?php echo $phone;?>"> <?php echo $phone;?></a></li>
                                            <?php }?>
                                            <?php if( !empty($email) ){?>
                                            <li><strong>Email:</strong><a href="mailto:<?php echo $email;?>"> <?php echo $email;?></a></li>
                                            <?php }?>
                                        </ul>
                                        <ul class="nxadd-social nxaddon-social-colored round">
                                            <?php if( !empty($fb) ){?>
                                            <li><a href="https://www.facebook.com/<?php echo $fb;?>/" target="_blank" class="facebook"><i class="nx-icon nx-icon-facebook"></i></a></li>
                                            <?php }?>
                                            <?php if( !empty($tw) ){?>
                                            <li><a href="https://twitter.com/<?php echo $tw;?>/" target="_blank" class="twitter"><i class="nx-icon nx-icon-twitter"></i></a></li>
                                            <?php }?>
                                            <?php if( !empty($link) ){?>
                                            <li><a href="https://linkedin.com/in/<?php echo $link;?>/" target="_blank" class="linkedin"><i class="nx-icon nx-icon-linkedin"></i></a></li>
                                            <?php }?>
                                            <?php if( !empty($in) ){?>
                                            <li><a href="https://instagram.com/<?php echo $in;?>/" target="_blank" class="instagram"><i class="nx-icon nx-icon-instagram"></i></a></li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php endif;?> <!--popup-->