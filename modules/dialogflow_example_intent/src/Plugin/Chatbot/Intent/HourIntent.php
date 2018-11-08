<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "hourIntent",
 *   label = @Translation("hour intent")
 * )
 */
class HourIntent extends IntentPluginBase {

  /**
   * {@inheritdoc}
   */
  public function process() {
    $msg = 'According to my heroku container the time is ' . date('G') . ' hours and ' . date('i') . ' minutes.';
    $this->response->setIntentResponse($msg);
     $this->response->setIntentDisplayCard($msg, 'Time check');
  }

}
