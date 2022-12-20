Run this docker image to create a xampp docker container. https://github.com/tomsik68/docker-xampp

fixed the log in issue. Commented out the parts that handled forgot password. There seemed to be two functioanlities for it. I propose we scrap it.

Creating category as an admin is bust. sql eror havent looked at yet.
We should probably get rid of subcategories.

We do not need the add state functionality in admin side we should just have the defaukt states. It is also bugged up

We should also probably kill user log in log. The queries that "perform" this action are bugging up the place

couldnt spot any sub admins stuff.

