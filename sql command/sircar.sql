create or replace procedure myproc2(myrc out sys_refcursor,x in out number) as
   begin
     open myrc for select * from DIET_CHART where DIET_ID=x;
   end;


CREATE OR REPLACE FUNCTION BMI(w IN OUT NUMBER, h IN OUT NUMBER)
RETURN NUMBER
AS
bm NUMBER;
BEGIN
	h:=h/100;
	h:=h*h;
	bm:=w/h;
	RETURN bm;
END; 
