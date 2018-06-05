# Hash-Algorithm-Secure-Login

Hash algoritmalarına örnek olması ve kendimi test etmek için yazmış olduğum 256 bit 64 karakterlik hash algoritması ile kullanıcı kontrollü bir sistemin parola bilgilerini saklamayı hedefliyorum.
Hash algoritması login sistemle birlikte kurgulanmıştır. Sadece hash algoritmasını test edecek olanlar için `test_hash.php` yayınlanmıştır.


## Hash nedir?
Bilmeyenler için kısaca özet geçmek istiyorum. Hash boyutu ne olursa olsun farketmeksizin belli boyuttaki bir dosya, metin, video vb belgelerin belirlenen uzunlukta temsil edilmesi işlemidir. Kesinlikle bu şifrelemenin geri dönüşü olmaması gerekir. Çözümleme ancak ve ancak aynı dosyanın ilgili hash algoritmasından geçirilmesiyle tespit edilebilir.

#### Dipnot:
Hash algoritmasıyla şifrelenecek iki adet dosya sadece `1 karakteri farklı olsa bile` üretilen hash kodu `tamamen birbirinden farklı` olması gerekmektedir.
Böyle olmasının nedeni tahmin edilememe durumunu sağlamaktadır.

Gelin bir iki örnek deneyelim.

İlk olarak dosyamızda veri olmadığını farzedilim. Nasıl bir çıktı bekleriz? 

>   ''= dcad3d890ee64abe60dfb360564bd71f851ca7516c453f6da65426917f20b035

Hash algoritmamızın sonucunda her zaman göreceğimiz gibi `256 bit 64 karakter` bir string dizisi göreceğiz.

Gelin biraz ileri gidip ' '(1 adet boşluk karakteri) karakterini test edelim.

>   ' '= eec73d890ee64abe60dfb360564bd71f851ca7516c453f6da65426917f20b035

Gördüğünüz gibi 1 karakter değişmesine rağmen tamamen stringimiz birbirinden farklı olmaktadır.

**Aşağıdaki örneklerede bir göz atmanızda fayda var.**
>   YILDIRIM= d7606cfd48b12b3c06cc06f7b6ea124e731cf36ee9621a36563d1d927aa325c7 <br>
>   YILDIRIM.= b06a6ae958785f8858b946b517ac94a2d2dbb674e3582a07075a49c313e517b7 <br>
>   YILDIRIm.= 90487aeb58785f8858b946b517ac94a2d2dbb674e3582a07075a49c313e517b7 <br>

# Login System

Login sistem bootstrap tema üzerine inşa edilmiştir. Index.html sayfasında login.php ve register.php çalıştırılmıştır.
Localde çalıştıracaklar için `baglan.php` sayfası örnek olarak sunulmuştur. Sunucunuzun bilgileriyle düzenlenerek sunucu tarafında da rahat bir şekilde kullanabilirsiniz.

 ## Veritabanı
 
 MySql tablolarının oluşturulması için;
 > zamazingo.sql
 
 SQL kodu paylaşılmıştır. Veritabanı yönetim sisteminizden (örn: PhpMyAdmin) kodu çalıştırıp. Veritabanını oluşturabilirsiniz.
 
 #### Önemli Hatırlatma:
 _Kullanıcı tarafından gelecek olan hiç bir bilgiye güvenmeyiniz. bkz: [SQL Injection](https://tr.wikipedia.org/wiki/SQL_Injection)_
 
 
