---raport on stock based on gender,category
create or replace function raport_stock(p_gender varchar(40),p_category varchar(40)) 
returns text[] 
LANGUAGE PLPGSQL as 
$$
DECLARE
	v_cursor CURSOR(p_gender varchar,p_category varchar) FOR
		SELECT p.info_url,p.stock FROM products p  WHERE p.gender like p_gender AND p.category like p_category; 	
	v_parfumes  text[];
	v_rec record;
BEGIN
if p_gender = 'toate' then
	p_gender = '%';
end if;

if p_category = 'toate' then
	p_category = '%';
end if;

open v_cursor(p_gender,p_category);
	loop
		fetch v_cursor into v_rec;
		exit when not found;
		v_parfumes := array_append(v_parfumes,v_rec.info_url);
		v_parfumes := array_append(v_parfumes,CAST(v_rec.stock AS varchar));
	end loop;
close v_cursor;
return v_parfumes;
END
$$;

-- select raport_stock('femei','orientale');


---raport on sold based on gender,category,time
create or replace function raport_sold(p_gender varchar(40),p_category varchar(40),p_time date) 
returns text[] 
LANGUAGE PLPGSQL as 
$$
DECLARE
	v_cursor CURSOR(p_gender varchar,p_category varchar,p_time date) FOR
		SELECT p.info_url,s.quantity_sold FROM sold s join products p on s.id_product=p.id WHERE p.gender like p_gender AND p.category like p_category; 	
	v_parfumes  text[];
	v_rec record;
BEGIN
if p_gender = 'toate' then
	p_gender = '%';
end if;

if p_category = 'toate' then
	p_category = '%';
end if;

open v_cursor(p_gender,p_category,p_time);
	loop
		fetch v_cursor into v_rec;
		exit when not found;
		v_parfumes := array_append(v_parfumes,v_rec.info_url);
		v_parfumes := array_append(v_parfumes,CAST(v_rec.quantity_sold AS varchar));
	end loop;
close v_cursor;
return v_parfumes;
END
$$;

-- select raport_sold('femei','orientale',CURRENT_DATE);
-- select * from sold;

