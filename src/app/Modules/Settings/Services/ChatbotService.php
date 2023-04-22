<?php

namespace App\Modules\Settings\Services;

use App\Modules\Settings\Models\Chatbot;
use Illuminate\Support\Facades\Cache;

class ChatbotService
{

    public function getById(Int $id): Chatbot|null
    {
        return Cache::remember('chatbot_settings_main_'.$id, 60*60*24, function() use($id){
            return Chatbot::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): Chatbot
    {
        $chatbot = Chatbot::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $chatbot->user_id = auth()->user()->id;
        $chatbot->save();

        return $chatbot;
    }

}
