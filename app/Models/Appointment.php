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
        $this->hasOne(User::class,'user_id');
    }

    public function contact(){
    }
}
