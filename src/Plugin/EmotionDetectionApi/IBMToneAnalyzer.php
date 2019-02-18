<?php

namespace Drupal\comment_emotion_detection\Plugin\EmotionDetectionApi;

use Drupal\comment_emotion_detection\EmotionDetectionApiBase;

/**
 * Provides the IBM Tone Analyzer API.
 *
 * @EmotionDetectionApi(
 *   id = "ibm_tone_analyzer",
 *   title = @Translation("IBM Tone Analyzer"),
 *   description = @Translation("Provides the IBM Tone Analyzer API.")
 * )
 */
class IBMToneAnalyzer extends EmotionDetectionApiBase {
  /**
   * {@inheritdoc}
   */
  public function getEmotion(string $comment_text) {
    $test = $comment_text;
    return parent::getEmotion($comment_text);
  }

}
