--
-- PostgreSQL database dump
--

-- Dumped from database version 10.2
-- Dumped by pg_dump version 10.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: author; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE author (
    book_id integer NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE author OWNER TO postgres;

--
-- Name: book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE book (
    id integer NOT NULL,
    metadata_id integer NOT NULL,
    going integer,
    active boolean DEFAULT true NOT NULL
);


ALTER TABLE book OWNER TO postgres;

--
-- Name: book_genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE book_genre (
    book_id integer NOT NULL,
    genre_id integer NOT NULL
);


ALTER TABLE book_genre OWNER TO postgres;

--
-- Name: book_id_seq1; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE book_id_seq1
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE book_id_seq1 OWNER TO postgres;

--
-- Name: book_id_seq1; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE book_id_seq1 OWNED BY book.id;


--
-- Name: book_language; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE book_language (
    language_id integer NOT NULL,
    book_id integer NOT NULL
);


ALTER TABLE book_language OWNER TO postgres;

--
-- Name: comment; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE comment (
    id integer NOT NULL,
    user_id integer NOT NULL,
    book_id integer NOT NULL,
    body character varying(257) NOT NULL,
    date timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE comment OWNER TO postgres;

--
-- Name: comment_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE comment_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE comment_id_seq OWNER TO postgres;

--
-- Name: comment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE comment_id_seq OWNED BY comment.id;


--
-- Name: country; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE country (
    id integer NOT NULL,
    name character varying(128),
    abbreviation character varying(5)
);


ALTER TABLE country OWNER TO postgres;

--
-- Name: country_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE country_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE country_id_seq OWNER TO postgres;

--
-- Name: country_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE country_id_seq OWNED BY country.id;


--
-- Name: download; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE download (
    date timestamp without time zone DEFAULT now() NOT NULL,
    user_id integer NOT NULL,
    book_id integer NOT NULL,
    language_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE download OWNER TO postgres;

--
-- Name: download_count; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE download_count
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 99999
    CACHE 10;


ALTER TABLE download_count OWNER TO postgres;

--
-- Name: download_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE download_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE download_id_seq OWNER TO postgres;

--
-- Name: download_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE download_id_seq OWNED BY download.id;


--
-- Name: favorite; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE favorite (
    user_id integer NOT NULL,
    book_id integer NOT NULL
);


ALTER TABLE favorite OWNER TO postgres;

--
-- Name: feed; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed (
    id integer NOT NULL,
    date timestamp with time zone DEFAULT now(),
    body text,
    title character varying(156),
    user_id integer
);


ALTER TABLE feed OWNER TO postgres;

--
-- Name: feed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE feed_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE feed_id_seq OWNER TO postgres;

--
-- Name: feed_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE feed_id_seq OWNED BY feed.id;


--
-- Name: friend; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE friend (
    sended_user_id integer NOT NULL,
    received_user_id integer NOT NULL,
    status boolean DEFAULT false
);


ALTER TABLE friend OWNER TO postgres;

--
-- Name: genre; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE genre (
    id integer NOT NULL,
    name character varying(30) NOT NULL,
    description text
);


ALTER TABLE genre OWNER TO postgres;

--
-- Name: genre_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE genre_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE genre_id_seq OWNER TO postgres;

--
-- Name: genre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE genre_id_seq OWNED BY genre.id;


--
-- Name: language; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE language (
    id integer NOT NULL,
    name character varying(28),
    abbreviation character varying(5)
);


ALTER TABLE language OWNER TO postgres;

--
-- Name: language_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE language_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE language_id_seq OWNER TO postgres;

--
-- Name: language_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE language_id_seq OWNED BY language.id;


--
-- Name: metadata; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE metadata (
    id integer NOT NULL,
    title character varying(56) NOT NULL,
    synopsis text,
    comments text,
    publication_date date,
    complete boolean,
    upload_date timestamp with time zone DEFAULT now()
);


ALTER TABLE metadata OWNER TO postgres;

--
-- Name: metadata_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE metadata_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE metadata_id_seq OWNER TO postgres;

--
-- Name: metadata_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE metadata_id_seq OWNED BY metadata.id;


--
-- Name: person; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE person (
    id integer NOT NULL,
    first_name character varying(32) NOT NULL,
    last_name character varying(32) NOT NULL,
    city character varying(128),
    birth_date date NOT NULL,
    user_id integer NOT NULL,
    gender character varying(18),
    country_id integer
);


ALTER TABLE person OWNER TO postgres;

--
-- Name: person_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE person_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE person_id_seq OWNER TO postgres;

--
-- Name: person_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE person_id_seq OWNED BY person.id;


--
-- Name: profile_texts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE profile_texts (
    id integer NOT NULL,
    thought character varying(164),
    user_id integer NOT NULL,
    biography text
);


ALTER TABLE profile_texts OWNER TO postgres;

--
-- Name: rate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rate (
    value real NOT NULL,
    user_id integer NOT NULL,
    book_id integer NOT NULL
);


ALTER TABLE rate OWNER TO postgres;

--
-- Name: usr; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usr (
    id integer NOT NULL,
    username character varying(16) NOT NULL,
    email character varying(64) NOT NULL,
    password character varying(256) NOT NULL,
    active boolean DEFAULT true NOT NULL
);


ALTER TABLE usr OWNER TO postgres;

--
-- Name: search_book_generic; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW search_book_generic AS
 SELECT DISTINCT bo.id AS book_id,
    bo.title,
    bo.complete,
    string_agg((u.username)::text, ', '::text ORDER BY (u.username)::text) AS authors,
    ge.genre,
    la.language,
    to_char(bo.upload_date, 'dd/mm/YYYY  HH24:MI:SS'::text) AS upload_date
   FROM ((((( SELECT DISTINCT b.id,
            b.metadata_id,
            m.title,
            m.complete,
            m.upload_date
           FROM ((((book b
             JOIN author a_1 ON ((a_1.book_id = b.id)))
             JOIN usr u_1 ON ((u_1.id = a_1.user_id)))
             JOIN person p ON ((p.user_id = u_1.id)))
             JOIN metadata m ON ((m.id = b.metadata_id)))
          WHERE ((lower((m.title)::text) ~~ '%$search%'::text) OR (lower(m.synopsis) ~~ '%$search%'::text) OR (lower((u_1.username)::text) ~~ '%$search%'::text) OR (((lower((p.first_name)::text) || ' '::text) || lower((p.last_name)::text)) ~~ '%$search%'::text) OR (lower((p.first_name)::text) ~~ '%$search%'::text) OR (lower((p.last_name)::text) ~~ '%$search%'::text))) bo
     JOIN author a ON ((a.book_id = bo.id)))
     JOIN usr u ON ((u.id = a.user_id)))
     JOIN ( SELECT string_agg((g.name)::text, ', '::text ORDER BY (g.name)::text) AS genre,
            bg.book_id
           FROM (book_genre bg
             JOIN genre g ON ((g.id = bg.genre_id)))
          GROUP BY bg.book_id) ge ON ((ge.book_id = bo.id)))
     JOIN ( SELECT string_agg((l.name)::text, ', '::text ORDER BY (l.name)::text) AS language,
            bl.book_id
           FROM (book_language bl
             JOIN language l ON ((l.id = bl.language_id)))
          GROUP BY bl.book_id) la ON ((la.book_id = bo.id)))
  GROUP BY bo.id, bo.title, ge.genre, bo.complete, bo.upload_date, la.language
  ORDER BY bo.title, ge.genre;


ALTER TABLE search_book_generic OWNER TO postgres;

--
-- Name: thought_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE thought_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE thought_id_seq OWNER TO postgres;

--
-- Name: thought_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE thought_id_seq OWNED BY profile_texts.id;


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY usr.id;


--
-- Name: view; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE view (
    date timestamp without time zone DEFAULT now() NOT NULL,
    user_id integer NOT NULL,
    book_id integer NOT NULL,
    language_id integer NOT NULL,
    id integer NOT NULL
);


ALTER TABLE view OWNER TO postgres;

--
-- Name: view_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE view_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE view_id_seq OWNER TO postgres;

--
-- Name: view_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE view_id_seq OWNED BY view.id;


--
-- Name: book id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book ALTER COLUMN id SET DEFAULT nextval('book_id_seq1'::regclass);


--
-- Name: comment id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment ALTER COLUMN id SET DEFAULT nextval('comment_id_seq'::regclass);


--
-- Name: country id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY country ALTER COLUMN id SET DEFAULT nextval('country_id_seq'::regclass);


--
-- Name: download id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY download ALTER COLUMN id SET DEFAULT nextval('download_id_seq'::regclass);


--
-- Name: feed id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed ALTER COLUMN id SET DEFAULT nextval('feed_id_seq'::regclass);


--
-- Name: genre id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY genre ALTER COLUMN id SET DEFAULT nextval('genre_id_seq'::regclass);


--
-- Name: language id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY language ALTER COLUMN id SET DEFAULT nextval('language_id_seq'::regclass);


--
-- Name: metadata id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metadata ALTER COLUMN id SET DEFAULT nextval('metadata_id_seq'::regclass);


--
-- Name: person id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY person ALTER COLUMN id SET DEFAULT nextval('person_id_seq'::regclass);


--
-- Name: profile_texts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profile_texts ALTER COLUMN id SET DEFAULT nextval('thought_id_seq'::regclass);


--
-- Name: usr id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usr ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Name: view id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY view ALTER COLUMN id SET DEFAULT nextval('view_id_seq'::regclass);


--
-- Data for Name: author; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO author VALUES (37, 2);
INSERT INTO author VALUES (37, 3);
INSERT INTO author VALUES (36, 1);
INSERT INTO author VALUES (38, 8);
INSERT INTO author VALUES (37, 5);
INSERT INTO author VALUES (45, 15);
INSERT INTO author VALUES (45, 7);
INSERT INTO author VALUES (40, 1);
INSERT INTO author VALUES (41, 1);
INSERT INTO author VALUES (41, 2);
INSERT INTO author VALUES (42, 4);
INSERT INTO author VALUES (43, 4);
INSERT INTO author VALUES (45, 6);
INSERT INTO author VALUES (49, 15);
INSERT INTO author VALUES (49, 9);
INSERT INTO author VALUES (55, 9);
INSERT INTO author VALUES (55, 7);
INSERT INTO author VALUES (56, 17);
INSERT INTO author VALUES (56, 1);
INSERT INTO author VALUES (57, 1);
INSERT INTO author VALUES (57, 8);
INSERT INTO author VALUES (58, 1);
INSERT INTO author VALUES (58, 8);
INSERT INTO author VALUES (59, 1);
INSERT INTO author VALUES (59, 8);
INSERT INTO author VALUES (39, 8);
INSERT INTO author VALUES (39, 1);
INSERT INTO author VALUES (39, 2);


--
-- Data for Name: book; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO book VALUES (36, 39, 0, true);
INSERT INTO book VALUES (37, 40, 0, true);
INSERT INTO book VALUES (38, 41, 0, true);
INSERT INTO book VALUES (42, 45, 0, true);
INSERT INTO book VALUES (43, 46, 0, true);
INSERT INTO book VALUES (45, 48, 0, true);
INSERT INTO book VALUES (49, 52, 0, true);
INSERT INTO book VALUES (40, 43, 0, true);
INSERT INTO book VALUES (55, 58, 0, true);
INSERT INTO book VALUES (56, 59, 0, true);
INSERT INTO book VALUES (39, 42, 0, true);
INSERT INTO book VALUES (57, 60, 0, true);
INSERT INTO book VALUES (58, 61, 0, true);
INSERT INTO book VALUES (59, 62, 0, false);
INSERT INTO book VALUES (41, 44, 0, false);


--
-- Data for Name: book_genre; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO book_genre VALUES (55, 2);
INSERT INTO book_genre VALUES (55, 6);
INSERT INTO book_genre VALUES (55, 8);
INSERT INTO book_genre VALUES (56, 4);
INSERT INTO book_genre VALUES (56, 6);
INSERT INTO book_genre VALUES (57, 5);
INSERT INTO book_genre VALUES (57, 6);
INSERT INTO book_genre VALUES (57, 7);
INSERT INTO book_genre VALUES (58, 1);
INSERT INTO book_genre VALUES (58, 5);
INSERT INTO book_genre VALUES (58, 7);
INSERT INTO book_genre VALUES (59, 2);
INSERT INTO book_genre VALUES (59, 5);
INSERT INTO book_genre VALUES (36, 4);
INSERT INTO book_genre VALUES (39, 1);
INSERT INTO book_genre VALUES (39, 6);
INSERT INTO book_genre VALUES (38, 4);
INSERT INTO book_genre VALUES (38, 9);
INSERT INTO book_genre VALUES (39, 7);
INSERT INTO book_genre VALUES (40, 3);
INSERT INTO book_genre VALUES (40, 4);
INSERT INTO book_genre VALUES (40, 5);
INSERT INTO book_genre VALUES (41, 1);
INSERT INTO book_genre VALUES (41, 8);
INSERT INTO book_genre VALUES (41, 9);
INSERT INTO book_genre VALUES (42, 5);
INSERT INTO book_genre VALUES (43, 2);
INSERT INTO book_genre VALUES (43, 3);
INSERT INTO book_genre VALUES (37, 5);
INSERT INTO book_genre VALUES (37, 6);
INSERT INTO book_genre VALUES (45, 6);
INSERT INTO book_genre VALUES (45, 8);
INSERT INTO book_genre VALUES (45, 9);
INSERT INTO book_genre VALUES (49, 2);


--
-- Data for Name: book_language; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO book_language VALUES (9, 49);
INSERT INTO book_language VALUES (1, 36);
INSERT INTO book_language VALUES (8, 55);
INSERT INTO book_language VALUES (3, 55);
INSERT INTO book_language VALUES (6, 56);
INSERT INTO book_language VALUES (5, 56);
INSERT INTO book_language VALUES (1, 57);
INSERT INTO book_language VALUES (6, 57);
INSERT INTO book_language VALUES (7, 57);
INSERT INTO book_language VALUES (6, 58);
INSERT INTO book_language VALUES (5, 58);
INSERT INTO book_language VALUES (7, 58);
INSERT INTO book_language VALUES (6, 59);
INSERT INTO book_language VALUES (2, 59);
INSERT INTO book_language VALUES (3, 39);
INSERT INTO book_language VALUES (6, 37);
INSERT INTO book_language VALUES (6, 38);
INSERT INTO book_language VALUES (6, 39);
INSERT INTO book_language VALUES (2, 39);
INSERT INTO book_language VALUES (6, 40);
INSERT INTO book_language VALUES (6, 41);
INSERT INTO book_language VALUES (4, 39);
INSERT INTO book_language VALUES (3, 42);
INSERT INTO book_language VALUES (7, 42);
INSERT INTO book_language VALUES (7, 43);
INSERT INTO book_language VALUES (3, 43);
INSERT INTO book_language VALUES (1, 43);
INSERT INTO book_language VALUES (8, 43);
INSERT INTO book_language VALUES (6, 45);


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO comment VALUES (248, 8, 39, 'Natália S2 Europa', '2018-06-06 08:14:46.965982');
INSERT INTO comment VALUES (251, 8, 39, 'Olá', '2018-06-12 07:23:44.372162');
INSERT INTO comment VALUES (255, 1, 39, 'sfjashaksjd', '2018-06-21 09:49:20.411351');
INSERT INTO comment VALUES (258, 8, 39, 'asdajksdhajkdhkjda', '2018-06-28 21:08:20.659459');
INSERT INTO comment VALUES (262, 8, 39, 'oi', '2018-06-28 21:31:14.914027');
INSERT INTO comment VALUES (18, 1, 39, 'sdasda', '2018-05-18 22:08:50.848501');
INSERT INTO comment VALUES (19, 1, 39, 'sdasdadasda', '2018-05-18 22:08:56.797863');
INSERT INTO comment VALUES (20, 1, 38, 'sfsfjslfjsfs', '2018-05-19 03:30:25.34983');
INSERT INTO comment VALUES (21, 1, 38, 'dsdakjs asdj lakjs lakjs akljsda l', '2018-05-19 03:34:01.52944');
INSERT INTO comment VALUES (22, 1, 38, ' jskjf sdj sljf lsdsdakjs asdj lakjs lakjs akljsda l', '2018-05-19 03:34:13.359746');
INSERT INTO comment VALUES (23, 1, 39, 'GHFHGFHGHFHG', '2018-05-23 08:28:08.789696');
INSERT INTO comment VALUES (25, 1, 39, 'GHFHGFHGHFHGMNMMHGJGJGJHGJ', '2018-05-23 08:28:43.750533');
INSERT INTO comment VALUES (26, 1, 39, 'aa', '2018-06-01 01:52:52.829101');
INSERT INTO comment VALUES (27, 1, 41, 'aaaaaa', '2018-06-03 01:10:12.401488');
INSERT INTO comment VALUES (28, 8, 39, 'asodaoidoaio aois oa ais iai aio ioai oai oia', '2018-06-03 01:11:42.579668');
INSERT INTO comment VALUES (29, 1, 41, 'adad
', '2018-06-03 01:17:39.549599');
INSERT INTO comment VALUES (31, 1, 37, 'a
', '2018-06-03 03:27:05.255649');
INSERT INTO comment VALUES (32, 15, 49, 'sasda', '2018-06-03 03:29:56.75638');
INSERT INTO comment VALUES (33, 1, 39, 'a aj ja', '2018-06-03 07:12:57.377728');
INSERT INTO comment VALUES (34, 1, 39, 'adaj', '2018-06-03 07:13:47.653634');
INSERT INTO comment VALUES (37, 1, 39, 'asda s a', '2018-06-03 07:14:47.397602');
INSERT INTO comment VALUES (38, 1, 39, 'a a a ', '2018-06-03 07:15:32.70647');
INSERT INTO comment VALUES (39, 1, 39, 'as jaskh akjs najk dhkahs dakashd', '2018-06-03 07:16:13.214283');
INSERT INTO comment VALUES (40, 1, 39, 'ajshdkajsh kajh akjhdajsdh ka', '2018-06-03 07:17:05.737222');
INSERT INTO comment VALUES (41, 1, 39, 'sjhasdjhakjsda
asdasda', '2018-06-03 07:30:36.103492');
INSERT INTO comment VALUES (43, 1, 39, 'sadadad', '2018-06-03 07:32:12.744128');
INSERT INTO comment VALUES (53, 8, 39, 'fsfsf', '2018-06-03 07:59:25.003678');
INSERT INTO comment VALUES (54, 8, 39, 'fsfsfasa', '2018-06-03 07:59:40.103229');
INSERT INTO comment VALUES (55, 8, 49, 'sajjas kajsd ja', '2018-06-03 18:31:19.560864');
INSERT INTO comment VALUES (56, 1, 49, 'asda as a', '2018-06-03 18:31:38.195207');
INSERT INTO comment VALUES (57, 8, 49, 'sajjas kajsd ja sd sa', '2018-06-03 18:31:48.871534');
INSERT INTO comment VALUES (58, 1, 49, 'asda as a a', '2018-06-03 18:32:39.213594');
INSERT INTO comment VALUES (59, 1, 49, 'asda as a a as ', '2018-06-03 18:32:48.726614');
INSERT INTO comment VALUES (60, 1, 49, 'sda asda ', '2018-06-03 18:34:08.643131');
INSERT INTO comment VALUES (61, 1, 49, 'sda asda ', '2018-06-03 18:34:14.508122');
INSERT INTO comment VALUES (62, 1, 49, 'sda asda ', '2018-06-03 18:34:16.080139');
INSERT INTO comment VALUES (63, 1, 49, 'asd jakjsdh kajsa', '2018-06-03 18:34:30.420703');
INSERT INTO comment VALUES (64, 1, 49, 'asd jakjsdh kajsa', '2018-06-03 18:34:35.797411');
INSERT INTO comment VALUES (65, 1, 49, 'asd jakjsdh kajsa', '2018-06-03 18:34:55.641621');
INSERT INTO comment VALUES (66, 1, 49, 'asd jakjsdh kajsa', '2018-06-03 18:34:56.915291');
INSERT INTO comment VALUES (67, 1, 49, 'asd jakjsdh kajsa', '2018-06-03 18:34:57.65364');
INSERT INTO comment VALUES (68, 1, 49, 's fsf s', '2018-06-03 18:37:37.743212');
INSERT INTO comment VALUES (69, 1, 49, 's fsf s', '2018-06-03 18:37:39.419336');
INSERT INTO comment VALUES (70, 1, 49, 's fsf s', '2018-06-03 18:37:40.070707');
INSERT INTO comment VALUES (71, 1, 49, 's fsf s', '2018-06-03 18:37:40.890037');
INSERT INTO comment VALUES (72, 1, 49, ' sajh jaksh kja', '2018-06-03 18:38:20.707478');
INSERT INTO comment VALUES (73, 1, 49, 'dakjshd jahdjkah aj', '2018-06-03 18:48:00.127386');
INSERT INTO comment VALUES (74, 1, 49, 'dakjshd jahdjkah aj', '2018-06-03 18:48:03.133994');
INSERT INTO comment VALUES (75, 1, 49, 'dakjshd jahdjkah aj', '2018-06-03 18:48:06.467261');
INSERT INTO comment VALUES (76, 1, 49, 'ashdajks dhkaj da', '2018-06-03 18:51:44.004987');
INSERT INTO comment VALUES (77, 1, 49, 'ashdajks dhkaj da', '2018-06-03 18:51:48.379388');
INSERT INTO comment VALUES (78, 8, 49, 'a hdajskh aksh djak aaaaaaa', '2018-06-03 18:57:38.119809');
INSERT INTO comment VALUES (79, 8, 49, 'nao', '2018-06-03 18:59:44.186921');
INSERT INTO comment VALUES (80, 8, 49, 'nao asd as ', '2018-06-03 19:00:48.218133');
INSERT INTO comment VALUES (81, 8, 49, 'nao asd as asd asjdk aksjd ak', '2018-06-03 19:01:28.351458');
INSERT INTO comment VALUES (82, 8, 49, 'nao asd as asd asjdk aksjd ak', '2018-06-03 19:01:40.005576');
INSERT INTO comment VALUES (83, 8, 49, 'vai recarregar', '2018-06-03 19:03:35.7267');
INSERT INTO comment VALUES (84, 1, 49, 'sdhjakshdj kahsd kajhsda jhkajdh ajkhsdj akhdjka shdjasdha jkdhajksdh jakhakjs dhajksdh ajkshdjash dkajshd akjhajkshd ajhda', '2018-06-03 19:05:19.650998');
INSERT INTO comment VALUES (247, 1, 39, 'jhj shfjshf sjkdfhsd fhskj', '2018-06-06 08:12:05.52934');
INSERT INTO comment VALUES (249, 1, 41, 'jhgxchjgjhx', '2018-06-06 09:06:46.275002');
INSERT INTO comment VALUES (250, 1, 39, 'ahskdjahdjakdhakshdasdhakjd', '2018-06-12 07:23:24.942536');
INSERT INTO comment VALUES (254, 1, 39, 'sfjashaksjd', '2018-06-21 09:49:19.308816');
INSERT INTO comment VALUES (257, 1, 39, 'ui', '2018-06-28 21:08:05.288186');
INSERT INTO comment VALUES (261, 1, 39, 'asdasdadadasada', '2018-06-28 21:30:41.749748');
INSERT INTO comment VALUES (264, 1, 39, 'asuhdkashdkajdajkjaksajsdhjs', '2018-06-29 08:32:02.60523');


--
-- Data for Name: country; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO country VALUES (11, 'Argentina', 'ARG');
INSERT INTO country VALUES (12, 'Brasil', 'BRA');
INSERT INTO country VALUES (13, 'China', 'CHN');
INSERT INTO country VALUES (14, 'Canadá', 'CAN');
INSERT INTO country VALUES (15, 'França', 'FRA');
INSERT INTO country VALUES (16, 'Japão', 'JPN');
INSERT INTO country VALUES (17, 'Estados Unidos', 'USA');
INSERT INTO country VALUES (18, 'Espanha', 'ESP');
INSERT INTO country VALUES (19, 'Alemanha', 'DEU');


--
-- Data for Name: download; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO download VALUES ('2018-05-18 23:31:07.952898', 4, 36, 6, 1);
INSERT INTO download VALUES ('2018-05-18 23:33:29.078771', 2, 36, 6, 2);
INSERT INTO download VALUES ('2018-05-18 23:34:37.189185', 2, 39, 6, 3);
INSERT INTO download VALUES ('2018-05-18 23:35:15.446825', 2, 39, 2, 4);
INSERT INTO download VALUES ('2018-05-19 01:58:21.230685', 1, 39, 4, 5);
INSERT INTO download VALUES ('2018-05-19 02:15:51.452955', 1, 39, 2, 6);
INSERT INTO download VALUES ('2018-05-23 01:17:49.277837', 1, 39, 6, 7);
INSERT INTO download VALUES ('2018-05-23 08:54:20.642957', 1, 40, 6, 8);
INSERT INTO download VALUES ('2018-05-26 20:57:03.126891', 1, 37, 6, 9);
INSERT INTO download VALUES ('2018-05-26 20:57:14.439244', 1, 45, 6, 10);
INSERT INTO download VALUES ('2018-05-26 20:57:29.87797', 1, 43, 7, 11);
INSERT INTO download VALUES ('2018-05-26 20:57:41.959066', 1, 49, 9, 12);
INSERT INTO download VALUES ('2018-05-31 22:27:58.664357', 1, 39, 6, 13);
INSERT INTO download VALUES ('2018-06-02 01:57:09.757597', 1, 39, 6, 14);
INSERT INTO download VALUES ('2018-06-07 09:21:04.461962', 1, 39, 6, 15);
INSERT INTO download VALUES ('2018-06-10 13:53:33.23354', 1, 37, 6, 16);
INSERT INTO download VALUES ('2018-06-10 13:53:42.515335', 1, 45, 6, 17);
INSERT INTO download VALUES ('2018-06-10 13:57:10.342206', 1, 55, 3, 18);
INSERT INTO download VALUES ('2018-06-10 13:57:26.336418', 1, 41, 6, 19);
INSERT INTO download VALUES ('2018-06-10 13:57:39.557173', 1, 39, 6, 20);
INSERT INTO download VALUES ('2018-06-10 13:57:49.465296', 1, 36, 1, 21);
INSERT INTO download VALUES ('2018-06-10 13:57:59.381847', 1, 38, 6, 22);
INSERT INTO download VALUES ('2018-06-10 13:58:07.96399', 1, 49, 9, 23);
INSERT INTO download VALUES ('2018-06-10 13:58:17.217072', 1, 56, 6, 24);
INSERT INTO download VALUES ('2018-06-12 07:22:06.66405', 1, 39, 2, 25);
INSERT INTO download VALUES ('2018-06-21 09:48:05.934011', 1, 39, 2, 26);
INSERT INTO download VALUES ('2018-06-28 21:00:27.98034', 1, 37, 6, 27);
INSERT INTO download VALUES ('2018-06-28 21:28:59.870181', 1, 39, 4, 28);
INSERT INTO download VALUES ('2018-06-29 08:30:54.327525', 1, 39, 2, 29);


--
-- Data for Name: favorite; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO favorite VALUES (8, 39);
INSERT INTO favorite VALUES (9, 55);
INSERT INTO favorite VALUES (1, 55);
INSERT INTO favorite VALUES (8, 37);
INSERT INTO favorite VALUES (1, 39);
INSERT INTO favorite VALUES (1, 37);
INSERT INTO favorite VALUES (1, 58);
INSERT INTO favorite VALUES (1, 59);
INSERT INTO favorite VALUES (1, 41);


--
-- Data for Name: feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO feed VALUES (16, '2018-04-21 14:32:48.318263-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'Algum Título!', 1);
INSERT INTO feed VALUES (17, '2018-04-21 14:39:09.701005-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'Review 1', 1);
INSERT INTO feed VALUES (18, '2018-04-21 15:13:25.893971-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'Algum Título!', 8);
INSERT INTO feed VALUES (19, '2018-04-21 15:14:01.366967-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'Outro Título', 8);
INSERT INTO feed VALUES (20, '2018-04-21 15:14:50.561266-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'Não gostei daquele Livro!', 4);
INSERT INTO feed VALUES (21, '2018-04-21 15:15:10.533019-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'Aquele autor é um lixo!', 4);
INSERT INTO feed VALUES (22, '2018-04-21 15:15:28.698589-03', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.', 'DC >>> Marvel!', 4);
INSERT INTO feed VALUES (23, '2018-04-21 17:10:32.982933-03', 'É importante questionar o quanto a contínua expansão de nossa atividade é uma das consequências do processo de comunicação como um todo.', 'Olá Mundo!', 1);
INSERT INTO feed VALUES (24, '2018-04-21 17:40:06.897589-03', 'A certificação de metodologias que nos auxiliam a lidar com a necessidade de renovação processual aponta para a melhoria do processo de comunicação como um todo.', 'aasda', 9);
INSERT INTO feed VALUES (25, '2018-05-04 09:18:32.251799-03', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem', 1);
INSERT INTO feed VALUES (26, '2018-06-06 08:36:20.86437-03', 'Faz um ano que o Gabriel já testou pela última vez', 'Teste', 8);


--
-- Data for Name: friend; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO friend VALUES (8, 2, true);
INSERT INTO friend VALUES (1, 4, true);
INSERT INTO friend VALUES (8, 4, false);
INSERT INTO friend VALUES (1, 8, true);


--
-- Data for Name: genre; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO genre VALUES (1, 'Biografia', 'A Biografia é um gênero literário em que o autor narra a história da vida de uma pessoa ou de várias pessoas. De um modo geral as biografias contam a vida de alguém.');
INSERT INTO genre VALUES (2, 'Ciência', 'Publicação que apresenta e discute ideias, métodos, técnicas, processos e resultados nas diversas áreas do conhecimento.');
INSERT INTO genre VALUES (3, 'Contos', ' Narrativa que cria um universo de seres, de fantasia ou acontecimentos. Como todos os textos de ficção, o conto apresenta um narrador, personagens, ponto de vista e enredo.');
INSERT INTO genre VALUES (4, 'Fantasia', 'Gênero literário em que narrativas ficcionais estão centradas em elementos não existentes ou não reconhecidos na realidade, pela ciência dos tempos em que a obra foi escrita.');
INSERT INTO genre VALUES (5, 'Ficção Científica', 'Gênero da ficção que normalmente lida com conceitos ficcionais e imaginativos, relacionados ao futuro, ciência e tecnologia, e seus impactos e/ou consequências em uma determinada sociedade ou em seus indivíduos.');
INSERT INTO genre VALUES (6, 'História', 'Gênero que apresenta estudos de eventos passados com referência a um povo, país, período ou indivíduo específico.');
INSERT INTO genre VALUES (7, 'Horror', 'Ligado à fantasia e à ficção especulativa. Criado com o intuito de causar medo, aterrorizar.');
INSERT INTO genre VALUES (8, 'Poesia', 'Obra literária que pertence ao gênero da poesia, e cuja apresentação pode surgir em forma de versos, estrofes ou prosa, com a finalidade de manifestar sentimento e emoção.');
INSERT INTO genre VALUES (9, 'Romance', 'Obra literária que apresenta narrativa em prosa, normalmente longa, com fatos criados ou relacionados a personagens, que vivem diferentes conflitos ou situações dramáticas, numa sequência de tempo relativamente ampla.');


--
-- Data for Name: language; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO language VALUES (1, 'Chinês', 'zh');
INSERT INTO language VALUES (10, 'Francês', 'fr');
INSERT INTO language VALUES (9, 'Japonês', 'jp');
INSERT INTO language VALUES (8, 'Russo', 'ru');
INSERT INTO language VALUES (7, 'Bengali', 'bn');
INSERT INTO language VALUES (6, 'Português', 'pt');
INSERT INTO language VALUES (5, 'Árabe', 'ar');
INSERT INTO language VALUES (4, 'Hindi', 'hi');
INSERT INTO language VALUES (3, 'Inglês', 'en');
INSERT INTO language VALUES (2, 'Espanhol', 'es');


--
-- Data for Name: metadata; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO metadata VALUES (40, 'Algum Título!', 'anakin', 'sdj akljds lak', '2018-05-14', true, '2018-05-08 03:24:00.592598-03');
INSERT INTO metadata VALUES (48, 'Android', '', '', '2018-05-08', true, '2018-05-25 00:39:25.635591-03');
INSERT INTO metadata VALUES (52, 'sadaa', '', '', '2018-05-10', true, '2018-05-25 01:03:43.277866-03');
INSERT INTO metadata VALUES (58, 'Antiquado', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-06-11', false, '2018-06-03 02:07:13.155102-03');
INSERT INTO metadata VALUES (59, 'zsjallaks', 'xnm nmnsfjs djfsk nxnxcncxmn xm,vnxm,cn jdfvnjkdfn vjdknf vkjncx vm,xcn vm,xcnv mxcn vxn', 'sjn fjkdsfn jksnfkdjsfn jkdsfnj kdsfn djsfn sdjnfjdksn jxnvx m,vnxmc,n v,xmcv', '2018-06-12', true, '2018-06-09 17:57:23.83168-03');
INSERT INTO metadata VALUES (60, 'lala', 'asdajld', 'asldjakldja', '2018-06-19', true, '2018-06-28 21:03:47.928052-03');
INSERT INTO metadata VALUES (61, 'dasdasdadadada', 'asdjasndajkdhj', 'amazon', '2018-06-04', false, '2018-06-28 21:25:08.904168-03');
INSERT INTO metadata VALUES (62, 'asdaasdasdasd', 'asdasjdbajks hajksdhajkd hajk', 'aksdhajksdhakdj', '2018-06-13', true, '2018-06-29 08:25:03.625124-03');
INSERT INTO metadata VALUES (39, 'dadada', '', '', NULL, true, '2018-05-08 03:23:41.066623-03');
INSERT INTO metadata VALUES (41, 'Lord', 'Tolkien', '', '2018-05-01', true, '2018-05-08 03:23:54.905889-03');
INSERT INTO metadata VALUES (43, 'zxczjhjhk', 'kxjvlkxvxc', 'sdfkmsdl sl', '2018-05-22', false, '2018-05-09 23:10:53.298606-03');
INSERT INTO metadata VALUES (44, 'apsdiap idapd aips d', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-05-02', false, '2018-05-10 09:06:06.411873-03');
INSERT INTO metadata VALUES (45, 'DC >>> Marvel!', '', '', '2018-04-30', false, '2018-05-12 16:36:24.108618-03');
INSERT INTO metadata VALUES (46, 'dadasd asd as', '', '', '2018-05-17', false, '2018-05-12 16:44:22.797532-03');
INSERT INTO metadata VALUES (42, 'A title', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam augue metus, posuere eget accumsan ut, sollicitudin sed dui. Donec at nunc ac erat venenatis egestas at cursus ligula. Vivamus fermentum massa urna, eget volutpat lorem maximus at. In convallis, dolor non tempor tempor, ligula risus tempor sapien, at ornare nisi nulla id urna. Proin dictum ut justo non ultricies. Integer quis nisl nec dolor volutpat varius. Vivamus libero tortor, placerat eu neque sed, efficitur dignissim nisl.
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam augue metus, posuere eget accumsan ut, sollicitudin sed dui. Donec at nunc ac erat venenatis egestas at cursus ligula. Vivamus fermentum massa urna, eget volutpat lorem maximus at. In convallis, dolor non tempor tempor, ligula risus tempor sapien, at ornare nisi nulla id urna. Proin dictum ut justo non ultricies. Integer quis nisl nec dolor volutpat varius. Vivamus libero tortor, placerat eu neque sed, efficitur dignissim nisl.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam augue metus, posuere eget accumsan ut, sollicitudin sed dui. Donec at nunc ac erat venenatis egestas at cursus ligula. Vivamus fermentum massa urna, eget volutpat lorem maximus at. In convallis, dolor non tempor tempor, ligula risus tempor sapien, at ornare nisi nulla id urna. Proin dictum ut justo non ultricies. Integer quis nisl nec dolor volutpat varius. Vivamus libero tortor, placerat eu neque sed, efficitur dignissim nisl.', '2018-05-15', false, '2018-05-08 03:23:48.400796-03');


--
-- Data for Name: person; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO person VALUES (15, 'Carlos', 'Cristiano', 'Hell', '2018-05-30', 15, 'Não Informado', 12);
INSERT INTO person VALUES (9, 'Paulo', 'Ricardo', 'Não Informada', '2018-03-29', 9, 'Não Informado', 12);
INSERT INTO person VALUES (4, 'Fan', 'Boy', 'Crackolândia', '2018-04-12', 4, 'Outro', 14);
INSERT INTO person VALUES (3, 'Márcia', 'Antônia', 'São Francisco', '2018-04-20', 3, 'Feminino', 12);
INSERT INTO person VALUES (16, 'Guilherme', 'Antunes', 'California', '2018-05-15', 16, 'Outro', 12);
INSERT INTO person VALUES (2, 'Pedro', 'Pereira', 'Santo Antônio', '2018-04-02', 2, 'Masculino', 11);
INSERT INTO person VALUES (8, 'Antônioo', 'Carlos', 'São Paulo', '2009-04-05', 8, 'Masculino', 12);
INSERT INTO person VALUES (5, 'Affonso', 'Solano', 'Pantanal', '2018-04-10', 5, 'Masculino', 19);
INSERT INTO person VALUES (17, 'Jean', 'Link', 'Ibirubá', '2018-06-13', 17, 'Masculino', 12);
INSERT INTO person VALUES (18, 'Juliana', 'Costa', 'Santa Maria', '2018-06-20', 18, 'Feminino', 12);
INSERT INTO person VALUES (19, 'Maicon', 'Cácio', 'Santa Rosa', '2018-06-13', 19, 'Masculino', 12);
INSERT INTO person VALUES (20, 'Mariana', 'Cannavaro', 'Sertão', '2018-06-14', 20, 'Feminino', 12);
INSERT INTO person VALUES (21, 'Asasdad', 'Asdadasd', 'asdasdad', '2018-06-13', 21, 'Masculino', 12);
INSERT INTO person VALUES (7, 'Jovem', 'Nerd', 'Não Informada', '2018-03-27', 7, 'Não Informado', 15);
INSERT INTO person VALUES (6, 'Sem', 'Foto', 'Não Informada', '2018-04-18', 6, 'Não Informado', 11);
INSERT INTO person VALUES (1, 'Gabriela', 'Geier', 'Sertão', '2018-05-22', 1, 'Feminino', 12);


--
-- Data for Name: profile_texts; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO profile_texts VALUES (1, '"Podemos já vislumbrar o modo pelo qual o início da atividade geral de formação de atitudes estende o alcance e a importância do fluxo de informações." - Autor', 1, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?');
INSERT INTO profile_texts VALUES (2, '"Frase edificante de algum autor famoso."', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eget ligula eu lectus lobortis condimentum. Aliquam nonummy auctor massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at risus. Quisque purus magna, auctor et, sagittis ac, posuere eu, lectus. Nam mattis, felis ut adipiscing.');
INSERT INTO profile_texts VALUES (3, 'Acesse meus produtos: marcia@gmail.com.', 3, NULL);
INSERT INTO profile_texts VALUES (6, NULL, 6, NULL);
INSERT INTO profile_texts VALUES (4, 'No mundo atual, o fenômeno da Internet faz parte de um processo de gerenciamento das diversas correntes de pensamento.', 4, NULL);
INSERT INTO profile_texts VALUES (5, 'Percebemos, cada vez mais, que a percepção das dificuldades não pode mais se dissociar do sistema de formação de quadros que corresponde às necessidades.', 5, NULL);
INSERT INTO profile_texts VALUES (7, 'No mundo atual, o entendimento das metas propostas auxilia a preparação e a composição do fluxo de informações.', 7, NULL);
INSERT INTO profile_texts VALUES (9, 'A certificação de metodologias que nos auxiliam a lidar com a necessidade de renovação processual aponta para a melhoria do processo de comunicação como um todo.', 9, NULL);
INSERT INTO profile_texts VALUES (15, NULL, 15, 'asjdasjda
asdasda');
INSERT INTO profile_texts VALUES (16, NULL, 16, NULL);
INSERT INTO profile_texts VALUES (8, NULL, 8, 'wfhjg hjsdfhdsf jsdg fgsjs');
INSERT INTO profile_texts VALUES (18, NULL, 18, NULL);
INSERT INTO profile_texts VALUES (17, 'asjdaskj dnajkds ajksdna jksnaks', 17, 'asdasda');
INSERT INTO profile_texts VALUES (19, NULL, 19, NULL);
INSERT INTO profile_texts VALUES (20, NULL, 20, NULL);
INSERT INTO profile_texts VALUES (21, NULL, 21, NULL);


--
-- Data for Name: rate; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO rate VALUES (1, 2, 39);
INSERT INTO rate VALUES (3, 1, 40);
INSERT INTO rate VALUES (4, 8, 39);
INSERT INTO rate VALUES (4, 1, 41);
INSERT INTO rate VALUES (2.5, 9, 55);
INSERT INTO rate VALUES (2, 1, 55);
INSERT INTO rate VALUES (4, 8, 37);
INSERT INTO rate VALUES (3, 1, 56);
INSERT INTO rate VALUES (4, 1, 39);
INSERT INTO rate VALUES (4, 1, 37);
INSERT INTO rate VALUES (3.5, 1, 58);
INSERT INTO rate VALUES (4, 1, 59);


--
-- Data for Name: usr; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usr VALUES (3, 'marcia', 'marcia@gmail.com', '$2y$10$kiO/pc1OFSq.b/9MV.IXyuJVOub8rFtW9NXZlWAPo9yixvxKLAz8O', true);
INSERT INTO usr VALUES (4, 'fanboy', 'fanboy@gmail.com', '$2y$10$bSkYjKzC5pwCA12Bqzpi7O1LKHd1SftpM1rHVrXziLn4k.gEKJAB6', true);
INSERT INTO usr VALUES (5, 'solano', 'reidosescritores@gmail.com', '$2y$10$FbnlznHZqhV52Jjlhdm8zuHu/MOkA4GKMBoxL3D0iRJ/V.04e7TUC', true);
INSERT INTO usr VALUES (6, 'sem_foto', 'pqsim@gmail.com', '$2y$10$iIJ1SRCXJuymOABIyQXSfegAVSTI.vUgaIWYc9pSbfOJSOBH6Hdnm', true);
INSERT INTO usr VALUES (7, 'nerd', 'semcamisa@gmail.com', '$2y$10$pUI2CrgWn5MisAnJmXUdmuf2cLoH0MWajKajbauMt.NAIbPRMyEvW', true);
INSERT INTO usr VALUES (9, 'paulo', 'paulo@gmail.com', '$2y$10$VDVvR3hYEC6gy3RS2sWMu.rvK7PLxxLWMIJAhr1EQbExh39YZTel6', true);
INSERT INTO usr VALUES (15, 'carlos', 'carlos@gmail.com', '$2y$10$pKZHU5LDvSSpRRsVDuca2e6Yi4..qAdtZ1vbJkZYMOQ.nGEhzoWbi', true);
INSERT INTO usr VALUES (16, 'guilherme', 'guilherme@gmail.com', '$2y$10$UpxQyHDkjd00abqo4zUgceKmqtCutSXpkWU9neBzQp.5n87KP/w0e', false);
INSERT INTO usr VALUES (2, 'pedro', 'pedro@gmail.com', '$2y$10$c1mdRxD/3rBKYOel3JmsOOdyZ/MJtoxNnbzn5O.ndO0K3EwNuexhy', true);
INSERT INTO usr VALUES (8, 'antonio', 'antonio@gmail.com', '$2y$10$svms7Zzz1PEcyjr2q/LvwOGUesiMUfDWP8W4GLqx/jjihzfWATkR.', true);
INSERT INTO usr VALUES (17, 'jean_link', 'jean@gmail.com', '$2y$10$S/.nmAYT9pmW8F6FHso.Herbx0SWAOpmyiJjsqUk4cdpzufUxz1Fy', true);
INSERT INTO usr VALUES (18, 'juliana', 'juliana@gmail.com', '$2y$10$t1XYHWm6IoF48ECUIfvXjeKG03mYEIrU2z4VE/sgZTq6JoHdMnfCu', true);
INSERT INTO usr VALUES (19, 'maicon', 'maicon@gmail.com', '$2y$10$teLdVQ.1Uqh3T4Vh5zEaxONVZ/FhZPFOVVfav/SDu.q8UCYlYr4vC', true);
INSERT INTO usr VALUES (20, 'mariana', 'mariana@gmail.com', '$2y$10$ZP79vDhkuoTy41kCFqkpTOdGi0U8PyK1iNoAiMxotutfP787lpg9.', true);
INSERT INTO usr VALUES (21, 'henrique', 'henrique@g.com', '$2y$10$hUk8gKk8HYUrqY1jo5E9Zu8mS4lCaImBKetm1Uv4Cc/qrTiyd3lDS', true);
INSERT INTO usr VALUES (1, 'geier', 'geier@gmail.com', '$2y$10$W7vF4HkClRz9sHq1CrdAyObu8.2qmcJPU6nNQ4UDWtq95CnE3kJUW', true);


--
-- Data for Name: view; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO view VALUES ('2018-05-19 02:33:16.24629', 1, 39, 4, 1);
INSERT INTO view VALUES ('2018-05-19 03:30:15.892587', 1, 38, 6, 2);
INSERT INTO view VALUES ('2018-05-23 00:28:21.511898', 1, 39, 2, 3);
INSERT INTO view VALUES ('2018-03-23 00:43:03.335019', 4, 39, 2, 4);
INSERT INTO view VALUES ('2018-05-23 00:43:42.045741', 4, 39, 6, 5);
INSERT INTO view VALUES ('2018-05-25 00:12:40.025925', 1, 40, 6, 6);
INSERT INTO view VALUES ('2018-05-25 00:32:16.964138', 1, 43, 7, 7);
INSERT INTO view VALUES ('2018-05-25 00:33:49.888378', 2, 37, 6, 8);
INSERT INTO view VALUES ('2018-05-25 00:48:29.263437', 15, 45, 6, 9);
INSERT INTO view VALUES ('2018-05-25 01:04:26.812517', 15, 49, 9, 10);
INSERT INTO view VALUES ('2018-05-31 22:03:09.582202', 1, 39, 6, 11);
INSERT INTO view VALUES ('2018-06-01 01:49:40.147083', 1, 39, 6, 14);
INSERT INTO view VALUES ('2018-06-02 01:58:10.45874', 1, 40, 6, 15);
INSERT INTO view VALUES ('2018-06-02 02:03:09.887208', 1, 39, 6, 16);
INSERT INTO view VALUES ('2018-06-03 01:10:04.060188', 1, 41, 6, 17);
INSERT INTO view VALUES ('2018-06-03 01:10:51.365164', 1, 39, 6, 18);
INSERT INTO view VALUES ('2018-06-03 01:11:32.379327', 8, 39, 6, 19);
INSERT INTO view VALUES ('2018-06-03 01:15:41.458131', 8, 37, 6, 20);
INSERT INTO view VALUES ('2018-06-03 02:10:46.727323', 9, 55, 3, 21);
INSERT INTO view VALUES ('2018-06-03 03:25:01.75303', 1, 37, 6, 22);
INSERT INTO view VALUES ('2018-06-03 03:29:43.800537', 15, 49, 9, 23);
INSERT INTO view VALUES ('2018-06-03 06:26:25.360318', 1, 43, 7, 24);
INSERT INTO view VALUES ('2018-06-03 06:28:17.133275', 1, 39, 6, 25);
INSERT INTO view VALUES ('2018-06-03 07:28:19.152819', 1, 39, 6, 26);
INSERT INTO view VALUES ('2018-06-03 07:57:01.151469', 8, 39, 6, 27);
INSERT INTO view VALUES ('2018-06-03 17:21:41.320363', 1, 49, 9, 28);
INSERT INTO view VALUES ('2018-06-03 18:22:55.112965', 1, 49, 9, 29);
INSERT INTO view VALUES ('2018-06-03 18:31:13.565447', 8, 49, 9, 30);
INSERT INTO view VALUES ('2018-06-03 20:54:13.534751', 1, 39, 6, 31);
INSERT INTO view VALUES ('2018-06-04 13:19:33.4089', 1, 39, 6, 32);
INSERT INTO view VALUES ('2018-06-05 14:27:49.00908', 1, 39, 6, 33);
INSERT INTO view VALUES ('2018-06-05 15:28:10.907182', 1, 39, 6, 34);
INSERT INTO view VALUES ('2018-06-06 08:11:58.626531', 1, 39, 6, 35);
INSERT INTO view VALUES ('2018-06-06 08:14:37.445943', 8, 39, 2, 36);
INSERT INTO view VALUES ('2018-06-06 08:52:59.372668', 1, 41, 6, 37);
INSERT INTO view VALUES ('2018-06-06 10:28:18.536958', 1, 41, 6, 38);
INSERT INTO view VALUES ('2018-06-07 08:13:23.148467', 1, 39, 6, 39);
INSERT INTO view VALUES ('2018-06-09 18:02:15.721436', 17, 56, 6, 40);
INSERT INTO view VALUES ('2018-06-09 20:49:55.278345', 1, 41, 6, 41);
INSERT INTO view VALUES ('2018-06-10 13:51:28.92312', 1, 42, 7, 42);
INSERT INTO view VALUES ('2018-06-10 13:58:32.316849', 1, 56, 6, 43);
INSERT INTO view VALUES ('2018-06-12 06:05:20.065746', 8, 39, 6, 44);
INSERT INTO view VALUES ('2018-06-12 07:22:49.986132', 1, 39, 6, 45);
INSERT INTO view VALUES ('2018-06-12 18:07:08.089073', 8, 39, 6, 46);
INSERT INTO view VALUES ('2018-06-12 18:14:15.743542', 1, 39, 2, 47);
INSERT INTO view VALUES ('2018-06-13 18:05:06.325493', 8, 39, 6, 48);
INSERT INTO view VALUES ('2018-06-13 18:06:11.95904', 1, 39, 6, 49);
INSERT INTO view VALUES ('2018-06-21 09:48:55.480352', 1, 39, 4, 50);
INSERT INTO view VALUES ('2018-06-21 09:49:11.905036', 8, 39, 6, 51);
INSERT INTO view VALUES ('2018-06-28 20:49:14.310003', 8, 39, 6, 52);
INSERT INTO view VALUES ('2018-06-28 21:05:49.369547', 1, 57, 6, 53);
INSERT INTO view VALUES ('2018-06-28 21:07:31.455159', 1, 39, 6, 54);
INSERT INTO view VALUES ('2018-06-29 00:45:22.398385', 8, 39, 2, 55);
INSERT INTO view VALUES ('2018-06-29 08:00:29.67434', 8, 39, 2, 56);
INSERT INTO view VALUES ('2018-06-29 08:31:25.742785', 1, 39, 3, 57);


--
-- Name: book_id_seq1; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('book_id_seq1', 59, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('comment_id_seq', 264, true);


--
-- Name: country_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('country_id_seq', 19, true);


--
-- Name: download_count; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('download_count', 20, true);


--
-- Name: download_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('download_id_seq', 29, true);


--
-- Name: feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_id_seq', 95, true);


--
-- Name: genre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('genre_id_seq', 9, true);


--
-- Name: language_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('language_id_seq', 10, true);


--
-- Name: metadata_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('metadata_id_seq', 62, true);


--
-- Name: person_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('person_id_seq', 21, true);


--
-- Name: thought_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('thought_id_seq', 21, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 21, true);


--
-- Name: view_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('view_id_seq', 57, true);


--
-- Name: book_genre book_genre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book_genre
    ADD CONSTRAINT book_genre_pkey PRIMARY KEY (book_id, genre_id);


--
-- Name: book book_pkey1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book
    ADD CONSTRAINT book_pkey1 PRIMARY KEY (id);


--
-- Name: comment comment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_pkey PRIMARY KEY (id);


--
-- Name: country country_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY country
    ADD CONSTRAINT country_pkey PRIMARY KEY (id);


--
-- Name: download download_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY download
    ADD CONSTRAINT download_pkey PRIMARY KEY (id);


--
-- Name: favorite favorite_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY favorite
    ADD CONSTRAINT favorite_pkey PRIMARY KEY (user_id, book_id);


--
-- Name: feed feed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed
    ADD CONSTRAINT feed_pkey PRIMARY KEY (id);


--
-- Name: friend friend_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY friend
    ADD CONSTRAINT friend_pkey PRIMARY KEY (sended_user_id, received_user_id);


--
-- Name: genre genre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY genre
    ADD CONSTRAINT genre_pkey PRIMARY KEY (id);


--
-- Name: language language_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY language
    ADD CONSTRAINT language_pkey PRIMARY KEY (id);


--
-- Name: metadata metadata_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY metadata
    ADD CONSTRAINT metadata_pkey PRIMARY KEY (id);


--
-- Name: person person_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_pkey PRIMARY KEY (id);


--
-- Name: book_language pk_book_id_language_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book_language
    ADD CONSTRAINT pk_book_id_language_id PRIMARY KEY (book_id, language_id);


--
-- Name: author pk_book_id_user_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY author
    ADD CONSTRAINT pk_book_id_user_id PRIMARY KEY (book_id, user_id);


--
-- Name: rate rate_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rate
    ADD CONSTRAINT rate_pkey PRIMARY KEY (user_id, book_id);


--
-- Name: profile_texts thought_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY profile_texts
    ADD CONSTRAINT thought_pkey PRIMARY KEY (id);


--
-- Name: usr users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usr
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: view view_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY view
    ADD CONSTRAINT view_pkey PRIMARY KEY (id);


--
-- Name: author author_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY author
    ADD CONSTRAINT author_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: author author_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY author
    ADD CONSTRAINT author_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- Name: book_genre book_genre_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book_genre
    ADD CONSTRAINT book_genre_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: book_genre book_genre_genre_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book_genre
    ADD CONSTRAINT book_genre_genre_id_fkey FOREIGN KEY (genre_id) REFERENCES usr(id);


--
-- Name: book_language book_language_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book_language
    ADD CONSTRAINT book_language_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: book_language book_language_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book_language
    ADD CONSTRAINT book_language_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id);


--
-- Name: book book_metadata_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY book
    ADD CONSTRAINT book_metadata_id_fkey FOREIGN KEY (metadata_id) REFERENCES metadata(id);


--
-- Name: comment comment_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: comment comment_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- Name: download download_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY download
    ADD CONSTRAINT download_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: download download_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY download
    ADD CONSTRAINT download_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id);


--
-- Name: download download_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY download
    ADD CONSTRAINT download_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- Name: favorite favorite_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY favorite
    ADD CONSTRAINT favorite_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: favorite favorite_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY favorite
    ADD CONSTRAINT favorite_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- Name: friend friend_received_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY friend
    ADD CONSTRAINT friend_received_user_id_fkey FOREIGN KEY (received_user_id) REFERENCES usr(id);


--
-- Name: friend friend_sended_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY friend
    ADD CONSTRAINT friend_sended_user_id_fkey FOREIGN KEY (sended_user_id) REFERENCES usr(id);


--
-- Name: person person_country_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_country_id_fkey FOREIGN KEY (country_id) REFERENCES country(id);


--
-- Name: person person_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY person
    ADD CONSTRAINT person_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- Name: rate rate_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rate
    ADD CONSTRAINT rate_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: rate rate_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rate
    ADD CONSTRAINT rate_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- Name: view view_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY view
    ADD CONSTRAINT view_book_id_fkey FOREIGN KEY (book_id) REFERENCES book(id);


--
-- Name: view view_language_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY view
    ADD CONSTRAINT view_language_id_fkey FOREIGN KEY (language_id) REFERENCES language(id);


--
-- Name: view view_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY view
    ADD CONSTRAINT view_user_id_fkey FOREIGN KEY (user_id) REFERENCES usr(id);


--
-- PostgreSQL database dump complete
--

