<?php

class DashboardModel
{
    public static function getDailyPresent()
    {
        $databasePath = "C:\\Program Files (x86)\\Time Attendance System 4.3.1.25\\HITFPTA.mdb";

        if (!file_exists($databasePath)) {
            die("Error: File database tidak ditemukan di lokasi: $databasePath");
        }

        $dsn = "DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=" . realpath($databasePath) . ";PWD=ithITtECH;";
        $conn = odbc_connect($dsn, "", "");

        if (!$conn) {
            die("Koneksi ke database gagal: " . odbc_errormsg());
        }

        $tanggalHariIni = date('Y-m-d'); // Format PHP YYYY-MM-DD
        $queryTanggal = "#" . date('m/d/Y', strtotime($tanggalHariIni)) . "#"; // Format Access MM/DD/YYYY

        // Ambil seluruh employee
        $queryEmployees = "SELECT FingerPrintID, EmployeeFirstName FROM Employee ORDER BY EmployeeFirstName";
        $resultEmployees = odbc_exec($conn, $queryEmployees);

        if (!$resultEmployees) {
            die("Query gagal: " . odbc_errormsg());
        }

        $employees = [];
        while ($row = odbc_fetch_array($resultEmployees)) {
            $employees[$row['FingerPrintID']] = [
                'name'      => $row['EmployeeFirstName'],
                'clock-in'  => '-',
                'clock-out' => '-'
            ];
        }

        // Ambil data kehadiran
        $queryAttendance = "
            SELECT 
                p.FingerPrintID,
                MIN(p.TimeLog) AS clock_in,
                MAX(p.TimeLog) AS clock_out
            FROM PersonalLog AS p
            WHERE p.DateLog = $queryTanggal
            GROUP BY p.FingerPrintID
        ";
        $resultAttendance = odbc_exec($conn, $queryAttendance);

        if (!$resultAttendance) {
            die("Query gagal: " . odbc_errormsg());
        }

        // Masukkan data clock-in & clock-out ke array employees
        while ($row = odbc_fetch_array($resultAttendance)) {
            $fingerprintID = $row['FingerPrintID'];
            $clockIn = !empty($row['clock_in']) ? $row['clock_in'] : "-";
            $clockOut = !empty($row['clock_out']) ? $row['clock_out'] : "-";
        
            // Jika clock-in di atas jam 11:00, ubah menjadi "-"
            if ($clockIn !== "-" && strtotime($clockIn) > strtotime("11:00:00")) {
                $clockIn = "-";
            }
        
            // Jika clock-out di bawah jam 16:00, tampilkan "-"
            if ($clockOut !== "-" && strtotime($clockOut) < strtotime("16:00:00")) {
                $clockOut = "-";
            }
        
            if (isset($employees[$fingerprintID])) {
                $employees[$fingerprintID]['clock-in'] = $clockIn;
                $employees[$fingerprintID]['clock-out'] = $clockOut;
            }
        }

        odbc_close($conn);
        return array_values($employees);
    }
}
