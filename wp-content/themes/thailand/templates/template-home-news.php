<div id="news-home" class="animation-item">
    <div class="news-home-title">
        <div class="title-first title-select" onclick=" ChangSelect('.title-first', '.content-first')">
            <h3>Case Studies</h3>
        </div>
        <div class="title-second" onclick="ChangSelect('.title-second', '.content-second')">
            <h3>Articles<h3>
        </div>
        <div class="title-third" onclick="ChangSelect('.title-third', '.content-third')">
            <h3>Events</h3>
        </div>
        <div class="title-fourth" onclick="ChangSelect('.title-fourth', '.content-fourth')">
            <h3>News</h3>
        </div>
        <div class="title-fifth" onclick="ChangSelect('.title-fifth', '.content-fifth')">
            <h3>Career</h3>
        </div>
    </div>

    <div class="news-home-content">
        <div class="content-first content-select">
            <div class="content-list">
                <?php
                $arr = array(
                    'post_type' => 'resource',
                    'resource_category' => 'case-studies',
                    'posts_per_page' => get_option('first_load'),
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $wp_query = new WP_Query($arr);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                        <div>
                            <div><a class="my-link" href="<?php echo get_the_permalink() ?>"><?php the_title(); ?></a></div>
                            <div><?php echo get_the_date('Y-m-d', get_the_ID()) ?></div>
                        </div>
                <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
        </div>

        <div class="content-second">
            <div class="content-list">
                <?php
                $arr = array(
                    'post_type' => 'resource',
                    'resource_category' => 'articles',
                    'posts_per_page' => get_option('first_load'),
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $wp_query = new WP_Query($arr);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                        <div>
                            <div><a class="my-link" href="<?php echo get_the_permalink() ?>"><?php the_title(); ?></a></div>
                            <div><?php echo get_the_date('Y-m-d', get_the_ID()) ?></div>
                        </div>
                <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
        </div>

        <div class="content-third">
            <div class="content-list">
                <?php
                $arr = array(
                    'post_type' => 'resource',
                    'resource_category' => 'events',
                    'posts_per_page' => get_option('first_load'),
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $wp_query = new WP_Query($arr);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                        <div>
                            <div><a class="my-link" href="<?php echo get_the_permalink() ?>"><?php the_title(); ?></a></div>
                            <div><?php echo get_the_date('Y-m-d', get_the_ID()) ?></div>
                        </div>
                <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
        </div>

        <div class="content-fourth">
            <div class="content-list">
                <?php
                $arr = array(
                    'post_type' => 'news',
                    'news_category' => 'news',
                    'posts_per_page' => get_option('first_load'),
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $wp_query = new WP_Query($arr);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                        <div>
                            <div><a class="my-link" href="<?php echo get_the_permalink() ?>"><?php the_title(); ?></a></div>
                            <div><?php echo get_the_date('Y-m-d', get_the_ID()) ?></div>
                        </div>
                <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
        </div>

        <div class="content-fifth">
            <div class="content-list">
                <?php
                $arr = array(
                    'post_type' => 'news',
                    'news_category' => 'career',
                    'posts_per_page' => get_option('first_load'),
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                );

                $wp_query = new WP_Query($arr);
                if ($wp_query->have_posts()) {
                    while ($wp_query->have_posts()) {
                        $wp_query->the_post();
                ?>
                        <div>
                            <div><a class="my-link" href="<?php echo get_the_permalink() ?>"><?php the_title(); ?></a></div>
                            <div><?php echo get_the_date('Y-m-d', get_the_ID()) ?></div>
                        </div>
                <?php
                    }
                }
                wp_reset_postdata();
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function() {});

        function ChangSelect(titleSelect, contentSelect) {
            jQuery(titleSelect).parents().siblings('.news-home-content').children().removeClass('content-select');

            jQuery(titleSelect).siblings().removeClass('title-select');

            jQuery(titleSelect).addClass('title-select');

            jQuery(titleSelect).parents().siblings('.news-home-content').children(contentSelect).addClass('content-select');

        }
    </script>