<?php
/**
 * sidebar.php
 * 
 * Ce fichier contient la logique pour afficher la barre latérale du blog, et ses widgets.
 * Il est appelé par la fonction <?php get_sidebar(); ?>. Comme pour <?php get_header(); ?>, on peut passer un paramètre à la fonction pour aller chercher une autre sidebar.
 * Par exemple, <?php get_sidebar('page'); ?> va permettre de chercher le fichier sidebar-page.php
 * 
 */
?>

<?php if( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <aside class="main-widget-area">
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
    </aside>
<?php endif; ?>