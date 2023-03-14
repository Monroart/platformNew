<?php

namespace App\Http\Controllers\Slots;

use App\Http\Services\Slots\SlotsService;
use Illuminate\Http\Request;

class SlotsController
{
    public function index(Request $request, SlotsService $service)
    {
        return $service->getSlotsForTeacher($request->user()['id']);
    }

    public function store(Request $request, SlotsService $service)
    {
        return $service->createSlot($request->slot, $request->user()['id']);
    }
}
