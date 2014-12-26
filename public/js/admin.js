$(function () {
	//删除电影
	var flag = true;
	$('.del').on('click', function (e) {
		var target = $(e.target);
		var movie_id = target.attr('data-id');
		var tr = target.parent().parent();
		$.ajax({
			type: 'POST',
			data: {movie_id: movie_id},
			url: 'delete',
			beforeSend: function () {
				flag = false;
			},
			success: function (response, status) {
				flag = true;
				if (status == 'success') {
					response.status == 200 ? tr.length > 0 ? tr.remove() : '' : alert('failed');
				};
			}
		})
	})

	var type = $('input:radio[name="movie_type"]')

	$('#douban').blur(function () {
		if ($('#douban').val().length > 0) {
			type.attr('disabled', true)
		} else {
			type.attr('disabled', false)
		}
	})

	type.change(function (event) {
		var boolCheck = $(this).is(":checked");
		if (boolCheck) {
			$('#douban').attr('disabled', true);
		}
	})

	// 调用豆瓣电影API
	$('#douban').blur(function (event) {
		var douban = $(this);
		var id = douban.val();
		/* Act on the event */
		if (id) {
			$.ajax({
				url: "https://api.douban.com/v2/movie/" + id,
				cache: true,
				type: "GET",
				dataType: "jsonp",
				crossDomain: true,
				jsonp: "callback",
				success: function (data) {
					$('#doctor').val(data.attrs.director);
					$('#name').val(data.attrs.title)
					$('#myType').val(data.attrs.movie_type[0])
					$('#year').val(data.attrs.year)
					$('#country').val(data.attrs.country[0])
					$('#language').val(data.attrs.language[0])
					$('#poster').val(data.image)
					$('#summary').val(data.summary)
				}
			});
		}
	});




});