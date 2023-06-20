<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
?>
