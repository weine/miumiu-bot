<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineBotController extends Controller
{
    protected $bot;

    public function __construct()
    {
        $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('dBKn3JydBUarjUqbgb0L0uKDlWyiIiZc0PwMgacUxhcrzZac237OTrn5K4EuzC0LkNHHV5BGA88MBaBTlw/5pom4FzuTidHT5wA3bjUjTpH103LndnrALP3uMnl459TaCe6zVERk2m03QD2aBdwXYQdB04t89/1O/w1cDnyilFU=

'); // Channel Secret Key

        $this->bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'daeb9fb4f4f54930ada22a8af6cab9d5
']);
    }

    public function testBotSend()
    {
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
        $response = $this->bot->replyMessage('<reply token>', $textMessageBuilder);
        if ($response->isSucceeded()) {
            echo 'Succeeded!';
            return;
        }

// Failed
        echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
    }
}
