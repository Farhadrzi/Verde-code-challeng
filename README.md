<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
## Requirments
The minimum version of php you need to run this project is PHP v8 please make sure you have this version of PHP on your system

## How To Build Project
The first step is to install the project. You are installing project dependencies. First, make sure that Composer is installed on your operating system. If it is not installed, you can install it from this **[Link](https://getcomposer.org/download/)**. And after installation, refer to this section


## Installing packages
To install the packages, first, enter this command in the project's root path.
```shell script

composer install

```

With this command, all the required packages for the project are downloaded and installed.


## Create env file
In the project, because there is no need for a special env, the default env of Laravel is used, and the only thing you need to do is to change the **.env.example** file to **.env**

## Create MySQL Database
Please before start the project run your mysql database , and after that create empty database with name **verde** and after that enter your mysql connection detail in **.env** file. please make sure evey thing working fine with you mysql database

## Migrate Tables to Database
after run the mysql database and enter the connection data in **.env** file please run this command for run migration and create tables.
```shell script

php artisan migrate

```
if this command return error please check your database status and database connection in **.env** file.

## How To Run Project

After you have done all the above things entirely, you can now run the project. To run the project, you can use the following command to run the project automatically for you.

```shell script

php artisan serve

```

### Run All Test File
You can run all test file with this command and check the result of each test.

```shell script

php artisan test

```

## Request And Response Sample

You can see the example api of this project from whit link please make sure check this link. [Postman Sample](https://documenter.getpostman.com/view/11867545/2s7Z13ihTm).

