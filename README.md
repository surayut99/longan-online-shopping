# ระบบจัดการการขายลำไยออนไลน์

### ขั้นตอนการเริ่มใช้งาน/พัฒนา
1. รันคำสั่ง ```composer install``` ภายใน directory
2. รันคำสั่ง ```cp .env.exmaple .env``` เพื่อสร้างไฟล์ .env ในการเซตค่า config
3. รันคำสั่ง ```php artisan key:generate``` เพื่อ generate key สำหรับไฟล์ .env
4. ตั้งค่า database ภายในไฟล์ .env 
5. หลังจากสร้าง database พร้อมใช้งานแล้ว รันคำสั่ง ```php artisan migrate``` เพื่อสร้างตารางใน database นั้น
6. หากต้องการ seed ข้อมูล ให้รันคำสั่ง ```php artisan db:seed``` หรือเลือกเฉพาะ class ที่ใช้ในการ seed ด้วย ```php artisan db:seed --class=<ชื่อคลาส>```
7. รันคำสั่ง ```php artisan storage:link``` เพื่อสร้าง shortcut ในการเข้าถึงไฟล์เพิ่มเติม เช่น .css, .js, .jpg
8. รันคำสั่ง ```php artisan serve``` เพื่อใช้งานระบบ
