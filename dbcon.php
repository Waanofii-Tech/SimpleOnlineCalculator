<?php
	if(!is_file('db/db_calculator.sqlite3')){
		file_put_contents('db/db_calculator.sqlite3', null);
	}
	$dbcon = new PDO('sqlite:db/db_calculator.sqlite3');
	$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query = "CREATE TABLE IF NOT EXISTS user(users_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username TEXT, password TEXT, firstname TEXT, lastname TEXT)";
	$dbcon->exec($query);
    $querytwo = "CREATE TABLE IF NOT EXISTS history(question_id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, byuser TEXT, expression TEXT, result TEXT)";
	$dbcon->exec($querytwo);
?>