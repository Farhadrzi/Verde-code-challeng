<?php


namespace App\Repositories;


use App\Interfaces\ContactInterface;
use App\Models\Contact;

class ContactRepository implements ContactInterface
{
    public function createContract(array $contactData){
        try {
            return Contact::firstOrCreate($contactData);
        }catch (\Exception $exception){
            throw new \Exception('error while create contact');
        }
    }
}
