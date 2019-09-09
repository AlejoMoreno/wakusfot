<?php 

Session::put('id', "");
Session::put('idTipoUsuario', "");
Session::put('usuario', "");
Session::put('nombres', "");
Session::put('email', "");


header("Location: http://parkapp.wakusoft.com/public/");

?>

<script>
window.location.href = "http://parkapp.wakusoft.com/public/";
</script>