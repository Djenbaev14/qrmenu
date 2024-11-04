<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class PhoneValidationController extends Controller
{
    public function validatePhone(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|string'
        ]);

        $phoneNumber = $request->input('phoneNumber');

        // Twilio klientini sozlash
        $twilio = new Client(config('services.twilio.account_sid'), config('services.twilio.auth_token'));

        try {
            // Telefon raqamni tekshirish va formatlash
            $number = $twilio->lookups->v1->phoneNumbers($phoneNumber)->fetch(["countryCode" => "UZ"]);

            return response()->json([
                'valid' => true,
                'formattedNumber' => $number->nationalFormat, // Milliy format: 99 123 45 67
                'internationalFormat' => $number->phoneNumber  // Xalqaro format: +998 99 123 45 67
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'valid' => false,
                'message' => 'Telefon raqami noto‘g‘ri yoki topilmadi'
            ], 400);
        }
    }
}
