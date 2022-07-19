
--1.
CREATE SEQUENCE DIET_ID_GENERATE_SEQUENCE
INCREMENT BY 1
START WITH 101
MAXVALUE 50000
NOCACHE
NOCYCLE;

--2.
CREATE OR REPLACE FUNCTION AGE(X IN DATE)
RETURN NUMBER
AS
Today DATE;
Var NUMBER;
	
BEGIN
	Today:=SYSDATE;
        SELECT ROUND((Today-X)/365) INTO Var from dual;
RETURN Var;

END;

--3.
CREATE TABLE FIXED_BY_TRAINER
(
        Serial_No NUMBER NOT NULL primary key,
        Trainer varchar2(50),
        Username varchar2(50),
        Diet_Id NUMBER,
        Fixed_Date DATE DEFAULT SYSDATE,
        Fixed_Time varchar2(12),
        Action VARCHAR2(10)
);



--4.
CREATE SEQUENCE Action_NO_SEQ
 START WITH     1
 INCREMENT BY   1

--5.
CREATE or REPLACE TRIGGER FIXED_BY_TRAINER_TRIGGER
        AFTER UPDATE OF DIET_ID
        ON MEMBER
        FOR EACH ROW
        DECLARE 
        v varchar2(12);
        f varchar2(52);
        BEGIN
        dbms_output.put_line('trigger called');
        v := 'Inserted';
        select TO_CHAR(SYSDATE, 'HH:MI:SS AM')  into f from dual;

        INSERT INTO Fixed_By_Trainer VALUES (Action_NO_SEQ.nextval,:new.Trainer,:new.Username,:new.Diet_Id, SYSDATE,f,v);
        END;

--6.
CREATE SEQUENCE TRX_ID_GENERATE_SEQUENCE
INCREMENT BY 1
START WITH 1000

--7

CREATE or REPLACE TRIGGER TRIGGER_INCOME
        AFTER UPDATE OF MEMBERSHIP_EXPIRY
        ON MEMBER
        FOR EACH ROW
        DECLARE
        var1 NUMBER;
        var2 varchar2(50);
        var3 varchar2(50);
        var4 varchar2(50);
        var5 varchar2(5);
        BEGIN
        dbms_output.put_line('trigger called');
        var2:= :new.username;
        var4:= 'Member Payment';
        SELECT PKG_CHARGE INTO var1 FROM PACKAGE NATURAL JOIN M_PKG WHERE USERNAME=var2;
        SELECT BR_NAME INTO var3 FROM USERS NATURAL JOIN M_PKG WHERE USERNAME=var2;
        INSERT INTO Income(TRX_ID,USERNAME,INC_AMOUNT,BR_NAME,INC_TYPE,INC_DATEANDTIME) VALUES (TRX_ID_GENERATE_SEQUENCE.nextval,var2,var1,var3,var4,SYSTIMESTAMP);
        END;