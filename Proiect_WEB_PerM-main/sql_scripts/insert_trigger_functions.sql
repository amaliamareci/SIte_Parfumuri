CREATE OR REPLACE VIEW products_view AS 
	(SELECT p.name,manufacturer,stock,new_price,old_price,quantity,category,gender,type,info_url,release_date,i.name as i_name
	FROM products p join ingredients i on p.id=i.id_product);
	
create or replace procedure insert_from_file()
as
$$
begin 
	COPY products_view(name,manufacturer,stock,new_price,old_price,quantity,category,gender,type,info_url,release_date,i_name)
	FROM 'C:\xampp\htdocs\Proiect_WEB_PerM\api\config\products.csv'
	DELIMITER ','
	CSV HEADER;
end
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION products_insert_row() 
RETURNS TRIGGER
LANGUAGE PLPGSQL
AS
$$
DECLARE
	next_id integer;
	contor integer := 1;
	ingredient varchar(30);
	v_id integer;
BEGIN
	select id into v_id from products where name=new.name;
	if v_id is null then
		select max(id) into next_id from products;
		if next_id is null then 
			next_id := 0;
		end if;
		next_id := next_id + 1;
		insert into products values (next_id,new.name,new.manufacturer,new.stock,new.new_price,new.old_price,
									 new.quantity,new.category,new.gender,new.type,new.info_url,new.release_date);
		SELECT split_part(new.i_name, ';', contor) INTO ingredient;
		WHILE ingredient != '' LOOP
			insert into ingredients values(next_id, ingredient);
			contor := contor + 1;
			SELECT split_part(new.i_name, ';', contor) INTO ingredient;
		END LOOP;
	else
		UPDATE products set manufacturer=new.manufacturer,stock=new.stock,new_price=new.new_price,old_price=new.old_price,quantity=new.quantity
		,category=new.category,gender=new.gender,type=new.type,info_url=new.info_url where id=v_id;
		end if;
	RETURN new;
END;
$$;

CREATE OR REPLACE TRIGGER view_insert
    INSTEAD OF INSERT ON products_view
    FOR EACH ROW
    EXECUTE FUNCTION products_insert_row();


CALL insert_from_file();

select * from products;
select * from ingredients;
