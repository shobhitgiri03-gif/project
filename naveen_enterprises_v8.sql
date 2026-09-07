-- Naveen Enterprises V8 MySQL Database
-- Import this file in phpMyAdmin / MySQL 8+
-- Database: naveen_enterprises

CREATE DATABASE IF NOT EXISTS naveen_enterprises
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE naveen_enterprises;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS enquiries;
DROP TABLE IF EXISTS gallery;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS settings;
DROP TABLE IF EXISTS admins;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE admins (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(150) DEFAULT NULL,
    role ENUM('admin','staff') NOT NULL DEFAULT 'admin',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL UNIQUE,
    slug VARCHAR(140) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED DEFAULT NULL,
    name VARCHAR(180) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    description TEXT DEFAULT NULL,
    image_url VARCHAR(1000) DEFAULT NULL,
    price DECIMAL(12,2) DEFAULT NULL,
    featured TINYINT(1) NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_category
      FOREIGN KEY (category_id) REFERENCES categories(id)
      ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_products_category (category_id),
    INDEX idx_products_featured (featured),
    INDEX idx_products_active (is_active)
) ENGINE=InnoDB;

CREATE TABLE gallery (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(180) DEFAULT NULL,
    image_url VARCHAR(1000) NOT NULL,
    alt_text VARCHAR(255) DEFAULT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE enquiries (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    phone VARCHAR(40) DEFAULT NULL,
    email VARCHAR(190) DEFAULT NULL,
    product_id BIGINT UNSIGNED DEFAULT NULL,
    message TEXT DEFAULT NULL,
    status ENUM('New','Viewed','Contacted','Closed') NOT NULL DEFAULT 'New',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_enquiries_product
      FOREIGN KEY (product_id) REFERENCES products(id)
      ON DELETE SET NULL ON UPDATE CASCADE,
    INDEX idx_enquiries_status (status),
    INDEX idx_enquiries_created (created_at)
) ENGINE=InnoDB;

CREATE TABLE settings (
    setting_key VARCHAR(100) PRIMARY KEY,
    setting_value TEXT NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Initial categories
INSERT INTO categories (name, slug, description) VALUES
('Bakery', 'bakery', 'Bakery and confectionery supplies'),
('Cake Supplies', 'cake-supplies', 'Creams, toppings and cake finishing supplies'),
('Packaging', 'packaging', 'Cake, bakery and gift packaging'),
('Bags', 'bags', 'LD and non-woven bags'),
('Party', 'party', 'Party and celebration essentials');

-- Initial products
INSERT INTO products (category_id, name, slug, description, featured) VALUES
((SELECT id FROM categories WHERE slug='bakery'),
 'Fancy Bakery Products', 'fancy-bakery-products',
 'Everyday and fancy bakery requirements.', 1),
((SELECT id FROM categories WHERE slug='cake-supplies'),
 'Cake Cream & Toppings', 'cake-cream-toppings',
 'Creams and toppings for premium finishing.', 1),
((SELECT id FROM categories WHERE slug='packaging'),
 'Cake & Bakery Boxes', 'cake-bakery-boxes',
 'Stylish packaging for cakes and bakery products.', 1),
((SELECT id FROM categories WHERE slug='packaging'),
 'Fancy Gift Packaging', 'fancy-gift-packaging',
 'Premium-looking packaging for celebrations.', 0),
((SELECT id FROM categories WHERE slug='bags'),
 'LD & Non-Woven Bags', 'ld-non-woven-bags',
 'Business and shopping bags with printing options.', 0),
((SELECT id FROM categories WHERE slug='party'),
 'Party Essentials', 'party-essentials',
 'Stylish essentials for birthdays and events.', 0);

-- Website settings
INSERT INTO settings (setting_key, setting_value) VALUES
('brand_name', 'NAVEEN ENTERPRISES'),
('tagline', 'BAKE & PACK SOLUTION'),
('hero_company_color', '#526d9c'),
('hero_tagline_color', '#7890b7'),
('phone', ''),
('whatsapp', ''),
('email', ''),
('address', '')
ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value);

-- IMPORTANT:
-- Do NOT put a plain-text admin password in the database.
-- Generate a PHP password_hash() value and insert it into admins.password_hash.
--
-- Example PHP:
-- echo password_hash('YOUR_STRONG_PASSWORD', PASSWORD_DEFAULT);
--
-- Then:
-- INSERT INTO admins (username, password_hash, full_name)
-- VALUES ('admin', 'PASTE_HASH_HERE', 'Naveen Enterprises Admin');
