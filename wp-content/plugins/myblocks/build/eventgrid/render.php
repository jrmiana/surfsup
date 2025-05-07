<?php
$limit = intval($attributes['limit'] ?? 6);
$category = sanitize_text_field($attributes['category'] ?? '');
$order = $attributes['order'] === 'ASC' ? 'ASC' : 'DESC';

$args = [
    'post_type' => 'event',
    'posts_per_page' => $limit,
    'order' => $order,
    'orderby' => 'date',
];

if ($category) {
    $args['tax_query'] = [[
        'taxonomy' => 'category',
        'field'    => 'slug',
        'terms'    => $category,
    ]];
}

$query = new WP_Query($args);

if ($query->have_posts()) {
    echo '<div class="event-grid">';
    while ($query->have_posts()) {
        $query->the_post();
        $date = date_create(get_post_meta(get_the_ID(), '_date')[0]);
        $date = date_format($date, "M d Y");
        echo '<div class="event-grid__item">';
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium');
        }
        echo '<h3>' . esc_html(get_the_title()) . '</h3>';
        echo '<p>' . $date . '</p>';
        echo '<a href="' . esc_url(get_permalink()) . '">View Event</a>';
        echo '</div>';
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo '<p>No events found.</p>';
}
