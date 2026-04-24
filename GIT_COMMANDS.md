# 🛠️ Brewhub Git Commands & Daily Routine
## 👤 Team
- dibraa (Dave) — Owner
- tonyyyzxc (Zentify) — Contributor

---

## 🗓️ Daily Routine

### 1. Start XAMPP
- Start Apache
- Start MySQL

### 2. Open VS Code
- Open folder: C:\xampp\htdocs\Brewhub-master

### 3. Pull latest changes FIRST
git pull origin master

### 4. Code your changes
- Test on: localhost/Brewhub-master
- Database: localhost/phpmyadmin

### 5. Push when done
git add .
git commit -m "describe what you changed"
git push origin master

### 6. Close properly
- Stop Apache and MySQL in XAMPP
- Close VS Code

---

## 📋 All Commands

### Pull (get latest)
git pull origin master

### Check status
git status
git log --oneline

### Push all files
git add .
git commit -m "your message"
git push origin master

### Push specific file
git add filename.php
git commit -m "updated filename.php"
git push origin master

### Fix conflicts
git checkout --ours .
git add .
git commit -m "resolved conflicts"
git push origin master

### Set identity
git config --global user.name "Zentify"
git config --global user.email "your@email.com"

### Check identity
git config --global user.name
git config --global user.email

### Check remote
git remote -v

---

## ⚠️ Golden Rules
1. Always git pull before coding
2. Always start XAMPP first
3. Write clear commit messages
4. Always git push when done