# WordPress Docker Environment

A **Docker-based WordPress local development environment** quickly spin up a complete WordPress stack using Docker. This setup is ideal for theme and plugin development, testing, and maintaining consistent environments across different machines.

---

## 🚀 Features

* WordPress powered by the official Docker image
* Database service (MySQL/MariaDB)
* Easy configuration via environment variables
* Fast setup with Docker Compose
* Isolated and reproducible development environment

---

## 📦 Requirements

Before getting started, make sure you have the following installed:

* Docker
* Docker Compose

You can verify installation by running:

```bash
docker --version
docker compose version
```

---

## ⚙️ Getting Started

1. **Clone the repository**

```bash
git clone https://github.com/Marcos-SCO/wordpress_docker_environment.git
cd wordpress_docker_environment
```

2. **Start the environment**

```bash
docker compose up -d
```

## 📂 Project Structure (example)

```
wordpress_docker_environment/
├── docker-compose.yml
├── .env
└── README.md
```

> You can customize volumes, ports, and environment variables according to your needs.

---

## 🧪 Use Cases

* Local WordPress development
* Theme and plugin testing
* Learning Docker with a real-world PHP application
* Consistent environments for teams

## 👤 Author

**Marcos-SCO** - PHP / WordPress Developer

Feel free to fork, customize, and improve this e
