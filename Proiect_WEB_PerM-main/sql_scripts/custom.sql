
create or replace function hasIngredient(p_name varchar(100),p_id integer) RETURNS integer LANGUAGE PLPGSQL AS $$
declare
	v_raspuns integer;
begin
	SELECT count(*)into v_raspuns  FROM ingredients where id_product=p_id and name=p_name;
	return v_raspuns  ;
end
$$;

create or replace function product_season(season varchar(100),p_id integer) RETURNS integer LANGUAGE PLPGSQL AS $$
declare
	v_raspuns integer;
	v_month integer;
begin
	select cast(to_char(p.release_date, 'mm') as integer) into v_month from products p where p.id=p_id; 

	v_raspuns := 0;
	
	if season = 'spring' and v_month >= 3 and v_month <= 5 then
		v_raspuns:=1;
	end if;
	if season = 'summer' and v_month >= 6 and v_month <= 8 then
		v_raspuns:=1;
	end if;
	if season = 'autumn' and v_month >= 9 and v_month <= 11 then
		v_raspuns:=1;
	end if;
	if season = 'winter' and (v_month = 12 or v_month = 1 or v_month = 2) then
		v_raspuns:=1;
	end if;
	
	return v_raspuns;
end
$$;

CREATE OR REPLACE FUNCTION getCustomRecommendation(p_answer1 VARCHAR(50),p_answer2 VARCHAR(50),p_answer3 VARCHAR(50),p_answer4 VARCHAR(50)) RETURNS varchar(150) LANGUAGE PLPGSQL AS $$
DECLARE
	v_rec record;
	v_rec_product record;
	v_cursor CURSOR(v_id integer)FOR
		SELECT name FROM ingridients where id=v_id ;
	v_cursor_products CURSOR FOR SELECT id,info_url FROM products;
	nr integer;
	nr_max integer;
	v_url products.info_url%type;
BEGIN
nr_max:=0;
	open v_cursor_products;
	loop
		fetch v_cursor_products into v_rec_product;
		nr:=0;
		exit when not found;
			if p_answer1 = 'date_night' then
				nr:=nr+hasIngredient('zmeura',v_rec_product.id);
			elsif p_answer1 = 'everyday' then
				nr:=nr+hasIngredient('mosc',v_rec_product.id);
			elsif p_answer1 = 'night_out' then
				nr:=nr+hasIngredient('orhidee',v_rec_product.id);
			elsif p_answer1 = 'office' then
				nr:=nr+hasIngredient('piper roz',v_rec_product.id);
			elsif p_answer1 = 'special_occasion' then
				nr:=nr+hasIngredient('hibiscus',v_rec_product.id);
			end if;
			
			if p_answer2 = 'chai' then
				nr:=nr+hasIngredient('para',v_rec_product.id);
			elsif p_answer2 = 'cookie' then
				nr:=nr+hasIngredient('lotus',v_rec_product.id);
			elsif p_answer2 = 'cut_grass' then
				nr:=nr+hasIngredient('bujor',v_rec_product.id);
			elsif p_answer2 = 'mulled_wine' then
				nr:=nr+hasIngredient('lemn',v_rec_product.id);
			elsif p_answer2 = 'ocean' then
				nr:=nr+hasIngredient('magnolie',v_rec_product.id);
			elsif p_answer2 = 'pina' then
				nr:=nr+hasIngredient('floare de portocal',v_rec_product.id);
			elsif p_answer2 = 'rose' then
				nr:=nr+hasIngredient('trandafir',v_rec_product.id);
			elsif p_answer2 = 'wood' then
				nr:=nr+hasIngredient('lemn',v_rec_product.id);
			end if;
			
			if p_answer3 = 'beach' then
				nr:=nr+hasIngredient('orhidee',v_rec_product.id);
				nr:=nr+product_season('summer',v_rec_product.id);
			elsif p_answer3 = 'hiking' then
				nr:=nr+hasIngredient('frezie',v_rec_product.id);
				nr:=nr+product_season('autumn',v_rec_product.id);
			elsif p_answer3 = 'ski' then
				nr:=nr+hasIngredient('jasmine',v_rec_product.id);
				nr:=nr+product_season('winter',v_rec_product.id);
			elsif p_answer3 = 'versailles' then
				nr:=nr+hasIngredient('orhidee',v_rec_product.id);
				nr:=nr+product_season('spring',v_rec_product.id);
			end if;
			
			if p_answer4 = 'coffee' then
				nr:=nr+hasIngredient('cafea',v_rec_product.id);
			elsif p_answer4 = 'mimosa' then
				nr:=nr+hasIngredient('floare de portocal',v_rec_product.id);
			elsif p_answer4 = 'rose' then
				nr:=nr+hasIngredient('trandafir',v_rec_product.id);
			elsif p_answer4 = 'scotch' then
				nr:=nr+hasIngredient('lemn',v_rec_product.id);
			end if;
			
			if nr>nr_max then
				nr_max:=nr;
				v_url=v_rec_product.info_url;
				end if;
	end loop;
	close v_cursor_products;
	return v_url;
END
$$;

-- select getCustomRecommendation('office','','','');
-- select hasIngredient('zmeura',1);

-- select * from ingredients;

