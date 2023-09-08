<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Perumahan;
use App\Models\Pesanan;
use App\Models\ProfilInstansi;
use Illuminate\Http\Request;

class PerumahanController extends Controller
{
    public function cart(Perumahan $perumahan, Request $request)
    {
        $validateData = $request->validate([
            'id_perumahan' => 'required',
            'jumlah_pesanan' => 'required | numeric'
        ]);

        if ($request->jumlah_pesanan <= 0) {
            return redirect('/perumahan/' . $perumahan->slug . '/show')->with('error_cart', 'Pesan tidak boleh 0');
            return false;
        }

        if ($request->jumlah_pesanan > 1) {
            return redirect('/perumahan/' . $perumahan->slug . '/show')->with('error_pesanan', 'Pesan tidak boleh 0');
            return false;
        }

        $cek_pelanggan = Pesanan::where('user_id', auth()->user()->id)->where('status', 3)->first();

        if ($cek_pelanggan) {
            if ($cek_pelanggan->user) {
                if (auth()->user()->id == $cek_pelanggan->user->id) {
                    return redirect('/perumahan/' . $perumahan->slug . '/show')->with('pesanan_double', '');
                    return false;
                }
            }
        }

        $cek_user_pesanan = Pesanan::where('user_id', auth()->user()->id)->first();
        if ($cek_user_pesanan) {
            if ($cek_user_pesanan->total_harga != 0) {
                return redirect('/perumahan/' . $perumahan->slug . '/show')->with('user_exist', '');
                return false;
            }
        }

        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        $total_harga = $request->jumlah_pesanan * $perumahan->harga;

        if (empty($pesanan)) {
            Pesanan::create([
                'user_id' => auth()->user()->id,
                'status' => 0,
                'total_harga' => $total_harga
            ]);

            $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

            Pesanan::where('id_pesanan', $pesanan->id_pesanan)->update([
                'kode' => mt_rand(000, 999) . $pesanan->id_pesanan
            ]);
        } else {
            Pesanan::where('id_pesanan', $pesanan->id_pesanan)->update([
                'total_harga' => $pesanan->total_harga + $total_harga
            ]);
        }

        DetailPesanan::create([
            'id_perumahan' => $perumahan->id_perumahan,
            'id_pesanan' => $pesanan->id_pesanan,
            'jumlah_pesanan' => $request->jumlah_pesanan,
            'total_harga' => $total_harga
        ]);

        return redirect('/perumahan/' . $perumahan->slug . '/show')->with('message', 'success/Pesanan ditambahkan ke keranjang');
    }

    public function show(Perumahan $perumahan)
    {
        $nama_perumahan = strtolower($perumahan->nama_perumahan);

        return view('perumahan.show', [
            'title' => 'Perumahan ' . ucwords($nama_perumahan),
            // 'subtitle' => '<li>Adminintrator</li>',
            'profil' => ProfilInstansi::first(),
            'perumahan' => $perumahan
        ]);
    }

    public function index()
    {
        return view('perumahan.index', [
            'title' => 'Daftar Perumahan',
            // 'subtitle' => '<li>Adminintrator</li>',
            'profil' => ProfilInstansi::first(),
            'perumahan' => Perumahan::orderBy('id_perumahan', 'DESC')->get()
        ]);
    }
}
