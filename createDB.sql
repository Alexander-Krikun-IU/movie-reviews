-- Tabelle für Filme erstellen
CREATE TABLE movies (
    id SERIAL PRIMARY KEY,              -- Eindeutige ID für jeden Film
    title VARCHAR(255) NOT NULL,        -- Titel des Films
    actors TEXT NOT NULL,               -- Liste der Darsteller
    description TEXT,                   -- Beschreibung des Films
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Erstellungszeitpunkt
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP   -- Letzte Aktualisierung
);

-- Tabelle für Bewertungen erstellen
CREATE TABLE reviews (
    id SERIAL PRIMARY KEY,              -- Eindeutige ID für jede Bewertung
    movie_id INT NOT NULL,              -- Fremdschlüssel zu movies.id
    stars INT CHECK (stars BETWEEN 1 AND 5),  -- Bewertung in Sternen (1-5)
    review_text TEXT,                   -- Text der Bewertung
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Erstellungszeitpunkt
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Letzte Aktualisierung
    FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE -- Beziehungen
);

-- Beispiel-Daten in die Tabelle movies einfügen
INSERT INTO movies (title, actors, description) VALUES
-- Beispiel-Filme
('Inception', 'Leonardo DiCaprio, Joseph Gordon-Levitt, Ellen Page', 'A mind-bending thriller that explores dreams within dreams.'),
('The Matrix', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss', 'A sci-fi classic that questions reality and perception.'),
('The Shawshank Redemption', 'Tim Robbins, Morgan Freeman', 'A story of hope and resilience within a prison.'),
('The Dark Knight', 'Christian Bale, Heath Ledger', 'Batman faces the Joker in a dark and thrilling tale.'),
('Pulp Fiction', 'John Travolta, Uma Thurman, Samuel L. Jackson', 'A crime anthology with sharp dialogue and style.'),
('The Godfather', 'Marlon Brando, Al Pacino', 'The epic saga of a mafia family.'),
('Forrest Gump', 'Tom Hanks, Robin Wright', 'A man with a big heart journeys through life and history.'),
('The Lord of the Rings: The Fellowship of the Ring', 'Elijah Wood, Ian McKellen', 'The start of an epic fantasy adventure.'),
('Star Wars: Episode IV - A New Hope', 'Mark Hamill, Harrison Ford', 'The classic sci-fi saga begins.'),
('Fight Club', 'Brad Pitt, Edward Norton', 'A dark and satirical tale of identity and rebellion.'),
('The Lion King', 'Matthew Broderick, Jeremy Irons', 'An animated classic about loss, family, and destiny.'),
('Avatar', 'Sam Worthington, Zoe Saldana', 'A visually stunning sci-fi epic.'),
('Gladiator', 'Russell Crowe, Joaquin Phoenix', 'A tale of revenge and honor in ancient Rome.'),
('Titanic', 'Leonardo DiCaprio, Kate Winslet', 'A tragic love story set on the ill-fated ship.'),
('Goodfellas', 'Ray Liotta, Robert De Niro', 'The rise and fall of a mobster in gritty detail.'),
('The Avengers', 'Robert Downey Jr., Chris Evans, Scarlett Johansson', 'Superheroes unite to save the world.'),
('Jurassic Park', 'Sam Neill, Laura Dern, Jeff Goldblum', 'A thrilling adventure with dinosaurs.'),
('Interstellar', 'Matthew McConaughey, Anne Hathaway', 'A journey through space to save humanity.'),
('The Social Network', 'Jesse Eisenberg, Andrew Garfield', 'The story of Facebook and its founder.'),
('The Wolf of Wall Street', 'Leonardo DiCaprio, Jonah Hill', 'A wild tale of excess and ambition.'),
('Mad Max: Fury Road', 'Tom Hardy, Charlize Theron', 'A high-octane post-apocalyptic action film.'),
('Toy Story', 'Tom Hanks, Tim Allen', 'The beloved animated tale of living toys.'),
('Saving Private Ryan', 'Tom Hanks, Matt Damon', 'A gripping World War II epic.'),
('The Silence of the Lambs', 'Jodie Foster, Anthony Hopkins', 'A chilling thriller about a cannibalistic killer.'),
('Schindlers List', 'Liam Neeson, Ralph Fiennes', 'A harrowing and emotional Holocaust story.'),
('Avengers: Endgame', 'Robert Downey Jr., Chris Evans', 'The epic conclusion to the Marvel saga.'),
('The Prestige', 'Hugh Jackman, Christian Bale', 'A rivalry between magicians with dark secrets.'),
('Parasite', 'Kang-ho Song, Sun-kyun Lee', 'A Korean masterpiece about class and deception.'),
('The Grand Budapest Hotel', 'Ralph Fiennes, Tony Revolori', 'A quirky tale of adventure and mischief.'),
('Django Unchained', 'Jamie Foxx, Christoph Waltz', 'A revenge western with style and grit.'),
('The Truman Show', 'Jim Carrey, Ed Harris', 'A man discovers his life is a TV show.'),
('The Green Mile', 'Tom Hanks, Michael Clarke Duncan', 'A supernatural and emotional prison drama.'),
('The Revenant', 'Leonardo DiCaprio, Tom Hardy', 'A mans survival and revenge in the wilderness.'),
('Black Panther', 'Chadwick Boseman, Michael B. Jordan', 'A superhero film celebrating culture and heritage.'),
('Logan', 'Hugh Jackman, Patrick Stewart', 'A gritty and emotional send-off for Wolverine.'),
('La La Land', 'Ryan Gosling, Emma Stone', 'A vibrant and romantic musical.'),
('Whiplash', 'Miles Teller, J.K. Simmons', 'A tense exploration of ambition and music.'),
('The Big Short', 'Christian Bale, Steve Carell', 'The financial crisis of 2008 explained with wit.'),
('Frozen', 'Kristen Bell, Idina Menzel', 'A heartwarming animated musical.'),
('Up', 'Ed Asner, Christopher Plummer', 'A touching adventure about life and dreams.'),
('Inside Out', 'Amy Poehler, Phyllis Smith', 'An emotional journey inside a young girls mind.'),
('Spirited Away', 'Rumi Hiiragi, Miyu Irino', 'A stunning animated fantasy from Studio Ghibli.'),
('Coco', 'Anthony Gonzalez, Gael García Bernal', 'A heartwarming tale of family and legacy.'),
('The Pianist', 'Adrien Brody, Thomas Kretschmann', 'A haunting story of survival during the Holocaust.'),
('The Departed', 'Leonardo DiCaprio, Matt Damon', 'A tense and thrilling crime drama.'),
('Shutter Island', 'Leonardo DiCaprio, Mark Ruffalo', 'A mind-twisting thriller.'),
('The Breakfast Club', 'Emilio Estevez, Molly Ringwald', 'A heartfelt coming-of-age classic.'),
('Slumdog Millionaire', 'Dev Patel, Freida Pinto', 'An inspiring rags-to-riches story.'),
('The Hunger Games', 'Jennifer Lawrence, Josh Hutcherson', 'A dystopian survival tale with heart.');

-- Beispiel-Daten in die Tabelle reviews einfügen
INSERT INTO reviews (movie_id, stars, review_text) VALUES
(1, 5, 'An incredible movie that keeps you thinking long after it ends.'),
(2, 4, 'A groundbreaking sci-fi film with amazing action sequences.');

