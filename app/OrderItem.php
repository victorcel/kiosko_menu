<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $table = 'order_items';

	protected $fillable = ['points', 'quantity', 'product_id', 'order_id'];

	public function order(){
		return $this->belongsTo('App\Order');
	}
	public function product(){
		return $this->belongsTo('App\Product');
	}

}
