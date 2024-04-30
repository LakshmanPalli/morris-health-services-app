# morris-health-services-app

MHS is interested in an online application program interface that is easy to
use so that they do not have to spend time unnecessarily to train their
employees. In particular, MHS is interested in three applications:
Employee and Facility Management, Patient Management
(appointments, procedures and billing), and Management Reporting. The
last application is crucial in decision making by management and the
Accounting Department.
As database and application program designers you are expected to write a
menu-based main program which consists of the following three application
programs for the management of the company and is open to the inclusion of
additional functionality in the future. Note that many functions are left out
in order to reduce the size and the complexity of the project.

**1. Employee and Facility Management**

The Employee and Facility Management application provides insert / update
/ view utilities for:

• Employees

• Medical offices

• Employee assignments

• Insurance companies



**2. Patient Management**

The Patient Management application provides functions to allow for
insert/entry/view of activities and revenue such as:

• Create new patient records

• Create appointments and update with charges when complete

• Generate daily insurance company invoices with patient subtotals



**3. Management and Reporting**

Management uses this application to review and/or change operations,
manage its workforce and measure the business’s financial performance. This
program provides statistics used by management to analyze its income,
facilities, employees and patients. In particular, the program should be able
to make the following computations:

a) For a given day, a report of the revenue (patient charges recorded) by
facility, with subtotals and a total.

b) For a user-selected date and a user-selected physician, a list of
appointments.

c) For a user-selected time period (begin date and end date) and a userselected facility, a list of appointments with detail for date-time,
physician, patient, and description.

d) For a user-selected month compute the 5 best days (in terms of total
revenue) for MHS.

d) For a user-selected time period (begin date and end date) compute the
average daily revenue for each insurance company.

------------
**Database:**

HMS SQL - To Create DB

HMS SQL Values - To Load DB


**Modules:**

efm - Employee and Facility Management

mr - Management and Reporting

pm - Patient Management

-----------------

**Steps to Setup Project**

Download the zip from https://github.com/LakshmanPalli/morris-health-services-app 

Extract the file in xampp/htdocs

Import the SQL files in phpMyAdmin, db name: `morris_healthservice`

Browse  http://localhost/morris-health-services-app
