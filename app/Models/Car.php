<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'model'];
    /**
     * Get the users associated with the car.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_car', 'car_id', 'user_id');
    }
}
?>