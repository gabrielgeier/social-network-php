<?php

	session_start();

	include_once('menu.php');
	include_once('header.php');

	(string)$Url = "$_SERVER[REQUEST_URI]";

	if (strpos($Url, "handlers")) {
		include('handlers.php');
	}

	elseif (strpos($Url, "profile_view")) {
		include_once('profile.php');
	}

	elseif (strpos($Url, "profile_edit")) {
		include_once('profile_edit.php');
	}

	elseif (strpos($Url, "user_feed")) {
		include_once('user_feed.php');
	}

	elseif (strpos($Url, "other_feed")) {
		include_once('other_feed.php');
	}

	elseif (strpos($Url, "delete_form")) {
		include_once('delete_form.php');
	}

	elseif (strpos($Url, "search_form")) {
		include_once('search_form.php');
	}

	elseif (strpos($Url, "friends_feed")) {
		include_once('friends_feed.php');
	}

	elseif (strpos($Url, "friend_list_user")) {
		include_once('friend_list.php');
	}

	elseif (strpos($Url, "friend_list_other")) {
		include_once('friend_list_other.php');
	}

	elseif (strpos($Url, "friend_requests")) {
		include_once('friend_requests.php');
	}

	elseif (strpos($Url, "book_metadata_form")) {
		include_once('book_metadata_form.php');
	}

	elseif (strpos($Url, "book_file_form")) {
		include_once('book_file_form.php');
	}

	elseif (strpos($Url, "book_language_edit")) {
		include_once('book_language_form_edit.php');
	}

	elseif (strpos($Url, "book_language_form")) {
		include_once('book_language_form.php');
	}

	elseif (strpos($Url, "book_image_form")) {
		include_once('book_image_form.php');
	}

	elseif (strpos($Url, "book_info_view")) {
		include_once('book_info_view.php');
	}

	elseif (strpos($Url, "book_language_view")) {
		include_once('book_language_view.php');
	}

	elseif (strpos($Url, "book_info_edit")) {
		include_once('book_info_edit.php');
	}

	elseif (strpos($Url, "book_image_edit")) {
		include_once('book_image_form_edit.php');
	}

	elseif (strpos($Url, "book_comments")) {
		include_once('book_comments.php');
	}

	elseif (strpos($Url, "other_books")) {
		include_once('other_books.php');
	}

	elseif (strpos($Url, "search_result")) {
		include_once('../back-end/search_result.php');
	}

	elseif (strpos($Url, "my_books")) {
		include_once('my_books.php');
	}

	elseif (strpos($Url, "profile_other")) {
		include_once('profile_other.php');
	}

	elseif (strpos($Url, "book_action_view")) {
		include_once('book_action_view.php');
	}

	elseif (strpos($Url, "book_action_download")) {
		include_once('book_action_download.php');
	}

	elseif (strpos($Url, "ranking_authors")) {
		include_once('ranking_authors.php');
	}

	elseif (strpos($Url, "ranking_books")) {
		include_once('ranking_books.php');
	}

	elseif (strpos($Url, "ranking_languages")) {
		include_once('ranking_languages.php');
	}

	elseif (strpos($Url, "ranking_genres")) {
		include_once('ranking_genres.php');
	}

	elseif (strpos($Url, "book_delete")) {
		include_once('book_delete_form.php');
	}

	elseif (strpos($Url, "my_stats")) {
		include_once('stats_user.php');
	}

	elseif (strpos($Url, "stats_other")) {
		include_once('stats_other.php');
	}

	elseif (strpos($Url, "book_stats")) {
		include_once('book_stats.php');
	}

	elseif (strpos($Url, "user_favorites")) {
		include_once('user_favorites.php');
	}

	elseif (strpos($Url, "other_favorites")) {
		include_once('other_favorites.php');
	}

	else{

	}

?>

</body>
</html>