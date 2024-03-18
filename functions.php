<?php

const _test_version = '1.0.1';

function _meeet_admin_menu()
{
    add_menu_page('MEEET', 'Meeet', 'manage_options', 'meeet', function () {
        include __DIR__ . '/templates/admin-page.php';
    });
}

function _meeet_admin_scripts()
{
    wp_enqueue_style(
        'meeet-admin-page-style',
        plugins_url('/assets/admin/css/admin-menu-page.css?v=' . _test_version, __FILE__)
    );

    wp_enqueue_script(
        'meeet-admin-page-script',
        plugins_url('/assets/admin/css/admin-menu-page.js?v=' . _test_version, __FILE__)
    );

}