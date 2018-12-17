<?php
/**
 * content-excerpt.php
 * 
 * Ce fichier est responsable de l'affichage d'un article sur les pages d'archives et de résultats de recherche
 * Il est appelé par archive.php et search.php
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
         * On affiche l'entête standard des articles.
         * On affiche les metas uniquement pour les articles
         */
    ?>
   
    <header class="entry-header">
        <?php the_post_thumbnail(); // affiche l'image à la une de l'article, avec 'wp-post-image' comme classe CSS. Attention à bien ajouter le add_theme_support() correspondant dans functions.php ?>        
        <h2 class="entry-title">
            <a href="<?php the_permalink(); // Lien vers l'article?>">
                <?php the_title(); // Permet d'afficher le titre de l'article. ?>
            </a>
        </h2>
        <?php if ( 'post' == get_post_type() ) : ?>
            <p class="entry-meta"><?php select_meta(); ?></p>
        <?php endif; ?>
    </header>
   
    <div class="entry-content">     
        <?php
            // Permet d'afficher uniquement l'extrait de l'article.
            the_excerpt();
        ?>
    </div>

    <?php select_entry_footer(); ?>
    
</article>