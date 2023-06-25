<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id','title','image','qty','price','size','color','total','cus_name','mobile','email','address','city'];
    protected $table = 'orders';
    use HasFactory;
}
