<?php
	
	class Type extends Eloquent{

		protected $table = 'type';
		protected $primaryKey = 'type_id';
		protected $guarded = [];
		public $timestamps = false;//关闭时间验证



		public function movie(){
			return $this->hasMany('Movie','movie_type');
		}


		/**
		 * [findField description]
		 * @param  [type] $where [description]
		 * @param  [type] $field [description]
		 * @return [type]        [description]
		 */
		public function findField($where, $field){
			try {
				return Type::where($where[0], $where[1], $where[2])->pluck($field);
			} catch (Exception $e) {
				return;
			}
		}


		/**
		 * [findAll description]
		 * @return [type] [description]
		 */
		public static function findAll(){
			try {
				return Type::get();
			} catch (Exception $e) {
				return false;			
			}
		}

	}


