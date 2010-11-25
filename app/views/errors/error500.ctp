<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<h2><?php echo $name; ?></h2>
<p class="error">
	<strong><?php __('Error'); ?>: </strong>
	<?php printf(__('An Internal Error Has Occurred.', true), "<strong>'{$message}'</strong>"); ?>
</p>
<br />
<br />
<p>
	Ative a opção de debug, no arquivo app/config/core.php, para verificar maiores detalhes do problema.
	<br />
	<br />
	<br />
	clique <a href="http://book.cakephp.org/pt/view/1189/Debugging" target="_blank">aqui</a> para saber mais sobre a depuração do cakePHP.
	<br />
	<br />
	<br />
	clique <a href="<?php echo $this->here; ?>">aqui</a> após da ativação.
</p>
