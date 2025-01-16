create database assighment;
create table student(
    id int primary key,
    s_name varchar(20),
    score decimal(3,1)
);

create table student_course(
    c_id varchar(2),
    s_id INT,
    
     FOREIGN KEY(s_id) REFERENCES student(id));

insert into student (id, s_name,score) values(1,'samiksha',78),(2,'purnika',80),(3,'bishal',90),(4,'kabin',10);
insert into student_course(c_id,s_id) values('c1',1),('c2',2),('c3',4),('c4',3);
insert into student_course(c_id,s_id) values('c1',4);

SELECT s_name from student where score>any(select score from student_course where c_id='c1');

select *from student_course;