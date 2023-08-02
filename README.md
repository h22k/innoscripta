# innoscripta
hello, this is the general documentatiton about innoscript. This project has been created by using React.js with TypeScript, and Laravel, and dockerized by using Docker. There is seperate README files for both the front-end and the back-end that explaines how both sides work, however with this README file I will touch on to more general information to explain how code works.

## running the project
actually it is pretty simple, all you have to do is typing this line of code to the terminal :

    docker compose up -d

after this line of code everything that is needed for the project  to run, including Laravel Horizon and Cronjob, will start.

In general, React.js with Typescript for front-end, Laravel for back-end, Laravel Horizon for queue tracking and monitoring, and Cronjob for job scheduling has been used in this project.