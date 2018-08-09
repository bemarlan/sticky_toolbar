<?php

/**
 * @file
 * Contains \Drupal\sticky_toolbar\src\Form\SettingsForm
 */

namespace Drupal\sticky_toolbar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormState;
use Drupal\sticky_toolbar\Controller\StickySettingController;


/**
 * Configures Sticky Toolbar settings for this user.
 */
class SettingsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'sticky_toolbar_settings_form';
  }

  /**
   * {@inheridoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $settings = new StickySettingController();
    $sticky = $settings->getSetting();

    $form['is_sticky'] = array(
      '#type' => 'checkbox',
      '#title' => 'Make toolbar sticky',
      '#default_value' => $sticky,
    );
    $form['submit'] = array(
    '#type' => 'submit',
    '#name' => 'submit_button',
    '#value' => t('Save'),
     );

    return $form;
  }

  /**
   * {@inheritdoc}
   * 
   * @todo Add error handling.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $sticky = $form_state->getValue('is_sticky');
    $settings = new StickySettingController();

    if (is_integer($sticky)) {
      $settings->setSetting($sticky);
    }

    $form_state->setRedirect('sticky_toolbar.admin_settings');
    $message = 'Your toolbar settings have been updated.';
    drupal_set_message($message);
  }
}
