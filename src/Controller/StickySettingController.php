<?php

/**
 * @file
 * Contains \Drupal\sticky_toolbar\Controller\StickySettingController
 */

namespace Drupal\sticky_toolbar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Cache\CacheBackendInterface;

/**
 * Sets and returns responses for Sticky Toolbar settings.
 */
class StickySettingController extends ControllerBase {
  /**
   * Gets the authenticated user's ID.
   * 
   * @return integer
   *   The Drupal user's ID.
   */
  private function getUserId() {
    $userID = \Drupal::currentUser()->id();
    return $userID;
  }

  /**
   * Gets the sticky setting from user's data.
   * 
   * @return integer
   *   The integer determining the sticky setting.
   */
  private function getStickySettingData() {
    $userData = \Drupal::service('user.data');
    $setting = $userData->get('sticky_toolbar', $this->getUserId(), 'sticky');

    return $setting;
  }

  /**
   * Sets the user's data sticky setting.
   *  
   * @param integer $setting
   *   The integer determining the sticky setting.
   */
  private function setStickySettingData($setting) {
    $userData = \Drupal::service('user.data');

    $userData->set('sticky_toolbar', $this->getUserId(), 'sticky', $setting);
  }

  /**
   * Gets the sticky setting.
   * 
   * @return integer
   *   The integer determining the sticky setting.
   */
  public function getSetting() {
    $userSettingData = $this->getStickySettingData();
    $setting = 1;

    if ($userSettingData !== null) {
      $setting = $userSettingData;
    }

    return $setting;
  }

  /**
   * Sets the sticky setting.
   *  
   * @param integer $setting
   *   The integer determining the sticky setting.
   * 
   * @todo Make this accept many data types and add param for setting name.
   */
  public function setSetting($setting) {
    $this->setStickySettingData($setting);

    // Flush asset file caches.
    \Drupal::service('asset.css.collection_optimizer')->deleteAll();
    \Drupal::service('asset.js.collection_optimizer')->deleteAll();
    _drupal_flush_css_js();
  }
}
