--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: menu_node; Type: TABLE; Schema: public; Owner: -; Tablespace: 
--

CREATE TABLE menu_node (
    id integer NOT NULL,
    menu_id integer NOT NULL,
    parent_id integer NOT NULL,
    "primary" boolean
);


--
-- Name: menu_node_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE menu_node_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: menu_node_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE menu_node_id_seq OWNED BY menu_node.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY menu_node ALTER COLUMN id SET DEFAULT nextval('menu_node_id_seq'::regclass);


--
-- Name: menu_node_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY menu_node
    ADD CONSTRAINT menu_node_id PRIMARY KEY (id);


--
-- Name: menu_node_menu_id_parent_id; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY menu_node
    ADD CONSTRAINT menu_node_menu_id_parent_id UNIQUE (menu_id, parent_id);


--
-- Name: menu_node_menu_id_primary; Type: CONSTRAINT; Schema: public; Owner: -; Tablespace: 
--

ALTER TABLE ONLY menu_node
    ADD CONSTRAINT menu_node_menu_id_primary UNIQUE (menu_id, "primary") DEFERRABLE INITIALLY DEFERRED;


--
-- Name: menu_node_parent_id; Type: INDEX; Schema: public; Owner: -; Tablespace: 
--

CREATE INDEX menu_node_parent_id ON menu_node USING btree (parent_id);


--
-- Name: menu_node_menu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY menu_node
    ADD CONSTRAINT menu_node_menu_id_fkey FOREIGN KEY (menu_id) REFERENCES menu(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: menu_node_parent_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY menu_node
    ADD CONSTRAINT menu_node_parent_id_fkey FOREIGN KEY (parent_id) REFERENCES menu(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

