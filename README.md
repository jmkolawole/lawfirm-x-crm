## About this application
A Customer Relationship Management Application built in Laravel / Vue Js.


![Imgur](https://i.imgur.com/8mn3UgJ.png)

![Imgur](https://i.imgur.com/WlKkE7B.png)

## How to Set Up

1. Clone the Repository
Run ```git clone https://github.com/jmkolawole/lawfirm-x-crm.git```

2. cd into the project directory
Run ```cd lawfirm-x-crm```

3. Copy .env.example file and rename as .env
Alternatively, run ```cp .env.example .env```

4. Edit database and mail credentials in your newly generated .env file

5. Run ```composer install``` to install all libraries and dependencies in the composer.lock file

6. Run ```php artisan key:generate``` to set the APP_KEY value in the .env file

7. Having created a database, and specifying the same with the right credentials in your .env file, run ```php artisan migrate``` to create the tables

8. Run ```npm install``` to download all the dependencies defined in the package.json file

9. Run ```php artisan serve``` to run the PHP development server. Alternatively, you can run your project with XAMPP or WAMP.

10. Finally, run ```npm run dev``` to build and compile your Vue files





## Caveats
1. Please, set up a mail client to use the mail functionalities. You can use "Sendgrid", "mailtrap" or "gmail". If no mail client is set up, please comment this part ```Mail::to($this->client->email)->send(new \App\Mail\Client($this->client)); ``` in your ClientController to avoid your application malfunctioning. If no mail client is set up, you may not proceed to 2 below.

2. Run ```php schedule:run``` to run the ```send:reminder``` which sends prompting emails to clients without profile images every 3 days to submit one.

3. Not that we are initiating the command above to run the command locally (on localhost). On a live server, we need to make the laravel scheduler start by itself by adding a cron job which executes every minute.
So, on a live server, SSH into your server, cd into your project and run ```crontab -e```.
This will open the server Crontab file, past the code below into the file, save and then exit.
``` * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1```
Remember, path-to-your-project is the path to the Artisan command of your Laravel application 
