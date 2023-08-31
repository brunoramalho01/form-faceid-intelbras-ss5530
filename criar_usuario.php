<?php
    require 'autoload.php'; // Carrega o arquivo de autoload
    use Intervention\Image\ImageManagerStatic as Image;
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new SQLite3('data/usuarios.db');

    //variaveis de dados do usuarios
    //$uuid = "";
    $nome = $_POST['nome'];
    $cartao = "";
    $tag = "";
    $senha = "";
    $controle = "";
    $email = $_POST['e_mail'];
    $rg = "";
    $cpf = $_POST['cpf'];
    $tel = $_POST['telefone_celular'];
    $matricula = "";
    $estado = "Ativo";
    $dt_inicial = "24/08/2023";
    $dt_final = "24/08/2099";
    $obs = "";
    $tp_usuario = "normal ";
    $num_dig = "0";
    $biometria = "";
    $modelo = "SS";
    $origem = "";
    $cartao_quant = "";
    $tag_uhf = "";
    $data_nascimento = $_POST['data'];
    $palestras = implode(", ", $_POST["palestras"]); // Converter o array de palestras em uma string

    // Lidar com o upload da foto
    $fotoNome = $_FILES['foto']['name'];
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoCaminhoOrigin = 'export/' . $fotoNome;
    move_uploaded_file($fotoTmp, $fotoCaminhoOrigin);

    // Redimensiona a foto para 480x640 pixels
    $nomeFotoArquivo = str_replace(' ', '_', $_POST['nome']); // Certifique-se de ter um input no seu formulário com o atributo 'name="nome_foto"'
    $fotoRedimensionada = "foto_" . $nomeFotoArquivo . ".jpg"; // Adicione a extensão de arquivo desejada
    $fotoPath = $fotoCaminhoOrigin;

    $image = Image::make($fotoPath)->resize(480, 640);
    $image->save('export/' . $fotoRedimensionada);
    $fotoCaminho = 'c:\\foto_' . $nomeFotoArquivo;

    // Exclui a imagem original após redimensionamento e salvamento
    unlink($fotoPath);

    $query = "INSERT INTO usuarios (uuid, Nome_Usuario, Cartao, Tag_uhf, Senha, Controle_remoto, E_mail, RG, CPF, Telefone_celular, Matricula, Estado, Data_inicial_Validade, Data_Final_Validade, Observacoes, Tipo_Usuario, num_digital, Biometria, Foto, modelo_digital, Origem, Cartao_quantidade_bits, Tag_uhf_quantidade_bits, Data_nascimento, Palestra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($query);
    $stmt->bindParam(1, $uuid);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $cartao);
    $stmt->bindParam(4, $tag);
    $stmt->bindParam(5, $senha);
    $stmt->bindParam(6, $controle);
    $stmt->bindParam(7, $email);
    $stmt->bindParam(8, $rg);
    $stmt->bindParam(9, $cpf);
    $stmt->bindParam(10, $tel);
    $stmt->bindParam(11, $matricula);
    $stmt->bindParam(12, $estado);
    $stmt->bindParam(13, $dt_inicial);
    $stmt->bindParam(14, $dt_final);
    $stmt->bindParam(15, $obs);
    $stmt->bindParam(16, $tp_usuario);
    $stmt->bindParam(17, $num_dig);
    $stmt->bindParam(18, $biometria);
    $stmt->bindParam(19, $fotoCaminho);
    $stmt->bindParam(20, $modelo);
    $stmt->bindParam(21, $origem);
    $stmt->bindParam(22, $cartao_quant);
    $stmt->bindParam(23, $tag_uhf);
    $stmt->bindParam(24, $data_nascimento);
    $stmt->bindParam(25, $palestras);

    $stmt->execute();

    $db->close();

    header("Location: index.php");
    exit();
}
?>
