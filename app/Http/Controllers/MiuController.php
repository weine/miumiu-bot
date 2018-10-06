<?php

namespace App\Http\Controllers;

use App\Services\MiuBotService;
use App\Services\RollService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiuController extends Controller
{
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

        switch ($this->message) {
            case 'roll' :
                $this->miuBotService->reply($this->rollService->numberRandom(), $this->replyToken);
                break;
            default :
                $this->miuBotService->reply($this->message, $this->replyToken);
        }
    }
}
