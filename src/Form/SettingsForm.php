<?php
/**
 * @file
 * Contains \Drupal\sticky_toolbar\src\Form\SettingsForm
 */

namespace Drupal\sticky_toolbar\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormState;
use Drupal\sticky_toolbar\Controller\StickySetting;

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
		// get user's existing settings
		$currentUser = new StickySetting();
		$setting = $currentUser->getSetting();

		// fields available on admin settings screen
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

		return $form;

		// @todo: Find more elegant way to create a single StickySetting object for both functions.
	}

	public function submitForm(array &$form, FormStateInterface $form_state) {
		$sticky = $form_state->getValue('is_sticky');
		$currentUser = new StickySetting();
		if (is_bool($sticky)) {
			$currentUser->setSetting($sticky);
		}

		$form_state->setRedirect('sticky_toolbar.admin_settings');
		$message = 'Your toolbar settings have been updated.';
		drupal_set_message($message);

		// @todo: Add error handling.
	}
}