<div class="container-fluid py-4">
      <div class="row">
        <div class="col-sm-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Ganancias</p>
                  <h5 class="font-weight-bolder mb-0">
                    $130,220
                  </h5>
                  <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">+55% <span class="font-weight-normal text-secondary">que el mes anterior</span></span>
                </div>
                <div class="col-5">
                  <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="text-xs text-secondary">Octubre</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers1">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Este mes</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Este año</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Siempre</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Clientes</p>
                  <h5 class="font-weight-bolder mb-0">
                    923
                  </h5>
                  <span class="text-sm text-end text-success font-weight-bolder mt-auto mb-0">+12% <span class="font-weight-normal text-secondary">que el mes anterior</span></span>
                </div>
                <div class="col-5">
                  <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="text-xs text-secondary">Octubre</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers1">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Este mes</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Este año</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Siempre</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-body p-3 position-relative">
              <div class="row">
                <div class="col-7 text-start">
                  <p class="text-sm mb-1 text-capitalize font-weight-bold">Servicios</p>
                  <h5 class="font-weight-bolder mb-0">
                    7,200
                  </h5>
                  <span class="font-weight-normal text-secondary text-sm"><span class="font-weight-bolder">+$213</span> que el mes anterior</span>
                </div>
                <div class="col-5">
                  <div class="dropdown text-end">
                    <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers1" data-bs-toggle="dropdown" aria-expanded="false">
                      <span class="text-xs text-secondary">Octubre</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownUsers1">
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Este mes</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Este año</a></li>
                      <li><a class="dropdown-item border-radius-md" href="javascript:;">Siempre</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-4 col-sm-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-0">Servicios (este mes)</h6>
              </div>
            </div>
            <div class="card-body pb-0 p-3">
                <div class="col-12">
                      <!-- Array de nombre [ , , ], array datos [[],[]...],  -->
                    <div id="generar_grafica" style="max-width:100%; max-height: 180px"></div>
                        <script>
                        var options = {
                            xaxis:{
                                categories: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"],
                            },
                            series: [{
                                name: "Ventas de este día",
                                data: [1000, 800, 900, 1100, 2000, 1000, 1200]
                            }],
                            plotOptions: {
                                bar: {
                                borderRadius: 4,
                                horizontal: true,
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            chart: {
                            type: 'bar',
                            },
                            stroke: {
                            colors: ['#fff']
                            },
                            fill: {
                            opacity: 0.8
                            },
                            responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                width: 200
                                },
                                legend: {
                                position: 'bottom'
                                }
                            },
                            
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector("#generar_grafica"), options);
                        chart.render();
                        </script>
                </div>
            </div>
            <div class="card-footer pt-0 pb-0 p-3 d-flex align-items-center">
              <div class="w-60">
                <p class="text-sm">
                  Hay <b>70%</b> más ventas  el día <b>Viernes</b>, en promedio a otros días.
                </p>
              </div>
              <div class="w-40 text-end">
                <a class="btn bg-light mb-0 text-end" href="javascript:;">Ver más</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-0">Grafica</h6>
              </div>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <div id="generar_grafica2" style="max-width:100%; max-height: 180px">
                <script>
                          var options = {
          series: [{
          name: 'Octubre',
          data: [31, 40, 28, 51, 42, 109, 100]
        }, {
          name: 'Noviembre',
          data: [11, 32, 45, 32, 34, 52, 41]
        }],
          chart: {
          height: 350,
          type: 'area'
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        xaxis: {
          type: 'date',
          categories: ["2018-09-19", "2018-09-19", "2018-09-19", "2018-09-19", "2018-09-19", "2018-09-19", "2018-09-19"]
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy'
          },
        },
        };

        var chart = new ApexCharts(document.querySelector("#generar_grafica2"), options);
        chart.render();
                        </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Servicios completados</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Servicio</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Inicio</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fin</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-3 py-1">
                          <div>
                            <img src="https://website-assets-fd.freshworks.com/attachments/ckjv6jx7700lscjfzuyspsnv0-customer-service-team-training.one-half.png" class="avatar me-3" alt="image">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Cambio de luces</h6>
                            <p class="text-sm font-weight-bold text-secondary mb-0">Realizado el <span class="text-success">12/02/21</span> </p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">12/02/21</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0">12/02/21</p>
                      </td>
                      <td class="align-middle text-end">
                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                          <i class="ni ni-bold-up text-sm ms-1 mt-1 text-success"></i>
                          <p class="text-sm font-weight-bold mb-0">Terminado</p>
                        </div>
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