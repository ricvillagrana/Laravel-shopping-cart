$(document).ready(function(){

	//
	//Search
	//
	$('#search-button').on('click',function(){
		window.location.replace("/productos/buscar/" + $('#query-search').val())
	});
	$('#query-search').keypress(function (e) {
	  if (e.which == 13) {
	  	window.location.replace("/productos/buscar/" + $('#query-search').val())
	  }
	});

	//
	//	Añade al carrito de compra y manda notificación de ello
	//
	$('.add-cart').on('click',function(){
		var cant = $('#cantidad-product').val(); // En la vista producto.ver se puede seleccionar la cantidad del producot a añadir
		if(cant == null)
			cant = 1; // Catidad default 1 por si no está en la vista producto.ver
		$.get( "/ajax/addCart/"+$(this).attr('id')+"/"+cant).done(function( data ) { // Función AJAX hacia el controlador ShoppingCart
			if(data=="nouser"){
				notify("Sesión","Debes iniciar sesión primero.","error")
			}else{
				var last = data.charAt(data.length-1);
				if(last == 'E'){
					data = data.slice(0, data.length-1);
					notify("Carrito","Haz llegado al límite de este producto en tu carrito","warning")
				}
				else{
					if(cant>1)
						notify("Carrito",cant+" productos agregados.","success")
					else
						notify("Carrito","Producto agregado.","success")
				}
				$('#amount-total').html(data);
			}
		});
	})
	//
	//	Pasa el ID a la vista de edición para poder ser modificado previamente
	//
	$('.edit-product').on('click', function(){
		$.get( "/ajax/getRank/"+$(this).attr('id')).done(function( data ) { // Función AJAX hacia el controlador ShoppingCart
			var rank = data.split(',');
			$('#cantidad-product').attr('min',rank[0]+1);
			$('#cantidad-product').attr('max',rank[1]);
		});
		$('.delete-hide').css('display','block')
		$('#product-id').text($(this).attr('id'))
		$('.product-edited').attr('id',$(this).attr('id'))		// El ID se le asigna al botón Editar para ser usado al accionarlo
		$('.product-deleted').attr('id',$(this).attr('id'))		// El ID se le asigna al botón Eliminar para ser usado al accionarlo
	})
	// Botón de edición del carrito
	$('.product-edited').on('click',function(){
		var cant = $('#cantidad-product').val()
		$.get( "/ajax/editProduct/"+$(this).attr('id')+"/"+cant).done(function( data ) { // Función AJAX hacia el controlador ShoppingCart
			$('#amount-total').html(data);
			window.location.replace("http://"+$(location).attr('host')+"/productos/carrito");
		});
	})
	// Botón de eliminación del carrito
	$('.product-deleted').on('click',function(){
		$.get( "/ajax/deleteProduct/"+$(this).attr('id')).done(function( data ) { // Función AJAX hacia el controlador ShoppingCart
			$('#amount-total').html(data);
			window.location.replace("http://"+$(location).attr('host')+"/productos/carrito");
		});
	})


	// Esconde el panel de edición en caso de darse click uera de él
	$('.blank').on('click',function(){ 
		$('.delete-hide').css('display','none')
	})



	$('#del-cart').on('click',function(){
		swal({
		  title: '¿Estás seguro?',
		  text: "El carrito se vaciará y perderás todo lo que ya tienes en él.",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Sí, vaciar',
		  cancelButtonText: 'Cancelar',
		  confirmButtonClass: 'btn btn-success',
		  cancelButtonClass: 'btn btn-danger',
		  buttonsStyling: false
		}).then(function () {

			var id = $(this).attr('id');
			$.get( "/ajax/delCart").done(function( data ) {
				$('#amount-total').html(data);
				notify("Carrito","Se removieron los artículos del carrito.","success")
				$('#no-carrito').css('display','block')
				$('#products-amount').html('0')
				$('#si-carrito').css('display','none')
			})
		  	swal(
			    '¡Se vació!',
			    'Tu carrito ahora está vacío',
				'success'
			 )
		}, function (dismiss) {
		  // dismiss can be 'cancel', 'overlay',
		  // 'close', and 'timer'
		  if (dismiss === 'cancel') {
		    swal(
		      'Cancelado',
		      'Tu carrito está intacto.',
		      'error'
		    )
		  }
		})
	})
});
function notify(title, body){
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-bottom-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "300",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	toastr.info(body ,title);
}
function notify(title, body, type){
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-bottom-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "300",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	switch(type){
		case "success":
			toastr.success(body, title)
			break;
		case "info":
			toastr.info(body, title)
			break;
		case "warning":
			toastr.warning(body, title)
			break;
		case "error":
			toastr.error(body, title)
			break;
		default:
			toastr.info(body, title)
			break;
	}
}
