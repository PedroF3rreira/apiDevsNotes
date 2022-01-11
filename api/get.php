<?php 
require_once'../config.php';

$method = $_SERVER['REQUEST_METHOD'];

if(strtolower($method) === 'get'){
	
	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

	if($id){

		$stmt = $pdo->prepare('SELECT * FROM notes WHERE id = :id');
		
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			
			$data = $stmt->fetch(PDO::FETCH_ASSOC);
			$array['result'] = [
					'id' => $data['id'],
					'title' => $data['title'],
					'body' => $data['body']
				];
		}
		else{
			$array['error'] = 'Não foi encontrado registro';
		}
	}
	else{
		$array['error'] = 'id não encontrado';
	}
}
else{
	$array['error'] = 'Método permitido GET'; 
}

require_once'../result.php';