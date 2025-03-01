@extends('admin.index')
@section('title', 'Danh Sách Tài Khoản')
@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-semibold mb-6">Danh Sách Tài Khoản Độc Giả</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-4">
            <form action="{{ route('docgia.index') }}" method="GET" class="flex">
                <input type="text" id="searchInput" name="search" placeholder="Tìm kiếm theo tên đăng nhập" class="border p-2 w-full rounded-lg" value="{{ request('search') }}">
            </form>
        </div>
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-3 px-4 text-left">Mã Tài Khoản</th>
                        <th class="py-3 px-4 text-left">Tên Đăng Nhập</th>
                        <th class="py-3 px-4 text-left">Tên Độc Giả</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Số Điện Thoại</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($docgias as $docgia)
                        <tr class="border-b hover:bg-gray-100 transition duration-150">
                            <td class="py-3 px-4">{{ $docgia->MaTK }}</td>
                            <td class="py-3 px-4">{{ $docgia->TenDangNhap }}</td>
                            <td class="py-3 px-4">{{ $docgia->docgia->TenDG }}
                            <td class="py-3 px-4">{{ $docgia->docgia->Email }}
                            <td class="py-3 px-4">{{ $docgia->docgia->SDT }}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="t-4">
            {{ $docgias->links()}}
        </div>
    </div>
@endsection
