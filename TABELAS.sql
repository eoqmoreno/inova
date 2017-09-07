CREATE TABLE inova_catalogo(
  id_itm INT PRIMARY KEY AUTO_INCREMENT,
  titulo VARCHAR(60) NOT NULL,
  link_imagem VARCHAR(100) NOT NULL,
  descricao VARCHAR(600),
  desc_cliente VARCHAR(200),
  data DATE NOT NULL,
  tags VARCHAR(300)
);

CREATE TABLE inova_contatos(
  id_con INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(200) NOT NULL,
  assunto VARCHAR(300) NOT NULL,
  email VARCHAR(200) NOT NULL,
  mensagem VARCHAR(800) NOT NULL,
  data_msg DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE inova_sys_err(
  id_err INT PRIMARY KEY AUTO_INCREMENT,
  sistema VARCHAR(300) NOT NULL,
  msg VARCHAR(300) NOT NULL,
  data DATETIME NOT NULL
);


INSERT INTO inova_catalogo VALUES(null,'Mesa Premier','mesa_premier.jpg','<p>Conforto, qualidade e praticidade</p>
<p>Design <b>inovador</b><br/>(Encaixe lateral)</p>','Inova','2017-08-07','Inova,Mesa,Premier');
INSERT INTO inova_catalogo VALUES(null,'Banqueta Inova','banqueta.jpg','<p>Leve, <b>compacta</b>, reforçada.</p>
<p>Ideal para o seu dia.</p>','Inova','2017-08-07','Inova,Banqueta');
INSERT INTO inova_catalogo VALUES(null,'Mesa Premier','mesa_premier.jpg','<p>Conforto, qualidade e praticidade</p>
<p>Design <b>inovador</b><br/>(Encaixe lateral)</p>','Inova','2017-08-07','Inova,Mesa,Premier');
INSERT INTO inova_catalogo VALUES(null,'Banqueta Inova','banqueta.jpg','<p>Leve, <b>compacta</b>, reforçada.</p>
<p>Ideal para o seu dia.</p>','Inova','2017-08-07','Inova,Banqueta');
