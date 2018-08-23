<?php

namespace Drupal\sticky_toolbar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\user\UserDataInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configures Sticky Toolbar settings for this user.
 */
class SettingsForm extends FormBase {

  /**
   * @var Drupal\user\UserDataInterface
   */
  protected $userData;

  /**
   * @var Drupal\Core\Session\AccountInterface
   */
  protected $user;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static (
      $container->get('user.data'),
      $container->get('current_user')
    );
  }

  /**
   * Constructs the SettingsForm.
   *
   * @param Drupal\user\UserDataInterface $userData
   *   The user data.
   *
   * @param Drupal\Core\Session\AccountInterface $account
   */
  public function __construct(UserDataInterface $userData, AccountInterface $account) {
    $this->userData = $userData;
    $this->user = $account;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'sticky_toolbar_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $sticky = $this->getSetting();

    $form['is_sticky'] = [
      '#type' => 'checkbox',
      '#title' => 'Make toolbar sticky',
      '#default_value' => $sticky,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#name' => 'submit_button',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   *
   * @todo Add error handling.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $sticky = $form_state->getValue('is_sticky');

    if (is_int($sticky)) {
      $this->setSetting($sticky);
    }

    $form_state->setRedirect('sticky_toolbar.admin_settings');
    $message = 'Your toolbar settings have been updated.';
    drupal_set_message($message);
  }

  /**
   * Gets the sticky setting.
   *
   * @return int
   *   The integer determining the sticky setting.
   */
  protected function getSetting() {
    $userSettingData = $this->userData->get('sticky_toolbar', $this->user->id(), 'sticky');
    $setting = 1;

    if ($userSettingData !== NULL) {
      $setting = $userSettingData;
    }

    return $setting;
  }

  /**
   * Sets the sticky setting.
   *
   * @param int $setting
   *   The integer determining the sticky setting.
   */
  protected function setSetting($setting) {
    $this->userData->set('sticky_toolbar', $this->user->id(), 'sticky', $setting);

    // Flush asset file caches.
    \Drupal::service('asset.css.collection_optimizer')->deleteAll();
    \Drupal::service('asset.js.collection_optimizer')->deleteAll();
    _drupal_flush_css_js();
  }

}
