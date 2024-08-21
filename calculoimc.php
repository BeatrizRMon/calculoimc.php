<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #1e2a47;
            margin-top: 50px;
        }
        form {
            display: inline-block;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            font-size: 18px;
            color: #1e2a47;
            display: block;
            margin-bottom: 10px;
            text-align: left;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #00b894;
            color: white;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border-radius: 20px;
            border: none;
            background-color: #1e2a47;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #16203a;
        }
        .resultado {
            font-size: 20px;
            font-weight: bold;
            color: #1e2a47;
            margin-top: 30px;
        }
        hr {
            margin: 50px 0;
            border: none;
            border-top: 1px solid #1e2a47;
        }
    </style>
</head>
<body>
    <h1>CALCULADORA DE IMC</h1>
    <form method="post" action="">
        <label for="altura">Altura:</label>
        <input type="text" id="altura" name="altura" placeholder="Ex: 1.75" required>
        
        <label for="peso">Peso:</label>
        <input type="text" id="peso" name="peso" placeholder="Ex: 70" required>
        
        <input type="submit" value="Calcular IMC">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $altura = floatval($_POST['altura']);
        $peso = floatval($_POST['peso']);

        if ($altura > 0 && $peso > 0) {
            $imc = $peso / ($altura * $altura);
            $imc = number_format($imc, 2);

            // Função para classificar o IMC
            function classificarIMC($imc) {
                $faixas = [
                    'Magreza' => 18.5,
                    'Saudável' => 24.9,
                    'Sobrepeso' => 29.9,
                    'Obesidade Grau I' => 34.9,
                    'Obesidade Grau II' => 39.9,
                    'Obesidade Grau III' => PHP_FLOAT_MAX
                ];

                foreach ($faixas as $classificacao => $valorMaximo) {
                    if ($imc <= $valorMaximo) {
                        return "Atenção, seu IMC é $imc, e você está classificado como $classificacao.";
                    }
                }
            }

            echo "<div class='resultado'>";
            echo "<h2>RESULTADO:</h2>";
            echo "<p>" . classificarIMC($imc) . "</p>";
            echo "</div>";
        } else {
            echo "<p class='resultado'>Por favor, insira valores válidos para altura e peso.</p>";
        }
    }
    ?>

    <hr>
</body>
</html>
