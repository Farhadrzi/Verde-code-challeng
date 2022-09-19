<?php


namespace App\Services;


use App\Interfaces\AppointmentInterface;
use Exception;

class AppointmentService
{
    /**
     * @var AppointmentInterface
     */
    private AppointmentInterface $appointmentInterface;

    public function __construct(AppointmentInterface $appointmentInterface)
    {
        $this->appointmentInterface = $appointmentInterface;
    }

    public function createAppointment(array $appointmentData){
        try {
            //todo:create contact.
//            $appointmentData['contact_id']=$contact->id;
            $this->appointmentInterface->createAppointment($appointmentData);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function updateAppointment($appointmentId,$appointmentUpdateData){
        try {
            $this->appointmentInterface->updateAppointment($appointmentId, $appointmentUpdateData);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function deleteAppointment($appointmentId){
        try {
            $this->appointmentInterface->deleteAppointment($appointmentId);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
}
