<article class="post--item post--item__status" itemtype="http://schema.org/Article" itemscope="itemscope">
    <div class="content">
        <header>
            <?php echo get_avatar(get_the_author_meta('ID'), 48); ?>
            <a itemprop="datePublished" datetime="<?php echo get_the_date('c'); ?>" class="humane--time" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
                <?php echo get_the_date('Y-m-d'); ?>
            </a>
        </header>
        <?php if (get_the_content()) : ?>
            <div class="description" itemprop="about"><?php the_content(); ?></div>
        <?php endif; ?>
    </div>
</article>