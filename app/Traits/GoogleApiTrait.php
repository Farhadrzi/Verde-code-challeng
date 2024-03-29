<?php


namespace App\Traits;


use Illuminate\Support\Facades\Http;

trait GoogleApiTrait
{
    /**
     * Call google API and get Data from Google Distance Matrix Service base of postal Code
     * @param $destinationPostalCode
     * @return object
     * @throws \Exception
     */
    public function getPostalCodeDetail($destinationPostalCode){
        $isInUk=false;
        try {
            $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json?destinations=".trim($destinationPostalCode)."&origins=CM27PJ&
        units=metric&key=AIzaSyCdUK1PNwGsutqnophMfGjrficFmSPPsoY");
            if($response->successful()){
                $json = json_decode($response->body());
                if(isset($json->rows)){
                    if($json->rows!=[]){
                        if(isset($json->rows[0]->elements)){
                            foreach ($json->destination_addresses as $destination){
                                if(str_contains($destination, 'UK')){
                                    $isInUk=true;
                                }
                            }
                            if($isInUk){
                                $element= $json->rows[0]->elements;
                                $distance = $element[0]->distance->value;
                                $duration = $element[0]->duration->value;
                                return (object)['distance'=>$distance,'duration'=>$duration];
                            }else{
                                throw new \Exception('postal code not valid');
                            }
                        }else{
                            throw new \Exception('postal code not valid');
                        }
                    }else{
                        throw new \Exception('postal code not valid');
                    }
                }else{
                    throw new \Exception('postal code not valid');
                }
            }else{
                throw new \Exception('Error while get data from google api');
            }
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
