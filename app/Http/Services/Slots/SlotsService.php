<?php

namespace App\Http\Services\Slots;

use App\Http\Services\Traits\ErrorReturnTrait;
use App\Models\SlotPeriods;
use App\Models\TeacherSlot;

class SlotsService
{
    use ErrorReturnTrait;

    const PERIODS = ['8.00-8.30', '8.30-9.00', '9.00-9.30', '9.30-10.00', '10.00-10.30', '10.30-11.00', '11.00-11.30', '11.30-12.00',
        '12.00-12.30', '12.30-13.00', '13.00-13.30', '13.30-14.00', '14.00-14.30', '14.30-15.00', '15.00-15.30', '15.30-16.00',
        '16.00-16.30', '16.30-17.00', '17.00-17.30', '17.30-18.00', '18.00-18.30', '18.30-19.00', '19.00-19.30', '19.30-20.00',
        '20.00-20.30', '20.30-21.00', '21.00-21.30', '21.30-22.00', '22.00-22.30', '22.30-23.00'];

    const LESSON_TYPE = 'lesson';
    const OPEN_TYPE = 'open';
    const CAN_TYPE = 'can';
    const REMOVE_TYPE = 'remove';

    public function getSlotsForTeacher(int $teacher_id)
    {
        try {
            $slots = TeacherSlot::query()
                ->from('teacher_slots AS ts')
                ->leftJoin('slot_periods AS sp', 'ts.period_id', '=', 'sp.id')
                ->where('ts.teacher_id', $teacher_id)
                ->select('sp.id AS period_id', 'sp.period', 'ts.day_of_the_week', 'ts.type')
                ->get();

            $periods = SlotPeriods::all();

            return [
                'status'  => 'ok',
                'slots'   => $slots,
                'periods' => $periods
            ];

        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }

    public function createSlot($slot, int $teacher_id)
    {
        try {
            switch ($slot['type']) {
                case self::OPEN_TYPE:
                    TeacherSlot::create([
                        'teacher_id'      => $teacher_id,
                        'day_of_the_week' => $slot['day'],
                        'period_id'       => $slot['interval_id'],
                        'type'            => self::OPEN_TYPE
                    ]);
                    break;
                case self::CAN_TYPE:
                    TeacherSlot::create([
                        'teacher_id'      => $teacher_id,
                        'day_of_the_week' => $slot['day'],
                        'period_id'       => $slot['interval_id'],
                        'type'            => self::CAN_TYPE
                    ]);
                    break;
                case self::LESSON_TYPE:
                    //tODO
                    break;
                case self::REMOVE_TYPE:
                    //TODO
                    break;
                default:
                    return $this->returnError('Не верный тип');
            }

            return ['status' => 'ok'];

        } catch (\Exception $e) {
            return $this->returnError($e->getMessage());
        }
    }


}
