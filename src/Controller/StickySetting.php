<?php
/**
 * @file
 * Contains \Drupal\sticky_toolbar\Controller\StickySetting
 */
namespace Drupal\sticky_toolbar\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\user\Entity\User;

class StickySetting extends ControllerBase {
  protected $user;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->user = \Drupal::currentUser()->id();
  }

  /**
   * {@inheritdoc}
   */
  public function getID() {
    $user = $this->user;
    return $user;
  }

  /**
   * {@inheritdoc}
   */
  public function getSetting() {
    /** @var UserDataInterface $userData */
    $userData = \Drupal::service('user.data');
    $setting = FALSE;

    if ($userData->get('sticky_toolbar', $this->user, 'sticky') !== null) {
      $setting = $userData->get('sticky_toolbar', $this->user, 'sticky');
    }

    return $setting;

    // @todo: Find more elegant way to create a single $userData variable for both Setting functions.
  }

  /**
   * {@inheritdoc}
   */
  public function setSetting(int $setting) {
    /** @var UserDataInterface $userData */
    $userData = \Drupal::service('user.data');
    if ($userData->get('sticky_toolbar', $this->user, 'sticky') !== $setting) {
      $userData->set('sticky_toolbar', $this->user, 'sticky', $setting);
    }

    // @todo: Make this accept many data types and add param for setting name.
  }

}
