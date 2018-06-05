
<?php
   /*
      Kullanıcı tarafından index.html formundan gönderilen (POST) veriler burda işlenmektedir.
      Kullanıcının yolladığı ham şifre Hashing()'den geçirilip veri tabanına kaydedilmiştir.
      Hashing işlemi yapılırken rasgele (milisaniye beslemeli) salt değeri veri tabanında salting sütununda saklanmıştır.
      
   */
   include("baglan.php");
   include("hash.php");
   $firstname=$_POST["firstname"];
   $lastname=$_POST["lastname"];
   $email=$_POST["email"];
   $password=hashing($_POST["password"],"");

   if (mysqli_query($con,"insert into users(firstname,lastname,email,password) values ('$firstname','$lastname','$email','$password')") && mysqli_query($con,"insert into salting(email,salt) values ('$email','$salt')"))
         echo "correct";
      else
         echo "err";
?>
 