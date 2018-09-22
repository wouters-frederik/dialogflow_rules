<?php

namespace Drupal\dialogflow_rules\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Represent various chatbot events.
 *
 * @see rules_entity_presave()
 */
class DialogFlowWebhookEvent extends GenericEvent {
  const EVENT_NAME = 'dialogflow_rules_webhook';
}
