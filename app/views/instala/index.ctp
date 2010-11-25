<?php echo $this->element('cpweb_cab'); ?>
<?php
	$on_read_view = isset($on_read_view) ? $on_read_view : '';
	require_once LIBS . 'model' . DS . 'connection_manager.php';
	$db = ConnectionManager::getInstance();
	@$connected = $db->getDataSource('default');
	if (!$connected->isConnected())
	{
		echo "<p class='sql_tit'>Peça ao Administrador do Banco de dados para executar os comandos abaixo.</p>";
		echo "<pre class='txt_sql'>";
		echo "create database ".$db->config->default['database'].";\n";
		echo "grant all privileges on ".$db->config->default['database'].".* to ";
		echo $db->config->default['login']."@localhost identified by \"".$db->config->default['password']."\" with grant option;\n";
		echo "flush privileges;\n";
		echo "</pre>";
		echo "<p class='sql_obs2'>* Para auterar as configurações do banco de dados, edite o arquivo app/config/database.php</p>";
		echo "<p class='sql_obs3'>Cliquei <a href=".$this->here.">aqui</a> para atualizar.</p>";
		$on_read_view .= "\n".'$("#instala").fadeOut();';
	}
?>

<?php if (isset($instala_ok)): ?>
<div id='instala_ok'>
<p>A instalação foi executada com sucesso !!!</p>
<p>Aguarde um instante e vocẽ será redirecionado para a tela inicial.</p>
<p>Clique <a href="<?php echo Router::url('/',true); ?>">aqui</a> para não esperar.</p>
</div>
<?php $on_read_view .= "\n".'setTimeout(function(){ window.location="'.Router::url('/',true).'";  },4000);'; ?>
<?php endif;?>

<div id='aguarde'>Aguarde ...</div>

<?php if (!isset($instala_ok)): ?>
<div id='instala'>

<p class='txt_topo'>Informe o login, senha e e-mail do usuário Administrador.</p>
<p class='txt_obs'>
	Este script irá executar as configurações básicas do sistema. Todos os dados serão apagados, então tenha certeza antes de prosseguir.
</p>

<?php echo $this->Form->create('instala',array('id'=>'formInstala','url'=>Router::url('/',true).'instala'))."\n"; ?>
<ul>
	<li><?php echo $this->Form->input('ed_host',	array('div'=>null,'label'=>array('text'=>'Host *'),'value'=>$db->config->default['host'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_banco',	array('div'=>null,'label'=>array('text'=>'Banco *'),'value'=>$db->config->default['database'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_usuario',	array('div'=>null,'label'=>array('text'=>'Usuário Banco *'),'value'=>$db->config->default['login'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_driver',	array('div'=>null,'label'=>array('text'=>'Driver *'),'value'=>$db->config->default['driver'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_admin',	array('div'=>null,'label'=>array('text'=>'Login *'),'value'=>'admin')); ?></li>
	<li><?php echo $this->Form->input('ed_nome',	array('div'=>null,'label'=>array('text'=>'Nome *'),'value'=>'')); ?></li>
	<li><?php echo $this->Form->input('ed_senha',	array('div'=>null,'label'=>array('text'=>'Senha *'),'type'=>'password')); ?></li>
	<li><?php echo $this->Form->input('ed_email',	array('div'=>null,'label'=>array('text'=>'e-mail *'))); ?></li>
</ul>
<?php echo $this->Form->end('Enviar'); ?>

<pre class='txt_obs2'>
*  Campos de preenchimento obrigatório
** Para alterar as configurações do banco de dados, edite o arquivo app/config/database.php
</pre>

<p class='txt_msg'><?php if (isset($msg)) echo $msg; ?></p>
<p class='txt_erro'><?php if (isset($erro)) echo $erro; ?></p>

</div>

<?php endif;?>

<?php
	$on_read_view .= "\n".'$("#instalaEdNome").focus();';
	$on_read_view .= "\n".'$("#formInstala").submit(function(){ $("#instala").fadeOut(1000); $("#aguarde").show(); });';
	$on_read_view .= "\n".'$("#userOn").fadeOut();';
	$on_read_view .= "\n".'$("#instalaEdNome").css("text-transform","uppercase")';
	$on_read_view .= "\n".'$("#instalaEdEmail").css("text-transform","lowercase")';
	$this->Html->css('instala.css', null, array('inline' => false));
	include_once('../views/cpweb_crud/rodape.ctp');
?>

