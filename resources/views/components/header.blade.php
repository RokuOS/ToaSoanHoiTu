<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tòa Soạn Hội Tụ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Noto Serif', serif;

        }
        .article-image {
            transition: transform 0.3s ease-in-out;
        }
        .article-image:hover {
            transform: scale(1.05);
        }
        .border-b-2 {
            border-bottom-width: 2px;
        }
        .border-blue-600 {
            border-color: #2563eb;
        }
        .active-category {
            text-decoration: underline; 
        }
        .submenu {
            position: absolute; 
            z-index: 10; 
            width: auto; 
            min-width: 200px; 
        }
        .menu-item {
            position: relative;
        }
        .menu-item .submenu {
            display: none; 
            position: absolute;
            top: 100%; 
            left: 0;
            background-color: #ffffff; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            z-index: 10;
            min-width: 200px;
            border: 1px solid #ddd; 
        }
        .menu-item:hover .submenu {
            display: block; 
        }
        .menu-item a {
            padding: 10px 15px; 
            display: block; 
            color: #333; 
            text-decoration: none; 
        }
        .menu-item a:hover {
            background-color: #f1f1f1; 
        }
        .submenu a {
            padding: 10px 15px; 
            color: #333;
        }
        .submenu a:hover {
            background-color: #f1f1f1; 
        }
    </style>
</head>
<body class="bg-gray-100 p-6">
<nav class="bg-white shadow-md" style="background: rgb(238,174,202); background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center p-4">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo/logo-removebg-preview.png') }}" alt="" class="w-48 md:w-56 h-auto">
        </a>
        <div class="flex flex-col md:flex-row items-center w-full md:w-auto md:ml-auto mt-4 md:mt-0">
            <form action="{{ route('search.page') }}" method="GET" class="flex items-center w-full md:w-80 mb-2 relative">
                <input type="text" name="q" id="searchInput" placeholder="Tìm kiếm bài viết..."
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" 
                    class="absolute right-0 px-4 py-2 bg-blue-600 text-white rounded-r-full hover:bg-blue-700 h-full"
                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                    Tìm kiếm
                </button>
            </form>
            <div class="flex items-center space-x-4 ml-4">
                @if(Auth::check() && Auth::user()->Quyen == 'Độc Giả')
                    <div class="relative inline-block text-left">
                        <button id="dropdownButton" class="flex items-center px-4 py-2 space-x-2 focus:outline-none">
                            <span>Xin chào, <span class="font-semibold">{{ Auth::user()->docgia->TenDG }}</span></span>
                        </button>
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-10">
                            <a href="{{ route('account.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Cập nhật tài khoản</a>
                            <a href="{{ route('account.comment') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Lịch sử bình luận</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Đăng Xuất</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Đăng Nhập</a>
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Đăng Ký</a>
                @endif
            </div>
        </div>
    </div>
</nav>
<nav class="bg-white-200 py-3">
    <div class="container mx-auto flex flex-col md:flex-row justify-center space-x-0 md:space-x-1 relative">
    <a href="{{ route('welcome') }}" class="hover:text-blue-600 font-semibold {{ request()->is('/') ? 'border-b-2 border-blue-600' : '' }} py-2">
            <i class="fas fa-home mr-2"></i>
            Trang Chủ
        </a>
        @foreach($chuyenmuc as $chuyenMuc)
            <div class="relative menu-item group">
                <a href="{{ route('chuyenmuc.show', $chuyenMuc->MaCM) }}" class="hover:text-blue-600 font-semibold {{ isset($currentChuyenMuc) && $currentChuyenMuc->MaCM == $chuyenMuc->MaCM ? 'border-b-2 border-blue-600' : '' }} py-2">
                    @if($chuyenMuc->Icon)
                        <img src="{{ asset($chuyenMuc->Icon) }}" alt="Icon chuyên mục" class="w-6 h-6 inline mr-2">
                    @endif
                    {{ $chuyenMuc->TenCM }}
                </a>
                <div id="submenu-{{ $chuyenMuc->MaCM }}" class="submenu bg-white shadow-lg mt-2 hidden">
                    @php
                        $loaiTinList = $chuyenMuc->loaiTin;
                    @endphp
                    @if($loaiTinList && $loaiTinList->count() > 0)
                        @foreach($loaiTinList as $loaiTin)
                            <a href="{{ route('loaitin.show', $loaiTin->MaLT) }}" class="block px-4 py-2 hover:bg-gray-100">
                                {{ $loaiTin->TenLT }}
                            </a>
                        @endforeach
                    @else
                        <span class="block px-4 py-2">Không có loại tin nào</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            let timeout;
            item.addEventListener('mouseenter', function() {
                const submenu = this.querySelector('.submenu');
                clearTimeout(timeout); 
                if (submenu) submenu.style.display = 'block';
            });
            item.addEventListener('mouseleave', function() {
                const submenu = this.querySelector('.submenu');
                timeout = setTimeout(function() {
                    if (submenu) submenu.style.display = 'none';
                }, 20); 
            });
        });
    });
</script>
</body>
</html>
