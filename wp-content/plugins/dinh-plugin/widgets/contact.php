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
        require WIDGET_VIEWS_DIR . '/contact_view.php';
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title_ct'] = strip_tags($new_instance['title_ct']);
        $instance['name_ct'] = strip_tags($new_instance['name_ct']);
        $instance['email_ct'] = strip_tags($new_instance['email_ct']);
        $i = 0;
        foreach ($new_instance['phone_ct'] as $phone) {
            if ($phone == '')
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
        ?>
        <p class="form-group">
            <label for="">Title</label>
            <input type="text" class="widefat" id="" name="<?= $nameTitle; ?>" value="<?= $valTitle; ?>"
                   placeholder="Title">
        </p>
        <p class="form-group">
            <label for="">Name</label>
            <input type="text" class="widefat" id="" name="<?= $nameName; ?>" value="<?= $valName; ?>"
                   placeholder="Name">
        </p>
        <p class="form-group">
            <label for="">Email</label>
            <input type="text" class="widefat" id="" name="<?= $nameEmail; ?>" value="<?= $valEmail; ?>"
                   placeholder="Email">
        </p>
        <div class="form-group phone">
            <label for="">Phone </label>
            <?php foreach ($phone_array as $phone): ?>
                <div class="input-phone">
                    <?php if (!empty($phone)) echo '<span class=" remove_phone dashicons dashicons-no-alt"></span>' ?>
                    <p><input type="text" class="widefat " id="" name="<?= $namePhone; ?>[]" value="<?= $phone; ?>"
                              placeholder="Phone"></p>
                </div>
            <?php endforeach; ?>

        </div>
        <p class="add_phone" style="text-align: center">Add New<span class=" dashicons dashicons-plus"></span></p>
        <p class="form-group">
            <label for="">Fax</label>
            <input type="text" class="widefat" id="" name="<?= $nameFax; ?>" value="<?= $valFax; ?>"
                   placeholder="Fax">
        </p>

        <p class="form-group">
            <label for="">Address</label>
            <textarea name="<?= $nameAddress; ?>" id="input" class="widefat"
                      rows="3"><?= $valAddress; ?></textarea>
        </p>
        <style>
            span.remove_phone.dashicons.dashicons-no-alt {
                position: absolute;
                right: 0;
                cursor: pointer;
            }

            span.remove_phone.dashicons.dashicons-no-alt:hover {
                color: red;
            }

            p.add_phone {
                cursor: pointer;
                border: solid 1px #00a1ff;
            }

            p.add_phone:hover {
                color: red;
            }

            .input-phone {
                position: relative;
            }
        </style>
        <script>
            $('.add_phone').click(function () {
                $('.phone').append('<p><input type="text" class="widefat" id="" placeholder="Phone" name="<?= $namePhone; ?>[]"></p>');

            });
            $('.remove_phone').click(function () {
                $(this).parent('.input-phone').remove();

            });


        </script>
        <?php


    }

}


?>