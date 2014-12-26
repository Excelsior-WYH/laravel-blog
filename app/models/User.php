<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	protected $table = 'users';
	public $timestamps = false;//关闭时间验证
	protected $primaryKey = 'id';
	protected $guarded = [];

	/**
	 * [createUser 新增一个用户]
	 * @param  [Array] $userData [用户信息]
	 * @return [type]           [description]
	 */
	public function createUser($userData){
		return User::create($userData);
	}


	public static function getField($user_id, $field){
		try {
			$getField = User::where('id', '=', $user_id)->pluck($field);
			return $getField ? $getField : false;
		} catch (Exception $e) {
			return;
		}
	}

	/**
	 * [getByUnique description]
	 * @param  [type] $unique [description]
	 * @return [type]         [description]
	 */
	public function getByUnique($unique){
		return User::where('user_unique', '=', $unique)->first();
	}
	

	/**
	 * [findById description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public static function findById($id){
		return User::find($id);
	}


	/**
	 * [updateStatus description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function updateStatus($id){
		return User::where('id', $id) ->update(['user_status' => 1]);
	}


	/**
	 * [updateUserData 完善用户信息]
	 * @param  [Number] $id       [用户ID]
	 * @param  [Array] $userData [用户数据]
	 * @return [Boolean]           [Null]
	 */
	public static function updateUserData($id, $userData){
		$userInfo = self::findById($id);
		foreach ($userData as $key => $value) {
			$userInfo->$key = $value;
		}
		return $userInfo->save() ? true : false;
	}




}
?>