# Coding-Challenge-Software-Engineer-application-by-Abdessamad-Souilem

## About

This application is a demo app for the coding challenge provided by Nextmedia to evaluate the coding skills of developers and software engineers.

## Used technologies
- Laravel  / VueJs 
- PHP 

## Web Interface
### Show Product List
#### Important
# you need to follow some instruction 
- create a base donner and copy the content of .env.example inside a new .env file 
- run command composer install to install vendor inside abdessamad_you_can_test
- to run project run php artisan serve , you will have access to api from http://127.0.0.1:8000
- run php artisan migrate to get your table of database 
- to run tests run php artisan test

# for front end 
- run npm install inside youcan_test_front
- run npm run serve,  you will have access to app via http://localhost:8080/


# Create Product & Delete Product From CLi

- Run this Command to create new Product :
`php artisan product:create --name=NameOfProduct --description=Description --price=PriceOfProduct --category_id=CatId --image=Path`

- Run this Command to delete Product :
`php artisan product:delete --id=IdOfProduct`


# Create Category & Delete Category From CLi

- Run this Command to create new Category :
`php artisan category:create --name=nameOfCategory --parent=Parent `

- Run this Command to delete Category :
`php artisan category:delete --id=IdOfCategory`


if you stack in somthing please call me in my number or contact me via abdessamadsouilem1@gmail.com

