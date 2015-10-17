--INSERT INTO Student (name, email) VALUES ('Pirkko', 'mina@email.fi');

INSERT INTO Counsellor (username, password) VALUES ('tarmo.tietaja@email.com', 'salasana123');

INSERT INTO Counsellor (username, password, administrator) VALUES ('pirkko.parempi@email.com', '1972', true);

INSERT INTO Category (category_name) VALUES ('Tyhmät kysymykset');

INSERT INTO Category (category_name) VALUES ('Fiksut kysymykset');

INSERT INTO Category (category_name) VALUES ('Kaikki muut kysymykset');

INSERT INTO Question (questiontext, title, nametext, category_id) VALUES ('Tarvitseeko sateella mennä yliopistolle?', 'Säätiedoitus', 'Jari', 2);

INSERT INTO Answer (answertext, question_id) VALUES ('Ei tarvitse, vaan voit itse päättää haluatko osallistua luennolle.', 1);
-- Lisää INSERT INTO lauseet tähän tiedostoon
