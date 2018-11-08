<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "7327f61f-8305-456c-9e1b-f3938d287420",
 *   label = @Translation("tell me a joke.")
 * )
 */
class DialogFlowJokeIntent extends IntentPluginBase implements ContainerFactoryPluginInterface{


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


  private function getName(){
      $content = $this->requestStack->getCurrentRequest()->getContent();
      $data = json_decode($content, true);
      return $data['queryResult']['parameters']['name'];
  }

 /**
   * Do the joke request
   */
  private function doJokeRequest($name){
    if (!empty($name)) {
      $url = 'jokes/random?firstName=' . $name ;
    }else{
      $url = 'jokes/random';
    }
    $client = new Client([
      'base_uri' => 'http://api.icndb.com/',
    ]);
    $response = $client->get($url);
    $body = $response->getBody();
    return json_decode((string) $body);
  }

  /**
   * {@inheritdoc}
   */
  public function process() {
    $name = $this->getName();
    $data = $this->doJokeRequest($name);
    $this->response->setIntentResponse($data->value->joke);
    $this->response->setIntentDisplayCard($data->value->joke, 'Greetings');
  }
}
