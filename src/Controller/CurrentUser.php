<?php
/**
 * @file
 * Contains \Drupal\sticky_toolbar\Controller\CurrentUser.
 */
namespace Drupal\sticky_toolbar\Controller;

use Drupal\Core\Controller\ControllerBase;
use \Drupal\user\Entity\User;

class CurrentUser extends ControllerBase {
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

        if ($userData->get('sticky_toolbar', $this->user, 'sticky') !== null) {
            $setting = $userData->get('sticky_toolbar', $this->user, 'sticky');
        }
        else {
            $setting = FALSE;
        }
        return $setting;
    }

    /**
     * {@inheritdoc}
     */
    public function setSetting(bool $setting) {
        /** @var UserDataInterface $userData */
        $userData = \Drupal::service('user.data');
        if ($userData->get('sticky_toolbar', $this->user, 'sticky') !== $setting) {
            $userData->set('sticky_toolbar', $this->user, 'sticky', $setting);
        }
        return TRUE;
    }

}
