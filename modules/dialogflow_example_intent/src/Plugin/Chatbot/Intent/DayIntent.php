<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "daytoday",
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
