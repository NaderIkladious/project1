<?php

$config = array(
	'username' => 'root',
	'password' => '1234'
);

function connect($config)
{
	try{
		$conn = new PDO('mysql:host=localhost;dbname=blogme',
						$config['username'],
						$config['password']);

		$conn->setAttribute(PDO::ATTR_ERRMODE, 	PDO::ERRMODE_EXCEPTION);
		return $conn;
	}catch(Exception $e) {
		return false;
	}
}

function get( $tableName, $conn, $col ="*", $where="", $order ="", $limit = 10, $max = null)
{	
	try {
		if ($max === null){
			$result = $conn->query("SELECT $col FROM $tableName $where $order LIMIT $limit");
		}else {
			$result = $conn->query("SELECT $col FROM $tableName $where $order LIMIT $limit , $max");
		}
		return ($result->rowCount() > 0)
		? $result
		: false;
	} catch (Exception $e) {
		return false;
		echo "Error: ". $e->getMessage();
		die();
	}

	
}


function query($query, $conn, $bindings = false)
{
	$result = $conn->prepare($query);
	if ($bindings){
	$result->execute($bindings);
	}
	$result = $result->fetchAll();
	return $result ? $result : false;
}

function get_by_id($id, $conn)
{
	return query('SELECT * FROM posts WHERE id = :id LIMIT 1',
				$conn,
				array('id' => $id));
}

function user($id, $conn)
{
	return query('SELECT username FROM users INNER JOIN posts on user_id = :id LIMIT 1',
					$conn,
					array('id' => $id))[0][0];
	
}

function name($user, $conn)
{
	return query('SELECT name FROM users WHERE username = :user LIMIT 1',
				 	$conn,
				 	array('user' => $user))[0][0];
}

function comments($id, $conn)
{
	return query("SELECT subject, comments.body, comments.date, uid FROM posts INNER JOIN comments WHERE pid = :pid GROUP BY cid",
					$conn,
					array('pid'	 => $id));
	 
}

// function search($term, $conn)
// {
// 	$result = query('SELECT title, catagory, body, username FROM posts INNER JOIN users WHERE title LIKE ":term" GROUP BY id',
// 					array('term' => $term),
// 					$conn);
// 	print_r($result); die();
// }

function search($term, $conn)
{
	try {	
		$result = $conn->query("SELECT title, catagory, body, posts.id, author_id, date, username FROM posts INNER JOIN users WHERE title LIKE '$term' GROUP BY id");
		return ($result->rowCount() > 0)
		? $result
		: false;
	} catch (Exception $e) {
		echo "Error: ". $e->getMessage();
		return false;
	}
}

// function valid($username, $password, $conn)
// {
// 	// $users = query('SELECT username, password FROM users',$conn);
// 	try {
// 		$users = $conn->query('SELECT username, password FROM users');
// 		foreach ($users as $user) {
// 			print_r($user);
// 			if ($username === $user['username'] && $password === $user['password']){
// 				// return true;
				

// 			}die();
// 	} catch(Exception $e) {
// 		echo "Error: ". $e->getMessage();
// 		die();
// 	}
	
// 	}
// 	return false;
// }
function all_users($conn)
{
	return $conn->query('SELECT * FROM users');
}
function valid($username, $password, $conn)
{
	// $users = query('SELECT username, password FROM users',$conn);

	$users = all_users($conn);
	foreach ($users as $user) {
		if ($username === $user['username'] && $password === $user['password']){
			return true;
		}
	}
		
	return false;
}

function user_exists($username, $conn)
{
	$users = all_users($conn);
	foreach ($users as $user) {
		if ($username === $user['username']){
			return true;
		}
	}

	return false;
}
function create_user($username, $password, $conn)
{
	try{
		$result = $conn->prepare("INSERT INTO users(username, password ) VALUES(:user, :pass)");
		$result->bindParam('user', $username, PDO::PARAM_STR);
		$result->bindParam('pass', $password, PDO::PARAM_STR);
		$result->execute();
	}catch(Exception $e) {
		echo "Error: " .$e->getMessage();
		die();
	}
}

function catagory($conn)
{
		return $conn->query('SELECT catagory FROM catagories ORDER BY catagory ASC');
}

function user_id($user, $conn)
{
	return query("SELECT user_id FROM users WHERE username = :user",
				 $conn,
				 array('user' => $user))[0][0];
}

function new_post($data, $conn)
{
	try{
		$result = $conn->prepare("INSERT INTO posts(catagory, title, body, date, author_id) VALUES(:categ, :title, :body, :date, :author_id )");
		$result->bindParam('categ', $data['categ'], PDO::PARAM_STR);
		$result->bindParam('title', $data['title'], PDO::PARAM_STR);
		$result->bindParam('body', $data['body'], PDO::PARAM_STR);
		$result->bindParam('date', $data['date'], PDO::PARAM_STR);
		$result->bindParam('author_id', user_id($data['author_id'], $conn), PDO::PARAM_INT);
		$result->execute();
	}catch(Exception $e) {
		echo "Error: " .$e->getMessage();
		die();
	}	
}

function change_name($new, $id, $conn)
{
	try{
		$result = $conn->prepare("UPDATE  users SET  name = :new WHERE user_id = :id");
		$result->bindParam('new', $new, PDO::PARAM_STR);
		$result->bindParam('id', $id, PDO::PARAM_INT);
		$result->execute();
	}catch(Exception $e) {
		echo "Error: " .$e->getMessage();
		die();
	}
}

function change_pass($old, $first, $second, $conn)
{
	// try{
		$result = $conn->prepare("UPDATE users SET password = :new WHERE username = :name");
		$result->bindParam('new', $first, PDO::PARAM_STR);
		$result->bindParam('name', $_SESSION['username'], PDO::PARAM_STR);
		$result->execute();
	// }catch(Exception $e) {
	// 	echo "Error: " .$e->getMessage();
	// 	die();
	// }
}

function bio($id, $conn)
{
	return query("SELECT bio FROM users WHERE user_id = :id",
				 $conn,
				 array('id' => $id))[0][0];
}

function change_bio($new, $id, $conn)
{
	try{
		$result = $conn->prepare("UPDATE  users SET  bio = :new WHERE user_id = :id");
		$result->bindParam('new', $new, PDO::PARAM_STR);
		$result->bindParam('id', $id, PDO::PARAM_INT);
		$result->execute();
		$_SESSION['username'] = $new;
	}catch(Exception $e) {
		echo "Error: " .$e->getMessage();
		die();
	}
}

// function user_posts($id, $conn)
// {
// 	return query("SELECT * FROM posts WHERE author_id = :id ORDER BY id DESC",
// 				 $conn,
// 				 array('id' => $id));

// }

// function new_comment($comment, $conn)
// {
// 	try {
// 		$result = $conn->prepare("INSERT INTO comments(uid, pid, subject, body, date) VALUES(:uid, :pid, :subject, :comment, :date )");
// 		$result->bindParam('uid', user_id($comment['user'], $conn), PDO::PARAM_INT);
// 		$result->bindParam('pid', $comment['post'], PDO::PARAM_INT);
// 		$result->bindParam('subject', $comment['subject'], PDO::PARAM_STR);
// 		$result->bindParam('body', $comment['cmt'], PDO::PARAM_STR);
// 		$result->bindParam('date', $comment['date'], PDO::PARAM_STR);
// 		$result->execute();
// 	}catch(Exception $e) {
// 		echo "Error: " .$e->getMessage();
// 		die();
// 	}
// }

function new_comment($new, $conn)
{
	try{
		$result = $conn->prepare("INSERT INTO comments(uid, pid, subject, body, date) VALUES(:user, :post, :subject, :cmt, :date )");
		$result->bindParam('user', user_id($new['user'], $conn), PDO::PARAM_INT);
		$result->bindParam('post', $new['post'], PDO::PARAM_INT);
		$result->bindParam('subject', $new['subject'], PDO::PARAM_STR);
		$result->bindParam('cmt', $new['cmt'], PDO::PARAM_STR);
		$result->bindParam('date', $new['date'], PDO::PARAM_STR);
		$result->execute();
	} catch(Exception $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

function remove_post($id, $conn)
{
	$result = $conn->prepare("DELETE FROM posts WHERE id = :id");
	$result->bindParam('id', $id, PDO::PARAM_INT);
	$result->execute();
}

function remove_user($id, $conn)
{
	$result = $conn->prepare("DELETE FROM users WHERE user_id = :id");
	$result->bindParam('id', $id, PDO::PARAM_INT);
	$result->execute();
}

function admin($id, $role, $conn)
{
	$result = $conn->prepare("UPDATE users SET is_admin = :role WHERE user_id = :id");
	$result->bindParam('role', $role, PDO::PARAM_INT);
	$result->bindParam('id', $id, PDO::PARAM_INT);
	$result->execute();
}

function is_admin($user, $conn)
{
	return query("SELECT is_admin FROM users WHERE username = :user",
					$conn,
					array('user' => $user))[0][0];
}

function post_count( $conn, $where = "")
{
	$result = $conn->query("SELECT COUNT(id) FROM posts $where LIMIT 1");
	return $result->fetchAll()[0][0];
}

