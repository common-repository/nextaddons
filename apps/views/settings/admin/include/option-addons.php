<form action="<?php echo esc_url(admin_url().'admin.php?page=nextaddons&tab=widgets');?>" name="setting_addons_form" method="post" id="nextaddons-widgets">
	<div class="section-addons addons-default">
		<div class="nxadd-import-layouts">
			<h1><?php echo esc_html__('GLOBAL CONTROL', 'next-addons');?></h1>
			<p class="sub-headding"> <?php echo esc_html__(' Use the Buttons to Activate or Deactivate all the Elements of Next Addons at once.', 'next-addons');?></p>
			<div class="nxadd-btn-group">
				<button type="button" class="nxadd-btn nxadd-btn-control-enable">Enable All</button>
				<button type="button" class="nxadd-btn nxadd-btn-control-disable">Disable All</button>
			</div>
		</div>
		<div class="next-addons-services addons-wrapper">
			<h3>Content Elements</h3>
			<div class="nx-row">
				<?php
					if(is_array($widgets) && isset($widgets)){
						foreach( $widgets as $k=>$v ):
							$files = $this->_get_widgets_dir($k, $v);
							if(file_exists( $files )){
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
								<input type="checkbox" onclick="nx_addons_ser_add(this)" name="themedev[addons][<?php echo $k;?>][ebable]" <?php echo isset($getServices['addons'][$k]) || empty($getServices) ? 'checked' : ''; ?> class="nextaddons-switch-input next-addons-event-enable" value="Yes" id="nextaddons-<?php echo $k;?>_addons_data"/>
								<label class="nextaddons-checkbox-switch" for="nextaddons-<?php echo $k;?>_addons_data">
									<?php echo esc_html__($name, 'next-addons');?>
									<div class="nxaddons-info-link">
										<a class="nxaddons-demo-link" href="http://nextaddons.themedev.net/<?php echo $link;?>" target="_blank">
											<i class="nx-icon nx-icon-desktop"></i>
											<span class="nxaddons-info-tooltip">Click and view demo</span>
										</a>
									</div>
									<span class="nextaddons-label-switch" data-active="ON" data-inactive="OFF"></span>
								</label>
							</div>
						</div>
					<?php	
							}
						endforeach;
					}
				?>
			</div>
		</div>
	</div>
	
	<div class="section-addons <?php echo esc_attr('themeDev-form');?>">
		<button type="submit" name="themedev-addons-submit" class="button nxadd-save-button"> <?php echo esc_html__('Save Setting', 'next-addons');?></button>
	</div>
</form>

