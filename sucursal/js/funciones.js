async function cambiar_hash(vista) {
    var hash = window.location.hash;
    if( hash.includes("=") ){
        var valor = hash.substring(hash.indexOf('=') + 1);
    }else{
        var valor = 0;
    }
    
    hash = hash.replace('#', '');
    hash = hash.replace('=' + valor, '');
    if (hash == '') hash = 'inicio';
    add_skeleton(vista, hash);
    await peticion_ajax_general(hash, vista, valor);
    
    $(".main-content").animate({
        scrollTop: 0
    }, "slow");
    funciones_hash(hash, valor);
    cambiar_nav(hash,valor);
}
verificar_cambios();
function verificar_cambios(){
    $.ajax({
        type: "POST",
        url: "../php/c/5/verificar_cambios.php",
        data:0,
        success: function(respuesta) {
            var tot = respuesta.header.length;
            if (respuesta.status == 'success') {
                for (i = 0; i < tot; i++) {
                    crear_div_notify(respuesta.header[i],respuesta.msg[i],moment(respuesta.hora[i]).fromNow());
                }   
            }
        }
    })
}

function crear_div_notify(titulo, mensaje,hora){
    var notif = '<li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg"> <div class="row justify-content-center align-items-center d-flex"> <div class="col-2 icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center"> <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mt-1"> <title>spaceship</title> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero"> <g transform="translate(1716.000000, 291.000000)"> <g transform="translate(4.000000, 301.000000)"> <path d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path> <path d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path> <path d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z" opacity="0.598539807"></path> <path d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z" opacity="0.598539807"></path> </g> </g> </g> </g> </svg> </div><div class="d-flex flex-column col-10"> <h6 class="mb-1 text-dark text-sm">'+titulo+'</h6> <span class="text-xs">'+mensaje+'<span class="font-weight-bold"> <br> '+hora+'</span></span> </div></div></li>';
    
    $('#notificaciones_content').append(notif);
}



function cambiar_nav(hash,valor) {
    if(valor != 0){
        hash = hash+valor;    
    }
    
    console.log(hash);
    $('.nav-link.active').removeClass('active');
    $('.nav-link.'+hash).addClass('active');
}

var status_ajx;
var mensaje_ajx;
var titulo_ajx;
function funciones_hash(hash, valor) {
    calcular_tiempo();
    switch (hash) {
        case 'inicio':
            break;
        case 'formulario':
            cambiar_select_estado();
            crear_inputs_telefono();
            break;
        case 'editar_formulario':
            crear_inputs_telefono();
            crear_mapa();
            preview_sucursal(valor);
            break;
        case 'configuracion':
            sonido_actual();
            break;
        case  'sucursal':
            buscar_ordenes();
            break;
        case 'agregar_producto_sucursal':
            peticion_ajax_general('select_categorias_sucursal', '#id_categoria', '0');
            peticion_ajax_general('select_complementos_sucursal', '#id_complementos', '0');
            peticion_ajax_general('select_menus_sucursal', '#id_menus', '0');
            break;
        case 'agregar_complementos_sucursal':
            cargar_tabla_ingredientes(0);
            break;
        default:
            break;
    }
    helper(hash);
    //     Metodos de pago configurables desde emp_com,emp_suc,suc
    //     reportes
}

function cargar_tabla_ingredientes(id){
    $('#tabla_ingredientes').html('<div class="row justify-content-center d-flex"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>');
    (async function(){
        await peticion_ajax_general('tabla_ingredientes_sucursal', '#tabla_ingredientes', '0');
        if(id != 0){
            var target = $('#btn_editar_complemento[data-id="'+id+'"]');
            target.parent().parent().parent().addClass('edited');
        }
    })();
}

function calcular_tiempo() {
    $( "[fecha-hora]" ).each(function(){
        $(this).html(moment($(this).attr('fecha-hora')).fromNow());
      });
}
var limite = 0;
async function buscar_ordenes(){
    await insertar_formulario(0,'buscar_ordenes',1);
    if(status_ajx == 'success'){
        mensaje_ajx.replace(/\//g,'');
        var arr = mensaje_ajx.split(',');;
        console.log(arr);
        crear_tr_tabla(arr[0],arr[1],arr[2],arr[3],arr[4]);
        calcular_tiempo();
    }
    // limite++;
    // if(limite < 5){
    //     buscar_ordenes();
    // }
}

function crear_tr_tabla(id,hora,estado,cliente,total){
    var row = '<tr class="new"><td><p class="text-xs font-weight-bold ms-2 mb-0 text-center">#'+id+'</p></td><td><span class="badge badge-dot me-4"><i class="bg-info"></i><span class="text-dark text-xs" fecha-hora="'+hora+'"></span></span></td><td class="text-xs font-weight-bold"><div class="d-flex align-items-center"><button class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-2 btn-sm d-flex align-items-center justify-content-center"><i class="fas fa-check" aria-hidden="true"></i></button><span>'+estado+'</span></div></td><td class="text-xs font-weight-bold"><div class="d-flex align-items-center"><span>'+cliente+'</span></div></td><td class="align-middle text-center"><button class="btn btn-icon bg-gradient-primary" id="ref" data-ref="orden_sucursal='+id+'">Ver detalles </button></td><td class="align-middle text-center"><span class="badge badge-dot me-4"><i class="bg-info"></i><span class="text-success text-xs">$'+total+'</span></span></td></tr>';
    $('tbody').prepend(row);
}

var paises_pref = ["mx","co","us","es"];
function crear_inputs_telefono(){
    const input = document.querySelector("#telefono");
    window.intlTelInput(input, {
        initialCountry:paises_pref[0],
        separateDialCode:true,
        preferredCountries: paises_pref,
    });
    var iti = window.intlTelInputGlobals.getInstance(input);

    const input_wsp = document.querySelector("#telefono_wsp");
    window.intlTelInput(input_wsp, {
        initialCountry:paises_pref[0],
        separateDialCode:true,
        preferredCountries: paises_pref,
    });
    var iti2 = window.intlTelInputGlobals.getInstance(input_wsp);

    if(input.value.length > 5 || input_wsp.value.length > 5){
        iti.setNumber('+'+input.value);
        iti2.setNumber('+'+input_wsp.value);
    }
    
}

const helper_hash = ['formulario'];

function helper(hash) {
    if (helper_hash.includes(hash)) {
        if (localStorage.getItem(hash) === null) {
            introJs().start().onexit(function() {
                (async function() {
                    await peticion_ajax_general('modales_ayuda/' + hash, '#helper');
                    $('#modal_ayuda').modal('show');
                    localStorage.setItem(hash, 1);
                })();
            });
        }
    }
}

function add_skeleton(vista, hash) {
    switch (hash) {
        case 'inicio':
            $(vista).html(sk_inicio);
            break;

        default:
            $(vista).html(sk_inicio);
            break;
    }
}

function cambiar_select_estado() {
    $('#select_estado').val('');
    $('#ciudad_select_cont').html('');
    $('#direccion_cont').html('<p class="form-control"> Selecciona un estado para continuar</p>');
    traer_vista_valores('estado_select', '#estado_select', [$('#pais_select')]);
}

function cambiar_ciudad_select() {
    $('#select_ciudad').val('');
    if ($('#select_estado').val() > 0) {
        traer_vista_valores('ciudad_select', '#ciudad_select_cont', [$('#select_estado')]);
    } else {
        $('#ciudad_select_cont').html('');
        $('#direccion_cont').html('<p class="form-control"> Selecciona un estado para continuar</p>');
    }
}

async function cambiar_direccion_formulario() {
    if ($('#select_estado').val() > 0 && $('#select_ciudad').val() > 0) {
        await traer_vista_valores('direccion_input', '#direccion_cont', [$('#select_ciudad')]);
        crear_mapa();
    } else {
        $('#direccion_cont').html('');
    }
}

// function validar_texto_no_especiales(event, limite) {
//     var regex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
//     var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
//     if (regex.test(key)) {
//         event.preventDefault();
//         return false;
//     }
//     if ($(event.target).val().trim().length >= limite) {
//         $(event.target).addClass('is-valid').removeClass('is-invalid');
//         $(event.target).parent().next().html('');
//     } else {
//         $(event.target).parent().next().html('<small class="ms-2"><i class="fas fa-info-circle"></i> El texto es demasiado corto</small>');
//         $(event.target).removeClass('is-valid').addClass('is-invalid');
//     }
// }
// val-min="" caracteres minimos minimo
// val-max="" caracteres maximos
// val-text="" permite texto (0 no, 1 si)
// val-num="" permite numeros (0 no, 1 si)
// val-mail="" valida @ y . de un correo (0 no, 1 si)"
$(document).on('keyup','.val_text', function(e) {

    // Se declara el input
    var input = $(e.target);

    // Valor sin espacios dobles
    var valor_input = e.target.value.replace( /  +/g, ' ' );

    // Estructura lables para validar
    var inp_valido = '<label class="text-success"><i class="fas fa-check-circle"></i> Este campo es valido</label>';
    var inp_invalido = '<small class="ms-2"><i class="fas fa-info-circle"></i> El texto es demasiado corto</small>';
    var inp_correo_invalido = '<small class="ms-2"><i class="fas fa-info-circle"></i> Este correo no es valido</small>';
    
    // Parametros disponibles
    var minimo = parseInt(input.attr('val-min'));
    var maximo = parseInt(input.attr('val-max'));
    var text = input.attr('val-text');
    var mail = input.attr('val-mail');
    var tel = input.attr('val-tel');
    var placa = input.attr('val-placa');
    var nit = input.attr('val-nit');
    var usr = input.attr('val-usr');
    // Si no estan definidas se asigna un valor auto
    if (!maximo) { maximo = 100; }
    if (!minimo) { minimo = 0; }

    // Variables Regex
    var no_letras = new RegExp(/[^a-zA-Z ]/g);
    var no_num = new RegExp(/[^0-9\.]+/g);
    var espacios = new RegExp(/\s/g);
    var letras_num = new RegExp(/[^A-Za-z0-9_-]/g);
    if(text == 1 && tel != 1 ){
        // Remueve el ultimo caracter
        valor_input = valor_input.replace(no_letras, "")
    }
    if(text == 1 && tel == 1 ){
        // Remueve el ultimo caracter
        valor_input = valor_input.replace(letras_num, "")
    }
    if(usr == 1){
        // Elimina el texto de un string
        valor_input = valor_input.replace(no_letras, "")
    }
    if (tel == 1 && text != 1) {
        // Elimina los numeros de un string
        valor_input = valor_input.replace(no_num, '');
    }

    if (placa == 1) {
        // Elimina los espacios de un string y los pone auto cada 3 caracter
        console.log(valor_input.length);
        if(valor_input.length < 4){
            // Si son los 3 primeros caracteres solo permite texto
            valor_input = valor_input.replace(no_letras, '');
        }else{
            if(!tiene_numero(valor_input.slice(-1))){
                // Si tiene mas de 4 caracteres y escribe un numero lo elimina
                valor_input = valor_input.slice(0, -1);
            }
            // Establece el nuevo valor del input y agrega un espacio en el 4to caracter
            valor_input = valor_input.replace(espacios, '').replace(/([A-Za-z0-9]{3})/g, '$1 ').trim();
        }
    }

    if(nit == 1){
        valor_input = valor_input.replaceAll(/[^0-9]/g, '').replace(/([0-9]{3})/g, '$1.').replace(/\.(?=[^.]*$)/, "-").trim();
    }
    if(!$(this).parent().next().is('validado')){
        $(this).parent().after('<validado></validado>');
    }
    // Tamaño del texto sin espacios
    var size = valor_input.replace(espacios, '').length;
    
    // Si el texto es más largo que lo permitido, se elmina el ultimo caracter escrito
    if(size > maximo) valor_input = valor_input.slice(0, maximo);

    // Si el texto es menor al minimo pero no es tipo correo, se agrega la clase invalida
    if(size < minimo && mail != 1) $(this).addClass('is-invalid').removeClass('is-valid').parent().next().html(inp_invalido);

    // Si el valor se encuentra entre lo permitido y no es tipo mail, se agrega la clase valida
    if(size >= minimo && size <= maximo && mail != 1) $(this).removeClass('is-invalid').addClass('is-valid').parent().next('validado').remove();
    
    // Si es tipo mail y no cumple con los requisitos, se agrega la clase invalida
    if(mail == 1 && !es_mail(valor_input) ) $(this).addClass('is-invalid').removeClass('is-valid').parent().next().html(inp_correo_invalido);

    // Si es mail y se cumplen los requisitos, se agrega la clase valida
    else if( mail == 1 && es_mail(valor_input) ) $(this).removeClass('is-invalid').addClass('is-valid').parent().next('validado').remove();
    
    // Se le asigna el valor al input
    e.target.value = valor_input;
});
var loader = '<div class="justify-content-center d-flex"><div class="lds-dual-ring"></div></div>';

/**
 * @archivo {String} nombre del archivo a llamar
 * @contenedor {String} donde obtendra los valores de cada input/textarea
 * @vista {string} carpeta a donde enviara el archivo 5 empresa de comida (default) 1 sucursal
 * @id {object} id del boton seleccionado, para updates o deletes, si no se envia valor no se tomara en cuenta
 */

function insertar_formulario(contenedor, archivo, vista = 5,id = 0) {
    return new Promise((resolve) => {
        var fd = new FormData();
        if(contenedor != 0){
            if(id != 0){
                fd.append('id', id);
            }
            $(contenedor + " input," + contenedor + " textarea," + contenedor + " select").each(function() {
                if (!$(this).attr('aria-label')) {
                    if ($(this)[0].type == 'file') {
                        fd.append($(this).attr("name"), $(this)[0].files[0]);
                    }
                    else if($(this).is('#telefono') || $(this).is('#telefono_wsp')){
                        var num = $(this).prev().find('.iti__selected-dial-code').html() + escapear($(this).val());
                        num = num.substring(1);
                        fd.append($(this).attr("name"),  num);
                    }
                    else {
                        fd.append( $(this).attr("name"), escapear( $(this).val() ) );
                    }
                }
            });
        }
        $.ajax({
            type: "POST",
            url: "../php/c/"+vista+"/" + archivo + ".php",
            contentType: false,
            processData: false,
            data: fd,
            success: function(respuesta) {
                status_ajx = respuesta.status;
                mensaje_ajx = respuesta.msg;
                titulo_ajx = respuesta.titulo;
                tipo_ajx = respuesta.tipo; 
                resolve();
                if(contenedor != 0){
                    alerta_ajax(titulo_ajx,mensaje_ajx,status_ajx,tipo_ajx);
                }
            }
        });
    });
}

/**
 * @archivo {String} nombre del archivo a llamar
 * @vista {String} donde mostrara el archiv
 * @inputs {Array} inputs donde obtendra valores y name
 */

function imprimir_contenido(archivo,contenedor,valores){
    return new Promise((resolve) => {
        var fd = new FormData();
        valores.forEach(element => {
            fd.append(element[0], escapear(element[1]));
        });
        $.ajax({
            type: "POST",
            url: "../php/v/5/" + archivo + ".php",
            contentType: false,
            processData: false,
            data: fd,
            success: function(respuesta) {
            status_ajx = respuesta.status;
            mensaje_ajx = respuesta.msg;
            titulo_ajx = respuesta.titulo;
            tipo_ajx = respuesta.tipo; 
            $(contenedor).html(respuesta);
            resolve();
            }
        });
    });
};


function traer_vista_valores(archivo, vista, valores) {
    return new Promise((resolve) => {
        datos = '';
        $(valores).each(function() {
            datos = datos + '&' + $(this).attr("name") + '=' + $(this).val();
        });
        datos = datos.substring(1);
        $.ajax({
            type: "POST",
            url: "../php/v/5/" + archivo + ".php",
            data: datos,
            success: function(respuesta) {
                $(vista).html(respuesta);
                resolve();
            }

        })
    });
}

/**
 * @archivo {String} nombre del archivo a llamar
 * @contenedor {String} donde imprimira el contenido ej. '#contenedor', mandar 0 para no imprimir
 */

function peticion_ajax_general(archivo, contenedor, valor = 0,modal = 0) {
    var vista = 5;
    if(archivo.includes("sucursal") || modal == 1){
        vista = 1;
    }
    return new Promise((resolve) => {
        $.ajax({
            type: "POST",
            url: '../php/v/'+vista+'/' + archivo + '.php',
            data: 'valor=' + valor,
            success: function(respuesta) {
                if (contenedor != 0) {
                    $(contenedor).html(respuesta);
                    resolve();
                } else {
                    if (respuesta.status == 'success') {
                        resolve();
                    } else {
                        alert('Error al procesar la solicitud');
                    }
                }
            },
            error: function(error) {
                alert('Error 500');
            }
        });
    });
}

function preview_sucursal(editar = 0) {
    $('#preview_sucursal').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...').addClass('unable');
    var nombre = $('#nombre_sucursal').val();
    var desc = $('#desc').val();
    var categ = $('option:selected', '#categoria_select').attr('data-cat');
    // FD form data
    var fd = new FormData();
    if ($('#imagen_sucursal')[0].files[0] == undefined && editar == 0) {
        basic_notify('message','Primero selecciona una imagen');
        $('#preview_sucursal').html(' Previsualizar').removeClass('unable');
    } else {
        var img = $('#imagen_sucursal')[0].files;
        fd.append('file', img[0]);
        $.ajax({
            type: 'POST',
            url: '../php/c/5/cargar_preview_img.php',
            contentType: false,
            processData: false,
            data: fd,
            success: function(respuesta) {
                $('#preview_sucursal').html(' Previsualizar').removeClass('unable');
                if ($('#imagen_sucursal').val() != '') {
                    var tiene_img = '&img=1';
                } else {
                    var tiene_img = '';
                }
                var url = 'nombre=' + nombre + '&desc=' + desc + '&categ=' + categ + tiene_img;
                $('#frame_sucursal').replaceWith('<iframe height="562" width="315" id="frame_sucursal" src="preview/sucursal.php?' + url + '&editar=' + editar + '"></iframe>');
            }
        });
    }
}
// MAPS

function crear_mapa() {
    var lat = $('#map').data('lat');
    var lon = $('#map').data('lon');
    $('#map').show();
    const map = new google.maps.Map(document.getElementById("map"), {
        center: {
            lat: lat,
            lng: lon
        },
        zoom: 13,
        mapTypeId: "terrain",
    });
    // Create the search box and link it to the UI element.
    const input = document.getElementById("direccion");
    const searchBox = new google.maps.places.SearchBox(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            // Create a marker for each place.
            markers.push(
                new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                })
            );
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
                document.getElementById('lat_mp').value = place.geometry.location.lat();
                document.getElementById('lng_mp').value = place.geometry.location.lng();
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

function play(clase = 'notify') {
    var audio = $('.audio.' + clase)[0];
    audio.play();
}


function alerta_ajax(titulo,mensaje,estado,tipo){
    if(tipo == 'alerta'){
        alertify.alert(titulo, mensaje);    
    }else{
        alertify.notify(mensaje,estado);
    }
};

function basic_alert(titulo, mensaje) {
    play();
    alertify.alert(titulo, mensaje);
    $('.unable').removeClass('unable');
}

function basic_notify(status, mensaje) {
    play();
    alertify.notify(mensaje,status);
}

function esNum(x) {
    return parseFloat(x).toString() === x.toString();
}

function escapear(s) {
    if(Array.isArray(s)) return JSON.stringify(s);
    if (isNaN(s)) {
        return s.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    } else {
        return s;
    }
}

function sonido_actual(){
    if (localStorage.getItem('notify') !== null) { var notify = localStorage.getItem('notify'); }else{ var notify = '../sounds/long-pop.wav'; }
    notify = notify.substring(10);
    $('#notify-sound').html(notify);

    if(localStorage.getItem('success') !== null ){ var success = localStorage.getItem('success'); }else{ var success = '../sounds/digital-quick-tone.wav'; }
    success = success.substring(10);
    $('#success-sound').html(success);

    if(localStorage.getItem('error')  !== null ){var error = localStorage.getItem('error');}else{var error = '../sounds/elevator-tone.wav';}
    error = error.substring(10);
    $('#error-sound').html(error);

}
function cambiar_sonido_local(){
    if (localStorage.getItem('notify') !== null) {
        var notify = localStorage.getItem('notify');
    }else{
        var notify = '../sounds/long-pop.wav';
    }
    if(localStorage.getItem('success') !== null ){
        var success = localStorage.getItem('success');
    }else{
        var success = '../sounds/digital-quick-tone.wav';
    }
    if(localStorage.getItem('error') !== null ){
        var error = localStorage.getItem('error');
    }else{
        var error = '../sounds/elevator-tone.wav';
    }
    $('.audio.notify').replaceWith('<audio class="audio notify" src="'+notify+'"></audio>');
    $('.audio.success').replaceWith('<audio class="audio success" src="'+success+'"></audio>');
    $('.audio.error').replaceWith('<audio class="audio error" src="'+error+'"></audio>');
}

var btn_antes = '';
function add_load_btn(boton,tipo,simple = 0){
    if(tipo == 0){
        btn_antes = $(boton).html();
        $(boton).addClass('unable');
        var texto_load = '';
        if(simple == 0){
            texto_load = 'Cargando...';
        }
        return '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'+texto_load;
        
    }else{
        var x =  btn_antes;
        $(boton).removeClass('unable');
        btn_antes = '';
        return x;
    }
}

function validar_inputs(contenedor){
    var vacios = 0;
    var invalidos = 0;
    $(contenedor+" input,"+contenedor+" textarea,"+contenedor+" select").each(function () {
        if( $(this).val() == '' && $(this).is(":visible") ){
            vacios++;
        }if( $(this).hasClass('val_text') && $(this).hasClass('is-invalid')  && $(this).is(":visible") ){
            invalidos++;
        }
    });
    console.log(invalidos,vacios);
    if(vacios > 2 && invalidos > 2){
        alerta_ajax('Error',"Hay " +vacios+ " campo(s) sin rellenar y " +invalidos+ " campo(s) invalidos",'error','alerta');
    }else if(vacios > 2){
        alerta_ajax('Error',"Hay " +vacios+ " campos sin rellenar",'error','alerta');
    }else if(invalidos > 2){
        alerta_ajax('Error',"Hay " +invalidos+ " campos invalidos",'error','alerta');
    }
    return vacios + invalidos;
}

function agregar_complementos_div(lista,posicion){
    var target = $('#modal_complementos[data-pos="'+posicion+'"]');
    agregar_data_complementos(lista,target);
}

function agregar_data_complementos(lista,target){
    var lista = lista.filter(function(entry) { return entry.trim() != ''; });
    if(lista.length == 0){
        var text = 'Materiales para el servico';
    }else{
        var text = lista.length + ' asignados';
    }
    target.html('<i class="fas fa-link" aria-hidden="true"></i> '+text);
    target[0].setAttribute('complementos',lista);
}
function quitar_complementos_generados(){
    $('.ingrediente_row').slice(1).each(function() { $(this).remove(); });
}
function generar_editar_ingrediente(id,nombre,minimo,maximo,multiple,complementos){
    $('#nombre_complemento').val(nombre);
    $('#cant_minima').val(minimo);
    $('#cant_maxima').val(maximo);
    $('#seleccion_multiple').val(multiple);
    agregar_row_ingrediente(complementos.length-1);
    $('.ingrediente_row').each(function(x){
        $(this).find('.nombre').val(complementos[x].nombre);
        $(this).find('.precio').val(complementos[x].precio);
        agregar_data_complementos(complementos[x].ids.split(','),$(this).find('#modal_complementos'));
    });
    
}
function vaciar_inputs_contenedor(contenedor){
    $(''+contenedor+' input').each(function() {
        $(this).val('').removeClass('is-valid is-invalid');
        $('validado').remove();
    });
}

var pos = 0;
function agregar_row_ingrediente(total){
    for (var i = 0; i < total; i++) { 
        pos++;
        var row_ing = '<span class="row m-0 p-0 justify-content-center d-flex ingrediente_row"> <div class="col-12 col-sm-6 nom-comp"> <div> <label>Nombre</label> <input class="multisteps-form__input form-control val_text nombre" val-min="3" val-max="20" val-text="1" type="text" placeholder="Nombre del ingrediente"> </div><span id="validar"></span> </div><div class="col-12 col-sm-6 precio-comp"> <div> <label>Precio</label> <input class="multisteps-form__input form-control val_text precio" val-min="1" val-tel="1" type="text" placeholder="Precio por selección"> </div><a data-pos="'+pos+'" complementos="0" class=" float-end btn btn-link text-dark p-0 m-0 my-1" id="modal_complementos" href="javascript:;"><i class="fas fa-link"></i> Materiales para el servico</a> </div></span>';
        $('#complementos_div').append(row_ing);
        $('#quitar_ing_vista').css('display','inline-block');
     }
}
