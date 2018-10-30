<?php

namespace Drupal\dialogflow_rules\Plugin\Condition;

use Drupal\node\NodeInterface;
use Drupal\rules\Core\RulesConditionBase;
use Drupal\api_ai_webhook\ApiAiEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Provides a 'Dialogflow Intent' condition.
 *
 * @Condition(
 *   id = "rules_dialogflow_intent",
 *   label = @Translation("intent name"),
 *   category = @Translation("Chatbot"),
 *   context = {
 *     "intent" = @ContextDefinition("string",
 *       label = @Translation("Dialogflow intent")
 *     )
 *   }
 * )
 */
class DialogFlowIntent extends RulesConditionBase  implements ContainerFactoryPluginInterface {


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
   * Check if the event action exists in the allowed actions.
   *
   * @param \Drupal\api_ai_webhook\ApiAiEvent $request
   *   The node to check for a type.
   * @param string $intent
   *   The intent to check for.
   *
   * @return bool
   *   TRUE if the action is the correct action.
   */
  protected function doEvaluate(string $intent) {
    $content = $this->requestStack->getCurrentRequest()->getContent();
    $data = json_decode($content, true);
    return $intent == $data['queryResult']['intent']['name'];
  }
}
