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
| POST | `/group` | Create a new group, returns the groupId | ```curl -X POST localhost:8100/group ``` |
| POST | `/group/{groupId}/addUser` | Add a user to a group (name should be given as form fields) and returns the userId| ``` curl -X POST -F 'name=rilwan' localhost:8100/group/$groupId/addUser ``` |
| GET | `/groups` | Retrieve list of groups  | ``` curl localhost:8100/groups ```
| GET | `/group/{groupId}/users` | Retrieve list of users in a group  | ``` curl localhost:8100/group/$groupId/users ```
| POST | `/user/addFriend` | Add a friend to a user (userId and friendId should be given as form fields) and returns the userId| ``` curl -X POST -F 'name=rilwan' localhost:8100/user/addFriend ``` |

### Elasticsearch web ui

You can access the elasticsearch; 
main index `broadway_demo.people_that_bought_this_product`

http://localhost:9200/_plugin/head/

## Code structure

- Domain code can be found in `src/ConnectIn/`
- ReadModel code can be found in `src/ConnectIn/ReadModel`
- Controller / services can be found in `src/ConnectInBundle`


The domain specific tests can be found in `test/BroadwayDemo/Basket` and `test/BroadwayDemo/ReadModel`

Note that there is a functional test (using ElasticSearch) in `test/BroadwayDemoBundle/Functional`

For more information, rilwanfit@gmail.com