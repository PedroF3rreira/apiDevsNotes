<?php 
require_once'../config.php';

$method = $_SERVER['REQUEST_METHOD'];

if(strtolower($method) === 'post'){
	$title = filter_input(INPUT_POST, 'title');
	$body = filter_input(INPUT_POST, 'body');

	if($title && $body){

		$stmt = $pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
		$stmt->bindValue(':title', $title);
		$stmt->bindValue(':body', $body);
		$stmt->execute();

		$id = $pdo->lastInsertId();
		
		$array['result'] = [
			'id' => $id,
			'title' => $title,
			'body' => $body
		];
	}
	else{
		$array['error'] = 'não foram enviados os dados';
	}
}
else{
	$array['error'] = 'Método permitido GET'; 
}

require_once'../result.php';