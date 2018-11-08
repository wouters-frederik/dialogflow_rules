<?php

namespace Drupal\dialogflow_example_intent\Plugin\Chatbot\Intent;

use Drupal\chatbot_api\Plugin\IntentPluginBase;
use GuzzleHttp\Client;

/**
 * Plugin implementation of chatbot intent.
 *
 * @Intent(
 *   id = "Name of the intent",
 *   label = @Translation("what is the weather?")
 * )
 */
class DialogFlowExampleIntent extends IntentPluginBase {
  private function gettext($temperature) {
    $pre = $temperature. ' degrees celcius. ';
    if ($temperature <= 0) {
      return $pre . 'Freezing cold! ';
    }elseif ($temperature > 0 && $temperature < 8) {
       return $pre . 'Rather chilly! ';
    }elseif ($temperature >= 8 && $temperature < 15) {
     return $pre . "That's ok for this time of the year. ";
    }elseif ($temperature >= 15 && $temperature < 55) {
      return $pre . "That's quite warm. ";
    }
  }

 /**
   * Do the weather request
   */
  private function doWeatherRequest(){
    $client = new Client([
        'base_uri' => 'https://services.vrt.be/',
      ]);
      $response = $client->get('weather/observations/belgische_streken?accept=application%2Fvnd.weather.vrt.be.observations_1.0%2Bjson', [
        'debug' => TRUE,
        'headers' => [
          'Content-Type' => 'application/x-www-form-urlencoded',
        ]
      ]);
      $body = $response->getBody();
      return json_decode((string) $body);
  }

  /**
   * {@inheritdoc}
   */
  public function process() {
    $data = $this->doWeatherRequest();
    foreach( $data->observations as $observation) {
      if ($observation->location == 'Centrum') {
        $temperature = $observation->temperature;
        $windspeed = $observation->wind->speed;
        $this->response->setIntentResponse($this->gettext($temperature));
        $this->response->setIntentDisplayCard($this->gettext($temperature), 'Greetings');
      }
    }
  }
}
