$(function (){

	// 首页卡片效果
	var movieImg = $('.panel-footer').find('img');
	var movieCard = $('#detail');
	var timer = null;//定时器
	movieImg.on('mouseenter',function (event) {
		var self = $(this)
		/* Act on the event */
		timer = setTimeout(function (){
			var top = self.offset().top;
			var left = self.offset().left;
			var flag = 1;
			if (flag) {
				$.ajax({
					url : "/movie/card",
					type : "POST",
					data : {id : self.attr('data-id')},
					dataType : "json",
					beforeSend : function(){
						flag = 0
					},
					success : function (res){
						flag = 1
						movieCard.html("");
						if (res.status == 200) {
							var $html = '<p>电影简介:</p><span class="arrow"></span><div>'+ res.data.summary.substr(0, 40) +'</div>';
							movieCard.append($html);
							movieCard.css({position : "absolute", top : top, left : left + 150}).fadeIn();
						}
					}
				})
			}
		}, 1000)
	}).on('mouseleave', function (event){
		clearTimeout(timer);
		setTimeout(function (){	
			movieCard.on('mouseenter', function (event){
				movieCard.addClass('hover');
			})
			movieCard.hasClass('hover') == false ? movieCard.fadeOut(300) : ""
		}, 300);
	})



	if (movieCard.hasClass('hover') == false) {
		movieCard.on('mouseenter', function (event){
			$(this).addClass('hover');
			if (movieCard.hasClass('hover') == true) {
				movieCard.on('mouseleave', function (event){
					$(this).removeClass('hover').fadeOut(300)					
				})
			}
		})
	}


	var flag = true; // 锁
	// 元素
	var inputEle = {
		$movieID: $("input[name='t-movie-id']"),
		$userID: $("input[name='t-user-id']"),
		$submitBtn: $("input[name='t-user-id']").next()
	}

	inputEle.$submitBtn.on("click", function(event){
		event.preventDefault();
		// Ajax数据
		var $data = {
			t_movie_id: inputEle.$movieID.val(),
			t_user_id: inputEle.$userID.val(),
			t_content: $('#t-content').val()
		}
		if (flag) {
			$.ajax({
				url : "../talk",
				type: "POST",
				data: $data,
				beforeSend : function(){
					flag = false;
				},
				success: function (response, status){
					flag = true;
					if (status == 'success') {
						var returnData = response;
						var $html = '<div class="media"><a class="pull-left">';
							$html += '<img class="media-object img-circle" src="../../img/h.png" width="50" height="50">';
							$html += '</a><div class="media-body"><h4 class="media-heading">';
							$html += returnData.user_name + '</h4><br><p>' + returnData.t_content;
							$html += '</p></div><hr></div>';
						$('.panel-footer').eq(1).append($html);
					}
				},
				error: function (){

				}
			})
		};
	})
	


});
