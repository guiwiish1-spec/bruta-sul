-- Banco de dados do projeto Bruta Sul Performance
-- Estrutura relacional seguindo o padrão de criação do projeto-base.

CREATE DATABASE IF NOT EXISTS `gym_system`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE `gym_system`;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `schedules`;
DROP TABLE IF EXISTS `faqs`;
DROP TABLE IF EXISTS `plans`;
DROP TABLE IF EXISTS `teachers`;
DROP TABLE IF EXISTS `modalities`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `user_types`;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE `user_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_user_types_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_types` (`id`, `name`) VALUES
  (1, 'ADMIN'),
  (2, 'STANDARD');

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `typeId` int NOT NULL DEFAULT 2,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_users_email` (`email`),
  KEY `fk_users_user_types_idx` (`typeId`),
  CONSTRAINT `fk_users_user_types` FOREIGN KEY (`typeId`) REFERENCES `user_types` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teachers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `specialty` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `modalities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_modalities_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `week_day` varchar(20) NOT NULL,
  `hour` time NOT NULL,
  `modality_id` int NOT NULL,
  `teacher_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_schedules_modality_idx` (`modality_id`),
  KEY `fk_schedules_teacher_idx` (`teacher_id`),
  CONSTRAINT `fk_schedules_modality` FOREIGN KEY (`modality_id`) REFERENCES `modalities` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT `fk_schedules_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`)
    ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `faqs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `teachers` (`id`, `name`, `specialty`, `description`) VALUES
  (1, 'Rafael Oliveira', 'Jiu-Jitsu', 'Professor de Jiu-Jitsu com foco em técnica, condicionamento e evolução dos alunos.'),
  (2, 'Marcos Silva', 'Muay Thai', 'Treinador de Muay Thai com aulas para iniciantes e praticantes experientes.'),
  (3, 'André Costa', 'Boxe', 'Professor de boxe com foco em fundamentos, movimentação e preparo físico.'),
  (4, 'Lucas Ferreira', 'Musculação', 'Instrutor de musculação e preparação física.'),
  (5, 'Bruno Martins', 'MMA', 'Professor de artes marciais mistas e treinamento integrado.');

INSERT INTO `modalities` (`id`, `name`, `description`) VALUES
  (1, 'Musculação', 'Treinamento de força e condicionamento físico para diferentes objetivos.'),
  (2, 'Jiu-Jitsu', 'Arte marcial baseada em técnicas de solo, controle e finalizações.'),
  (3, 'Boxe', 'Treinamento de golpes, defesa, movimentação e resistência.'),
  (4, 'Muay Thai', 'Arte marcial tailandesa que utiliza punhos, cotovelos, joelhos e chutes.'),
  (5, 'MMA', 'Treinamento que integra técnicas de diferentes modalidades de combate.');

INSERT INTO `plans` (`id`, `name`, `description`, `price`) VALUES
  (1, 'Musculação', 'Acesso à área de musculação da academia.', 89.90),
  (2, 'Lutas', 'Acesso às aulas coletivas de artes marciais.', 119.90),
  (3, 'Performance Total', 'Acesso à musculação e às modalidades de luta.', 159.90);

INSERT INTO `schedules` (`week_day`, `hour`, `modality_id`, `teacher_id`) VALUES
  ('Segunda-feira', '06:00:00', 1, 4),
  ('Terça-feira', '06:00:00', 1, 4),
  ('Quarta-feira', '06:00:00', 1, 4),
  ('Quinta-feira', '06:00:00', 1, 4),
  ('Sexta-feira', '06:00:00', 1, 4),
  ('Sábado', '08:00:00', 1, 4),
  ('Segunda-feira', '20:00:00', 2, 1),
  ('Quarta-feira', '20:00:00', 2, 1),
  ('Sexta-feira', '20:00:00', 2, 1),
  ('Terça-feira', '18:30:00', 3, 3),
  ('Quinta-feira', '18:30:00', 3, 3),
  ('Terça-feira', '19:30:00', 4, 2),
  ('Quinta-feira', '19:30:00', 4, 2),
  ('Sábado', '10:00:00', 5, 5);

INSERT INTO `faqs` (`question`, `answer`) VALUES
  ('Quais modalidades a Bruta Sul oferece?', 'A academia oferece musculação, Jiu-Jitsu, Boxe, Muay Thai e MMA.'),
  ('Como posso consultar os horários?', 'Acesse a página Horários para conferir os dias, horários, modalidades e professores.'),
  ('Como faço meu cadastro?', 'Acesse Criar conta, preencha seus dados e envie o formulário.'),
  ('Quais planos estão disponíveis?', 'Consulte a página Planos para conhecer as opções e os valores disponíveis.');
