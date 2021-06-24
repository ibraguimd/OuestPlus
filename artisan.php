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
    echo (0 ==Connection::exec('DROP TABLE IF EXISTS locations;')) ? '-' : 'x';
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

    $request =  'CREATE TABLE IF NOT EXISTS locations (
                id int AUTO_INCREMENT PRIMARY KEY,
                label VARCHAR(255)
                );';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'CREATE TABLE IF NOT EXISTS tasks (
        id int AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        description VARCHAR(255),
        creationDate DATE,
        scheduledDate DATE,
        doneDate DATE,
        workDuration TIME,
        location_id int REFERENCES locations(id),
        department_id int REFERENCES departments(id),
        creator_user_id int REFERENCES users(id),
        assign_user_id int REFERENCES users(id)
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
                ADD CONSTRAINT fk2_task_id
                FOREIGN KEY (location_id) REFERENCES locations(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE tasks
                ADD CONSTRAINT fk1_creator_user_id
                FOREIGN KEY (creator_user_id) REFERENCES users(id)
                ON DELETE RESTRICT
                ON UPDATE RESTRICT;';
    echo (0 ==Connection::exec($request)) ? '-' : 'x';

    $request =  'ALTER TABLE tasks
                ADD CONSTRAINT fk1_assign_user_id
                FOREIGN KEY (assign_user_id) REFERENCES users(id)
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
    echo (0 == Connection::exec('TRUNCATE locations')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE tasks')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE histories')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE capacities')) ? '-' : 'x';
    echo (0 == Connection::exec('TRUNCATE capacities_roles')) ? '-' : 'x';
    echo (0 == Connection::exec('SET FOREIGN_KEY_CHECKS=1;')) ? '-' : 'x';
    echo "\n";
    
    // second : On insére des données dans les tables (seed)
    function seedRoles(){
        echo "ADD RECORDS IN TABLE roles : ";
        $roles=['Employé','Employé du service de maintenance informatique','Employé du service de maintenance technique','Employé du service ressources humaines',
            'Direction de l\'entreprise','Administrateur'];
        foreach ($roles as $role) {
            Roles::create(['label'=>$role]);
            echo '-';
        }
        echo "\n";
    }

    function seedRandomUser($nbUser){
        for ($i=0;$i<$nbUser;$i++){
            $faker = Faker\Factory::create('fr_FR');
            $firstName=$faker->firstName();
            $lastName=$faker->lastName();
            $email=strtolower(utf8_decode($firstName[0])).'.'.strtolower(utf8_decode($lastName)).'@test.fr';
            $user = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
                'password' => sha1('pwsio'),
                'role_id' => $faker->numberBetween(1,5)
            ];

            // On vérifie qu'il n'existe déjà pas dans la BDD

            // On utilise la fonction count qui nous permet de compter le nombre de doublon, donc il nous reste plus qu'à vérifier
            // qu'il n'y a aucun doublon (==0)
            if(Users::count('email="'.$user["email"].'"')==0) {
                Users::create($user);
                echo "-";
                echo "-";
            }
            else{
                $i--;
            }
        }
        echo "\n";
    }

    function seedUserSIO(){
        $user = [
            'firstName' => 'user',
            'lastName' => 'SIO',
            'email' => 'usersio@test.fr',
            'password' => sha1('pwsio'),
            'role_id' => 6
        ];
       Users::create($user);
        echo "-";
    }

    function seedUsers($nbUsers)
    {
        echo "ADD RECORDS IN TABLE user : ";
        seedUserSIO();
        seedRandomUser($nbUsers);
    }

    function seedDepartments($nbDepartments)
    {
        echo "ADD RECORDS IN TABLE departments : ";
        for ($i=0;$i<$nbDepartments;$i++)
        {
            $faker = Faker\Factory::create('fr_FR');
            $description = $faker->city;

            $departments=
                [
                    'name' => $description
                ];
            if(Departments::count('name="'.$departments["name"].'"')==0) {
                Departments::create($departments);
                echo "-";
        }
            else{
                $i--;
            }
        }
        echo "\n";
    }

    function seedLocations($nbLocations)
    {
        echo "ADD RECORDS IN TABLE locations : ";
        for ($i=0;$i<$nbLocations/2;$i++)
        {
            $faker = Faker\Factory::create('fr_FR');
            $location = 'Salle '.$faker->country;

            $locations=
                [
                    'label' => $location
                ];
            if(Locations::count('label="'.$locations["label"].'"')==0) {
                Locations::create($locations);
                echo "-";
        }
            else{
                $i--;
            }
        }
        echo "\n";
        for ($i=0;$i<$nbLocations/2;$i++)
        {
            $faker = Faker\Factory::create('fr_FR');
            $location = $faker->numerify('salle-##');

            $locations=
                [
                    'label' => $location
                ];
            if(Locations::count('label="'.$locations["label"].'"')==0) {
                Locations::create($locations);
                echo "-";
        }
            else{
                $i--;
            }
        }
        echo "\n";
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
        echo "ADD RECORDS IN TABLE tasks : ";
        for ($i=0;$i<$nbTasks/2;$i++){
            $faker = Faker\Factory::create('fr_FR');
            $title = $faker->sentence(3);
            $description = $faker->text(11);
            $creationDate = $faker->date();
            $scheduledDate = null;
            $doneDate = null;
            $workDuration = null;
            $departmentId = $faker->numberBetween(1,500);
            $locationId = $faker->numberBetween(1,20);
            $creatorUserId = $faker->numberBetween(1,1000);
            $assignUserId = null;
            $task = [
                'title' => $title,
                'description' => $description,
                'creationDate' => $creationDate,
                'scheduledDate' => $scheduledDate,
                'doneDate' => $doneDate,
                'workDuration' => $workDuration,
                'department_id' => $departmentId,
                'location_id' => $locationId,
                'creator_user_id' => $creatorUserId,
                'assign_user_id' => $assignUserId
            ];

            // Make sure it dosen't aleadry exists
            if (Tasks::count('title="'.$task['title'].'"')==0)
            {
                Tasks::create($task);
                echo '-' ;
            }
            else{
                $i--;
            }
        }

        for ($i=0;$i<$nbTasks/2;$i++){
            $faker = Faker\Factory::create('fr_FR');
            $title = $faker->sentence(3);
            $description = $faker->text(11);
            $creationDate = $faker->date();
            $scheduledDate = dateUpper($creationDate);
            $doneDate = dateUpper($creationDate);
            $workDuration = $faker->time();
            $departmentId = $faker->numberBetween(1,500);
            $locationId = $faker->numberBetween(1,20);
            $creatorUserId = $faker->numberBetween(1,1000);
            $assignUserId = null;
            $task = [
                'title' => $title,
                'description' => $description,
                'creationDate' => $creationDate,
                'scheduledDate' => $scheduledDate,
                'doneDate' => $doneDate,
                'workDuration' => $workDuration,
                'department_id' => $departmentId,
                'location_id' => $locationId,
                'creator_user_id' => $creatorUserId,
                'assign_user_id' => $assignUserId
            ];

            // Make sure it dosen't aleadry exists
            if (Tasks::count('title="'.$task['title'].'"')==0)
            {
                Tasks::create($task);
                echo '-' ;
            }
            else{
                $i--;
            }
        }

        echo "\n";

    }

    function seedCapacities()
    {
        echo "ADD RECORDS IN TABLE capacities : ";
        for ($i=0;$i<8;$i++)
        {

            $labels=['addTask','assignTask','deleteTask','updateTask','displayStat','displayOwnTask','displayUsersByRole','displayAllTask'];
            $descriptions=['Peut ajouter des tâches' , 'Peut assigner des tâches' , 'Peut supprimer des tâches',
                'Peut modifié une tâche' , 'Peut visualiser les graphiques' , 'Peut ses visualiser les tâches',
                'Peut afficher la listes des utilisateurs par rôles','Peut afficher les tâches de tous les utilisateurs'];

            $capacities= [
                'label' => $labels[$i],
                'description' => $descriptions[$i]
            ];
            if (Capacities::count('label="'.$capacities['label'].'"')==0)
            {
                Capacities::create($capacities);
            }
            else{
                $i--;
            }
            echo '-';
        }
        echo "\n";
    }

    function seedCapacityRoles()
    {
        echo "ADD RECORDS IN TABLE capacity role : ";
        for ($i=0;$i<27;$i++)
        {
            /** Role_id
             *  6 --> Administrateur
             *  5 --> Direction de l'entreprise
             *  4 --> Employé du service ressources humaines
             *  3 --> Employé du service de maintenance technique
             *  2 --> Employé du service de maintenance info
             *  1 --> Employé
             *
             *  Capacity_id
             *  1 --> Peut ajouter des tâches
             *  2 --> Peut assigner des tâches
             *  3 --> Peut supprimer des tâches
             *  4 --> Peut modifier les tâches
             *  5 --> Peut visualiser les graphiques
             *  6 --> Peut afficher ses tâches
             *  7 --> Peut afficher la liste des utilisateurs classé par role
             *  8 --> Peut afficher toutes les tâches
             */

            // Ajout des capacités pour l'admin
            $roleId=[6,6,6,6,6,6,6,6];
            $capacityId=[1,2,3,4,5,6,7,8];

            //Ajout des capacités pour la direction
            array_push($roleId,5,5,5,5,5);
            array_push($capacityId,1,5,6,7,8);

            //Ajout des capacités pour les employés du service ressources humaines
            array_push($roleId,4,4);
            array_push($capacityId,1,6);

            //Ajout des capacités pour les employés du service de maintenance technique
            array_push($roleId,3,3,3,3,3);
            array_push($capacityId,1,2,4,6,8);

            //Ajout des capacités pour les employés du service de maintenance informatique
            array_push($roleId,2,2,2,2,2);
            array_push($capacityId,1,2,4,6,8);

            //Ajout des capacités pour les employés
            array_push($roleId,1,1);
            array_push($capacityId,1,6);

            $capacitiesRoles= [
                'role_id' => $roleId[$i],
                'capacity_id' => $capacityId[$i]
            ];
            if (Capacities_Roles::count('role_id="'.$capacitiesRoles["role_id"].'" AND capacity_id="'.$capacitiesRoles['capacity_id'].'"')==0)
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
    seedUsers(1000);
    //departments
    seedDepartments(500);
    //departments
    seedLocations(100);
    //tasks
    seedTasks(1000);
    //capacities
    seedCapacities();
    //capacities roles
    seedCapacityRoles();

    
}


