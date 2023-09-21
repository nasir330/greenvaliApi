<?php

use App\Http\Controllers\Api\Web\SocialLinkController;
use App\Http\Controllers\Api\Web\WebSliderController;
use App\Http\Controllers\Api\Web\WebVentureController;
use Illuminate\Support\Facades\Route;

Route::get('all-ventures', [WebVentureController::class, 'allVentureItems']);
Route::get('venture-details/{id}', [WebVentureController::class, 'ventureDetialById']);
Route::get('sliders', [WebSliderController::class, 'allSliders']);
Route::get('social-links', [SocialLinkController::class, 'socialLinks']);
