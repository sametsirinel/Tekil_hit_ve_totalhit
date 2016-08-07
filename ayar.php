<?php 

	$b = mysqli_connect("localhost","root","","sayac");
	date_default_timezone_set('Europe/Istanbul');
	
	if($b){
		$ip = $_SERVER["REMOTE_ADDR"];
		$tarih = date("Y-m-d");
		
		$sorgu = mysqli_query($b,"select * from sayac where ip='$ip' and tarih = '$tarih'");
		
		if($sorgu){
			
			if(mysqli_num_rows($sorgu)<1){
				
				if(mysqli_query($b,"insert into sayac set ip='$ip',tarih='$tarih',sayi='1'")){
					
					echo "insert Calıstı";
					
				}else{
					
					echo "insert hatası";
					
				}
				
				
			}else{
				
				$row = mysqli_fetch_array($sorgu);
				
				$sayi  = $row["sayi"] +1;
				
				
				if(mysqli_query($b,"update sayac set sayi='$sayi' where ip='$ip' and tarih='$tarih'")){
					
					echo "update Calıstı";
					
				}else{
					
					echo "update hatası";
					
				}
				
			}
			
			
		}else{
			
			echo "sorgu hatası";
			
		}
		
		$sorgu = mysqli_query($b,"select * from sayac");
		
		$row = mysqli_num_rows($sorgu);
		
		echo " Tekil Hitimiz : $row  \n";
		
		$sorgu = mysqli_query($b,"select sum(sayi) as hit from sayac");
		
		$row = mysqli_fetch_array($sorgu);
		
		echo "Hitimiz : ".$row["hit"]."  \n";
		
	}else{

		echo "problem";
	
	}

?>