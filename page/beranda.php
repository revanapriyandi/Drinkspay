<?php
$user = $_SESSION['user'];

if ($user['role'] == 'owner') {
?>
    <div class="row">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                X
            </button>
            <strong>Selamat datang </strong> di halaman admin Drink's Pay <?php echo $user['name']; ?>, silahkan pilih menu yang tersedia di sidebar untuk mengelola data.
        </div>

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Pendapatan Minggu ini</p>
                                        <h5 class="font-weight-bolder">
                                            <?php
                                            $tanggal_minggu_lalu = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
                                            $query = "SELECT SUM(total) AS total FROM transaksi WHERE tanggal >= '$tanggal_minggu_lalu' AND tanggal <= CURDATE() AND status='Selesai'";
                                            $stmt = $konek->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result) {
                                                $data = $result->fetch_assoc();
                                                if ($data['total'] !== null) {
                                                    echo 'Rp. ' . number_format($data['total'], 0, ',', '.');
                                                } else {
                                                    echo '0';
                                                }
                                            } else {
                                                echo 'Terjadi kesalahan saat mengambil data';
                                            }
                                            ?>

                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Konsumen Minggu Ini</p>
                                        <h5 class="font-weight-bolder">
                                            <?php
                                            $tanggal_minggu_lalu = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
                                            $query = "SELECT COUNT(*) AS total FROM konsumen WHERE created_at >= '$tanggal_minggu_lalu' AND created_at <= CURDATE()";
                                            $stmt = $konek->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result) {
                                                $data = $result->fetch_assoc();
                                                if ($data['total'] !== null) {
                                                    echo $data['total'];
                                                } else {
                                                    echo '0';
                                                }
                                            } else {
                                                echo 'Terjadi kesalahan saat mengambil data';
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Produk Terjual Minggu Ini</p>
                                        <h5 class="font-weight-bolder">
                                            <?php
                                            $tanggal_minggu_lalu = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
                                            $query = "SELECT SUM(jumlah) AS total FROM transaksi WHERE tanggal >= '$tanggal_minggu_lalu' AND tanggal <= CURDATE() AND status = 'Selesai'";
                                            $stmt = $konek->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result) {
                                                $data = $result->fetch_assoc();
                                                if ($data['total'] !== null) {
                                                    echo $data['total'];
                                                } else {
                                                    echo '0';
                                                }
                                            } else {
                                                echo 'Terjadi kesalahan saat mengambil data';
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Penjualan Minggu Ini</p>
                                        <h5 class="font-weight-bolder">
                                            <?php
                                            $tanggal_minggu_lalu = date('Y-m-d', strtotime('-7 days', strtotime(date('Y-m-d'))));
                                            $query = "SELECT COUNT(*) AS total FROM transaksi WHERE tanggal >= '$tanggal_minggu_lalu' AND tanggal <= CURDATE() AND status = 'Selesai'";

                                            $stmt = $konek->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result) {
                                                $data = $result->fetch_assoc();
                                                if ($data['total'] !== null) {
                                                    echo $data['total'];
                                                } else {
                                                    echo '0';
                                                }
                                            } else {
                                                echo 'Terjadi kesalahan saat mengambil data';
                                            }
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4 mb-lg-0">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">
                                <i class="fa fa-chart-bar text-primary"></i>
                                Grafik Penjualan <?php echo date('Y'); ?>
                            </h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                                in <?php echo date('F'); ?>
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="300" style="display: block; box-sizing: border-box; height: 300px; width: 852px;" width="852"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/plugins/chartjs.min.js"></script>
    <?php
    $query = "SELECT MONTH(tanggal) AS bulan, SUM(total) AS total FROM transaksi GROUP BY bulan";
    $result = $konek->query($query);

    $bulanLabels = [];
    $totalTransaksi = [];


    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $namaBulan = date("F", mktime(0, 0, 0, $row['bulan'], 1));
            $bulanLabels[] = $namaBulan;
            $totalTransaksi[] = intval($row['total']);
        }
    } else {
        echo 'Terjadi kesalahan saat mengambil data dari database: ' . $konek->error;
    } ?>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#ff5733",
                    backgroundColor: ["#ff5733", "#007acc", "#ff5733", "#2ecc71", "#9b59b6"],
                    borderWidth: 3,
                    fill: true,
                    data: <?php echo json_encode($totalTransaksi); ?>,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
<?php } else { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card text-white bg-primary alert alert-secondary alert-dismissible fade show">
                <div class="card-body">
                    Selama datang di halaman kasir Drink's Pay <?php echo $user['name']; ?>, silahkan pilih menu order yang tersedia di sidebar untuk melakukan transaksi.
                </div>
            </div>

        </div>
    </div>
<?php } ?>