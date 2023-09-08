<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LihatPesananController extends Controller
{
    public function get_pesanan_detail(Request $request)
    {
        $detail = DetailPesanan::where('id_pesanan', $request->id)->get();

        $pesanan = Pesanan::where('id_pesanan', $request->id)->first();

        $i = 1;
        foreach ($detail as $data) {
            echo "<tr>";

            echo    "<td>" . $i++ . "</td>";

            echo     "<td style='vertical-align: middle;text-align: left;'>" . $data->perumahan->nama_perumahan . "</td>";

            echo     "<td style='vertical-align: middle;text-align: center;'>" . $data->jumlah_pesanan . "</td>";

            echo     "<td style='vertical-align: middle;text-align: right;'>Rp. " . number_format($data->perumahan->harga, 2, ',', ',') . "</td>";

            echo      "<td style='vertical-align: middle;text-align: right;'>Rp. " . number_format($data->jumlah_pesanan * $data->perumahan->harga, 2, ',', ',') . "</td>";

            echo "</tr>";
        }

        echo "<tr>";

        echo "<th colspan='4' style='vertical-align: middle;text-align: right;'>Total Pembayaran</th>";

        echo "<td style='vertical-align: middle;text-align: right;'>Rp. " . number_format($pesanan->total_harga, 2, ',', ',') . "</td>";

        echo "</tr>";
    }
}
