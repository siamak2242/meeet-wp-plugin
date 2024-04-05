<?php

const _meeet_elementor_category_id = 'meeet-elementor-category';

function _meeet_elementor_register_category($manager): void
{
    $func = function ($categories) {
        $this->categories = $categories;
    };
    $category = [
        _meeet_elementor_category_id => [
            'title' => meeetOptionHandler->get_option('elementor-settings/_meeet_elementor_category_name'),
        ]
    ];
    $func->call($manager, array_merge($category, $manager->get_categories()));
}

function _meeet_elementor_register_scripts(): void
{
}

function _meeet_elementor_register_widgets($manager): void
{
    $settings = meeetOptionHandler->get_option('elementor-widgets');
    if ($settings['_meeet_elementor_widget_carousel']) {
        require_once __DIR__ . '/widgets/MeeetElementorWidgetCarousel.php';
        $manager->register(new MeeetElementorWidgetCarousel());
    }
}