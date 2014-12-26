<?php

	class UserController extends BaseController {
		
		/**
		 * [signUpView 用户注册视图渲染]
		 * @return [View] [视图渲染]
		 */
		public function signUpView(){
			return View::make('user.signup')->withTitle('用户注册');
		}


		/**
		 * [signUpDeal 用户注册业务逻辑]
		 * @return [View] [视图渲染]
		 */
		public function signUpDeal(){
			if ($this->checkToken()) {
				$User = new User;
				$userData = Input::except('_token');
				$userData = $this->_userDataDeal($userData); // 处理用户输入信息
				if(!$this->_userDataVal($userData)){ // 验证用户信息
					if($User->createUser($userData)){ // 新增用户
						$tip = '感谢你的注册,请点击以下链接激活你的账号';
						return $this->_sendEmailDeal($userData['user_unique'], $tip) ? Redirect::to('user/sendMail'): "";
					}
				}else {
					return $this->_userDataVal($userData);
				}
			}
		}


		/**
		 * [_userDataVal 用户数据验证]
		 * @param  [Array] $userData [用户数据]
		 * @return [Array]           [description]
		 */
		private function _userDataVal($userData){
			// 验证规则
			$rules = [
				'user_name' => 'required|min:2|max:30',
				'user_email' => 'required|email'
			];
			// 自定义错误提示信息
			$messages = [
				'user_name.required' => '用户名不得为空',
				'user_name.min' => '用户名不得小于2位',
				'user_name.max' => '用户名不得长于30位',
				'user_email.required' => '必填',
				'user_email.email' => '请填写正确的邮箱地址'
			];
			// 验证实例
			$Validator = Validator::make($userData, $rules, $messages);
			if ($Validator->fails()) {
				return Redirect::to('user/signup')->withErrors($Validator->messages());
			}
		} 


		/**
		 * [_userDataDeal 用户数据处理]
		 * @param  [Array] $userData [用户原始数据]
		 * @return [Array]           [处理之后的数据]
		 */
		private function _userDataDeal($userData){
			$userData['password'] = Hash::make($userData['password']); // 密码加密
			$userUnique = $this->createUnique(time(), $userData['user_email']); // 产生唯一激活码
			return $userData = $this->arrayAdd($userData, ['user_unique'=>$userUnique, 'user_sign_date'=>time()]); // 添加唯一激活码和时间戳
		}


		/**
		 * [sendMailView 发送邮件中转页面]
		 * @return [Void] [视图渲染]
		 */
		public function sendEmailView(){
			return View::make('user.mail')->withTitle('邮箱认证');
		}
		

		/**
		 * [_sendEmailDeal 注册认证邮件]
		 * @param  [String] $userUnique [唯一激活码]
		 * @return [String]             [邮件主题内容]
		 */
		private function _sendEmailDeal($userUnique, $tip){
			try {
				$viewData = ['userUnique' => $userUnique, 'tip' => $tip];
				Mail::later('10', 'emails.signup', $viewData, function($message){
					$message->to('18523278424@163.com')->subject('注册验证');
				});
				return true;
			} catch (Exception $e) {
				return Redirect::to('user/login');
			}
		}


		/**
		 * [checkUnique 验证激活码是否过期]
		 * @param   [String] $unique [用户唯一激活码]
		 * @return [View] [视图渲染]
		 */
		public function checkUnique($unique){
			$User = new User;
			$userData = $User->getByUnique($unique);
			if(time() - $userData['user_sign_date'] < 3600){
				return Auth::loginUsingId($userData->id) ? Redirect::to('user/prefect') : Redirect::to('user/login');
			}else {
				try{
					$userUnique = $this->createUnique(time(), $userData->user_email); // 生成新的唯一验证码
					$userData->user_unique = $userUnique; 
					$userData->user_sign_date = time();
					$userData->save(); // 更新数据
					$tip = '你的激活码已经再次发送,请及时激活';
					return $this->_sendEmailDeal($userUnique, $tip) ? Redirect::to('user/sendMail') : ""; // 如果过期了则再次发送验证邮件
				} catch(Exception $e){
					return Redirect::to('user/login');
				}
			}
		}


		/**
		 * [loginView 登录试图渲染]
		 * @return [Void] [Null]
		 */
		public function loginView(){
			return View::make('user.login')->withTitle('用户登录');
		}


		/**
		 * [loginDeal 用户登录逻辑处理]
		 * @return [View] [视图渲染]
		 */
		public function loginDeal(){
			if ($this->checkToken()) {
				if (Auth::attempt(Input::except('_token'), true)){
					if (Auth::check()) {
						return Redirect::to('movie/index');
					}
				}else {
					return Redirect::back();
				}
			}
		}


		/**
		 * [prefectView 完善个人信息视图渲染]
		 * @param  [String] $unique [用户唯一激活码]
		 * @return [View]         [视图渲染]
		 */
		public function prefectView(){
			try {
				if(Auth::check()){
					$User = new User;
					$userData = User::findById(Auth::id());
					$User->updateStatus($userData->id); // 更新激活状态
					$viewData = ['title' => '完善个人信息', 'userData' => $userData];
					return View::make('user.prefect')->with($viewData);
				}else {
					return Redirect::to('user/login');
				}
			} catch (Exception $e) {
				return Redirect::to('user/login');
			}
		}
		

		/**
		 * [prefectDeal 完善个人信息业务逻辑]
		 * @return [type] [description]
		 */
		public function prefectDeal(){
			if ($this->checkToken()) {
				$userData = Input::except('_token');
				return User::updateUserData(Auth::id(), $userData) ? Redirect::back() : false;
			}
		}


		/**
		 * [logout 退出登录]
		 * @return [View] [视图渲染]
		 */
		public function logout(){
			if (Auth::check()) {
				Auth::logout();
				return Redirect::to('user/login');
			}
		}


	}
?>