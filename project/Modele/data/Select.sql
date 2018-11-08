--SELECT p.ref,p.name,p.price from products as p  WHERE (SELECT ref FROM panier WHERE name = 'clercma') = p.ref;

--SELECT p.*,q.count from products as p , panier as q WHERE q.name ='clercma' and q.ref = p.ref;


--Update panier SET count = ((Select count from panier where name ='clercma' and ref =0)+1) where name ='clercma' and ref =0;

DELETE  products,panier
from products
 INNER JOIN panier
 where panier.ref in (Select ref from panier where name ='clercma' )
  and products.ref in (Select ref from panier where name ='clercma' );
