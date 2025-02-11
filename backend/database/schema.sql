CREATE TABLE IF NOT EXISTS users (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS notices (
    id CHAR(36) PRIMARY KEY DEFAULT (UUID()),                       -- GUID as ID
    title VARCHAR(255) NOT NULL,                                    -- Notice title
    content TEXT NOT NULL,                                          -- Notice content
    created_by CHAR(36) NOT NULL,                                   -- Admin ID (GUID)
    views INT DEFAULT 0,                                            -- View count
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,                 -- Creation Time
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Last Update Time
    updated_by CHAR(36) NOT NULL                                                 -- Editor Admin ID (GUID)
);

