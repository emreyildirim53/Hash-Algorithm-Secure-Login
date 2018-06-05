
$("#login").click(function(){
    //login ajax işlemleri
    var email=$("input[name='email']").val();
    email=jQuery.trim(email);
    var password=$("input[name='password']").val();
    password=jQuery.trim(password);

    // burada eposta validationu yapılabilir.
    if(email==''||password=='') $(".info").html("<div class='alert alert-danger'>Lütfen tüm alanları doldurunuz.</div>");        
    else if(!$("input[name='email']").val().includes('@') || !$("input[name='email']").val().includes(".com")) $(".info").html("<div class='alert alert-danger'>Uygun bir eposta giriniz.</div>"); 
    else if($("input[name='password']").val().length<8 || $("input[name='password']").val().length>16)$(".info").html("<div class='alert alert-danger'>Şifre uzunluğu 8-16 karakter aralığında olmalıdır.</div>"); 
    else{
      var values="email="+email+"&password="+password;
      $.ajax({
          type:"POST",
          url:"login.php",
          data:values,
          beforeSend: function(){
              $(".info").fadeOut();
          },
          success: function(result){
            result=result.trim();
            if(result==="correct"){
              $("#login").html("<img src='img/ajax-loader.gif' width=20px/>&nbsp;GİRİŞ");
              setTimeout('window.location.href = "dashboard.php";',3000);
            }else if(result=="err"){
              console.log("err");  
               $(".info").fadeIn(1000, function(){
                  $(".info").html("<div class='alert alert-danger'>Kullanıcı adı veya şifre hatalı.</div>");
                  $("#login").html('GİRİŞ');
                });
            }
          }
      })
    }
});
$("#register").click(function(){
    //register ajax işlemleri
    var firstname=$("input[name='firstname']").val();
    //console.log(firstname);
    firstname=jQuery.trim(firstname);
    var lastname=$("input[name='lastname']").val();
    //console.log(lastname);
    lastname=jQuery.trim(lastname);
    var email=$("input[name='emailSignup']").val();
    //console.log(email);
    email=jQuery.trim(email);
    var password=$("input[name='passwordSignup']").val();
    //console.log(password);
    password=jQuery.trim(password);

    // burada eposta validationu yapılabilir.
    if(firstname==''||lastname==''||email==''||password=='') $(".info").html("<div class='alert alert-danger'>Lütfen tüm alanları doldurunuz.</div>");        
    else if(!$("input[name='emailSignup']").val().includes('@') || !$("input[name='emailSignup']").val().includes(".com")) $(".info").html("<div class='alert alert-danger'>Uygun bir eposta giriniz.</div>"); 
    else if($("input[name='passwordSignup']").val().length<8 || $("input[name='passwordSignup']").val().length>16)$(".info").html("<div class='alert alert-danger'>Şifre uzunluğu 8-16 karakter aralığında olmalıdır.</div>"); 
    else{
      var values="firstname="+firstname+"&lastname="+lastname+"&email="+email+"&password="+password;
      $.ajax({
          type:"POST",
          url:"register.php",
          data:values,
          beforeSend: function(){
              $(".info").fadeOut();
          },
          success: function(result){
            result=result.trim();
            if(result=="correct"){
              $("#register").html("<img src='img/ajax-loader.gif' width=20px/>&nbsp;KAYDEDİLİYOR");
              
              setTimeout('$(".publicInfo").css("display", "inline-block");window.location.href = "index.html";',3000);
              
            }
            else if(result=="err"){
               $(".info").fadeIn(1000, function(){
                  $(".info").html("<div class='alert alert-danger'>Girmiş olduğunuz email adresi sistemde mevcut.<a href='#loginPage'> Giriş yap.</a></div>");
                  $("#register").html('KAYIT OL');
                });
            }
          }
      })
    }
});


$("#signupPage").click(function(){
  $(".info").html="";
});
$("#loginPage").click(function(){
  $(".info").html="";
});


