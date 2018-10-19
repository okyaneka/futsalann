$(window).bind("load", function() {

	$('.custom-prices .add-row').click(function() {

		var priceData 	= $('.custom-prices tbody tr');
		if (priceData.find('.price-id').length > 0) {
			var id 		= parseInt(priceData.find('.price-id').last().val()) + priceData.length;
		} else /*(priceData.add('.price-id').length == 0)*/ {
			var id 		= priceData.length;
		} 

		var select 		= '<td><select disabled name="price['+id+'][type]" style="width: 8em"></select></td>';
		var range 		= '<td><input type="time" name="price['+id+'][start]">s/d<input type="time" name="price['+id+'][end]"></td>';
		var price 		= '<td><span>[+]</span><input type="number" name="price['+id+'][price]" style="width: 5em"></td>';
		var priority	= '<td><input type="number" name="price['+id+'][priority]" style="width: 3em"></td>';
		var action 		= '<td><a class="action-link text-danger del-row" href="#">del</a></td>';

		$('.custom-prices tbody').append('<tr>'+select+range+price+priority+action+'</tr>');

		$.getJSON(baseUrl+"/api/get_price_types", function(result){
		    $.each(result, function(i, field){
		        $(".custom-prices tbody select").append('<option value="'+field.id+'">'+field.name+'</option>');
		    });
		});

		init();

	});

	$('.resource .add-row').click(function() {

		var resData 	= $('.resource tbody tr');
		if (resData.add('.res-id').length == 0) {
			var id 		= resData.length;
		} else {
			var id 		= parseInt(resData.find('.res-id').last().val()) + resData.length;
		}

		var name 		= '<td><input type="text" name="res['+id+'][name]"></td>';
		var price 		= '<td><span>[+]</span><input type="number" name="res['+id+'][price]"></td>';
		var action 		= '<td><a class="action-link text-danger del-row" href="#" style="width:3em">del</a></td>';

		$('.resource tbody').append('<tr>'+name+price+action+'</tr>');

		init();

	});

	$('.facility .add-facility').click(function() {
		var facWell	= $('.facility .well');
		var facForm	= $('.facility-input');
		var fac		= facWell.children('input');

		isDuplicate = false;
		
		if (facForm.val() == '') {
			facForm.attr('data-original-title','Fasilitas tidak boleh kosong!!');
			facForm.attr('title','Fasilitas tidak boleh kosong!!');
			facForm.tooltip();
			facForm.focus();
		} else {

			for (i = 0; i < fac.length; i++) {
				if (facForm.val().toLowerCase() == fac[i].value.toLowerCase()) {
					isDuplicate = true;
				}
			}

			if (isDuplicate == true) {
				facForm.attr('data-original-title','Fasilitas sudah dimasukkan!!');
				facForm.attr('title','Fasilitas sudah dimasukkan!!');
				facForm.tooltip();
				facForm.focus();
			} else {
				console.log(fac);
				if (fac.length == 0) {
					var id = 1;

					var facility = '<p class="p-x-10 facility-name facility-'+id+'">'+facForm.val()+'<a class="remove-facility remove-facility-'+id+' m-l-10" href="#"><span class="badge">x</span></a></p>';

					facWell.html(facility);
				} else {
					var lastFac		= fac.last();
					var lastFacClass= lastFac.attr('class');
					var lastId		= lastFacClass.replace('facility-form facility-','');
					console.log(lastId);
					var id 			= parseInt(lastId) + 1;

					var facility = '<p class="p-x-10 facility-name facility-'+id+'">'+facForm.val()+'<a class="remove-facility remove-facility-'+id+' m-l-10" href="#"><span class="badge">x</span></a></p>';

					facWell.append(facility);
				}

				facForm.attr('data-original-title','');

				facForm.attr('title','');

				input 	= '<input class="facility-form facility-'+id+'" type="hidden" name="facility['+id+']" value="'+facForm.val()+'">';

				facWell.append(input);

				init();
			}
		}

		facForm.val('');
	});

	$('.equal-to-user-address').click(function(e) {
		var address = $('.address input[type="text"]');

		if ($(this)[0].checked == true) {
			$.getJSON(baseUrl+"/api/get_user_address", function(result){
				$('#street').val(result.street);
				$('#district').val(result.district);
				$('#city').val(result.city);
				$('#zip').val(result.zip);

				var street = '<input name="address[street]" type="hidden" value="'+result.street+'">';
				var district = '<input name="address[district]" type="hidden" value="'+result.district+'">';
				var city = '<input name="address[city]" type="hidden" value="'+result.city+'">';
				var zip = '<input name="address[zip]" type="hidden" value="'+result.zip+'">';

				$('.address').append(street+district+city+zip);
			});


			address.attr('disabled','');
		} else {
			$('.address input[type=hidden]').remove();
			address.val('');
			address.removeAttr('disabled');

		}
	});

	$('.check-all').on('click', function () {
		$(this).parents('table').find('tbody :checkbox').prop('checked',this.checked);
	});

	$('tbody :checkbox').on('click', function () {
		
	});

	function init() {
		$('.remove-facility').click(function(e) {
			var remClass	= $(this).attr('class');
			var facClass 	= remClass.split(' ')[1];
			var facId		= facClass.replace('remove-facility-','');

			$('input.facility-'+facId).remove();
			$('p.facility-'+facId).remove();

			if ($('.facility .well input').length == 0) {
				$('.facility .well').append('Belum terdapat fasilitas');
			}
		});

		$('a[href="#"]').click(function(e){
			e.preventDefault();
		});

		$('.del-row').click(function(e) {
			var id = $(this).parents('tr').find('.price-id').val();
			$(this).parents('tr').remove();
		});
	}

	init();

})