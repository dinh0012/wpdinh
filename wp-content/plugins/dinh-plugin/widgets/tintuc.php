<?php

class Tintuc extends WP_Widget
{

    public function __construct()
    {
        $id_base = 'tintuc';
        $name = 'Tự Động lấy tin';
        $widget_options = array(
            //'classname' => 'kenshin-wg-css-simple',
            'description' => 'Tự Động lấy tin'
        );
        parent::__construct($id_base, $name, $widget_options);
    }

    public function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if (!empty($title)) {
            echo $before_title . $title . $after_title;
        }
        global $wpdb;
        $prefix = $wpdb->prefix;
        $table_danhmuc = $prefix . 'tintuc_danhmuc';
        $table_baiviet = $prefix . 'tintuc_baiviet';
        $result_danhmuc = $wpdb->get_results("SELECT * FROM $table_danhmuc", OBJECT);

        ?>

        <div class="tintuc">
            <ul class="danhmuc">
                <?php foreach ($result_danhmuc as $danhmuc) {
                    $result_baiviet = $wpdb->get_results("SELECT * FROM $table_baiviet WHERE id_danh_muc = $danhmuc->id  ORDER BY id DESC LIMIT 5 ", OBJECT);
                    ?>

                    <li class="danh-muc">
                        <span class="view"></span><?php echo $danhmuc->ten_danh_muc ?>
                        <ul class="baiviet">
                            <?php foreach ($result_baiviet as $baiviet): ?>
                                <li class="bai-viet">
                                    <!--                                    <div class="image"><img src="<?php /*echo $baiviet->image*/ ?>" width="100" height="100"></div>
-->
                                    <div class="title"><strong><a href="<?php echo  home_url().'?tin-tuc='.$baiviet->id?>"><?php echo $baiviet->ten_bai_viet ?></a></strong></div>
                                    <!--                                    <div class="mota"><?php /*echo $baiviet->mo_ta*/ ?></div>
-->                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <?php
                } ?>
            </ul>
        </div>
        <style>
            li .view:before {
                font-family: Ionicons;
                content: '\f2c7';
                font-weight: 600;
                cursor: pointer;
            }

            li .des:before {
                font-family: Ionicons;
                content: '\f2f4';
                font-weight: 600;
                cursor: pointer;
            }

            li .view, .des {
                float: right;
            }

            ul.baiviet {
                display: none;
            }
        </style>
        <script>
            $('.view').each(function () {
                $(this).click(function () {
                    $(this).parents('.danh-muc').children('.baiviet').toggle(function () {
                        if ($(this).parents('.danh-muc').children('.view').hasClass('view')) {
                            $(this).parents('.danh-muc').children('.view').addClass('des').removeClass('view');
                        }  if ($(this).parents('.danh-muc').children('.view').hasClass('des')) {
                            $(this).parents('.danh-muc').children('.view').addClass('view').removeClass('des');
                        }

                    });
                })
            });
        </script>
        <?php


        echo $after_widget;

    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    public function form($instance)
    {
        $inputID = $this->get_field_id('title');
        $inputName = $this->get_field_name('title');
        $inputValue = @$instance['title'];

        $html = '';
        $html .= '<p>';
        $html .= '<label for=' . $inputID . '>Title :</label>';
        $html .= '<input class="widefat" type="text" name= "' . $inputName . '" id="' . $inputID . '" value = "' . $inputValue . '" size="25" />';
        $html .= '</p>';
        echo $html;

    }

}