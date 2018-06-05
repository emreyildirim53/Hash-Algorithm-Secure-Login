<?php
   /*
      Login ekranından kullanıcının yolladığı(POST) bilgiler burda işlemden geçirilmiştir.
      Dashboadın bizi içeriye kabul etmesi için oturum (Session) yaratıyoruz ve içini dolduruyoruz.

   */
   session_start();
   include("baglan.php"); // Veri tabanı bağlantısı yapıldı.
   include("hash.php"); // Hash algoritması sayfaya davet edildi. 

   $email = trim($_POST['email']); //index.html formdan gönderilen veriler çekildi.
   $pass = trim($_POST['password']);
   $password=$pass;
   //echo " email: $email";
   //echo " pass: $pass";

   /*
      Veri tabanında users ve salting olmak üzere iki tablo bulunmaktadır.
      users(firstname,lastname,email,password), salting(email,salting) bilgilerini tutmaktadır.
      Bu iki tablo joinle birleştirilip ortak sorguya tâbi tutulmuşlardır.
      Tablodan gelecek olan salt değeriyle birlikte ham şifre hashing() algoritmasına yollanmıştır.
      password 256 bit 64 karakterlik bir yapıya sahiptir.
   */
   $result = $con->prepare("SELECT * FROM users INNER JOIN salting ON users.email = salting.email WHERE salting.email = ?");
   $result->bind_param("s", $email);
   $result->execute();
   $result->bind_result($firstname, $lastname, $myemail, $mypass, $myemailSalt, $salt);
   $result->fetch();

   //echo " email: $email";
   //echo " password: $password";
   //echo " salt: $salt";
   $password=hashing($password,$salt);
   //echo " password: $password";

   if($mypass==$password && $myemail==$email){
      $_SESSION['firstname'] = $firstname;
      $_SESSION['lastname'] = $lastname;
      $_SESSION['email'] = $myemail;
      echo "correct";
   } else{
      echo "err";
   }

?>