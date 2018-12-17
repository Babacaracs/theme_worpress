<?php
/**
 * single-game.php
 * 
 * Ce fichier est le modèle pour les posts du type 'Games'.
 * Quand vous cliquez sur un jeu de la page d'archive des jeux, c'est ce fichier que WordPress va chercher. 
 * 
 */

// D'abord, on va charger l'entête du document et la navigation du thème. La fonction ci-dessous va chercher un fichier appelé header.php.
get_header(); ?>

<main class="main-content">

    <?php 
        /** 
         * Pas besoin de vérifier si on a des posts, vu que ce template est appelé uniquement quand on veut afficher un jeu simple.
         * On passe donc directement dans notre boucle While
         * La boucle va en fait boucler une seule fois, vu qu'il n'y a qu'une pièce de contenu à afficher.
         */
        while( have_posts() ) { // Tant qu'il y a des posts à afficher ... 
            
            // ... prépare-le. 
            the_post();

            // ... et affiche-le en utilisant le template contenu dans le fichier 'content.php' dans le dossier 'template-part/'.
            get_template_part( 'template-parts/content', 'game' );
        }   
    ?>

</main>

<?php // Nous sommes toujours dans le <div class="content-area">. On va afficher l'image à la une dans le plus grand conteneur. ?>
<?php if( has_post_thumbnail() ) : ?>
    <picture class="game-screenshot">
        <?php the_post_thumbnail(); ?>
    </picture>
<?php endif;

the_post_navigation();

// Puis, on peut inclure le fichier footer.php qui va fermer la zone de contenu et afficher notre pied de page.
get_footer();

    