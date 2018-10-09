<?php
	$this->setPageTitle(LANG_GOOGLE2FA_PROCESS_VERIFY);
	$this->addBreadcrumb(LANG_GOOGLE2FA_PROCESS_VERIFY);

?>

    <h1><?php echo LANG_GOOGLE2FA_PROCESS_VERIFY; ?></h1>

    <p><?php echo LANG_GOOGLE2FA_PROCESS_VERIFY_NOTICE; ?></p>

<?php
	$this->renderForm($form, $data, [
		'action' => '',
		'method' => 'post',
		'submit' => [
			'title' => LANG_CONTINUE,
		],
	], $errors);