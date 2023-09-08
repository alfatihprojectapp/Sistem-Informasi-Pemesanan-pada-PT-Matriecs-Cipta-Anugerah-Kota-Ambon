<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Perumahan extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id_perumahan'];

    protected $table = 'perumahan';

    protected $primaryKey = 'id_perumahan';

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_perumahan'
            ]
        ];
    }

}
