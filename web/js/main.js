$(window).on('load', function() {
    $(document).ready(function() {
        $("#lightgallery").lightGallery({
            selector: '.thumbnail'
        });
    });
	
	
	$('button.btn.btn-success').click(function(e){
		
		$.ajax(
		{
			url: "/cart/add", 
			//dataType: 'text',
			type: 'get',
			//contentType: 'application/json',
			data: {
				price: $(this).data( "price" ),
				marka: $(this).data( "marka" ),
				model: $(this).data( "model" )
			},
			success: function(result){				
				showCart(result);
			},
			error: function(){
				console.log('Ajax error');
			}
		});
	});
	
	// console.log('aaaa');
	
		function showCart(txt){
			$('#cart .modal-body').html(txt);
			$( "#cartpic" ).load(location.href + " #cartpic");
			$('#cart').modal();
			localStorage.rez = txt;
			console.log('rezshowxart', localStorage.rez);
		}
		
		
		$('#clearCart').click(function(e){
			$.ajax(
			{
				url: "/cart/clear", 
				//dataType: 'text',
				type: 'get',

				success: function(result){

					showCart(result);
				},
				error: function(){
					console.log('Ajax error');
				}
			});
		});
		
		
		$('#cart .modal-body').on('click', '.fa-window-close', function(){
			// var i = $(this).data('i');
				$.ajax(
				{
				url: "/cart/del-item", 
				//dataType: 'text',
				type: 'get',
				//contentType: 'application/json',
				data: {
					i: $(this).data('i')
				},
				success: function(result){
					//$("#div1").html(result);
					//console.log(result);
				//	$( "#cartpic" ).load(location.href + " #cartpic");
					showCart(result);
				},
				error: function(){
					console.log('Ajax error');
				}
			});
		});
		
		$('#cartpic').on('click', function(){
			//console.log('click');
			//console.log('localStorage.rez', localStorage.rez);
			showCart(localStorage.rez);
		});
		
		

});