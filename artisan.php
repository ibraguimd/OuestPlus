<?php
error_reporting(E_ALL);
ini_set('display_errors',true);
ini_set('display_startup_errors',true);

require('./vendor/autoload.php');

include('./config/env.php');

foreach (glob('./data/*.php') as $file) {
    include($file);
}
foreach (glob('./data/model/*.php') as $file) {
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

}


function artisan_seed() {
    artisan_seed_minimum();
    artisan_seed_project();
}


//function artisan_migrate_project() {
//    // Here is the begining of your project. You can create all the tables you need
//    // A example is made with a table named "example"
//
//    // First :  drop the tables if exists
//    echo "DROPPING ALL YOUR TABLES : ";
//    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
//    echo (0 ==Connection::exec('DROP TABLE IF EXISTS example;')) ? '-' : 'x';
//    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
//
//    // Second : create your tables
//    echo "\nCREATING ALL YOUR TABLES : ";
//    $request =  'CREATE TABLE IF NOT EXISTS example (
//        id int AUTO_INCREMENT PRIMARY KEY,
//        name VARCHAR(255)
//        );';
//    echo (0 ==Connection::exec($request)) ? '-' : 'x';
//
//    // Third : Alter tables to add Foreign Keys
//    echo "\nADDING ALL YOUR FOREIGN KEYS : ";
//    echo "\n";
//
//}

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
    
    // On supprime les tables si elles existent déjà
    echo "DROPPING ALL MINIMUM TABLES : ";
    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS users;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS roles;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS histories;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS departments;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS tasks;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS capacities;')) ? '-' : 'x';
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS capacities_roles;')) ? '-' : 'x';
    echo (0 ==Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
    
    // Création des tables
    echo "\nCREATING ALL MINIMUM TABLES : ";

    $request =  'CREATE TABLE IF NOT EXISTS histories (
                id int AUTO_INCREMENT PRIMARY KEY,
                datetime DATE,
                description VARCHAR(255),
                task_id int REFERENCES tasks(id),
                user_id int REFERENCES users(id)
                );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS users (
        id int AUTO_INCREMENT PRIMARY KEY,
        firstName VARCHAR(255),
        lastName VARCHAR(255),
        email VARCHAR(255),
        password VARCHAR(255),
        role_id int REFERENCES roles(id)
        );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS roles (
                id int AUTO_INCREMENT PRIMARY KEY,
                label VARCHAR(255)
                );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS departments (
                id int AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255)
                );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS tasks (
        id int AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        description VARCHAR(255),
        location VARCHAR(255),
        creationDate DATE,
        scheduledDate DATE,
        doneDate DATE,
        workDuration TIME, 
        department_id int REFERENCES departments(id),
        user_id int REFERENCES users(id)
        );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS capacities (
        id int AUTO_INCREMENT PRIMARY KEY,
        label VARCHAR(255),
        description VARCHAR(255)
        );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS capacities_roles (
        id int AUTO_INCREMENT PRIMARY KEY,
        role_id int REFERENCES roles(id),
        capacity_id int REFERENCES capacities(id)
        );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    // Création des clés étrangères

    echo "\nADDING ALL MINIMUM FOREIGN KEYS : ";
    $request =  'ALTER TABLE users 
                ADD CONSTRAINT fk1_role_id
                FOREIGN KEY (role_id) REFERENCES roles(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE histories
                ADD CONSTRAINT fk1_task_id
                FOREIGN KEY (task_id) REFERENCES tasks(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE histories
                ADD CONSTRAINT fk1_user_id
                FOREIGN KEY (user_id) REFERENCES users(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE tasks
                ADD CONSTRAINT fk1_department_id
                FOREIGN KEY (department_id) REFERENCES departments(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE tasks
                ADD CONSTRAINT fk2_user_id
                FOREIGN KEY (user_id) REFERENCES users(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE capacities_roles
                ADD CONSTRAINT fk2_role_id
                FOREIGN KEY (role_id) REFERENCES roles(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE capacities_roles
                ADD CONSTRAINT fk2_capacity_id
                FOREIGN KEY (capacity_id) REFERENCES capacities(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';
    echo "\n";

}

function artisan_seed_minimum() {
    
    // First : empty tables
    echo "EMPTY ALL MINIMUM TABLES : ";
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=0;')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE users')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE roles')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE departments')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE tasks')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE histories')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE capacities')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE capacities_roles')) ? '-' : 'x';
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
    echo "\n";
    
    // second : On insére des données dans les tables (seed)
    function seedRoles(){
        echo "ADD RECORDS IN TABLE roles : ";
        $roles=['Employee','Service de maintenance','Direction de l\'entreprise'];
        foreach ($roles as $role) {
            Roles::create(['label'=>$role]);
            echo '-';
        }
        echo "\n";
    }

    function seedRandomUser(){
        $faker = Faker\Factory::create('fr_FR');
        $firstName=$faker->firstName();
        $lastName=$faker->lastName();
        $email=strtolower(utf8_decode($firstName[0])).'.'.strtolower(utf8_decode($lastName)).'@test.fr';
        $user = [
            'firstName' => $firstName,
            'lastName' => $lastName, 
            'email' => $email, 
            'password' => sha1('pwsio'),
            'role_id' => $faker->numberBetween(1,2)
        ];

        // Make sure it dosen't aleadry exists
        if(Users::doublon('email="'.$user["email"].'"')[0]->nbDoublon==0) {
            Users::create($user);
        }
    }

    function seedUserSIO(){
        $user = [
            'firstName' => 'user',
            'lastName' => 'SIO',
            'email' => 'usersio@test.fr',
            'password' => sha1('pwsio'),
            'role_id' => 1
        ];
       Users::create($user);
    }

    function seedDirecteur(){
        $faker = Faker\Factory::create('fr_FR');
        $firstName=$faker->firstName();
        $lastName=$faker->lastName();
        $email=strtolower(utf8_decode($firstName[0])).'.'.strtolower(utf8_decode($lastName)).'@test.fr';
        $directeur = [
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'password' => sha1('pwsio'),
            'role_id' => 3
        ];
        Users::create($directeur);
    }

    function seedUsers($nbUsers)
    {
        echo "ADD RECORDS IN TABLE user : ";
        seedUserSIO();
        seedDirecteur();
        echo '-';
        for ($i=0;$i<$nbUsers;$i++){
            seedRandomUser();


            echo '-';
        }
        echo "\n";      
    }

    function seedDepartments($nbDepartments)
    {
        for ($i=0;$i<$nbDepartments;$i++)
        {
            $faker = Faker\Factory::create('fr_FR');
            $description = $faker->city;

            $departments=
                [
                    'name' => $description
                ];
            if(Departments::doublon('name="'.$departments["name"].'"')[0]->nbDoublon==0) {
                Departments::create($departments);
        }

        }
    }

    function dateUpper($date)
    {
        $faker = Faker\Factory::create('fr_FR');
        $nextDate = $faker->date();
        while(strtotime($nextDate)<strtotime($date)){
            $nextDate=$faker->date();
        }
        return $nextDate;
    }

    function seedTasks($nbTasks){
        for ($i=0;$i<$nbTasks;$i++){
            $faker = Faker\Factory::create('fr_FR');
            $title = $faker->jobTitle;
            $description = $faker->text(11);
            $location = $faker->postcode;
            $creationDate = $faker->date();
            $scheduledDate = dateUpper($creationDate);
            $doneDate = dateUpper($scheduledDate);
            $workDuration = $faker->time();
            $departmentId = $faker->numberBetween(1,30);
            $userId = $faker->numberBetween(1,100);
            $task = [
                'title' => $title,
                'description' => $description,
                'location' => $location,
                'creationDate' => $creationDate,
                'scheduledDate' => $scheduledDate,
                'doneDate' => $doneDate,
                'workDuration' => $workDuration,
                'department_id' => $departmentId,
                'user_id' => $userId
            ];

            // Make sure it dosen't aleadry exists
            if (Tasks::doublon('title="'.$task['title'].'"')[0]->nbDoublon==0)
            {
                Tasks::create($task);
            }
        }

    }

    function seedCapacities()
    {
        echo "ADD RECORDS IN TABLE capacities : ";
        for ($i=0;$i<6;$i++)
        {

            $labels=['addTask','assignTask','deleteTask','updateTask','displayStat','displayTask'];
            $descriptions=['Ajouter des tâches','Assigner des tâches','Supprimer des tâches','Peut modifié une tâche','Peut visualiser les graphiques','Peut visualiser les tâches'];

            $capacities= [
                'label' => $labels[$i],
                'description' => $descriptions[$i]
            ];
            if (Capacities::doublon('label="'.$capacities['label'].'"')[0]->nbDoublon==0)
            {
                Capacities::create($capacities);

            }
            echo '-';
        }
        echo "\n";
    }

    function seedCapacityRoles()
    {
        echo "ADD RECORDS IN TABLE capacity role : ";
        for ($i=0;$i<14;$i++)
        {
            $roleId=[3,3,3,3,3,3,2,2,2,2,1,1,1,1];
            $capacityId=[1,2,3,4,5,6,1,2,5,6,1,6,5,2];

            $capacitiesRoles= [
                'role_id' => $roleId[$i],
                'capacity_id' => $capacityId[$i]
            ];
            if (Capacities_Roles::doublon('role_id="'.$capacitiesRoles["role_id"].'" AND capacity_id="'.$capacitiesRoles['capacity_id'].'"')[0]->nbDoublon==0)
            {
                Capacities_Roles::create($capacitiesRoles);
            }
            echo "-";
        }
        echo "\n";
    }

    //roles
    seedRoles();
    //users
    seedUsers(100);
    //departments
    seedDepartments(80);
    //tasks
    seedTasks(100);
    //capacities
    seedCapacities();
    //capacities roles
    seedCapacityRoles();

    
}


