<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "siteonline",
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
    $msg = 'Site is now Online.';
    $this->response->setIntentResponse($msg);
    $this->response->setIntentDisplayCard($msg, 'Site Online');
  }

}
