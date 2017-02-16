<?php $name = $instance['name_ct'];
$email = $instance['email_ct'];
$phone = $instance['phone_ct'];
$phone_array = explode(',', $phone);
$add = $instance['address_ct'];
?>


<div class="col-sm-4 right">
    <div class="header-contact right clearfix">
        <div class="well header-block ">
            <span title="Liên hệ"><i  class="ionicon icon-person" style=""></i><?php echo $name ?></span>
            <br>
            <?php foreach ($phone_array as $phone): ?>
                <span title="Số điện thoại"><i class="ionicon icon-phone" style=""></i><?php echo $phone ?></span>
                <br>
            <?php endforeach; ?>
        </div>
        <div class="well header-block right ">
            <span title="Facebook"><i class="ionicon icon-fb" style=""></i><?php echo $email ?></span>
            <br>
            <span title="Youtube"><i  class="ionicon icon-youtube" style=""></i><?php echo $email ?></span>
            <br>
            <span title="Địa chỉ"><i class="ionicon icon-home" style=""></i><?php echo $add ?></span>
        </div>

    </div>
</div>
<!--
<div class="col-sm-4 right">
    <div class="header-contact right clearfix">
        <div class="well header-block ">
            <i class="ionicon icon-person" style=""></i> +(404) 158 14 25 78
            <br>
            <i class="ionicon icon-phone" style=""></i> +(404) 158 14 25 78
            <br>
            <i class="ionicon icon-phone" style=""></i> +(404) 851 21 48 15
        </div>
        <div class="well header-block right ">
            <i class="ionicon icon-fb" style=""></i> venedor_support
            <br>
            <i class="ionicon icon-youtube" style=""></i> venedor_support
            <br>
            <i class="ionicon icon-skype" style=""></i> support@venedor.com
        </div>
    </div>
</div>-->