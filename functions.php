<?php

function _meeet_admin_menu()
{
    add_menu_page('MEEET', 'Meeet', 'manage_options', 'meeet', function () {
        include __DIR__ . '/templates/admin-page.php';
    });
}