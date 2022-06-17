Create Table Branch
(
Br_Name varchar2(50) NOT NULL,
Br_Revenue NUMBER,
Br_Expenditure NUMBER,
Br_Profit NUMBER,
Br_Rent NUMBER,
Reg_Fee NUMBER
);

Create Table Diet_Chart
(
Diet_Id NUMBER NOT NULL,
B_Vitamin NUMBER,
B_Fat NUMBER,
B_Protein NUMBER,
B_Minerals NUMBER,
B_Carbohydrate NUMBER,
B_Calories NUMBER,


L_Vitamin NUMBER,
L_Fat NUMBER,
L_Protein NUMBER,
L_Minerals NUMBER,
L_Carbohydrate NUMBER,
L_Calories NUMBER,


D_Vitamin NUMBER,
D_Fat NUMBER,
D_Protein NUMBER,
D_Minerals NUMBER,
D_Carbohydrate NUMBER,
D_Calories NUMBER,

Pr_Wrk_Carbohydrate NUMBER,
Pr_Wrk_Protein NUMBER,
Pr_Wrk_Calories NUMBER,

Pst_Wrk_Carbohydrate NUMBER,
Pst_Wrk_Protein NUMBER,
Pst_Wrk_Calories NUMBER
);


Create Table Package
(
pkg_Id NUMBER NOT NULL,
Pkg_Name varchar2(50),
Pkg_Charge NUMBER,
Pkg_Type varchar2(50),
Pkg_Duration Number
);

create Table Exercises_List
(
Exe_Id NUMBER NOT NULL,
Exe_Name varchar2(50),
Beg_Cal_Burn_Per_Set NUMBER,
Inter_Cal_Burn_Per_Set NUMBER,
Exp_Cal_Burn_Per_Set NUMBER,
Exe_Type varchar2(50),
Min_Weight Number,
Beg_Num_Of_Set Number,
Inter_Num_Of_Set Number,
Exp_Num_Of_Set Number,
Min_Age Number,
Min_Height Number,
Beg_Per_Set_Item Number,
Inter_Per_Set_Item Number,
Exp_Per_Set_Item Number
);


create table Users
(
Username varchar2(50) NOT NULL,
Password varchar2(50) NOT NULL,
Name varchar2(50),
Gender varchar2(50),
Email varchar2(50),
Address varchar2(50),
Blood_Grp varchar2(50),
Account_No NUMBER,
Br_Name varchar2(50),
dob date
);

create table Message
(
Mes_Id NUMBER NOT NULL,
Reciever_Id NUMBER NOT NULL,
Subject varchar2(100),
Description varchar2(2000),
Username varchar2(50)
);

create table Employee
(
Username varchar2(50),
Emp_Id NUMBER NOT NULL,    
Salary NUMBER,
Shift DATE,
Experience NUMBER,
Education varchar2(50),
Num_Of_Rating Number,
Rating_Value DECIMAL(2,1),
Designation varchar2(50)
);

create table Member
(
Username varchar2(50),
Mem_Id NUMBER NOT NULL,
Mem_Height Number,
Mem_Weight Number,
Membership_Expiry DATE,
Expected_Outcome varchar2(50),
Memb_BMI Decimal(10,3),
Diet_Id NUMBER,
Trainer varchar2(50)
);

Create Table Routine
(
Username varchar2(50) NOT NULL,
Exe_Id NUMBER NOT NULL,
Days Number,
Followed_Set Number
);

Create Table Income
(
Trx_Id NUMBER NOT NULL,
Inc_Status varchar2(50),
Inc_Amount NUMBER,
Inc_DateAndTime TIMESTAMP WITH TIME ZONE,
Inc_Type varchar2(50),
Inc_Details varchar2(50),
Username varchar2(50),
Br_Name varchar2(50)
);

Create Table Br_Pkg
(
Br_Name varchar2(50) NOT NULL,
Pkg_Id NUMBER NOT NULL
);

create table Equipment
(
Equipment_Available Number,
Equipment_Quantity Number,
Equipment_Id NUMBER NOT NULL,
Equipment_Name varchar2(50),
Equipment_Brand varchar2(50),
Equipment_Model varchar2(50),
Br_Name varchar2(50)
);

create table Maintenance
(
Mai_Id NUMBER NOT NULL,
Mai_Date Date,
Repairer_Name varchar2(50),
Cost_Of_Repairing Number,
Repairer_Company_Name varchar2(50),
Repairer_Contact_No varchar2(50),
Delivery_Date Date,
Equipment_Id NUMBER
);

create table Expenditure
(
Exp_Id NUMBER NOT NULL,
Amount NUMBER,
Exp_DateAndTime TIMESTAMP WITH TIME ZONE,
Exp_Reason varchar2(50),
Br_Name varchar2(50)
);


Create Table User_MobileNo
(
Username varchar2(50) NOT NULL,
Mobile_No varchar2(50)
);



Create Table M_Pkg
(
Username varchar2(50) NOT NULL,
Pkg_Id NUMBER NOT NULL
);

ALTER TABLE Branch
ADD PRIMARY KEY (Br_Name);

ALTER TABLE Diet_Chart
ADD PRIMARY KEY (Diet_Id);

ALTER TABLE Package
ADD PRIMARY KEY (Pkg_Id);

ALTER TABLE Exercises_List
ADD PRIMARY KEY (Exe_Id);

ALTER TABLE Users
ADD PRIMARY KEY (Username);

ALTER TABLE Users
ADD CONSTRAINT Users_Br_Name_fk
FOREIGN KEY(Br_name) REFERENCES Branch(Br_name) ON DELETE CASCADE;

ALTER TABLE Message
ADD PRIMARY KEY (Mes_Id);

ALTER TABLE Message
ADD CONSTRAINT Message_Username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE Employee
ADD CONSTRAINT Employee_Username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE Member
ADD CONSTRAINT Member_Username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE Member
ADD CONSTRAINT Member_Diet_Id_fk
FOREIGN KEY(Diet_Id) REFERENCES Diet_Chart(Diet_Id) ON DELETE CASCADE;

ALTER TABLE Member
ADD CONSTRAINT Member_Trainer_fk
FOREIGN KEY(Trainer) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE Routine
ADD CONSTRAINT Routine_username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE Routine
ADD CONSTRAINT Routine_exe_id_fk
FOREIGN KEY(exe_id) REFERENCES Exercises_List(exe_id) ON DELETE CASCADE;

ALTER TABLE Income
ADD PRIMARY KEY (Trx_Id);

ALTER TABLE Income
ADD CONSTRAINT Income_Username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE Income
ADD CONSTRAINT Income_Br_Name_fk
FOREIGN KEY(Br_Name) REFERENCES Branch(Br_Name) ON DELETE CASCADE;

ALTER TABLE Br_Pkg
ADD CONSTRAINT Br_Pkg_Br_Name_fk
FOREIGN KEY(Br_Name) REFERENCES Branch(Br_Name) ON DELETE CASCADE;

ALTER TABLE Br_Pkg
ADD CONSTRAINT Br_Pkg_Pkg_Id_fk
FOREIGN KEY(Pkg_Id) REFERENCES Package(Pkg_Id) ON DELETE CASCADE;

ALTER TABLE Equipment
ADD PRIMARY KEY (Equipment_Id);

ALTER TABLE Equipment
ADD CONSTRAINT Equipment_Br_Name_fk
FOREIGN KEY(Br_Name) REFERENCES Branch(Br_Name) ON DELETE CASCADE;

ALTER TABLE Maintenance
ADD PRIMARY KEY (Mai_Id);

ALTER TABLE Maintenance
ADD CONSTRAINT Maintenance_Equipment_Id_fk
FOREIGN KEY(Equipment_Id) REFERENCES Equipment(Equipment_Id) ON DELETE CASCADE;

ALTER TABLE Expenditure
ADD PRIMARY KEY (Exp_Id);

ALTER TABLE Expenditure
ADD CONSTRAINT Expenditure_Br_Name_fk
FOREIGN KEY(Br_Name) REFERENCES Branch(Br_Name) ON DELETE CASCADE;

ALTER TABLE User_MobileNo
ADD CONSTRAINT User_MobileNo_Username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE M_Pkg
ADD CONSTRAINT M_Pkg_Username_fk
FOREIGN KEY(Username) REFERENCES Users(Username) ON DELETE CASCADE;

ALTER TABLE M_Pkg
ADD CONSTRAINT M_Pkg_pkg_Id_fk
FOREIGN KEY(Pkg_Id) REFERENCES Package(Pkg_Id) ON DELETE CASCADE;


