<?php

include_once("modelo.php");

function rotas($url)
{

    $dados = explode("/", $url);

    // CADASTRAR
    if (strcmp($dados[0], "cadastrar") == 0) {
        echo "<script> window.location='viewCadastrar.php' </script>";
    }
    // ALTERAR
    else if (strcmp($dados[0], "alterar") == 0) {
        // Obtem dados do curso escolhido para alteração
        $pessoa = select_where(trim($dados[1]));

        if ($pessoa == null) {
            echo "<script> alert('CPF da pessoa NÃO ENCONTRADO!') </script>";
        } else {
            $url = "viewAlterar.php?cpf=" . trim($dados[1]) . "&nome=" . $pessoa[0] . "&endereco=" . $pessoa[1] . "&telefone=" . trim($pessoa[2]);
            echo "<script> window.location='" . $url . "' </script>";
        }
    }
    // Remover
    else if (strcmp($dados[0], "remover") == 0) {
        echo "<script> window.location='viewRemover.php?cpf=" . $dados[1] . "' </script>";
    }
}

function cadastrar()
{

    // Monta o array
    $dados = array(
        $_POST['cpf'] => array(
            "nome" => $_POST['nome'],
            "endereco" => $_POST['endereco'],
            "telefone" => $_POST['telefone']
        )
    );

    insert($dados);
    echo "<script> window.location='viewMain.php' </script>";
}

function alterar()
{
    // Monta o array
    $dados = array(
        $_POST['cpf'] => array(
            "nome" => $_POST['nome'],
            "endereco" => $_POST['endereco'],
            "telefone" => $_POST['telefone']
        )
    );

    update($dados, $_POST['cpf']);
    echo "<script> window.location='viewMain.php' </script>";
}

function delete()
{
    // Monta o array
    $dados = array(
        $_POST['cpf'] => array(
            "nome" => $_POST['nome'],
            "endereco" => $_POST['endereco'],
            "telefone" => $_POST['telefone']
        )
    );

    delete($dados);
    echo "<script> window.location='viewMain.php' </script>";
}

function loadPessoas()
{
    $pessoas = select();

    foreach ($pessoas as $cpf => $dados) {

        if (!empty($dados)) {
            echo "<tr>";
            echo "<td class='d-none d-md-table-cell'>" . $cpf . "</td>";

            $cont = 0;
            foreach ($dados as $valor) {
                if ($cont == 0)
                    echo "<td>" . $valor . "</td>";
                else
                    echo "<td class='d-none d-md-table-cell'>" . $valor . "</td>";

                $cont++;
            }

            echo "<td>";
            echo "<button type='submit' name='acao' value='alterar/" . $cpf . "' class='btn btn-success'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='#FFF' class='bi bi-arrow-counterclockwise' viewBox='0 0 16 16'>";
            echo "<path fill-rule='evenodd' d='M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z'/>";
            echo "<path d='M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z'/>";
            echo "</svg>";
            echo "</button>";
            echo "&nbsp";
            echo "<button type='submit' name='acao' value='remover/" . $cpf . "' class='btn btn-danger'>";
            echo "<svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='#FFF' class='bi bi-trash-fill' viewBox='0 0 16 16'>";
            echo "<path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>";
            echo "</svg>";
            echo "</button>";
            echo "</td>";
            echo "</tr>";
        }
    }
}
