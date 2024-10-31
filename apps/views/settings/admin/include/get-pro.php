<div class="section-addons addons-pro">
	<div class="nxadd-feature-section">
        <div class="feature-container">
            <div class="feature-addons-bannar">
               <img src="<?php echo esc_url('https://themedev.net/ads/attach/next-addons-banner.jpg'); ?>" alt="Banner">
            </div>
        </div>
    </div>	
	<h3><?php echo esc_html__('Next Addons (PRO)', 'next-addons');?></h3>
	<div class="nxadd-pro-features">
		<div class="nx-row nxadd-content-inner">
			<div class="nx-col-lg-6">
				<div class="nxadd-admin-wrapper">
                    <div class="nxadd-admin-block">
                        <div class="nxadd-admin-header">
                            <div class="nxadd-admin-header-icon">
                                <i class="nx-icon nx-icon-file-text-o"></i>
                            </div>
							<h4 class="nxadd-admin-header-title">Header Footer Builder</h4>
							<p>Header & Footer builder of Next Addons plugins allows you to create a layout with Elementor and set it as a header/footer or use as a custom block easily on your website.</p>
                        </div>
                    </div>
                   
                </div>
			</div>
			<div class="nx-col-lg-6">
				<div class="feature-addons-bannar nx-pt-lt">
					<img src="<?php echo esc_url('https://themedev.net/ads/attach/header-fotter.png'); ?>" alt="Header">
				</div>
			</div>
		</div>
		<div class="nx-row nxadd-content-inner">
			<div class="nx-col-lg-6">
				<div class="feature-addons-bannar">
					<img src="<?php echo esc_url('https://themedev.net/ads/attach/mega-menu.png'); ?>" alt="MegaMenu">
				</div>
			</div>
			<div class="nx-col-lg-6">
				<div class="nxadd-admin-wrapper nx-pt-lt">
                    <div class="nxadd-admin-block">
                        <div class="nxadd-admin-header">
                            <div class="nxadd-admin-header-icon">
                                <i class="nx-icon nx-icon-file-text-o"></i>
                            </div>
							<h4 class="nxadd-admin-header-title">Build megamenu content</h4>
							<p>If you concerned about building a outstanding Mega Menu to your website then Mega Menu builder of Next Addons will be your ultimate solution.You can use Mega Menu incredibly stunning navigation menus for your website.</p>
                        </div>
                    </div>
                   
                </div>
			</div>
			
		</div>
	</div>
	<div class="next-addons-services nx-pro">
		<h3 class="nxadd-pro-feature">PRO Features</h3>
		<div class="nx-row nxadd-content-inner nx-inner-pt-0">
			<?php
				if(is_array($widget) && isset($widget)){
					foreach( $widget as $k=>$v ):
						
							$name = isset($v['name']) ? $v['name'] : $k;
							$type = isset($v['type']) ? $v['type'] : '';
							$cate = isset($v['cate']) ? $v['cate'] : '';
							$link = isset($v['link']) ? $v['link'] : '';
				?>
					<div class="<?php echo esc_attr('themeDev-form');?> nx-col-lg-4 nx-col-md-6 nx-col-sm-12">
						<div class="card-shadow <?php echo isset($getServices['addons'][$k]) || empty($getServices) ? 'active' : ''; ?>">
							<?php if( !empty($cate) ){?>
							<sup class="<?php echo esc_attr($cate);?>-widget"> <?php echo strtoupper($cate);?></sup>
							<?php }?>
							<label class="nextaddons-checkbox-switch" for="nextaddons-<?php echo $k;?>_addons_data">
								<?php echo esc_html__($name, 'next-addons');?>
								<div class="nxaddons-info-link">
									<a class="nxaddons-demo-link" href="http://nextaddons.themedev.net/<?php echo $link;?>" target="_blank">
										<i class="nx-icon nx-icon-desktop"></i>
										<span class="nxaddons-info-tooltip">Click and view demo</span>
									</a>
								</div>
								
							</label>
						</div>
					</div>
				<?php	
						
					endforeach;
				}
			?>
		</div>
	</div>
	<div class="nxadd-footer-pro-inner">
		<div class="nx-row ">
			<div class="nx-col-lg-12">
				<h3 class="nxadd-fetaure-pro-title">Get PRO version with exclusive features and widgets.</h3>
				<a href="https://nextaddons.themedev.net/pricing/" target="_blank" class="nxadd-button nx-get-pro">GET PRO</a>
			</div>
		</div>
	</div>
</div>