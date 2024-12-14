CREATE TABLE member_updates (
    id SERIAL PRIMARY KEY,                     
    post_date DATE DEFAULT CURRENT_DATE,       
    post_title VARCHAR(255) NOT NULL,          
    post_article TEXT NOT NULL,                
    post_image VARCHAR(255),                   
    status VARCHAR(20) DEFAULT 'draft',        
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);
