--
-- PostgreSQL database dump
--

-- Dumped from database version 11.7
-- Dumped by pg_dump version 11.7

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

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: candidate; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.candidate (
    c_id integer NOT NULL,
    profession character varying(100) NOT NULL,
    city character varying(130) NOT NULL,
    photo character varying(300),
    c_number numeric(10,0) NOT NULL,
    c_name character varying(100) NOT NULL,
    c_email character varying(130) NOT NULL,
    c_dr date NOT NULL,
    salary integer NOT NULL,
    skills text NOT NULL,
    me text NOT NULL,
    status character varying(50) NOT NULL
);


ALTER TABLE public.candidate OWNER TO postgres;

--
-- Name: candidate_c_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.candidate_c_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.candidate_c_id_seq OWNER TO postgres;

--
-- Name: candidate_c_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.candidate_c_id_seq OWNED BY public.candidate.c_id;


--
-- Name: education; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.education (
    ed_id integer NOT NULL,
    c_id integer,
    level character varying(30) NOT NULL,
    university character varying(150),
    faculty character varying(100),
    specialization character varying(100),
    ed_year integer
);


ALTER TABLE public.education OWNER TO postgres;

--
-- Name: education_ed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.education_ed_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.education_ed_id_seq OWNER TO postgres;

--
-- Name: education_ed_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.education_ed_id_seq OWNED BY public.education.ed_id;


--
-- Name: candidate c_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.candidate ALTER COLUMN c_id SET DEFAULT nextval('public.candidate_c_id_seq'::regclass);


--
-- Name: education ed_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.education ALTER COLUMN ed_id SET DEFAULT nextval('public.education_ed_id_seq'::regclass);


--
-- Data for Name: candidate; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.candidate VALUES (1, 'веб разработчик', 'Самара', NULL, 8945865985, 'Игорев Игорь Игоревич', 'igor@mail.ru', '2015-02-11', 78000, 'что-то умею', 'неплохой человек', 'Назначено собеседование');


--
-- Data for Name: education; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.education VALUES (1, 1, 'Среднее', 'универ самары', 'автоматизации и информатики', 'программная инженерия', 2021);


--
-- Name: candidate_c_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.candidate_c_id_seq', 1, true);


--
-- Name: education_ed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.education_ed_id_seq', 1, true);


--
-- Name: candidate pk_candidate; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.candidate
    ADD CONSTRAINT pk_candidate PRIMARY KEY (c_id);


--
-- Name: education pk_education; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.education
    ADD CONSTRAINT pk_education PRIMARY KEY (ed_id);


--
-- Name: candidate_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX candidate_pk ON public.candidate USING btree (c_id);


--
-- Name: education_pk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX education_pk ON public.education USING btree (ed_id);


--
-- Name: have_fk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX have_fk ON public.education USING btree (c_id);


--
-- Name: education fk_educatio_have_candidat; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.education
    ADD CONSTRAINT fk_educatio_have_candidat FOREIGN KEY (c_id) REFERENCES public.candidate(c_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- PostgreSQL database dump complete
--

