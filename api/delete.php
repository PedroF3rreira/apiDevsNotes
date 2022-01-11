<?php 
require_once'../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'delete'){
	
	parse_str(file_get_contents('php://input'), $input);

	$id = filter_var($input['id']??null);

	if($id){

		$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			
			$stmt = $pdo->prepare("DELETE FROM notes WHERE id = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
		}
		else{
			$array['error'] = 'id não existe';
		}
	}	
	else{
		$array['error'] = 'parametros estão vazios';
	}

}
else{
	$array['error'] = 'apenas método DELETE';
}

require_once'../result.php';