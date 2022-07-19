create or replace procedure myproc2(myrc out sys_refcursor,x in out number) as
   begin
     open myrc for select * from DIET_CHART where DIET_ID=x;
   end;