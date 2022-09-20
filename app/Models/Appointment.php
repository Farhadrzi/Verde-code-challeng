<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table='appointments';

    protected $primaryKey='id';

    protected $fillable=['address','distance','date','departure_time','available_time','user_id','contact_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class,'contact_id','id');
    }

    public function format(){
        return[
            "id"=> $this->id,
            "address"=> $this->address,
            "date"=> $this->date,
            "distance"=> $this->distance,
            "available_time"=> $this->available_time->toDateTimeString(),
            "departure_time"=> $this->departure_time->toDateTimeString(),
            "contact_id"=>$this->contact_id,
            "user_id"=>$this->user_id,
        ];
    }
    public function formatAll(){
        return[
            "id"=> $this->id,
            "address"=> $this->address,
            "date"=> $this->date,
            "distance"=> $this->distance,
            "available_time"=> $this->available_time,
            "departure_time"=> $this->departure_time,
            "contact"=>$this->contact->format(),
            "user"=>$this->user->format(),
        ];
    }
}
