<?php

namespace Drupal\dialogflow_rules\Plugin\RulesAction;

use Drupal\ban\BanIpManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\rules\Core\RulesActionBase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the 'put site offline' action.
 *
 * @RulesAction(
 *   id = "dialogflow_rules_put_site_offline",
 *   label = @Translation("Put Site Offline"),
 *   category = @Translation("Chatbot"),
 *   context = {
 *     "text" = @ContextDefinition("string",
 *       label = @Translation("Text"),
 *       description = @Translation("Put the site in maintenance mode."),
 *       default_value = NULL,
 *       required = false
 *     )
 *   }
 * )
 *
 */
class PutSiteOffline extends RulesActionBase implements ContainerFactoryPluginInterface {
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
   * Constructs the LogWebhook object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The corresponding request stack.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, RequestStack $request_stack) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->requestStack = $request_stack;
  }

  /**
   * Executes the action with the given context.
   *
   * @param string $text
   *   (optional) The text to log.
   */
  protected function doExecute($text = NULL) {
    $offline = \Drupal::state()->get('system.maintenance_mode');
    if (!$offline) {
      \Drupal::state()->set('system.maintenance_mode', TRUE);
    }
  }

}
