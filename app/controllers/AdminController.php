<?php

	class AdminController extends BaseController {


		/**
		 * [indexView 后台首页]
		 * @return [View] [视图渲染]
		 */
		public function indexView(){
			$moviesData = Movie::findAll();
			$viewData = ['title' => " 后台首页", 'movies' => $moviesData];
			return View::make('admin.index')->with($viewData);
		}


		/**
		 * [addMovieView 添加电影视图渲染]
		 */
		public function addMovieView(){
			$types = Type::findAll();
			$viewData = ['title'=>"后台添加",'types'=>$types];
			return View::make('admin.add')->with($viewData);
		}

		/**
		 * [addMovieDeal 添加电影逻辑]
		 */
		public function addMovieDeal(){
			if ($this->checkToken()) {
				$movieData = Input::except('_token');
				if (isset($movieData['movie_douban'])) { // 从豆瓣API抓取的数据
					$Type = new Type;
					$type_id = $Type->findField(['type_name', '=', $movieData['movie_myType']], 'type_id');
					if ($type_id) {
						$movie_id = $this->_addMovieDeal($movieData, true, 'movie_douban', ['movie_type'=>$type_id]); // 插入数据的ID
						return $movie_id ? Redirect::action('MovieController@movieDetail',[$movie_id]) : false; // 跳转到刚刚插入的详情页面
					}else {
						$type_id = Type::insertGetId(['type_name'=>$movieData['movie_myType']]);
						$movie_id = $this->_addMovieDeal($movieData, true, 'movie_douban', ['movie_type'=>$type_id]); // 插入数据的ID
						return $movie_id ? Redirect::action('MovieController@movieDetail',[$movie_id]) : false; // 跳转到刚刚插入的详情页面
					}
				}else {
					return  $this->_addMovieDeal($movieData, false) ? Redirect::to('movie/index') : false;
				}
			}
		}

		
		/**
		 * [_addMovieDeal description]
		 * @param [type] $movieData    [description]
		 * @param [type] $flag         [description]
		 * @param [type] $keys         [description]
		 * @param [type] $newItemArray [description]
		 * @TODO: 
		 */
		private function _addMovieDeal($movieData, $flag, $keys, $newItemArray){
			!isset($newItemArray) ? $newItemArray = [] : $newItemArray = $newItemArray;
			$movieData = $this->arrayUnset($movieData, $flag, $keys);
			$movieData = $this->arrayAdd($movieData, $newItemArray);
			try {
				$Movie = new Movie;
				$movie_id = $Movie->createNewMovie($movieData);
				return $movie_id ? $movie_id : false;
			} catch (Exception $e) {
				return Redirect::to('movie/index');
			}
		}


		/**
		 * [editMovieView 更新电影]
		 * @param  [Number] $mid [电影ID]
		 * @return [View]      [视图渲染]
		 */
		public function editMovieView($mid){
			$movieData = Movie::find($mid);
			$types = Type::findAll();
			$viewData = ['title' => "电影修改", 'types' => $types, 'movie' => $movieData];
			// showbug($movieData);
			return View::make('admin.edit')->with($viewData);
		}


		/**
		 * [editMovieDeal 上传电影海报]
		 * @return [type] [description]
		 */
		public function editMovieDeal(){
			if ($movieData = Input::except('_token')) {
				$File = Input::file('movie_poster');
				$movie = Movie::find($movieData['movie_id']);
				foreach ($movieData as $key => $value) {
					$movie->$key = $value;
				}
				if ($File && $File->isValid()){
					$fileName = $File->getClientOriginalName();
					$fileMime = $File->getClientOriginalExtension();
					$fileName = substr(str_replace($fileMime, '' ,$fileName) , 0, -1).'___'.time();
					$fileName = $fileName.'.'.$fileMime;
					if ($File->move('../uploads', $fileName)) {
						$movie->movie_poster = 'uploads/'.$fileName;
						return $movie->save() ? Redirect::to('movie/index') : false;
					};
				}else {
					return $movie->save() ? Redirect::to('movie/index') : false;
				}
			}
		}


		/**
		 * [deleteMovieDeal 删除电影]
		 * @return [type] [description]
		 */
		public function deleteMovieDeal(){
			if (Movie::destroy(Input::get('movie_id'))) {
				return Response::json(['status' => 200]);
			}else {
				return Response::json(['status' => 0]);
			}
		}





		






	}
?>