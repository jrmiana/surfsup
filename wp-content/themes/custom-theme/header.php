<!DOCTYPE html>
<html <?php language_attributes(); ?>

    <head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title('|', true, 'right'); ?></title>
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="hfeed site ">
        <a class="screen-reader-text skip-link" href="#content"><?php _e('Skip to content', 'custom-theme'); ?></a>
        <header id="masthead" class="site-header fixed top-0 w-dvw z-10 py-10">

            <div class="flex flex-wrap justify-between max-w-6xl mx-auto px-8 md:px-20 items-center gap-y-4">
                <a href="/surfsup/" rel="home" class="text-2xl md:text-3xl font-black">SURF'S UP
                </a>
                <div class="flex flex-wrap gap-y-4 gap-x-10">
                    <a href="/surfsup/about-us/">About Us</a>
                    <a href="/surfsup/contact/">Contact</a>
                </div>
            </div>

        </header>
        <script>
            window.onscroll = function(ev) {
                if ((Math.round(window.scrollY)) >= 50) {
                    document.getElementById('masthead').classList.add('bg-red-100');
                } else {
                    document.getElementById('masthead').classList.remove('bg-red-100');
                }
            };
        </script>

        <div id="main" class="wrapper">