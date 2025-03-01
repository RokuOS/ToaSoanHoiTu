<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tòa Soạn Hội Tụ</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>

    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Noto Serif', serif;
        }
        @media (max-width: 768px) {
        .ad-left, .ad-right {
            display: none;
        }
    }
    @media (min-width: 768px) {
        .ad-left, .ad-right {
            position: absolute;
            top: 300px;
            bottom: 260px;
            width: 200px; 
            height: 1000px;
            padding: 10px;
        }
        .ad-left {
            left: 0;
        }
        .ad-right {
            right: 0;
            margin-right: -30px;
        }
        .main-content {
            margin: 0 auto;
            max-width: 800px;
            padding: 1rem;
        }
    }
    @media (max-width: 768px) {
        .ad-banner img,
        .footer-ad-banner img {
            width: 100%;
            height: auto;
        }
        .ad-banner {
            max-width: 100%;
            padding: 10px 0;
            text-align: center;
        }

        .footer-ad-banner {
            max-width: 100%;
            padding: 10px 0;
            text-align: center;
        }
        
    }
    .ad-item {
        position: relative;
    }
    .ad-title-overlay {
        transition: opacity 0.3s ease; /* Thời gian hiệu ứng hover */
    }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    @include('components.header')
    <div class="ad-left">
        @foreach($quangcaos->where('ViTri', 'Trái')->where('TrangThai', 'Đang Quảng Cáo')->random(1) as $quangcao)
            <a href="{{ $quangcao->URL }}" target="_blank">
                <img src="{{ asset($quangcao->AnhQC) }}" alt="{{ $quangcao->TieuDeQC }}" class="object-cover mb-4 rounded-lg" style="width: 150px; height: 500px">
                <div class="ad-title-overlay absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2">
                {{ $quangcao->TieuDeQC }}
            </div>
            </a>
        @endforeach
    </div>
    <div class="flex-1 container mx-auto">
        @yield('content')
    </div>
    <div class="ad-right">
        @foreach($quangcaos->where('ViTri', 'Phải')->where('TrangThai', 'Đang Quảng Cáo')->random(1) as $quangcao)
            <a href="{{ $quangcao->URL }}" target="_blank">
                <img src="{{ asset($quangcao->AnhQC) }}" alt="{{ $quangcao->TieuDeQC }}" class="object-cover mb-4 rounded-lg" style="width: 150px; height: 500px">
                <div class="ad-title-overlay absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2">
                {{ $quangcao->TieuDeQC }}
            </div>
            </a>
        @endforeach
    </div>
    <div class="footer-ad-banner my-6 mx-auto">
        @foreach($quangcaos->where('ViTri', 'Cuối')->where('TrangThai', 'Đang Quảng Cáo')->random(1) as $quangcao)
            <a href="{{ $quangcao->URL }}" target="_blank">
                <img src="{{ asset($quangcao->AnhQC) }}" alt="{{ $quangcao->TieuDeQC }}" class="w-full h-48 object-cover mb-4 rounded-lg" style="width: 1400px;" >
                <div class="ad-title-overlay absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 p-2">
                {{ $quangcao->TieuDeQC }}
            </div>
            </a>
        @endforeach
    </div>
    <footer>
        @include('components.footer') 
    </footer>
    <script>
        document.getElementById('toggleSubMenuButton').addEventListener('click', function() {
        var subMenu = document.getElementById('subMenu');
        subMenu.classList.toggle('hidden');
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('toggleSubMenuButton').addEventListener('click', function() {
                var subMenu = document.getElementById('subMenu');
                subMenu.classList.toggle('hidden');
                subMenu.classList.toggle('block'); 
            });
        });
    </script>
</body>
</html>
