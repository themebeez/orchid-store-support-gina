<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themebeez.com
 * @since             1.0.0
 * @package           Orchid_Store_Support_Gina
 *
 * @wordpress-plugin
 * Plugin Name:       Orchid Store Support Gina
 * Plugin URI:        https://github.com/themebeez/orchid-store-support-gina
 * Description:       
 * Version:           1.0.0
 * Author:            Themebeez
 * Author URI:        https://themebeez.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       orchid-store-support-gina
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ORCHID_STORE_SUPPORT_GINA_VERSION', '1.0.0' );

if ( ! function_exists( 'orchid_store_support_gina_after_theme_setup' ) ) {

    function orchid_store_support_gina_after_theme_setup() {

        if ( function_exists( 'orchid_store_desktop_site_identity_action' ) ) {
            remove_action( 'orchid_store_desktop_site_identity', 'orchid_store_desktop_site_identity_action', 10 );
            add_action( 'orchid_store_desktop_site_identity', 'orchid_store_support_gina_desktop_site_identity_action', 10 );
        }

        if ( function_exists( 'orchid_store_mobile_site_identity_action' ) ) {
            remove_action( 'orchid_store_mobile_site_identity', 'orchid_store_mobile_site_identity_action', 10 );
            add_action( 'orchid_store_mobile_site_identity', 'orchid_store_support_gina_mobile_site_identity_action', 10 );
        }        

        if ( function_exists( 'orchid_store_pro_site_identity_template' ) ) {
            remove_action( 'orchid_store_site_identity', 'orchid_store_pro_site_identity_template' );
            add_action( 'orchid_store_site_identity', 'orchid_store_support_gina_site_identity' );
        }   

        // if ( function_exists( 'orchid_store_product_search_action' ) ) {
        //     remove_action( 'orchid_store_product_search', 'orchid_store_product_search_action', 10 );
        //     add_action( 'orchid_store_product_search', 'orchid_store_support_gina_product_search_template', 10 );
        // }
    }
    add_action( 'after_setup_theme', 'orchid_store_support_gina_after_theme_setup', 10 );
}

if ( ! function_exists( 'orchid_store_support_gina_desktop_site_identity_action' ) ) {
    
    function orchid_store_support_gina_desktop_site_identity_action() {
        ?>
        <div class="site-branding">
            <?php
            if( has_custom_logo() ) {

                if( is_front_page() && ! wp_is_mobile() ) {
                    ?>
                    <span class="site-logo">
                    <?php
                }

                the_custom_logo();

                if( is_front_page() && ! wp_is_mobile() ) {
                    ?>
                    </span>
                    <?php
                }
            } else {

                if ( is_front_page() && ! wp_is_mobile() ) :
                    ?>
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </span><!-- .site-title -->
                    <?php
                else :
                    ?>
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </span><!-- .site-title -->
                    <?php
                endif;
                $site_description = get_bloginfo( 'description', 'display' );
                if ( $site_description || is_customize_preview() ) {
                    ?>
                    <p class="site-description"><?php echo esc_html( $site_description ); // phpcs:ignore. ?></p> 
                    <?php
                }
            }
            ?>
        </div><!-- site-branding -->
        <?php
    }
}

if ( ! function_exists( 'orchid_store_support_gina_mobile_site_identity_action' ) ) {
    
    function orchid_store_support_gina_mobile_site_identity_action() {
        ?>
        <div class="site-branding">
            <?php

            $mobile_logo = orchid_store_get_option( 'logo_mobile' );

            if( has_custom_logo() || $mobile_logo ) {

                if( is_front_page() && wp_is_mobile() ) {
                    ?>
                    <span class="site-logo">
                    <?php
                }

                if( $mobile_logo ) {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="mobile-logo" src="<?php echo esc_url( $mobile_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    </a>
                    <?php
                } else {
                    the_custom_logo();
                }

                if( is_front_page() && wp_is_mobile() ) {
                    ?>
                    </span>
                    <?php
                }
            } else {

                if ( is_front_page() && wp_is_mobile() ) :
                    ?>
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </span><!-- .site-title -->
                    <?php
                else :
                    ?>
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </span><!-- .site-title -->
                    <?php
                endif;
                $site_description = get_bloginfo( 'description', 'display' );
                if ( $site_description || is_customize_preview() ) {
                    ?>
                    <p class="site-description"><?php echo esc_html( $site_description ); // phpcs:ignore. ?></p> 
                    <?php
                }
            }
            ?>
        </div><!-- site-branding -->
        <?php
    }
}

if ( ! function_exists( 'orchid_store_support_gina_site_identity' ) ) {
    
    function orchid_store_support_gina_site_identity() {
        ?>
        <div class="site-branding">
            <?php

            $mobile_logo = get_theme_mod( 'logo_mobile', '' );

            if( has_custom_logo() || $mobile_logo ) {

                if( is_front_page() ) {
                    ?>
                    <span class="site-logo">
                    <?php
                }

                if( ! wp_is_mobile() ) {

                    the_custom_logo();
                } else {

                    if( $mobile_logo ) {
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img class="mobile-logo" src="<?php echo esc_url( $mobile_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        </a>
                        <?php
                    } else {
                        
                        the_custom_logo();
                    }
                }
                

                if( is_front_page() ) {
                    ?>
                    </span>
                    <?php
                }
            } else {

                if ( is_front_page() ) :
                    ?>
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </span><!-- .site-title -->
                    <?php
                else :
                    ?>
                    <span class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    </span><!-- .site-title -->
                    <?php
                endif;
                $site_description = get_bloginfo( 'description', 'display' );
                if ( $site_description || is_customize_preview() ) {
                    ?>
                    <p class="site-description"><?php echo esc_html( $site_description ); // phpcs:ignore. ?></p> 
                    <?php
                }
            }
            ?>
        </div><!-- site-branding -->
        <?php
    }
}





if ( ! function_exists( 'orchid_store_support_gina_product_search_template' ) ) {

    function orchid_store_support_gina_product_search_template() {

        $mobile_product_search_class = '';

        if ( orchid_store_get_option( 'display_product_search_form_on_mobile' ) ) {

            $mobile_product_search_class = 'os-mobile-show';
        }
        ?>
        <div class="custom-search <?php echo esc_attr( $mobile_product_search_class ); ?>">
            <?php 
            if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
                echo do_shortcode('[fibosearch]');
            } else {
                get_product_search_form();
            }
            ?>
        </div><!-- .custom-search -->
        <?php
    }
}











