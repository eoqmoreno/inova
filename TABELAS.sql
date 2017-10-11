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
