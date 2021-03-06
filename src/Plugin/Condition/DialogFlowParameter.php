<?php

namespace Drupal\dialogflow_rules\Plugin\Condition;

use Drupal\node\NodeInterface;
use Drupal\rules\Core\RulesConditionBase;
use Drupal\api_ai_webhook\ApiAiEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides a 'Dialogflow Parameter' condition.
 *
 * @Condition(
 *   id = "rules_dialogflow_parameter",
 *   label = @Translation("condition by intent parameters"),
 *   category = @Translation("Chatbot"),
 *   context = {
 *     "parameter_name" = @ContextDefinition("string",
 *       label = @Translation("Dialogflow parameter name")
 *     ),
*     "parameter_value" = @ContextDefinition("string",
 *       label = @Translation("Dialogflow parameter value")
 *     )

 *   }
 * )
 */
class DialogFlowParameter extends RulesConditionBase  implements ContainerFactoryPluginInterface {


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('request_stack')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RequestStack $request_stack) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->requestStack = $request_stack;
  }

  /**
   * Check if the parameter exists and value.
   *
   * @param string $parameter_name
   *   The param to check for.
   * @param string $parameter_value
   *   The param value to compare .
   *
   * @return bool
   *   TRUE if the action is the correct action.
   */
  protected function doEvaluate(string $parameter_name, string $parameter_value) {
    $content = $this->requestStack->getCurrentRequest()->getContent();
    $data = json_decode($content, true);
    if (isset($data['queryResult']['parameters'][$parameter_name])) {
      return $parameter_value == $data['queryResult']['parameters'][$parameter_name];
    }
    return FALSE;

  }
}
