<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienCovid extends Controller
{
    # Mendapatkan semua resource pasien
    # method index
    public function index()
    {
        $pasiens = Pasien::all();

        if ($pasiens) {
            $data = [
                'message' => 'get all pasiens',
                'data' => $pasiens,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Data is empty'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Menambahkan Resource pasien
    # method store
    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'name' => 'required',
            'phone' => 'numeric|required',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'required',
        ]);

        # menggunakan create untul insert data
        $pasiens = Pasien::create($validasiData);

        $data = [
            'message' => 'Menambahkan Resource',
            'data' => $pasiens,
        ];

        # mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }

    # mendapatkan detail resource pasien
    # method show
    public function show($id)
    {
        # data pasien
        $pasiens = Pasien::find($id);

        if ($pasiens) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $pasiens,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => ' Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Memperbarui single resource
    # Method update
    public function update(Request $request, $id)
    {
        # data pasien
        $pasiens = Pasien::find($id);

        if ($pasiens) {
            $input = [
                'name' => $request->name ?? $pasiens->name,
                'phone' => $request->phone ?? $pasiens->phone,
                'address' => $request->address ?? $pasiens->address,
                'status' => $request->status ?? $pasiens->status,
                'in_date_at' => $request->in_date_at ?? $pasiens->in_date_at,
                'out_date_at' => $request->out_date_at ?? $pasiens->out_date_at,
            ];

            # memperbarui data
            $pasiens->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $pasiens,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Menghapus single resource
    # Method destroy
    public function destroy($id)
    {
        # data pasien
        $pasiens = Pasien::find($id);

        if ($pasiens) {
            # menghapus data
            $pasiens->delete();

            $data = [
                'message' => 'Resource is delete successfully',
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Mencari resource by name
    # Method search
    public function search($name)
    {
        # mencari data pasien menggunakan where dan get
        $search = Pasien::where('name', 'LIKE', '%' . $name . '%')->get();
        if (count($search)) {
            $data = [
                'message' => 'Get searched resource',
                'data' => $search,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Menampilkan resource pasien positif
    # Method positive
    public function positive()
    {
        $status = Pasien::where('status', 'LIKE', '%' . 'positif' . '%')->get();
        if ($status) {
            $data = [
                'message' => 'Get positive resource',
                'data' => $status,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Menampilkan resource pasien sembuh
    # Method recovered
    public function recovered()
    {
        $status = Pasien::where('status', 'LIKE', '%' . 'sembuh' . '%')->get();
        if ($status) {
            $data = [
                'message' => 'Get recovered resource',
                'data' => $status,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }

    # Menampilkan resource pasien meninggal
    # Method dead
    public function dead()
    {
        $status = Pasien::where('status', 'LIKE', '%' . 'meninggal' . '%')->get();
        if ($status) {
            $data = [
                'message' => 'Get dead resource',
                'data' => $status,
            ];

            # mengembalikan data (json) status code 200
            return response()->json($data, 200);
        } else {
            $data = ['message' => 'Resource not found'];

            # mengembalikan data (json) status code 404
            return response()->json($data, 404);
        }
    }
}
