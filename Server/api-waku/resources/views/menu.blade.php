<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="nav-item  " id="index">
        <a class="nav-link" href="index">
            <i class="material-icons">dashboard</i>
            <p>Censo de vehiculos</p>
        </a>
        </li>
        <li class="nav-item " id="usuario">
        <a class="nav-link" href="usuarios">
            <i class="material-icons">person</i>
            <p>Perfil Usuario</p>
        </a>
        </li>
        <li class="nav-item " id="servicios">
        <a class="nav-link" href="servicios">
            <i class="material-icons">content_paste</i>
            <p>Servicios</p>
        </a>
        </li>
        <li class="nav-item " id="clientes">
        <a class="nav-link" href="clientes">
            <i class="material-icons">library_books</i>
            <p>Clientes</p>
        </a>
        </li>
        <li class="nav-item " id="entradas">
        <a class="nav-link" href="entradas">
            <i class="material-icons">location_ons</i>
            <p>Entradas</p>
        </a>
        </li>
        <li class="nav-item " id="pagos">
        <a class="nav-link" href="pagos">
            <i class="material-icons">notifications</i>
            <p>Cierre Caja</p>
        </a>
        </li>
        <li class="nav-item " id="configuracion">
        <a class="nav-link" href="configuracion">
            <i class="material-icons">bubble_chart</i>
            <p>Configuración</p>
        </a>
        </li>
        <li class="nav-item active-pro ">
        <a class="nav-link" href="salida">
            <i class="material-icons">unarchive</i>
            <p>Salir</p>
        </a>
        </li>
    </ul>
</div>

<script>
    let menu = ["usuario","index","servicios","clientes","entradas","pagos","configuracion"];
    for(let i = 0; menu.length > i; i++){
        if(menu[i] == window.location.pathname.split('/')[1]){
            document.getElementById(menu[i]).classList.add("active");
        }
    }
</script>