	@extends('layout.main')

	@section('main')
		{{HTML::script('js/admin.js')}}
		<div class="row col-md-8 col-md-offset-2">
	        <div class="page-header">
	          	<h1>新增电影 &nbsp;&nbsp;&nbsp;<small>By Excelsior</small></h1>
	        </div>
	    </div>

		<div class="row col-md-6 col-md-offset-3">

			{{Form::open(["url"=>"admin/add",'class'=>'form-horizontal','role'=>'form'])}}

				{{Form::token()}}

				<div class="form-group">
					{{Form::label('douban','豆瓣ID',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_douban','',['id'=>"douban",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('doctor','导演',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_doctor','',['id'=>"doctor",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('name','片名',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_name','',['id'=>"name",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('type','类型',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						@foreach ($types as $type)
							{{Form::radio('movie_type',"$type->type_id",['id'=>"type",'class'=>'form-control'])}}
							{{$type->type_name}}
						@endforeach
					</div>
				</div>

				<div class="form-group">
					{{Form::label('year','时间',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_year','',['id'=>"year",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('country','国家',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_country','',['id'=>"country",'class'=>'form-control'])}}
					</div>
				</div>

				<div class="form-group">
					{{Form::label('language','语言',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_language','',['id'=>"language",'class'=>'form-control'])}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('summary','简介',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-10">
						{{Form::text('movie_summary','',['id'=>"summary",'class'=>'form-control'])}}
					</div>
				</div>
				
				{{Form::hidden('movie_poster','img/1.png',['id'=>'poster','class'=>'form-control'])}}
				{{Form::hidden('movie_myType','',['id'=>'myType','class'=>'form-control'])}}
				
				<div class="form-group">
					{{Form::submit('确认',['class'=>'btn btn-primary pull-right'])}}
				</div>

			{{Form::close()}}

		</div>
	@stop
