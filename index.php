<?php
/**
 * Created by PhpStorm.
 * User: Student
 * Date: 13.02.2018
 * Time: 19:32
 */


error_reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting', E_ALL);

header( 'Content-type: text/html;charset=utf-8' );
session_start();

require_once 'Vkontakte.php';
require_once 'functions.php';

global $vk;

use \BW\Vkontakte as Vk;

$vk_bot_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$vk = new Vk( array(
	'client_id'     => '6374232',
	'client_secret' => 'EaWDuq0xH0a1fg4npj1m',
	'redirect_uri'  => $vk_bot_uri,
) );



// если вернулся ответ в виде запроса с параметро code
if ( isset( $_GET['code'] ) ) {

	// производится авторизация
	$vk->authenticate();

	// в глобальную переменную access_token записывается полученный приложением токен
	$_SESSION['access_token'] = $vk->getAccessToken();

	// происходит перенаправление на основную страницу
	header( 'location: ' . $vk_bot_uri );

	die();
} else {

	// если токен хранится в сессии
	if ( ! empty( $_SESSION['access_token'] ) ) {

		// токен устанавливается для доступа к API
		$vk->setAccessToken( $_SESSION['access_token'] );

		// запуск функции init
		init();
	} else {
		// если авторизация не пройдена - выводится url  и ссылка для авторизации
		?>
        <p>Доверенный redirect URI: <code><?php echo $vk_bot_uri; ?></code></p>
        <p><a href="<?php echo $vk->getLoginUrl(); ?>">Authenticate</a></p>
		<?php
	}
}
get_tameplate('footer.php');
