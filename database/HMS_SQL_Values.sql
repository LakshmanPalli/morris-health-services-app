-- --------------------------------------------------------

--
-- Dumping data for table `Facility`
--

INSERT INTO Facility (FacID, Street, City, State, Zip, Size, Office_Count, Room_Count, P_Code, FacType, `Desc`)
VALUES
(1, '123 Main St', 'New York', 'NY', '10001', 'Large', 10, 20, 1234, 'Hospital', 'Main Hospital'),
(2, '456 Elm St', 'Los Angeles', 'CA', '90001', 'Medium', 8, 15, 5678, 'Clinic', 'Downtown Clinic'),
(3, '789 Oak St', 'Chicago', 'IL', '60001', 'Small', 5, 10, 91011, 'Urgent Care', 'City Urgent Care'),
(4, '101 Pine St', 'Houston', 'TX', '77001', 'Large', 12, 25, 121314, 'Hospital', 'Regional Hospital'),
(5, '202 Cedar St', 'Miami', 'FL', '33001', 'Medium', 8, 15, 151617, 'Clinic', 'Beachside Clinic');

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
INSERT INTO Patient (Pid, FName, Minit, LName, Street, City, State, Zip, SSN, Ins_id)
VALUES
(1, 'Alice', 'M', 'Johnson', '123 Oak St', 'New York', 'NY', '10001', 123456789, 1),       -- .
(2, 'Bob', 'N', 'Smith', '456 Elm St', 'Los Angeles', 'CA', '90001', 234567890, 2),         -- .
(3, 'Charlie', 'O', 'Williams', '789 Maple St', 'Chicago', 'IL', '60001', 345678901, 3),     -- .
(4, 'David', 'P', 'Brown', '101 Pine St', 'Houston', 'TX', '77001', 456789012, 4),           -- .
(5, 'Emma', 'Q', 'Jones', '202 Cedar St', 'Miami', 'FL', '33001', 567890123, 5),             -- .
(6, 'Frank', 'R', 'Davis', '303 Elm St', 'Seattle', 'WA', '98001', 123456789, 1),            -- .
(7, 'Grace', 'S', 'Miller', '404 Maple St', 'San Francisco', 'CA', '94101', 234567890, 2),   -- .
(8, 'Hannah', 'T', 'Wilson', '505 Oak St', 'Boston', 'MA', '02101', 345678901, 3),           -- .
(9, 'Ian', 'U', 'Taylor', '606 Pine St', 'Atlanta', 'GA', '30301', 456789012, 4),            -- .
(10, 'Julia', 'V', 'Anderson', '707 Cedar St', 'Denver', 'CO', '80201', 567890123, 5);       -- .
-- --------------------------------------------------------

--
-- Dumping data for table `Invoice`
--
INSERT INTO `Invoice` (Inv_id, Inv_date, Ins_id)
VALUES
(1, UNIX_TIMESTAMP('2024-04-01'), 1),   -- Invoice 1 created on 2024-04-01, insurance company 1
(2, UNIX_TIMESTAMP('2024-04-02'), 2),   -- Invoice 2 created on 2024-04-02, insurance company 2
(3, UNIX_TIMESTAMP('2024-04-03'), 3),   -- Invoice 3 created on 2024-04-03, insurance company 3
(4, UNIX_TIMESTAMP('2024-04-04'), 4),   -- Invoice 4 created on 2024-04-04, insurance company 4
(5, UNIX_TIMESTAMP('2024-04-05'), 5);   -- Invoice 5 created on 2024-04-05, insurance company 5

-- --------------------------------------------------------


--
-- Dumping data for table `Invoice Detail`
--
INSERT INTO `Invoice Detail` (Inv_id, SSN, Pid, Cost)
VALUES
(1, 123456789, 1, 100),   -- Invoice 1 for patient 1 with doctor 123456789, cost $100
(2, 234567890, 2, 150),   -- Invoice 2 for patient 2 with doctor 234567890, cost $150
(3, 345678901, 3, 200),   -- Invoice 3 for patient 3 with doctor 345678901, cost $200
(4, 456789012, 4, 250),   -- Invoice 4 for patient 4 with doctor 456789012, cost $250
(5, 567890123, 5, 300);   -- Invoice 5 for patient 5 with doctor 567890123, cost $300

-- --------------------------------------------------------


--
-- Dumping data for table `Appointment`
--

INSERT INTO Appointment (FacID, SSN, Pid, Date_Time)
VALUES
(1, 123456789, 1, '2024-04-10 10:00:00'),   -- Appointment at Facility 1 with doctor 123456789 for patient 1 on 2024-04-10 at 10:00 AM
(2, 234567890, 2, '2024-04-11 11:00:00'),   -- Appointment at Facility 2 with doctor 234567890 for patient 2 on 2024-04-11 at 11:00 AM
(3, 345678901, 3, '2024-04-12 12:00:00'),   -- Appointment at Facility 3 with doctor 345678901 for patient 3 on 2024-04-12 at 12:00 PM
(4, 456789012, 4, '2024-04-13 13:00:00'),   -- Appointment at Facility 4 with doctor 456789012 for patient 4 on 2024-04-13 at 1:00 PM
(5, 567890123, 5, '2024-04-14 14:00:00');   -- Appointment at Facility 5 with doctor 567890123 for patient 5 on 2024-04-14 at 2:00 PM


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
