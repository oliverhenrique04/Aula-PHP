<table border="1" align="center" width="100%">
            <tr>
                <th bgcolor="#CCCCCC"><input type="checkbox" name="todos"></th>
                <th bgcolor="#CCCCCC">idproduto</th>
                <th bgcolor="#CCCCCC">Nome</th>
                <th bgcolor="#CCCCCC">Preço</th>
                <th bgcolor="#CCCCCC">Status</th>
            </tr>
            <?php
            $resultado = pg_query($conn, "SELECT * FROM produto");
            while ($linha = pg_fetch_assoc($resultado)) {

                //print_r($linha);
            ?>
            <tr>
                <td><input type="checkbox" name="todos"></td>
                <td><?php echo $linha["idproduto"] ;?></td>
                <td><?php echo $linha["produtonome"] ;?></td>
                <td><?php echo $linha["produtopreco"] ;?></td>
                <td><?php
                if($linha["produtostatus"] == "t") echo "Ativo";
                else echo "Desativado"
                ?>
                </td>
            </tr>    
            <?php
            }
            ?>
        </table>