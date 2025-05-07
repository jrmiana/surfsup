<?php
$image_url = esc_url($attributes['imageUrl'] ?? '');
$heading = $attributes['heading'] ?? '';
$button_text = $attributes['buttonText'] ?? '';
$button_url = esc_url($attributes['buttonUrl'] ?? '');
?>

<div class="hero-block">
    <?php if ($image_url): ?>
        <img src="<?php echo $image_url; ?>" alt="Hero" class="hero-image" />
    <?php endif; ?>

    <div class="text-area">
        <?php if (!empty($heading)): ?>
            <h2 class="text-3xl"><?php echo wp_kses_post($heading); ?></h2>
        <?php endif; ?>

        <?php if (!empty($button_text) && !empty($button_url)): ?>
            <a href="<?php echo $button_url; ?>" class="hero-button"><?php echo esc_html($button_text); ?></a>
        <?php endif; ?>
    </div>
</div>