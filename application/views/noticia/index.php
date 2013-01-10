<h1>MacFramework by hugo machado instalado<h1>
        <hr/>
        <h2>Eu sou a view noticia</h2>
        <table>
            <tr>
                <td>ID</td>
                <td>NOME</td>
                <td>EMAIL</td>
            </tr>
            <? foreach ($this->noticia as $noticia): ?>
                <tr>
                    <td><?= $noticia["id"] ?></td>
                    <td><?= $noticia["nome"] ?></td>
                    <td><?= $noticia["email"] ?></td>
                </tr>
            <? endforeach; ?>
        </table>

