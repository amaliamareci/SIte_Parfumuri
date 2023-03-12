
CREATE OR REPLACE FUNCTION get_products_from_filter(p_type VARCHAR(100), p_category VARCHAR(100), p_value integer)
RETURNS text[] LANGUAGE PLPGSQL AS $$
DECLARE
	v_rec record;
	v_cursor CURSOR(p_type products.type%type, p_category products.category%type, p_value integer) FOR
		SELECT info_url FROM products WHERE products.type LIKE p_type AND products.category LIKE p_category AND new_price <= p_value;
	v_array_type text[];
	v_array_category text[];
	v_response text[];
	v_category varchar;
	v_type varchar;
BEGIN
	if p_type ='' then
		p_type='%';
	end if;
	if p_category ='' then
		p_category='%';
	end if;
	v_array_type :=  string_to_array(p_type, ';');
	v_array_category  :=  string_to_array(p_category, ';');
	FOREACH v_type IN ARRAY v_array_type
	loop
		FOREACH v_category IN ARRAY v_array_category
		loop
			open v_cursor(v_type,v_category,p_value);
			loop
				fetch v_cursor into v_rec;
				exit when not found;
				v_response:=array_append(v_response,v_rec.info_url);
			end loop;
			close v_cursor;
		end loop;
	end loop;
	return v_response;
END
$$;

-- select get_products_from_filter('apa de parfum', 'fructe;orientale', 1000);

