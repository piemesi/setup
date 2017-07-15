CREATE TABLE books (
id integer unsigned not null auto_increment,
title text,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE authors (
id integer unsigned not null auto_increment,
name text,
PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE book_author (
book_id integer unsigned not null,
author_id integer unsigned not null,
KEY book_author (book_id, author_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

<!-- запрос получающий список книг, которые написаны 3-мя и более со-авторами-->
SELECT books.title, count(*) AS authors_count
FROM books
INNER JOIN book_author ON (book_author.book_id = books.id)
GROUP BY books.id
HAVING authors_count > 2

