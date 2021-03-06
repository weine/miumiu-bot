<?php

namespace App\Http\Controllers;

use App\Services\MiuBotService;
use App\Services\RollService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiuController extends Controller
{
    protected $useInfo = '哈囉~~我是MiuMiu(cony big smile)'. PHP_EOL. '功能使用說明:' . PHP_EOL . '1.應聲蟲' . PHP_EOL . '2.輸入roll可由1~100隨機取數'; //使用說明

    protected $keyWords = ['哥哥', '弟弟', '妹妹', '媽媽', '爸爸', '哈哈', '幹', '流星', 'Miu', 'miu', 'miu~'];

    protected $eventType;
    protected $replyToken;
    protected $userId;
    protected $message;

    protected $miuBotService;
    protected $rollService;

    public function __construct(
        MiuBotService $miuBotService,
        RollService $rollService
    ){
        $this->miuBotService = $miuBotService;
        $this->rollService = $rollService;
    }

    private function botRequestHandle($data)
    {
        $event = $data['events'][0];

        $this->eventType = $event['type'];
        $this->replyToken =$event['replyToken'];
        $this->userId = $event['source']['userId'];
        $this->message = $event['message']['text'];
    }

    public function miuGet()
    {
        $event = request()->all();
        Log::info(response()->json($event));
    }

    public function miuPost(Request $request)
    {
        $events = $request->all();
        Log::info(response()->json($events));
        $this->botRequestHandle($events);

        if(in_array($this->message, $this->keyWords)) {
            return;
        }

        switch ($this->message) {
//            case 'miu' :
//                $this->miuBotService->replyText($this->useInfo, $this->replyToken);
//                break;
            case 'roll' :
                $this->miuBotService->reply($this->rollService->numberRandom(), $this->replyToken);
                break;
            default :
                $this->miuBotService->reply($this->message, $this->replyToken);
        }
    }
}
