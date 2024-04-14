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
    // carousel widget style
    wp_enqueue_style(
        'meeet-elementor-widget-style-carousel',
        plugins_url('../assets/widgets/css/carousel.css?v=' . _test_version, __FILE__)
    );

    // elementor widgets global functions
    wp_enqueue_script(
        'meeet-lib-functions',
        plugins_url('../assets/libs/functions.js?v=' . _test_version, __FILE__)
    );

    // glider library engine
    wp_enqueue_script(
        'meeet-lib-glider-script',
        plugins_url('../assets/libs/glider/glider.min.js', __FILE__)
    );

    // glider library style
    wp_enqueue_style(
        'meeet-lib-glider-style',
        plugins_url('../assets/libs/glider/glider.min.css', __FILE__)
    );
}

function _meeet_elementor_register_widgets($manager): void
{
    $settings = meeetOptionHandler->get_option('elementor-widgets');
    if ($settings['_meeet_elementor_widget_carousel']) {
        require_once __DIR__ . '/widgets/MeeetElementorWidgetCarousel.php';
        $manager->register(new MeeetElementorWidgetCarousel());
    }
}