set names utf8;

drop table if exists g_points;

create table g_points(
	point_id integer auto_increment primary key,
	point_n decimal(9,6) not null,
	point_e decimal(9,6) not null,
	point_name varchar(255)
);
alter table g_points add constraint unique_1 unique(point_n, point_e);