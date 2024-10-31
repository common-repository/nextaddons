<?php 
namespace NextAddons\Apps;

class Next_Widget{

    public function next_init(){
        return false;
    }

    static function get_next_name() {
        return false;
    }

    static function get_next_title() {
        return false;
    }

    static function get_next_icon() {
        return false;
    }
	
	static function get_next_keywords() {
        return false;
    }

    static function get_next_categories() {
        return false;
    }
    
    static function get_next_dir() {
        return false;
    }
    
    static function get_next_url() {
        return false;
    }
    
    public function next_register_api(){
        return false;
    }

    public function next_inline_js(){
        return false;
    }

    public function next_inline_css(){
        return false;
    }
    
    public function next_sass(){
        return false;
    }

    public function next_scripts(){
        return false;
    }
}