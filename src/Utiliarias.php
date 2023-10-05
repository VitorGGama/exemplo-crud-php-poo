<?php
abstract class Utilitarios {
    public static function  formatarPreco( float $valor ):string {
        $valorFormatado = number_format($valor, 2, ",", ".");
        return "R$ " . $valorFormatado;
    }
    
    public static function calcularTotal(float $valor, int $qtd):string {
        $total = $valor * $qtd;
        return formatarPreco($total);
    }
}
    