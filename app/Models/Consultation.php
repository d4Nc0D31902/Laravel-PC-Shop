<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    public $table = 'consultations';
    protected $guarded = ['id'];

    protected $fillable = [
        'pc_id',
        'employee_id',
        'comment',
        'price',
    ];

    public function employees() {
        return $this->hasMany('App\Models\Employee', 'employee_id');
    }

    public function pcspecs() {
        return $this->hasMany('App\Models\Pcspec', 'pc_id');
    }
}
