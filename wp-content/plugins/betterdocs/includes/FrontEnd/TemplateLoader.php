<?php

namespace WPDeveloper\BetterDocs\FrontEnd;
use WPDeveloper\BetterDocs\Utils\Base;
use WPDeveloper\BetterDocs\Utils\Views;
use WPDeveloper\BetterDocs\Utils\Database;
use WPDeveloper\BetterDocs\Dependencies\DI\Container;

class TemplateLoader extends Base {
    public $is_fse_theme = false;
    private $templates_dir;
    private $block_templates_dir;
    private $container;
    private $database;
    private $views;

    public function __construct( Container $container ) {
        $this->container = $container;
        $this->database  = $this->container->get( Database::class );
        $this->views     = $this->container->get( Views::class );
    }

    public function init() {
        $this->is_fse_theme = $this->is_fse_theme();

        if ( $this->is_fse_theme ) {
            // @todo: for FSE theme
        }

        if ( ! $this->is_fse_theme ) {
            add_filter( 'archive_template', [$this, 'archive_template'] );
            add_filter( 'single_template', [$this, 'single_template'] );
        }
    }

    public function archive_template( $template ) {
        if ( get_post_type() !== 'docs' ) {
            return $template;
        }

        if ( is_embed() ) {
            return $template;
        }

        $_default_template = 'templates/archives/layout-1';
        $layout            = $this->database->get_theme_mod( 'betterdocs_docs_layout_select', 'layout-1' );
        $_template         = 'templates/archives/' . $layout;

        if ( is_tax( 'doc_category' ) ) {
            $_template         = 'templates/taxonomy-doc_category';
            $_default_template = $_template;
        } elseif ( is_tax( 'doc_tag' ) ) {
            $_template         = 'templates/taxonomy-doc_tag';
            $_default_template = $_template;
        }

        $eligible_template = $this->views->path( $_template, $_default_template );

        if ( file_exists( $eligible_template ) ) {
            $template = &$eligible_template;
        }

        return apply_filters( 'betterdocs_archives_template', $template, $layout, $_default_template, $this->views );
    }

    public function single_template( $template ) {
        if ( ! is_singular( 'docs' ) ) {
            return $template;
        }

        $_default_template = 'templates/single/layout-1';
        $layout            = $this->database->get_theme_mod( 'betterdocs_single_layout_select', 'layout-1' );
        $layout            = 'templates/single/' . $layout;

        $eligible_template = $this->views->path( $layout, $_default_template );

        if ( file_exists( $eligible_template ) ) {
            $template = &$eligible_template;
        }

        return apply_filters( 'betterdocs_single_template', $template, $layout, $_default_template, $this->views );
    }

    /**
     * Summary of is_fse_theme
     * @return bool
     *
     * @suppress PHP0417
     */
    private function is_fse_theme() {
        if ( function_exists( 'wp_is_block_theme' ) ) {
            return (bool) wp_is_block_theme();
        }
        if ( function_exists( 'gutenberg_is_fse_theme' ) ) {
            return (bool) gutenberg_is_fse_theme();
        }

        return false;
    }
}
