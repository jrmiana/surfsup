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
        'register_meta_box_cb'  => 'register_event_acf'
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

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
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
