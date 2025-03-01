<?php

namespace App\Http\Controllers;

use App\Models\QuangCao;
use Illuminate\Http\Request;

class QuangCaoController extends Controller{
    public function index(){
        $quangcaos = QuangCao::paginate(10);
        return view('quanly.quangcao.index', compact('quangcaos'));
    }
    public function create(){
        return view('quanly.quangcao.create');
    }
    public function store(Request $request)
    {
        $fileName = null;
        if ($request->hasFile('AnhQC')) {
            $file = $request->file('AnhQC');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/quangcao'), $fileName);
        }
        $quangcao = new QuangCao();
        $quangcao->TieuDeQC = $request->TieuDeQC;
        $quangcao->DoanhNghiepQC = $request->DoanhNghiepQC;
        $quangcao->NgayQC = now();
        $quangcao->URL = $request->URL;
        $quangcao->ViTri = $request->ViTri; 
        $quangcao->TrangThai = 'Đang Quảng Cáo';
        if ($fileName) {
            $quangcao->AnhQC = 'images/quangcao/' . $fileName;
        }
        $quangcao->save();
        return redirect()->route('quangcao.index')->with('success', 'Quảng cáo đã được thêm thành công.');
    }
    public function edit($MaQC){
        $quangcao = QuangCao::findOrFail($MaQC);
        return view('quanly.quangcao.edit', compact('quangcao'));
    }
    public function update(Request $request, $id)
    {
        $quangcao = QuangCao::findOrFail($id);
        $quangcao->TieuDeQC = $request->TieuDeQC;
        $quangcao->DoanhNghiepQC = $request->DoanhNghiepQC;
        $quangcao->NgayQC = $request->NgayQC;
        $quangcao->URL = $request->URL;
        $quangcao->ViTri = $request->ViTri;
        $quangcao->TrangThai = $request->TrangThai;
        if ($request->hasFile('AnhQC')) {
            $file = $request->file('AnhQC');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/quangcao'), $fileName);
            $quangcao->AnhQC = 'images/quangcao/' . $fileName;
        }
        $quangcao->save();
        return redirect()->route('quangcao.index')->with('success', 'Quảng cáo đã được cập nhật thành công.');
    }
    public function goQuangCao($MaQC){
        $quangcao = QuangCao::findOrFail($MaQC);
        $quangcao->TrangThai = 'Ngưng Quảng Cáo';
        $quangcao->save();
        return redirect()->route('quangcao.index')->with('success', 'Đã gỡ quảng cáo.');
    }
}