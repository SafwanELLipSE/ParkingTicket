<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket_user extends Model
{
    public function park()
    {
      return $this->hasOne(Parking_location::class,'id','parking_location');
    }
    public static function getStatus($priority_id){
    switch($priority_id) {
            case 0    : return 'Not Approved';
            case 1    : return 'Approved';
        }
    }
}
