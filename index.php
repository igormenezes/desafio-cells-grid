<?php

class ConexaoCelulasEmGrade{
    private $area;
    private $areaRepetida;
    private $contador_regioes = [];
    private $contador = 0;

    public function verificarMatriz(){
        $input = fopen("php://stdin", "r");
        //$input = fopen('input.txt', "r");
        $quantidade_linhas = fgets($input);
        $quantidade_colunas = fgets($input);
        $arr = [];

        for($i = 0; $i < $quantidade_linhas; $i++){
            $linha = $i + 1;
            $coluna = 1;

            $linha_atual = fgets($input);
            $arr[] = explode(' ', trim($linha_atual)); 

            foreach($arr[$i] as $valor){
                $this->area[$linha][$coluna] = $valor; 
                $coluna++;   
            } 
        }

        for($i = 0; $i < $quantidade_linhas; $i++){
            $linha = $i + 1;
            $coluna = 1;

            foreach($this->area[$linha] as $valor){
                $this->contador = 0;
                $this->areaRepetida = null;

                if($valor == 1){
                    $this->calcularNumeroConexoes($linha, $coluna);
                }

                $this->contador_regioes[] = $this->contador;
                $coluna++;
            }
        }

        return max($this->contador_regioes);
    }

    private function calcularNumeroConexoes($linha, $coluna){
        if(isset($this->area[$linha][$coluna]) && $this->area[$linha][$coluna] == 1 && empty($this->areaRepetida[$linha][$coluna])){
            $this->areaRepetida[$linha][$coluna] = true;
            $this->contador ++;

            $this->calcularNumeroConexoes($linha - 1, $coluna - 1);
            $this->calcularNumeroConexoes($linha - 1, $coluna);
            $this->calcularNumeroConexoes($linha - 1, $coluna + 1);
            $this->calcularNumeroConexoes($linha, $coluna - 1);
            $this->calcularNumeroConexoes($linha, $coluna + 1);
            $this->calcularNumeroConexoes($linha + 1, $coluna - 1);
            $this->calcularNumeroConexoes($linha + 1, $coluna);
            $this->calcularNumeroConexoes($linha + 1, $coluna + 1);
        }        
    }
}

$desafio = new ConexaoCelulasEmGrade();
$resultado = $desafio->verificarMatriz();
echo $resultado;