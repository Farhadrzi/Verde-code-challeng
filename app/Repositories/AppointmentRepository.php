<?php


namespace App\Repositories;


use App\Interfaces\AppointmentInterface;
use App\Models\Appointment;
use Exception;

class AppointmentRepository implements AppointmentInterface
{
    /**
     * Create Appointment
     * @param array $appointmentData
     * @return mixed
     * @throws Exception
     */
    public function createAppointment(array $appointmentData){
        try {
            return Appointment::create($appointmentData)->format();
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Update Appointment Data
     * @param $appointmentId
     * @param array $updatedValue
     * @throws Exception
     */
    public function updateAppointment($appointmentId,array $updatedValue){
        try {
            $appointment = Appointment::with('user','contact')->where('id',$appointmentId)->first();
            if($appointment!=null){
                $appointment->update($updatedValue['appointmentData']);
                if(isset($updatedValue['appointmentData']['contact'])){
                    $appointment->contact->update($updatedValue['appointmentData']['contact']);
                }
            }else{
                throw new Exception('Appointment not found');
            }
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Delete Appointment
     * @param $appointmentId
     * @throws Exception
     */
    public function deleteAppointment($appointmentId){
        try {
            if(Appointment::where('id',$appointmentId)->exists()){
                Appointment::where('id',$appointmentId)->delete();
            }else{
                throw new Exception('Appointment not found');
            }
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * Get Appointment List
     * @param null $userId
     * @param null $startDate
     * @param null $endDate
     * @return mixed
     */
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
