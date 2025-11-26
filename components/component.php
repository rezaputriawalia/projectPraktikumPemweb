<?php
function listAlert($status)
{
  switch ($status) {
    case 'register_berhasil': ?>
      <div class="alert alert-success" style="background-color: #b1cba6;" role="alert">
        Success : Berhasil mendafatarkan akun!
      </div>
    <?php break;
    case 'gagal_mendaftar': ?>
      <div class="alert alert-danger" role="alert">
        Error : Gagal gagal mendafatarkan akun!
      </div>
    <?php break;
    case 'gagal_login': ?>
      <div class="alert alert-danger" style="background-color:rgb(230, 75, 83); color: white;" role="alert">
        Error : Gagal gagal login!
      </div>
    <?php break;
    case 'password_tidak_sama': ?>
      <div class="alert alert-danger" style="background-color:rgb(230, 75, 83); color: white;" role="alert">
        Error : Password tidak sama!
      </div>
    <?php break;
    case 'login_dulu': ?>
      <div class="alert alert-danger" style="background-color:rgb(230, 75, 83); color: white;" role="alert">
        Error : Login terlebih dahulu!
      </div>
    <?php break;
    case 'berhasil_logout': ?>
      <div class="alert alert-success" style="background-color:rgb(207, 233, 248);" role="alert">
        Success : Berhasil Logout!
      </div>
    <?php break;
    case 'email_sudah_ada': ?>
      <div class="alert alert-warning" style="background-color:rgb(247, 244, 175);" role="alert">
        Warning : Email sudah terdaftar!
      </div>
    <?php break;
  }
}
?>