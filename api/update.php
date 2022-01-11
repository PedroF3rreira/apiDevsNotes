<?php 
require_once'../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'put'){
	parse_str(file_get_contents('php://input'), $input);

	$id = filter_var($input['id']??null);
	$title = filter_var($input['title']??null);
	$body = filter_var($input['body']??null);

	if($id && $title && $body){
		
		$stmt = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			
			$stmt = $pdo->prepare("UPDATE notes SET  
			title = :title, 
			body = :body 
				WHERE id = :id");
			$stmt->bindValue(':id', $id);
			$stmt->bindValue(':title', $title);
			$stmt->bindValue(':body', $body);
			$stmt->execute();

			$array['result'] = [
				'id' => $id,
				'title' => $title,
				'body' => $body
			];

		}
		else{
			$array['error'] = "id não existe";
		}
		
	}
	else{
		$array['error'] = 'parametros estão vazios';
	}

}
else{
	$array['error'] = 'apenas método PUT';
}

require_once'../result.php';