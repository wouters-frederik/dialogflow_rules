<?php

namespace Drupal\dialogflow_rules\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "projects/restobot-hfb/agent/intents/cfa05e6a-4828-4bae-a5dc-1d24708a59a7",
 *   label = @Translation("flush intent")
 * )
 */
class FlushIntent extends IntentPluginBase {
  /**
   * {@inheritdoc}
   */
  public function process() {

    $this->response->setIntentResponse('The cache flush was started.');
    drupal_flush_all_caches();
  }

}
