<div class="themDev-element-wraper <?php echo esc_attr($themedev_next_progress_custom_class);?>" >
	<div class="themDev-skillbar-group <?php echo esc_attr($groupClass);?>">
		<div class="themDev-single-skill-bar">
			<?php if($themedev_next_progress_title_enable == 'yes'):?>
			<div class="skill-bar-content">
				<<?php echo esc_html($themedev_next_progress_title_tag);?> class="<?php echo esc_attr($title_class);?>"><?php echo esc_html($themedev_next_progress_title);?></<?php echo esc_html($themedev_next_progress_title_tag);?>>
			</div>
			<?php endif;?>
			<div class="<?php echo esc_attr($progressClass);?> <?php echo esc_attr($elementorID);?>">
				<div class="nx-skill-progress" nx-progress="<?php echo esc_html($themedev_next_progress_bar_percentage);?>" nx-animation-duration="<?php echo esc_html($themedev_next_progress_bar_duration['size']);?>">
					<?php if($themedev_next_progress_bar_percentage_enable == 'yes'):?>
					<span class="number-percentage-wraper">
						<span class="nx-progress-counter number-percentage"></span><?php echo esc_html($themedev_next_progress_bar_percentage_symbol);?>
						<div class="nx-svg-content">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" viewBox="0 0 116 79.6">
								<g> <path d="M0,18.3v21.3C0,49.8,8.2,58,18.3,58h5.9c7.8,0,15.3,3.1,20.8,8.6l13,13l13-13c5.5-5.5,13-8.6,20.8-8.6h5.9 c10.1,0,18.3-8.2,18.3-18.3V18.3C116,8.2,107.8,0,97.7,0H18.3C8.2,0,0,8.2,0,18.3z"></path>
								</g>
							</svg>
						</div>
					</span>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>