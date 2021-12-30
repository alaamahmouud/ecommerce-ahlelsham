<?php

namespace App\Models;
use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use GetAttribute;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'des' , 'price' ,'category_id' ,'descount_value' , 'price_after_descount');

    public function categories()
    {
       return $this->belongsTo(Category::class);
    }
    
    public function orders()
    {
       return $this->belongsTo(Order::class);
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }
}
