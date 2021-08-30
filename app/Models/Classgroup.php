<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classgroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function sign()
    {
        $this->belongsTo(Sign::class);
    }
}
