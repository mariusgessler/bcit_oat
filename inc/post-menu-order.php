<?php
function bcitoat_queries( $query ) {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( is_post_type_archive( 'oat-courses' ) ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
        return;
	}
	
	if ( is_post_type_archive( 'oat-certifications' ) ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
        return;
    }
}
add_action( 'pre_get_posts', 'bcitoat_queries', 1 );