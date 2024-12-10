create database cement_sale;

use cement_sale;

create table cement(
        id tinyint unsigned not null auto_increment primary key,
        cement_name varchar(50) not null,
        description text,
        image varchar(255), 
        quantity smallint not null, 
        unit_price int not null,
)engine=innodb; 

create table standard(
        id smallint unsigned not null auto_increment primary key,
        cement_id tinyint unsigned not null,
        name varchar(25) not null, 
        quantity smallint not null, 
        unit_price int not null
)engine=innodb; 

alter table standard add constraint fk_description_cement foreign key(cement_id) references cement(id) on delete cascade on update cascade; 

create table sales(
        id smallint unsigned not null auto_increment primary key,
        cement_id tinyint unsigned not null,
        standard_id smallint unsigned,
        client_name varchar(100) not null,
        client_num varchar(20) not null,
        client_address varchar(200) not null,
        nbr_bags smallint not null,
        total_price int not null
        
)engine=innodb; 

alter table sales add constraint fk_sales_cement foreign key(cement_id) references cement(id) on delete cascade on update cascade; 

alter table sales add constraint fk_sales_standard foreign key(standard_id) references standard(id) on delete cascade on update cascade; 
