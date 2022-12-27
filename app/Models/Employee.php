<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'employees';
    public $primaryKey = 'employee_id';
    protected $guarded = ['employee_id'];

    protected $fillable = [
        'title',
        'fname',
        'lname',
        'addressline',
        'town',
        'zipcode',
        'phone',
        'imagePath',
        'user_id',
    ];

    public function users() {
        return $this->belongsTo('App\Models\User');
    }

    public function consultations() {
        return $this->belongsTo('App\Models\Consultation');
    }

}