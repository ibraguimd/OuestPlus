<?php
error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('display_startup_errors',true);

require('./vendor/autoload.php');

include('./config/env.php');

foreach (glob('./data/*.php') as $file) {
    include($file);
}
foreach (glob('./control/*.php') as $file) {
    include($file);
}

include ('./page/fct_date.php');

$faker = Faker\Factory::create('fr_FR');

switch ($argv[1]) {
    case "migrate" :
        artisan_migrate();
        break;
    case "seed" :
        artisan_seed();
        break;
    default :
        var_dump(" This option doesn't exist !");
    break;
}


function artisan_migrate() {
    artisan_migrate_minimum();
    artisan_migrate_project();
}


function artisan_seed() {
    artisan_seed_minimum();
    artisan_seed_project();
}


function artisan_migrate_project() {
    // Here is the begining of your project. You can create all the tables you need
    // A example is made with a table named "example"

    // First :  drop the tables if exists
    echo "DROPPING ALL YOUR TABLES : ";
    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS example;')) ? '-' : 'x';
    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';

    // Second : create your tables
    echo "\nCREATING ALL YOUR TABLES : ";
    $request =  'CREATE TABLE IF NOT EXISTS example (
        id int AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255)
        );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    // Third : Alter tables to add Foreign Keys
    echo "\nADDING ALL YOUR FOREIGN KEYS : ";
    echo "\n";

}

function artisan_seed_project() {
    // Here is the beginning of your project. You can seed all the tables you need
    // A exemple is made with a table named "exemple"

    // First : empty your tables 
    echo "EMPTY ALL YOUR TABLES : ";
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE example')) ? '-' : 'x';
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
    echo "\n";

    // Thrid : calls the seeders functions here
}


function artisan_migrate_minimum() {
    
    // First : drop tables if exists
    echo "DROPPING ALL MINIMUM TABLES : ";
    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS user;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS role;')) ? '-' : 'x';
    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
    
    // Second : Create tables
    echo "\nCREATING ALL MINIMUM TABLES : ";
    $request =  'CREATE TABLE IF NOT EXISTS user (
        id int AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(255),
        lastName VARCHAR(255),
        email VARCHAR(255),
        password VARCHAR(255),
        isAdmin int,
        role_id int REFERENCES role(id)
        );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS role (
                id int AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(50)
                );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';



    // Third : Alter tables to add Foreign Keys
    echo "\nADDING ALL MINIMUM FOREIGN KEYS : ";
    $request =  'ALTER TABLE user 
                ADD CONSTRAINT fk1_role_id
                FOREIGN KEY (role_id) REFERENCES role(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';


}

function artisan_seed_minimum() {
    
    // First : empty tables
    echo "EMPTY ALL MINIMUM TABLES : ";
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE user')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE role')) ? '-' : 'x';
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
    echo "\n";
    
    // second : seed tables
    function seedRoles(){
        echo "ADD RECORDS IN TABLE role : ";
        $roles=['Employee','Utilisateur','Admin'];
        foreach ($roles as $role) {
            Connection::insert('role',['name'=>$role], null);
            echo '-';
        }
        echo "\n";
    }

    function seedRandomUser($isAdmin){
        $faker = Faker\Factory::create('fr_FR');
        $firstName=$faker->firstName();
        $lastName=$faker->lastName();
        $email=strtolower(utf8_decode($firstName[0])).'.'.strtolower(utf8_decode($lastName)).'@test.fr';
        $user = [
            'firstName' => $firstName,
            'lastName' => $lastName, 
            'email' => $email, 
            'password' => sha1('pwsio'), 
            'role_id' => $faker->numberBetween(1,3),
            'isAdmin' => $isAdmin
        ];
        //var_dump($user);
        // Make sure it dosen't aleadry exists
        if(Connection::safeQuery('select count(*) as count from user where email=?', [$user['email']],null)[0]['count']==0) {
            Connection::insert('user', $user,null);
        }
    }

    function seedUserSIO(){
        $user = [
            'firstName' => 'user',
            'lastName' => 'SIO', 
            'email' => 'usersio@test.fr', 
            'password' => sha1('pwsio'), 
            'role_id' => 1,
            'isAdmin' => 1
        ];
       Connection::insert('user', $user, null);
    }

    function seedUsers($nbUsers)
    {
        echo "ADD RECORDS IN TABLE user : ";
        seedUserSIO();
        echo '-';
        for ($i=0;$i<$nbUsers;$i++){
            if ($i==0){
                seedRandomUser(1);
            }
            else{
                seedRandomUser(0);
            }
            echo '-';
        }
        echo "\n";      
    }
    //roles
    seedRoles();
    //users
    seedUsers(100);


    
}


