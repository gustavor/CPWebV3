<?php echo $this->Form->create($modelClass, array('url'=>Router::url('/',true).'lotes_processos_solicitacoes/listar')); ?>
<?php require_once('../views/cpweb_crud/listar.ctp'); ?>
<?php echo $this->Form->end(); ?>
