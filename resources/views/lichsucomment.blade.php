@extends('layouts.app')
@section('content')
<body class="bg-gray-50 font-sans">
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-semibold mb-6">Lịch Sử Bình Luận</h2>
        @if($comments->isEmpty())
            <p class="text-gray-500">Bạn chưa có bình luận nào!.</p>
        @else
            <div class="overflow-x-auto shadow-md rounded-lg">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 text-left">Bài Viết</th>
                            <th class="py-3 px-4 text-left">Nội Dung</th>
                            <th class="py-3 px-4 text-left">Trạng Thái</th>
                            <th class="py-3 px-4 text-left">Ngày Bình Luận</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr class="border-b">
                                <td class="py-3 px-4 text-gray-700">{{ $comment->TieuDeBT_XB ?? 'Bài viết không xác định' }}</td>
                                <td class="py-3 px-4 text-gray-700">{{ $comment->NoiDung }}</td>
                                <td class="py-3 px-4 text-gray-600 font-bold">
                                    @if($comment->TrangThai == 'Đã Xóa')
                                        <span class="text-red-500">{{ $comment->TrangThai }}</span>
                                    @elseif($comment->TrangThai == 'Chờ Kiểm Duyệt')
                                        <span class="text-yellow-500">{{ $comment->TrangThai }}</span>
                                    @elseif($comment->TrangThai == 'Đã Kiểm Duyệt')
                                        <span class="text-green-500">{{ $comment->TrangThai }}</span>
                                    @else
                                        <span class="text-gray-500">Chưa xác định</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-gray-500">
                                    {{ \Carbon\Carbon::parse($comment->created_at)->format('H:i d/m/Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropdownButton = document.getElementById('dropdownButton');
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
        });
        window.addEventListener('click', function (e) {
            if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>
@endsection
