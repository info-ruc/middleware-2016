package com.jd.demotion.action;

import com.google.gson.Gson;
import com.jd.cf.demotion_sys.domain.Node;
import com.jd.cf.demotion_sys.domain.Plate;
import com.jd.cf.demotion_sys.domain.User;
import com.jd.cf.demotion_sys.service.NodeService;
import com.jd.cf.demotion_sys.service.PlateService;
import com.jd.cf.demotion_sys.service.UserService;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.servlet.ModelAndView;
import redis.clients.jedis.Jedis;
import redis.clients.jedis.JedisSentinelPool;
import redis.clients.jedis.ShardedJedis;
import redis.clients.jedis.ShardedJedisPool;

import javax.annotation.Resource;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created with IntelliJ IDEA.
 * User: wangyi9
 * Date: 15-5-20
 * Time: 上午9:52
 * To change this template use File | Settings | File Templates.
 */
@Controller
public class UserAction extends BaseController {
    private final static Logger logger = LoggerFactory.getLogger(UserAction.class);


    @Resource(name = "nodeService")
    private NodeService nodeService;

    @Resource(name = "userService")
    private UserService userService;

    @Resource(name = "plateService")
    PlateService plateService;

    @Resource(name = "jedis")
    private ShardedJedisPool jedisSentinelPool;

    private Integer TIME=1500;

    @RequestMapping("/insertUser.html")
    public  ModelAndView resetUser(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=new ModelAndView("user/insertUser");
        List<Plate> plateList= plateService.selectPlateAll();
        model.addObject("pin",findUserPin(request));
        model.addObject("plateListAll",plateList);
        return  model;
    }
    @RequestMapping("/findUserName.action")
    public  String findUserName(HttpServletRequest request, HttpServletResponse response){
        String userName=request.getParameter("userName");
        Map<String,Integer> map=new  HashMap<String,Integer>();
        User user=new User();
        user.setUserName(userName);
        List<User> userList=userService.selectUser(user);
        if(userList!=null && userList.size()>0){
              map.put("msg",1);
        }else{
            map.put("msg",0);
        }
        Gson gson=new Gson();
        try {
            writeJson(response,gson.toJson(map));
        } catch (Exception e) {
            logger.error("",e);
        }
        return  null;
    }


    @RequestMapping("/insertUser.action")
    public ModelAndView insertUser(HttpServletRequest request, HttpServletResponse response,User user){
        logger.info("进入insertUser");
        ModelAndView model=null;
        String msg=null;
        if(user!=null){
            if(stringBlank( user.getName())){
                msg="请输入昵称";
            }
            if(stringBlank( user.getUserName())){
                msg="请输入账号";
            }
            if(stringBlank(user.getPassword())){
                msg="请输入密码";
            }
            if(stringBlank(msg)){
                try{
                    Boolean result=userService.insertUser(user);
                    if(result){
                        model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
                        return model;
                    }
                }catch (Exception e){
                    logger.error("添加失败",e);
                    msg="添加失败";
                }
            }
        }else{
            msg="请输入必填用户信息";
        }
        model=new ModelAndView("user/insertUser");
        model.addObject("msg",msg);
        return model;
    }
    @RequestMapping("/school/updateUser.html")
    public ModelAndView updateUser(HttpServletRequest request, HttpServletResponse response){
        ModelAndView model=new ModelAndView("user/userMsg");
        List<Plate> plateList= plateService.selectPlateAll();
        String pin=findUserPin(request);
        User user=new User();
        user.setName(pin);
        List<User> users=userService.selectUser(user);
        if(users!=null && users.size()>0){
           model.addObject("user", users.get(0));
        }
        model.addObject("pin",pin);
        model.addObject("plateListAll",plateList);
        return model;
    }

    @RequestMapping("/school/updateUser.action")
    public ModelAndView updateUser(HttpServletRequest request, HttpServletResponse response,User user){
        ModelAndView model=null;
        String msg=null;
        String pin=findUserPin(request);
        if(!stringBlank(pin)){
            User oldUser=new User();
            oldUser.setName(pin);
            try{
                oldUser=userService.selectUser(oldUser).get(0);
            }catch (Exception e){
                logger.error("无法获取用户信息",e);
                oldUser=null;
            }
            if(user!=null && oldUser!=null){
                user.setId(oldUser.getId());
                if(stringBlank( user.getName())){
                    msg="请输入昵称";
                }
                if(stringBlank(user.getPassword())){
                    msg="请输入密码";
                }
                if(stringBlank(msg)){
                    try{
                        User userNew=new User();
                        userNew.setName(pin);
                        userNew=userService.selectUser(userNew).get(0);
                        user.setUserName(userNew.getUserName());
                        user.setId(userNew.getId());
                        Gson gson=new Gson();
                        logger.info("gson;{}",gson.toJson(user));
                        Boolean result=userService.updateUserById(user);
                        if(result){
                            String nameValue=null;
                            try {
                                nameValue= URLEncoder.encode(user.getName(), "UTF-8");
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
                            model=new ModelAndView("redirect:http://www.schoolhome.com/index.html");
                            return model;
                        }
                    }catch (Exception e){
                        logger.error("添加失败",e);
                        msg="添加失败";
                    }
                }
            }else{
                msg="请输入必填用户信息";
            }
        }else {
            model=new ModelAndView("login");
            return model;
        }
        model=new ModelAndView("insertUser");
        model.addObject("msg",msg);
        return model;
    }

    @RequestMapping("/school/userMsg.html")
    public ModelAndView userMsg(HttpServletRequest request, HttpServletResponse response){
        String pin=findUserPin(request);
        ModelAndView model=null;
        if(stringBlank(pin)){
            model=new ModelAndView("login");
            return model;
        }
        model=new ModelAndView("userMsg");
        User user=new User();
        user.setName(pin);
        try{
            user=userService.selectUser(user).get(0);
        }catch (Exception e){
            logger.error("无法获取用户信息",e);
            user=null;
        }
        if(user!=null){
            try{
                Node node=new Node();
                node.setUserId(user.getId());
                List<Node> nodeList=nodeService.selectNode(node);
                model.addObject("nodeList",nodeList);
            }catch (Exception e){
                logger.error("无法获取用户贴信息",e);
            }
        }
        model.addObject("user",user);
        return model;
    }



}
