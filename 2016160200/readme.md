# 中间件实现技术课堂报告 #
# 基于主流中间件技术框架的B/S应用开发 #
# 1.背景介绍 #
   随着开源软件的蓬勃发展，传统的从前端到后台的完全自主开发的模式已经不复存在，就架构师而言，集成高效稳定的中间件成为了必备技能。在java开源社区，spring开发框架成为了IOC和AOP的事实标准，基于spring基础框架演化的快速开发框架也推动了开源社区的蓬勃发展。


   本项目基于Spring-Boot技术框架，融合了其它当前主流的开源中间件框架，实现了一个基本Restful风格的的B/S小应用。主要的技术包括了：

- 基础框架：Spring Boot
- 前端展现层：BootStrap
- 控制层：Spring-WEB
- 服务层：Spring
- DAO层：MyBatis
- DB层：ORACLE数据库
- SCM:MAVEN
			
# 2.主要中间件简介 #
## 2.1.Spring Boot ##
   Spring Boot是由Pivotal团队提供的全新框架，其设计目的是用来简化新Spring应用的初始搭建以及开发过程。该框架使用了特定的方式来进行配置，从而使开发人员不再需要定义样板化的配置。通过这种方式，Spring Boot致力于在蓬勃发展的快速应用开发领域（rapid application development）成为领导者。
## 2.2.BootStrap ##
 它由Twitter的设计师Mark Otto和Jacob Thornton合作开发，是一个CSS/HTML框架。Bootstrap提供了优雅的HTML和CSS规范，它即是由动态CSS语言Less写成,使Web开发更加快捷。
## 2.3.spring-web ##
Spring Web MVC是一种基于Java的实现了Web MVC设计模式的请求驱动类型的轻量级Web框架，即使用了MVC架构模式的思想，将web层进行职责解耦，基于请求驱动指的就是使用请求-响应模型，框架的目的就是帮助我们简化开发，Spring Web MVC也大大简化了我们日常的Web开发。
## 2.4.spring ##
Spring是一个分层的JavaSE/EE full-stack(一站式) 轻量级开源框架。从大小与开销两方面而言Spring都是轻量的。完整的Spring框架可以在一个大小只有1MB多的JAR文件里发布。并且Spring所需的处理开销也是微不足道的。Spring通过一种称作控制反转（IoC）的技术促进了低耦合,通过一种面向切面编程的技术（AOP）实现了内聚性的开发。
## 2.5.MyBatis ##
MyBatis 支持普通SQL查询，存储过程和高级映射的优秀持久层框架。MyBatis 消除了几乎所有的JDBC代码和参数的手工设置以及结果集的检索。MyBatis 使用简单的 XML或注解用于配置和原始映射，将接口和 Java 的POJOs（Plain Old Java Objects，普通的 Java对象）映射成数据库中的记录。
## 2.6.ORACLE数据库 ##
ORACLE数据库是世界主流的商业数据库产品。
## 2.7.MAVEN ##
Maven是一个项目管理工具，它包含了一个项目对象模型 (Project Object Model)，一个项目生命周期(Project Lifecycle)，一个依赖管理系统(Dependency Management System)，和用来运行定义在生命周期阶段(phase)中插件(plugin)目标(goal)的逻辑。
# 3.项目功能 #
本项目创建了一张部门表，包括部门ID、部门名称、部门简称三个字段，用户可以通过浏览器访问服务器，实现部门信息的CRUD功能。

## 3.1.新建部门信息 ##
在默认首页面上点击**新增**按钮，系统弹出录入页面，在页面中输入：部门编号、部门名称、部门简称等信息，点击保存按钮，保存成功。
![新建](http://i.imgur.com/JdmiLNN.png)

## 3.2.修改部门信息 ##
在默认首页面上，先选中列表中的某行数据，然后点击**修改**按钮，系统弹出修改页面，在页面中可以任意修改：部门编号、部门名称、部门简称等信息，点击**提交更改**后，保存成功。
![修改操作](http://i.imgur.com/028KqEn.png)

## 3.3.删除部门##
在默认首页面上，先选中列表中的某行数据，然后点击**删除**按钮，系统将删除对应的部门信息。
![删除操作](http://i.imgur.com/CQkUxQ5.png)

## 3.4.查询部门##
在默认首页面上，输入部门编号查询条件，点击**查询**按钮，可以查询对应的部门信息。
![查询操作](http://i.imgur.com/OHuULhm.png)

# 4.主要代码说明#
## 4.1.index.jsp ##
   文件路径为：src\main\webapp\WEB-INF\jsp\index.jsp

	<body>
		<!--控制窗体，包含增加、修改、删除、查询等按钮-->
		<form role="form" action="/findDept"  method="post">
		......	
		</form>
		<!--部门编号、部门名称、部门简称列表信息显示的table-->
		<table class="table table-condensed" id="table">
		......
		</table>
		<!--弹出修改子窗口的div-->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		......
		</div>
		<!--弹出新增子窗口的div-->
		<div class="modal fade" id="myModalInsert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		......
		</div	
	</body>
## 4.2.DeptController.java ##
   文件路径为：src\main\java\com\jackie\controller\DeptController.java

	@Controller  //注解标示为控制层
	public class DeptController {
		public static final String INDEX = "index";
		
		@Autowired  //自动注入服务层对象
		private DeptService service;
		
		@RequestMapping("/")  //注解定义URL导航地址
		public String index(){
			return INDEX;
		}
		
		@RequestMapping(value = "/findDept")  //注解定义URL导航地址
		public String findDept(String deptNo,Model model){
			List<Dept> deptList= service.findByDeptNo(deptNo);
			model.addAttribute("deptList", deptList);
			return INDEX;
		}
		......
## 4.3.DeptService.java ##
   文件路径为：src\main\java\com\jackie\service\DeptService.java

	@Service   //注解标记服务层
	public class DeptServiceImpl implements DeptService{
	
	@Autowired  //注解自动注入DAO层对象
	private DeptMapper deptMapper; 
	
	@Override
	public List<Dept> findAllDept() {
		//调用DAO层方法，查找部门信息
		return deptMapper.findAllDept();
	}
	......
## 4.4.DeptMapper.java ##
   文件路径为：src\main\java\com\jackie\annotationMapper\DeptMapper.java

	@Mapper  //注解标记为MaBtis SQL映射文件
	public interface DeptMapper {
		
		//在注解中配置SQL语句			
		@Select("select * from dept t ")
		public List<Dept> findAllDept();

		//在注解中配置SQL语句，也可以通过外部类构造更为复杂的SQL语句
		@SelectProvider(type=GetSql.class,method="findDept")
		public List<Dept> findByDeptNo(String deptNo);
		
		@Insert("insert into dept (deptNo, dName, LOC) values (#{deptNo}, #{dName}, #{loc})")
		public int insertDeptNo(Dept dept);
		......		
	}

## 4.5.SpringBootTestApplication.java ##
   文件路径为：src\main\java\com\jackie\SpringBootTestApplication.java
   在Spring Boot框架下，不需要web.xml文件，而是通过整合web插件(比如jetty插件、tomcat插件等),通过run Java Application的方式启动web服务。
	
	@RestController  //标记Restful更个的web服务， 配置需要扫描的包路径
	@SpringBootApplication(scanBasePackages={"com.jackie"})
	public class SpringBootTestApplication{
		
		public static void main(String[] args) {
			SpringApplication.run(SpringBootTestApplication.class, args);
		}
	}


## 4.6.Dept.java ##
   文件路径为：src\main\java\com\jackie\pojo\Dept.java
	
	//POJO对象,本例中没有拆分:vo bo po 等值对象
	public class Dept {
		
		private String deptNo;
		
		private String dName;
		
		private String loc;
		
		private String msg;
	
		public String getMsg() {
			return msg;
		}
		......

## 4.7.application.properties ##
   文件路径为：src\main\resources\application.properties

	debug=true
	#开启spring的aop
	spring.aop.auto=true
	
	spring.datasource.driver-class-name:oracle.jdbc.driver.OracleDriver
	spring.datasource.url:jdbc:oracle:thin:@localhost:1521:orcl
	spring.datasource.username:TESTDB
	spring.datasource.password:TESTDB
	
	#配置JSP
	#页面默认前缀目录
	spring.mvc.view.prefix=/WEB-INF/jsp/
	#相应页面默认后缀
	spring.mvc.view.suffix=.jsp
	
	server.port=8080

# 5.总结 #
   以上为中间件课程的课堂报告，报告中用到了很多课堂中学到的知识，包括java、JSP、servlet、Jquery、JDBC等中间件，而且还熟悉了github、markdown等知识，在此表示感谢！

# 附录1：工程目录树 #
	project
	│  pom.xml
	├─.mvn
	│  └─wrapper
	│          maven-wrapper.jar
	│          maven-wrapper.properties
	├─.settings
	│      org.eclipse.core.resources.prefs
	│      org.eclipse.jdt.core.prefs
	│      org.eclipse.m2e.core.prefs
	└─src
	    ├─main
	    │  ├─java
	    │  │  └─com
	    │  │      └─jackie
	    │  │          │  SpringBootTestApplication.java
	    │  │          ├─annotationMapper
	    │  │          │      DeptMapper.java
	    │  │          ├─controller
	    │  │          │      DeptController.java
	    │  │          ├─pojo
	    │  │          │      Dept.java
	    │  │          ├─service
	    │  │          │      DeptService.java
	    │  │          ├─serviceImpl
	    │  │          │      DeptServiceImpl.java
	    │  │          └─sql
	    │  │                  GetSql.java
	    │  ├─resources
	    │  │  │  application.properties
	    │  │  │  create_table.sql
	    │  │  └─static
	    │  │      ├─css
	    │  │      │      bootstrap-theme.css
	    │  │      │      bootstrap-theme.css.map
	    │  │      │      bootstrap-theme.min.css
	    │  │      │      bootstrap.css
	    │  │      │      bootstrap.css.map
	    │  │      │      bootstrap.min.css
	    │  │      ├─fonts
	    │  │      │      glyphicons-halflings-regular.eot
	    │  │      │      glyphicons-halflings-regular.svg
	    │  │      │      glyphicons-halflings-regular.ttf
	    │  │      │      glyphicons-halflings-regular.woff
	    │  │      └─js
	    │  │              bootstrap.js
	    │  │              bootstrap.min.js
	    │  │              jquery-3.1.1.min.js
	    │  │              npm.js
	    │  └─webapp
	    │      └─WEB-INF
	    │          └─jsp
	    │                  index.jsp
	    └─test
	        └─java
	            └─com
	                └─example
	                        SpringBootTestApplicationTests.java
