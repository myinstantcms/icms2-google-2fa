<?php

	class backendGoogle2fa extends cmsBackend
	{
		public $useDefaultOptionsAction = true;

		public function actionIndex()
		{
			$this->redirectToAction('options');
		}
	}
