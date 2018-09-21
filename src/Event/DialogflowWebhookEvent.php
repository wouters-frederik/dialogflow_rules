<?php

namespace Drupal\rules\Event;

use Symfony\Component\EventDispatcher\GenericEvent;

/**
 * Represent various entity events.
 *
 * @see rules_entity_presave()
 */
class DialogFlowWebhookEvent extends GenericEvent {
  const EVENT_NAME = 'dialogflow_rules_webhook';
}
