<?php  
/**
 * @package onsus
 */
?>
<?php 
echo '<div class="post-meta">';
    $meta_elements = themesflat_layout_draganddrop(themesflat_get_opt( 'meta_elements' ));
    foreach ( $meta_elements as $meta_element ) :
        if ( 'author' == $meta_element ) {
            echo '<span class="item-meta post-author">';
                printf(
                '<svg class="meta-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2792 10.488C14.2792 12.8733 12.8732 14.2793 10.4879 14.2793H5.29988C2.90854 14.2793 1.49988 12.8733 1.49988 10.488V5.288C1.49988 2.906 2.37588 1.5 4.76188 1.5H6.09521C6.57388 1.50067 7.02455 1.72533 7.31121 2.10867L7.91988 2.918C8.20788 3.30067 8.65855 3.526 9.13721 3.52667H11.0239C13.4152 3.52667 14.2979 4.744 14.2979 7.178L14.2792 10.488Z" stroke="#73787D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.9873 9.64193H10.8106" stroke="#73787D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                            <a class="meta-text" href="%s" title="%s" rel="author">%s</a>',
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )),
                esc_attr( sprintf( esc_html__( 'View all posts by %s', 'onsus' ), get_the_author() ) ),get_the_author());
            echo '</span>';
        }   elseif ( 'date' == $meta_element ) {
                    echo '<span class="item-meta post-date">';   
                        $archive_year  = get_the_time('Y'); 
                        $archive_month = get_the_time('m'); 
                        $archive_day   = get_the_time('d');                 
                        echo '<a class="meta-text" href="'.get_day_link( $archive_year, $archive_month, $archive_day).'">'.get_the_date().'</a>';
                    echo '</span>';
        } elseif ( 'comment' == $meta_element ) {
            echo'<span class="item-meta post-comments"><i class="meta-icon icon-monal-comment" aria-hidden="true"></i><span class="meta-text">';
                    comments_number ();
            echo '</span></span>';
        } elseif ( 'view' == $meta_element ) {
            echo '<span class="item-meta post-view"><i class="meta-icon icon-monal-view" aria-hidden="true"></i>'. themesflat_get_post_views(get_the_ID()) .'</span>';
        }
    endforeach;
echo '</div>';
?>