<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "lpse";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $data[] = null;


// $sql = "select kategori, count(*) jum from lpse2012 where nama_propinsi = '".$_GET['nama_propinsi']."' group by kategori";
$sql = "select kategori, count(*) jum from lpse2012 where nama_propinsi = '".$_POST['prov']."' group by kategori";
$result = $conn->query($sql);

if ($dat = $result->num_rows > 0) {
  $color = null;
    while($dat = $result->fetch_assoc()) {
      switch ($dat['kategori']) {
        case 'Pengadaan Barang':
            $color = "#e9a45c";
          break;
        case 'Jasa Konsultasi':
            $color = "#0c6197";
          break;
        case 'Pekerjaan Konstruksi':
            $color = "#4daa4b";
          break;
        case 'Jasa Lainnya':
            $color = "#e95151";
          break;
        default:
          # code...
          break;
      }
      $d = array( 'label' => $dat['kategori'],
                  'value' => $dat['jum']/1,
                  'color' => $color
                      );
      array_unshift($data, $d);
    }
} else {
  echo "0 kategori results";
}

echo json_encode(array_filter($data));
?>
