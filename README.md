# Webhooks Management

## Overview
This repository contains the necessary components to set up and manage webhooks on a HTTP server. It is designed to provide a straightforward way to handle incoming webhook requests, process them as needed, and optionally trigger other scripts or processes in response.

## Structure
- `.htaccess`: Apache server configuration file to handle request routing and permissions.
- `index.php`: The main entry point for webhook requests. This file processes incoming requests and dispatches them to the appropriate handler.
- `lib/main.inc.php`: A library file that contains core functionalities and utilities for processing webhook data.
- `traitement-webhooks.sh`: An example shell script that could be triggered by the PHP handler as part of the webhook processing routine.

## Installation
1. Clone this repository to your web server's serving directory.
2. Ensure `.htaccess` is properly configured to allow access to `index.php` while restricting access to other resources as needed.
3. Modify `index.php` and `lib/main.inc.php` as necessary to suit your webhook processing requirements.
4. Set appropriate permissions on `traitement-webhooks.sh` to allow execution as part of the webhook handling process (if used).

## Configuration
- **Apache Configuration**: Make sure that your Apache configuration allows for `.htaccess` overrides. This is crucial for the routing and security settings defined in `.htaccess` to take effect.
- **Webhook Processing**: Customize `index.php` to parse and process incoming webhook payloads according to your specific needs. Utilize functions and utilities defined in `lib/main.inc.php` for more efficient handling.
- **Shell Script Execution**: If utilizing `traitement-webhooks.sh` or any other external scripts, configure these scripts to perform the desired actions (e.g., data processing, notifications, etc.). Ensure these scripts are securely accessible and executable by the server process.

## Usage
To use the Webhooks Management system, direct incoming webhook payloads to `http://{your-server}/path-to-webhooks/index.php`. The system will process each request according to the logic defined in `index.php` and `main.inc.php`, with the possibility of triggering additional scripts like `traitement-webhooks.sh`.

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

## Security Considerations
- Always validate and sanitize incoming data to prevent injection attacks.
- Restrict access to the server and application files using `.htaccess` or equivalent server configuration.
- Regularly update your server and script components to mitigate vulnerabilities.

## Contributing
Contributions to improve the Webhooks Management system are welcome. Please submit pull requests or issues through the repository's issue tracker.

## License
Under the MIT Licence for open source projects.



