<div class="page-heading">
    <!--    <h3>Thống kê </h3>-->
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tổng quan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 bg-primary">
                                <div class="details">
                                    <h3><?= $soDichVuPhong ?></h3>
                                    <h4>dịch vụ phòng</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 bg-secondary">
                                <div class="details">
                                    <h3><?= $soPhong ?></h3>
                                    <h4>phòng</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 bg-info">
                                <div class="details">
                                    <h3><?= $soChienDich ?></h3>
                                    <h4>chiến dịch</h4>
                                </div>
                                <div id="spark3"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 rounded-4 bg-success">
                                <div class="details">
                                    <h3><?= $soVoucher ?></h3>
                                    <h4>voucher</h4>
                                </div>
                                <div id="spark4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Doanh thu theo phòng (Đơn vị: $)</h4>
                            <h4>Tổng: <?= get_price($tongDoanhThu) ?></h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-doanh-thu-phong"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Thống kê đơn đặt phòng</h4>
                </div>

                <div id="chart-thong-ke-don"></div>
                <div class="card-content pb-4">
                    <div class="p-2">
                        <table class="table table-hover col-12 col-lg-12 col-md-12">
                            <tr>
                                <td>Tổng</td>
                                <td><?= $tongSoDon ?> đơn</td>
                            </tr>
                            <tr>
                                <td>Đã xác nhận</td>
                                <td><?= $soDonDaXacNhan ?> đơn</td>
                            </tr>
                            <tr>
                                <td>Chưa xác nhận</td>
                                <td><?= $soDonChuaXacNhan ?> đơn</td>
                            </tr>
                            <tr>
                                <td>Đã hủy</td>
                                <td><?= $soDonChuaXacNhan ?> đơn</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Biểu đồ thống kê lượt đặt theo phòng</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-luot-dat-phong"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="../public/admin/dist/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script>
    let phong = Object.values(<?= json_encode($phong) ?>);
    let phongLabels = [];
    let phongDoanhThu = [];
    let phongLuotDat = [];
    phong.forEach((p) => {
        phongLabels.push(p.name);
        phongDoanhThu.push(p.doanh_thu);
        phongLuotDat.push(p.so_luot_dat);
    })
    let optionsThongKeDon = {
        series: [<?= $soDonDaXacNhan ?>, <?= $soDonChuaXacNhan ?>, <?= $soDonBiHuy ?>],
        labels: ['Đã xác nhận', 'Chưa xác nhận', 'Đã hủy'],
        colors: ['#55c6e8', '#546E7A', '#E91E63'],
        chart: {
            type: 'donut',
            width: '100%',
            height: '350px'
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '30%'
                }
            }
        }
    }
    let optionsDoanhThuPhong = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [{
            name: 'Doanh thu',
            data: phongDoanhThu,
        }],
        colors: '#435ebe',
        xaxis: {
            categories: phongLabels,
        },
    }
    let optionsLuotDatPhong = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [{
            name: 'Số lượt đặt',
            data: phongLuotDat,
        }],
        colors: '#F44336',
        xaxis: {
            categories: phongLabels,
        },
    }


    var chartThongKeDon = new ApexCharts(document.getElementById('chart-thong-ke-don'), optionsThongKeDon);
    var chartDoanhThuPhong = new ApexCharts(document.getElementById('chart-doanh-thu-phong'), optionsDoanhThuPhong)
    var chartLuotDatPhong = new ApexCharts(document.getElementById('chart-luot-dat-phong'), optionsLuotDatPhong)

    chartThongKeDon.render();
    chartDoanhThuPhong.render();
    chartLuotDatPhong.render();
</script>