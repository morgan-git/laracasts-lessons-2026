#!/bin/bash

# 1. Check and start Queue Worker
if pgrep -f "queue:work" > /dev/null; then
    echo "Queue Worker is already running. Skipping."
else
    echo "Starting Queue Worker..."
    php artisan queue:work > /dev/null 2>&1 &
fi

# 2. Check and start Vite
if pgrep -f "vite" > /dev/null; then
    echo "Vite is already running. Skipping."
else
    echo "Starting Vite..."
    npm run dev > /dev/null 2>&1 &
fi

# 3. Check and start MailPit
if pgrep "mailpit" > /dev/null; then
    echo "MailPit is already running. Skipping."
else
    echo "Starting MailPit..."
    mailpit > /dev/null 2>&1 &
fi

disown -a

#pgrep -fl "vite|mailpit|queue:work"


#TODO adding for future use for prod version of this dev script create a systemservce?
#sudo nano /etc/systemd/system/afterthesyntax-queue.service
#sudo systemctl daemon-reload
#sudo systemctl start afterthesyntax-queue
#sudo systemctl enable afterthesyntax-queue
#sudo systemctl status afterthesyntax-queue

#[Unit]
#Description=AFTERtheSYNTAX Laravel Queue Worker
#After=network.target

#[Service]
#User=www-data
#Group=www-data
#Restart=always
#ExecStart=/usr/bin/php /var/www/afterthesyntax/artisan queue:work --sleep=3 --tries=3 --max-time=3600
#WorkingDirectory=/var/www/afterthesyntax

#[Install]
#WantedBy=multi-user.target
