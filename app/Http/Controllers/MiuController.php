<?php

namespace App\Http\Controllers;

use App\Services\MiuBotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MiuController extends Controller
{
    protected $eventType;
    protected $replyToken;
    protected $userId;
    protected $message;

    protected $miuBotService;

    public function __construct(MiuBotService $miuBotService)
    {
        $this->miuBotService = $miuBotService;
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

        $this->miuBotService->reply($this->message, $this->replyToken);
    }
}
