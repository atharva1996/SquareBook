CREATE TABLE log
(
	lid serial primary key,
	"File_Name" character varying(20),
	"Sheet_Name" character varying(20),
	"Date" character varying(25)
);
CREATE TABLE login
(
	"Fname" character varying(20),
	"Lname" character varying(20),
	"Phone" character varying(15),
	"Email" character varying(100),
	"Password" character varying(100),
	"Code" character varying(100),
	"Flag" character varying(1)
);
CREATE TABLE person_details
(
	pid serial primary key,
	lid int8,
	FOREIGN KEY(lid) REFERENCES log(lid),
	sal character varying(10),
	fname character varying(20),
	lname character varying(20),
	phone character varying(100),
	email character varying(100),
	mobile character varying(20),
	dob character varying(20),
	anniversary character varying(20),
	inserted_at character varying(25),
	updated_at character varying(25)
);
CREATE TABLE source_details
(
	sid serial primary key,
	src_name character varying(200),
	src_desc character varying(200),
	inserted_at character varying(25),
	updated_at character varying(25)
);
CREATE TABLE company_details
(
	cmpid serial primary key,
	pid int8,
	sid int8,
	FOREIGN KEY(pid) REFERENCES person_details(pid),
	FOREIGN KEY(sid) REFERENCES source_details(sid),
	cmp_name character varying(200),
	designation character varying(200),
	fax character varying(40),
	inserted_at character varying(25),
	updated_at character varying(25)
);
CREATE TABLE address_details
(
	aid serial primary key,
	pid int8,
	cmpid int8,
	FOREIGN KEY(pid) REFERENCES person_details(pid),
	FOREIGN KEY(cmpid) REFERENCES company_details(cmpid),
	c_addr1 character varying(500),
	c_addr2 character varying(500),
	c_addr3 character varying(500),
	city character varying(100),
	pincode character varying(25),
	country character varying(50),
	inserted_at character varying(25),
	updated_at character varying(25)
);
CREATE TABLE category_details
(
	catid serial primary key,
	cat_name character varying(200),
	inserted_at character varying(25),
	updated_at character varying(25)
);
CREATE TABLE person_source
(
	psid serial primary key,
	pid int8 REFERENCES person_details(pid),
	sid int8 REFERENCES source_details(sid),
	inserted_at character varying(25),
	updated_at character varying(25)
);

CREATE TABLE person_category
(
	pcid serial primary key,
	pid int8 REFERENCES person_details(pid),
	catid int8 REFERENCES category_details(catid),
	inserted_at character varying(25),
	updated_at character varying(25)
);
CREATE TABLE book_event_details
(
	bookid serial primary key,
	book_event character varying(25)
);
CREATE TABLE art_event_details
(
	artid serial primary key,
	art_event character varying(25)
);
CREATE TABLE food_promo_details
(
	foodid serial primary key,
	food_promo character varying(25)
);
CREATE TABLE alcohol_pairing_details
(
	alcid serial primary key,
	alcohol_pairing character varying(25)
);
CREATE TABLE fund_raiser_details
(
	fundid serial primary key,
	fund_raiser character varying(25)
);
CREATE TABLE fashion_event_details
(
	fashionid serial primary key,
	fashion_event character varying(25)
);
CREATE TABLE sports_event_details
(
	sportsid serial primary key,
	sports_event character varying(25)
);
CREATE TABLE vip_event_details
(
	vipid serial primary key,
	vip_event character varying(25)
);
INSERT INTO book_event_details("book_event") VALUES('yes');
INSERT INTO book_event_details("book_event") VALUES('no');
INSERT INTO art_event_details("art_event") VALUES('yes');
INSERT INTO art_event_details("art_event") VALUES('no');
INSERT INTO food_promo_details("food_promo") VALUES('yes');
INSERT INTO food_promo_details("food_promo") VALUES('no');
INSERT INTO alcohol_pairing_details("alcohol_pairing") VALUES('yes');
INSERT INTO alcohol_pairing_details("alcohol_pairing") VALUES('no');
INSERT INTO fund_raiser_details("fund_raiser") VALUES('yes');
INSERT INTO fund_raiser_details("fund_raiser") VALUES('no');
INSERT INTO fashion_event_details("fashion_event") VALUES('yes');
INSERT INTO fashion_event_details("fashion_event") VALUES('no');
INSERT INTO sports_event_details("sports_event") VALUES('yes');
INSERT INTO sports_event_details("sports_event") VALUES('no');
INSERT INTO vip_event_details("vip_event") VALUES('yes');
INSERT INTO vip_event_details("vip_event") VALUES('no');
CREATE TABLE person_event
(
	peid serial primary key,
	pid int8 REFERENCES person_details(pid),
	bookid int8 REFERENCES book_event_details(bookid),
	artid int8 REFERENCES art_event_details(artid),
	foodid int8 REFERENCES food_promo_details(foodid),
	alcid int8 REFERENCES alcohol_pairing_details(alcid),
	fundid int8 REFERENCES fund_raiser_details(fundid),
	fashionid int8 REFERENCES fashion_event_details(fashionid),
	sportsid int8 REFERENCES sports_event_details(sportsid),
	vipid int8 REFERENCES vip_event_details(vipid)
);