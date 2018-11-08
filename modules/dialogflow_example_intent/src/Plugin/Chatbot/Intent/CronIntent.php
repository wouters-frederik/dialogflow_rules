<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "8c7e072f-6c03-4edb-9d04-235b4bff717d",
 *   label = @Translation("cron intent")
 * )
 */
class CronIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {

    $msg = 'Cron run triggered.';
    $this->response->setIntentResponse($msg);
    $this->response->setIntentDisplayCard($msg, 'Cron run');
    \Drupal::service('cron')->run();
  }

}
