## 💼 &nbsp; About Pangaea_TH Project


This project is an implementation of an HTTP-based notification system. A server (or set of servers) will keep track of ```topics -> subscribers``` where a topic is a string and a subscriber is an HTTP endpoint.

When a message is published on a topic, it should be forwarded to all subscriber endpoints.

### 🛠 &nbsp; Installation

This project was built with the popular Laravel Framework.

Follow the steps below to have it running on your local system:
Steps:
- clone the repository ```git clone https://github.com/tengine8000/pangaea_th.git```
- Change directory into the project folder ```cd pangaea_th/```
- Run ```composer update``` to install al the required packages
- Setup your local ```MySQL``` database
- Add the database connection parameters to your ```.env``` file
- Run migrations ```php artisan migrate``` to create relevant tables
- Run ```php artisan key:generate``` to generate the secure application keys

If you encounter any problems installing the project or you want to learn more about installing Laravel, you can go to the [Laravel Installation Guide](https://laravel.com/docs/8.x/installation).

### ⚙️ &nbsp; Running and Testing

To get this project up and running, you need a minimum of 2 instances running on different ports and on different terminals.

The first terminal will be for the main ```Publishing server``` or **Publisher** and the second terminal will be the ```Subscribing server``` or **Subscriber**.

For this example run, we will use ```PORT 8000``` for the **Publisher** and ```PORT 9000``` for the **Subscriber**. If those ports are in use by your system, you can choose any ports above ```1024```.

#### **Steps**

- On the **Publisher**, run ```php artisan serve --port=8000``` to start it.
- On the **Subscriber**, run ```php artisan serve --port=9000``` to start it.
- To make API calls, you can use ```curl```, [Postman](https://www.postman.com/), or [REST Client plugin](https://github.com/Huachao/vscode-restclient) if you are using [VSCode](https://code.visualstudio.com/)<img src="https://raw.githubusercontent.com/ABSphreak/ABSphreak/master/gifs/Hi.gif" width="20px" />

##### **Using Curl**
- ```curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/test1"}' http://localhost:8000/subscribe/topic1 ```

- ```curl -X POST -H "Content-Type: application/json" -d '{ "url": "http://localhost:9000/test2"}' http://localhost:8000/subscribe/topic1```

- ```curl -X POST -H "Content-Type: application/json" -d '{"message": "hello"}' http://localhost:8000/publish/topic1```

##### **Using REST Client plugin**

This is a lot easier and more fun.

Go to the ```test.http``` file at the root of the project, and if you have the plugin installed, you will see the ```Send Request``` links above each of the sample request I created in the file for tests.

You can edit and click each of the requests to see the responses in the **Subscriber** terminal(s).

### Further Information

If you need to learn more about this project, feel free to contact me.

<p align="left">
<a href="https://www.tortyemmanuel.com/"><img alt="Website" src="https://img.shields.io/badge/Website-www.tortyemmanuel.com-blue?style=rounded-square&logo=google-chrome"></a>
<a href="https://www.linkedin.com/in/emmanuel-torty-60052153/"><img alt="LinkedIn" src="https://img.shields.io/badge/LinkedIn-Emmanuel%20Torty-blue?style=rounded-square&logo=linkedin"></a>
<a href="mailto:torty.emmanuel@gmail.com"><img alt="Email" src="https://img.shields.io/badge/Email-torty.emmanuel@gmail.com-blue?style=rounded-square&logo=gmail"></a>
</p>
