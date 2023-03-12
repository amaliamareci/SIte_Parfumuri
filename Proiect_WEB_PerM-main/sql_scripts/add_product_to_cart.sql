

CREATE OR REPLACE PROCEDURE add_product_to_cart(p_username varchar, p_product varchar, p_quantity integer)
LANGUAGE PLPGSQL AS
$$
DECLARE
	v_user_id integer;
	v_product_id integer;
	v_quantity integer;
BEGIN
	select id into v_user_id from users where username=p_username;
	select id into v_product_id from products where info_url=p_product;
	
	select quantity into v_quantity from cart where id_user=v_user_id and id_product=v_product_id;
	
	if v_quantity is null then 
		insert into cart values(v_user_id, v_product_id, p_quantity);
	else 
		update cart set quantity=v_quantity+p_quantity where id_user=v_user_id and id_product=v_product_id;
	end if;
END
$$;

-- call add_product_to_cart('aaaaa', 'black_opium', 5);

-- select * from cart;

