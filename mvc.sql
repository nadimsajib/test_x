
CREATE TABLE test_x.buyers (
	id BIGINT(20) auto_increment NOT NULL PRIMARY KEY,
	amount INT(10) DEFAULT 0 NOT NULL,
	buyer VARCHAR(255) NOT NULL,
	receipt_id varchar(20) NOT NULL,
	items varchar(255) NULL,
	buyer_email varchar(50) NULL,
	buyer_ip varchar(20) NULL,
	note TEXT NULL,
	city varchar(20) NULL,
	phone varchar(20) NOT NULL,
	hash_key varchar(255) NULL,
	entry_at DATE NOT NULL,
	entry_by INT(10) NOT NULL
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;
