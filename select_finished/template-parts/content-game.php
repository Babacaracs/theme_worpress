<?php
/**
 * content-game.php
 * 
 * Ce fichier est responsable de l'affichage d'un post du CPT "Games" sur une page 'Game' simple.
 * Il est appelé par single-game.php
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
     * On affiche les méta-infos du jeu: c'est-à-dire les champs personnalisés et les taxonomies.
     * Puis le contenu, simplement.
     */
    select_game_meta(); 
    the_content(); 
    ?>
 
</article>