<?php get_header(); ?>

<main class="site--main">
    <?php while (have_posts()) : the_post(); ?>
        <article class="post--single" itemscope="itemscope" itemtype="http://schema.org/Article">
            <div class="post--single__meta"><?php echo get_the_date('Y-m-d'); ?> / <?php the_category(',') ?></div>
            <h2 class="post--single__title" itemprop="headline"><?php the_title(); ?></h2>
            <div class="post__single__content graph" itemprop="articleBody">
                <?php the_content(); ?>
            </div>
            <div class="post__single__copyright">
                本文内容和图片均为原创，未经允许不得任何形式的转载。
            </div>
            <div class="tag--list">
                <?php the_tags('', '') ?>
            </div>
            <?php get_template_part('template-parts/author', 'card'); ?>
            <div class="post__single__comments">
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </div>
            <?php the_post_navigation(array(
                'next_text' => '<span class="meta-nav">Next</span><span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav">Previous</span><span class="post-title">%title</span>',
            )); ?>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>