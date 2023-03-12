
CREATE OR REPLACE PROCEDURE add_products_to_sale(p_username varchar) 
LANGUAGE PLPGSQL AS
$$
DECLARE
	v_user_id int;
	v_rec record;
	v_cursor CURSOR(p_user_id integer) FOR
		SELECT p.id, c.quantity FROM products p join cart c on p.id=c.id_product WHERE c.id_user=p_user_id;
BEGIN

	select id into v_user_id from users where username=p_username; 
	
	open v_cursor(v_user_id);
	loop
		fetch v_cursor into v_rec;
		exit when not found;
		insert into sold values(v_rec.id, v_rec.quantity, CURRENT_DATE);
		update products set stock = stock - v_rec.quantity where id = v_rec.id;
	end loop;
	close v_cursor;

	delete from cart where id_user=v_user_id;
END
$$;

-- call add_products_to_sale('aaaaa');

-- select * from sold;

-- select * from cart;
