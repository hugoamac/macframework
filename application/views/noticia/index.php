<h1>MacFramework by hugo machado instalado</h1>
<hr/>
<h2>Eu sou a view noticia</h2>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>ID</td>
        <td>Título</td>
        <td>Fonte</td>
    </tr>
    <? foreach ($this->noticia as $noticia): ?>
        <tr>
            <td><?= $noticia->id ?></td>
            <td><?= $noticia->titulo ?></td>
            <td><?= $noticia->fonte ?></td>
        </tr>
    <? endforeach; ?>
</table>

