--
-- PostgreSQL database dump
--

-- Dumped from database version 9.1.9
-- Dumped by pg_dump version 9.1.9
-- Started on 2014-05-02 08:22:30 WIT

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

ALTER TABLE ONLY public.transfer_hdr DROP CONSTRAINT warehouse_transfer_hdr_fk1;
ALTER TABLE ONLY public.transfer_hdr DROP CONSTRAINT warehouse_transfer_hdr_fk;
ALTER TABLE ONLY public.stock_opname DROP CONSTRAINT warehouse_stock_opname_fk;
ALTER TABLE ONLY public.stock_adjustment DROP CONSTRAINT warehouse_stock_adjustment_fk;
ALTER TABLE ONLY public.sales_dtl DROP CONSTRAINT warehouse_sales_dtl_fk;
ALTER TABLE ONLY public.purchase_dtl DROP CONSTRAINT warehouse_purchase_dtl_fk;
ALTER TABLE ONLY public.product_stock DROP CONSTRAINT warehouse_product_stock_fk;
ALTER TABLE ONLY public.product_uom DROP CONSTRAINT uoms_product_uoms_fk;
ALTER TABLE ONLY public.transfer_dtl DROP CONSTRAINT uom_transfer_dtl_fk;
ALTER TABLE ONLY public.stock_opname_dtl DROP CONSTRAINT uom_stock_opname_dtl_fk;
ALTER TABLE ONLY public.stock_adjusment_dtl DROP CONSTRAINT uom_stock_adjusment_dtl_fk;
ALTER TABLE ONLY public.sales_dtl DROP CONSTRAINT uom_sales_dtl_fk;
ALTER TABLE ONLY public.purchase_dtl DROP CONSTRAINT uom_purchase_dtl_fk;
ALTER TABLE ONLY public.product_stock DROP CONSTRAINT uom_product_stock_fk;
ALTER TABLE ONLY public.price DROP CONSTRAINT uom_price_fk;
ALTER TABLE ONLY public.notice_dtl DROP CONSTRAINT uom_notice_dtl_fk;
ALTER TABLE ONLY public.cogs DROP CONSTRAINT uom_cogs_fk;
ALTER TABLE ONLY public.notice_dtl DROP CONSTRAINT transfer_notice_notice_dtl_fk;
ALTER TABLE ONLY public.transfer_notice DROP CONSTRAINT transfer_hdr_transfer_notice_fk;
ALTER TABLE ONLY public.transfer_dtl DROP CONSTRAINT transfer_hdr_transfer_dtl_fk;
ALTER TABLE ONLY public.purchase_hdr DROP CONSTRAINT supplier_purchase_hdr_fk;
ALTER TABLE ONLY public.product_supplier DROP CONSTRAINT supplier_product_supplier_fk;
ALTER TABLE ONLY public.stock_opname_dtl DROP CONSTRAINT stock_opname_stock_opname_dtl_fk;
ALTER TABLE ONLY public.stock_adjusment_dtl DROP CONSTRAINT stock_adjustment_stock_adjusment_dtl_fk;
ALTER TABLE ONLY public.sales_dtl DROP CONSTRAINT sales_hdr_sales_dtl_fk;
ALTER TABLE ONLY public.purchase_dtl DROP CONSTRAINT purchase_hdr_purchase_dtl_fk;
ALTER TABLE ONLY public.transfer_dtl DROP CONSTRAINT product_transfer_dtl_fk;
ALTER TABLE ONLY public.stock_opname_dtl DROP CONSTRAINT product_stock_opname_dtl_fk;
ALTER TABLE ONLY public.stock_adjusment_dtl DROP CONSTRAINT product_stock_adjusment_dtl_fk;
ALTER TABLE ONLY public.sales_dtl DROP CONSTRAINT product_sales_dtl_fk;
ALTER TABLE ONLY public.purchase_dtl DROP CONSTRAINT product_purchase_dtl_fk;
ALTER TABLE ONLY public.product_uom DROP CONSTRAINT product_product_uoms_fk;
ALTER TABLE ONLY public.product_supplier DROP CONSTRAINT product_product_supplier_fk;
ALTER TABLE ONLY public.product_stock DROP CONSTRAINT product_product_stock_fk;
ALTER TABLE ONLY public.product_child DROP CONSTRAINT product_product_child_fk;
ALTER TABLE ONLY public.price DROP CONSTRAINT product_price_fk;
ALTER TABLE ONLY public.notice_dtl DROP CONSTRAINT product_notice_dtl_fk;
ALTER TABLE ONLY public.cogs DROP CONSTRAINT product_cogs_fk;
ALTER TABLE ONLY public.product DROP CONSTRAINT product_category_product_fk;
ALTER TABLE ONLY public.price DROP CONSTRAINT price_category_price_fk;
ALTER TABLE ONLY public.payment_dtl DROP CONSTRAINT payment_payment_dtl_fk;
ALTER TABLE ONLY public.branch DROP CONSTRAINT org_branch_fk;
ALTER TABLE ONLY public.payment_dtl DROP CONSTRAINT invoice_hdr_payment_dtl_fk;
ALTER TABLE ONLY public.invoice_dtl DROP CONSTRAINT invoice_hdr_invoice_dtl_fk;
ALTER TABLE ONLY public.product DROP CONSTRAINT group_product_fk;
ALTER TABLE ONLY public.gl_detail DROP CONSTRAINT gl_header_gl_detail_fk;
ALTER TABLE ONLY public.entri_sheet_dtl DROP CONSTRAINT entri_sheet_new_table_fk;
ALTER TABLE ONLY public.customer_detail DROP CONSTRAINT customers_customer_detail_fk;
ALTER TABLE ONLY public.sales_hdr DROP CONSTRAINT customer_sales_fk;
ALTER TABLE ONLY public.entri_sheet_dtl DROP CONSTRAINT coa_new_table_fk;
ALTER TABLE ONLY public.gl_detail DROP CONSTRAINT coa_gl_detail_fk;
ALTER TABLE ONLY public.coa DROP CONSTRAINT coa_coa_fk;
ALTER TABLE ONLY public.sales_hdr DROP CONSTRAINT cashdrawer_sales_hdr_fk;
ALTER TABLE ONLY public.warehouse DROP CONSTRAINT branch_warehouse_fk;
ALTER TABLE ONLY public.sales_hdr DROP CONSTRAINT branch_sales_hdr_fk;
ALTER TABLE ONLY public.purchase_hdr DROP CONSTRAINT branch_purchase_hdr_fk;
ALTER TABLE ONLY public.gl_header DROP CONSTRAINT branch_gl_header_fk;
ALTER TABLE ONLY public.cashdrawer DROP CONSTRAINT branch_cashdrawer_fk;
ALTER TABLE ONLY public.gl_header DROP CONSTRAINT acc_periode_gl_header_fk;
DROP INDEX public.uoms_unique_code;
DROP INDEX public.unique_cd_cust;
DROP INDEX public.supplier_ucode;
DROP INDEX public.product_ucode;
DROP INDEX public.product_category_ucode;
DROP INDEX public.entri_sheet_dtl_idx;
DROP INDEX public.coa_idx;
DROP INDEX public.branch_ucode;
ALTER TABLE ONLY public.warehouse DROP CONSTRAINT warehouse_pk;
ALTER TABLE ONLY public.uom DROP CONSTRAINT uom_pk;
ALTER TABLE ONLY public.transfer_notice DROP CONSTRAINT transfer_notice_pk;
ALTER TABLE ONLY public.transfer_hdr DROP CONSTRAINT transfer_hdr_pk;
ALTER TABLE ONLY public.transfer_dtl DROP CONSTRAINT transfer_dtl_pk;
ALTER TABLE ONLY public.supplier DROP CONSTRAINT supplier_pk;
ALTER TABLE ONLY public.stock_opname DROP CONSTRAINT stock_opname_pk;
ALTER TABLE ONLY public.stock_opname_dtl DROP CONSTRAINT stock_opname_dtl_pk;
ALTER TABLE ONLY public.stock_adjustment DROP CONSTRAINT stock_adjustment_pk;
ALTER TABLE ONLY public.stock_adjusment_dtl DROP CONSTRAINT stock_adjusment_dtl_pk;
ALTER TABLE ONLY public.sales_hdr DROP CONSTRAINT sales_hdr_pk;
ALTER TABLE ONLY public.sales_dtl DROP CONSTRAINT sales_dtl_pk;
ALTER TABLE ONLY public.purchase_hdr DROP CONSTRAINT purchase_hdr_pk;
ALTER TABLE ONLY public.purchase_dtl DROP CONSTRAINT purchase_dtl_pk;
ALTER TABLE ONLY public.product_uom DROP CONSTRAINT product_uom_pk;
ALTER TABLE ONLY public.product_supplier DROP CONSTRAINT product_supplier_pk;
ALTER TABLE ONLY public.product_stock DROP CONSTRAINT product_stock_pk;
ALTER TABLE ONLY public.product DROP CONSTRAINT product_pk;
ALTER TABLE ONLY public.product_group DROP CONSTRAINT product_group_pk;
ALTER TABLE ONLY public.product_child DROP CONSTRAINT product_child_pk;
ALTER TABLE ONLY public.price DROP CONSTRAINT price_pk;
ALTER TABLE ONLY public.price_category DROP CONSTRAINT price_category_pk;
ALTER TABLE ONLY public.payment DROP CONSTRAINT payment_pk;
ALTER TABLE ONLY public.payment_dtl DROP CONSTRAINT payment_dtl_pk;
ALTER TABLE ONLY public.category DROP CONSTRAINT p_category_pk;
ALTER TABLE ONLY public.orgn DROP CONSTRAINT orgn_pk;
ALTER TABLE ONLY public.notice_dtl DROP CONSTRAINT notice_dtl_pk;
ALTER TABLE ONLY public.invoice_hdr DROP CONSTRAINT invoice_hdr_pk;
ALTER TABLE ONLY public.invoice_dtl DROP CONSTRAINT invoice_dtl_pk;
ALTER TABLE ONLY public.global_config DROP CONSTRAINT global_config_pk;
ALTER TABLE ONLY public.gl_header DROP CONSTRAINT gl_header_pk;
ALTER TABLE ONLY public.gl_detail DROP CONSTRAINT gl_detail_pk;
ALTER TABLE ONLY public.entri_sheet DROP CONSTRAINT entri_sheet_pk;
ALTER TABLE ONLY public.entri_sheet_dtl DROP CONSTRAINT entri_sheet_dtl_pk;
ALTER TABLE ONLY public.customer DROP CONSTRAINT customer_pk;
ALTER TABLE ONLY public.customer_detail DROP CONSTRAINT customer_dtl_pk;
ALTER TABLE ONLY public.cogs DROP CONSTRAINT cogs_pk;
ALTER TABLE ONLY public.coa DROP CONSTRAINT coa_pk;
ALTER TABLE ONLY public.cashdrawer DROP CONSTRAINT cashdrawer_pk;
ALTER TABLE ONLY public.branch DROP CONSTRAINT branch_pk;
ALTER TABLE ONLY public.auto_number DROP CONSTRAINT auto_number_pk;
ALTER TABLE ONLY public.acc_periode DROP CONSTRAINT acc_periode_pk;
ALTER TABLE public.warehouse ALTER COLUMN id_warehouse DROP DEFAULT;
ALTER TABLE public.uom ALTER COLUMN id_uom DROP DEFAULT;
ALTER TABLE public.transfer_hdr ALTER COLUMN id_transfer DROP DEFAULT;
ALTER TABLE public.supplier ALTER COLUMN id_supplier DROP DEFAULT;
ALTER TABLE public.stock_opname ALTER COLUMN id_opname DROP DEFAULT;
ALTER TABLE public.stock_adjustment ALTER COLUMN id_adjustment DROP DEFAULT;
ALTER TABLE public.sales_hdr ALTER COLUMN id_sales DROP DEFAULT;
ALTER TABLE public.sales_dtl ALTER COLUMN id_sales_dtl DROP DEFAULT;
ALTER TABLE public.purchase_hdr ALTER COLUMN id_purchase DROP DEFAULT;
ALTER TABLE public.purchase_dtl ALTER COLUMN id_purchase_dtl DROP DEFAULT;
ALTER TABLE public.product_uom ALTER COLUMN id_puom DROP DEFAULT;
ALTER TABLE public.product_stock ALTER COLUMN id_stock DROP DEFAULT;
ALTER TABLE public.product_group ALTER COLUMN id_group DROP DEFAULT;
ALTER TABLE public.product ALTER COLUMN id_product DROP DEFAULT;
ALTER TABLE public.price_category ALTER COLUMN id_price_category DROP DEFAULT;
ALTER TABLE public.payment ALTER COLUMN id_payment DROP DEFAULT;
ALTER TABLE public.orgn ALTER COLUMN id_orgn DROP DEFAULT;
ALTER TABLE public.invoice_hdr ALTER COLUMN id_invoice DROP DEFAULT;
ALTER TABLE public.gl_header ALTER COLUMN id_gl DROP DEFAULT;
ALTER TABLE public.gl_detail ALTER COLUMN id_gl_detail DROP DEFAULT;
ALTER TABLE public.entri_sheet ALTER COLUMN id_esheet DROP DEFAULT;
ALTER TABLE public.customer ALTER COLUMN id_customer DROP DEFAULT;
ALTER TABLE public.coa ALTER COLUMN id_coa DROP DEFAULT;
ALTER TABLE public.category ALTER COLUMN id_category DROP DEFAULT;
ALTER TABLE public.cashdrawer ALTER COLUMN id_cashdrawer DROP DEFAULT;
ALTER TABLE public.branch ALTER COLUMN id_branch DROP DEFAULT;
ALTER TABLE public.acc_periode ALTER COLUMN id_periode DROP DEFAULT;
DROP SEQUENCE public.warehouse_id_warehouse_seq;
DROP TABLE public.warehouse;
DROP SEQUENCE public.uom_id_uom_seq;
DROP TABLE public.uom;
DROP TABLE public.transfer_notice;
DROP SEQUENCE public.transfer_hdr_id_transfer_seq;
DROP TABLE public.transfer_hdr;
DROP TABLE public.transfer_dtl;
DROP SEQUENCE public.supplier_id_supplier_seq;
DROP TABLE public.supplier;
DROP SEQUENCE public.stock_opname_id_opname_seq;
DROP TABLE public.stock_opname_dtl;
DROP TABLE public.stock_opname;
DROP SEQUENCE public.stock_adjustment_id_adjustment_seq;
DROP TABLE public.stock_adjustment;
DROP TABLE public.stock_adjusment_dtl;
DROP SEQUENCE public.sales_hdr_id_sales_seq;
DROP TABLE public.sales_hdr;
DROP SEQUENCE public.sales_dtl_id_sales_dtl_seq;
DROP TABLE public.sales_dtl;
DROP SEQUENCE public.purchase_hdr_id_purchase_seq;
DROP TABLE public.purchase_hdr;
DROP SEQUENCE public.purchase_dtl_id_purchase_dtl_seq;
DROP TABLE public.purchase_dtl;
DROP SEQUENCE public.product_uom_id_puom_seq;
DROP TABLE public.product_uom;
DROP TABLE public.product_supplier;
DROP SEQUENCE public.product_stock_id_stock_seq;
DROP TABLE public.product_stock;
DROP SEQUENCE public.product_id_product_seq;
DROP SEQUENCE public.product_group_id_group_seq_1;
DROP TABLE public.product_group;
DROP TABLE public.product_child;
DROP TABLE public.product;
DROP SEQUENCE public.price_category_id_price_category_seq_1;
DROP TABLE public.price_category;
DROP TABLE public.price;
DROP SEQUENCE public.payment_id_payment_seq;
DROP TABLE public.payment_dtl;
DROP TABLE public.payment;
DROP SEQUENCE public.orgn_id_orgn_seq;
DROP TABLE public.orgn;
DROP TABLE public.notice_dtl;
DROP SEQUENCE public.invoice_hdr_id_invoice_seq;
DROP TABLE public.invoice_hdr;
DROP TABLE public.invoice_dtl;
DROP TABLE public.global_config;
DROP SEQUENCE public.gl_header_id_gl_seq;
DROP TABLE public.gl_header;
DROP SEQUENCE public.gl_detail_id_gl_detail_seq;
DROP TABLE public.gl_detail;
DROP SEQUENCE public.entri_sheet_id_esheet_seq;
DROP TABLE public.entri_sheet_dtl;
DROP TABLE public.entri_sheet;
DROP SEQUENCE public.customer_id_customer_seq;
DROP TABLE public.customer_detail;
DROP TABLE public.customer;
DROP TABLE public.cogs;
DROP SEQUENCE public.coa_id_coa_seq;
DROP TABLE public.coa;
DROP SEQUENCE public.category_id_category_seq;
DROP TABLE public.category;
DROP SEQUENCE public.cashdrawer_id_cashdrawer_seq_1;
DROP TABLE public.cashdrawer;
DROP SEQUENCE public.branch_id_branch_seq;
DROP TABLE public.branch;
DROP TABLE public.auto_number;
DROP SEQUENCE public.acc_periode_id_periode_seq_1;
DROP TABLE public.acc_periode;
SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 188 (class 1259 OID 39275)
-- Dependencies: 2075 6
-- Name: acc_periode; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE acc_periode (
    id_periode integer NOT NULL,
    nm_periode character varying(32) NOT NULL,
    date_from date NOT NULL,
    date_to date NOT NULL,
    status integer DEFAULT 0 NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2259 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN acc_periode.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN acc_periode.create_by IS 'id of user creator';


--
-- TOC entry 2260 (class 0 OID 0)
-- Dependencies: 188
-- Name: COLUMN acc_periode.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN acc_periode.update_by IS 'id of user creator';


--
-- TOC entry 187 (class 1259 OID 39273)
-- Dependencies: 6 188
-- Name: acc_periode_id_periode_seq_1; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE acc_periode_id_periode_seq_1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2261 (class 0 OID 0)
-- Dependencies: 187
-- Name: acc_periode_id_periode_seq_1; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE acc_periode_id_periode_seq_1 OWNED BY acc_periode.id_periode;


--
-- TOC entry 186 (class 1259 OID 39264)
-- Dependencies: 2073 6
-- Name: auto_number; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE auto_number (
    template_group character varying NOT NULL,
    template_num character varying(20) NOT NULL,
    auto_number integer NOT NULL,
    optimistic_lock integer DEFAULT 1 NOT NULL,
    update_time integer
);


--
-- TOC entry 199 (class 1259 OID 39325)
-- Dependencies: 6
-- Name: branch; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE branch (
    id_branch integer NOT NULL,
    id_orgn integer NOT NULL,
    cd_branch character varying(4) NOT NULL,
    nm_branch character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    update_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2262 (class 0 OID 0)
-- Dependencies: 199
-- Name: COLUMN branch.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN branch.create_by IS 'id of user creator';


--
-- TOC entry 2263 (class 0 OID 0)
-- Dependencies: 199
-- Name: COLUMN branch.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN branch.update_by IS 'id of user creator';


--
-- TOC entry 198 (class 1259 OID 39323)
-- Dependencies: 6 199
-- Name: branch_id_branch_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE branch_id_branch_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2264 (class 0 OID 0)
-- Dependencies: 198
-- Name: branch_id_branch_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE branch_id_branch_seq OWNED BY branch.id_branch;


--
-- TOC entry 205 (class 1259 OID 39353)
-- Dependencies: 2085 2086 2087 6
-- Name: cashdrawer; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE cashdrawer (
    id_cashdrawer integer NOT NULL,
    client_machine character varying(32) NOT NULL,
    id_branch integer NOT NULL,
    cashier_no integer NOT NULL,
    id_user integer NOT NULL,
    init_cash double precision DEFAULT 0 NOT NULL,
    close_cash double precision DEFAULT 0 NOT NULL,
    variants double precision DEFAULT 0 NOT NULL,
    status integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2265 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN cashdrawer.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN cashdrawer.create_by IS 'id of user creator';


--
-- TOC entry 2266 (class 0 OID 0)
-- Dependencies: 205
-- Name: COLUMN cashdrawer.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN cashdrawer.update_by IS 'id of user creator';


--
-- TOC entry 204 (class 1259 OID 39351)
-- Dependencies: 205 6
-- Name: cashdrawer_id_cashdrawer_seq_1; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE cashdrawer_id_cashdrawer_seq_1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2267 (class 0 OID 0)
-- Dependencies: 204
-- Name: cashdrawer_id_cashdrawer_seq_1; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE cashdrawer_id_cashdrawer_seq_1 OWNED BY cashdrawer.id_cashdrawer;


--
-- TOC entry 211 (class 1259 OID 39381)
-- Dependencies: 6
-- Name: category; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE category (
    id_category integer NOT NULL,
    cd_category character varying(4) NOT NULL,
    nm_category character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2268 (class 0 OID 0)
-- Dependencies: 211
-- Name: COLUMN category.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN category.create_by IS 'id of user creator';


--
-- TOC entry 2269 (class 0 OID 0)
-- Dependencies: 211
-- Name: COLUMN category.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN category.update_by IS 'id of user creator';


--
-- TOC entry 210 (class 1259 OID 39379)
-- Dependencies: 6 211
-- Name: category_id_category_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE category_id_category_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2270 (class 0 OID 0)
-- Dependencies: 210
-- Name: category_id_category_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE category_id_category_seq OWNED BY category.id_category;


--
-- TOC entry 184 (class 1259 OID 39248)
-- Dependencies: 6
-- Name: coa; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE coa (
    id_coa integer NOT NULL,
    id_coa_parent integer,
    cd_account character varying(16) NOT NULL,
    nm_account character varying(64) NOT NULL,
    coa_type integer NOT NULL,
    normal_balance character(1) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2271 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN coa.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN coa.create_by IS 'id of user creator';


--
-- TOC entry 2272 (class 0 OID 0)
-- Dependencies: 184
-- Name: COLUMN coa.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN coa.update_by IS 'id of user creator';


--
-- TOC entry 183 (class 1259 OID 39246)
-- Dependencies: 6 184
-- Name: coa_id_coa_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE coa_id_coa_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2273 (class 0 OID 0)
-- Dependencies: 183
-- Name: coa_id_coa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE coa_id_coa_seq OWNED BY coa.id_coa;


--
-- TOC entry 216 (class 1259 OID 39407)
-- Dependencies: 6
-- Name: cogs; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE cogs (
    id_product integer NOT NULL,
    id_uom integer NOT NULL,
    cogs double precision NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2274 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN cogs.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN cogs.create_by IS 'id of user creator';


--
-- TOC entry 2275 (class 0 OID 0)
-- Dependencies: 216
-- Name: COLUMN cogs.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN cogs.update_by IS 'id of user creator';


--
-- TOC entry 196 (class 1259 OID 39310)
-- Dependencies: 2080 6
-- Name: customer; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE customer (
    id_customer integer NOT NULL,
    cd_cust character varying(13) NOT NULL,
    nm_cust character varying(64) NOT NULL,
    contact_name character varying(64),
    contact_number character varying(64),
    status smallint DEFAULT 1 NOT NULL,
    update_by integer NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    create_date timestamp without time zone NOT NULL
);


--
-- TOC entry 2276 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN customer.status; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN customer.status IS 'active (1) , inactive(0), delete(-1)';


--
-- TOC entry 2277 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN customer.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN customer.update_by IS 'id of user creator';


--
-- TOC entry 2278 (class 0 OID 0)
-- Dependencies: 196
-- Name: COLUMN customer.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN customer.create_by IS 'id of user creator';


--
-- TOC entry 197 (class 1259 OID 39318)
-- Dependencies: 6
-- Name: customer_detail; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE customer_detail (
    id_customer integer NOT NULL,
    id_distric integer NOT NULL,
    addr1 character varying(128) NOT NULL,
    addr2 character varying(128),
    latitude double precision,
    longtitude double precision,
    id_kab integer,
    id_kec integer,
    id_kel integer,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2279 (class 0 OID 0)
-- Dependencies: 197
-- Name: COLUMN customer_detail.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN customer_detail.create_by IS 'id of user creator';


--
-- TOC entry 2280 (class 0 OID 0)
-- Dependencies: 197
-- Name: COLUMN customer_detail.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN customer_detail.update_by IS 'id of user creator';


--
-- TOC entry 195 (class 1259 OID 39308)
-- Dependencies: 6 196
-- Name: customer_id_customer_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE customer_id_customer_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2281 (class 0 OID 0)
-- Dependencies: 195
-- Name: customer_id_customer_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE customer_id_customer_seq OWNED BY customer.id_customer;


--
-- TOC entry 180 (class 1259 OID 39232)
-- Dependencies: 6
-- Name: entri_sheet; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE entri_sheet (
    id_esheet integer NOT NULL,
    cd_esheet character varying(4) NOT NULL,
    nm_esheet character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2282 (class 0 OID 0)
-- Dependencies: 180
-- Name: COLUMN entri_sheet.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN entri_sheet.create_by IS 'id of user creator';


--
-- TOC entry 2283 (class 0 OID 0)
-- Dependencies: 180
-- Name: COLUMN entri_sheet.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN entri_sheet.update_by IS 'id of user creator';


--
-- TOC entry 185 (class 1259 OID 39255)
-- Dependencies: 6
-- Name: entri_sheet_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE entri_sheet_dtl (
    id_esheet integer NOT NULL,
    nm_esheet_dtl character varying NOT NULL,
    id_coa integer NOT NULL
);


--
-- TOC entry 179 (class 1259 OID 39230)
-- Dependencies: 180 6
-- Name: entri_sheet_id_esheet_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE entri_sheet_id_esheet_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2284 (class 0 OID 0)
-- Dependencies: 179
-- Name: entri_sheet_id_esheet_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE entri_sheet_id_esheet_seq OWNED BY entri_sheet.id_esheet;


--
-- TOC entry 203 (class 1259 OID 39345)
-- Dependencies: 6
-- Name: gl_detail; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE gl_detail (
    id_gl_detail integer NOT NULL,
    id_gl integer NOT NULL,
    id_coa integer NOT NULL,
    amount double precision NOT NULL
);


--
-- TOC entry 202 (class 1259 OID 39343)
-- Dependencies: 6 203
-- Name: gl_detail_id_gl_detail_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE gl_detail_id_gl_detail_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2285 (class 0 OID 0)
-- Dependencies: 202
-- Name: gl_detail_id_gl_detail_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE gl_detail_id_gl_detail_seq OWNED BY gl_detail.id_gl_detail;


--
-- TOC entry 201 (class 1259 OID 39334)
-- Dependencies: 6
-- Name: gl_header; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE gl_header (
    id_gl integer NOT NULL,
    gl_date timestamp without time zone NOT NULL,
    gl_num character varying(13) NOT NULL,
    gl_memo character varying(128),
    id_branch integer NOT NULL,
    id_periode integer NOT NULL,
    type_reff integer,
    id_reff integer,
    description character varying NOT NULL,
    status integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2286 (class 0 OID 0)
-- Dependencies: 201
-- Name: COLUMN gl_header.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN gl_header.create_by IS 'id of user creator';


--
-- TOC entry 2287 (class 0 OID 0)
-- Dependencies: 201
-- Name: COLUMN gl_header.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN gl_header.update_by IS 'id of user creator';


--
-- TOC entry 200 (class 1259 OID 39332)
-- Dependencies: 201 6
-- Name: gl_header_id_gl_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE gl_header_id_gl_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2288 (class 0 OID 0)
-- Dependencies: 200
-- Name: gl_header_id_gl_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE gl_header_id_gl_seq OWNED BY gl_header.id_gl;


--
-- TOC entry 170 (class 1259 OID 39176)
-- Dependencies: 6
-- Name: global_config; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE global_config (
    config_group character varying(16) NOT NULL,
    config_name character varying(32) NOT NULL,
    config_value character varying NOT NULL,
    description character varying(128),
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2289 (class 0 OID 0)
-- Dependencies: 170
-- Name: COLUMN global_config.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN global_config.create_by IS 'id of user creator';


--
-- TOC entry 2290 (class 0 OID 0)
-- Dependencies: 170
-- Name: COLUMN global_config.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN global_config.update_by IS 'id of user creator';


--
-- TOC entry 178 (class 1259 OID 39222)
-- Dependencies: 6
-- Name: invoice_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE invoice_dtl (
    id_invoice integer NOT NULL,
    id_reff integer NOT NULL,
    description character varying,
    trans_value double precision NOT NULL
);


--
-- TOC entry 176 (class 1259 OID 39208)
-- Dependencies: 6
-- Name: invoice_hdr; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE invoice_hdr (
    id_invoice integer NOT NULL,
    inv_num character varying NOT NULL,
    type integer NOT NULL,
    inv_date date NOT NULL,
    due_date date NOT NULL,
    id_vendor integer NOT NULL,
    inv_value double precision NOT NULL,
    status integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2291 (class 0 OID 0)
-- Dependencies: 176
-- Name: COLUMN invoice_hdr.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN invoice_hdr.create_by IS 'id of user creator';


--
-- TOC entry 2292 (class 0 OID 0)
-- Dependencies: 176
-- Name: COLUMN invoice_hdr.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN invoice_hdr.update_by IS 'id of user creator';


--
-- TOC entry 175 (class 1259 OID 39206)
-- Dependencies: 6 176
-- Name: invoice_hdr_id_invoice_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE invoice_hdr_id_invoice_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2293 (class 0 OID 0)
-- Dependencies: 175
-- Name: invoice_hdr_id_invoice_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE invoice_hdr_id_invoice_seq OWNED BY invoice_hdr.id_invoice;


--
-- TOC entry 235 (class 1259 OID 39500)
-- Dependencies: 6
-- Name: notice_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE notice_dtl (
    id_transfer integer NOT NULL,
    id_product integer NOT NULL,
    qty_notice double precision NOT NULL,
    id_uom integer NOT NULL
);


--
-- TOC entry 190 (class 1259 OID 39284)
-- Dependencies: 6
-- Name: orgn; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE orgn (
    id_orgn integer NOT NULL,
    cd_orgn character varying(4) NOT NULL,
    nm_orgn character varying(64) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2294 (class 0 OID 0)
-- Dependencies: 190
-- Name: COLUMN orgn.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN orgn.create_by IS 'id of user creator';


--
-- TOC entry 2295 (class 0 OID 0)
-- Dependencies: 190
-- Name: COLUMN orgn.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN orgn.update_by IS 'id of user creator';


--
-- TOC entry 189 (class 1259 OID 39282)
-- Dependencies: 6 190
-- Name: orgn_id_orgn_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE orgn_id_orgn_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2296 (class 0 OID 0)
-- Dependencies: 189
-- Name: orgn_id_orgn_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE orgn_id_orgn_seq OWNED BY orgn.id_orgn;


--
-- TOC entry 174 (class 1259 OID 39197)
-- Dependencies: 6
-- Name: payment; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE payment (
    id_payment integer NOT NULL,
    payment_num character varying NOT NULL,
    payment_type integer NOT NULL,
    payment_date date NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2297 (class 0 OID 0)
-- Dependencies: 174
-- Name: COLUMN payment.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN payment.create_by IS 'id of user creator';


--
-- TOC entry 2298 (class 0 OID 0)
-- Dependencies: 174
-- Name: COLUMN payment.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN payment.update_by IS 'id of user creator';


--
-- TOC entry 177 (class 1259 OID 39217)
-- Dependencies: 6
-- Name: payment_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE payment_dtl (
    id_payment integer NOT NULL,
    id_invoice integer NOT NULL,
    pay_val double precision NOT NULL
);


--
-- TOC entry 173 (class 1259 OID 39195)
-- Dependencies: 6 174
-- Name: payment_id_payment_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE payment_id_payment_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2299 (class 0 OID 0)
-- Dependencies: 173
-- Name: payment_id_payment_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE payment_id_payment_seq OWNED BY payment.id_payment;


--
-- TOC entry 215 (class 1259 OID 39402)
-- Dependencies: 6
-- Name: price; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE price (
    id_product integer NOT NULL,
    id_price_category integer NOT NULL,
    id_uom integer NOT NULL,
    price double precision NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2300 (class 0 OID 0)
-- Dependencies: 215
-- Name: COLUMN price.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN price.create_by IS 'id of user creator';


--
-- TOC entry 2301 (class 0 OID 0)
-- Dependencies: 215
-- Name: COLUMN price.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN price.update_by IS 'id of user creator';


--
-- TOC entry 172 (class 1259 OID 39186)
-- Dependencies: 6
-- Name: price_category; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE price_category (
    id_price_category integer NOT NULL,
    nm_price_category character varying NOT NULL,
    formula character varying NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL,
    create_date timestamp without time zone NOT NULL
);


--
-- TOC entry 2302 (class 0 OID 0)
-- Dependencies: 172
-- Name: COLUMN price_category.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN price_category.create_by IS 'id of user creator';


--
-- TOC entry 2303 (class 0 OID 0)
-- Dependencies: 172
-- Name: COLUMN price_category.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN price_category.update_by IS 'id of user creator';


--
-- TOC entry 171 (class 1259 OID 39184)
-- Dependencies: 6 172
-- Name: price_category_id_price_category_seq_1; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE price_category_id_price_category_seq_1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2304 (class 0 OID 0)
-- Dependencies: 171
-- Name: price_category_id_price_category_seq_1; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE price_category_id_price_category_seq_1 OWNED BY price_category.id_price_category;


--
-- TOC entry 213 (class 1259 OID 39390)
-- Dependencies: 6
-- Name: product; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE product (
    id_product integer NOT NULL,
    cd_product character varying(13) NOT NULL,
    nm_product character varying(64) NOT NULL,
    id_category integer NOT NULL,
    id_group integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2305 (class 0 OID 0)
-- Dependencies: 213
-- Name: TABLE product; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE product IS 'details of product';


--
-- TOC entry 2306 (class 0 OID 0)
-- Dependencies: 213
-- Name: COLUMN product.cd_product; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product.cd_product IS 'product number eg.barcode label';


--
-- TOC entry 2307 (class 0 OID 0)
-- Dependencies: 213
-- Name: COLUMN product.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product.create_by IS 'id of user creator';


--
-- TOC entry 2308 (class 0 OID 0)
-- Dependencies: 213
-- Name: COLUMN product.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product.update_by IS 'id of user creator';


--
-- TOC entry 214 (class 1259 OID 39397)
-- Dependencies: 6
-- Name: product_child; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE product_child (
    barcode character varying(13) NOT NULL,
    id_product integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    update_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_by integer NOT NULL,
    nm_product character varying(64) NOT NULL
);


--
-- TOC entry 2309 (class 0 OID 0)
-- Dependencies: 214
-- Name: COLUMN product_child.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_child.create_by IS 'id of user creator';


--
-- TOC entry 2310 (class 0 OID 0)
-- Dependencies: 214
-- Name: COLUMN product_child.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_child.update_by IS 'id of user creator';


--
-- TOC entry 182 (class 1259 OID 39240)
-- Dependencies: 6
-- Name: product_group; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE product_group (
    id_group integer NOT NULL,
    cd_group character varying(4) NOT NULL,
    nm_group character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2311 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN product_group.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_group.create_by IS 'id of user creator';


--
-- TOC entry 2312 (class 0 OID 0)
-- Dependencies: 182
-- Name: COLUMN product_group.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_group.update_by IS 'id of user creator';


--
-- TOC entry 181 (class 1259 OID 39238)
-- Dependencies: 6 182
-- Name: product_group_id_group_seq_1; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE product_group_id_group_seq_1
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2313 (class 0 OID 0)
-- Dependencies: 181
-- Name: product_group_id_group_seq_1; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE product_group_id_group_seq_1 OWNED BY product_group.id_group;


--
-- TOC entry 212 (class 1259 OID 39388)
-- Dependencies: 6 213
-- Name: product_id_product_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE product_id_product_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2314 (class 0 OID 0)
-- Dependencies: 212
-- Name: product_id_product_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE product_id_product_seq OWNED BY product.id_product;


--
-- TOC entry 238 (class 1259 OID 39512)
-- Dependencies: 6
-- Name: product_stock; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE product_stock (
    id_stock integer NOT NULL,
    id_warehouse integer NOT NULL,
    id_product integer NOT NULL,
    id_uom integer NOT NULL,
    qty_stock double precision NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2315 (class 0 OID 0)
-- Dependencies: 238
-- Name: COLUMN product_stock.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_stock.create_by IS 'id of user creator';


--
-- TOC entry 2316 (class 0 OID 0)
-- Dependencies: 238
-- Name: COLUMN product_stock.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_stock.update_by IS 'id of user creator';


--
-- TOC entry 237 (class 1259 OID 39510)
-- Dependencies: 6 238
-- Name: product_stock_id_stock_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE product_stock_id_stock_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2317 (class 0 OID 0)
-- Dependencies: 237
-- Name: product_stock_id_stock_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE product_stock_id_stock_seq OWNED BY product_stock.id_stock;


--
-- TOC entry 217 (class 1259 OID 39412)
-- Dependencies: 6
-- Name: product_supplier; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE product_supplier (
    id_product integer NOT NULL,
    id_supplier integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2318 (class 0 OID 0)
-- Dependencies: 217
-- Name: COLUMN product_supplier.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_supplier.create_by IS 'id of user creator';


--
-- TOC entry 2319 (class 0 OID 0)
-- Dependencies: 217
-- Name: COLUMN product_supplier.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_supplier.update_by IS 'id of user creator';


--
-- TOC entry 219 (class 1259 OID 39419)
-- Dependencies: 6
-- Name: product_uom; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE product_uom (
    id_puom integer NOT NULL,
    id_product integer NOT NULL,
    id_uom integer NOT NULL,
    isi integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2320 (class 0 OID 0)
-- Dependencies: 219
-- Name: COLUMN product_uom.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_uom.create_by IS 'id of user creator';


--
-- TOC entry 2321 (class 0 OID 0)
-- Dependencies: 219
-- Name: COLUMN product_uom.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN product_uom.update_by IS 'id of user creator';


--
-- TOC entry 218 (class 1259 OID 39417)
-- Dependencies: 219 6
-- Name: product_uom_id_puom_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE product_uom_id_puom_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2322 (class 0 OID 0)
-- Dependencies: 218
-- Name: product_uom_id_puom_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE product_uom_id_puom_seq OWNED BY product_uom.id_puom;


--
-- TOC entry 223 (class 1259 OID 39435)
-- Dependencies: 2096 6
-- Name: purchase_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE purchase_dtl (
    id_purchase_dtl integer NOT NULL,
    id_purchase integer NOT NULL,
    id_product integer NOT NULL,
    id_warehouse integer NOT NULL,
    id_uom integer NOT NULL,
    purch_qty double precision NOT NULL,
    purch_price double precision DEFAULT 0 NOT NULL,
    selling_price double precision NOT NULL
);


--
-- TOC entry 222 (class 1259 OID 39433)
-- Dependencies: 6 223
-- Name: purchase_dtl_id_purchase_dtl_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE purchase_dtl_id_purchase_dtl_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2323 (class 0 OID 0)
-- Dependencies: 222
-- Name: purchase_dtl_id_purchase_dtl_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE purchase_dtl_id_purchase_dtl_seq OWNED BY purchase_dtl.id_purchase_dtl;


--
-- TOC entry 207 (class 1259 OID 39364)
-- Dependencies: 2089 6
-- Name: purchase_hdr; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE purchase_hdr (
    id_purchase integer NOT NULL,
    purchase_num character varying(16) NOT NULL,
    id_supplier integer NOT NULL,
    id_branch integer NOT NULL,
    purchase_date date NOT NULL,
    purchase_value double precision NOT NULL,
    item_discount double precision DEFAULT 0,
    status integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2324 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN purchase_hdr.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN purchase_hdr.create_by IS 'id of user creator';


--
-- TOC entry 2325 (class 0 OID 0)
-- Dependencies: 207
-- Name: COLUMN purchase_hdr.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN purchase_hdr.update_by IS 'id of user creator';


--
-- TOC entry 206 (class 1259 OID 39362)
-- Dependencies: 207 6
-- Name: purchase_hdr_id_purchase_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE purchase_hdr_id_purchase_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2326 (class 0 OID 0)
-- Dependencies: 206
-- Name: purchase_hdr_id_purchase_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE purchase_hdr_id_purchase_seq OWNED BY purchase_hdr.id_purchase;


--
-- TOC entry 225 (class 1259 OID 39444)
-- Dependencies: 2098 2099 6
-- Name: sales_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE sales_dtl (
    id_sales_dtl integer NOT NULL,
    id_sales integer NOT NULL,
    id_product integer NOT NULL,
    id_uom integer NOT NULL,
    id_warehouse integer NOT NULL,
    sales_price double precision NOT NULL,
    sales_qty double precision NOT NULL,
    discount double precision DEFAULT 0,
    cogs double precision NOT NULL,
    tax double precision DEFAULT 0 NOT NULL
);


--
-- TOC entry 224 (class 1259 OID 39442)
-- Dependencies: 6 225
-- Name: sales_dtl_id_sales_dtl_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE sales_dtl_id_sales_dtl_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2327 (class 0 OID 0)
-- Dependencies: 224
-- Name: sales_dtl_id_sales_dtl_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE sales_dtl_id_sales_dtl_seq OWNED BY sales_dtl.id_sales_dtl;


--
-- TOC entry 209 (class 1259 OID 39373)
-- Dependencies: 6
-- Name: sales_hdr; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE sales_hdr (
    id_sales integer NOT NULL,
    sales_num character varying(16) NOT NULL,
    id_branch integer NOT NULL,
    id_customer integer NOT NULL,
    id_cashdrawer integer,
    discount double precision,
    sales_date date NOT NULL,
    status integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2328 (class 0 OID 0)
-- Dependencies: 209
-- Name: COLUMN sales_hdr.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN sales_hdr.create_by IS 'id of user creator';


--
-- TOC entry 2329 (class 0 OID 0)
-- Dependencies: 209
-- Name: COLUMN sales_hdr.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN sales_hdr.update_by IS 'id of user creator';


--
-- TOC entry 208 (class 1259 OID 39371)
-- Dependencies: 6 209
-- Name: sales_hdr_id_sales_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE sales_hdr_id_sales_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2330 (class 0 OID 0)
-- Dependencies: 208
-- Name: sales_hdr_id_sales_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE sales_hdr_id_sales_seq OWNED BY sales_hdr.id_sales;


--
-- TOC entry 228 (class 1259 OID 39463)
-- Dependencies: 6
-- Name: stock_adjusment_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE stock_adjusment_dtl (
    id_adjustment integer NOT NULL,
    id_product integer NOT NULL,
    id_uom integer NOT NULL,
    qty double precision NOT NULL,
    item_value double precision NOT NULL
);


--
-- TOC entry 227 (class 1259 OID 39454)
-- Dependencies: 6
-- Name: stock_adjustment; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE stock_adjustment (
    id_adjustment integer NOT NULL,
    adjusment_num character varying NOT NULL,
    id_warehouse integer NOT NULL,
    adjusment_date date NOT NULL,
    status integer NOT NULL,
    id_reff character varying NOT NULL,
    description character varying,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2331 (class 0 OID 0)
-- Dependencies: 227
-- Name: COLUMN stock_adjustment.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN stock_adjustment.create_by IS 'id of user creator';


--
-- TOC entry 2332 (class 0 OID 0)
-- Dependencies: 227
-- Name: COLUMN stock_adjustment.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN stock_adjustment.update_by IS 'id of user creator';


--
-- TOC entry 226 (class 1259 OID 39452)
-- Dependencies: 6 227
-- Name: stock_adjustment_id_adjustment_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE stock_adjustment_id_adjustment_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2333 (class 0 OID 0)
-- Dependencies: 226
-- Name: stock_adjustment_id_adjustment_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE stock_adjustment_id_adjustment_seq OWNED BY stock_adjustment.id_adjustment;


--
-- TOC entry 230 (class 1259 OID 39470)
-- Dependencies: 6
-- Name: stock_opname; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE stock_opname (
    id_opname integer NOT NULL,
    opname_num character varying NOT NULL,
    id_warehouse integer NOT NULL,
    opname_date date NOT NULL,
    description character varying,
    status integer NOT NULL,
    operator1 character varying NOT NULL,
    operator2 character varying,
    operator3 character varying,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2334 (class 0 OID 0)
-- Dependencies: 230
-- Name: COLUMN stock_opname.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN stock_opname.create_by IS 'id of user creator';


--
-- TOC entry 2335 (class 0 OID 0)
-- Dependencies: 230
-- Name: COLUMN stock_opname.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN stock_opname.update_by IS 'id of user creator';


--
-- TOC entry 231 (class 1259 OID 39479)
-- Dependencies: 6
-- Name: stock_opname_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE stock_opname_dtl (
    id_opname integer NOT NULL,
    id_product integer NOT NULL,
    id_uom integer NOT NULL,
    qty double precision NOT NULL
);


--
-- TOC entry 229 (class 1259 OID 39468)
-- Dependencies: 230 6
-- Name: stock_opname_id_opname_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE stock_opname_id_opname_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2336 (class 0 OID 0)
-- Dependencies: 229
-- Name: stock_opname_id_opname_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE stock_opname_id_opname_seq OWNED BY stock_opname.id_opname;


--
-- TOC entry 194 (class 1259 OID 39301)
-- Dependencies: 6
-- Name: supplier; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE supplier (
    id_supplier integer NOT NULL,
    cd_supplier character varying(4) NOT NULL,
    nm_supplier character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2337 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN supplier.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN supplier.create_by IS 'id of user creator';


--
-- TOC entry 2338 (class 0 OID 0)
-- Dependencies: 194
-- Name: COLUMN supplier.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN supplier.update_by IS 'id of user creator';


--
-- TOC entry 193 (class 1259 OID 39299)
-- Dependencies: 194 6
-- Name: supplier_id_supplier_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE supplier_id_supplier_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2339 (class 0 OID 0)
-- Dependencies: 193
-- Name: supplier_id_supplier_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE supplier_id_supplier_seq OWNED BY supplier.id_supplier;


--
-- TOC entry 236 (class 1259 OID 39505)
-- Dependencies: 6
-- Name: transfer_dtl; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE transfer_dtl (
    id_transfer integer NOT NULL,
    id_product integer NOT NULL,
    transfer_qty_send double precision NOT NULL,
    transfer_qty_receive double precision,
    id_uom integer NOT NULL
);


--
-- TOC entry 233 (class 1259 OID 39486)
-- Dependencies: 6
-- Name: transfer_hdr; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE transfer_hdr (
    id_transfer integer NOT NULL,
    transfer_num character varying(16) NOT NULL,
    id_warehouse_source integer NOT NULL,
    id_warehouse_dest integer NOT NULL,
    transfer_date date NOT NULL,
    receive_date date,
    status integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2340 (class 0 OID 0)
-- Dependencies: 233
-- Name: COLUMN transfer_hdr.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN transfer_hdr.create_by IS 'id of user creator';


--
-- TOC entry 2341 (class 0 OID 0)
-- Dependencies: 233
-- Name: COLUMN transfer_hdr.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN transfer_hdr.update_by IS 'id of user creator';


--
-- TOC entry 232 (class 1259 OID 39484)
-- Dependencies: 6 233
-- Name: transfer_hdr_id_transfer_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE transfer_hdr_id_transfer_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2342 (class 0 OID 0)
-- Dependencies: 232
-- Name: transfer_hdr_id_transfer_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE transfer_hdr_id_transfer_seq OWNED BY transfer_hdr.id_transfer;


--
-- TOC entry 234 (class 1259 OID 39492)
-- Dependencies: 6
-- Name: transfer_notice; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE transfer_notice (
    id_transfer integer NOT NULL,
    notice_date date NOT NULL,
    description character varying NOT NULL,
    status integer NOT NULL,
    update_by integer NOT NULL,
    create_by integer NOT NULL,
    create_date timestamp without time zone NOT NULL,
    update_date timestamp without time zone NOT NULL
);


--
-- TOC entry 2343 (class 0 OID 0)
-- Dependencies: 234
-- Name: COLUMN transfer_notice.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN transfer_notice.update_by IS 'id of user creator';


--
-- TOC entry 2344 (class 0 OID 0)
-- Dependencies: 234
-- Name: COLUMN transfer_notice.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN transfer_notice.create_by IS 'id of user creator';


--
-- TOC entry 192 (class 1259 OID 39292)
-- Dependencies: 6
-- Name: uom; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE uom (
    id_uom integer NOT NULL,
    cd_uom character varying(4) NOT NULL,
    nm_uom character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2345 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN uom.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN uom.create_by IS 'id of user creator';


--
-- TOC entry 2346 (class 0 OID 0)
-- Dependencies: 192
-- Name: COLUMN uom.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN uom.update_by IS 'id of user creator';


--
-- TOC entry 191 (class 1259 OID 39290)
-- Dependencies: 192 6
-- Name: uom_id_uom_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE uom_id_uom_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2347 (class 0 OID 0)
-- Dependencies: 191
-- Name: uom_id_uom_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE uom_id_uom_seq OWNED BY uom.id_uom;


--
-- TOC entry 221 (class 1259 OID 39427)
-- Dependencies: 6
-- Name: warehouse; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE warehouse (
    id_warehouse integer NOT NULL,
    id_branch integer NOT NULL,
    cd_whse character varying(4) NOT NULL,
    nm_whse character varying(32) NOT NULL,
    create_date timestamp without time zone NOT NULL,
    create_by integer NOT NULL,
    update_date timestamp without time zone NOT NULL,
    update_by integer NOT NULL
);


--
-- TOC entry 2348 (class 0 OID 0)
-- Dependencies: 221
-- Name: TABLE warehouse; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON TABLE warehouse IS 'Warehouse table';


--
-- TOC entry 2349 (class 0 OID 0)
-- Dependencies: 221
-- Name: COLUMN warehouse.create_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN warehouse.create_by IS 'id of user creator';


--
-- TOC entry 2350 (class 0 OID 0)
-- Dependencies: 221
-- Name: COLUMN warehouse.update_by; Type: COMMENT; Schema: public; Owner: -
--

COMMENT ON COLUMN warehouse.update_by IS 'id of user creator';


--
-- TOC entry 220 (class 1259 OID 39425)
-- Dependencies: 221 6
-- Name: warehouse_id_warehouse_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE warehouse_id_warehouse_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 2351 (class 0 OID 0)
-- Dependencies: 220
-- Name: warehouse_id_warehouse_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE warehouse_id_warehouse_seq OWNED BY warehouse.id_warehouse;


--
-- TOC entry 2074 (class 2604 OID 39278)
-- Dependencies: 187 188 188
-- Name: id_periode; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY acc_periode ALTER COLUMN id_periode SET DEFAULT nextval('acc_periode_id_periode_seq_1'::regclass);


--
-- TOC entry 2081 (class 2604 OID 39328)
-- Dependencies: 198 199 199
-- Name: id_branch; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY branch ALTER COLUMN id_branch SET DEFAULT nextval('branch_id_branch_seq'::regclass);


--
-- TOC entry 2084 (class 2604 OID 39356)
-- Dependencies: 204 205 205
-- Name: id_cashdrawer; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY cashdrawer ALTER COLUMN id_cashdrawer SET DEFAULT nextval('cashdrawer_id_cashdrawer_seq_1'::regclass);


--
-- TOC entry 2091 (class 2604 OID 39384)
-- Dependencies: 210 211 211
-- Name: id_category; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY category ALTER COLUMN id_category SET DEFAULT nextval('category_id_category_seq'::regclass);


--
-- TOC entry 2072 (class 2604 OID 39251)
-- Dependencies: 183 184 184
-- Name: id_coa; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY coa ALTER COLUMN id_coa SET DEFAULT nextval('coa_id_coa_seq'::regclass);


--
-- TOC entry 2079 (class 2604 OID 39313)
-- Dependencies: 195 196 196
-- Name: id_customer; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY customer ALTER COLUMN id_customer SET DEFAULT nextval('customer_id_customer_seq'::regclass);


--
-- TOC entry 2070 (class 2604 OID 39235)
-- Dependencies: 179 180 180
-- Name: id_esheet; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY entri_sheet ALTER COLUMN id_esheet SET DEFAULT nextval('entri_sheet_id_esheet_seq'::regclass);


--
-- TOC entry 2083 (class 2604 OID 39348)
-- Dependencies: 203 202 203
-- Name: id_gl_detail; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY gl_detail ALTER COLUMN id_gl_detail SET DEFAULT nextval('gl_detail_id_gl_detail_seq'::regclass);


--
-- TOC entry 2082 (class 2604 OID 39337)
-- Dependencies: 201 200 201
-- Name: id_gl; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY gl_header ALTER COLUMN id_gl SET DEFAULT nextval('gl_header_id_gl_seq'::regclass);


--
-- TOC entry 2069 (class 2604 OID 39211)
-- Dependencies: 176 175 176
-- Name: id_invoice; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY invoice_hdr ALTER COLUMN id_invoice SET DEFAULT nextval('invoice_hdr_id_invoice_seq'::regclass);


--
-- TOC entry 2076 (class 2604 OID 39287)
-- Dependencies: 189 190 190
-- Name: id_orgn; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY orgn ALTER COLUMN id_orgn SET DEFAULT nextval('orgn_id_orgn_seq'::regclass);


--
-- TOC entry 2068 (class 2604 OID 39200)
-- Dependencies: 174 173 174
-- Name: id_payment; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY payment ALTER COLUMN id_payment SET DEFAULT nextval('payment_id_payment_seq'::regclass);


--
-- TOC entry 2067 (class 2604 OID 39189)
-- Dependencies: 172 171 172
-- Name: id_price_category; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY price_category ALTER COLUMN id_price_category SET DEFAULT nextval('price_category_id_price_category_seq_1'::regclass);


--
-- TOC entry 2092 (class 2604 OID 39393)
-- Dependencies: 213 212 213
-- Name: id_product; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY product ALTER COLUMN id_product SET DEFAULT nextval('product_id_product_seq'::regclass);


--
-- TOC entry 2071 (class 2604 OID 39243)
-- Dependencies: 181 182 182
-- Name: id_group; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_group ALTER COLUMN id_group SET DEFAULT nextval('product_group_id_group_seq_1'::regclass);


--
-- TOC entry 2103 (class 2604 OID 39515)
-- Dependencies: 238 237 238
-- Name: id_stock; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_stock ALTER COLUMN id_stock SET DEFAULT nextval('product_stock_id_stock_seq'::regclass);


--
-- TOC entry 2093 (class 2604 OID 39422)
-- Dependencies: 219 218 219
-- Name: id_puom; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_uom ALTER COLUMN id_puom SET DEFAULT nextval('product_uom_id_puom_seq'::regclass);


--
-- TOC entry 2095 (class 2604 OID 39438)
-- Dependencies: 222 223 223
-- Name: id_purchase_dtl; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_dtl ALTER COLUMN id_purchase_dtl SET DEFAULT nextval('purchase_dtl_id_purchase_dtl_seq'::regclass);


--
-- TOC entry 2088 (class 2604 OID 39367)
-- Dependencies: 207 206 207
-- Name: id_purchase; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_hdr ALTER COLUMN id_purchase SET DEFAULT nextval('purchase_hdr_id_purchase_seq'::regclass);


--
-- TOC entry 2097 (class 2604 OID 39447)
-- Dependencies: 225 224 225
-- Name: id_sales_dtl; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_dtl ALTER COLUMN id_sales_dtl SET DEFAULT nextval('sales_dtl_id_sales_dtl_seq'::regclass);


--
-- TOC entry 2090 (class 2604 OID 39376)
-- Dependencies: 209 208 209
-- Name: id_sales; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_hdr ALTER COLUMN id_sales SET DEFAULT nextval('sales_hdr_id_sales_seq'::regclass);


--
-- TOC entry 2100 (class 2604 OID 39457)
-- Dependencies: 227 226 227
-- Name: id_adjustment; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_adjustment ALTER COLUMN id_adjustment SET DEFAULT nextval('stock_adjustment_id_adjustment_seq'::regclass);


--
-- TOC entry 2101 (class 2604 OID 39473)
-- Dependencies: 230 229 230
-- Name: id_opname; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_opname ALTER COLUMN id_opname SET DEFAULT nextval('stock_opname_id_opname_seq'::regclass);


--
-- TOC entry 2078 (class 2604 OID 39304)
-- Dependencies: 194 193 194
-- Name: id_supplier; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY supplier ALTER COLUMN id_supplier SET DEFAULT nextval('supplier_id_supplier_seq'::regclass);


--
-- TOC entry 2102 (class 2604 OID 39489)
-- Dependencies: 233 232 233
-- Name: id_transfer; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_hdr ALTER COLUMN id_transfer SET DEFAULT nextval('transfer_hdr_id_transfer_seq'::regclass);


--
-- TOC entry 2077 (class 2604 OID 39295)
-- Dependencies: 191 192 192
-- Name: id_uom; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY uom ALTER COLUMN id_uom SET DEFAULT nextval('uom_id_uom_seq'::regclass);


--
-- TOC entry 2094 (class 2604 OID 39430)
-- Dependencies: 221 220 221
-- Name: id_warehouse; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY warehouse ALTER COLUMN id_warehouse SET DEFAULT nextval('warehouse_id_warehouse_seq'::regclass);


--
-- TOC entry 2129 (class 2606 OID 39281)
-- Dependencies: 188 188 2256
-- Name: acc_periode_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY acc_periode
    ADD CONSTRAINT acc_periode_pk PRIMARY KEY (id_periode);


--
-- TOC entry 2127 (class 2606 OID 39272)
-- Dependencies: 186 186 186 2256
-- Name: auto_number_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY auto_number
    ADD CONSTRAINT auto_number_pk PRIMARY KEY (template_group, template_num);


--
-- TOC entry 2144 (class 2606 OID 39330)
-- Dependencies: 199 199 2256
-- Name: branch_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY branch
    ADD CONSTRAINT branch_pk PRIMARY KEY (id_branch);


--
-- TOC entry 2151 (class 2606 OID 39361)
-- Dependencies: 205 205 2256
-- Name: cashdrawer_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY cashdrawer
    ADD CONSTRAINT cashdrawer_pk PRIMARY KEY (id_cashdrawer);


--
-- TOC entry 2122 (class 2606 OID 39253)
-- Dependencies: 184 184 2256
-- Name: coa_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY coa
    ADD CONSTRAINT coa_pk PRIMARY KEY (id_coa);


--
-- TOC entry 2167 (class 2606 OID 39411)
-- Dependencies: 216 216 2256
-- Name: cogs_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY cogs
    ADD CONSTRAINT cogs_pk PRIMARY KEY (id_product);


--
-- TOC entry 2142 (class 2606 OID 39322)
-- Dependencies: 197 197 2256
-- Name: customer_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY customer_detail
    ADD CONSTRAINT customer_dtl_pk PRIMARY KEY (id_customer);


--
-- TOC entry 2139 (class 2606 OID 39316)
-- Dependencies: 196 196 2256
-- Name: customer_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY customer
    ADD CONSTRAINT customer_pk PRIMARY KEY (id_customer);


--
-- TOC entry 2125 (class 2606 OID 39262)
-- Dependencies: 185 185 185 2256
-- Name: entri_sheet_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY entri_sheet_dtl
    ADD CONSTRAINT entri_sheet_dtl_pk PRIMARY KEY (id_esheet, nm_esheet_dtl);


--
-- TOC entry 2117 (class 2606 OID 39237)
-- Dependencies: 180 180 2256
-- Name: entri_sheet_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY entri_sheet
    ADD CONSTRAINT entri_sheet_pk PRIMARY KEY (id_esheet);


--
-- TOC entry 2149 (class 2606 OID 39350)
-- Dependencies: 203 203 2256
-- Name: gl_detail_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY gl_detail
    ADD CONSTRAINT gl_detail_pk PRIMARY KEY (id_gl_detail);


--
-- TOC entry 2147 (class 2606 OID 39342)
-- Dependencies: 201 201 2256
-- Name: gl_header_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY gl_header
    ADD CONSTRAINT gl_header_pk PRIMARY KEY (id_gl);


--
-- TOC entry 2105 (class 2606 OID 39183)
-- Dependencies: 170 170 170 2256
-- Name: global_config_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY global_config
    ADD CONSTRAINT global_config_pk PRIMARY KEY (config_group, config_name);


--
-- TOC entry 2115 (class 2606 OID 39229)
-- Dependencies: 178 178 178 2256
-- Name: invoice_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY invoice_dtl
    ADD CONSTRAINT invoice_dtl_pk PRIMARY KEY (id_invoice, id_reff);


--
-- TOC entry 2111 (class 2606 OID 39216)
-- Dependencies: 176 176 2256
-- Name: invoice_hdr_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY invoice_hdr
    ADD CONSTRAINT invoice_hdr_pk PRIMARY KEY (id_invoice);


--
-- TOC entry 2191 (class 2606 OID 39504)
-- Dependencies: 235 235 235 2256
-- Name: notice_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY notice_dtl
    ADD CONSTRAINT notice_dtl_pk PRIMARY KEY (id_transfer, id_product);


--
-- TOC entry 2131 (class 2606 OID 39289)
-- Dependencies: 190 190 2256
-- Name: orgn_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY orgn
    ADD CONSTRAINT orgn_pk PRIMARY KEY (id_orgn);


--
-- TOC entry 2157 (class 2606 OID 39386)
-- Dependencies: 211 211 2256
-- Name: p_category_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY category
    ADD CONSTRAINT p_category_pk PRIMARY KEY (id_category);


--
-- TOC entry 2113 (class 2606 OID 39221)
-- Dependencies: 177 177 177 2256
-- Name: payment_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY payment_dtl
    ADD CONSTRAINT payment_dtl_pk PRIMARY KEY (id_payment, id_invoice);


--
-- TOC entry 2109 (class 2606 OID 39205)
-- Dependencies: 174 174 2256
-- Name: payment_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY payment
    ADD CONSTRAINT payment_pk PRIMARY KEY (id_payment);


--
-- TOC entry 2107 (class 2606 OID 39194)
-- Dependencies: 172 172 2256
-- Name: price_category_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY price_category
    ADD CONSTRAINT price_category_pk PRIMARY KEY (id_price_category);


--
-- TOC entry 2165 (class 2606 OID 39406)
-- Dependencies: 215 215 215 2256
-- Name: price_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY price
    ADD CONSTRAINT price_pk PRIMARY KEY (id_product, id_price_category);


--
-- TOC entry 2163 (class 2606 OID 39401)
-- Dependencies: 214 214 2256
-- Name: product_child_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY product_child
    ADD CONSTRAINT product_child_pk PRIMARY KEY (barcode);


--
-- TOC entry 2119 (class 2606 OID 39245)
-- Dependencies: 182 182 2256
-- Name: product_group_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY product_group
    ADD CONSTRAINT product_group_pk PRIMARY KEY (id_group);


--
-- TOC entry 2160 (class 2606 OID 39395)
-- Dependencies: 213 213 2256
-- Name: product_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY product
    ADD CONSTRAINT product_pk PRIMARY KEY (id_product);


--
-- TOC entry 2195 (class 2606 OID 39517)
-- Dependencies: 238 238 2256
-- Name: product_stock_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY product_stock
    ADD CONSTRAINT product_stock_pk PRIMARY KEY (id_stock);


--
-- TOC entry 2169 (class 2606 OID 39416)
-- Dependencies: 217 217 217 2256
-- Name: product_supplier_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY product_supplier
    ADD CONSTRAINT product_supplier_pk PRIMARY KEY (id_product, id_supplier);


--
-- TOC entry 2171 (class 2606 OID 39424)
-- Dependencies: 219 219 2256
-- Name: product_uom_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY product_uom
    ADD CONSTRAINT product_uom_pk PRIMARY KEY (id_puom);


--
-- TOC entry 2175 (class 2606 OID 39441)
-- Dependencies: 223 223 2256
-- Name: purchase_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY purchase_dtl
    ADD CONSTRAINT purchase_dtl_pk PRIMARY KEY (id_purchase_dtl);


--
-- TOC entry 2153 (class 2606 OID 39370)
-- Dependencies: 207 207 2256
-- Name: purchase_hdr_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY purchase_hdr
    ADD CONSTRAINT purchase_hdr_pk PRIMARY KEY (id_purchase);


--
-- TOC entry 2177 (class 2606 OID 39451)
-- Dependencies: 225 225 2256
-- Name: sales_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY sales_dtl
    ADD CONSTRAINT sales_dtl_pk PRIMARY KEY (id_sales_dtl);


--
-- TOC entry 2155 (class 2606 OID 39378)
-- Dependencies: 209 209 2256
-- Name: sales_hdr_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY sales_hdr
    ADD CONSTRAINT sales_hdr_pk PRIMARY KEY (id_sales);


--
-- TOC entry 2181 (class 2606 OID 39467)
-- Dependencies: 228 228 228 228 2256
-- Name: stock_adjusment_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY stock_adjusment_dtl
    ADD CONSTRAINT stock_adjusment_dtl_pk PRIMARY KEY (id_adjustment, id_product, id_uom);


--
-- TOC entry 2179 (class 2606 OID 39462)
-- Dependencies: 227 227 2256
-- Name: stock_adjustment_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY stock_adjustment
    ADD CONSTRAINT stock_adjustment_pk PRIMARY KEY (id_adjustment);


--
-- TOC entry 2185 (class 2606 OID 39483)
-- Dependencies: 231 231 231 231 2256
-- Name: stock_opname_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY stock_opname_dtl
    ADD CONSTRAINT stock_opname_dtl_pk PRIMARY KEY (id_opname, id_product, id_uom);


--
-- TOC entry 2183 (class 2606 OID 39478)
-- Dependencies: 230 230 2256
-- Name: stock_opname_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY stock_opname
    ADD CONSTRAINT stock_opname_pk PRIMARY KEY (id_opname);


--
-- TOC entry 2136 (class 2606 OID 39306)
-- Dependencies: 194 194 2256
-- Name: supplier_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY supplier
    ADD CONSTRAINT supplier_pk PRIMARY KEY (id_supplier);


--
-- TOC entry 2193 (class 2606 OID 39509)
-- Dependencies: 236 236 236 2256
-- Name: transfer_dtl_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY transfer_dtl
    ADD CONSTRAINT transfer_dtl_pk PRIMARY KEY (id_transfer, id_product);


--
-- TOC entry 2187 (class 2606 OID 39491)
-- Dependencies: 233 233 2256
-- Name: transfer_hdr_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY transfer_hdr
    ADD CONSTRAINT transfer_hdr_pk PRIMARY KEY (id_transfer);


--
-- TOC entry 2189 (class 2606 OID 39499)
-- Dependencies: 234 234 2256
-- Name: transfer_notice_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY transfer_notice
    ADD CONSTRAINT transfer_notice_pk PRIMARY KEY (id_transfer);


--
-- TOC entry 2133 (class 2606 OID 39297)
-- Dependencies: 192 192 2256
-- Name: uom_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY uom
    ADD CONSTRAINT uom_pk PRIMARY KEY (id_uom);


--
-- TOC entry 2173 (class 2606 OID 39432)
-- Dependencies: 221 221 2256
-- Name: warehouse_pk; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY warehouse
    ADD CONSTRAINT warehouse_pk PRIMARY KEY (id_warehouse);


--
-- TOC entry 2145 (class 1259 OID 39331)
-- Dependencies: 199 2256
-- Name: branch_ucode; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX branch_ucode ON branch USING btree (cd_branch);


--
-- TOC entry 2120 (class 1259 OID 39254)
-- Dependencies: 184 2256
-- Name: coa_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX coa_idx ON coa USING btree (cd_account);


--
-- TOC entry 2123 (class 1259 OID 39263)
-- Dependencies: 185 185 2256
-- Name: entri_sheet_dtl_idx; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX entri_sheet_dtl_idx ON entri_sheet_dtl USING btree (id_esheet, id_coa);


--
-- TOC entry 2158 (class 1259 OID 39387)
-- Dependencies: 211 2256
-- Name: product_category_ucode; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX product_category_ucode ON category USING btree (cd_category);


--
-- TOC entry 2161 (class 1259 OID 39396)
-- Dependencies: 213 2256
-- Name: product_ucode; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX product_ucode ON product USING btree (cd_product);


--
-- TOC entry 2137 (class 1259 OID 39307)
-- Dependencies: 194 2256
-- Name: supplier_ucode; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX supplier_ucode ON supplier USING btree (cd_supplier);


--
-- TOC entry 2140 (class 1259 OID 39317)
-- Dependencies: 196 2256
-- Name: unique_cd_cust; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX unique_cd_cust ON customer USING btree (cd_cust);


--
-- TOC entry 2134 (class 1259 OID 39298)
-- Dependencies: 192 2256
-- Name: uoms_unique_code; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE UNIQUE INDEX uoms_unique_code ON uom USING btree (cd_uom);


--
-- TOC entry 2204 (class 2606 OID 39563)
-- Dependencies: 2128 188 201 2256
-- Name: acc_periode_gl_header_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY gl_header
    ADD CONSTRAINT acc_periode_gl_header_fk FOREIGN KEY (id_periode) REFERENCES acc_periode(id_periode);


--
-- TOC entry 2208 (class 2606 OID 39658)
-- Dependencies: 2143 199 205 2256
-- Name: branch_cashdrawer_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY cashdrawer
    ADD CONSTRAINT branch_cashdrawer_fk FOREIGN KEY (id_branch) REFERENCES branch(id_branch);


--
-- TOC entry 2205 (class 2606 OID 39663)
-- Dependencies: 2143 199 201 2256
-- Name: branch_gl_header_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY gl_header
    ADD CONSTRAINT branch_gl_header_fk FOREIGN KEY (id_branch) REFERENCES branch(id_branch);


--
-- TOC entry 2210 (class 2606 OID 39653)
-- Dependencies: 207 2143 199 2256
-- Name: branch_purchase_hdr_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_hdr
    ADD CONSTRAINT branch_purchase_hdr_fk FOREIGN KEY (id_branch) REFERENCES branch(id_branch);


--
-- TOC entry 2212 (class 2606 OID 39648)
-- Dependencies: 2143 199 209 2256
-- Name: branch_sales_hdr_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_hdr
    ADD CONSTRAINT branch_sales_hdr_fk FOREIGN KEY (id_branch) REFERENCES branch(id_branch);


--
-- TOC entry 2226 (class 2606 OID 39643)
-- Dependencies: 221 199 2143 2256
-- Name: branch_warehouse_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY warehouse
    ADD CONSTRAINT branch_warehouse_fk FOREIGN KEY (id_branch) REFERENCES branch(id_branch);


--
-- TOC entry 2213 (class 2606 OID 39673)
-- Dependencies: 209 2150 205 2256
-- Name: cashdrawer_sales_hdr_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_hdr
    ADD CONSTRAINT cashdrawer_sales_hdr_fk FOREIGN KEY (id_cashdrawer) REFERENCES cashdrawer(id_cashdrawer);


--
-- TOC entry 2199 (class 2606 OID 39548)
-- Dependencies: 2121 184 184 2256
-- Name: coa_coa_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY coa
    ADD CONSTRAINT coa_coa_fk FOREIGN KEY (id_coa_parent) REFERENCES coa(id_coa) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2206 (class 2606 OID 39553)
-- Dependencies: 184 2121 203 2256
-- Name: coa_gl_detail_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY gl_detail
    ADD CONSTRAINT coa_gl_detail_fk FOREIGN KEY (id_coa) REFERENCES coa(id_coa) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- TOC entry 2201 (class 2606 OID 39558)
-- Dependencies: 184 185 2121 2256
-- Name: coa_new_table_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY entri_sheet_dtl
    ADD CONSTRAINT coa_new_table_fk FOREIGN KEY (id_coa) REFERENCES coa(id_coa);


--
-- TOC entry 2211 (class 2606 OID 39638)
-- Dependencies: 209 2138 196 2256
-- Name: customer_sales_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_hdr
    ADD CONSTRAINT customer_sales_fk FOREIGN KEY (id_customer) REFERENCES customer(id_customer);


--
-- TOC entry 2202 (class 2606 OID 39633)
-- Dependencies: 2138 196 197 2256
-- Name: customers_customer_detail_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY customer_detail
    ADD CONSTRAINT customers_customer_detail_fk FOREIGN KEY (id_customer) REFERENCES customer(id_customer);


--
-- TOC entry 2200 (class 2606 OID 39538)
-- Dependencies: 185 180 2116 2256
-- Name: entri_sheet_new_table_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY entri_sheet_dtl
    ADD CONSTRAINT entri_sheet_new_table_fk FOREIGN KEY (id_esheet) REFERENCES entri_sheet(id_esheet);


--
-- TOC entry 2207 (class 2606 OID 39668)
-- Dependencies: 201 203 2146 2256
-- Name: gl_header_gl_detail_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY gl_detail
    ADD CONSTRAINT gl_header_gl_detail_fk FOREIGN KEY (id_gl) REFERENCES gl_header(id_gl);


--
-- TOC entry 2214 (class 2606 OID 39543)
-- Dependencies: 2118 213 182 2256
-- Name: group_product_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product
    ADD CONSTRAINT group_product_fk FOREIGN KEY (id_group) REFERENCES product_group(id_group);


--
-- TOC entry 2198 (class 2606 OID 39528)
-- Dependencies: 178 2110 176 2256
-- Name: invoice_hdr_invoice_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY invoice_dtl
    ADD CONSTRAINT invoice_hdr_invoice_dtl_fk FOREIGN KEY (id_invoice) REFERENCES invoice_hdr(id_invoice);


--
-- TOC entry 2197 (class 2606 OID 39533)
-- Dependencies: 2110 176 177 2256
-- Name: invoice_hdr_payment_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY payment_dtl
    ADD CONSTRAINT invoice_hdr_payment_dtl_fk FOREIGN KEY (id_invoice) REFERENCES invoice_hdr(id_invoice);


--
-- TOC entry 2203 (class 2606 OID 39568)
-- Dependencies: 190 199 2130 2256
-- Name: org_branch_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY branch
    ADD CONSTRAINT org_branch_fk FOREIGN KEY (id_orgn) REFERENCES orgn(id_orgn);


--
-- TOC entry 2196 (class 2606 OID 39523)
-- Dependencies: 177 174 2108 2256
-- Name: payment_payment_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY payment_dtl
    ADD CONSTRAINT payment_payment_dtl_fk FOREIGN KEY (id_payment) REFERENCES payment(id_payment);


--
-- TOC entry 2217 (class 2606 OID 39518)
-- Dependencies: 215 2106 172 2256
-- Name: price_category_price_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY price
    ADD CONSTRAINT price_category_price_fk FOREIGN KEY (id_price_category) REFERENCES price_category(id_price_category);


--
-- TOC entry 2215 (class 2606 OID 39688)
-- Dependencies: 2156 213 211 2256
-- Name: product_category_product_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product
    ADD CONSTRAINT product_category_product_fk FOREIGN KEY (id_category) REFERENCES category(id_category);


--
-- TOC entry 2221 (class 2606 OID 39713)
-- Dependencies: 216 2159 213 2256
-- Name: product_cogs_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY cogs
    ADD CONSTRAINT product_cogs_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2247 (class 2606 OID 39748)
-- Dependencies: 213 2159 235 2256
-- Name: product_notice_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY notice_dtl
    ADD CONSTRAINT product_notice_dtl_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2219 (class 2606 OID 39728)
-- Dependencies: 2159 213 215 2256
-- Name: product_price_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY price
    ADD CONSTRAINT product_price_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2216 (class 2606 OID 39743)
-- Dependencies: 213 214 2159 2256
-- Name: product_product_child_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_child
    ADD CONSTRAINT product_product_child_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2253 (class 2606 OID 39708)
-- Dependencies: 238 2159 213 2256
-- Name: product_product_stock_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_stock
    ADD CONSTRAINT product_product_stock_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2223 (class 2606 OID 39698)
-- Dependencies: 217 2159 213 2256
-- Name: product_product_supplier_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_supplier
    ADD CONSTRAINT product_product_supplier_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2225 (class 2606 OID 39693)
-- Dependencies: 219 2159 213 2256
-- Name: product_product_uoms_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_uom
    ADD CONSTRAINT product_product_uoms_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2229 (class 2606 OID 39703)
-- Dependencies: 2159 213 223 2256
-- Name: product_purchase_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_dtl
    ADD CONSTRAINT product_purchase_dtl_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2233 (class 2606 OID 39723)
-- Dependencies: 2159 213 225 2256
-- Name: product_sales_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_dtl
    ADD CONSTRAINT product_sales_dtl_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2237 (class 2606 OID 39738)
-- Dependencies: 213 228 2159 2256
-- Name: product_stock_adjusment_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_adjusment_dtl
    ADD CONSTRAINT product_stock_adjusment_dtl_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2241 (class 2606 OID 39733)
-- Dependencies: 2159 213 231 2256
-- Name: product_stock_opname_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_opname_dtl
    ADD CONSTRAINT product_stock_opname_dtl_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2250 (class 2606 OID 39718)
-- Dependencies: 2159 236 213 2256
-- Name: product_transfer_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_dtl
    ADD CONSTRAINT product_transfer_dtl_fk FOREIGN KEY (id_product) REFERENCES product(id_product);


--
-- TOC entry 2228 (class 2606 OID 39678)
-- Dependencies: 207 2152 223 2256
-- Name: purchase_hdr_purchase_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_dtl
    ADD CONSTRAINT purchase_hdr_purchase_dtl_fk FOREIGN KEY (id_purchase) REFERENCES purchase_hdr(id_purchase);


--
-- TOC entry 2232 (class 2606 OID 39683)
-- Dependencies: 225 2154 209 2256
-- Name: sales_hdr_sales_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_dtl
    ADD CONSTRAINT sales_hdr_sales_dtl_fk FOREIGN KEY (id_sales) REFERENCES sales_hdr(id_sales);


--
-- TOC entry 2238 (class 2606 OID 39788)
-- Dependencies: 228 2178 227 2256
-- Name: stock_adjustment_stock_adjusment_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_adjusment_dtl
    ADD CONSTRAINT stock_adjustment_stock_adjusment_dtl_fk FOREIGN KEY (id_adjustment) REFERENCES stock_adjustment(id_adjustment);


--
-- TOC entry 2242 (class 2606 OID 39793)
-- Dependencies: 2182 231 230 2256
-- Name: stock_opname_stock_opname_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_opname_dtl
    ADD CONSTRAINT stock_opname_stock_opname_dtl_fk FOREIGN KEY (id_opname) REFERENCES stock_opname(id_opname);


--
-- TOC entry 2222 (class 2606 OID 39623)
-- Dependencies: 2135 217 194 2256
-- Name: supplier_product_supplier_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_supplier
    ADD CONSTRAINT supplier_product_supplier_fk FOREIGN KEY (id_supplier) REFERENCES supplier(id_supplier);


--
-- TOC entry 2209 (class 2606 OID 39628)
-- Dependencies: 207 194 2135 2256
-- Name: supplier_purchase_hdr_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_hdr
    ADD CONSTRAINT supplier_purchase_hdr_fk FOREIGN KEY (id_supplier) REFERENCES supplier(id_supplier);


--
-- TOC entry 2251 (class 2606 OID 39798)
-- Dependencies: 233 2186 236 2256
-- Name: transfer_hdr_transfer_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_dtl
    ADD CONSTRAINT transfer_hdr_transfer_dtl_fk FOREIGN KEY (id_transfer) REFERENCES transfer_hdr(id_transfer);


--
-- TOC entry 2245 (class 2606 OID 39803)
-- Dependencies: 234 233 2186 2256
-- Name: transfer_hdr_transfer_notice_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_notice
    ADD CONSTRAINT transfer_hdr_transfer_notice_fk FOREIGN KEY (id_transfer) REFERENCES transfer_hdr(id_transfer);


--
-- TOC entry 2248 (class 2606 OID 39808)
-- Dependencies: 235 2188 234 2256
-- Name: transfer_notice_notice_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY notice_dtl
    ADD CONSTRAINT transfer_notice_notice_dtl_fk FOREIGN KEY (id_transfer) REFERENCES transfer_notice(id_transfer);


--
-- TOC entry 2220 (class 2606 OID 39588)
-- Dependencies: 2132 192 216 2256
-- Name: uom_cogs_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY cogs
    ADD CONSTRAINT uom_cogs_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2246 (class 2606 OID 39618)
-- Dependencies: 2132 235 192 2256
-- Name: uom_notice_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY notice_dtl
    ADD CONSTRAINT uom_notice_dtl_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2218 (class 2606 OID 39603)
-- Dependencies: 2132 215 192 2256
-- Name: uom_price_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY price
    ADD CONSTRAINT uom_price_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2252 (class 2606 OID 39583)
-- Dependencies: 192 2132 238 2256
-- Name: uom_product_stock_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_stock
    ADD CONSTRAINT uom_product_stock_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2227 (class 2606 OID 39578)
-- Dependencies: 2132 223 192 2256
-- Name: uom_purchase_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_dtl
    ADD CONSTRAINT uom_purchase_dtl_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2231 (class 2606 OID 39598)
-- Dependencies: 2132 192 225 2256
-- Name: uom_sales_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_dtl
    ADD CONSTRAINT uom_sales_dtl_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2236 (class 2606 OID 39613)
-- Dependencies: 192 2132 228 2256
-- Name: uom_stock_adjusment_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_adjusment_dtl
    ADD CONSTRAINT uom_stock_adjusment_dtl_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2240 (class 2606 OID 39608)
-- Dependencies: 231 2132 192 2256
-- Name: uom_stock_opname_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_opname_dtl
    ADD CONSTRAINT uom_stock_opname_dtl_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2249 (class 2606 OID 39593)
-- Dependencies: 2132 236 192 2256
-- Name: uom_transfer_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_dtl
    ADD CONSTRAINT uom_transfer_dtl_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2224 (class 2606 OID 39573)
-- Dependencies: 192 2132 219 2256
-- Name: uoms_product_uoms_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_uom
    ADD CONSTRAINT uoms_product_uoms_fk FOREIGN KEY (id_uom) REFERENCES uom(id_uom);


--
-- TOC entry 2254 (class 2606 OID 39753)
-- Dependencies: 2172 238 221 2256
-- Name: warehouse_product_stock_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY product_stock
    ADD CONSTRAINT warehouse_product_stock_fk FOREIGN KEY (id_warehouse) REFERENCES warehouse(id_warehouse);


--
-- TOC entry 2230 (class 2606 OID 39783)
-- Dependencies: 223 2172 221 2256
-- Name: warehouse_purchase_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY purchase_dtl
    ADD CONSTRAINT warehouse_purchase_dtl_fk FOREIGN KEY (id_warehouse) REFERENCES warehouse(id_warehouse);


--
-- TOC entry 2234 (class 2606 OID 39778)
-- Dependencies: 2172 221 225 2256
-- Name: warehouse_sales_dtl_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY sales_dtl
    ADD CONSTRAINT warehouse_sales_dtl_fk FOREIGN KEY (id_warehouse) REFERENCES warehouse(id_warehouse);


--
-- TOC entry 2235 (class 2606 OID 39773)
-- Dependencies: 227 221 2172 2256
-- Name: warehouse_stock_adjustment_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_adjustment
    ADD CONSTRAINT warehouse_stock_adjustment_fk FOREIGN KEY (id_warehouse) REFERENCES warehouse(id_warehouse);


--
-- TOC entry 2239 (class 2606 OID 39768)
-- Dependencies: 221 230 2172 2256
-- Name: warehouse_stock_opname_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY stock_opname
    ADD CONSTRAINT warehouse_stock_opname_fk FOREIGN KEY (id_warehouse) REFERENCES warehouse(id_warehouse);


--
-- TOC entry 2243 (class 2606 OID 39758)
-- Dependencies: 221 2172 233 2256
-- Name: warehouse_transfer_hdr_fk; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_hdr
    ADD CONSTRAINT warehouse_transfer_hdr_fk FOREIGN KEY (id_warehouse_source) REFERENCES warehouse(id_warehouse);


--
-- TOC entry 2244 (class 2606 OID 39763)
-- Dependencies: 2172 233 221 2256
-- Name: warehouse_transfer_hdr_fk1; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY transfer_hdr
    ADD CONSTRAINT warehouse_transfer_hdr_fk1 FOREIGN KEY (id_warehouse_dest) REFERENCES warehouse(id_warehouse);


-- Completed on 2014-05-02 08:22:31 WIT

--
-- PostgreSQL database dump complete
--

