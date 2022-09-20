<?php


namespace App\Services;


use App\Interfaces\AppointmentInterface;
use App\Interfaces\ContactInterface;
use App\Traits\GoogleApiTrait;
use Carbon\Carbon;
use Exception;

class AppointmentService
{
    use GoogleApiTrait;
    /**
     * @var AppointmentInterface
     */
    private AppointmentInterface $appointmentInterface;
    /**
     * @var ContactInterface
     */
    private ContactInterface $contactInterface;

    public function __construct(AppointmentInterface $appointmentInterface,ContactInterface $contactInterface)
    {
        $this->appointmentInterface = $appointmentInterface;
        $this->contactInterface = $contactInterface;
    }

    public function createAppointment(array $appointmentData){
        try {
            $contact = $this->contactInterface->createContract($appointmentData['contact']);
            $appointmentData['contact_id']=$contact->id;

            $addressDetail = $this->getPostalCodeDetail($appointmentData['address']);

            $appointmentData['distance']= $addressDetail->distance;

            $availableTime = Carbon::createFromFormat('Y-m-d H:i:s',$appointmentData['date']);
            $departureTime = Carbon::createFromFormat('Y-m-d H:i:s',$appointmentData['date']);
            $appointmentData['available_time'] = $availableTime->addSeconds($addressDetail->duration+3600);

            $appointmentData['departure_time'] = $departureTime->subSeconds($addressDetail->duration);

            return $this->appointmentInterface->createAppointment($appointmentData);
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

    public function getAppointmentList($userId=null,$startDate=null,$endDate=null){
        try {
            return $this->appointmentInterface->getAppointmentList($userId,$startDate,$endDate);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
}
