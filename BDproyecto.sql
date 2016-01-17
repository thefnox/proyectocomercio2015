CREATE TABLE CLIENTE(
	CI VARCHAR(500),
	NOMBRE VARCHAR(30),
	APELLIDO VARCHAR(30),
	FECHA_NAC DATE,
	CONSTRAINT CI PRIMARY KEY (CI)
);

CREATE TABLE TARJETA(
	N_TDC VARCHAR(16),
	COD_SEG VARCHAR(3),
	LIMITE_CRED NUMBER(22,6),
	FECHA_EXP DATE,
	FECHA_EMI DATE,
	CRED_DISP NUMBER(22,6),
	SALDO NUMBER(22,6),
	CI VARCHAR(500),
	CONSTRAINT N_TDC PRIMARY KEY (N_TDC),
	CONSTRAINT FK_CI FOREIGN KEY (CI) REFERENCES CLIENTE (CI)
);

CREATE TABLE TRANSACCION(
	N_TDC VARCHAR(16),
	CI VARCHAR(500),
	FECHA_TRANS DATE,
	MONTO NUMBER(22,6),
	COD_OPERACION NUMBER,
	CONSTRAINT TRANSACCION PRIMARY KEY (N_TDC, CI, FECHA_TRANS),
	CONSTRAINT FK_N_TDC FOREIGN KEY (N_TDC) REFERENCES TARJETA (N_TDC),
	CONSTRAINT FK_CI FOREIGN KEY (CI) REFERENCES CLIENTE (CI)
);