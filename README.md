# vendor-management
A PHP-based vendor management dashboard
# 🧾 Vendor Management Dashboard

A lightweight vendor management system built using PHP, MySQL, Bootstrap, and jQuery. It allows admins to manage vendor details, calculate threat scores, and export data to Excel or PDF with color-coded risk levels.

---

## 🚀 Features

- ✅ Add, edit, and delete vendors
- ✅ Assign daily working hours (Mon–Sun)
- ✅ Select active months (Jan–Dec)
- ✅ Automatically calculate **Threat Score**
- ✅ Highlight threat score (green/yellow/red)
- ✅ Export reports to:
  - 📊 Excel (`SimpleXLSXGen`)
  - 📄 PDF (`FPDF`)
- ✅ Form validation using `jQuery Validate`
- ✅ Alert popups using `SweetAlert2`
- ✅ Responsive layout with Bootstrap
- ✅ Simple admin login with PHP session

---

## 🛠 Tech Stack

| Category      | Technology |
|---------------|------------|
| Frontend      | HTML, CSS, Bootstrap |
| JavaScript    | jQuery, jQuery Validate, SweetAlert2 |
| Backend       | PHP (no framework) |
| Database      | MySQL |
| Excel Export  | [SimpleXLSXGen](https://github.com/shuchkin/simplexlsxgen) |
| PDF Export    | [FPDF](http://www.fpdf.org/) |

---
## Workflow

![alt text](https://github.com/dekay4/vendor-management/blob/main/vendor-workflow.png)

## 🛠️ Setup Instructions

1. **Import the Database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin)
   - Create a new database (e.g., `vendor_management`)
   - Import the SQL file: `vendor_management.sql`

2. **Update Database Connection**
   - Default database credentials used:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     ```
   - If your system uses a different username/password, update them in:
     ```
     includes/connection.php
     ```

3. **Run the Project**
   - Start Apache and MySQL in XAMPP
   - Visit in your browser:
     ```
     http://localhost/vendor-managment/
     ```

4. **Admin Login**
   - Default credentials:
     ```
     Username: admin@email.com
     Password: 123456
     ```

     ## 📋 Dashboard Overview

- After logging in, you will be redirected to the **Dashboard** page.
- The dashboard displays key summary cards:
  - 🧾 **Total Vendors**
  - ✅ **Active Vendors**
  - ❌ **Inactive Vendors**
  - ⚠️ **High Threat Vendors**

- Below the summary cards, a detailed **vendor list table** is displayed.
- On the **right side** of the table, you will find:

  - 📥 **Export as Excel** button
  - 📄 **Export as PDF** button

These export buttons allow you to download the full vendor report with threat score highlights.

![alt text](https://github.com/dekay4/vendor-management/blob/main/dashboard.png)

