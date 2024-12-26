<?php

namespace App\Services;

/**
 * Class NexmoService.
 */
use Illuminate\Support\Facades\Http;
class NexmoService
{
  public function sendSMS($to, $message)
  {
      $response = Http::post('https://m3xywj.api.infobip.com/sms/2/text/advanced', [
          'api_key'    => env('NEXMO_API_KEY'),
          'api_secret' => env('NEXMO_API_SECRET'),
          'to'         => $to,
          'from'       => env('NEXMO_PHONE_NUMBER'),
          'text'       => $message,
      ]);

      // Javobni tekshirish
      if ($response->successful()) {
          return true;
      } else {
          return false;
      }
  }

}
