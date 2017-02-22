<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$setting_option = get_option('theme_option');
//get_header($setting_option['header']);
get_template_part('header/header-' . $setting_option['header']); ?>

<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action('woocommerce_before_main_content');
?>

<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

    <h1 class="page-title">Sản phẩm mới nhất</h1>

<?php endif; ?>

<?php

$arr = [

    'post_type' => [
        'my-post-type' => 'product'
    ],
    'posts_per_page' => 24,
    'orderby'=>'ID'
];
$wp_query = new WP_Query($arr);
/**
 * woocommerce_archive_description hook.
 *
 * @hooked woocommerce_taxonomy_archive_description - 10
 * @hooked woocommerce_product_archive_description - 10
 */
do_action('woocommerce_archive_description');
?>

<?php if (have_posts()) : ?>

    <?php
    /**
     * woocommerce_before_shop_loop hook.
     *
     * @hooked woocommerce_result_count - 20
     * @hooked woocommerce_catalog_ordering - 30
     */
    do_action('woocommerce_before_shop_loop');
    ?>

    <?php woocommerce_product_loop_start(); ?>

    <?php woocommerce_product_subcategories(); ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php $j = 0;
            while (have_posts()) : the_post(); ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <?php if ($j % 4 == 0): ?>
                <div class="item <?php echo($j == 0 ? 'active' : '') ?>">
                    <?php endif; ?>
                    <div class="col-sm-3">
                        <div class="carousel-image">
                            <a class="post" href="<?php the_permalink() ?>">
                                <?php woocommerce_template_loop_product_thumbnail() ?>
                            </a>
                        </div>
                        <div class="carousel-more">

                                <span class="title">
                                      <a class="link-title" href="<?php the_permalink() ?>">
                                    <?php woocommerce_template_loop_product_title(); ?>
                                          </a>
                            </span>

                            <?php woocommerce_show_product_loop_sale_flash() ?>
                            <span class="price"><?php woocommerce_template_loop_price() ?></span>
                            <span class="add_card"><?php woocommerce_template_loop_add_to_cart() ?></span>

                        </div>
                    </div>

                    <?php if ($j % 4 == 3): ?>
                </div>
            <?php endif; ?>
                <?php //wc_get_template_part('content', 'product');
                $j++; ?>
                <?php echo $i ?>

            <?php endwhile; // end of the loop. ?>
        </div>
        <style>
            span.title:hover {
                background: #00A8EF;
            }

            span.price {
                display: block;
                padding-top: 10px;
                padding-bottom: 10px;
            }

            span.title {
                margin-top: 20px;
                display: block;
                min-height: 60px;
            }

            .carousel-control {
                background: none !important;
            }

            span.fa.fa-search:before, .control-right:before, .control-left:before, .icon-fb:before, .icon-phone:before, .icon-skype:before, .icon-youtube:before, .icon-person:before, .icon-home:before {
                font-family: Ionicons;
                font-size: 40px;
            }

            .carousel-control .icon-prev, .carousel-control .glyphicon-chevron-left {
                left: 30%;
            }

            .carousel-control .icon-prev, .carousel-control .glyphicon-chevron-right {
                right: 30%;
            }
        </style>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="control-left glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="control-right glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <?php woocommerce_product_loop_end(); ?>

    <?php
    $get_terms = get_terms('product_cat');
    /**
     * woocommerce_after_shop_loop hook.
     *
     * @hooked woocommerce_pagination - 10
     */
    do_action('woocommerce_after_shop_loop');
    ?>
    <h1 class="page-title">Danh mục sản phẩm</h1>
    <?php foreach ($get_terms as $term): ?>
        <?php $attachment_id= get_term_meta($term->term_id,'thumbnail_id',true);
        $thumbnail = wp_get_attachment_image($attachment_id, 'thumbnail');
        ?>
        <div class="col-sm-3">
            <div class="thubnail"><?php echo $thumbnail ?></div>
            <div class="title"><?php echo $term->name ?></div>

        </div>
    <?php endforeach; ?>

<?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

    <?php wc_get_template('loop/no-products-found.php'); ?>

<?php endif; ?>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
?>

<?php //get_footer();
$setting_option = get_option('theme_option');
//get_header($setting_option['header']);
get_template_part('footer/footer-' . $setting_option['footer'], 'none');
