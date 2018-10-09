<?php

	class onGoogle2faProfileEditMenu extends cmsAction
	{

		public function run($menu)
		{
			$menu[] = [
				'title'      => LANG_GOOGLE2FA_USERS_EDIT_PROFILE,
				'controller' => 'users',
				'action'     => $menu[0]['action'],
				'params'     => ['edit', '2fa'],
			];

			return $menu;
		}
	}
