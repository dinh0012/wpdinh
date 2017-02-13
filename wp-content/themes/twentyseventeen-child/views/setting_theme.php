
<div class="wrap">
    <h2>My Setting Theme</h2>
    <p>Đây là trang thiết lập cấu hình Theme</p>
    <form method="post" action="options.php" id="kenshin_setting_form" enctype="multipart/form-data" >
        <?php settings_fields('theme_setting_options'); ?>
        <?php do_settings_sections('theme-setting'); ?>
        <p class="submit">
            <input type="submit" name="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>