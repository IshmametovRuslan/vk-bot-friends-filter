<?php
/**
 * Created by PhpStorm.
 * User: Student
 * Date: 13.02.2018
 * Time: 20:35
 */
function get_header(){
	include 'header.php';
}
function init() {
	get_header();

	// проверка - передан ли атрибут строки action
	if ( ! empty( $_GET['action'] ) ) {

		// определение переменной
		$action = $_GET['action'];

		// если функция, имя которой соответствует значению переменной $action существует
		if ( function_exists( $action ) ) {

			// происходит вывозов указанной функции
			$action();
		}
	} else {
		my_func();
	}
}

function my_func() {
	include 'main.php';
}

/**
 * Получение списка пользователей VK с указанным id с помощью vk api
 *
 * @param null $user_ids
 *
 */
function get_users( $user_ids = null ) {
	global $vk;
	if ( ! empty( $_REQUEST['user_ids'] ) ) {
		$user_ids = $_REQUEST['user_ids'];
		$users    = $vk->api( 'users.get', array(
			'user_ids' => $user_ids,
			'fields'   => array(
				'photo_max',
				'photo',
				'city',
				'sex',
			),
		) );

		template_users( $users );
	} else {
		echo 'Укажите значение атрибута <code>user_ids</code>';
	}
}

/**
 * Вывод на экран и оформление списка пльзователей
 *
 * @param $users
 *
 */
function template_users( $users ) {
	if ( ! empty( $users ) ) {
		$out = '';
		if ( is_array( $users ) ) {
			foreach ( $users as $user ) {
				$out .= '<div class="users__item">' . template_user( $user ) . '</div>';
			}
		}

		$out = '<div class="users">' . $out . '</div>';

		echo $out;
	}
}


/**
 * Вывод на экран и оформление одного пользователя
 *
 * @param $user
 *
 * @return string
 *
 */
function template_user( $user ) {
	$link = '';
	if ( ! empty( $user['id'] ) ) {
		$link = '//vk.com/id' . $user['id'];
	}

	$keys = array(
		'first_name',
		'last_name',
		'photo_max',
		'city',
	);

	if ( is_array( $user ) ) {
		foreach ( $keys as $key ) {
			if ( empty( $user[ $key ] ) ) {
				$user[ $key ] = '';
			}
		}
	}
	if ( ! empty( $user['city']['title'] ) ) {
		$city = $user['city']['title'];
	} else {
		$city = '';
	}
	$out = '<a target="_blank" href="' . $link . '" class="user" style="background-image: url(' . $user['photo_max'] . ');">' .
	       '<div class="user__name">' . $user['first_name'] . ' ' . $user['last_name'] . '</div>' .
	       '<div class="user__city">' . $city . '</div>' .
	       '</a>';

	return $out;
}

/**
 * Получение списка друзей указанного пользователя Vk с помощью vk api
 *
 * @param null $user_ids
 *
 */
function get_friends( $user_ids = null ) {
	global $vk;
	global $users;
	$action = 'get_friends';

	if ( ! empty( $_REQUEST['user_ids'] ) ) {
		$limit = 8;

		if ( empty( $_GET['page'] ) ) {
			$page = 0;
		} else {
			$page = $_GET['page'];
		}

		$user_ids = $_REQUEST['user_ids'];
		$users    = $vk->api( 'friends.get', array(
			'user_id' => $user_ids,
			'offset'  => $limit * $page,
			'count'   => $limit,
			'fields'  => array(
				'photo_max',
				'photo',
				'city',
				'sex',
			),
		) );
		function gender_user( $users ) {
			return ( $users['items']['sex'] == '2' );
		}

		pagination( $limit, $action, $user_ids );

		template_users( $users['items'] );

	} else {
		echo 'Укажите значение атрибута <code>user_ids</code>';
	}
}

/**
 * Функция формирования и вывода постраничной пагинации
 *
 * @param $limit
 * @param $action
 * @param $user_id
 *
 */
function pagination( $limit, $action, $user_id ) {
	global $users;
	$start            = '';
	$users_count      = $users['count'];
	$count_pages      = ceil( $users_count / $limit - 1 );
	$active           = ( empty ( $_GET['page'] ) ? 0 : intval( $_GET['page'] ) );
	$count_show_pages = 3;
	$url_first        = '?user_ids=' . $user_id . '&action=' . $action . '&page=0';
	$url_page         = '?user_ids=' . $user_id . '&action=' . $action . '&page=';
	if ( $count_pages > 1 ) {
		$left  = $active - 1;
		$right = $count_pages - $active;

		if ( $left < floor( $count_show_pages / 2 ) ) {
			$start = 1;
		} else {
			$start = $active - floor( $count_show_pages / 2 );
		}
	}
	$end = $start + $count_show_pages - 1;

	if ( $end > $count_pages ) {
		$start -= ( $end - $count_pages );
		$end   = $count_pages;
		if ( $start < 1 ) {
			$start = 1;
		}
	}
	?>

	<div id="pagination">
		<span>Страницы: </span>
		<?php if ( $active != 0 ) { ?>
			<a href="<?= $url_first ?>" title="Первая страница">&lt;&lt;&lt;</a>
			<a href="<?php if ( $active == 2 ) { ?><?= $url_first ?><?php } else { ?><?= $url_page . ( $active - 1 ) ?><?php } ?>"
			   title="Предыдущая страница">&lt;</a>
		<?php } ?>
		<?php for ( $i = $start; $i <= $end; $i ++ ) { ?>
			<?php if ( $i == $active ) { ?><span><?= $i ?></span><?php } else { ?><a
				href="<?php if ( $i == 1 ) { ?><?= $url_first ?><?php } else { ?><?= $url_page . $i ?><?php } ?>"><?= $i ?></a><?php } ?>
		<?php } ?>
		<?php if ( $active != $count_pages ) { ?>
			<a href="<?= $url_page . ( $active + 1 ) ?>" title="Следующая страница">&gt;</a>
			<a href="<?= $url_page . $count_pages ?>" title="Последняя страница">&gt;&gt;&gt;</a>
		<?php } ?>
	</div>
	<?php
}


function styles() {
	?>
	<style>


	</style>
	<?php
}

