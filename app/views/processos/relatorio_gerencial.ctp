<center><h1>Relatório Gerencial - Temporário</h1></center>
<center>
    <br />
    <p>Número de Processos por Tipo:</p>
    <?php foreach($countProcessoByTipo as $Tipo => $Quantidade): ?>
        <ol><?php echo $Tipo.' : '.$Quantidade?></ol>
    <?php endforeach; ?>
    <br />
    <p>Número de Processos por Advogado Associado:</p>
    <?php foreach($numeroProcessos as $Advogado => $Quantidade): ?>
        <ol><?php echo $Advogado.' : '.$Quantidade?></ol>
    <?php endforeach; ?>

</center>