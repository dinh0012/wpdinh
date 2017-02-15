<?php

class Contact extends WP_Widget
{
    public function __construct()
    {
        $id_base = 'contact';
        $name = 'Thông tin liên hệ';
        $widget_options = array(
            'description' => 'Thông tin liên hệ'
        );
        parent::__construct($id_base, $name, $widget_options);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title_ct']);
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title . '<hr />';
        }
        if (!empty($instance['name_ct'])) {
            echo '<p>Name: ' . $instance['name_ct'] . '</p> <hr />';
            echo '<p>Email: ' . $instance['email_ct'] . '</p> <hr />';
            echo '<p>Phone: ' . $instance['phone_ct'] . '</p> <hr />';
            echo '<p>Fax: ' . $instance['fax_ct'] . '</p> <hr />';
            echo '<p>Address: ' . $instance['address_ct'] . '</p> <hr />';
        }

        echo $after_widget;

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title_ct'] = strip_tags($new_instance['title_ct']);
        $instance['name_ct'] = strip_tags($new_instance['name_ct']);
        $instance['email_ct'] = strip_tags($new_instance['email_ct']);
        $i=0;
        foreach ($new_instance['phone_ct'] as $phone){
            if($phone == '')
                unset($new_instance['phone_ct'][$i]);
            $i++;
        }
        $phone_ct = implode(',', $new_instance['phone_ct']);
        $instance['phone_ct'] = $phone_ct;
        $instance['fax_ct'] = strip_tags($new_instance['fax_ct']);
        $instance['address_ct'] = strip_tags($new_instance['address_ct']);
        return $instance;
    }

    public function form($instance)
    {
        $nameTitle = $this->get_field_name('title_ct');
        $valTitle = ($instance['title_ct']) ? $instance['title_ct'] : NULL;
        $nameName = $this->get_field_name('name_ct');
        $valName = ($instance['name_ct']) ? $instance['name_ct'] : NULL;
        $nameEmail = $this->get_field_name('email_ct');
        $valEmail = ($instance['email_ct']) ? $instance['email_ct'] : NULL;
        $namePhone = $this->get_field_name('phone_ct');
        $valPhone = ($instance['phone_ct']) ? $instance['phone_ct'] : NULL;
        $phone_array = explode(',', $valPhone);

        $nameFax = $this->get_field_name('fax_ct');
        $valFax = ($instance['fax_ct']) ? $instance['fax_ct'] : NULL;
        $nameAddress = $this->get_field_name('address_ct');
        $valAddress = ($instance['address_ct']) ? $instance['address_ct'] : NULL;
        //Hiển thị form trong option của widget
        var_dump($valPhone);
        ?>
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" id="" name="<?= $nameTitle; ?>" value="<?= $valTitle; ?>"
                   placeholder="Title">
        </div>
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" class="form-control" id="" name="<?= $nameName; ?>" value="<?= $valName; ?>"
                   placeholder="Name">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" class="form-control" id="" name="<?= $nameEmail; ?>" value="<?= $valEmail; ?>"
                   placeholder="Email">
        </div>
        <div class="form-group phone">
            <label for="">Phone </label><i class=" add_phone glyphicon glyphicon-plus-sign icon_add"></i>
            <?php foreach ($phone_array as $phone): ?>
                <div class="input-phone">
                <?php if(!empty($phone)) echo '<span class=" remove_phone glyphicon glyphicon-remove icon_add"></span>' ?>
                <input type="text" class="form-control " id="" name="<?= $namePhone; ?>[]" value="<?= $phone; ?>"
                       placeholder="Phone">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="form-group">
            <label for="">Fax</label>
            <input type="text" class="form-control" id="" name="<?= $nameFax; ?>" value="<?= $valFax; ?>"
                   placeholder="Fax">
        </div>

        <div class="form-group">
            <label for="">Address</label>
            <textarea name="<?= $nameAddress; ?>" id="input" class="form-control"
                      rows="3"><?= $valAddress; ?></textarea>
        </div>
<script>
$('.add_phone').click(function () {
   $('.phone').append('<input type="text" class="form-control" id="" name="<?= $namePhone; ?>[]">');
    //$('.phone').css('background','red');
});
$('.remove_phone').click(function () {
    $(this).parent('.input-phone').remove();

});


</script>
        <?php


    }

}


?>