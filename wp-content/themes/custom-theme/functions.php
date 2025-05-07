<?php

function enqueue_tailwind()
{
    wp_enqueue_style('my-style', get_stylesheet_uri());
    wp_enqueue_style('tailwind-output', get_template_directory_uri() . '/src/output.css', false, '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind');

register_nav_menus(
    array(
        'primary-menu' => __('Primary Menu'),
        'secondary-menu' => __('Secondary Menu')
    )
);

add_theme_support('post-thumbnails');

function register_event_cpt()
{

    $labels = array(
        'name'                     => __('Events', 'custom-theme'),
        'singular_name'            => __('Event', 'custom-theme'),
        'add_new'                  => __('Add New', 'custom-theme'),
        'add_new_item'             => __('Add New Event', 'custom-theme'),
        'edit_item'                => __('Edit Event', 'custom-theme'),
        'new_item'                 => __('New Event', 'custom-theme'),
        'view_item'                => __('View Event', 'custom-theme'),
        'view_items'               => __('View Events', 'custom-theme'),
        'search_items'             => __('Search Events', 'custom-theme'),
        'not_found'                => __('No Events found.', 'custom-theme'),
        'not_found_in_trash'       => __('No Events found in Trash.', 'custom-theme'),
        'parent_item_colon'        => __('Parent Events:', 'custom-theme'),
        'all_items'                => __('All Events', 'custom-theme'),
        'archives'                 => __('Event Archives', 'custom-theme'),
        'attributes'               => __('Event Attributes', 'custom-theme'),
        'insert_into_item'         => __('Insert into Event', 'custom-theme'),
        'uploaded_to_this_item'    => __('Uploaded to this Event', 'custom-theme'),
        'featured_image'           => __('Featured Image', 'custom-theme'),
        'set_featured_image'       => __('Set featured image', 'custom-theme'),
        'remove_featured_image'    => __('Remove featured image', 'custom-theme'),
        'use_featured_image'       => __('Use as featured image', 'custom-theme'),
        'menu_name'                => __('Events', 'custom-theme'),
        'filter_items_list'        => __('Filter Event list', 'custom-theme'),
        'filter_by_date'           => __('Filter by date', 'custom-theme'),
        'items_list_navigation'    => __('Events list navigation', 'custom-theme'),
        'items_list'               => __('Events list', 'custom-theme'),
        'item_published'           => __('Event published.', 'custom-theme'),
        'item_published_privately' => __('Event published privately.', 'custom-theme'),
        'item_reverted_to_draft'   => __('Event reverted to draft.', 'custom-theme'),
        'item_scheduled'           => __('Event scheduled.', 'custom-theme'),
        'item_updated'             => __('Event updated.', 'custom-theme'),
        'item_link'                => __('Event Link', 'custom-theme'),
        'item_link_description'    => __('A link to an Event.', 'custom-theme'),
    );

    $args = array(
        'labels'                => $labels,
        'description'           => __('organize and manage events', 'custom-theme'),
        'public'                => true,
        'hierarchical'          => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => false,
        'show_in_admin_bar'     => false,
        'show_in_rest'          => true,
        'menu_position'         => null,
        'menu_icon'             => 'dashicons-megaphone',
        'capability_type'       => 'post',
        'capabilities'          => array(),
        'supports'              => array('title', 'editor', 'revisions', 'thumbnail'),
        'taxonomies'            => array(),
        'has_archive'           => false,
        'rewrite'               => array('slug' => 'event'),
        'query_var'             => true,
        'can_export'            => true,
        'delete_with_user'      => false,
        'template'              => array(),
        'template_lock'         => false,
        'taxonomies'            => array('event-category', 'category'),
        'register_meta_box_cb'  => 'register_event_acf',
        'rest_base'             => 'events',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('event', $args);
}
add_action('init', 'register_event_cpt');

function register_event_acf()
{
    add_meta_box(
        'date',
        __('Date', 'custom-theme'),
        'register_event_acf_date_callback'
    );
    add_meta_box(
        'time',
        __('Time', 'custom-theme'),
        'register_event_acf_time_callback'
    );
    add_meta_box(
        'location',
        __('Location', 'custom-theme'),
        'register_event_acf_location_callback'
    );
    add_meta_box(
        'registration_link',
        __('Registration Link', 'custom-theme'),
        'register_event_acf_registration_link_callback'
    );
}

function register_event_acf_date_callback($post)
{
    wp_nonce_field('date_nonce', 'date_nonce');
    $value = get_post_meta($post->ID, '_date', true);
    echo '<input type="date" style="width:100%" id="date" name="date" value="' . esc_attr($value) . '"></input>';
}

function register_event_acf_time_callback($post)
{
    wp_nonce_field('time_nonce', 'time_nonce');
    $value = get_post_meta($post->ID, '_time', true);
    echo '<input type="time" style="width:100%" id="time" name="time" value="' . esc_attr($value) . '"></input>';
}

function register_event_acf_location_callback($post)
{
    wp_nonce_field('location_nonce', 'location_nonce');
    $value = get_post_meta($post->ID, '_location', true);
    echo '<textarea style="width:100%" id="location" name="location">' . esc_attr($value) . '</textarea>';
}

function register_event_acf_registration_link_callback($post)
{
    wp_nonce_field('registration_link_nonce', 'registration_link_nonce');
    $value = get_post_meta($post->ID, '_registration_link', true);
    echo '<input type="text" style="width:100%" id="registration_link" name="registration_link" value="' . esc_attr($value) . '"></input>';
}

function save_event_acf($post_id)
{
    if (
        !isset($_POST['date_nonce']) &&
        !isset($_POST['time_nonce']) &&
        !isset($_POST['location_nonce']) &&
        !isset($_POST['registration_link_nonce'])
    ) {
        return;
    }

    if (
        !wp_verify_nonce($_POST['date_nonce'], 'date_nonce') &&
        !wp_verify_nonce($_POST['time_nonce'], 'time_nonce') &&
        !wp_verify_nonce($_POST['location_nonce'], 'location_nonce') &&
        !wp_verify_nonce($_POST['registration_link_nonce'], 'registration_link_nonce')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (! current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (! current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (! isset($_POST['location'])) {
        return;
    }

    $date_data = sanitize_text_field($_POST['date']);
    $time_data = sanitize_text_field($_POST['time']);
    $location_data = sanitize_text_field($_POST['location']);
    $registration_link_data = sanitize_text_field($_POST['registration_link']);

    update_post_meta($post_id, '_date', $date_data);
    update_post_meta($post_id, '_time', $time_data);
    update_post_meta($post_id, '_location', $location_data);
    update_post_meta($post_id, '_registration_link', $registration_link_data);
}
add_action('save_post', 'save_event_acf');

add_action('rest_api_init', 'create_api_posts_meta_field');
function create_api_posts_meta_field()
{
    register_rest_field('event', 'acf', array(
        'get_callback' => 'get_post_meta_for_api',
        'schema' => null,
    ));
}

function get_post_meta_for_api($object)
{
    $post_id = $object['id'];
    return get_post_meta($post_id);
}


//function referenced from https://gist.github.com/WaseemMansour/f9bbbe558e935e7c06f93ee398074221
function show_related_posts($postType = 'post', $postID = null, $totalPosts = null, $relatedBy = null)
{
    global $post, $related_posts_custom_query_args;
    if (null === $postID) $postID = $post->ID;
    if (null === $totalPosts) $totalPosts = 4;
    if (null === $relatedBy) $relatedBy = 'category';
    if (null === $postType) $postType = 'post';

    if ($relatedBy === 'category') {
        $categories = get_the_category($post->ID);
        $catidlist = '';
        foreach ($categories as $category) {
            $catidlist .= $category->cat_ID . ",";
        }
        // Build our category based custom query arguments
        $related_posts_custom_query_args = array(
            'post_type' => $postType,
            'posts_per_page' => $totalPosts, // Number of related posts to display
            'post__not_in' => array($postID), // Ensure that the current post is not displayed
            'orderby' => 'rand', // Randomize the results
            'cat' => $catidlist, // Select posts in the same categories as the current post
        );
    }

    if ($relatedBy === 'tags') {

        // Get the tags for the current post
        $tags = wp_get_post_tags($postID);
        // If the post has tags, run the related post tag query
        if ($tags) {
            $tag_ids = array();
            foreach ($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
            // Build our tag related custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'tag__in' => $tag_ids, // Select posts with related tags
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
            );
        } else {
            // If the post does not have tags, run the standard related posts query
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
            );
        }
    }

    $custom_query = new WP_Query($related_posts_custom_query_args);

?>
    <div class="grid md:grid-cols-3 gap-4">
        <?php
        if ($custom_query->have_posts()) : ?>
            <?php while ($custom_query->have_posts()) : $custom_query->the_post();
                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            ?>

                <div class="shadow-md overflow-hidden rounded-lg bg-white">
                    <img class="h-48 w-full object-cover" src="<?php echo $featured_img_url; ?>" alt="Event" loading="lazy">
                    <div class="p-6 flex flex-col gap-4">
                        <h4 class="text-2xl font-medium"><?php echo the_title(); ?></h4>
                        <a href="<?php the_permalink(); ?>" class="bg-red-400 hover:bg-fuchsia-400 text-white font-bold py-2 px-4 rounded-full text-center self-end w-48">
                            More Details
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>

        <?php endif;
        ?>
    </div>
<?php

    wp_reset_postdata();
}

//rest api
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/events/next', [
        'methods'  => 'GET',
        'callback' => 'get_next_events',
        'permission_callback' => '__return_true',
    ]);
});

function get_next_events(WP_REST_Request $request)
{
    $today = date('Y-m-d');

    $query = new WP_Query([
        'post_type'      => 'event',
        'posts_per_page' => 5,
        'meta_key'       => '_date',
        'meta_value'     => $today,
        'meta_compare'   => '>=',
        'orderby'        => 'meta_value',
        'order'          => 'ASC',
    ]);

    $events = [];

    while ($query->have_posts()) {
        $query->the_post();
        $date = get_post_meta(get_the_ID(), '_date')[0];

        $events[] = [
            'id'     => get_the_ID(),
            'title'  => get_the_title(),
            'link'   => get_permalink(),
            'date'   => $date,
        ];
    }

    wp_reset_postdata();

    return rest_ensure_response($events);
}
