<?php

	class actionGoogle2faVerify extends cmsAction
	{

		public function run()
		{
			$userSession = cmsUser::sessionGet('user_verify');

			if (!$userSession || cmsUser::isLogged()) {
				cmsCore::error404();
			}

			$form = $this->getForm('verify');

			$data = [];

			if ($this->request->has('submit')) {

				$data = $form->parse($this->request, true);

				$errors = $form->validate($this,  $data);

				if ($errors){
					cmsUser::addSessionMessage(LANG_FORM_ERRORS, 'error');
				}

				if (!$errors) {
					if (!$data['code']) {
						cmsUser::addSessionMessage(LANG_GOOGLE2FA_CODE_NOT_VALID, 'error');
						cmsUser::logout();
						$this->redirectBack();
					}

					$model_2fa = cmsCore::getModel('google2fa');

					$user_2fa = $model_2fa->getUserData($userSession['id']);

					if (strpos($data['code'], '-') !== false && strlen($data['code']) === 11) {

						$restore_code = cmsModel::yamlToArray($model_2fa::decrypt($user_2fa['restore_code']));

						if (empty($restore_code)) {
							cmsUser::addSessionMessage(LANG_GOOGLE2FA_RESTORE_CODE_NOT_FOUND, 'error');
							cmsUser::logout();
							$this->redirectBack();
						}

						$recovery_success = false;

						foreach ($restore_code as $key => $r_code) {
							if ($data['code'] == $r_code) {
								$recovery_success = true;
								unset($restore_code[$key]);
							}
						}

						if ($recovery_success) {

							$restore_code = $model_2fa::encrypt(cmsModel::arrayToYaml($restore_code));

							$model_2fa->updateRestoreCode($userSession['id'], $restore_code);

							return true;
						} else {
							cmsUser::addSessionMessage(LANG_GOOGLE2FA_RESTORE_CODE_NOT_VALID, 'error');
							cmsUser::logout();
							$this->redirectBack();
						}
					}

					if (empty($user_2fa['secret_key'])) {
						cmsUser::addSessionMessage(LANG_GOOGLE2FA_NOT_VALID, 'error');
						cmsUser::logout();
						$this->redirectBack();
					}

					$secret_key = $model_2fa::decrypt($user_2fa['secret_key']);

					if ($model_2fa->verifyKey($data['code'], $secret_key)) {

						$model_2fa->loginUser();

						cmsUser::addSessionMessage(LANG_GOOGLE2FA_VERIFY_CODE_VALID, 'success');

						$this->redirect(href_to_home());

						return true;

					} else {
						cmsUser::addSessionMessage(LANG_GOOGLE2FA_VERIFY_CODE_NOT_VALID, 'error');
						cmsUser::logout();
						$this->redirectBack();
					}
				}
			}

			return $this->cms_template->render('verify', [
				'form'   => $form,
				'data'   => $data,
				'errors' => isset($errors) ? $errors : false,
			]);

		}

	}
