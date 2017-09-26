<?php
/**
 * ProcessWire PhpStorm Meta
 *
 * This file is not a CODE, it makes no sense and won't run or validate
 * Its AST serves PhpStorm IDE as DATA source to make advanced type inference decisions.
 * 
 * @see https://confluence.jetbrains.com/display/PhpStorm/PhpStorm+Advanced+Metadata
 */

namespace PHPSTORM_META {

    $STATIC_METHOD_TYPES = [
        new \Pimple\Container => [
            '' == '@',
            'assets' instanceof Tribe\Libs\Assets\Asset_Loader,
            'cache' instanceof Tribe\Libs\Cache\Cache,
            'cache.listener' instanceof Tribe\Project\Cache\Listener,
            'cache.purger' instanceof Tribe\Libs\Cache\Purger,
            'cli.pimple_dump' instanceof Tribe\Project\CLI\Pimple_Dump,
            'menu.primary' instanceof Tribe\Libs\Nav\Menu_Location,
            'menu.secondary' instanceof Tribe\Libs\Nav\Menu_Location,
            'object_meta.collection_repo' instanceof Tribe\Libs\Object_Meta\Meta_Repository,
            'object_meta.example' instanceof Tribe\Project\Object_Meta\Example,
            'p2p.General_Relationship' instanceof Tribe\Project\P2P\Relationships\General_Relationship,
            'p2p.admin_search_filtering.General_Relationship' instanceof Tribe\Project\P2P\Admin_Search_Filtering,
            'p2p.admin_titles_filter' instanceof Tribe\Project\P2P\Titles_Filter,
            'p2p.event_query_filters' instanceof Tribe\Project\P2P\Event_Query_Filters,
            'p2p.panel_search_filters' instanceof Tribe\Project\P2P\Panel_Search_Filters,
            'p2p.query_optimization' instanceof Tribe\Project\P2P\Query_Optimization,
            'panels.init' instanceof Tribe\Project\Panels\Initializer,
            'post_type.page' instanceof Tribe\Project\Post_Types\Page\Page,
            'post_type.post' instanceof Tribe\Project\Post_Types\Post\Post,
            'post_type.sample_post_type' instanceof Tribe\Project\Post_Types\Sample\Sample,
            'post_type.sample_post_type.config' instanceof Tribe\Project\Post_Types\Sample\Config,
            'post_type.tribe_events' instanceof Tribe\Project\Post_Types\Event\Event,
            'post_type.tribe_organizer' instanceof Tribe\Project\Post_Types\Organizer\Organizer,
            'post_type.tribe_venue' instanceof Tribe\Project\Post_Types\Venue\Venue,
            'settings.general' instanceof Tribe\Project\Settings\General,
            'shortcode.gallery' instanceof Tribe\Project\Shortcodes\Gallery,
            'taxonomy.category' instanceof Tribe\Project\Taxonomies\Category\Category,
            'taxonomy.category.config' instanceof class@anonymous /mnt/c/Users/danie/Code/square-one/wp-content/plugins/core/src/Service_Providers/Taxonomies/Taxonomy_Service_Provider.php0x7f9efd5947eb,
            'taxonomy.example_taxonomy' instanceof Tribe\Project\Taxonomies\Example\Example,
            'taxonomy.example_taxonomy.config' instanceof Tribe\Project\Taxonomies\Example\Config,
            'taxonomy.post_tag' instanceof Tribe\Project\Taxonomies\Post_Tag\Post_Tag,
            'taxonomy.post_tag.config' instanceof class@anonymous /mnt/c/Users/danie/Code/square-one/wp-content/plugins/core/src/Service_Providers/Taxonomies/Taxonomy_Service_Provider.php0x7f9efd5947eb,
            'theme.body_classes' instanceof Tribe\Project\Theme\Body_Classes,
            'theme.gravity_forms_filter' instanceof Tribe\Project\Theme\Gravity_Forms_Filter,
            'theme.images.responsive_disabler' instanceof Tribe\Project\Theme\WP_Responsive_Image_Disabler,
            'theme.images.sizes' instanceof Tribe\Project\Theme\Image_Sizes,
            'theme.images.wrap' instanceof Tribe\Project\Theme\Image_Wrap,
            'theme.nav.attribute_filters' instanceof Tribe\Project\Theme\Nav\Nav_Attribute_Filters,
            'theme.oembed' instanceof Tribe\Project\Theme\Oembed_Filter,
            'theme.resources.editor_styles' instanceof Tribe\Project\Theme\Resources\Editor_Styles,
            'theme.resources.emoji_disabler' instanceof Tribe\Project\Theme\Resources\Emoji_Disabler,
            'theme.resources.fonts' instanceof Tribe\Project\Theme\Resources\Fonts,
            'theme.resources.legacy' instanceof Tribe\Project\Theme\Resources\Legacy_Check,
            'theme.resources.login' instanceof Tribe\Project\Theme\Resources\Login_Resources,
            'theme.resources.scripts' instanceof Tribe\Project\Theme\Resources\Scripts,
            'theme.resources.styles' instanceof Tribe\Project\Theme\Resources\Styles,
            'theme.supports' instanceof Tribe\Project\Theme\Supports,
            'theme_customizer.loader' instanceof Tribe\Project\Theme_Customizer\Customizer_Loader,
            'twig' instanceof Twig_Environment,
            'twig.extension' instanceof Tribe\Project\Twig\Extension,
            'twig.loader' instanceof Twig_Loader_Filesystem,
            'twig.templates.content/panels/accordion' instanceof Tribe\Project\Templates\Content\Panels\Accordion,
            'twig.templates.content/panels/cardgrid' instanceof Tribe\Project\Templates\Content\Panels\CardGrid,
            'twig.templates.content/panels/content-slider' instanceof Tribe\Project\Templates\Content\Panels\ContentSlider,
            'twig.templates.content/panels/gallery' instanceof Tribe\Project\Templates\Content\Panels\Gallery,
            'twig.templates.content/panels/hero' instanceof Tribe\Project\Templates\Content\Panels\Hero,
            'twig.templates.content/panels/imagetext' instanceof Tribe\Project\Templates\Content\Panels\ImageText,
            'twig.templates.content/panels/interstitial' instanceof Tribe\Project\Templates\Content\Panels\Interstitial,
            'twig.templates.content/panels/logofarm' instanceof Tribe\Project\Templates\Content\Panels\LogoFarm,
            'twig.templates.content/panels/micronavbuttons' instanceof Tribe\Project\Templates\Content\Panels\MicroNavButtons,
            'twig.templates.content/panels/panel' instanceof Tribe\Project\Templates\Content\Panels\Panel,
            'twig.templates.content/panels/postloop' instanceof Tribe\Project\Templates\Content\Panels\PostLoop,
            'twig.templates.content/panels/testimonial' instanceof Tribe\Project\Templates\Content\Panels\Testimonial,
            'twig.templates.content/panels/videotext' instanceof Tribe\Project\Templates\Content\Panels\VideoText,
            'twig.templates.content/panels/wysiwyg' instanceof Tribe\Project\Templates\Content\Panels\Wysiwyg,
            'twig.templates.sidebar.main' instanceof Tribe\Project\Templates\Sidebar,
            'util.svg_support' instanceof Tribe\Project\Util\SVG_Support,
        ],
    ];

}
