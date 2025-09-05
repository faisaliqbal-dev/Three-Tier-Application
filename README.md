# **🚀 AWS Cloud Form Submission System**  
**A Complete PHP + AWS Solution for Form Data & File Uploads**  

---

## **📌 Project Overview**  
This project demonstrates a **PHP web form** that:  
✔ **Stores user data** in **AWS RDS (MySQL)**  
✔ **Uploads files** to **AWS S3 Bucket**  
✔ Runs on an **EC2 instance** with secure AWS configurations  

Perfect for learning **cloud integration** with PHP!  

---

## **🛠️ Tech Stack**  
| Category       | Technologies Used |
|---------------|------------------|
| **Frontend**  | HTML5, CSS3, JavaScript |
| **Backend**   | PHP 8.0+ |
| **Database**  | MySQL (AWS RDS) |
| **Cloud**     | AWS EC2, S3, RDS, IAM |
| **Tools**     | Apache HTTP Server, AWS CLI |

---
## **⚙️ Setup Guide**  

### **1. Clone the Repository**  
```bash
git clone https://github.com/faisaliqbal-dev/Three-Tier-Application.git
cd Three-Tier-Application
```

### **2. AWS Infrastructure Setup**  
#### **EC2 Instance**  
- AMI: **Amazon Linux 2**  
- Security Group: Allow **HTTP (80), HTTPS (443), SSH (22)**  

#### **RDS Database**  
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
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### **S3 Bucket**  
- Bucket Name: `ec2-form-photos`  
- Permissions: **public**  

### **3. Configure PHP & Apache**  
```bash
sudo yum install httpd php php-mysqlnd -y
sudo systemctl start httpd
sudo systemctl enable httpd
```

### **4. Deploy the Project**  
Upload files to `/var/www/html/form-app`:  
```bash
sudo cp -r * /var/www/html/form-app/
sudo chown -R apache:apache /var/www/html/form-app
```

---

## **🔍 How It Works?**  
1. User submits form → **PHP processes data**  
2. **Files uploaded to S3** (via AWS SDK)  
3. **Form data saved in RDS** (MySQL)  
4. Success page displayed  

---

## **📂 Project Structure**  
```
aws-form-project/
├── index.php             # Main form
├── upload.php            # Form processor
├── success.php           # Success page
├── assets/               # CSS/JS files
├── docs/
│   ├── AWS_SETUP.md      # AWS config guide
│   └── TROUBLESHOOTING.md
└── README.md
```

---

## **🚨 Troubleshooting**  
| Issue | Solution |
|-------|----------|
| **Form not submitting** | Check EC2 security groups & RDS connectivity |
| **File upload fails** | Verify S3 bucket permissions & IAM roles |
| **Database error** | Ensure `userdb` exists & tables are correct |

---

## **📜 License**  
This project is under **MIT License**.  

---

## **🙏 Credits**  
- Developed by ** Mohammed Faisal Iqbal **  
- **GitHub**:   https://github.com/faisaliqbal-dev
- **LinkedIn**: https://www.linkedin.com/in/mohammed-faisal-iqbal-4629ab344 

---

## **💡 Future Improvements**  
- [ ] **Admin Dashboard** to view submissions  
- [ ] **User Authentication** (AWS Cognito)  
- [ ] **Automated Backups** for S3 & RDS
# Three-Tier-Application
