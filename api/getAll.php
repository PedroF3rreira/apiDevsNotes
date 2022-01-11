<?php 
require_once'../config.php';

$method = $_SERVER['REQUEST_METHOD'];

if(strtolower($method) === 'get'){

	$sql = $pdo->query('SELECT * FROM notes');
	
	if($sql->rowCount() > 0){
		$data = $sql->fetchAll(PDO::FETCH_ASSOC);

		foreach($data as $note){
			$array['result'][] = [
				'id' => $note['id'],
				'title' => $note['title'],
				'body' => $note['body']
			];
		}
	}

}
else{
	$array['error'] = 'Método permitido GET'; 
}

require_once'../result.php';