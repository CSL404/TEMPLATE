$(function () {
    $('[title="tooltip"]').tooltip()
});

function mayusculas(e) {
    e.value = e.value.toUpperCase();
}


function coloca_icono(tipo){

    const icon = {
        "0": `<a href="javascript:;" class="btn btn-sm btn-info m-b-10"><i class="fa fa-ban t-plus-1 fa-fw fa-lg"></i> CANCELADA</a>`,
        "1": `<a href="javascript:;" class="btn btn-sm btn-info m-b-10"><i class="fa fa-spinner fa-spin  t-plus-1 fa-fw fa-lg"></i> PENDIENTE</a>`,
        "2": `<a href="javascript:;" class="btn btn-sm btn-info m-b-10"><i class="fa fa-lock t-plus-1 fa-fw fa-lg"></i> CERRADA</a>`,
    }

    return icon[tipo];

}


function genera_tabla() {
    $('#data-table-buttons').DataTable({
        dom: "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-6'B><'col-md-6'p>><'row'<'col-md-12't>><'row'<'col-md-12'i>>",
        buttons: [
            { extend: 'copy', text:'<i class="fas fa-copy fa-lg"></i>',titleAttr: 'Copiar' },
            { extend: 'csv',  fieldSeparator: ';' , text:'<i class="fas fa-file fa-lg"></i>',titleAttr: 'CSV' },
            { extend: 'excel', text:'<i class="fas fa-file-excel fa-lg"></i>',titleAttr: 'Excel' },
            { extend: 'pdf', orientation: 'landscape', text:'<i class="fas fa-file-pdf fa-lg"></i>',titleAttr: 'PDF' },
            { extend: 'print',  text:'<i class="fas fa-print fa-lg"></i>',titleAttr: 'Imprimir' }
        ],
        responsive: true,
        "autoWidth": false,
        "language": {
            buttons: {
                copySuccess: {
                    1: "Copió una fila al portapapeles",
                    _: "Se copiaron %d filas al portapapeles"
                },
                copyTitle: 'Datos Copiados'
            },
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
        "order": [[ 0, "desc" ]]
    });
}


function tipo_elemento({tipo, id, required}){

    requerido = (required)? '': '';
    const campo = {
        text: `<input type="text" class="form-control" name="${id}" id="${id}" ${requerido}>`,
        checkbox: `<input type="checkbox" name="${id}" id="${id}" ${requerido}>`,
        select: `<select class="form-control" name="${id}" id="${id}" ${requerido}></select>`,
        number: `<input type="number" class="form-control" name="${id}" id="${id}" ${requerido}>`
    }
    return campo[tipo];
}





function cancelar(id){

    swal({
        title: "¿Estas seguro de cancelar la solicitud?",
        text: "Si cancelas la solicitud esta se cerrara y pasara al apartado de histórico.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        buttons: ["Cerrar", "Si, estoy seguro"],
    }).then(( willDelete ) => {
        if ( willDelete ) {
            $.ajax({
                type: 'DELETE',
                url: $('#boton_cancelar_'+id ).attr('data_url'),
                data: {_token:$('meta[name="csrf-token"]').attr('content'), id: id},
                dataType: 'json',
                success: function (response) {
                    if ( response.error ) {
                        swal('Mensaje', 'Ocurrio un problema intenta de nuevo', 'error');
                    } else {
                        $('#data-table-buttons').DataTable().row('#registro_'+id).remove().draw()
                        swal('Solicitud cancelada correctamente', 'Dicha solicitud se encuentra en el apartado de histórico.', 'success');
                    }
                }
            });
        }
    });
}


function expotar(id, accion){

    swal({
        title: ( accion == true )? '¿Estas seguro de exportar?': '¿Quieres volver a exportar la solicitud?',
        text: ( accion == true )? 'Al momento de exportar la solicitud se cerrará y estará en el apartado de histórico.': '',
        icon: 'info',
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: {
            cancel: {
                text: 'Cerrar',
                value: null,
                visible: true,
                className: 'btn btn-default',
                closeModal: true,
            },
            confirm: {
                text: 'Si, seguro',
                value: true,
                visible: true,
                className: 'btn btn-info',
                closeModal: true
            }
        }
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({
                type: 'POST',
                url: $('#exportar_'+id ).attr('data_url'),
                data: { _token:$('meta[name="csrf-token"]').attr('content'), id:id, accion:accion},
                success: function(response) {
                    
                    if( response.error ){
                        swal('Mensaje', 'Ocurrio un problema intenta de nuevo', 'error');
                    } else {
                        datos = JSON.parse(response.completado[0].estructure);
                        
                        cabecera = `"Product Type"\t`;
                        valor = `"product"\t`;
                        for (let i = 0; i < response.areas.length; i++) {
                            area = response.areas[i].description.replace('ó', 'o');
                            area = area.replace('í', 'i');
         
                            for (let j = 0; j < datos[area].length; j++) {
                                //cabecera += datos[area][j].odoo.replace('__', '/') + ",";
                                cabecera += `"${datos[area][j].Modelo.replace('__', '/')}"\t`;
                                val = datos[area][j].value;
                                if(datos[area][j].type.toString() == "checkbox"){
                                    val = (datos[area][j].value.toString() == "on")? 1: 0;
                                }
                                
                                valor += val+ "\t";
                                
                                if(datos[area][j].Modelo.replace('__', '/') == "Unit of Measure / Database ID"){
                                    cabecera += `"Purchase Unit of Measure / Database ID"\t`;
                                    valor += val+ "\t";
                                }
                                                
                            }
                        }


                        let d = new Date()
                        let nombre =  `SOL-${id}_${response.completado[0].product_name.replaceAll(' ', '')}_${d.getDate()}_${(d.getMonth()+1)}_${d.getFullYear()}.csv`;

                        contenido = cabecera.substring(0, cabecera.length - 1) + "\n" + valor.substring(0, valor.length - 1);
                        crear_csv(nombre, contenido);
                        if ( accion ) {
                           $('#data-table-buttons').DataTable().row('#registro_'+id).remove().draw()
                        }
                    }
                }
            });     
        }
    }); 
}



function crear_csv(nombre, contenido) {

	//comprobamos compatibilidad
	if(window.Blob && (window.URL || window.webkitURL)){
		let blob, save, clicEvent;

		//creamos el blob
		blob =  new Blob([contenido], {type: 'text/csv;charset=UTF-8'});
		//creamos el reader
		let reader = new FileReader();
		reader.onload = function (event) {
			//escuchamos su evento load y creamos un enlace en dom
			save = document.createElement('a');
			save.href = event.target.result;
			save.target = '_blank';
			//aquí le damos nombre al archivo
			save.download = nombre;
			try {
				//creamos un evento click
				clicEvent = new MouseEvent('click', {
					'view': window,
					'bubbles': true,
					'cancelable': true
				});
			} catch (e) {
				//si llega aquí es que probablemente implemente la forma antigua de crear un enlace
				clicEvent = document.createEvent("MouseEvent");
				clicEvent.initEvent('click', true, true);
			}
			//disparamos el evento
			save.dispatchEvent(clicEvent);
			//liberamos el objeto window.URL
			(window.URL || window.webkitURL).revokeObjectURL(save.href);
		}
		//leemos como url
		reader.readAsDataURL(blob);
	}else {
		//el navegador no admite esta opción
		alert("Su navegador no permite esta acción");
	}
    
}
