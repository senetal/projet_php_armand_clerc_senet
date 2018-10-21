--SELECT p.ref,p.name,p.price from products as p  WHERE (SELECT ref FROM panier WHERE name = 'clercma') = p.ref;

SELECT p.ref,p.name,p.price,q.count from products as p , panier as q WHERE q.name ='clercma' and q.ref = p.ref;
