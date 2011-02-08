<br />
<br />
<br />
<?php if(isset($ok)) : ?>
<center><h2>Populução executa com sucesso</h2></center>
<?php else : ?>
<center><h2>Não foi possível executar a população !!!</h2>
<br />
<br />
Clique <a href="<?php echo Router::url('/',true).'popular/executar'; ?>">aqui</a> para tentar novamente.
</center>
<?php endif; ?>
<br />
<br />
<br />
<br />
<br />
<p>
<?php if(isset($msg)) echo $msg; ?>
</p>
