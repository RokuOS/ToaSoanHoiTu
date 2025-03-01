@extends('quanly.index')
@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6">Cập Nhật Quảng Cáo</h2>
    <form action="{{ route('quangcao.update', $quangcao->MaQC) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="TieuDeQC" class="block text-gray-700 font-semibold mb-2">Tiêu Đề Quảng Cáo</label>
            <input type="text" name="TieuDeQC" id="TieuDeQC" value="{{ $quangcao->TieuDeQC }}" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="DoanhNghiepQC" class="block text-gray-700 font-semibold mb-2">Doanh Nghiệp Quảng Cáo</label>
            <input type="text" name="DoanhNghiepQC" id="DoanhNghiepQC" value="{{ $quangcao->DoanhNghiepQC }}" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="NgayQC" class="block text-gray-700 font-semibold mb-2">Ngày Quảng Cáo</label>
            <input type="date" name="NgayQC" id="NgayQC" value="{{ \Carbon\Carbon::parse($quangcao->NgayQC)->format('Y-m-d') }}" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="URL" class="block text-gray-700 font-semibold mb-2">URL</label>
            <input type="url" name="URL" id="URL" value="{{ $quangcao->URL }}" class="border border-gray-300 rounded px-3 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label for="AnhQC" class="block text-gray-700 font-semibold mb-2">Ảnh Quảng Cáo</label>
            <input type="file" name="AnhQC" id="AnhQC" class="border border-gray-300 rounded px-3 py-2 w-full">
            @if($quangcao->AnhQC)
                <div class="mt-2">
                    <img src = {{ asset($quangcao->AnhQC) }} alt="Ảnh quảng cáo" class="w-32 h-32 object-cover">
                    <p class="text-sm text-gray-500">Ảnh hiện tại</p>
                </div>
            @endif
        </div>
        <div class="mb-4">
            <label for="ViTri" class="block text-gray-700 font-semibold mb-2">Vị Trí</label>
            <select name="ViTri" id="ViTri" class="border border-gray-300 rounded px-3 py-2 w-full">
                <option value="Trái" {{ $quangcao->ViTri == 'Trái' ? 'selected' : '' }}>Trái</option>
                <option value="Phải" {{ $quangcao->ViTri == 'Phải' ? 'selected' : '' }}>Phải</option>
                <option value="Giữa" {{ $quangcao->ViTri == 'Giữa' ? 'selected' : '' }}>Giữa</option>
                <option value="Cuối" {{ $quangcao->ViTri == 'Cuối' ? 'selected' : '' }}>Cuối</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="TrangThai" class="block text-gray-700 font-semibold mb-2">Trạng Thái</label>
            <select name="TrangThai" id="TrangThai" class="border border-gray-300 rounded px-3 py-2 w-full">
                <option value="Đang Quảng Cáo" {{ $quangcao->TrangThai == 'Đang Quảng Cáo' ? 'selected' : '' }}>Đang Quảng Cáo</option>
                <option value="Ngưng Quảng Cáo" {{ $quangcao->TrangThai == 'Ngưng Quảng Cáo' ? 'selected' : '' }}>Ngưng Quảng Cáo</option>
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Cập Nhật Quảng Cáo</button>
        </div>
    </form>
</div>
@endsection
