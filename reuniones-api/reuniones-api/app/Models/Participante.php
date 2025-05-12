<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participante extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'email'];

    public function reunion()
    {
        return $this->belongsTo(Reunion::class);
    }
}
