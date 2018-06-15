# build images

docker build -t res/apache-php-image .

docker build -t res/apache-reverse-proxy .

docker build -t res/express-image .

# Run images static and dynamic

docker run -d --name apache_static1 res/apache-php-image

docker run -d --name apache_static2 res/apache-php-image

docker run -d --name dynamic1 res/express-image

docker run -d --name dynamic2 res/express-image

# Run proxy

docker inspect apache_static1 | grep IPAddr 

docker inspect apache_static2 | grep IPAddr 

docker inspect dynamic1 | grep IPAddr 

docker inspect dynamic2 | grep IPAddr 

docker run -d -e STATIC_APP1=[172.17.0.2:80](http://172.17.0.2:80) -e STATIC_APP2=[172.17.0.3:80](http://172.17.0.3:80) -e DYNAMIC_APP1=[172.17.0.4:3000](http://172.17.0.4:3000) -e DYNAMIC_APP2=[172.17.0.5:3000](http://172.17.0.5:3000) -p 8080:80 res/apache-reverse-proxy 



# Management ui

docker run -d -p 9000:9000 -v "/var/run/docker.sock:/var/run/docker.sock" portainer/portainer 