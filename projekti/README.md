# Docker Compose Guide

## 🚀 Quick Start

### Development (with phpMyAdmin)
```bash
docker-compose --profile dev up -d    # Start
docker-compose down                   # Stop
docker ps -a --filter "network=projekti_laravel" --format "{{.ID}}" | ForEach-Object { docker rm -f $_ }
```
# After making code changes, clear Laravel cache:
```bash
docker compose exec app php artisan optimize:clear
```

**Access:**
- Laravel: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (root/rootpassword)
- MySQL: localhost:3307

### Production (secure, no phpMyAdmin)
```bash
docker-compose -f docker-compose.yml up -d    # Start
docker-compose -f docker-compose.yml down     # Stop
```

---

## 📋 Common Commands

```bash
# View logs
docker-compose logs -f

# Access container shell
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan migrate

# Restart after changes
docker-compose restart app

# Rebuild containers
docker-compose up -d --build

# Remove everything including data (⚠️ destructive)
docker-compose down -v
```

---

## 🔧 Troubleshooting

**Port already in use:**
```bash
netstat -ano | findstr :8080
```

**Clear Laravel cache:**
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

**Fix permissions:**
```bash
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

---

## 📝 Key Differences

| Feature | Development | Production |
|---------|-------------|------------|
| Code changes | Auto-reload | Requires rebuild |
| phpMyAdmin | ✅ Enabled | ❌ Disabled |
| Debug mode | ✅ On | ❌ Off |
| File mounts | Full source | .env + storage only |