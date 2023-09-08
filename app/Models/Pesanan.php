<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id_pesanan'];

    protected $table = 'pesanan';

    protected $primaryKey = 'id_pesanan';

    protected $with = ['user','pesanan_detail'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pesanan_detail()
    {
        return $this->hasMany(DetailPesanan::class, 'id_pesanan');
    }

}
