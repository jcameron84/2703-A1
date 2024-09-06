
CREATE TABLE IF NOT EXISTS USER_POST (
    postID integer not null primary key,
    title   VARCHAR(30),
    author  INT,  
    message VARCHAR(100),
    date    DATETIME,
    FOREIGN KEY (author) REFERENCES USER(userID)
);

CREATE TABLE IF NOT EXISTS COMMENT (
    commentID   INT,
    onPost  INT,
    author  INT,
    date    DATETIME,
    message VARCHAR(100),
    PRIMARY KEY (commentID),
    FOREIGN KEY (onPost) REFERENCES USER_POST(postID),
    FOREIGN KEY (author) REFERENCES USER(userID)
);

CREATE TABLE IF NOT EXISTS USER (
    userID  INTEGER PRIMARY KEY,
    displayName VARCHAR(20)
);



INSERT INTO USER_POST (postID, title, author, message, date) VALUES
    (NULL, 'New Social Media Z!!', 1, 'This is the first post on my brand new social media platform called Z!!', '2023-09-09 10:16:00'),
    (NULL, 'Fist Post on Z!', 2, 'This new social media platform seems pretty cool!', '2023-09-09 10:30:34'),
    (NULL, 'Selling Blue Sky', 3, 'Anyone interested in blue sky, hit me up in my Z DMs', '2023-09-09 11:00:00'),
    (NULL, 'This is theft!!!!', 4, 'This is clear theft of my platform X formerly known as twitter!!!!', '2023-09-10 03:34:00');

INSERT INTO COMMENT (commentID, onPost, author, date, message) VALUES
    (NULL, 1, 4, '2023-09-09 10:24:12', 'This is clear theft!!!'),
    (NULL, 1, 2, '2023-09-09 10:45:14', "YOU CAN'T SEE ME"),
    (NULL, 4, 1, '2023-09-10 03-36-14', 'WAH WAH WAH');

INSERT INTO USER (userID, displayName) VALUES
    (NULL, 'joelc0406'),
    (NULL, 'johnCena1'),
    (NULL, 'walterWh1t3'),
    (NULL, 'eloMoosk');