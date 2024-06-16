--
-- PostgreSQL database dump
--

-- Dumped from database version 16.3 (Debian 16.3-1.pgdg120+1)
-- Dumped by pg_dump version 16.2

-- Started on 2024-06-16 00:31:31 UTC

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 241 (class 1255 OID 16699)
-- Name: add_book(character varying, character varying, character varying, date, integer, character varying, character varying[], text); Type: FUNCTION; Schema: public; Owner: docker
--

CREATE FUNCTION public.add_book(book_title character varying, author_firstname character varying, author_surname character varying, publishing_date date, page_count integer, photo character varying, categories character varying[], description text) RETURNS void
    LANGUAGE plpgsql
    AS $$
DECLARE
    author_idv INTEGER;
    book_idv INTEGER;
    category_namev VARCHAR;
    category_idv INTEGER;
BEGIN
    -- Check if the author already exists
    SELECT a.author_id INTO author_idv
    FROM authors a
    WHERE a.firstname = author_firstname AND a.surname = author_surname;

    -- If the author does not exist, create a new author
    IF author_idv IS NULL THEN
        INSERT INTO authors (firstname, surname) VALUES (author_firstname, author_surname)
        RETURNING author_id INTO author_idv;
    END IF;

    -- Insert the book
    INSERT INTO books (author_id, title, publishing_date, description, page_count, photo)
    VALUES (author_idv, book_title, publishing_date, description, page_count, photo)
    RETURNING book_id INTO book_idv;

    -- Add entries to the books_categories table
    FOREACH category_namev IN ARRAY categories
    LOOP
        -- Check if the category exists
        SELECT c.category_id INTO category_idv
        FROM categories c
        WHERE c.category_name = category_namev;

        -- If the category does not exist, insert it
        IF category_idv IS NULL THEN
            INSERT INTO categories (category_name) VALUES (category_namev)
            RETURNING category_id INTO category_idv;
        END IF;

        -- Insert into books_categories
        INSERT INTO books_categories (book_id, category_id) VALUES (book_idv, category_idv);
    END LOOP;

END;
$$;


ALTER FUNCTION public.add_book(book_title character varying, author_firstname character varying, author_surname character varying, publishing_date date, page_count integer, photo character varying, categories character varying[], description text) OWNER TO docker;

--
-- TOC entry 240 (class 1255 OID 16700)
-- Name: check_publishing_date(); Type: FUNCTION; Schema: public; Owner: docker
--

CREATE FUNCTION public.check_publishing_date() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
    IF NEW.publishing_date > CURRENT_DATE THEN
        RAISE EXCEPTION 'Publishing date cannot be in the future';
    END IF;
    RETURN NEW;
END;
$$;


ALTER FUNCTION public.check_publishing_date() OWNER TO docker;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 218 (class 1259 OID 16618)
-- Name: authors; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.authors (
    author_id integer NOT NULL,
    firstname character varying(50) NOT NULL,
    surname character varying(50) NOT NULL
);


ALTER TABLE public.authors OWNER TO docker;

--
-- TOC entry 217 (class 1259 OID 16617)
-- Name: authors_author_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.authors_author_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.authors_author_id_seq OWNER TO docker;

--
-- TOC entry 3426 (class 0 OID 0)
-- Dependencies: 217
-- Name: authors_author_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.authors_author_id_seq OWNED BY public.authors.author_id;


--
-- TOC entry 226 (class 1259 OID 16650)
-- Name: bookmarks; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.bookmarks (
    user_id integer NOT NULL,
    book_id integer NOT NULL
);


ALTER TABLE public.bookmarks OWNER TO docker;

--
-- TOC entry 216 (class 1259 OID 16609)
-- Name: books; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.books (
    book_id integer NOT NULL,
    author_id integer NOT NULL,
    title character varying(255) NOT NULL,
    publishing_date date,
    description text NOT NULL,
    page_count integer,
    photo character varying(128) NOT NULL
);


ALTER TABLE public.books OWNER TO docker;

--
-- TOC entry 215 (class 1259 OID 16608)
-- Name: books_book_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.books_book_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.books_book_id_seq OWNER TO docker;

--
-- TOC entry 3427 (class 0 OID 0)
-- Dependencies: 215
-- Name: books_book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.books_book_id_seq OWNED BY public.books.book_id;


--
-- TOC entry 225 (class 1259 OID 16647)
-- Name: books_categories; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.books_categories (
    book_id integer NOT NULL,
    category_id integer NOT NULL
);


ALTER TABLE public.books_categories OWNER TO docker;

--
-- TOC entry 227 (class 1259 OID 16688)
-- Name: books_view; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public.books_view AS
SELECT
    NULL::integer AS book_id,
    NULL::character varying(255) AS title,
    NULL::text AS author_name,
    NULL::date AS publishing_date,
    NULL::text AS categories,
    NULL::integer AS page_count,
    NULL::character varying(128) AS photo,
    NULL::text AS description;


ALTER VIEW public.books_view OWNER TO docker;

--
-- TOC entry 220 (class 1259 OID 16625)
-- Name: categories; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.categories (
    category_id integer NOT NULL,
    category_name character varying(25) NOT NULL
);


ALTER TABLE public.categories OWNER TO docker;

--
-- TOC entry 219 (class 1259 OID 16624)
-- Name: categories_category_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.categories_category_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_category_id_seq OWNER TO docker;

--
-- TOC entry 3428 (class 0 OID 0)
-- Dependencies: 219
-- Name: categories_category_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.categories_category_id_seq OWNED BY public.categories.category_id;


--
-- TOC entry 222 (class 1259 OID 16632)
-- Name: reservations; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.reservations (
    reservation_id integer NOT NULL,
    user_id integer NOT NULL,
    book_id integer NOT NULL,
    reservation_start date NOT NULL,
    reservation_end date NOT NULL,
    reservation_status character varying(25) NOT NULL
);


ALTER TABLE public.reservations OWNER TO docker;

--
-- TOC entry 224 (class 1259 OID 16639)
-- Name: users; Type: TABLE; Schema: public; Owner: docker
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    firstname character varying(50) NOT NULL,
    surname character varying(50) NOT NULL,
    phone_nb character varying(15),
    email character varying(128) NOT NULL,
    password character varying(256) NOT NULL,
    is_admin boolean NOT NULL
);


ALTER TABLE public.users OWNER TO docker;

--
-- TOC entry 228 (class 1259 OID 16702)
-- Name: reservation_view; Type: VIEW; Schema: public; Owner: docker
--

CREATE VIEW public.reservation_view AS
 SELECT r.reservation_id,
    (((a.firstname)::text || ' '::text) || (a.surname)::text) AS author_name,
    b.title AS book_title,
    b.photo,
    r.reservation_start,
    r.reservation_end,
    u.email,
    r.reservation_status
   FROM (((public.reservations r
     JOIN public.books b ON ((r.book_id = b.book_id)))
     JOIN public.authors a ON ((b.author_id = a.author_id)))
     JOIN public.users u ON ((r.user_id = u.user_id)))
  ORDER BY r.reservation_id;


ALTER VIEW public.reservation_view OWNER TO docker;

--
-- TOC entry 221 (class 1259 OID 16631)
-- Name: reservations_reservation_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.reservations_reservation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.reservations_reservation_id_seq OWNER TO docker;

--
-- TOC entry 3429 (class 0 OID 0)
-- Dependencies: 221
-- Name: reservations_reservation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.reservations_reservation_id_seq OWNED BY public.reservations.reservation_id;


--
-- TOC entry 223 (class 1259 OID 16638)
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: docker
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_user_id_seq OWNER TO docker;

--
-- TOC entry 3430 (class 0 OID 0)
-- Dependencies: 223
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: docker
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- TOC entry 3242 (class 2604 OID 16621)
-- Name: authors author_id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.authors ALTER COLUMN author_id SET DEFAULT nextval('public.authors_author_id_seq'::regclass);


--
-- TOC entry 3241 (class 2604 OID 16612)
-- Name: books book_id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.books ALTER COLUMN book_id SET DEFAULT nextval('public.books_book_id_seq'::regclass);


--
-- TOC entry 3243 (class 2604 OID 16628)
-- Name: categories category_id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.categories ALTER COLUMN category_id SET DEFAULT nextval('public.categories_category_id_seq'::regclass);


--
-- TOC entry 3244 (class 2604 OID 16635)
-- Name: reservations reservation_id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations ALTER COLUMN reservation_id SET DEFAULT nextval('public.reservations_reservation_id_seq'::regclass);


--
-- TOC entry 3245 (class 2604 OID 16642)
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- TOC entry 3412 (class 0 OID 16618)
-- Dependencies: 218
-- Data for Name: authors; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.authors (author_id, firstname, surname) VALUES (1, 'Frank', 'Herbert');
INSERT INTO public.authors (author_id, firstname, surname) VALUES (9, 'Antoine', 'Saint-Exupery');
INSERT INTO public.authors (author_id, firstname, surname) VALUES (10, 'J.R.R.', 'Tolkien');
INSERT INTO public.authors (author_id, firstname, surname) VALUES (11, 'Noah', 'Harari');
INSERT INTO public.authors (author_id, firstname, surname) VALUES (12, 'Nikhil', 'Abraham');


--
-- TOC entry 3420 (class 0 OID 16650)
-- Dependencies: 226
-- Data for Name: bookmarks; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.bookmarks (user_id, book_id) VALUES (1, 12);
INSERT INTO public.bookmarks (user_id, book_id) VALUES (1, 10);
INSERT INTO public.bookmarks (user_id, book_id) VALUES (1, 1);


--
-- TOC entry 3410 (class 0 OID 16609)
-- Dependencies: 216
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.books (book_id, author_id, title, publishing_date, description, page_count, photo) VALUES (1, 1, 'Dune', '1965-06-01', 'Set on the desert planet Arrakis, Dune is the story of the boy Paul Atreides, heir to a noble family tasked with ruling an inhospitable world where the only thing of value is the “spice” melange, a drug capable of extending life and enhancing consciousness. Coveted across the known universe, melange is a prize worth killing for...  When House Atreides is betrayed, the destruction of Paul’s family will set the boy on a journey toward a destiny greater than he could ever have imagined. And as he evolves into the mysterious man known as Muad’Dib, he will bring to fruition humankind’s most ancient and unattainable dream.', 658, 'previmg.jpeg');
INSERT INTO public.books (book_id, author_id, title, publishing_date, description, page_count, photo) VALUES (10, 9, 'The Little Prince', '1943-04-06', 'The Little Prince, fable and modern classic by French aviator and writer Antoine de Saint-Exupéry that was published with his own illustrations in French as Le Petit Prince in 1943. The simple tale tells the story of a child, the little prince, who travels the universe gaining wisdom. The novella has been translated into hundreds of languages and has sold some 200 million copies worldwide, making it one of the best-selling books in publishing history.', 96, '666dce275d8db8.24214290.png');
INSERT INTO public.books (book_id, author_id, title, publishing_date, description, page_count, photo) VALUES (11, 10, 'The Hobbit', '2023-01-24', 'Bilbo Baggins enjoys a quiet and contented life, with no desire to travel far from the comforts of home; then one day the wizard Gandalf and a band of dwarves arrive unexpectedly and enlist his services - as a burglar - on a dangerous expedition to raid the treasure-hoard of Smaug the dragon. Bilbo''s life is never to be the same again.

Seldom has any book been so widely read and loved as J. R.R. Tolkien''s classic tale, ''The Hobbit''. Since its first publication in 1937 it has remained in print to delight each new generation of readers all over the world, and its hero, Bilbo Baggins, has taken his place among the ranks of the immortals of fiction.', 368, '666dd0f83b81d7.41198843.png');
INSERT INTO public.books (book_id, author_id, title, publishing_date, description, page_count, photo) VALUES (12, 11, 'Sapiens', '2011-01-01', 'Planet Earth is 4.5 billion years old. In just a fraction of that time, one species among countless others has conquered it. Us. We are the most advanced and most destructive animals ever to have lived. What makes us brilliant? What makes us deadly? What makes us Sapiens? In this bold and provocative book, Yuval Noah Harari explores who we are, how we got here and where we’re going. Sapiens is a thrilling account of humankind’s extraordinary history – from the Stone Age to the Silicon Age – and our journey from insignificant apes to rulers of the world. ''Unbelievably good. Jaw dropping from the first word to the last'' Chris Evans, BBC Radio 2', 530, '666dd3cb807228.98057556.jpg');
INSERT INTO public.books (book_id, author_id, title, publishing_date, description, page_count, photo) VALUES (13, 12, 'Getting a Coding Job For Dummies', '2015-08-03', 'Your friendly guide to getting a job in coding
Getting a Coding Job For Dummies explains how a coder works in (or out of) an organization, the key skills any job requires, the basics of the technologies a coding pro will encounter, and how to find formal or informal ways to build your skills. Plus, it paints a picture of the world a coder lives in, outlines how to build a resume to land a coding job, and so much more.

Coding is one of the most in-demand skills in today''s job market, yet there seems to be an ongoing deficit of candidates qualified to take these jobs. Getting a Coding Job For Dummies provides a road map for students, post-grads, career switchers, and anyone else interested in starting a career in coding.', 288, '666dd6be7540f7.79749696.jpeg');


--
-- TOC entry 3419 (class 0 OID 16647)
-- Dependencies: 225
-- Data for Name: books_categories; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 1);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 2);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 3);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 4);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 5);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 6);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 7);
INSERT INTO public.books_categories (book_id, category_id) VALUES (1, 8);
INSERT INTO public.books_categories (book_id, category_id) VALUES (10, 2);
INSERT INTO public.books_categories (book_id, category_id) VALUES (10, 3);
INSERT INTO public.books_categories (book_id, category_id) VALUES (10, 15);
INSERT INTO public.books_categories (book_id, category_id) VALUES (10, 16);
INSERT INTO public.books_categories (book_id, category_id) VALUES (11, 3);
INSERT INTO public.books_categories (book_id, category_id) VALUES (11, 17);
INSERT INTO public.books_categories (book_id, category_id) VALUES (12, 18);
INSERT INTO public.books_categories (book_id, category_id) VALUES (13, 18);


--
-- TOC entry 3414 (class 0 OID 16625)
-- Dependencies: 220
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.categories (category_id, category_name) VALUES (1, 'Science Fiction');
INSERT INTO public.categories (category_id, category_name) VALUES (2, 'Fiction');
INSERT INTO public.categories (category_id, category_name) VALUES (3, 'Fantasy');
INSERT INTO public.categories (category_id, category_name) VALUES (4, 'Classics');
INSERT INTO public.categories (category_id, category_name) VALUES (5, 'Novels');
INSERT INTO public.categories (category_id, category_name) VALUES (6, 'Adventure');
INSERT INTO public.categories (category_id, category_name) VALUES (7, 'Adult');
INSERT INTO public.categories (category_id, category_name) VALUES (8, 'Space');
INSERT INTO public.categories (category_id, category_name) VALUES (15, 'Young Adult');
INSERT INTO public.categories (category_id, category_name) VALUES (16, 'Philosophy');
INSERT INTO public.categories (category_id, category_name) VALUES (17, 'Epic');
INSERT INTO public.categories (category_id, category_name) VALUES (18, 'Non-fiction');


--
-- TOC entry 3416 (class 0 OID 16632)
-- Dependencies: 222
-- Data for Name: reservations; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (1, 1, 1, '2024-06-10', '2024-06-15', 'confirmed');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (2, 1, 1, '2024-06-16', '2024-06-18', 'cancelled');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (12, 1, 1, '2024-06-24', '2024-06-30', 'pending');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (13, 1, 13, '2024-06-17', '2024-06-28', 'pending');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (7, 1, 13, '2024-06-17', '2024-06-20', 'cancelled');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (9, 1, 12, '2024-06-23', '2024-06-29', 'confirmed');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (10, 1, 11, '2024-07-01', '2024-07-04', 'confirmed');
INSERT INTO public.reservations (reservation_id, user_id, book_id, reservation_start, reservation_end, reservation_status) VALUES (11, 1, 11, '2024-07-29', '2024-07-09', 'cancelled');


--
-- TOC entry 3418 (class 0 OID 16639)
-- Dependencies: 224
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: docker
--

INSERT INTO public.users (user_id, firstname, surname, phone_nb, email, password, is_admin) VALUES (2, 'Jan', 'Nowak', '123456789', 'jnowak@test.pl', '$2y$10$Be3LtnmY93dsQYuUSmS8e.DH0TL8VjNBgO5c4gYVhRcejmEdpnunC', false);
INSERT INTO public.users (user_id, firstname, surname, phone_nb, email, password, is_admin) VALUES (1, 'Test', 'Testowy', '123456789', 'test@test.pl', '$2y$10$Be3LtnmY93dsQYuUSmS8e.DH0TL8VjNBgO5c4gYVhRcejmEdpnunC', false);
INSERT INTO public.users (user_id, firstname, surname, phone_nb, email, password, is_admin) VALUES (3, 'Admin', 'Adminowy', '123456789', 'admin@admin.pl', '$2y$10$Zz6ziRxY3MKI9Jsu1Nzv7.mIXyoHrNveXL98XcUNHPrgnv1OhnUBm', true);


--
-- TOC entry 3431 (class 0 OID 0)
-- Dependencies: 217
-- Name: authors_author_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.authors_author_id_seq', 12, true);


--
-- TOC entry 3432 (class 0 OID 0)
-- Dependencies: 215
-- Name: books_book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.books_book_id_seq', 13, true);


--
-- TOC entry 3433 (class 0 OID 0)
-- Dependencies: 219
-- Name: categories_category_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.categories_category_id_seq', 18, true);


--
-- TOC entry 3434 (class 0 OID 0)
-- Dependencies: 221
-- Name: reservations_reservation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.reservations_reservation_id_seq', 13, true);


--
-- TOC entry 3435 (class 0 OID 0)
-- Dependencies: 223
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: docker
--

SELECT pg_catalog.setval('public.users_user_id_seq', 4, true);


--
-- TOC entry 3249 (class 2606 OID 16623)
-- Name: authors authors_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.authors
    ADD CONSTRAINT authors_pkey PRIMARY KEY (author_id);


--
-- TOC entry 3247 (class 2606 OID 16616)
-- Name: books books_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pkey PRIMARY KEY (book_id);


--
-- TOC entry 3251 (class 2606 OID 16630)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (category_id);


--
-- TOC entry 3253 (class 2606 OID 16637)
-- Name: reservations reservations_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_pkey PRIMARY KEY (reservation_id);


--
-- TOC entry 3255 (class 2606 OID 16646)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


--
-- TOC entry 3407 (class 2618 OID 16691)
-- Name: books_view _RETURN; Type: RULE; Schema: public; Owner: docker
--

CREATE OR REPLACE VIEW public.books_view AS
 SELECT b.book_id,
    b.title,
    (((a.firstname)::text || ' '::text) || (a.surname)::text) AS author_name,
    b.publishing_date,
    COALESCE(string_agg((c.category_name)::text, ', '::text), ''::text) AS categories,
    b.page_count,
    b.photo,
    b.description
   FROM (((public.books b
     JOIN public.authors a ON ((b.author_id = a.author_id)))
     LEFT JOIN public.books_categories bc ON ((b.book_id = bc.book_id)))
     LEFT JOIN public.categories c ON ((bc.category_id = c.category_id)))
  GROUP BY b.book_id, a.firstname, a.surname
  ORDER BY b.book_id;


--
-- TOC entry 3263 (class 2620 OID 16701)
-- Name: books check_publishing_date_trigger; Type: TRIGGER; Schema: public; Owner: docker
--

CREATE TRIGGER check_publishing_date_trigger BEFORE INSERT OR UPDATE ON public.books FOR EACH ROW EXECUTE FUNCTION public.check_publishing_date();


--
-- TOC entry 3261 (class 2606 OID 16683)
-- Name: bookmarks bookmarks_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.bookmarks
    ADD CONSTRAINT bookmarks_book_id_fkey FOREIGN KEY (book_id) REFERENCES public.books(book_id) NOT VALID;


--
-- TOC entry 3262 (class 2606 OID 16678)
-- Name: bookmarks bookmarks_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.bookmarks
    ADD CONSTRAINT bookmarks_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id) NOT VALID;


--
-- TOC entry 3256 (class 2606 OID 16653)
-- Name: books books_author_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_author_id_fkey FOREIGN KEY (author_id) REFERENCES public.authors(author_id) NOT VALID;


--
-- TOC entry 3259 (class 2606 OID 16668)
-- Name: books_categories books_categories_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.books_categories
    ADD CONSTRAINT books_categories_book_id_fkey FOREIGN KEY (book_id) REFERENCES public.books(book_id) NOT VALID;


--
-- TOC entry 3260 (class 2606 OID 16673)
-- Name: books_categories books_categories_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.books_categories
    ADD CONSTRAINT books_categories_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(category_id) NOT VALID;


--
-- TOC entry 3257 (class 2606 OID 16658)
-- Name: reservations reservations_book_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_book_id_fkey FOREIGN KEY (book_id) REFERENCES public.books(book_id) NOT VALID;


--
-- TOC entry 3258 (class 2606 OID 16663)
-- Name: reservations reservations_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: docker
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_user_id_fkey FOREIGN KEY (user_id) REFERENCES public.users(user_id) NOT VALID;


-- Completed on 2024-06-16 00:31:31 UTC

--
-- PostgreSQL database dump complete
--

