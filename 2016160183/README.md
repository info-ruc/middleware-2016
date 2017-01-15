# 中间件实现技术课堂报告 #
# 基于JAVA主流中间件技术框架的C/S应用开发 #
# 1.背景介绍 #
   随着开源软件的蓬勃发展，传统的从前端到后台的完全自主开发的模式已经不复存在，就架构师而言，集成高效稳定的中间件成为了必备技能。在java开源社区，spring开发框架成为了IOC和AOP的事实标准，基于spring基础框架演化的快速开发框架也推动了开源社区的蓬勃发展。


   本项目基于Spring技术框架，融合了其它当前主流的开源中间件框架，实现了一个基本Restful风格的的C/S小应用。主要的技术包括了：

- 基础框架：Spring
- 前端：BootStrap
- 展现层：Velocity
- 服务层：Spring
- DAO层：MyBatis
- DB层：Mysql
- SCM: MAVEN,Git
			
# 2.主要中间件简介 #
## 2.1.Spring Boot ##
   Spring框架是由于软件开发的复杂性而创建的。Spring使用的是基本的JavaBean来完成以前只可能由EJB完成的事情。然而，Spring的用途不仅仅限于服务器端的开发。从简单性、可测试性和松耦合性的角度而言，绝大部分Java应用都可以从Spring中受益。
   Spring的优点：  
   ◆ J2EE应该更加容易使用。  
   ◆ 面向对象的设计比任何实现技术（比如J2EE）都重要。  
   ◆ 面向接口编程，而不是针对类编程。Spring将使用接口的复杂度降低到零。（面向接口编程有哪些复杂度？）  
   ◆ 代码应该易于测试。Spring框架会帮助你，使代码的测试更加简单。  
   ◆ JavaBean提供了应用程序配置的最好方法。  
   ◆ 在Java中，已检查异常（Checked exception）被过度使用。框架不应该迫使你捕获不能恢复的异常。  
## 2.2.BootStrap ##
 它由Twitter的设计师Mark Otto和Jacob Thornton合作开发，是一个CSS/HTML框架。Bootstrap提供了优雅的HTML和CSS规范，它即是由动态CSS语言Less写成,使Web开发更加快捷。  
 它使你只需要写简单的代码就可以很快的搭建一个还不错的前端框架，他是后端程序员的福音，使他们只需要专注业务逻辑，而无须浪费太多的精力在界面设计上。  
 它可以开发全响应式网页——不论你使用手机、平板电脑、普通个人电脑浏览网站内容，所有的元素都可以很优雅的呈现。所以，可以用他来开发适合各种设备浏览的页面，避免了大量的因为兼容性而导致的重复劳动。  
## 2.3.Velocity ##
Velocity是一个基于java的模板引擎（template engine）。它允许任何人仅仅简单的使用模板语言（template language）来引用由java代码定义的对象。 当Velocity应用于web开发时，界面设计人员可以和java程序开发人员同步开发一个遵循MVC架构的web站点，也就是说，页面设计人员可以只 关注页面的显示效果，而由java程序开发人员关注业务逻辑编码。Velocity将java代码从web页面中分离出来，这样为web站点的长期维护提 供了便利，同时也为我们在JSP和PHP之外又提供了一种可选的方案。
## 2.4.MyBatis ##
MyBatis 是一个可以自定义SQL、存储过程和高级映射的持久层框架。MyBatis 摒除了大部分的JDBC代码、手工设置参数和结果集重获。MyBatis 只使用简单的XML 和注解来配置和映射基本数据类型、Map 接口和POJO 到数据库记录。相对Hibernate和Apache OJB等“一站式”ORM解决方案而言，Mybatis 是一种“半自动化”的ORM实现。
## 2.6.Mysql数据库 ##
MySQL是一种开放源代码的关系型数据库管理系统（RDBMS），MySQL数据库应该是目前软件行业最常用的开源数据库。
## 2.7.MAVEN ##
maven是一个项目构建和管理的工具，提供了帮助管理 构建、文档、报告、依赖、scms、发布、分发的方法。可以方便的编译代码、进行依赖管理、管理二进制库等等。  
maven的好处在于可以将项目过程规范化、自动化、高效化以及强大的可扩展性  
利用maven自身及其插件还可以获得代码检查报告、单元测试覆盖率、实现持续集成等等。
# 3.项目功能 #
本项目实现了一个投票功能，用户可以创建一个新的投票，然后在投票列表中看到它，然后可以从列表中删除它。

## 3.1.新建部门信息 ##
在默认首页面上点击**添加新投票**按钮，系统弹出录入页面，在页面中输入：投票标题、模式、截止时间，保存成功。
![新建](http://i.imgur.com/JdmiLNN.png)

## 3.2.投票列表 ##
投票列表页面显示了所有创建过的投票记录，包含每个投票的：标题，模式，创建时间和截止时间等信息，点击**绿色小笔**按钮，可以进行投票。点击**垃圾箱**按钮，可以进行删除。
![修改操作](http://i.imgur.com/028KqEn.png)


# 4.主要代码说明#
## 4.1.SurveyController.java ##
   包名：com.vincent.controller

		@Controller
        @RequestMapping("/survey")
        public class SurveyController {
            private static final Logger LOGGER = LoggerFactory.getLogger(SurveyController.class);
        
            @Resource
            private SurveyService surveyService;
        
            @RequestMapping("doSurvey")
            public ModelAndView index() {
                ModelAndView mv = new ModelAndView("home");
                return mv;
            }
        
            @RequestMapping("list")
            public ModelAndView surveyList() {
                List<Survey> surveyList = surveyService.getAllSurveyList();
                ModelAndView mv = new ModelAndView("surveyList");
                mv.addObject("surveyList", surveyList);
                return mv;
            }
        
            @ResponseBody
            @RequestMapping("/addSurvey.do")
            public String addConfig(Survey survey) {
                LOGGER.error("aabbcc: " + survey.getMode() + ", " + survey.getCreateTime()  + ", " + survey.getTopic());
                int res = surveyService.addSurvey(survey);
                if (res == 1) {
                    return "Success!";
                } else {
                    return "Failed!" ;
                }
            }
        
            @ResponseBody
            @RequestMapping("/deleteSurvey")
            public String deleteConfig(int id) {
                int res = surveyService.deleteMonitorConfig(id);
                if (res == 1) {
                    return "Success！";
                } else {
                    return "Failed! ";
                }
            }
        }
## 4.2.SurveyService.java ##
   包名：com.vincent.service

	@Service
    public class SurveyService {
    
        @Resource
        private SurveyDao surveyDao;
    
        /**
         * 返回所有投票
         *
         * @return
         */
        public List<Survey> getAllSurveyList() {
            List<Survey> surveyList = surveyDao.getAllSurveyList();
            return surveyList;
        }
    
        /**
         * 添加一条投票
         *
         * @param survey
         * @return
         */
        public int addSurvey(Survey survey) {
            return surveyDao.addSurvey(survey);
        }
    
    
        /**
         * 删除一条投票
         *
         * @param id
         * @return
         */
        public int deleteMonitorConfig(int id) {
            return surveyDao.deleteSurvey(id);
        }
    }
## 4.3.surveyList.vm ##
   文件路径为：src\main\webapp\WEB-INF\vm\surveyList.vm

    <-- 列表代码 --!>
	<div class="main-content" style="padding: 10px 10px;">
	......
	<-- 添窗口加投票代码 --!>
	<div id="add-monitor-window" title="" class="hide">
	......
	<-- 引用的js --!>
	<script type="text/javascript" src="/js/survey.js"></script>
	......
## 4.4.survey.js ##
   文件路径为：src\main\webapp\js\survey.js

    <-- 主要方法如下 --!>
	function openDialog(submitType) {
	function openUpdatePage(id) {
	function deleteConfig(id) {
	function doSubmit(submitType) {
	......


# 5.总结 #
   以上为中间件课程的课堂报告，通过这堂课，又重温了一次完整工程的开发，从js到java到数据库，从spring配置到mybatis配置，很有收获。
