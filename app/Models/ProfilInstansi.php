<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilInstansi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'profil_instansi';

    protected $primaryKey = 'id';

}
