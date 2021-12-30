<?php

namespace App\Models;

use App\Traits\GetAttribute;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use GetAttribute;

    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = array('title');


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }
}


