<?php $on_read_view_sub_form = ''; ?>
<div id="menu_relatorios">
<ul>
	<li id="l1"><span>Processos Solicitações</span>
		<ul id="p1">
			<li><a href="<?php echo Router::url('/',true).'relatorios/processos1';?>">Quantitativo</a></li>
			<li><a href="<?php echo Router::url('/',true).'relatorios/processos1';?>">Qualitativo</a></li>
		</ul>
	</li>
</ul>
</div>
<?php $this->set('on_read_view_sub_form',$on_read_view_sub_form); ?>
