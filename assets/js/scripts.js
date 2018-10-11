$(document).ready(function() {
	// affix
	$('#header').affix({offset:{top:$('.banner-content button').offset().top}});
	$("#header").on('affix.bs.affix', function(){
		$(this).addClass('animated slideInDown');
		$(this).find('.search').removeClass('hidden');
    });
    $('#header').on('affix-top.bs.affix', function(){
    	$(this).removeClass('animated slideInDown');
		$(this).find('.search').addClass('hidden');
    });


	// $('#sandbox-container .input-group.date').datepicker({
	// 	maxViewMode: 2,
	// 	todayBtn: "linked",
	// 	language: "id"
	// });	

	// // Calendar

	// var calendar = {};

	// var thisMonth = moment().format('YYYY-MM');

	// var eventArray = [];

	// calendar = $('.calendar').clndr({
	// 	ready: function (e) {
	// 		setup();
	// 	},
	// 	clickEvents: {
	// 		nextMonth: function () {
	// 			setup();
	// 		},
	// 		previousMonth: function () {
	// 			setup();
	// 		},
	// 		click: function (target) {
	// 			// console.log(target.date);
	// 			$('.day').removeClass('selected');
	// 			if ($(target.element).hasClass('past') == false) {
	// 				$(target.element).addClass('selected');
	// 				$('#res').val($('#resource').val());
	// 				$('#time').val('');
	// 				$('button').prop('disabled', true);
	// 				$('#date').val(target.date._i);
	// 				$('.price').text('');
	// 				availability();
	// 			}
	// 		},
	// 	},
			
 //      // today: function (month) {
 //      //     console.log('today');
 //      // },
 //      // nextYear: function (month) {
 //      //     console.log('next year');
 //      // },
 //      // nextMonth: function (month) {
 //      //     console.log('next month');
 //      // },
 //      // previousYear: function (month) {
 //      //     console.log('previous year');
 //      // },
 //      // onYearChange: function (month) {
 //      //     console.log('on year change');
 //      // },
 //      // previousMonth: function (month) {
 //      //     console.log('previous month');
 //      // },
 //      // onMonthChange: function (month) {
 //      //     console.log('on month change');
 //      // }
 //    	daysOfTheWeek: ['M','S','S','R','K','J','S'],
	// });

	// $("#duration").change(function(e) {
	// 	if ($('#date').val() != false) {
	// 		availability();
	// 	}
	// 	$('#time').val('');
	// 	$('.price').text('');
	// });

	// $("#resource").change(function(e) {
	// 	$('.day').removeClass('selected');
	// 	$('#date').val('');
	// 	$('#res').val($('#resource').val());
	// 	$('#time').val('');
	// 	$('.time').html('');
	// 	$('.price').text('');
	// 	$('button').prop('disabled', true);
	// });

	// function setup() {
	// 	$(".clndr-table").addClass("table text-center");

	// 	$(".clndr-previous-button").html("<i class=\"fa fa-angle-left\"></i>");
	// 	$(".clndr-next-button").html("<i class=\"fa fa-angle-right\"></i>");

	// 	$(".clndr-previous-button").addClass('btn btn-default');
	// 	$(".clndr-next-button").addClass('btn btn-default');

	// 	$(".clndr-controls").addClass("text-center");	
	// };

	// function availability() {
	// 	$.post('/futsal/field/availability',{
	// 		date:$('#date').val(),
	// 		duration:$("#duration").val(),
	// 		sku:$('#sku').val(),
	// 		res:$('#res').val(),
	// 		resname:$('#resname').val()
	// 	},function(data, status){
	// 		// alert("Data: " + data + "\nStatus: " + status);
	// 		date = JSON.parse(data);
	// 		i = 0;
	// 		text = "";
	// 		while(date[i]){
	// 			text += '<div class="col-xs-4"><div class="text-center"><div class="radio time"><label><input type="radio" name="time" value="'+date[i]+'">'+date[i]+'</label></div></div></div>';
	// 			i++;
	// 		}
	// 		$(".time").html(text);
	// 		$(".radio.time").click(function(e) {
	// 			$('button').prop('disabled', false);
	// 			price();
	// 		});
	// 	});
	// }

	// function price() {
	// 	$.post('/futsal/field/price',{
	// 		id:$('#id').val(),
	// 		date:$('#date').val(),
	// 		duration:$("#duration").val(),
	// 		res:$('#resource').val(),
	// 		time:$('input[name=time]:checked').val()
	// 	},function(data, status) {
	// 		data = JSON.parse(data);
	// 		// alert("Data: " + data + "\nStatus: " + status);
	// 		$('.price').text('Harga: Rp '+data[1]);
	// 		$('#price').val(data[0]);
	// 	});
	// }
});