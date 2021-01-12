# Libricos.com

Bookstore based on Wordpress. It´s about books, reviews and recommendations.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
Give examples
```

### Installing

A step by step series of examples that tell you how to get a development env running

Say what the step will be

```
 cd c:/xammp/htdocs/jesuserro.com
 git lfs install
 git config 'lfs.locksverify' false
 git lfs track "*.zip" "*.gz" "*.wpress"
 git add .gitattributes
```

And repeat

```
git add file.zip
git commit -m "Add zip file"
git push origin master
```

At wp-config.php

```
define('PODS_SHORTCODE_ALLOW_SUB_SHORTCODES',true);
```

End with an example of getting some data out of the system or using it for a little demo

See:

* https://git-lfs.github.com/

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Wordpress](https://es.wordpress.org/download/) - The web framework used
* [Xampp](https://www.apachefriends.org/es/index.html) - Not a Dependency Management

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

### v0.0.1

* Wordpress 5.6.0
* Permalinks: 
  * Custom: category/postname
  * Category base: a dot
* Theme Twenty Eleven Child
* Plugins:
  * Updraftplus + backup files
  * All In One Wordpress Migration + backup file
  * Pods: Libros, Autores, Reviews, Géneros, Notas
* Menú principal: inicio & libros.

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Jesús Erro** - *Initial work* - [Jesuserro](https://github.com/jesuserro

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc

