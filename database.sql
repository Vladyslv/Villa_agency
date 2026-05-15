CREATE DATABASE IF NOT EXISTS villa_agency
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE villa_agency;

DROP TABLE IF EXISTS contacts;
DROP TABLE IF EXISTS properties;
DROP TABLE IF EXISTS users;

CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(12, 2) NOT NULL,
    bedrooms INT NOT NULL DEFAULT 0,
    bathrooms INT NOT NULL DEFAULT 0,
    area INT NOT NULL DEFAULT 0,
    floor VARCHAR(20) NOT NULL DEFAULT '1',
    parking VARCHAR(50) NOT NULL DEFAULT '0',
    description TEXT,
    image VARCHAR(255) DEFAULT 'property-01.jpg',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO properties (title, category, price, bedrooms, bathrooms, area, floor, parking, description, image) VALUES
('18 New Street Miami, OR 97219', 'Luxury Villa', 2264000, 8, 8, 545, '3', '6 spots',
 'Nádherná luxusná vila v srdci Miami. Priestranné izby, moderný dizajn a všetky predstaviteľné vymoženosti.', 'property-01.jpg'),

('54 Mid Street Florida, OR 27001', 'Luxury Villa', 1180000, 6, 5, 450, '3', '8 spots',
 'Štýlová vila s veľkou záhradou a bazénom. Ideálne miesto pre rodinu, ktorá hľadá pokoj a luxus.', 'property-02.jpg'),

('26 Old Street Miami, OR 38540', 'Luxury Villa', 1460000, 5, 4, 225, '3', '10 spots',
 'Moderná vila s panoramatickým výhľadom. Otvorený dispozičný plán a kvalitné materiály.', 'property-03.jpg'),

('12 New Street Miami, OR 12650', 'Apartment', 584500, 4, 3, 125, '25th', '2 cars',
 'Elegantný apartmán vysoko nad mestom. Moderná kuchyňa, priestranný balkón s výhľadom na panorámu.', 'property-04.jpg'),

('34 Beach Street Miami, OR 42680', 'Penthouse', 925600, 4, 4, 180, '38th', '2 cars',
 'Exkluzívny penthouse na 38. poschodí s ohromujúcim výhľadom na pláž. Privátny bazén a terasa.', 'property-05.jpg'),

('22 New Street Portland, OR 16540', 'Modern Condo', 450000, 3, 2, 165, '26th', '3 cars',
 'Súčasný condo s minimalistickým dizajnom. Skvelá poloha v meste, blízko obchody a reštaurácie.', 'property-06.jpg');