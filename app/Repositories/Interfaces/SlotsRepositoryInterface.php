<?php

namespace App\Repositories\Interfaces;

interface SlotsRepositoryInterface
{
    public function getAllSlots();

    public function getSlotForTeacher();

    public function getFreeSlots();

    public function getSlotsForLesson();

    public function getCustomSlots();
}
