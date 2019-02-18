<?php

namespace Drupal\comment_emotion_detection;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Plugin manager that controls emotion detection apis.
 */
class EmotionDetectionApiPluginManager extends DefaultPluginManager {

  /**
   * Constructs a new EmotionDetectionApiPluginManager.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/EmotionDetectionApi', $namespaces, $module_handler, 'Drupal\comment_emotion_detection\EmotionDetectionApiInterface', 'Drupal\comment_emotion_detection\Annotation\EmotionDetectionApi');
    $this->alterInfo('comment_emotion_detection_api_info');
    $this->setCacheBackend($cache_backend, 'comment_emotion_detection_api');
  }

}
