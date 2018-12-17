<?php
/**
 * header.php
 * 
 * Ce fichier va contenir tout ce qui sera répété sur les pages de notre thème, avant le contenu à proprement parler.
 * Plus précisément, il va contenir l'entête de notre document, la navigation, et la première balise <div class="content-area"> qui va ouvrir notre zone de contenu.
 * 
 * Ce fichier est appelé via la fonction <?php get_header(); ?>. Il ne faut donc pas oublier de l'inclure dans nos template.
 * A noter que la fonction admet un paramètre (une chaine de caractères) qui va permettre d'aller chercher un autre header, si besoin est.
 * Ainsi, <?php get_header('toto'); ?> va ordonner à WordPress d'aller chercher le fichier header-toto.php
 * 
 */
?>
<?php
/**
 * Il ne faut pas oublier d'ajouter l'attribut de langue sur la balise <html> à l'aide de <?php language_attribute(); ?>
 * La balise <head> ne doit pas contenir grand chose, vu que toutes les feuilles de styles et scripts sont gérés par
 * les fonctions <?php wp_enqueue_style; ?> et <?php wp_enqueue_script(); ?> dans functions.php. 
 * Par contre, il ne faut pas oublier <?php wp_head(); ?>. Sans elle,pas possible d'écrire dans la balise <head> 
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta <?php bloginfo( 'charset' ); ?> />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); // Cette fonction est essentielle, car un place un hook dans notre thème, que WordPress va utiliser pour écrire dans la balise <head>. Sans cette fonction, aucun plugin ne peut ajouter d'éléments dans cette balise.?>
</head>
<body <?php body_class(); // Hyper utile, body_class() va générer des classes CSS bien pratiques. ?>>
    <a href="#content" class="skip-link screen-reader-text"><?php esc_html_e( 'Skip to content', 'select' ); // On rends le texte traduisible. Pas de texte codé en dur !!!?></a>
    
    <header class="main-header">
        <nav class="navbar">
            <?php select_logo(); ?>
            <button class="menu-button" aria-controls="menu" aria-expanded="false">
                <svg class="menu-icon" viewBox="0 0 16 16">
                    <path d="M0,14h16v-2H0V14z M0,2v2h16V2H0z M0,9h16V7H0V9z"/>
                </svg>
                <span class="screen-reader-text"><?php esc_html_e( 'Menu', 'select' ); ?></span>
            </button>
            <div class="menu-wrapper">
                <button class="menu-close" aria-controls="menu" aria-expanded="false">
                    <svg class="menu-icon" viewBox="0 0 16 16">
                        <polygon fill="#231F20" points="14.7,2.7 13.3,1.3 8,6.6 2.7,1.3 1.3,2.7 6.6,8 1.3,13.3 2.7,14.7 8,9.4 13.3,14.7 14.7,13.3 9.4,8" >
                    </svg>
                    <span class="screen-reader-text"><?php esc_html_e( 'Close Menu', 'select' ); ?></span>
                </button>
                <?php
                    /**
                     * Déclarons notre menu avec wp_nav_menu().
                     * Les paramètres par défaut conviennent pour notre thème, sauf 'container'.
                     */ 
                    wp_nav_menu( array(
                        'container'      => false,    // Je ne veux pas de conteneur, donc je lui passe false.
                        'theme_location' => 'menu-1'  // Je veux afficher le contenu enregistré dans la zone de menu 'menu-1' déclarée dans functions.php
                    ) ); 
                ?> 
            </div>
        </nav>
        <?php
            /**
             * Cette section affiche le titre et la description du site sur la page d'accueil (front-page).
             * On vérifie juste qu'il y a bien une description avant de l'afficher.
             * 
             * Par contre, on va afficher le titre de l'article ou de la page sur les articles simples ou pages.
             */
        ?>
        <section class="title-section">
            
            <?php if( is_front_page() ) : ?>
                
                <?php 
                    /**
                     * Sur la page d'accueil, on va afficher le titre et la description du site.
                     * bloginfo() et get_bloginfo() sont bien pratiques pour chercher des infosrmations générales sur le site.
                     */
                ?>

                <h1 class="main-title"><?php bloginfo( 'name' ); ?></h1>
                <?php if( $description = get_bloginfo( 'description', 'display' ) ) : ?>
                    <p class="main-meta"><?php echo esc_html( $description ); ?></p>
                <?php endif; ?>

            <?php elseif ( is_singular() ): ?>
                
                <?php 
                    /**
                     * Ici, <?php the_title(); ?> ne conviendrait pas. Simplement parce que cette fonction est faite pour être utilisée dans la boucle.
                     * Le problème devient apparent quand vous selectionnez une page comme page d'accueil, et que vous voulez lister vos articles sur une page 'Blog'.
                     * Au lieu d'avoir 'Blog' comme titre principal (c'est-à-dire de titre de la page), vous aurez le titre du premier article de la boucle.
                     * 
                     * single_post_title(); va chercher directement le titre de la page demandée.
                     * 
                     * Ensuite, on va afficher les metas seulement si on est sur une page d'article
                     */
                ?>
                <h1 class="main-title"><?php single_post_title(); ?></h1>
                <?php if( is_singular( 'post' ) ) : ?>
                    <p class="main-meta">
                        <?php select_meta(); ?>
                    </p>
                <?php endif; ?>

            <?php elseif ( is_archive() ): ?>
                
                <?php
                    /**
                     * Dans le cas d'une page d'archive, il faut afficher le titre de l'archive et la description si elle existe.
                     * Comme pour the_title(), on peut passer le balisage que l'on veut avant et après the_archive_title() et the_archive_description() dans leur paramètres
                     * Et les fonctions s'occupent de vérifier si le titre et la description n'est pas vide avant d'afficher le balisage.
                     * Donc pas de risque d'obtenir un paragraphe vide.
                     */
                    the_archive_title( '<h1 class="main-title">','</h1>');
                    the_archive_description('<div class="main-meta">','</div>');
                ?>

            <?php elseif ( is_search() ): ?>

                <?php 
                    /**
                     * On affiche simplement le terme de la recherche pour rappel. 
                     */
                ?>
                <h1 class="main-title">
                    <?php printf( esc_html__( 'Search Results for: %s', 'select' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>

            <?php elseif ( is_404() ): ?>

                <?php 
                    /**
                     * On affiche un petit message rassurant... 
                     */
                ?>
                <h1 class="main-title">
                    <?php esc_html_e( 'Oops! This is a 404 !', 'select' ); ?>
                </h1>

            <?php endif; ?>
            
        </section>
    </header>

    <div id="content" class="content-area">