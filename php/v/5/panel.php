<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Abierto</p>
                    <h5 class="font-weight-bolder mb-0">
                    Cierra en: 3 horas
                    </h5>
                </div>
                </div>
                <div class="col-4 text-end">
                <div class="active-icon icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <svg class="m-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
            <div class="row">
                <div class="col-8">
                <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Repartidores</p>
                    <h5 class="font-weight-bolder mb-0">
                    10 disponibles
                    </h5>
                </div>
                </div>
                <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
            <div class="row align-items-center">
                <div class="col-8">
                    <h5 class="font-weight-bolder">
                    Crear pedido
                    </h5>
                </div>
                <div class="col-4 text-end">
                <div class="active-icon icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <svg class="m-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    
    </div>
    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
        <div class="card mb-4">
        <a class="btn btn-link text-dark my-0" href="javascript:;"><i class="fas fa-filter"></i> Quitar filtros</a>
        <div class="row justify-content-center d-flex  text-center">
            <div class="col-8">
                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-times"></i> Completada</a>
                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-times"></i> Pendientes</a>
                <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="fas fa-times"></i> Canceladas</a>
            </div>
        </div>
        <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Pedidos </h6>
                  <p class="text-sm mb-0">
                  <i class="fas fa-stream text-info"></i>
                    <span class="font-weight-bold ms-1">30 ordenes</span> restantes
                  </p>
                </div>
                <div class="col-lg-6 col-5 my-auto text-end" style="padding-right:90px">
                  <div class="dropdown float-lg-end pe-4">
                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-ellipsis-v text-secondary" aria-hidden="true"></i>
                    </a>
                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable" style="">
                      <li><a class="dropdown-item border-radius-md" data-bs-toggle="modal" data-bs-target="#exampleModal" href="javascript:;"><i class="fas fa-filter" aria-hidden="true"></i> Filtrar</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;"><i class="fas fa-redo-alt"></i> Actualizar</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;"><i class="fas fa-clipboard-list"></i> Limpiar completadas</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Pago</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Orden</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tiempo</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Alberto Hernandez</h6>
                                <p class="text-xs text-secondary mb-0">528781383809</p>
                            </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Efectivo</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-danger">Cancelada</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Domicilio</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Ver detalles</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold" data-precio="400"></span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold" tiempo-origen="12:31">Hace 1 hora</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">a b</span>
                        </td>

                        <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Senia Michel Vega De La Cruz</h6>
                                <p class="text-xs text-secondary mb-0">528781383809</p>
                            </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Efectivo</span>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-danger">Cancelada</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Domicilio</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">Ver detalles</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold" data-precio="400"></span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold" tiempo-origen="12:42">Hace 1 hora</span>
                        </td>
                        <td>
                            <span class="text-xs font-weight-bold">a b</span>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Modal filtro -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 700px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filtrar ordenes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row mx-4 d-flex">
                <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked="">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Mostrar completadas</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Mostrar pendientes</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked="">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Mostrar canceladas</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked="">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Mostrar en envio</label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked="">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Envio a domicilio</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Entregar en sucursal</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked="">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">En efectivo</label>
                            </div>
                        </li>
                        <li class="list-group-item border-0 px-0">
                            <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked="">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Pago digital</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-info">Aplicar filtro</button>
      </div>
    </div>
  </div>
</div>