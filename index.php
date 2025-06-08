<?php get_header(); ?>

<main>
    <h1>Hola, este es mi nuevo tema</h1>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    else :
        echo '<p>No hay contenido aún.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
