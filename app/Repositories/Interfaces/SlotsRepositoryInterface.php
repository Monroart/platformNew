<?php

namespace App\Repositories\Interfaces;

interface SlotsRepositoryInterface
{
    public function getAllSlots();

    public function getSlotForTeacher($teacher_id);

    public function getFreeSlotsBy($request);

    public function getSlotsForLesson();

    public function getCustomSlots();
}
