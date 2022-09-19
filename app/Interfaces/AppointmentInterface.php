<?php

namespace App\Interfaces;

interface AppointmentInterface
{
    public function createAppointment(array $appointmentData);

    public function updateAppointment($appointmentId, array $updatedValue);

    public function deleteAppointment($appointmentId);
}
