<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 2;
    
        if (!empty($katakunci)) {
            // Only search if there is a keyword
            $data = Barang::where('KodeBarang', 'like', '%' . $katakunci . '%')
                ->orWhere('Nama', 'like', '%' . $katakunci . '%')
                ->orWhere('Satuan', 'like', '%' . $katakunci . '%')
                ->paginate($jumlahbaris);
        } else {
            // Default view when there is no keyword or it's removed
            $data = Barang::orderBy('KodeBarang', 'desc')->paginate($jumlahbaris);
        }
    
        return view('pg')->with('data', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pgcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('KodeBarang',$request->KodeBarang);
        Session::flash('Nama',$request->Nama);
        Session::flash('Satuan',$request->Satuan);
        Session::flash('HargaBeli',$request->HargaBeli);
        Session::flash('HargaJual',$request->HargaJual);
        Session::flash('Stok',$request->Stok);
        Session::flash('Barcode',$request->Barcode);


        $request->validate([
            'KodeBarang' => 'required|unique:barang,KodeBarang',            
            'Nama' => 'required',            
            'Satuan' => 'required',
            'HargaBeli' => 'required',              
            'HargaJual' => 'required',            
            'Stok' => 'required',            
            'Barcode' => 'required|regex:/^[0-9]{1,8}$/',                     
        ],[
            'KodeBarang.required' => 'KodeBarang wajib diisi',
            'KodeBarang.unique' => 'KodeBarang sudah terdaftar di database',
            'Nama.required' => 'Nama barang wajib diisi',
            'Satuan.reqiured' => 'Satuan barang wajib diisi',
            'HargaBeli.required' => 'Harga beli barang wajib diisi',
            'HargaJual.required' => 'Harga jual barang wajib diisi',
            'Stok.required' => 'Stok barang wajib diisi',
            'Barcode.required' => 'Barcode wajib diisi',
            'Barcode.regex' => 'Barcode mencapai batas maksimal angka',
        ]);
        $dataa = [
            'KodeBarang' => $request->KodeBarang,
            'Nama' => $request->Nama,
            'Satuan' => $request->Satuan,
            'HargaBeli' => $request->HargaBeli,
            'HargaJual' => $request->HargaJual,
            'Stok' => $request->Stok,
            'Barcode' => $request->Barcode,
        ];
        Barang::create($dataa);
        return redirect()->to('petugasgudang')->with('success', 'Berhasil menambahkan barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data1 = Barang::where('KodeBarang', $id)->first();
        return view('pgedit')->with('data1', $data1);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([          
            'Nama' => 'required',            
            'Satuan' => 'required',
            'HargaBeli' => 'required',                 
            'HargaJual' => 'required',            
            'Stok' => 'required',            
            'Barcode' => 'required|regex:/^[0-9]{1,8}$/',                     
        ],[
            'Nama.required' => 'Nama barang wajib diisi',
            'Satuan.reqiured' => 'Satuan barang wajib diisi',
            'HargaBeli.required' => 'Harga beli barang wajib diisi',
            'HargaJual.required' => 'Harga jual barang wajib diisi',
            'Stok.required' => 'Stok barang wajib diisi',
            'Barcode.required' => 'Barcode wajib diisi',
            'Barcode.regex' => 'Barcode mencapai batas maksimal angka',
        ]);
        $dataa = [
            'Nama' => $request->Nama,
            'Satuan' => $request->Satuan,
            'HargaBeli' => $request->HargaBeli,
            'HargaJual' => $request->HargaJual,
            'Stok' => $request->Stok,
            'Barcode' => $request->Barcode,
        ];
        Barang::where('KodeBarang',$id)->update($dataa);
        return redirect()->to('petugasgudang')->with('success', 'Berhasil mengupdate Barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::where('KodeBarang',$id)->delete($id);
        return redirect()->to('petugasgudang')->with('success', 'Berhasil mengdelete Barang'); 
    }
}
