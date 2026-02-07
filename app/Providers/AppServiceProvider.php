<?php

namespace App\Providers;

use App\Contracts\AiChatService;
use App\Services\HuggingFacePhiService;
use App\Services\OllamaService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $driver = config('services.ai.driver', 'ollama');

        $this->app->bind(AiChatService::class, function ($app) use ($driver) {
            return match ($driver) {
                'huggingface' => $app->make(HuggingFacePhiService::class),
                'ollama' => $app->make(OllamaService::class),
                default => $app->make(OllamaService::class),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
