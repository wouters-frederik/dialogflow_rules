<?php
/**
 * @file
 * Contains \Drupal\dialogflow_rules\EventSubscriber\DialogFlowWebhookEventSubscriber.
 */

namespace Drupal\dialogflow_rules\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Drupal\api_ai_webhook\ApiAiEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\dialogflow_rules\Event\DialogFlowWebhookEvent;
use Drupal\chatbot_api_apiai\IntentResponseApiAiProxy;
use Drupal\chatbot_api_apiai\IntentRequestApiAiProxy;

/**
 * Event Subscriber MyEventSubscriber.
 */
class DialogFlowWebhookEventSubscriber implements EventSubscriberInterface {

  /**
   * Code that should be triggered on event specified
   */
  public function onRespond(ApiAiEvent $DfEvent) {
    $event = new DialogFlowWebhookEvent($DfEvent);

    //Trigger the rules stuff.
    $event_dispatcher = \Drupal::service('event_dispatcher');
    $event_dispatcher->dispatch("dialogflow_rules_webhook", $event);

    $request = new IntentRequestApiAiProxy($DfEvent->getRequest());
    $response = new IntentResponseApiAiProxy($DfEvent->getResponse());

    // The answer to your bot framework:
    $response->setIntentResponse('Rules processing triggered!');
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[ApiAiEvent::NAME][] = ['onRespond'];
    return $events;
  }

}
