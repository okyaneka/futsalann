$(document).ready(function() {

	$(".field-gallery").on('dragenter', function (e) {
		e.preventDefault();
		$(this).css('background', '#ddd');
	});

	$(".field-gallery").on('dragover', function (e) {
		e.preventDefault();
	});

	$(".field-gallery").on('drop', function (e) {
		$(this).css('background', '#eee');
		e.preventDefault();
		var image = e.originalEvent.dataTransfer.files;
		for (i = 0; i < image.length; i++) {
			createFormData(image[i]);
		}
	});

	function createFormData(image) {
		var formImage = new FormData();
		formImage.append('photo', image);
		formImage.append('field_id', $('#field_id').val());
		uploadFormData(formImage);
	}

	function uploadFormData(formData) {
		$.ajax({
			url: "http://127.0.0.1/futsal/field/gallery",
			type: "POST",
			data: formData,
			contentType:false,
			cache: false,
			processData: false,
			success: function(data){
				var data = JSON.parse(data);
				var imgPath = 'http://127.0.0.1/futsal/assets/images/uploads/'+data['filename'];
				var setmain = '<a class="setmain btn btn-sm btn-primary" href="#" data-id="'+data['id']+'">Set main</a>';
				var del = '<a class="delete btn btn-sm btn-danger" href="#" data-id="'+data['id']+'">Hapus</a>';
				var input = '<input type="hidden" name="gallery[]" value="'+data['id']+'">';

				var feedback = '<div class="thumbnail pull-left text-center m-10"><a href="'+imgPath+'" target="_blank"><img src="'+imgPath+'" alt="'+data['filename']+'"><!-- <div class="caption"><p>Lorem ipsum...</p></div> --></a>'+ setmain + del +'</div>'+input;
				// '<div class=""><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> '+aa['filename']+'</div>';

				if ($('.field-gallery .thumbnail').length == 0) {
					$('.field-gallery').html(feedback);
				} else {
					$('.field-gallery').append(feedback);
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
				url: "http://127.0.0.1/futsal/field/gallery/delete", 
				type: "POST",
				data: {
					field_id:$('#field_id').val(),
					id:$(this).attr('data-id'),
				},
				success: function(data) {
					$('.field-gallery').html(data);
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
				url: "http://127.0.0.1/futsal/field/gallery/setmain", 
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