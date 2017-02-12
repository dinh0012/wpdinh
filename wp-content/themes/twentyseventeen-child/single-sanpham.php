<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php
                /* Start the Loop */
                while (have_posts()) : the_post();

                    ?>

                    <header>
                        <!--BEGIN: PRODUCT THUMBNAIL-->
                        <div class="product-thumb">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <!--END: PRODUCT THUMBNAIL-->

                        <!--BEGIN: PRODUCT INFO-->
                        <div class="product-info">
                            <h1><?php the_title(); ?></h1> <!--Tiêu đề sản phẩm-->
                            <p class="product-price">
                                <?php echo "<strong>Giá:</strong> " . get_post_meta($post->ID, 'price', true); ?>
                            </p><!--Giá sản phẩm-->
                            <div class="information">
                                <?php echo get_post_meta($post->ID, 'information', true); ?>
                            </div><!--Mô tả sản phẩm-->
                            <a href="#" class="order-button">Đặt hàng</a>
                        </div>
                        <!--BEGIN: PRODUCT INFO-->
                    </header>

                    <div class="post-info">
                        <?php the_content(); ?>
                    </div>
                    <?php


                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
          
            <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-numposts="10"></div>
        </div><!-- #primary -->
        <?php get_sidebar(); ?>


    </div><!-- .wrap -->
<style>
    /*--Shop CSS--*/
    .product-thumb {
        width: 45%;
        float: left;
    }
    .product-info {
        width: 45%;
        margin-left: 5%;
        float: right;
    }
    .product-info h1 {
        font-size: 1.5em;
        margin-bottom: 0.5em;
    }
    .product-price, .product-status, .product-description {
        margin: 5px 0;
    }
    .order-button {
        color: #fff;
        background: rgb(33, 189, 12);
        text-decoration: none;
        padding: 5px;
        margin: 15px 0;
        display: table;
    }
    .post-info {
        clear: both;
        padding-top: 15px;
    }
</style>
<?php get_footer();
