<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\log;

class HttpController extends Controller
{
    static private $key = "ac7a131503054038980397b6e572da95";

    /**
     * @param $action
     * @param $body
     * @param false @needKey
     * @return object
     */
    public static function post($action, $body, $needKey = false): object
    {
        try {
            $body["a"] = $action;
            if ($needKey) {
                $body["Key"] = self::$key;
            }
            $post = Http::asForm()->post("https://www.999doge.com/api/web.aspx", $body);

            Log::info($body);
            Log::info($post->body());

            switch ($post) {
                case $post->serverError():
                    $data = [
                        'code' => 500,
                        'message' => 'server error code 500',
                        'data' => [],
                    ];
                    break;
                case $post->clientError():
                    $data = [
                        'code' => '401',
                        'message' => 'client error code 401',
                        'data' => [],
                    ];
                    break;
                case $post->status() === 408:
                    $data = [
                        'code' => 408,
                        'message' => 'Timeout',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'IP are blocked for 2 minutes') === true:
                    $data = [
                        'code' => 500,
                        'message' => 'You Have been blocked',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'Invalid session') === true:
                    $data = [
                        'code' => 500,
                        'message' => 'Server has been blocked',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'ChanceTooHigh') === true:
                    $data = [
                        'code' => 400,
                        'message' => ' Chance Too High',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'ChanceTooLow') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Chance Too Low',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'InsufficientFunds') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Insufficient Funds',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'NoPossibleProfit') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'No Possible Profit',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'MaxPayoutExcided') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Max Payout Exceeded',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), '999doge') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Invalid request On server Please Wait 5 minute',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'error') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Invalid Request',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'Toofast') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Too Fast',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'TooLow') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Too Small',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'LoginRequired') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Login Required',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'InvalidApiKey') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'key you provided is invalid',
                        'data' => [],
                    ];
                    break;
                case str_contains($post->body(), 'error') === true:
                    $data = [
                        'code' => 400,
                        'message' => 'Party error',
                        'data' => [],
                    ];
                    break;
                default:
                    $data = [
                        'code' => 200,
                        'message' => 'successful',
                        'data' => (object)$post->json(),
                    ];
                    break;
            }
            return (object)$data;
        } catch (Exception $e) {
            return (object)[
                'code' => 408,
                'message' => 'Timeout',
                'date' => [],
            ];
        }
    }
}


?>