@extends('quanly.index')
@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6">Thêm Quảng Cáo Mới</h2>
    <form action="{{ route('quangcao.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="TieuDeQC" class="block text-gray-700 font-semibold mb-2">Tiêu Đề Quảng Cáo</label>
            <input type="text" name="TieuDeQC" id="TieuDeQC" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="DoanhNghiepQC" class="block text-gray-700 font-semibold mb-2">Doanh Nghiệp Quảng Cáo</label>
            <input type="text" name="DoanhNghiepQC" id="DoanhNghiepQC" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="URL" class="block text-gray-700 font-semibold mb-2">URL</label>
            <input type="url" name="URL" id="URL" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="AnhQC" class="block text-gray-700 font-semibold mb-2">Ảnh Quảng Cáo</label>
            <input type="file" name="AnhQC" id="AnhQC" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="ViTri" class="block text-gray-700 font-semibold mb-2">Vị Trí</label>
            <select name="ViTri" id="ViTri" class="border border-gray-300 rounded px-3 py-2 w-full" required>
                <option value="Trái">Trái</option>
                <option value="Phải">Phải</option>
                <option value="Giữa">Giữa</option>
                <option value="Cuối">Cuối</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Thêm Quảng Cáo</button>
        </div>
    </form>
</div>
@endsection
