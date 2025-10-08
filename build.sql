
-- Create table restaurant locations

CREATE TABLE restaurant_location(
    location_id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(80),
    state VARCHAR(30),
    address VARCHAR(255),
    zip VARCHAR(10)
);


-- Creating restaurant table

CREATE TABLE restaurant(
    restaurant_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    location_id INT,
    FOREIGN KEY (location_id) REFERENCES restaurant_location(location_id)
);


-- Creating menu category table

CREATE TABLE menu_category(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(100) NOT NULL
);


-- Creating menu items table

CREATE TABLE menu_item(
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(150) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    description TEXT,
    category_id INT,
    restaurant_id INT,
    FOREIGN KEY (category_id) REFERENCES menu_category(category_id),
    FOREIGN KEY (restaurant_id) REFERENCES restaurant(restaurant_id)
);


-- Insert data into locations

INSERT INTO restaurant_location (city, state, address, zip) VALUES
('Bloomington', 'IN', '2121 N College Ave', '47404'),
('Indianapolis', 'IN', '812 Market St', '46225');


-- Insert data into restaurants

INSERT INTO restaurant (name, phone, location_id) VALUES
('Roose & Vine - Bloomington', '(812) 555-5555', 1),
('Roose & Vine - Indianapolis', '(812) 777-7777', 2);



-- Insert data into menu categories table

INSERT INTO menu_category (category_name) VALUES
('Starters'),
('Entrees'),
('Sides'),
('Drinks');


-- Insert data into menu items table

INSERT INTO menu_item (item_name, price, description, category_id, restaurant_id) VALUES
('Bruschetta al Pomodoro', 7.49, 'Grilled bread topped with fresh tomatoes, basil, and olive oil', 1, 1),
('Calamari Fritti', 9.99, 'Crispy fried squid served with lemon and marinara sauce', 1, 2),
('Spaghetti Carbonara', 13.99, 'Classic Roman pasta with pancetta, egg, parmesan, and black pepper', 2, 1),
('Chicken Parmigiana', 15.49, 'Breaded chicken breast topped with marinara and melted mozzarella, served with pasta', 2, 2),
('Garlic Bread', 4.99, 'Toasted baguette slices brushed with garlic butter and herbs', 3, 1),
('Caprese Salad', 6.49, 'Fresh mozzarella, tomatoes, and basil drizzled with balsamic glaze', 3, 2),
('Italian Soda', 3.99, 'Sparkling water with flavored syrup and a splash of cream', 4, 1),
('Espresso', 2.49, 'Rich, bold Italian-style espresso shot', 4, 2);

