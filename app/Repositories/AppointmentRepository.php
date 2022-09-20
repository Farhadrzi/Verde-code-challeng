<?php


namespace App\Repositories;


use App\Interfaces\AppointmentInterface;
use App\Models\Appointment;

class AppointmentRepository implements AppointmentInterface
{
    public function createAppointment(array $appointmentData){
        try {
            return Appointment::create($appointmentData)->format();
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateAppointment($appointmentId,array $updatedValue){
        try {
            $appointment = Appointment::with('user','contact')->where('id',$appointmentId)->first();
            if($appointment!=null){
                $appointment->update($updatedValue['appointmentData']);
                if(isset($updatedValue['appointmentData']['contact'])){
                    $appointment->contact->update($updatedValue['appointmentData']['contact']);
                }
            }else{
                throw new \Exception('Appointment not found');
            }
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function deleteAppointment($appointmentId){
        try {
            if(Appointment::where('id',$appointmentId)->exists()){
                Appointment::where('id',$appointmentId)->delete();
            }else{
                throw new \Exception('Appointment not found');
            }
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAppointmentList($userId = null, $startDate = null,$endDate=null)
    {

        if($userId==null){
            $appointmentList = Appointment::with('user','contact')->get();
        }else{
            $appointmentList = Appointment::with('user','contact')->where('user_id',$userId)->get();
        }

            if($startDate!=null){
                $appointmentList = $appointmentList->where('date','>=',$startDate);
            }
            if($endDate!=null){
                $appointmentList = $appointmentList->where('data','<=',$endDate);
            }
        return $appointmentList->map->formatAll();
    }
}
