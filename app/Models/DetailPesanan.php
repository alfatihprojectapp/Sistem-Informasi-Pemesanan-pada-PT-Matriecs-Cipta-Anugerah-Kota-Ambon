<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id_detail'];

    protected $table = 'detail_pesanan';

    protected $primaryKey = 'id_detail';

    protected $with = ['perumahan'];

    public function perumahan()
    {
        return $this->belongsTo(Perumahan::class, 'id_perumahan');
    }

}
