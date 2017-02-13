<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

function tao_custom_post_type()
{

    /*
     * Biến $label để chứa các text liên quan đến tên hiển thị của Post Type trong Admin
     */
    $label = array(
        'name' => 'Các sản phẩm', //Tên post type dạng số nhiều
        'singular_name' => 'Sản phẩm' //Tên post type dạng số ít
    );

    /*
     * Biến $args là những tham số quan trọng trong Post Type
     */
    $args = array(
        'labels' => $label, //Gọi các label trong biến $label ở trên
        'description' => 'Post type đăng sản phẩm', //Mô tả của post type
        'supports' => array(
            'title',
            'editor',
         /*   'excerpt',
            'author',*/
            'thumbnail',
            'comments',
          /*  'trackbacks',
            'revisions',
            'custom-fields'*/
        ), //Các tính năng được hỗ trợ trong post type
        'taxonomies' => array( 'loai-san-pham', 'post_tag' ), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        //'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => get_template_directory_uri().'/edit1.png', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );

    register_post_type('sanpham', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên

}
function tao_taxonomy() {

    /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
     */
    $labels = array(
        'name' => 'Các loại sản phẩm',
        'singular' => 'Loại sản phẩm',
        'menu_name' => 'Loại sản phẩm',
        'add_new_item'=>'Thêm loại sản phẩm'
    );

    /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
     */
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        //'capabilities'                  =>['edit_terms'=>'aaaaaa']
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('loai-san-pham', 'sanpham', $args);
}

// Hook into the 'init' action
add_action( 'init', 'tao_taxonomy', 0 );

/* Kích hoạt hàm tạo custom post type */
add_action('init', 'tao_custom_post_type');
add_filter('pre_get_posts','lay_custom_post_type');
function lay_custom_post_type($query) {
    if (is_home() && $query->is_main_query ())
        $query->set ('post_type', array ('post','sanpham'));
    return $query;
}

function add_your_fields_meta_box() {
    add_meta_box(
        'meta_box', // $id
        'Your Fields', // $title
        'form', // $callback
        'sanpham', // $screen
        'normal', // $context
        'high' // $priority
    );
}
add_action('save_post','save');
function save($post_id){
    $postVal = $_POST;
    if($postVal){
        // Đưa dữ liệu vào table wp_postmeta
        update_post_meta($post_id,'title',
            sanitize_text_field($postVal[ 'title']));
        update_post_meta($post_id, 'price',
            sanitize_text_field($postVal[ 'price']));
        update_post_meta($post_id,'author',
            sanitize_text_field($postVal[ 'author']));
        update_post_meta($post_id, 'information',
            strip_tags($postVal['information']));
    }


}
function form($post) {

    echo '<div class="ks-mb-data">';
    // Phần tử form Book Title
    $inputID    = '';
    $inputValue = get_post_meta($post->ID,'title',true);
    //wp_nonce_field(1,  '-nonce');
    $html  = '';
    $html .= '<label>Title :</label>';
    $html .= '<input style="width: 99%" type="text" name="title" id="" value="'.$inputValue.'" size="25" />';
    echo $html;

    // Phần tử form Book Price
    $inputID    = '';
    $inputValue = get_post_meta($post->ID,'price',true);
    $html  = '';

    $html .= '<label>Price :</label>';
    $html .= '<input style="width: 99%" type="text" name="price" id="" value="'.$inputValue.'" size="25" />';
    echo $html;
    // Phần tử form Book Author
    $inputID    = '';
    $inputValue = get_post_meta($post->ID,'author',true);
    $html  = '';
    $html .= '<label>Author :</label>';
    $html .= '<input style="width: 99%" type="text" name="author" value="'.$inputValue.'" size="25" />';
    echo $html;

    // Phần tử form Book Title
    $inputID    = '';
    $inputValue = '';$inputValue = get_post_meta($post->ID,'information',true);   $html  = '';
    $html .= '<label>Infomation :</label>';
    $html .= '<textarea style="width: 99%" name="information" id="" rows="6" cols= "50">'.$inputValue.'</textarea>';
    echo $html;

    echo '</div>';
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );


//*******************************************THEME SETTING*****************************************************
function settingMenu(){
    add_menu_page(
        'Theme Setting',
        'Theme Setting',
        'manage_options',
        'theme-setting',
        'themeSetting'
    );
}
function themeSetting(){
    include_once 'views/setting_theme.php';
}
add_action('admin_menu','settingMenu');
add_action('admin_init', 'register_setting_and_field');
function register_setting_and_field(){
    register_setting(
        'theme_setting_options',
        'theme_option',
        'validate_setting'
    );

    add_settings_section('set_footer_section', 'Setting Footer', '', 'theme-setting');
    add_settings_section('set_header_section', 'Setting Header', '', 'theme-setting');
    add_settings_field('footer','Select Header', 'footer_setting', 'theme-setting','set_footer_section');
    add_settings_field('header','
                            Select Header', 'header_setting', 'theme-setting', 'set_header_section');

}
function validate_setting($data_input){
    return $data_input;
}
function header_setting(){
    $setting_option = get_option('theme_option');
    ?>
    <input type="radio" name="theme_option[header]" <?php echo ($setting_option['header'] ==1 ?  'checked':'')?> value="1">Header 1<br>
    <input type="radio" name="theme_option[header]" <?php echo ($setting_option['header'] ==2 ?  'checked':'')?> value="2">Header 2<br>
    <?php
}
function footer_setting(){
    $setting_option = get_option('theme_option');
    ?>
    <input type="radio" name="theme_option[footer]" <?php echo ($setting_option['footer'] ==1 ?  'checked':'')?> value="1">Footer 1<br>
    <input type="radio" name="theme_option[footer]" <?php echo ($setting_option['footer'] ==2 ?  'checked':'')?> value="2">Footer 2<br>
    <?php
}
?>


