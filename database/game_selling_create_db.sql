CREATE TABLE users ( 
    userId INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'รหัสผู้ใช้',
    firstname VARCHAR(255) NOT NULL COMMENT 'ชื่อจริงผู้ของใช้', 
    lastname VARCHAR(255) NOT NULL COMMENT 'นามสกุลผู้ของใช้', 
    email VARCHAR(100) UNIQUE NOT NULL COMMENT 'อีเมลส์ผู้ของใช้', 
    passwords VARCHAR(255) NOT NULL COMMENT 'รหัสผ่านของผู้ใช้', 
    role ENUM('user', 'admin') DEFAULT 'user' NOT NULL COMMENT 'บทบาทของผู้ใช้' 
    );

CREATE TABLE products (
	productId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า',
    gameName VARCHAR(255) NOT NULL COMMENT 'ชื่อสินค้า/ชื่อเกม',
	price DECIMAL(8,2) NOT NULL COMMENT 'ราคาสินค้า/ราคาเกม',
    stock ENUM('คงเหลือ', 'ไม่มีคงเหลือ') DEFAULT 'ไม่มีคงเหลือ' NOT NULL COMMENT 'จำนวนสินค้าคงคลัง',
    isDeleted ENUM('ลบแล้ว') DEFAULT NULL COMMENT 'สถานะการลบสินค้า',
    PRIMARY KEY (productId) 
);

CREATE TABLE carts (
	cartId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสตะกร้าสินค้า',
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'วันเวลาที่ตะกร้าถูกสร้าง',
    status ENUM('finished', 'not finished') DEFAULT 'not finished' NOT NULL COMMENT 'สถานะของตะกร้า',
    updatedAt DATETIME ON UPDATE CURRENT_TIMESTAMP NULL COMMENT 'วันเวลาที่ตะกร้าถูกอัปเดต',
    userId INT NOT NULL COMMENT 'รหัสผู้ใช้',
	PRIMARY KEY (cartId),
	FOREIGN KEY (userId) REFERENCES users(userId)
);

CREATE TABLE cartItems (
	cartItemId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการในตะกร้า',
    quantity TINYINT(255) NOT NULL COMMENT 'จำนวนสินค้าของแต่ละรายการ',
    cartId INT UNIQUE NOT NULL COMMENT 'รหัสตะกร้าสินค้า',
    productId INT UNIQUE NOT NULL COMMENT 'รหัสสินค้า',
    PRIMARY KEY (cartItemId),
    FOREIGN KEY (cartId) REFERENCES carts(cartId),
    FOREIGN KEY (productId) REFERENCES products(productId)
);

CREATE TABLE orders (
    orderId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสคำสั่งซื้อ',
    orderStatus ENUM('PENDING_VERIFICATION', 'COMPLETED', 'REJECTED') DEFAULT 'PENDING_VERIFICATION' NOT NULL COMMENT 'สถานะคำสั่งซื้อ',
    totalAmount DECIMAL(8, 2) NOT NULL COMMENT 'ราคารวมของคำสั่งซื้อ',
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'วันเวลาที่สั่งซิ้อสินค้า',
    userId INT NOT NULL COMMENT 'รหัสผู้ใช้',
    PRIMARY KEY (orderId),
    FOREIGN KEY (userId) REFERENCES users(userId)
);

CREATE TABLE ordersItems (
    orderItemId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายการคำสั่งซื้อ',
    quantity TINYINT(255) NOT NULL COMMENT 'จำนวนรวมสินค้าเดียวกันที่สั่งซื้อ',
    unitPrice DECIMAL(8, 2) NOT NULL COMMENT 'ราคารวมสินค้าเดียวกันที่สั่งซื้อ',
    orderId INT NOT NULL COMMENT 'รหัสคำสั่งซื้อ',
    productId INT NOT NULL COMMENT 'รหัสผู้ใช้',
    PRIMARY KEY (orderItemId),
    FOREIGN KEY (orderId) REFERENCES orders(orderId),
    FOREIGN KEY (productId) REFERENCES products(productId)
);

CREATE TABLE categories (
	categorieId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสหมวดหมู่',
    categoryName VARCHAR(255) UNIQUE NOT NULL COMMENT 'ชื่อหมวดหมู่',
    PRIMARY KEY (categorieId)
);

CREATE TABLE productCategories (
    categorieId INT NOT NULL COMMENT 'รหัสหมวดหมู่',
    productid INT NOT NULL COMMENT 'รหัสสินค้า',
    PRIMARY KEY (productId, categorieId),
    FOREIGN KEY (productId) REFERENCES products(productId),
    FOREIGN KEY (categorieId) REFERENCES categories(categorieId)
);

CREATE TABLE gameDetails (
	gameDetailId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายละเอียดสินค้า',
    gameDetail MEDIUMTEXT COMMENT 'ข้อมูลรายละเอียดสินค้า',
    gameImage MEDIUMBLOB COMMENT 'รูปสินค้า',
    productId INT COMMENT 'รหัสสินค้า',
    PRIMARY KEY (gameDetailId),
    FOREIGN KEY (productId) REFERENCES products(productId)
);

CREATE TABLE promotions (
	promotionId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสลดราคา',
    promotionName VARCHAR(255) NOT NULL COMMENT 'ชื่อการลดราคา',
    discountPercent DECIMAL(8, 2) NOT NULL COMMENT 'เปอร์เซ็นการลดราคา',
    promotionStartDate DATETIME NOT NULL COMMENT 'วันเวลาที่เริ่มลดราคา',
    promotionEndDate DATETIME NOT NULL COMMENT 'วันเวลาที่หยุดลดราคา',
    createAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันเวลาที่สร้างการลดราคา',
    PRIMARY KEY (promotionId)
);

CREATE TABLE productPromotions (
	productId INT NOT NULL COMMENT 'รหัสสินค้า',
    promotionId INT NOT NULL COMMENT 'รหัสลดราคา',
	PRIMARY KEY (productId, promotionId),
    FOREIGN KEY (productId) REFERENCES products(productId),
    FOREIGN KEY (promotionId) REFERENCES promotions(promotionId) 
);

CREATE TABLE payments (
	paymentId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสการชำระเงิน',
    paymentSlip MEDIUMBLOB NOT NULL COMMENT 'สลิปการโอนเงิน',
    paymentStatus ENUM('รอตรวจสอบ', 'ชำระเงินแล้ว', 'ชำระเงินไม่สำเร็จ') DEFAULT 'รอตรวจสอบ' NOT NULL COMMENT 'สถานะการชำระเงิน',
    amount DECIMAL(8, 2) NOT NULL COMMENT 'ราคาที่ทำการชำระเงิน',
    paidAt DATETIME NOT NULL COMMENT 'วันเวลาที่ชำระเงิน',
    orderId INT NOT NULL COMMENT 'รหัสคำสั่งซิ้อ',
    PRIMARY KEY (paymentId),
    FOREIGN KEY (orderId) REFERENCES orders(orderId)
);

CREATE TABLE gameKeys (
    gameKeyId INT NOT NULL AUTO_INCREMENT COMMENT 'รหัสคีย์เกม',
    gameKey CHAR(255) NOT NULL UNIQUE COMMENT 'คีย์เกมสตรีม',
    isUsed ENUM('yes', 'no') DEFAULT 'no' COMMENT 'สถานะของคีย์เกมถูกใช้หรือยัง',
    productId INT NOT NULL COMMENT 'รหัสสินค้า',
    orderItemId INT NOT NULL COMMENT 'รหัสรายการคำสั่งซิ้อ',
    PRIMARY KEY (gameKeyId),
    FOREIGN KEY (productId) REFERENCES products(productId),
    FOREIGN KEY (orderItemId) REFERENCES ordersItems(orderItemId) 
);

CREATE TABLE usersRefreshToken (
    usersRefreshTokenId INT NOT NULL UNIQUE AUTO_INCREMENT COMMENT 'รหัสรีเซ็ตโทเค็น',
    tokenHash VARCHAR(255) NOT NULL COMMENT 'โทเค็นสำหรับรีเซ็ตที่ถูกเข้ารหัส',
    revokedAt DATETIME NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'เวลาที่โทเค็นถูกยกเลิก',
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'เวลาที่โทเค็นถูกสร้าง',
    expiresAt DATETIME NOT NULL COMMENT 'เวลาที่โทเค็นหมดอายุ',
    userId INT NOT NULL COMMENT 'รหัสผู้ใช้',
    PRIMARY KEY (usersRefreshTokenId),
    FOREIGN KEY (userId) REFERENCES users(userId) 
)