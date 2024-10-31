<?php 
namespace NextAddons\Modules\Controls;

defined( 'ABSPATH' ) || exit;
use \NextAddons\Modules\Controls\Init as Init;

class Imageselect extends \Elementor\Base_Data_Control {

	public function get_type() {
		return 'imageselect';
	}
    
	
	public function enqueue() {
		wp_register_style( 'nextaddons-imagechoose', Init::_get_url() . 'assets/css/imagechoose.css',  false, Init::_version() );
        
        wp_register_script( 'nextaddons-imagechoose-js', Init::_get_url() . 'assets/js/imagechoose.js',  false, Init::_version() );

		// styles
		wp_enqueue_style( 'nextaddons-imagechoose' );

		// script
		wp_enqueue_script( 'nextaddons-imagechoose-js' );
	}

	
	public function content_template() {
		$control_uid = $this->get_control_uid( '{{value}}' );
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<div class="elementor-image-choices">
					<# _.each( data.options, function( options, value ) { #>
					<div class="image-choose-label-block" 
					style="width:{{ options.width }}">
						<input id="<?php echo esc_attr($control_uid); ?>" type="radio" name="elementor-choose-{{ data.name }}-{{ data._cid }}" value="{{ value }}">
						<label class="elementor-image-choices-label" for="<?php echo esc_attr($control_uid); ?>" title="{{ options.title }}">
							<img class="imagesmall" src="{{ options.imagesmall }}" alt="{{ options.title }}" />
							<span class="imagelarge">
								<img src="{{ options.imagelarge }}" alt="{{ options.title }}" />
							</span>
							<span class="elementor-screen-only">{{{ options.title }}}</span>
						</label>
					</div>
					<# } ); #>
				</div>
			</div>
		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

	protected function get_default_settings() {
		return [
			'label_block' => true,
			'options' => []
		];
	}
}