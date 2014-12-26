<?php

	class BaseController extends Controller {

		/**
		 * Setup the layout used by the controller.
		 *
		 * @return void
		 */
		protected function setupLayout(){
			if (!is_null($this->layout)){
				$this->layout = View::make($this->layout);
			}
		}

		/**
		 * [createUnique 产生唯一激活码]
		 * @param  [Date] $time [当前时间戳]
		 * @param  [String] $salt [盐]
		 * @return [String]       [用户唯一激活码]
		 */
		protected function createUnique($time, $salt){
			return md5(sha1($time).$salt);
		}


		/**
		 * [checkToken 验证跨域]
		 * @return [type] [description]
		 */
		protected function checkToken(){
			return Input::get('_token') != csrf_token() ? View::make('error.csrf') : true;
		}


		/**
		 * [_arrayUnset 删除数组指定元素]
		 * @param  [Array] $oldArray [初始数组]
		 * @param  [Array] $flag     [锁]
		 * @param  [Array] $keys     [删除元素]
		 * @return [Array]           [删除之后的数组]
		 * @TODO:
		 */
		protected function arrayUnset($oldArray, $flag, $keys){
			try {
				$tempArray = $oldArray;
				array_shift($oldArray);
				array_pop($oldArray);
				if ($flag) {
					if (is_array($keys)) {
						foreach ($keys as $key) {
							unset($oldArray[$key]);
						}
						return $oldArray;
					}else {
						unset($oldArray[$keys]);
						return $oldArray;
					}
				}else {
					return $oldArray;
				}
			} catch (Exception $e) {
				return $tempArray;
			}
		}


		/**
		 * [_arrayAdd 为数组添加追加元素]
		 * @param  [Array] $oldArray     [初始数组]
		 * @param  [Array] $newItemArray [追加数组]
		 * @return [Array]               [追加元素之后的数组]
		 */
		protected function arrayAdd($oldArray, $newItemArray){
			try {
				$tempArray = $oldArray;
				if (is_array($newItemArray)) {
					foreach ($newItemArray as $key => $value) {
						if (array_key_exists($key, $oldArray)) {
							continue;
						}else {
							$oldArray[$key] = $value;
						}
					}
					return $oldArray;
				}
			} catch (Exception $e) {
				return $tempArray;
			}
		}


		protected function objectAdd($oldObejct, $newItems){
			try {
				$tempObject = $oldObejct;
				if (is_array($newItems)) {
					foreach ($newItems as $key => $value) {
						if ($oldObejct->$key) {
							continue;
						}else {
							$oldObejct->$key = $value;
						}
					}
				}else {
					return $tempObject;
				}
			} catch (Exception $e) {
				return $tempObject;
			}
		}











	}
?>