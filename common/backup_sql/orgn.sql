--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.9
-- Dumped by pg_dump version 9.1.9
-- Started on 2014-02-24 17:55:03 WIT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 1950 (class 0 OID 19396)
-- Dependencies: 171 1951
-- Data for Name: orgn; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY orgn (id_orgn, cd_orgn, nm_orgn, create_date, create_by, update_date, update_by) FROM stdin;
1	2000	AWS	2014-02-24 16:27:10.394873	1	2014-02-24 16:48:52.254551	1
\.


--
-- TOC entry 1955 (class 0 OID 0)
-- Dependencies: 170
-- Name: orgn_id_orgn_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('orgn_id_orgn_seq', 1, true);


-- Completed on 2014-02-24 17:55:04 WIT

--
-- PostgreSQL database dump complete
--

