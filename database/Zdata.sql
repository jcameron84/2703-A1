
CREATE TABLE IF NOT EXISTS Item (
    ItemId INTEGER PRIMARY KEY,
    Name   VARCHAR(30),
    ManId  INT,  
    Tracks  VARCHAR(100),
    FOREIGN KEY (ManId) REFERENCES Manufacturer(ManId)
);

CREATE TABLE IF NOT EXISTS Manufacturer (
    ManId   INTEGER PRIMARY KEY,
    Name    VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS Review (
    ReviewId   INTEGER PRIMARY KEY,
    UserID  INT,
    ItemId  INT,
    Rating  INT,
    ReviewBody VARCHAR(100),
    Date    DATETIME,
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (ItemId) REFERENCES Item(ItemId)
);

CREATE TABLE IF NOT EXISTS User (
    UserId  INTEGER PRIMARY KEY,
    DisplayName VARCHAR(20)
);

INSERT INTO Item (ItemId, Name, ManId, Tracks) VALUES
    (NULL, 'In Rainbows', 1, '15 Step, Body Snachers, .....'),
    (NULL, 'Ants From Up There', 2, 'Intro, Chaos Space Marine, ....'),
    (NULL, 'In The Aeroplan Over The Sea', 3, 'Two Headed Boy, King Of Carrot Flowers, ...'),
    (NULL, 'To Pimp A Butterfly', 4, 'Wesleys Theory, King Kunta, ....');

INSERT INTO Manufacturer (ManId, Name) VALUES
    (NULL, 'Radiohead'),
    (NULL, 'Black Country New Road'),
    (NULL, 'Neutral Milk Hotel'),
    (NULL, 'Kendrick Lamar')


INSERT INTO Review (ReviewId, UserId, ItemId, Rating, ReviewBody, Date) VALUES
    (NULL, 1, 1, 10, 'Incredible, best album ever!', '2024-08-10 14:21:55'),
    (NULL, 2, 4, 8, 'Really Good!', '2021-11-10 14:21:55'),
    (NULL, 3, 2, 7, 'Not the best but a great one for sure!', '2024-03-20 15:22:45'),
    (NULL, 4, 3, 9, 'Very interesting!', '2022-03-16 14:21:55'),


INSERT INTO User (userID, DisplayName) VALUES
    (NULL, 'joelc0406'),
    (NULL, 'johnCena1'),
    (NULL, 'walterWh1t3'),
    (NULL, 'eloMoosk');

