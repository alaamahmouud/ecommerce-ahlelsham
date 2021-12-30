<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //

    use GetAttribute;

    protected $table = 'services';
    public $timestamps = true;
    protected $fillable = array('name', 'desc');

    public function details()
    {
        return $this->hasMany(Detail::class);
    }


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }
}
