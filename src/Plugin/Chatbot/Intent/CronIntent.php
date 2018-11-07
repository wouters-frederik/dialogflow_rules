<?php

namespace Drupal\dialogflow_rules\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "projects/restobot-hfb/agent/intents/8c7e072f-6c03-4edb-9d04-235b4bff717d",
 *   label = @Translation("cron intent")
 * )
 */
class CronIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {

    $this->response->setIntentResponse('Cron run triggered.');
    \Drupal::service('cron')->run();
  }

}
