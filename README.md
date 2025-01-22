# Personal Blog
Welcome to the repository for my personal blog! This project serves as the backend and frontend of a simple blogging platform. The blog consists of two primary sections: the Guest Section and the Admin Section. 

## Features
Article Management: Add, edit, or delete articles easily from the admin dashboard.
Public Access: Anyone can view articles on the home page and read individual articles.
User Authentication: Admin users can log in to access the dashboard for managing articles.
Technologies Used
Frontend: HTML, CSS
Backend: PHP
Database: MySQL

## Prerequisites
- **Xampp**
- **MySQL Manager**
- **PHP Intalled**

## Installing
### 1. Clone Repository in htdocs directory
```bash
git clone https://github.com/rodrigocarreonc/personal-blog.git
```
## 2.- Run SQL code in database manager

```bash
Create database personalBlog;
use personalBlog;
create table article(
	article_id int primary key auto_increment,
    title varchar(100) not null,
    date varchar(10) not null,
    content text not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);
create table users(
	user_id int auto_increment primary key,
    name varchar(100) not null,
    username varchar(50) unique not null,
    password varchar(255) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);
insert into users(name,username,password) values ("Jhon Doe","admin","admin123");
insert into article(title,date,content) values ("Welcome","01/22/2025","Hi! Welcome for my project");
```

## 3.-Start Server with xampp and go to the url project
http://localhost/personal-blog/

URL ROADMAP.SH IDEA: https://roadmap.sh/projects/personal-blog
