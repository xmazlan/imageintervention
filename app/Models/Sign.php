<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sign extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function classGroup()
    {
        return $this->hasOne(Classgroup::class, 'id', 'classGroupID');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'positionID');
    }
}
