<?php

	class formGoogle2faSetup extends cmsForm
	{

		public function init()
		{
			return [

				'basic' => [
					'type'   => 'fieldset',
					'childs' => [
						new fieldCheckbox('is_enabled', [
							'title'   => LANG_GOOGLE2FA_CFG_IS_ENABLED,
							'default' => 0,
						]),
						new fieldString('secret_key', [
							'title'   => LANG_GOOGLE2FA_CFG_SECRET_KEY,
							'default' => '',
						]),
					],
				],

			];

		}

	}
