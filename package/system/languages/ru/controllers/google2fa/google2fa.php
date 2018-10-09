<?php

	define('LANG_GOOGLE2FA_CONTROLLER', 'Google 2fa - двухфакторная авторизация');

	define('LANG_GOOGLE2FA_CFG_CRYPTO_KEY', 'Ключ шифрования');
	define('LANG_GOOGLE2FA_CFG_CRYPTO_KEY_HINT', 'Ключ шифрования используется для шифрования данных пользователя');

	define('LANG_GOOGLE2FA_USERS_EDIT_PROFILE', 'Google 2fa - авторизация');
	define('LANG_GOOGLE2FA_SETUP', 'Настройка Google 2fa');
	define('LANG_GOOGLE2FA_SETUP_TITLE', 'Настройка Google 2fa');
	define('LANG_GOOGLE2FA_SETUP_HINT', 'Здесь вы можете настройть двухфакторную авторизацию от Google.');

	define('LANG_GOOGLE2FA_CFG_IS_ENABLED', 'Включить двухфакторную авторизацию');
	define('LANG_GOOGLE2FA_CFG_SECRET_KEY', 'Секретный ключ');
	define('LANG_GOOGLE2FA_CFG_RESTORE_CODE', 'Коды восстановления');

	define('LANG_GOOGLE2FA_CODE_NOT_VALID', 'Код авторизации не принят');
	define('LANG_GOOGLE2FA_PROCESS_VERIFY', 'Проверка кода авторизации');
	define('LANG_GOOGLE2FA_PROCESS_VERIFY_NOTICE', 'Пожалуйста укажите проверочный код для авторизации');

	define('LANG_GOOGLE2FA_CODE', 'Код авторизации');

	define('LANG_GOOGLE2FA_RESTORE_CODE_NOT_FOUND', 'Ошибка получения кодов восстановления');
	define('LANG_GOOGLE2FA_RESTORE_CODE_NOT_VALID', 'Не корректный код восстановления');
	define('LANG_GOOGLE2FA_NOT_VALID', 'Ошибка 2fa - авторизации');
	define('LANG_GOOGLE2FA_VERIFY_CODE_NOT_VALID', 'Ошибка подтверждения 2fa кода');
	define('LANG_GOOGLE2FA_VERIFY_CODE_VALID', 'Код авторизации подтвержден');

	define('LANG_GOOGLE2FA_CFG_SETUP_STEP_0', 'Чтобы включить двухфакторную авторизацию вам нужно выполнить следующие шаги.');
	define('LANG_GOOGLE2FA_CFG_SETUP_STEP_1', '<b>Шаг 1: Авторизация приложения</b><br/><p>Откройте мобильное приложение 2FA и сканируйте следующий QR-код:</p>');
	define('LANG_GOOGLE2FA_CFG_SETUP_STEP_2', '<b>Шаг 2: Коды восстановления</b><br/><p>Коды восстановления используются для доступа к вашей учетной записи в случае, если вы не можете получить двухфакторные коды аутентификации.</p>');
	define('LANG_GOOGLE2FA_CFG_SETUP_STEP_1_HINT','<b>Внимание!</b><br/><p>Если ваше мобильное приложение 2FA не поддерживает QR-коды, введите следующий номер:</p>');
	define('LANG_GOOGLE2FA_CFG_SETUP_STEP_2_HINT','<b>Поместите их в безопасное место!</b><br/><p>Если вы потеряете свое устройство и коды восстановления, вы потеряете доступ к своей учетной записи.</p>');