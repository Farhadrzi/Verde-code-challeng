<?php


namespace App\Repositories;


use App\Interfaces\ContactInterface;
use App\Models\Contact;

class ContactRepository implements ContactInterface
{
    /**
     * Create Contact Or Select if created
     * @param array $contactData
     * @return mixed
     * @throws \Exception
     */
    public function createContract(array $contactData){
        try {
            return Contact::firstOrCreate($contactData);
        }catch (\Exception $exception){
            throw new \Exception('error while create contact');
        }
    }
}
