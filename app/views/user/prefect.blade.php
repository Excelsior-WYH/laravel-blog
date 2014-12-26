	@extends('layout.main')
	
	@section('main')
		<div class="row col-md-6 col-md-offset-3" style="margin:200px 0 0 500px;padding:100px 0 100px 100px;background:#ccc;">
			{{Form::open(["url"=>"user/prefect",'class'=>'form-horizontal','role'=>'form'])}}
				{{Form::token()}}
				<div class="form-group">
					{{Form::label('userName','用户名',['class'=>'col-sm-2 control-label'])}}
					@if($userData)
						<div class="col-sm-6">
							{{Form::text('user_name',"{$userData->user_name}",['id'=>"userName",'class'=>'form-control'])}}
						</div>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('userEmail','邮&nbsp;&nbsp;&nbsp;箱',['class'=>'col-sm-2 control-label'])}}
					@if($userData)
						<div class="col-sm-6">
							<input type="text" name="user_email" value="{{$userData->user_email}}" class="form-control" readonly="readonly">
						</div>
					@endif
				</div>
				<div class="form-group">
					{{Form::label('userTel','联系电话',['class'=>'col-sm-2 control-label'])}}
					@if($userData)
						<div class="col-sm-6">
							{{Form::text('user_tel',"{$userData->user_tel}",['id'=>"userTel",'class'=>'form-control'])}}
						</div>
					@endif
				</div>
				<div class="form-group">
					<div class="col-sm-6" style="margin:0 0 0 145px;">
						{{Form::submit('确认更改',['class'=>'btn btn-primary pull-right'])}}
					</div>
				</div>

			{{Form::close()}}
		</div>
	@stop