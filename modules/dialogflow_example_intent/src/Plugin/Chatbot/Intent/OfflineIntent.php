<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "projects/restobot-hfb/agent/intents/31511d13-08fb-4bb9-bd8d-efbb1feffcf5",
 *   label = @Translation("Offline intent")
 * )
 */
class OfflineIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {
    $offline = \Drupal::state()->get('system.maintenance_mode');
    if (!$offline) {
      \Drupal::state()->set('system.maintenance_mode', TRUE);
    }
    $this->response->setIntentResponse('Site is now offline.');
  }

}
