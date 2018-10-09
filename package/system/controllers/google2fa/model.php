<?php

	use PragmaRX\Google2FA\Google2FA;
	use PragmaRX\Recovery\Recovery;

	class modelGoogle2fa extends cmsModel
	{

		const METHOD             = 'aes-256-ctr';
		const CRYPTO_KEY_DEFAULT = '?AyRk)w<Zv)@sb{<zQ`nl49HS:ge-<|h&Cs,|`B)J5VobJmgUrzIcAOpt_E`7e[g';

		protected        $google2fa;
		protected        $recovery;
		protected static $config = [];

		public function __construct()
		{
			parent::__construct();

			require_once PATH . '/vendor/autoload.php';

			$this->google2fa = new Google2FA;
			$this->recovery  = new Recovery;

			static::$config = cmsController::loadOptions('google2fa');
		}

		protected static function key()
		{
			return isset(static::$config['crypto_key']) ? self::$config['crypto_key'] : static::CRYPTO_KEY_DEFAULT;
		}

		public static function encrypt($value)
		{
			$nonce_size  = openssl_cipher_iv_length(static::METHOD);
			$nonce       = openssl_random_pseudo_bytes($nonce_size);
			$cipher_text = openssl_encrypt($value, static::METHOD, static::key(), OPENSSL_RAW_DATA, $nonce);

			return base64_encode($nonce . $cipher_text);
		}

		public static function decrypt($value)
		{
			$value = base64_decode($value, true);
			if ($value === false) {
				return '';
			}
			$nonce_size  = openssl_cipher_iv_length(static::METHOD);
			$nonce       = mb_substr($value, 0, $nonce_size, '8bit');
			$cipher_text = mb_substr($value, $nonce_size, null, '8bit');
			$plaintext   = openssl_decrypt($cipher_text, static::METHOD, static::key(), OPENSSL_RAW_DATA, $nonce);

			return $plaintext;
		}

		public function generateQrCode($secret)
		{
			$title = cmsConfig::get('sitename');

			if (function_exists('imagecreatetruecolor')) {
				return $this->google2fa->getQRCodeInline($title, cmsUser::get('email'), $secret);
			}

			return $this->google2fa->getQRCodeGoogleUrl($title, cmsUser::get('email'), $secret);
		}

		public function generateSecretKey()
		{
			return $this->google2fa->generateSecretKey();
		}

		public function generateRecoveryCodes()
		{
			return $this->recovery->setChars(5)
			                      ->setCount(12)
			                      ->toArray();
		}

		public function updateRestoreCode($user_id, $code)
		{
			return $this->filterEqual('user_id', $user_id)
			            ->updateFiltered('users_google2fa', [
				            'restore_code' => $code,
			            ]);
		}

		public function verifyKey($code, $secret)
		{
			return $this->google2fa->verify($code, $secret);
		}

		public function setUserData($data)
		{
			$this->insertOrUpdate('users_google2fa', $data, $data);
		}

		public function getUserData($user_id)
		{
			$result = $this->filterEqual('user_id', $user_id)
			               ->getItem('users_google2fa', function ($item) {
				               return $item;
			               });

			return $result ? $result : [];
		}

		public function loginUser()
		{

			$user_verify = cmsUser::sessionGet('user_verify');

			$model_user = cmsCore::getModel('users');

			$user = $model_user->getUser($user_verify['id']);

			cmsUser::setUserSession($user);

			$model_user->updateUserIp($user['id']);

			return true;
		}
	}
