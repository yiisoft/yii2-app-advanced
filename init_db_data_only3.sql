--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.9
-- Dumped by pg_dump version 9.1.9
-- Started on 2014-05-02 07:55:06 WIT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

--
-- TOC entry 2160 (class 0 OID 38625)
-- Dependencies: 188 2184
-- Data for Name: acc_periode; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO acc_periode VALUES (1, 'Januari 2014', '2014-01-01', '2014-01-31', 0, '2014-05-01 05:06:27.63336', 1, '2014-05-01 05:06:27.63336', 1);


--
-- TOC entry 2188 (class 0 OID 0)
-- Dependencies: 187
-- Name: acc_periode_id_periode_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('acc_periode_id_periode_seq_1', 1, true);


--
-- TOC entry 2162 (class 0 OID 38634)
-- Dependencies: 190 2184
-- Data for Name: orgn; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO orgn VALUES (1, 'ZMB', 'DZomb', '2014-04-04 08:03:46.098', 1, '2014-04-04 08:03:46.098', 1);


--
-- TOC entry 2171 (class 0 OID 38675)
-- Dependencies: 199 2162 2184
-- Data for Name: branch; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO branch VALUES (1, 1, '01', 'Main Office Aur', '2014-04-04 08:05:01.535', '2014-04-04 08:05:01.535', 1, 1);
INSERT INTO branch VALUES (2, 1, '02', 'Pdg BlackID-GP', '2014-04-04 08:19:53.775', '2014-04-04 08:19:53.775', 1, 1);
INSERT INTO branch VALUES (3, 1, '03', 'Pdg DZomb-Adls', '2014-04-04 08:20:42.125', '2014-04-04 08:20:42.125', 1, 1);
INSERT INTO branch VALUES (4, 1, '04', 'Pdg BlackID-PA', '2014-04-04 08:21:29.086', '2014-04-04 08:21:29.086', 1, 1);


--
-- TOC entry 2189 (class 0 OID 0)
-- Dependencies: 198
-- Name: branch_id_branch_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('branch_id_branch_seq', 4, true);


--
-- TOC entry 2173 (class 0 OID 38703)
-- Dependencies: 205 2171 2184
-- Data for Name: cashdrawer; Type: TABLE DATA; Schema: public; Owner: mdmunir
--



--
-- TOC entry 2190 (class 0 OID 0)
-- Dependencies: 204
-- Name: cashdrawer_id_cashdrawer_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('cashdrawer_id_cashdrawer_seq_1', 1, false);


--
-- TOC entry 2175 (class 0 OID 38731)
-- Dependencies: 211 2184
-- Data for Name: category; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO category VALUES (1, '01', 'Kaos', '2014-04-03 22:37:58.469', 1, '2014-04-22 11:34:50.643', 1);


--
-- TOC entry 2191 (class 0 OID 0)
-- Dependencies: 210
-- Name: category_id_category_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('category_id_category_seq', 1, true);


--
-- TOC entry 2157 (class 0 OID 38598)
-- Dependencies: 184 2184
-- Data for Name: coa; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO coa VALUES (1, NULL, '100000', 'AKTIVA', 100000, 'D', '2014-05-01 14:34:46.55118', 1, '2014-05-01 14:34:46.55118', 1);
INSERT INTO coa VALUES (2, NULL, '200000', 'KEWAJIBAN', 200000, 'K', '2014-05-01 14:35:26.008025', 1, '2014-05-01 14:35:26.008025', 1);
INSERT INTO coa VALUES (3, NULL, '300000', 'MODAL', 300000, 'K', '2014-05-01 14:36:02.3023', 1, '2014-05-01 14:36:02.3023', 1);
INSERT INTO coa VALUES (4, NULL, '400000', 'PENDAPATAN', 400000, 'K', '2014-04-04 10:44:38.272', 1, '2014-04-04 18:14:33.668', 1);
INSERT INTO coa VALUES (5, NULL, '500000', 'HARGA POKOK PENJUALAN', 500000, 'K', '2014-04-04 10:45:47.512', 1, '2014-04-04 18:16:00.753', 1);
INSERT INTO coa VALUES (6, NULL, '600000', 'BIAYA', 600000, 'D', '2014-04-04 10:48:13.921', 1, '2014-04-04 10:48:13.921', 1);
INSERT INTO coa VALUES (7, 1, '110000', 'AKTIVA LANCAR', 100000, 'D', '2014-04-04 10:37:24.064', 1, '2014-04-04 18:11:46.941', 1);
INSERT INTO coa VALUES (8, 1, '120000', 'AKTIVA TETAP', 100000, 'D', '2014-04-04 10:38:25.299', 1, '2014-04-04 18:06:49.081', 1);
INSERT INTO coa VALUES (9, 7, '110001', 'Kas Kecil', 100000, 'D', '2014-04-04 11:35:40.232', 1, '2014-04-24 10:52:56.5', 1);
INSERT INTO coa VALUES (10, 7, '110002', 'Bank BNI64', 100000, 'D', '2014-04-04 11:36:57.124', 1, '2014-04-04 18:27:22.9', 1);
INSERT INTO coa VALUES (11, 7, '110003', 'Piutang Dagang', 100000, 'D', '2014-04-04 18:24:10.582', 1, '2014-04-04 18:27:46.351', 1);
INSERT INTO coa VALUES (12, 7, '110004', 'Persediaan Barang Dagang', 100000, 'D', '2014-04-04 18:26:09.456', 1, '2014-04-04 18:28:04.362', 1);
INSERT INTO coa VALUES (13, 7, '110005', 'Kas Lain', 100000, 'D', '2014-05-01 18:40:45.489844', 1, '2014-05-01 18:40:45.489844', 1);
INSERT INTO coa VALUES (14, 8, '121000', 'Tanah Kapling A', 100000, 'D', '2014-04-23 15:49:18.677', 1, '2014-04-23 16:14:19.33', 1);
INSERT INTO coa VALUES (15, 8, '122000', 'Ruko Jl.Sudirman 45', 100000, 'D', '2014-04-23 16:15:30.122', 1, '2014-04-23 16:15:30.122', 1);
INSERT INTO coa VALUES (16, 2, '210000', 'HUTANG LANCAR', 200000, 'K', '2014-04-04 10:48:43.496', 1, '2014-04-04 18:28:33.212', 1);
INSERT INTO coa VALUES (17, 2, '220000', 'HUTANG JANGKA PANJANG', 200000, 'K', '2014-04-04 18:22:22.164', 1, '2014-04-04 18:22:22.164', 1);
INSERT INTO coa VALUES (18, 16, '210001', 'Hutang Dagang', 200000, 'K', '2014-04-04 18:23:10.407', 1, '2014-04-04 18:28:59.48', 1);
INSERT INTO coa VALUES (19, 16, '210002', 'Hutang Gaji', 200000, 'K', '2014-04-23 16:17:43.411', 1, '2014-04-23 16:35:13.124', 1);
INSERT INTO coa VALUES (20, 3, '310000', 'MODAL', 300000, 'K', '2014-04-04 10:39:31.904', 1, '2014-04-23 16:37:41.14', 1);
INSERT INTO coa VALUES (21, 20, '310001', 'Modal Pemilik', 300000, 'K', '2014-04-23 16:21:15.76', 1, '2014-04-23 16:37:21.669', 1);
INSERT INTO coa VALUES (22, 5, '510000', 'HPP', 500000, 'D', '2014-05-01 19:43:13.458085', 1, '2014-05-01 19:43:13.458085', 1);
INSERT INTO coa VALUES (23, 6, '610001', 'Beban Gaji/ Upah', 600000, 'D', '2014-04-23 16:22:50.609', 1, '2014-04-24 11:51:10.286', 1);
INSERT INTO coa VALUES (24, 6, '620001', 'Beban Adm & Umum', 600000, 'D', '2014-04-23 16:23:32.538', 1, '2014-04-24 11:51:29.197', 1);


--
-- TOC entry 2192 (class 0 OID 0)
-- Dependencies: 183
-- Name: coa_id_coa_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('coa_id_coa_seq', 24, true);


--
-- TOC entry 2168 (class 0 OID 38660)
-- Dependencies: 196 2184
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO customer VALUES (1, '0000', 'Umum', '', '', 1, 1, 1, '2014-05-02 07:48:49.91967', '2014-05-02 07:48:49.91967');


--
-- TOC entry 2169 (class 0 OID 38668)
-- Dependencies: 197 2168 2184
-- Data for Name: customer_detail; Type: TABLE DATA; Schema: public; Owner: mdmunir
--



--
-- TOC entry 2193 (class 0 OID 0)
-- Dependencies: 195
-- Name: customer_id_customer_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('customer_id_customer_seq', 1, true);


--
-- TOC entry 2153 (class 0 OID 38582)
-- Dependencies: 180 2184
-- Data for Name: entri_sheet; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO entri_sheet VALUES (1, 'PKRE', 'PEMBELIAN_KREDIT', '2014-05-02 05:48:36.027541', 1, '2014-05-02 05:48:36.027541', 1);


--
-- TOC entry 2158 (class 0 OID 38605)
-- Dependencies: 185 2153 2157 2184
-- Data for Name: entri_sheet_dtl; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO entri_sheet_dtl VALUES (1, 'PERSEDIAAN', 12);
INSERT INTO entri_sheet_dtl VALUES (1, 'HUTANG', 18);


--
-- TOC entry 2194 (class 0 OID 0)
-- Dependencies: 179
-- Name: entri_sheet_id_esheet_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('entri_sheet_id_esheet_seq', 1, true);


--
-- TOC entry 2149 (class 0 OID 38526)
-- Dependencies: 170 2184
-- Data for Name: global_config; Type: TABLE DATA; Schema: public; Owner: mdmunir
--



--
-- TOC entry 2195 (class 0 OID 0)
-- Dependencies: 189
-- Name: orgn_id_orgn_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('orgn_id_orgn_seq', 1, true);


--
-- TOC entry 2151 (class 0 OID 38536)
-- Dependencies: 172 2184
-- Data for Name: price_category; Type: TABLE DATA; Schema: public; Owner: mdmunir
--



--
-- TOC entry 2196 (class 0 OID 0)
-- Dependencies: 171
-- Name: price_category_id_price_category_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('price_category_id_price_category_seq_1', 1, false);


--
-- TOC entry 2155 (class 0 OID 38590)
-- Dependencies: 182 2184
-- Data for Name: product_group; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO product_group VALUES (1, 'wrn', 'Warning', '2014-04-03 22:35:40.436', 1, '2014-04-03 22:35:40.436', 1);


--
-- TOC entry 2177 (class 0 OID 38740)
-- Dependencies: 213 2155 2175 2184
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO product VALUES (1, '9890989099989', 'Kaos v-neck', 1, 1, '2014-04-03 22:39:44.032', 1, '2014-04-03 22:39:44.032', 1);
INSERT INTO product VALUES (2, '8890989099123', 'Kaos Polo', 1, 1, '2014-04-22 11:35:32.962', 1, '2014-04-22 11:35:32.962', 1);


--
-- TOC entry 2178 (class 0 OID 38747)
-- Dependencies: 214 2177 2184
-- Data for Name: product_child; Type: TABLE DATA; Schema: public; Owner: mdmunir
--



--
-- TOC entry 2197 (class 0 OID 0)
-- Dependencies: 181
-- Name: product_group_id_group_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('product_group_id_group_seq_1', 1, true);


--
-- TOC entry 2198 (class 0 OID 0)
-- Dependencies: 212
-- Name: product_id_product_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('product_id_product_seq', 2, true);


--
-- TOC entry 2166 (class 0 OID 38651)
-- Dependencies: 194 2184
-- Data for Name: supplier; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO supplier VALUES (1, 'Wrn', 'Warning Corp.', '2014-04-03 22:32:47.96', 1, '2014-04-03 22:32:47.96', 1);


--
-- TOC entry 2179 (class 0 OID 38762)
-- Dependencies: 217 2166 2177 2184
-- Data for Name: product_supplier; Type: TABLE DATA; Schema: public; Owner: mdmunir
--



--
-- TOC entry 2164 (class 0 OID 38642)
-- Dependencies: 192 2184
-- Data for Name: uom; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO uom VALUES (1, 'Pcs', 'Peaces', '2014-04-03 22:33:57.195', 1, '2014-04-03 22:33:57.195', 1);
INSERT INTO uom VALUES (2, 'Dzn', 'Dozen', '2014-04-03 22:34:19.881', 1, '2014-04-03 22:34:19.881', 1);


--
-- TOC entry 2181 (class 0 OID 38769)
-- Dependencies: 219 2164 2177 2184
-- Data for Name: product_uom; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO product_uom VALUES (1, 1, 1, 1, '2014-04-03 22:40:12.071', 1, '2014-04-03 22:40:12.071', 1);
INSERT INTO product_uom VALUES (2, 1, 2, 12, '2014-04-03 22:40:28.477', 1, '2014-04-03 22:40:28.477', 1);
INSERT INTO product_uom VALUES (3, 2, 1, 1, '2014-04-22 11:37:02.323', 1, '2014-04-22 11:37:02.323', 1);


--
-- TOC entry 2199 (class 0 OID 0)
-- Dependencies: 218
-- Name: product_uom_id_puom_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('product_uom_id_puom_seq', 3, true);


--
-- TOC entry 2200 (class 0 OID 0)
-- Dependencies: 193
-- Name: supplier_id_supplier_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('supplier_id_supplier_seq', 1, true);


--
-- TOC entry 2201 (class 0 OID 0)
-- Dependencies: 191
-- Name: uom_id_uom_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('uom_id_uom_seq', 2, true);


--
-- TOC entry 2183 (class 0 OID 38777)
-- Dependencies: 221 2171 2184
-- Data for Name: warehouse; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO warehouse VALUES (1, 1, 'Bkt1', 'Gudang Transit', '2014-04-04 08:16:00.092', 1, '2014-04-04 08:16:00.092', 1);
INSERT INTO warehouse VALUES (2, 1, 'Bkt2', 'Gudang Display', '2014-04-04 08:16:24.08', 1, '2014-04-04 08:16:24.08', 1);
INSERT INTO warehouse VALUES (3, 2, 'Pdg1', 'Display BlackID-GP', '2014-04-04 08:22:42.579', 1, '2014-04-04 08:22:42.579', 1);


--
-- TOC entry 2202 (class 0 OID 0)
-- Dependencies: 220
-- Name: warehouse_id_warehouse_seq; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('warehouse_id_warehouse_seq', 3, true);


--
-- TOC entry 2071 (class 0 OID 38536)
-- Dependencies: 172 2072
-- Data for Name: price_category; Type: TABLE DATA; Schema: public; Owner: mdmunir
--

INSERT INTO price_category VALUES (1, null, 'PRICE STANDART', null, '2014-05-02 07:58:46.399077', 1, '2014-05-02 07:58:46.399077', 1);


--
-- TOC entry 2076 (class 0 OID 0)
-- Dependencies: 171
-- Name: price_category_id_price_category_seq_1; Type: SEQUENCE SET; Schema: public; Owner: mdmunir
--

SELECT pg_catalog.setval('price_category_id_price_category_seq_1', 1, true);


-- Completed on 2014-05-02 07:55:06 WIT

--
-- PostgreSQL database dump complete
--

