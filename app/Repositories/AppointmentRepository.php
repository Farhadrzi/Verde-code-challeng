<?php


namespace App\Repositories;


use App\Interfaces\AppointmentInterface;
use App\Models\Appointment;

class AppointmentRepository implements AppointmentInterface
{
    public function createAppointment(array $appointmentData){
        try {
            return Appointment::create($appointmentData);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateAppointment($appointmentId,array $updatedValue){
        try {
            $appointment = Appointment::where('id',$appointmentId)->first();
            if($appointment!=null){
                $appointment->update($updatedValue);
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
}
