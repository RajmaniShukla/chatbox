# Chatbox - Facebook-Style Chat Widget

💬 **A lightweight, real-time chat popup widget inspired by Facebook Messenger**

[![PHP](https://img.shields.io/badge/PHP-7.x-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.x-orange.svg)](https://mysql.com)
[![jQuery](https://img.shields.io/badge/jQuery-Required-blue.svg)](https://jquery.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

## 📖 About

A Facebook-style chat popup widget that allows real-time messaging between users. Features include:

- Facebook Messenger-like UI design
- Real-time message updates (polling every 20 seconds)
- Sidebar with online contacts
- Responsive design (hides on mobile < 540px)
- Enter to send, Shift+Enter for new line

## 🖼️ Features

- **Chat Popup Widget** - Minimizable chat window
- **Contact Sidebar** - List of available contacts
- **Real-time Updates** - AJAX-based message polling
- **Clean UI** - Facebook-inspired design
- **XSS Protection** - Messages are escaped before display

## 📁 Project Structure

```
chatbox/
├── index.html        # Main page with sidebar and popup demo
├── Chat.php          # Chat widget component (loads messages)
├── FbChatMock.php    # Database class (⚠️ configure credentials)
├── add_msg.php       # AJAX endpoint to add messages
├── get_msg.php       # AJAX endpoint to fetch messages
├── chat.js           # Frontend JavaScript logic
├── core.css          # Styles for chat widget
└── README.md         # This file
```

## ⚙️ Installation

### Prerequisites

- PHP 7.0+
- MySQL 5.6+
- Apache/Nginx web server
- jQuery (loaded via CDN or locally)

### Database Setup

1. **Create the database:**
   ```sql
   CREATE DATABASE fbchat;
   USE fbchat;
   ```

2. **Create required tables:**
   ```sql
   -- Users table
   CREATE TABLE users (
       id INT PRIMARY KEY AUTO_INCREMENT,
       username VARCHAR(50) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   -- Chat messages table
   CREATE TABLE chat (
       id INT PRIMARY KEY AUTO_INCREMENT,
       user_id INT NOT NULL,
       message TEXT NOT NULL,
       sent_on INT NOT NULL,
       FOREIGN KEY (user_id) REFERENCES users(id)
   );

   -- Insert sample users
   INSERT INTO users (username) VALUES ('john'), ('jane'), ('mike');
   ```

### Application Setup

1. **Clone the repository:**
   ```bash
   git clone https://github.com/RajmaniShukla/chatbox.git
   cd chatbox
   ```

2. **Configure database credentials:**
   
   Edit `FbChatMock.php` and update:
   ```php
   private $_dbHost = 'localhost';
   private $_dbUsername = 'your_username';
   private $_dbPassword = 'your_password';
   public $_databaseName = 'fbchat';
   ```

3. **Configure your web server** to serve the project directory

4. **Access the chat:**
   ```
   http://localhost/chatbox/Chat.php?user_id=1
   ```

## 🚀 Usage

### Opening a Chat Session

Access the chat with a user ID parameter:
```
Chat.php?user_id=1
```

### Sending Messages

1. Type your message in the textarea
2. Press **Enter** to send
3. Press **Shift + Enter** for a new line

### Demo Page

Open `index.html` to see the Facebook-style sidebar and popup design.

## 🔒 Security Notes

⚠️ **Important Security Considerations:**

1. **Database Credentials** - Move to environment variables or config file
2. **Session Security** - Implement proper authentication
3. **SQL Injection** - Using mysqli with escaping (consider prepared statements)
4. **XSS Protection** - Messages are HTML-escaped

### Recommended Improvements

```php
// Instead of hardcoded credentials:
private $_dbHost = getenv('DB_HOST') ?: 'localhost';
private $_dbUsername = getenv('DB_USER') ?: 'root';
private $_dbPassword = getenv('DB_PASS') ?: '';
```

## 🗄️ Database Schema

### Users Table
| Column | Type | Description |
|--------|------|-------------|
| id | INT | Primary key |
| username | VARCHAR(50) | Display name |
| created_at | TIMESTAMP | Registration date |

### Chat Table
| Column | Type | Description |
|--------|------|-------------|
| id | INT | Primary key |
| user_id | INT | Foreign key to users |
| message | TEXT | Message content |
| sent_on | INT | Unix timestamp |

## 🛠️ API Endpoints

| Endpoint | Method | Description |
|----------|--------|-------------|
| `Chat.php?user_id=X` | GET | Load chat widget for user X |
| `add_msg.php` | POST | Add new message (`msg` parameter) |
| `get_msg.php` | GET | Fetch all messages |

## 💡 Future Improvements

- [ ] WebSocket support for real-time updates
- [ ] User authentication system
- [ ] Private messaging between users
- [ ] Message read receipts
- [ ] Emoji support
- [ ] File/image sharing
- [ ] Mobile-responsive chat interface

## 👤 Author

**Rajmani Shukla**

- GitHub: [@RajmaniShukla](https://github.com/RajmaniShukla)

## 📜 License

This project is licensed under the MIT License.

---

💬 *Simple, clean, Facebook-style chat for your web applications*
