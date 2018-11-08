<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "cfa05e6a-4828-4bae-a5dc-1d24708a59a7",
 *   label = @Translation("flush intent")
 * )
 */
class FlushIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {

//die('I AM HERE');
    $msg = 'The cache flush was started.';
    $this->response->setIntentResponse($msg);
    $this->response->setIntentDisplayCard($msg, 'Flushed');
    drupal_flush_all_caches();
  }

}
