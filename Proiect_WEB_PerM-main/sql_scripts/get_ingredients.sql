CREATE OR REPLACE FUNCTION get_ingredients(p_name varchar(40)) 
RETURNS varchar(100) 
LANGUAGE PLPGSQL
AS
$$
DECLARE
	v_result varchar(100);
	rec_ingredients record;
	cursor_ingredients CURSOR(v_name varchar(40)) FOR select i.name from products p join ingredients i on p.id=i.id_product where p.info_url=v_name;
BEGIN 
	open cursor_ingredients(p_name);
	loop 
		fetch cursor_ingredients into rec_ingredients;
		exit when not found;
		v_result := concat(concat(v_result, rec_ingredients.name), ', ');
	end loop;
	close cursor_ingredients;
	return substr(v_result, 1, length(v_result) - 2);
END
$$;

-- select get_ingredients('ari');