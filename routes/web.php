<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SafetyController;
use App\Livewire\BullyingAnalyzer;
use App\Livewire\SupportChat;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/welcome', fn () => redirect()->route('home'));
Route::get('/safety', [SafetyController::class, 'index'])->name('safety.index');
Route::get('/learn', [LearnController::class, 'index'])->name('learn.index');

Route::get('/chat', SupportChat::class)->name('chat');
Route::get('/analyze', BullyingAnalyzer::class)->name('analyze');

Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::get('/reports/{report}/download', [ReportController::class, 'download'])->name('reports.download');

Route::middleware('auth')->group(function () {
    Route::get('/communities', \App\Http\Controllers\CommunityController::class)->name('communities.index');
    Route::get('/communities/{community}', \App\Livewire\CommunityChat::class)->name('communities.show');
});

require __DIR__ . '/auth.php';
