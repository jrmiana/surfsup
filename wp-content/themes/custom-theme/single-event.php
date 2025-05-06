<?php

get_header(); ?>

<div id="primary" class="content-area py-36 max-w-6xl mx-auto px-8 md:px-20">
    <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while (have_posts()) : the_post();
            $date = date_create(get_post_meta(get_the_ID(), '_date')[0]);
            $date = date_format($date, "M d Y");
            $location = get_post_meta(get_the_ID(), '_location')[0];
            $time = get_post_meta(get_the_ID(), '_time')[0];
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $reg_link = get_post_meta(get_the_ID(), '_registration_link')[0];
        ?>
            <div class="flex flex-col md:flex-row items-center md:justify-between mb-4">
                <h1 class="text-5xl font-bold mb-4"><?php echo the_title(); ?></h1>
                <a href="<?php echo $reg_link; ?>" class="bg-red-400 hover:bg-fuchsia-400 text-white font-bold py-2 px-4 rounded-full text-center flex items-center justify-center w-48 h-12">
                    Register
                </a>
            </div>
            <div class="flex flex-wrap gap-x-8 gap-y-2 items-center w-full justify-center md:justify-start mb-4">
                <p class="font-medium text-lg"><?php echo $date; ?></p>
                <p class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <?php echo $time; ?>
                </p>
                <p class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <?php echo $location; ?>
                </p>
            </div>
            <img class="h-96 w-full object-cover mb-4" src="<?php echo $featured_img_url; ?>" alt="Event" loading="lazy">
            <div class="content">
                <?php the_content(); ?>
            </div>
            <style>
                .content p {
                    margin-bottom: 1rem;
                    text-align: justify;
                }
            </style>
        <?php
        // End the loop.
        endwhile;


        ?>
        <div class="mt-16">
            <h2 class="font-medium text-3xl mb-8">Check out other events</h2>
            <?php show_related_posts('event', get_the_ID()); ?>
        </div>
        <?php
        ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>