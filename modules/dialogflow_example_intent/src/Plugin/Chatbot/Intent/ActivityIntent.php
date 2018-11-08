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
 *   id = "uitdatabank",
 *   label = @Translation("What is there to do?")
 * )
 */
class ActivityIntent extends IntentPluginBase implements ContainerFactoryPluginInterface{


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


  private function getGemeente(){
      $content = $this->requestStack->getCurrentRequest()->getContent();
      $data = json_decode($content, true);
      return $data['queryResult']['parameters']['gemeente'];
  }
  private function getDate(){
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);
        return $data['queryResult']['parameters']['date'];
    }

 /**
   * Do the request
   */
  private function activityRequest($postcode, $date){

        $apikey = getenv('UIT_API_KEY');
        $postal = '3000';//$gemeente
        $from = '2018-11-08';
        $to = '2018-11-08';
        $url = 'https://search.uitdatabank.be/events/?postalCode='.$postal.'&apiKey='.$apikey.'&dateFrom='.$from.'T18:00:00%2B01:00&dateTo='.$to.'T23:59:59%2B01:00&facets%5B%5D=types&embed=true&sort[availableTo]=asc';

    $client = new Client([
      'base_uri' => $url,
    ]);
    $response = $client->get($url);
    $body = $response->getBody();
    return json_decode((string) $body);
  }

  /**
   * {@inheritdoc}
   */
  public function process() {
    $gemeente = $this->getGemeente();
    $date = $this->getDate();
    $data = $this->activityRequest($gemeente, $date);
    $counts = [];
    foreach($data->facet->types as $type){
      $counts[] = [
       'name' => $type->name->en,
      'count' => $type->count
      ];
    }

    $msg = 'There are ' . $data->totalItems . ' events that we know of.';
    $msg = $msg . 'There are ' . $counts[0]['count'] . ' ' . $counts[0]['name'].'s and  ' . $counts[1]['count'] . ' ' . $counts[1]['name'].'s.';

    $msg = $msg . 'The first one is '.$data->member[0]->name->nl;
    $this->response->setIntentResponse($msg);
    $this->response->setIntentDisplayCard($msg, 'Activities');
  }
}
