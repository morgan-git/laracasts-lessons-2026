#!/bin/bash

#echo "Starting Laravel..."
#php artisan serve &

echo "Starting Queue Worker..."
php artisan queue:work > /dev/null 2>&1 &

echo "Starting Vite..."
npm run dev > /dev/null 2>&1 &

echo "Starting MailPit..."
mailpit > /dev/null 2>&1 &
#wait
disown -a



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
