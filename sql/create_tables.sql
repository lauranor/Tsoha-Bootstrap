
CREATE TABLE Student(
    id SERIAL PRIMARY KEY, -- 
    nametext varchar(50), -- nimi, saa olla myös tyhjä
    email varchar (30) NOT NULL
);

CREATE TABLE Counsellor(
    id SERIAL PRIMARY KEY,
    nametext varchar(30) NOT NULL,
    password varchar NOT NULL,
    administrator boolean DEFAULT false
);

CREATE TABLE Subject(
    id SERIAL PRIMARY KEY,
    subject varchar(30)
);

CREATE TABLE Question(
    id SERIAL PRIMARY KEY,
    added DATE DEFAULT NOW(),
    title varchar(50),
    questiontext varchar(400),
    --subject_id INTEGER DEFAULT NULL REFERENCES Subject(id),
    --student_id INTEGER DEFAULT NULL REFERENCES Student(id),
    status boolean DEFAULT false
);

CREATE TABLE Answer(
    counsellor_id INTEGER REFERENCES Counsellor(id),
    question_id INTEGER REFERENCES Question(id),
    answer varchar(400)
);
