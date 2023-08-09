-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/07/2023 às 13:45
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `csv_db 6`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ead_zap_controle_msg`
--

CREATE TABLE `ead_zap_controle_msg` (
  `id` int(11) NOT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `id_zap_mensagens` varchar(25) DEFAULT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `resposta_z_api` text DEFAULT NULL,
  `dt_disparo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ead_zap_cursos`
--

CREATE TABLE `ead_zap_cursos` (
  `id` int(11) NOT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `nome` text DEFAULT NULL,
  `inicio` bigint(20) NOT NULL DEFAULT 0,
  `fim` bigint(20) NOT NULL DEFAULT 0,
  `data_criacao` bigint(20) NOT NULL DEFAULT 0,
  `id_categoria` varchar(25) DEFAULT NULL,
  `json` text DEFAULT NULL,
  `data_hora_json` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ead_zap_inscritos`
--

CREATE TABLE `ead_zap_inscritos` (
  `id` int(11) NOT NULL,
  `iduser` varchar(25) DEFAULT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `nome` text DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `data_inscrito_no_curso` bigint(20) NOT NULL DEFAULT 0,
  `perfil_no_curso` varchar(125) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `username` varchar(225) DEFAULT NULL,
  `data_hora_json` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ead_zap_mensagens`
--

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
  `texto_msg` text DEFAULT NULL,
  `responder_pesquisa` varchar(25) DEFAULT NULL,
  `emitir_certificado` varchar(25) DEFAULT NULL,
  `quantidade_modulos` varchar(25) DEFAULT NULL,
  `dt_mensagem_criada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ead_zap_realizar_curso`
--

CREATE TABLE `ead_zap_realizar_curso` (
  `id` int(11) NOT NULL,
  `id_curso` varchar(25) DEFAULT NULL,
  `id_zap_mensagens` varchar(25) DEFAULT NULL,
  `modulo` text DEFAULT NULL,
  `id_topico` text DEFAULT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `resposta_z_api` text DEFAULT NULL,
  `resposta_json` text DEFAULT NULL,
  `dt_disparo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ead_zap_token_moodle`
--

CREATE TABLE `ead_zap_token_moodle` (
  `id` int(11) NOT NULL,
  `host_ead` text DEFAULT NULL,
  `token` text DEFAULT NULL,
  `campo_celular` varchar(50) DEFAULT NULL,
  `token_z_api` text DEFAULT NULL,
  `token_wordpress` text DEFAULT NULL,
  `dt_mensagem_criada` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ead_zap_token_moodle`
--

INSERT INTO `ead_zap_token_moodle` (`id`, `host_ead`, `token`, `campo_celular`, `token_z_api`, `token_wordpress`, `dt_mensagem_criada`) VALUES
(1, 'https://moodledev.eadflex.com.br', '7dfa86ce3d27f6e3b5c902ea2f4107ad', '', 'https://api.z-api.io/instances/3A4ADBEE4AF0C043B5FF2EADE306FFE0/token/3605D26750C7B2DEA353B48E/', '7asd16fg3e21r6t3m5n9h2qa2f4107sa', '2023-05-03 07:56:36');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `seu_email` varchar(200) DEFAULT NULL,
  `sua_senha` varchar(255) DEFAULT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `escola` varchar(200) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `avatar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `apelido`, `nome_completo`, `seu_email`, `sua_senha`, `fone`, `estado`, `cidade`, `escola`, `genero`, `avatar`) VALUES
(1, 'Dev', 'Desenvolvedor', 'desenvolvedor@avantebasil.com.br', '202cb962ac59075b964b07152d234b70', '6196661484', 'DF', 'Brasília', '3', 'Masculino', '644b1de2573ab-6.jpg'),
(2, 'Romulo', 'Romulo', '123', '202cb962ac59075b964b07152d234b70', '', 'DF', 'Brasília', '3', 'Masculino', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ead_zap_controle_msg`
--
ALTER TABLE `ead_zap_controle_msg`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ead_zap_cursos`
--
ALTER TABLE `ead_zap_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ead_zap_inscritos`
--
ALTER TABLE `ead_zap_inscritos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ead_zap_mensagens`
--
ALTER TABLE `ead_zap_mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ead_zap_realizar_curso`
--
ALTER TABLE `ead_zap_realizar_curso`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ead_zap_token_moodle`
--
ALTER TABLE `ead_zap_token_moodle`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seu_email` (`seu_email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ead_zap_controle_msg`
--
ALTER TABLE `ead_zap_controle_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ead_zap_cursos`
--
ALTER TABLE `ead_zap_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ead_zap_inscritos`
--
ALTER TABLE `ead_zap_inscritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ead_zap_mensagens`
--
ALTER TABLE `ead_zap_mensagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ead_zap_realizar_curso`
--
ALTER TABLE `ead_zap_realizar_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ead_zap_token_moodle`
--
ALTER TABLE `ead_zap_token_moodle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
