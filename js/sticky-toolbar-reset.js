/**
 * @file
 * Javascript for the Sticky Toolbar reset.
 */

'use strict';

(function ($, Drupal) {
  Drupal.behaviors.sticky_toolbar_reset = {
    attach: function () {
      $('body').removeClass('toolbar-fixed');
      $('body').removeClass('toolbar-tray-open');
      $('body').css('padding-top', '40px');
      $('.toolbar-tray').removeClass('is-active');
    }
  }
})(jQuery, Drupal);
