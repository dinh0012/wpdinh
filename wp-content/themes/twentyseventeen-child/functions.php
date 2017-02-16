<?php
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '-child/assets/css/bootstrap.css');
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

}
function sidbar_init() {
    register_sidebar( array(
        'name'          => __( 'Header', 'twentyseventeen-child' ),
        'id'            => 'sidebar-header',
        'description'   => __( 'Add widgets here to appear in your Header.', 'twentyseventeen-child' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'sidbar_init' );

//****************THEM CSS JS************************

function admin_styles()
{
    wp_register_style('admin_css', get_theme_file_uri() . '/assets/css/admin.css');
    wp_enqueue_style('admin_css');
    /*wp_register_style('bootstrap_3', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap_3');*/
}

function script_settup()
{
    wp_register_script('js_admin', get_theme_file_uri() . '/assets/js/admin.js', array('jquery'), '2.1.2', true);
    wp_enqueue_script('js_admin');
  wp_register_script('jquery_1.9', 'http://code.jquery.com/jquery-1.9.1.js');
    wp_enqueue_script('jquery_1.9');
    /*   wp_register_script('bootstrap_3_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js');
     wp_enqueue_script('bootstrap_3_js');
     wp_register_script('my_script', get_theme_file_uri() . '/assets/js/myScript.js');
     wp_enqueue_script('my_script');*/
}

add_action('admin_enqueue_scripts', 'script_settup');
add_action('admin_enqueue_scripts', 'admin_styles');
//****************END************************


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
        'taxonomies' => array('loai-san-pham', 'post_tag'), //Các taxonomy được phép sử dụng để phân loại nội dung
        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
        'public' => true, //Kích hoạt post type
        //'show_ui' => true, //Hiển thị khung quản trị như Post/Page
        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
        'menu_icon' => get_template_directory_uri() . '/edit1.png', //Đường dẫn tới icon sẽ hiển thị
        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
        'capability_type' => 'post' //
    );

    register_post_type('sanpham', $args); //Tạo post type với slug tên là sanpham và các tham số trong biến $args ở trên

}

add_action('init', 'tao_custom_post_type');
function tao_taxonomy()
{

    /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
     */
    $labels = array(
        'name' => 'Các loại sản phẩm',
        'singular' => 'Loại sản phẩm',
        'menu_name' => 'Loại sản phẩm',
        'add_new_item' => 'Thêm loại sản phẩm'
    );

    /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
     */
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        //'capabilities'                  =>['edit_terms'=>'aaaaaa']
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('loai-san-pham', 'sanpham', $args);
}

// Hook into the 'init' action
add_action('init', 'tao_taxonomy', 0);


add_filter('pre_get_posts', 'lay_custom_post_type');
function lay_custom_post_type($query)
{
    if (is_home() && $query->is_main_query())
        $query->set('post_type', array('post', 'sanpham'));
    return $query;
}

add_action('add_meta_boxes', 'add_your_fields_meta_box');
function add_your_fields_meta_box()
{
    add_meta_box(
        'meta_box', // $id
        'Your Fields', // $title
        'form', // $callback
        'sanpham', // $screen
        'normal', // $context
        'high' // $priority
    );
    add_meta_box('woocommerce-product-images', 'Thư Viện Ảnh', 'output', 'sanpham', 'side', 'low');
}

function output($post)
{
    ?>
    <div id="product_images_container">
        <ul class="product_images">
            <?php
            if (metadata_exists('post', $post->ID, 'image_gallery')) {
                $product_image_gallery = get_post_meta($post->ID, 'image_gallery', true);
            } else {
                // Backwards compat
                $attachment_ids = get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_exclude_image&meta_value=0');
                $attachment_ids = array_diff($attachment_ids, array(get_post_thumbnail_id()));
                $product_image_gallery = implode(',', $attachment_ids);
            }

            $attachments = array_filter(explode(',', $product_image_gallery));
            $update_meta = false;
            $updated_gallery_ids = array();

            if (!empty($attachments)) {
                foreach ($attachments as $attachment_id) {
                    $attachment = wp_get_attachment_image($attachment_id, 'thumbnail');
                    // if attachment is empty skip
                    if (empty($attachment)) {
                        $update_meta = true;
                        continue;
                    }

                    echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__('Delete image', 'woocommerce') . '">' . __('Delete', 'woocommerce') . '</a></li>
								</ul>
							</li>';

                    // rebuild ids to be saved
                    $updated_gallery_ids[] = $attachment_id;
                }

                // need to update product meta to set new gallery ids
                if ($update_meta) {
                    update_post_meta($post->ID, 'image_gallery', implode(',', $updated_gallery_ids));
                }
            }
            ?>
        </ul>
        <input type="hidden" id="product_image_gallery" name="image_gallery"
               value="<?php echo esc_attr($product_image_gallery); ?>"/>

    </div>
    <p class="add_product_images hide-if-no-js">
        <a href="#" data-choose="<?php esc_attr_e('Add Images to Product Gallery', 'woocommerce'); ?>"
           data-update="<?php esc_attr_e('Add to gallery', 'woocommerce'); ?>"
           data-delete="<?php esc_attr_e('Delete image', 'woocommerce'); ?>"
           data-text="<?php esc_attr_e('Delete', 'woocommerce'); ?>"><?php _e('Add product gallery images', 'woocommerce'); ?></a>
    </p>

    <?php
}

function form($post)
{

    echo '<div class="ks-mb-data">';
    // Phần tử form Book Title
    $inputID = '';
    $inputValue = get_post_meta($post->ID, 'title', true);
    //wp_nonce_field(1,  '-nonce');
    $html = '';
    $html .= '<label>Title :</label>';
    $html .= '<input style="width: 99%" type="text" name="title" id="" value="' . $inputValue . '" size="25" />';
    echo $html;

    // Phần tử form Book Price
    $inputID = '';
    $inputValue = get_post_meta($post->ID, 'price', true);
    $html = '';

    $html .= '<label>Price :</label>';
    $html .= '<input style="width: 99%" type="text" name="price" id="" value="' . $inputValue . '" size="25" />';
    echo $html;
    // Phần tử form Book Author
    $inputID = '';
    $inputValue = get_post_meta($post->ID, 'author', true);
    $html = '';
    $html .= '<label>Author :</label>';
    $html .= '<input style="width: 99%" type="text" name="author" value="' . $inputValue . '" size="25" />';
    echo $html;

    // Phần tử form Book Title
    $inputID = '';
    $inputValue = '';
    $inputValue = get_post_meta($post->ID, 'information', true);
    $html = '';
    $html .= '<label>Infomation :</label>';
    $html .= '<textarea style="width: 99%" name="information" id="" rows="6" cols= "50">' . $inputValue . '</textarea>';
    echo $html;

    echo '</div>';
}

add_action('save_post', 'save');
function save($post_id)
{
    $postVal = $_POST;
    if ($postVal) {
        // Đưa dữ liệu vào table wp_postmeta
        update_post_meta($post_id, 'image_gallery',
            sanitize_text_field($postVal['image_gallery']));
        update_post_meta($post_id, 'title',
            sanitize_text_field($postVal['title']));
        update_post_meta($post_id, 'price',
            sanitize_text_field($postVal['price']));
        update_post_meta($post_id, 'author',
            sanitize_text_field($postVal['author']));
        update_post_meta($post_id, 'information',
            strip_tags($postVal['information']));
    }


}


//*******************************************THEME SETTING*****************************************************
function settingMenu()
{
    add_menu_page(
        'Theme Setting',
        'Theme Setting',
        'manage_options',
        'theme-setting',
        'themeSetting'
    );
}

function themeSetting()
{
    include_once 'views/setting_theme.php';
}

add_action('admin_menu', 'settingMenu');
add_action('admin_init', 'register_setting_and_field');
function register_setting_and_field()
{
    register_setting(
        'theme_setting_options',
        'theme_option',
        'validate_setting'
    );

    add_settings_section('set_footer_section', 'Setting Footer', '', 'theme-setting');
    add_settings_section('set_header_section', 'Setting Header', '', 'theme-setting');
    add_settings_field('footer', 'Select Header', 'footer_setting', 'theme-setting', 'set_footer_section');
    add_settings_field('header', '
                            Select Header', 'header_setting', 'theme-setting', 'set_header_section');
}
function validate_setting($data_input)
{
    return $data_input;
}

function header_setting()
{
    $setting_option = get_option('theme_option');
    ?>
    <input type="radio" name="theme_option[header]" <?php echo($setting_option['header'] == 1 ? 'checked' : '') ?>
           value="1">Header 1<br>
    <input type="radio" name="theme_option[header]" <?php echo($setting_option['header'] == 2 ? 'checked' : '') ?>
           value="2">Header 2<br>
    <?php
}

function footer_setting()
{
    $setting_option = get_option('theme_option');
    ?>
    <input type="radio" name="theme_option[footer]" <?php echo($setting_option['footer'] == 1 ? 'checked' : '') ?>
           value="1">Footer 1<br>
    <input type="radio" name="theme_option[footer]" <?php echo($setting_option['footer'] == 2 ? 'checked' : '') ?>
           value="2">Footer 2<br>
    <?php
}

//*************************Woocommerce********************************

function tp_sale_flash( $output ) {
    $output = '<span style="text-decoration: line-through;color: red; class="thachpham">' . __( 'Giảm giá', 'woocommerce' ) . '</span>';
    return $output;
}
add_filter( 'woocommerce_sale_flash', 'tp_sale_flash' );
add_action('xem_ngay','view_now');
function view_now( $output ) {
    $output = '<span style="font-size:18px;font-weight: 600;color: red; class="thachpham">' . __( 'Xem chi tiết', 'woocommerce' ) . '</span>';
    echo $output;
}
function test( $output ) {
    $output = '<span style="font-size:18px;font-weight: 600;color: red; class="thachpham">' . __( 'Xem chi tiết', 'woocommerce' ) . '</span>';
    echo $output;
}
function remove_ac(){
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_title');

}
add_action('init','remove_ac');
add_action('woocommerce_single_product_summary','test',22);

?>


