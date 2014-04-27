--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.9
-- Dumped by pg_dump version 9.1.9
-- Started on 2014-04-26 21:21:54 WIT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2161 (class 0 OID 36720)
-- Dependencies: 193 2181
-- Data for Name: orgn; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY orgn (id_orgn, cd_orgn, nm_orgn, create_date, create_by, update_date, update_by) FROM stdin;
1	ZMB	DZomb	2014-04-04 08:03:46.098	1	2014-04-04 08:03:46.098	1
\.


--
-- TOC entry 2170 (class 0 OID 36761)
-- Dependencies: 202 2161 2181
-- Data for Name: branch; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY branch (id_branch, id_orgn, cd_branch, nm_branch, create_date, update_date, create_by, update_by) FROM stdin;
1	1	01	Main Office Aur	2014-04-04 08:05:01.535	2014-04-04 08:05:01.535	1	1
2	1	02	Pdg BlackID-GP	2014-04-04 08:19:53.775	2014-04-04 08:19:53.775	1	1
3	1	03	Pdg DZomb-Adls	2014-04-04 08:20:42.125	2014-04-04 08:20:42.125	1	1
4	1	04	Pdg BlackID-PA	2014-04-04 08:21:29.086	2014-04-04 08:21:29.086	1	1
\.


--
-- TOC entry 2185 (class 0 OID 0)
-- Dependencies: 201
-- Name: branch_id_branch_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('branch_id_branch_seq', 4, true);


--
-- TOC entry 2172 (class 0 OID 36817)
-- Dependencies: 214 2181
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY category (id_category, cd_category, nm_category, create_date, create_by, update_date, update_by) FROM stdin;
1	01	Kaos	2014-04-03 22:37:58.469	1	2014-04-22 11:34:50.643	1
\.


--
-- TOC entry 2186 (class 0 OID 0)
-- Dependencies: 213
-- Name: category_id_category_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('category_id_category_seq', 1, true);


--
-- TOC entry 2158 (class 0 OID 36685)
-- Dependencies: 187 2181
-- Data for Name: coa; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY coa (id_coa, id_coa_parent, cd_account, nm_account, coa_type, normal_balance, create_date, create_by, update_date, update_by) FROM stdin;
1	\N	110000	AKTIVA LANCAR	100000	D	2014-04-04 10:37:24.064	1	2014-04-04 18:11:46.941	1
2	\N	120000	AKTIVA TETAP	100000	D	2014-04-04 10:38:25.299	1	2014-04-04 18:06:49.081	1
6	\N	600000	BIAYA	600000	D	2014-04-04 10:48:13.921	1	2014-04-04 10:48:13.921	1
8	1	110001	Kas Kecil	100000	D	2014-04-04 11:35:40.232	1	2014-04-24 10:52:56.5	1
19	6	610001	Beban Gaji/ Upah	600000	D	2014-04-23 16:22:50.609	1	2014-04-24 11:51:10.286	1
4	\N	400000	PENDAPATAN	400000	K	2014-04-04 10:44:38.272	1	2014-04-04 18:14:33.668	1
20	6	620001	Beban Adm & Umum	600000	D	2014-04-23 16:23:32.538	1	2014-04-24 11:51:29.197	1
5	\N	500000	HARGA POKOK PENJUALAN	500000	K	2014-04-04 10:45:47.512	1	2014-04-04 18:16:00.753	1
10	\N	220000	HUTANG JANGKA PANJANG	200000	K	2014-04-04 18:22:22.164	1	2014-04-04 18:22:22.164	1
7	\N	210000	HUTANG LANCAR	200000	K	2014-04-04 10:48:43.496	1	2014-04-04 18:28:33.212	1
3	\N	310000	MODAL	300000	K	2014-04-04 10:39:31.904	1	2014-04-23 16:37:41.14	1
9	1	110002	Bank BNI64	100000	D	2014-04-04 11:36:57.124	1	2014-04-04 18:27:22.9	1
12	1	110003	Piutang Dagang	100000	D	2014-04-04 18:24:10.582	1	2014-04-04 18:27:46.351	1
13	1	110004	Persediaan Barang Dagang	100000	D	2014-04-04 18:26:09.456	1	2014-04-04 18:28:04.362	1
14	2	121000	Tanah Kapling A	100000	D	2014-04-23 15:49:18.677	1	2014-04-23 16:14:19.33	1
15	2	122000	Ruko Jl.Sudirman 45	100000	D	2014-04-23 16:15:30.122	1	2014-04-23 16:15:30.122	1
11	7	210001	Hutang Dagang	200000	K	2014-04-04 18:23:10.407	1	2014-04-04 18:28:59.48	1
17	7	210002	Hutang Gaji	200000	K	2014-04-23 16:17:43.411	1	2014-04-23 16:35:13.124	1
18	3	310001	Modal Pemilik	300000	K	2014-04-23 16:21:15.76	1	2014-04-23 16:37:21.669	1
\.


--
-- TOC entry 2187 (class 0 OID 0)
-- Dependencies: 186
-- Name: coa_id_coa_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('coa_id_coa_seq', 22, true);


--
-- TOC entry 2167 (class 0 OID 36746)
-- Dependencies: 199 2181
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY customer (id_customer, cd_cust, nm_cust, contact_name, contact_number, status, update_by, create_by, update_date, create_date) FROM stdin;
\.


--
-- TOC entry 2168 (class 0 OID 36754)
-- Dependencies: 200 2167 2181
-- Data for Name: customer_detail; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY customer_detail (id_customer, id_distric, addr1, addr2, latitude, longtitude, id_kab, id_kec, id_kel, create_date, create_by, update_date, update_by) FROM stdin;
\.


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 198
-- Name: customer_id_customer_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('customer_id_customer_seq', 1, true);


--
-- TOC entry 2154 (class 0 OID 36669)
-- Dependencies: 183 2181
-- Data for Name: entri_sheet; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY entri_sheet (id_esheet, cd_esheet, nm_esheet, create_date, create_by, update_date, update_by) FROM stdin;
3	PRET	PENJUALAN_RETAIL	2014-04-05 06:36:58.138	1	2014-04-05 06:36:58.138	1
4	PGRO	PENJUALAN_GROSIR	2014-04-05 06:38:20.61	1	2014-04-05 06:38:20.61	1
1	PKRE	PEMBELIAN_KREDIT	2014-04-04 20:44:47.105	1	2014-04-23 13:43:36.964	1
6	test	Test	2014-04-23 15:45:51.409	1	2014-04-23 15:46:09.508	1
2	PKTN	PEMBELIAN_TUNAI	2014-04-05 06:33:15.777	1	2014-04-24 11:54:37.829	1
\.


--
-- TOC entry 2159 (class 0 OID 36691)
-- Dependencies: 188 2154 2158 2181
-- Data for Name: entri_sheet_dtl; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY entri_sheet_dtl (id_esheet, nm_esheet_dtl, id_coa) FROM stdin;
2	PIUTANG	12
1	PERSEDIAAN	13
6	sdsd	12
1	HUTANG	11
\.


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 182
-- Name: entri_sheet_id_esheet_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('entri_sheet_id_esheet_seq', 6, true);


--
-- TOC entry 2150 (class 0 OID 36613)
-- Dependencies: 173 2181
-- Data for Name: global_config; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY global_config (config_group, config_name, config_value, description, create_date, create_by, update_date, update_by) FROM stdin;
\.


--
-- TOC entry 2149 (class 0 OID 29493)
-- Dependencies: 167 2181
-- Data for Name: group_1; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY group_1 (id_group, cd_group, nm_group, create_date, create_by, update_date, update_by) FROM stdin;
\.


--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 166
-- Name: group_1_id_group_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('group_1_id_group_seq', 1, false);


--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 192
-- Name: orgn_id_orgn_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('orgn_id_orgn_seq', 1, true);


--
-- TOC entry 2152 (class 0 OID 36623)
-- Dependencies: 175 2181
-- Data for Name: price_category; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY price_category (id_price_category, nm_price_category, formula, create_by, update_date, update_by, create_date) FROM stdin;
\.


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 174
-- Name: price_category_id_price_category_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('price_category_id_price_category_seq_1', 1, false);


--
-- TOC entry 2156 (class 0 OID 36677)
-- Dependencies: 185 2181
-- Data for Name: product_group; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY product_group (id_group, cd_group, nm_group, create_date, create_by, update_date, update_by) FROM stdin;
1	wrn	Warning	2014-04-03 22:35:40.436	1	2014-04-03 22:35:40.436	1
\.


--
-- TOC entry 2174 (class 0 OID 36826)
-- Dependencies: 216 2156 2172 2181
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY product (id_product, cd_product, nm_product, id_category, id_group, create_date, create_by, update_date, update_by) FROM stdin;
1	9890989099989	Kaos v-neck	1	1	2014-04-03 22:39:44.032	1	2014-04-03 22:39:44.032	1
2	8890989099123	Kaos Polo	1	1	2014-04-22 11:35:32.962	1	2014-04-22 11:35:32.962	1
\.


--
-- TOC entry 2175 (class 0 OID 36833)
-- Dependencies: 217 2174 2181
-- Data for Name: product_child; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY product_child (barcode, id_product, create_date, update_date, create_by, update_by, nm_product) FROM stdin;
\.


--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 184
-- Name: product_group_id_group_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('product_group_id_group_seq_1', 1, true);


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 215
-- Name: product_id_product_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('product_id_product_seq', 2, true);


--
-- TOC entry 2165 (class 0 OID 36737)
-- Dependencies: 197 2181
-- Data for Name: supplier; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY supplier (id_supplier, cd_supplier, nm_supplier, create_date, create_by, update_date, update_by) FROM stdin;
1	Wrn	Warning Corp.	2014-04-03 22:32:47.96	1	2014-04-03 22:32:47.96	1
\.


--
-- TOC entry 2176 (class 0 OID 36848)
-- Dependencies: 220 2165 2174 2181
-- Data for Name: product_supplier; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY product_supplier (id_product, id_supplier, create_date, create_by, update_date, update_by) FROM stdin;
\.


--
-- TOC entry 2163 (class 0 OID 36728)
-- Dependencies: 195 2181
-- Data for Name: uom; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY uom (id_uom, cd_uom, nm_uom, create_date, create_by, update_date, update_by) FROM stdin;
1	Pcs	Peaces	2014-04-03 22:33:57.195	1	2014-04-03 22:33:57.195	1
2	Dzn	Dozen	2014-04-03 22:34:19.881	1	2014-04-03 22:34:19.881	1
\.


--
-- TOC entry 2178 (class 0 OID 36855)
-- Dependencies: 222 2163 2174 2181
-- Data for Name: product_uom; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY product_uom (id_puom, id_product, id_uom, isi, create_date, create_by, update_date, update_by) FROM stdin;
1	1	1	1	2014-04-03 22:40:12.071	1	2014-04-03 22:40:12.071	1
2	1	2	12	2014-04-03 22:40:28.477	1	2014-04-03 22:40:28.477	1
3	2	1	1	2014-04-22 11:37:02.323	1	2014-04-22 11:37:02.323	1
\.


--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 221
-- Name: product_uom_id_puom_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('product_uom_id_puom_seq', 3, true);


--
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 196
-- Name: supplier_id_supplier_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('supplier_id_supplier_seq', 1, true);


--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 194
-- Name: uom_id_uom_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('uom_id_uom_seq', 2, true);


--
-- TOC entry 2180 (class 0 OID 36863)
-- Dependencies: 224 2170 2181
-- Data for Name: warehouse; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

COPY warehouse (id_warehouse, id_branch, cd_whse, nm_whse, create_date, create_by, update_date, update_by) FROM stdin;
1	1	Bkt1	Gudang Transit	2014-04-04 08:16:00.092	1	2014-04-04 08:16:00.092	1
2	1	Bkt2	Gudang Display	2014-04-04 08:16:24.08	1	2014-04-04 08:16:24.08	1
3	2	Pdg1	Display BlackID-GP	2014-04-04 08:22:42.579	1	2014-04-04 08:22:42.579	1
\.


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 223
-- Name: warehouse_id_warehouse_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('warehouse_id_warehouse_seq', 3, true);


-- Completed on 2014-04-26 21:21:54 WIT

--
-- PostgreSQL database dump complete
--

