	@extends('layout.main')

	@section('main')
		{{HTML::script('js/admin.js')}}
		<div class="row col-md-8 col-md-offset-2">
	        <div class="page-header">
	          	<h1>修改电影信息 &nbsp;&nbsp;&nbsp;<small>By Excelsior</small></h1>
	        </div>
	    </div>
		<div class="row col-md-6 col-md-offset-3">

			{{Form::open(["url"=>"admin/edit",'files' => true, 'class'=>'form-horizontal','role'=>'form'])}}

				{{Form::token()}}
				<div class="form-group">
					{{Form::label('doctor','导演',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_doctor',"$movie->movie_doctor", ['id'=>"doctor",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('name','片名',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_name', "$movie->movie_name", ['id'=>"name",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('type','类型',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						@foreach ($types as $type)
							<label class="radio-inline">
								@if ($type->type_id == $movie->movie_type)
							    	<input type="radio" name="movie_type" id="movie_type" value="{{$type->type_id}}" checked="checked">
							    	{{$type->type_name}}
							    @else 
								    <input type="radio" name="movie_type" id="movie_type" value="{{$type->type_id}}">
								    {{$type->type_name}}
							    @endif
							</label>
						@endforeach
					</div>
				</div>

				<div class="form-group">
					{{Form::label('year','时间',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_year', "$movie->movie_year", ['id'=>"year",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('country','国家',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_country',"$movie->movie_country",['id'=>"country",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('country','预览图s',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::file('movie_poster')}}
					</div>
				</div>
				

				<div class="form-group">
					{{Form::label('language','语言',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_language',"$movie->movie_language",['id'=>"language",'class'=>'form-control'])}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('summary','简介',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_summary',"$movie->movie_summary",['id'=>"summary",'class'=>'form-control'])}}
					</div>
				</div>
				
				{{Form::hidden('movie_id', "$movie->movie_id" ,['id'=>'movie_id','class'=>'form-control'])}}
				
				<div class="form-group">
					{{Form::submit('确认',['class'=>'btn btn-primary pull-right'])}}
				</div>

			{{Form::close()}}

		</div>
	@stop
