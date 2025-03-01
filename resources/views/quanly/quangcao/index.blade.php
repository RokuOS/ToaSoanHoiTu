@extends('quanly.index')
@section('content')
<div class="container mx-auto mt-8">
    <h2 class="text-2xl font-semibold mb-6">Danh Sách Quảng Cáo</h2>
    <div class="mb-4">
        <a href="{{ route('quangcao.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">Tạo Quảng Cáo</a>
    </div>
    <div class="overflow-x-auto shadow-md rounded-lg">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-3 px-4 text-left">Mã Quảng Cáo</th>
                    <th class="py-3 px-4 text-left">Tiêu Đề Quảng Cáo</th>
                    <th class="py-3 px-4 text-left">Doanh Nghiệp Quảng Cáo</th>
                    <th class="py-3 px-4 text-left">Ngày Quảng Cáo</th>
                    <th class="py-3 px-4 text-left">Vị Trí</th>
                    <th class="py-3 px-4 text-left">Trạng Thái</th>
                    <th class="py-3 px-4 text-left">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quangcaos as $qc)
                <tr class="border-b">
                    <td class="py-3 px-4">{{ $qc->MaQC }}</td>
                    <td class="py-3 px-4">{{ $qc->TieuDeQC }}</td>
                    <td class="py-3 px-4">{{ $qc->DoanhNghiepQC }}</td>
                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($qc->NgayQC)->format('d/m/Y') }}</td>
                    <td class="py-3 px-4">{{ $qc->ViTri }}</td>
                    <td class="py-3 px-4">{{ $qc->TrangThai }}</td>
                    <td class="py-3 px-4">
                        <a href="{{ route('quangcao.edit', $qc->MaQC) }}" class="text-blue-500 hover:text-blue-700 mr-4">Sửa</a>
                        <form action="{{ route('quangcao.go', $qc->MaQC) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">Gỡ Quảng Cáo</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection