PGDMP     !                
    t            postgres    9.6.1    9.6.1 B    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                        2615    16405 	   siasisten    SCHEMA        CREATE SCHEMA siasisten;
    DROP SCHEMA siasisten;
             postgres    false            �            1255    16739    add_jml_pelamar()    FUNCTION     �   CREATE FUNCTION add_jml_pelamar() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
UPDATE lowongan SET jml_pelamar = jml_pelamar + 1
WHERE IDLowongan = NEW.IDLowongan;
RETURN NEW;
END;
$$;
 +   DROP FUNCTION siasisten.add_jml_pelamar();
    	   siasisten       postgres    false    8            �            1255    16744    add_jml_pelamar_diterima()    FUNCTION       CREATE FUNCTION add_jml_pelamar_diterima() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
if(new.id_st_lamaran = 3) then
UPDATE lowongan SET jml_pelamar_diterima = jml_pelamar_diterima + 1
WHERE IDLowongan = old.IDLowongan;
END IF;
RETURN NEW;
END;
$$;
 4   DROP FUNCTION siasisten.add_jml_pelamar_diterima();
    	   siasisten       postgres    false    8            �            1255    16747 $   update_jml_pelamar_diterima(integer)    FUNCTION     �  CREATE FUNCTION update_jml_pelamar_diterima(id_lowongan integer) RETURNS void
    LANGUAGE plpgsql
    AS $$ 
BEGIN 
 BEGIN 
 UPDATE LOWONGAN lo 
    SET jml_pelamar_diterima = (SELECT COUNT(*) AS jml_pelamar_diterima FROM LAMARAN la 
    WHERE la.idlowongan=lo.idlowongan AND la.idlowongan=id_lowongan AND la.id_st_lamaran = 3 
    GROUP BY la.idlowongan) 
    WHERE lo.idlowongan=id_lowongan; 
END;  
END; $$;
 J   DROP FUNCTION siasisten.update_jml_pelamar_diterima(id_lowongan integer);
    	   siasisten       postgres    false    8            �            1255    16748 "   update_jml_pelamar_diterima_null()    FUNCTION     �   CREATE FUNCTION update_jml_pelamar_diterima_null() RETURNS void
    LANGUAGE plpgsql
    AS $$ 
BEGIN 
 BEGIN 
 UPDATE LOWONGAN lo 
    SET jml_pelamar_diterima = 0 
    WHERE jml_pelamar_diterima is null;
END;  
END; $$;
 <   DROP FUNCTION siasisten.update_jml_pelamar_diterima_null();
    	   siasisten       postgres    false    8            �            1255    16746    update_juml_pelamar(integer)    FUNCTION     i  CREATE FUNCTION update_juml_pelamar(id_lowongan integer) RETURNS void
    LANGUAGE plpgsql
    AS $$ 
BEGIN 
 BEGIN 
 UPDATE LOWONGAN lo 
    SET jml_pelamar = (SELECT COUNT(*) AS jml_pelamar FROM LAMARAN la 
    WHERE la.idlowongan=lo.idlowongan AND la.idlowongan=id_lowongan 
    GROUP BY la.idlowongan) 
    WHERE lo.idlowongan=id_lowongan; 
END;  
END; $$;
 B   DROP FUNCTION siasisten.update_juml_pelamar(id_lowongan integer);
    	   siasisten       postgres    false    8            �            1259    16524    dosen    TABLE     M  CREATE TABLE dosen (
    nip character varying(20) NOT NULL,
    nama character varying(100) NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(20) NOT NULL,
    email character varying(100) NOT NULL,
    universitas character varying(100) NOT NULL,
    fakultas character varying(100) NOT NULL
);
    DROP TABLE siasisten.dosen;
    	   siasisten         postgres    false    8            �            1259    16582    dosen_kelas_mk    TABLE     h   CREATE TABLE dosen_kelas_mk (
    nip character varying(20) NOT NULL,
    idkelasmk integer NOT NULL
);
 %   DROP TABLE siasisten.dosen_kelas_mk;
    	   siasisten         postgres    false    8            �            1259    16411    kategori_log    TABLE     d   CREATE TABLE kategori_log (
    id integer NOT NULL,
    kategori character varying(50) NOT NULL
);
 #   DROP TABLE siasisten.kategori_log;
    	   siasisten         postgres    false    8            �            1259    16509    kelas_mk    TABLE     ~   CREATE TABLE kelas_mk (
    idkelasmk integer NOT NULL,
    tahun integer,
    semester integer,
    kode_mk character(10)
);
    DROP TABLE siasisten.kelas_mk;
    	   siasisten         postgres    false    8            �            1259    16691    lamaran    TABLE     �   CREATE TABLE lamaran (
    idlamaran integer NOT NULL,
    npm character(10) NOT NULL,
    idlowongan integer NOT NULL,
    id_st_lamaran integer NOT NULL,
    ipk numeric(5,2) NOT NULL,
    "JumlahSKS" integer NOT NULL,
    nip character varying(20)
);
    DROP TABLE siasisten.lamaran;
    	   siasisten         postgres    false    8            �            1259    16706    log    TABLE     �  CREATE TABLE log (
    id integer NOT NULL,
    idlamaran integer NOT NULL,
    npm character(10) NOT NULL,
    id_kat_log integer NOT NULL,
    id_st_log integer NOT NULL,
    tanggal timestamp without time zone NOT NULL,
    jam_mulai timestamp without time zone NOT NULL,
    jam_selesai timestamp without time zone NOT NULL,
    deskripsi_kerja character varying(100) NOT NULL
);
    DROP TABLE siasisten.log;
    	   siasisten         postgres    false    8            �            1259    16609    lowongan    TABLE     M  CREATE TABLE lowongan (
    idlowongan integer NOT NULL,
    idkelasmk integer NOT NULL,
    status boolean NOT NULL,
    jumlah_asisten integer DEFAULT 0,
    syarat_tambahan character varying(100),
    nipdosenpembuka character varying(20) NOT NULL,
    jml_pelamar integer DEFAULT 0,
    jml_pelamar_diterima integer DEFAULT 0
);
    DROP TABLE siasisten.lowongan;
    	   siasisten         postgres    false    8            �            1259    16529 	   mahasiswa    TABLE     �  CREATE TABLE mahasiswa (
    npm character(10) NOT NULL,
    nama character varying(100) NOT NULL,
    username character varying(30) NOT NULL,
    password character varying(20) NOT NULL,
    email character varying(100) NOT NULL,
    email_aktif character varying(100),
    waktu_kosong character varying(100),
    bank character varying(100),
    norekening character varying(100),
    url_mukatab character varying(100),
    url_foto character varying(100)
);
     DROP TABLE siasisten.mahasiswa;
    	   siasisten         postgres    false    8            �            1259    16494    mata_kuliah    TABLE     �   CREATE TABLE mata_kuliah (
    kode character(10) NOT NULL,
    nama character varying(100) NOT NULL,
    prasyarat_dari character(10)
);
 "   DROP TABLE siasisten.mata_kuliah;
    	   siasisten         postgres    false    8            �            1259    16557    mhs_mengambil_kelas_mk    TABLE     �   CREATE TABLE mhs_mengambil_kelas_mk (
    npm character(10) NOT NULL,
    idkelasmk integer NOT NULL,
    nilai numeric(5,2)
);
 -   DROP TABLE siasisten.mhs_mengambil_kelas_mk;
    	   siasisten         postgres    false    8            �            1259    16625    status_lamaran    TABLE     d   CREATE TABLE status_lamaran (
    id integer NOT NULL,
    status character varying(10) NOT NULL
);
 %   DROP TABLE siasisten.status_lamaran;
    	   siasisten         postgres    false    8            �            1259    16406 
   status_log    TABLE     `   CREATE TABLE status_log (
    id integer NOT NULL,
    status character varying(10) NOT NULL
);
 !   DROP TABLE siasisten.status_log;
    	   siasisten         postgres    false    8            �            1259    16537    telepon_mahasiswa    TABLE     t   CREATE TABLE telepon_mahasiswa (
    npm character(10) NOT NULL,
    nomortelepon character varying(20) NOT NULL
);
 (   DROP TABLE siasisten.telepon_mahasiswa;
    	   siasisten         postgres    false    8            �            1259    16504    term    TABLE     Q   CREATE TABLE term (
    tahun integer NOT NULL,
    semester integer NOT NULL
);
    DROP TABLE siasisten.term;
    	   siasisten         postgres    false    8            �          0    16524    dosen 
   TABLE DATA               U   COPY dosen (nip, nama, username, password, email, universitas, fakultas) FROM stdin;
 	   siasisten       postgres    false    200   W       �          0    16582    dosen_kelas_mk 
   TABLE DATA               1   COPY dosen_kelas_mk (nip, idkelasmk) FROM stdin;
 	   siasisten       postgres    false    204   �c       �          0    16411    kategori_log 
   TABLE DATA               -   COPY kategori_log (id, kategori) FROM stdin;
 	   siasisten       postgres    false    190   �f       �          0    16509    kelas_mk 
   TABLE DATA               @   COPY kelas_mk (idkelasmk, tahun, semester, kode_mk) FROM stdin;
 	   siasisten       postgres    false    199   g       �          0    16691    lamaran 
   TABLE DATA               \   COPY lamaran (idlamaran, npm, idlowongan, id_st_lamaran, ipk, "JumlahSKS", nip) FROM stdin;
 	   siasisten       postgres    false    207   i       �          0    16706    log 
   TABLE DATA               s   COPY log (id, idlamaran, npm, id_kat_log, id_st_log, tanggal, jam_mulai, jam_selesai, deskripsi_kerja) FROM stdin;
 	   siasisten       postgres    false    208   �q       �          0    16609    lowongan 
   TABLE DATA               �   COPY lowongan (idlowongan, idkelasmk, status, jumlah_asisten, syarat_tambahan, nipdosenpembuka, jml_pelamar, jml_pelamar_diterima) FROM stdin;
 	   siasisten       postgres    false    205   V�       �          0    16529 	   mahasiswa 
   TABLE DATA               �   COPY mahasiswa (npm, nama, username, password, email, email_aktif, waktu_kosong, bank, norekening, url_mukatab, url_foto) FROM stdin;
 	   siasisten       postgres    false    201   i�       �          0    16494    mata_kuliah 
   TABLE DATA               :   COPY mata_kuliah (kode, nama, prasyarat_dari) FROM stdin;
 	   siasisten       postgres    false    197   ��       �          0    16557    mhs_mengambil_kelas_mk 
   TABLE DATA               @   COPY mhs_mengambil_kelas_mk (npm, idkelasmk, nilai) FROM stdin;
 	   siasisten       postgres    false    203   ��       �          0    16625    status_lamaran 
   TABLE DATA               -   COPY status_lamaran (id, status) FROM stdin;
 	   siasisten       postgres    false    206   a�       �          0    16406 
   status_log 
   TABLE DATA               )   COPY status_log (id, status) FROM stdin;
 	   siasisten       postgres    false    189   ��       �          0    16537    telepon_mahasiswa 
   TABLE DATA               7   COPY telepon_mahasiswa (npm, nomortelepon) FROM stdin;
 	   siasisten       postgres    false    202   �       �          0    16504    term 
   TABLE DATA               (   COPY term (tahun, semester) FROM stdin;
 	   siasisten       postgres    false    198   ҭ       :           2606    16586 "   dosen_kelas_mk dosen_kelas_mk_pkey 
   CONSTRAINT     e   ALTER TABLE ONLY dosen_kelas_mk
    ADD CONSTRAINT dosen_kelas_mk_pkey PRIMARY KEY (nip, idkelasmk);
 O   ALTER TABLE ONLY siasisten.dosen_kelas_mk DROP CONSTRAINT dosen_kelas_mk_pkey;
    	   siasisten         postgres    false    204    204    204            2           2606    16528    dosen dosen_pkey 
   CONSTRAINT     H   ALTER TABLE ONLY dosen
    ADD CONSTRAINT dosen_pkey PRIMARY KEY (nip);
 =   ALTER TABLE ONLY siasisten.dosen DROP CONSTRAINT dosen_pkey;
    	   siasisten         postgres    false    200    200            *           2606    16415    kategori_log kategori_log_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY kategori_log
    ADD CONSTRAINT kategori_log_pkey PRIMARY KEY (id);
 K   ALTER TABLE ONLY siasisten.kategori_log DROP CONSTRAINT kategori_log_pkey;
    	   siasisten         postgres    false    190    190            0           2606    16513    kelas_mk kelas_mk_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY kelas_mk
    ADD CONSTRAINT kelas_mk_pkey PRIMARY KEY (idkelasmk);
 C   ALTER TABLE ONLY siasisten.kelas_mk DROP CONSTRAINT kelas_mk_pkey;
    	   siasisten         postgres    false    199    199            @           2606    16695    lamaran lamaran_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY lamaran
    ADD CONSTRAINT lamaran_pkey PRIMARY KEY (idlamaran, npm);
 A   ALTER TABLE ONLY siasisten.lamaran DROP CONSTRAINT lamaran_pkey;
    	   siasisten         postgres    false    207    207    207            B           2606    16710    log log_pkey 
   CONSTRAINT     C   ALTER TABLE ONLY log
    ADD CONSTRAINT log_pkey PRIMARY KEY (id);
 9   ALTER TABLE ONLY siasisten.log DROP CONSTRAINT log_pkey;
    	   siasisten         postgres    false    208    208            <           2606    16614    lowongan lowongan_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY lowongan
    ADD CONSTRAINT lowongan_pkey PRIMARY KEY (idlowongan);
 C   ALTER TABLE ONLY siasisten.lowongan DROP CONSTRAINT lowongan_pkey;
    	   siasisten         postgres    false    205    205            4           2606    16536    mahasiswa mahasiswa_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY mahasiswa
    ADD CONSTRAINT mahasiswa_pkey PRIMARY KEY (npm);
 E   ALTER TABLE ONLY siasisten.mahasiswa DROP CONSTRAINT mahasiswa_pkey;
    	   siasisten         postgres    false    201    201            ,           2606    16498    mata_kuliah mata_kuliah_pkey 
   CONSTRAINT     U   ALTER TABLE ONLY mata_kuliah
    ADD CONSTRAINT mata_kuliah_pkey PRIMARY KEY (kode);
 I   ALTER TABLE ONLY siasisten.mata_kuliah DROP CONSTRAINT mata_kuliah_pkey;
    	   siasisten         postgres    false    197    197            8           2606    16561 2   mhs_mengambil_kelas_mk mhs_mengambil_kelas_mk_pkey 
   CONSTRAINT     u   ALTER TABLE ONLY mhs_mengambil_kelas_mk
    ADD CONSTRAINT mhs_mengambil_kelas_mk_pkey PRIMARY KEY (npm, idkelasmk);
 _   ALTER TABLE ONLY siasisten.mhs_mengambil_kelas_mk DROP CONSTRAINT mhs_mengambil_kelas_mk_pkey;
    	   siasisten         postgres    false    203    203    203            >           2606    16629 "   status_lamaran status_lamaran_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY status_lamaran
    ADD CONSTRAINT status_lamaran_pkey PRIMARY KEY (id);
 O   ALTER TABLE ONLY siasisten.status_lamaran DROP CONSTRAINT status_lamaran_pkey;
    	   siasisten         postgres    false    206    206            (           2606    16410    status_log status_log_pkey 
   CONSTRAINT     Q   ALTER TABLE ONLY status_log
    ADD CONSTRAINT status_log_pkey PRIMARY KEY (id);
 G   ALTER TABLE ONLY siasisten.status_log DROP CONSTRAINT status_log_pkey;
    	   siasisten         postgres    false    189    189            6           2606    16541 (   telepon_mahasiswa telepon_mahasiswa_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY telepon_mahasiswa
    ADD CONSTRAINT telepon_mahasiswa_pkey PRIMARY KEY (npm);
 U   ALTER TABLE ONLY siasisten.telepon_mahasiswa DROP CONSTRAINT telepon_mahasiswa_pkey;
    	   siasisten         postgres    false    202    202            .           2606    16508    term term_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY term
    ADD CONSTRAINT term_pkey PRIMARY KEY (tahun, semester);
 ;   ALTER TABLE ONLY siasisten.term DROP CONSTRAINT term_pkey;
    	   siasisten         postgres    false    198    198    198            Q           2620    16740    lamaran trg_jml_pelamar    TRIGGER     i   CREATE TRIGGER trg_jml_pelamar AFTER INSERT ON lamaran FOR EACH ROW EXECUTE PROCEDURE add_jml_pelamar();
 3   DROP TRIGGER trg_jml_pelamar ON siasisten.lamaran;
    	   siasisten       postgres    false    209    207            R           2620    16745     lamaran trg_jml_pelamar_diterima    TRIGGER     {   CREATE TRIGGER trg_jml_pelamar_diterima AFTER UPDATE ON lamaran FOR EACH ROW EXECUTE PROCEDURE add_jml_pelamar_diterima();
 <   DROP TRIGGER trg_jml_pelamar_diterima ON siasisten.lamaran;
    	   siasisten       postgres    false    210    207            J           2606    16592 ,   dosen_kelas_mk dosen_kelas_mk_idkelasmk_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY dosen_kelas_mk
    ADD CONSTRAINT dosen_kelas_mk_idkelasmk_fkey FOREIGN KEY (idkelasmk) REFERENCES kelas_mk(idkelasmk);
 Y   ALTER TABLE ONLY siasisten.dosen_kelas_mk DROP CONSTRAINT dosen_kelas_mk_idkelasmk_fkey;
    	   siasisten       postgres    false    199    2096    204            I           2606    16587 &   dosen_kelas_mk dosen_kelas_mk_nip_fkey    FK CONSTRAINT     t   ALTER TABLE ONLY dosen_kelas_mk
    ADD CONSTRAINT dosen_kelas_mk_nip_fkey FOREIGN KEY (nip) REFERENCES dosen(nip);
 S   ALTER TABLE ONLY siasisten.dosen_kelas_mk DROP CONSTRAINT dosen_kelas_mk_nip_fkey;
    	   siasisten       postgres    false    2098    204    200            E           2606    16519    kelas_mk kelas_mk_kode_mk_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY kelas_mk
    ADD CONSTRAINT kelas_mk_kode_mk_fkey FOREIGN KEY (kode_mk) REFERENCES mata_kuliah(kode) ON UPDATE RESTRICT ON DELETE RESTRICT;
 K   ALTER TABLE ONLY siasisten.kelas_mk DROP CONSTRAINT kelas_mk_kode_mk_fkey;
    	   siasisten       postgres    false    197    2092    199            D           2606    16514    kelas_mk kelas_mk_tahun_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY kelas_mk
    ADD CONSTRAINT kelas_mk_tahun_fkey FOREIGN KEY (tahun, semester) REFERENCES term(tahun, semester) ON UPDATE RESTRICT ON DELETE RESTRICT;
 I   ALTER TABLE ONLY siasisten.kelas_mk DROP CONSTRAINT kelas_mk_tahun_fkey;
    	   siasisten       postgres    false    198    199    198    2094    199            M           2606    16696    lamaran lamaran_idlowongan_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY lamaran
    ADD CONSTRAINT lamaran_idlowongan_fkey FOREIGN KEY (idlowongan) REFERENCES lowongan(idlowongan) ON UPDATE RESTRICT ON DELETE RESTRICT;
 L   ALTER TABLE ONLY siasisten.lamaran DROP CONSTRAINT lamaran_idlowongan_fkey;
    	   siasisten       postgres    false    205    207    2108            N           2606    16711    log log_id_kat_log_fkey    FK CONSTRAINT     r   ALTER TABLE ONLY log
    ADD CONSTRAINT log_id_kat_log_fkey FOREIGN KEY (id_kat_log) REFERENCES kategori_log(id);
 D   ALTER TABLE ONLY siasisten.log DROP CONSTRAINT log_id_kat_log_fkey;
    	   siasisten       postgres    false    2090    208    190            O           2606    16716    log log_id_st_log_fkey    FK CONSTRAINT     n   ALTER TABLE ONLY log
    ADD CONSTRAINT log_id_st_log_fkey FOREIGN KEY (id_st_log) REFERENCES status_log(id);
 C   ALTER TABLE ONLY siasisten.log DROP CONSTRAINT log_id_st_log_fkey;
    	   siasisten       postgres    false    189    208    2088            P           2606    16721    log log_idlamaran_fkey    FK CONSTRAINT     |   ALTER TABLE ONLY log
    ADD CONSTRAINT log_idlamaran_fkey FOREIGN KEY (idlamaran, npm) REFERENCES lamaran(idlamaran, npm);
 C   ALTER TABLE ONLY siasisten.log DROP CONSTRAINT log_idlamaran_fkey;
    	   siasisten       postgres    false    2112    207    207    208    208            K           2606    16615     lowongan lowongan_idkelasmk_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY lowongan
    ADD CONSTRAINT lowongan_idkelasmk_fkey FOREIGN KEY (idkelasmk) REFERENCES kelas_mk(idkelasmk) ON UPDATE RESTRICT ON DELETE RESTRICT;
 M   ALTER TABLE ONLY siasisten.lowongan DROP CONSTRAINT lowongan_idkelasmk_fkey;
    	   siasisten       postgres    false    205    2096    199            L           2606    16620 &   lowongan lowongan_nipdosenpembuka_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY lowongan
    ADD CONSTRAINT lowongan_nipdosenpembuka_fkey FOREIGN KEY (nipdosenpembuka) REFERENCES dosen(nip) ON UPDATE RESTRICT ON DELETE RESTRICT;
 S   ALTER TABLE ONLY siasisten.lowongan DROP CONSTRAINT lowongan_nipdosenpembuka_fkey;
    	   siasisten       postgres    false    200    2098    205            C           2606    16499 +   mata_kuliah mata_kuliah_prasyarat_dari_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY mata_kuliah
    ADD CONSTRAINT mata_kuliah_prasyarat_dari_fkey FOREIGN KEY (prasyarat_dari) REFERENCES mata_kuliah(kode) ON UPDATE RESTRICT ON DELETE RESTRICT;
 X   ALTER TABLE ONLY siasisten.mata_kuliah DROP CONSTRAINT mata_kuliah_prasyarat_dari_fkey;
    	   siasisten       postgres    false    2092    197    197            H           2606    16567 <   mhs_mengambil_kelas_mk mhs_mengambil_kelas_mk_idkelasmk_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY mhs_mengambil_kelas_mk
    ADD CONSTRAINT mhs_mengambil_kelas_mk_idkelasmk_fkey FOREIGN KEY (idkelasmk) REFERENCES kelas_mk(idkelasmk);
 i   ALTER TABLE ONLY siasisten.mhs_mengambil_kelas_mk DROP CONSTRAINT mhs_mengambil_kelas_mk_idkelasmk_fkey;
    	   siasisten       postgres    false    203    2096    199            G           2606    16562 6   mhs_mengambil_kelas_mk mhs_mengambil_kelas_mk_npm_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY mhs_mengambil_kelas_mk
    ADD CONSTRAINT mhs_mengambil_kelas_mk_npm_fkey FOREIGN KEY (npm) REFERENCES mahasiswa(npm);
 c   ALTER TABLE ONLY siasisten.mhs_mengambil_kelas_mk DROP CONSTRAINT mhs_mengambil_kelas_mk_npm_fkey;
    	   siasisten       postgres    false    203    2100    201            F           2606    16542 ,   telepon_mahasiswa telepon_mahasiswa_npm_fkey    FK CONSTRAINT     ~   ALTER TABLE ONLY telepon_mahasiswa
    ADD CONSTRAINT telepon_mahasiswa_npm_fkey FOREIGN KEY (npm) REFERENCES mahasiswa(npm);
 Y   ALTER TABLE ONLY siasisten.telepon_mahasiswa DROP CONSTRAINT telepon_mahasiswa_npm_fkey;
    	   siasisten       postgres    false    202    201    2100            �   u  x��Wɒ�J�]��"� �y�5� �@�AXo�$�,��eVݧ��}fU�Y9~"�� ��(Bcʲ���.�>NA��A�8�쾟i��]�׭��3�K`Wٔt}6��\�u��Y �?Ժl�!�6(K1?"�_1����C�%�@�Y~���囥ߏJ�$Xc$_;z�����oC�~�����D' �aP�`�>����F����ҿ��o3��_�`�]��Sߗ��	?��F����ߏ���Bo�
�8�@����1T۷������1�{2���Tه�3��>f_�p�O���������8gn�.c��7�����Οp~�����~���X��Uq�˟�3�i���_�C�����@�(�p�{�|�8y���'�:������4r/�c+Ȟ��)|������*�3�:vU�������'�����_�J%�R����;x�w>�o %��͛�(1�j2e��6}�& �}F�
�G����(��-(��>��g(�/T����������Y�a�}���O�g����5�ߏ~�	������������~.? M}����VEg�6�A�젧 ���	�8|[����u�����/�!@���3��F��eԐQ�Ӑ����EG���_]��t�}!8D<q��⟵PCi��Q�dXg8�)jR'�|����'�z�.*��3����۟�Ȧ;���Ad�%a=��./D�'dK�/Yw�Lc�X�W��/[S��ؠE�,���\�	����X춵��K���)�\=}�)�F�Ku��h�ZU�]��%��兇�p�Sv�.����}�A&7G�嗽���Yޠ$AP8�aH
�I��5��lg[
�q�.8XaqXo�}T�a�q��@����&�[�]x�V���zo]����td����p+�!1��@i�`0�bh �|eF;�Qp��J��"�,�8>�u�O����3C������./<ni*,e%�)3�,���FL�:��XU���K$,Fc�l�`9	|vo��p]u��4�Sk��u�*�]�BK/E ��P��[�:'2�ZmX��16�<�[�ѥ���1�ὠ4��(C2N!��>P�z��U�wr'�%pT-��Y\.7�T�y� UZ����兇��x��ł�v��{�~�=�z��M�M��!$M�4��KB�������8��u��i�a��Hw�f�餍�fߋ��|����(铪��c��z�;�pN^�|��{�_��q��	�'1�H�CX
��tN����V�u���D,�Ȼ��6�E�%�Ϝ���>$�{����ne�(t��!��2W�+�.,a�����7P8F����A?O\�0v�jW�SO/�S׮@	r��%2���ʩ�bP1n�:���G��y%wm�"�'��/�{�?�K����0Wa	a	����R�{P_wF��=\w�%� b!'u�.6a<j��F�����uy�1g��xJ�[w�bh}0��~�ï,ag�z��1gp2�
aH�`���-/�h�xq�~�@<Q2��ԅ�� V�pO׀�0�������^��)�M�2�'^7�:�Yd��(�q�� ���	
��Ek�,�Z�f)�8�A,_�[?�Y���I�p/���.o]^x��~���<5��8�[:�S��a���;�z���O�@H�������č�(���N���j�`*����=�(�*���l^��./<%r5EN'�3�}�+��o9C;�>m%�i�Ù�(U�.bh�1�:Ф0���b	3���D��K��] .�U��o]^x��exh�b�}���#ρ�>�|m�J<���-���jh� 'a�|�<�զ�ws�DS�:�g�0�m3 �<�ۻ��`F�uy᱃b<E�ٛ����5 �Y�B�����'cC�P��Ѣ,��$�ño\�a��C���8a�L�X9jg=u�a�D���i]�����ۏd���Z�;��Bʙ�r�OE|�xX֟M��0XȠRx0���L�z�yZ�z9ݏ�b鐚%u��H�­��S��}+�uyᡤ��/�͵9XLۻ��E�5M��lC1�6P���b6\�}kn0�r2�ɣ�<4S����MH��_��������uy�1e�*���5c8r5��s��ήζ�2߰
���_p"Q��,/��mM�/d/��X�����1^7���|�����o]^x��#�u��{�I�4`���~���I7?��>P�a�"���k�JT�|MdY�F�d��V^DGf��3��[/����ӸN�|��gO�}�स���+�(�D��>p8�<J!�ӠǺZ�v��I��S톏<`LxMBz�+�6��� ��>{;��k�s���g%v[m�/����������0O�?�ª����I�ZN�uwYb�d���l=�u�Ol��s���a5��[�C�9��R/.N�"�PV?��2��*9�rŞ2E(��c�o�����W���~ �@�#��	%�M%h<���u)n��ߺ��Ȓn��}8�ӭW��7�x����g�m.A��a)�9CB�R$K�	 8�u��֒�F��E���za�a˜�T�܇mr�>}��mz������>I~.n4)y��2���|9��[B��=�`iX�0�A?���s̢���S-�Mo>��rGuIǻqt�Q���;��X���u;��=�'a�ٲ�wq#���݅�r�!Oi�'	8'3�v4X9������Jh��R!|rkF�F��s��<��e�Kܷ./<�\��F��W�]�)Ѷ���>&�7��	�C��Y�9�2ԓ
��!>���&��m`'��% �GM5�.��#D�<�ax�Yb�����M����)j�qi�C�iT����C�lK�9���p`��pv��)�l=�2�&*��7�eJ�Ve�3�(N�ؓyO� u!�e�ŷ./<�D�*_���*j�6��|�G�%��e�}�a9���.<�k-{k��r�Y��GekN8M��K톍CbP� nfiX�[��q��u����jM�٠v�jv�J�4�̗g%%(X��,[
�Y-O8A�ؗ"��l`c[_�3Qw��Ò�p�~/���./<"E���z�-h��l� ��Rc�/y������s���S�vH      �      x�m�Y�#IC�ۇih_�2�?�0�4�~
��#%R�!s'S
qw�2���w�z���_�B�#��`tI_�C�#���^K[H���[(yNȗ�꣫G�e����BCq�A�8à�P�aPt*�r�e�0(�y|��A��v��q_'� �Ǡ���r��,]����j��8��l�^m�����Yh� ����u��(V��VQy�S��.Ԓ��8wN��˫4�B���.��V����$G��*��:�s�P	Ǉ�"���\�"��Ѫ��Z�@�*�J�[?�W�j�{h�U2r.4��t�vӞ�����Q���զ=���z[���>�[�*r�.v/]�=�����&3���(����(��F\�;oQЈY9�
qӎS̛+�j�vQhUBl|�B��f�D�gu��eզ00Rq�R�Fg�&��0��"�N�ǠD��;���Je�/Ӯ5���%?��/d��n͉$�-�pӍ]�g8İ��cp�=��'��EJ�hO�`F<���L�7Z�PF��>���'�-;F�-peM����	�2D9��ۨdBbƄz?�n�	kB��u]W�:��P7���yĄ�9EM���O����D�&�2��IG�1׉s����M~q����a�o��=~q����a���5~p���yX��a�_����yX��a���5~p����w���5~p���yX���5~p.���@��y a�<�pqP�8��pp�~ҝ�����8$�q�����_���o5�      �   a   x�=�I
�@��+���g�D��I��<x��HE��Jo��&q��M�*���8A�t�dAE�OR���f�������xu7������z��"�Og&�      �   �  x�u�I�� ���ô�$I`i�ʳ�c����є���}BA�P)�F
�߲���b��($��7w��돞�(�J��I7�\�Q:����ʱ�=Iٗ����^��[�QD{�b/]쥋�t��.���^��K{��b�7�i*l�7$#�������r�V������N:uyF`E���u�մiЂD�1�9�v�<��,��^��F�3�l�2�,��y/Ywj���;0F�黤=K�&��r����Yl�0ix=�9j]�r��0]�q����~��Sp쐢��v���m��޺�%5��Gj��+�M�l�%�*����أjÇ
=�rѷ���)CBO�*z6�%�Ҵ|�|�Ϝ
�wU�U5���y/��H,0;��\���g��r���a�ek7� %.���V=N+y�7.u݌`D[���C��Ϡ�s��x�ʸ�6���n����ə^q����n�QSt:�$����ި�e���(L���_ �B���      �   �  x���m��6�ۇ	�o�.{�slQjI���I �˱)��塋��V
�+�.��-���ZP	.�Z-B���3�E���bD#�E��'��h�eG㹬� ��_�r���V���K3��h�mG��z����(_�v���W�y��F�S�h�cG��Q��w�gs�_w]�ȴ���Q�U�]ﶣ	�o�ޖD�3��Hq��`������2Én�.�!������$�i˩zU%珜�%�i�׫�����뤤7mA�/�Q�����d7mE5Pu��G��9�ߴ%UH�);OI�څ⦭���Y�Oe�����z�����Y�.�(�
�L[U���蘩�=���[U㋣Ζ��W8�n�jr�h�S�	5��I�9�[T�]m�zj��Ѭ�,���ܼ55�- C���T]�.�\����e\CjܘkU
���5nޚZ�43���1.=����lI�]ZۤKJj�D�j/�|��&f�!iX����%� 1��%u��kOݺ�Q�c@��2�oޒ�(��3w�"u�Z�<�=�lIѹ=!�G�TP;T�i�콢0�%E"��1���$U�Ⱦ�i�ek
�h3���T�ĭ��lQ(YPGRFE�QE)�8�ɓ-*j�@�O��a���Eed���b��G�
��2�U�ӷ��.��_�Ն3�	/5��ɓ�*��N��d�8�h���断j oz�W�@ޢo�Q�[���Wm�P�9!�0 F�ӭ*���P'!��Z[1�[������x.��yD/�r�u��B��#�@/� ����p�5<11�Q!:�A3  �[���Rp[�g>!(���nM�S�nQ�#&�|D��Bmq@+k,��nQь��Y�>��`1�hWF�!|�Z��e�C_�VsN��O*�Emx���J�0aQo�H
*�[�� ��ң�(&^��m[�V�{���Q�r�C'�?�L��/�M@JC���Y���,�I#��n3�3�k����0�ta[����F�=PqV�	'�_����ٕ?i�����<k0 ����gS���,��F��)��
(��wf0�t"�sE��^=@���� �lIY��­�	#H~�յ�!l=��"#��Z���kƔ�4�}�¹�eqL P�����1���xR���i�&鍠�
������Ñ����}���_���]�HnKu�c� &�RŖˤČ?�xF�S�O��2H�]�Jy[F��P���Q���K�#��{1�j�eV��s��=����(�צ�Iz1qXOw�~e��H��V`e�˰��=F�c�X:��46}Y�Ѱ,{q:�8F���4�ht����@�AƓ������ǭ�#�[�,�6��5F<x��M��X����z8�h˴��� T�@fⲮ�#���-Q�nZ��t�q�6 �<r�2�W����+�v�k7-s�?�XFW�I0�ݵ�=и� ��+�v-g�q��|B\������x�$��� ]�Ӂ���1�i��זxf1�xX+L2u�¿Y<����)���b��羛׶�tdq���h����Y��Ŕ�����B{`���G�E$Q�^;��zm�Bt�v�2/�#�k�al�n]h�O�|��1��]����WK�Ҽ���b�M��$�n^�G��)�ĸ6C�&t�¿P������ӽ�W�[�4�u�^�1�HLڳ���þ����ڕe� ���e+{@��1���V��e�����q߃m>���.���+������ޟ�G��w�#������r��l�s\�?����'%z|o:n�>�Aw͏e��R>��#�\�!��0�c�S���q��c�H@�ߘ��|f��=?�u�{1�)�mDe����� �4+�`��O��o8��8h3�X�<S�3��?�D��=���t�q�� ��<�f�����GC =���tڌ��h��#�8�az@�%M���1�ڗ���l���n�ҳ�| �G�u��1�`j��~�l��ؾ�l�����c�2�izx�O��4��yfm^h\�̬�ǧ��blO7����bLܞ~6M��1��Ϧ��+ԁ�T�ih���= ���Ϧ陝vrkO;���C�r|��iz��֞~vz���c���M�o�������7Wz���;y�q�/;������<�lz��B�vcҧ�M���K����&��o#λ�=���<�����;��������5�ʿ��z����{.�*������+�?����_���      �   v  x��[ۮ�8}_Q?0#|L�H-��m���TI������xy_�^�ɍ�s}.H����F]���%�������`�����Y��h�wӨw������(�p��0��0�.�*�ݘz�w���g�s�/�#�0��o\=׿�?��s�!�+2��z7O=7���{�s=�O�P?���=�>w����,��ay��0�+&���_�[������ a#@�7q>����Ʋ@�+6�Ά���[��Md���ȳC��P��y?< ��uգ�$��
q�GK̤���.zG�C �z,.�I@�,6$��F4C�ػ�>�!���>�,.$���	����0T�BrPbL/��TY�}�;�h$��h��<���[g�D�lN<��l`@�"�5��\��ň����߼q�J��<��O}�C�l>ŇӐ�*=��u��T̦C ��@�D���ӉFQb�"C�h*?�Mo��3E0��Y]��*=&˟����YtHL��-�)Ъr����H.J̤0��U%�'�b�"��M���R�V%�'[�F6���ٔp��FU*z��u��T��E�g�S
�,�B<�i$�����BRI�t�Hf�`��B�PI��:�b$	%f!,"�U�_�E20��_��E�1$�����Xv�Ƞ&�,��E�1$"IA:�[����4}G��a%;�t�R���k�"Zw�Rv�,���JB?�TE��	�0r<
�JC_h*�"�w�lN8�?@?3��~��<�����	�T6�&�("{w�"��	7��1 �Σ���0���~�8h��1��У���0���UNL{�;f1Z�$4W�pM�QD�n��q�r
�L<M�QD�n�E!XlH	�1�5�Gٻc&���"��DM�QD�n��C�4WiM�QD�n�M�FZ�G*�P�x��;f��a��3Wi(\M�QD�n�M���S��\�a�j*�"�w�lB���<ؿ�h�"�w�,6�O~HhO�a(4�Gٻa6#X�	M�o"'q�PNϚG\[��ؕ�/v��1?�M9ݓ�[�G�&m�: ��\�P���PB� �c�"�bI�e}�L����ϰ���倶@e�_D�����;9ѱ��}��yWwS�6�1-�ّ:[�W����#Zs�Rٰ�2_�XfY󡝪��Ƶ��xn��� q�,,�:��r���e�)���yS��$-���6Zs�}�oP��֘"Aw�`�qZ�w�4Cw/�f�ts��!  !d%� � � 8����;[ǎ������;��>�q>Վ'O�n��$ �jq�w�d�W\vͧ�>Y7�S��'����� @f���;v��Ϫ��3/����u]���nY�ri�_I3+�;���Y�琗�cJתI���� �J�x�~Y��j;F��}���Z�s�M���2?�BJ]��d��0�a�^����˫�-�.n_iY906w�3WNL�M{$ްk�}�#(���?��m��~N�X=GX��݂ ���V��1+�t��>>�"}�]�u�w5e�u`��h�>qe�9WA|�3����~�w].�@�şi�_���p��Ԩ(���S��q4c�Ϗ����gM�J�4v`� i#�1�h#�@�����:vT��1�eU�mTF�������A�v2>g.��I�c��Ћw����k�u:EMU��,sF.�����z�S�J& r�vW��y�h�S5|�i|��ہdo�.�jR�m�;f�"�c���7m�>^�O�f���@��� �<�)�BQ�cWy�ŎӪ�W���?�dκ�ͫđ��%O��
�UjX��8S:vl���2}�]6����T�ց!��-��?����O-��Lbge����/C��yZe���;X�OnTd(�Ι3��c��ر#��O[�s9Ws_?�{�6�)޷h�����C$iv,���^G�|,S:݇�L�(n�сq&؊�ǹ�BY/�
$̤iv ����{�c�NC1ϡL���@����gB��́Ld��6v�\V��7��sdY��9��Wf!<B.Qfi�3fǎ�)��+��zi�m���`/��0Nt#D���	/�6�;��y飩{�s��?]�)����绂in���{N���P: �lh>� ��24Lߕ}M�;17����74��Yٽm�.����GG�Fx�/�r?.=�y��[2���cԼ����_�w>J�� I޶
hY
�7DF�3@x���\��z��dY�)�	l���] ��O|�Er+�cv��*��.I��	#S[��ؿ�.qd)�b�%B@�TC�$�e�4�v�dlI���U�j��!n�x�AC@�o5F��|M����a���bGH|�ZrS�.-�ǽ�&���m�p0L �������OC����3<г���������kbZ�/D|����4m>�yݵ����W�>���M�b�D(�
2I8�9 ;68-ŚU�׻��q��Q����p �N���;fQ����<��/����v:�4��w4�\���S+ð������=>>�ܷ��E�@�o���mf�^��&�'�-i������Q�P&���L� f�%1-S���6v�V:��{�K��ݜ�S��r��Y�{Fa�<��r��|��������3,�9��k�@��-��
�e�M�ڍ{qu�(3�4O�"z4�Uc�K]90��� p�y@t�j��e�9f藖c�)�nj��fV��X�f� ��xg� ��".Vhw�/vl��}�DY��K����KW'7?�1���63Y�;f$͎+���*�ki�~��w_/'o�?CA� g.c�}�;ژ�2��!���u�-��ݑ֜�@0�����1��ڴ��������ES�E���\��vHSΜX�`�Q�iK����h�}Ϝ4O�G�sl��&�>�W��׹9������fL�ȿ߷.uL5N�H&�m�����Y��F0�X���kZ�D��Z����^���m�z�L��"��N �m��D\�T�ps<� ��uP��k]�@-����0���Q�Pω���:��f��.�%��$}����c�����.:�:Iʮ���ٍQB��!�:m�suUT[��'&lL)B�w"Ĳ������=1�~k<bz����f;0�Y�ر4j<b������x�e������1]Az���&Ё1�cGL��!�-�k�0+G��~FǎD�'B�Z@�����f��A%�>�\����v��c��\�Z��y\+����Աci��e�Z-G��avG`�tPj����;O�Crt�����6Qp�޹��|K�Ď���Prҹ�̴�O̔mLs�P�P�p�x�$��ډ���P���z��2��zy���Ej��v�0C����E�uG@5=��������fEf^��P����kT;�A�(��[��<������]-P3j�;�k���������� В燙�VS�jC)�F]/
�h���c���K��a�M��yR���Kӱ�6Ԓ"̼*`Z��3��� G�#2PO�0�@�n�xvb�t���$�Im6�qYp��Ϫ@�=>��R�`��Tk��<����8/Ԕ"ܺ.���^ac�vPW�p����Dk��v�+�9_��VA@-�`Ǭ�M�A})iJ�]Te�]?��jʉ�A})���w�L�R���*l���Δ��]���52�nމ���)��ߵ��͞������{Sەѥ�^�4�E	��D�]��F��p�E1�:<���pk
(�vQ���x�$��I�֔|]��Eٹ���`�^�yqkJRfv�?'E�߾	E`:�����;�X���@�5%o��]��s���6ܚ�8~���ܱ
5�
5�L�ￎ�����i      �     x�}VK��J\ˇ	�r�`�H�Y��?Rl�4�@�F��?UER�1�1�?�l�oTA#xPU�_��F�������Ϗ￀�\ؚX�� V`ybm��q
�уgv_Aw`���1� ?R�X�2��'0gD�0���XH��uI��
$��Lژ�%���l����Q#�"�� F7�v�'�1&�<��fN��/Asb-+�k�'�&��s^ŹD�����h�.^�#�E�&P���/e�0i��C;�$)���UfX��p�.�/�4P���KG��̝$R_�e
�� ��f�7^SH�@��03�BK%���򹄌��̉%BUCl3�!�5��ʋ�C�j<������'�&�n�����M)��~7<�> T���b���N��.��,���r�t\������Xk���c�Ä�*��v�.�X.�+JG٨&TTmo�8_��p�R�&�OW�H}!���3{q0�mX�k��a�K�C���4Z����T1;^E/�.�،Z�<Q�bzH�KV^Xyg��h�0J����y��8W��R9Q�@I�d$k� ��}�TDhﺂ��m�B'��I�TC\�ҹ��븘�)��I���tP��z�C�6�7_��E�h����KJm埢,�������}�L�z�����Eԃ[�������Vb����SK�nM�΁����[�������7���!)b�Zw}w�@ފMmxyo-�~1��k g�mm��\����<65ٻH�0�6����(�����W/��|#�п�h2�z9�#��z���>l	:n׋�n�Ħ�[��luv$ ��Q3k���z$�Z^�\C߮��F<iͶ#
V��D�?:�g�
�?f�0��K��Z��ٰ0Xh�@�z����-�Ӟ��;�А�������A'�)�=[�9��]�fGV���4ٛ�g������|���IΉ��^�"E���5�3���c���OC�a�@�^j$ܺ����C�Z�G��J�Ʊ*�F`�{�����_τK      �      x�uzٲ�:r�s�W�pwp�$ŵ�d��G��<����Z k�v��Y+���* �̕dٮx���&�va�/����� ��q��O��Dt?������Y�K�G;���>���<7�˱�@�w˟�PP�?ؚ�q=�WVv'��f��S�?%���������S���b�Y1T=9�/<�}�)���ӟG�Z�ԕ�3�̕q3��0�ҿgS�F�'�w<_��
S������5-X�i�����bp�x��z։����ՏvfB�)�MүU�`����S�j�&x�߲��Y�Gۥa}ш�\/�?!Gy�M�o������LL]�V�6��^���e3S������D�/�B9;�͘����l1��¤yI����ÿ�ܧwP��O�	�r0��S��W<~�x�_bh�/<������e�e�o������G�@.�~[:)fm|s����K��i�)��>�w�o��}������K	���?��h��4/��S���f�}]*W_��T��H�=���W��W/�bvn���P��Z5E�ķ׽j������,͐+p�󲘱l�0!����AC��0r# �~�I�M���H#��k^�-R����O�S�ɄN��?p��M��7[@���G^��*e��}�'����c���є���7QH��.�Ե(뼌�q��ƯE��ﳊ�>y��n>��	#�K����6Ek|s�����䉒���n��9b�ۺ�yE�~)�(�8��{�/CO�=�����v�i�ͷ�?;�J�~Et�Qh̛����(n��bv��>���Mg���V��y݀Є��TT<�{.�S�i�{l��q��iE~˼ɣH�{��Q��	�����& �&p��Z4�Ru��:��2M\��>��H�h��C�oK���l�:�	�M^�a��_r��'���~��C�U�䱢���P��	��Iɨ���Ċ�
u������)_�2 �iB�7���K^�i�ʸ������(5*P�wm��&��W�:��iQ�Xf�{������I =o�o�o�+�.���=_Y�F=P�<TC���G��k� �]�����Ǒ���T�|�8�eO{���Ƿ�oU�2j�U1�|#-�n^Xo��������s�of�f�tr�o�eȲ�Q�n{�D<S�#�U�sb.>� ��E����4I�m��A0��y�抰�VG��y�i���\i�/�s�3	�=�+5\��9��}�k�S�_��3	�����_�� �>��@�#8��j�!T/3���z���P�D��w� z\;�t��f鯧 HY��/fLHf6��]f���)ۓ�fN�wE��A���2OEY(l��~������S࿤����j���2�@��5�k�l�e�^���I��V^�E�/��BG��
��k3��m����Zc?U�(�b*oS�$�f���'s��<e%K6q�>�2��8V.&�I�o�C�l`*:ӥ��tC?4���$}��~����e�t� �ڊ��W�?�	�/�G��Q�����I��M������F])zY����ud������S���G�H�����R�'͈�;w��}��d����19Z�e��2��|��cV�S>��~��[���X��`^�����m�]瑹�ǋ���E([����uNs���xZ��.�z�A�\n
��)b�7���ˋJƳ�&U��\�A�.����&M��%��������漋}��c�a����ci�1�KѧE�+���O5�ٯ��	��~���F���������QO������*��������7MD�+Y�FB]���j)���_)?��c����ͥ��Ƅ�+R�$/�\�Ras��W�(��0�&�wi,�lK��S��$&o�V,��I�͔���4�bk�4k��Vrt{�[v�֧%��y�g�C�6
|_����P:.z7;����y��X�I��uǐ&�4����s����ݵ�\4G=/ڲ�r�� ��u]�o2�Ě�qm;B��4��d��i����ly����g�ZM�r��1��dX҉�59ؔ8�m�ݴ�ߌ�}F4����HÑs��ю�Z�4w^8��v���Y3�ل�X��/��ض}l���oJ�ͺB9��Ѿ�ﰣ���Q�M�Ms�^�q�x^��N��9N���vlm��5����I�O�D�k���s�P��<Ì���J���yẌ���b��5�*j�t`�Ȩ��b�PS���T�	��c�5f��S��UIu�L��V�4-����~��
��Z�C:�9��j�Ni�7J��kl����K�s��tXi�x=o�m�u}�(��|{��gR�Fq�~����fa%�,lY�K�9\�IU�N��ʆ��4�|�w��+8-Q�u�O"%�r\7�������Ć���P�uv����R-9�C7�bʴiN�������,Y)��������e!����!���C��"��$ɇ��n��u�k�h���+^�¯a�D�%�E��G�§��x��P�;�EC��$^UYMG��u�n�4��^x(|>x�ԝ󶣙ȚU`��1 �߉���%���bےm�<%���7s�LҊu�jm��y�{����ݙ:��)��R��!�@����M�H���:(3���II���N�1I�yӼqa��e�\�x����JlGs	
�y F��oF�F%Ƌ�qt>Hs6o���܉�ԦI/��^�VN�n�˰���n�Y-ض�{��Q�&Hl=/�l�9�lDŪ���"���6M�|a���J�nb�C{�k�w�}O��P�U�o*��wJ�B=h��y�WN�T�'">O��/�i$���h���moy=҂ܺ�8S��2D��7�L�'^=�r���m���G�.��d�i��Qe
6Oے�M9�w��`�	�����&x$~N��Zyҕ�/�����&%TvZj�T�n�^�_�3��J]�/�\�YV�Y�ّ�7*W�'���oA"V5�ƃ�nd�KR,��k����6����y��{,�H�n'��1�����oJ��S����y�/'�{��4oSq4ǠMS:^��]�����M�����b�K�e�1����M#%񳗮#��9"m�IV�FWr��?.m>=��d��p̳d��ѡE$ݾbc�$"��!���ӠJ��<��1b���e��,��k�V�����~�xs�[:�tI$�@n$l`i��?��֏��f��E޷8�Yw�r��6�۠�[e&�n���27)��o(C�TP>�V�&H�K��]�֢l��;hJW��zҦ�|�q��5.뾺ڧ�l�A G�P���R��R��xRWG4�nZ��\������h�м�d��6!��!�~ �sS��2���[�ߔ
�e��(Q��d��$Aٝ���*�y��놭�PK���F����ڄ����вc�S*��#Q�#�e,���ε��0��,$�2M�~�.=jV�,8\�G�S�s]�^�UC#��M���I�X}�n�r��y���<�b���3~p�i��)�f�dH�q%��%�I����������!�}=d\lق�ǪX'e>!����әo�Z��i�P�FEi�ciɧS����Oh����VA�9�2�,�K� M3��X{�E���a�=�i�^�V`9�x����R���p�Wve+�m�̔�b\��iӨ�>�tʪn�.�F�K���{qb�=����k��I��KH�9v��,C��	khjE[��Ц	�Fur6�7����i�~�C��CZ��1k>?���*���Y�^'R�4�'K�j��3c�[�V�<�h[�~<�B.ʥ�I���!��YX[6�>���({Q4��ՙ�Ц�|�����"��?/Z+��� �V�΀�7�?�+
�0�5Gº�!�i��,�D�7�[�~�]xXK��]C�Ufu2��9������7���,Cl&��<"�'֕�2��6����Qb��*L�=NѺ�i��y"����-���X৒�/�,Z�.�X��CK.֩�sm���[7�Ln�"m*�z�ǣ� ���Cǡ�oJ�?�ҏ�Ȗ��zA_z��(ΣB)���/\�t����M%dmsfD��gc��&T� ,	  ɰ��NH��t3�p>�ΑÎ=ѦX/|-V�^E�YzI�Z���q2�B0���:��oJ�_4|bʦa���eM�\@�pm�S��^*R.��A��"�|Z=E7���B�}��9��.��cY񖵓�2�Eױ�U/�6M���>l��w�v|=�,���'�=��4����Ϧ�i��������j����{>8;��UN�U���ɋ�b5�ڲ������=�O�D6�"�ȁ�X �{����+K2m�}ጋ,����8�ZN۰Omv��:h6�s]�S*���'�
�H��@4]Eِ9�Fm>���l��=��M���]�!��D��q �m�o�H����B�@MTg!&���:V�&��Ԧ9�o<��t�0��Hd��e.�ͨ�x�XR��oH|�]�|�S��]C<Y��-z��N;m�����&����%�A�C�d�@۶6}tH��M�.�3K�� ���yC=/Kd����=�2MK��G���$�r�'�P��y�ж�W��=�oZ=���e�!$�t�֞���!��+��H�i�򅏶<zγ��~m�����c!���<'����K���A��G#~�e��-�~��B2��M�&b_��y��{�ޢ@��M�]�}���!Օ�	X�?���|Z�tH7�;1�%2AR@��4��77ٽp8��q�զbZ�$�v(�0�J\�?ߕ��}%z$���H�b�FF�UUW��4Z����h�k{?Cw��*�-��F8����������Um{H>�ȑ���):��g�ʴi:���$t�x�NR�+k�lF����G�	�P��NO�{�N���V�p`O�!GG\UKQL�4G񅽠82{.[���I��ً�|�Fs`{���ͱ��	�H��)�$Ce�2���9������G�r�p/�d�*�W��}��NƬki��a�9#��V��!I�)o��I�*�����Ҧ)�o|����1���+*��΅K�X.���>��šŇ���P���ҩ��%�5צI>/<�����q�L�.�vy��
Qzm�Ѿv7�G�'z���5+��$6O��8�%{xi�
���B�S���M�ej�6i3$7�cDG��M�.�G�DJ�]�[����mZ�ye>E���h.����m�]'([V�n9��C_`��7�?�rR~ŉ��� ��IM:U�*�LC��}%V��������]%"��'<�����O�T�_.β�,T�$m�܆��}��S�?8u��SbO������V�54�'�8���&^%~���r:�z�%�e������A���|a��ܲ��m��p.�>l>"$��"����ߴ�?[8�\��*;�iE&҅����B�F���X��WN]1����u��Z[>�t ��W��Q�ʈ�Î�˳f5�y��4�ILu��i��p����X"H뤠#�lJ
"t1������5�?7C�»T�*_0VU��lٮ&��ih^�������n
ޡ�jڽ��~'?�B�U�W��)�r��F�C�?�i��X���t��gD�F����;n/9J��CǾ6��Zr=���G����T���}�2~h}Ue�1嵩�����S�>x�7�}��~�����>rd�wB���\�c�a�i)����t�Ji��ĺ6MM~�dl��.X���/��sh��|�
����H��2�Ĩ"1�tɖt^8���d���4Z�w̝b���8�Ph�*�)E"� ��Ñ{����+�����vC��oړ�=e�YsWmlӦ��ƊLAR�p]QFz�����3Z���|�o�R�'z�Gע&_�dB���u�n���4����ר��_�X;�k��/�S��7{)�s,��m��R��:Zƈ�J��Ц�ya���eQ��A� h�jފj�)B��{66K��3"�sc����!�/�r���f�8�6�,_��{s��>��]!۹��}��P������%b6�_�����������,7U�f/_8����cx�,���dh����/�/�I(��?�>��r����J�˚Mm�k�P����ۓ�9�"^�3�(�|H�m�o(%����˧�]pGɵ��C�:e��}�r�E�Gq��<�T��� �����|�fi��?2D>��,*�s�k��fE�.b�^���|�X�)+�0���`�|j��)F;���A��澖ğ��g i����R݌�:��*��4�_^8[Ҹ�>���MMUR������#�Y�����Y�X�)jf�с���R6U?��4�yZF�w��o׉�MK��WN��iڱlH��iH$~�DR8  ������Z�2[Z�D�4Q��s#"o+�8������GKH1��|̣�͝X����������B�      �   �  x�]�K��8F��W�QϺQ��M���� �Q~}}oy�g�X�핝�����E@��8O����I\͋�K��MWŏ��mX[�h���O?P�k�I���?��~����G�T��H� (� v�E?t_�q��˴鲾�?�[zO�\��;~�VL���ǯ��� M�~���P�3g$e\���܈��I�&}|~3�܌-q  3�>���	|d$�%7�t.B�SuM�-M�/���	
���V'�TC�s������l-�xK��\?��3j�.#mrݾɸEPA'U ���Iu��)2�KX��,�D6��9
��iԣ�,�����[N��� N�%��`��q���s5D��뵹"$R,��
$�_*[��	�vw�q�����]�0(k?���-�E���ZP�P�E���>C�.�ʨ�&td�T�L�t+M�i�}��i��2�ҌN�*Y��� ���\�]Zk��}A�,{b�����=K}c���F9��'b�;P�mJܫ [�E�ӷ׺��[e���1:���7QD�%@��kM}3{����z �t]�(a�\�b���k��{^��k���a��M��s�Uo(�Ո.�^�p�@Zf��A*#Wg�)�^�הy[�HV��䕷(ֱ�P�U�R�ZN$��-�$gѵX�q��ϡ�:�,�T�'ӖH�a$h�3�m1eJ[r�ګu*�sD��,�}�1�H�N����{O���c%��$�< �GL����r����K�wd��i���<j��)����̈Zx�1̓��řI���b�P3��Vf��Pt,�@��\.�3�~�������nA,��(i��	�E�s_M�Z%�<�><��Ae�R��d�زó�3&<#�٘<m:"��Ĉ��7��v+��)��d ��>讣!K�N�4��lH���BJ�N� ��铿��Z�E����oq����Bx�8����W�l�z��g)��͐T�t#q��z��#��,����bM	)��z
}R���}�شц�0�H�T��A�5�W-�zrc'���4ߧ%M'�]�>��k/��-�u�h8���"�q�Ʊ;�x.+</x׮�:��+*Gd���,�Fܢ��y[��k�^"�A ˆ y�r:)b��(��_�{�����4ҏ����UG؍����?iٿςu�2E��+I�ܛ �L^�g�d�t-��`�=k��qj�꯲�.tY���;�̑@�-Z��_y�Z�9M~��%��6��?S2k      �   �  x�e�K�;D�}S�$�{y�_�K�Q8<��yTi���Z��BD��O�Lsm3�?��%��\�Y?Nf�����y2��}�f�Y�oM�Yav�܎�	f�Y�S����H�:�NL'�7�_�=Ky"adٳ��<fdُws��,kϒa�kF��g���F�Uf��7��:}� YV����dY��R	��1��涴|���exPti��-���2����[o������R��Z��o:Z���9nmK�W�e7_NT���^�[�Gy�������<3����鸧�����������ҟ+�]-�����-[ˇo�Z�C�m-aN�۶�o�|����=�~�oa�����w�(����w�F�z�yȏ�b݊V��O�PX�km��:�m�[��o�ލiF�74�V���`�6����u�1�
��U��C�p�
z%+KKb:0�h(o�nm#X�h��x��LL
;������ <��p�v�G������m&�:�%���`���UZ��xex`*d?�:�v�T��R���,�5�9�xc�Lf���Q��{�[c!H߯������H�`����wXm܆?8���H{����1�HN�K�m���0�E�@��eRfy�	ISj]�:K�.H�yb�x�ъ���\D	am�b�@~�M+��m�|� 5X�餙H�����;���Ͱ�����n107w1TP Nć;���xx9�����b��B�̘���6Un����m �Ý�ۼ �v��Q�h�G�;�46��r7w���j�xw:��:����b J�w����_wT�[%^w�}@�
"�͝)�E����ǎ���xć;- W�>	6w�_	\��ᮓ�Mbʛ�	H���g��n
��	��r7����w#]8�lq7_�5BgZ���ƊՁ.w�0<1и��՗T���n6\��o��%�����]�;����n�_ՊÝ��� �;a��u��3᷇� @�z��Q4\TUw:����?6wu��4.w�r��ޟwe����n~�]�I.YA��;��MA��͝�~獩�����[��.�v�%{s�򊽹�7��]�{	z��N�Y_��d��Eޭ7w�y���Y����`���N�ƞ�,_��wiw�;g�W�s6m�~����ӛ���!�3g��ĝ�"`���I��9����.���qsg7aI���+~�]����V�sV�2z�]����Yܥ�蝳r�T����χ�+�^�Zrp���as�T����j�;����N��y��gi^�%B�rW.6v���]��7�]�ʳ-�9��^��*�;�*���,Y[��1O�ky��ܕ�w��]гc.�f��;��E�17wk��sqW$�I�1O��ώ���;��n&�W�͝<+���$����i^1'w�k�g��β웻���w�[�o6���@�ܥv�w�h~���������! Z      �   4   x�3��M�I�M,�2�L�,J���M��2�KR�2s�L@����l�=... w��      �   7   x�3�L��I,�/�N��2r�SKJ�J3�������l. ��(�8��+F��� �      �   �  x�e�[�\1D�݋��<����:R���1����6���ↅ\�C�ʤ�'?�J[�K1%��+�ҙR��!�Rv��t��KJ]�)q�tJ�K6%�OI�4�j]z�.�6=�6=�6=�5=�5=�5=�5=�5=�5*�}Q��u�5�zo�=�ި{�Q��{���F�C�-�zo�=���{��e��e��e��e��e��e��e��e��e��e��u��u��u�Ϸ4��/�C��A_�:�]�*|��΅K���[���!�ufK4�1��u߃�L��ey+�V�w��2K�BE�c�-M�	��8�V�����e�!DzK�\P����-�5u���~�y�R�!�W)��r�+݃a��g!�v�u���G��RŃ(Vl����F�g^�;��^�B���)��j����_��a@�λP2C[�Lf�V��.0��%Y%�QMYQ2��}*�fl�dV�ڗ�t��U��� 3�!Oy�TNŘ�[��0�0�*��E13�'*�C�G�}�� �Dg)IY�
�~b� ѥ��O]�ǓT���6;�������ҧT��dx Ė$��Ͱ����[q���9������K �r3�e(�5 $9�"�T�kT��
t�+�� �b+{�`�"20�-a�;+���uĎ�I�/k�n6<��c ւ�HyF2$(F��r��z�c8� ��/)�����@������]���9t{W�!<�|!�|�^��T�G!�*S �uV���Z�[x�!=߱NJ�Y��	I.<�%x���b�̆Q��^����*��.Ox�0؅{a��{�n�e��*tzF�ZJ���0�+�W�����{�ݙa\��|�(o�s�>a������Q9O��ʅ��������?\�p�[?XZxmՒR7z%<2W�i�]R>Ԩ����ݎb�KK���[pA�����(0�ʋ^�dǱ ��˹� #X��w����|>��g�h      �      x�3204�4�2QFʘ+F��� 7@�     