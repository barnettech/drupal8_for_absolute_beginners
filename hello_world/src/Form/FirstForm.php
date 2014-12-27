<?php
 
/**
 * @file
 * Contains \Drupal\hello_world\Form\FirstForm.
 */
 
namespace Drupal\hello_world\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
 
class FirstForm extends FormBase {
 
  /**
   *  {@inheritdoc}
   */
  public function getFormId() {
    return 'first_form';
  }
 
  /**
   * {@inheritdoc}
   *
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The request object.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Use the Form API to define form elements.
    $form['message'] = array(
      '#title' => t('Enter your message to insert into the hello_world table'),
      '#type' => 'textarea',
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }
 
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validate the form values.
  }
 
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $account = \Drupal::currentUser();
    db_query("INSERT INTO hello_world (uid, message, timestamp) values(:uid, :message, :timestamp)", array(':uid' => $account->id(), ':message' => $form_state->getValue('message'), ':timestamp' => time()));
    drupal_set_message('Your form was submitted successfully, you typed in the body ' . $form_state->getValue('message'));
    drupal_set_message('A new row was entered into the hello_world table! ');
  }
 
}
