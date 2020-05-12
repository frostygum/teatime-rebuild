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
	PRIMARY KEY (id),
    FOREIGN KEY (idTransaksi) REFERENCES TransaksiPemesanan(id),
	FOREIGN KEY (idMenu) REFERENCES Menu(id)
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
	SEED PENGGUNA untuk coba login
	semua password: frostygum
*/

INSERT INTO `pengguna` (`id`, `nama_pengguna`, `tipe`, `username`, `password`) VALUES
(1, 'kasir_1', 'kasir', 'frostyKasir', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6'),
(2, 'admin_1', 'admin', 'frostyAdmin', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6'),
(3, 'manager_1', 'manager', 'frostyManager', '$2y$10$A/oDzRiF9qlI9ViNrNWyX.X4hOkq4QSD56xI0vkYgkYqZkpYjAKX6'),
(4, 'daniel', 'kasir', 'daniel', '$2y$10$NJi5HnU5yiaqwiZ/1/rWne9isjuOWFLVpKWEczR76dQwAqFxNyw1y');

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
(1, 'Brown Sugar Milk Tea', 25000, 27000),
(2, 'Roasted Milk Tea', 20000, 24000),
(3, 'Brown Rice Green Milk Tea', 20000, 23000),
(4, 'Jasmine Green Milk Tea', 20000, 23000),
(5, 'Strawberry Milk Tea', 22000, 26000),
(6, 'Vanilla Milk Tea', 22000, 25000),
(7, 'Hazelnut Milk Tea', 22000, 25000),
(8, 'Caramel Milk Tea', 22000, 27000),
(9, 'Honey Milk Tea', 22000, 25000),
(10, 'Taro Milk Tea', 23000, 27000),
(11, 'Hazelnut Chocolate Milk Tea', 23000, 26000),
(13, 'Japanese Sakura Sencha', 20000, 23000),
(14, 'Honey Black Tea', 21000, 24000),
(15, 'Grapefruit Juice', 24000, 28000),
(16, 'Mango Green Tea', 21000, 24000),
(17, 'Lemon Green Tea', 21000, 24000),
(18, 'Black Tea Mousse', 22000, 25000),
(19, 'Chcocolate Mousse', 25000, 29000),
(20, 'Roasted Tea Mousse', 22000, 25000),
(21, 'Mango Smoothie', 22000, 25000),
(22, 'Passion Fruit Smoothie', 22000, 25000),
(23, 'Strawberry Smoothie', 22000, 25000),
(24, 'Peach Smoothie', 22000, 25000),
(25, 'Lemon Yogurt Smoothie', 23000, 27000),
(26, 'Matcha Red Bean Smoothie', 23000, 27000),
(27, 'Hawaii Fruit Tea', 22000, 25000),
(28, 'Yogurt Lemon Juice', 23000, 26000),
(29, 'Honey Lemon Aloe', 24000, 27000),
(30, 'Oolong Tea', 18000, 21000),
(31, 'Jasmine Green Tea', 18000, 21000),
(32, 'Black Tea', 18000, 21000),
(33, 'Brown Rice Green Tea', 18000, 21000),
(34, 'Anxi Tie Guan Yin Tea', 20000, 23000),
(35, 'Green Tea Latte', 23000, 26000),
(36, 'Tie Guan Yin Tea Latte', 23000, 26000),
(37, 'Black Tea Latte', 23000, 26000),
(38, 'Vanilla Latte', 26000, 28000),
(39, 'Hazelnut Latte', 26000, 28000),
(40, 'Caramel Latte', 26000, 28000);

INSERT INTO `transaksipemesanan` (`id`, `idKasir`, `nama_pemesan`, `tanggal_transaksi`, `waktu_transaksi`, `total`) VALUES
(1, 1, 'jasmin', '2020-05-12', '20:52:37', 46000),
(2, 1, 'geraldi', '2020-05-12', '20:53:34', 87000),
(3, 1, 'afi', '2020-05-12', '20:55:23', 32000),
(4, 1, 'kotamu', '2020-05-12', '20:55:51', 95000),
(5, 1, 'kambing', '2020-05-12', '20:56:05', 34000),
(6, 1, 'radian', '2020-05-12', '20:56:36', 134000),
(7, 1, 'cumber', '2020-05-12', '20:56:57', 57000),
(8, 1, 'koko', '2020-05-12', '20:57:44', 67000),
(9, 1, 'reandi', '2020-05-12', '21:00:09', 31000),
(10, 1, 'magerun', '2020-05-12', '21:00:25', 35000),
(11, 1, 'bagugi', '2020-05-12', '21:01:13', 207000),
(12, 1, 'kelvin', '2020-05-12', '21:01:45', 92000);

INSERT INTO `pesanan` (`id`, `idTransaksi`, `idMenu`, `banyak_es`, `banyak_gula`, `ukuran_gelas`) VALUES
(1, 1, 2, 'none', 'none', 'regular'),
(2, 1, 11, 'normal', 'normal', 'large'),
(3, 2, 2, 'normal', '30%', 'regular'),
(4, 2, 6, 'normal', 'normal', 'large'),
(5, 2, 6, 'less', '30%', 'regular'),
(6, 3, 1, 'normal', 'normal', 'large'),
(7, 4, 10, 'less', 'normal', 'regular'),
(8, 4, 16, 'normal', '30%', 'large'),
(9, 4, 16, 'normal', 'normal', 'large'),
(10, 5, 5, 'normal', 'normal', 'large'),
(11, 6, 1, 'less', '10%', 'regular'),
(12, 6, 20, 'normal', '30%', 'large'),
(13, 6, 20, 'normal', 'normal', 'large'),
(14, 6, 17, 'less', '30%', 'large'),
(15, 7, 10, 'less', '10%', 'regular'),
(16, 7, 13, 'normal', 'normal', 'large'),
(17, 8, 10, 'less', '30%', 'regular'),
(18, 8, 1, 'normal', 'normal', 'large'),
(19, 9, 10, 'normal', 'normal', 'large'),
(20, 10, 1, 'normal', 'normal', 'large'),
(21, 11, 1, 'normal', '30%', 'large'),
(22, 11, 5, 'less', 'normal', 'large'),
(23, 11, 9, 'normal', 'normal', 'large'),
(24, 11, 14, 'normal', 'normal', 'large'),
(25, 11, 18, 'less', 'normal', 'large'),
(26, 11, 4, 'less', 'normal', 'large'),
(27, 12, 10, 'less', '30%', 'regular'),
(28, 12, 17, 'normal', 'normal', 'large'),
(29, 12, 20, 'less', 'normal', 'regular');

INSERT INTO `memilikitoping` (`idPesanan`, `idToping`) VALUES
(3, 1),
(3, 2),
(5, 1),
(5, 3),
(5, 4),
(6, 1),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 6),
(12, 1),
(12, 3),
(13, 1),
(13, 4),
(14, 1),
(14, 6),
(15, 1),
(15, 2),
(15, 3),
(17, 1),
(17, 2),
(18, 1),
(18, 5),
(19, 5),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 2),
(23, 4),
(23, 5),
(24, 1),
(24, 4),
(24, 6),
(25, 1),
(25, 6),
(26, 8),
(26, 9),
(27, 6),
(27, 8),
(28, 3),
(28, 5),
(29, 1),
(29, 3);
