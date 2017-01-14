create table DEPT
(
  deptno NUMBER(20) not null,
  dname  VARCHAR2(100),
  loc    VARCHAR2(30)
);

alter table DEPT add constraint PK_DEPT primary key (DEPTNO)
