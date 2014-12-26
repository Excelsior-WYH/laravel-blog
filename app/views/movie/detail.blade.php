	@extends('layout.main')
	@section('header')
		<div class="row">
			<nav id="h_nav" class="navbar navbar-inverse" role="navigation">
				<div class="container-fluid">

				    <div class="navbar-header">
				      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      	</button>
				      	<a class="navbar-brand" href="#">Excelsior</a>
				    </div>

				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      	<ul class="nav navbar-nav">
					        <li class="active"><a href="/movie">首页</a></li>
					        <li><a href="">登陆</a></li>
				      	</ul>

					    <ul class="nav navbar-nav navbar-right">
					    	@if ($userData = Auth::user())
	                            <li><a href="#">{{$userData->user_name}}</a></li>
	                            <li><a href="../../user/logout">退出</a></li>
	                        @else
	                            <li><a style="cursor:pointer" href="../../user/login">登录</a></li>
					    	@endif
	                    </ul>
                	</div>
                	
            	</div>
        	</nav>
    	</div>
	@show


	
	@section('main')
		{{HTML::script('js/movie.js')}}
		<div class="row">
	        <div class="col-md-4 col-md-offset-2" style="margin-top:55px;">
	            <embed src="http://player.youku.com/player.php/sid/XNzkyNTc3OTYw/v.swf" allowFullScreen="true" quality="high" width="400" height="400" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>
	        </div>

	        <div class="col-md-3 col-md-offset-1" style="margin-top:25px;">
	            <div class="page-header"><h3>{{$movie->movie_name}}</h3></div>
	            <div class="panel panel-default" style="background:rgb(217,237,247)">
	                <div class="panel-body">影片详情</div>
	                <div class="panel-footer">
	                    <p>导演:{{$movie->movie_doctor}}</p><br>
	                    <p>类型:{{$movie->type_name}}</p><br>
	                    <p>国家:{{$movie->movie_country}}</p><br>
	                    <p>语言:{{$movie->movie_language}}</p><br>
	                    <p><a class="btn btn-primary btn-md" role="button">查看更多</a></p>
	                </div>
	            </div>
	        </div>
	    </div>

		<div class="row col-md-8 col-md-offset-2" id="comment_list">
	        <div class="panel panel-default" style="margin-top:50px;background:rgb(217,237,247)">
	            <div class="panel-body">评论区</div>
	            @if (!empty($talks))
					<div class="panel-footer">
		            	@foreach ($talks as $talk)
		                    <div class="media">
		                        <a class="pull-left">
		                            <img class="media-object img-circle" src="../../img/h.png" width="50" height="50">
		                        </a>
		                        <div class="media-body">
		                            <h4 class="media-heading">{{$talk->user_name}}</h4>
		                            {{$talk->t_content}}
		                        </div>
		                        <hr>
		                    </div>
	                   	@endforeach
		            </div>
	            @else
	            	<h4>快来抢沙发啊</h4>
	            @endif
	        </div>
	    </div>

	    <div class="row col-md-8 col-md-offset-2">
	        <div class="panel" style="margin-top:50px;background:rgb(217,237,247)">
	            <div class="panel-body">发表评论</div>
	            <div class="panel-footer">
	                <div id="talk">
	                    <form role="form" id="tForm">
	                        <input type="hidden" name="t-movie-id" value="{{$movie->movie_id}}">
	                        <div class="form-group">
	                            <textarea class="form-control com_content" rows="3" id="t-content"></textarea>
	                        </div>
	                        @if ($userData = Auth::user())
	                            <div class="form-group">
	                            	<input type="hidden" name="t-user-id" value="{{$userData->id}}">
	                                <button class="btn btn-primary btn-md pull-right">评论</button>
	                       	@else
	                                <span>请登录后再评论</span>
	                            </div>
	                        @endif
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	@stop