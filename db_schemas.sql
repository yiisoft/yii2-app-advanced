
CREATE SEQUENCE public.cashdrawer_id_cashdrawer_seq_1;

CREATE TABLE public.cashdrawer (
                id_cashdrawer INTEGER NOT NULL DEFAULT nextval('public.cashdrawer_id_cashdrawer_seq_1'),
                init_cash DOUBLE PRECISION DEFAULT 0 NOT NULL,
                id_user INTEGER NOT NULL,
                close_cash DOUBLE PRECISION DEFAULT 0 NOT NULL,
                variants DOUBLE PRECISION DEFAULT 0 NOT NULL,
                status INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                create_by INTEGER NOT NULL,
                CONSTRAINT cashdrawer_pk PRIMARY KEY (id_cashdrawer)
);
COMMENT ON COLUMN public.cashdrawer.update_by IS 'id of user creator';
COMMENT ON COLUMN public.cashdrawer.create_by IS 'id of user creator';


ALTER SEQUENCE public.cashdrawer_id_cashdrawer_seq_1 OWNED BY public.cashdrawer.id_cashdrawer;

CREATE SEQUENCE public.price_category_id_price_category_seq_1;

CREATE TABLE public.price_category (
                id_price_category INTEGER NOT NULL DEFAULT nextval('public.price_category_id_price_category_seq_1'),
                nm_price_category VARCHAR NOT NULL,
                formula VARCHAR NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                CONSTRAINT price_category_pk PRIMARY KEY (id_price_category)
);
COMMENT ON COLUMN public.price_category.create_by IS 'id of user creator';
COMMENT ON COLUMN public.price_category.update_by IS 'id of user creator';


ALTER SEQUENCE public.price_category_id_price_category_seq_1 OWNED BY public.price_category.id_price_category;

CREATE SEQUENCE public.payment_id_payment_seq;

CREATE TABLE public.payment (
                id_payment INTEGER NOT NULL DEFAULT nextval('public.payment_id_payment_seq'),
                payment_num VARCHAR NOT NULL,
                payment_type INTEGER NOT NULL,
                payment_date DATE NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT payment_pk PRIMARY KEY (id_payment)
);
COMMENT ON COLUMN public.payment.create_by IS 'id of user creator';
COMMENT ON COLUMN public.payment.update_by IS 'id of user creator';


ALTER SEQUENCE public.payment_id_payment_seq OWNED BY public.payment.id_payment;

CREATE SEQUENCE public.invoice_hdr_id_invoice_seq;

CREATE TABLE public.invoice_hdr (
                id_invoice INTEGER NOT NULL DEFAULT nextval('public.invoice_hdr_id_invoice_seq'),
                inv_num VARCHAR NOT NULL,
                type INTEGER NOT NULL,
                inv_date DATE NOT NULL,
                id_vendor INTEGER NOT NULL,
                inv_value DOUBLE PRECISION NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT invoice_hdr_pk PRIMARY KEY (id_invoice)
);
COMMENT ON COLUMN public.invoice_hdr.create_by IS 'id of user creator';
COMMENT ON COLUMN public.invoice_hdr.update_by IS 'id of user creator';


ALTER SEQUENCE public.invoice_hdr_id_invoice_seq OWNED BY public.invoice_hdr.id_invoice;

CREATE TABLE public.payment_dtl (
                id_payment INTEGER NOT NULL,
                id_invoice INTEGER NOT NULL,
                pay_val DOUBLE PRECISION NOT NULL,
                CONSTRAINT payment_dtl_pk PRIMARY KEY (id_payment, id_invoice)
);


CREATE TABLE public.invoice_dtl (
                id_invoice INTEGER NOT NULL,
                id_reff INTEGER NOT NULL,
                description VARCHAR,
                trans_value DOUBLE PRECISION NOT NULL,
                CONSTRAINT invoice_dtl_pk PRIMARY KEY (id_invoice, id_reff)
);


CREATE SEQUENCE public.entri_sheet_id_esheet_seq;

CREATE TABLE public.entri_sheet (
                id_esheet INTEGER NOT NULL DEFAULT nextval('public.entri_sheet_id_esheet_seq'),
                cd_esheet VARCHAR(4) NOT NULL,
                nm_esheet VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT entri_sheet_pk PRIMARY KEY (id_esheet)
);
COMMENT ON COLUMN public.entri_sheet.create_by IS 'id of user creator';
COMMENT ON COLUMN public.entri_sheet.update_by IS 'id of user creator';


ALTER SEQUENCE public.entri_sheet_id_esheet_seq OWNED BY public.entri_sheet.id_esheet;

CREATE SEQUENCE public.product_group_id_group_seq_1;

CREATE TABLE public.product_group (
                id_group INTEGER NOT NULL DEFAULT nextval('public.product_group_id_group_seq_1'),
                cd_group VARCHAR(4) NOT NULL,
                nm_group VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT product_group_pk PRIMARY KEY (id_group)
);
COMMENT ON COLUMN public.product_group.create_by IS 'id of user creator';
COMMENT ON COLUMN public.product_group.update_by IS 'id of user creator';


ALTER SEQUENCE public.product_group_id_group_seq_1 OWNED BY public.product_group.id_group;

CREATE SEQUENCE public.coa_id_coa_seq;

CREATE TABLE public.coa (
                id_coa INTEGER NOT NULL DEFAULT nextval('public.coa_id_coa_seq'),
                id_coa_parent INTEGER,
                cd_account VARCHAR(16) NOT NULL,
                coa_type INTEGER NOT NULL,
                normal_balance CHAR(1) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT coa_pk PRIMARY KEY (id_coa)
);
COMMENT ON COLUMN public.coa.create_by IS 'id of user creator';
COMMENT ON COLUMN public.coa.update_by IS 'id of user creator';


ALTER SEQUENCE public.coa_id_coa_seq OWNED BY public.coa.id_coa;

CREATE TABLE public.entri_sheet_dtl (
                id_esheet INTEGER NOT NULL,
                id_coa INTEGER NOT NULL,
                dk VARCHAR(1) NOT NULL,
                CONSTRAINT entri_sheet_dtl_pk PRIMARY KEY (id_esheet, id_coa)
);


CREATE TABLE public.auto_number (
                template_group VARCHAR NOT NULL,
                template_num VARCHAR(20) NOT NULL,
                auto_number INTEGER NOT NULL,
                optimistic_lock INTEGER DEFAULT 1 NOT NULL,
                update_time INTEGER,
                CONSTRAINT auto_number_pk PRIMARY KEY (template_group, template_num)
);


CREATE SEQUENCE public.acc_periode_id_periode_seq_1;

CREATE TABLE public.acc_periode (
                id_periode INTEGER NOT NULL DEFAULT nextval('public.acc_periode_id_periode_seq_1'),
                nm_periode VARCHAR(32) NOT NULL,
                date_from DATE NOT NULL,
                date_to DATE NOT NULL,
                status INTEGER DEFAULT 0 NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT acc_periode_pk PRIMARY KEY (id_periode)
);
COMMENT ON COLUMN public.acc_periode.create_by IS 'id of user creator';
COMMENT ON COLUMN public.acc_periode.update_by IS 'id of user creator';


ALTER SEQUENCE public.acc_periode_id_periode_seq_1 OWNED BY public.acc_periode.id_periode;

CREATE SEQUENCE public.gl_header_id_gl_seq;

CREATE TABLE public.gl_header (
                id_gl INTEGER NOT NULL DEFAULT nextval('public.gl_header_id_gl_seq'),
                gl_date TIMESTAMP NOT NULL,
                gl_memo VARCHAR(128),
                id_periode INTEGER NOT NULL,
                type INTEGER,
                id_reff INTEGER,
                description VARCHAR NOT NULL,
                status INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT gl_header_pk PRIMARY KEY (id_gl)
);
COMMENT ON COLUMN public.gl_header.create_by IS 'id of user creator';
COMMENT ON COLUMN public.gl_header.update_by IS 'id of user creator';


ALTER SEQUENCE public.gl_header_id_gl_seq OWNED BY public.gl_header.id_gl;

CREATE SEQUENCE public.gl_detail_id_gl_detail_seq;

CREATE TABLE public.gl_detail (
                id_gl_detail INTEGER NOT NULL DEFAULT nextval('public.gl_detail_id_gl_detail_seq'),
                id_gl INTEGER NOT NULL,
                id_coa INTEGER NOT NULL,
                debit DOUBLE PRECISION NOT NULL,
                credit DOUBLE PRECISION NOT NULL,
                CONSTRAINT gl_detail_pk PRIMARY KEY (id_gl_detail)
);


ALTER SEQUENCE public.gl_detail_id_gl_detail_seq OWNED BY public.gl_detail.id_gl_detail;

CREATE SEQUENCE public.orgn_id_orgn_seq;

CREATE TABLE public.orgn (
                id_orgn INTEGER NOT NULL DEFAULT nextval('public.orgn_id_orgn_seq'),
                cd_orgn VARCHAR(4) NOT NULL,
                nm_orgn VARCHAR(64) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT orgn_pk PRIMARY KEY (id_orgn)
);
COMMENT ON COLUMN public.orgn.create_by IS 'id of user creator';
COMMENT ON COLUMN public.orgn.update_by IS 'id of user creator';


ALTER SEQUENCE public.orgn_id_orgn_seq OWNED BY public.orgn.id_orgn;

CREATE SEQUENCE public.uom_id_uom_seq;

CREATE TABLE public.uom (
                id_uom INTEGER NOT NULL DEFAULT nextval('public.uom_id_uom_seq'),
                cd_uom VARCHAR(4) NOT NULL,
                nm_uom VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT uom_pk PRIMARY KEY (id_uom)
);
COMMENT ON COLUMN public.uom.create_by IS 'id of user creator';
COMMENT ON COLUMN public.uom.update_by IS 'id of user creator';


ALTER SEQUENCE public.uom_id_uom_seq OWNED BY public.uom.id_uom;

CREATE UNIQUE INDEX uoms_unique_code
 ON public.uom USING BTREE
 ( cd_uom );

CREATE SEQUENCE public.supplier_id_supplier_seq;

CREATE TABLE public.supplier (
                id_supplier INTEGER NOT NULL DEFAULT nextval('public.supplier_id_supplier_seq'),
                cd_supplier VARCHAR(4) NOT NULL,
                nm_supplier VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT supplier_pk PRIMARY KEY (id_supplier)
);
COMMENT ON COLUMN public.supplier.create_by IS 'id of user creator';
COMMENT ON COLUMN public.supplier.update_by IS 'id of user creator';


ALTER SEQUENCE public.supplier_id_supplier_seq OWNED BY public.supplier.id_supplier;

CREATE UNIQUE INDEX supplier_ucode
 ON public.supplier USING BTREE
 ( cd_supplier );

CREATE SEQUENCE public.customer_id_customer_seq;

CREATE TABLE public.customer (
                id_customer INTEGER NOT NULL DEFAULT nextval('public.customer_id_customer_seq'),
                cd_cust VARCHAR(13) NOT NULL,
                nm_cust VARCHAR(64) NOT NULL,
                contact_name VARCHAR(64),
                contact_number VARCHAR(64),
                update_by INTEGER NOT NULL,
                status SMALLINT DEFAULT 1 NOT NULL,
                create_by INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                update_date TIMESTAMP NOT NULL,
                CONSTRAINT customer_pk PRIMARY KEY (id_customer)
);
COMMENT ON COLUMN public.customer.update_by IS 'id of user creator';
COMMENT ON COLUMN public.customer.status IS 'active (1) , inactive(0), delete(-1)';
COMMENT ON COLUMN public.customer.create_by IS 'id of user creator';


ALTER SEQUENCE public.customer_id_customer_seq OWNED BY public.customer.id_customer;

CREATE UNIQUE INDEX unique_cd_cust
 ON public.customer USING BTREE
 ( cd_cust );

CREATE TABLE public.customer_detail (
                id_customer INTEGER NOT NULL,
                id_distric INTEGER NOT NULL,
                addr1 VARCHAR(128) NOT NULL,
                addr2 VARCHAR(128),
                latitude DOUBLE PRECISION,
                longtitude DOUBLE PRECISION,
                id_kab INTEGER,
                id_kec INTEGER,
                id_kel INTEGER,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT customer_dtl_pk PRIMARY KEY (id_customer)
);
COMMENT ON COLUMN public.customer_detail.create_by IS 'id of user creator';
COMMENT ON COLUMN public.customer_detail.update_by IS 'id of user creator';


CREATE SEQUENCE public.branch_id_branch_seq;

CREATE TABLE public.branch (
                id_branch INTEGER NOT NULL DEFAULT nextval('public.branch_id_branch_seq'),
                id_orgn INTEGER NOT NULL,
                cd_branch VARCHAR(4) NOT NULL,
                nm_branch VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                update_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT branch_pk PRIMARY KEY (id_branch)
);
COMMENT ON COLUMN public.branch.create_by IS 'id of user creator';
COMMENT ON COLUMN public.branch.update_by IS 'id of user creator';


ALTER SEQUENCE public.branch_id_branch_seq OWNED BY public.branch.id_branch;

CREATE UNIQUE INDEX branch_ucode
 ON public.branch USING BTREE
 ( cd_branch );

CREATE SEQUENCE public.purchase_hdr_id_purchase_seq;

CREATE TABLE public.purchase_hdr (
                id_purchase INTEGER NOT NULL DEFAULT nextval('public.purchase_hdr_id_purchase_seq'),
                purchase_num VARCHAR(16) NOT NULL,
                id_supplier INTEGER NOT NULL,
                id_branch INTEGER NOT NULL,
                purchase_date DATE NOT NULL,
                purchase_value DOUBLE PRECISION NOT NULL,
                payment_discount DOUBLE PRECISION DEFAULT 0 NOT NULL,
                status INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT purchase_hdr_pk PRIMARY KEY (id_purchase)
);
COMMENT ON COLUMN public.purchase_hdr.create_by IS 'id of user creator';
COMMENT ON COLUMN public.purchase_hdr.update_by IS 'id of user creator';


ALTER SEQUENCE public.purchase_hdr_id_purchase_seq OWNED BY public.purchase_hdr.id_purchase;

CREATE SEQUENCE public.sales_hdr_id_sales_seq;

CREATE TABLE public.sales_hdr (
                id_sales INTEGER NOT NULL DEFAULT nextval('public.sales_hdr_id_sales_seq'),
                sales_num VARCHAR(16) NOT NULL,
                id_branch INTEGER NOT NULL,
                id_customer INTEGER NOT NULL,
                id_cashdrawer INTEGER,
                discount DOUBLE PRECISION,
                sales_date DATE NOT NULL,
                status INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT sales_hdr_pk PRIMARY KEY (id_sales)
);
COMMENT ON COLUMN public.sales_hdr.create_by IS 'id of user creator';
COMMENT ON COLUMN public.sales_hdr.update_by IS 'id of user creator';


ALTER SEQUENCE public.sales_hdr_id_sales_seq OWNED BY public.sales_hdr.id_sales;

CREATE SEQUENCE public.category_id_category_seq;

CREATE TABLE public.category (
                id_category INTEGER NOT NULL DEFAULT nextval('public.category_id_category_seq'),
                cd_category VARCHAR(4) NOT NULL,
                nm_category VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT p_category_pk PRIMARY KEY (id_category)
);
COMMENT ON COLUMN public.category.create_by IS 'id of user creator';
COMMENT ON COLUMN public.category.update_by IS 'id of user creator';


ALTER SEQUENCE public.category_id_category_seq OWNED BY public.category.id_category;

CREATE UNIQUE INDEX product_category_ucode
 ON public.category USING BTREE
 ( cd_category );

CREATE SEQUENCE public.product_id_product_seq;

CREATE TABLE public.product (
                id_product INTEGER NOT NULL DEFAULT nextval('public.product_id_product_seq'),
                cd_product VARCHAR(13) NOT NULL,
                nm_product VARCHAR(64) NOT NULL,
                id_category INTEGER NOT NULL,
                id_group INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT product_pk PRIMARY KEY (id_product)
);
COMMENT ON TABLE public.product IS 'details of product';
COMMENT ON COLUMN public.product.cd_product IS 'product number eg.barcode label';
COMMENT ON COLUMN public.product.create_by IS 'id of user creator';
COMMENT ON COLUMN public.product.update_by IS 'id of user creator';


ALTER SEQUENCE public.product_id_product_seq OWNED BY public.product.id_product;

CREATE UNIQUE INDEX product_ucode
 ON public.product USING BTREE
 ( cd_product );

CREATE TABLE public.price (
                id_product INTEGER NOT NULL,
                id_price_category INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                price DOUBLE PRECISION NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT price_pk PRIMARY KEY (id_product, id_price_category)
);
COMMENT ON COLUMN public.price.create_by IS 'id of user creator';
COMMENT ON COLUMN public.price.update_by IS 'id of user creator';


CREATE TABLE public.cogs (
                id_product INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                cogs DOUBLE PRECISION NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT cogs_pk PRIMARY KEY (id_product)
);
COMMENT ON COLUMN public.cogs.create_by IS 'id of user creator';
COMMENT ON COLUMN public.cogs.update_by IS 'id of user creator';


CREATE TABLE public.product_supplier (
                id_product INTEGER NOT NULL,
                id_supplier INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT product_supplier_pk PRIMARY KEY (id_product, id_supplier)
);
COMMENT ON COLUMN public.product_supplier.create_by IS 'id of user creator';
COMMENT ON COLUMN public.product_supplier.update_by IS 'id of user creator';


CREATE TABLE public.product_uom (
                id_product INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                isi INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT product_uom_pk PRIMARY KEY (id_product, id_uom)
);
COMMENT ON COLUMN public.product_uom.create_by IS 'id of user creator';
COMMENT ON COLUMN public.product_uom.update_by IS 'id of user creator';


CREATE SEQUENCE public.warehouse_id_warehouse_seq;

CREATE TABLE public.warehouse (
                id_warehouse INTEGER NOT NULL DEFAULT nextval('public.warehouse_id_warehouse_seq'),
                id_branch INTEGER NOT NULL,
                cd_whse VARCHAR(4) NOT NULL,
                nm_whse VARCHAR(32) NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT warehouse_pk PRIMARY KEY (id_warehouse)
);
COMMENT ON TABLE public.warehouse IS 'Warehouse table';
COMMENT ON COLUMN public.warehouse.create_by IS 'id of user creator';
COMMENT ON COLUMN public.warehouse.update_by IS 'id of user creator';


ALTER SEQUENCE public.warehouse_id_warehouse_seq OWNED BY public.warehouse.id_warehouse;

CREATE SEQUENCE public.purchase_dtl_id_purchase_dtl_seq;

CREATE TABLE public.purchase_dtl (
                id_purchase_dtl INTEGER NOT NULL DEFAULT nextval('public.purchase_dtl_id_purchase_dtl_seq'),
                id_purchase INTEGER NOT NULL,
                id_product INTEGER NOT NULL,
                id_warehouse INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                purch_qty DOUBLE PRECISION NOT NULL,
                purch_price DOUBLE PRECISION DEFAULT 0 NOT NULL,
                selling_price DOUBLE PRECISION NOT NULL,
                CONSTRAINT purchase_dtl_pk PRIMARY KEY (id_purchase_dtl)
);


ALTER SEQUENCE public.purchase_dtl_id_purchase_dtl_seq OWNED BY public.purchase_dtl.id_purchase_dtl;

CREATE SEQUENCE public.sales_dtl_id_sales_dtl_seq;

CREATE TABLE public.sales_dtl (
                id_sales_dtl INTEGER NOT NULL DEFAULT nextval('public.sales_dtl_id_sales_dtl_seq'),
                id_sales INTEGER NOT NULL,
                id_product INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                id_warehouse INTEGER NOT NULL,
                sales_price DOUBLE PRECISION NOT NULL,
                sales_qty DOUBLE PRECISION NOT NULL,
                discount DOUBLE PRECISION DEFAULT 0 NOT NULL,
                cogs DOUBLE PRECISION NOT NULL,
                tax DOUBLE PRECISION DEFAULT 0 NOT NULL,
                CONSTRAINT sales_dtl_pk PRIMARY KEY (id_sales_dtl)
);


ALTER SEQUENCE public.sales_dtl_id_sales_dtl_seq OWNED BY public.sales_dtl.id_sales_dtl;

CREATE SEQUENCE public.stock_adjustment_id_adjustment_seq;

CREATE TABLE public.stock_adjustment (
                id_adjustment INTEGER NOT NULL DEFAULT nextval('public.stock_adjustment_id_adjustment_seq'),
                adjusment_num VARCHAR NOT NULL,
                id_warehouse INTEGER NOT NULL,
                adjusment_date DATE NOT NULL,
                status INTEGER NOT NULL,
                id_reff VARCHAR NOT NULL,
                description VARCHAR,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT stock_adjustment_pk PRIMARY KEY (id_adjustment)
);
COMMENT ON COLUMN public.stock_adjustment.create_by IS 'id of user creator';
COMMENT ON COLUMN public.stock_adjustment.update_by IS 'id of user creator';


ALTER SEQUENCE public.stock_adjustment_id_adjustment_seq OWNED BY public.stock_adjustment.id_adjustment;

CREATE TABLE public.stock_adjusment_dtl (
                id_adjustment INTEGER NOT NULL,
                id_product INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                qty DOUBLE PRECISION NOT NULL,
                item_value DOUBLE PRECISION NOT NULL,
                CONSTRAINT stock_adjusment_dtl_pk PRIMARY KEY (id_adjustment, id_product, id_uom)
);


CREATE SEQUENCE public.stock_opname_id_opname_seq;

CREATE TABLE public.stock_opname (
                id_opname INTEGER NOT NULL DEFAULT nextval('public.stock_opname_id_opname_seq'),
                opname_num VARCHAR NOT NULL,
                id_warehouse INTEGER NOT NULL,
                opname_date DATE NOT NULL,
                description VARCHAR,
                status INTEGER NOT NULL,
                operator1 VARCHAR NOT NULL,
                operator2 VARCHAR,
                operator3 VARCHAR,
                update_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT stock_opname_pk PRIMARY KEY (id_opname)
);
COMMENT ON COLUMN public.stock_opname.create_by IS 'id of user creator';
COMMENT ON COLUMN public.stock_opname.update_by IS 'id of user creator';


ALTER SEQUENCE public.stock_opname_id_opname_seq OWNED BY public.stock_opname.id_opname;

CREATE TABLE public.stock_opname_dtl (
                id_opname INTEGER NOT NULL,
                id_product INTEGER NOT NULL,
                id_uom INTEGER NOT NULL,
                qty DOUBLE PRECISION NOT NULL,
                CONSTRAINT stock_opname_dtl_pk PRIMARY KEY (id_opname, id_product, id_uom)
);


CREATE SEQUENCE public.transfer_hdr_id_transfer_seq;

CREATE TABLE public.transfer_hdr (
                id_transfer INTEGER NOT NULL DEFAULT nextval('public.transfer_hdr_id_transfer_seq'),
                transfer_num VARCHAR(16) NOT NULL,
                id_warehouse_source INTEGER NOT NULL,
                id_warehouse_dest INTEGER NOT NULL,
                transfer_date DATE NOT NULL,
                status INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT transfer_hdr_pk PRIMARY KEY (id_transfer)
);
COMMENT ON COLUMN public.transfer_hdr.create_by IS 'id of user creator';
COMMENT ON COLUMN public.transfer_hdr.update_by IS 'id of user creator';


ALTER SEQUENCE public.transfer_hdr_id_transfer_seq OWNED BY public.transfer_hdr.id_transfer;

CREATE SEQUENCE public.transfer_dtl_id_transfer_dtl_seq;

CREATE TABLE public.transfer_dtl (
                id_transfer_dtl INTEGER NOT NULL DEFAULT nextval('public.transfer_dtl_id_transfer_dtl_seq'),
                id_transfer INTEGER NOT NULL,
                id_product INTEGER NOT NULL,
                transfer_qty_send DOUBLE PRECISION NOT NULL,
                transfer_qty_receive DOUBLE PRECISION,
                id_uom INTEGER NOT NULL,
                CONSTRAINT transfer_dtl_pk PRIMARY KEY (id_transfer_dtl)
);


ALTER SEQUENCE public.transfer_dtl_id_transfer_dtl_seq OWNED BY public.transfer_dtl.id_transfer_dtl;

CREATE TABLE public.product_stock (
                id_warehouse INTEGER NOT NULL,
                id_product INTEGER NOT NULL,
                qty_stock DOUBLE PRECISION NOT NULL,
                id_uom INTEGER NOT NULL,
                create_date TIMESTAMP NOT NULL,
                create_by INTEGER NOT NULL,
                update_date TIMESTAMP NOT NULL,
                update_by INTEGER NOT NULL,
                CONSTRAINT product_stock_pk PRIMARY KEY (id_warehouse, id_product)
);
COMMENT ON COLUMN public.product_stock.create_by IS 'id of user creator';
COMMENT ON COLUMN public.product_stock.update_by IS 'id of user creator';


ALTER TABLE public.sales_hdr ADD CONSTRAINT cashdrawer_sales_hdr_fk
FOREIGN KEY (id_cashdrawer)
REFERENCES public.cashdrawer (id_cashdrawer)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.price ADD CONSTRAINT price_category_price_fk
FOREIGN KEY (id_price_category)
REFERENCES public.price_category (id_price_category)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.payment_dtl ADD CONSTRAINT payment_payment_dtl_fk
FOREIGN KEY (id_payment)
REFERENCES public.payment (id_payment)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.invoice_dtl ADD CONSTRAINT invoice_hdr_invoice_dtl_fk
FOREIGN KEY (id_invoice)
REFERENCES public.invoice_hdr (id_invoice)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.payment_dtl ADD CONSTRAINT invoice_hdr_payment_dtl_fk
FOREIGN KEY (id_invoice)
REFERENCES public.invoice_hdr (id_invoice)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.entri_sheet_dtl ADD CONSTRAINT entri_sheet_new_table_fk
FOREIGN KEY (id_esheet)
REFERENCES public.entri_sheet (id_esheet)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product ADD CONSTRAINT group_product_fk
FOREIGN KEY (id_group)
REFERENCES public.product_group (id_group)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.coa ADD CONSTRAINT coa_coa_fk
FOREIGN KEY (id_coa_parent)
REFERENCES public.coa (id_coa)
ON DELETE SET NULL
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.gl_detail ADD CONSTRAINT coa_gl_detail_fk
FOREIGN KEY (id_coa)
REFERENCES public.coa (id_coa)
ON DELETE RESTRICT
ON UPDATE CASCADE
NOT DEFERRABLE;

ALTER TABLE public.entri_sheet_dtl ADD CONSTRAINT coa_new_table_fk
FOREIGN KEY (id_coa)
REFERENCES public.coa (id_coa)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.gl_header ADD CONSTRAINT acc_periode_gl_header_fk
FOREIGN KEY (id_periode)
REFERENCES public.acc_periode (id_periode)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.gl_detail ADD CONSTRAINT gl_header_gl_detail_fk
FOREIGN KEY (id_gl)
REFERENCES public.gl_header (id_gl)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.branch ADD CONSTRAINT org_branch_fk
FOREIGN KEY (id_orgn)
REFERENCES public.orgn (id_orgn)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_uom ADD CONSTRAINT uoms_product_uoms_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.purchase_dtl ADD CONSTRAINT uom_purchase_dtl_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_stock ADD CONSTRAINT uom_product_stock_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cogs ADD CONSTRAINT uom_cogs_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.transfer_dtl ADD CONSTRAINT uom_transfer_dtl_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.sales_dtl ADD CONSTRAINT uom_sales_dtl_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.price ADD CONSTRAINT uom_price_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_opname_dtl ADD CONSTRAINT uom_stock_opname_dtl_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_adjusment_dtl ADD CONSTRAINT uom_stock_adjusment_dtl_fk
FOREIGN KEY (id_uom)
REFERENCES public.uom (id_uom)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_supplier ADD CONSTRAINT supplier_product_supplier_fk
FOREIGN KEY (id_supplier)
REFERENCES public.supplier (id_supplier)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.purchase_hdr ADD CONSTRAINT supplier_purchase_hdr_fk
FOREIGN KEY (id_supplier)
REFERENCES public.supplier (id_supplier)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.customer_detail ADD CONSTRAINT customers_customer_detail_fk
FOREIGN KEY (id_customer)
REFERENCES public.customer (id_customer)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.sales_hdr ADD CONSTRAINT customer_sales_fk
FOREIGN KEY (id_customer)
REFERENCES public.customer (id_customer)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.warehouse ADD CONSTRAINT branch_warehouse_fk
FOREIGN KEY (id_branch)
REFERENCES public.branch (id_branch)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.sales_hdr ADD CONSTRAINT branch_sales_hdr_fk
FOREIGN KEY (id_branch)
REFERENCES public.branch (id_branch)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.purchase_hdr ADD CONSTRAINT branch_purchase_hdr_fk
FOREIGN KEY (id_branch)
REFERENCES public.branch (id_branch)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.purchase_dtl ADD CONSTRAINT purchase_hdr_purchase_dtl_fk
FOREIGN KEY (id_purchase)
REFERENCES public.purchase_hdr (id_purchase)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.sales_dtl ADD CONSTRAINT sales_hdr_sales_dtl_fk
FOREIGN KEY (id_sales)
REFERENCES public.sales_hdr (id_sales)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product ADD CONSTRAINT product_category_product_fk
FOREIGN KEY (id_category)
REFERENCES public.category (id_category)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_uom ADD CONSTRAINT product_product_uoms_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_supplier ADD CONSTRAINT product_product_supplier_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.purchase_dtl ADD CONSTRAINT product_purchase_dtl_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_stock ADD CONSTRAINT product_product_stock_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.cogs ADD CONSTRAINT product_cogs_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.transfer_dtl ADD CONSTRAINT product_transfer_dtl_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.sales_dtl ADD CONSTRAINT product_sales_dtl_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.price ADD CONSTRAINT product_price_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_opname_dtl ADD CONSTRAINT product_stock_opname_dtl_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_adjusment_dtl ADD CONSTRAINT product_stock_adjusment_dtl_fk
FOREIGN KEY (id_product)
REFERENCES public.product (id_product)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.product_stock ADD CONSTRAINT warehouse_product_stock_fk
FOREIGN KEY (id_warehouse)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.transfer_hdr ADD CONSTRAINT warehouse_transfer_hdr_fk
FOREIGN KEY (id_warehouse_source)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.transfer_hdr ADD CONSTRAINT warehouse_transfer_hdr_fk1
FOREIGN KEY (id_warehouse_dest)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_opname ADD CONSTRAINT warehouse_stock_opname_fk
FOREIGN KEY (id_warehouse)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_adjustment ADD CONSTRAINT warehouse_stock_adjustment_fk
FOREIGN KEY (id_warehouse)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.sales_dtl ADD CONSTRAINT warehouse_sales_dtl_fk
FOREIGN KEY (id_warehouse)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.purchase_dtl ADD CONSTRAINT warehouse_purchase_dtl_fk
FOREIGN KEY (id_warehouse)
REFERENCES public.warehouse (id_warehouse)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_adjusment_dtl ADD CONSTRAINT stock_adjustment_stock_adjusment_dtl_fk
FOREIGN KEY (id_adjustment)
REFERENCES public.stock_adjustment (id_adjustment)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.stock_opname_dtl ADD CONSTRAINT stock_opname_stock_opname_dtl_fk
FOREIGN KEY (id_opname)
REFERENCES public.stock_opname (id_opname)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE public.transfer_dtl ADD CONSTRAINT transfer_hdr_transfer_dtl_fk
FOREIGN KEY (id_transfer)
REFERENCES public.transfer_hdr (id_transfer)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;
