# ADR Blog example

1. [Introduction](#introduction)
2. [Installation](#installation)
3. [Structure](#structure)
4. [Extend the project](#extend)

<a name="introduction"></a>
## Introduction
The next project is a code example for a Blog project based on Action-Domain-Responder and Symfony 4.

<a name="installation"></a>
## Installation

In order to get the project working:

1. Clone the repository
2. Execute `composer install`
3. Configure the database access in your `.env` file
4. Create the database: `bin/console doctrine:database:create`
5. Run Migrations: `bin/console doctrine:migration:migrate`
6. You can import the Postman Collection file on `postman/ADR-Blog.postman_collection.json`

<a name="structure"></a>
## 3. Structure

The project has the next structure:

```
src
|__  Action
|  |__  Author
|  |__  Post
|
|__  Domain
|  |__  Entity
|  |__  Module
|  |  |__  Author
|  |  |  |__  Application
|  |  |  |  |__  CreateAuthor
|  |  |  |  |__  DeleteAuthor
|  |  |  |  |__  GetAuthor
|  |  |  |  |__  GetAuthors
|  |  |  |  
|  |  |  |__  Domain
|  |  |  |__  Infratructure
|  |  | 
|  |  |__  Post
|  |     |__  Application
|  |     |  |__  CreatePost
|  |     |  |__  DeletePost
|  |     |  |__  GetPost
|  |     |  |__  GetPost
|  |     |  
|  |     |__  Domain
|  |     |__  Infratructure
|  |
|  |__  Shared
|     |__  Http
|     |__  Uuid
|
|__  Migrations
|__  Responder

```

### 3.1. Actions
Here we have the _endpoints_ which allow us to perform some actions in the blog, like: 

* List posts paginated
* Get a single post
* Delete a post
* Create a new post

### 3.2. Domain
In this directory we can found the two modules that the application is composed. Each module has exactly 3 folders:

* **Application:** Contains all the use cases
* **Domain:** Contains all the the interfaces needed to allow the talk between application and infrastructure
* **Infrastructure:** Contains all the concrete implementations of the domain contracts

Here we can als found two more directories:

* **Entities:** Where we store our _models_
* **Shared:** Where we store interfaces and classes of shared use, like exceptions or checkers.

### 3.3. Responder
Last but not least important, in the responder folder we can found all the classes that handle the responses.
 
<a name="extend"></a>
## 4. Extend the project
If you want to play with the code and add your self actions, it's very easy! Take for example the case you want
add an **edit author** action:

You just need to:

1. Create your action (in the `Action\Author` folder)
2. Create your use case (in the `Domain\Module\Author\Application\EditAuthor`)
3. Think if you need an _ad-hoc_ responder or you can use an existent (for this case, the `ResourceResponder` will do the job)
4. Register the route for your action in `config/routes/author.yml`

That's all!
