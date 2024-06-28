-- initdb.d/init.sql

-- Vérifiez si l'utilisateur existe déjà, et le supprimez si c'est le cas
DROP USER IF EXISTS 'laravel'@'%';

-- Créez l'utilisateur et accordez les privilèges
CREATE USER 'laravel'@'%' IDENTIFIED BY 'laravel';
GRANT ALL PRIVILEGES ON gestionstock.* TO 'laravel'@'%';
FLUSH PRIVILEGES;

