<?php

namespace Drupal\comment_emotion_detection\EventSubscriber;

use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\comment_emotion_detection\EmotionDetectionApiPluginManager;

/**
 * Class CommentEmotionDetectionSubscriber.
 *
 * @package Drupal\comment_emotion_detection
 */
class CommentEmotionDetectionSubscriber implements EventSubscriberInterface {

  /**
   * Emotion detection api plugin manager service.
   *
   * @var \Drupal\comment_emotion_detection\EmotionDetectionApiPluginManager
   */
  protected $emotionDetectionManager;

  /**
   * Config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $config;

  /**
   * Constructs a new MemoryLimitPolicySubscriber object.
   *
   * @param \Drupal\comment_emotion_detection\EmotionDetectionApiPluginManager $emotionDetectionManager
   *   Emotion detection api plugin manager service.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config
   *   Config factory service.
   */
  public function __construct(EmotionDetectionApiPluginManager $emotionDetectionManager,
                              ConfigFactoryInterface $config) {
    $this->emotionDetectionManager = $emotionDetectionManager;
    $this->config = $config;
  }

  /**
   * {@inheritdoc}
   */
  public function onRequest(GetResponseEvent $event) {
    $request = $event->getRequest();
    $config = $this->configFactory->get('emotion_detection_api_settings');

    $selected_emotion_detection_api_id = $config->get('selected_emotion_detection_api');

    $selected_emotion_detection_api_definition = $this->emotionDetectionManager->getDefinition('plugin_id');

    /** @var \Drupal\comment_emotion_detection\EmotionDetectionApiInterface $emotion_detection_api */
    $emotion_detection_api = $this->emotionDetectionManager->createInstance($selected_emotion_detection_api_id, $selected_emotion_detection_api_definition);

    $emotion = $emotion_detection_api->getEmotion('xyz');

  }

  /**
   * {@inheritdoc}
   */
  public function onResponse(FilterResponseEvent $event) {
    $request = $event->getRequest();

    $settings = $this->config->get('memory_limit_policy.settings');

    if ($settings->get('header')) {
      $response = $event->getResponse();
      $response->headers->set(
        'memory_limit',
        ini_get('memory_limit')
      );
      $response->headers->set(
        'memory_limit_policy_override',
        (int) $request->attributes->get('_memory_limit_policy_override')
      );

    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    // High priority for this subscriber to execute it soon enough.
 //   $events[KernelEvents::REQUEST][] = ['onRequest', 100];
  //  $events[KernelEvents::RESPONSE][] = ['onResponse'];
   // return $events;
  }

}
