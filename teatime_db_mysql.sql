CREATE TABLE Pengguna
(
	id int NOT NULL AUTO_INCREMENT,
	nama_pengguna varchar(255) NOT NULL,
	tipe varchar(50) NOT NULL,
	username varchar(255) NOT NULL,
	password varchar(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (username)
)

CREATE TABLE TransaksiPemesanan
(
	id int NOT NULL AUTO_INCREMENT,
	idKasir int NOT NULL,
	nama_pemesan varchar(255) NOT NULL,
	tanggal_transaksi date NOT NULL,
	waktu_transaksi time NOT NULL,
	banyak_gula varchar(50) NOT NULL,
	banyak_es varchar(50) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idKasir) REFERENCES kasir(id)
)

CREATE TABLE Menu
(
	id int NOT NULL AUTO_INCREMENT,
	nama_minuman varchar(255) NOT NULL,
	harga_regular int NOT NULL,
	harga_large int NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE MemilikiMenu
(
	idTransaksi int NOT NULL,
	idMenu int NOT NULL,
    PRIMARY KEY (idTransaksi, idMenu),
    FOREIGN KEY (idTransaksi) REFERENCES TransaksiPemesanan(id),
	FOREIGN KEY (idMenu) REFERENCES Menu(id)
)

CREATE TABLE Toping
(
	id int NOT NULL AUTO_INCREMENT,
	nama_toping varchar(255) NOT NULL,
	harga_toping int NOT NULL,
    PRIMARY KEY (id)
)

CREATE TABLE MemilikiToping
(
	idTransaksi int NOT NULL,
	idToping int NOT NULL,
    PRIMARY KEY (idTransaksi, idToping),
    FOREIGN KEY (idTransaksi) REFERENCES TransaksiPemesanan(id),
	FOREIGN KEY (idToping) REFERENCES Toping(id)
)


