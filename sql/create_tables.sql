
CREATE TABLE Student(
    id SERIAL PRIMARY KEY, -- 
    nametext varchar(50), -- nimi, saa olla myös tyhjä
    email varchar (50) NOT NULL
);

CREATE TABLE Counsellor(
    id SERIAL PRIMARY KEY,
    username varchar(50) NOT NULL,
    password varchar NOT NULL,
    administrator boolean DEFAULT false
);

CREATE TABLE Category(
    id SERIAL PRIMARY KEY,
    category_name varchar(50)
);

CREATE TABLE Question(
    id SERIAL PRIMARY KEY,
    added DATE DEFAULT NOW(),
    title varchar(50),
    questiontext varchar(400),
    answertext varchar (400),
    nametext varchar(30),
    category_id INTEGER DEFAULT NULL REFERENCES Category(id),
    --student_id INTEGER DEFAULT NULL REFERENCES Student(id),
    status boolean DEFAULT false
);

CREATE TABLE Answer(
    id SERIAL PRIMARY KEY,
    question_id INTEGER REFERENCES Question(id),
    answertext varchar(400)
);
