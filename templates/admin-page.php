<div id="meeet-admin-page">
    <div class="title">تنظیمات میییت</div>
    <div class="main-tabbox" data-lib-tabbing-root="admin-main-page">
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