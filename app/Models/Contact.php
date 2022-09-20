<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table='contacts';

    protected $primaryKey='id';

    protected $fillable=['name','surname','email','address','phone'];

    public function format(){
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'surname'=>$this->surname,
            'email'=>$this->email,
            'address'=>$this->address,
            'phone'=>$this->phone,
        ];
    }
}
