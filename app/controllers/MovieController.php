<?php

	class MovieController extends BaseController {

		/**
		 * [indexView description]
		 * @return [type] [description]
		 */
		public function indexView(){
			$result = Movie::findAll();
		    $movies = [];
          	foreach ($result as $key => $value) {
          		$movies[$value->type_name][] = $value;
            }
			$viewData = ['title' => "首页", 'movies' => $movies];
			return View::make('movie.index')->with($viewData);
		}
		
		
		/**
		 * [movieDetail 电影详情页]
		 * @param  [String] $mid [电影ID]
		 * @return [View]      [视图渲染]
		 */
		public function movieDetail($mid){
			$movieData = Movie::findOne($mid); // 电影信息
			$talksData = Talk::findTalks($mid); // 所有评论
			$viewData = ['title' => "详情页", 'movie' => $movieData, 'talks' => $talksData];
			return View::make('movie.detail')->with($viewData);
		}


		/**
		 * [movieTalk 用户评论]
		 * @return [Json] [description]
		 */
		public function movieTalk(){
			if (Request::ajax()) {
				$talkData = Input::all();
				$t_user_id = $talkData['t_user_id'];
				$talkData = $this->arrayAdd($talkData, ['t_date' => time()]);
				try {
					if ($returnData = Talk::create($talkData)) {
						$userName = User::getField($t_user_id, 'user_name');
						$returnData->user_name = $userName;
						return Response::json($returnData);
					}else {
					 	return Response::make(['status' => 0], 500);
					}
				} catch (Exception $e) {
					return;
				}
			}else {
				return Redirect::to('movie/index');
			}
		}








	}
?>