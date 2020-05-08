

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
	idMenu int NOT NULL,
	idToping int NOT NULL,
	ukuran_gelas varchar(50) NOT NULL,
	banyak_gula varchar(50) NOT NULL,
	banyak_es varchar(50) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idKasir) REFERENCES Pengguna(id)
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


-- SEED PENGGUNA untuk coba login
-- username: frostygum, password: frostygum

INSERT INTO `pengguna` (`id`, `nama_pengguna`, `tipe`, `username`, `password`) VALUES
(26, 'juan', 'kasir', 'frostygum', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6');

--SEED TOPPING
INSERT INTO `toping` (`id`, `nama_toping`, `harga_toping`) VALUES
(1, 'Pearl', 5000),
(2, 'Pudding', 3000),
(3, 'Mousse', 3000),
(4, 'Grass Jelly', 4000),
(5, 'Aloe Vera Jelly', 4000),
(6, 'Coconut Jelly', 4000),
(7, 'Coffee Jelly', 4000),
(8, 'Rainbow Jelly', 4000),
(9, 'Read Beans', 4000);