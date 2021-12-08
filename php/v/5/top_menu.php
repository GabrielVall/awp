<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Panel</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Inicio</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Inicio</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" list="ayuda-list" class="form-control" placeholder="Busca algo...">
              <datalist id="ayuda-list">
                  <option value="ventas">Informes de ventas</option>
                  <option value="ayuda">Como recibir pedidos</option>
                  <option value="ayuda">Como cambiar horarios</option>
                  <option value="ayuda">Como agregar Repartidores</option>
                  <option value="ayuda">Configurar pagos</option>
              </datalist>
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-bell py-2"> </i> 
      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger nt_pendientes">
        1
    <span class="visually-hidden">unread messages</span>
  </span>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Notificaciones</h5>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-0">
      <div class="card mt-4">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Notificaciones</h6>
        </div>
        <div class="card-body p-2">
          <ul class="list-group" id="notificaciones_content" >
          </ul>
          <button class="btn bg-gradient-dark w-100 mb-0">Ver todo</button>
        </div>
      </div>
      </div>
    </div>
  </div>