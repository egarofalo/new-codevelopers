<?php if (get_field('copyright', 'option')) : ?>
    <p class="copyright text-center mt-4 mb-0">
        <?php the_field('copyright', 'option') ?>
    </p>
<?php endif;
