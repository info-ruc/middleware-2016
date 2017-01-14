package com.jd.demotion.action;

import com.jd.cf.demotion_sys.domain.Plate;
import com.jd.cf.demotion_sys.domain.User;
import com.jd.cf.demotion_sys.service.PlateService;
import com.jd.cf.demotion_sys.service.UserService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;
import redis.clients.jedis.ShardedJedis;
import redis.clients.jedis.ShardedJedisPool;
import sun.rmi.runtime.NewThreadAction;

import javax.annotation.Resource;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-25
 * Time: 上午10:02
 * To change this template use File | Settings | File Templates.
 */

@Controller
public class indexAction extends  BaseController{
    private final static Logger logger = LoggerFactory.getLogger(indexAction.class);

    @Resource(name = "userService")
    private UserService userService;

    @Resource(name = "plateService")
    PlateService plateService;

    private Integer TIME=1500;

    @Resource(name = "jedis")
    private ShardedJedisPool jedisSentinelPool;
    @RequestMapping("/")
    public ModelAndView indexN(HttpServletRequest request, HttpServletResponse response){
        return new ModelAndView("redirect:http://www.schoolhome.com/index.html");
    }

    @RequestMapping("/index.html")
    public ModelAndView index(HttpServletRequest request, HttpServletResponse response){
        List<Plate> plateList= plateService.selectPlateAll();
        List<Plate> plateslist=new ArrayList<Plate>();
        if(plateList.size()>3){
           plateslist=plateList.subList(0,3);
        }
        Plate plateRight=new Plate();
        if(plateList.size()==4){
            plateRight=plateList.get(3);
        }
        ModelAndView model=new ModelAndView("index");
        model.addObject("plateList",plateslist);
        model.addObject("plateRight",plateRight);
        model.addObject("plateListAll",plateList);
        model.addObject("pin",findUserPin(request));
        return model;
    }
    @RequestMapping("/login.html")
    public ModelAndView loginHtml(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=new ModelAndView("login");
        model.addObject("returnUrl",request.getParameter("returnUrl"));
        return model;
    }
    @RequestMapping("/loginOut.html")
    public ModelAndView loginOut(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=null;
        Cookie cookie=getCookie(request,"userName");
        String pin=findUserPin(request);
       if(cookie!=null){
        cookie.setValue("");
        cookie.setPath("/");
        cookie.setMaxAge(0);
        response.addCookie(cookie);
       }
        ShardedJedis jedis= jedisSentinelPool.getResource();
        if(jedis!=null && jedis.get("pin_"+pin)!=null ){
            jedis.del("pin_"+pin);
        }

        model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
        return model;
    }


    @RequestMapping("/login.action")
    public ModelAndView loginAction(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=null;
        String name=request.getParameter("username");
        String password=request.getParameter("password");
        String returnUrl=request.getParameter("returnUrl");
        logger.info("name:{},password:{}",name,password);
        String msg=null;
        if(!(stringBlank(name) && stringBlank(password))){
            if(stringBlank(name)){
                msg="001";
            }
            if(stringBlank(password)){
                msg="002";
            }
        }
        if(stringBlank(msg) && !stringBlank(name) && !stringBlank(password)){
            User user=new User();
            user.setUserName(name);
            user.setPassword(password);
            List<User> users= userService.selectUser(user);
            if(users!=null && users.size()>0){
                user=users.get(0);
                String nameValue=null;
                try {
                    nameValue= URLEncoder.encode(user.getName(),"UTF-8");
                } catch (UnsupportedEncodingException e) {
                    logger.error("",e);
                }
                Cookie cookie=new Cookie("userName",nameValue);
                cookie.setMaxAge(TIME);
                cookie.setPath("/");
                response.addCookie(cookie);

                ShardedJedis jedis= jedisSentinelPool.getResource();
                try{
                    String key="pin_"+user.getName();
                    jedis.del(key);
                    jedis.setex(key,TIME,user.getName());
                }catch (Exception e){
                    logger.error("",e);
                }
                if(stringBlank(returnUrl)){
                    model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
                }else{
                    try {
                        model=new ModelAndView("redirect:"+ URLDecoder.decode(returnUrl));
                    } catch (Exception e) {
                        logger.error("",e);
                    }
                }
                return model;
            }else{
               msg="003";
            }
        }
        model=new ModelAndView("login");
        model.addObject("msg",msg);
        logger.info("msg:{}",msg);
        return model;
    }



}
