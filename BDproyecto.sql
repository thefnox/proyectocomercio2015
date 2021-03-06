CREATE TABLE IF NOT EXISTS CLIENTE(
	CI VARCHAR(500),
	NOMBRE VARCHAR(30),
	APELLIDO VARCHAR(30),
	FECHA_NAC DATE,
	CONSTRAINT CI PRIMARY KEY (CI)
);

CREATE TABLE IF NOT EXISTS TARJETA(
	N_TDC VARCHAR(16),
	COD_SEG VARCHAR(3),
	LIMITE_CRED DECIMAL(22,6),
	FECHA_EXP DATE,
	FECHA_EMI DATE,
	CRED_DISP DECIMAL(22,6),
	SALDO DECIMAL(22,6),
	CI VARCHAR(500),
	CONSTRAINT N_TDC PRIMARY KEY (N_TDC),
	CONSTRAINT FK_CI FOREIGN KEY (CI) REFERENCES CLIENTE (CI)
);

CREATE TABLE IF NOT EXISTS TRANSACCION(
	N_TRANS INT NOT NULL AUTO_INCREMENT,
	N_TDC VARCHAR(16),
	CI VARCHAR(500),
	FECHA_TRANS DATE,
	MONTO DECIMAL(22,6),
	COD_OPERACION VARCHAR(3),
	CONSTRAINT TRANSACCION PRIMARY KEY (N_TRANS),
	CONSTRAINT FK_N_TDC FOREIGN KEY (N_TDC) REFERENCES TARJETA (N_TDC),
	CONSTRAINT FK_CI FOREIGN KEY (CI) REFERENCES CLIENTE (CI)
);

CREATE TABLE IF NOT EXISTS BANCO(
	BANCO VARCHAR(5),
	RUTA VARCHAR(100),
	N_TDC VARCHAR()
	CONSTRAINT BANCO PRIMARY KEY (BANCO)
);

CREATE TABLE IF NOT EXISTS COMERCIO(
	COD_TIENDA VARCHAR(5),
	CUENTA VARCHAR(30),
	MONTO DECIMAL(22,6),
	CONSTRAINT COD_TIENDA PRIMARY KEY (COD_TIENDA)
);
