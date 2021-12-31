<form method="POST">
	Dezenas: <input type="text" name="txtDezenas"/>
	<br/>
	Quantidade de Jogos: <input type="text" name="txttotal_jogos"/>
	<br/>
	<input type="submit" value="Gerar Jogos"/>
</form>
<?php

  class Jogos{
  
		private $dezenas;
		private $resultado;
		private $total_jogos;
		private $jogos;
		
		# Construtor da classe
		function __construct($quantidade_dezenas, $total_jogos){
			
			if($quantidade_dezenas >= 6 and $quantidade_dezenas <= 10){

				# Atribuindo a quantidade de dezenas e total de jogos
				$this->setDezenas($quantidade_dezenas);
				$this->setTotalJogos($total_jogos);
				#$this->NumeracaoDezenas();
				$this->ReceberQuantidadeJogos();
			
			}else{
				echo "Numero de Dezenas deve ser entre 6 a 10.";
			}
		}

		# RESPOSTA NUMERO 04
		private function NumeracaoDezenas(){
			
			$array = array();
			for($i=1;$i<=60;$i++){
				$array[$i] = $i;
			}
			return $array;
		}	

		public function ReceberQuantidadeJogos (){
			
			$arrayQuantidadeJogos = array();
			$quantidadeJogos      = $this->getTotalJogos();
			for($i=1;$i<=$quantidadeJogos;$i++){
				# CHAMAR O METODO DO SORTEIO
				$arrayQuantidadeJogos[$i] = $this->RealizarSorteio();
			}
		
			#return $arrayQuantidadeJogos;
			$this->setJogos($arrayQuantidadeJogos);
		}	
		
		public function RealizarSorteio(){
			
			$arrayQuantidadeNumeros = array();
			$quantidadeDezenas      = $this->getDezenas();
			
			for($i=1;$i<=$quantidadeDezenas;$i++){
				#$v_dezenas  = $this->NumeracaoDezenas();
				$numero = rand(1,60);
				$gera   = array_rand($this->NumeracaoDezenas(), 1);
				
				if( in_array( $gera ,$arrayQuantidadeNumeros ) ){
					#$gera = rand(1,60);
					$gera = array_rand($this->NumeracaoDezenas(), 1);
					$arrayQuantidadeNumeros[$gera] = $gera;
				}else{
					$arrayQuantidadeNumeros[$gera] = $gera;
				}
			}
			
			ksort($arrayQuantidadeNumeros);
			$this->setResultado($arrayQuantidadeNumeros);
				
			return $arrayQuantidadeNumeros;
		
		}
	  
		public function ResultadoSorteio() {
			
			$resultado = $this->getJogos();
			
			$html = "<table><th colspan=10>RESULTADO</th>";
			foreach($resultado as $key => $vetor){
				$html .="<tr>";
				foreach ($vetor as $chave => $valor){
					$html .= "<td>".$valor."<td>"; 
				}
				$html .="<tr>";
			}
			$html .="</table>";
			
			return $html;
		}
	  
	  
		# Metodos SET
		public function setDezenas($nova_dezena){
			$this->dezenas = $nova_dezena;
		}

		public function setResultado($novo_resultado){
			$this->resultado = $novo_resultado;
		}

		public function setTotalJogos($novo_total_jogos){
			$this->total_jogos = $novo_total_jogos;
		}
	  
		public function setJogos($novo_jogo){
			$this->jogos = $novo_jogo;
		}
		
		# Métodos GET
		public function getDezenas(){
			return $this->dezenas;
		}

		public function getResultado(){
			return $this->resultado;
		}

		public function getTotalJogos(){
			return $this->total_jogos;
		}
	  
		public function getJogos(){
			return $this->jogos;
		}
  
  }

if($_POST['txtDezenas'] != '' and $_POST['txttotal_jogos'] != ''){
	
	$obj = new Jogos($_POST['txtDezenas'],$_POST['txttotal_jogos']);
	
	/*echo "<pre>";
	print_r($obj->getJogos());
	echo "</pre>";
	
	echo "<pre>";
	print_r($obj->getResultado());
	echo "</pre>";*/
	
	
	echo $obj->ResultadoSorteio();
	
}

?>