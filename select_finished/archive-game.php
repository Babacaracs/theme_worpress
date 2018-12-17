<?php
/**
 * archive-game.php
 * 
 * Ce fichier est le modèle utilisé pour les pages d'archives des jeux.
 * Il est utilisé pour afficher les contenus du CPT 'Games'.
 */

// D'abord, on va charger l'entête du document et la navigation du thème. La fonction ci-dessous va chercher un fichier appelé header.php.
get_header(); ?>
<main class="main-content">

    <?php 
    
        // Après avoir ouvert la zone de contenu principale <main>, on vérifie que l'on a bien des posts (éléments de contenus) à afficher avec have_posts()
        if ( have_posts() ) {
        
            // On a des posts, donc on va boucler dessus avec une boucle while (= tant que)
            while( have_posts() ) { // Tant qu'il y a des posts à afficher ... 
                
                // ... prépare-le. 
                the_post();

                // ... et affiche-le en utilisant le template contenu dans le fichier 'content-games.php' dans le dossier 'template-parts/'.
                get_template_part( 'template-parts/content', 'games' );
            }
        
        } else {
            
            // Si on n'avait aucun posts à afficher pour cette page, on afficher un message d'erreur contenu dans un autre template part.
            get_template_part( 'template-parts/content', 'none' );
        
        } 
    ?>

</main>
<?php 
    /**
     * On affiche la pagination s'il y a beaucoup de posts
     */
    the_posts_navigation();
?>
<?php
// Puis, on peut inclure le fichier footer.php qui va fermer la zone de contenu et afficher notre pied de page.
get_footer();

    