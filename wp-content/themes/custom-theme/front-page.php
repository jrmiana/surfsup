<?php get_header(); ?>

<div class="bg-[url(http://localhost/surfsup/wp-content/uploads/2025/05/SURF_BG.webp)] h-dvh bg-cover py-48 flex items-center justify-center">
    <div class="flex flex-col items-center gap-8">
        <h1 class="text-5xl m-auto text-center">Endless Summer <br /><span class="font-semibold">SURF</span></h1>
        <a href="#events" class="bg-red-400 hover:bg-fuchsia-400 text-white font-bold py-2 px-4 rounded-full">
            Explore Events
        </a>
    </div>
</div>

<div id="events" class="py-36 max-w-6xl mx-auto px-8">
    <h2 class="font-medium text-4xl mb-8">Check our Events</h2>
    <div class="grid md:grid-cols-3 gap-4">
        <?php
        $args = array(
            'post_type' => 'event',
            'post_status' => 'publish',
            'posts_per_page' => -1
        );
        $posts = new WP_Query($args);
        if ($posts->have_posts()) {
            while ($posts->have_posts()) {
                $posts->the_post();
                $date = date_create(get_post_meta(get_the_ID(), '_date')[0]);
                $date = date_format($date, "M d Y");
                $location = get_post_meta(get_the_ID(), '_location')[0];
                $time = get_post_meta(get_the_ID(), '_time')[0];
                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
        ?>
                <div class="shadow-md overflow-hidden rounded-lg bg-white">
                    <img class="h-48 w-full object-cover" src="<?php echo $featured_img_url; ?>" alt="Event" loading="lazy">
                    <div class="p-6 flex flex-col gap-4">
                        <h4 class="text-2xl font-medium"><?php echo the_title(); ?></h4>
                        <div class="grid grid-cols-3">
                            <p class="font-medium text-lg"><?php echo $date; ?></p>
                            <div class="col-span-2">
                                <p class="flex gap-2 mb-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <?php echo $time; ?></p>
                                <p class="flex gap-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <?php echo $location; ?></p>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="bg-red-400 hover:bg-fuchsia-400 text-white font-bold py-2 px-4 rounded-full text-center self-end w-48">
                            More Details
                        </a>
                    </div>
                </div>
        <?php
            }
        }
        wp_reset_query();
        ?>

    </div>

</div>

<?php get_footer(); ?>