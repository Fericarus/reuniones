<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reunion extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'fecha'];

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
}
