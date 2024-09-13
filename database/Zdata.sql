CREATE TABLE IF NOT EXISTS User (
    UserId  INTEGER PRIMARY KEY AUTOINCREMENT,
    DisplayName VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS Manufacturer (
    ManId   INTEGER PRIMARY KEY AUTOINCREMENT,
    ManName    VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS Item (
    ItemId INTEGER PRIMARY KEY AUTOINCREMENT,
    ItemName   VARCHAR(30),
    ManId  INT,  
    Tracks  VARCHAR(100),
    CoverImage VARCHAR(100),
    FOREIGN KEY (ManId) REFERENCES Manufacturer(ManId)
);

CREATE TABLE IF NOT EXISTS Review (
    ReviewId   INTEGER PRIMARY KEY AUTOINCREMENT,
    UserId  INT,
    ItemId  INT,
    Rating  INT,
    ReviewBody VARCHAR(100),
    Date    DATETIME,
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (ItemId) REFERENCES Item(ItemId)
);

INSERT INTO Manufacturer (ManName) VALUES
    ('Radiohead'),
    ('Black Country New Road'),
    ('Neutral Milk Hotel'),
    ('Kendrick Lamar');

INSERT INTO Item (ItemName, ManId, Tracks, CoverImage) VALUES
    ('In Rainbows', 1, '15 Step, Body Snachers, .....', 'images/InRainbows.png'),
    ('Ants From Up There', 2, 'Intro, Chaos Space Marine, ....', 'images/AFUT.png'),
    ('In The Aeroplane Over The Sea', 3, 'Two Headed Boy, King Of Carrot Flowers, ...', 'images/ITAOTS.png'),
    ('To Pimp A Butterfly', 4, 'Wesleys Theory, King Kunta, ....', 'images/TPAB.png');

INSERT INTO Review (UserId, ItemId, Rating, ReviewBody, Date) VALUES
    (1, 1, 10, 'Incredible, best album ever!', '2024-08-10 14:21:55'),
    (2, 4, 8, 'Really Good!', '2021-11-10 14:21:55'),
    (3, 2, 7, 'Not the best but a great one for sure!', '2024-03-20 15:22:45'),
    (4, 3, 9, 'Very interesting!', '2022-03-16 14:21:55');


INSERT INTO User (DisplayName) VALUES
    ('joelc0406'),
    ('johnCena1'),
    ('walterWh1t3'),
    ('eloMoosk');

