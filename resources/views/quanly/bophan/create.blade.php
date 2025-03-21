@extends('quanly.index')
@section('content')
<div class="container mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Thêm Bộ Phận</h2>
    <form action="{{ route('quanly.bophan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="TenBP" class="block text-gray-700">Tên Bộ Phận:</label>
            <input type="text" id="TenBP" name="TenBP" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Thêm</button>
    </form>
</div>
@endsection
