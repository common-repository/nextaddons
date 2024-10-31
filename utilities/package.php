<?php
namespace NextAddons\Utilities;

defined( 'ABSPATH' ) || exit;
/**
 * 
 * @since 1.0.0
 */

class Package{
	
	
	/**
     * Nx Animation List
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return array Control type.
     */ 
	 public static function nx_animation(){
		
		return self::nx_animation_data();
	 }
	 
	 public static function nx_animation_data(){
		 $anima = [
                'none' => 'None',
				
                'FadeIn' => 'Fade In',
                'FadeInLeft' => 'Fade In Down',
                'FadeInRight' => 'Fade In Left',
                'FadeInTop' => 'Fade In Right',
                'FadeInBottom' => 'Fade In Up',
           
                'MovingBackFromRight' => 'Moving Back From Right',
                'MovingBackFromLeft' => 'Moving Back From Left',
           
                'zoomIn' => 'Zoom In',
                'zoomInDown' => 'Zoom In Down',
                'zoomInLeft' => 'Zoom In Left',
                'zoomInRight' => 'Zoom In Right',
                'zoomInUp' => 'Zoom In Up',
            
                'bounceIn' => 'Bounce In',
                'bounceInDown' => 'Bounce In Down',
                'bounceInLeft' => 'Bounce In Left',
                'bounceInRight' => 'Bounce In Right',
                'bounceInUp' => 'Bounce In Up',
           
                'slideInDown' => 'Slide In Down',
                'slideInLeft' => 'Slide In Left',
                'slideInRight' => 'Slide In Right',
                'slideInUp' => 'Slide In Up',
           
                'rotateIn' => 'Rotate In',
                'rotateInDownLeft' => 'Rotate In Down Left',
                'rotateInDownRight' => 'Rotate In Down Right',
                'rotateInUpLeft' => 'Rotate In Up Left',
                'rotateInUpRight' => 'Rotate In Up Right',
            
                'bounce' => 'Bounce',
                'flash' => 'Flash',
                'pulse' => 'Pulse',
                'rubberBand' => 'Rubber Band',
                'shake' => 'Shake',
                'headShake' => 'Head Shake',
                'swing' => 'Swing',
                'tada' => 'Tada',
                'wobble' => 'Wobble',
                'jello' => 'Jello',
           
                'lightSpeedIn' => 'Light Speed In',
           
                'rollIn' => 'Roll In',
				// text
                'tracking-in-expand' => 'Tracking In Expand',
                'tracking-in-expand-fwd' => 'Tracking In Expand Fwd',
                'tracking-in-expand-fwd-top' => 'Tracking In Expand Fwd Top',
                'tracking-in-expand-fwd-bottom' => 'Tracking In Expand Fwd Bottom',
                'tracking-in-contract' => 'Tracking In Contract',
                'tracking-in-contract-bck' => 'Tracking In Contract Bck',
                'tracking-in-contract-bck-top' => 'Tracking In Contract Bck Top',
                'tracking-in-contract-bck-bottom' => 'Tracking In Contract Bck Bottom',
				
                'tracking-out-contract' => 'Tracking Out Expand',
                'tracking-out-contract-bck' => 'Tracking Out Contract Bck',
                'tracking-out-contract-bck-top' => 'Tracking Out Contract Bck Top',
                'tracking-out-contract-bck-bottom' => 'Tracking Out Contract Bck Bottom',
                'tracking-out-expand' => 'Tracking Out Expand',
                'tracking-out-expand-fwd' => 'Tracking Out Expand Fwd',
                'tracking-out-expand-fwd-top' => 'Tracking Out Expand Fwd Top',
                'tracking-out-expand-fwd-bottom' => 'Tracking Out Expand Fwd Bottom',
				
                'text-focus-in' => 'Text Focus In',
                'focus-in-expand' => 'Focus In Expand',
				
				'vibrate-1' => 'Vibrate',
				'vibrate-2' => 'Vibrate 2',
				'vibrate-3' => 'Vibrate 3',
				'heartbeat' => 'Heartbeat',
				'pulsate-bck' => 'Pulsate Bck',
				'pulsate-fwd' => 'Pulsate Fwd',
				'ping' => 'Ping',
        ];
		return $anima;
     }
     
     public static function _extend_animation(){
        $animations = [
			
			'NX Tracking In' => [
                'nx-tracking-in-expand' => 'Tracking In Expand',
                'nx-tracking-in-expand-fwd' => 'Tracking In Expand Fwd',
                'nx-tracking-in-expand-fwd-top' => 'Tracking In Expand Fwd Top',
                'nx-tracking-in-expand-fwd-bottom' => 'Tracking In Expand Fwd Bottom',
                'nx-tracking-in-contract' => 'Tracking In Contract',
                'nx-tracking-in-contract-bck' => 'Tracking In Contract Bck',
                'nx-tracking-in-contract-bck-top' => 'Tracking In Contract Bck Top',
                'nx-tracking-in-contract-bck-bottom' => 'Tracking In Contract Bck Bottom',
            ],
            
            'NX Tracking Out' => [
                'nx-tracking-out-contract' => 'Tracking Out Expand',
                'nx-tracking-out-contract-bck' => 'Tracking Out Contract Bck',
                'nx-tracking-out-contract-bck-top' => 'Tracking Out Contract Bck Top',
                'nx-tracking-out-contract-bck-bottom' => 'Tracking Out Contract Bck Bottom',
                'nx-tracking-out-expand' => 'Tracking Out Expand',
                'nx-tracking-out-expand-fwd' => 'Tracking Out Expand Fwd',
                'nx-tracking-out-expand-fwd-top' => 'Tracking Out Expand Fwd Top',
                'nx-tracking-out-expand-fwd-bottom' => 'Tracking Out Expand Fwd Bottom',
            ],
            
            'NX Text Focus' => [
                'nx-text-focus-in' => 'Text Focus In',
                'nx-focus-in-expand' => 'Focus In Expand',
            ],
            
            'NX Vibrate' => [
                'nx-vibrate-1' => 'Vibrate',
				'nx-vibrate-2' => 'Vibrate 2',
				'nx-vibrate-3' => 'Vibrate 3',
            ],
            
            'NX Heartbeat' => [
                'nx-heartbeat' => 'Heartbeat',
            ],
            
            'NX Pulsate' => [
                'nx-pulsate-bck' => 'Pulsate Bck',
				'nx-pulsate-fwd' => 'Pulsate Fwd',
				'nx-hotspot-pulse-break-1' => 'Pulsate Break',
				'nx-pulse-red-1' => 'Pulsate Red',
				'nx-pulse-dotted-1' => 'Pulsate Dotted',
				'nx-pulse-white-1' => 'Pulsate White',
				'nx-pulse-default-1' => 'Pulsate Default',
            ],
            
            'NX Ping' => [
                'nx-ping' => 'Ping',
			],
        ];
        return apply_filters( 'nextaddons_animation_extend', $animations );
     }


	 public static function nx_timing(){
		  $anima = [
                'linear' => 'Linear',
                'easeIn' => 'easeIn',
                'easeOut' => 'easeOut',
                'easeInOut' => 'easeInOut',
                'easeInQuad' => 'easeInQuad',
                'easeInCubic' => 'easeInCubic',
                'easeInQuart' => 'easeInQuart',
                'easeInQuint' => 'easeInQuint',
                'easeInSine' => 'easeInSine',
                'easeInExpo' => 'easeInExpo',
                'easeInCirc' => 'easeInCirc',
                'easeInBack' => 'easeInBack',
                'easeOutQuad' => 'easeOutQuad',
                'easeOutCubic' => 'easeOutCubic',
                'easeOutQuart' => 'easeOutQuart',
                'easeOutQuint' => 'easeOutQuint',
                'easeOutSine' => 'easeOutSine',
                'easeOutExpo' => 'easeOutExpo',
                'easeOutCirc' => 'easeOutCirc',
                'easeOutBack' => 'easeOutBack',
                'easeInOutQuad' => 'easeInOutQuad',
                'easeInOutCubic' => 'easeInOutCubic',
                'easeInOutQuart' => 'easeInOutQuart',
                'easeInOutQuint' => 'easeInOutQuint',
                'easeInOutSine' => 'easeInOutSine',
                'easeInOutExpo' => 'easeInOutExpo',
                'easeInOutCirc' => 'easeInOutCirc',
                'easeInOutBack' => 'easeInOutBack',
  
			];
		return apply_filters('nextaddons_animation_timing', $anima);
	 }
	 
}