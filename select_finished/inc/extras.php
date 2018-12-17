<?php
/**
 * extras.php
 * 
 * Ce fichier contient les filtres, actions et autres fonctionnalités spécifiques au thème, 
 * mais qui ne sont pas des templates tags (ie des fonctions permettant d'afficher du contenu)
 */ 

add_filter( 'body_class', 'select_body_classes' );
/**
 * Ajoute des classes nécessaires sur la balise <body> pour que la mise en page fonctionne correctement
 * Nécessite que la fonction <?php body_class(); ?> soit présente sur la balise <body>.
 * 
 * @param   array  $classes  Les classes ajoutées par WordPress via body_class()
 * @return  array  $classes  La liste des classes modifiée, si besoin.
 **/
function select_body_classes( $classes ){
    /**
     * Si on est pas sur une page, dans les pages de jeux, et qu'il y a des widgets à afficher,
     * Alors, on ajoute la classe 'sidebar' sur le <body>
     */
    if( ! is_page() && ( 'game' != get_post_type() ) && is_active_sidebar( 'sidebar-1' ) ){
        $classes[] = 'sidebar';
    }
    return $classes;
}
