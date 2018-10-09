<?php

	class onGoogle2faUserLogin extends cmsAction
	{

		public function run($user)
		{
			$model_2fa = cmsCore::getModel('google2fa');

			$user_2fa = $model_2fa->getUserData($user['id']);

			if (!$user_2fa['is_enabled']) {
				return $user;
			}

			cmsUser::sessionSet('user_verify', [
				'id' => $user['id'],
			]);

			$this->redirectTo('google2fa', 'verify');

			$this->controller->halt();
		}
	}
