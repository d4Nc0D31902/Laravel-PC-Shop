<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'product_id';
    protected $table = 'stock';

	protected $fillable = [
        'quantity',
        'product_id'];
	
	public function product(){
    	return $this->belongsTo('App\Models\Product','product_id');
    }
}