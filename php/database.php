<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/10/1
 * Time: 11:45
 */
$servername="localhost";
$username="root";
$password="";
$conn=new mysqli($servername,$username,$password);
if($conn->connect_error)
{
    die("连接失败:".$conn->connect_error);
}
else{
    echo "连接成功<br/>";
}

$sql="create database csutdqgzxzx";

if($conn->query($sql)===true){
    echo "数据库创建成功<br/>";
}
$dbname="csutdqgzxzx";
$conn=new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error)
{
    die("连接失败:".$conn->connect_error);

}

$sta="create table staff          /*中心工作人员信息表*/
(
id_staff INT (4) NOT NULL,
id_card CHAR(20) PRIMARY KEY ,
account CHAR(10) UNIQUE ,
name CHAR (20) NOT NULL ,
sex CHAR (2),
birthday DATE ,
picture VARCHAR(50) NOT NULL,
e_mail CHAR (20) UNIQUE ,
phone char(11) UNIQUE ,
hometown CHAR(40) NOT NULL,
institution CHAR(40) NOT NULL,
class char(20) NOT NULL,
dormitory char(20) NOT NULL ,
resume VARCHAR (800) NOT NULL
)";
if($conn->query($sta)===true){
    echo "中心工作人员信息表创建成功<br/>";
}
else
{
    echo "中心工作人员信息表创建失败<br/>";
}
$dep="create table department         /*中心部门信息表*/
(
id_department INT(4) PRIMARY KEY ,
name CHAR(20) UNIQUE ,
description VARCHAR (100),
numebr INT (4),
dep_header CHAR (20)
)";
if($conn->query($dep)===true){
    echo "中心部门信息表创建成功<br/>";
}
else
{
    echo "中心部门信息表创建失败<br/>";
}
$dep_sta="create table dep_sta  /*部门_人员信息表*/
(
id_department INT (4),
id_card CHAR (20),
PRIMARY KEY (id_department,id_card),
FOREIGN KEY (id_department) REFERENCES department(id_department),
FOREIGN KEY (id_card) REFERENCES staff(id_card)
)";
if($conn->query($dep_sta)===true){
    echo "部门_人员信息表创建成功<br/>";
}
else
{
    echo "部门_人员信息表创建失败<br/>";
}
$ad="create table admin            /*建立管理员信息表格*/
(
   id_admin int(4) primary key,
   account char(20) UNIQUE,
   password char(20) not null
)";
if($conn->query($ad)===true){
    echo "管理员信息表创建成功<br/>";
}
else
{
    echo "管理员信息表创建失败<br/>";
}

$stu="create table student_info       /*建立学生信息表格*/
(
    id_student int(4) PRIMARY KEY,
    name char(10),
    stusex char(2),
    card_id char(15) UNIQUE ,
    e_mail char(20) UNIQUE ,
    phone char(11) UNIQUE,
    home char(40),
    institution char(40),
    class char(40),
    dormitory char(20),
    subjects char(40),
    experience char(2),
    resume VARCHAR(800),
    status char(6),
    dealer char(20)
)";
if($conn->query($stu)===true){
    echo "学生信息表创建成功<br/>";
}
else
{
    echo "学生信息表创建失败<br/>";
}
$fra="create table fraulein_info       /*建立家教信息表格*/
(
    id_parent int(4) primary key,
    name char(10),
    phone char(11) UNIQUE,
    e_mail char(20) UNIQUE,
    is_school_staff char(2),
    stu_sex char(4),
    stu_grade char(15),
    subjects char(40),
    time char(30),
    location VARCHAR(100),
    pay_range char(20),
    tutor_sex char(2),
    enquirements VARCHAR(400),
    interview char(2),
    apply_date date,
    status char(6),
    dealer char(20)
)";
if($conn->query($fra)===true){
    echo "家教信息表创建成功<br/>";
}
else
{
    echo "家教信息表创建失败<br/>";
}


$fra_apply="create table fraulein_apply      /*建立家教报名表格*/
(
    id_parent int(4),
    id_student int(4),
    status char(7),
    sig_date date,
    primary key(id_parent,id_student),
    foreign key (id_parent) references fraulein_info(id_parent),
    foreign key (id_student) references student_info(id_student)
)";
if($conn->query($fra_apply)===true){
    echo "家教报名信息表创建成功<br/>";
}
else
{
    echo "家教报名信息表创建失败<br/>";
}

$fra_cost="create table fraulein_cost        /*建立家教费用表格*/
(
    id_parent int(4),
    id_student int(4),
    fee int(4),
    fee_dealer char(20),
    fee_date date,
    refund int(4),
    refund_staff char(20),
    refund_date date,
    remark varchar(100),
    primary key(id_parent,id_student),
    foreign key (id_parent) references fraulein_info(id_parent),
    foreign key (id_student) references student_info(id_student)
)";
if($conn->query($fra_cost)===true){
    echo "家教费用表创建成功<br/>";
}
else
{
    echo "家教费用表创建失败<br/>";
}

$company="create table company        /*企业信息表格*/
(
  id_parttime INT (4) PRIMARY KEY ,
  name CHAR (20),
  phone CHAR (11) UNIQUE,
  e_mail CHAR (20) UNIQUE ,
  job_content CHAR (100),
  job_time CHAR (40),
  job_place CHAR (50),
  pay_range CHAR (20),
  stunum INT (4),
  equirements VARCHAR (400),
  apply_date DATE,
  status CHAR (6)
)";
if($conn->query($company)===true){
    echo "企业信息表创建成功<br/>";
}
else
{
    echo "企业信息表创建失败<br/>";
}
$job_apply="create table job_apply        /*兼职报名信息表格*/
(
 id_parttime INT (4),
 id_student INT (4),
 status CHAR (9),
 sig_date DATE,
 PRIMARY KEY (id_parttime,id_student),
 FOREIGN KEY (id_parttime) REFERENCES company(id_parttime),
 FOREIGN KEY (id_student) REFERENCES student_info(id_student)
 )";
if($conn->query($job_apply)===true){
    echo "兼职报名信息表创建成功<br/>";
}
else
{
    echo "兼职报名信息表创建失败<br/>";
}
$job_charge= "create table job_charge        /*兼职收费信息表格*/
(
 id_parttime INT (4),
 id_student INT (4),
 fee_dealer CHAR (20),
 fee_date DATE ,
 refund INT (4),
 refund_staff CHAR (20),
 refund_date DATE ,
 remark VARCHAR(100),
 PRIMARY KEY (id_parttime,id_student),
 FOREIGN KEY (id_parttime) REFERENCES company(id_parttime),
 FOREIGN KEY (id_student) REFERENCES student_info(id_student)
 )";
if($conn->query($job_charge)===true){
    echo "兼职收费信息表创建成功<br/>";
}
else
{
    echo "兼职收费信息表创建失败<br/>";
}
$not="create table notice      /*建立通知公告信息表格*/
(
   id_notice int(4) primary key,
   src VARCHAR (50),
   title varchar(50),
   content mediumtext,
   cover VARCHAR (50),
   image VARCHAR (50),
   publisher char(30),
   editor char(20),
   is_time date,
   readnum int(4)
)";
if($conn->query($not)===true){
    echo "建立通知公告信息表创建成功<br/>";
}
else
{
    echo "建立通知公告信息表创建失败<br/>";
}
$link="create table link              /*建立链接信息表格*/
(
    id_link int(4) primary key,
    url VARCHAR(50) UNIQUE,
    name char(20),
    clicktime int(4)
)";
if($conn->query($link)===true){
    echo "建立链接信息表创建成功<br/>";
}
else
{
    echo "建立链接信息表创建失败<br/>";
}
$com="create table commonfile        /*建立常用文件信息表格*/
(
    id_file int(4) primary key,
    name varchar(50),
    src varchar(50),
    dload_time int(4)
)";
if($conn->query($com)===true){
    echo "常用文件信息表创建成功<br/>";
}
else
{
    echo "常用文件信息表创建失败<br/>";
}


$used="create table unused        /*建立闲置物品信息表格*/
(
    id_unused INT (4) PRIMARY KEY,
    id_owner INT(4),
    type CHAR (2),
    item CHAR (20),
    img VARCHAR (50),
    description VARCHAR (400),
    date DATE ,
    publisher CHAR(20),
    status CHAR(6)
)";
if($conn->query($used)===true){
    echo "闲置物品信息表创建成功<br/>";
}
else
{
    echo "闲置物品信息表创建失败<br/>";
}

$owner="create table owner        /*建立闲置物品用户信息表格*/
(
    id_owner INT (4) PRIMARY KEY,
    name CHAR (2),
    phone CHAR(11) UNIQUE,
    id_type CHAR(4),
    card_id CHAR(4) UNIQUE,
    e_mail CHAR(20) UNIQUE,
    status CHAR(6)
)";
if($conn->query($used)===true){
    echo "闲置物品信息用户表创建成功<br/>";
}
else
{
    echo "闲置物品信息用户表创建失败<br/>";
}

/*失物信息表格*/
$lose="create table lost(
  id_lost INT (4) PRIMARY KEY ,
  type CHAR (4),
  item CHAR (20),
  img VARCHAR (50),
  description VARCHAR (400),
  place CHAR (50),
  data DATE ,
  contact CHAR (20),
  phone CHAR (11),
  publisher CHAR (20),
  status CHAR (6)
)";
if($conn->query($lose)===true){
    echo "失物信息表创建成功<br/>";
}
else
{
    echo "失物信息表创建失败<br/>";
}
$conn->close();
