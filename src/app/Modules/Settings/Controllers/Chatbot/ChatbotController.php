<?php

namespace App\Modules\Settings\Controllers\Chatbot;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Requests\ChatbotRequest;
use App\Modules\Settings\Services\ChatbotService;

class ChatbotController extends Controller
{
    private $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->middleware('permission:view chatbot settings detail', ['only' => ['get','post']]);
        $this->chatbotService = $chatbotService;
    }

    public function get(){
        $data = $this->chatbotService->getById(1);
        return view('admin.pages.setting.chatbot.index', compact('data'));
    }

    public function post(ChatbotRequest $request){
        try {
            //code...
            $this->chatbotService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Chatbot settings updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
