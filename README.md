# PRAXXYS back-end examination

![github](https://github.com/Redtro2k/praxxy-back-examination/assets/102702524/ecbd20ac-2ef4-4372-98ae-017563cfe85d)




Hi, my name is Darwin, and I'm a fresh graduate of STI College Fairview. I have pursued a Bachelor of Science in Information Technology. I have been studying programming since 2016, and my strongest language is PHP. I particularly enjoy working with the Laravel framework, which happens to be one of your major tools. I am excited to apply for an entry-level position as a Laravel developer and eager to enhance my skills while discovering new tips and tricks. It would be an honor to work with you and the entire team.

## Updates
#### 6/28/2023
- Now add a realtime api
- Now Add Mailing System

#### 6/21/2023
- Now Support mode

## What I used?
- Laravel
    - Jetstream
    - InertiaJs
    - Vue
    - Spatie
        - MediaLibrary
        - Query Builder
- TailwindCSS
    - Aspect Ratio
- MYSQL
- NODEJS Packages
    - headlessui
    - heroicons
    - FilePond
    - Lodash/Debounce
    - MomentJS
    - VCalendar
## Layout using Design Page Figma
- [My Layouts](https://www.figma.com/proto/SD0V7Ie9oR2W736Muwe6zM/Untitled?node-id=4-7&mode=design)

## Improvements
* If you could provide me with additional time, I would be able to accomplish your bonus objectives. Unfortunately, my time is running out 😅. I must admit, though, I thoroughly enjoyed this examination. It reminded me of my thesis days 😅. Moving forward, I plan to refactor my controllers to make them shorter and cleaner.
* I have created a new model for the category, which can be extended if desired. However, I regret to inform you that I have not yet implemented CRUD (Create, Read, Update, Delete) functionality for it.
* When it comes to styling, I utilized the default components provided by Laravel and customized them to align with my design preferences. This was possible because of my familiarity with Tailwind CSS.
* I have implemented an Observer and Mailing functionality, which you can try out if you'd like. However, please note that you would need an alternative mailing system such as Mailtrap, which I used for testing purposes. Additionally, there are several code snippets that need to be added to the .env file.
* It Support Dark Mode
* I already build it for production of all components and pages.
* I created a resuable breadcrumbs using vue to make better the scratch for laravel.

(optional)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=******
MAIL_USERNAME=***********
MAIL_PASSWORD==***********
MAIL_ENCRYPTION=tls
```

### Installation

#### Step 1 - Installing Laravel Project
clone this repository then after that install the laravel composer, I assume that you have already composer and nodejs so we will skip for that.
```properties
composer install
```
after the composer installing the laravel then move forward to nodejs

!Type this command inside the directory of laravel project!
```properties
npm install
```

#### Step 2 - Step Up Database & Generate key And .env
!Type this command inside the directory of laravel project
* create a database via mysql you may use <b>XAMPP</b>
* generate the .env file by command
```properties
cp .env.example .env
```
* then generate the unique Key
```properties
php artisan key:generate
```
Then copy your current url laravel to .env just like the example
```env
APP_URL=http://127.0.0.1:8000
```
Then make a shorcut for the storage just type in your cmd
```properties
php artisan storage:link
```

* now we after we install the laravel, you need to create the database and migrate it.
 simply just create a database named in <strong>praxxy_examination_app</stong> on your xampp or other virtual hosting

 on .env file you can edit the <strong>DB_Database</strong>
```env
DB_DATABASE=praxxy_examination_app
```
* then migrate by using this command
```properties
php artisan migrate
```
* !Note you need seed a Category 
```properties
php artisan db:seed CategorySeeder
```
* then after you do that if you want to generate a new record just type this
```properties
php artisan db:seed DatabaseSeeder
```
#### Step 3 - Running the Laravel Project
```properties
php artisan serve
```
then open a new cmd, at the same directory of my laravel project
```properties
npm run dev
```
Now you can visit to localhost like for example [PRAXXYS](https://127.0.0.1:8000/)
user: admin1
password: admin123

> Thank you for selecting me as a candidate for the entry-level Laravel developer position. I am truly grateful for this opportunity to showcase my Laravel skills and contribute to your esteemed organization. I am confident that my skills in Laravel, even at an entry-level, are well-qualified for the position. Once again, I express my heartfelt gratitude for considering me for this role, and I am excited about the potential to grow and succeed together. 🙂

