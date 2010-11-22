<?php
require LIBS . 'model' . DS . 'connection_manager.php';
$db = ConnectionManager::getInstance();
echo $this->Form->create('instala')."\n";
?>
<h2>Instalação Cpweb</h2>
<div id='instala'>

<p class='txt_topo'>
Antes de enviar este formulário, certifique-se de que o arquivo 'config/database.php' foi criado e configurado corretamente, caso queira altera as configurações abaixo edite este mesmo arquivo.
</p>

<ul>
	<li><?php echo $this->Form->input('ed_host',	array('div'=>null,'label'=>array('text'=>'Host *'),'value'=>$db->config->default['host'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_banco',	array('div'=>null,'label'=>array('text'=>'Banco *'),'value'=>$db->config->default['database'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_usuario',	array('div'=>null,'label'=>array('text'=>'Usuário Banco *'),'value'=>$db->config->default['login'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_driver',	array('div'=>null,'label'=>array('text'=>'Driver *'),'value'=>$db->config->default['driver'], 'disabled'=>'disabled')); ?></li>
	<li><?php echo $this->Form->input('ed_admin',	array('div'=>null,'label'=>array('text'=>'Administrador *'),'value'=>'administrador')); ?></li>
	<li><?php echo $this->Form->input('ed_senha',	array('div'=>null,'label'=>array('text'=>'Senha *'))); ?></li>
	<li><?php echo $this->Form->input('ed_email',	array('div'=>null,'label'=>array('text'=>'e-mail *'))); ?></li>
</ul>
<?php echo $this->Form->end('Enviar'); ?>

<p class='txt_obs1'><span>OBSERVAÇÃO:</span> Certifique-se que o seu DBA tenho executado os comandos abaixo:</p>
	
<pre class='txt_sql'>
create database <?php echo $db->config->default['database']; ?>;
grant all privileges on <?php echo $db->config->default['database']; ?>.* to <?php echo $db->config->default['login']; ?>@localhost identified by "senha**" with grant option;
flush privileges;
</pre>

<pre class='txt_obs2'>
*  Campos de preenchimento obrigatório
** A senha deve estar cadastrada no arquivo app/config/database.php
</pre>

</div>

<?
	$on_read_view = "\n".'$("#instalaEdAdmin").focus();';
	$this->Html->css('instala.css', null, array('inline' => false));
	include_once('../views/cpweb_crud/rodape.ctp');
?>

