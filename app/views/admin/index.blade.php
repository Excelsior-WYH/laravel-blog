    @extends('layout.main')
    @section('main')
        {{HTML::script('js/admin.js')}}
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="page-header">
                    <h1>后台管理<small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BY Excelsior</small></h1>
                </div>
                <a href="add" class="btn btn-primary btn-md pull-right" style="margin:0 0 20px 0;">添加</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table">
                    <tr>
                        <th>片名</th>
                        <th>导演</th>
                        <th>语种</th>
                        <th>更改</th>
                        <th>删除</th>
                    </tr>
                    @foreach ($movies as $movie)
                        <tr>
                            <td>{{$movie->movie_name}}</td>
                            <td>{{$movie->movie_doctor}}</td>
                            <td>{{$movie->movie_language}}</td>
                            <td><a href="edit/{{$movie->movie_id}}" class="btn btn-primary btn-sm">修改</a></td>
                            <td><button class="btn btn-danger btn-sm del" data-id="{{$movie->movie_id}}">删除</button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @stop
   