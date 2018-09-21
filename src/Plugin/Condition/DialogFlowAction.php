<?php

namespace Drupal\dialogflow_rules\Plugin\Condition;

use Drupal\node\NodeInterface;
use Drupal\rules\Core\RulesConditionBase;
use Drupal\api_ai_webhook\ApiAiEvent;

/**
 * Provides a 'Dialogflow Action' condition.
 *
 * @Condition(
 *   id = "rules_dialogflow_action",
 *   label = @Translation("action is of type"),
 *   category = @Translation("Chatbot"),
 *   context = {
 *     "action" = @ContextDefinition("string",
 *       label = @Translation("Dialogflow action")
 *     ),
 *     "types" = @ContextDefinition("string",
 *       label = @Translation("Content types"),
 *       description = @Translation("Check for the the allowed node types."),
 *       multiple = TRUE
 *     )
 *   }
 * )
 */
class DialogFlowAction extends RulesConditionBase {

  /**
   * Check if the event action exists in the allowed actions.
   *
   * @param \Drupal\api_ai_webhook\ApiAiEvent $request
   *   The node to check for a type.
   * @param string[] $types
   *   An array of type names as strings.
   *
   * @return bool
   *   TRUE if the action is in the array of types.
   */
  protected function doEvaluate(ApiAiEvent $event, array $types) {
    $request = $event->getRequest();
    $data = $request->request->get('queryResult');
    //structure = request.body.queryResult.action
    //var_dump($data['action']);
    \Drupal::logger('dialogflow_rules')->notice('testing condition (action)');
    \Drupal::logger('dialogflow_rules')->notice($data['action']);
    return in_array($data['action'], $types);
  }
}
