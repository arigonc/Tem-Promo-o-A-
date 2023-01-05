# TemPromocaoAi

Informações gerais: O sistema Tem Promoção Aí está na sua versão inicial e facilita a conexão entre empresas e clientes. Por meio dessa aplicação, as empresas podem anunciar promoções que estão disponíveis nas suas lojas. Já o usuário pode seguir as empresas prediletas e acompanhar todas as suas promoções. Dessa forma, os clientes conseguem usufruir de preços melhores e as empresas conseguem atrair um possível maior número de clientes. Algumas ferramentas contidas na plataforma são curtir e denunciar promoções, seguir empresas preferidas e dashboard do perfil empresarial.

Código: O ambiente de desenvolvimento foi o Visual Studio Code. Além disso, foi utilizado o padrão Model-View-Controller (MVC) para a organização do código.

Configurações: O projeto foi configurado para rodar com a ajuda do pacote xampp, que disponibiliza, dentre vários recursos, o servidor Apache. Dessa forma, alguns arquivos foram inseridos apenas para garantir um ambiente de desenvolvimento adequado.

Banco de dados: Foi utilizado o MySQL como Sistema de Gerenciamento de Banco de Dados. A seguir, tem-se o código criado.

<code>CREATE DATABASE tempromocaoai;
USE tempromocaoai;
CREATE TABLE `empresas` (
  `cnpj` varchar(255) NOT NULL PRIMARY KEY,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `promocoes` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cnpj` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `validade` date NOT NULL,
  `descricao` text NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `preco_inicio` varchar(255) NOT NULL,
  `preco_fim` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `usuarios` (
  `email` varchar(255) NOT NULL PRIMARY KEY,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atividade` tinyint(1) NOT NULL
);
CREATE TABLE `seguidores` (
  `email` varchar(255) NOT NULL,
  `cnpj` varchar(255) NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (email) REFERENCES usuarios(email),  
  FOREIGN KEY (cnpj) REFERENCES empresas(cnpj)
);
CREATE TABLE `curtidas` (
  `email` varchar(255) NOT NULL,
  `id` int NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (email) REFERENCES usuarios(email),  
  FOREIGN KEY (id) REFERENCES promocoes(id)
);
CREATE TABLE `denuncias` (
  `email` varchar(255) NOT NULL,
  `id` int NOT NULL,
  `cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (email) REFERENCES usuarios(email),  
  FOREIGN KEY (id) REFERENCES promocoes(id)
);</code>
