<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "projects/restobot-hfb/agent/intents/4eb5185a-3bb5-409f-bd1e-44b75e43c396",
 *   label = @Translation("Online intent")
 * )
 */
class OnlineIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {
    $offline = \Drupal::state()->get('system.maintenance_mode');
    if ($offline) {
      \Drupal::state()->set('system.maintenance_mode', FALSE);
    }
    $this->response->setIntentResponse('Site is now online!');
  }

}
