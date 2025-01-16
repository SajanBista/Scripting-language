-- modifying constraints ( foreign queue for foreign key)
create TABLE employee(
    Id int primary key,
    Name varchar(20),
    D_Id int );
create table Depart(
    D_ID int primary key,
    Name varchar(20) );
alter table employee add foreign key(D_Id) references Depart(D_ID);
select name from sys.foreign_keys where OBJECT_NAME(parent_object_id)='employee';
alter table employee drop CONSTRAINT FK__employee__D_Id__4F7CD00D;
