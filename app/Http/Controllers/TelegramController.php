<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $update = $request->all();

        // Логируем полученное обновление от Telegram
        Log::info('Received Telegram update:', ['update' => $update]);

        // Проверяем, является ли полученное обновление от сообщения
        if (isset($update['message']['text'])) {
            $chatId = $update['message']['chat']['id'];
            $userChoice = $update['message']['text'];

            // Определяем ответ на выбранный пользователем вариант
            switch ($userChoice) {
                case 'Вариант 1':
                    $responseText = 'Вы выбрали Вариант 1';
                    break;
                case 'Вариант 2':
                    $responseText = 'Вы выбрали Вариант 2';
                    break;
                case 'Вариант 3':
                    $responseText = 'Вы выбрали Вариант 3';
                    break;
                default:
                    $responseText = 'Неизвестный выбор. Пожалуйста, выберите один из предложенных вариантов.';
                    break;
            }

            // Отправляем ответ пользователю
            Telegram::sendMessage([
                'chat_id' => $chatId,
                'text' => $responseText,
            ]);
        }

        // Возвращаем ответ Telegram (для корректной работы вебхука)
        return response()->json(['status' => 'ok']);
    }
}
