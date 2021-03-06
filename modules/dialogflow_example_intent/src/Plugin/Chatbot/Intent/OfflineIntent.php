<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "siteoffline - yes",
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
    $msg = 'Site is now offline.';
    $this->response->setIntentResponse($msg);
     $this->response->setIntentDisplayCard($msg, 'Site offline');
  }

}
