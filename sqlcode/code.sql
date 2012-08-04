----- 创建数据库 -----

if db_id('student_info') is not null drop database student_info
go

create database student_info
on primary (
NAME=student_info_Data
,FILENAME='D:\www\DB\student_info_Data.MDF'
,SIZE=1MB
,MAXSIZE=UNLIMITED
,FILEGROWTH=1MB
)
log on (
NAME=student_info_Log
,FILENAME='D:\www\DB\student_info_Log.LDF'
,SIZE=1MB
,MAXSIZE=UNLIMITED
,FILEGROWTH=1MB
)

----- 创建数据表 -----

use student_info
go

create table student (
  sno char(9) primary key,
  sname varchar(20) not null,
  ssex char(2) not null,
  sbirth smalldatetime not null,
  sclass char(7) not null,
  stel varchar(20),
  sentertag smalldatetime not null,
  saddr varchar(50),
  scmt varchar(50),

  check(sno like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]'),
  check(sclass like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9]'),
  check(ssex='男' or ssex='女' or ssex='--'),
  check(sbirth<getdate())
);

create table course (
  cno smallint primary key,
  cname varchar(30) not null,
  ctype varchar(20) not null,
  credit tinyint not null,
  cdscrpt varchar(50),
  check (credit>0)
);

create table grade (
  sno char(9) not null,
  cno smallint not null,
  score tinyint not null,

  primary key (sno, cno),
  foreign key(sno) references student(sno),
  foreign key(cno) references course(cno),
  check (score between 0 and 100)
);

----- 创建成绩相关的存储过程 -----
----- 判断存储过程是否存在参考：http://www.sqlservercurry.com/2010/07/check-if-stored-procedure-exists-else.html -----

if objectproperty(object_id('dbo.findscore'), N'IsProcedure') = 1
drop proc findscore
go

if objectproperty(object_id('dbo.addscore'), N'IsProcedure') = 1
drop proc addscore
go

if objectproperty(object_id('dbo.updatescore'), N'IsProcedure') = 1
drop proc updatescore
go

if objectproperty(object_id('dbo.deletescore'), N'IsProcedure') = 1
drop proc deletescore
go

create proc findscore
@sno char(9) = '',
@sclass char(7) = '',
@cno smallint = 0,
@cname varchar(30) = '',
@pass tinyint = 0,
@sql varchar(500) = 'select grade.sno, student.sclass, student.sname, grade.cno, course.cname, grade.score from student, course, grade where student.sno = grade.sno and course.cno = grade.cno'
as
  if (@sno is not null and @sno like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]')
    begin
      set @sql = @sql + ' and grade.sno = ''' + @sno + ''''
    end
  else if (@sclass is not null and @sclass like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9]')
    begin
      set @sql = @sql + ' and student.sclass = ''' + @sclass + ''''
    end

  if (@cno is not null and @cno!=0)
    begin
      set @sql = @sql + ' and grade.cno = ' + convert(varchar(8), @cno)
    end

  if (@cname is not null and @cname!='')
    begin
      set @sql = @sql + ' and course.cname like ''%' + @cname + '%'''
    end

  if (@pass is not null and @pass=1)
    begin
      set @sql = @sql + ' and grade.score<60'
    end

  set @sql = @sql + ' order by student.sclass, student.sno, grade.cno'

  exec(@sql)
go

create proc addscore
@sno char(9),
@cno smallint,
@score tinyint
as
insert into grade(sno, cno, score)
values (@sno, @cno, @score)
go

create proc updatescore
@sno char(9),
@cno smallint,
@score tinyint
as
update grade
set score = @score
where sno = @sno and cno = @cno
go

create proc deletescore
@sno char(9),
@cno smallint
as
delete from grade
where sno = @sno and cno = @cno
go

----- 创建学生信息相关的存储过程 -----

if objectproperty(object_id('dbo.addstudent'), N'IsProcedure') = 1
drop proc addstudent
go

if objectproperty(object_id('dbo.updatestudent'), N'IsProcedure') = 1
drop proc updatestudent
go

if objectproperty(object_id('dbo.deletestudent'), N'IsProcedure') = 1
drop proc deletestudent
go

if objectproperty(object_id('dbo.findstudent'), N'IsProcedure') = 1
drop proc findstudent
go

create proc addstudent
@sno char(9),
@sname varchar(20),
@ssex char(2),
@sbirth smalldatetime,
@sclass char(7),
@stel varchar(20),
@sentertag smalldatetime,
@saddr varchar(50),
@scmt varchar(50)
as
insert into student(sno, sname, ssex, sbirth, sclass, stel, sentertag, saddr, scmt)
values(@sno, @sname, @ssex, @sbirth, @sclass, @stel, @sentertag, @saddr, @scmt)
go

create proc deletestudent
@sno char(9)
as
delete from grade where sno = @sno
delete from student where sno = @sno
go

create proc updatestudent
@oldsno char(9),
@sno char(9),
@sname varchar(20),
@ssex char(2),
@sbirth smalldatetime,
@sclass char(7),
@stel varchar(20),
@sentertag smalldatetime,
@saddr varchar(50),
@scmt varchar(50)
as
update student set sname = @sname where sno = @oldsno
update student set ssex = @ssex where sno = @oldsno
update student set sbirth = @sbirth where sno = @oldsno
update student set sclass = @sclass where sno = @oldsno
update student set stel = @stel where sno = @oldsno
update student set sentertag = @sentertag where sno = @oldsno
update student set saddr = @saddr where sno = @oldsno
update student set scmt = @scmt where sno = @oldsno
update student set sno = @sno where sno = @oldsno
go

create proc findstudent
@sno char(9) = '',
@sname varchar(20) = '',
@ssex char(2) = '',
@sbirth smalldatetime = '',
@sclass char(7) = '',
@stel varchar(20) = '',
@sentertag smalldatetime = '',
@saddr varchar(50) = '',
@scmt varchar(50) = '',
@sql varchar(500) = 'select * from student',
@case tinyint = 0

as

if ((@sno is not null and @sno!='         ') or (@sname is not null and @sname!='') or (@ssex is not null and @ssex!='  ') or (@sbirth is not null and @sbirth!='') or (@sclass is not null and @sclass!='       ') or (@stel is not null and @stel!='') or (@sentertag is not null and @sentertag!='') or (@saddr is not null and @saddr!='') or (@scmt is not null and @scmt!=''))
  begin

    set @sql = @sql + ' where'

    if (@sno is not null and @sno like '[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]')
      begin
        set @sql = @sql + ' sno = ''' +@sno + ''''
      end
    else
      begin
        if (@sname is not null and @sname!='')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' sname like ''%' + @sname + '%'''
            set @case = 1
          end

        if (@ssex is not null and @ssex!='  ')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' ssex = ''' + @ssex + ''''
            set @case = 1
          end

        if (@sbirth is not null and @sbirth!='')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' sbirth = ''' + convert(varchar(10), @sbirth, 120) + ''''
            set @case = 1
          end

        if (@sclass is not null and @sclass!='       ')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' sclass like ''%' + @sclass + '%'''
            set @case = 1
          end

        if (@stel is not null and @stel!='')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' stel like ''%' + @stel + '%'''
            set @case = 1
          end

        if (@sentertag is not null and @sentertag!='')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' sentertag = ''' + convert(varchar(10), @sentertag, 120) + ''''
            set @case = 1
          end

        if (@saddr is not null and @saddr!='')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' saddr like ''%' + @saddr + '%'''
            set @case = 1
          end

        if (@scmt is not null and @scmt!='')
          begin
            if (@case = 1)
              begin
                set @sql = @sql + ' and'
              end
            set @sql = @sql + ' scmt like ''%' + @scmt + '%'''
            set @case = 1
          end
    end

    set @sql = @sql + ' order by student.sno'

  end

  exec(@sql)
go

----- 创建课程相关的存储过程 -----

if objectproperty(object_id('dbo.addcourse'), N'IsProcedure') = 1
drop proc addcourse
go

if objectproperty(object_id('dbo.updatecourse'), N'IsProcedure') = 1
drop proc updatecourse
go

if objectproperty(object_id('dbo.deletecourse'), N'IsProcedure') = 1
drop proc deletecourse
go

create proc addcourse
@cno smallint,
@cname varchar(30),
@ctype varchar(20),
@credit tinyint,
@cdscrpt varchar(50)
as
insert into course(cno, cname, ctype, credit, cdscrpt)
values (@cno, @cname, @ctype, @credit, @cdscrpt)
go

create proc updatecourse
@oldcno smallint,
@cno smallint,
@cname varchar(30),
@ctype varchar(20),
@credit tinyint,
@cdscrpt varchar(50)
as
update course set cno = @cno where cno = @oldcno
update course set cname = @cname where cno = @oldcno
update course set ctype = @ctype where cno = @oldcno
update course set credit = @credit where cno = @oldcno
update course set cdscrpt = @cdscrpt where cno = @oldcno
go


create proc deletecourse
@cno smallint
as
delete from grade where cno = @cno
delete from course where cno = @cno
go

