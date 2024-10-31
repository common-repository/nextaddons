<?php
use \NextAddons\Utilities\Help as Help;

$defult_featured = \Elementor\Utils::get_placeholder_image_src();
?>
<div class="themedev-advance-blog-post-area <?php echo esc_attr($nextaddons_custom_class);?>" >
    <div class="nx-container">
		<div class="nx-row nx-row-1">    

            <?php 
                $posts = isset($post_query->posts) ? $post_query->posts : '';
               
                $main_blog[] = isset($posts[0]) ? $posts[0] : '';

                $first_blog[] = isset($posts[1]) ? $posts[1] : '';
                
                $second_blog[] = isset($posts[2]) ? $posts[2] : '';
                $second_blog[] = isset($posts[3]) ? $posts[3] : '';
            ?>
            <!-- 1st part start-->
            <div class="nx-col-lg-6 nx-col-md-6">
                <div class="nx-row nx-row-1">
                    <div class="nx-col-lg-12">

                        <div class="nxadd-blog-post-wrap block-gradient">
                            <?php if( is_array($main_blog) && !empty($main_blog) ){
                                foreach($main_blog as $v):
                                    if(!isset($v->ID)){
                                        continue;
                                    }
                                    $id = isset($v->ID) ? $v->ID : 0;
                                ?>
                            <div class="nxadd-blog-post-thumbnail">
                                <div class="nxadd-thumb nxfull-blog">
                                    <a href="<?php the_permalink($id); ?>" class="post-image">
                                        <?php  if( has_post_thumbnail($id) ){
                                            $id_fre = get_post_thumbnail_id($id);
                                            echo wp_get_attachment_image( $id_fre, $thumbnail_size, '', ['class' => 'thumb-img']);
                                        }else{?>
                                            <img src="<?php echo esc_url( $defult_featured);?>" class="thumb-img" alt="">
                                        <?php }?>    
                                        </a>
                                    <div class="nxadd-background-overlay"></div>
                                </div>
                            
                                <?php if($nextaddons_advanceblog_categories_enable == 'yes'){?>
                                <span class="post-cat post-category">
                                    <?php if($nextaddons_advanceblog_categories_icon == 'yes'){
                                            if( isset($nextaddons_advanceblog_categories_icon_select) ){
                                            if($nextaddons_advanceblog_categories_icon_select['library'] == 'svg' || isset($nextaddons_advanceblog_categories_icon_select['value']['url'])){
                                                \Elementor\Icons_Manager::render_icon( $nextaddons_advanceblog_categories_icon_select, [ 'aria-hidden' => 'true'] );
                                            }else{
                                                ?>
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_advanceblog_categories_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_advanceblog_categories_icon_select['library']);?>"></i>	
                                                <?php
                                            }
                                        }else{
                                        ?><i class="nx-icon nx-icon-folder"></i> 
                                        <?php }
                                        }?>
                                <?php 
                                    $seperator = !empty( trim($nextaddons_advanceblog_categories_seperator) ) ? $nextaddons_advanceblog_categories_seperator : ' | ';
                                    echo get_the_category_list( $seperator, '', $id ); ?>
                                </span>
                                <?php }?>

                                <div class="nxadd-blog-post-content">
                                <?php if($nextaddons_advanceblog_title_enable == 'yes'){?>  
                                    <<?php echo $nextaddons_advanceblog_title_tag;?> class="nxadd-post-title fz-large <?php echo esc_attr($animation_title);?>">
                                        <a href="<?php the_permalink($id); ?>" >
                                            <?php 
                                            $ext = '';
                                            if(strlen(get_the_title($id)) >= $nextaddons_advanceblog_title_limit){
                                                $ext = $nextaddons_advanceblog_title_limit_symbol;
                                            }
                                            if($nextaddons_advanceblog_title_limit_by == 'word'){
                                                echo wp_trim_words( get_the_title($id), $nextaddons_advanceblog_title_limit, $nextaddons_advanceblog_title_limit_symbol );
                                            }else{
                                                echo substr( get_the_title($id), 0, $nextaddons_advanceblog_title_limit) . $ext; 
                                            }
                                        
                                            ?>
                                        </a>
                                    </<?php echo $nextaddons_advanceblog_title_tag;?>>
                                    <?php }?> 
                                    <div class="nxadd-meta-list">
                                        <?php if($nextaddons_advanceblog_date_enable == 'yes'){?><span class="meta-data"> 
                                            <?php if($nextaddons_advanceblog_date_icon == 'yes'){
                                                if( isset($nextaddons_advanceblog_date_icon_select) ){
                                                    if($nextaddons_advanceblog_date_icon_select['library'] == 'svg' || isset($nextaddons_advanceblog_date_icon_select['value']['url'])){
                                                        \Elementor\Icons_Manager::render_icon( $nextaddons_advanceblog_date_icon_select, [ 'aria-hidden' => 'true'] );
                                                    }else{
                                                        ?>
                                                        <i class="nextaddons-icon <?php echo esc_attr($nextaddons_advanceblog_date_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_advanceblog_date_icon_select['library']);?>"></i>	
                                                        <?php
                                                    }
                                                }else{
                                                ?>
                                                    <i class="nx-icon nx-icon-calendar"></i> 
                                            <?php }
                                            }?> 
                                        <?php echo esc_html( get_the_date( $nextaddons_advanceblog_date_format, $id ) ); ?></span>
                                        <?php }?> 
                                    </div>
                                </div>

                            </div>
                            <?php 
                                endforeach;
                            }else{
                                echo esc_html__('Please insert new posts', 'next-addons');
                            }?>
                        </div>

                    </div>
                </div>
            </div>
            <!-- 1st part end-->

            <!-- 2nd part start-->
            <div class="nx-col-lg-6 nx-col-md-6">
                <div class="nx-row nx-row-1">
					<div class="nx-col-lg-12"> 

                        <div class="nxadd-blog-post-wrap block-gradient">
                            <?php if( is_array($first_blog) && !empty($first_blog) ){
                                foreach($first_blog as $v):
                                    if(!isset($v->ID)){
                                        continue;
                                    }
                                    $id = isset($v->ID) ? $v->ID : 0;
                                ?>
                            <div class="nxadd-blog-post-thumbnail">
                                <div class="nxadd-thumb  nxsmall-blog">
                                
                                    <a href="<?php the_permalink($id); ?>" class="post-image">
                                    <?php  if( has_post_thumbnail($id) ){
                                            $id_fre = get_post_thumbnail_id($id);
                                            echo wp_get_attachment_image( $id_fre, $thumbnail_size, '', ['class' => 'thumb-img']);
                                        }else{?>
                                            <img src="<?php echo esc_url( $defult_featured);?>" class="thumb-img" alt="">
                                    <?php }?>    
                                    </a>
                                    <div class="nxadd-background-overlay"></div>
                                </div>
                                <?php if($nextaddons_advanceblog_categories_enable == 'yes'){?>
                                <span class="post-cat post-category">
                                    <?php if($nextaddons_advanceblog_categories_icon == 'yes'){
                                            if( isset($nextaddons_advanceblog_categories_icon_select) ){
                                            if($nextaddons_advanceblog_categories_icon_select['library'] == 'svg' || isset($nextaddons_advanceblog_categories_icon_select['value']['url'])){
                                                \Elementor\Icons_Manager::render_icon( $nextaddons_advanceblog_categories_icon_select, [ 'aria-hidden' => 'true'] );
                                            }else{
                                                ?>
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_advanceblog_categories_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_advanceblog_categories_icon_select['library']);?>"></i>	
                                                <?php
                                            }
                                        }else{
                                        ?><i class="nx-icon nx-icon-folder"></i> 
                                        <?php }
                                        }?>
                                <?php 
                                    $seperator = !empty( trim($nextaddons_advanceblog_categories_seperator) ) ? $nextaddons_advanceblog_categories_seperator : ' | ';
                                    echo get_the_category_list( $seperator, '', $id ); ?>
                                </span>
                                <?php }?>

                                <div class="nxadd-blog-post-content">
                                    <?php if($nextaddons_advanceblog_title_enable == 'yes'){?>  
                                    <<?php echo $nextaddons_advanceblog_title_tag;?> class="nxadd-post-title">
                                        <a href="<?php the_permalink($id); ?>">
                                            <?php 
                                            $ext = '';
                                            if(strlen(get_the_title($id)) >= $nextaddons_advanceblog_title_limit){
                                                $ext = $nextaddons_advanceblog_title_limit_symbol;
                                            }
                                            if($nextaddons_advanceblog_title_limit_by == 'word'){
                                                echo wp_trim_words( get_the_title($id), $nextaddons_advanceblog_title_limit, $nextaddons_advanceblog_title_limit_symbol );
                                            }else{
                                                echo substr( get_the_title($id), 0, $nextaddons_advanceblog_title_limit) . $ext; 
                                            }
                                        
                                            ?>
                                        </a>
                                    </<?php echo $nextaddons_advanceblog_title_tag;?>>
                                    <?php }?>    
                                
                                    <div class="nxadd-meta-list">
                                        <?php if($nextaddons_advanceblog_date_enable == 'yes'){?><span class="meta-data"> 
                                        <?php if($nextaddons_advanceblog_date_icon == 'yes'){
                                            if( isset($nextaddons_advanceblog_date_icon_select) ){
                                                if($nextaddons_advanceblog_date_icon_select['library'] == 'svg' || isset($nextaddons_advanceblog_date_icon_select['value']['url'])){
                                                    \Elementor\Icons_Manager::render_icon( $nextaddons_advanceblog_date_icon_select, [ 'aria-hidden' => 'true'] );
                                                }else{
                                                    ?>
                                                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_advanceblog_date_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_advanceblog_date_icon_select['library']);?>"></i>	
                                                    <?php
                                                }
                                            }else{
                                            ?>
                                                <i class="nx-icon nx-icon-calendar"></i> 
                                        <?php }
                                        }?> 
                                        <?php echo esc_html( get_the_date( $nextaddons_advanceblog_date_format, $id ) ); ?></span>
                                        <?php }?>    
                                
                                    </div>

                                </div>
                            </div>
                            <?php 
                                endforeach;
                                }else{
                                echo esc_html__('Please insert new posts', 'next-addons');
                            }?>
                        
                        </div>

                    </div>

                    <!-- 3rd part start-->
                    <?php if( is_array($second_blog) && !empty($second_blog) ){
                            foreach($second_blog as $v):
                                if(!isset($v->ID)){
                                    continue;
                                }
                                $id = isset($v->ID) ? $v->ID : 0;
                            ?>
                    <div class="nx-col-lg-6 nx-col-md-6">
                        <div class="nxadd-blog-post-wrap block-gradient">
                           
                            <div class="nxadd-blog-post-thumbnail">
                                <div class="nxadd-thumb  nxsmall-blog">
                                
                                    <a href="<?php the_permalink($id); ?>" class="post-image">
                                    <?php  if( has_post_thumbnail($id) ){
                                            $id_fre = get_post_thumbnail_id($id);
                                            echo wp_get_attachment_image( $id_fre, $thumbnail_size, '', ['class' => 'thumb-img']);
                                        }else{?>
                                            <img src="<?php echo esc_url( $defult_featured);?>" class="thumb-img" alt="">
                                    <?php }?>    
                                    </a>
                                    <div class="nxadd-background-overlay"></div>
                                </div>
                                <?php if($nextaddons_advanceblog_categories_enable == 'yes'){?>
                                <span class="post-cat post-category">
                                    <?php if($nextaddons_advanceblog_categories_icon == 'yes'){
                                            if( isset($nextaddons_advanceblog_categories_icon_select) ){
                                            if($nextaddons_advanceblog_categories_icon_select['library'] == 'svg' || isset($nextaddons_advanceblog_categories_icon_select['value']['url'])){
                                                \Elementor\Icons_Manager::render_icon( $nextaddons_advanceblog_categories_icon_select, [ 'aria-hidden' => 'true'] );
                                            }else{
                                                ?>
                                                <i class="nextaddons-icon <?php echo esc_attr($nextaddons_advanceblog_categories_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_advanceblog_categories_icon_select['library']);?>"></i>	
                                                <?php
                                            }
                                        }else{
                                        ?><i class="nx-icon nx-icon-folder"></i> 
                                        <?php }
                                        }?>
                                <?php 
                                    $seperator = !empty( trim($nextaddons_advanceblog_categories_seperator) ) ? $nextaddons_advanceblog_categories_seperator : ' | ';
                                    echo get_the_category_list( $seperator, '', $id ); ?>
                                </span>
                                <?php }?>

                                <div class="nxadd-blog-post-content">
                                    <?php if($nextaddons_advanceblog_title_enable == 'yes'){?>  
                                    <<?php echo $nextaddons_advanceblog_title_tag;?> class="nxadd-post-title">
                                        <a href="<?php the_permalink($id); ?>">
                                            <?php 
                                            $ext = '';
                                            if(strlen(get_the_title($id)) >= $nextaddons_advanceblog_title_limit){
                                                $ext = $nextaddons_advanceblog_title_limit_symbol;
                                            }
                                            if($nextaddons_advanceblog_title_limit_by == 'word'){
                                                echo wp_trim_words( get_the_title($id), $nextaddons_advanceblog_title_limit, $nextaddons_advanceblog_title_limit_symbol );
                                            }else{
                                                echo substr( get_the_title($id), 0, $nextaddons_advanceblog_title_limit) . $ext; 
                                            }
                                        
                                            ?>
                                        </a>
                                    </<?php echo $nextaddons_advanceblog_title_tag;?>>
                                    <?php }?>    
                                
                                    <div class="nxadd-meta-list">
                                        <?php if($nextaddons_advanceblog_date_enable == 'yes'){?><span class="meta-data"> 
                                        <?php if($nextaddons_advanceblog_date_icon == 'yes'){
                                            if( isset($nextaddons_advanceblog_date_icon_select) ){
                                                if($nextaddons_advanceblog_date_icon_select['library'] == 'svg' || isset($nextaddons_advanceblog_date_icon_select['value']['url'])){
                                                    \Elementor\Icons_Manager::render_icon( $nextaddons_advanceblog_date_icon_select, [ 'aria-hidden' => 'true'] );
                                                }else{
                                                    ?>
                                                    <i class="nextaddons-icon <?php echo esc_attr($nextaddons_advanceblog_date_icon_select['value']);?>" aria-hidden="true" data-library="<?php echo esc_attr($nextaddons_advanceblog_date_icon_select['library']);?>"></i>	
                                                    <?php
                                                }
                                            }else{
                                            ?>
                                                <i class="nx-icon nx-icon-calendar"></i> 
                                        <?php }
                                        }?> 
                                        <?php echo esc_html( get_the_date( $nextaddons_advanceblog_date_format, $id ) ); ?></span>
                                        <?php }?>    
                                
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <?php 
                        endforeach;
                        }else{
                        echo esc_html__('Please insert new posts', 'next-addons');
                    }?>
                    <!-- 3rd part end-->
                
                </div>
            </div>  
            <!-- 2nd part end-->

            
        </div>
    </div>
</div> 