/**
 * @file
 * Javascript for the Sticky Toolbar reset.
 */
 
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.sticky_toolbar_reset = {
    attach: function () {
      $('body').removeClass('toolbar-fixed');
      $('body').removeClass('toolbar-tray-open');
      $('.toolbar-tray').removeClass('is-active');
    }
  };

})(jQuery, Drupal);
