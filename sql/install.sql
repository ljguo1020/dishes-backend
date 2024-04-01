DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS user_info;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS permission;


-- user 表 

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255),
    status TINYINT(1),
    role_id INT,
    salt VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO user (username, password, status, role_id, salt) VALUES ('ljguo', '20001020', 1, 1, 'abcd1234');
INSERT INTO user (username, password, status, role_id, salt) VALUES ('jane_smith', 'letmein', 0, 2, 'efgh5678');


-- user_info 表

CREATE TABLE user_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    avatar VARCHAR(255),
    user_id INT,
    phone VARCHAR(20),
    email VARCHAR(255),
    create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    update_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO user_info (avatar, user_id, phone, email) VALUES ('avatar1.jpg', 1, '123456789', 'john@example.com');
INSERT INTO user_info (avatar, user_id, phone, email) VALUES ('avatar2.jpg', 2, '987654321', 'jane@example.com');


-- role 表
CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(256),
    role_name_zh VARCHAR(256),
    permission_ids VARCHAR(256)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO role (role_name, role_name_zh, permission_ids) VALUES ('admin', '管理员', '1,2,3');
INSERT INTO role (role_name, role_name_zh, permission_ids) VALUES ('user', '普通用户', '2,3');

-- permission 表

CREATE TABLE permission (
    id INT PRIMARY KEY AUTO_INCREMENT,
    permission_name VARCHAR(256),
    permission_desc VARCHAR(256)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO permission (permission_name, permission_desc) VALUES ('user:read', '读取权限，允许用户查看内容');
INSERT INTO permission (permission_name, permission_desc) VALUES ('user:create', '写入权限，允许用户编辑内容');
INSERT INTO permission (permission_name, permission_desc) VALUES ('user:delete', '删除权限，允许用户删除内容');
