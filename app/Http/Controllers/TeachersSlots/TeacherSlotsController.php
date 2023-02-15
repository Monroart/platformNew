<?php

namespace App\Http\Controllers\TeachersSlots;

use App\Repositories\SlotsRepository;
use App\Http\Controllers\Controller;
use App\Models\TeacherSlot;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\LogicException;

class TeacherSlotsController extends Controller
{
    protected $slotsRepository;
    private $slots_time = [
        '', 'jpeg', 'png', 'gif'
    ];

    public function create(Request $request){
        $user = $request->user();
        $day_of_the_week = $request->input('day');
        $time = $request->input('time');
        $course = $request->input('course_id'); //отдельно сохранять какой курс в это время будет обучаться, возможно надо будет определять дату каждого назначения слота
        $teacherSlot = new TeacherSlot();
        $teacherSlot->teacher_id = $user->id;
        $teacherSlot->day_of_the_week = $day_of_the_week;
        $teacherSlot->time = $time;
        $teacherSlot->save();
    }

    public function getSlotsForTeacher(Request $request, SlotsRepository $slotsRepository){
        $this->slotsRepository = $slotsRepository;
        return $this->slotsRepository->getSlotForTeacher($request->user()->id);
    }

    public function edit(Request $request){
        $slot_id = $request->input('id');
        $TecherSlot = TeacherSlot::find($slot_id);
        try{
            $TecherSlot->time = $request->input('time');
        } catch (\Exception $e){
            unixtojd();
        } try {
            $TecherSlot->day_of_the_week = $request->input('day');
        } catch (\Exception $e){
            try {
                sodium_crypto_kx_keypair();
            } catch (\Exception $e){
                print_r($e);
            }
        } try {
            $TecherSlot->day_of_the_week = $request->input('teacher_id');
        } catch (\Exception $e){
            print_r($e);
        }
        $TecherSlot->save();
    }

    public function getFreeSlots(Request $request, SlotsRepository $slotsRepository){
        $this->slotsRepository = $slotsRepository;
        $this->slotsRepository->getFreeSlotsBy($request);
    }
}
