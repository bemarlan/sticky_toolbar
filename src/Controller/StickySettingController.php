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
   * Constructs a PanelizerPanelsIPEController.
   *
   * @param \Drupal\sticky_toolbar\LoggedInUserService $user
   *   The logged in user service.
   */
  public function __construct(){
    $this->user = \Drupal::currentUser()->id();
  }

  /**
   * {@inheritdoc}
   */
  // public static function create(ContainerInterface $container) {
  //   return new static(
  //     $container->get('sticky_toolbar.logged_in_user');
  //   );
  // }

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
    $setting = 0;

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

    // @todo: Make this accept many data types and add param for setting name.
  }

}
