<?php
// Set header type konten.
header("Content-Type: application/json; charset=UTF-8");

// Deklarasi variable untuk koneksi ke database.
include_once "koneksi.php";

// Deklarasi variable keyword buah.
$nama = $_GET["query"];

// Query ke database.
$query  = $konek->query("SELECT * FROM inv_brg WHERE nama LIKE '%$nama%' ORDER BY nama ASC");

// Fetch hasil query.
$result = $query->fetch_All(MYSQLI_ASSOC);

// Cek apakah ada yang cocok atau tidak.
if (count($result) > 0) {
    foreach($result as $data) {
        $output['suggestions'][] = [
            'value' => $data['nama'],
            'nama'  => $data['nama'],
            'jml' => $data['jumlah']
        ];
    }

    // Encode ke JSON.
    echo json_encode($output);

// Jika tidak ada yang cocok.
} else {
    $output['suggestions'][] = [
        'value' => '',
        'nama'  => '',
        'jml' => ''
    ];

    // Encode ke JSON.
    echo json_encode($output);
}
?>