<?php
/**
 * content-page.php
 * 
 * Ce fichier est responsable de l'affichage du contenu d'une page. Il est appelé dans la boucle de WordPress pour l'affichage d'une page,
 * via page.php.
 * Il contient tout ce qui est entre les balises <article>.
 * Utiliser un petit fichier distinct comme celui-là pour le contenu augmente la lisibilité des templates principaux (comme index.php) 
 * et permet de réutiliser ce fichier dans un autre template. 
 * 
 */
?>
<?php 
/** 
 * Ajouter l'ID de l'article peut être utile. post_class() génère des classes CSS très utiles, en fonction des données du post. 
 * Par exemple, on aura une classe CSS en fonction de la catégorie, des étiquettes, du format, etc...
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <?php
        /**
         * Le grand ménage par rapport à content.php
         * Pas besoin du header avec les métas, ni du footer avec les étiquettes.
         */
    ?>
    
    <div class="entry-content">     
        <?php
            /**
             *  Permet d'afficher tout le contenu de l'article.
             */
            the_content();

            /**
             * Si le contenu est divisé en plusieurs pages, il faut en afficher la navigation.
             * On fait ça avec la fonction wp_link_pages().
             * Elle prend un tableau de paramètre, qui permetent de personnaliser pas mal de choses.
             * Il y a aussi un filtre qu'on peut utiliser pour personnaliser l'HTML rendu.
             * Mais pour notre exemple, on va faire simple et utiliser les paramètres par défaut.
             */
            wp_link_pages();
        ?>
    </div>
    
</article>