<?php
/**
 * footer.php
 * 
 * Ce fichier contient le pied de page du site, à inclure sur toutes les pages, donc.
 * Il ferme la zone de contenu principale et affiche le footer, simplement.
 * Il est appelé par la fonction <?php get_footer; ?> qui fonctionne exactement de la même manière que <?php get_footer(); ?>
 * 
 * Il contient également la fonction <?php wp_footer(); ?> qui va placer le hook nécessaire pour ajouter le JavaScript juste avant la balise fermante </body> 
 */
?>
</div><!-- .content-area -->
    <footer class="main-footer">
        <div class="site-info">
            <?php
                /** 
                 * Ici, on va chercher les infos sur le thème, pour afficher la ligne de copyright, simplement.
                 */
                $theme = wp_get_theme( 'select' ); 
                printf( 
                    __(' Theme made with love by <a href="%1$s">%2$s</a>', 'select'),
                    esc_url( $theme->get( 'AuthorURI' ) ),
                    esc_html( $theme->get( 'Author' ) )
                ); 
            ?>
        </div>
    </footer>
    <?php wp_footer(); // Très important ! Cette fonction place un hook pour insérer des scripts à cet endroit. ?>
</body>
</html>