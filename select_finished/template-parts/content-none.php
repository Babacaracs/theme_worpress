<?php
/**
 * content-none.php
 * 
 * Ce fichier est responsable de l'affichage d'un message d'erreur au cas où il n'y aurait pas d'articles à afficher.
 * 
 */
?>
<section class="no-content">
    <h2 class="entry-title"><?php esc_html_e( 'No panic.', 'select' ); ?></h2>
    <p><?php esc_html_e( 'We couldn\'t find your content. What were you looking for ?', 'select' ); ?></p>
    <?php 
        /**
         * On affiche un petit message d'erreur, puis le formulaire de recherche par défaut de WordPress.
         * On peut être bien plus créatif pour ce template, mais on va faire simple pour notre exemple.
         */
        get_search_form(); 
    ?>
</section>