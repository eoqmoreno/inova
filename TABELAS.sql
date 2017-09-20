CREATE TABLE inova_catalogo_tabs(
  id_tab INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(60) NOT NULL,
  herdando int NOT NULL
);

INSERT INTO inova_catalogo_tabs VALUES(1,"Produtos",1);

CREATE TABLE inova_catalogo(
  id_itm INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(60) NOT NULL,
  link_imagem VARCHAR(100) NOT NULL,
  descricao VARCHAR(600),
  data DATE NOT NULL,
  tab INT NOT NULL,
  FOREIGN KEY(tab) REFERENCES inova_catalogo_tabs(id_tab)
);

CREATE TABLE inova_contatos(
  id_con INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(200) NOT NULL,
  assunto VARCHAR(30) NOT NULL,
  telefone VARCHAR(15) NOT NULL,
  email VARCHAR(200),
  mensagem VARCHAR(800) NOT NULL,
  data_msg DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE inova_sys_err(
  id_err INT PRIMARY KEY AUTO_INCREMENT,
  sistema VARCHAR(300) NOT NULL,
  msg VARCHAR(300) NOT NULL,
  data DATETIME NOT NULL
);


INSERT INTO inova_catalogo_tabs VALUES(null,"Poltronas Monobloco");
INSERT INTO inova_catalogo_tabs VALUES(null,"Poltronas Pés de Alumínio");
INSERT INTO inova_catalogo_tabs VALUES(null,"Cadeiras");
INSERT INTO inova_catalogo_tabs VALUES(null,"Roupeiros");
INSERT INTO inova_catalogo_tabs VALUES(null,"Banquetas");
INSERT INTO inova_catalogo_tabs VALUES(null,"Mesas");


INSERT INTO inova_catalogo VALUES(null,'Mesa Premier','mesa_premier.jpg','<p>Conforto, qualidade e praticidade</p>
<p>Design <b>inovador</b><br/>(Encaixe lateral)</p>','2017-08-07',1);
