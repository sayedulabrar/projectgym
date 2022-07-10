--Number of Managers.
SELECT COUNT(*) FROM Employee WHERE Designation="Manager" ;
--list of managers
SELECT Name,Email,Br_name,Salary FROM User Natural Join Employee where Designation="Manager" ;


--Average of Registration fee
SELECT AVG(Reg_fee) FROM Branch;
--Registration fee of all the branches
Select Br_name"Branch Name",Reg_fee"Registration fee" FROM Branch;

--Number of branches
SELECT COUNT(*) FROM Branch ;
--list of branches
SELECT Br_name,Br_Revenue,Br_Expendeture,Br_profit FROM Branch;

--member count
SELECT COUNT(*) FROM Member ;
--Number of Packages.
SELECT COUNT(*) FROM Package ;

--Number of Purchased Packages.
SELECT COUNT(*) FROM M_PKG ;

--Total Revenue,cost,expenditure
SELECT SUM(Br_Revenue),SUM(Br_Expendeture),SUM(Br_profit) FROM Branch;


--Profile for Manager
Select * From User Natural Join Employee WHERE Designation="Manager";

--profile for Owner
Select * From User Natural Join Employee WHERE Designation="Owner";

--Message list for Owner

Select Mes_ID, Reciever_ID, Subject, Description, Username  From Message
 where Rciver_ID IN (Select Emp_ID FROM Employee  where Designation="Owner");

--Manager ADD
INSERT INTO User(Username,Name,Email,Gender,Mobile_No,Address,Blood_Grp,Acc_No)Values('','','','','','','','');
INSERT INTO Employee( Username, Emp_ID,Salary,Shift,Experience,Designation)Values('','','','','','Manager');



--Search Branch from manager or Branch Information
SELECT Br_name,Br_Revenue,Br_profit,Br_Expendeture,Username FROM
(Select Username from User Natural Join Employee WHERE Designation="Manager")tt,Branch ORDER BY Br_Revenue;

--Search Manager

Select Name,Br_name,Salary,Experience from User Natural Join Employee WHERE Designation="Manager";