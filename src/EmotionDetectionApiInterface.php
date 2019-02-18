<?php

namespace Drupal\comment_emotion_detection;

use Drupal\Component\Plugin\ConfigurablePluginInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Plugin\PluginFormInterface;

/**
 * An interface to define the expected operations of a emotion detection api.
 */
interface EmotionDetectionApiInterface extends PluginInspectionInterface {

  /**
   * Returns a translated string for the emotion detection api title.
   *
   * @return string
   *   Title of the emotion detection api.
   */
  public function getTitle();

  /**
   * Returns a translated description for the emotion detection api description.
   *
   * @return string
   *   Description of the emotion detection api.
   */
  public function getDescription();

  /**
   * Evaluate the emotion detection api to check if it applies.
   *
   * @param string $comment_text
   *   The text of the comment.
   *
   * @return string
   *   The emotion detected from the comment.
   */
  public function getEmotion(string $comment_text);

}
