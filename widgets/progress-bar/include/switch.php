<div class="themDev-element-wraper <?php echo esc_attr($themedev_next_progress_custom_class);?>" >
	<div class="themDev-skillbar-group <?php echo esc_attr($groupClass);?>">
		<div class="themDev-single-skill-bar <?php echo esc_attr($skillClass);?>">
			<div class="content-group">
				<?php if($themedev_next_progress_title_enable == 'yes'):?>
				<div class="skill-bar-content">
					<<?php echo esc_html($themedev_next_progress_title_tag);?> class="<?php echo esc_attr($title_class);?>"><?php echo esc_html($themedev_next_progress_title);?></<?php echo esc_html($themedev_next_progress_title_tag);?>>
				</div>
				<?php endif;?>
				<div class="<?php echo esc_attr($progressClass);?> <?php echo esc_attr($elementorID);?>">
					<div class="nx-skill-progress" nx-progress="<?php echo esc_html($themedev_next_progress_bar_percentage);?>" nx-animation-duration="<?php echo esc_html($themedev_next_progress_bar_duration['size']);?>">
					</div>
				</div>
			</div>
			<?php if($themedev_next_progress_bar_percentage_enable == 'yes'):?>
			<span class="number-percentage-wraper <?php echo esc_attr($percentageClass);?>">
				<span class="nx-progress-counter number-percentage"><?php echo esc_html($themedev_next_progress_bar_percentage);?></span><?php echo esc_html($themedev_next_progress_bar_percentage_symbol);?>
			</span>
			<?php endif;?>
			
		</div>
	</div>
</div>