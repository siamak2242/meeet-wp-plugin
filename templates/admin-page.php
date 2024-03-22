<div data-admin-ajax="<?php echo admin_url('admin-ajax.php') ?>"></div>

<div id="meeet-loading-page"><span></span></div>

<div id="meeet-admin-page">
    <div class="title">تنظیمات <span class="__head">میییت</span></div>
    <div class="main-tabbox" data-lib-tabbing-el="root" data-lib-tabbing-default="0">
        <div class="buttons" data-lib-tabbing-el="buttons">
            <button data-lib-tabbing-el="button">عمومی</button>
            <button data-lib-tabbing-el="button">تنظیمات المنتور</button>
            <button data-lib-tabbing-el="button">ویجت&zwnj;های المنتور</button>
        </div>
        <div class="contents" data-lib-tabbing-el="contents">
            <div class="content" data-lib-tabbing-el="content">
                <?php include __DIR__ . "/admin-tabs/public.php" ?>
            </div>
            <div class="content" data-lib-tabbing-el="content">
                <?php include __DIR__ . "/admin-tabs/elementor-settings.php" ?>

            </div>
            <div class="content" data-lib-tabbing-el="content">
                <?php include __DIR__ . "/admin-tabs/elementor-widgets.php" ?>
            </div>
        </div>
    </div>
</div>