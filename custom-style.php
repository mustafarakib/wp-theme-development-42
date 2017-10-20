<?php
if ( ! function_exists( 'stock_mr_google_fonts_url' ) ) :
    /**
     * Register Google fonts.
     *
     * @return string Google fonts URL for the theme.
     */
    function stock_mr_google_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = ':300,300i,400,400i,500,500i,700,700i,900,900i';


        $body_font = cs_get_option('body_font') ['family'];
        $body_font .= $subsets;

        $heading_font = cs_get_option('heading_font') ['family'];
        $heading_font .= $subsets;

        /* translators: If there are characters in your language that are not supported by this font,
        translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_html_x( 'on', 'Karla font: on or off', 'stock-mr' ) ) {
            $fonts[] = $body_font;
        }

        /* translators: If there are characters in your language that are not supported by this font,
        translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'stock-mr' ) ) {
            $fonts[] = $heading_font;
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
            ), 'https://fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function stock_mr_prefix_scripts() {
    // add custom fonts, used in the main stylesheet
    wp_enqueue_style( 'stock-mr-google-fonts', stock_mr_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'stock_mr_prefix_scripts' );


// add inline stylesheet
function stock_mr_custom_css() {
    wp_enqueue_style( 'stock-mr-custom-style',
        get_template_directory_uri().'/assets/css/custom-style.css');

    $body_font = cs_get_option('body_font') ['family'];
    $heading_font = cs_get_option('heading_font') ['family'];

    $custom_css = '
        body {font-family: '.$body_font.'}
        h1, h2, h3, h4, h5, h6 {font-family: '.$heading_font.'}
    ';

    wp_add_inline_style('stock-mr-custom-style',$custom_css);
}
add_action( 'wp_enqueue_scripts', 'stock_mr_custom_css' );
