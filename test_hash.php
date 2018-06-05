
<?php
    /*
		256 bit 64 karakterlik hash algoritması.
	*/
	srand(microtime(true));// Rasgele üretilecek olan 16 karakterlik string dizisini mili saniyeyle besledik.
	$bitHASH=" ";//her iterasyonun son değeri için değişken 16 bitlik 1 harf için

    $password="YILDIRIM.";
  	echo "password: ".$password."<br>";
    ////////////////////////////////// HASH TESTING \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        //''= dcad3d890ee64abe60dfb360564bd71f851ca7516c453f6da65426917f20b035
	  	//' '= eec73d890ee64abe60dfb360564bd71f851ca7516c453f6da65426917f20b035
	  	//'  '= e6c73dcd0ee64abe60dfb360564bd71f851ca7516c453f6da65426917f20b035
	  	//YILDIRIM= d7606cfd48b12b3c06cc06f7b6ea124e731cf36ee9621a36563d1d927aa325c7
	  	//YILDIRIM.= b06a6ae958785f8858b946b517ac94a2d2dbb674e3582a07075a49c313e517b7
	  	//YILDIRIm.= 90487aeb58785f8858b946b517ac94a2d2dbb674e3582a07075a49c313e517b7
  
    /*
		Hashing() fonksiyonu kayıt olmak için çağırılıyorsa bu sayfada rasgele 16 karakterlik string dizi yaratılıyor.
		Hashing() fonksiyonu giriş yapmak için çağırılıyorsa salt değerini parametre olarak yolluyor, üretilmiyor.
	*/
  
  
    //$salt=bin2hex(openssl_random_pseudo_bytes(8));
  	$salt="caa4e51b5848e512";// salt sabit tutulup password tek karakter değiştirmek için //TESTING
  	echo "salt: ".$salt."<br><br>";
	
  	/*
		Her iterasyon sonunda hesaplanan 16 bytelık veri dizide tutulmaktadır.
		Amaç, yeni veri üretilirken bir önceki verinin kullanılmasıdır.(XOR)
		Bu nedenle ilk veri salt destekli üretilmiştir. (16 byte)
		ord: ASCII code, decbin: dec to bin convert, substr: 16 karaktere tamamlama için string kesme, strrev: string tersi
  	*/
	$prcSalt= decbin(ord($salt[3]))."".decbin(ord($salt[5]));
	$prcSalt = strrev(substr(decbin(ord($salt[9])),0,16 - strlen($prcSalt)) . $prcSalt);
	$prcBitHash= array($prcSalt);

	//echo "Salt besleme: ".$prcSalt."<br><br>";

  	$password=substr($salt,0,16-strlen($password)).$password;
  	//echo "16'a tamalama: ".$password."<br><br>";

  	for($i=0;$i<16;$i++){// 8-16 karakter için 16 karakter için ayrı ayrı işlem yapılıyor

	  	$bin= decbin(ord($password[$i]));
	  	$bin = substr("0000000000000000",0,16 - strlen($bin)) . $bin;

	  	$binSalt= decbin(ord($salt[$i]));
	  	$binSalt = strrev(substr("0000000000000000",0,16 - strlen($binSalt)) . $binSalt);

	    /*
	    --- Karakterlerin dönüştürülmesi, formatlanması
	    
	  	echo $password[$i]." ASCII:".ord($password[$i])."<br>";
	  	echo ord($password[$i])." binary:".decbin(ord($password[$i]))."<br><br>";
		echo "16 byte password char: ".$bin."<br><br>"; //password character
		echo "16 byte salt char: ".$binSalt."<br><br>"; //salt character reverse
		*/
		
        //Dizinin ilk elemanını saltla beslemek için atandı.
	  	$newBin=$bin;
	  	$newBinSalt=$binSalt;
	  	for($j=1;$j<count($prcBitHash);$j++){
			$tempNewBinSalt=bitXOR($prcBitHash[$j-1],$prcBitHash[$j]);
	 		$newBinSalt=bitXOR($tempNewBinSalt,$binSalt);
		}
	  	
		for($j=0;$j<32;$j++){//Programın karmaşıklığı için 32 döngü makul görüldü.
	    	/*
				ilk döngü için;
				newBin: Şifredeki ilk karakterin binary hali
				newBinSalt: Salttaki ilk karakterin binary hali
				
				Yukarıdaki iki değişken her döngü sonunda bir önceki array elemanıyla güncellenmektedir.

				shiftLEFT aldığı veriyi sola kaydırır (circle) 12 karakter uygun görüldü.
				shiftRIGHT aldığı veriyi sağa kaydırır (circle) 12 karakter uygun görüldü.
				
				AND, OR, XOR, klasik bitwise oparatörlerin kodlanmış versiyonudur.
			*/
			$OR=bitOR($newBin,$newBinSalt);

			$shiftLEFT=shiftLEFT($OR,12);
			
			$XOR=bitXOR($OR,$shiftLEFT);
			

			$shiftRIGHT=shiftRIGHT($XOR,12);
			

			$AND=bitOR($XOR,$shiftRIGHT);
			/*
			echo "OR(pass,salt): ".$OR."<br><br>";
			echo "shiftLEFT(OR): ".$shiftLEFT."<br><br>";
			echo "XOR(OR,shiftLEFT): ".$XOR."<br><br>";
			echo "shiftRIGHT(XOR): ".$shiftRIGHT."<br><br>";
			echo "AND(XOR,shiftRIGHT): ".$AND."<br><br>";
			echo "<br><br><br><br>";
			*/
			$newBin=$AND;
	  		$newBinSalt=$shiftRIGHT;
	    }

	   $tempBin=substr($bin,8,strlen($bin));

	   $tempBin.=strrev($tempBin); // pass al sonuna passın tersini yapıştır.

	   $resultBin=bitXOR($newBin,$tempBin);

	   /*
	   echo "Password:  ".$bin."<br><br>";
	   echo "Modify Password:  ".$newBin."<br><br>";
	   echo "resultBin: ".$resultBin."<br><br>";
	   */

	   $bitHASH.=$resultBin." ";
	   array_push($prcBitHash,$resultBin);// en son yapılan bit işlemi 16 bitlik 1 harf için
	}		

	//echo "hast bit: ".$bitHASH."<br><br>";

	$prcBitHash=array_reverse($prcBitHash);
	
	//echo "suffle:  ".suffleHASH($bitHASH,$prcBitHash)."<br><br>";

	echo converHASH(suffleHASH($bitHASH,$prcBitHash))."<br><br>";		
	return converHASH(suffleHASH($bitHASH,$prcBitHash));	
	
    /*	
		Dizideki her bir elemanın bir öncekiyle işleme sokulduğu fonksiyondur.
		Girdi olarak iterasyonlar sonunda elde edilen 256 bitlik string dizgesi ve işlemlerden elde edilen dizi kullanılmaktadır.
		Çıktı olarak 256 btylelık bir string dizgesi döndürür.
  	*/
	function suffleHASH($bitHASH,$prcBitHash){
		$quadCound=0;
		$bytes="";
		for($i=0;$i<count($prcBitHash)-1;$i++){
			$quad=substr($bitHASH,$quadCound,16);
			//echo "quad: ".$quad."<br><br>";
			//echo "prcBitHash: ".$prcBitHash[$i]."<br><br>";
			
			$quad=bitXOR($quad,$prcBitHash[$i]);
			//echo "quad: ".$quad."<br><br><br><br>";
			//echo $quad." : ".dechex(bindec($quad))."<br><br>";
			$bytes.=$quad." ";
			$quadCound+=16;
		}
		return $bytes;
	}
	/*
		256 bytelık string dizgesi burada quadlara ayrılmaktadır 4'erli 64 blok halinde ayrıştırılmıştır.
		her blok hexdecimal olarak döndürülmüştür.
		burada alternatif olarak 8li blok ASCII kod tablosu kullanılabilir çıktı 32 karakter elde edilebilirdi.
	*/
	function converHASH($bitHASH){
		$quadCound=0;
		$HASH="";
		for($i=0;$i<64;$i++){
			$quad=substr($bitHASH,$quadCound,4);
			//echo $quad." : ".dechex(bindec($quad))."<br><br>";
			$HASH.=dechex(bindec($quad));
			$quadCound+=4;
		}
		return $HASH;
	}

  	function bitXOR($first,$second){
	  	$bitXOR="";
	  	for($i=0;$i<strlen($first);$i++)
	  		if($first[$i]===$second[$i])
	  			$bitXOR.="0";
	  		else
	  			$bitXOR.="1";
	  	return $bitXOR;
  	}

  	function bitOR($first,$second){
	  	$bitOR="";
	  	for($i=0;$i<strlen($first);$i++)
	  		if($first[$i]==1 || $second[$i]==1)
	  			$bitOR.="1";
	  		else
	  			$bitOR.="0";
	  	return $bitOR;
  	}

  	function bitAND($first,$second){
	  	$bitAND="";
	  	for($i=0;$i<strlen($first);$i++)
	  		if($first[$i]==0 || $second[$i]==0)
	  			$bitAND.="0";
	  		else
	  			$bitAND.="1";
	  	return $bitAND;
  	}

  	function shiftLEFT($bytes,$size){
	  	for($i=0;$i<$size;$i++){
	  		$temp=$bytes[0];
	  		$bytes=substr($bytes, 1);
	  		$bytes.=$temp;
	  	}
	  	return $bytes;
  	}

  	function shiftRIGHT($bytes,$size){
	  	for($i=0;$i<$size;$i++){
	  		$temp=$bytes[strlen($bytes)-1];
	  		$bytes=substr($bytes,0,strlen($bytes)-1);
	  		$bytes=$temp.$bytes;
	  	}
	  	return $bytes;
  	}


?>
 