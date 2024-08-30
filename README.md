simple API

## Guide
1. Clone this repo
2. Copy .env.example to .env
3. Config database with mysql / postgres
4. Instal Dependency ```composer install```
5. Run ```composer fresh``` for database migrate and seed
6. Run ```php artisan test``` for run test
7. Run ```php artisan serve``` for run this project

## Author Route List
| No  |  Method |  Url |
|---|---|---|
| 1.  | GET  | ```http://localhost:8000/api/authors```  | 
| 2. |  GET |  ```http://localhost:8000/api/authors/{id}``` | 
| 3.  | GET  | ```http://localhost:8000/api/authors/{id}/books```  |
| 4.  | POST  | ```http://localhost:8000/api/authors```  |
| 5. |PUT| ```http://localhost:8000/api/authors/{id}```  |
|6. |DELETE| ```http://localhost:8000/api/authors/{id}``` |


## Book Route List
| No  |  Method |  Url |
|---|---|---|
| 1.  | GET  | ```http://localhost:8000/api/books```  | 
| 2. |  GET |  ```http://localhost:8000/api/books/{id}``` | 
| 3.  | POST  | ```http://localhost:8000/api/books```  |
| 4. |PUT| ```http://localhost:8000/api/books/{id}```  |
|5. |DELETE| ```http://localhost:8000/api/books/{id}``` |