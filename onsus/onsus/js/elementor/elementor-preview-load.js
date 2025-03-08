;(function($) {
    "use strict";

    jQuery(document).ready(function(){
        //Header
        elementor.settings.page.addChangeCallback( 'style_header', handleReloadPreview );

        elementor.settings.page.addChangeCallback( 'topbar_show', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'menu_topbar', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'profile_topbar', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'language_topbar', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'currency_topbar', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'ship_topbar', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'ship_header', handleReloadPreview );

        
        elementor.settings.page.addChangeCallback( 'site_logo', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_absolute', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_sticky', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_search_box', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_sidebar_toggler', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_cart_icon', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_wishlist_icon', handleReloadPreview );

        elementor.settings.page.addChangeCallback( 'header_category', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_cart_icon2', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'header_compare_icon', handleReloadPreview );


        elementor.settings.page.addChangeCallback( 'show_thumb', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'show_cowndown', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'show_progress', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'show_configuration', handleReloadPreview );
        elementor.settings.page.addChangeCallback( 'show_delivery', handleReloadPreview );

        //Page
        elementor.settings.page.addChangeCallback( 'sidebar_layout', handleReloadPreview );
        
        //Footer
        elementor.settings.page.addChangeCallback( 'show_footer_info', handleReloadPreview );
    });

    function handleReloadPreview ( newValue ) {
        elementor.saver.saveEditor({
            status: elementor.settings.page.model.get('post_status'),
            onSuccess: () => {
                elementor.reloadPreview();

                elementor.once("preview:loaded", function() {
                    elementor.getPanelView().setPage("page_settings");
                });
            }
        })
    }

})(jQuery);