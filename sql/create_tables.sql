-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Student(
    id SERIAL PRIMARY KEY, -- 
    name varchar(50), -- Nimi, saa olla myös tyhjä
    email varchar (30) NOT NULL
);

CREATE TABLE Counsellor(
    id SERIAL PRIMARY KEY,
    name varchar(30) NOT NULL,
    password varchar NOT NULL
);

CREATE TABLE Subject(
    id SERIAL PRIMARY KEY,
    subject varchar(30)
);

CREATE TABLE Question(
    id SERIAL PRIMARY KEY,
    student_id INTEGER REFERENCES Student(id),
    date DATE,
    questiontext varchar(400),
    subject_id INTEGER REFERENCES Subject(id),
    status boolean DEFAULT false
);

CREATE TABLE Answer(
    question_id INTEGER REFERENCES Question(id),
    counsellor_id INTEGER REFERENCES Counsellor(id),
    answertext varchar(400)
);
