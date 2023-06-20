<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    public function client()
    {
        return $this->hasOne(Client::class, 'employee_id', 'id');
    }
    
}
?>