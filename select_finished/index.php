<?php
/**
 * index.php
 * 
 * Ce fichier est le modèle (template) par défaut de votre thème.
 * C'est ce fichier que WordPress va chercher quand il ne trouve pas de template plus spécifique. 
 * C'est la raison pour laquelle il est (avec style.css) obligatoire.
 * 
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

                // ... et affiche-le en utilisant le template contenu dans le fichier 'content.php' dans le dossier 'template-part/'.
                // Utiliser get_template_part et isoler le contenu de l'article dans son fichier rend notre thème plus lisible et modulable.
                get_template_part( 'template-parts/content' );
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

    