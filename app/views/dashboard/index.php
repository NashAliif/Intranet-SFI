<div id="content">
    <div class="mt-4 mx-3">
        <h3>Welcome <?= $_SESSION['full_name']; ?>, have you clock in today?</h3>
    </div>
    <div class="d-flex my-5">
        <div style="width: 10wh;">
        <?php 
        $totalEmployees = count($data['dailyPresent']); // Total karyawan
            $totalPresent = 0; // Inisialisasi hadir

            // Hitung yang hadir (clock-in tidak '-')
            foreach ($data['dailyPresent'] as $dp) {
                if (!empty($dp['clock-in']) && $dp['clock-in'] !== "-") {
                    $totalPresent++;
                }
            }

            // Hitung yang tidak hadir
            $totalAbsent = $totalEmployees - $totalPresent;
        ?>

        <!-- Tambahkan Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Canvas untuk Chart -->
        <canvas id="attendanceChart"></canvas>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('attendanceChart').getContext('2d');
            var attendanceChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Hadir', 'Tidak Hadir'],
                    datasets: [{
                        data: [<?= $totalPresent; ?>, <?= $totalAbsent; ?>],
                        backgroundColor: ['#0388fc', '#03f8fc'], // Hijau & Merah
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
        </script>

        </div>
    </div>
    <div class="d-flex">
    <div class="w-50 shadow-sm mt-3 mx-3 border rounded-4 bg-light overflow-auto" style="height: 50vh;">
        <div class="border-bottom">
            <h5 class="p-4 m-0 w-100">Employees Presence <?= date('d M Y') ?></h5>
        </div>
        <div class="p-4">
            <div class="d-flex flex-column">
                <table class="table table-light">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Clock In</th>
                            <th scope="col">Clock Out</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data['dailyPresent'] as $dp) : ?>
                        <?php if ($dp['name'] !== 'Hariman') : ?>
                            <tr class="text-center">
                                <td class="align-middle"><?= htmlspecialchars($dp['name']); ?></td>
                                <td class="align-middle"><?= htmlspecialchars($dp['clock-in']); ?></td>
                                <td class="align-middle"><?= htmlspecialchars($dp['clock-out']); ?></td>
                                <td class="align-middle">
                                    <!-- <?php 
                                    date_default_timezone_set('Asia/Jakarta');
                                    $currentTime = date('H:i:s');
                                    $currentDay = date('N');
                                    if ($currentDay == 6 || $currentDay == 7) {
                                        echo "Off";
                                    } elseif ($currentTime >= "08:30:00" && $currentTime < "12:00:00") {
                                        echo "On Duty";
                                    } elseif ($currentTime >= "12:00:00" && $currentTime < "13:00:00") {
                                        echo "Break";
                                    } elseif ($currentTime >= "13:00:00" && $currentTime < "17:30:00") {
                                        echo "On Duty";
                                    } else {
                                        echo "Off";
                                    }
                                    ?> -->
                                    <?php 
                                        date_default_timezone_set('Asia/Jakarta');
                                        $currentDay = date('N'); // 1 = Senin, 7 = Minggu

                                        // Jika Sabtu atau Minggu, langsung "Off"
                                        if ($currentDay == 6 || $currentDay == 7) {
                                            echo "Off";
                                        } elseif (!empty($dp['clock-in']) && $dp['clock-in'] !== "-") {
                                            echo "Attended";
                                        } else {
                                            echo "Unattended";
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="w-25 shadow-sm mt-3 mx-3 border rounded-4 bg-light overflow-auto" style="height: 50vh;">
        <div class="border-bottom">
            <h5 class="p-4 m-0 w-100">Ontime Presence <?= date('d M Y') ?></h5>
        </div>
        <div class="p-4">
            <div class="d-flex flex-column">
                <table class="table table-light">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Clock In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['dailyPresent'] as $dp) : ?>
                            <?php 
                                if ($dp['name'] !== 'Hariman' && $dp['clock-in'] !== '-' && strtotime($dp['clock-in']) <= strtotime("08:30:00")) : 
                            ?>
                                <tr class="text-center">
                                    <td class="align-middle"><?= htmlspecialchars($dp['name']); ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($dp['clock-in']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="w-25 shadow-sm mt-3 mx-3 border rounded-4 bg-light overflow-auto" style="height: 50vh;">
        <div class="border-bottom">
            <h5 class="p-4 m-0 w-100">Late Presence <?= date('d M Y') ?></h5>
        </div>
        <div class="p-4">
            <div class="d-flex flex-column">
                <table class="table table-light">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Name</th>
                            <th scope="col">Clock In</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['dailyPresent'] as $dp) : ?>
                            <?php 
                                if (
                                    $dp['name'] !== 'Hariman' && 
                                    $dp['clock-in'] !== '-' && 
                                    strtotime($dp['clock-in']) >= strtotime("08:31:00") && 
                                    strtotime($dp['clock-in']) <= strtotime("11:01:00")
                                ) : 
                                ?>
                                <tr class="text-center">
                                    <td class="align-middle"><?= htmlspecialchars($dp['name']); ?></td>
                                    <td class="align-middle"><?= htmlspecialchars($dp['clock-in']); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>