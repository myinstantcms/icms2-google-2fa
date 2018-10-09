<?php

	class formGoogle2faVerify extends cmsForm
	{

		public function init()
		{

			return [

				'basic' => [
					'type'   => 'fieldset',
					'title'  => LANG_GOOGLE2FA_CODE,
					'childs' => [
						new fieldString('code', [
							'rules' => [
								['required'],
							],
						]),
					],
				],

			];

		}

	}
