/**
 * @file
 * Javascript for the Stickytoolbar reset.
 */
(function ($) {
  Drupal.behaviors.sticky_toolbar_reset = {
    attach: function (context, settings) {

      function reset_default_css() {
        $('body').removeClass('toolbar-fixed');
        $('body').removeClass('toolbar-tray-open');
        $('.toolbar-tray').removeClass('is-active');
      }

      reset_default_css();
    }
  };
})(jQuery);