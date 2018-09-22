<?php

namespace Drupal\dialogflow_rules\Plugin\Condition;

use Drupal\node\NodeInterface;
use Drupal\rules\Core\RulesConditionBase;
use Drupal\api_ai_webhook\ApiAiEvent;

/**
 * Provides a 'Dialogflow Action' condition.
 *
 * @Condition(
 *   id = "rules_dialogflow_language",
 *   label = @Translation("intent language"),
 *   category = @Translation("Chatbot"),
 *   context = {
 *     "event" = @ContextDefinition("dialogflow:event",
 *       label = @Translation("Dialogflow event")
 *     ),
 *     "language" = @ContextDefinition("string",
 *       label = @Translation("Dialogflow language")
 *     )
 *   }
 * )
 */
class DialogFlowLanguage extends RulesConditionBase {

  /**
   * Check if the event action exists in the allowed actions.
   *
   * @param \Drupal\api_ai_webhook\ApiAiEvent $request
   *   The node to check for a type.
   * @param string $language
   *   The type to check for.
   *
   * @return bool
   *   TRUE if the action is the correct language.
   */

  protected function doEvaluate(ApiAiEvent $event, string $language) {
    var_dump('EVAL LANGUAGE');
    $request = $event->getRequest();
    $data = $request->request->get('queryResult');
    \Drupal::logger('dialogflow_rules')->notice('testing condition (language) ' . $language . ' - ' . $data['languageCode']);
    return ($data['languageCode'] == $language);

  }
}
