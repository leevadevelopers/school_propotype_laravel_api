<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class QuestionController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        try {
            /** @var array $response */
            $response = Http::withHeaders([
                "Content-Type" => "application/json",
                "Authorization" => "Bearer " . env('OPENAI_API_KEY')
            ])->post('https://api.openai.com/v1/chat/completions', [
                "model" => $request->post('model', 'gpt-4o'),
                "messages" => [
                    [
                        "role" => "user",
                        "content" => $request->post('question')
                    ]
                ],
                "temperature" => 0,
                "max_tokens" => 2048
            ])->json();

            return $response['choices'][0]['message']['content'] ?? 'Desculpe, não consegui encontrar uma resposta.';
        } catch (Throwable $e) {
            return "Chat GPT Limit Reached. This means too many people have used this demo this month and hit the FREE limit available. You will need to wait, sorry about that.";
        }
    }
}

