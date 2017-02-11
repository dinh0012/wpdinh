<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
				/*while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/page/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.*/

				$temp = $wp_query;
				$wp_query = null;
				$wp_query = new WP_Query();
				$wp_query->query('showposts=6&post_type=sanpham'.'&paged='.$paged);
				$count = 0;

				while ($wp_query->have_posts()) : $wp_query->the_post(); $count++;
					?>

					<?php //Tạo biến chèn class 'thrid' vào mỗi 3 bài viết.
					if ($count == 4) {
						$p3 = 'thrid';
						$count = 0;
					} else { $p3 = ''; }
					?>

					<div <?php post_class($p3); ?> id="product-<?php the_ID(); ?>">
						<?php the_post_thumbnail('medium',array('class' => 'product-thumb') ); ?>
						<a href="<?php the_permalink(); ?>"><h3 class="title-sp"><?php the_title(); ?></h3></a>
						<div class="info">
							<p style="margin-top: 5px;">Giá: <?php echo get_post_meta( $post->ID, 'price', true ); ?></p>
							<p class="product-status">
								<?php
								$product_status = get_post_meta( $post->ID, 'author', true );

								?>
							</p><!--Tình trạng sản phẩm-->
							<a class="order-button" href="<?php the_permalink();?>">Xem chi tiết</a>
						</div>
					</div>

				<?php endwhile; ?>
<!--
				<nav>
					<?php /*previous_posts_link('<< Previous') */?>
					<?php /*next_posts_link('Next >>') */?>
				</nav>-->

				<?php
				$wp_query = null;
				$wp_query = $temp;  // Reset
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div><!-- .wrap -->
	<style>
		.title-sp{
			font-size: 16px;
			padding-top: 10px !important;
		}
		#content #primary{
			width: 100%;
		}
		.product-thumb {
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
		.sanpham {
			width: 30.3333%;
			float: left;
			margin-right: 3%;
		}

	</style>

<?php get_footer();
