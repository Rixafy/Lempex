# Lempex
🛠️ Console utility for managing web projects safely (Nginx configuration, PHP versions and pools, FTP accounts, MariaDB databases and backups)

# Concept

## Commands

### General
`lempex` Show command help

`lempex project <name> add` Add new project

`lempex project <name> info` Show info about projects, ftp accounts, websites

`lempex project <name> edit` Edit project

### Storage
`lempex project <name> ftp list` Show all FTP account names

`lempex project <name> ftp add <ftp>` Add new FTP account

`lempex project <name> ftp info <ftp>` Show connection count, etc.

`lempex project <name> ftp log <ftp>` Show connection log (last 100 by default)

`lempex project <name> ftp edit <ftp>` Edit FTP name or password

`lempex project <name> ftp remove <ftp>` Remove FTP account

### Websites

`lempex project <name> web list` Show all websites in project

`lempex project <name> web add <domain>` Add new website

`lempex project <name> web info <domain>` Show website configuration

`lempex project <name> web edit <domain>` Edit website settings

`lempex project <name> web remove <domain>` Remove domain

`lempex project <name> web redirect <source> <dest>` Domain redirect

`lempex project <name> web https <domain> always/smart/never` Use https?

`lempex project <name> web auth <domain> enable/disable` Enable HTTP promp auth?

`lempex project <name> web certify <domain>` Create SSL certificate for website

`lempex project <name> web backup <domain>` Backup website

### Database

`lempex project <name> database list` Show all databases in project

`lempex project <name> db add <database>` Add new database

`lempex project <name> db edit <database>` Edit database credentials

`lempex project <name> db remove <database>` Remove database

`lempex project <name> db backup <database>` Backup database

### Security

`lempex project <name> ssh key add <key>` Add RSA public key

`lempex project <name> ssh key remove <name/email/key>` Remove RSA public key

`lempex project <name> ssh enable/disable` Enable or disable SSH connections

`lempex project <name> ssh list` Show SSH accounts

`lempex project <name> ssh status` Show SSH status

`lempex project <name> ssh log` Show SSH log (last 100 by default)
