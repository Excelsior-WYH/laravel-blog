	
	@extends('layout.main')

	@section('main')
		{{HTML::script("js/email.js")}}
		<p id="num">3</p>
		<p>感谢你的注册</p>
		<a href="http://mail.qq.com/" target="_blank">登录邮箱激活当前账号</a>
	@stop