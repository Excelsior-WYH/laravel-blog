	@extends('layout.main')

	@section('header')
		<div class="row">
			<nav id="h_nav" class="navbar navbar-default" role="navigation">
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
	                            @if ($userData->user_status == 0)
	                            	<li><a href="../user/prefect"  style="color:red">完善信息</a></li>
	                            @endif
	                            <li><a href="../user/logout">退出</a></li>
	                        @else
	                            <li><a style="cursor:pointer" href="../user/login">登录</a></li>
					    	@endif
	                    </ul>
                	</div>
                	
            	</div>
        	</nav>
    	</div>
	@show

	
	@section('main')
		<div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            @foreach ($movies as $type_name => $oneTypeMovies)
	                <div class="panel panel-default">
	                    <div class="panel-body" style="background:rgb(223,240,216)">
	                        <a href="/type?typeid=$movie->movie_id"><strong>{{$type_name}}</strong></a>
	                    </div>
						<div class="panel-footer">
							<div class="row">
								@foreach ($oneTypeMovies as $movie)
									<div class="col-md-2 col-md-offset-1">
										<strong style="color:black">{{$movie->movie_name}}</strong><br><br>
										<img src="../../{{$movie->movie_poster}}" data-id="$movie->movie_id" width="130" height="180"><br/><br/>
										<a href="detail/{{$movie->movie_id}}" class="btn btn-primary btn-sm" role="button" style="margin-left:35px;">查看详情</a><br>
									</div>
								@endforeach
							</div>
						</div>
	                </div>
	            @endforeach
	        </div>
	    </div>
	@stop
