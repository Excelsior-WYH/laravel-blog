<?php 
	class Talk extends Eloquent {

		protected $table = 'talk';
		protected $guarded = [];
		protected $primaryKey = 't_id';
		public $timestamps = false;//关闭时间验证


		/**
		 * [Movie description]
		 * 多对一,属于关系
		 */
		public function Movie(){
			return $this->belongsTo('movie', 'movie_id');
		}

		/**
		 * [findTalks 返回当前电影的所有评论信息]
		 * @param  [type] $movie_id [description]
		 * @return [type]           [description]
		 */
		public static function findTalks($movie_id){
			return Talk::join('users','talk.t_user_id', '=', 'users.id')
				   ->where('talk.t_movie_id', $movie_id)
				   ->select('talk.*','users.user_name')
				   ->get();
		}

	}


 ?>