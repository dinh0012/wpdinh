<?php
$num_post = $instance['num_post'];
$arr = [
    'post_type' => [
        'my-post-type' => 'sanpham'
    ],
    'posts_per_page' => $num_post
];
$wp_query = new WP_Query($arr);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <!--        <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php $i = 0;
        while ($wp_query->have_posts()) : $wp_query->the_post();
            $title = get_the_title();
            $thumbnail = get_the_post_thumbnail_url($post->ID);
            ?>

            <div class="item <?php echo($i == 0 ? 'active' : '') ?>">
                <a class="post" href="<?php echo the_permalink() ?>">
                    <img src="<?php echo $thumbnail ?>" alt="<?php echo $title ?>" width="460" height="345">
                    <div class="carousel-caption">
                        <h3 class="title"><?php echo $title;
                            $i++; ?></h3>
                    </div>
                </a>
            </div>

        <?php endwhile; ?>
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<style>
    h3.title {
        font-size: 2.0rem;
        font-weight: 700;
        color: #d0021b;
    }
    a.carousel-control,a.carousel-control:hover,a.carousel-control:focus {
        color: inherit;
        box-shadow:inherit;
        background-image:inherit !important
    }
    a.post:hover{
        color: inherit;
    }
    .carousel-caption {
        /* left: 0; */
        bottom: 0;
        padding-bottom: 0;
    }
</style>