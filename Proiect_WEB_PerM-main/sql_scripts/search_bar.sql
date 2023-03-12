CREATE OR REPLACE FUNCTION GETPRODUCTSFROMSEARCHBAR(P_SEARCH VARCHAR(100)) RETURNS text[] LANGUAGE PLPGSQL AS $$
DECLARE
	v_products text[];
	v_rec record;
	v_cursor CURSOR FOR
		SELECT info_url,manufacturer,name,category,gender,type FROM products ;
	v_first_product products.info_url %type;
	v_second_product  products.info_url %type;
	v_third_product  products.info_url %type;
	v_first integer;
	v_second integer;
	v_third integer;
	nr integer;
	i varchar;
	number integer;
	v_search  text[];
BEGIN
	v_first := 0;
	v_second := 0;
	v_third := 0;
	v_search :=  string_to_array(p_search, ' ');
	open v_cursor;
		loop
			nr:=0;
			fetch v_cursor into v_rec;
			exit when not found;
			FOREACH i IN ARRAY v_search
			loop
				if position(lower(i) in lower(v_rec.manufacturer)) >0 then
					nr:=nr+1;
				end if;
				if  position(lower(i) in lower(v_rec.name))>0 then
					nr:=nr+1;
				end if;
				if v_rec.category = i then
					nr:=nr+1;
				end if;
				if v_rec.gender = i then
					nr:=nr+1;
				end if;
				if v_rec.type = i then
					nr:=nr+1;
				end if;

			end loop;
		if nr > v_first then
			v_second := v_first;
			v_second_product := v_first_product;
			v_first := nr;
			v_first_product := v_rec.info_url;
			elsif nr > v_second then
				v_third := v_second;
				v_third_product := v_second_product;
				v_second := nr;
				v_second_product := v_rec.info_url;
				elsif nr > v_third then
					v_third := nr;
					v_third_product := v_rec.info_url;
		end if;

	end loop;
	close v_cursor;
	v_products := array_append(v_products, v_first_product);
	v_products := array_append(v_products, v_second_product);
	v_products := array_append(v_products, v_third_product);
	return v_products;
END
$$;


-- SELECT GETPRODUCTSFROMSEARCHBAR('black_opium_floral_shock Yves Saint Laurent');