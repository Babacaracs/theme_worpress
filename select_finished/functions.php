<?php 
/**
 * functions.php
 * 
 * Ce fichier contient les fonctionalités de notre thème.
 * C'est ici qu'on va déclarer les menus, les zones de widgets, les feuilles de style, les tailles personnalisées des images, 
 * et le support pour les fonctionnalités natives comme les images à la une, logo, arrière-plan personnalisés, etc...
 * 
 */

add_action( 'wp_enqueue_scripts', 'select_scripts' );
/**
 * Cette fonction va enregistrer la feuille de style et les scripts dans WordPress
 * Ainsi, quand WordPress va charger les scripts sur le hook wp_enqueue_scripts, il va prendre en compte notre feuille de style et nos scripts, et 
 * placer les balises <link> et <script> dans notre <head> et dans notre footer, à l'aide des fonction <?php wp_head(); ?> et <?php wp_footer(); ?>
 *
 **/
function select_scripts(){
    /**
     * Enregistrons notre feuille de styles principale.
     * get_stylesheet_uri renvoie l'URL vers style.css. Pratique.
     * On passe null pour le numéro de version.
     */
    wp_enqueue_style( 'select_styles', get_stylesheet_uri(), array(), null);

    /**
     * On va charger aussi notre police Titillium Web
     * On peut passer l'URL vers Google Fonts directement.
     * C'est l'exception à la règle qui dit qu'il ne faut rien hotlinker dans un thème : c'est-à-dire que toutes les ressources du thème doivent être contenues dans ses fichiers.
     */
    wp_enqueue_style( 'select_font', 'https://fonts.googleapis.com/css?family=Titillium+Web:300,300i,400,400i,700,700i&amp;subset=latin-ext', array(), null);

    /**
     * Chargeons notre JavaScript
     * La fonction wp_enqueue_script fonctionne comme wp_enqueue_style, à la différence du dernier paramètre, 
     * qui permet d'indiquer si le script est à placer dans la balise <head>, ou dans le footer juste avant la balise fermante <body>. .
     */
    wp_enqueue_script( 'select_navigation', get_theme_file_uri( '/js/navigation.js' ), array(), null, false ); // dans la balise <head>
    wp_enqueue_script( 'select_skip_link', get_theme_file_uri( '/js/skip-link-focus-fix.js' ), array(), null, true ); // en bas de page
}



add_action( 'after_setup_theme', 'select_setup' );
/**
 * Cette fonction est hookée juste après le chargement du thème, et va définir les fonctionnalités supportée par le thème.
 * On va donc y déclarer nos menus, nos zones de widgets, et toutes les autres fonctionnalités à déclarer à l'aide de la fonction <?php add_theme_support() ?>.
 **/
function select_setup(){
    /**
     * On charge le text domain du thème pour avoir les bonnes traductions. 
     * Pour l'instant, le thème est juste disponible en français et en anglais standard.
     * Les fichiers de traductions sont dans le dossier /languages/ du thème.
     */
    load_theme_textdomain( 'select', get_template_directory() . '/languages' );

    /**
     * On déclare une zone de menu àl'aide de <?php register_nav_menus ?>
     * Si on a qu'un seul menu, on peut utiliser <?php register_nav_menu ?> à la place.
     * 
     * La fonction __() permet de définir une chaine traductible. 
     * WordPress ira chercher la traduction correspondant à cette chaîne dans la langue de l'utilisateur si elle existe.
     * Le deuxième paramètre 'select' est le text-domain. Pour simplifier, c'est un identifiant permettant de grouper les chaînes ensemble.
     * 
     * Une zone de menu devrait apparaitre dans l'admininstration.
     */
    register_nav_menus( array(
        'menu-1' => __( 'Main menu', 'select' ),
    ) );

    /**
     * Maintenant, on va déclarer une zone de widget.
     * Ce sera la barre latérale du blog.
     * On utilise la fonction register_sidebar();, qui accepte un tableau.
     * Une zone de widget devrait être disponible dans l'administration.
     */
    register_sidebar( array(
        'name'          => __( 'Blog sidebar', 'select' ),                // Le nom apparaissant dans l'admininstration
        'id'            => 'sidebar-1',                                   // Un identifiant
        'description'   => __( 'The main blog widget area.', 'select' ),  // La description apparaissant dans l'admininstration
        'before_widget' => '<section id="%1$s" class="widget %2$s">',     // Le balisage avant chaque widget.
        'after_widget'  => '</section>',                                  // Le balisage après chaque widget.
        'before_title'  => '<h2 class="widget-title h4">',                // Le balisage avant le titre de chaque widget.
        'after_title'   => '</h2>',                                       // Le balisage après le titre de chaque widget.
    ) );

    /**
     * On ajoute le support pour les images à la une.
     * Avec seulement cette ligne, on permet d'ajouter la metabox dans l'administration qui va permettre le choix d'une image à la une.
     */
    add_theme_support( 'post-thumbnails' );

    /**
     * On laisse WordPress s'occuper comme un grand des balises <title>
     */
    add_theme_support( 'title-tag' );

    /*
     * On laisse aussi WordPress gérer les liens des flux RSS dans l'entête.
     */
    add_theme_support( 'automatic-feed-links' );

    /*
     * On dit à WordPress d'utiliser de l'HTML5 valide pour les formulaires et les galleries
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
    
    /**
     * On active la fonctionnalité des logos personnalisés.
     * on peut passer un tableau de paramètre à la fonction add_theme_support();
     * Le logo sera affiché sur le devant du site en utilisant the_custom_logo();
     * Voir la fonction select_logo() dans "inc/template-tags.php"
     */
    add_theme_support( 'custom-logo', array(
        'height'      => 50,    // hauteur maximale du logo
        'width'       => 200,   // largeur maximale du logo.
        'flex-height' => false, // Est-ce qu'on autorise la hauteur flexible ?
        'flex-width'  => true,  // Idem pour la largeur 
        'header-text' => array( 'site-title' ), // Classes CSS des éléments à cacher quand le logo est actif
    ) );

    /**
     * On active la fonctionnalité de l'image d'entête personnalisée.
     * Comme pour le logo, on peut passer un tableau de paramètre à la fonction add_theme_support();
     * L'image d'entête est appelée dans notre exemple à l'aide de la fonctionn passée dans le paramètre 'wp_head_callback'
     * Simplement parce que l'image n'est pas dans le balisage, mais dans les styles (c'est une image de background)
     * Il faut donc ajouter une balise <style> dans la balise <head> du thème, contenant nos styles.
     */
    add_theme_support( 'custom-header', array(
        'height'           => 260,
        'width'            => 1980,
        'flex-width'       => true,
        'flex-height'      => true,
        'wp-head-callback' => 'select_custom_header'
    ) );


    /**
     * On active la fonctionnalité de l'image de fond personnalisée.
     * Comme pour le logo et l'image d'entête, on peut passer un tableau de paramètre à la fonction add_theme_support();
     * On peut simplement définir des valeurs par défaut.
     */
    add_theme_support( 'custom-background', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) );

    /**
     * On active le support pour les grand alignements offerts par Gutenberg.
     */
    add_theme_support( 'align-wide' );
    
}


if( ! function_exists( 'select_custom_header' ) ):
/**
 * Cette fonction va gérer l'affichage de la balise <style> nécessaire pour afficher notre background-image
 **/
function select_custom_header(){
    ?>
        <style>
            .title-section {
                background-image: url("<?php header_image(); ?>");
                <?php if( $header_text_color = get_header_textcolor() ) : ?>
                    color: #<?php echo esc_attr( $header_text_color ); ?>
                <?php endif; ?>
            }
        </style>
    <?php
}
endif;


// On va charger un fichier contenant tous nos templates tags personnalisés.
include( 'inc/template-tags.php' );

// Fonctionalités additionnelles du thème, qui ne sont ni template tags, ni font partie de la configuration de base.
// En général, ce sont des filtres et autres hooks qui vienent personnaliser le thème.
include( 'inc/extras.php' );