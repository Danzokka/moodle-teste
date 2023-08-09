<?php
exit();
?>
-- O script do banco inicia abaixo ---





-- --------------------------------------------------------

CREATE TABLE `ead_zap_controle_msg` (
  `id` int(11) NOT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `id_zap_mensagens` varchar(25) DEFAULT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `resposta_z_api` text,
  `dt_disparo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ead_zap_controle_msg`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ead_zap_controle_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE `ead_zap_cursos` (
  `id` int(11) NOT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `nome` text,
  `inicio` bigint(20) NOT NULL DEFAULT '0',
  `fim` bigint(20) NOT NULL DEFAULT '0',
  `data_criacao` bigint(20) NOT NULL DEFAULT '0',
  `id_categoria` varchar(25) DEFAULT NULL,
  `json` text,
  `data_hora_json` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ead_zap_cursos`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ead_zap_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE `ead_zap_inscritos` (
  `id` int(11) NOT NULL,
  `iduser` varchar(25) DEFAULT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `nome` text,
  `telefone` varchar(25) DEFAULT NULL,
  `data_inscrito_no_curso` bigint(20) NOT NULL DEFAULT '0',
  `perfil_no_curso` varchar(125) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `username` varchar(225) DEFAULT NULL,
  `data_hora_json` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ead_zap_inscritos`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ead_zap_inscritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE `ead_zap_mensagens` (
  `id` int(11) NOT NULL,
  `tipo_mensagem` varchar(25) DEFAULT NULL COMMENT '1=msg curso, 2=msg usuário, 3=material do curso via whats',
  `perfil` varchar(25) DEFAULT NULL COMMENT '1=aluno, 2=professor',
  `nome_mensagem` varchar(255) DEFAULT NULL,
  `id_curso` varchar(25) DEFAULT NULL COMMENT 'deixar vazio envia para todos',
  `formato_mensagem` varchar(25) DEFAULT NULL COMMENT '1=por data, 2=após a inscrição',
  `dt_enviar` date DEFAULT NULL,
  `hora_enviar` time(6) DEFAULT NULL,
  `apos_inscricao_dias` varchar(25) DEFAULT NULL,
  `texto_msg` text,
  `responder_pesquisa` varchar(25) DEFAULT NULL,
  `emitir_certificado` varchar(25) DEFAULT NULL,
  `quantidade_modulos` varchar(25) DEFAULT NULL,
  `dt_mensagem_criada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ead_zap_mensagens`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `ead_zap_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- --------------------------------------------------------


CREATE TABLE `ead_zap_realizar_curso` (
  `id` int(11) NOT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `id_zap_mensagens` varchar(25) DEFAULT NULL,
  `modulo` text,
  `id_topico` text,
  `id_user` varchar(25) DEFAULT NULL,
  `resposta_z_api` text,
  `resposta_json` text,
  `dt_disparo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `ead_zap_realizar_curso`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `ead_zap_realizar_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- --------------------------------------------------------

CREATE TABLE `ead_zap_token_moodle` (
  `id` int(11) NOT NULL,
  `host_ead` text,
  `token` text,
  `campo_celular` varchar(50) DEFAULT NULL,
  `token_z_api` text,
  `token_wordpress` text,
  `dt_mensagem_criada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `ead_zap_token_moodle` (`id`, `host_ead`, `token`, `campo_celular`, `token_z_api`, `token_wordpress`, `dt_mensagem_criada`) VALUES
(1, 'https://moodledev.eadflex.com.br', '7dfa86ce3d27f6e3b5c902ea2f4107ad', '', 'https://api.z-api.io/instances/3A4ADBEE4AF0C043B5FF2EADE306FFE0/token/3605D26750C7B2DEA353B48E/', '7asd16fg3e21r6t3m5n9h2qa2f4107sa', '2023-05-03 07:56:36');

-- --------------------------------------------------------

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `apelido` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome_completo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seu_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sua_senha` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `escola` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genero` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO `usuarios` (`id`, `apelido`, `nome_completo`, `seu_email`, `sua_senha`, `fone`, `estado`, `cidade`, `escola`, `genero`, `avatar`) VALUES
(1, 'Dev', 'Desenvolvedor', 'desenvolvedor@avantebasil.com.br', '202cb962ac59075b964b07152d234b70', '6196661484', 'DF', 'Brasília', '3', 'Masculino', '644b1de2573ab-6.jpg'),
(2, 'Romulo', 'Romulo', '123', '202cb962ac59075b964b07152d234b70', '', 'DF', 'Brasília', '3', 'Masculino', NULL);

ALTER TABLE `ead_zap_token_moodle`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seu_email` (`seu_email`);



ALTER TABLE `ead_zap_token_moodle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
