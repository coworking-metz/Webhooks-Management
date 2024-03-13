# Webhooks Management

## Overview
This repository is designed for setting up and managing webhooks on a HTTP server. It enables efficient processing of incoming webhook requests and allows for easy integration with other services or scripts. this codebase need a local Redis instance with default hiost/login/port set up. 

## Structure
- `.htaccess`: Apache server configuration file for request routing and permissions.
- `cloudflare.sh`: A script for interacting with Cloudflare APIs, for purging cache in response to webhooks.
- `deploy.sh`: A deployment script that can be used to automate the deployment process of your web applications.
- `index.php`: The main entry point for incoming webhook requests. Processes requests and store them in redis.
- `lib/main.inc.php`: Contains core functionalities and utilities for webhook processing.
- `service.sh`: A generic service script that can be adapted for various background tasks or services.
- `traitement-webhooks.sh`: The script that is executed by the service, who will read the events in local redis and launch actions.

## Usage
Direct webhooks to `http://{your-server}/[path-to-webhooks]/[action]/[slug]`. The system is designed to process each request according to your custom logic in `index.php` and the utility library, with options to trigger additional scripts for automation or notification purposes. The events are stored in the local redis

## Production behaviour
On the server, the script service.sh is executed in a service (usually stored in /lib/systemd/system/webhooks.service)

```ini
[Unit]
Description=Webhooks 
After=network.target

[Service]
ExecStart=/home/coworking/webhooks/service.sh
Restart=always
User=coworking
Group=coworking

[Install]
WantedBy=multi-user.target
```

This service is active on the production server and can be either stopped, restarted, and asked for status : 

```bash
sudo systemctl start webhooks.service
sudo systemctl stop webhooks.service
sudo systemctl restart webhooks.service
sudo systemctl status webhooks.service
```

## License
Under the MIT Licence for open source projects.



