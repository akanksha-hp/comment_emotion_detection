<?php

namespace Drupal\comment_emotion_detection;

use Drupal\Core\Plugin\PluginBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;

/**
 * A base class to define standard operations of an emotion detection api.
 */
abstract class EmotionDetectionApiBase extends PluginBase implements EmotionDetectionApiInterface {
  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    return $this->pluginDefinition['title'];
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->pluginDefinition['description'];
  }

  /**
   * {@inheritdoc}
   */
  public function getEmotion(string $comment_text) {
    return '';
  }

}
