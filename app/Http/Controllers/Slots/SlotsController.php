<?php

namespace App\Http\Controllers\Slots;

use App\Http\Services\Slots\SlotsService;
use Illuminate\Http\Request;

class SlotsController
{
    public function index(Request $request, SlotsService $service): array
    {
        return $service->getSlotsForTeacher($request->user()['id']);
    }

    public function store(Request $request, SlotsService $service): array
    {
        return $service->createSlot($request->slot, $request->user()['id']);
    }

    public function getCourseList(Request $request, SlotsService $service): array
    {
        return $service->getCourseList($request->user()['id']);
    }
}
