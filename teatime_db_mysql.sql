/* 
	BIKIN DULU DATABASENYA
*/

CREATE TABLE Pengguna
(
	id INT NOT NULL AUTO_INCREMENT,
	nama_pengguna varchar(255) NOT NULL,
	tipe varchar(50) NOT NULL,
	username varchar(255) NOT NULL,
	last_login DATE DEFAULT NULL,
	profile_location varchar(255) DEFAULT NULL,
	password varchar(255) NOT NULL,
	PRIMARY KEY (id),
	UNIQUE (username)
);

CREATE TABLE Menu
(
	id INT NOT NULL AUTO_INCREMENT,
	nama_minuman varchar(255) NOT NULL,
	harga_regular INT NOT NULL,
	harga_large INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Toping
(
	id INT NOT NULL AUTO_INCREMENT,
	nama_toping varchar(255) NOT NULL,
	harga_toping INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE TransaksiPemesanan
(
	id INT NOT NULL AUTO_INCREMENT,
	idKasir INT NOT NULL,
	nama_pemesan varchar(255) NOT NULL,
	tanggal_transaksi date NOT NULL,
	waktu_transaksi time NOT NULL,
	total INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idKasir) REFERENCES Pengguna(id)
);

CREATE TABLE Pesanan
(
	id INT NOT NULL AUTO_INCREMENT,
	idTransaksi INT NOT NULL,
	idMenu INT NOT NULL,
	banyak_es VARCHAR(10) NOT NULL,
	banyak_gula VARCHAR(10) NOT NULL,
	ukuran_gelas VARCHAR(10) NOT NULL,
	PRIMARY KEY (idPesanan)
    FOREIGN KEY (idTransaksi) REFERENCES TransaksiPemesanan(id),
	FOREIGN KEY (idMenu) REFERENCES Menu(id),
	FOREIGN KEY (idToping) REFERENCES Toping(id)
);

CREATE TABLE MemilikiToping
(
	idPesanan INT NOT NULL,
	idToping INT NOT NULL,
	PRIMARY KEY (idPesanan, idToping),
	FOREIGN KEY (idPesanan) REFERENCES Pesanan(id),
	FOREIGN KEY (idToping) REFERENCES Toping(id)
);

/*
CREATE TABLE DetailTransaksi
(
	idTransaksi INT NOT NULL,
	idMenu INT NOT NULL,
	idToping INT DEFAULT NULL,
	banyak_es VARCHAR(10) NOT NULL,
	banyak_gula VARCHAR(10) NOT NULL,
	ukuran_gelas VARCHAR(10) NOT NULL,
    FOREIGN KEY (idTransaksi) REFERENCES TransaksiPemesanan(id),
	FOREIGN KEY (idMenu) REFERENCES Menu(id),
	FOREIGN KEY (idToping) REFERENCES Toping(id)
);
*/

/* 	
	SEED PENGGUNA untuk coba login
	semua password: frostygum
*/

INSERT INTO `pengguna` (`id`, `nama_pengguna`, `tipe`, `username`, `password`) VALUES
(1, 'kasir_1', 'kasir', 'frostyKasir', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6'),
(2, 'admin_1', 'admin', 'frostyAdmin', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6'),
(3, 'manager_1', 'manager', 'frostyManager', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6');

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

INSERT INTO `menu` (`id`, `nama_minuman`, `harga_regular`, `harga_large`) VALUES
(1, 'Brown Sugar Milk Tea', 25000, 35000),
(2, 'Roasted Milk Tea', 20000, 23000),
(3, 'Brown Rice Green Milk Tea', 20000, 23000),
(4, 'Jasmine Green Milk Tea', 20000, 23000),
(5, 'Strawberry Milk Tea', 22000, 26000),
(6, 'Vanilla Milk Tea', 22000, 25000),
(7, 'Hazelnut Milk Tea', 22000, 25000),
(8, 'Caramel Milk Tea', 22000, 27000),
(9, 'Honey Milk Tea', 22000, 25000),
(10, 'Taro Milk Tea', 23000, 27000),
(11, 'Hazelnut Chocolate Milk Tea', 23000, 26000);

INSERT INTO `transaksipemesanan` (`id`, `idKasir`, `nama_pemesan`, `tanggal_transaksi`, `waktu_transaksi`, `total`) VALUES
(1, 1, 'tommy', '2020-05-08', '12:23:05', 60000);

INSERT INTO `detailtransaksi` (`idTransaksi`, `idMenu`, `idToping`, `banyak_es`, `banyak_gula`, `ukuran_gelas`) VALUES
(1, 1, 1, 'none', 'less', 'regular'),
(1, 2, 1, 'none', 'less', 'large'),
(1, 2, 2, 'none', 'less', 'large');

/*
	VIEWS
*/

CREATE VIEW transaksi AS
SELECT 
	transaksipemesanan.id,
	nama_pemesan,
    nama_minuman,
    nama_toping,
    ukuran_gelas,
    banyak_es,
    banyak_gula,
    waktu_transaksi,
    tanggal_transaksi,
	total
FROM 
	detailtransaksi 
    JOIN transaksipemesanan ON transaksipemesanan.id = detailtransaksi.idTransaksi 
    JOIN menu ON menu.id = detailtransaksi.idMenu JOIN toping ON toping.id = detailtransaksi.idToping 
