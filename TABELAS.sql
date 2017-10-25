CREATE TABLE inova_catalogo_tabs(
  id_tab INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(60) NOT NULL,
  herdando int NOT NULL
);

INSERT INTO inova_catalogo_tabs VALUES(1,"Produtos",1);

CREATE TABLE inova_produto_classe(
  id_itm INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(60) NOT NULL,
  descricao VARCHAR(600),
  tab INT NOT NULL,
  FOREIGN KEY(tab) REFERENCES inova_catalogo_tabs(id_tab)
);

ALTER TABLE `inova_produto_classe` CHANGE `preco` `preco` DECIMAL(6,2) NULL DEFAULT '0.00';

CREATE TABLE inova_produto_cor(
  id_cor INT PRIMARY KEY AUTO_INCREMENT,
  id_itm INT NOT NULL,
  nome_cor VARCHAR(60) NOT NULL,
  link_imagem VARCHAR(100) NOT NULL,
  FOREIGN KEY(id_itm) REFERENCES inova_produto_classe(id_itm)
);

CREATE TABLE inova_sys_err(
  id_err INT PRIMARY KEY AUTO_INCREMENT,
  sistema VARCHAR(300) NOT NULL,
  msg VARCHAR(300) NOT NULL,
  data DATETIME NOT NULL
);

CREATE TABLE inova_representante(
  id_rep INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(300) NOT NULL,
  passwd VARCHAR(100) NOT NULL,
  email VARCHAR(345) NOT NULL,
  telefone VARCHAR(15) NOT NULL,
  cpf VARCHAR(14)
);

CREATE TABLE inova_pedido(
  ped_id INT PRIMARY KEY AUTO_INCREMENT,
  datpedido DATETIME NOT NULL,
  repres_id INT DEFAULT 0,
  nome_cliente VARCHAR(300) NOT NULL,
  email VARCHAR(345),
  telefone VARCHAR(15) NOT NULL,
  cep VARCHAR(9),
  numero VARCHAR(10) NOT NULL,
  logradouro VARCHAR(300) NOT NULL,
  bairro VARCHAR(100),
  cidade VARCHAR(120) NOT NULL,
  estado VARCHAR(20) NOT NULL,
  uf VARCHAR(2) NOT NULL,
  cnpj VARCHAR(18),
  cpf VARCHAR(14)
);

CREATE TABLE inova_pedido_itens(
  id_item INT PRIMARY KEY AUTO_INCREMENT,
  ped_id INT NOT NULL,
  id_cor INT NOT NULL,
  preco_unit DECIMAL(6,2) NOT NULL,
  qnt_cor INT NOT NULL,
  FOREIGN KEY(ped_id) REFERENCES inova_pedido(ped_id),
  FOREIGN KEY(id_cor) REFERENCES inova_produto_cor(id_cor)
);
