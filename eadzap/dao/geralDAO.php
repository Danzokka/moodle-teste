<?php
class GeralDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::getInstance();
    }

    public function get_results($sql) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $dados;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
	function query($sql){
		try{
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
		} catch(PDOExeption $exec){
			echo $exec->getMessage();
		}
	}
	
	public function InsertRetornarId($sql) {
        try {			
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
			return $this->pdo->lastInsertId();
        } catch (PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function GeralContItens($sql) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $dados = $stmt->rowCount();
            return $dados;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }
	
}
?>