# 🚀 AWS Cloud Form Submission System  

A **complete PHP + AWS solution** to collect user form data and upload files, hosted on **EC2**, storing data in **RDS (MySQL)** and files in **S3**. Ideal for learning **cloud integration with PHP**.

---

## 📌 Project Overview
This project provides a **cloud-ready PHP form** that:  
- ✅ Stores form data in **AWS RDS (MySQL)**  
- ✅ Uploads user files (photos) to **AWS S3**  
- ✅ Runs securely on an **EC2 instance** with IAM role-based permissions  

---

## 🛠️ Tech Stack
| Layer         | Technology |
|---------------|------------|
| Frontend      | HTML5, CSS3, JavaScript |
| Backend       | PHP 8.x |
| Database      | MySQL (AWS RDS) |
| Cloud         | AWS EC2, S3, RDS, IAM |
| Server        | Apache HTTP Server |
| Tools         | Composer, AWS SDK for PHP |

---

## ⚙️ Setup Guide  

### 1️⃣ AWS Infrastructure
#### EC2 Instance
- OS: Ubuntu 22.04 / Amazon Linux 2  
- Security Group: Allow **SSH (22), HTTP (80), HTTPS (443)**  

#### RDS Database
Connect via MySQL client and run:
```sql
CREATE DATABASE userdb;

USE userdb;

CREATE TABLE form_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    photo_url VARCHAR(255),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
````

#### S3 Bucket

* Bucket Name: `ec2-form-photos-store`
* Permissions: IAM role attached to EC2 with **PutObject** permission

---

### 2️⃣ PHP & Apache Setup

```bash
sudo apt update -y
sudo apt install apache2 php php-mysql php-xml unzip curl -y
sudo systemctl start apache2
sudo systemctl enable apache2
```

---

### 3️⃣ AWS SDK for PHP

```bash
cd /var/www/html
composer require aws/aws-sdk-php
```

---

### 4️⃣ Deploy Project Files

```bash
sudo cp -r * /var/www/html/
sudo chown -R www-data:www-data /var/www/html/
sudo chmod -R 755 /var/www/html/
sudo systemctl restart apache2

## 🔍 How To View Database Data
To check the data stored in your RDS MySQL database:

### 1️⃣ Connect to RDS from EC2
```bash
mysql -h <RDS-ENDPOINT> -u <USERNAME> -p
````

* Replace `<RDS-ENDPOINT>` with your RDS endpoint
* Replace `<USERNAME>` with your RDS username (e.g., `admin`)
* Enter your password when prompted

### 2️⃣ Select your database

```sql
USE userdb;
```

### 3️⃣ List tables

```sql
SHOW TABLES;
```

### 4️⃣ View table data

```sql
SELECT * FROM form_submissions;
```

### 5️⃣ Exit MySQL

```sql
EXIT;
```

> Tip: You can also run a single command to view data without logging in interactively:

```bash
mysql -h <RDS-ENDPOINT> -u <USERNAME> -p -e "SELECT * FROM userdb.form_submissions;"
```

```

---

Agar chaho mai ab **poora README.md ka final version** ready bana du jisme ye database section + sari previous instructions included ho, ek hi file me?
```


---

## 🔍 How It Works

1. User fills the form → **PHP processes input**
2. Photo uploaded to **S3** using AWS SDK
3. Form data saved in **RDS MySQL database**
4. Success message displayed to user

---

## 📂 Project Structure

```
Three-Tier-Application/
├── index.php             # Main form
├── upload.php            # Form submission processor
├── assets/               # CSS/JS files
├── vendor/               # AWS SDK (Composer)
├── docs/                 # Documentation
│   ├── AWS_SETUP.md
│   └── TROUBLESHOOTING.md
└── README.md
```

---

## 🚨 Troubleshooting

| Issue                     | Solution                                         |
| ------------------------- | ------------------------------------------------ |
| Form submission fails     | Check EC2 security group & RDS connectivity      |
| File upload fails         | Ensure S3 bucket permissions & IAM role attached |
| Database connection error | Confirm `userdb` exists and table is correct     |

---

## 💡 Future Improvements

* Admin dashboard to view submissions
* User authentication (AWS Cognito)
* Automated backups for RDS & S3

---

## 📜 License

**MIT License**

---

## 🙏 Credits

* Developed by **Mohammed Faisal Iqbal**
* GitHub: [faisaliqbal-dev](https://github.com/faisaliqbal-dev)
* LinkedIn: [Mohammed Faisal Iqbal](https://www.linkedin.com/in/mohammed-faisal-iqbal-4629ab344)

```

---

Bhai ye **new README.md** professional + modern format me hai aur fully updated hai **PHP form + RDS + S3 + EC2 project ke liye**.  

Agar chaho mai tumhare liye **ek aur version bana du**, jo **short + resume friendly** ho jisse GitHub me portfolio dikhe aur recruiters ko impress kare?
```
