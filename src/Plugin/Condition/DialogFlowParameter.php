<?php

namespace Drupal\dialogflow_rules\Plugin\Condition;

use Drupal\node\NodeInterface;
use Drupal\rules\Core\RulesConditionBase;
use Drupal\api_ai_webhook\ApiAiEvent;

/**
 * Provides a 'Dialogflow Parameter' condition.
 *
 * @Condition(
 *   id = "rules_dialogflow_parameter",
 *   label = @Translation("request contains parameters"),
 *   category = @Translation("Chatbot"),
 *   context = {
 *     "parameter" = @ContextDefinition("dialogflow:parameter",
 *       label = @Translation("Dialogflow parameter")
 *     ),
 *     "types" = @ContextDefinition("string",
 *       label = @Translation("values"),
 *       description = @Translation("Check for the the required values."),
 *       multiple = TRUE
 *     )
 *   }
 * )
 */
class DialogFlowParameter extends RulesConditionBase {

  /**
   * Check if the event parameter exists in the allowed actions.
   *
   * @param \Drupal\api_ai_webhook\ApiAiEvent $request
   *   The node to check for a type.
   * @param string[] $types
   *   An array of type names as strings.
   *
   * @return bool
   *   TRUE if the parameter is in the array of types.
   */
  protected function doEvaluate(ApiAiEvent $event, array $types) {
    var_dump('EVAL PARAMETER');
    $request = $event->getRequest();
    $data = $request->request->get('queryResult');
    $parameters = $data['parameters'];
    \Drupal::logger('dialogflow_rules')
      ->notice('testing condition (parameters)');
    \Drupal::logger('dialogflow_rules')->notice(print_r($parameters,true));
    return in_array($data['parameters'], $types);
  }
}
