$(window).bind("load", function() {

	$(".field-gallery").on('dragenter', function (e) {
		e.preventDefault();
		$(this).parent().css('background', '#ddd');
	});

	$(".field-gallery").on('dragover', function (e) {
		e.preventDefault();
	});

	$(".field-gallery").on('drop', function (e) {
		$(this).parent().css('background', '#eee');
		e.preventDefault();
		var image = e.originalEvent.dataTransfer.files;
		for (i = 0; i < image.length; i++) {
			createFormData(image[i]);
		}
	});

	$(".file-gallery").on('change', function (e) {
		var image = e.target.files;
		for (i = 0; i < image.length; i++) {
			createFormData(image[i]);
		}
		$(this).val('');
	});

	function createFormData(image) {
		var formImage = new FormData();
		formImage.append('photo', image);
		formImage.append('field_id', $('#field_id').val());
		uploadFormData(formImage);
	}

	function uploadFormData(formData) {
		$.ajax({
			url: baseUrl+"/field/gallery",
			type: "POST",
			data: formData,
			contentType:false,
			cache: false,
			processData: false,
			success: function(data){
				try {
					var data = JSON.parse(data);
					var imgPath = baseUrl+'/assets/images/uploads/'+data['filename'];
					var setmain = '<a class="setmain btn btn-sm btn-primary" href="#" data-id="'+data['id']+'">Set main</a>';
					var del = '<a class="delete btn btn-sm btn-danger" href="#" data-id="'+data['id']+'">Hapus</a>';
					var input = '<input type="hidden" name="gallery[]" value="'+data['id']+'">';

					var feedback = '<div class="thumbnail pull-left text-center m-10"><a href="'+imgPath+'" target="_blank"><img src="'+imgPath+'" alt="'+data['filename']+'"><!-- <div class="caption"><p>Lorem ipsum...</p></div> --></a>'+ setmain + del +'</div>'+input;
					// '<div class=""><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> '+aa['filename']+'</div>';

					if ($('.field-gallery .content .thumbnail').length == 0) {
						$('.field-gallery .content').html(feedback);
					} else {
						$('.field-gallery .content').append(feedback);
					}
				} catch (e) {
					$('.modal-body').html(data);
					$('#modal-danger').modal();
				}

				init();
			}
		});
	}

	function init() {
		$('.delete').click(function(e) {
			e.preventDefault();
			// $(this).parents('.thumbnail').remove();
			$.ajax({
				url: baseUrl+"/field/gallery/delete", 
				type: "POST",
				data: {
					field_id:$('#field_id').val(),
					id:$(this).attr('data-id'),
				},
				success: function(data) {
					$('.field-gallery .content').html(data);
					init();
				}
			});
		});

		$('.setmain').click(function(e) {
			e.preventDefault();
			$('.setmain').removeClass('ismain disabled btn-default');
			$('.setmain').addClass('btn-primary');
			$('.setmain').text('Set main');
			$(this).removeClass('btn-primary');
			$(this).addClass('ismain disabled btn-default');
			$(this).text('Main');
			$.ajax({
				url: baseUrl+"/field/gallery/setmain", 
				type: "POST",
				data: {
					field_id:$('#field_id').val(),
					id:$(this).attr('data-id'),
				}
			});
		});
	}

	init();
});