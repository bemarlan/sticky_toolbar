<?php
/**
 * @file
 * Contains \Drupal\sticky_toolbar\src\Form\SettingsForm
 */
namespace Drupal\sticky_toolbar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormState;
use Drupal\sticky_toolbar\Controller\StickySettingController;

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
		// Get user's existing setting.
		$currentUser = new StickySettingController();
		$setting = $currentUser->getSetting();

		// Fields available on admin settings screen.
		$form['is_sticky'] = array(
			'#type' => 'checkbox',
			'#title' => 'Make toolbar sticky',
			'#default_value' => $setting,
		);
		$form['submit'] = array(
	      '#type' => 'submit',
	      '#name' => 'submit_button',
	      '#value' => t('Save'),
	    );

		// Destroy object for memory.
  		$currentUser = null;
  		unset($currentUser);

		return $form;
		// @todo: Find more elegant way to create a single StickySettingController object for both functions.
	}

	/**
	 * {@inheridoc}
	 */
	public function submitForm(array &$form, FormStateInterface $form_state) {
		$sticky = $form_state->getValue('is_sticky');
		$currentUser = new StickySettingController();
		if (is_integer($sticky)) {
			$currentUser->setSetting($sticky);
		}

		// Destroy object for memory.
  		$currentUser = null;
  		unset($currentUser);

		$form_state->setRedirect('sticky_toolbar.admin_settings');
		$message = 'Your toolbar settings have been updated.';
		drupal_set_message($message);
		// @todo: Add error handling.
	}
}