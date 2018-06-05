<?php
/*
	Veri tabanı ayarları bu dosya çağrılarak yapılmaktadır.
	Buradaki bilgiler local makineye göre doldurulmuştur.
	Çalıştırılacak olan makine bilgilerinin girilmesi gerekmektedir.
*/
 $con = mysqli_connect("localhost","root","","zamazingo") or die ("could not connect to mysql");
      
  mysqli_query($con,"SET NAMES 'utf8'"); 
  mysqli_query($con,"SET CHARACTER SET utf8"); 
  mysqli_query($con,"SET COLLATION_CONNECTION = 'utf8_turkish_ci'"); 
?>