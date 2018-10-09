<?php

	class formGoogle2faOptions extends cmsForm
	{

		public function init()
		{
			$crypto_key_def = function() {
				return 'ddd';
			};

			return [
				[
					'type'   => 'fieldset',
					'title'  => LANG_OPTIONS,
					'childs' => [

						new fieldString('crypto_key', [
							'title'   => LANG_GOOGLE2FA_CFG_CRYPTO_KEY,
							'hint'    => LANG_GOOGLE2FA_CFG_CRYPTO_KEY_HINT,
							'default' => $crypto_key_def(),
						]),
					],
				],
			];

		}

	}
