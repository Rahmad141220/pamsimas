<html>
<head>
    <title>Cetak PDF</title>
</head>
<body>
<h1 style="text-align: center;">Data Siswa</h1>
<a href="<?php echo base_url("index.php/controller/cetak"); ?>">Cetak Data</a><br><br>
<table border="1" width="100%">
<tr>

<th>No</th>   
    <th>Nik</th>
    <th>Nama</th>
    <th>tgl lahir</th>
    <th>Jenis Kelamin</th>
     <th>agama</th>
    <th>pekerjaan</th>
    <th>no hp</th>
    <th>status tagihan</th>
</tr>
<?php
if( ! empty($tb_pelanggan)){
    $no = 1;
    foreach($tb_pelanggan as $data){
        echo "<tr>";
        echo "<td>".$no."</td>";
        echo "<td>".$data->nik."</td>";
        echo "<td>".$data->nama."</td>";
        echo "<td>".$data->tgl_lahir."</td>";
        echo "<td>".$data->jenis_kelamin."</td>";
        echo "<td>".$data->agama."</td>";
        echo "<td>".$data->pekerjaan."</td>";
        echo "<td>".$data->no_hp."</td>";
        echo "</tr>";
        $no++;
    }
}
?>
</table>
</body>
</html>