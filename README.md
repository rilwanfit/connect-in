# ConnectIn
social networking application using CQRS-ES with a help of broadway framework.

## A bit of context
Let’s assume we are a startup that wants to build a social network application to manage
people’s connections in a high traffic scenario (millions of unique visitors per month).
Yes... We are ambitious! ;-)
People connect in groups to meet regularly. The website has registered users and the
goal of the application is to create connections within the users and facilitate them to
organize meetings within their groups. The users can be logging in with their
linkedin/facebook/local account.
Let’s also assume that a user can RSVP on a meeting of a group and that all users can
access a (near-real) time report on a group and meeting popularity.
We know it may seem familiar...but fear not! We will not be asking you to implement the
whole meetup.com ;-)
It is just to give you context, perhaps inspire you regarding domain model and help us
describe the exercise in hand...

## Tech stack
- Broadway 1.0
- Symfony 2.8
- phpunit
- elastic search
- sqlite
- git
- docker

## Installation

### Docker Compose

```sh
docker-compose up -d

docker-compose exec app /bin/bash
app/console broadway:event-store:schema:init
```
us
Docker-compose will set up the containers needed to run this app.

To make sure the app running properly
```sh
curl -i localhost:8100
```

The app will be available at http://localhost:8100 as configured in `docker-compose.yml`.

## Running the unit test
```sh
docker-compose exec app /bin/bash
vendor/bin/phpunit
```

## Running the demo

This app doesn't have a GUI, only an API with the following endpoints:

| Method | Path | Description | Action |
|--------|------|-------------| ------- |
| POST | `/user` | Create a new user, name should be given as form fields) and returns the userId | ```curl -X -F 'name=$name' POST localhost:8100/user ``` |
| GET | `/users` | Retrieve registered users  | ``` curl localhost:8100/users ```
| POST | `/user/addFriend` | Add a friend to a user (userId and friendId should be given as form fields) and returns the userId| ``` curl -X POST localhost:8100/user/addFriend ``` |
| GET | `/user/{userId}/friends` | Retrieve list of friends for a user  | ``` curl localhost:8100/user/$userId/friends ```

### Elasticsearch web ui

You can access the elasticsearch; 
main index `broadway_demo.people_that_bought_this_product`

http://localhost:9200/_plugin/head/

delete an index
```sh
curl -XDELETE localhost:9200/connect_in.registered_user
```

## Code structure

- Domain code can be found in `src/ConnectIn/`
- ReadModel code can be found in `src/ConnectIn/ReadModel`
- Controller / services can be found in `src/ConnectInBundle`

### Note:
Events table with some example data is added with this repository.
1. to see list of users: http://localhost:8100/users
2. to see user's connections: http://localhost:8100/user/5cdafda7-386b-47eb-a313-d67f1a664580/friends



For more information, rilwanfit@gmail.com