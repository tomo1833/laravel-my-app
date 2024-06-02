<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ChatGPTController extends Controller
{
    public function chat(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . env('CHATGPT_API_KEY'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [['role' => 'user', 'content' => $request->input('message')]]
                ]
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            return response()->json(['error' => 'Request to ChatGPT API failed'], 500);
        }
    }
}
