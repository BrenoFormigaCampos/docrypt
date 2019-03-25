<!DOCTYPE html>
<html>
<head>
<title>Criptografia</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="logo.gif" rel="shortcut icon">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'On');

//PEGA AS VARIAVEIS
if (!empty($_POST)) {
    $tipo  = $_POST['tipo'];
    $texto = $_POST['texto'];
}


?>
<div>
    <form class="col-md-12" method="POST" action="criptografia.php">

        <div class="form-group col-md-12">
            <label for="central"><?php echo 'Escolha uma opção:'; ?></label>
            <label class="radio-inline"><input type="radio" <?php echo (empty($tipo) || ($tipo != 'D')) ? 'checked ' : ''; ?>name="tipo" value="C">Criptografar</label>
            <label class="radio-inline"><input type="radio" <?php echo (!empty($tipo) && ($tipo == 'D')) ? 'checked ' : ''; ?> name="tipo" value="D">Descriptografar</label>
        </div>

        <div class="form-group col-md-12">
            <label for="texto">Texto:</label>
            <textarea class="form-control" rows="5" name="texto" placeholder="Digite o texto..." id="texto" ><?php echo isset($_POST['texto']) ? $_POST['texto'] : null ?></textarea>
        </div>

        <button type="submit" class="btn btn-success col-md-12">Enviar</button>
    </form>
</div>
<div>
    <form class="col-md-12">
        <div class="form-group">
            <label for="comment">Resultado:</label><br>

            <?php

            if (isset($_POST) && !empty($_POST)) {

                if ($_POST['tipo'] == 'C') {

                    // RECEBERÁ O TEXTO CRIPTOGRAFADO
                    $textoCriptografado = [];

                    // INVERTE TEXTO
                    $textoInvertido = inverterTexto($texto);

                    // CONVERTE EM ARRAY
                    $textoArray = converteStringParaArray($texto);

                    foreach ($textoArray as $chave => $valor) {
                        $valor = comparaCaracter($valor);

                        $letraCriptografada = retornaValorCriptografado($valor);

                        array_push($textoCriptografado, $letraCriptografada);
                    }
                    // CONVERTE NOVAMENTE EM STRING
                    $textoCriptografado = implode('', $textoCriptografado);

                    $textoCriptografado = inverterTexto($textoCriptografado);

                    echo $textoCriptografado;

                }else if ($_POST['tipo'] == 'D') {
                    // RECEBERÁ O TEXTO CRIPTOGRAFADO
                    $textoDescriptografado = [];

                    // INVERTE TEXTO
                    $textoInvertido = inverterTexto($texto);

                    // CONVERTE EM ARRAY
                    $textoArray = converteStringParaArray($texto);

                    foreach ($textoArray as $chave => $valor) {
                        $valor = comparaCaracter($valor);

                        $letraDescriptografada = retornaValorDescriptografado($valor, $chave);

                        array_push($textoDescriptografado, $letraDescriptografada);
                    }

                    // CONVERTE NOVAMENTE EM STRING
                    $textoDescriptografado = implode('', $textoDescriptografado);

                    $textoDescriptografado = inverterTexto($textoDescriptografado);

                    echo $textoDescriptografado;

                }
            }?>
        </div>
    </form>
</div>

<?php

function comparaCaracter($letra){

    $letra = strtoupper($letra);

    $dados =
    [
        "A" => 1,
        "B" => 2,
        "C" => 3,
        "D" => 4,
        "E" => 5,
        "F" => 6,
        "G" => 7,
        "H" => 8,
        "I" => 9,
        "J" => 10,
        "K" => 11,
        "L" => 12,
        "M" => 13,
        "N" => 14,
        "O" => 15,
        "P" => 16,
        "Q" => 17,
        "R" => 18,
        "S" => 19,
        "T" => 20,
        "U" => 21,
        "V" => 22,
        "W" => 23,
        "X" => 24,
        "Y" => 25,
        "Z" => 26,
        " " => " ",
    ];

    foreach ($dados as $chave => $valor) {
        if ($letra == $chave) {
            $posicao = $valor;
        }
    }

    return $posicao;
}

function retornaValorCriptografado($posicao){
    // SUBTRAI 10 DA POSIÇÃO CAPTURADA
    if ($posicao <= 10) {

        switch ($posicao) {
            case 10:
                $posicao = 26;
                break;
            case 9:
                $posicao = 25;
                break;
            case 8:
                $posicao = 24;
                break;
            case 7:
                $posicao = 23;
                break;
            case 6:
                $posicao = 22;
                break;
            case 5:
                $posicao = 21;
                break;
            case 4:
                $posicao = 20;
                break;
            case 3:
                $posicao = 19;
                break;
            case 2:
                $posicao = 18;
                break;
            case 1:
                $posicao = 17;
                break;
            default:
                break;
        }
    }else{
        $posicao = $posicao -10;
    }

    $dadosBusca =
    [
        "A" => 1,
        "B" => 2,
        "C" => 3,
        "D" => 4,
        "E" => 5,
        "F" => 6,
        "G" => 7,
        "H" => 8,
        "I" => 9,
        "J" => 10,
        "K" => 11,
        "L" => 12,
        "M" => 13,
        "N" => 14,
        "O" => 15,
        "P" => 16,
        "Q" => 17,
        "R" => 18,
        "S" => 19,
        "T" => 20,
        "U" => 21,
        "V" => 22,
        "W" => 23,
        "X" => 24,
        "Y" => 25,
        "Z" => 26,
        " " => " ",
    ];

    foreach ($dadosBusca as $chave => $valor) {
        if ($posicao == $valor) {
            $valorCriptografado = $chave;
        }
    }

    return $valorCriptografado;
}

function retornaValorDescriptografado($posicao, $chave){

    // ADICIONA 10 DA POSIÇÃO CAPTURADA
    if ($posicao >= 17) {

        switch ($posicao) {
            case 17:
                $posicao = 1;
                break;
            case 18:
                $posicao = 2;
                break;
            case 19:
                $posicao = 3;
                break;
            case 20:
                $posicao = 4;
                break;
            case 21:
                $posicao = 5;
                break;
            case 22:
                $posicao = 6;
                break;
            case 23:
                $posicao = 7;
                break;
            case 24:
                $posicao = 8;
                break;
            case 25:
                $posicao = 9;
                break;
            case 26:
                $posicao = 10;
                break;
            default:
                break;
        }
    }else{

        if ($posicao != " ") {
            $posicao = $posicao +10;
        }
    }

    $dadosBusca =
    [
        "A" => 1,
        "B" => 2,
        "C" => 3,
        "D" => 4,
        "E" => 5,
        "F" => 6,
        "G" => 7,
        "H" => 8,
        "I" => 9,
        "J" => 10,
        "K" => 11,
        "L" => 12,
        "M" => 13,
        "N" => 14,
        "O" => 15,
        "P" => 16,
        "Q" => 17,
        "R" => 18,
        "S" => 19,
        "T" => 20,
        "U" => 21,
        "V" => 22,
        "W" => 23,
        "X" => 24,
        "Y" => 25,
        "Z" => 26,
        " " => " ",
    ];

    foreach ($dadosBusca as $chave => $valor) {
        if ($posicao == $valor) {
            $valorDescriptografado = $chave;
        }
    }

    return $valorDescriptografado;
}

function inverterTexto($texto){
    return strrev($texto);
}

function converteStringParaArray($texto){
    return str_split($texto);

}

?>
</body>
</script>
</html>