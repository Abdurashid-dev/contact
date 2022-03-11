<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Base
{
    //relation with contact
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
