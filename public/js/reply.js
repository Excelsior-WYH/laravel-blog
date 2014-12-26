$(function(){

	var flag = 1;
	$('.comment').on('click',function(e){

		var target = $(this);
		var commentID = target.data('cid');//主评论的ID
		var toID = target.data('tid')//楼主的ID
		if ($('input[name=commentID]').val() == undefined) {
			$('<input>').attr({
				type : "hidden",
				name : 'commentID',
				value : commentID,
			}).appendTo('#reply_form');
		}

		if ($('input[name=to]').val() != undefined) {
			$('input[name=to]').val(toID);
		}else {
			$('<input>').attr({
				type : "hidden",
				name : 'to',
				value : toID,
			}).appendTo('#reply_form');
		}
			
	});

	//对电影进行评论
	$('.reply').on('click',function(e){
		e.preventDefault();
		if ($('input[name=commentID]').val() !== undefined){
			var data = {
				commentID : $("input[name='commentID']").val(),
				from : $('#from_user_id').val(),//登录用户
				to : $("input[name='to']").val(),//楼主
				content : $('#reply_form').find('textarea').val()
			}
			$.ajax({
				url : "../../comment/reply",
				type : "POST",
				data : data,
				beforeSend : function(){
					flag = 0;
				},
				success : function(res){
					flag = 1;
					if(res.status === 200){
						alert('message');
					}else {
						alert(res.info)
					}
				} 
			})
		}else {
			var data = {
				movie : $('#movie_id').val(),
				from : $('#from_user_id').val(),
				content : $('#reply_form').find('textarea').val()
			}
			$.ajax({
				url : "../../comment/reply",
				type : "POST",
				data : data,
				beforeSend : function(){
					flag = 0;
				},
				success : function(res){
					flag = 1;
					if(res.status === 200){
						var html = '<div class="media"><a class="pull-left" href="#"><img class="media-object img-circle" src="../../img/h.png" alt="..." width="70" height="70"></a><div class="media-body"><h4 class="media-heading">'+ res.data +'</h4>' + $('#reply_form').find('textarea').val() + '</div><hr><br/></div>';
						$('#comment_list').append(html);
					}else {
						alert(res.info)
					}
				} 
			})
		}
	})

});