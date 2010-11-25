<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php echo $this->element('cpweb_cab'); ?>
<h2><?php __('Missing Database Table'); ?></h2>
<p class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php printf(__('Database table %1$s for model %2$s was not found.', true), '<em>' . $table . '</em>',  '<em>' . $model . '</em>'); ?>
</p>
<p class="notice">
	<strong><?php __('Notice'); ?>: </strong>
	<?php printf(__('If you want to customize this error message, create %s', true), APP_DIR . DS . 'views' . DS . 'errors' . DS . 'missing_table.ctp'); ?>
</p>
<p id="obs">
</p>
<?php 
	if ($this->viewVars['table']=='usuarios' && $this->viewVars['title']=='Tabela não encontrada no banco de dados')
	{
		$on_read_view  = "\n".'setTimeout(function(){ window.location="'.Router::url('/',true).'instala";  },4000);';
		$on_read_view .= "\n".'$("#obs").html("<h3>Aguarde um instante e você será redirecionado para a página de instalação</h3>")';
		$on_read_view .= "\n".'$("#obs").css("color","red")';
		$on_read_view .= "\n".'$("#obs").css("margin","50px 0px 0px 0px")';
		$on_read_view .= "\n".'$("#obs").css("text-align","center")';
		$this->set('on_read_view',$on_read_view);
	}
 ?>

