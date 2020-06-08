ALTER TABLE users ADD COLUMN username VARCHAR(100) UNIQUE ;

ALTER TABLE users ADD COLUMN credit_balance FLOAT DEFAULT 0;
ALTER TABLE bids ADD COLUMN from_auto_bid BOOLEAN DEFAULT 0;


-- now we are using service
-- cd /etc/systemd/system
-- nano autobid.service

-- [Unit]
-- Description=Autobid
--
-- [Service]
-- ExecStart=/root/autobid.sh
-- Restart=always
-- Type=forking
-- StandardInput=tty-force
--
-- [Install]

-- systemclt start autobid.service


-- nano /root/autobid.sh

-- #!/bin/bash
-- cd /var/www/html/e-commerce && php artisan schedule:run





















--for corn job schduler
-- 1) crontab -e
-- 2) @reboot cd /var/www/html/e-commerce && php artisan schedule:run >> /dev/null 2>&1&
-- 3) reboot
-- 4) systemctl status cron
-- ps -ax|grep cron

-- pgrep cron

-- systemctl status cron

-- kill -9 $(pgrep -U root cron)    // for kill all corn job
--then comment out crontab -e code and reboot

-- for run nohou
    -- nohup php artisan schedule:run >> /dev/null 2>&1 &
    -- pg (to froground the nohup)

-- kill -9 `pgrep [nohup]` // We don't need right now if i run sever off  i need run nginx and php7.2-fpm again
-- systemctl restart nginx
-- systemctl restart php7.2-fpm


-- to get all runing background jobs
-- ps aux | grep sh


-- service
-- cd /etc/systemd/system
---

-- php artisan websockets:serve
-- - 4) kill -9 processid (to get process id "ps -ef")
-- * * * * * cd /var/www/html/e-commerce &cd & php artisan schedule:run >> /dev/null 2>&1






