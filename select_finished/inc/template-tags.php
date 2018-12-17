<?php
/**
 * template-tags.php
 * 
 * Ce fichier va contenir tous les templates tags que l'on va créer pour éviter de dupliquer du code, et rendre nos templates plus lisible.
 * On peut utiliser la fonction <?php function_exists(); ?> pour permettre à un thème enfant de surcharger ces fonctions.
 */

if( ! function_exists( 'select_meta' ) ):
/**
 * Affiche les metas pour les articles: catégories et date de publication.
 *
 * Dés qu'un bout de code apparait sur plusieurs templates, 
 * c'est quand même bien mieux de créer une petite fonction que l'on va appeler à ces endroits, non ?
 **/
function select_meta(){
    /**
     * Ici, get_the_category_list() va permettre de récupérer la liste des liens vers les catégories de l'article.
     * Par défaut, la fonction créer une <ul>. Pour notre exemple, on les veut séparés par ', '.
     * 
     * Puis get_the_time() va permettre d'afficher la date et l'heure de l'article. 
     * On lui passe le format choisi par l'utilisateur dans les réglages.
     */
    $categories = get_the_category_list( ', ' );
    $time       = get_the_time( get_option( 'date_format' ) );
    echo '<span class="category-list">' . $categories . '</span> | <span class="post-date">' . esc_html( $time ) . '</span>';
}
endif;


if( ! function_exists( 'select_entry_footer' ) ):
/**
 * Affiche les etiquettes ans le footer de l'article, s'il y en a.
 **/
function select_entry_footer(){
    /**
     * Attention, get_the_tag_list() fonctionne un peu différemment de get_the_category_list, et ne prends pas les même paramètres.
     * On peut lui passer l'html que l'on veut avant (1er param), le séparateur (2e param), et l'html que l'on veut après (3e param)
     * 
     * Je lui donne donc mon 'Tags:', en prenant soin de le rendre traductible, 
     * puis une ', ' pour séparer les étiquettes, 
     * et enfin le '</span>' de fermeture. 
     */
    if( get_the_tag_list() ) {
        echo '<footer class="entry-footer">' . get_the_tag_list( '<span class="tag-list">' .  esc_html__( 'Tags: ', 'select' ), ', ', '</span>' ) . '</footer>';
    }
}
endif;

if( ! function_exists( 'select_logo' ) ):
/**
 * Affiche le logo personnalisé si un logo est uploadé, sinon affiche le titre du site.
 **/
function select_logo(){
    /**
     * On vérifie si la fonction existe pour ne pas créer d'erreur sur les anciennes versions de WordPress.
     */
    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
        
        the_custom_logo();

    } else {
        
        /**
         * Sinon, on affiche simplement un lien avec le titre du site.
         */
        ?>
            <a href="<?php echo esc_url( home_url() ); // On récupère l'url vers l'accueil ?>" class="site-title">
                <?php bloginfo( 'name' ); // On affiche le titre du site, simplement. ?>
            </a>
        <?php 
        
    }
}
endif;

if( ! function_exists( 'select_game_meta' ) ):
    /**
     * Affiche les metas pour les jeux: console, date de sortie et URL vers Wikipedia.
     **/
    function select_game_meta(){
        /**
         * Ici, get_the_term_list() va permettre de récupérer la liste des liens vers les termes de la taxonomie personnalisée 'console'.
         * On les veut séparés par ', '.
         * 
         * Puis get_the_time() va permettre d'afficher la date et l'heure de l'article. 
         * On lui passe le format choisi par l'utilisateur dans les réglages.
         */
        $platforms = get_the_term_list( get_the_ID(), 'platform', '', ', ', '' );
        $platforms_list = '';
        if ( ! empty( $platforms ) ){
            $platforms_list = sprintf(
                '<span>' . esc_html__( 'Platforms: %s', 'select' ) . '</span>',
                '<span class="platform-list">' . $platforms . '</span>'
            );
        }

        /**
         * Puis on va chercher les termes de la deuxième taxonomie release_year, exactement de la même manière.
         */
        $year = get_the_term_list( get_the_ID(), 'release-year', '', ', ', '' );
        $years_list = '';
        if ( ! empty( $year ) ){
            $years_list = sprintf(
                '<br /><span>' . esc_html__( 'Release Year: %s', 'select' ) . '</span>',
                '<span class="console-list">' . $year . '</span>'
            );
        }

        /**
         * Enfin, on va chercher la valeur du champ personnalisé wiki_url
         */
        $wiki_field = '';
        $wiki_url = get_post_meta( get_the_ID(), 'game_url', true );
        if( ! empty( $wiki_url ) ){
            $wiki_field = sprintf(
                '<br /><a href="%1$s">%2$s</a>',
                esc_url( $wiki_url ),
                esc_html__( 'Link to Wikipedia page', 'select' )
            );
        }

        /**
         * Si on a une des infos, on peut afficher le paragraphe.
         */
        if ( $platforms_list || $years_list || $wiki_field ){
            echo '<p class="entry-meta">' . $platforms_list . $years_list . $wiki_field. '</p>';
        }
        
    }
    endif;

