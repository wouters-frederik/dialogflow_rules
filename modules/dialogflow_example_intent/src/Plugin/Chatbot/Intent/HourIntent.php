<?php

namespace Drupal\dialogflow_rules\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "projects/restobot-hfb/agent/intents/3c4c7294-0d8f-4d8f-9d75-31dce3bfcc45",
 *   label = @Translation("hour intent")
 * )
 */
class HourIntent extends IntentPluginBase {

  /**
   * {@inheritdoc}
   */
  public function process() {
    $this->response->setIntentResponse('According to my heroku container the time is ' . date('G') . ' hours and ' . date('i') . ' minutes.');
    //$this->response->setIntentDisplayCard('Hi to everyone!', 'Greetings');
  }

}
