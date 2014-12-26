	
	@extends('layout.main')

	@section('main')
		{{HTML::script('js/sign.js')}}
		<div class="row col-md-6 col-md-offset-3" style="margin:200px 0 0 500px;padding:100px 0 100px 100px;background:#ccc;">
			{{Form::open(["url"=>"user/login",'class'=>'form-horizontal','role'=>'form'])}}
				{{Form::token()}}
				<div class="form-group">
					{{Form::label('userEmail','邮&nbsp;&nbsp;&nbsp;箱',['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-6">
						{{Form::text('user_email','',['id'=>"userEmail",'class'=>'form-control'])}}
					</div>
				</div>
				<div class="form-group">
					{{Form::label('password', '密&nbsp;&nbsp;&nbsp;码', ['class'=>'col-sm-2 control-label'])}}
					<div class="col-sm-6">
						<input type="password" name="password" id="password" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6" style="margin:0 0 0 145px;">
						{{Form::submit('登录',['class'=>'btn btn-primary pull-right'])}}
					</div>
				</div>
			{{Form::close()}}
		</div>
	@stop