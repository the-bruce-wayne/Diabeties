/*
on delete set null / on delete no action / on delete cascade
*/

drop table if exists images;
create table images(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(30) not null,
	image blob null,
	url varchar(30) null,
	date_created datetime not null default CURRENT_TIMESTAMP,
	description varchar(150)
);

drop table if exists hospitals;
create table hospitals(
	id int(11) unsigned not null primary key auto_increment,
	hospital_name varchar(15) not null,
	address varchar(255) not null
);

drop table if exists recommendations;
create table recommendations(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(50) not null
);

drop table if exists scales;
create table scales(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(15) not null,
	value int(11) unsigned not null
);

drop table if exists proliferative_retinopathy;
create table proliferative_retinopathy(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(50) not null,
	description varchar(50) not null
);

drop table if exists associated_diagnoses;
create table associated_diagnoses(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(50) not null,
	description varchar(50) not null
);

drop table if exists poor_retinal_view;
create table poor_retinal_view(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(50) not null,
	description varchar(50) not null
);

drop table if exists optic_nerve;
create table optic_nerve(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(50) not null,
	description varchar(50) not null
);

drop table if exists clinics;
create table clinics(
	id int(11) unsigned not null primary key auto_increment,
	name varchar(15) not null,
	hospital_id int(11) unsigned not null,
	foreign key (hospital_id) references hospitals(id)
);

drop table if exists eyes;
create table eyes(
	id int(11) unsigned not null primary key auto_increment,
	dme int(11) unsigned null,
	non_proliferative_retinopathy int(11) unsigned null,
	proliferative_retinopathy int(11) unsigned null,
	associated_diagnoses int(11) unsigned null,
	poor_retinal_view int(11) unsigned null,
	optic_nerve int(11) unsigned null,
	no_dr text null,
	other text null,
	foreign key (dme) references scales(id),
	foreign key (proliferative_retinopathy) references proliferative_retinopathy(id),
	foreign key (non_proliferative_retinopathy) references scales(id),
	foreign key (associated_diagnoses) references associated_diagnoses(id),
	foreign key (poor_retinal_view) references poor_retinal_view(id),
	foreign key (optic_nerve) references optic_nerve(id)
);

drop table if exists results;
create table results(
	id int(11) unsigned not null primary key auto_increment,
	notes text null,
	right_eye_id int(11) unsigned not null,
	left_eye_id int(11) unsigned not null,
	diabeties enum('TRUE', 'FALSE') not null default 'FALSE',
	date_diabeties_diagnoesed date not null,
	foreign key (left_eye_id) references eyes(id) on delete cascade on update cascade,
	foreign key (right_eye_id) references eyes(id) on delete cascade on update cascade
);

drop table if exists patients;
create table patients(
	id int(11) unsigned not null primary key auto_increment,
	first_name varchar(20) not null,
	last_name varchar(20) not null,
	other_name varchar(20) null,
	sex enum('MALE', 'FEMALE') not null,
	national_id varchar(20) not null,
	phone_number varchar(15) not null,
	phone_number_cell varchar(15) null,
	email varchar(25) null,
	address varchar(255) null,
	date_of_birth date not null,
	smart_phone enum('TRUE', 'FALSE') not null default 'FALSE',
	created_by int(11) not null,
	date_created datetime not null default CURRENT_TIMESTAMP,
	notes varchar(255),
	hospital_id int(11) unsigned not null,
	clinic_number_id int(11) unsigned not null,
	foreign key (hospital_id) references hospitals(id),
	foreign key (clinic_number_id) references clinics(id),
	foreign key (created_by) references user(id) on delete cascade on update cascade
);

drop table if exists screenings;
create table screenings(
	id int(11) unsigned not null primary key auto_increment,
	date_created datetime not null default CURRENT_TIMESTAMP,
	created_by int(11) not null,
	waist float not null,
	vision varchar(30) null,
	result_id int(11) unsigned null,
	recommendation_id int(11) unsigned not null,
	notes varchar(255) null,
	foreign key (created_by) references user(id) on delete cascade on update cascade,
	foreign key (result_id) references results(id) on delete cascade on update cascade,
	foreign key (recommendation_id) references recommendations(id) on delete cascade on update cascade
);

drop table if exists patient_screenings;
create table patient_screenings(
	screening_id int(11) unsigned not null,
	patient_id int(11) unsigned not null,
	primary key(screening_id, patient_id),
	foreign key (screening_id) references screenings(id) on delete cascade on update cascade,
	foreign key (patient_id) references patients(id) on delete cascade on update cascade
);

drop table if exists screening_images;
create table screening_images(
	screening_id int(11) unsigned not null,
	image_id int(11) unsigned not null,
	primary key(screening_id, image_id),
	foreign key (screening_id) references screenings(id) on delete cascade on update cascade,
	foreign key (image_id) references images(id) on delete cascade on update cascade
);

/*hospitals*/
insert into hospitals (hospital_name, address)
	values ('hospital 1', 'address of first hospital');	
insert into hospitals (hospital_name, address)
	values ('hospital 2', 'address of second hospital');	

/*clinics*/
insert into clinics (name, hospital_id)
	values ('clinic 1', 1);
	
/*scale*/	
insert into scales (name, value)
	values ('none', 1);	
insert into scales (name, value)
	values ('mild', 2);	
insert into scales (name, value)
	values ('moderate', 3);	
insert into scales (name, value)
	values ('severe', 4);

/*recommendations*/
insert into recommendations(name)
	values('Routine repeat retinal photos in one year');
insert into recommendations(name)
	values('Urgent ophthalmic referral');
insert into recommendations(name)
	values('Non- urgent ophthalmic referral');
insert into recommendations(name)
	values('Repeat photos in six months');
insert into recommendations(name)
	values('Repeat photos next clinic');
insert into recommendations(name)
	values('Medical referral');
insert into recommendations(name)
	values('Metabolic referral ');
	