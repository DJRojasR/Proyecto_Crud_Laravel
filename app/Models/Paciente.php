<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'dni', 'nombres', 'apellidos',
        'fecha_nacimiento', 'telefono',
        'estado', 'created_us', 'updated_us', 'deleted_us'
    ];
}