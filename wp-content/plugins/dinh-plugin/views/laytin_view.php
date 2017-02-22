<div class="wrap">
    <h2>Lấy tin</h2>
    <p>Đây là trang thiết lập cấu hình Theme</p>
    <form method="POST" action="" id="kenshin_setting_form" >
        <p>LINK <input type="text" name="link" placeholder="Link lấy tin" value="<?php echo (isset($_POST['link'])?$_POST['link']:'')?>"></p>
        <p>ELEMENT <input type="text" name="link-element" placeholder="div.example" value="<?php echo (isset($_POST['link-element'])?$_POST['link-element']:'')?>"></p>
        <p class="submit">
            <input type="submit" name="submit" class="button button-primary" value="Lấy Tin">
        </p>
    </form>
    <form method="POST" action="" id="kenshin_setting_form" >
        <p>ELEMENT <input type="text" name="element-content" placeholder="div.example" value="<?php echo (isset($_POST['element-content'])?$_POST['element-content']:'')?>"></p>
        <p class="submit">
            <input type="submit" name="get-content" class="button button-primary" value="Lấy nội dung tin">
        </p>
    </form>
</div>
