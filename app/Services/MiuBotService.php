<?php
/**
 * Created by PhpStorm.
 * User: 馬爺
 * Date: 2018/10/6
 * Time: 下午 01:52
 */

namespace App\Services;


use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class MiuBotService
{
    protected $bot;
    protected $textMessageBuilder;

    public function __construct()
    {
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $this->bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_CHANNEL_SECRET')]);

    }

    public function reply($replyMessage, $replyToken)
    {
        $textMessageBuilder = new TextMessageBuilder($replyMessage);

        $response = $this->bot->replyMessage($replyToken, $textMessageBuilder);
        if ($response->isSucceeded()) {
            Log::info('Reply Success!');
            return;
        }

        // Failed
        Log::info($response->getHTTPStatus() . ' ' . $response->getRawBody());
    }
}
