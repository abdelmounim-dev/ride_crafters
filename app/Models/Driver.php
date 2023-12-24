<?php
//A Driver is a user that hold additional information
// alot of benefits of creating it as a seperate model 
// Driver cannot change his car without permission from Admin

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
}
