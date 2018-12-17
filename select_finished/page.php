<?php
/**
 * page.php
 * 
 * Ce fichier est le modèle pour les pages standards.
 * Quand vous cliquez sur une page, c'est ce fichier que WordPress va utiliser s'il n'y a pas de fichier plus spécifiques à utiliser. 
 * Comme pour single.php, il est fortement recommandé de l'inclure dans chaque thème.
 * 
 */

// D'abord, on va charger l'entête du document et la navigation du thème. La fonction ci-dessous va chercher un fichier appelé header.php.
get_header(); ?>

<?php 
    // Comme pour single.php, l'image à la une sort du container <main>, mais reste dans <div class="content-area">
    the_post_thumbnail(); 
?>

<main class="main-content">

    <?php 
        /** 
         * Pas besoin de vérifier si on a des posts, vu que ce template est appelé uniquement quand on affiche une page.
         * On passe donc directement dans notre boucle While.
         * La boucle va en fait boucler une seule fois, vu qu'il n'y a qu'une pièce de contenu à afficher.
         */
        while( have_posts() ) { // Tant qu'il y a des posts à afficher ... 
            
            // ... prépare-le. 
            the_post();

            /** 
             * Pas besoin d'afficher les métas, ni le footer avec les étiquettes.
             * Il sera donc plus simple d'appeler un autre template-part spécifique pour les pages.
             * Le deuxième paramètre permet à la fonction d'aller chercher un fichier nommé content-page.php dans le dossier template-parts/
             * On aurait pu ajouter "-page" au premier paramètre aussi.
             * L'intérêt du deuxième paramètre et de permettre de chercher des template-parts de façon dynamique.
             * Par exemple, en utilisant get_template_part( 'template-parts/content', get_the_ID() ),
             * vous pouvez aller chercher un fichier content-123.php pour le post 123. 
             * S'il ne trouve pas content-123.php, WordPress utilisera content.php
             */
            get_template_part( 'template-parts/content', 'page' );
        }

        /**
         * On peut inclure ou non une zone de commentaires pour nos pages.
         * Ici, on ne va pas mettre de commentaires pour les pages.
         */
    ?>

</main>

<?php
// Pas de sidebar sur notre prototype. Pas besoin de get_sidebar();
// Puis, on peut inclure le fichier footer.php qui va fermer la zone de contenu et afficher notre pied de page.
get_footer();

    