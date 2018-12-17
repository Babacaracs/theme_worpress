<?php
/**
 * search.php
 * 
 * Ce fichier est le modèle utilisé pour les pages de résultats de recherche.
 * Comme pour archive.php, la seule différence avec index.php est que ce template appelle content-excerpt.php au lieu de content.php pour afficher le contenu de l'article.
 * Même dans content-excerpt.php, la seule différence avec content.php est qu'on affiche l'extrait de l'article seulement.
 * 
 * Donc, toujours comme archive.php, on aurait simplement pu ne pas inclure ce template et laisser WordPress utiliser index.php pour les résultats de recherche, 
 * et ensuite inclure une simple ligne de logique (un bête if) pour afficher le contenu complet ou l'extrait seulement selon la page demandée.
 * Ce template est donc juste inclus pour l'exemple mais je recommande dans tous les cas d'inclure un search.php dans chaque thème.
 * 
 * Aussi, jetez un oeil à header.php pour voir comment est géré l'affichage du titre de la page de résultats.
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

                // ... et affiche-le en utilisant le template contenu dans le fichier 'content-excerpt.php' dans le dossier 'template-parts/'.
                get_template_part( 'template-parts/content', 'excerpt' );
            }

            /**
             * On affiche des liens vers les posts précédents/suivants.
             * Attention à ne pas confondre avec the_post_navigation() (singulier) qui s'utilise dans single.php
             * Facile à retenir: single.php -> the_post_navigation (singulier)
             */
            the_posts_navigation();
        
        } else {
            
            // Si on n'avait aucun posts à afficher pour cette page, on afficher un message d'erreur contenu dans un autre template part.
            get_template_part( 'template-parts/content', 'none' );
        
        } 
    ?>

</main>

<?php
// Nous sommes toujours dans le <div class="content-area">. On va charger la zone de widget principale en appelant le fichier sidebar.php
get_sidebar();
// Puis, on peut inclure le fichier footer.php qui va fermer la zone de contenu et afficher notre pied de page.
get_footer();

    