/**
 * @file
 * Javascript for the Sticky Toolbar reset.
 */
(function ($) {
  Drupal.behaviors.sticky_toolbar_reset = {
    attach: function () {
      function reset_default_css() {
        $('body').removeClass('toolbar-fixed');
        $('body').removeClass('toolbar-tray-open');
        $('.toolbar-tray').removeClass('is-active');
      }
      reset_default_css();
    }
  };
})(jQuery);