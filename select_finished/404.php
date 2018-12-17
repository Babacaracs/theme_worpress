<?php
/**
 * 404.php
 * 
 * Ce fichier est le modèle (template) utilisé pour les pages d'erreur 404.
 * Pour l'exemple, il affiche uniquement le message d'erreur quand WordPress ne trouve pas de contenu
 * Il appelle simplement content-none.php
 * Par contre, la page a quand même un titre. Allez jeter un oeil dans header.php.
 * 
 * Beaucoup de themes/sites personnalisent la page 404 de façon assez drastique, pour compenser le fait de tomber sur une erreur.
 * Soyez créatif, et faites un truc sympa ! En gros pas comme moi ici ;-)
 */

// D'abord, on va charger l'entête du document et la navigation du thème. La fonction ci-dessous va chercher un fichier appelé header.php.
get_header(); ?>

<main class="main-content">
    <?php 
        // Pas de contenu à afficher ? Mince alors.
        get_template_part( 'template-parts/content', 'none' );
    ?>
</main>

<?php
// Puis, on peut inclure le fichier footer.php qui va fermer la zone de contenu et afficher notre pied de page.
get_footer();

    