<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class MeeetElementorWidgetCarousel extends Widget_Base
{
    public function get_name(): string
    {
        return 'meeet-raw-widget';
    }

    public function get_title(): string
    {
        return 'meeet raw widget';
    }

    public function get_icon(): string
    {
        return 'eicon-post';
    }

    public function get_categories(): array
    {
        return [_meeet_elementor_category_id];
    }

    public function get_style_depends(): array
    {
        return [
        ];
    }
    public function get_script_depends(): array
    {
        return [
        ];
    }

    protected function register_controls()
    {
    }

    protected function render()
    {
    }
}