<?php

namespace Drupal\comment_emotion_detection\Plugin\EmotionDetectionApi;

use Drupal\comment_emotion_detection\EmotionDetectionApiBase;

/**
 * Provides the Azure cognitive services API.
 *
 * @EmotionDetectionApi(
 *   id = "azure_cognitive_services",
 *   title = @Translation("Azure Cognitive Services"),
 *   description = @Translation("Provides the Azure Cognitive Services API.")
 * )
 */
class AzureCognitiveServices extends EmotionDetectionApiBase {
  /**
   * {@inheritdoc}
   */
  public function getEmotion($comment_text) {

    return parent::getEmotion($comment_text);
  }

}
