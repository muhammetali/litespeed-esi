function cym_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count views";
}

function cym_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}

function cym_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}


function cym_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo cym_get_post_view();
    }
}

add_filter( 'manage_posts_columns', 'cym_posts_column_views' );
add_action( 'manage_posts_custom_column', 'cym_posts_custom_column_views' );

add_action( 'litespeed_esi_load-cym_esi_block', 'cym_esi_block_esi_load' );

function cym_esi_block_esi_load()
{
    do_action( 'litespeed_control_set_nocache' );
    cym_set_post_view();

    $number = get_post_meta( get_the_ID(), 'post_views_count', true );
    $abbrevs = array(
        12 => 'T',
        9  => 'Mr',
        6  => 'Mn',
        3  => 'B',
        0  => '',
    );

    if ( $number > 999 ) {
        foreach ( $abbrevs as $exponent => $abbrev ) {
            if ( $number >= pow( 10, $exponent ) ) {
                $display_num = $number / pow( 10, $exponent );
                $decimals    = ( $exponent >= 3 && round( $display_num ) < 100 ) ? 1 : 0;
                return number_format( $display_num, $decimals ) . $abbrev;
            }
        }
    } else {
        echo $number;
    }
}
