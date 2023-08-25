<?php

    require 'autoload.php'; // Carrega o arquivo de autoload
    use Intervention\Image\ImageManagerStatic as Image;

    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Função para remover caracteres especiais e manter apenas letras
        function sanitizeName($name) {
        // Mapeamento de caracteres especiais acentuados para suas versões sem acento
        $charMap = array(
            'á' => 'a', 'à' => 'a', 'ã' => 'a', 'â' => 'a', 'ä' => 'a', 'Á' => 'A', 'À' => 'A', 'Ã' => 'A', 'Â' => 'A', 'Ä' => 'A',
            'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e', 'É' => 'E', 'È' => 'E', 'Ê' => 'E', 'Ë' => 'E',
            'í' => 'i', 'ì' => 'i', 'î' => 'i', 'ï' => 'i', 'Í' => 'I', 'Ì' => 'I', 'Î' => 'I', 'Ï' => 'I',
            'ó' => 'o', 'ò' => 'o', 'õ' => 'o', 'ô' => 'o', 'ö' => 'o', 'Ó' => 'O', 'Ò' => 'O', 'Õ' => 'O', 'Ô' => 'O', 'Ö' => 'O',
            'ú' => 'u', 'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'Ú' => 'U', 'Ù' => 'U', 'Û' => 'U', 'Ü' => 'U',
            'ç' => 'c', 'Ç' => 'C'
        );
        
        
        // Realiza a substituição de caracteres especiais no nome
        $name = strtr($name, $charMap);
        // Remove espaços extras
        $name = preg_replace('/\s+/', ' ', $name);
        // Remove espaços no início e no final
        $name = trim($name);
        // Converte para letras minúsculas (opcional)
        $name = strtolower($name);
        // Converte a primeira letra de cada palavra para maiúscula (opcional)
        $name = ucwords($name);
        return $name;
    }
    
        
        //variaveis que salvam os dados do formulario
        $uuid = "";
        $nome = sanitizeName($_POST["nome"]);
        $cartao = "";
        $tag = "";
        $senha = "";
        $controle = "";
        $email = "";
        $rg = "";
        $cpf = "";
        $tel = "";
        $matricula = "";
        $estado = "";
        $dt_inicial = "24/08/2023";
        $dt_final = "24/08/2099";
        $obs = "";
        $tp_usuario = "normal ";
        $num_dig = "0";
        $biometria = "";
        $foto = $_FILES["foto"];
        $modelo = "BIOT";
        $origem = "InControl";
        $cartao_quant = "";
        $tag_uhf = "";



        // Pasta onde as fotos serão salvas
        $uploadDirectory = "dados/";
        $uploadDirectoryfoto = "C:\\"; //- codigo comentado
        
        // Verifica se a pasta de img existe, se não, cria-a
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Gera um número de registro único
        $registroUnico = str_pad(rand(1, 9999), 4, "0", STR_PAD_LEFT);

        // Gera um nome único para a foto
        $nomeFoto = $nome . "_" . $registroUnico . ".jpg"; // Substitua ".jpg" pelo formato real da foto
        $nomeFoto = str_replace(' ', '_', $nomeFoto);

        $fotoPath1 = $uploadDirectoryfoto . "foto_" . $nomeFoto;

        // Move a foto para a pasta de uploads
        $fotoPath = $uploadDirectory . $nomeFoto;
        move_uploaded_file($foto["tmp_name"], $fotoPath);
        
        // Redimensiona a foto para 600x800 pixels
        $resizedFotoPath = $uploadDirectory . "foto_" . $nomeFoto;
        $image = Image::make($fotoPath)->resize(600, 800);
        $image->save($resizedFotoPath);

        // Exclui a imagem original após redimensionamento e salvamento
        unlink($fotoPath);

        // Dados a serem salvos no CSV
        $data = array($uuid, $nome, $cartao, $tag, $senha, $controle, $email, $rg, $cpf, $tel, $matricula, $estado, $dt_inicial, $dt_final, $obs, $tp_usuario, $num_dig, $biometria, $fotoPath1, $modelo, $origem, $cartao_quant, $tag_uhf);
        
        // Caminho do arquivo CSV
        $csvFilePath = "dados/usuario.csv";
        
        // Abre o arquivo CSV para escrita
        $file = fopen($csvFilePath, "a");
        
        // Define o separador como ";"
        $delimiter = ";";

        if (filesize($csvFilePath) === 0) {
            // Cabeçalho do arquvio usuario.csv
            $header = array(
                "uuid", "Nome_Usuario", "Cartao", "Tag_uhf", "Senha", "Controle_remoto", 
                "E_mail", "RG", "CPF", "Telefone_celular", "Matricula", "Estado", 
                "Data_inicial_Validade", "Data_Final_Validade", "Observacoes", 
                "Tipo_Usuario", "num_digital", "Biometria", "Foto", "modelo_digital", 
                "Origem", "Cartao_quantidade_bits", "Tag_uhf_quantidade_bits"
            );
            fputcsv($file, $header, $delimiter);
        }
        
        // Escreve os dados no arquivo CSV
        fputcsv($file, $data, $delimiter);

        // Fecha o arquivo
        fclose($file);

        echo "Dados salvos com sucesso em usuario.csv!";
    } else {
        echo "Método não permitido.";
    }
?>
