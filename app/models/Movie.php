<?php
	
	class Movie extends Eloquent{
		
		protected $table = 'movie';
		protected $primaryKey = 'movie_id';
		protected $guarded = [];
		public $timestamps = false;//关闭时间验证


		/**
		 * [Talk description]
		 * 包含关系 一对多
		 */
		public function Talks(){
			return $this->hasMany('talk','t_movie_id');
		}

		/**
		 * [createNewMovie description]
		 * @param  [type] $data [description]
		 * @return [type]       [description]
		 */
		public function createNewMovie($data){
			return Movie::insertGetId($data);
		}

		/**
		 * [findOne 查询一条记录]
		 * @param  [type] $table    [description]
		 * @param  [type] $movie_id [description]
		 * @return [type]           [description]
		 */
		public static function findOne($movie_id){
			return Movie::join('type', 'type.type_id', '=', 'movie.movie_type')
				   ->where('movie.movie_id', $movie_id)
				   ->select('type.type_name','movie.*')
				   ->first();	
		}
		
		/**
		 * [[Description]]
		 * @param   [[Type]] $table [[Description]]
		 * @param   [[Type]] $flag  [[Description]]
		 * @return [[Type]] [[Description]]
		 */
		public static function findAll(){
			return Movie::join('type', 'type.type_id', '=', 'movie.movie_type')
				   ->select('type.type_name','movie.*')
				   ->get();
		}



	}





?>