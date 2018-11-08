<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "f1e84d3f-deca-4145-a9d3-e66baf0d9ac2",
 *   label = @Translation("greet intent")
 * )
 */
class GreetIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {

    $hour = date('H');
    $msg = '';
    if ($hour > 0 && $hour <= 4) {
        $msg = 'Good night nerds. How can I help you?';
    }
    if ($hour > 4 && $hour <= 6) {
        $msg = 'Good morning nerds. How can I help you?';
    }
    if ($hour > 6 && $hour <= 9) {
        $msg = 'Good morning  nerds. How can I help you?';
    }
    if ($hour > 9 && $hour <= 15) {
        $msg = 'Good day  nerds. How can I help you?';
    }
    if ($hour > 15 && $hour <= 18) {
        $msg = 'Good afternoon nerds. How can I help you?';
    }
    if ($hour > 18 ) {
        $msg = 'Good evening nerds. How can I help you?';
    }
    $this->response->setIntentResponse($msg);
    $this->response->setIntentDisplayCard($msg, 'Greetings');
  }

}
