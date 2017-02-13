
<div class="wrap">
    <h2>My Setting page</h2>
    <p>Đây là trang thiết lập cấu hình plugin Kenshin Setting</p>
    <form method="post" action="options.php" id="kenshin_setting_form" enctype="multipart/form-data" >
        <?php settings_fields('kenshin_setting_options'); ?>
        <?php do_settings_sections('dinh-setting'); ?>
        <p class="submit">
            <input type="submit" name="submit" class="button button-primary" value="Save Changes">
        </p>
    </form>
</div>