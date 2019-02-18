<?php

namespace Drupal\comment_emotion_detection\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a emotion detection api annotation object.
 *
 * @Annotation
 */
class EmotionDetectionApi extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the emotion detection type.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $title;

  /**
   * The description shown to users.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}
