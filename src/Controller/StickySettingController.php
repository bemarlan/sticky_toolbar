<?php
/**
 * @file
 * Contains \Drupal\sticky_toolbar\Controller\StickySettingController
 */
namespace Drupal\sticky_toolbar\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StickySettingController extends ControllerBase {
  protected $user;

  /**
   * {@inheritdoc}
   */
  public function __construct(){
    $this->user = \Drupal::currentUser()->id();
  }

  /**
   * {@inheritdoc}
   */
  public function getUserID() {
    $userID = $this->user;
    return $userID;
  }

  /**
   * {@inheritdoc}
   */
  public function getSetting() {
    /** @var UserDataInterface $userData */
    $userData = \Drupal::service('user.data');
    $setting = 1;

    if ($userData->get('sticky_toolbar', $this->user, 'sticky') !== null) {
      $setting = $userData->get('sticky_toolbar', $this->user, 'sticky');
    }

    return $setting;
    // @todo: Find more elegant way to create a single $userData variable for both Setting functions.
  }

  /**
   * @param integer $setting
   *   The boolean integer determining the sticky setting.
   * {@inheritdoc}
   */
  public function setSetting($setting) {
    /** @var UserDataInterface $userData */
    $userData = \Drupal::service('user.data');
    if (($setting <=1 && $setting >= 0) && $this->getSetting() !== $setting) {
      $userData->set('sticky_toolbar', $this->user, 'sticky', $setting);
    }

    // reset cache each time the user updates their setting
    $this->sticky_toolbar_set_cache($setting);
    // @todo: Make this accept many data types and add param for setting name.
  }

  /*
   * Wrapper for cache setting.
   * Set cache each time the user updates their setting.
   * @param: key - an arbitrary name given to the cached data
   *         setting - the user's sticky setting 
   * @return: the data that was cached
   */
  function sticky_toolbar_set_cache($setting, $key = 'setting') {
    $data = $setting;
    \Drupal::cache()->set($key, $data);
    return $data;
  }

}
