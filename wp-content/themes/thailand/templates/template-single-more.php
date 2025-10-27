<div class="single-more">
    <?php
    $postType =  get_post_type();
    $currentID =  get_the_ID();
    if ($postType === 'resource') {
        $taxonomy = 'resource_category';
    } elseif ($postType === 'news') {
        $taxonomy = 'news_category';
    } else {
        $taxonomy = ''; // 預防其他 post type 出錯
    }
    // $cate = get_the_terms($post->ID, 'resource_category');
    // $cateID = $cate[0]->term_id;
    if ($taxonomy) {
        $cate = get_the_terms($post->ID, $taxonomy);
        if (!empty($cate) && !is_wp_error($cate)) {
            $cateID = $cate[0]->term_id;
            $args = array(
                'post_type' => $postType,
                'post__not_in' => array($currentID),
                'posts_per_page' => get_option('_more_count'),
                'orderby' => 'date',
                'order'   => 'DESC',
                'tax_query' => array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field' => 'term_id',
                        'terms' => $cateID,
                    )
                )
            );

            $loop = new WP_Query($args);
        }
    }
    if ($loop->have_posts()) :
        $stt = 1;
        while ($loop->have_posts()) :
            $loop->the_post();
    ?>
            <div class="single-more-item" data-id="<?php echo $stt ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <a class="my-link" href="<?php echo get_the_permalink() ?>">
                        <img class="item-img" src="<?php the_post_thumbnail_url() ?>" srcset="<?php the_post_thumbnail_url() ?>" />
                    </a>
                <?php endif ?>
                <div class="item-title">
                    <a class="my-link" href="<?php echo get_the_permalink() ?>">
                        <?php the_title() ?>
                    </a>
                </div>
                <div class="item-date">
                    <?php echo get_the_date() ?>
                </div>
                <div class="item-summary">
                    <?php echo get_post_meta(get_the_ID(), '_meta_box_summary', true) ?>
                </div>
            </div>
    <?php
            $stt += 1;
        endwhile;
    endif;
    wp_reset_postdata();
    wp_reset_query();
    ?>
</div>