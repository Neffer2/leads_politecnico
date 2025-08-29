<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'leads';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'mobilephone',
        'ilu_depcolombia',
        'ilu_cityofresidencecolombia',
        'ilu_opportunitytype',
        'modality',
        'program',
        'tipo_de_documento',
        'ilu_numerodocumento',
        'preferred_contact_method',
    ];
}
