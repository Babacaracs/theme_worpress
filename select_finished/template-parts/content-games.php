<?php
/**
 * content-games.php
 * 
 * Ce fichier est responsable de l'affichage d'un post du CPT "Games" sur la page d'archive des jeux.
 */
?>
<?php 
/** 
 * Ajouter l'ID de l'article peut être utile. post_class() génère des classes CSS très utiles, en fonction des données du post. 
 *  Par exemple, on aura une classe CSS en fonction de la catégorie, des étiquettes, du format, etc...
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   
    <figure>
        <?php the_post_thumbnail(); ?>
        <figcaption class="game-caption">
            <a href="<?php echo get_permalink(); ?>">
                <h2 class="game-title h6"><?php the_title(); ?></h2>
            </a>    
        </figcaption>
    </figure>
 
</article>