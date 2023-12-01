# MedTest ![Static Badge](https://img.shields.io/badge/html-%23fff?logo=html5) ![Static Badge](https://img.shields.io/badge/css-%23563D7C?logo=css3) ![Static Badge](https://img.shields.io/badge/JavaScript-%23fff?logo=JavaScript) ![Static Badge](https://img.shields.io/badge/PHP-%23fff?logo=PHP) ![Static Badge](https://img.shields.io/badge/docker-%23384d54?logo=docker)

### _MedTest - Group_22
A docker-compose stack to set up a LAMP stack

## Available Scripts
```sh
#Clone this repository or unzip the repository(MedTest_Group22)
git clone https://github.com/kkanho/Group_22.git

#change to the correct directory
cd MedTest_Group22

#Build the server through docker
docker-compose up --build
```
Open [http://localhost](http://localhost) to view it in the browser.

#if any errors, try to restart multiple times with the following command
```sh
docker-compose down

docker-compose up --build
```

## Query Log
We view query log using phpMyAdmin using the following 2 accounts
| Username | Password |
|   ----   |   ----   |
| root     |          |
| admin    | 123123   |

In order to view query log using account admin,
type the following command in the docker 
```sh
#locate the image(mysql:latest), get the container id(8815b887d4d7)
docker ps

#run commands inside an existing container, with the id(8815b887d4d7) just get
docker exec -it 8815b887d4d7 bash

#execute the following command inside the container
mysql -h localhost -P 3306 -u root
GRANT ALL PRIVILEGES ON mysql.general_log TO 'admin';
FLUSH PRIVILEGES;
exit;

#exit the container
exit
```
To view log, simple run the following query
```sql
SELECT * FROM mysql.general_log
```

## Features
- [x] Ability to sign up, login and logout
- [x] Ability to access table with different privileges(front end)
- [x] Form query log