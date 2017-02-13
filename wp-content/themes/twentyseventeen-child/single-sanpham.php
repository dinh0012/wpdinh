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
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                    <header>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">

                                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                            <!-- Indicators -->
                                            <ol class="carousel-indicators">
                                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                                <li data-target="#myCarousel" data-slide-to="2"></li>
                                                <li data-target="#myCarousel" data-slide-to="3"></li>
                                            </ol>

                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner" role="listbox">

                                                <div class="item active">
                                                    <img src="http://vuonhoa.vn/userfiles/images/vuon-dung-14.jpg" alt="Chania" width="460" height="345">
                                                    <div class="carousel-caption">
                                                        <h3>Chania</h3>
                                                        <p>The atmosphere in Chania has a touch of Florence and
                                                            Venice.</p>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <img src="http://vuonhoa.vn/userfiles/images/vuon-dung-14.jpg" alt="Chania" width="460" height="345">
                                                    <div class="carousel-caption">
                                                        <h3>Chania</h3>
                                                        <p>The atmosphere in Chania has a touch of Florence and
                                                            Venice.</p>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <img src="http://vuonhoa.vn/userfiles/images/vuon-dung-14.jpg" alt="Flower" width="460" height="345">
                                                    <div class="carousel-caption">
                                                        <h3>Flowers</h3>
                                                        <p>Beatiful flowers in Kolymbari, Crete.</p>
                                                    </div>
                                                </div>

                                                <div class="item">
                                                    <img src="http://vuonhoa.vn/userfiles/images/vuon-dung-14.jpg" alt="Flower" width="460" height="345">
                                                    <div class="carousel-caption">
                                                        <h3>Flowers</h3>
                                                        <p>Beatiful flowers in Kolymbari, Crete.</p>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Left and right controls -->
                                            <a class="left carousel-control" href="#myCarousel" role="button"
                                               data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left"
                                                      aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#myCarousel" role="button"
                                               data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right"
                                                      aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--BEGIN: PRODUCT THUMBNAIL-->

                        <div class="product-thumb" data-toggle="modal" data-target="#myModal">
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
