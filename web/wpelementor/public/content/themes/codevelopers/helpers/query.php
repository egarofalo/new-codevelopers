<?php

namespace Codevelopers\WpElementor\Helpers\Query;

/**
 * Returns one post and reset the global $post variable.
 * If the query has more than one result, the first one is returned.
 */
function get_post(\WP_Query $query): \WP_Post
{
    global $post;
    $onePost = null;

    while ($query->have_posts()) {
        $query->the_post();
        $onePost = clone $post;
        break;
    }

    wp_reset_postdata();

    return $onePost;
}

/**
 * Get the last six posts.
 */
function get_last_posts(int $count = 6)
{
    return new \WP_Query([
        'post_type' => 'post',
        'posts_per_page' => $count,
        'order' => 'DESC',
        'orderby' => 'date'
    ]);
}
