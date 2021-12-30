<?php

namespace App\Models;
use App\Traits\GetAttribute;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
            use GetAttribute;
        
            protected $table = 'orders';
            public $timestamps = true;
            protected $fillable = array('name','client_id','product_id');
    
            public function products()
            {
                return $this->hasMany(Product::class);
            }

            public function clients()
            {
                return $this->hasMany(Client::class);
            }
        
        
            public function __construct(array $attributes = [])
            {
                parent::__construct($attributes);
                $this->multiple_attachment = true;
                $this->multiple_attachment_usage = ['default', 'bdf-file'];
            }
        }
        
        
        