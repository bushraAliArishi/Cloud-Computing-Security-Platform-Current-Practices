# Cloud Computing Security Platform: Current Practices  
## منصة أمان الحوسبة السحابية: الممارسات الحالية

This repository contains the implementation of a secure file management system built using PHP and AES-256 encryption. The system was developed as part of a graduation project to explore practical applications of cloud security in user-managed environments.

يحتوي هذا المستودع على تطبيق نظام آمن لإدارة الملفات باستخدام PHP وتشفير AES-256. تم تطوير النظام ضمن مشروع تخرج لاستكشاف تطبيقات عملية لأمن الحوسبة السحابية في بيئات يديرها المستخدم.

---

## 🌐 Overview | نظرة عامة

Cloud computing offers flexibility, but often lacks sufficient user-side security. This system provides:
- Secure login and authentication
- AES-based file encryption during upload
- Decryption upon download using the same private key
- Tracking file ownership and access

توفر الحوسبة السحابية مرونة عالية، لكنها غالبًا ما تفتقر إلى الأمان من جانب المستخدم. هذا النظام يقدّم:
- تسجيل دخول وتوثيق آمن
- تشفير الملفات أثناء الرفع باستخدام AES
- فك التشفير عند التحميل باستخدام نفس المفتاح
- تتبع ملكية الملفات والوصول إليها

---

## 🔒 Key Features | الميزات الرئيسية

- Secure file upload with AES-256-CBC encryption  
- Decryption handled on download with validation  
- Role-based access structure  
- Simple PHP backend with MySQL database  
- Clear legacy vs secure implementations in code  

- رفع ملفات آمن باستخدام تشفير AES-256-CBC  
- فك تشفير الملف عند التنزيل مع تحقق آمن  
- هيكل وصول قائم على الصلاحيات  
- باك اند مبني بلغة PHP مع قاعدة بيانات MySQL  
- وجود توثيق في الكود بين النسخ القديمة والمحدثة

---

## 🛠️ Technologies Used | التقنيات المستخدمة

- **PHP (8.x)** – File handling, encryption logic  
- **MySQL** – User and file management  
- **AES-256-CBC** – Symmetric encryption method  
- **HTML/CSS** – Frontend templates (to be replaced by React)  

- **PHP** – لمعالجة الملفات وتطبيق التشفير  
- **MySQL** – لإدارة المستخدمين والملفات  
- **AES-256-CBC** – خوارزمية تشفير متماثل  
- **HTML/CSS** – الواجهات الأمامية (سيتم استبدالها بـ React لاحقًا)

---

## 🧪 How to Use | طريقة الاستخدام

1. Clone this repository  
2. Import the `cloud_db.sql` into your MySQL server  
3. Run the PHP server (e.g., via XAMPP)  
4. Register a user and login  
5. Upload a file — it will be encrypted and stored  
6. Download it — it will be decrypted automatically  

1. استنسخ هذا المستودع  
2. استورد ملف `cloud_db.sql` في MySQL  
3. شغّل الخادم المحلي (مثلاً عبر XAMPP)  
4. أنشئ مستخدم جديد وسجّل الدخول  
5. ارفع ملفًا — سيتم تشفيره وتخزينه  
6. نزّل الملف — سيتم فك التشفير تلقائيًا  

---

## LinkedIn

**LinkedIn** | [Bushra Ali Arishi](https://www.linkedin.com/in/bushra-ali-arishi/?locale=en_US)
