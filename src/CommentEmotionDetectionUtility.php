<?php

namespace Drupal\comment_emotion_detection;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\comment_emotion_detection\EmotionDetectionApiPluginManager;

/**
 * Class CommentEmotionDetectionUtility.
 */
class CommentEmotionDetectionUtility {

  /**
   * Config Factory service object.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Emotion detection api plugin manager service.
   *
   * @var \Drupal\comment_emotion_detection\EmotionDetectionApiPluginManager
   */
  protected $emotionDetectionManager;

  /**
   * Constructs a new AlshayaI18nHelper object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\comment_emotion_detection\EmotionDetectionApiPluginManager $emotionDetectionManager
   *   motion detection api plugin manager service.
   */
  public function __construct(ConfigFactoryInterface $config_factory,
                              EmotionDetectionApiPluginManager $emotionDetectionManager) {
    $this->configFactory = $config_factory;
    $this->emotionDetectionManager = $emotionDetectionManager;
  }

  /**
   * Get mapping between Drupal language code and Magento language code.
   *
   * @return array
   *   Mapping between Drupal language code and Magento language code
   */
  public function processComment($comment) {
    $comment_body = $comment->get('comment_body')->value;

    $emotion_detection_api_settings = $this->configFactory->get('comment_emotion_detection.emotion_detection_api_settings');
    $enabled_api_id = $emotion_detection_api_settings->get('selected_emotion_detection_api');
    $enabled_api_definition = $this->emotionDetectionManager->getDefinition($enabled_api_id);

    /** @var \Drupal\comment_emotion_detection\EmotionDetectionApiInterface $emotion_detection_api */
    $emotion_detection_api = $this->emotionDetectionManager->createInstance($enabled_api_id, $enabled_api_definition);

    // Send the text to the API for evaluation.
    $emotion = $emotion_detection_api->getEmotion($comment_body);

    // Once we have the response, we need to make sure that it is in a standard format.

  }

}
