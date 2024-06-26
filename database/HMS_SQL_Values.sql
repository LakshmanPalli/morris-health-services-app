-- --------------------------------------------------------

--
-- Dumping data for table `Facility`
--

INSERT INTO Facility (Street, City, State, Zip, Size, Office_Count, Room_Count, P_Code, FacType, `Desc`)
VALUES
('123 Main St', 'New York', 'NY', '10001', 'Large', 10, 20, 1234, 'Hospital', 'Main Hospital'),
('456 Elm St', 'Los Angeles', 'CA', '90001', 'Medium', 8, 15, 5678, 'Clinic', 'Downtown Clinic'),
('789 Oak St', 'Chicago', 'IL', '60001', 'Small', 5, 10, 91011, 'Urgent Care', 'City Urgent Care'),
('101 Pine St', 'Houston', 'TX', '77001', 'Large', 12, 25, 121314, 'Hospital', 'Regional Hospital'),
('202 Cedar St', 'Miami', 'FL', '33001', 'Medium', 8, 15, 151617, 'Clinic', 'Beachside Clinic');

-- --------------------------------------------------------

--
-- Dumping data for table `employee`
--
INSERT INTO employee (SSN, FName, Minit, LName, Street, City, State, Zip, Salary, Hiredate, Jobclass, FacID)
VALUES
(123456789, 'John', 'D', 'Doe', '123 Main St', 'New York', 'NY', '10001', 60000, '2023-01-15', 'Doctor', 1),
(234567890, 'Jane', 'M', 'Smith', '456 Elm St', 'Los Angeles', 'CA', '90001', 70000, '2022-11-20', 'Doctor', 2),
(345678901, 'Michael', 'A', 'Johnson', '789 Oak St', 'Chicago', 'IL', '60001', 55000, '2023-03-10', 'Doctor', 3),
(456789012, 'Emily', 'N', 'Brown', '101 Pine St', 'Houston', 'TX', '77001', 65000, '2023-05-05', 'Doctor', 4),
(567890123, 'David', 'R', 'Wilson', '202 Maple St', 'Miami', 'FL', '33001', 60000, '2022-12-30', 'Doctor', 5),
(678901234, 'Sarah', 'K', 'Taylor', '303 Cedar St', 'Seattle', 'WA', '98001', 75000, '2023-02-18', 'Other_HCP', 1),
(789012345, 'Robert', 'J', 'Miller', '404 Oak St', 'San Francisco', 'CA', '94101', 70000, '2022-10-05', 'Other_HCP', 2),
(890123456, 'Jennifer', 'L', 'Lee', '505 Elm St', 'Boston', 'MA', '02101', 60000, '2023-04-20', 'Other_HCP', 3),
(901234567, 'Daniel', 'P', 'Clark', '606 Pine St', 'Atlanta', 'GA', '30301', 65000, '2022-09-15', 'Other_HCP', 4),
(912345678, 'Michelle', 'T', 'Adams', '707 Maple St', 'Denver', 'CO', '80201', 70000, '2023-06-10', 'Other_HCP', 5),
(123123123, 'Jessica', 'E', 'Garcia', '808 Pine St', 'San Diego', 'CA', '92101', 60000, '2023-03-25', 'Nurse', 1),
(234234234, 'Andrew', 'F', 'Martinez', '909 Elm St', 'Portland', 'OR', '97201', 70000, '2022-12-10', 'Nurse', 2),
(345345345, 'Emily', 'G', 'Lopez', '101 Oak St', 'Las Vegas', 'NV', '89101', 55000, '2023-05-20', 'Nurse', 3),
(456456456, 'Christopher', 'H', 'Hernandez', '202 Cedar St', 'Phoenix', 'AZ', '85001', 65000, '2023-01-05', 'Nurse', 4),
(567567567, 'Maria', 'I', 'Gonzalez', '303 Pine St', 'Austin', 'TX', '78701', 60000, '2022-11-30', 'Nurse', 5),
(678678678, 'David', 'J', 'Perez', '404 Elm St', 'San Antonio', 'TX', '78201', 75000, '2023-02-15', 'Admin', 1),
(789789789, 'Jessica', 'K', 'Ramirez', '505 Oak St', 'Dallas', 'TX', '75201', 70000, '2022-10-20', 'Admin', 2),
(890890890, 'Kevin', 'L', 'Torres', '606 Cedar St', 'Fort Worth', 'TX', '76101', 60000, '2023-04-05', 'Admin', 3),
(901901901, 'Ashley', 'M', 'Flores', '707 Elm St', 'El Paso', 'TX', '79901', 65000, '2022-09-30', 'Admin', 4),
(912912912, 'Michael', 'N', 'Rivera', '808 Pine St', 'Seattle', 'WA', '98101', 70000, '2023-06-15', 'Admin', 5);

-- Sample data for Doctor subclass
INSERT INTO Doctor (SSN, Speciality, BO_date)
VALUES
(123456789, 'Cardiology', '1980-05-15'),
(234567890, 'Orthopedics', '1975-09-20'),
(345678901, 'Dermatology', '1983-03-25'),
(456789012, 'Neurology', '1981-11-30'),
(567890123, 'Oncology', '1982-08-05');

-- Sample data for Other_HCP subclass
INSERT INTO Other_HCP (SSN, JobTitle)
VALUES
(678901234, 'Pharmacist'),
(789012345, 'Physician Assistant'),
(890123456, 'Medical Technologist'),
(901234567, 'Radiologic Technologist'),
(912345678, 'Respiratory Therapist');

-- Sample data for Nurse subclass
INSERT INTO Nurse (SSN, Certi)
VALUES
(123123123, 'Certified Nursing Assistant'),
(234234234, 'Nurse Practitioner'),
(345345345, 'Clinical Nurse Specialist'),
(456456456, 'Nurse Anesthetist'),
(567567567, 'Registered Nurse');

-- Sample data for Admin subclass
INSERT INTO Admin (SSN, JobTitle)
VALUES
(678678678, 'HR Coordinator'),
(789789789, 'Office Manager'),
(890890890, 'Billing Coordinator'),
(901901901, 'Executive Assistant'),
(912912912, 'Financial Analyst');

-- --------------------------------------------------------

--
-- Dumping data for table `Insurance Company`
--

INSERT INTO `Insurance Company` (Name, Street, City, State, Zip)
VALUES
('ABC Insurance', '123 Main St', 'New York', 'NY', '10001'),
('XYZ Insurance', '456 Elm St', 'Los Angeles', 'CA', '90001'),
('123 Insurance', '789 Oak St', 'Chicago', 'IL', '60001'),
('456 Insurance', '101 Pine St', 'Houston', 'TX', '77001'),
('789 Insurance', '202 Maple St', 'Miami', 'FL', '33001');

-- --------------------------------------------------------

--
-- Dumping data for table `Patient`
--

-- Sample data for Patient table
INSERT INTO Patient (FName, Minit, LName, Street, City, State, Zip, SSN, Ins_id)
VALUES
('Alice', 'M', 'Johnson', '123 Oak St', 'New York', 'NY', '10001', 123456789, 1),       -- pid:1
('Bob', 'N', 'Smith', '456 Elm St', 'Los Angeles', 'CA', '90001', 234567890, 2),         -- pid:2
('Charlie', 'O', 'Williams', '789 Maple St', 'Chicago', 'IL', '60001', 345678901, 3),     -- pid:3
('David', 'P', 'Brown', '101 Pine St', 'Houston', 'TX', '77001', 456789012, 4),           -- pid:4
('Emma', 'Q', 'Jones', '202 Cedar St', 'Miami', 'FL', '33001', 567890123, 5),             -- pid:5
('Frank', 'R', 'Davis', '303 Elm St', 'Seattle', 'WA', '98001', 123456789, 1),            -- pid:6
('Grace', 'S', 'Miller', '404 Maple St', 'San Francisco', 'CA', '94101', 234567890, 2),   -- pid:7
('Hannah', 'T', 'Wilson', '505 Oak St', 'Boston', 'MA', '02101', 345678901, 3),           -- pid:8
('Ian', 'U', 'Taylor', '606 Pine St', 'Atlanta', 'GA', '30301', 456789012, 4),            -- pid:9
('Julia', 'V', 'Anderson', '707 Cedar St', 'Denver', 'CO', '80201', 567890123, 5);       -- pid:10
-- --------------------------------------------------------

--
-- Dumping data for table `Invoice`
--
INSERT INTO `Invoice` (Inv_date, Ins_id)
VALUES
('2024-04-01', 1),   -- Invoice 1 created on 2024-04-01, insurance company 1
('2024-04-02', 2),   -- Invoice 2 created on 2024-04-02, insurance company 2
('2024-04-03', 3),   -- Invoice 3 created on 2024-04-03, insurance company 3
('2024-04-04', 4),   -- Invoice 4 created on 2024-04-04, insurance company 4
('2024-04-05', 5);   -- Invoice 5 created on 2024-04-05, insurance company 5


-- INSERT INTO `Invoice` (Inv_date, Ins_id)
-- VALUES
-- (UNIX_TIMESTAMP('2024-04-01'), 1),   -- Invoice 1 created on 2024-04-01, insurance company 1
-- (UNIX_TIMESTAMP('2024-04-02'), 2),   -- Invoice 2 created on 2024-04-02, insurance company 2
-- (UNIX_TIMESTAMP('2024-04-03'), 3),   -- Invoice 3 created on 2024-04-03, insurance company 3
-- (UNIX_TIMESTAMP('2024-04-04'), 4),   -- Invoice 4 created on 2024-04-04, insurance company 4
-- (UNIX_TIMESTAMP('2024-04-05'), 5);   -- Invoice 5 created on 2024-04-05, insurance company 5

-- --------------------------------------------------------


--
-- Dumping data for table `Appointment`
--

-- P(1/6)=Ins(1), P(2/7)=Ins(2), P(3/8)=Ins(3), P(4/9)=Ins(4), P(5/10)=Ins(5)  
 
INSERT INTO Appointment (FacID, SSN, Pid, Date_Time, Inv_id, Cost)
VALUES
(1, 123456789, 1, '2024-04-10 10:00:00', 1, 100),   -- Appointment at Facility 1 with doctor 123456789 for patient 1 on 2024-04-10 at 10:00 
(1, 123456789, 2, '2024-04-10 11:00:00', 2, 110),   -- Appointment at Facility 1 with doctor 123456789 for patient 2 on 2024-04-10 at 11:00 
(1, 123456789, 3, '2024-04-10 12:00:00', 3, 120),   -- Appointment at Facility 1 with doctor 123456789 for patient 3 on 2024-04-10 at 12:00 
(1, 123456789, 4, '2024-04-10 13:00:00', 4, 130),   -- Appointment at Facility 1 with doctor 123456789 for patient 4 on 2024-04-10 at 13:00 
(1, 123456789, 5, '2024-04-10 14:00:00', 5, 140),   -- Appointment at Facility 1 with doctor 123456789 for patient 5 on 2024-04-10 at 14:00 
(2, 234567890, 1, '2024-04-11 10:00:00', 1, 150),   -- Appointment at Facility 2 with doctor 234567890 for patient 1 on 2024-04-11 at 10:00 
(2, 234567890, 2, '2024-04-11 11:00:00', 2, 160),   -- Appointment at Facility 2 with doctor 234567890 for patient 2 on 2024-04-11 at 11:00 
(2, 234567890, 3, '2024-04-11 12:00:00', 3, 170),   -- Appointment at Facility 2 with doctor 234567890 for patient 3 on 2024-04-11 at 12:00 
(2, 234567890, 4, '2024-04-11 13:00:00', 4, 180),   -- Appointment at Facility 2 with doctor 234567890 for patient 4 on 2024-04-11 at 13:00 
(2, 234567890, 5, '2024-04-11 14:00:00', 5, 190),   -- Appointment at Facility 2 with doctor 234567890 for patient 5 on 2024-04-11 at 14:00 
(3, 345678901, 1, '2024-04-12 10:00:00', 1, 200),   -- Appointment at Facility 3 with doctor 345678901 for patient 1 on 2024-04-12 at 10:00 
(3, 345678901, 2, '2024-04-12 11:00:00', 2, 210),   -- Appointment at Facility 3 with doctor 345678901 for patient 2 on 2024-04-12 at 11:00 
(3, 345678901, 3, '2024-04-12 12:00:00', 3, 220),   -- Appointment at Facility 3 with doctor 345678901 for patient 3 on 2024-04-12 at 12:00 
(3, 345678901, 4, '2024-04-12 13:00:00', 4, 230),   -- Appointment at Facility 3 with doctor 345678901 for patient 4 on 2024-04-12 at 13:00 
(3, 345678901, 5, '2024-04-12 14:00:00', 5, 240),   -- Appointment at Facility 3 with doctor 456789012 for patient 5 on 2024-04-12 at 14:00 
(4, 456789012, 1, '2024-04-13 10:00:00', 1, 125),   -- Appointment at Facility 4 with doctor 456789012 for patient 1 on 2024-04-13 at 10:00 
(4, 456789012, 2, '2024-04-13 11:00:00', 2, 150),   -- Appointment at Facility 4 with doctor 456789012 for patient 2 on 2024-04-13 at 11:00 
(4, 456789012, 3, '2024-04-13 12:00:00', 3, 175),   -- Appointment at Facility 4 with doctor 456789012 for patient 3 on 2024-04-13 at 12:00 
(4, 456789012, 4, '2024-04-13 13:00:00', 4, 200),   -- Appointment at Facility 4 with doctor 456789012 for patient 4 on 2024-04-13 at 13:00 
(4, 456789012, 5, '2024-04-13 14:00:00', 5, 100),   -- Appointment at Facility 4 with doctor 456789012 for patient 4 on 2024-04-13 at 14:00 
(5, 567890123, 1, '2024-04-14 10:00:00', 1, 50),   -- Appointment at Facility 5 with doctor 567890123 for patient 1 on 2024-04-14 at 10:00 
(5, 567890123, 2, '2024-04-14 11:00:00', 2, 60),   -- Appointment at Facility 5 with doctor 567890123 for patient 2 on 2024-04-14 at 11:00 
(5, 567890123, 3, '2024-04-14 12:00:00', 3, 70),   -- Appointment at Facility 5 with doctor 567890123 for patient 3 on 2024-04-14 at 12:00 
(5, 567890123, 4, '2024-04-14 13:00:00', 4, 80),	-- Appointment at Facility 5 with doctor 567890123 for patient 4 on 2024-04-14 at 13:00 
(5, 567890123, 5, '2024-04-14 14:00:00', 5, 90),   -- Appointment at Facility 5 with doctor 567890123 for patient 5 on 2024-04-14 at 14:00 
(1, 123456789, 6, '2024-04-11 10:00:00', 1, 100),
(1, 123456789, 7, '2024-04-12 11:00:00', 2, 100),
(1, 123456789, 8, '2024-04-13 12:00:00', 3, 100),
(1, 123456789, 9, '2024-04-14 13:00:00', 4, 100),
(2, 234567890, 6, '2024-04-10 10:00:00', 1, 100),
(2, 234567890, 7, '2024-04-12 11:00:00', 2, 100),
(2, 234567890, 8, '2024-04-13 12:00:00', 3, 100),
(2, 234567890, 9, '2024-04-14 13:00:00', 4, 100),
(3, 345678901, 6, '2024-04-10 10:00:00', 1, 100),
(3, 345678901, 7, '2024-04-11 11:00:00', 2, 100),
(3, 345678901, 8, '2024-04-13 12:00:00', 3, 100),
(3, 345678901, 9, '2024-04-14 13:00:00', 4, 100),
(4, 456789012, 6, '2024-04-10 10:00:00', 1, 100),
(4, 456789012, 7, '2024-04-11 11:00:00', 2, 100),
(4, 456789012, 8, '2024-04-12 12:00:00', 3, 100),
(4, 456789012, 9, '2024-04-14 13:00:00', 4, 100),
(5, 567890123, 6, '2024-04-15 10:00:00', 1, 100),
(5, 567890123, 7, '2024-04-16 11:00:00', 2, 100),
(5, 567890123, 8, '2024-04-17 12:00:00', 3, 100),
(5, 567890123, 1, '2024-04-18 13:00:00', 1, 100),
(5, 567890123, 2, '2024-04-19 13:00:00', 2, 100),
(5, 567890123, 3, '2024-04-15 13:00:00', 3, 100),
(5, 567890123, 4, '2024-04-16 13:00:00', 4, 100),
(5, 567890123, 6, '2024-04-17 13:00:00', 1, 100),
(5, 567890123, 7, '2024-04-18 13:00:00', 2, 100),
(5, 567890123, 8, '2024-04-19 13:00:00', 3, 100),
-- -------
(5, 567890123, 6, '2024-04-15 11:00:00', 1, 100),
(5, 567890123, 7, '2024-04-16 12:00:00', 2, 100),
(5, 567890123, 8, '2024-04-17 13:00:00', 3, 100),
(5, 567890123, 1, '2024-04-18 14:00:00', 1, 100),
(5, 567890123, 2, '2024-04-19 15:00:00', 2, 100),
(5, 567890123, 3, '2024-04-15 12:00:00', 3, 100),
(5, 567890123, 4, '2024-04-16 14:00:00', 4, 100),
(5, 567890123, 6, '2024-04-17 15:00:00', 1, 100),
(5, 567890123, 7, '2024-04-18 16:00:00', 2, 100),
(5, 567890123, 8, '2024-04-19 17:00:00', 3, 100),
-- -------
(5, 567890123, 6, '2024-04-15 15:00:00', 1, 100),
(5, 567890123, 7, '2024-04-16 16:00:00', 2, 100),
(5, 567890123, 8, '2024-04-17 17:00:00', 3, 100),
(5, 567890123, 1, '2024-04-18 18:00:00', 1, 100),
(5, 567890123, 2, '2024-04-19 09:00:00', 2, 100),
(5, 567890123, 3, '2024-04-15 10:00:00', 3, 100),
(5, 567890123, 4, '2024-04-16 11:00:00', 4, 100),
(5, 567890123, 6, '2024-04-17 12:00:00', 1, 100),
(5, 567890123, 7, '2024-04-18 15:00:00', 2, 100),
(5, 567890123, 8, '2024-04-19 10:00:00', 3, 100);


-- --------------------------------------------------------

--
-- Dumping data for table `Treat`
--

-- Sample data for Treat table
INSERT INTO Treat (SSN, Pid)
VALUES
(123456789, 1),   -- Employee 123456789 treats patient 1
(234567890, 2),   -- Employee 234567890 treats patient 2
(345678901, 3),   -- Employee 345678901 treats patient 3
(456789012, 4),   -- Employee 456789012 treats patient 4
(567890123, 5);   -- Employee 567890123 treats patient 5

-- --------------------------------------------------------
