@extends('quanly.index')

@section('content')
<div class="mt-6">
    <h2 class="text-2xl font-semibold">Thống Kê</h2>
    <div id="myChart" style="height: 250px;"></div>
    <div class="mt-4">
        <p>Tổng số lượt xem bản tin: <strong>{{ $totalViews }}</strong></p>
        <p>Tổng số bình luận: <strong>{{ $totalComments }}</strong></p>
    </div>
    <h3 class="text-xl font-semibold mt-6">Tỉ lệ số bản tin theo chuyên mục</h3>
    <div id="chuyenMucChart" style="height: 250px;"></div>
    <div class="mt-4">
        <p>Tổng số bản tin: <strong>{{ $totalBantins }}</strong></p>
    </div>
    <h3 class="text-xl font-semibold mt-6">Số lượng bản tin theo loại tin</h3>
    <div id="loaiTinChart" style="height: 300px;"></div>
</div>

<style>
    #loaiTinChart {
        width: 100%;
        height: 300px;
    }
</style>

<script>
    $(document).ready(function() {
        const chartData = @json($chartData);
        const chuyenMucData = @json($chuyenMucData);
        const loaiTinData = @json($loaiTinData); 
        const morrisData = chartData.map(item => ({
            date: item.date,
            views: item.views,
            comments: item.comments
        }));

        new Morris.Line({
            element: 'myChart',
            data: morrisData,
            xkey: 'date',
            ykeys: ['views', 'comments'],
            labels: ['Lượt Xem', 'Bình Luận'],
            lineColors: ['#0b62a4', '#7a92a3'],
            resize: true
        });
        new Morris.Donut({
            element: 'chuyenMucChart',
            data: chuyenMucData.map(item => ({ label: item.label, value: item.value })),
            colors: ['#0b62a4', '#7a92a3', '#c2c2c2'],
            formatter: function (x) { return x + '%'; }
        });
        new Morris.Bar({
            element: 'loaiTinChart',
            data: loaiTinData.map(item => ({ label: item.label, value: item.value })),
            xkey: 'label',
            ykeys: ['value'],
            labels: ['Số lượng bản tin'],
            barColors: ['#0b62a4'],
            resize: true,
            xLabelAngle: 45
        });
    });
</script>
@endsection