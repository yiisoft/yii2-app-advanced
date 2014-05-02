--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.9
-- Dumped by pg_dump version 9.1.9
-- Started on 2014-05-02 08:03:30 WIT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2071 (class 0 OID 38536)
-- Dependencies: 172 2072
-- Data for Name: price_category; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO price_category (id_price_category, nm_price_category, formula, create_by, update_date, update_by, create_date) VALUES (1, 'Eceran Tertinggi', '1*price', 1, '2014-05-02 07:58:46.399077', 1, '2014-05-02 07:58:46.399077');


--
-- TOC entry 2076 (class 0 OID 0)
-- Dependencies: 171
-- Name: price_category_id_price_category_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('price_category_id_price_category_seq_1', 1, true);


-- Completed on 2014-05-02 08:03:30 WIT

--
-- PostgreSQL database dump complete
--

