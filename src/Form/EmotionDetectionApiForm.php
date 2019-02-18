<?php

namespace Drupal\comment_emotion_detection\Form;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form for listing all emotion detection apis available and for selecting one.
 */
class EmotionDetectionApiForm extends ConfigFormBase {

  /**
   * Plugin manager for emotion detection api.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $manager;

  /**
   * Machine name for the form step.
   *
   * @var string
   */
  protected $machineName;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.comment_emotion_detection.emotion_detection_api')
    );
  }

  /**
   * Overridden constructor to load the plugin.
   *
   * @param \Drupal\Component\Plugin\PluginManagerInterface $manager
   *   Plugin manager for emotion detection api.
   */
  public function __construct(PluginManagerInterface $manager) {
    $this->manager = $manager;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'comment_emotion_detection_api_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return ['comment_emotion_detection.emotion_detection_api_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $config = $this->config('comment_emotion_detection.emotion_detection_api_settings');
    $emotion_detection_apis = [];
    foreach ($this->manager->getDefinitions() as $plugin_id => $definition) {
      $emotion_detection_apis[$plugin_id] = (string) $definition['title'];
    }

    $form['emotion_detection_apis']['selected_emotion_detection_api'] = [
      '#type' => 'select',
      '#options' => $emotion_detection_apis,
      '#default' => $config->get('selected_emotion_detection_api') ?? '',
      '#description' => $this->t('Select which emotion detection api to use.'),
    ];

    if ($config->get('selected_emotion_detection_api')) {
      $form['emotion_detection_apis']['username'] = [
        '#type' => 'textfield',
        '#default' => $config->get('username') ?? '',
        '#description' => $this->t('Enter username for the API.'),
      ];

      $form['emotion_detection_apis']['password'] = [
        '#type' => 'textfield',
        '#default' => $config->get('password') ?? '',
        '#description' => $this->t('Enter password for the API.'),
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // This form has no explicit submit action since it just shows constraints.
    $emotion_detection_api = $form_state->getValue('selected_emotion_detection_api');
    $config = $this->config('comment_emotion_detection.emotion_detection_api_settings');
    $config->set('selected_emotion_detection_api', $emotion_detection_api);
    $config->set('username', $form_state->getValue('username'));
    $config->set('password', $form_state->getValue('password'));
    $config->save();

    parent::submitForm($form, $form_state);
  }

}
