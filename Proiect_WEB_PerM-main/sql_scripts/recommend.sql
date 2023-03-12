
create or replace function array_unique (a text[]) returns text[] as $$
select array (
	select distinct v from unnest(a) as b(v)
)
$$ language sql;

create or replace function recommended(p_name varchar(40)) 
returns text[] 
LANGUAGE PLPGSQL as 
$$
DECLARE
	v_manufacturer products.manufacturer%type;
	v_category products.category%type;
	v_gender products.gender%type;
	v_rec record;
	v_array text[];
	v_cursor1 CURSOR(v_name products.info_url%type, v_manufacturer products.manufacturer%type,
					 v_category products.category%type, v_gender products.gender%type) FOR 
		SELECT info_url FROM products WHERE 
		 manufacturer = v_manufacturer AND
		 category = v_category AND
		 gender = v_gender AND
		 info_url != v_name;		
	v_cursor2 CURSOR(v_name products.info_url%type, v_manufacturer products.manufacturer%type,
					 v_gender products.gender%type) FOR 
		SELECT info_url FROM products WHERE 
		 manufacturer = v_manufacturer AND
		 gender = v_gender AND
		 info_url != v_name;	
	v_cursor3 CURSOR(v_name products.info_url%type, v_gender products.gender%type) FOR 
		SELECT info_url FROM products WHERE 
		 gender = v_gender AND
		 info_url != v_name;	
BEGIN
	select manufacturer, category, gender into v_manufacturer, v_category,
		v_gender from products where info_url=p_name;
	
	OPEN v_cursor1(p_name, v_manufacturer, v_category, v_gender);
	loop 
		fetch v_cursor1 into v_rec;
		exit when not found or array_length(v_array, 1) = 3;
		v_array := array_append(v_array, v_rec.info_url);
		select array_unique(v_array) into v_array;
		--RAISE NOTICE '[%]', v_rec.info_url;
	end loop;
	
	if array_length(v_array, 1) < 3 or array_length(v_array, 1) is null then
		RAISE NOTICE '[%]', array_length(v_array, 1);
		OPEN v_cursor2(p_name, v_manufacturer, v_gender);
		loop 
			fetch v_cursor2 into v_rec;
			exit when not found or array_length(v_array, 1) = 3;
			v_array := array_append(v_array, v_rec.info_url);
			select array_unique(v_array) into v_array;
			--RAISE NOTICE '[%]', v_rec.info_url;
		end loop;
	end if;
	
	if array_length(v_array, 1) < 3 or array_length(v_array, 1) is null then
		RAISE NOTICE '[%]', array_length(v_array, 1);
		OPEN v_cursor3(p_name, v_gender);
		loop 
			fetch v_cursor3 into v_rec;
			exit when not found or array_length(v_array, 1) = 3;
			v_array := array_append(v_array, v_rec.info_url);
			select array_unique(v_array) into v_array;
			--RAISE NOTICE '[%]', v_rec.info_url;
		end loop;
	end if;
	
	RETURN v_array;
END
$$;

-- select recommended('ari');

