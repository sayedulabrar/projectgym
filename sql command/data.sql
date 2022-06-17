INSERT INTO USERS (
  USERNAME, PASSWORD, NAME, GENDER, EMAIL, ADDRESS, BLOOD_GRP, ACCOUNT_NO, BR_NAME, DOB, Mobile_No
) VALUES (
  'afk999', 'mathanoshto', 'Abrar Khan', 'Male', 'afk@gmail.com', 'Mirpur', 'B+', 12354648, 'br_001', TO_DATE('09/08/1995','dd/mm/yyyy'), '0123232'
);  
INSERT INTO USERS (
  USERNAME, PASSWORD, NAME, GENDER, EMAIL, ADDRESS, BLOOD_GRP, ACCOUNT_NO, BR_NAME, DOB
) VALUES (
  'billu037', 'missingbilli', 'Ayon Bilwal', 'Male', 'mr.bill@gmail.com', 'Jatrabari', 'A+', 1549841, 'br_001', TO_DATE('08/09/1993','dd/mm/yyyy')
);
INSERT INTO USERS (
  USERNAME, PASSWORD, NAME, GENDER, EMAIL, ADDRESS, BLOOD_GRP, ACCOUNT_NO, BR_NAME, DOB
) VALUES (
  'brownFalcon', 'spifu', 'Saifur Kacchi', 'Male', '@gmail.com', 'Mirpur', 'B+', 12354648, 'br_001', TO_DATE('','dd/mm/yyyy')
);
INSERT INTO USERS (
  USERNAME, PASSWORD, NAME, GENDER, EMAIL, ADDRESS, BLOOD_GRP, ACCOUNT_NO, BR_NAME, DOB
) VALUES (
  'modasayedul', 'rapking', 'Sayedul Eminem', 'Male', 'eminem@gmail.com', 'ECB', 'AB-', 789456, 'br_001', TO_DATE('05/07/1991','dd/mm/yyyy')
);
INSERT INTO USERS (
  USERNAME, PASSWORD, NAME, GENDER, EMAIL, ADDRESS, BLOOD_GRP, ACCOUNT_NO, BR_NAME, DOB
) VALUES (
  'arnab007', 'sirca', 'Arnab Src', 'Male', 'sircar@gmail.com', 'Tikatuli', 'B-', 45685241, 'br_001', TO_DATE('05/03/1995','dd/mm/yyyy')
);

INSERT INTO MEMBER (
  USERNAME, MEM_ID, MEM_HEIGHT, MEM_WEIGHT, MEMBERSHIP_EXPIRY, EXPECTED_OUTCOME, MEMB_BMI, DIET_ID, TRAINER
)
  VALUES (
  'modasayedul', 'rapking', 'Sayedul Eminem', 'Male', 'eminem@gmail.com', 'ECB', 'AB-', 7894561, 'br_001', TO_DATE('07/07/1991','dd/mm/yyyy')
);


INSERT INTO branch (
  BR_NAME, BR_REVENUE, BR_EXPENDITURE, BR_PROFIT, BR_RENT, REG_FEE
) VALUES (
  'br_001', 12, 12, 12, 12, 12
); 