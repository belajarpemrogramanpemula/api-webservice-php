<?php 
header('Access-Control-Allow-Origin: *');
$conn = new mysqli("localhost","root","","apps");
mysqli_connect_errno();
date_default_timezone_set('Asia/Jakarta');
$json = array(
	"response_status"=>"OK",
	"response_message"=>'',
	"data"=>array()
);
$username=isset($_GET['username'])?$_GET['username']:'';
$password=isset($_GET['password'])?$_GET['password']:'';
$sql=$conn->query("select * from users where username='".$username."' and password='".$password."' ");
$jml=$sql->num_rows;
if($jml>0){
	while($rs=$sql->fetch_object()){
		$arr_row=array();
		$arr_row['username'] = $rs->username;
		$arr_row['nama'] = $rs->nama;
		$arr_row['alamat'] = $rs->alamat;
		$arr_row['kota'] = $rs->kota;
		$arr_row['telp'] = $rs->telp;
		$json['data'][] = $arr_row;
	}	
}else{
	$json['response_status']= "Error";		
	$json['response_message']= "Username atau Password Salah";		
}

header('Content-Type: application/json');
print json_encode($json, JSON_PRETTY_PRINT);
?>