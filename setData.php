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

  $sql = "select nama_propinsi, count(*) jumlah, sum(`hasil_lelang`)  hasil from lpse2013 group by nama_propinsi order by nama_propinsi";
  $result = $conn->query($sql);
  $data[] = null;
  if ($result->num_rows > 0) {
        while($dat = $result->fetch_assoc()) {
          $prov = array('prop' => $dat['nama_propinsi'],
                        'jumlah' => $dat['jumlah']/1,
                        'hasil' => $dat['hasil']/10000000000,
                        'lat' => null,
                        'long' => null
                          );

          array_unshift($data, $prov);
        }
  } else {
      echo "0 results";
  }
echo "<pre/>";
print_r($data);
// $data =  array_filter($data), function($var){return !is_null($var);} );
  file_put_contents('data2013.json', json_encode($data));
?>
