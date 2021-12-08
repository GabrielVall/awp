$(document).ready(function () {
    /* --------------------------------- INICIO --------------------------------- */
    cambiar_contenido_hash();
    var interval_ubicacion_repartidor;
    var interval_ordenes_dashboard;
    var interval_notificaciones = setInterval(function(){
        notificaciones_sistema();
    },20000);
    /* ---------------------------------- HASH ---------------------------------- */
    window.onhashchange = function () {
        cambiar_contenido_hash();
    }
    /* --------------------------------- GENERAL -------------------------------- */
    // EXPANDIR - CONTRAER MAPA
    $(document).on("click", "#expandir_mapa", function () {
        var mapa = $(this).data("map");
        $(mapa).slideToggle();
        if ($(this).text() == "expand_more") {
            $(this).text("expand_less");
        }
        else {
            $(this).text("expand_more");
        }
    });
    var primera_carga = 0;
    function cambiar_contenido_hash() {
        calcular_tiempo();
        clearInterval(interval_ubicacion_repartidor);
        clearInterval(interval_ordenes_dashboard);
        var hash = window.location.hash;
        var hash = hash.replace('#', '');
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/') + 1);
        hash_anterior = hash;

        if ((filename.length == 0 || filename == 'empresa_reparto.php')) {
            if (hash == '') {
                hash = "inicio";
                window.location.hash = '#inicio';
            }
            if (window.location.hash.indexOf('info_conductor_') == 1) {
                var id_repartidor = hash.split("_");
                get_view_main('repartidores', 'info_personal', { id_repartidor: id_repartidor[2] }, "#main");
            }
            else if (window.location.hash.indexOf('order_detail_') == 1) {
                var id_orden = hash.split("_");
                get_view_main('ordenes', 'detalles_orden', { id_orden: id_orden[2] }, "#main");
            }
            else if (window.location.hash.indexOf('order_express_detail_') == 1) {
                var id_orden = hash.split("_");
                get_view_main('ordenes_express', 'detalles_orden', { id_orden: id_orden[3] }, "#main");
            }
            else if (window.location.hash.indexOf('customer_') == 1) {
                var id_cliente = hash.split("_");
                get_view_main('clientes', 'info_cliente', { id_cliente: id_cliente[1] }, "#main");
            }
            else if (window.location.hash.indexOf('sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('sucursales', 'info_sucursal', { id_sucursal: id_sucursal[1] }, "#main");
            }
            else if (window.location.hash.indexOf('horarios_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('sucursales', 'horarios_sucursal', { id_sucursal: id_sucursal[2] }, "#main");
            }
            else if (window.location.hash.indexOf('categorias_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('categorias_productos', 'categorias', { id_sucursal: id_sucursal[2] }, "#main");
            }
            else if (window.location.hash.indexOf('productos_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('productos', 'productos', { id_sucursal: id_sucursal[2] }, "#main");
            }
            else if (window.location.hash.indexOf('producto_info_') == 1) {
                var id_producto = hash.split("_");
                get_view_main('productos', 'info_producto', { id_producto: id_producto[2] }, "#main");
            }
            else if (window.location.hash.indexOf('ingredientes_productos_') == 1) {
                var id_producto = hash.split("_");
                get_view_main('productos', 'ingredientes_productos', { id_producto: id_producto[2], id_sucursal: id_producto[3] }, "#main");
            }
            else if (window.location.hash.indexOf('menus_productos_') == 1) {
                var id_producto = hash.split("_");
                get_view_main('productos', 'menus_productos', { id_producto: id_producto[2], id_sucursal: id_producto[3] }, "#main");
            }
            else if (window.location.hash.indexOf('imagenes_productos_') == 1) {
                var id_producto = hash.split("_");
                get_view_main('productos', 'imagenes', { id_producto: id_producto[2] }, "#main");
            }
            else if (window.location.hash.indexOf('ingredientes_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('ingredientes', 'ingredientes', { id_sucursal: id_sucursal[2] }, "#main");
            }
            else if (window.location.hash.indexOf('ingrediente_info_') == 1) {
                var id_ingrediente = hash.split("_");
                get_view_main('ingredientes', 'editar', { id_ingrediente: id_ingrediente[2] }, "#main");
            }
            else if (window.location.hash.indexOf('schedules_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('menus', 'menus', { id_sucursal: id_sucursal[2] }, "#main");
            }
            else if (window.location.hash.indexOf('schedule_info_') == 1) {
                var id_menu = hash.split("_");
                get_view_main('menus', 'editar', { id_menu: id_menu[2] }, "#main");
            }
            else if (window.location.hash.indexOf('documentos_repartidor_') == 1) {
                var id_repartidor = hash.split("_");
                get_view_main('repartidores', 'documentos', { id_repartidor: id_repartidor[2] }, "#main");
            }
            else if (window.location.hash.indexOf('vehiculos_repartidor_') == 1) {
                var id_repartidor = hash.split("_");
                get_view_main('repartidores', 'vehiculos', { id_repartidor: id_repartidor[2] }, "#main");
            }
            else if (window.location.hash.indexOf('asignar_orden_') == 1) {
                var id_repartidor = hash.split("_");
                get_view_main('ordenes', 'asignar_orden_repartidor', { id_repartidor: id_repartidor[2] }, "#main");
            }
            else if (window.location.hash.indexOf('area_servicio_info_') == 1) {
                var id_zona = hash.split("_");
                get_view_main('zonas', 'editar', { id_zona: id_zona[3] }, "#main");
            }
            else if (window.location.hash.indexOf('ubicacion_repartidor_') == 1) {
                var id_repartidor = hash.split("_");
                get_view_main('repartidores', 'ubicacion', { id_repartidor: id_repartidor[2] }, "#main");

                interval_ubicacion_repartidor = setInterval(function(){
                    get_view_main('repartidores', 'ubicacion_interval', { id_repartidor: id_repartidor[2] }, "#main_ubicacion");
                }, 60000);
            }
            else if (window.location.hash.indexOf('ban_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('sucursales', 'clientes_bloqueados', { id_sucursal: id_sucursal[2] }, "#main");
            }
            else if (window.location.hash.indexOf('ban_express_sucursal_') == 1) {
                var id_sucursal = hash.split("_");
                get_view_main('sucursales_express', 'clientes_bloqueados', { id_sucursal: id_sucursal[3] }, "#main");
            }
            else if (window.location.hash.indexOf('mensualidad_detalles_') == 1) {
                var id_historial_pago = hash.split("_");
                get_view_main('mensualidad', 'detalles_mensualidad', { id_historial_pago: id_historial_pago[2] }, "#main");
            }
            else if (window.location.hash.indexOf('order_punto_detail_') == 1) {
                var id_orden = hash.split("_");
                get_view_main('ordenes_punto_a_punto', 'detalles_orden', { id_orden: id_orden[3] }, "#main");
            }
            else if (window.location.hash.indexOf('empresa_comida_sucursales_') == 1) {
                var id_empresa_comida = hash.split("_");
                get_view_main('empresas_comida', 'sucursales', { id_empresa_comida: id_empresa_comida[3] }, "#main");
            }
            else {
                switch (hash) {
                    case "inicio":
                        get_view_main("dashboard", "dashboard", "", "#main");
                        interval_ordenes_dashboard = setInterval(function(){
                            var id_estado=$("#content_ordenes .card-header").data("estado");
                            var text=$("#content_ordenes .card-header").data("text");
                            
                            get_view_main('ordenes', 'ordenes_dashboard', { id_estado: id_estado, text:text }, "#content_ordenes");
                            get_view_main('dashboard', 'ultimas_acciones', '', "#content_ultimas_acciones");
                            get_view_main('dashboard', 'ordenes_express', '', "#content_ordenes_express");
                            get_view_main('dashboard', 'ordenes_punto_a_punto', '', "#content_ordenes_punto_a_punto");
                            get_view_main('dashboard', 'repartidores_activos', '', "#content_repartidores_activos");
                        }, 120000);
                        break;
                    
                    case "nuevo_producto":
                        get_view_main("productos", "agregar", "", "#main");
                        break;
                    
                    case "nuevo_cliente_bloqueado_sucursal_express":
                        get_view_main("sucursales_express", "bloquear_clientes", "", "#main");
                        break;
                    
                    case "nuevo_cliente_bloqueado_sucursal":
                        get_view_main("sucursales", "bloquear_clientes", "", "#main");
                        break;
                    
                    case "nueva_orden_express":
                        get_view_main("ordenes_express", "agregar", "", "#main");
                        break;

                    case "nuevo_ingrediente":
                        get_view_main("ingredientes", "agregar", "", "#main");
                        break;
                    
                    case "nuevo_cliente":
                        get_view_main("clientes", "agregar", "", "#main");
                        break;
                    
                    case "nuevo_schedule":
                        get_view_main("menus", "agregar", "", "#main");
                        break;
                    
                    case "nueva_area_servicio":
                        get_view_main("zonas", "agregar", "", "#main");
                        break;
                    
                    case "nuevo_repartidor":
                        get_view_main("repartidores", "agregar", "", "#main");
                        break;
                    
                    case "nueva_sucursal":
                        get_view_main("sucursales", "agregar", "", "#main");
                        break;
                    
                    case "clientes_ban":
                        get_view_main("clientes", "bloquear", "", "#main");
                        break;
                    
                    case "pagar_servicio":
                        get_view_main("mensualidad", "mensualidad", "", "#main");
                        break;
                    
                    case "tipos_transportes":
                        get_view_main("tipos_transportes", "tipos_transportes", "", "#main");
                        break;
                    
                    case "resumen_ventas":
                        get_view_main("resumenes", "resumenes", "", "#main");
                        break;
                    
                    case "areas_servicio":
                        get_view_main("zonas", "zonas", "", "#main");
                        break;
                    
                    case "categorias_sucursales":
                        get_view_main("categorias_sucursales", "categorias", "", "#main");
                        break;
                    
                    case "solicitudes_repartidores":
                        get_view_main("repartidores", "solicitudes", "", "#main");
                        break;
                    
                    case "nueva_orden_punto_a_punto":
                        get_view_main("ordenes_punto_a_punto", "agregar", "", "#main");
                        break;
                    
                    case "sucursales_express":
                        get_view_main("sucursales_express", "sucursales_express", "", "#main");
                        break;
                    
                    case "clientes":
                        get_view_main("clientes", "clientes", "", "#main");
                        break;
                    
                    case "sucursales":
                        get_view_main("sucursales", "sucursales", "", "#main");
                        break;
                    
                    case "historial_ordenes":
                        get_view_main("ordenes", "historial", "", "#main");
                        break;
                    
                    case "repartidores":
                        get_view_main("repartidores", "repartidores", "", "#main");
                        break;
                    
                    case "empresas_comida":
                        get_view_main("empresas_comida", "empresas_comida", "", "#main");
                        break;
                    
                    case "costos_km":
                        get_view_main("costos_km", "costos_km", "", "#main");
                        break;
                    
                    case "config_metodo_pago":
                        $("#modal_configuraciones").modal("hide");
                        setTimeout(function(){
                            get_view_main("configuraciones", "metodos_pago", "", "#main");
                        },500);
                        break;
                    
                    case "config_cuenta":
                        $("#modal_configuraciones").modal("hide");
                        setTimeout(function(){
                            get_view_main("configuraciones", "info_cuenta", "", "#main");
                        },500);
                        break;
                    
                    case "config_avanzadas":
                        $("#modal_configuraciones").modal("hide");
                        setTimeout(function(){
                            get_view_main("configuraciones", "config_avanzada", "", "#main");
                        },500);
                        break;
                }
            }
        }
        else {
            if (primera_carga == 0) {
                primera_carga++;
                window.location.hash = '';
            }
            else {
                primera_carga = 0;
                window.location.href = "empresa_reparto.php#" + hash + "";
            }
        }
    }
    // FORMATO DE NOMBRE
    $(document).on("keyup",".name_format",function(){
        $(this).val(name_format($(this).val()));
    });
    // FORMATO DE TEXTO GENERICO
    $(document).on("keyup",".string_format",function(){
        $(this).val(name_format($(this).val()));
    });
    // FORMATO DE PRECIO
    $(document).on("keyup",".price_format",function(){
        $(this).val(price_format($(this).val()));
    });
    // FORMATO DE TELÉFONO
    $(document).on("keyup",".phone_format",function(){
        $(this).val(phone_format($(this).val()));
    });
    // FORMATO DE CORREO
    $(document).on("keyup",".email_format",function(){
        $(this).val(email_format($(this).val()));
    });
    // PAGINACIÓN ENTRE BOTONES NUMÉRICOS
    $(document).on("click", "#new_page", function () {
        var page = parseInt($(this).data("page"));
        var ultima_pagina = $("#next_page").data("last");

        $(".pagination li").removeClass("active");
        $(this).addClass("active");

        $("#tbody_repartidores_activos tr, #tbody_categorias_sucursal tr, #tbody_sucursal tr, #tbody_sucursal_express tr, #tbody_repartidor tr, #tbody_cliente tr, #tbody_tipos_transporte tr, #tbody_empresa_comida tr, #tbody_costos_km tr, #tbody_zonas tr").each(function () {
            if ($(this).hasClass("page_" + (page))) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });

        if ($(this).next().find("a").text() == '...') {
            $(".pagination li").removeClass("active");
            $(".pagination li.page-item-" + (page - 1)).addClass("active");
            if (ultima_pagina == (page + 1)) {
                $("#next_page").prevAll().slice(0, 1).insertAfter("#prev_page");
            }
            $(".pagination li a:not(:contains(Ant.), .pagination li a:not(:contains(Sig.))").each(function () {
                var new_page = $(this).parent().data("page");
                if (new_page != undefined) {
                    if (new_page <= page) {
                        $(this).text(parseInt(new_page + 1)).parent().removeClass("page-item-" + new_page).addClass("page-item-" + (new_page + 1)).data("page", (new_page + 1));
                    }
                }
            });
        }
        else if ($(this).prev().find("a").text() == '...') {
            $(".pagination li").removeClass("active");
            $(".pagination li.page-item-" + (page + 1)).addClass("active");
            if (page == 2) {
                $("#prev_page").nextAll().slice(0, 1).insertBefore("#next_page");
            }
            $(".pagination li a:not(:contains(Ant.), .pagination li a:not(:contains(Sig.))").each(function () {
                var new_page = $(this).parent().data("page");
                if (new_page != undefined) {
                    if ($(this).text() != '1' && $(this).text() != '...') {
                        $(this).text(parseInt(new_page - 1)).parent().removeClass("page-item-" + new_page).addClass("page-item-" + (new_page - 1)).data("page", (new_page - 1));
                    }
                }
            });
        }
    });
    // PAGINACIÓN POR BOTON SIG.
    $(document).on("click", "#next_page", function () {
        if ($(".pagination li.active").next().find("a").text() != "Sig.") {
            $(".pagination li.active").next().trigger("click");
        }
    });
    // PAGINACIÓN POR BOTON ANT.
    $(document).on("click", "#prev_page", function () {
        if ($(".pagination li.active").prev().find("a").text() != "Ant.") {
            $(".pagination li.active").prev().trigger("click");
        }
    });
    // HACE QUE EL FILTRO DE BUSQUEDA NO SEA SENSIVITY CASE
    jQuery.expr[':'].contains = function (a, i, m) {
        return jQuery(a).text().toUpperCase()
            .indexOf(m[3].toUpperCase()) >= 0;
    };
     // FILTRO DE BUSQUEDA EN TABLAS
     $(document).on("keyup", ".search-box", function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        var tbody=$(this).data("tbody");
        var colspan=$(this).data("colspan");
        if ($(this).val().length > 0) {
            if (keycode == '13') {
                var texto = $(this).val().toUpperCase().trim();
                $("#"+tbody+" .title:not(:contains('" + texto + "'))").parent().hide();
                $("#"+tbody+" .title:hidden:contains('" + texto + "')").parent().show();

                if ($("#"+tbody+" .title:visible").length == 0) {
                    $("#"+tbody).prepend('<tr>' +
                        '<td colspan="'+colspan+'" class="empty">' +
                            '<p class="mb-0 text-truncate">No se encontraron resultados</p>' +
                        '</td>' +
                    '</tr>');
                }
                else {
                    $("#"+tbody+" .empty").remove();
                }
            }
        }
        else {
            $("#"+tbody+" .title").parent().show();
            $("#"+tbody+" .empty").remove();
        }
    });
    /* -------------------------------- DASHBOARD ------------------------------- */
    $(document).on("click","#filtro_ordenes_dashboard",function(){
        clearInterval(interval_ordenes_dashboard);

        var id_estado=$(this).data("estado");
        var text=$(this).text();

        get_view_main("ordenes", "ordenes_dashboard", { id_estado: id_estado, text:text }, "#content_ordenes");
        interval_ordenes_dashboard = setInterval(function(){
            get_view_main('ordenes', 'ordenes_dashboard', { id_estado: id_estado, text:text }, "#content_ordenes");
        }, 120000);
    });
    /* ---------------------------- RESUMEN DE VENTAS --------------------------- */
    // FILTRO
    $(document).on("change","#filtro_resumen",function(){
        get_view_main('resumenes', 'resumenes', { mes: $(this).val() }, "#main");
    });
    // EXPORTAR PDF
    $(document).on("click","#exportar_detalle_resumen_pdf",function(){
        var fecha=$("#filtro_resumen").val();
        visor_pdf('../php/c/2/resumenes/resumen_pdf.php?fecha='+fecha,'Resumen de ventas');
    });
    // EXPORTAR EXCEL
    $(document).on("click", "#exportar_detalle_resumen_excel", function () {
        var fecha=$("#filtro_resumen").val();
        $.get('../php/c/2/resumenes/resumen_excel.php',{fecha:fecha}, function () {
            visor_google(
                'documentos/reportes/resumen_ventas.xlsx?' + Math.floor(Math.random() * 1000),
                'Clientes',
            );
        });
    });
    /* ------------------------------ REPARTIDORES ------------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_repartidor",function(){
        validar_formulario("#content_info input:not([type='search'])");

        if($("#content_info .is-invalid").length==0){
            var nombre=$("#nombre_repartidor").val();
            var apellido=$("#apellido_repartidor").val();
            var telefono=$("#telefono_repartidor").val();
            var correo=$("#correo_repartidor").val();
            var id_ciudad=$("#id_ciudad").val();
            var direccion=$("#direccion_repartidor").val();
            var latitud=$("#lat_repartidor").val();
            var longitud=$("#lon_repartidor").val();
            var usuario=$("#nombre_usuario").val();
            var contrasena=$("#contrasena").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/repartidores/agregar.php",
                data:{ nombre:nombre, apellido:apellido, telefono:telefono, correo:correo, direccion:direccion, latitud:latitud, longitud:longitud, id_ciudad:id_ciudad, usuario:usuario, contrasena:contrasena },
                beforeSend:function () {
                    $("#btn_agregar_repartidor").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#content_info input").val("");
                    }
                },
                complete:function(response){
                    $("#btn_agregar_repartidor").attr("disabled",false).text("Agregar");
                }
            });
        }
    });
    // EDITAR CONTROLADOR
    $(document).on("click", "#btn_editar_info_conductor", function () {
        validar_formulario("#content_info_personal input");

        if ($("#content_info_personal .is-invalid").length == 0) {
            var nombre = $("#nombre_repartidor").val();
            var apellido = $("#apellido_repartidor").val();
            var correo = $("#correo_repartidor").val();
            var telefono = $("#telefono_repartidor").val();
            var direccion = $("#direccion_repartidor").val();
            var latitud = $("#lat_repartidor").val();
            var longitud = $("#lon_repartidor").val();
            var id = $(this).data("id");

            peticion_ajax_1('../php/c/2/repartidores/editar.php',{ nombre:nombre, apellido:apellido, correo:correo, telefono:telefono, direccion:direccion, latitud:latitud, longitud:longitud, id:id }, '#btn_editar_info_conductor');
        }
    });
    // RECHAZAR REPARTIDOR
    $(document).on("click","#rechazar_repartidor",function(){
        var id=$(this).data("id");
        $("#btn_rechazar_repartidor").data("id",id);

        $("#modal_rechazar").modal("show");
    });
    // RECHAZAR REPARTIDOR CONTROLADOR
    $(document).on("click","#btn_rechazar_repartidor",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/repartidores/rechazar_solicitud.php',{ id:id },'#btn_rechazar_repartidor','#row_solicitud_'+id,'#modal_rechazar','Rechazando...','Confirmar');
    });
    // ACEPTAR REPARTIDOR
    $(document).on("click","#aceptar_repartidor",function(){
        var id=$(this).data("id");
        $("#btn_aceptar_repartidor").data("id",id);

        $("#modal_aceptar").modal("show");
    });
    // ACEPTAR REPARTIDOR CONTROLADOR
    $(document).on("click","#btn_aceptar_repartidor",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/repartidores/aceptar_solicitud.php',{ id:id },'#btn_aceptar_repartidor','#row_solicitud_'+id,'#modal_aceptar','Aceptando...','Confirmar');
    });
    // ELIMINAR
    $(document).on("click","#eliminar_repartidor",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_repartidor").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_repartidor",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/repartidores/eliminar.php',{ id:id },'#btn_eliminar_repartidor','#row_repartidor_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    // CAMBIAR ESTADO DE REPARTIDOR
    $(document).on("click","#btn_cambiar_estado_repartidor",function(){
        var id_estado=$("#id_estado_repartidor").val();
        var id_repartidor=$(this).data("id");
        if(id_estado>0){
            $.ajax({
                type:"POST",
                url:"../php/c/2/repartidores/cambiar_estado.php",
                data:{ id_repartidor:id_repartidor, id_estado:id_estado },
                beforeSend: function () {
                    $("#btn_cambiar_estado_repartidor").attr("disabled",true).text("Actualizando...");
                },
                success: function (response) {
                    show_message(response.title,response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#badge_status").text(obtener_atributo_select("#id_estado_repartidor","text",1));
                        $("#id_estado_repartidor").val(0);
                    }
                },
                complete: function (){
                    $("#btn_cambiar_estado_repartidor").attr("disabled",false).text("Actualizar estado");
                    $("#modal_estado_repartidor").modal("hide");
                }
            });
        }
    });
    /* -------------------------------- CLIENTES -------------------------------- */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_cliente",function(){
        validar_formulario("#content_info input:not([type='search'])");

        if($("#content_info .is-invalid").length==0){
            var nombre=$("#nombre_cliente").val();
            var apellido=$("#apellido_cliente").val();
            var telefono=$("#telefono_cliente").val();
            var correo=$("#correo_cliente").val();
            var id_ciudad=$("#id_ciudad").val();
            var usuario=$("#nombre_usuario").val();
            var contrasena=$("#contrasena").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/clientes/agregar.php",
                data:{ nombre:nombre, apellido:apellido, telefono:telefono, correo:correo, id_ciudad:id_ciudad, usuario:usuario, contrasena:contrasena },
                beforeSend:function () {
                    $("#btn_agregar_cliente").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#content_info input").val("");
                    }
                },
                complete:function(response){
                    $("#btn_agregar_cliente").attr("disabled",false).text("Agregar");
                }
            });
        }
    });
    // AGREGAR PRODUCTO CONTROLADOR
    $(document).on("click","#btn_agregar_producto_cliente",function(){
        validar_formulario("#content_agregar_producto input");

        if($("#content_agregar_producto .is-invalid").length==0){
            var nombre=$("#nombre_producto_cliente").val();
            var id=$(this).data("id");

            $.ajax({
                type: "POST",
                url:"../php/c/2/clientes/agregar_producto.php",
                data:{ nombre:nombre,id:id },
                beforeSend: function () {
                    $("#btn_agregar_producto_cliente").attr("disabled",true).text("Agregando...");
                },
                success: function (response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#tbody_productos_cliente").append('<tr id="row_producto_cliente_'+response.id+'">'+
                            '<td>'+nombre+'</td>'+
                            '<td class="text-right">'+
                                '<a href="javascript:void(0);" data-id="'+response.id+'" class="btn btn-sm btn-outline-dark" style="width:90px;" id="eliminar_producto_cliente" type="button">Eliminar</a>'+
                            '</td>'+
                        '</tr>');
                        $("#modal_agregar_producto_cliente input").val("");
                    }
                },
                complete: function () {
                    $("#modal_agregar_producto_cliente").modal("hide");
                    $("#btn_agregar_producto_cliente").attr("disabled",false).text("Agregar");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_producto_cliente",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_producto_cliente").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_producto_cliente",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/clientes/eliminar_producto.php',{ id:id },'#btn_eliminar_producto_cliente','#row_producto_cliente_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    // CHANGE TIPO BLOQUEO
    $(document).on("click","#tipo_sucursal",function(){
        if($(this).is(":checked")){
            $("#group_sucursal").addClass("d-none");
            $("#group_express").removeClass("d-none");
        }
        else{
            $("#group_express").addClass("d-none");
            $("#group_sucursal").removeClass("d-none");
        }
    })
    // BLOQUEAR CLIENTES CONTROLADOR
    $(document).on("click","#btn_bloquear_cliente",function(){
        var id_cliente=$("#id_cliente").val();
        var id_sucursal=$("#id_sucursal").val();
        var id_sucursal_express=$("#id_sucursal_express").val();
        var tipo_sucursal = $("#tipo_sucursal").is(":checked") ? 1 : 0;

        if(id_cliente.length>0 && (id_sucursal.length>0 || id_sucursal_express.length>0)){
            $.ajax({
                type: "POST",
                url:"../php/c/2/clientes/bloquear.php",
                data:{ id_cliente:JSON.stringify(id_cliente), id_sucursal:JSON.stringify(id_sucursal), id_sucursal_express:JSON.stringify(id_sucursal_express), tipo_sucursal:tipo_sucursal },
                beforeSend:function () {
                    $("#btn_bloquear_cliente").attr("disabled",true).text("Bloqueando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        select_id_cliente.set(['']);
                        select_id_sucursal.set(['']);
                        select_id_sucursal_express.set(['']);
                    }
                },
                complete:function(){
                    $("#btn_bloquear_cliente").attr("disabled",false).text("Bloquear");
                }
            })
        }
        else{
            show_message('Error.', 'Seleccione al menos un cliente y una sucursal', 'error', 3000);
        }
    });
    // EXPORTAR DETALLE DE ORDEN PDF
    $(document).on("click","#exportar_clientes_pdf", function(){
        visor_pdf('../php/c/2/clientes/clientes_pdf.php','Clientes');
    });
    // EXPORTAR DETALLE DE ORDEN EXCEL
    $(document).on("click", "#exportar_clientes_excel", function () {
        $.get('../php/c/2/clientes/clientes_excel.php', function () {
            visor_google(
                'documentos/reportes/clientes.xlsx?' + Math.floor(Math.random() * 1000),
                'Clientes',
            );
        });
    });
    /* -------------------------- HISTORIAL DE ORDENES -------------------------- */
    // CHANGE TIPO DE FECHA
    $(document).on("change","#tipo_fecha",function(){
        if($(this).val()==1){
            $("#group_fecha_filtro").addClass("d-none");
            $("#group_mes_filtro").removeClass("d-none");
        }
        else{
            $("#group_mes_filtro").addClass("d-none");
            $("#group_fecha_filtro").removeClass("d-none");
        }
    });
    // APLICAR FILTRO
    $(document).on("click","#btn_aplicar_filtro_historial_ordenes",function(){
        var tipo_historial=$("#tipo_historial").val();
        var tipo_fecha=$("#tipo_fecha").val();
        if(tipo_fecha==1){
            var fecha=$("#mes_filtro").val();
        }
        else{
            var fecha=$("#fecha_filtro").val();
            fecha=fecha.split("-");
            fecha=fecha[2]+'-'+fecha[1]+fecha[0];
        }
        
        switch (tipo_historial) {
            case '1':
                get_view_main('ordenes', 'historial_ordenes', { fecha:fecha, tipo_fecha:tipo_fecha }, "#content_historial");
                break;

            case '2':
                get_view_main('ordenes', 'historial_ordenes_express', { fecha:fecha, tipo_fecha:tipo_fecha }, "#content_historial");
                break;

            case '3':
                get_view_main('ordenes', 'historial_ordenes_punto_a_punto', { fecha:fecha, tipo_fecha:tipo_fecha }, "#content_historial");
                break;
        
            default:
                break;
        }
    });
    /* --------------------------------- ORDENES -------------------------------- */
    // VER ORDENES_INGREDIENTES
    $(document).on("click","#ver_ordenes_ingredientes",function(){
        var id=$(this).data("id");
        var id_orden=$(this).data("orden");
        get_view_main('ordenes', 'ordenes_ingredientes', { id_orden_producto:id, id_orden:id_orden } , '#tabla_ordenes_productos');
    });
    // VOLVER A ORDENES PRODUCTOS
    $(document).on("click","#volver_ordenes_productos",function(){
        var id=$(this).data("orden");
        get_view_main('ordenes', 'ordenes_productos', { id_orden:id } , '#tabla_ordenes_productos');
    });
    // EXPORTAR DETALLE DE ORDEN PDF
    $(document).on("click","#exportar_detalle_orden_pdf",function(){
        var id_orden=$(this).data("id");
        visor_pdf('../php/c/2/ordenes/detalles_orden_pdf.php?id_orden='+id_orden,'Orden #'+id_orden);
    });
    // EXPORTAR DETALLE DE ORDEN TICKET
    $(document).on("click","#exportar_detalle_orden_ticket",function(){
        var id_orden=$(this).data("id");
        visor_pdf('../php/c/2/ordenes/detalles_orden_ticket.php?id_orden='+id_orden,'Orden #'+id_orden);
    });
    // EXPORTAR DETALLE DE ORDEN EXCEL
    $(document).on("click", "#exportar_detalle_orden_excel", function () {
        var id_orden=$(this).data("id");
        $.get('../php/c/2/ordenes/detalles_orden_excel.php',{id_orden:id_orden}, function () {
            visor_google(
                'documentos/reportes/detalles_orden.xlsx?' + Math.floor(Math.random() * 1000),
                'Orden #'+id_orden,
            );
        });
    });
    // ASIGNAR ORDEN A REPARTIDOR
    $(document).on("click","#asignar_orden_repartidor",function(){
        var id_repartidor=$(this).data("repartidor");
        var id_orden=$(this).data("id");

        $("#btn_asignar_orden_repartidor").data("id",id_orden);
        $("#btn_asignar_orden_repartidor").data("id_repartidor",id_repartidor);

        $("#modal_asignar_orden").modal("show");
    });
    // ASIGNAR ORDEN A REPARTIDOR CONTROLADOR
    $(document).on("click","#btn_asignar_orden_repartidor",function(){
        var id_repartidor=$(this).data("id_repartidor");
        var id_orden=$(this).data("id");

        delete_row('../php/c/2/ordenes/asignar_orden_repartidor.php',{ id_repartidor:id_repartidor, id_orden:id_orden },'#btn_asignar_orden_repartidor','#row_orden_'+id_orden,'#modal_asignar_orden','Asignando...','Confirmar');
    });
    // SELECCIONAR REPARTIDOR EN DETALLES DE ORDEN
    $(document).on("click","#detalle_repartidor_disponible",function(){
        $("#content_repartidores .card").data("select",0).removeClass("border-success").find(".card-footer small").html('<span class="dot dot-lg bg-secondary mr-1"></span> Seleccionar');
        $(this).addClass("border-success").data("select",1).find(".card-footer small").html('<span class="dot dot-lg bg-success mr-1"></span> Seleccionado');
    });
    // ASIGNAR REPARTIDOR A ORDEN DESDE DETALLES DE ORDEN CONTROLADOR
    $(document).on("click","#btn_asignar_repartidor_detalle_orden",function(){
        var id_repartidor=0;
        var nombre;
        var apellido;
        $("#content_repartidores [data-select]").each(function(){
            if($(this).data("select")==1){
                id_repartidor=$(this).data("id");
                nombre=$(this).find("#card_nombre_repartidor").text();
                apellido=$(this).find("#card_apellido_repartidor").text();
                return false;
            }
        });
        var id_orden=$(this).data("id");
        if(id_repartidor>0){
            $.ajax({
                type:"POST",
                url:"../php/c/2/ordenes/asignar_orden_repartidor.php",
                data:{ id_orden:id_orden, id_repartidor:id_repartidor },
                beforeSend:function () {
                    $("#btn_asignar_repartidor_detalle_orden").attr("disabled",true).text("Asignando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("a[data-target='#modal_repartidores']").remove();
                        $("#nombre_repartidor_detalle").text(nombre+' '+apellido);
                    }
                },
                complete:function () {
                    $("#btn_asignar_repartidor_detalle_orden").attr("disabled",true).text("Asignar repartidor");
                    $("#modal_repartidores").modal("hide");
                }

            });
        }
    });
    /* -------------------------- ORDENES PUNTO A PUNTO ------------------------- */
    // CHANGE CHECKBOX
    $(document).on("click","#recibir_paquete",function(){
        if($(this).is(":checked")){
            $("#telefono").val(obtener_atributo_select("#id_cliente_orden_punto_a_punto", 'phone', 1)).prev().text("Teléfono cliente").parent().parent().siblings("#productos_orden_punto_a_punto").find("label").text("Productos a recibir");
            $("#nombre_recibe").val(obtener_atributo_select("#id_cliente_orden_punto_a_punto", 'name', 1));
            select_id_producto_orden_punto_a_punto.setData([]);
            $("#content_productos").html("");
        }
        else{
            $("#telefono").val("").prev().text("Teléfono destinatario").parent().parent().siblings("#productos_orden_punto_a_punto").find("label").text("Productos a enviar");
            $("#nombre_recibe").val("");

            var nombre_productos=obtener_atributo_select("#id_cliente_orden_punto_a_punto", 'data-namep', 0).split(",");
            var array_productos=[];
    
            for (var i = 0; i < (nombre_productos.length-1); i++) {
                array_productos[i]={ text: nombre_productos[i], value:nombre_productos[i] };
            }
    
            array_productos.length>0 ? select_id_producto_orden_punto_a_punto.setData(array_productos.sort()) : select_id_producto_orden_punto_a_punto.setData([]);
        }
    });
    // CHANGE SELECT CLIENTE
    $(document).on("change","#id_cliente_orden_punto_a_punto",function(){
        if($("#recibir_paquete").is(":checked")){
            $("#telefono").val(obtener_atributo_select("#id_cliente_orden_punto_a_punto", 'phone', 1)).prev().text("Teléfono cliente");
            select_id_producto_orden_punto_a_punto.setData([]);
            $("#nombre_recibe").val(obtener_atributo_select("#id_cliente_orden_punto_a_punto", 'name', 1));
            $("#content_productos").html("");
        }
        else{
            $("#telefono").val("").prev().text("Teléfono destinatario");
            $("#nombre_recibe").val("");
            var nombre_productos=obtener_atributo_select("#id_cliente_orden_punto_a_punto", 'data-namep', 0).split(",");
            var array_productos=[];    
            for (var i = 0; i < (nombre_productos.length-1); i++) {
                array_productos[i]={ text: nombre_productos[i], value:nombre_productos[i] };
            }
            array_productos.length>0 ? select_id_producto_orden_punto_a_punto.setData(array_productos.sort()) : select_id_producto_orden_punto_a_punto.setData([]);
        }
    });
    // CHANGE SELECT PRODUCTO
    $(document).on("change","#id_producto_orden_punto_a_punto",function(){
        var producto=$(this).val();
        var simbolo=$(this).data("simbolo");
        if(producto.length>0){
            var div='';
            for (var i = 0; i < producto.length; i++) {
                div+=
                '<div class="col-sm-12 col-md-3">'+
                    '<div class="form-group">'+
                        '<label class="form-label">'+producto[i]+'</label>'+
                        '<div class="input-group mb-3">'+
                            '<div class="input-group-prepend">'+
                                '<span class="input-group-text">'+simbolo+'</span>'+
                            '</div>'+
                            '<input type="text" data-producto="'+producto[i]+'" class="form-control price_format list-producto" placeholder="0.00">'+
                        '</div>'+
                    '</div>'+
                '</div>';
                
            }
            $("#content_productos").html(div);
        }
        else{
            $("#content_productos").html("");
        }
    });
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_orden_punto_a_punto",function(){
        validar_formulario("#content_info input:not([type='search'],[type='checkbox'], #content_info textarea)");

        if($("#content_info .is-invalid").length==0){
            var id_cliente=$("#id_cliente_orden_punto_a_punto").val();
            var recibir_paquete= $("#recibir_paquete").is(":checked") ? 1 : 2;
            var id_repartidor=$("#id_repartidor").val();
            var telefono=$("#telefono").val();
            var nombre_recibe=$("#nombre_recibe").val();
            var descripcion=$("#descripcion").val();
            var direccion_remitente=$("#direccion_remitente").val();
            var latitud_remitente=$("#lat_remitente").val();
            var longitud_remitente=$("#lon_remitente").val();
            var direccion_destinatario=$("#direccion_destinatario").val();
            var latitud_destinatario=$("#lat_destinatario").val();
            var longitud_destinatario=$("#lon_destinatario").val();
            var productos=[];

            $(".list-producto").each(function(index){
                productos[index]={ nombre_producto:$(this).data("producto"), precio:$(this).val() };
            });

            $.ajax({
                type: "POST",
                url:"../php/c/2/ordenes_punto_a_punto/agregar.php",
                data:{ id_cliente:id_cliente, recibir_paquete:recibir_paquete, id_repartidor:id_repartidor, telefono:telefono, nombre_recibe:nombre_recibe, descripcion:descripcion, direccion_remitente:direccion_remitente, latitud_remitente:latitud_remitente, longitud_remitente:longitud_remitente, direccion_destinatario:direccion_destinatario, latitud_destinatario:latitud_destinatario, longitud_destinatario:longitud_destinatario, productos: JSON.stringify(productos) },
                beforeSend:function () {
                    $("#btn_agregar_orden_punto_a_punto").attr("disabled",true).text("Agregando...");
                },
                success:function (response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#content_info input:not([type='hidden'])").val("");
                        $("#content_info input[type='hidden']").val(0);
                        $("#content_productos").html("");
                        select_id_producto_orden_punto_a_punto.set(['']);
                        $("#recibir_paquete").prop("checked",false);
                        $('option:selected', '#id_cliente_orden_punto_a_punto').attr('data-namep',response.namep);
                    }
                },
                complete:function(){
                    $("#btn_agregar_orden_punto_a_punto").attr("disabled",false).text("Agregar");
                }
            });
        }
    });
    // EXPORTAR DETALLE DE ORDEN PDF
    $(document).on("click","#exportar_detalle_orden_punto_a_punto_pdf",function(){
        var id_orden=$(this).data("id");
        visor_pdf('../php/c/2/ordenes_punto_a_punto/detalles_orden_pdf.php?id_orden='+id_orden,'Orden #'+id_orden);
    });
    // EXPORTAR DETALLE DE ORDEN EXCEL
    $(document).on("click", "#exportar_detalle_orden_punto_a_punto_excel", function () {
        var id_orden=$(this).data("id");
        $.get('../php/c/2/ordenes_punto_a_punto/detalles_orden_excel.php',{id_orden:id_orden}, function () {
            visor_google(
                'documentos/reportes/detalles_orden_punto_a_punto.xlsx?' + Math.floor(Math.random() * 1000),
                'Orden #'+id_orden,
            );
        });
    });
    /* ----------------------------- ORDENES EXPRESS ---------------------------- */
    // CHANGE SUCURSAL
    $(document).on("change","#id_sucursal_orden_express",function(){
        $("#costo_orden_express").text('Costo de envío: '+$(this).data("simbolo")+obtener_atributo_select(this, 'costo', 1))
    });
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_orden_express",function(){
        validar_formulario("#content_info input:not([type='search'], #content_info textarea)");

        if($("#content_info .is-invalid").length==0){
            var id_cliente=$("#id_cliente").val();
            var id_sucursal_express= $("#id_sucursal_orden_express").val();
            var id_repartidor= $("#id_repartidor").val();
            var nombre_recibe_orden=$("#nombre_recibe_orden").val();
            var detalles_orden=$("#detalles_orden").val();
            var direccion_orden_express=$("#direccion_orden_express").val();
            var latitud_orden_express=$("#lat_orden_express").val();
            var longitud_orden_express=$("#lon_orden_express").val();
            var costo=obtener_atributo_select("#id_sucursal_orden_express", 'costo', 1);

            $.ajax({
                type: "POST",
                url:"../php/c/2/ordenes_express/agregar.php",
                data:{ id_cliente:id_cliente,id_sucursal_express:id_sucursal_express, id_repartidor:id_repartidor, nombre_recibe_orden:nombre_recibe_orden, detalles_orden:detalles_orden, direccion_orden_express:direccion_orden_express, latitud_orden_express:latitud_orden_express, longitud_orden_express:longitud_orden_express, costo:costo },
                beforeSend:function () {
                    $("#btn_agregar_orden_express").attr("disabled",true).text("Agregando...");
                },
                success:function (response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#content_info input:not([type='hidden'])").val("");
                        $("#content_info input[type='hidden']").val(0);
                    }
                },
                complete:function(){
                    $("#btn_agregar_orden_express").attr("disabled",false).text("Agregar");
                }
            });
        }
    });
    // EXPORTAR DETALLE DE ORDEN PDF
    $(document).on("click","#exportar_detalle_orden_express_pdf",function(){
        var id_orden=$(this).data("id");
        visor_pdf('../php/c/2/ordenes_express/detalles_orden_pdf.php?id_orden='+id_orden,'Orden #'+id_orden);
    });
    // EXPORTAR DETALLE DE ORDEN EXCEL
    $(document).on("click", "#exportar_detalle_orden_express_excel", function () {
        var id_orden=$(this).data("id");
        $.get('../php/c/2/ordenes_express/detalles_orden_excel.php',{id_orden:id_orden}, function () {
            visor_google(
                'documentos/reportes/detalles_orden_express.xlsx?' + Math.floor(Math.random() * 1000),
                'Orden #'+id_orden,
            );
        });
    });
    /* ------------------------------- SUCURSALES ------------------------------- */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_sucursal",function(){
        validar_formulario("#content_info input:not([type='search'])");

        if($("#content_info .is-invalid").length==0){
            var nombre=$("#nombre_sucursal").val();
            var descripcion=$("#descripcion_sucursal").val();
            var telefono=$("#telefono_sucursal").val();
            var telefono_whatsapp=$("#telefono_whatsapp_sucursal").val();
            var direccion=$("#direccion_sucursal").val();
            var latitud=$("#lat_sucursal").val();
            var longitud=$("#lon_sucursal").val();
            var id_categoria=$("#id_categoria_sucursal").val();
            var id_ciudad=$("#id_ciudad").val();
            var id_empresa=$("#id_empresa").val();
            var usuario=$("#nombre_usuario").val();
            var contrasena=$("#contrasena").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/sucursales/agregar.php",
                data:{ nombre:nombre, descripcion:descripcion, telefono:telefono, telefono_whatsapp:telefono_whatsapp, direccion:direccion, latitud:latitud, longitud:longitud, id_categoria:id_categoria, id_empresa:id_empresa,  id_ciudad:id_ciudad, usuario:usuario, contrasena:contrasena },
                beforeSend:function () {
                    $("#btn_agregar_sucursal").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        uploadfiles('sucursales', response.id, "cropper_dropzone_copy");
                        $("#content_info input, #content_info textarea").val("");
                        myDropZone.disable();
                        myDropZone.removeAllFiles();
                        myDropZone.enable();
                    }
                },
                complete:function(response){
                    $("#btn_agregar_sucursal").attr("disabled",false).text("Agregar");
                }
            });
        }
    });
    // EDITAR INFO CONTROLADOR
    $(document).on("click","#btn_editar_info_sucursal",function(){
        validar_formulario("#content_info input, #content_info textarea");
        
        if($("#content_info .is-invalid").length==0){
            var nombre=$("#nombre_sucursal").val();
            var descripcion=$("#descripcion_sucursal").val();
            var telefono_sucursal=$("#telefono_sucursal").val();
            var telefono_whatsapp_sucursal=$("#telefono_whatsapp_sucursal").val();
            var direccion_sucursal=$("#direccion_sucursal").val();
            var lat_sucursal=$("#lat_sucursal").val();
            var lon_sucursal=$("#lon_sucursal").val();
            var id_sucursal=$(this).data("id");

            peticion_ajax_1('../php/c/2/sucursales/editar.php', { nombre:nombre, descripcion:descripcion, telefono_sucursal:telefono_sucursal, telefono_whatsapp_sucursal:telefono_whatsapp_sucursal, direccion_sucursal:direccion_sucursal, latitud_sucursal:lat_sucursal, longitud_sucursal:lon_sucursal, id_sucursal:id_sucursal }, '#btn_editar_info_sucursal');
        }
    });
    // AGREGAR HORARIO CONTROLADOR
    $(document).on("click","#btn_agregar_horario_sucursal",function(){
        validar_formulario("#content_agregar_horario input");

        if($("#content_agregar_horario .is-invalid").length==0){

            var dia=$("#agregar_dia").val();
            var abierto=$("#agregar_hora_abierto").val();
            var cerrado=$("#agregar_hora_cerrado").val();
            var id_sucursal=$(this).data("id");

            var array_horario={0:'Domingo', 1:'Lunes', 2:'Martes', 3:'Miércoles', 4:'Jueves', 5:'Viernes', 6:'Sábado' };

            $.ajax({
                type:"POST",
                url:"../php/c/2/sucursales/agregar_horario.php",
                data:{ dia:dia, abierto:abierto, cerrado:cerrado, id_sucursal:id_sucursal },
                beforeSend:function () {
                    $("#btn_agregar_horario_sucursal").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#horarios_empty").length>0){
                            $("#horarios_empty").remove();
                        }
                        $("#tbody_horarios_sucursal").append('<tr id="row_horario_'+response.id+'">'+
                            '<td>'+array_horario[dia]+'</td>'+
                            '<td>'+abierto+'hrs.</td>'+
                            '<td>'+cerrado+'hrs.</td>'+
                            '<td>'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="editar_horario_sucursal">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_horario_sucursal">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_horario_sucursal").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                }
            })
        }
    });
    // EDITAR HORARIO
    $(document).on("click","#editar_horario_sucursal",function(){
        var id=$(this).data("id");
        var dia=$("#row_horario_"+id).children("td:nth-child(1)").text();
        var array_dias={ Domingo:0, Lunes:1, Martes:2, Miércoles:3, Jueves: 4, Viernes:5, Sábado:6 };
        dia=array_dias[dia];
        var abierto=$("#row_horario_"+id).children("td:nth-child(2)").text().replace("hrs.",'');
        var cerrado=$("#row_horario_"+id).children("td:nth-child(3)").text().replace("hrs.",'');

        $("#editar_dia").val(dia);
        $("#editar_hora_abierto").val(abierto);
        $("#editar_hora_cerrado").val(cerrado);
        $("#btn_editar_horario_sucursal").data("id",id);

        $("#modal_editar").modal("show");

    });
    // EDITAR HORARIO CONTROLADOR
    $(document).on("click","#btn_editar_horario_sucursal",function(){
        validar_formulario("#content_editar_horario input");

        if($("#content_editar_horario .is-invalid").length==0){
            var dia=$("#editar_dia").val();
            var abierto=$("#editar_hora_abierto").val();
            var cerrado=$("#editar_hora_cerrado").val();
            var id_horario=$(this).data("id");
            var array_horario={0:'Domingo', 1:'Lunes', 2:'Martes', 3:'Miércoles', 4:'Jueves', 5:'Viernes', 6:'Sábado' };

            $.ajax({
                type:"POST",
                url:"../php/c/2/sucursales/editar_horario.php",
                data:{ dia:dia, abierto:abierto, cerrado:cerrado, id_horario:id_horario },
                beforeSend:function () {
                    $("#btn_editar_horario_sucursal").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_horario_"+id_horario).children("td:nth-child(1)").text(array_horario[dia]);
                        $("#row_horario_"+id_horario).children("td:nth-child(2)").text(abierto+"hrs.");
                        $("#row_horario_"+id_horario).children("td:nth-child(3)").text(cerrado+"hrs.");
                    }
                },
                complete:function(){
                    $("#btn_editar_horario_sucursal").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR HORARIO
    $(document).on("click","#eliminar_horario_sucursal",function(){
        var id_horario=$(this).data("id");
        $("#btn_eliminar_horario_sucursal").data("id",id_horario);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR HORARIO CONTROLADOR
    $(document).on("click","#btn_eliminar_horario_sucursal",function(){
        var id_horario=$(this).data("id");
        delete_row('../php/c/2/sucursales/eliminar_horario.php',{ id_horario:id_horario },'#btn_eliminar_horario_sucursal','#row_horario_'+id_horario,'#modal_eliminar','Eliminando...','Confirmar');
    });
    // ACTIVAR O DESACTIVAR LOS METODOS DE PAGO DE LA SUCURSAL
    $(document).on("click","#activar_desactivar_metodo_pago_sucursal",function(){
        var id=$(this).data("id");
        var estado=$(this).data("value");
        var texto=$(this).data("text");

        $("#modal_estado_metodo_pago .modal-body span").text(texto);
        $("#btn_activar_desactivar_metodo_pago_sucursal").data("id",id);
        $("#btn_activar_desactivar_metodo_pago_sucursal").data("estado",estado);
        $("#btn_activar_desactivar_metodo_pago_sucursal").data("text",texto);

        $("#modal_estado_metodo_pago").modal("show");
    });
    // ACTIVAR O DESACTIVAR LOS METODOS DE PAGO DE LA SUCURSAL CONTROLADOR
    $(document).on("click","#btn_activar_desactivar_metodo_pago_sucursal",function(){
        var id=$(this).data("id");
        var estado=$(this).data("estado");
        var texto=$(this).data("text");

        $.ajax({
            type:"POST",
            url:"../php/c/2/sucursales/cambiar_estado_metodo_pago.php",
            data:{ id:id, estado:estado },
            beforeSend:function(){
                $("#btn_activar_desactivar_metodo_pago_sucursal").attr("disabled",true).text("Cambiando...");
            },
            success:function(response){
                show_message(response.title,response.message,response.status,response.time);
                if(response.status=="success"){
                    $("#nombre_estado_metodo_pago_sucursal_"+id).text(texto);
                    console.log("#nombre_estado_metodo_pago_sucursal_"+id+'-'+texto);
                }
            },
            complete:function(){
                $("#btn_activar_desactivar_metodo_pago_sucursal").attr("disabled",false).text("Confirmar");
                $("#modal_estado_metodo_pago").modal("hide");
            }
        });
    });
    // GUARDAR CONFIGURACIONES CONTROLADOR
    $(document).on("click","#btn_guardar_configuracion_sucursal",function(){
        var schedule = $("#schedule_sucursal").is(":checked") ? 1 : 0;
        var proceso_auto = $("#proceso_auto_sucursal").is(":checked") ? 1 : 0;
        var metodo_pago_obligatorio = $("#metodo_pago_obligatorio_sucursal").is(":checked") ? 1 : 0;
        var id_zona_horaria=$("#id_zona_horaria").val();
        var id_categoria_sucursal=$("#id_categoria_sucursal").val();
        var id_ciudad=$("#id_ciudad").val();
        var id_estado_usuario=$("#id_estado_usuario").val();
        var id_sucursal=$(this).data("id");

        peticion_ajax_1('../php/c/2/sucursales/editar_configuracion.php', { schedule:schedule, proceso_auto:proceso_auto, metodo_pago_obligatorio:metodo_pago_obligatorio, id_zona_horaria:id_zona_horaria, id_categoria_sucursal:id_categoria_sucursal, id_ciudad:id_ciudad, id_estado_usuario:id_estado_usuario, id_sucursal:id_sucursal }, '#btn_guardar_configuracion_sucursal');
    });
    // CAMBIAR IMAGEN
    $(document).on("click","#cambiar_imagen_sucursal",function(){
        if($(this).data("id")==1){
            $("#group_horarios").hide();
            $("#group_img").show();
        }
        else{
            $("#group_img").hide();
            $("#group_horarios").show();
        }
    });
    // CAMBIAR IMAGEN CONTROLADOR
    $(document).on("click","#btn_cambiar_imagen_sucursal",function(){
        if(uploadfiles('sucursales', $(this).data("id"), "cropper_dropzone_copy")=="success"){
            myDropZone.disable();
            myDropZone.removeAllFiles();
            myDropZone.enable();
            
            $("#group_img").hide();
            $("#group_horarios").show();
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_sucursal",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_sucursal").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_sucursal",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/sucursales/eliminar.php',{ id:id },'#btn_eliminar_sucursal','#row_sucursal_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    // BLOQUEAR CLIENTE CONTROLADOR
    $(document).on("click","#btn_bloquear_cliente_sucursal",function(){
        var id_clientes=$("#id_cliente").val();
        if(id_clientes.length>0){
            $.ajax({
                type: "POST",
                url:"../php/c/2/sucursales/bloquear_clientes.php",
                data:{ id_clientes:JSON.stringify(id_clientes) },
                beforeSend:function () {
                    $("#btn_bloquear_cliente_sucursal").attr("disabled",true).text("Bloqueando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        window.location.hash='#ban_sucursal_'+response.id;
                    }
                },
                complete:function(){
                    $("#btn_bloquear_cliente_sucursal").attr("disabled",false).text("Bloquear");
                }
            })
        }
        else{
            show_message('Error.', 'Seleccione al menos un cliente', 'error', 1500);
        }
    });
    // ELIMINAR CLIENTE BLOQUEADO
    $(document).on("click","#eliminar_cliente_bloqueado",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_cliente_bloqueado").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CLIENTE BLOQUEADO CONTROLADOR
    $(document).on("click","#btn_eliminar_cliente_bloqueado",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/sucursales/eliminar_cliente_bloqueado.php',{ id:id },'#btn_eliminar_cliente_bloqueado','#row_cliente_'+id,'#modal_eliminar','Quitando bloqueo...','Confirmar');
    });
    /* ------------------------- CATEGORIAS DE SUCURSALES ------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_categoria_sucursal",function(){
        validar_formulario("#content_agregar_categoria input");

        if($("#content_agregar_categoria .is-invalid").length==0){
            var nombre=$("#agregar_nombre_categoria").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/categorias_sucursales/agregar.php",
                data:{ nombre:nombre },
                beforeSend:function () {
                    $("#btn_agregar_categoria_sucursal").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#categorias_empty").length>0){
                            $("#categorias_empty").remove();
                        }
                        $("#tbody_categorias_sucursal").append('<tr id="row_categoria_'+response.id+'">'+
                            '<td>'+nombre+'</td>'+
                            '<td class="d-flex justify-content-end">'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="editar_categoria_sucursal">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_categoria_sucursal">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_categoria_sucursal").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                    $("#modal_agregar input").val("");
                }
            })
        }
    });
    // EDITAR
    $(document).on("click","#editar_categoria_sucursal",function(){
        var id=$(this).data("id");
        var nombre=$("#row_categoria_"+id).children("td:nth-child(1)").text();
        
        $("#editar_nombre_categoria").val(nombre);
        $("#btn_editar_categoria_sucursal").data("id",id);

        $("#modal_editar").modal("show");
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_editar_categoria_sucursal",function(){
        validar_formulario("#content_editar_categoria input");

        if($("#content_editar_categoria .is-invalid").length==0){
            var nombre=$("#editar_nombre_categoria").val();
            var id_categoria=$(this).data("id");

            $.ajax({
                type:"POST",
                url:"../php/c/2/categorias_sucursales/editar.php",
                data:{ nombre:nombre, id_categoria:id_categoria },
                beforeSend:function () {
                    $("#btn_editar_categoria_sucursal").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_categoria_"+id_categoria).children("td:nth-child(1)").text(nombre);
                    }
                },
                complete:function(){
                    $("#btn_editar_categoria_sucursal").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_categoria_sucursal",function(){
        var id_categoria=$(this).data("id");
        $("#btn_eliminar_categoria_sucursal").data("id",id_categoria);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_categoria_sucursal",function(){
        var id_categoria=$(this).data("id");
        delete_row('../php/c/2/categorias_sucursales/eliminar.php',{ id_categoria:id_categoria },'#btn_eliminar_categoria_sucursal','#row_categoria_'+id_categoria,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ------------------------- ZONAS ------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_zona",function(){
        validar_formulario("#content_info input");

        if($("#content_info .is-invalid").length==0){
            var nombre=$("#nombre_zona").val();
            var radio=$("#radio_zona").val();
            var direccion=$("#direccion_zona").val();
            var lat=$("#lat_zona").val();
            var lon=$("#lon_zona").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/zonas/agregar.php",
                data:{ nombre:nombre, radio:radio, direccion:direccion, lat:lat, lon:lon },
                beforeSend:function () {
                    $("#btn_agregar_zona").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#content_info input").val("");
                    }
                },
                complete:function(){
                    $("#btn_agregar_zona").attr("disabled",false).text("Agregar");
                }
            })
        }
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_guardar_zona",function(){
        validar_formulario("#content_editar_categoria input");

        if($("#content_editar_categoria .is-invalid").length==0){
            var nombre=$("#nombre_zona").val();
            var radio=$("#radio_zona").val();
            var direccion=$("#direccion_zona").val();
            var lat=$("#lat_zona").val();
            var lon=$("#lon_zona").val();
            var id=$(this).data("id");

            peticion_ajax_1('../php/c/2/zonas/editar.php', { nombre:nombre, radio:radio, direccion:direccion, id:id, lat:lat, lon:lon }, '#btn_guardar_zona');
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_zona",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_zona").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_zona",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/zonas/eliminar.php',{ id:id },'#btn_eliminar_zona','#row_zona_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ------------------------- SUCURSALES EXPRESS ------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_sucursal_express",function(){
        validar_formulario("#content_agregar_sucursal input:not([type='search'])");

        if($("#content_agregar_sucursal .is-invalid").length==0){
            var nombre=$("#agregar_nombre_sucursal").val();
            var costo_km=$("#agregar_costo_km_sucursal").val();
            var id_ciudad=$("#agregar_id_ciudad").val();
            var id_categoria_sucursal=$("#agregar_id_categoria_sucursal").val();
            var nombre_categoria=obtener_atributo_select("#agregar_id_categoria_sucursal", 'name', 1);

            $.ajax({
                type:"POST",
                url:"../php/c/2/sucursales_express/agregar.php",
                data:{ nombre:nombre, costo_km:costo_km, id_ciudad:id_ciudad, id_categoria_sucursal:id_categoria_sucursal },
                beforeSend:function () {
                    $("#btn_agregar_sucursal_express").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#sucursal_express_empty").length>0){
                            $("#sucursal_express_empty").remove();
                        }
                        $("#tbody_sucursal_express").append('<tr id="row_sucursal_'+response.id+'">'+
                            '<td>'+nombre+'</td>'+
                            '<td>'+nombre_categoria+'</td>'+
                            '<td>'+response.simbolo+parseFloat(costo_km).toFixed(2)+'</td>'+
                            '<td class="d-flex justify-content-end">'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-simbolo="'+response.simbolo+'" data-ciudad="'+id_ciudad+'" data-categoria="'+id_categoria_sucursal+'" data-id="'+response.id+'" id="editar_sucursal_express">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_sucursal_express">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_sucursal_express").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                    $("#modal_agregar input").val("");
                }
            })
        }
    });
    // EDITAR
    $(document).on("click","#editar_sucursal_express",function(){
        var id=$(this).data("id");
        var id_categoria=$(this).data("categoria");
        var id_ciudad=$(this).data("ciudad");
        var simbolo=$(this).data("simbolo");
        var nombre=$("#row_sucursal_"+id).children(":nth-child(1)").text();
        var costo=$("#row_sucursal_"+id).children(":nth-child(3)").text().replace(simbolo,'');
        
        $("#editar_nombre_sucursal").val(nombre);
        $("#editar_costo_km_sucursal").val(costo);
        select_editar_id_categoria_sucursal.set([id_categoria]);
        select_editar_id_ciudad.set([id_ciudad]);

        $("#btn_editar_sucursal_express").data("id",id);
        $("#btn_editar_sucursal_express").data("simbolo",simbolo);

        $("#modal_editar").modal("show");
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_editar_sucursal_express",function(){
        validar_formulario("#content_editar_sucursal input:not([type='search'])");

        if($("#content_editar_sucursal .is-invalid").length==0){
            var nombre=$("#editar_nombre_sucursal").val();
            var costo_km=$("#editar_costo_km_sucursal").val();
            var id_ciudad=$("#editar_id_ciudad").val();
            var id_categoria_sucursal=$("#editar_id_categoria_sucursal").val();
            var nombre_categoria=obtener_atributo_select("#editar_id_categoria_sucursal", 'name', 1);
            var id_sucursal=$(this).data("id");
            var simbolo=$(this).data("simbolo");

            $.ajax({
                type:"POST",
                url:"../php/c/2/sucursales_express/editar.php",
                data:{ nombre:nombre, costo_km:costo_km, id_ciudad:id_ciudad, id_categoria_sucursal:id_categoria_sucursal, id_sucursal:id_sucursal },
                beforeSend:function () {
                    $("#btn_editar_sucursal_express").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_sucursal_"+id_sucursal).children(":nth-child(1)").text(nombre);
                        $("#row_sucursal_"+id_sucursal).children(":nth-child(2)").text(nombre_categoria);
                        $("#row_sucursal_"+id_sucursal).children(":nth-child(3)").text(simbolo+costo_km);
                    }
                },
                complete:function(){
                    $("#btn_editar_sucursal_express").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_sucursal_express",function(){
        var id_sucursal=$(this).data("id");
        $("#btn_eliminar_sucursal_express").data("id",id_sucursal);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_sucursal_express",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/sucursales_express/eliminar.php',{ id:id },'#btn_eliminar_sucursal_express','#row_sucursal_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    // BLOQUEAR CLIENTE CONTROLADOR
    $(document).on("click","#btn_bloquear_cliente_sucursal_express",function(){
        var id_clientes=$("#id_cliente").val();
        if(id_clientes.length>0){
            $.ajax({
                type: "POST",
                url:"../php/c/2/sucursales_express/bloquear_clientes.php",
                data:{ id_clientes:JSON.stringify(id_clientes) },
                beforeSend:function () {
                    $("#btn_bloquear_cliente_sucursal_express").attr("disabled",true).text("Bloqueando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        window.location.hash='#ban_express_sucursal_'+response.id;
                    }
                },
                complete:function(){
                    $("#btn_bloquear_cliente_sucursal_express").attr("disabled",false).text("Bloquear");
                }
            })
        }
        else{
            show_message('Error.', 'Seleccione al menos un cliente', 'error', 1500);
        }
    });
    // ELIMINAR CLIENTE BLOQUEADO
    $(document).on("click","#eliminar_cliente_bloqueado_express",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_cliente_bloqueado_express").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CLIENTE BLOQUEADO CONTROLADOR
    $(document).on("click","#btn_eliminar_cliente_bloqueado_express",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/sucursales_express/eliminar_cliente_bloqueado.php',{ id:id },'#btn_eliminar_cliente_bloqueado_express','#row_cliente_'+id,'#modal_eliminar','Quitando bloqueo...','Confirmar');
    });
    /* ------------------------- CATEGORIAS DE PRODUCTOS ------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_categoria_producto",function(){
        validar_formulario("#content_agregar_categoria input");

        if($("#content_agregar_categoria .is-invalid").length==0){
            var nombre=$("#agregar_nombre_categoria").val();
            var id=$(this).data("id");

            $.ajax({
                type:"POST",
                url:"../php/c/2/categorias_productos/agregar.php",
                data:{ nombre:nombre, id:id },
                beforeSend:function () {
                    $("#btn_agregar_categoria_producto").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#categorias_empty").length>0){
                            $("#categorias_empty").remove();
                        }
                        $("#tbody_categorias_sucursal").append('<tr id="row_categoria_'+response.id+'">'+
                            '<td>'+nombre+'</td>'+
                            '<td class="d-flex justify-content-end">'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="editar_categoria_producto">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_categoria_producto">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_categoria_producto").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                    $("#modal_agregar input").val("");
                }
            })
        }
    });
    // EDITAR
    $(document).on("click","#editar_categoria_producto",function(){
        var id=$(this).data("id");
        var nombre=$("#row_categoria_"+id).children("td:nth-child(1)").text();
        
        $("#editar_nombre_categoria").val(nombre);
        $("#btn_editar_categoria_producto").data("id",id);

        $("#modal_editar").modal("show");
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_editar_categoria_producto",function(){
        validar_formulario("#content_editar_horario input");

        if($("#content_editar_horario .is-invalid").length==0){
            var nombre=$("#editar_nombre_categoria").val();
            var id_categoria=$(this).data("id");

            $.ajax({
                type:"POST",
                url:"../php/c/2/categorias_productos/editar.php",
                data:{ nombre:nombre, id_categoria:id_categoria },
                beforeSend:function () {
                    $("#btn_editar_categoria_producto").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_categoria_"+id_categoria).children("td:nth-child(1)").text(nombre);
                    }
                },
                complete:function(){
                    $("#btn_editar_categoria_producto").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_categoria_producto",function(){
        var id_categoria=$(this).data("id");
        $("#btn_eliminar_categoria_producto").data("id",id_categoria);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_categoria_producto",function(){
        var id_categoria=$(this).data("id");
        delete_row('../php/c/2/categorias_productos/eliminar.php',{ id_categoria:id_categoria },'#btn_eliminar_categoria_producto','#row_categoria_'+id_categoria,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ------------------------- COSTOS POR KM ------------------------ */
    // AGREGAR
    $(document).on("click","#agregar_costo_km",function(){
        $.ajax({
            type:"POST",
            url:"../php/v/2/costos_km/ultimo_km.php",
            beforeSend:function () {
                $("#agregar_costo_km").attr("disabled",true).text("Espere...");
            },
            success:function(response){
                $("#agregar_desde_km").val(response.costo_km_desde);
                $("#agregar_hasta_km").val(response.costo_km_hasta);
                $("#btn_agregar_costo_km").data("simbolo",response.simbolo);
            },
            complete:function(){
                $("#agregar_costo_km").attr("disabled",false).text("Agregar costo");
                $("#modal_agregar").modal("show");
            }
        });
    });
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_costo_km",function(){
        validar_formulario("#content_agregar_costo input");

        if($("#content_agregar_costo .is-invalid").length==0){
            var desde=$("#agregar_desde_km").val();
            var hasta=$("#agregar_hasta_km").val();
            var costo=$("#agregar_precio_km").val();
            var simbolo=$(this).data("simbolo");

            $.ajax({
                type:"POST",
                url:"../php/c/2/costos_km/agregar.php",
                data:{ desde:desde, hasta:hasta, costo:costo },
                beforeSend:function () {
                    $("#btn_agregar_costo_km").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#costos_empty").length>0){
                            $("#costos_empty").remove();
                        }
                        $("#tbody_costos_km").append('<tr id="row_costo_km_'+response.id+'">'+
                            '<td class="text-center">'+parseFloat(desde).toFixed(2)+'</td>'+
                            '<td class="text-center">'+parseFloat(hasta).toFixed(2)+'</td>'+
                            '<td class="text-center">'+simbolo+parseFloat(costo).toFixed(2)+'</td>'+
                            '<td class="d-flex justify-content-end">'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-simbolo="'+simbolo+'" data-id="'+response.id+'" id="editar_costo_km">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_costo_km">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_costo_km").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                    $("#modal_agregar input").val("");
                }
            })
        }
    });
    // EDITAR
    $(document).on("click","#editar_costo_km",function(){
        var id=$(this).data("id");
        var simbolo=$(this).data("simbolo");
        var desde=$("#row_costo_km_"+id).children(":nth-child(1)").text();
        var hasta=$("#row_costo_km_"+id).children(":nth-child(2)").text();
        var costo=$("#row_costo_km_"+id).children(":nth-child(3)").text().replace(simbolo,'');
        
        $("#editar_desde_km").val(desde);
        $("#editar_hasta_km").val(hasta);
        $("#editar_precio_km").val(costo);

        $("#btn_editar_costo_km").data("id",id);
        $("#btn_editar_costo_km").data("simbolo",simbolo);

        $("#modal_editar").modal("show");
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_editar_costo_km",function(){
        validar_formulario("#content_editar_costo input");

        if($("#content_editar_costo .is-invalid").length==0){
            var hasta=$("#editar_hasta_km").val();
            var costo=$("#editar_precio_km").val();
            var id=$(this).data("id");
            var simbolo=$(this).data("simbolo");

            $.ajax({
                type:"POST",
                url:"../php/c/2/costos_km/editar.php",
                data:{ hasta:hasta, costo:costo, id:id },
                beforeSend:function () {
                    $("#btn_editar_costo_km").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_costo_km_"+id).children(":nth-child(2)").text(parseFloat(hasta).toFixed(2));
                        $("#row_costo_km_"+id).children(":nth-child(3)").text(simbolo+parseFloat(costo).toFixed(2));
                    }
                },
                complete:function(){
                    $("#btn_editar_costo_km").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_costo_km",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_costo_km").data("id",id);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_costo_km",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/costos_km/eliminar.php',{ id:id },'#btn_eliminar_costo_km','#row_costo_km_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ------------------------- EMPRESAS DE COMIDA ------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_empresa_comida",function(){
        validar_formulario("#content_agregar_empresa input");

        if($("#content_agregar_empresa .is-invalid").length==0){
            var nombre=$("#agregar_nombre_empresa_comida").val();
            var telefono=$("#agregar_telefono_empresa_comida").val();
            var correo=$("#agregar_correo_empresa_comida").val();
            var limite=$("#agregar_limite_sucursal_empresa_comida").val();
            var usuario=$("#agregar_usuario_empresa_comida").val();
            var contrasena=$("#agregar_contrasena_empresa_comida").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/empresas_comida/agregar.php",
                data:{ nombre:nombre, telefono:telefono, correo:correo, limite:limite, usuario:usuario, contrasena:contrasena },
                beforeSend:function () {
                    $("#btn_agregar_empresa_comida").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#empresas_comida_empty").length>0){
                            $("#empresas_comida_empty").remove();
                        }
                        $("#tbody_empresa_comida").append('<tr id="row_empresa_comida_'+response.id+'">'+
                            '<td>'+nombre+'</td>'+
                            '<td>'+telefono+'</td>'+
                            '<td>'+correo+'</td>'+
                            '<td class="text-center">'+limite+'</td>'+
                            '<td class="d-flex justify-content-end">'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="editar_empresa_comida">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_empresa_comida">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_empresa_comida").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                    $("#modal_agregar input").val("");
                }
            })
        }
    });
    // EDITAR
    $(document).on("click","#editar_empresa_comida",function(){
        var id=$(this).data("id");
        var nombre=$("#row_empresa_comida_"+id).children(":nth-child(1)").text();
        var replace_string= new Array("(",")","-");
        var telefono=$("#row_empresa_comida_"+id).children(":nth-child(2)").text();
        for (let i = 0; i < replace_string.length; i++) {
            telefono=telefono.replaceAll(replace_string[i],'');
        }
        var correo=$("#row_empresa_comida_"+id).children(":nth-child(3)").text();
        var limite=$("#row_empresa_comida_"+id).children(":nth-child(4)").text();
        
        $("#editar_nombre_empresa_comida").val(nombre);
        $("#editar_telefono_empresa_comida").val(telefono);
        $("#editar_correo_empresa_comida").val(correo);
        $("#editar_limite_sucursal_empresa_comida").val(limite);
        $("#btn_editar_empresa_comida").data("id",id);

        $("#modal_editar").modal("show");
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_editar_empresa_comida",function(){
        validar_formulario("#content_editar_empresa input");

        if($("#content_editar_empresa .is-invalid").length==0){
            var nombre=$("#editar_nombre_empresa_comida").val();
            var telefono=$("#editar_telefono_empresa_comida").val();
            var correo=$("#editar_correo_empresa_comida").val();
            var limite=$("#editar_limite_sucursal_empresa_comida").val();
            var id_empresa=$(this).data("id");

            $.ajax({
                type:"POST",
                url:"../php/c/2/empresas_comida/editar.php",
                data:{ nombre:nombre, telefono:telefono, correo:correo, limite:limite, id_empresa:id_empresa },
                beforeSend:function () {
                    $("#btn_editar_empresa_comida").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_empresa_comida_"+id_empresa).children("td:nth-child(1)").text(nombre);
                        $("#row_empresa_comida_"+id_empresa).children("td:nth-child(2)").text("("+telefono.substr(0, 3)+")-"+telefono.substr(3, 3)+"-"+telefono.substr(6, 4));
                        $("#row_empresa_comida_"+id_empresa).children("td:nth-child(3)").text(correo);
                        $("#row_empresa_comida_"+id_empresa).children("td:nth-child(4)").text(limite);
                    }
                },
                complete:function(){
                    $("#btn_editar_empresa_comida").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_empresa_comida",function(){
        var id_empresa=$(this).data("id");
        $("#btn_eliminar_empresa_comida").data("id",id_empresa);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_empresa_comida",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/empresas_comida/eliminar.php',{ id:id },'#btn_eliminar_empresa_comida','#row_empresa_comida_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ------------------------- TIPOS DE TRANSPORTE ------------------------ */
    // AGREGAR CONTROLADOR
    $(document).on("click","#btn_agregar_tipo_transporte",function(){
        validar_formulario("#content_agregar_tipo_transporte input");

        if($("#content_agregar_tipo_transporte .is-invalid").length==0){
            var nombre=$("#agregar_nombre_tipo_transporte").val();

            $.ajax({
                type:"POST",
                url:"../php/c/2/tipos_transportes/agregar.php",
                data:{ nombre:nombre },
                beforeSend:function () {
                    $("#btn_agregar_tipo_transporte").attr("disabled",true).text("Agregando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        if($("#tipos_transporte_empty").length>0){
                            $("#tipos_transporte_empty").remove();
                        }
                        $("#tbody_tipos_transporte").append('<tr id="row_tipo_transporte_'+response.id+'">'+
                            '<td>'+nombre+'</td>'+
                            '<td class="d-flex justify-content-end">'+
                                '<button class="btn btn-sm btn-light d-flex align-items-center dropdown-toggle more-horizontal" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opciones <span class="material-icons-round">expand_more</span></button>'+
                                '<div class="dropdown-menu dropdown-menu-right">'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="editar_tipo_transporte">Editar</a>'+
                                    '<a class="dropdown-item" href="javascript:void(0);" data-id="'+response.id+'" id="eliminar_tipo_transporte">Eliminar</a>'+
                                '</div>'+
                            '</td>'+
                        '</tr>');
                    }
                },
                complete:function(){
                    $("#btn_agregar_tipo_transporte").attr("disabled",false).text("Agregar");
                    $("#modal_agregar").modal("hide");
                    $("#modal_agregar input").val("");
                }
            })
        }
    });
    // EDITAR
    $(document).on("click","#editar_tipo_transporte",function(){
        var id=$(this).data("id");
        var nombre=$("#row_tipo_transporte_"+id).children("td:nth-child(1)").text();
        
        $("#editar_nombre_tipo_transporte").val(nombre);
        $("#btn_editar_tipo_transporte").data("id",id);

        $("#modal_editar").modal("show");
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_editar_tipo_transporte",function(){
        validar_formulario("#content_editar_tipo_transporte input");

        if($("#content_editar_tipo_transporte .is-invalid").length==0){
            var nombre=$("#editar_nombre_tipo_transporte").val();
            var id_tipo_transporte=$(this).data("id");

            $.ajax({
                type:"POST",
                url:"../php/c/2/tipos_transportes/editar.php",
                data:{ nombre:nombre, id_tipo_transporte:id_tipo_transporte },
                beforeSend:function () {
                    $("#btn_editar_tipo_transporte").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#row_tipo_transporte_"+id_tipo_transporte).children("td:nth-child(1)").text(nombre);
                    }
                },
                complete:function(){
                    $("#btn_editar_tipo_transporte").attr("disabled",false).text("Guardar");
                    $("#modal_editar").modal("hide");
                }
            });
        }
    });
    // ELIMINAR
    $(document).on("click","#eliminar_tipo_transporte",function(){
        var id_tipo_transporte=$(this).data("id");
        $("#btn_eliminar_tipo_transporte").data("id",id_tipo_transporte);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR CONTROLADOR
    $(document).on("click","#btn_eliminar_tipo_transporte",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/tipos_transportes/eliminar.php',{ id:id },'#btn_eliminar_tipo_transporte','#row_tipo_transporte_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* -------------------------------- PRODUCTOS ------------------------------- */
    // CHECKBOX
    $(document).on("click","#marcar_check_nuevo_producto",function(){
        if(!$(this).find(":checkbox").is(":checked")){
            $(this).find(":checkbox").prop("checked",true).next().text("Agregado");
            $(this).find("#icon_check").addClass("text-success").text("check_circle");
        }
        else{
            $(this).find(":checkbox").prop("checked",false).next().text("Agregar");
            $(this).find("#icon_check").removeClass("text-success").text("radio_button_unchecked");
        }
    });
    // AGREGAR PRODUCTO CONTROLADOR
    $(document).on("click","#btn_agregar_producto",function(){
        validar_formulario("#content_info input:not([type='search']), #content_info textarea");

        if($("#content_info .is-invalid").length==0){
            var nombre_producto=$("#nombre_producto").val();
            var descripcion_producto=$("#descripcion_producto").val();
            var id_categoria_producto=$("#id_categoria_producto").val();
            var tiempo_preparacion_producto=$("#tiempo_preparacion_producto").val();
            var precio_producto=$("#precio_producto").val();
            var precio_kg_producto=$("#precio_kg_producto").val();
            var id_sucursal=$(this).data("id");

            var ingredientes=[];

            $("#content_ingredientes :checkbox:checked").each(function(index){
                ingredientes[index]={ id_ingrediente: $(this).data("id") }
            });

            var menus=[];

            $("#content_menus :checkbox:checked").each(function(index){
                menus[index]={ id_menu: $(this).data("id") }
            });

            $.ajax({
                type:"POST",
                url:"../php/c/2/productos/agregar.php",
                data:{ nombre_producto:nombre_producto, descripcion_producto:descripcion_producto, id_categoria_producto:id_categoria_producto, tiempo_preparacion_producto:tiempo_preparacion_producto, precio_producto:precio_producto, precio_kg_producto:precio_kg_producto, id_ingrediente: JSON.stringify(ingredientes), id_menu: JSON.stringify(menus), id_sucursal:id_sucursal },
                beforeSend:function () {
                    $("#btn_agregar_producto").attr("disabled",true).text("Agregando...");
                },
                success:function (response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        uploadfiles('productos', response.id, "cropper_dropzone_copy");
                        $("#content_info input, #content_info textarea").val("");
                        $(":checkbox:checked").prop("checked",false).next().text("Agregar");
                        $("#content_ingredientes, #content_menus").find(".icon_check").removeClass("text-success").text("radio_button_unchecked");
                        myDropZone.disable();
                        myDropZone.removeAllFiles();
                        myDropZone.enable();
                        $("#v-info-tab").trigger("click");
                    }
                },
                complete:function (){
                    $("#btn_agregar_producto").attr("disabled",false).text("Agregar");
                }
            })

        }
        else{
            $("#v-info-tab").trigger("click");
        }
    });
    // EDITAR CONTROLADOR
    $(document).on("click","#btn_guardar_producto",function(){
        validar_formulario("#content_info input:not([type='search']), #content_info textarea");

        if($("#content_info .is-invalid").length==0){
            var nombre=$("#nombre_producto").val();
            var descripcion=$("#descripcion_producto").val();
            var id_categoria=$("#id_categoria_producto").val();
            var tiempo_preparacion=$("#tiempo_preparacion_producto").val();
            var precio=$("#precio_producto").val();
            var precio_kg=$("#precio_kg_producto").val();
            var id_producto=$(this).data("id");

            peticion_ajax_1('../php/c/2/productos/editar.php', { nombre:nombre, descripcion:descripcion, id_categoria:id_categoria, tiempo:tiempo_preparacion, precio:precio, precio_kg:precio_kg, id_producto:id_producto }, '#btn_guardar_producto');
        }
    });
    // QUITAR INGREDIENTE DEL PRODUCTO
    $(document).on("click","#eliminar_detalle_producto_ingrediente",function(){
        var id=$(this).data("id");
        var id_producto=$(this).data("producto");
        var id_ingrediente=$(this).data("ingrediente");
        var nombre_ingrediente=$(this).parent().prev().text();
        $("#btn_eliminar_detalle_producto_ingrediente").data("id",id);
        $("#btn_eliminar_detalle_producto_ingrediente").data("producto",id_producto);
        $("#btn_eliminar_detalle_producto_ingrediente").data("ingrediente",id_ingrediente);
        $("#btn_eliminar_detalle_producto_ingrediente").data("nombre_ingrediente",nombre_ingrediente);
        $("#modal_eliminar").modal("show");
    });
    // QUITAR INGREDIENTE DEL PRODUCTO CONTROLADOR
    $(document).on("click","#btn_eliminar_detalle_producto_ingrediente",function(){
        var id=$(this).data("id");
        var id_producto=$(this).data("producto");
        var nombre_ingrediente=$(this).data("nombre_ingrediente");
        var id_ingrediente=$(this).data("ingrediente");

        $.ajax({
            type: "POST",
            url: '../php/c/2/productos/eliminar_ingrediente.php',
            data: { id:id },
            beforeSend: function () {
                $('#btn_eliminar_detalle_producto_ingrediente').attr("disabled", true).text("Eliminando...");
            },
            success: function (response) {
                show_message(response.title, response.message, response.status, response.time);
                if(response.status=="success"){
                    $('#row_detalle_ingrediente_'+id).remove();

                    if($("#tbody_detalle_productos_ingredientes tr").length==0){
                        $("#tbody_detalle_productos_ingredientes").html('<tr id="detalle_ingrediente_empty">'+
                            '<td colspan="2">No se encontraron resultados</td>'+
                        '</tr>')
                    }

                    if($("#card_empty").length>0){
                        $("#card_empty").remove();
                    }

                    $("#content_ingredientes").prepend('<div class="col-sm-12 col-md-4 my-4">'+
                        '<div class="list-group list-group-flush my-n3 border shadow-sm" id="marcar_check_nuevo_producto" style="cursor:pointer;">'+
                            '<div class="list-group-item">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-auto">'+
                                        '<span class="material-icons-round icon_check" id="icon_check">radio_button_unchecked</span>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>'+
                                        '<strong>'+nombre_ingrediente+'</strong>'+
                                        '<div class="my-0 text-muted small" id="nombre_estado_metodo_pago_sucursal_1">&nbsp</div>'+
                                    '</div>'+
                                    '<div class="col-auto">'+
                                        '<div class="form-check">'+
                                            '<input class="form-check-input" style="display:none;" type="checkbox" data-id="'+id_ingrediente+'">'+
                                            '<label>Agregar</label>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');

                    if($("#card_button").length==0){
                        $("#content_ingredientes").append('<div class="col-sm-12" id="card_button">'+
                            '<div class="form-group text-right">'+
                                '<button class="btn btn-outline-dark" id="btn_agregar_detalle_producto_ingredientes" data-id="'+id_producto+'">Agregar ingredientes</button>'+
                            '</div>'+
                        '</div>');
                    }
                }
            },
            complete: function () {
                $('#btn_eliminar_detalle_producto_ingrediente').attr("disabled", false).text("Confirmar");
                $('#modal_eliminar').modal("hide");
            }
        });
    });
    // AGREGAR INGREDIENTES AL PRODUCTO CONTROLADOR
    $(document).on("click","#btn_agregar_detalle_producto_ingredientes",function(){
        if($("#content_ingredientes :checkbox:checked").length>0){
            var id_producto=$(this).data("id");
            var ingredientes=[];
    
            $("#content_ingredientes :checkbox:checked").each(function(index){
                ingredientes[index]={ id_ingrediente: $(this).data("id"), nombre_ingrediente: $(this).parent().parent().prev().find("strong").text() }
            });

            $.ajax({
                type:"POST",
                url:"../php/c/2/productos/agregar_ingrediente.php",
                data:{ id_producto:id_producto, id_ingrediente: JSON.stringify(ingredientes) },
                beforeSend: function () {
                    $("#btn_agregar_detalle_producto_ingredientes").attr("disabled",true).text("Agregando...");
                },
                success: function (response) {
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){

                        if($("#detalle_ingrediente_empty").length>0){
                            $("#detalle_ingrediente_empty").remove();
                        }

                        $("#content_ingredientes :checkbox:checked").each(function(){
                            $(this).parent().parent().parent().parent().parent().parent().remove();
                        });

                        if($("#content_ingredientes :checkbox").length==0){
                            $("#content_ingredientes").html('<div class="col-sm-12" id="card_empty">'+
                                '<h5 class="text-center">No se encontraron resultados</h5>'+
                            '</div>');
                        }

                        var id_ingredientes=response.id_ingredientes.split(",");
                        var nombres_ingredientes=response.nombre_ingredientes.split(",");

                        for (var i = 0; i < response.total_ing; i++) {
                            $("#tbody_detalle_productos_ingredientes").append('<tr id="row_detalle_ingrediente_'+id_ingredientes[i]+'">'+
                                '<td>'+nombres_ingredientes[i]+'</td>'+
                                '<td class="d-flex justify-content-end">'+
                                    '<button class="btn btn-light" id="eliminar_detalle_producto_ingrediente" data-id="'+id_ingredientes[i]+'">Quitar ingrediente</button>'+
                                '</td>'+
                            '</tr>');
                        }
                    }
                },
                complete: function(){
                    $("#btn_agregar_detalle_producto_ingredientes").attr("disabled",false).text("Agregar ingredientes");
                }
            });
        }
        else{
            show_message('Error', 'Primero seleccione ingredientes', 'error', 3000);
        }
    });
    // QUITAR MENU DEL PRODUCTO
    $(document).on("click","#eliminar_detalle_producto_menu",function(){
        var id=$(this).data("id");
        var id_producto=$(this).data("producto");
        var nombre_menu=$(this).parent().prev().text();
        $("#btn_eliminar_detalle_producto_menu").data("id",id);
        $("#btn_eliminar_detalle_producto_menu").data("producto",id_producto);
        $("#btn_eliminar_detalle_producto_menu").data("nombre_menu",nombre_menu);
        $("#modal_eliminar").modal("show");
    });
    // QUITAR MENU DEL PRODUCTO CONTROLADOR
    $(document).on("click","#btn_eliminar_detalle_producto_menu",function(){
        var id=$(this).data("id");
        var nombre_menu=$(this).data("nombre_menu");
        var id_producto=$(this).data("producto");

        $.ajax({
            type: "POST",
            url: '../php/c/2/productos/eliminar_menu.php',
            data: { id:id, id_producto:id_producto },
            beforeSend: function () {
                $('#btn_eliminar_detalle_producto_menu').attr("disabled", true).text("Eliminando...");
            },
            success: function (response) {
                show_message(response.title, response.message, response.status, response.time);
                if(response.status=="success"){
                    $('#row_detalle_menu_'+id).remove();

                    if($("#card_menu_empty").length>0){
                        $("#card_menu_empty").remove();
                    }

                    $("#content_menus").prepend('<div class="col-sm-12 col-md-4 my-4">'+
                        '<div class="list-group list-group-flush my-n3 border shadow-sm" id="marcar_check_nuevo_producto" style="cursor:pointer;">'+
                            '<div class="list-group-item">'+
                                '<div class="row align-items-center">'+
                                    '<div class="col-auto">'+
                                        '<span class="material-icons-round icon_check" id="icon_check">radio_button_unchecked</span>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<div class="my-0 text-muted small">&nbsp</div>'+
                                        '<strong>'+nombre_menu+'</strong>'+
                                        '<div class="my-0 text-muted small">&nbsp</div>'+
                                    '</div>'+
                                    '<div class="col-auto">'+
                                        '<div class="form-check">'+
                                            '<input class="form-check-input" style="display:none;" type="checkbox" data-id="'+id+'">'+
                                            '<label>Agregar</label>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>');

                    if($("#card_button").length==0){
                        $("#content_menus").append('<div class="col-sm-12" id="card_button">'+
                            '<div class="form-group text-right">'+
                                '<button class="btn btn-outline-dark" id="btn_agregar_detalle_producto_menus" data-id="'+id_producto+'">Agregar schedules</button>'+
                            '</div>'+
                        '</div>');
                    }
                }
            },
            complete: function () {
                $('#btn_eliminar_detalle_producto_menu').attr("disabled", false).text("Confirmar");
                $('#modal_eliminar').modal("hide");
            }
        });
    });
    // AGREGAR MENUS AL PRODUCTO CONTROLADOR
    $(document).on("click","#btn_agregar_detalle_producto_menus",function(){
        if($("#content_menus :checkbox:checked").length>0){
            var id_producto=$(this).data("id");
            var menus=[];
    
            $("#content_menus :checkbox:checked").each(function(index){
                menus[index]={ id_menu: $(this).data("id"), nombre_menu: $(this).parent().parent().prev().find("strong").text() }
            });

            $.ajax({
                type:"POST",
                url:"../php/c/2/productos/agregar_schedule.php",
                data:{ id_producto:id_producto, id_menu: JSON.stringify(menus) },
                beforeSend: function () {
                    $("#btn_agregar_detalle_producto_menus").attr("disabled",true).text("Agregando...");
                },
                success: function (response) {
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){

                        $("#content_menus :checkbox:checked").each(function(){
                            $(this).parent().parent().parent().parent().parent().parent().remove();
                        });

                        if($("#content_menus :checkbox").length==0){
                            $("#content_menus").html('<div class="col-sm-12" id="card_menu_empty">'+
                                '<h5 class="text-center">No se encontraron resultados</h5>'+
                            '</div>');
                        }

                        if($("#detalle_menu_empty").length>0){
                            $("#detalle_menu_empty").remove();
                        }

                        var id_menu=response.id_menu.split(",");
                        var nombre_menu=response.nombre_menu.split(",");

                        for (var i = 0; i < response.total_menu; i++) {
                            $("#tbody_detalle_productos_menus").append('<tr id="row_detalle_menu_'+id_menu[i]+'">'+
                                '<td>'+nombre_menu[i]+'</td>'+
                                '<td class="d-flex justify-content-end">'+
                                    '<button class="btn btn-light" id="eliminar_detalle_producto_menu" data-producto="'+id_producto+'" data-id="'+id_menu[i]+'">Quitar schedule</button>'+
                                '</td>'+
                            '</tr>');
                        }
                    }
                },
                complete: function(){
                    $("#btn_agregar_detalle_producto_menus").attr("disabled",false).text("Agregar");
                }
            });
        }
        else{
            show_message('Error', 'Primero seleccione schedules', 'error', 3000);
        }
    });
    // ELIMIANR IMAGEN
    $(document).on("click","#eliminar_imagen_producto",function(){
        var id=$(this).data("id");
        var name=$(this).data("name");
        var posicion=$(this).data("posicion");

        $("#btn_eliminar_imagen_producto").data("id",id);
        $("#btn_eliminar_imagen_producto").data("name",name);
        $("#btn_eliminar_imagen_producto").data("posicion",posicion);

        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR IMAGEN CONTROLADOR
    $(document).on("click","#btn_eliminar_imagen_producto",function(){
        var id=$(this).data("id");
        var name=$(this).data("name");
        var posicion=$(this).data("posicion");

        $.ajax({
            type: "POST",
            url: '../php/c/0/upload.php',
            data: { carpeta:'productos', subcarpeta:id, name:name, request:'delete_file' },
            beforeSend: function () {
                $('#btn_eliminar_imagen_producto').attr("disabled", true).text("Eliminando...");
            },
            success: function (response) {
                show_message(response.title, response.message, response.status, response.time);
                if(response.status=="success"){
                    $('#image_'+posicion).remove();

                    if($(".img-row").length==0){
                        $("#content_imagenes").html('<div class="col-sm-12">'+
                            '<div class="text-center my-5">'+
                                '<h2 class="mb-0">No se encontraron imágenes</h2>'+
                                '<p class="lead text-muted">No se han agregado imágenes al producto</p>'+
                            '</div>'+
                        '</div>');
                    }
                }
            },
            complete: function () {
                $('#btn_eliminar_imagen_producto').attr("disabled", false).text("Confirmar");
                $('#modal_eliminar').modal("hide");
            }
        });
    });
    // AGREGAR IMAGENES AL PRODUCTO
    $(document).on("click","#agregar_imagenes_producto",function(){
        if($(this).data("num")==1){
            $("#content_imagenes").hide();
            $(".content_dropzone").show();
            $(this).data("num",0).text("Volver");
        }
        else{
            $(".content_dropzone").hide();
            $("#content_imagenes").show();
            $(this).data("num",1).text("Agregar imágenes");
        }
    });
    // AGREGAR IMAGENES AL PRODUCTO CONTROLADOR
    $(document).on("click","#btn_agregar_imagenes_producto",function(){
        uploadfiles('productos', $(this).data("id"), "cropper_dropzone_copy");
        get_view_main('productos', 'imagenes', { id_producto: $(this).data("id") }, "#main");
    });
    // ELIMINAR PRODUCTO
    $(document).on("click","#eliminar_producto",function(){
        var id_producto=$(this).data("id");
        $("#btn_eliminar_producto").data("id",id_producto);

        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR PRODUCTO CONTROLADOR
    $(document).on("click","#btn_eliminar_producto",function(){
        var id_producto=$(this).data("id");
        
        delete_row('../php/c/2/productos/eliminar.php',{ id_producto:id_producto },'#btn_eliminar_producto','#row_producto_'+id_producto,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ------------------------------ INGREDIENTES ------------------------------ */
    // AGREGAR INGREDIENTE ADICIONAL
    $(document).on("click","#btn_agregar_ingrediente_adicional",function(){
        validar_formulario("#content_ing_adicional input:not([type='search'])");

        if($("#content_ing_adicional .is-invalid").length==0){
            var nombre_adicional=$("#nombre_adicional").val();
            var precio_adicional=$("#precio_adicional").val();
            var id_sub_complementos=$("#id_sub_complementos").val();
            var simbolo=$(this).data("simbolo");

            $("#tbody_ingredientes_extras").append('<tr>'+
                '<th scope="col">'+nombre_adicional+'</th>'+
                '<td class="text-center">'+simbolo+parseFloat(precio_adicional).toFixed(2)+'</td>'+
                '<td data-ids="'+id_sub_complementos+'">'+obtener_atributo_select('#id_sub_complementos', 'name', 0)+'</td>'+
                '<td>'+
                    '<a href="javascript:void(0);" id="quitar_ing_extra" class="text-muted">Eliminar</a>'+
                '</td>'+
            '</tr>');

            $("#content_ing_adicional input").val("");
            select_id_sub_complementos.set(['']);
            $("#modal_ing_extra").modal("hide");
        }
    });
    // QUITAR INGREDIENTE ADICIONAL
    $(document).on("click","#quitar_ing_extra",function(){
        if(!$(this).data("id")){
            $(this).parent().parent().remove();
        }
        else{
            $("#btn_eliminar_ingrediente_extra").data("id",$(this).data("id"));
            $("#modal_eliminar_ing_extra").modal("show");
        }
    });
    // ELIMINAR INGREDIENTE ADICIONAL CONTROLADOR
    $(document).on("click","#btn_eliminar_ingrediente_extra",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/ingredientes/eliminar_adicional.php',{ id:id },'#btn_eliminar_ingrediente_extra','#tr_row_ing_adicional_'+id,'#modal_eliminar_ing_extra','Eliminando...','Confirmar');
    });
    // AGREGAR INGREDIENTE CONTROLADOR
    $(document).on("click","#btn_agregar_ingrediente",function(){
        validar_formulario("#content_ingrediente input");
        if($("#content_ingrediente .is-invalid").length==0 && $("#tbody_ingredientes_extras tr").length>0){

            var nombre_ingrediente=$("#nombre_ingrediente").val();
            var cantidad_minima_ingrediente=$("#cantidad_minima_ingrediente").val();
            var cantidad_maxima_ingrediente=$("#cantidad_maxima_ingrediente").val();
            var seleccion_multiple_ingrediente=$("#seleccion_multiple_ingrediente").val();
            var simbolo=$(this).data("simbolo");
            var ingredientes_extras=[];

            $("#tbody_ingredientes_extras tr").each(function(index){
                ingredientes_extras[index]={ nombre:$(this).children("th:nth-child(1)").text(), precio:$(this).children("td:nth-child(2)").text().replace(simbolo,''), id_subcomplemento:$(this).children("td:nth-child(3)").data('ids') };
            });

            $.ajax({
                type: "POST",
                url:"../php/c/2/ingredientes/agregar.php",
                data:{ nombre_ingrediente:nombre_ingrediente, cantidad_minima_ingrediente:cantidad_minima_ingrediente, cantidad_maxima_ingrediente:cantidad_maxima_ingrediente, seleccion_multiple_ingrediente:seleccion_multiple_ingrediente, ingredientes_extras:JSON.stringify(ingredientes_extras) },
                beforeSend: function () {
                    $("#btn_agregar_ingrediente").attr("disabled",true).text("Agregando...");
                },
                success: function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#content_ingrediente input").val("");
                        $("#tbody_ingredientes_extras").html("");
                    }
                },
                complete: function (){
                    $("#btn_agregar_ingrediente").attr("disabled",false).text("Agregar");
                }
            });

        }
        else{
            if($("#tbody_ingredientes_extras tr").length==0){
                show_message('Error.', 'Agregue ingredientes adicionales', 'error', 2000);
            }
        }
    });
    // EDITAR INGREDIENTE ADICIONAL
    $(document).on("click","#editar_ing_extra",function(){
        var id=$(this).data("id");
        var simbolo=$(this).data("simbolo");
        var nombre=$("#tr_row_ing_adicional_"+id).children(":nth-child(1)").text();
        var precio=$("#tr_row_ing_adicional_"+id).children(":nth-child(2)").text().replace(simbolo,'');
        
        $("#editar_nombre_ing_adicional").val(nombre);
        $("#editar_precio_ing_adicional").val(precio);
        
        var id_ingredientes=$(this).data("ingrediente").split(",");
        var array_ingredientes=[];
        
        for (var i = 0; i < (id_ingredientes.length+1); i++) {
            array_ingredientes.push(id_ingredientes[i]);
        }
        select_editar_id_sub_complementos.set(array_ingredientes.sort());

        var id_detalle=$(this).data("id_detalle").split(",");
        var detalle=$(this).data("detalle").split(",");
        var tr='';

        if(id_detalle!=""){
            for(var i = 0; i<(id_detalle.length); i++) {
                tr+='<tr data-detalle="'+id_detalle[i]+'" data-estado="1" data-ingrediente="'+id_ingredientes[i]+'">'+
                    '<th scope="col">'+detalle[i]+'</th>'+
                    '<td>'+
                        '<a href="javascript:void(0);" id="marcar_eliminar_detalle_ing_sub" class="text-muted">Eliminar</a>'+
                    '</td>'+
                '</tr>';
            }
        }
        $("#tbody_editar_ingredientes_extras").html(tr);

        $("#btn_editar_ing_extra").data("id",id);
        
        $("#modal_editar_ing_extra").modal("show");
    });
    // MARCAR COMO ELIMINADO
    $(document).on("click","#marcar_eliminar_detalle_ing_sub",function(){
        var texto=$(this).parent().prev().text();
        var array=[];
        $(this).html("<s>Eliminar</s>").parent().prev().html("<s>"+texto+"</s>").parent().data("estado",0);
        $("#tbody_editar_ingredientes_extras tr").each(function(){
            $(this).data("estado")==1 ? array.push($(this).data("ingrediente")) : void 0 ;
        });
        select_editar_id_sub_complementos.set(array.sort());
    });
    // CHANGE DE SUBCOMPLEMENTOS AL EDITAR
    $(document).on("change","#editar_id_sub_complementos",function(){
        if($(this).val().length>0){
            var id_sub_complementos=obtener_atributo_select(this,'value',0);
            var name_sub_complementos=obtener_atributo_select(this,'name',0);

            id_sub_complementos=id_sub_complementos.split(',');
            name_sub_complementos=name_sub_complementos.split(",");
            var tr='';
            for(var i=0; i<id_sub_complementos.length; i++){

                if($("#tbody_editar_ingredientes_extras tr[data-ingrediente='"+id_sub_complementos[i].trim()+"']").length==0){

                    tr+='<tr data-detalle="0" data-estado="1" data-ingrediente="'+id_sub_complementos[i].trim()+'">'+
                        '<th scope="col">'+name_sub_complementos[i].trim()+'</th>'+
                        '<td>'+
                            '<a href="javascript:void(0);" id="marcar_eliminar_detalle_ing_sub" class="text-muted">Eliminar</a>'+
                        '</td>'+
                    '</tr>';

                }
                else{
                    $("#tbody_editar_ingredientes_extras tr[data-ingrediente='"+id_sub_complementos[i].trim()+"']").data("estado",1);

                    var texto_1=$("#tbody_editar_ingredientes_extras tr[data-ingrediente='"+id_sub_complementos[i].trim()+"']").find("s:first").text();
                    $("#tbody_editar_ingredientes_extras tr[data-ingrediente='"+id_sub_complementos[i].trim()+"']").find("s:first").replaceWith(texto_1);
                    
                    var texto_2=$("#tbody_editar_ingredientes_extras tr[data-ingrediente='"+id_sub_complementos[i].trim()+"']").find("s:last").text();
                    $("#tbody_editar_ingredientes_extras tr[data-ingrediente='"+id_sub_complementos[i].trim()+"']").find("s:last").replaceWith(texto_2);
                }
            }
            $("#tbody_editar_ingredientes_extras").append(tr);
        }
    });
    // EDITAR INGREDIENTE ADICIONAL CONTROLADOR
    $(document).on("click","#btn_editar_ing_extra",function(){
        validar_formulario("#content_editar_ing_extra input:not([type='search'])");

        if($("#content_editar_ing_extra .is-invalid").length==0){
            var nombre=$("#editar_nombre_ing_adicional").val();
            var precio=$("#editar_precio_ing_adicional").val();
            var id=$(this).data("id");
            var simbolo=$(this).data("simbolo");
            var id_ing_adicionales=[];

            $("#tbody_editar_ingredientes_extras tr").each(function(index){
                id_ing_adicionales[index]={ id_detalle:$(this).data("detalle"), estado:$(this).data("estado"), id_ingrediente:$(this).data("ingrediente") };
            });

            $.ajax({
                type:"POST",
                url:"../php/c/2/ingredientes/editar_ing_extra.php",
                data:{ nombre:nombre, precio:precio, id:id, id_ing_adicionales:JSON.stringify(id_ing_adicionales) },
                beforeSend:function () {
                    $("#btn_editar_ing_extra").attr("disabled",true).text("Guardando...");
                },
                success:function(response){
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        $("#tbody_ingredientes_extras #tr_row_ing_adicional_"+id).children(":nth-child(1)").text(nombre);
                        $("#tbody_ingredientes_extras #tr_row_ing_adicional_"+id).children(":nth-child(2)").text(simbolo+parseFloat(precio).toFixed(2));

                        $("#tbody_ingredientes_extras a[data-id='"+id+"']").data("id_detalle",response.id_detalles.substring(0, response.id_detalles.length - 1));
                        $("#tbody_ingredientes_extras a[data-id='"+id+"']").data("detalle",response.nombre_detalles.substring(0, response.nombre_detalles.length - 1));

                        var id_ingredientes='';
                        $("#tbody_editar_ingredientes_extras tr").each(function(){
                            if($(this).data("estado")==1){
                                id_ingredientes+=$(this).data("ingrediente")+',';
                            }
                        });
                        id_ingredientes.substring(0, id_ingredientes.length - 1);
                        $("#tbody_ingredientes_extras a[data-id='"+id+"']").data("ingrediente",id_ingredientes);

                        $("#tbody_ingredientes_extras #tr_row_ing_adicional_"+id).children(":nth-child(3)").text(obtener_atributo_select("#editar_id_sub_complementos", "name", 0));
                    }
                },
                complete:function(){
                    $("#btn_editar_ing_extra").attr("disabled",false).text("Guardar");
                    $("#modal_editar_ing_extra").modal("hide");
                }
            })
        }
    });
    // EDITAR INGREDIENTE CONTROLADOR
    $(document).on("click","#btn_guardar_ingrediente",function(){
        validar_formulario("#content_ingrediente input:not([type='search'])");

        if($("#content_ingrediente .is-invalid").length==0){
            var nombre_ingrediente=$("#nombre_ingrediente").val();
            var cantidad_minima_ingrediente=$("#cantidad_minima_ingrediente").val();
            var cantidad_maxima_ingrediente=$("#cantidad_maxima_ingrediente").val();
            var seleccion_multiple_ingrediente=$("#seleccion_multiple_ingrediente").val();
            var id_ingrediente=$(this).data("id");
            var simbolo=$(this).data("simbolo");
            var ingredientes_extras=[];

            $("#tbody_ingredientes_extras tr:not([id])").each(function(index){
                ingredientes_extras[index]={ nombre:$(this).children(":nth-child(1)").text(), precio:$(this).children(":nth-child(2)").text().replace(simbolo,""), id_subcomplemento:$(this).children(":nth-child(3)").data("ids") };
            });

            $.ajax({
                type: "POST",
                url: '../php/c/2/ingredientes/editar.php',
                data: { nombre_ingrediente:nombre_ingrediente, cantidad_minima_ingrediente:cantidad_minima_ingrediente, cantidad_maxima_ingrediente:cantidad_maxima_ingrediente, seleccion_multiple_ingrediente:seleccion_multiple_ingrediente, id_ingrediente:id_ingrediente, ingredientes_extras:JSON.stringify(ingredientes_extras) },
                beforeSend: function () {
                    $('#btn_guardar_ingrediente').attr("disabled", true).text("Guardando...");
                },
                success: function (response) {
                    show_message(response.title, response.message, response.status, response.time);
                    if(response.status=="success"){
                        var id_ing_extra_response_split=response.ids_ingredientes_extras.substring(0, response.ids_ingredientes_extras.length - 1).split(",");
                        var id_detalles=response.ids_detalle.substring(0, response.ids_detalle.length - 1).split("/");
                        var id_detalle_retorno='';

                        $("#tbody_ingredientes_extras tr:not([id])").each(function(index){
                            
                            var id_detalles_split=id_detalles[index].split('-');
                            for(var i=0; i<id_detalles.length; i++){

                                if(id_detalles_split[0]==id_ing_extra_response_split[index]){
                                    id_detalle_retorno+=id_detalles_split[1];
                                    break;
                                }
                            }                            
                            
                            $(this).attr("id","tr_row_ing_adicional_"+id_ing_extra_response_split[index]).find("a#quitar_ing_extra").data("id",id_ing_extra_response_split[index]);
                            var id_sub_complementos=$(this).children(":nth-child(3)").data("ids");
                            
                            $(this).find("a#quitar_ing_extra").before('<a href="javascript:void(0);" data-detalle="" data-ingrediente="'+id_sub_complementos+'" data-id_detalle="'+id_detalle_retorno+'" data-id="'+id_ing_extra_response_split[index]+'" id="editar_ing_extra" class="text-muted mr-2">Editar</a>');
                            
                            id_detalle_retorno='';
                            
                        });

                    }
                },
                complete: function () {
                    $('#btn_guardar_ingrediente').attr("disabled", false).text("Guardar cambios");
                }
            });
        }
    });
    // ELIMINAR INGREDIENTE
    $(document).on("click","#eliminar_ingrediente",function(){
        var id=$(this).data("id");
        $("#btn_eliminar_ingrediente").data("id",id);
        $("#modal_eliminar").modal("show");

    });
    // ELIMINAR INGREDIENTE CONTROLADOR
    $(document).on("click","#btn_eliminar_ingrediente",function(){
        var id=$(this).data("id");
        delete_row('../php/c/2/ingredientes/eliminar.php',{ id:id },'#btn_eliminar_ingrediente','#row_ingrediente_'+id,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ---------------------------------- MENUS --------------------------------- */
    // FILTRO DE PRODUCTOS POR CATEGORIA
    $(document).on("click","#filtro_categoria_schedule",function(){
        var id_categoria=$(this).data("id");
        var icon=$(this).find(".icon").text();
        if(icon=="radio_button_unchecked"){
            $(this).find(".icon").text("check_circle").addClass("text-success");
            $("#content_productos [data-categoria='"+id_categoria+"']").find("#icon_check").text("check_circle").addClass("text-success");
            $("#content_productos [data-categoria='"+id_categoria+"']").find(":checkbox").prop("checked",true).next().text("Agregado");
        }
        else{
            $(this).find(".icon").text("radio_button_unchecked").removeClass("text-success");
            $("#content_productos [data-categoria='"+id_categoria+"']").find("#icon_check").text("radio_button_unchecked").removeClass("text-success");
            $("#content_productos [data-categoria='"+id_categoria+"']").find(":checkbox").prop("checked",false).next().text("Agregar");
        }
    });
    // AGREGAR MENU CONTROLADOR
    $(document).on("click","#btn_agregar_menu",function(){
        validar_formulario("#content_menu input:not([type='search'])");

        if($("#content_menu .is-invalid").length==0 && $("#dia_semana").val().length>0){
            var nombre=$("#nombre_menu").val();
            var hora_inicio=$("#hora_inicio_menu").val();
            var hora_fin=$("#hora_fin_menu").val();
            var dia=$("#dia_semana").val();
            var id_productos=[];

            $("#content_productos :checkbox:checked").each(function(index){
                id_productos[index]={ id:$(this).data("id") };
            });

            if(id_productos.length>0){
                $.ajax({
                    type: "POST",
                    url:"../php/c/2/menus/agregar.php",
                    data:{ nombre:nombre, hora_inicio:hora_inicio, hora_fin:hora_fin, dia:JSON.stringify(dia), id_productos:JSON.stringify(id_productos) },
                    beforeSend:function () {
                        $("#btn_agregar_menu").attr("disabled",true).text("Agregando...");
                    },
                    success:function(response){
                        show_message(response.title, response.message, response.status, response.time);
                        if(response.status=="success"){
                            $("#content_productos :checkbox:checked").prop("checked",false).next().text("Agregar").parent().parent().prev().prev().find("#icon_check").removeClass("text-success").text("radio_button_unchecked");
                            $("#content_filtro_categorias [data-id]").find(".icon").removeClass("text-success").text("radio_button_unchecked");
                            $("#nombre_menu").val("");
                            $(".hora-menu").val("00:00");
                            select_dia_semana.set(['']);
                        }
                    },
                    complete: function (){
                        $("#btn_agregar_menu").attr("disabled",false).text("Agregar");
                    }
                });
            }
            else{
                show_message("Error.","Por favor seleccione al menos un producto",'error',3000);
            }
        }
        else{
            if($("#dia_semana").val().length==0 && $("#content_menu .is-invalid").length==0){
                show_message("Error.","Por favor seleccione al menos un día de activación",'error',3000);
                $("#dia_semana").focus();
            }
        }
    });
    // EDITAR MENU CONTROLADOR
    $(document).on("click","#btn_editar_menu",function(){
        validar_formulario("#content_menu input:not([type='search'])");

        if($("#content_menu .is-invalid").length==0 && $("#dia_semana").val().length>0){
            var id_menu=$(this).data("id");
            var nombre=$("#nombre_menu").val();
            var hora_inicio=$("#hora_inicio_menu").val();
            var hora_fin=$("#hora_fin_menu").val();
            var dia=$("#dia_semana").val();
            var dia_string=$("#dia_semana").val().join();
            var id_productos=[];
            var id_productos_string='';

            $("#content_productos :checkbox:checked").each(function(index){
                id_productos[index]={ id:$(this).data("id") };
                id_productos_string+=$(this).data("id")+',';
            });

            if(id_productos.length>0){
                peticion_ajax_1('../php/c/2/menus/editar.php',{ id_menu:id_menu, nombre:nombre, hora_inicio:hora_inicio, hora_fin:hora_fin, dia:JSON.stringify(dia), dia_string:dia_string, id_productos:JSON.stringify(id_productos), id_productos_string:id_productos_string }, '#btn_editar_menu');
            }
            else{
                show_message("Error.","Por favor seleccione al menos un producto",'error',3000);
            }
        }
        else{
            if($("#dia_semana").val().length==0 && $("#content_menu .is-invalid").length==0){
                show_message("Error.","Por favor seleccione al menos un día de activación",'error',3000);
                $("#dia_semana").focus();
            }
        }
    });
    // ELIMINAR MENU
    $(document).on("click","#eliminar_menu",function(){
        var id_menu=$(this).data("id");
        $("#btn_eliminar_menu").data("id",id_menu);
        $("#modal_eliminar").modal("show");
    });
    // ELIMINAR MENU CONTROLADOR
    $(document).on("click","#btn_eliminar_menu",function(){
        var id_menu=$(this).data("id");
        delete_row('../php/c/2/menus/eliminar.php',{ id:id_menu }, '#btn_eliminar_menu','#row_menu_'+id_menu,'#modal_eliminar','Eliminando...','Confirmar');
    });
    /* ----------------------------- CONFIGURACIONES ---------------------------- */
    // DATOS DE LA CUENTA CONTROLADOR
    $(document).on("click","#btn_guardar_info_cuenta",function(){

        validar_formulario("#content_info input");

        if($("#content_info .is-invalid").length==0){
            var nombre_empresa=$("#nombre_empresa").val();
            var nombre_usuario=$("#nombre_usuario").val();
            var telefono_empresa=$("#telefono_empresa").val();
            var correo_empresa=$("#correo_empresa").val();
    
            peticion_ajax_1('../php/c/2/configuraciones/editar_config_cuenta.php', { nombre_empresa: nombre_empresa, nombre_usuario: nombre_usuario, telefono_empresa: telefono_empresa, correo_empresa: correo_empresa }, '#btn_guardar_info_cuenta');
        }

    });
    // CONTRASEÑA CONTROLADOR
    $(document).on("click","#btn_guardar_contrasena",function(){
        var contrasena=$("#contrasena").val();

        if(contrasena.length>0){
            peticion_ajax_1('../php/c/2/configuraciones/guardar_contrasena.php', { contrasena:contrasena }, '#btn_guardar_contrasena');
        }
    });
    // ACTIVAR / DESACTIVAR METODOS DE PAGO
    $(document).on("change","#estado_empresa_metodo_pago",function(e){
        var id_empresa_metodo_pago=$(this).data("id");
        var estado=$(this).val();

        $.ajax({
            type: "POST",
            url: '../php/c/2/configuraciones/cambiar_estado_metodo_pago.php',
            data: { id_empresa_metodo_pago:id_empresa_metodo_pago, estado:estado },
            beforeSend: function () {
                $(e.target).attr("disabled", true);
            },
            success: function (response) {
                show_message(response.title, response.message, response.status, response.time);
            },
            complete: function () {
                $(e.target).attr("disabled", false);
            }
        });
    });
    // GUARDAR KEYS METODOS DE PAGO CONTROLADOR
    $(document).on("click","#btn_guardar_keys_empresa_reparto",function(){
        validar_formulario("#content_keys input:not([type='search'])");

        if($("#content_keys .is-invalid").length==0){
            var paypal=$("#config_paypal").val();
            var stripe_public=$("#config_stripe_public").val();
            var stripe_secret=$("#config_stripe_secret").val();
            var mercado_pago=$("#config_mercado_pago").val();
            var id_banco=$("#id_banco").val();
            var num_transferencia=$("#num_transferencia").val();
            var num_deposito=$("#num_deposito").val();

            peticion_ajax_1('../php/c/2/configuraciones/guardar_keys_metodo_pago.php', { paypal: paypal, stripe_public:stripe_public, stripe_secret:stripe_secret, mercado_pago:mercado_pago, id_banco:id_banco, num_transferencia:num_transferencia, num_deposito:num_deposito }, '#btn_guardar_keys_empresa_reparto');
        }
    });
    // GUARDAR CONFIGURACIÓN AVANZADA CONTROLADOR
    $(document).on("click","#btn_guardar_config_avanzada",function(){
        validar_formulario("#content info input:not([type='search'])");

        if($("#content_info .is-invalid").length==0){
            var id_tipo_cambio=$("#id_tipo_cambio").val();
            var id_zona_horaria=$("#id_zona_horaria").val();
            var cuota_repartidor=$("#cuota_repartidor").val();
            var ordenes_maximas=$("#ordenes_maximas").val();
            var sucursales_express=$("#sucursales_express").val();
            var ordenes_punto_a_punto=$("#ordenes_punto_a_punto").val();
            var costo_minimo=$("#costo_minimo").val();
            var costo_por_km=$("#costo_por_km").val();
            peticion_ajax_1('../php/c/2/configuraciones/guardar_config_avanzada.php', { id_tipo_cambio: id_tipo_cambio, id_zona_horaria:id_zona_horaria, cuota_repartidor:cuota_repartidor, ordenes_maximas:ordenes_maximas, sucursales_express:sucursales_express, ordenes_punto_a_punto:ordenes_punto_a_punto, costo_minimo:costo_minimo, costo_por_km:costo_por_km }, '#btn_guardar_config_avanzada');
        }
    });
    /* ----------------------------- NOTIFICACIONES ----------------------------- */
    // SELECCIONAR NOTIFICACION
    $(document).on("click","#seleccionar_notificacion",function(){
        $(this).data("orden")>0 ? window.location.hash="#order_detail_"+$(this).data("orden") : void 0;
    });
    // BÚSQUEDA DE NOTIFICACIONES
    function notificaciones_sistema(){
        $.ajax({
            type: "POST",
            url: "../php/v/2/notificaciones/notificaciones.php",
            success: function (response) {
                response.total_row>0 ? $("#dot_notification").removeClass("d-none") : $("#dot_notification").addClass("d-none");
                $("#content_notificaciones").html(response.row);
            },
        });
    }
    /* ------------------------------- MENSUALIDAD ------------------------------ */
    // FACTURA
    $(document).on("click","#factura_mensualidad",function(){
        var total_actual=$(this).data("total");
        var total_nuevo = Math.abs(parseInt(total_actual));
        var iva = Math.abs((total_nuevo * 16) / 100);
        total_nuevo = Math.abs((total_nuevo + iva)).toFixed(2);

        $("#factura_mensualidad").is(':checked') ? $("#text_factura").text("$"+parseFloat(total_nuevo).toFixed(2)+"MXN") : $("#text_factura").text("$"+parseFloat(total_actual).toFixed(2)+"MXN");
    });
    // PROCEDER A PAGAR
    $(document).on("click","#proceder_pago_mensualidad",function(){
        var id_historial_pago=$(this).data("id");
        var factura=$("#factura_mensualidad").is(":checked") ? 1 : 0;
        var factura_text=$("#factura_mensualidad").is(":checked") ? 'Si' : 'No';

        var total_actual=$("#factura_mensualidad").data("total");
        var total_nuevo = Math.abs(parseInt(total_actual));
        var iva = Math.abs((total_nuevo * 16) / 100);
        total_nuevo = Math.abs((total_nuevo + iva)).toFixed(2);

        var monto_total=$("#factura_mensualidad").is(':checked') ? parseFloat(total_nuevo).toFixed(2) : parseFloat(total_actual).toFixed(2);

        get_view_main('mensualidad', 'pagar_mensualidad', { id_historial_pago:id_historial_pago, factura:factura, factura_text:factura_text, monto_total:monto_total }, "#main");
    });
    // STRIPE
    $(document).on("click","#btn_stripe",function(){
        loader("#content_metodos_pago");
    });
    // SUBIR COMPROBANTE DE TRANSFERENCIA
    $(document).on("click", "#btn_subir_comprobante_mensualidad", function () {
        var id_historial_pago = $(this).data("id");
        var factura = $(this).data("factura");
        var factura_text = $(this).data("factura_text");
        var monto_total = $(this).data("monto_total");
        var total_archivos_rechazados = myDropzone.getRejectedFiles().length;
        var total_archivos_en_fila = myDropzone.getQueuedFiles().length;

        /*
        // ARCHIVOS SELECCIONADOS
        myDropzone.getAcceptedFiles().length
        // ARCHIVOS RECHAZADOS POR EXTENSIÓN
        myDropzone.getRejectedFiles().length
        // ARCHIVOS EN COLA
        myDropzone.getQueuedFiles().length
        // ARCHIVOS SUBIENDO
        myDropzone.getUploadingFiles().length
        */

        if (total_archivos_rechazados == 0 && total_archivos_en_fila>0) {
            $.ajax({
                type: "POST",
                url: "../php/c/2/mensualidad/realizar_pago_transferencia.php",
                data: { id_historial_pago:id_historial_pago, factura:factura, factura_text:factura_text, monto_total:monto_total },
                beforeSend:function(){
                    loader("#content_metodos_pago");
                },
                success: function (respuesta) {
                    if (respuesta.status == "success") {
                        myDropzone.options.params = { 'sub_carpeta': id_historial_pago };
                        myDropzone.processQueue();
                    }
                    else {
                        muestraMensajeError(respuesta.msg);
                    }
                }
            });
        }
        else {
            total_archivos_rechazados>0 ? show_message('Extensión de imagen.','Por favor agregar un comprobante con extensión .jpeg, .jpg, .png','error',3000) : total_archivos_en_fila==0 ? show_message('No se encontró el comprobante.','Por favor agregar un comprobante.','error',1500) : void 0;
        }
    });
});
// FUNCIONES
function get_view_main(pathname, file, data, selector_main, show_loader) {
    $.ajax({
        type: "POST",
        url: "../php/v/2/" + pathname + "/" + file + ".php",
        data: data,
        beforeSend: function () {
            show_loader==undefined ? loader(selector_main) : void 0;
        },
        success: function (response) {
            $(selector_main).html(response);
        },
        complete: function () {
            $(selector_main).removeClass("disabledevent");
            $("#loader").remove();
        }
    });
}
function validar_formulario(selector) {
    $(selector).each(function () {
        if ($(this).val().length > 0) {
            $(this).removeClass("is-invalid");
        }
        else {
            $(this).addClass("is-invalid");
        }
    });
    $(selector + '.is-invalid:first').focus();
}
function peticion_ajax_1(url, data, id_button) {
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        beforeSend: function () {
            $(id_button).attr("disabled", true).text("Guardando...");
        },
        success: function (response) {
            show_message(response.title, response.message, response.status, response.time);
        },
        complete: function () {
            $(id_button).attr("disabled", false).text("Guardar cambios");
        }
    });
}
function show_message(title, message, status, time) {
    switch (status) {
        case 'success':
            var bgColor = "#a6efb8e6";
            break;

        case 'error':
            var bgColor = "#ffafb4e6";
            break;

        default:
            break;
    }
    iziToast.show({
        title: title,
        message: message,
        backgroundColor: bgColor,
        close: true,
        position: 'topRight',
        timeout: time,
    });
}
function loader(selector){
    $(selector).addClass("disabledevent").append('<div id="loader" class="spinner-grow" role="status" style="position:absolute; left:0; right:0; top:0; bottom:0; margin:auto">'+
        '<span class="sr-only">Loading...</span>'+
    '</div>');
}
function visor_pdf(url_pdf, titulo_pdf) {
    $.ajax({
        type: "POST",
        url: '../php/v/0/visores/visor_pdf.php',
        data: 'url_pdf=' + url_pdf,
        beforeSend: function(){
            $("#full_modal_title").text(titulo_pdf);
        },
        success: function (respuesta) {
            $("#full_content").html(respuesta);
            $("#full_modal").modal("show");
        }
    });
}
function visor_google(url_documento, titulo_documento) {
    $.ajax({
        type: "POST",
        url: '../php/v/0/visores/visor_google.php',
        data: 'url_documento=' + url_documento + '&titulo_documento=' + titulo_documento,
        success: function (respuesta) {
            $("#full_content").html(respuesta);
            $("#full_modal").modal("show");
        }
    });
}
function delete_row(url,data,id_button,id_row,id_modal,text_b,text_a){
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        beforeSend: function () {
            $(id_button).attr("disabled", true).text(text_b);
        },
        success: function (response) {
            show_message(response.title, response.message, response.status, response.time);
            if(response.status=="success"){
                $(id_row).remove();
            }
        },
        complete: function () {
            $(id_button).attr("disabled", false).text(text_a);
            $(id_modal).modal("hide");
        }
    });
}
var myDropZone;
var img_data_url_global_dropzone;
function cropper_dropzone(selector,accepted_files,max_files,request,carpeta,subcarpeta,width,height){
    // DROPZONE
    var cropper_modal;
    var boleean_dropzone=false;
    myDropZone = new Dropzone(selector, {
        maxFilesize: 10,
        acceptedFiles: accepted_files,
        addRemoveLinks: true,
        maxFiles: max_files,
        parallelUploads: max_files,
        dictDefaultMessage: "<h6>Suelte los archivos aquí o de click</h6>",
        dictRemoveFile: '<span class="material-icons-round">delete_forever</span>',
        dictCancelUpload: 'Cancelar',
        url: "../php/c/0/upload.php",
        removedfile: function(file) {
            var fileName = file.name;
            $.ajax({
                type: 'POST',
                url: '../php/c/0/upload.php',
                data: {
                    name: fileName,
                    carpeta: carpeta,
                    subcarpeta: subcarpeta,
                    request: 'cropper_dropzone_delete'
                },
                sucess: function(data) {
                    console.log('success: ' + data);
                }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        init: function() {
            this.on("sending", function(file, xhr, formData) {
                formData.append("request", request);
                formData.append("carpeta", carpeta);
                formData.append("subcarpeta", "user_" + subcarpeta);
            });
            this.on('resetFiles', function() {
                this.removeAllFiles();
            });
        },
        transformFile: function(file, done) {
            var editor_cropper = document.createElement("div");
            editor_cropper.style.width = '100%';
            editor_cropper.style.height = 'auto';
            editor_cropper.style.backgroundColor = "#000";

            var image = new Image();
            image.src = URL.createObjectURL(file);
            image.style.width = "100%";
            editor_cropper.appendChild(image);
            $("#modal_cropper .modal-body").html(editor_cropper);
            $("#modal_cropper").modal("show");

            $('#modal_cropper').on('shown.bs.modal', function() {

                var minCroppedWidth = width;
                var minCroppedHeight = height;
                var maxCroppedWidth = width;
                var maxCroppedHeight = height;
                cropper_modal = new Cropper(image, {
                    dragMode: 'none',
                    autoCropArea: 0.65,
                    restore: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    cropBoxMovable: true,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    zoomable: false,
                    background: false,
                    data: {
                        width: (minCroppedWidth + maxCroppedWidth) / 2,
                        height: (minCroppedHeight + maxCroppedHeight) / 2,
                    },
                });
                boleean_dropzone=false;
            }).on('hidden.bs.modal', function() {
                cropper_modal.destroy();
                if(boleean_dropzone==false){
                    myDropZone.disable();
                    myDropZone.removeAllFiles();
                    myDropZone.enable();
                }
            });

            $("#btn_cropper").on("click", function() {
                boleean_dropzone=true;
                var canvas = cropper_modal.getCroppedCanvas();

                canvas.toBlob(function(blob) {
                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false,
                        function(dataURL) {
                            // myDropZone.emit("thumbnail", file, dataURL);
                            done(blob);
                            img_data_url_global_dropzone=dataURL;
                        }
                    );
                });
                $("#modal_cropper").modal("hide");
            });
        }
    });
}
var file_name_upload;
function uploadfiles(carpeta, subcarpeta, request) {

    var retorno = "";
    $.ajax({
        type: 'POST',
        url: "../php/c/0/upload.php",
        data: { carpeta: carpeta, subcarpeta: subcarpeta, request: request },
        async: false,
        success: function (respuesta) {
            retorno = respuesta.status;
            file_name_upload=respuesta.file_name;
        }
    });

    return retorno;
}
function obtener_atributo_select(id_select, atributo, retorno) {
    var valores='';
    if(retorno==1){
        valores = $('option:selected', id_select).attr(atributo);
    }
    else{
        $('option:selected', id_select).each(function(){
            valores+=$(this).attr(atributo)+', ';
        });
        valores=valores.trim();
        valores=valores.substring(0, valores.length - 1);
    }

    return valores;
}
function marker_hash(type,id){
    type=="repartidor" ? window.location.hash='info_conductor_'+id : window.location.hash='sucursal_'+id;
}
function phone_format(string) {
    var out = '';
    var filtro = '1234567890';

    for (var i = 0; i < string.length; i++) {
        if (filtro.indexOf(string.charAt(i)) != -1) {
            out += string.charAt(i);
        }
    }
    return out;
}
function price_format(string) {
    var out = '';
    var filtro = '1234567890.';

    for (var i = 0; i < string.length; i++) {
        if (filtro.indexOf(string.charAt(i)) != -1) {
            out += string.charAt(i);
        }
    }
    return out;
}
function string_format(string) {
    var out = '';
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ.,@1234567890 ';

    for (var i = 0; i < string.length; i++) {
        if (filtro.indexOf(string.charAt(i)) != -1) {
            out += string.charAt(i);
        }
    }
    return out;
}
function name_format(string) {
    var out = '';
    var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ ';

    for (var i = 0; i < string.length; i++) {
        if (filtro.indexOf(string.charAt(i)) != -1) {
            out += string.charAt(i);
        }
    }
    return out;
}
function email_format(correo) {
    var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

    if (regex.test(correo)) {
        return 'success';

    } else {
        return 'error';
    }
}
function calcular_tiempo() {
    $( "[fecha-hora]" ).each(function(){
        $(this).html(moment($(this).attr('fecha-hora')).fromNow());
    });
}