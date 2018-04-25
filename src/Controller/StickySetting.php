<?php
/**
 * @file
 * Contains \Drupal\sticky_toolbar\Controller\StickySetting
 */
namespace Drupal\sticky_toolbar\Controller;

use Drupal\sticky_toolbar\LoggedInUserService;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

class StickySetting extends ControllerBase {
  /**
   * @var \Drupal\sticky_toolbar\LoggedInUserService
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  public function __construct(LoggedInUserService $user) {
    $this->user = $user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('sticky_toolbar.logged_in_user');
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getUserID() {
    $userID = $this->user->getID();
    return $userID;
  }

  /**
   * {@inheritdoc}
   */
  public function getSetting() {
    /** @var UserDataInterface $userData */
    $userData = \Drupal::service('user.data');
    $setting = 0;

    if ($userData->get('sticky_toolbar', $this->getUserID(), 'sticky') !== null) {
      $setting = $userData->get('sticky_toolbar', $this->getUserID(), 'sticky');
    }

    return $setting;

    // @todo: Find more elegant way to create a single $userData variable for both Setting functions.
  }

  /**
   * @param integer $setting
   *   Boolean integer to determine sticky setting.
   * {@inheritdoc}
   */
  public function setSetting($setting) {
    /** @var UserDataInterface $userData */
    $userData = \Drupal::service('user.data');
    if (($setting <= 1 && $setting >= 0) && $this->getSetting() !== $setting) {
      $userData->set('sticky_toolbar', $this->user, 'sticky', $setting);
    }

    // @todo: Make this accept many data types and add param for setting name.
  }

}
