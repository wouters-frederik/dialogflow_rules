<?php

namespace Drupal\dialogflow_rules\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "projects/restobot-hfb/agent/intents/5c610a26-ef10-4db5-8df9-74fa669775da",
 *   label = @Translation("day intent")
 * )
 */
class DayIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {
    $msg = 'According to my heroku container it is '  . date('l');
    $this->response->setIntentResponse($msg);
    $this->response->setIntentDisplayCard($msg, 'day');
  }

}
