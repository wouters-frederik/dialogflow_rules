<?php

namespace Drupal\helloworld_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "Process",
 *   label = @Translation("process intent")
 * )
 */
class ProcessIntent extends IntentPluginBase {

  /**
   * {@inheritdoc}
   */
  public function process() {
    $this->response->setIntentResponse('Hello World!');
    $this->response->setIntentDisplayCard('Hi to everyone!', 'Greetings');
  }

}
