Prezado(a) <?php echo $usuarioAtribuido['Usuario']['nome'] ?>,

O Sistema CPWeb está enviando este e-mail de notificação sobre a urgência no cumprimento da solicitação citada abaixo:

Data da Solicitação: <?php echo date('d/m/Y H:i:s',strtotime($solicitacao['ProcessoSolicitacao']['created']))."\n" ?>
Prazo Interno: <?php echo date('d/m/Y',strtotime($solicitacao['ProcessoSolicitacao']['prazo_interno']))."\n" ?>
Prazo Cliente: <?php echo date('d/m/Y',strtotime($solicitacao['ProcessoSolicitacao']['prazo_cliente']))."\n" ?>

Solicitação: <?php echo $solicitacao['Solicitacao']['solicitacao']."\n"; ?>

Observações:
--
<?php echo $solicitacao['ProcessoSolicitacao']['obs']."\n"; ?>
--

Solicitado por: <?php echo $usuarioSolicitante['Usuario']['nome']."\n"; ?>

ID do Processo: <?php echo 'VEBH-'.str_repeat('0',5-strlen($processo['Processo']['id'])).$processo['Processo']['id']."\n"; ?>
Número do Processo: <?php echo $processo['Processo']['numero']."\n"; ?>
Número Auxiliar do Processo: <?php echo $processo['Processo']['numero_auxiliar']."\n"; ?>

Para acessar a solicitação diretamente, o link abaixo pode ser utilizado:

http://cpweb.veadvogados.adv.br/processos_solicitacoes/editar/<?php echo $solicitacao['ProcessoSolicitacao']['id']."\n"."\n"; ?>

ATENÇÃO:
ESTA É UMA MENSAGEM AUTOMÁTICA E NÃO DEVE SER RESPONDIDA. QUALQUER RESPOSTA NÃO SERÁ MONITORADA

Sistema CPWeb
Copyright 2011-2012 - Valéria Esteves Advogados Associados
Copyright 2011-2012 - Gustavo Ramos

